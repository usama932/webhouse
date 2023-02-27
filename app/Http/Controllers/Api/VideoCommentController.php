<?php

namespace App\Http\Controllers\Api;

use App\Artist;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Video;
use App\VideoComment;
use App\VideoLike;

class VideoCommentController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
        
            'video_id' => 'required'
        ]);
        $video = Video::where('id',$request->video_id)->first();
        if(!$video){
            return response()->json(['message' => "Video not Found", "error" => true], 200);

        }
        // $user_id = auth()->user()->id;
        // return $user_id;
        $videoComments = VideoComment::where('video_id', $request->video_id)->skip($request->offset)->limit(30)->get();
        // return $videoComments;
        if (count($videoComments) < 1) {
            return response()->json(['message' => "No video Comments found", "error" => true], 200);
        }

        foreach ($videoComments as $data) {
            if($data['user_id'] !=null)
            {
                $user = User::where('id',$data['user_id'])->get();
                if(count($user)>0)
                {
                $data['name'] = $user[0]->name;
                $data['image']  =$user[0]->image;
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
        
        return response()->json(['message' => "Video Comments", "error" => false, 'data' => $videoComments], 200);
    }

    public function ArtistvideoComments(Request $request)
    {
        // $user_id = auth()->user()->id;
        // return $user_id;
        $videoComments = VideoComment::where('video_id', $request->video_id)->skip($request->offset)->limit(30)->get();
        // return $videoComments;
        if (count($videoComments) < 1) {
            return response()->json(['message' => "No video Comments found", "error" => true], 200);
        }

        foreach ($videoComments as $data) {
            if($data['user_id'] !=null)
            {
                $user = User::where('id',$data['user_id'])->get();
                if(count($user)>0)
                {
                $data['name'] = $user[0]->name;
                $data['image']  =$user[0]->image;
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
        
        return response()->json(['message' => "Video Comments", "error" => false, 'data' => $videoComments], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'comment' => 'required',
            'video_id' => 'required'
        ]);
        
        $input = $request->all();
        $user_id = auth()->user()->id;

        $video = Video::where('id',$request->video_id)->first();
        if(!$video){
            return response([
                'message' => "Video not Found",
                'error' => false
            ], 200);
        }
        
        $videoComment = new VideoComment();
        $videoComment->comment = $input['comment'];
        $videoComment->video_id = $input['video_id'];
        $videoComment->user_id = $user_id;
        $videoComment->save();

        return response([
            'message' => "Video Comment added Successfully",
            'error' => false
        ], 200);
    }

    public function artistVideoComment(Request $request)
    {
        $request->validate([
            'comment' => 'required',
            'video_id' => 'required'
        ]);
        $input = $request->all();
        $artist_id = auth()->user()->id;

        $videoComment = new VideoComment();
        $videoComment->comment = $input['comment'];
        $videoComment->video_id = $input['video_id'];
        $videoComment->artist_id = $artist_id;
        $videoComment->save();

        return response([
            'message' => "Video Comment added Successfully",
            'error' => false
        ], 200);
    }
    public function videolikesComment(Request $request)
    {
        $request->validate([
            'video_id' => 'required'
        ]);
        $videoComments = VideoComment::where('video_id', $request->video_id)->count();

        $videoLikes = VideoLike::where('video_id', $request->video_id)->count();
        $user_id = auth()->user()->id;
       // return $user_id;

        $isLikeObject = VideoLike::where([['user_id', $user_id]],[['video_id', $request->video_id]])->first();
        $islike=false;
        if($isLikeObject)
        {
        $islike=true;
        }
        
        return response()->json(['message' => " Video likes Comments Found Successfully", 'No of Comments' => $videoComments, 'No of Likes' => $videoLikes, 'isLike' => $islike, "error" => false], 200);
    }
    public function ArtistvideolikesComment(Request $request)
    {
      try{
        $request->validate([
            'video_id' => 'required'
        ]);
        $videoComments = VideoComment::where('video_id', $request->video_id)->count();

        $videoLikes = VideoLike::where('video_id', $request->video_id)->count();
        $artist_id = auth()->user()->id;
       // return $user_id;

        $isLikeObject = VideoLike::where([['artist_id', $artist_id]],[['video_id', $request->video_id]])->first();
        $islike=false;
        if($isLikeObject)
        {
        $islike=true;
        }
        
        return response()->json(['message' => "Artist Video likes Comments Found Successfully", 'No of Comments' => $videoComments, 'No of Likes' => $videoLikes, 'isLike' => $islike, "error" => false], 200);
    } catch (Exception $e) {
        return response()->json(['message' => $e->getMessage(), 'error' => true], 200);
    } 
    }
}
