<?php

namespace App\Http\Controllers\Api;

use App\Artist;
use App\Audio;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\User;
use App\AudioComment;
use App\AudioLike;

class AudioCommentController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'audio_id' => 'required'
        ]);

        $audio = Audio::where('id',$request->audio_id)->first();
        if(!$audio){
            return response()->json(['message' => "Audio not Found", "error" => true], 200);

        }

        $audioComments = AudioComment::where('audio_id', $request->audio_id)->skip($request->offset)->limit(30)->get();

        if (count($audioComments) < 1) {
            return response()->json(['message' => "No audio Comments found", "error" => true], 200);
        }
        foreach ($audioComments as $data) {
            if($data['user_id'] !=null)
            {
                $user = User::where('id',$data['user_id'])->get();
                if(count($user)>0)
                {
                $data['name'] = $user[0]->name;
                $data['image']  = $user[0]->image;
                }
               else {
                    $data['name'] = "Unknown";
                    $data['image']  = null;
                    }
            }
            else 
            {
                $artist = Artist::where('id',$data['artist_id'])->get();
                if(count($artist)>0)
                {
                $data['name'] = $artist[0]->name;
                $data['image']  = $artist[0]->image;
                }
               else {
                    $data['name'] = "Unknown";
                    $data['image']  = null;
                    }
            }
      
        }
        
        return response()->json(['message' => "Audio Comments", "error" => false, 'data' => $audioComments], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'comment' => 'required',
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

        
        $audioComment = new AudioComment();
        $audioComment->comment = $input['comment'];
        $audioComment->audio_id = $input['audio_id'];
        $audioComment->user_id = $user_id;
        $audioComment->save();

        return response([
            'message' => "Audio Comment added Successfully",
            'error' => false
        ], 200);
    }

    public function artistAudioComment(Request $request)
    {
        $request->validate([
            'audio_id' => 'required',
            'comment' => 'required'
        ]);
        $input = $request->all();
        $artist_id = auth()->user()->id;

        $audioComment = new AudioComment();
        $audioComment->audio_id = $input['audio_id'];
        $audioComment->comment = $input['comment'];
        $audioComment->artist_id = $artist_id;
        $audioComment->save();

        return response([
            'message' => "Audio Comment added Successfully",
            'error' => false
        ], 200);
    }

    public function audiolikesComment(Request $request)
    {

        $request->validate([
            'audio_id' => 'required'
        ]);
        $audioComments = AudioComment::where('audio_id', $request->audio_id)->count();

        $audioLikes = AudioLike::where('audio_id', $request->audio_id)->count();
        // if($audioComments == 0){
        //     return response()->json(['message' => " Audio Likes can't Found", "error" => true], 200);
        //     }
        $user_id = auth()->user()->id;
        
        $isLikeObject = AudioLike::where([['user_id', $user_id]],[['audio_id', $request->audio_id]])->first();
        $islike=false;
        if($isLikeObject)
        {
        $islike=true;
        }

        return response()->json(['message' => "Audio likes Comments Found Successfully", 'No of Comments' => $audioComments, 'No of Likes' => $audioLikes, 'isILike' => $islike, "error" => false], 200);
    }
    
    public function ArtistaudiolikesComment(Request $request)
    {
        $audioComments = AudioComment::where('audio_id', $request->audio_id)->count();

        $audioLikes = AudioLike::where('audio_id', $request->audio_id)->count();
        // if($audioComments == 0){
        //     return response()->json(['message' => " Audio Likes can't Found", "error" => true], 200);
        //     }
        $artist_id = auth()->user()->id;
        
        $isLikeObject = AudioLike::where([['artist_id', $artist_id]],[['audio_id', $request->audio_id]])->first();
        $islike=false;
        if($isLikeObject)
        {
        $islike=true;
        }

        return response()->json(['message' => "Artist Audio likes Comments Found Successfully", 'No of Comments' => $audioComments, 'No of Likes' => $audioLikes, 'isILike' => $islike, "error" => false], 200);
    }
}
