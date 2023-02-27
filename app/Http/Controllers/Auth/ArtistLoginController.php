<?php

namespace App\Http\Controllers\Auth;

use App\Artist;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ArtistLoginController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('guest:artist', ['except' => ['logout'],['registration']]);
    // }

    public function showLoginForm()
    {

        return view('auth.artist-login');
    }

    public function login(Request $request)
    {
       
        // Validate the form data
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        // Attempt to log the user in
        if (Auth::guard('artist')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            // if successful, then redirect to their intended location
            return redirect('/artist/dashboard');
        }

        // if unsuccessful, then redirect back to the login with the form data

        //return redirect()->back()->withErrors->withInput($request->only('email', 'remember'));
        return redirect()->back()->withErrors(['email'=>'These credentials do not match our records.'])->withInput
        ($request->only('email', 'remember'));
    }

    public function logout()
    {
        Auth::guard('artist')->logout();
        return redirect()->route('artist.login');

    }
    public function registration(Request $request)

    {

        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg',
            'email' => 'required|email|unique:artists',
            'password' => 'required|confirmed|min:8',
        ]);

        $data = $request->all();
        $user = new Artist();
        $user->gender = $request->gender;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->name = $request->name;
        $user->password = Hash::make($request->password);
        if ($request->hasFile('image')) {
            if ($request->file('image')->isValid()) {
                $this->validate($request, [
                    'image' => 'required|image|mimes:jpeg,png,jpg'
                ]);
                $file = $request->file('image');
                $destinationPath = public_path('/uploads');
                //$extension = $file->getClientOriginalExtension('logo');
                $image = $file->getClientOriginalName('image');
                $image = rand().$image;
                $request->file('image')->move($destinationPath, $image);
                $user->image = $image;

            }
        }
        $user->save();
        if (Auth::guard('artist')->attempt(['email' => $request->email, 'password' => $request->password])) {

            return redirect("artist/dashboard")->withSuccess('Great! You have Successfully loggedin');
        }


    }
}
