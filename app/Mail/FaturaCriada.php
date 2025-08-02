<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class FaturaCriada extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function envelope()
    {
        return new Envelope(
            subject: 'Fatura #' . $this->data['pedido']->code . ' - ' . config('app.name'),
        );
    }

    public function content()
    {
        return new Content(
            view: 'emails.fatura',
            with: [
                'fatura' => $this->data['fatura'],
                'user' => $this->data['user'],
                'pedido' => $this->data['pedido'],
                'service' => $this->data['service'],
                'payment_method' => $this->data['payment_method']
            ]
        );
    }

    public function attachments()
    {
        return [];
    }
}