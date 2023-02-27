<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProfileViewer extends Model
{
    protected $fillable = [
        'artist_id','view_by'
    ];
}
