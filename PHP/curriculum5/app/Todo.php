<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    protected $guarded = array('id');

    public static $rules = array(
        'title' => 'required',
        'space' => 'required',
        'deadline' => 'date',
        'priority' => 'digits_between:1,5',
        'user_id' => 'integer',
    );
}
