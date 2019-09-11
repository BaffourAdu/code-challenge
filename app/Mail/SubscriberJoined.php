<?php

namespace App\Mail;

use App\Subscriber;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SubscriberJoined extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    private $subscriber;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Subscriber $subscriber)
    {
        $this->subscriber = $subscriber;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.subscribers.joined-waitlist')
                ->subject('Someone joined the waitlist')
                ->replyTo($this->subscriber->email);
    }
}
