<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\SiswaModel;



class SendEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $siswa;
    

    /**
     * Create a new message instance.
     */
    public function __construct(SiswaModel $siswa)
    {
        $this->siswa = $siswa;
        //
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Send Email',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.sendemail',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
{
    return [
        Attachment::fromPath(storage_path('app/public/Pemrograman Web II-14.pdf'))
            ->as('file yang disertakan')
            ->withMime('application/pdf'),
    ];
}

}
