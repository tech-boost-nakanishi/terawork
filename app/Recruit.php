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

    public function corporate()
    {
    	return $this->belongsTo("App\Corporate");
    }

    public function applies()
    {
    	return $this->hasMany("App\Apply");
    }

    public static function boot()
    {
    	parent::boot();

    	static::deleting(function($recruit){
    		foreach ($recruit->recruitlanguages()->get() as $child) {
    			$child->delete();
    		}
    	});
    }
}
