<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Validation\Rule;
use Auth;

class Corporate extends Authenticatable
{
    use Notifiable;

    protected $guarded = array('id');

    public static function rules(array $data)
    {
        return [
            'corporate_name' => ['required', 'string', 'max:255'],
            'contact_name' => ['required', 'string', 'max:255', 'regex:/^[ぁ-んァ-ヶー一-龠]+$/'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('corporates')->ignore(Auth::guard('corporate')->user()->id)],
        ];
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'corporate_name', 'contact_name' , 'email', 'password',
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

    public function recruits()
    {
    	return $this->hasMany("App\Recruit");
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function($corporate){
            foreach ($corporate->recruits()->get() as $child) {
                $child->delete();
            }
        });
    }
}
