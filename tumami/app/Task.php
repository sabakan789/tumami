<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $guarded = array('user_id');

    public static $rules = array(
        'title' => 'required',
    );

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
