<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Pedido;
use App\Models\Fatura;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PDF;
use Illuminate\Support\Facades\Mail;
use App\Mail\FaturaCriada;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class FaturaController extends Controller
{
    use AuthorizesRequests;

    public function selectPaymentForm(Service $service)
    {
        return view('payment', [
            'service' => $service,
            'methods' => [
                'Transferência por IBAN',
                'Transferência por Nº de conta', 
                'Depósito',
                'Cash'
            ]
        ]);
    }

    public function selectPayment(Request $request, Service $service)
    {
        $validated = $request->validate([
            'payment_method' => 'required|in:Transferência por IBAN,Transferência por Nº de conta,Depósito,Cash'
        ]);

        session([
            'payment_method' => $validated['payment_method'],
            'payment_service_id' => $service->id,
            'payment_expires' => now()->addMinutes(30)
        ]);

        return redirect()->route('invoices.preview', $service);
    }

    public function showInvoice(Service $service)
    {
        if (session('payment_service_id') != $service->id || 
            !session()->has('payment_method') || 
            now()->gt(session('payment_expires'))) {
            
            session()->forget(['payment_method', 'payment_service_id', 'payment_expires']);
            return redirect()->route('payments.select', $service->id)
                ->with('error', 'Sessão expirada ou método não selecionado');
        }

        return view('preview', [
            'service' => $service,
            'payment_method' => session('payment_method'),
            'user' => auth()->user()
        ]);
    }

    public function processInvoice(Request $request, Service $service)
    {
        if (!session()->has('payment_method')) {
            return redirect()->route('payments.select', $service->id)
                ->with('error', 'Método de pagamento não selecionado');
        }

        DB::beginTransaction();

        try {
            $user = auth()->user();
            if (!$user) {
                throw new \Exception('Usuário não autenticado');
            }

            if (!is_numeric($service->preco) || $service->preco <= 0) {
                throw new \Exception('Preço do serviço inválido');
            }

            $pedido = Pedido::create([
                'code' => 'ElpCod' . str_pad(Pedido::count() + 1, 6, '0', STR_PAD_LEFT),
                'id_user' => $user->id,
                'id_service' => $service->id
            ]);

            $pdf = PDF::loadView('pdf.fatura', [
                'pedido' => $pedido,
                'service' => $service,
                'user' => $user,
                'payment_method' => session('payment_method')
            ])->setPaper('a4', 'portrait')
              ->setOptions([
                  'isHtml5ParserEnabled' => true,
                  'isRemoteEnabled' => true,
                  'defaultFont' => 'sans-serif'
              ]);

            $pdfContent = $pdf->output();
            if (empty($pdfContent)) {
                throw new \Exception('Falha ao gerar o conteúdo do PDF');
            }

            $directory = 'faturas';
            Storage::disk('public')->makeDirectory($directory, 0755, true);
            
            $filename = 'fatura-' . $pedido->code . '.pdf';
            $path = $directory . '/' . $filename;

            if (!Storage::disk('public')->put($path, $pdfContent)) {
                throw new \Exception('Falha ao salvar o arquivo PDF');
            }

            $fatura = Fatura::create([
                'id_pedido' => $pedido->id,
                'total' => $service->preco,
                'metodo_pagamento' => session('payment_method'),
                'path' => $path,
                'status' => 'pendente'
            ]);

try {
    Mail::to($user->email)->send(new FaturaCriada([
        'fatura' => $fatura,
        'user' => $user,
        'pedido' => $pedido,
        'service' => $service,
        'payment_method' => session('payment_method')
    ]));
    
    $emailStatus = [
        'sent' => true,
        'message' => 'E-mail enviado com sucesso'
    ];
    } catch (\Exception $e) {
        Log::error('Falha no envio de email', [
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString(),
            'fatura' => $fatura->id ?? null
        ]);
        
        $emailStatus = [
            'sent' => false,
            'message' => 'Fatura criada, mas e-mail não enviado: ' . $e->getMessage()
        ];
    }
            DB::commit();

            // Garantir que a fatura foi persistida
            if (!Fatura::where('id', $fatura->id)->exists()) {
                throw new \Exception('Falha na persistência da fatura no banco de dados');
            }

            // Adiciona pequeno delay apenas em desenvolvimento
            if (app()->environment('local')) {
                usleep(200000); // 200ms
            }

            session()->forget(['payment_method', 'payment_service_id', 'payment_expires']);
            
            return redirect()->route('invoice.confirmation')
                ->with([
                    'success' => 'Fatura criada com sucesso',
                    'fatura_id' => $fatura->id,
                    'fatura_data' => $fatura->toArray(),
                    'email_status' => $emailStatus,
                    'invoice_view_url' => route('invoices.show', $fatura->id)
                ]);

        } catch (QueryException $e) {
            DB::rollBack();
            return $this->handleError('Erro no banco de dados', $service->id, $e);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->handleError($e->getMessage(), $service->id, $e);
        } catch (Throwable $e) {
            DB::rollBack();
            return $this->handleError('Erro inesperado', $service->id, $e);
        }
    }

    public function show(Fatura $invoice)
    {
        try {
            $this->authorize('view', $invoice);
            
            if (!Storage::disk('public')->exists($invoice->path)) {
                throw new HttpException(404, 'Arquivo da fatura não encontrado');
            }

            $fullPath = Storage::disk('public')->path($invoice->path);

            return response()->file($fullPath, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="fatura-' . $invoice->pedido->code . '.pdf"'
            ]);

        } catch (HttpException $e) {
            return response()->view('errors.custom', [
                'message' => $e->getMessage()
            ], $e->getStatusCode());
        } catch (\Exception $e) {
            Log::error('Erro ao exibir fatura', [
                'error' => $e->getMessage(),
                'fatura_id' => $invoice->id
            ]);
            return response()->view('errors.custom', [
                'message' => 'Erro ao exibir fatura: ' . (config('app.debug') ? $e->getMessage() : '')
            ], 500);
        }
    }

    public function download(Fatura $invoice)
    {
        try {
            $this->authorize('view', $invoice);

            $filePath = storage_path('app/public/' . $invoice->path);
            
            if (!file_exists($filePath)) {
                throw new HttpException(404, 'Arquivo não encontrado');
            }

            $fileContent = file_get_contents($filePath);
            if (strpos($fileContent, '%PDF-') !== 0) {
                throw new HttpException(500, 'Arquivo PDF corrompido');
            }

            return response()->download($filePath, 'fatura-' . $invoice->pedido->code . '.pdf', [
                'Content-Type' => 'application/pdf',
                'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0'
            ]);

        } catch (HttpException $e) {
            return response()->view('errors.custom', [
                'message' => $e->getMessage()
            ], $e->getStatusCode());
        } catch (\Exception $e) {
            return response()->view('errors.custom', [
                'message' => 'Erro no download'
            ], 500);
        }
    }

    public function showConfirmation()
    {
        if (!session()->has('fatura_id')) {
            return redirect()->route('dashboard')->with('error', 'Sessão de confirmação inválida');
        }   

        // Tenta carregar do banco de dados, se não encontrar usa os dados da sessão
        $fatura = Fatura::find(session('fatura_id'));
        
        if (!$fatura) {
            Log::warning('Fatura não encontrada no BD, usando dados da sessão', ['id' => session('fatura_id')]);
            $fatura = new Fatura(session('fatura_data'));
        }

        return view('confirmation', [
            'invoice' => $fatura,
            'email_status' => session('email_status'),
            'invoice_url' => session('invoice_view_url')
        ]);
    }

    private function handleError($message, $serviceId, $exception = null)
    {
        Log::error('Erro no FaturaController', [
            'message' => $message,
            'exception' => $exception?->getMessage(),
            'service_id' => $serviceId
        ]);

        $message = config('app.debug') 
            ? $message . ' [' . ($exception?->getMessage() ?? '') . ']'
            : 'Ocorreu um erro ao processar sua solicitação';

        return redirect()->route('services.show', $serviceId)
               ->with('error', $message);
    }
}