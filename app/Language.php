<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    public function recruits()
    {
    	return $this->belongsToMany('App\Recruit', "recruit_languages");
    }
}
