<?php

namespace App\Mail;

use App\Models\Boat;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewsletterMail extends Mailable
{
    use Queueable, SerializesModels;
    public $boat;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Boat $boat)
    {
        $this->boat = $boat;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.subscriber');
    }
}
