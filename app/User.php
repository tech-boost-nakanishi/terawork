<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Validation\Rule;
use Auth;

class User extends Authenticatable
{
    use Notifiable;

    protected $guarded = array('id');

    public static function rules(array $data)
    {
        return [
            'name' => ['required', 'string', 'max:255', 'regex:/^[ぁ-んァ-ヶー一-龠]+$/'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore(Auth::guard('user')->user()->id)],
        ];
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function applies()
    {
        return $this->hasMany("App\Apply");
    }

    public function viewhistories()
    {
        return $this->hasMany("App\ViewHistory");
    }

    public function favorites()
    {
        return $this->hasMany("App\Favorite");
    }

    public function sendmessages()
    {
        return $this->hasMany("App\Message", "send_user_id");
    }

    public function recievemessages()
    {
        return $this->hasMany("App\Message", "recieve_user_id");
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function($user){
            foreach ($user->applies()->get() as $child) {
                $child->delete();
            }

            foreach ($user->viewhistories()->get() as $child) {
                $child->delete();
            }

            foreach ($user->favorites()->get() as $child) {
                $child->delete();
            }

            foreach ($user->sendmessages()->get() as $child) {
                $child->delete();
            }

            foreach ($user->recievemessages()->get() as $child) {
                $child->delete();
            }
        });
    }
}
