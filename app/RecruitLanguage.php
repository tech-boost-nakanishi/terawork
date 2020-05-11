<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RecruitLanguage extends Model
{
    protected $guarded = array('id');

    public function recruit()
    {
    	return $this->belongsTo("App\Recruit");
    }
}
