<?php 

namespace App\Acme\Transformers;

class TagTransformer extends Transformer {
	/**
     * Transform a lesson
     *
     * @param $lesson
     * @return array
     **/

    public function transform($tag)
    {
    	return [
    		'name' => $tag['name']
    	];
    }
}