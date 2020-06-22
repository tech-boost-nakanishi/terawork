<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CorporateRegisterMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $corporate;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($corporate)
    {
        $this->corporate = $corporate;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.corporate_register_emailcheck')
                    ->text('emails.corporate_register_emailcheck_plain')
                    ->subject('【' . config('app.name') . '】仮登録が完了しました。')
                    ->with([
                        'email' => $this->corporate->email,
                        'token' => $this->corporate->email_verify_token,
                      ]);
    }
}