<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Albums extends Model
{
    protected $fillable = [
        'name','image','description',
    ];
}
