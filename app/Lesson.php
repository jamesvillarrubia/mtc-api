<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Gate;

class Lesson extends Model
{
    //
    protected $table = 'lessons';
    protected $fillable = array('text', 'title', 'html', 'time', 'user_id');


    public function questions()
    {
        return $this->hasMany('App\Question');
    }

    public function shortanswers()
    {
    	return $this->hasManyThrough('App\Question','App\Shortanswer');
    }

    public function ownedBy()
    {
    	return User::find($this->user_id);
    }
    public function parents()
    {
        return collect([
            $this->ownedBy()
        ]);
    }


    public function scopeAccess($query){

        if (Gate::allows('view_lesson')){
            return $query;
        }elseif (Auth::check() && Gate::allows('view_own_lesson')){
            return $query->where('user_id',Auth::id());
        }else{
            return $query->where('user_id',-1);
        }
    }


    public function scopeEdit($query){

        if (Gate::allows('edit_lesson')){
            return $query;
        }elseif (Auth::check() && Gate::allows('edit_own_lesson')){
            return $query->where('user_id',Auth::id());
        }else{
            return $query->where('user_id',-1);
        }
    }

/*
        if (Gate::allows('edit_lesson')){
            $existing = Lesson::find($id);
        }elseif
            (Gate::allows('edit_own_lesson')
                &&
            Lesson::find($id)->parents()->contains(User::find(Auth::id())))
        {
            $existing = Lesson::find($id);
        }else{
            return $this->respondWithError('Not allowed to edit Lesson '.$id.'. ');
        }
*/

}
