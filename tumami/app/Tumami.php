<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tumami extends Model
{
    protected $guarded = array('user_id');

    public static $rules = array(
        'tumami_name' => 'required',
        'introduction' => 'required',
    );

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
