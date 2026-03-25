<?php

namespace App\Mail;

use App\Models\Application;
use App\Models\Setting;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ApplicationStatusChanged extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Application $application)
    {
        //
    }

    public function envelope(): Envelope
    {
        $siteName = Setting::get('site_name', 'WeducaApply');
        return new Envelope(
            subject: "Your Application Status Has Been Updated — {$siteName}",
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.application-status',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}

