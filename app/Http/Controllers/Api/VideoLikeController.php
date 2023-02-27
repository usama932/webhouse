<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\VideoLike;
use Auth;
use App\User;
use App\Video;
use Illuminate\Support\Facades\Validator;

class VideoLikeController extends Controller
{
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [

            'video_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->all(), "error" => true, 'data' => null]);
        }

        $video = Video::where('id',$request->video_id)->first();
        if(!$video){
            return response([
                'message' => "Video not Found",
                'error' => false
            ], 200);
        }
     
        $user_id = auth()->user()->id;
        $video_like = VideoLike::where([['video_id', $request['video_id']], ['user_id', $user_id]])->first();
        $isAlreadyVideolike = false;
        if ($video_like) {
            $isAlreadyVideolike = true;
        }
        if (!$isAlreadyVideolike) {
        $videoLike = new VideoLike();
        $videoLike->video_id = $request['video_id'];
        $videoLike->user_id = $user_id;
        $videoLike->save();
        }
        else {

            $video_like->delete();
        }
        return response([
            'message' => "Video Like added Successfully",
            'error' => false,
            'isVideoLike' => !$isAlreadyVideolike
        ], 200);
    }

    public function artistVideoLike(Request $request)
    {
        $request->validate([
            'video_id' => 'required'
        ]);
        $artist_id = auth()->user()->id;
        $video_like = VideoLike::where([['video_id', $request['video_id']], ['artist_id', $artist_id]])->first();
        $isAlreadyVideolike = false;
        if ($video_like) {
            $isAlreadyVideolike = true;
        }

        if (!$isAlreadyVideolike) {
            $videoLike = new VideoLike();
            $videoLike->video_id = $request['video_id'];
            $videoLike->artist_id = $artist_id;
            $videoLike->save();
        } else {

            $video_like->delete();
        }
        return response([
            'message' => "Video Like added Successfully",
            'error' => false,
            'isVideoLike' => !$isAlreadyVideolike
        ], 200);
    }
}
