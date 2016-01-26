<?php

namespace App\Api\V1\Transformers;

use League\Fractal\TransformerAbstract;
use League\Fractal\Serializer\JsonApiSerializer;
use App\Lesson;
use App\Question;

class QuestionTransformer extends TransformerAbstract {



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
      'shortanswers'
    ];


    //takes an array an returns an array;
    public function transform(Question $question)
    {
        return [
          "id"          => $question->id,
          "text"        => 'yes'.$question->text,
          "user_id"     => $question->user_id,
          "lesson_id"   => $question->lesson_id,
          "created_at"  => $question->created_at,
          "updated_at"  => $question->updated_at
        ];

    }



    /**
     * Include Question
     *
     * @return League\Fractal\ItemResource
     */
    public function includeShortanswers(Question $question)
    {
        $accessible = $question->shortanswers()->access()->get();
        return $this->collection($accessible, new ShortanswerTransformer($this->options), 'shortanswer');
    }




    public function reverse($attributes){

        //attributes may not be included and need to be nulled out if so
        $ret = [];
        if(isset($attributes['text']))      { $ret['text']      = $attributes['text'];      } 
        if(isset($attributes['user_id']))   { $ret['user_id']   = $attributes['user_id'];   } 
        if(isset($attributes['lesson_id'])) { $ret['lesson_id'] = $attributes['lesson_id']; } 
        return $ret;

    }


}