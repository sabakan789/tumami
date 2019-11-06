<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public static $rules = array(
        'title' => 'required',
    );
}
