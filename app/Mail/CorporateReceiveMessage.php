<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CorporateReceiveMessage extends Mailable
{
    use Queueable, SerializesModels;

    protected $corporate_name;
    protected $contact_name;
    protected $username;
    protected $apply_id;
    protected $title;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($corporate_name, $contact_name, $username, $apply_id)
    {
        $this->corporate_name = $corporate_name;
        $this->contact_name = $contact_name;
        $this->username = $username;
        $this->apply_id = $apply_id;
        $this->title = sprintf('%sさんからメッセージが届きました。', $username);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.corporate_receive_message')
                    ->text('emails.corporate_receive_message_plain')
                    ->subject($this->title)
                    ->with([
                        'corporate_name' => $this->corporate_name,
                        'contact_name' => $this->contact_name,
                        'username' => $this->username,
                        'apply_id' => $this->apply_id,
                      ]);
    }
}
