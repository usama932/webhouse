<?php

namespace App\Http\Controllers\User;

use App\Audio;
use App\FavrateAudio;
use App\FavrateVideo;
use App\Http\Controllers\Controller;
use App\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\ArtistSubscribe;
use App\Artist;
use App\User;
use App\Category;

class SongsController extends Controller
{
    public function audio_songs()
    {
        
        $user_id = Auth::id();
        $audios = Audio::with('cat','artist','fav')->paginate(10);
           
        return view("user.songs.audio_songs", ["audios" => $audios]);
    }

    public function video_songs()
    {
        $user_id = Auth::id();
        $videos = Video::with('cat','artist')->paginate(10);
        
        return view("user.songs.video_songs", ["videos" => $videos]);
    }
    public function audioSearch(Request $request)
    {
        $search = $request->search;

        $audios = Audio::where('name', 'like', "%{$search}%")
            ->get();

        return view("user.songs.audio_songs", ["audios" => $audios]);
    }

    public function videoSearch(Request $request)
    {
        $search = $request->search;

        $videos = Video::where('name', 'like', "%{$search}%")
            ->get();

        return view("user.songs.video_songs", ["videos" => $videos]);
    }

    public function favourVideo($id)
    {
        $user_id = Auth::id();
        $save = FavrateVideo::where([["video_id", $id], ["user_id", $user_id]])->first();
        if(empty($save)){
            $video = new FavrateVideo();
            $video->user_id = $user_id;
            $video->video_id = $id;
            $video->save();
            return response()->json(['status' => true, 'msg' => 'Added to Favourite']);
        }
        return response()->json(['status' => true, 'msg' => 'Already Added']);
      
    }

    public function favourAudio($id)
    {
        $user_id = Auth::id();
        $save = FavrateAudio::where([["AUDIO_id", $id], ["user_id", $user_id]])->first();
        if(empty($save)){
        $video = new FavrateAudio();
        $video->user_id = $user_id;
        $video->AUDIO_id = $id;
        $video->save();
        }

        return response()->json(['status' => true, 'msg' => 'Added to Favourite']);
    }

    public function audioFavourite_songs()
    {
        $id= Auth::id();
        $audios = FavrateAudio::where('user_id',$id)->with('audio')->get();
      
        return view("user.favourite_songs.audioFavourite", ["audios" => $audios]);
    }

    public function videoFavourite_songs()
    {
        $id= Auth::id();

        $videos = FavrateVideo::where('user_id',$id)->with('video')->get();
        return view("user.favourite_songs.videoFavourite", ["videos" => $videos]);
    }
    public function dislike_video($id)
    {
        $video = FavrateVideo::find($id);
        if(!empty($video)){
            $video->delete();
            return response()->json(['status' => true, 'msg' => 'Added to unwanted']);
        }
        return response()->json(['status' => true, 'msg' => 'Not found Video']);
    }
    public function dislike_audio($id)
    {
        $audio = FavrateAudio::find($id);
        if(!empty($audio)){
            $audio->delete();
            return response()->json(['status' => true, 'msg' => 'Added to unwanted']);
        }
        return response()->json(['status' => true, 'msg' => 'Not found audio']);
    }
 
    // Artist Function
    public function artist(){
        $artists = Artist::where('active',1)
        ->leftJoin('artist_subscribes','artists.id','=','artist_subscribes.artist_id')
        ->select(
            'artist_subscribes.id as artist_id',
            'artists.id',
            'artists.name',
            'artists.image',
            'artists.facebook_link',
            'artists.created_at',
            'artist_subscribes.status',
        )
        ->latest()->paginate(10);
        return view("user.artists.all",compact('artists'));
    }

    public function sub_artist(){ 
        $id= Auth::id();
        $artists = ArtistSubscribe::where('user_id',$id)->with('artist')
                    ->join('artists', 'artist_subscribes.artist_id', '=', 'artists.id')
                    ->select(
                        'artist_subscribes.id',
                        'artists.name',
                        'artists.image',
                        'artists.facebook_link',
                    
                    )->paginate(10);
        return view("user.artists.subcribe",compact('artists'));
    }
    public function searchArtist(Request $request){
        $id= Auth::id();
        $search = $request->search;
        if($request->subscribe == 0){
        
        $artists = Artist::where('active',1)->where('name', 'like', "%{$search}%")->latest()->paginate(10);
        return view("user.artists.all",compact('artists'));
        }
        elseif($request->subscribe == 1){
            $artists = ArtistSubscribe::where('user_id',$id)->with('artist')
            ->join('artists', 'artist_subscribes.artist_id', '=', 'artists.id')
            ->select(
                'artist_subscribes.id',
                'artists.name',
                'artists.image',
                'artists.facebook_link',
              
            )
           ->where('artists.name', 'like',"%{$search}%" )->paginate(10);
                 
            return view("user.artists.subcribe",compact('artists'));
        }
        else{
            return redirect()->back();
        }
       
    }
}
