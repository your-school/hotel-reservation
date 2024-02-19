<?php

namespace App\Mail;

use App\Models\Reservation;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AdminReservationConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $reservation;

    public function __construct(User $user, Reservation $reservation)
    {
        $this->user = $user;
        $this->reservation = $reservation;
    }

    public function build()
    {
        return $this->subject('予約受付のお知らせ')
            ->html("<html lang='ja'>
                        <head>
                            <meta charset='UTF-8'>
                            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                            <title>予約受付のお知らせ</title>
                        </head>
                        <body>
                            <p>管理者様</p>
                            <p>新しい予約がありました。以下は予約の詳細です。</p>
                            <p>予約内容: {$this->reservation->check_in_date} 〜 {$this->reservation->check_out_date}</p>
                            <p>予約者: {$this->user->name} ({$this->user->email})</p>
                            <p>宿泊施設: {$this->reservation->hotelPlan->hotel->name} - {$this->reservation->hotelPlan->title}</p>
                            <p>メッセージ: {$this->reservation->message}</p>
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
            subject: 'Admin Reservation Confirmation',
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
