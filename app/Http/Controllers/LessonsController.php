<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lesson;
use App\Http\Requests;
use Response;
use App\Acme\Transformers\LessonTransformer;

class LessonsController extends ApiController
{
    /**
     * undocumented class variable
     *
     * @var Acme\Transformers\Lesson\Transformer
     **/
    protected $lessonTransformer;

    function __construct(LessonTransformer $lessonTransformer)
    {
        $this->lessonTransformer = $lessonTransformer;
    }
	
    /**
	 * Display a listing of the resource
	 *
	 * @return reponse
	 **/
    public function index()
    {
    	// 1.) All is bad
    	// 2.) No way to attach meta data
    	// 3.) Linking db structure to the API output
    	// 4.) No way to signal headers/repsonse codes
    	$lessons = Lesson::all();
    	return Response::json([
    		'data' => $this->lessonTransformer->transformCollection($lessons->all())
    	], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     **/
    public function show($id)
    {
    	$lesson = Lesson::find($id);

    	if (! $lesson)
    	{
            return $this->respondNotFound('Lesson does not exist.');
    	}

    	return Response::json([
            'data' => $this->lessonTransformer->transform($lesson)
    	], 200);
    }

}
