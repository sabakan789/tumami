<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    public static $rules = array(
        'nickname' => 'required',
        'profile' => 'required',
    );

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
