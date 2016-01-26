<?php 

namespace App\Library;

use Auth;
use Gate;
use App\Question;
use App\Lesson;

class GateCheck {

	public static function questions(){
        if (Gate::allows('view_question')){
        	return Question::all();
        }elseif (Auth::check() && Gate::allows('view_own_question')){
            return Question::where('user_id',Auth::id())->get();
        }else{
            return null;
        }
	}

	public static function lessons(){
        if (Gate::allows('view_lesson')){
        	return Lesson::all();
        }elseif (Auth::check() && Gate::allows('view_own_lesson')){
            return Lesson::where('user_id',Auth::id())->get();
        }else{
            return null;
        }
	}


}


?>