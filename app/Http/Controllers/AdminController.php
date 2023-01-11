<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{
    public function index()
    {
        if (Auth::guard('admin')->user()) {
            return redirect()->route('dashboard');
        }
        return view('admin_auth.login');
    }
    public function login(Request $request)
    {
        if (Auth::guard('admin')->attempt($request->only('email', 'password'))) {
            if (Auth()->guard('admin')->check()) {
                return redirect()->route('dashboard');
            } else {
                return redirect()->back()->withErrors(['alert-danger' => "Permission Denied"]);
            }
        }
        return back()->withErrors(['alert-danger' => "Invalid Credentials"]);
    }
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        return redirect()->route('admin.index');
    }

    public function admin_profile()
    {
        $admin = Admin::where('id', Auth::guard('admin')->user()->id)->first();
        return view('Admin.admin_profile.profile', compact('admin'));
    }

    public function update_password(Request $request)
    {
        $id = Auth::guard('admin')->user()->id;
        $old = Auth::guard('admin')->user()->password;
        $Admin = Hash::check($request->old_password, $old);
        if ($request->password == $request->password_confirmation) {
            if ($Admin) {
                Admin::where('id', $id)->update(['password' => Hash::make($request->password)]);
                // Session::flash('success', 'Password Changed Successfully!');
                // return redirect()->back();
                return redirect()->back()->withErrors(['alert-success' => "Password Changed Successfully"]);
            } else {
                return redirect()->back()->withErrors(['alert-danger' => "Old password is incorrect!"]);
                // Session::flash('error', 'Old password is incorrect!');
                // return redirect()->back();
            }
        }
        return redirect()->back()->withErrors(['alert-danger' => "New Password and confirmed password didn't match!"]);
        // Session::flash('error', "New Password and confirmed password didn't match!");
        // return redirect()->back();
    }

    public function change_profile_img(Request $request)
    {
        // return $request->file('image');
        $request->validate([
            'image' => 'required|image',
        ]);

        DB::beginTransaction();
        try {
            $admin = Admin::findOrFail(Auth::guard('admin')->user()->id);

            if ($request->hasFile('image')) {

                $destination = '/uploads/admin/' . $admin->image;
                if (File::exists($destination)) {
                    File::delete($destination);
                }
                $ramdom_code = mt_rand(1000, 9999);
                $admin_image =  $request->file('image');
                $img_name = $admin->id . $admin->name .  $ramdom_code . '.' . $admin_image->getClientOriginalExtension();

                $admin_image->move(public_path('uploads/admin/'), $img_name);

                $admin->image = '/uploads/admin/' . $img_name;

                $admin->update();
            }



            DB::commit();
        } catch (\Exception $exception) {
            DB::rollback();
            if (('APP_ENV') == 'local') {
                dd($exception);
            } else {
                return redirect()->back()->withErrors(['alert-danger' => "Database Error. Please Contact Support"]);
            }
        }
        return redirect()->back()->withErrors(['alert-success' => "Profile Image Updated Successfully"]);
    }

    public function dashboard(){

        $users = User::count();
        $brands = Brand::count();
        $franchises = Franchise::count();
        return view('Admin.dashboard.dashboard', compact('users', 'brands', 'franchises'));
    }
    public function getUsersList(){
        $users = User::paginate(30);
        return view('Admin.users.users',get_defined_vars());
    }
    public function updateStatus(Request $request, $id){
        $request->validate([
            'status' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $user = User::findOrFail($id);
            $user->status = $request->status;
            $user->update();
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollback();
            if (('APP_ENV') == 'local') {
                dd($exception);
            } else {
                return redirect()->back()->withErrors(['alert-danger' => "Database Error. Please Contact Support"]);
            }
        }
        return redirect()->back()->withErrors(['alert-success' => "User Status Updated Successfully"]);
    }

}
