<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    public function user()
    {
    	return $this->belongsTo("App\User");
    }

    public function recruit()
    {
    	return $this->belongsTo("App\Recruit");
    }
}
