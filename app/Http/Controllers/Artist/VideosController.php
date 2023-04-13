<?php

namespace App\Http\Controllers\Artist;

use App\Albums;
use App\Audio;
use App\Category;
use App\FirebaseNotification;
use App\Http\Controllers\Controller;
use App\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class VideosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Video::where("artist_id",Auth::id())->get();
        return view("artist.videos.index",["data" => $data]);
    }

    public function search(Request $request)
    {
        $search = $request->search;
       
        $data = Video::where([["artist_id",Auth::id()],['name', 'like', "%{$search}%"]])
            ->orWhere([["artist_id",Auth::id()],['composer_name', 'like', "%{$search}%"]])
            ->get();
        
        return view("artist.videos.index",["data" => $data]);
    }

    public function singleSearch(Request $request)
    {
       
        $search = $request->search;
        $user = Auth::user();

       $album_id = $request->album_id;
        
        $audios = Audio::where([['artist_id', $user->id],['album_id', $album_id]])->get();

        $videos = Video::where([["artist_id",Auth::id()],['name', 'like', "%{$search}%"]])
            ->orWhere([["artist_id",Auth::id()],['composer_name', 'like', "%{$search}%"]])
            ->get();
        $videoActive = ' active';
       
        $audioActive ='';
        return view("artist.albums.albums",compact('videos','audios','album_id','videoActive','audioActive'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $albums = Albums::where("artist_id",Auth::id())->get();
        return view("artist.videos.create",["categories" => $categories,"albums" => $albums]);
    }


  
    public function store(Request $request)
    {
        $this->validate($request, [
            'video' => 'required',
            'thumbnail' => 'required',
            'name'=> 'required',
            'composer_name' => 'required',
            'album'=> 'required',
            'category'=> 'required',
            'video' =>   'required',
            'thumbnail' =>  'max:2048',

        ]);
        try {
         DB::beginTransaction();
        $user = Auth::user();
        $save = new video();
        $save->name = $request->name;
        $save->category = $request->category;
        $save->composer_name = $request->composer_name;
        $save->album_id = $request->album;
        $save->artist_id = $user->id;
        if ($request->hasFile('thumbnail')) {
            if ($request->file('thumbnail')->isValid()) {
                $this->validate($request, [
                    'thumbnail' => 'required|mimes:jpeg,png,jpg'
                ]);
                $file = $request->file('thumbnail');
                $destinationPath = public_path('/uploads/video');
                //$extension = $file->getClientOriginalExtension('logo');
                $thumbnail = $file->getClientOriginalName('thumbnail');
                $thumbnail = rand().$thumbnail;
                $request->file('thumbnail')->move($destinationPath, $thumbnail);
                $save->thumbnail = $thumbnail;

            }
        }
        if ($request->hasFile('video')) {
            if ($request->file('video')->isValid()) {
                $this->validate($request, [
                    'video' => 'required|mimetypes:video/x-ms-asf,video/x-flv,video/mp4,application/x-mpegURL,video/MP2T,video/3gpp,video/quicktime,video/x-msvideo,video/x-ms-wmv,video/avi'
                ]);
                $file = $request->file('video');
                $destinationPath = public_path('/uploads/video');
                //$extension = $file->getClientOriginalExtension('logo');
                $video = $file->getClientOriginalName('video');
                $video = rand().$video;
                $request->file('video')->move($destinationPath, $video);
                $save->video = $video;

            }
        }
        $save->save();
        Session::flash('success_message', 'Great! Video has been saved successfully!');
        DB::commit();
        return redirect()->back();
    }
    catch (\Throwable $th)
    {
        DB::rollBack();
        return redirect()->back()->with('error_message',$th->getMessage());

    }
            
    
 }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $album = Video::findOrFail($id);

        if($album){
              $album->delete();
              return response()->json(['status' => true, 'msg' => 'Video has been deleted']);
          } else {
              return response()->json(['status' => false, 'msg' => 'Video has  not Found']);
          }
    }
}
