<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apply extends Model
{
    protected $guarded = array('id');

    public static $rules = array(
        'username' => 'required',
        'phonetic' => 'required|regex:/^[ア-ン゛゜ァ-ォャ-ョー]+$/u',
        'birth_year' => 'required',
        'birth_month' => 'required',
        'birth_day' => 'required',
        'age' => 'required',
        'live_pref_name' => 'required',
        'email' => 'required',
        'phone' => 'required|numeric',
    );

    public function corporate()
    {
    	return $this->hasOneThrough("App\Corporate", "App\Recruit");
    }
}
