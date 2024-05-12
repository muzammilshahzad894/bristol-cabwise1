<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Quote extends Mailable
{
    use Queueable, SerializesModels;

    public $bookingDetails;
    public $message;

    /**
     * Create a new message instance.
     *
     * @param  array  $bookingDetails
     * @param  string $message
     * @return void
     */
    public function __construct($bookingDetails)
    {
        $this->bookingDetails = $bookingDetails;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Booking Confirmation')
            ->view('emails.quote')
            ->with([
                'bookingDetails' => $this->bookingDetails
            ]);
    }
}