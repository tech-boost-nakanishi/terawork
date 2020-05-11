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

    public function languages() 
    { 
    	return $this->belongsToMany('App\Language', "recruit_languages"); 
    }

    public function recruitlanguages() 
    { 
    	return $this->hasMany('App\RecruitLanguage'); 
    }
}
