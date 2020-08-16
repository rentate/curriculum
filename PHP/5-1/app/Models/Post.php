<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $guarded = array('id');

    public static $rules = array(
        'body' => 'required|max:255',

    );

    public function user(){
        return $this->belongsTo('App\User');
    }

}
