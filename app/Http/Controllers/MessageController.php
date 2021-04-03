<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Auth;
use DateTime;
use App\User;
use App\Apply;
use App\Message;

class MessageController extends Controller
{
    public function list(){
    	if(Auth::guard('user')->check()){
    		$user = Auth::guard('user')->user();
    		$applies = $user->applies()->orderBy('created_at', 'desc')->paginate(10);
    		return view('apply.messagelist', ['applies' => $applies, 'user' => $user]);
    	}
    }

    public function usershow($id){
		$apply = Apply::findOrFail($id);
		$user = Auth::guard('user')->user();
		Gate::authorize('usermessage', $apply);
		$send = $user->sendmessages()->where('apply_id', $id)->get();
		$recieve = $user->recievemessages()->where('apply_id', $id)->get();
		$subject = (count($recieve) > 0) ? $recieve->last()->subject : null;
		foreach ($recieve as $rec) {
			$rec->readed = 1;
			$rec->save();
		}
		$message = $send->merge($recieve)->toArray();
		
		$sort = array();
		foreach ($message as $value) {
			$sort[] = $value['created_at'];
		}
		array_multisort($sort, SORT_ASC, $message);
		$messages = json_decode(json_encode($message));
		foreach ($messages as $value) {
			$date = new DateTime($value->created_at);
			$value->created_at = $date->format('Y/n/j H:i');
		}
		return view('apply.messageshow', ['messages' => $messages, 'apply' => $apply, 'subject' => $subject]);
    }

    public function corporateshow($id){
    	$apply = Apply::findOrFail($id);
    	$corporate = Auth::guard('corporate')->user();
    	Gate::authorize('corporatemessage', $apply->recruit()->first());
		$send = $corporate->sendmessages()->where('apply_id', $id)->get();
		$recieve = $corporate->recievemessages()->where('apply_id', $id)->get();
		$subject = (count($recieve) > 0) ? $recieve->last()->subject : null;
		foreach ($recieve as $rec) {
			$rec->readed = 1;
			$rec->save();
		}
		$message = $send->merge($recieve)->toArray();
		
		$sort = array();
		foreach ($message as $value) {
			$sort[] = $value['created_at'];
		}
		array_multisort($sort, SORT_ASC, $message);
		$messages = json_decode(json_encode($message));
		foreach ($messages as $value) {
			$date = new DateTime($value->created_at);
			$value->created_at = $date->format('Y/n/j H:i');
		}
		return view('recruit.messageshow', ['messages' => $messages, 'apply' => $apply, 'subject' => $subject]);
    }

    public function create($id, Request $request){
    	$this->validate($request, Message::$rules);

    	$apply = Apply::findOrFail($id);
    	$recruit = $apply->recruit()->first();

    	if(Auth::guard('user')->check()){
    		$message = new Message;
    		$message->recruit_id = $recruit->id;
    		$message->apply_id = $id;
    		$message->send_user_id = Auth::guard('user')->user()->id;
    		$message->recieve_corporate_id = $recruit->corporate()->first()->id;
    		$message->subject = $request->subject;
    		$message->body = $request->body;
    		$message->save();
    		return redirect()->action('MessageController@usershow', ['id' => $id]);
    	}

    	if(Auth::guard('corporate')->check()){
    		$message = new Message;
    		$message->recruit_id = $recruit->id;
    		$message->apply_id = $id;
    		$message->send_corporate_id = Auth::guard('corporate')->user()->id;
    		$message->recieve_user_id = $apply->user()->first()->id;
    		$message->subject = $request->subject;
    		$message->body = $request->body;
    		$message->save();
    		return redirect()->action('MessageController@corporateshow', ['id' => $id]);
    	}
    }
}
