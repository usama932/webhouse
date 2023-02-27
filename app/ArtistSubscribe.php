<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArtistSubscribe extends Model
{
    protected $fillable = [
        'artist_id', 'user_id', 'status' 
    ];

    public function users()
    {
        return $this->belongsTo('App\User','user_id','id');
    }
}
