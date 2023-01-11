<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\UserCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserCartController extends Controller
{
    public function index()
    {
        $user_carts = UserCart::with('package')->where('user_id', Auth::guard('web')->id())->get();
        return view('frontend.cart.index', get_defined_vars());
    }
    public function profile()
    {
        return view('frontend.user_profile', get_defined_vars());
    }

    public function add_to_cart_package(Request $request)
    {
        DB::beginTransaction();
        try {
            
            $package = Package::find($request->id);
            $cart = new UserCart();
            $cart->user_id = Auth::guard('web')->id();
            $cart->package_id = $package->id;
            $cart->amount = $package->price;

            $cart->save();
            // set_alert('success', 'Information has been saved successfully');
            DB::commit();
            return redirect()->route('user_cart')->withErrors(['alert-success'=>'Package has been added to cart.']);
            // return json_encode(array('status' => 'success'));
        } catch (\Exception $e) {
            // set_alert('fail', 'Something went wrong !!');
            // return json_encode(array('status' => 'fail', 'error' => $e->getMessage()));
            return redirect()->back()->withErrors(['alert-danger'=>'Something Went Wrong!!']);

        }
    }
    public function delete_from_cart(Request $request)
    {
        DB::beginTransaction();
        try {
            
            $cart = UserCart::find($request->id);
           
            $cart->delete();

            // set_alert('success', 'Information has been saved successfully');
            DB::commit();
            return redirect()->back()->withErrors(['alert-success'=>'Package has been deleted from cart.']);
            // return json_encode(array('status' => 'success'));
        } catch (\Exception $e) {
            // set_alert('fail', 'Something went wrong !!');
            // return json_encode(array('status' => 'fail', 'error' => $e->getMessage()));
            return redirect()->back()->withErrors(['alert-danger'=>'Something Went Wrong!!']);

        }
    }
}
