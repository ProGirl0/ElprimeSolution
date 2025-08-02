<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Cliente;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Validation\ValidationException;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['string', 'max:255'],
            'bi' => ['required', 'string', 'max:255', 'unique:'.User::class],
            'tipo_de_usuario' => ['required', 'string', 'max:255'],
            'foto' => ['string', 'max:255'],
            'telefone' => ['required', 'integer', 'unique:'.User::class],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ], [
            'bi.unique' => 'Este número de BI já está registado',
            'telefone.unique' => 'Este número de telefone já está registado',
            'email.unique' => 'Este email já está registado',
            'telefone.integer' => 'O contacto deve conter apenas números',
        ]);

        
        // Validação adicional do BI via API
        $biValidation = $this->validarBIService($request->bi);

        if (!$biValidation['success']) {
            throw ValidationException::withMessages([
                'bi' => $biValidation['message'],
            ]);
        }

        $user = User::create([
            'name' => $request->name ?? $biValidation['name'],
            'bi' => $request->bi,
            'foto' => $request->foto,
            'telefone' => $request->telefone,
            'tipo_de_usuario' => $request->tipo_de_usuario,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        if ($request->tipo_de_usuario==='Cliente') {
            $cliente=Cliente::create([
                'id_usuario' => $user->id,

            ]);

                    event(new Registered($cliente));
        }


        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }

    /**
     * Endpoint para validação via AJAX
     */
public function validarBi(Request $request)
{
    $request->validate(['bi' => 'required|string']);

    $numeroBi = $request->input('bi');
    
    try {
        $resultado = $this->validarBIService($numeroBi);

        if (!$resultado['success']) {
            return response()->json([
                'error' => true,
                'message' => $resultado['message'],
                'name' => null
            ], 400);
        }

        return response()->json([
            'error' => false,
            'message' => $resultado['message'],
            'name' => $resultado['name']
        ]);

    } catch (\Exception $e) {
        \Log::error("Erro na validação do BI: " . $e->getMessage());
        
        return response()->json([
            'error' => true,
            'message' => 'Serviço temporariamente indisponível',
            'technical' => config('app.debug') ? $e->getMessage() : null
        ], 500);
    }
}

private function validarBIService(string $biNumber): array
{
    try {
        $url = "https://consulta.edgarsingui.ao/consultar/{$biNumber}";
        
        $response = Http::withOptions([
            'verify' => false,
            'timeout' => 15
        ])->get($url);

        // Verifica se a resposta é JSON válido
        $data = $response->json();
        
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \Exception("Resposta da API não é um JSON válido: " . $response->body());
        }

        \Log::debug("Resposta da API de validação:", [
            'bi' => $biNumber,
            'resposta' => $data
        ]);

        // Verifica a estrutura esperada
        if (isset($data['error'])) {
            return [
                'success' => !$data['error'],
                'message' => $data['error'] ? ($data['message'] ?? 'BI inválido') : 'BI válido',
                'name' => $data['name'] ?? null
            ];
        }

        // Se a API retornar sucesso sem campo 'error'
        if (isset($data['name'])) {
            return [
                'success' => true,
                'message' => 'BI válido',
                'name' => $data['name']
            ];
        }

        throw new \Exception("Resposta da API em formato inesperado");

    } catch (\Exception $e) {
        \Log::error("Erro no serviço de validação: " . $e->getMessage());
        return [
            'success' => false,
            'message' => 'Erro ao validar BI',
            'name' => null
        ];
    }
}}