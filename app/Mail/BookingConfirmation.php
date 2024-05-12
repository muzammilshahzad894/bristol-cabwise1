<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BookingConfirmation extends Mailable
{
use Queueable, SerializesModels;

public $messageContent;

/**
* Create a new message instance.
*
* @param string $messageContent
* @return void
*/
public function __construct($messageContent)
{
$this->messageContent = $messageContent;
}

/**
* Build the message.
*
* @return $this
*/
public function build()
{
return $this->subject('CAR RENT') // Email subject
->view('emails.booking_confirmation') // Blade template for email content
->with(['content' => $this->messageContent]); // Pass data to the view
}
}