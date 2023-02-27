<?php

namespace App\Http\Controllers\Artist;

use App\Http\Controllers\Controller;
use App\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ImagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images = Image::where("artist_id",Auth::id())->get();
        return view("artist.photos.index",["images" => $images]);
    }

    public function search(Request $request)
    {
        $search = $request->search;
        $albums = Image::where([["artist_id",Auth::id()],['name', 'like', "%{$search}%"]])
            ->orWhere([["artist_id",Auth::id()],['description', 'like', "%{$search}%"]])
            ->get();
        return view("artist.photos.index",["albums" => $albums]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        return view("artist.photos.create");
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
            'image' => 'required'

        ]);

        try {
        DB::beginTransaction();
        $user = Auth::user();
        $images = new Image();
        $images->description = $request->description;
        $images->artist_id = $user->id;
      
        if ($request->hasFile('image')) {
            if ($request->file('image')->isValid()) {
                $this->validate($request, [
                    'image' => 'required|mimes:jpeg,png,jpg'
                ]);
                $file = $request->file('image');
                $destinationPath = public_path('/uploads/images');
                //$extension = $file->getClientOriginalExtension('logo');
                $thumbnail = $file->getClientOriginalName('image');
                $thumbnail = rand().$thumbnail;
                $request->file('image')->move($destinationPath, $thumbnail);
                $images->image = $thumbnail;

            }
        }
       
        $images->save();
      

        Session::flash('success_message', 'Great! Photos has been saved successfully!');
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
        $album = Image::findOrFail($id);

      if($album){
            $album->delete();
            return response()->json(['status' => true, 'msg' => 'Photos has been deleted']);
        } else {
            return response()->json(['status' => false, 'msg' => 'Photos has  not Found']);
        }
       
    }
}
