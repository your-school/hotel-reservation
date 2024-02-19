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

class UserReservationConfirmation extends Mailable
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
        return $this->subject('予約完了のお知らせ')
            ->html("<html lang='ja'>
                        <head>
                            <meta charset='UTF-8'>
                            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                            <title>予約完了のお知らせ</title>
                        </head>
                        <body>
                            <p>{$this->user->name} 様</p>
                            <p>予約が完了しました。以下の内容で予約を受け付けました。</p>
                            <p>予約内容: {$this->reservation->check_in_date} 〜 {$this->reservation->check_out_date}</p>
                            <p>宿泊施設: {$this->reservation->hotelPlan->hotel->name} - {$this->reservation->hotelPlan->title}</p>
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
            subject: 'User Reservation Confirmation',
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
