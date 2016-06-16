<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'lessons';

    protected $fillable = ['title', 'body'];
}
