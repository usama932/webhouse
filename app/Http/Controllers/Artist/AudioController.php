<?php

namespace App\Http\Controllers\Artist;

use App\Albums;
use App\Audio;
use App\Category;
use App\Http\Controllers\Controller;
use App\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AudioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Audio::where("artist_id", Auth::id())->get();
        return view("artist.audios.index", ["data" => $data]);
    }
    

    public function search(Request $request)
    {
        $search = $request->search;

        $data = Audio::where([["artist_id", Auth::id()], ['name', 'like', "%{$search}%"]])
            ->orWhere([["artist_id", Auth::id()], ['composer_name', 'like', "%{$search}%"]])
            ->get();

        return view("artist.audios.index", ["data" => $data]);
    }

    public function singleSearch(Request $request)
    {


        $search = $request->search;
        $user = Auth::user();

        $album_id = $request->album_id;

        $videos = Video::where([['artist_id', $user->id], ['album_id', $album_id]])->get();

        $audios = Audio::where([["artist_id", Auth::id()], ['name', 'like', "%{$search}%"]])
            ->orWhere([["artist_id", Auth::id()], ['composer_name', 'like', "%{$search}%"]])
            ->get();
        $videoActive = '';
        $audioActive = 'active';

        return view("artist.albums.albums", compact('videos', 'audios', 'album_id', 'videoActive', 'audioActive'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $albums = Albums::where("artist_id", Auth::id())->get();
        return view("artist.audios.create", ["categories" => $categories, "albums" => $albums]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'audio' => 'required',
            'thumbnail' => 'required',
            'name' => 'required',
            'composer_name' => 'required',
            'album' => 'required',
            'category' => 'required'


        ]);
        try {
            DB::beginTransaction();
            $user = Auth::user();
            $save = new Audio();
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
                    $destinationPath = public_path('/uploads/audio');
                    //$extension = $file->getClientOriginalExtension('logo');
                    $thumbnail = $file->getClientOriginalName('thumbnail');
                    $thumbnail = rand() . $thumbnail;
                    $request->file('thumbnail')->move($destinationPath, $thumbnail);
                    $save->thumbnail = $thumbnail;
                }
            }
            if ($request->hasFile('audio')) {
                if ($request->file('audio')->isValid()) {
                    $this->validate($request, [
                        // 'audio' => 'required|mimetypes:video/x-ms-asf,video/x-flv,video/mp4,application/x-mpegURL,video/MP2T,video/3gpp,video/quicktime,video/x-msvideo,video/x-ms-wmv,video/avi'
                    ]);
                    $file = $request->file('audio');
                    $destinationPath = public_path('/uploads/audio');
                    //$extension = $file->getClientOriginalExtension('logo');
                    $audio = $file->getClientOriginalName('audio');
                    $video = rand() . $audio;
                    $request->file('audio')->move($destinationPath, $audio);
                    $save->audio = $audio;
                }
            }
            $save->save();
            Session::flash('success_message', 'Great! Audio has been saved successfully!');
            DB::commit();
            return redirect()->back();
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error_message', $th->getMessage());
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
        $album = Audio::findOrFail($id);

        if ($album) {
            $album->delete();
            return response()->json(['status' => true, 'msg' => 'Audio has been deleted']);
        } else {
            return response()->json(['status' => false, 'msg' => 'Audio has  not Found']);
        }
    }
}
