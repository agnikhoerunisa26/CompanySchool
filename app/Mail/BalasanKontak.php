<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class BalasanKontak extends Mailable
{
    public function __construct(
        public string $subjekBalasan,
        public string $isiHtml,
        public ?string $lampiranPath = null,
        public ?string $lampiranNama = null,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(subject: $this->subjekBalasan);
    }

    public function content(): Content
    {
        return new Content(view: 'emails.balasan-kontak');
    }

    public function attachments(): array
    {
        if (!$this->lampiranPath) {
            return [];
        }

        return [Attachment::fromPath($this->lampiranPath)->as($this->lampiranNama)];
    }
}