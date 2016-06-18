<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use App\Http\Requests;
use App\Acme\Transformers\TagTransformer;
use Reponse;
use App\Lesson;

class TagsController extends ApiController
{
	protected $tagTransformer;

	/**
	 * Display a listing of the resource
	 *
	 * @param null $id
	 * @return Reponse
	 **/
	function __construct(TagTransformer $tagTransformer)
	{
		$this->tagTransformer = $tagTransformer;
	}
    public function index($lessonId = null)
    {
    	$tags = $this->getTags($lessonId);

    	return $this->respond([
    		'data' => $this->tagTransformer->transformCollection($tags->all())
    	]);
    }

    private function getTags($lessonId)
    {
    	$tags = $lessonId ? Lesson::findOrFail($lessonId)->tags : Tag::all();

    	return $tags;
    }
}
