<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\User;

class ApplyConfirmMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $name;
    protected $corporate_email;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $corporate_email)
    {
        $this->name = $name;
        $this->corporate_email = $corporate_email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.apply_confirm')
                    ->text('emails.apply_confirm_plain')
                    ->subject('応募が完了しました。')
                    ->with([
                        'name' => $this->name,
                        'corporate_email' => $this->corporate_email,
                      ]);
    }
}
