<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Gate;
use Auth;

class Question extends Model
{
    //
    protected $table = 'questions';
    protected $fillable = array('text', 'user_id', 'lesson_id');

    public function shortanswers()
    {
        return $this->hasMany('App\ShortAnswer');
    }

    public function lesson()
    {
    	return $this->belongsTo('App\Lesson');
    }

    public function ownedBy()
    {
    	return User::find($this->user_id);
    }

    public function parents()
    {
    	return collect([
    		$this->ownedBy(),
  			$this->lesson()->ownedBy()
  		]);
    }

    public function scopeAccess($query){

        if (Gate::allows('view_question')){
            return $query;
        }elseif (Auth::check() && Gate::allows('view_own_question')){
            return $query->where('user_id',Auth::id());
        }else{
            return $query->where('user_id',-1);
        }
    }

    public function scopeEdit($query){

        if (Gate::allows('edit_question')){
            return $query;
        }elseif (Auth::check() && Gate::allows('edit_own_question')){
            return $query->where('user_id',Auth::id());
        }else{
            return $query->where('user_id',-1);
        }
    }

}



