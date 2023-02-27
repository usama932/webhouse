<?php

namespace App\Http\Controllers\Api;

use App\Audio;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\AudioLike;
use Auth;
use App\User;
class AudioLikeController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'audio_id' => 'required'
        ]);
        $input = $request->all();
         $user_id = auth()->user()->id;

         $audio = Audio::where('id',$request->audio_id)->first();
         if(!$audio){
             return response([
                 'message' => "Audio not Found",
                 'error' => false
             ], 200);
         }
        
         $audio_like = AudioLike::where([['audio_id', $request['audio_id']], ['user_id', $user_id]])->first();
         
        $isAlreadyAudiolike = false;
        if ($audio_like) {
            $isAlreadyAudiolike = true;
        }
        if (!$isAlreadyAudiolike) {
        $audioLike = new AudioLike();
     
        $audioLike->audio_id= $input['audio_id'];
        $audioLike->user_id= $user_id;
        $audioLike->save();
        }
        else {

            $audio_like->delete();
        }
        return response([
            'message' => "Audio Like added Successfully",
            'error' => false,
            'isAudioLike' => !$isAlreadyAudiolike
        ],200);


    }
    public function artistAudioLike(Request $request)
    {
        $request->validate([
            'audio_id' => 'required'
        ]);
        $input = $request->all();
        $artist_id = auth()->user()->id;
        $audio_like = AudioLike::where([['audio_id', $request['audio_id']], ['artist_id', $artist_id]])->first();
        $isAlreadyAudiolike = false;
        if ($audio_like) {
            $isAlreadyAudiolike = true;
        }
         $artist_id = auth()->user()->id;
         if (!$isAlreadyAudiolike) {
        $audioLike = new AudioLike();
        $audioLike->audio_id= $input['audio_id'];
        $audioLike->artist_id= $artist_id;
        $audioLike->save();
         }
        else {

            $audio_like->delete();
        }
        return response([
            'message' => "Audio Like added Successfully",
            'error' => false,
            'isAudioLike' => !$isAlreadyAudiolike
        ],200);


    }
    
}
