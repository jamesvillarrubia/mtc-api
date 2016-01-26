<?php

namespace App\Api\V1\Transformers;

use League\Fractal\TransformerAbstract;
use League\Fractal\Serializer\JsonApiSerializer;
use App\Lesson;
use App\Library\GateCheck as GateCheck;

class LessonTransformer extends TransformerAbstract {



    public function __construct($options = null)
    {
        $this->options = $options;
    }


    /**
     * List of resources possible to include
     *
     * @var array
     */



    protected $defaultIncludes = [
        'questions'
    ];

	//takes an array an returns an array;
    public function transform(Lesson $lesson)
    {

    	return [
            "id"			=> $lesson->id,
            "text"          => $lesson->text,
            "html"          => $lesson->html, 
			"title"         => $lesson->title,
            "time"          => $lesson->time,
            "user_id"       => $lesson->user_id,
            "created_at" 	=> $lesson->created_at,
            "updated_at" 	=> $lesson->updated_at
		];
    }

    /**
     * Include Question
     *
     * @return League\Fractal\ItemResource
     */
    public function includeQuestions(Lesson $lesson)
    {
        $questions = $lesson->questions()->access()->get();
        return $this->collection($questions, new QuestionTransformer($this->options), 'question');
    }

    public function reverse($attributes){

        //attributes may not be included and need to be nulled out if so
        $ret = [];
        if(isset($attributes['text']))      { $ret['text']      = $attributes['text'];      } 
        if(isset($attributes['html']))      { $ret['html']      = $attributes['html'];      } 
        if(isset($attributes['title']))     { $ret['title']     = $attributes['title'];     } 
        if(isset($attributes['time']))      { $ret['time']      = $attributes['time'];      } 
        if(isset($attributes['user_id']))   { $ret['user_id']   = $attributes['user_id'];   } 

        return $ret;

    }

}