<?php

namespace App;

use App\Notifications\ArtistResetPasswordNotification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class Artist extends Authenticatable
{
    use Notifiable,  HasApiTokens;

    protected $guard = 'artists';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','phone','facebook_link','twitter_link','instagram_link','youtube_link','gender','active',
        'cover_photo','description','image',
    ];

    public function subscribes(){
        return $this->hasMany('App\ArtistSubscribe','artist_id')->where("status",1);
    }
    public function albums(){
        return $this->hasMany('App\Albums','artist_id');
    }
    public function audios(){
        return $this->hasMany('App\Audio','artist_id');
    }
    public function videos(){
        return $this->hasMany('App\Video','artist_id');
    }
    public function images(){
        return $this->hasMany('App\Image','artist_id');
    }
    public function events(){
        return $this->hasMany('App\Event','artist_id');
    }
     public function profile_viewers(){
        return $this->hasMany('App\ProfileViewer','artist_id');
    }



    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ArtistResetPasswordNotification($token));
    }

}
