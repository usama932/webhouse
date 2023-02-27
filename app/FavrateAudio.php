<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FavrateAudio extends Model
{
    protected $fillable = [
        'user_id', 'audio_id'
    ];
    public function audio(){
        return $this->belongsTo('App\Audio');
    }
}
