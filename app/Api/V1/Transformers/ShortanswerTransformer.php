<?php

namespace App\Api\V1\Transformers;

use League\Fractal\TransformerAbstract;
use League\Fractal\Serializer\JsonApiSerializer;
use App\ShortAnswer;
use App\Lesson;
use App\Question;

class ShortanswerTransformer extends TransformerAbstract {


    public function __construct($options = null)
    {
        $this->options = $options;
    }
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $defaultIncludes = [];

	//takes an array an returns an array;
    public function transform(ShortAnswer $shortanswer)
    {
        return [
          "id"          => $shortanswer->id,
          "text"        => $shortanswer->text,
          "user_id"     => $shortanswer->user_id,
          "question_id" => $shortanswer->question_id,
          "lesson_id"   => $shortanswer->lesson_id,
          "created_at"  => $shortanswer->created_at,
          "updated_at"  => $shortanswer->updated_at,
          "rating"		=> $shortanswer->rating
        ];
    }

    public function reverse($attributes){

        //attributes may not be included and need to be nulled out if so
        $ret = [];
        if(isset($attributes['text']))      	{ $ret['text']      	= $attributes['text'];      	} 
        if(isset($attributes['user_id']))   	{ $ret['user_id']   	= $attributes['user_id'];   	} 
        if(isset($attributes['lesson_id'])) 	{ $ret['lesson_id'] 	= $attributes['lesson_id']; 	} 
        if(isset($attributes['question_id'])) 	{ $ret['question_id']	= $attributes['question_id']; 	} 
        if(isset($attributes['rating'])) 		{ $ret['rating']		= $attributes['rating']; 		} 
        return $ret;

    }


}