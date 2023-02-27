<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AudioComment extends Model
{
    public function users()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
