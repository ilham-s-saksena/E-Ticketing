<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $email;
    public $eventId;
    public $token;
    public $total;
    public $order;
    public $tickets;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $email, $eventId, $token, $total, $order, $tickets)
    {
        $this->name = $name;
        $this->email = $email;
        $this->eventId = $eventId;
        $this->token = $token;
        $this->total = $total;
        $this->order = $order;
        $this->tickets = $tickets;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.user_notification')
                    ->with([
                        'name' => $this->name,
                        'eventId' => $this->eventId,
                        'token' => $this->token,
                        'email' => $this->email,
                        'domain' => url('/'), // Jika perlu URL domain
                        'total' => $this->total,
                        'order' => $this->order,
                        'tickets' => $this->tickets,
                    ]);
    }
}
