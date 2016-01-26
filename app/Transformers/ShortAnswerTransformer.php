<?php

namespace App\Transformers;

class ShortAnswerTransformer extends Transformer {


    public function transform($shortAnswer)
    {

        return $shortAnswer->toArray();

    }

}