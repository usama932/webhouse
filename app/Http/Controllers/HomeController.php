<?php

namespace App\Http\Controllers;

use App\ArtistSubscribe;
use App\FirebaseNotification;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('auth.login');
    }
    public function artistLogin()
    {
        return view('auth.artist-login');
    }
    public function artistRegister()
    {
        return view('auth.artist-register');
    }
    public function sendNotification()
    {
        $notifications  = FirebaseNotification::where("sent",0)->get();
        foreach ($notifications as $notification) {
            $subscribes = ArtistSubscribe::where([["artist_id",$notifications->artist_id],["status",2]])->get();
            foreach ($subscribes as $subscribe) {
                $user = User::find($subscribe->user_id);
                if ($user->fb_token){
                    $api_access = env("FIREBASE_API_ACCESS_KEY", "AAAAHrdvIuA:APA91bFhvI_OrGMaSYyJ8_J3xXE8w9pmBYdMIiBCGYQuuulCpgo3Qle7S_fQIFHFHpYIqBzzqenBYSRUhAg07Ksn_9vAx0liJyTHxv6w7zepmJ5qUR8hLn4uoyaoUEMjUHn4V0GIZI1i");
                    $registrationIds = $user->fb_token;
                    // prep the bundle
                    $tokenResult = $user->createToken('AuthToken');
                    $user->access_token = $tokenResult->accessToken;
                    $data  = "{
\"message\": \"$notification->message\",
\"code\": $notification->status,
\"data\": $user,
\"error\": false
}";
                    #prep the bundle
                    $msg = array
                    (
                        'body' 	=> $notification->message,
                        'click_action' 	=> $data,
                        'title'	=> $notification->title,
                        'icon'	=> 'myicon',/*Default Icon*/
                        'sound' => 'mySound'/*Default sound*/
                    );

                    $fields = array
                    (
                        'to'		=> $registrationIds,
                        'notification'	=> $msg,

                    );


                    $headers = array
                    (
                        'Authorization: key=' . $api_access,
                        'Content-Type: application/json'
                    );

                    #Send Reponse To FireBase Server
                    $ch = curl_init();
                    curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
                    curl_setopt( $ch,CURLOPT_POST, true );
                    curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
                    curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
                    curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
                    curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
                    $result = curl_exec($ch );
                    curl_close( $ch );
                }
            }
            $notification->sent = 1;
            $notification->save();
        }
        // dd("notification send");
    }
}
