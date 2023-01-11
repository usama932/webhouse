<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function user_login()
    {
        if (Auth::guard('web')->user()) {
            return redirect()->route('main_web');
        }
        return view('auth.login');
    }

    public function register_page()
    {
        if (Auth::guard('web')->user()) {
            return redirect()->route('main_web');
        }
        return view('auth.register');
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|exists:users',
            'password' => 'required',
        ]);
        if (Auth::guard('web')->attempt($request->only('email', 'password'))) {
            if (Auth()->guard('web')->check()) {
                return redirect()->route('main_web');
            } else {

                return redirect()->back()->withErrors(['alert-danger' => "Permission Denied"]);
            }
        }

        return redirect()->back()->with('error', 'Invalid Credentials');
    }
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        return redirect()->route('main_web');
    }

    public function register(Request $request)
    {

        $request->validate([
            'email' => 'required|string|email|unique:users',
            'phone' => 'required|string|unique:users',
            'name' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);

        // if ($validator->fails()) {
        //     return redirect()->back()->withErrors(['alert-danger' => 'Enter Required Fields']);
        // }

        try {
            DB::beginTransaction();

            $check = User::where('email', $request->email)->first();
            if ($check) {
                return redirect()->back()->withErrors(['alert-danger' => 'Email already exists']);
            }
            $user = new User();
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->name = $request->name;
            $user->password = Hash::make($request->password);
          

            // try {
            //     Mail::to($request->email)->send(new EmailVerification($request->name, $otp));
            // } catch (\Exception $e) {
            //     if (('APP_ENV') == 'local') {
            //         dd($e);
            //     } else {
            //         return redirect()->back()->withErrors(['alert-danger' => "Database Error. Please Contact Support"]);
            //     }
            //     // return $this->sendError($e->getMessage(), null);
            // }

            $user->save();

            DB::commit();
           
            return redirect()->route('main_web');

        } catch (\Exception $exception) {
            DB::rollback();
            if (('APP_ENV') == 'local') {
                dd($exception);
            } else {
                return redirect()->back()->withErrors(['alert-danger' => 'Something went wrong!!']);

            }
        }
    }

}
