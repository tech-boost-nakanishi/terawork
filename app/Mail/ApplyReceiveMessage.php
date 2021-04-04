<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ApplyReceiveMessage extends Mailable
{
    use Queueable, SerializesModels;

    protected $name;
    protected $apply_id;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $apply_id)
    {
        $this->name = $name;
        $this->apply_id = $apply_id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.apply_receive_message')
                    ->text('emails.apply_receive_message_plain')
                    ->subject('企業からメッセージが届きました。')
                    ->with([
                        'name' => $this->name,
                        'apply_id' => $this->apply_id,
                      ]);
    }
}
