<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Audio;
use App\FavrateAudio;
use App\FavrateVideo;
use App\Video;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\ArtistSubscribe;
use App\Artist;
use App\User;

class ArtistSubscribeController extends Controller
{
    public function subscribe($id){
     
      $user_id = Auth::id();
      $save = ArtistSubscribe::where([["artist_id", $id], ["user_id", $user_id]])->first();
        if (empty($save)) {
          $artist = new ArtistSubscribe();
          $artist->user_id = $user_id;
          $artist->artist_id = $id;
          $artist->status = 0;
          $artist->save();
          return response()->json(['status' => true, 'msg' => 'Subscribed']);
        }
        else
        {
          return response()->json(['status' => true, 'msg' => 'Already Subscribe']);
        }
        
   
      
    }
    public function unsubscribe($id){
   
        $artist = ArtistSubscribe::find($id);
        if(!empty($artist)){
            $artist->delete();
            return response()->json(['status' => true, 'msg' => 'Unsubscribed']);
        }
        
        return response()->json(['status' => true, 'msg' => 'Artist Not found']);
      }
}
