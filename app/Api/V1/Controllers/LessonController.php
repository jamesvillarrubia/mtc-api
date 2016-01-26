<?php

namespace App\Api\V1\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use Gate;
use App\Question;
use App\Lesson;
use App\Shortanswer;
use App\User;
use App\Api\V1\Controllers\BaseController;
use League\Fractal;
use App\Api\V1\Transformers\LessonTransformer;



class LessonController extends BaseController
{

    protected $request;


    function __construct(Request $request)
    {
        $this->include_options = [
            "question"=>false,
            "shortanswer"=>false
        ];
        $this->type = 'lesson';




        $this->request = $request;
        $this->model = 'App\\'.ucfirst($this->type);
        $transformer = 'App\Api\V1\Transformers\\'.ucfirst($this->type).'Transformer';
        $this->transformer = $transformer;


    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        $type = $this->type;
        $transformer = $this->transformer;
        $model = $this->model;

        $accessible = $model::access()->get();
        if ($accessible->count() == 0){
            return $this->response->errorUnauthorized('Not allowed to view any '.$type.'.');
        }else{
            return $this->response->collection($accessible, new $transformer($this->include_options),['key' => $type]);
        }

    }









    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {

        $type = $this->type;
        $transformer = $this->transformer;
        $model = $this->model;

        $accessible = $model::where('id',$id)->access()->get();
        if ($accessible->count() == 0){
            return $this->response->errorUnauthorized('Not allowed to view this '.$type.'.');
        }else{
            return $this->response->collection($accessible, new $transformer($this->include_options),['key' => $type]);
        }

    } 









    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {

        $type = $this->type;
        $transformer = $this->transformer;
        $model = $this->model;

        //Check if the user is allowed to create a lesson
        if (!Gate::allows('create_'.$type)){
            return $this->response->errorUnauthorized('Not allowed to create a '.$type.'.');
        }

        //Pull in the request
        $request = $this->request;

        //make sure the request was json
        if($request->ajax()){
            $input = $request->all();

            //get the array of lesson info
            if( isset($input['data']) ){
                $array = (array) $input['data'][0];
            }

            //if does not have "type" and type doesn't = "lesson"
            if(!isset($array["type"]) || ($array["type"] != $type)){
                return $this->response->errorUnauthorized('Submission is malformed. Missing type.');
            }

            //if has "id"
            if(isset($array["id"])){
                return $this->response->errorUnauthorized('Submission is malformed. Cannot create '.$type.' with a preset ID. Use PATCH instead.');
            }

            $array = $array['attributes'];
            $array['user_id'] = Auth::id();

            //convert input into correct DB format
            $transformer = new $transformer;
            $cleaned = $transformer->reverse($array);

            $model::create($cleaned);

            return $this->response->item(null,null)->setStatusCode(200);
        }else{
            return $this->response->errorUnauthorized('Submission is malformed. Not valid ajax/json.');
        }
    }

 


    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {

        $type = $this->type;
        $transformer = $this->transformer;
        $model = $this->model;

        $editable = $model::where('id',$id)->edit()->get();
        if ($editable->count() == 0){
            return $this->response->errorUnauthorized('Not allowed to edit this '.$type.'.');
        }

        $request = $this->request;


        //make sure the request was json
        if($request->ajax()){
            $input = $request->all();

            //get the array of lesson info
            $array = (array) $input['data'][0];

            //if does not have "type" and type doesn't = "lesson"
            if(!isset($array["type"]) || ($array["type"] != $type)){
                return $this->response->errorUnauthorized('Submission is malformed. Missing type.');
            }

            $array = $array['attributes'];

            //if has user_id and has permission to set it

            if(isset($array['user_id']) && !Gate::allows('alter_owner') && ($array['user_id'] != $editable[0]->user_id)){
                return $this->response->errorUnauthorized('Cannot alter owner id.');
            }

            //convert input into correct DB format
            $transformer = new $transformer;
            $cleaned = $transformer->reverse($array);

            $editable[0]->update($cleaned);

            return $this->response->item(null,null)->setStatusCode(200);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $model = $this->model;
        $model::destroy($id);
        return $this->response->item(null,null)->setStatusCode(200);         

    }


}
