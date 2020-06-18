<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Recruit;
use App\Language;

class RecruitSearchController extends Controller
{
    public function search(Request $request)
    {
    	$s_pref_name = $request->pref_name;
    	$s_monthly_income = $request->monthly_income;
    	$s_language = $request->language;
    	$s_keyword = $request->keyword;
    	$PerPage = 12;

    	$query = Recruit::orderby('created_at', 'desc');
    	$query->where('status', '募集中');

    	if(!empty($s_pref_name)){
    		$query->where('pref_name', $s_pref_name);
    	}

    	if(!empty($s_monthly_income)){
    		$query->where('monthly_income', '>=', $s_monthly_income);
    	}

    	if(!empty($s_keyword)){
    		$query->where('title', 'like', "%{$s_keyword}%")->orWhere('body', 'like', "%{$s_keyword}%");
    	}

    	if(!empty($s_language)){
    		$language = Language::where('name', $s_language)->first();
    		$ids = $language->recruits()->get()->pluck('id');
    		$query->where('id', $ids);
    	}

        if($request->input('page', 1) * $PerPage - $PerPage + 1 < count($query->get())){
            $from = $request->input('page', 1) * $PerPage - $PerPage + 1;
        }else{
            $from = count($query->get());
        }

        if($from + $PerPage - 1 < count($query->get())){
            $to = $from + $PerPage - 1;
        }else{
            $to = count($query->get());
        }

    	$recruits = $query->paginate($PerPage);

    	return view('recruit.search', ['recruits' => $recruits, 'from' => $from, 'to' => $to]);
    }
}
