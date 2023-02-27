<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Audio extends Model
{

    protected $fillable = [
        'name', 'composer_name', 'thumbnail','audio','artist_id','album_id'
    ];

    public function album()
    {
        return $this->belongsTo('App\Albums', 'album_id');
    }
    public function artist()
    {
        return $this->belongsTo('App\Artist', 'artist_id');
    }
    public function cat()
    {
        return $this->belongsTo('App\Category', 'category');
    }
}
