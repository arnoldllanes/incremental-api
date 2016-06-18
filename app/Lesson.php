<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Tag;

class Lesson extends Model
{
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'lessons';

    protected $fillable = ['title', 'body', 'some_bool'];

    public function tags()
    {
    	return $this->belongsToMany('App\Tag');
    }
}
