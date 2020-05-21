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

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $corporate_email)
    {
        $this->user = User::find($user);
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
                        'user' => $this->user,
                        'corporate_email' => $this->corporate_email,
                      ]);
    }
}
