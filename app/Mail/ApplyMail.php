<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ApplyMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $username;
    protected $user_id;
    protected $phonetic;
    protected $birth_year;
    protected $birth_month;
    protected $birth_day;
    protected $age;
    protected $live_pref_name;
    protected $email;
    protected $phone;
    protected $rectitle;
    protected $corporate_name;
    protected $contact_name;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($username, $user_id, $phonetic, $birth_year, $birth_month, $birth_day, $age, $live_pref_name, $email, $phone, $rectitle, $corporate_name, $contact_name)
    {
        $this->username = $username;
        $this->user_id = $user_id;
        $this->phonetic = $phonetic;
        $this->birth_year = $birth_year;
        $this->birth_month = $birth_month;
        $this->birth_day = $birth_day;
        $this->age = $age;
        $this->live_pref_name = $live_pref_name;
        $this->email = $email;
        $this->phone = $phone;
        $this->rectitle = $rectitle;
        $this->corporate_name = $corporate_name;
        $this->contact_name = $contact_name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.apply_mail')
                    ->text('emails.apply_mail_plain')
                    ->subject('応募がありました。')
                    ->with([
                        'username' => $this->username,
                        'user_id' => $this->user_id,
                        'phonetic' => $this->phonetic,
                        'birth_year' => $this->birth_year,
                        'birth_month' => $this->birth_month,
                        'birth_day' => $this->birth_day,
                        'age' => $this->age,
                        'live_pref_name' => $this->live_pref_name,
                        'email' => $this->email,
                        'phone' => $this->phone,
                        'rectitle' => $this->rectitle,
                        'corporate_name' => $this->corporate_name,
                        'contact_name' => $this->contact_name,
                      ]);
    }
}
