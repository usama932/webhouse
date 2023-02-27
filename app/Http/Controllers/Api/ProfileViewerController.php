<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Artist;
use App\ProfileViewer;
Use \Carbon\Carbon;

class ProfileViewerController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'artist_id' => 'required'
        ]);
        $input = $request->all();

         $artist = Artist::where('id',$input['artist_id'])->count();
        if($artist == 0){
           return response([
            'message' => "Artist can't exist",
            'error' => true
        ], 200); 
        }
        $input = $request->all();
        $user_id = auth()->user()->id;
        $mytime = \Carbon\Carbon::now();
         
       

        $profileviewer = ProfileViewer::where('view_by',$user_id)->count();
        if($profileviewer>=10){
            $profile = ProfileViewer::where('view_by',$user_id)->first();
            $profile->updated_at = $mytime;
            $profile->save();
   
            return response([
                'message' => "Profile Viewer limit exceeded",
                'error' => false
            ],200);  
        }
        // return $profileviewer;
        $profileViewer = new ProfileViewer();
       
     
        $profileViewer->artist_id= $input['artist_id'];
        $profileViewer->view_by= $user_id;
        $profileViewer->save();

        return response([
            'message' => "Profile Viewer added Successfully",
            'error' => false
        ],200);


    }
}
