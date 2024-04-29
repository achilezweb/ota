<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewJobNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $jobData;

    /**
     * Create a new message instance.
     */
    public function __construct($jobData)
    {
        $this->jobData = $jobData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('New Job Posting')
                    ->markdown('emails.jobs.notifications')
                    ->with([
                        'title' => $this->jobData['title'],
                        'description' => $this->jobData['description'],
                        'approveLink' => route('boards.approve', ['job' => $this->jobData['id']]),
                        'spamLink' => route('boards.spam', ['job' => $this->jobData['id']])
                    ]);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Job Notification',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.jobs.notifications',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
