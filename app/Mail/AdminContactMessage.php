<?php

namespace App\Mail;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AdminContactMessage extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $message;

    public function __construct(User $user, string $message)
    {
        $this->user = $user;
        $this->message = $message;
    }

    public function build()
    {
        return $this->subject('お問い合わせが届きました')
            ->html("<html lang='ja'>
                        <head>
                            <meta charset='UTF-8'>
                            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                            <title>お問い合わせが届きました</title>
                        </head>
                        <body>
                            <p>管理者様</p>
                            <p>お問い合わせが届きました。</p>
                            <p>以下の内容でお問い合わせを受け付けました。</p>
                            <p>お問い合わせ内容: $this->message</p>
                            <p>お客様情報 名前: {$this->user->name}</p>
                            <p>お客様情報 メールアドレス: {$this->user->email}</p>
                        </body>
                    </html>");
    }


    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Admin Contact Message',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'view.name',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
