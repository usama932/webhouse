<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'image', 'venue', 'name','date_time','artist_id','description'
    ];
}
