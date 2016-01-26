<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

use Illuminate\Http\Request;
use App\Library\ELO;
use App\User;

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function($api){
    //$api->get('lessons/{id}/questions', 		'App\Api\V1\Controllers\QuestionsController@index');
	//$api->get('questions/{id}/shortanswers', 	'App\Api\V1\Controllers\ShortAnswersController@index');	
	$api->resource('lesson',      				'App\Api\V1\Controllers\LessonController');
	//get all lessons accessible to the user
	$api->resource('question',    				'App\Api\V1\Controllers\QuestionController');
	//get all questions accessible to the user
    $api->resource('shortanswer', 				'App\Api\V1\Controllers\ShortanswerController');
    //get all shortanswers accessible to the user
	$api->resource('lesson.question',      		'App\Api\V1\Controllers\LessonQuestionController');
	//get lessons with questions embedded accessible to the user - must specify the lesson
	$api->resource('question.shortanswer',    	'App\Api\V1\Controllers\QuestionShortanswerController');
	//get questions with shortanswers embedded accessible to the user - must specify the question


//Load lesson and (each question to ask the user) -> lessons.questions
//Load lessons assigned (all lessons assigned to you) -> lessons
//Load lessons to edit (accessible as owner or admin) -> lessons

//Build quiz
//Load questions (everybody has to answer/random/combo)
//Load comparisons Q (randomly select questions for comparison against minimum w/ or w/o ordering) -> question
//Load comparison QAs  against minimum / randomly select from TA+PrevAns+Mine) -> question.answer (each question at a time)

//Quiz (owner_id, user_id, serialized [Q:response,Q:response][QA1,QA2],Q:QAs,etc], start time, submit time, counted time)


});


    $user = User::find(1);
    Auth::setUser($user);


Route::get('/', function () {

	//$s1 = ShortAnswer::find(9);
	//$s2 = ShortAnswer::find(10);
	//$rat1 = $s1->rating;
	//$rat2 = $s2->rating;

	//ELO::compute($s2,$s1,false);

	//$nrat1 = $s1->rating;
	//$nrat2 = $s2->rating;

	//return 'yes';
	//return print_r(array($rat1,$rat2,$nrat1,$nrat2), true);

    return view('home');
});


/*
Route::group(['prefix' => 'api/v1'], function(){

	Route::get('lessons/{id}/questions', 'QuestionsController@index');
	Route::get('questions/{id}/shortanswers', 'ShortAnswersController@index');
	Route::resource('lessons', 'LessonsController');
	Route::resource('questions', 'QuestionsController');
    Route::resource('shortanswers', 'ShortAnswersController');
	//Route::get('tasks/{id}/labels', 'LabelsController@index');
	
});

Route::get('login', 'AuthController@login');
Route::get('logout', 'AuthController@logout');
Route::get('/', function (Request $request) {
    
    return redirect()->to('api/v1/questions');

	if(Auth::check())
	{
		return redirect()->to('api/v1/tasks');
	} 
	return view('pages.login');


});

*/
