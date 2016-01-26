<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Gate;

class Shortanswer extends Model
{
    //
    protected $table = 'shortanswers';
    protected $fillable = array('text', 'rating', 'user_id', 'lesson_id', 'question_id');

    public function question()
    {
    	return $this->belongsTo('App\Question');
    }

    public function lesson()
    {
    	return $this->belongsTo('App\Question')->belongsTo('App\Lesson');
    }

    public function ownedBy()
    {
        return User::find($this->user_id);
    }

    public function parents()
    {
    	return collect([
    		$this->ownedBy(),
    		$this->question()->ownedBy(),
  			$this->lesson()->ownedBy()
  		]);
    }

    public function scopeAccess($query){

        if (Gate::allows('view_shortanswer')){
            return $query;
        }elseif (Auth::check() && Gate::allows('view_own_shortanswer')){
            return $query->where('user_id',Auth::id());
        }else{
            return $query->where('user_id',-1);
        }
    }

    public function scopeEdit($query){

        if (Gate::allows('edit_shortanswer')){
            return $query;
        }elseif (Auth::check() && Gate::allows('edit_own_shortanswer')){
            return $query->where('user_id',Auth::id());
        }else{
            return $query->where('user_id',-1);
        }
    }

}
