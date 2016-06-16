<?php

namespace App\Acme\Transformers;

abstract class Transformer {
	/**
     * Transform collection of lessons
     *
     * @param $lessons
     * @return array
     **/
    public function transformCollection(array $items)
    {
    	return array_map([$this, 'transform'], $items);
    }

    public abstract function transform($item);
}