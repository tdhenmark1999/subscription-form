<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Subscriber;

class WelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subscriber;

    public function __construct(Subscriber $subscriber)
    {
        $this->subscriber = $subscriber;
    }

    public function build()
    {
        return $this->view('emails.welcome')
            ->with([
                'unsubscribeUrl' => url("/api/unsubscribe?email={$this->subscriber->email}"),
            ]);
    }
}
