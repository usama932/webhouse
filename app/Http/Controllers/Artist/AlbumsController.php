<?php

namespace App\Http\Controllers\Artist;

use App\Albums;
use App\Audio;
use App\Http\Controllers\Controller;
use App\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AlbumsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $albums = Albums::where("artist_id", Auth::id())->get();
        return view("artist.albums.index", ["albums" => $albums]);
    }

    public function search(Request $request)
    {
        $search = $request->search;
        $albums = Albums::where([["artist_id", Auth::id()], ['name', 'like', "%{$search}%"]])
            ->orWhere([["artist_id", Auth::id()], ['description', 'like', "%{$search}%"]])
            ->get();
        return view("artist.albums.index", ["albums" => $albums]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view("artist.albums.create");
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
            'name' => 'required',
            'image' => 'required'

        ]);

        try {
            DB::beginTransaction();
            $user = Auth::user();
            $album = new Albums();
            $album->name = $request->name;
            $album->description = $request->description;

            $album->artist_id = $user->id;

            if ($request->hasFile('image')) {
                if ($request->file('image')->isValid()) {
                    $this->validate($request, [
                        'image' => 'required|mimes:jpeg,png,jpg'
                    ]);
                    $file = $request->file('image');
                    $destinationPath = public_path('/uploads/album');
                    //$extension = $file->getClientOriginalExtension('logo');
                    $thumbnail = $file->getClientOriginalName('image');
                    $thumbnail = rand() . $thumbnail;
                    $request->file('image')->move($destinationPath, $thumbnail);
                    $album->image = $thumbnail;
                }
            }

            $album->save();


            Session::flash('success_message', 'Great! Album has been saved successfully!');
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
        $user = Auth::user();
        // $album_id =Albums::find($id)->pluck('id')->first();
      
        $album_id = $id;
      
        $audios = Audio::where([['artist_id', $user->id],['album_id', $id]])->get();
       
        $videos = Video::where([['artist_id', $user->id],['album_id', $id]])->get();
        $videoActive = '';
        $audioActive ='active';
        return view("artist.albums.albums", compact('audios','videos','album_id','videoActive','audioActive'));
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
        $album = Albums::findOrFail($id);

        if ($album) {
            $album->delete();
            return response()->json(['status' => true, 'msg' => 'Album has been deleted']);
        } else {
            return response()->json(['status' => false, 'msg' => 'Album has  not Found']);
        }
    }
}
