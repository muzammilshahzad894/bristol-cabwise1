<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BookingConfirm extends Mailable
{
    use Queueable, SerializesModels;

    public $bookingDetails;
    public $notify;

    /**
     * Create a new message instance.
     *
     * @param  array  $bookingDetails
     * @param  string $message
     * @return void
     */
    public function __construct($bookingDetails, $notify)
    {
        $this->bookingDetails = $bookingDetails;
        $this->notify = $notify;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Booking Confirmation')
            ->view('emails.booking_confirmation')
            ->with([
                'bookingDetails' => $this->bookingDetails,
                'notify' => $this->notify
            ]);
    }
}