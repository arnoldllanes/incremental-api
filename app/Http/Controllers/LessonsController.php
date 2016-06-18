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

        $this->middleware('auth.basic', ['only' => 'store']);
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
    	return $this->respond([
            'data' => $this->lessonTransformer->transformCollection($lessons->all())
        ]);
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

    	return $this->respond([
            'data' => $this->lessonTransformer->transform($lesson)
    	]);
    }

    public function store(Request $request)
    {
        if (! $request->input('title') or ! $request->input('body') ) 
        {
            return $this->setStatusCode(422)->respondWithError('Parameters failed validation for a lesson.');
        }

        Lesson::create($request->all());

        return $this->respondCreated('Lessons successfully created.');
    
    }


}
