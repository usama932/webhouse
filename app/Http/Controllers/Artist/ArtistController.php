<?php

namespace App\Http\Controllers\Artist;

use App\Artist;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class ArtistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("artist.dashboard.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    public function profileSetting()
    {
        $id = Auth::id();
        $artist = Artist::find($id);

       
        return view('artist.dashboard.profile',['artist'=>$artist]);
    }

    public function updateProfile(Request $request)
    {
       
      
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
        ]);
        $id = Auth::id();
        $input = $request->all();
        $user = Artist::find($id);
       $user->name = $request->input('name');
       $user->email = $request->input('email');
       $user->gender = $request->input('gender');
       if($request->description != ''){
        $user->description = $request->input('description');
       }
     


       if ($request->hasFile('image')) {
        if ($request->file('image')->isValid()) {
            $this->validate($request, [
                'image' => 'required|mimes:jpeg,png,jpg'
            ]);
            $file = $request->file('image');
            $destinationPath = public_path('/uploads');

            $imagePath = public_path('/uploads/'.$user->image);

            if($user->image != '') {
                if (File::exists($imagePath)) {
                    unlink($imagePath);
                }
            }
            //$extension = $file->getClientOriginalExtension('logo');
            $thumbnail = $file->getClientOriginalName('image');
            $thumbnail = rand() . $thumbnail;
            $request->file('image')->move($destinationPath, $thumbnail);
            $user->image = $thumbnail;
        }
    }
    
       $user->save();
       
       Session::flash('success_message','Profile updated successfully.');
       return redirect()->back();
    }
}
