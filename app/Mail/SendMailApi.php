<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Queue\SerializesModels;

class SendMailApi extends Mailable
{
    use Queueable, SerializesModels;

    public string $subjectText;
    public string $bodyText;
    public string $userName;
    public string $systemName;
    public array $attachmentsList;

    public function __construct(string $subject, string $body, string $userName, string $systemName, array $attachments = [])
    {
        $this->subjectText = $subject;
        $this->bodyText = $body;
        $this->userName = $userName;
        $this->systemName = $systemName;
        $this->attachmentsList = $attachments;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subjectText
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.default',
            with: [
                'body' => $this->bodyText,
                'userName' => $this->userName,
                'systemName' => $this->systemName,
            ]
        );
    }

    public function attachments(): array
    {
        $att = [];
        foreach ($this->attachmentsList as $file) {
            $att[] = Attachment::fromPath($file['path'])
                ->as($file['file_name']);
        }
        return $att;
    }
}
