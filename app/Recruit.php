<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recruit extends Model
{
    protected $guarded = array('id');

    public static $rules = array(
        'title' => 'required',
        'body' => 'required',
        'languages' => 'required',
        'monthly_income' => 'required',
        'pref_name' => 'required',
    );

    public function recruitlanguages() 
    { 
    	return $this->belongsToMany('App\Language', "recruit_languages"); 
    }
}
