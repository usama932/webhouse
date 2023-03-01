<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use App\Audio;
use App\FavrateAudio;
use App\FavrateVideo;
use App\Video;
use App\Artist;
use App\Category;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $audios = Audio::with('cat','artist')->latest()->take(5)->get();
        $videos = Video::with('cat','artist')->latest()->take(5)->get();
        $categories = Category::where('feature',1)->latest()->take(15)->get();
        $artists = Artist::where('feature',1)->latest()->take(15)->get();

        return view('user.dashboard.index',compact('audios','videos','categories','artists'));
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
    /**
     * User Profile Setting Method
     */

    public function profileSetting()
    {
        $user= Auth::user();
        return view('user.dashboard.profile',['user'=>$user]);
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email',
        ]);
        $input = $request->all();
       $user->name = $request->input('name');
       $user->email = $request->input('email');
       $user->gender = $request->input('gender');
       

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

    public function configCache(){
        Artisan::call('config:clear');
        Artisan::call('cache:clear');
        Artisan::call('config:cache');
        return redirect()->back();
    }

    public function logout()
    {
        Auth::guard('user')->logout();
        return redirect()->route('login');

    }
    public function notifications()
    {
//        dd(auth()->user()->notifications());
//        dd(auth()->user()->unreadNotifications()->groupBy('notifiable_type')->count());
        return auth()->user()->unreadNotifications()->limit(10)->get()->toArray();
    }
    public function showMessage(){


    }

}
