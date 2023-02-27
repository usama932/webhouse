<?php

namespace App\Http\Controllers\Api;

use App\Albums;
use App\ArtistSubscribe;
use App\Audio;
use App\Category;
use App\Event;
use App\FaverateEvent;
use App\FavrateAudio;
use App\FavrateVideo;
use App\FirebaseNotification;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;
use App\Image;
use App\Room;
use App\Video;
use App\Workout;
use Illuminate\Http\Request;
use App\Artist;
use App\Manager;
use App\User;
use Exception;
use Hash;
use File;
use Validator;
class ArtistController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get_top_artists(Request $request)
    {
        //    $artists = DB::table('artists')->join('profile_viewers', 'artists.id', '=', 'profile_viewers.artist_id')->COUNT();

        $artists = Artist::take(100)->withCount('profile_viewers')->orderBy('profile_viewers_count', 'DESC')->get();

        if (count($artists) < 1) {
            return response()->json(['message' => "Artists not Found", "error" => true, 'data' => $artists], 200);
        }
        return response()->json(['message' => "Artists with profile Viewers", "error" => false, 'data' => $artists], 200);
    }
    public function register(Request $request)
    {            
        $validation = Validator::make($request->all(), [
            'name'=>'required',
            'email'=>'required',
            'password'=>'required',
        
        ]);
        if($validation->fails()){
            $error = $validation->errors()->first();
            return $this->errorResponse($error, 200);
        }
        try {
            $name = $request->input("name");
            $password = $request->input("password");
            $email = $request->input("email");
            $gender = $request->input("gender");
            // if ($name == null or $password == null or $email == null) {
            //     return response([
            //         'message' => "Plz Fill the Field Correctly",
            //         'error' => true
            //     ], 200);
            // } else {
                $check_email = User::where("email", $email)->first();
                if ($check_email) {
                    return response([
                        'message' => "Email is already taken",
                        'error' => true
                    ], 200);
                }
            // }
            $validatedData = $request->all();
            $validatedData['password'] = bcrypt($request->password);
            if ($request->hasFile('image')) {
                if ($request->file('image')->isValid()) {
                    $this->validate($request, [
                        'image' => 'required|image|mimes:jpeg,png,jpg'
                    ]);
                    $file = $request->file('image');
                    $destinationPath = public_path('/uploads');
                    //$extension = $file->getClientOriginalExtension('logo');
                    $image = $file->getClientOriginalName('image');
                    $image = rand() . $image;
                    $request->file('image')->move($destinationPath, $image);
                    $validatedData['image'] = $image;
                }
            }
            $user = User::create($validatedData);

            $accessToken = $user->createToken('authToken')->accessToken;

            return response([
                'message' => "Account Successfully Created",
                'user' => $user,
                'access_token' => $accessToken,
                'error' => false
            ], 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'error' => true], 200);
        }
    }
    public function updateProfile(Request $request)
    {
        try {

            $validation = Validator::make($request->all(), [
                'name'=>'required',
                'email'=>'required'
            
           
                // 'categories'   =>'required'
            ]);
            /* if nearby is 1 
            * order by based on distance and name
            */
            if($validation->fails()){
                $error = $validation->errors()->first();
                return $this->errorResponse($error, 200);
            }
            $user = auth()->user();
            //        $user = Artist::findOrfail($request->id);
            $name = $request->input("name");
            $password = $request->input("password");
            $email = $request->input("email");
            $gender = $request->input("gender");
            if ($name == null  or $email == null or $gender == null) {
                return response([
                    'message' => "Plz Fill the Field Correctly",
                    'error' => true
                ], 200);
            } else {
                if ($user->email != $request->email) {
                    $check_email = Artist::where("email", $email)->first();
                    if ($check_email) {
                        return response([
                            'message' => "Email is already taken",
                            'error' => true
                        ], 200);
                    }
                }
            }




            if ($request->hasFile('image')) {
                if ($request->file('image')->isValid()) {
                    $this->validate($request, [
                        'image' => 'required|image|mimes:jpeg,png,jpg'
                    ]);
                    $file = $request->file('image');
                    $destinationPath = public_path('/uploads');
                    //$extension = $file->getClientOriginalExtension('logo');
                    $image = $file->getClientOriginalName('image');
                    $image = rand() . $image;
                    $request->file('image')->move($destinationPath, $image);
                    $user->image = $image;
                }
            }
            if ($request->hasFile('cover_photo')) {
                if ($request->file('cover_photo')->isValid()) {
                    $this->validate($request, [
                        'cover_photo' => 'required|image|mimes:jpeg,png,jpg'
                    ]);
                    $file = $request->file('cover_photo');
                    $destinationPath = public_path('/uploads');
                    //$extension = $file->getClientOriginalExtension('logo');
                    $image = $file->getClientOriginalName('cover_photo');
                    $image = rand() . $image;
                    $request->file('cover_photo')->move($destinationPath, $image);
                    $user->cover_photo = $image;
                }
            }
            if ($request->password) {
                $user->password = bcrypt($request->password);
            }
            $user->gender = $gender;
            $user->email = $email;
            $user->name = $name;
            $user->phone = $request->phone;
            $user->facebook_link = $request->facebook_link;
            $user->youtube_link = $request->youtube_link;
            $user->instagram_link = $request->instagram_link;
            $user->twitter_link = $request->twitter_link;
            $user->description = $request->description;
            $user->shopify = $request->shopify;
            $user->ecwid = $request->ecwid;
            $user->save();


            return response([
                'user' => $user,
                'error' => false
            ], 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'error' => true], 200);
        }
    }
    public function addRoom(Request $request)
    {
        try {
            $validation = Validator::make($request->all(), [
                'name' => 'required',
                'type'=>'required'
              
                // 'categories'   =>'required'
            ]);
            /* if nearby is 1 
            * order by based on distance and name
            */
            if($validation->fails()){
                $error = $validation->errors()->first();
                return $this->errorResponse($error, 200);
            }

            $user = auth()->user();
            //        $user = Artist::findOrfail($request->id);
            $save = new Room();
            $save->name = $request->name;
            $save->type = $request->type;
            $save->artist_id = $user->id;
            $save->save();

            return response([
                'data' => $save,
                'error' => false
            ], 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'error' => true], 200);
        }
    }
    public function updateToken(Request $request)
    {
        try{
            $validation = Validator::make($request->all(), [
                'token'=>'required',
               
                // 'categories'   =>'required'
            ]);
            /* if nearby is 1 
            * order by based on distance and name
            */
            if($validation->fails()){
                $error = $validation->errors()->first();
                return $this->errorResponse($error, 200);
            }  
        $user = auth()->user();
        //
        $user->fb_token = $request->token;
        $user->save();


        return response([
            'user' => $user,
            'message' => "Token Updated",
            'error' => false
        ], 200);

    } catch (Exception $e) {
        return response()->json(['message' => $e->getMessage(), 'error' => true], 200);
    }
    }
    public function updateTokenArtist(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'fb_token'=>'required'
            
            // 'categories'   =>'required'
        ]);
        /* if nearby is 1 
        * order by based on distance and name
        */
        if($validation->fails()){
            $error = $validation->errors()->first();
            return $this->errorResponse($error, 200);
        }
        $user = auth()->user();
        //
        $user->fb_token = $request->fb_token;
        $user->save();


        return response([
            'user' => $user,
            'message' => "Token Updated",
            'error' => false
        ], 200);
    }
    public function updateUserProfile(Request $request)
    {
        try {

            $validation = Validator::make($request->all(), [
                'name'=>'required',
                'password'=>'required',
                'email'=>'required'
            
               
                // 'categories'   =>'required'
            ]);
            /* if nearby is 1 
            * order by based on distance and name
            */
            if($validation->fails()){
                $error = $validation->errors()->first();
                return $this->errorResponse($error, 200);
            }
            $user = auth()->user();
            //        $user = Artist::findOrfail($request->id);
            $name = $request->input("name");
            $password = $request->input("password");
            $email = $request->input("email");
            $gender = $request->input("gender");
            if ($name == null  or $email == null or $gender == null) {
                return response([
                    'message' => "Plz Fill the Field Correctly",
                    'error' => true
                ], 200);
            } else {
                if ($user->email != $request->email) {
                    $check_email = User::where("email", $email)->first();
                    if ($check_email) {
                        return response([
                            'message' => "Email is already taken",
                            'error' => true
                        ], 200);
                    }
                }
            }


            if ($request->hasFile('image')) {
                if ($request->file('image')->isValid()) {
                    $this->validate($request, [
                        'image' => 'required|image|mimes:jpeg,png,jpg'
                    ]);
                    $file = $request->file('image');
                    $destinationPath = public_path('/uploads');
                    //$extension = $file->getClientOriginalExtension('logo');
                    $image = $file->getClientOriginalName('image');
                    $image = rand() . $image;
                    $request->file('image')->move($destinationPath, $image);
                    $user->image = $image;
                }
            }

            if ($request->password) {
                $user->password = bcrypt($request->password);
            }
            $user->gender = $gender;
            $user->email = $email;
            $user->name = $name;
            //        $user->phone = $request->phone;
            //        $user->facebook_link = $request->facebook_link;
            //        $user->youtube_link = $request->youtube_link;
            //        $user->instagram_link = $request->instagram_link;
            //        $user->twitter_link = $request->twitter_link;
            //        $user->description = $request->twitter_link;
            $user->save();


            return response([
                'user' => $user,
                'error' => false
            ], 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'error' => true], 200);
        }
    }
    public function subscribeUsers(Request $request)
    {
        try {
            $user = auth()->user();
            $data = ArtistSubscribe::where([["artist_id", $user->id], ["artist_subscribes.status", $request->status]])
                ->join('users', 'artist_subscribes.user_id', '=', 'users.id')
                ->select('users.name', 'users.email', 'users.image', 'artist_subscribes.*')
                ->selectRaw('datediff(NOW(),artist_subscribes.created_at)  AS date_difference')
                ->get();
            if ($data->isNotEmpty()) {
                return response([
                    'message' => "Subscribers List",
                    'data' => $data,
                    'error' => false
                ], 200);
            } else {
                return response([
                    'message' => "Subscribers Not Found",
                    'error' => true
                ], 200);
            }
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'error' => true], 200);
        }
    }

    public function registerArtist(Request $request)
    {
        try{

            $validation = Validator::make($request->all(), [
                'name'=>'required',
                'email'=>'required',
                'password'=>'required',
            
            ]);
            if($validation->fails()){
                $error = $validation->errors()->first();
                return $this->errorResponse($error, 200);
            }
        $name = $request->input("name");
        $password = $request->input("password");
        $email = $request->input("email");
        if ($name == null or $password == null or $email == null) {
            return response([
                'message' => "Plz Fill the Field Correctly",
                'error' => true
            ], 200);
        } else {
            $check_email = Artist::where("email", $email)->first();
            if ($check_email) {
                return response([
                    'message' => "Email is already taken",
                    'error' => true
                ], 200);
            }
        }
        $validatedData = $request->all();
        $validatedData['password'] = bcrypt($request->password);
        if ($request->hasFile('image')) {
            if ($request->file('image')->isValid()) {
                $this->validate($request, [
                    'image' => 'required|image|mimes:jpeg,png,jpg'
                ]);
                $file = $request->file('image');
                $destinationPath = public_path('/uploads');
                //$extension = $file->getClientOriginalExtension('logo');
                $image = $file->getClientOriginalName('image');
                $image = rand() . $image;
                $request->file('image')->move($destinationPath, $image);
                $validatedData['image'] = $image;
            }
        }
        if ($request->hasFile('cover_photo')) {
            if ($request->file('cover_photo')->isValid()) {
                $this->validate($request, [
                    'cover_photo' => 'required|image|mimes:jpeg,png,jpg'
                ]);
                $file = $request->file('cover_photo');
                $destinationPath = public_path('/uploads');
                //$extension = $file->getClientOriginalExtension('logo');
                $image = $file->getClientOriginalName('cover_photo');
                $image = rand() . $image;
                $request->file('cover_photo')->move($destinationPath, $image);
                $validatedData['cover_photo'] = $image;
            }
        }
        $user = Artist::create($validatedData);

        $accessToken = $user->createToken('authToken')->accessToken;

        return response([
            'message' => "Account Successfully Created",
            'artist' => $user,
            'access_token' => $accessToken,
            'error' => false
        ], 200);

    } catch (Exception $e) {
        return response()->json(['message' => $e->getMessage(), 'error' => true], 200);
    }
    }


    public function login(Request $request)
    {
        $loginData = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        try{

        $user = User::where("email", request('email'))->first();
        if (!isset($user)) {
            return response()->json([
                "message" => "User Not found",
                "error" => true
            ], 200);
        }
        if (!Hash::check(request('password'), $user->password)) {
            return response()->json([
                "message" => "Incorrect Password",
                "error" => true
            ], 200);
        }
        if ($user->active != 1) {
            return response()->json([
                "message" => "Sorry Your Account is not activated",
                "error" => true
            ], 200);
        }
        $tokenResult = $user->createToken('User');
        $user->access_token = $tokenResult->accessToken;
        $user->token_type = 'Bearer';
        return response()->json([
            "message" => "Login Successfully",
            "data" => $user,
            "error" => false
        ], 200);
    } catch (Exception $e) {
        return response()->json(['message' => $e->getMessage(), 'error' => true], 200);
    }

    }
    public function artistLogin(Request $request)
    {
        $loginData = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);
  try{
        $user = Artist::where("email", request('email'))->first();
        if (!isset($user)) {
            return response()->json([
                "message" => "Artist Not found",
                "error" => true
            ], 200);
        }
        if (!Hash::check(request('password'), $user->password)) {
            return response()->json([
                "message" => "Incorrect Password",
                "error" => true
            ], 200);
        }
        if ($user->active != 1) {
            return response()->json([
                "message" => "Sorry Your Account is not activated",
                "error" => true
            ], 200);
        }
        $tokenResult = $user->createToken('Artist');
        $user->access_token = $tokenResult->accessToken;
        $user->token_type = 'Bearer';
        $user->subscribers = ArtistSubscribe::where([["artist_id", $user->id], ["status", 2]])->get()->count();
        $user->video = $user->videos->count();
        $user->photo = $user->images->count();
        $user->audio = $user->audios->count();
        $user->album = $user->albums->count();
        $user->event = $user->events->count();
        $user->makeHidden('images')->toArray();
        $user->makeHidden('videos')->toArray();
        $user->makeHidden('albums')->toArray();
        $user->makeHidden('audios')->toArray();
        $user->makeHidden('events')->toArray();
        //        $user->unset('images','albums','videos','audios','');
        return response()->json([
            "message" => "Login Successfully",
            "data" => $user,
            "error" => false
        ], 200);

    } catch (Exception $e) {
        return response()->json(['message' => $e->getMessage(), 'error' => true], 200);
    }
        //        return response(['user' => auth("manager")->user(), 'access_token' => $accessToken]);

    }

    public function index()
    {
        $user = auth()->user();
        return response([
            'user' => $user,
            'message' => "working"
        ], 200);
    }


    public function albumList(Request $request)
    {
        $user = auth()->user();
        $offset = $request->offset;
        $data = Albums::where([["artist_id", $user->id], ["albums.status", 1]])
            ->select('albums.*')
            ->selectRaw('datediff(NOW(),created_at)  AS date_difference')
            ->skip($offset)->take(15)->get();
        $total_count = Albums::where([["artist_id", $user->id], ["status", 1]])->get()->count();
        if ($data->isNotEmpty()) {
            return response([
                'data' => $data,
                'total_count' => $total_count,
                'message' => "Albums List",
                'error' => false
            ], 200);
        } else {
            return response([
                'message' => "Albums Not Found",
                'error' => true
            ], 200);
        }
    }

    public function albumSave(Request $request)
    {
        try {

            $validation = Validator::make($request->all(), [
                'name'=>'required'
              
            
            ]);
            if($validation->fails()){
                $error = $validation->errors()->first();
                return $this->errorResponse($error, 200);
            }

            $user = auth()->user();
            $save = new Albums();
            $save->name = $request->name;
            $save->description = $request->description;
            $save->artist_id = $user->id;
            if ($request->hasFile('image')) {
                if ($request->file('image')->isValid()) {
                    $this->validate($request, [
                        'image' => 'required|image|mimes:jpeg,png,jpg'
                    ]);
                    $file = $request->file('image');
                    $destinationPath = public_path('/uploads/album');
                    //$extension = $file->getClientOriginalExtension('logo');
                    $image = $file->getClientOriginalName('image');
                    $image = rand() . $image;
                    $request->file('image')->move($destinationPath, $image);
                    $save->image = $image;
                }
            }
            $save->save();
            if ($save) {
                return response([
                    'data' => $save,
                    'message' => "Albums Saved",
                    'error' => false
                ], 200);
            } else {
                return response([
                    'message' => "Albums Not Saved",
                    'error' => true
                ], 200);
            }
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'error' => true], 200);
        }
    }
    public function albumUpdate(Request $request)
    {
        try {
            $validation = Validator::make($request->all(), [
                'id'=>'required',
                'name' => 'required'
              
            
            ]);
            if($validation->fails()){
                $error = $validation->errors()->first();
                return $this->errorResponse($error, 200);
            }
                 
            $user = auth()->user();
            $save = Albums::findOrFail($request->id);
            $save->name = $request->name;
            $save->description = $request->description;
            $save->artist_id = $user->id;
            if ($request->hasFile('image')) {
                if ($request->file('image')->isValid()) {
                    $this->validate($request, [
                        'image' => 'required|image|mimes:jpeg,png,jpg'
                    ]);
                    $file = $request->file('image');
                    $destinationPath = public_path('/uploads/album');
                    //$extension = $file->getClientOriginalExtension('logo');
                    $image = $file->getClientOriginalName('image');
                    $image = rand() . $image;
                    $request->file('image')->move($destinationPath, $image);
                    $save->image = $image;
                }
            }
            $save->save();
            if ($save) {
                return response([
                    'data' => $save,
                    'message' => "Albums Updated",
                    'error' => false
                ], 200);
            } else {
                return response([
                    'message' => "Albums Not Updated",
                    'error' => true
                ], 200);
            }
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'error' => true], 200);
        }
    }

    public function subscribeArtist(Request $request)
    {
        try {
            $validation = Validator::make($request->all(), [
                'artist_id' => 'required',
                'status' => 'required'
                
                // 'categories'   =>'required'
            ]);
            /* if nearby is 1 
            * order by based on distance and name
            */
            if($validation->fails()){
                $error = $validation->errors()->first();
                return $this->errorResponse($error, 200);
            }
            $user = auth()->user();
            $save = ArtistSubscribe::where([["artist_id", $request->artist_id], ["user_id", $user->id]])->first();
            if (!$save) {
                $save = new ArtistSubscribe();
            }
            $save->artist_id = $request->artist_id;
            $save->user_id = $user->id;
            $save->status = $request->status;
            $save->save();
            if ($save->status == 4) {

                if ($save->status == 4) {
                    return response([
                        'message' => "Artist Un Subscribed",
                        'error' => false
                    ], 200);
                } else {
                    return response([
                        'message' => "Artist  Subscribed",
                        'error' => true
                    ], 200);
                }
            }
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'error' => true], 200);
        }

        if ($save) {
            return response([
                'data' => $save,
                'message' => "Artist Subscribed",
                'error' => false
            ], 200);
        } else {
            return response([
                'message' => "Artist not Subscribed",
                'error' => true
            ], 200);
        }
    }
    public function favrateAudio(Request $request)
    {
        try {

            $validation = Validator::make($request->all(), [
                'audio_id'=>'required',
             
                // 'categories'   =>'required'
            ]);
            /* if nearby is 1 
            * order by based on distance and name
            */

            if($validation->fails()){
                $error = $validation->errors()->first();
                return $this->errorResponse($error, 200);
            }

            $audio = Audio::where('id',$request->audio_id)->first();
            if(!$audio){
                return response([
                    'message' => "Audio not Found",
                    'error' => false
                ], 200);
            }
            $user = auth()->user();
            $save = FavrateAudio::where([["audio_id", $request->audio_id], ["user_id", $user->id]])->first();
            if (!$save) {
                $save = new FavrateAudio();
            }

            $save->audio_id = $request->audio_id;
            $save->user_id = $user->id;
            $save->save();
            if ($request->delete == 1) {

                if ($save->delete()) {
                    return response([
                        'message' => "Audio Un Favorate",
                        'error' => false
                    ], 200);
                } else {
                    return response([
                        'message' => "Audio  Favorate",
                        'error' => true
                    ], 200);
                }
            }
            if ($save) {
                return response([
                    'data' => $save,
                    'message' => "Audio Favorate",
                    'error' => false
                ], 200);
            } else {
                return response([
                    'message' => "Audio not Favorate",
                    'error' => true
                ], 200);
            }
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'error' => true], 200);
        }
    }
    public function favrateVideo(Request $request)
    {
    try{
        
        $validation = Validator::make($request->all(), [
            'video_id'=>'required',
         
            // 'categories'   =>'required'
        ]);
        /* if nearby is 1 
        * order by based on distance and name
        */
        if($validation->fails()){
            $error = $validation->errors()->first();
            return $this->errorResponse($error, 200);
        }

        $video = Video::where('id',$request->video_id)->first();
        if(!$video){
            return response([
                'message' => "Video not Found",
                'error' => false
            ], 200);
        }
        $user = auth()->user();
        $save = FavrateVideo::where([["video_id", $request->video_id], ["user_id", $user->id]])->first();
        if (!$save) {
            $save = new FavrateVideo();
        }
        $save->video_id = $request->video_id;
        $save->user_id = $user->id;
        $save->save();
        if ($request->delete == 1) {

            if ($save->delete()) {
                return response([
                    'message' => "Video Un Favorate",
                    'error' => false
                ], 200);
            } else {
                return response([
                    'message' => "Video  Favorate",
                    'error' => true
                ], 200);
            }
        }
        if ($save) {
            return response([
                'data' => $save,
                'message' => "Video Favorate",
                'error' => false
            ], 200);
        } else {
            return response([
                'message' => "Video not Favorate",
                'error' => true
            ], 200);
        }

    } catch (Exception $e) {
        return response()->json(['message' => $e->getMessage(), 'error' => true], 200);
    }
    }
    public function favrateEvent(Request $request)
    {
        try {

            $validation = Validator::make($request->all(), [
                'event_id'=>'required',
              
                // 'categories'   =>'required'
            ]);
            /* if nearby is 1 
            * order by based on distance and name
            */
            if($validation->fails()){
                $error = $validation->errors()->first();
                return $this->errorResponse($error, 200);
            }

            $event = Event::where('id',$request->event_id)->first();
            if(!$event){
                return response([
                    'message' => "Event not Found",
                    'error' => false
                ], 200);
            }
            $user = auth()->user();
            $save = FaverateEvent::where([["event_id", $request->event_id], ["user_id", $user->id]])->first();
            if (!$save) {
                $save = new FaverateEvent();
            }
            $save->event_id = $request->event_id;
            $save->user_id = $user->id;
            $save->save();
            if ($request->delete == 1) {

                if ($save->delete()) {
                    return response([
                        'message' => "Event Un Favorate",
                        'error' => false
                    ], 200);
                } else {
                    return response([
                        'message' => "Event  Favorate",
                        'error' => true
                    ], 200);
                }
            }
            if ($save) {
                return response([
                    'data' => $save,
                    'message' => "Event Favorate",
                    'error' => false
                ], 200);
            } else {
                return response([
                    'message' => "Event not Favorate",
                    'error' => true
                ], 200);
            }
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'error' => true], 200);
        }
    }

    public function imageSave(Request $request)
    {
        try {
            $user = auth()->user();
            $save = new Image();
            $save->description = $request->description;
            $save->artist_id = $user->id;
            if ($request->hasFile('image')) {
                if ($request->file('image')->isValid()) {
                    $this->validate($request, [
                        'image' => 'required|image|mimes:jpeg,png,jpg'
                    ]);
                    $file = $request->file('image');
                    $destinationPath = public_path('/uploads/gallery');
                    //$extension = $file->getClientOriginalExtension('logo');
                    $image = $file->getClientOriginalName('image');
                    $image = rand() . $image;
                    $request->file('image')->move($destinationPath, $image);
                    $save->image = $image;
                }
            }
            $save->save();
            if ($save) {
                return response([
                    'data' => $save,
                    'message' => "Image Saved",
                    'error' => false
                ], 200);
            } else {
                return response([
                    'message' => "Image Not Saved",
                    'error' => true
                ], 200);
            }
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'error' => true], 200);
        }
    }
    public function eventSave(Request $request)
    {
        try {
            $validation = Validator::make($request->all(), [
                'name'=>'required',
                'venue'=>'required',
                'date_time'=>'required',
            
            ]);
            if($validation->fails()){
                $error = $validation->errors()->first();
                return $this->errorResponse($error, 200);
            }
            $user = auth()->user();
            $save = new Event();
            $save->name = $request->name;
            $save->venue = $request->venue;
            $save->date_time = $request->date_time;
            $save->description = $request->description;
            $save->artist_id = $user->id;
            if ($request->hasFile('image')) {
                if ($request->file('image')->isValid()) {
                    $this->validate($request, [
                        'image' => 'required|image|mimes:jpeg,png,jpg'
                    ]);
                    $file = $request->file('image');
                    $destinationPath = public_path('/uploads/event');
                    //$extension = $file->getClientOriginalExtension('logo');
                    $image = $file->getClientOriginalName('image');
                    $image = rand() . $image;
                    $request->file('image')->move($destinationPath, $image);
                    $save->image = $image;
                }
            }
            $save->save();
            if ($save) {
                return response([
                    'data' => $save,
                    'message' => "Event Saved",
                    'error' => false
                ], 200);
            } else {
                return response([
                    'message' => "Event Not Saved",
                    'error' => true
                ], 200);
            }
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'error' => true], 200);
        }
    }

    public function imageDelete(Request $request)
    {
        try {
            $user = auth()->user();
            $delete =  Image::findOrFail($request->id);

            File::delete(public_path("uploads/gallery/$delete->image"));
            if ($delete->delete()) {
                return response([
                    'message' => "Image Deleted",
                    'error' => false
                ], 200);
            } else {
                return response([
                    'message' => "Image Not Deleted",
                    'error' => true
                ], 200);
            }
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'error' => true], 200);
        }
    }
    public function eventDelete(Request $request)
    {
        $user = auth()->user();
        $favs = FaverateEvent::where("event_id", $request->id)->get();
        foreach ($favs as $fav) {
            $fav->delete();
        }
        $delete =  Event::findOrFail($request->id);

        File::delete(public_path("uploads/event/$delete->image"));
        if ($delete->delete()) {
            return response([
                'message' => "Event Deleted",
                'error' => false
            ], 200);
        } else {
            return response([
                'message' => "Event Not Deleted",
                'error' => true
            ], 200);
        }
    }
    public function roomDelete(Request $request)
    {

        $validation = Validator::make($request->all(), [
            'id'=>'required',
           
            // 'categories'   =>'required'
        ]);
        /* if nearby is 1 
        * order by based on distance and name
        */
        if($validation->fails()){
            $error = $validation->errors()->first();
            return $this->errorResponse($error, 200);
        }
        $user = auth()->user();
        $delete =  Room::findOrFail($request->id);
        if ($delete->delete()) {
            return response([
                'message' => "Room Deleted",
                'error' => false
            ], 200);
        } else {
            return response([
                'message' => "Room Not Deleted",
                'error' => true
            ], 200);
        }
    }

    public function albumDelete(Request $request)
    {
        try {

            $validation = Validator::make($request->all(), [
                'id'=>'required',
            
            ]);
            if($validation->fails()){
                $error = $validation->errors()->first();
                return $this->errorResponse($error, 200);
            }
            $user = auth()->user();
            $favs = Audio::where("album_id", $request->id)->get();
            foreach ($favs as $fav) {
                $fav->delete();
            }
            $videos = Video::where("album_id", $request->id)->get();
            foreach ($videos as $video) {
                $video->delete();
            }
            $delete =  Albums::findOrFail($request->id);

            File::delete(public_path("uploads/album/$delete->image"));
            if ($delete->delete()) {
                return response([
                    'message' => "Album Deleted",
                    'error' => false
                ], 200);
            } else {
                return response([
                    'message' => "Album Not Deleted",
                    'error' => true
                ], 200);
            }
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'error' => true], 200);
        }
    }

    public function videoDelete(Request $request)
    {
        try {
            $user = auth()->user();
            $delete =  Video::findOrFail($request->id);

            File::delete(public_path("uploads/video/$delete->video"));
            File::delete(public_path("uploads/video/$delete->thumbnail"));
            if ($delete->delete()) {
                return response([
                    'message' => "Video Deleted",
                    'error' => false
                ], 200);
            } else {
                return response([
                    'message' => "Video Not Deleted",
                    'error' => true
                ], 200);
            }
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'error' => true], 200);
        }
    }

    public function audioDelete(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'id'=>'required'
          
            // 'categories'   =>'required'
        ]);
        $audio = Audio::where('id',$request->id)->first();
        if(!$audio){
            return response([
                'message' => "Audio not Found",
                'error' => false
            ], 200);
        }
        /* if nearby is 1 
        * order by based on distance and name
        */
        if($validation->fails()){
            $error = $validation->errors()->first();
            return $this->errorResponse($error, 200);
        }
        $user = auth()->user();
        $delete =  Audio::findOrFail($request->id);

        File::delete(public_path("uploads/audio/$delete->audio"));
        if ($delete->delete()) {
            return response([
                'message' => "Audio Deleted",
                'error' => false
            ], 200);
        } else {
            return response([
                'message' => "Audio Not Deleted",
                'error' => true
            ], 200);
        }
    }
    public function subscribeUsersDelete(Request $request)
    {
        try {
            $user = auth()->user();
            $delete =  ArtistSubscribe::where([["user_id", $request->user_id], ["artist_id", $user->id]])->first();

            if ($delete->delete()) {
                return response([
                    'message' => "Subscriber Deleted",
                    'error' => false
                ], 200);
            } else {
                return response([
                    'message' => "Subscriber Not Deleted",
                    'error' => true
                ], 200);
            }
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'error' => true], 200);
        }
    }

    public function subscribeUsersStatus(Request $request)
    {
        try {
            $validation = Validator::make($request->all(), [
                'user_id'=>'required'
               
                // 'categories'   =>'required'
            ]);
            /* if nearby is 1 
            * order by based on distance and name
            */
            if($validation->fails()){
                $error = $validation->errors()->first();
                return $this->errorResponse($error, 200);
            }
            $message = '';
            $user = auth()->user();
            $delete =  ArtistSubscribe::where([["user_id", $request->user_id], ["artist_id", $user->id]])->first();
            if (!$delete) {
                $delete = new ArtistSubscribe();
                $delete->user_id = $request->user_id;
                $delete->artist_id = $user->id;
            }
            $delete->status = $request->status;
            $msg_user = User::find($request->user_id);
            if ($delete->save()) {
                $title = "Subscription";
                if ($delete->status == 2) {
                    $message = "Your Request has been accepted by Artist $user->name";
                } elseif ($delete->status == 3) {
                    $message = "Your Request has been Rejected by Artist $user->name";
                } elseif ($delete->status == 4) {
                    $message = "Your Request has been Unsubscribed by Artist $user->name";
                }
                $tokenResult = $msg_user->createToken('AuthToken');
                $msg_user->access_token = $tokenResult->accessToken;
                $data  = "{
\"message\": \"$message\",
\"code\": 2,
\"data\": $msg_user,
\"error\": false
}";
                $condition = false;
                if ($msg_user->fb_token) {
                    $api_access = env("FIREBASE_API_ACCESS_KEY", "AAAAHrdvIuA:APA91bFhvI_OrGMaSYyJ8_J3xXE8w9pmBYdMIiBCGYQuuulCpgo3Qle7S_fQIFHFHpYIqBzzqenBYSRUhAg07Ksn_9vAx0liJyTHxv6w7zepmJ5qUR8hLn4uoyaoUEMjUHn4V0GIZI1i");
                    $registrationIds = $msg_user->fb_token;
                    // prep the bundle

                    #prep the bundle
                    $msg = array(
                        'body'     => $message,
                        'click_action'     => $data,
                        'title'    => $title,
                        'icon'    => 'myicon',/*Default Icon*/
                        'sound' => 'mySound'/*Default sound*/

                    );
                    $fields = array(

                        'to'        => $registrationIds,
                        'notification'    => $msg,
                    );


                    $headers = array(
                        'Authorization: key=' . $api_access,
                        'Content-Type: application/json'
                    );

                    #Send Reponse To FireBase Server
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
                    curl_setopt($ch, CURLOPT_POST, true);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
                    $result = curl_exec($ch);
                    curl_close($ch);
                }
                return response([
                    'message' => "Subscriber updated",
                    'error' => false
                ], 200);
            } else {
                return response([
                    'message' => "Subscriber Not updated",
                    'error' => true
                ], 200);
            }
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'error' => true], 200);
        }
    }


    public function videoList(Request $request)
    {
        try {


            $user = auth()->user();
            $offset = $request->offset;
            $data = Video::where([["artist_id", $user->id], ["status", 1]])
                ->select('videos.*')
                ->selectRaw('datediff(NOW(),created_at)  AS date_difference')
                ->skip($offset)->take(15)->get();
            $total_count = Video::where([["artist_id", $user->id], ["status", 1]])->get()->count();
            if ($data->isNotEmpty()) {
                return response([
                    'data' => $data,
                    'total_count' => $total_count,
                    'message' => "Video List",
                    'error' => false
                ], 200);
            } else {
                return response([
                    'message' => "Video Not Found",
                    'error' => true
                ], 200);
            }
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'error' => true], 200);
        }
    }
    public function videoSearch(Request $request)
    {
        try {

            $validation = Validator::make($request->all(), [
                'search'=>'required'
                
            
            ]);
            if($validation->fails()){
                $error = $validation->errors()->first();
                return $this->errorResponse($error, 200);
            }
            $user = auth()->user();
            $offset = $request->offset;
            $search = $request->search;
            $data = Video::where([["artist_id", $user->id], ["status", 1], ["name", 'like', '%' .$search. '%']])
                ->orWhere([["artist_id", $user->id], ["status", 1]])
                ->select('videos.*')
                ->selectRaw('datediff(NOW(),created_at)  AS date_difference')
                ->get();
            //        $total_count = Video::where([["artist_id",$user->id],["status",1]])->get()->count();
            if ($data->isNotEmpty()) {
                return response([
                    'data' => $data,
                    //                'total_count' => $total_count,
                    'message' => "Video List",
                    'error' => false
                ], 200);
            } else {
                return response([
                    'message' => "Video Not Found",
                    'error' => true
                ], 200);
            }
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'error' => true], 200);
        }
    }
    public function allVideo(Request $request)
    {
        try {
          
            $user = auth()->user();
            $offset = $request->offset;
            $data = Video::where("videos.status", 1)->join('artists', 'videos.artist_id', '=', 'artists.id')
                ->select('artists.name', 'videos.*')
                ->selectRaw('artists.name  AS artist_name')
                ->skip($offset)->take(15)->get();
            $total_count = Video::where("status", 1)->get()->count();
            if ($data->isNotEmpty()) {
                foreach ($data as $row) {
                    $found = FavrateVideo::where([["user_id", $user->id], ["video_id", $row->id]])->first();
                    if ($found) {
                        $row["fav"] = 1;
                    } else {
                        $row["fav"] = 0;
                    }
                }
                return response([
                    'data' => $data,
                    'total_count' => $total_count,
                    'message' => "Video List",
                    'error' => false
                ], 200);
            } else {
                return response([
                    'message' => "Video Not Found",
                    'error' => true
                ], 200);
            }
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'error' => true], 200);
        }
    }
    public function userVideo(Request $request)
    {
        try {

            $validation = Validator::make($request->all(), [
                'id'=>'required',

            ]);
            if($validation->fails()){
                $error = $validation->errors()->first();
                return $this->errorResponse($error, 200);
            }
            $user = auth()->user();
            $offset = $request->offset;
            $id = $request->id;
            $data = Video::where([["videos.status", 1], ["videos.artist_id", $id]])->join('artists', 'videos.artist_id', '=', 'artists.id')
                ->select('artists.name', 'videos.*')
                ->selectRaw('artists.name  AS artist_name')
                ->skip($offset)->take(15)->get();
            $total_count = Video::where([["status", 1], ["artist_id", $id]])->get()->count();
            if ($data->isNotEmpty()) {
                foreach ($data as $row) {
                    $found = FavrateVideo::where([["user_id", $user->id], ["video_id", $row->id]])->first();
                    if ($found) {
                        $row["fav"] = 1;
                    } else {
                        $row["fav"] = 0;
                    }
                }
                return response([
                    'data' => $data,
                    'total_count' => $total_count,
                    'message' => "Video List",
                    'error' => false
                ], 200);
            } else {
                return response([
                    'message' => "Video Not Found",
                    'error' => true
                ], 200);
            }
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'error' => true], 200);
        }
    }
    public function albumVideo(Request $request)
    {
        try {

            $validation = Validator::make($request->all(), [
                'id' => 'required'
            
            ]);
          
            if($validation->fails()){
                $error = $validation->errors()->first();
                return $this->errorResponse($error, 200);
            }

            $user = auth()->user();
            $offset = $request->offset;
            $data = Video::where([["album_id", $request->id], ["status", 1]])
                ->select('videos.*')
                ->selectRaw('datediff(NOW(),created_at)  AS date_difference')
                ->skip($offset)->take(15)->get();
            $total_count = Video::where([["album_id", $request->id], ["status", 1]])->get()->count();
            if ($data->isNotEmpty()) {
                return response([
                    'data' => $data,
                    'total_count' => $total_count,
                    'message' => "Video List",
                    'error' => false
                ], 200);
            } else {
                return response([
                    'message' => "Video Not Found",
                    'error' => true
                ], 200);
            }
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'error' => true], 200);
        }
    }
    public function allFavVideo(Request $request)
    {
        try {
            $user = auth()->user();
            $offset = $request->offset;
            $data = FavrateVideo::where("user_id", $user->id)
                ->join('videos', 'favrate_videos.video_id', '=', 'videos.id')
                ->join('artists', 'videos.artist_id', '=', 'artists.id')
                ->select('artists.name', 'videos.*')
                ->selectRaw('artists.name  AS artist_name')
                ->skip($offset)->take(15)->get();
            $total_count = FavrateVideo::where("user_id", $user->id)->get()->count();
            //        $total = FavrateVideo::where("user_id",$user->id)->get();
            //        foreach ($total as $row){
            //            $found = FavrateVideo::where([["user_id",$user->id],["video_id",$row->id]])->first();
            //            if ($found){
            //                $total_count = $total_count + 1;
            //            }
            //        }
            if ($data->isNotEmpty()) {
                foreach ($data as $row) {
                    $found = FavrateVideo::where([["user_id", $user->id], ["video_id", $row->id]])->first();
                    if ($found) {
                        $row["fav"] = 1;
                    } else {
                        $row["fav"] = 0;
                    }
                }
                return response([
                    'data' => $data,
                    'total_count' => $total_count,
                    'message' => "Video List",
                    'error' => false
                ], 200);
            } else {
                return response([
                    'message' => "Video Not Found",
                    'error' => true
                ], 200);
            }
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'error' => true], 200);
        }
    }
    public function allFavEvent(Request $request)
    {
        try {
            $user = auth()->user();
            $offset = $request->offset;
            $data = FaverateEvent::where("user_id", $user->id)
                ->join('events', 'faverate_events.event_id', '=', 'events.id')
                ->join('artists', 'events.artist_id', '=', 'artists.id')
                ->select('artists.name', 'events.*')
                ->selectRaw('artists.name  AS artist_name')
                ->skip($offset)->take(15)->get();
            $total_count = FaverateEvent::where("user_id", $user->id)->get()->count();
            //        $total = FavrateVideo::where("user_id",$user->id)->get();
            //        foreach ($total as $row){
            //            $found = FavrateVideo::where([["user_id",$user->id],["video_id",$row->id]])->first();
            //            if ($found){
            //                $total_count = $total_count + 1;
            //            }
            //        }
            $forget = false;
            if ($data->isNotEmpty()) {
                foreach ($data as $key => $row) {
                    $today = date("Y-m-d H:i:s");
                    if ($today >= $row->date_time) {
                        $data->forget($key);
                        $forget = true;
                        $total_count = $total_count - 1;
                    }
                }
                if ($forget) {
                    $data = $data->flatten(1);
                }
            }
            if ($total_count > 0) {
                return response([
                    'data' => $data,
                    'total_count' => $total_count,
                    'message' => "Event List",
                    'error' => false
                ], 200);
            } else {
                return response([
                    'message' => "Event Not Found",
                    'error' => true
                ], 200);
            }
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'error' => true], 200);
        }
    }
    public function allAudio(Request $request)
    {
        try {
            $user = auth()->user();
            $offset = $request->offset;
            $data = Audio::where("audio.status", 1)->join('artists', 'audio.artist_id', '=', 'artists.id')
                ->select('artists.name', 'audio.*')
                ->selectRaw('artists.name  AS artist_name')
                ->skip($offset)->take(15)->get();

            $total_count = Audio::where("status", 1)->get()->count();
            if ($data->isNotEmpty()) {
                foreach ($data as $row) {
                    $found = FavrateAudio::where([["user_id", $user->id], ["audio_id", $row->id]])->first();
                    if ($found) {
                        $row["fav"] = 1;
                    } else {
                        $row["fav"] = 0;
                    }
                }
                return response([
                    'data' => $data,
                    'total_count' => $total_count,
                    'message' => "Audio List",
                    'error' => false
                ], 200);
            } else {
                return response([
                    'message' => "Audio Not Found",
                    'error' => true
                ], 200);
            }
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'error' => true], 200);
        }
    }
    public function userAudio(Request $request)
    {
        try {
            $user = auth()->user();
            $offset = $request->offset;
            $id = $request->id;
            $data = Audio::where([["audio.status", 1], ["audio.artist_id", $id]])->join('artists', 'audio.artist_id', '=', 'artists.id')
                ->select('artists.name', 'audio.*')
                ->selectRaw('artists.name  AS artist_name')
                ->skip($offset)->take(15)->get();

            $total_count = Audio::where([["status", 1], ["artist_id", $id]])->get()->count();
            if ($data->isNotEmpty()) {
                foreach ($data as $row) {
                    $found = FavrateAudio::where([["user_id", $user->id], ["audio_id", $row->id]])->first();
                    if ($found) {
                        $row["fav"] = 1;
                    } else {
                        $row["fav"] = 0;
                    }
                }
                return response([
                    'data' => $data,
                    'total_count' => $total_count,
                    'message' => "Audio List",
                    'error' => false
                ], 200);
            } else {
                return response([
                    'message' => "Audio Not Found",
                    'error' => true
                ], 200);
            }
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'error' => true], 200);
        }
    }
    public function albumAudio(Request $request)
    {
        try {

            $validation = Validator::make($request->all(), [
                'id'=>'required'
               
                // 'categories'   =>'required'
            ]);
            /* if nearby is 1 
            * order by based on distance and name
            */
            if($validation->fails()){
                $error = $validation->errors()->first();
                return $this->errorResponse($error, 200);
            }
            $user = auth()->user();
            $offset = $request->offset;
            $data = Audio::where([["album_id", $request->id], ["audio.status", 1]])
                ->select('audio.*')
                ->selectRaw('datediff(NOW(),created_at)  AS date_difference')
                ->skip($offset)->take(15)->get();
            $total_count = Audio::where([["album_id", $request->id], ["status", 1]])->get()->count();
            if ($data->isNotEmpty()) {
                return response([
                    'data' => $data,
                    'total_count' => $total_count,
                    'message' => "Audio List",
                    'error' => false
                ], 200);
            } else {
                return response([
                    'message' => "Audio Not Found",
                    'error' => true
                ], 200);
            }
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'error' => true], 200);
        }
    }
    public function allEvent(Request $request)
    {
        try {

            $user = auth()->user();
            $offset = $request->offset;
            $today = date("Y-m-d H:i:s");
            $data = Event::where([["events.status", 1], ["date_time", ">=", $today]])->join('artists', 'events.artist_id', '=', 'artists.id')
                ->select('artists.name', 'artists.gender', 'artists.image', 'events.*')
                ->selectRaw('artists.name  AS artist_name')
                ->selectRaw('artists.gender  AS artist_gender')
                ->selectRaw('artists.image  AS artist_image')
                ->skip($offset)->take(15)->get();

            $total_count = Event::where([["status", 1], ["date_time", ">=", $today]])->get()->count();
            if ($data->isNotEmpty()) {
                foreach ($data as $row) {
                    $found = FaverateEvent::where([["user_id", $user->id], ["event_id", $row->id]])->first();
                    if ($found) {
                        $row["fav"] = 1;
                    } else {
                        $row["fav"] = 0;
                    }
                }
                return response([
                    'data' => $data,
                    'total_count' => $total_count,
                    'message' => "Events List",
                    'error' => false
                ], 200);
            } else {
                return response([
                    'message' => "Events Not Found",
                    'error' => true
                ], 200);
            }
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'error' => true], 200);
        }
    }
    public function allEventSearch(Request $request)
    {
        try {
            $user = auth()->user();
            $search = $request->search;
            $type = $request->type;
            $today = date("Y-m-d H:i:s");
            if ($type == "name") {
                $data = Event::where([["events.status", 1], ["date_time", ">=", $today], ["name", 'like', "%{$search}%"]])->join('artists', 'events.artist_id', '=', 'artists.id')
                    ->select('artists.name', 'events.*')
                    ->selectRaw('artists.name  AS artist_name')
                    ->get();
            } else {
                $data = Event::where([["events.status", 1], ["events.date_time", ">=", $today], ["events.name", "%{$search}%"]])->join('artists', 'events.artist_id', '=', 'artists.id')
                    ->select('artists.name', 'events.*')
                    ->selectRaw('artists.name  AS artist_name')
                    ->get();
            }


            //        $total_count = Event::where([["status",1],["date_time",">=",$today]])->get()->count();
            if ($data->isNotEmpty()) {
                foreach ($data as $row) {
                    $found = FaverateEvent::where([["user_id", $user->id], ["event_id", $row->id]])->first();
                    if ($found) {
                        $row["fav"] = 1;
                    } else {
                        $row["fav"] = 0;
                    }
                }
                return response([
                    'data' => $data,
                    //                'total_count' => $total_count,
                    'message' => "Events List",
                    'error' => false
                ], 200);
            } else {
                return response([
                    'message' => "Events Not Found",
                    'error' => true
                ], 200);
            }
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'error' => true], 200);
        }
    }
    public function userEvent(Request $request)
    {
        try {
            $user = auth()->user();
            $offset = $request->offset;
            $id = $request->id;
            $today = date("Y-m-d H:i:s");
            $data = Event::where([["events.status", 1], ["date_time", ">=", $today], ["events.artist_id", $id]])->join('artists', 'events.artist_id', '=', 'artists.id')
                ->select('artists.name', 'events.*')
                ->selectRaw('artists.name  AS artist_name')
                ->skip($offset)->take(15)->get();

            $total_count = Event::where([["status", 1], ["date_time", ">=", $today], ["artist_id", $id]])->get()->count();
            if ($data->isNotEmpty()) {
                foreach ($data as $row) {
                    $found = FaverateEvent::where([["user_id", $user->id], ["event_id", $row->id]])->first();
                    if ($found) {
                        $row["fav"] = 1;
                    } else {
                        $row["fav"] = 0;
                    }
                }
                return response([
                    'data' => $data,
                    'total_count' => $total_count,
                    'message' => "Events List",
                    'error' => false
                ], 200);
            } else {
                return response([
                    'message' => "Events Not Found",
                    'error' => true
                ], 200);
            }
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'error' => true], 200);
        }
    }
    public function allFavAudio(Request $request)
    {
        try {
            $user = auth()->user();

            $offset = $request->offset;
            $data = FavrateAudio::where("user_id", $user->id)
                ->join('audio', 'favrate_audio.audio_id', '=', 'audio.id')
                ->join('artists', 'audio.artist_id', '=', 'artists.id')
                ->select('artists.name', 'audio.*')
                ->selectRaw('artists.name  AS artist_name')
                ->skip($offset)->take(15)->get();


            $total_count = FavrateAudio::where("user_id", $user->id)->get()->count();

            if ($data->isNotEmpty()) {
                foreach ($data as $row) {
                    $found = FavrateAudio::where([["user_id", $user->id], ["audio_id", $row->id]])->first();
                    if ($found) {
                        $row["fav"] = 1;
                    } else {
                        $row["fav"] = 0;
                    }
                }
                return response([
                    'data' => $data,
                    'total_count' => $total_count,
                    'message' => "Audio List",
                    'error' => false
                ], 200);
            } else {
                return response([
                    'message' => "Audio Not Found",
                    'error' => true
                ], 200);
            }
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'error' => true], 200);
        }
    }
    public function allAlbum(Request $request)
    {
        $user = auth()->user();
        $offset = $request->offset;
        $data = Albums::where("status", 1)->skip($offset)->take(15)->get();
        $total_count = Albums::where("status", 1)->get()->count();
        if ($data->isNotEmpty()) {
            return response([
                'data' => $data,
                'total_count' => $total_count,
                'message' => "Album List",
                'error' => false
            ], 200);
        } else {
            return response([
                'message' => "Album Not Found",
                'error' => true
            ], 200);
        }
    }
    public function allArtist(Request $request)
    {
        try {
            $user = auth()->user();
            $offset = $request->offset;
            $data = Artist::where("active", 1)->skip($offset)->take(15)->get();
            $total_count = Artist::where("active", 1)->get()->count();
            $forget = false;
            if ($data->isNotEmpty()) {
                foreach ($data as $key => $row) {
                    $found1 = ArtistSubscribe::where([["user_id", $user->id], ["artist_id", $row->id]])->first();
                    if ($found1) {
                        $row["subscribe"] = $found1->status;
                    } else {
                        $row["subscribe"] = 4;
                    }
                    if ($found1) {
                        if ($found1->status == 2) {
                            $data->forget($key);
                            $forget = true;
                            $total_count = $total_count - 1;
                        }
                    }
                }
                if ($forget) {
                    $data = $data->flatten(1);
                }
                return response([
                    'data' => $data,
                    'total_count' => $total_count,
                    'message' => "Artist List",
                    'error' => false
                ], 200);
            } else {
                return response([
                    'message' => "Artist Not Found",
                    'error' => true
                ], 200);
            }
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'error' => true], 200);
        }
    }

    public function roomList(Request $request)
    {
        try {
            $validation = Validator::make($request->all(), [
                'type'=>'required',
               
                // 'categories'   =>'required'
            ]);
            /* if nearby is 1 
            * order by based on distance and name
            */
            if($validation->fails()){
                $error = $validation->errors()->first();
                return $this->errorResponse($error, 200);
            }
            $user = auth()->user();
            $offset = $request->offset;
            $type = $request->type;
            $data = Room::where("type", $type)->skip($offset)->take(15)->get();
            $total_count = Room::where("type", $type)->get()->count();
            $forget = false;
            if ($data->isNotEmpty()) {
                foreach ($data as $key => $row) {
                    $artist = Artist::find($row->artist_id);
                    $row->artist_name = $artist->name;
                    $row->artist_image = $artist->image;
                    if ($row->type == 2) {
                        $found1 = ArtistSubscribe::where([["user_id", $user->id], ["artist_id", $row->artist_id], ["status", 2]])->first();
                        if (!$found1) {
                            $data->forget($key);
                            $forget = true;
                            $total_count = $total_count - 1;
                        }
                    }
                }
                if ($forget) {
                    $data = $data->flatten(1);
                }
                if ($data->isEmpty()) {
                    return response([
                        'message' => "Room Not Found",
                        'error' => true
                    ], 200);
                }
                return response([
                    'data' => $data,
                    'total_count' => $total_count,
                    'message' => "Room List",
                    'error' => false
                ], 200);
            } else {
                return response([
                    'message' => "Room Not Found",
                    'error' => true
                ], 200);
            }
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'error' => true], 200);
        }
    }

    public function allFavArtist(Request $request)
    {
        $user = auth()->user();
        $offset = $request->offset;
        $data = ArtistSubscribe::where([["user_id", $user->id], ["artist_subscribes.status", 2]])
            ->join('artists', 'artist_subscribes.artist_id', '=', 'artists.id')
            ->select(
                'artists.name',
                'artists.id',
                'artists.image',
                'artists.phone',
                'artists.facebook_link',
                'artists.twitter_link',
                'artists.instagram_link',
                'artists.youtube_link',
                'artists.active',
                'artists.gender',
                'artists.email',
                'artists.cover_photo',
                'artists.description',
                'artists.created_at',
                'artists.updated_at',
                'artists.deleted_at'
            )
            ->skip($offset)->take(15)->get();
        $total_count = ArtistSubscribe::where([["user_id", $user->id], ["status", 2]])->get()->count();
        $forget = false;
        if ($data->isNotEmpty()) {
            foreach ($data as $key => $row) {
                $found = ArtistSubscribe::where([["user_id", $user->id], ["artist_id", $row->id]])->first();
                if ($found) {
                    $row["subscribe"] = $found->status;
                } else {
                    $row["subscribe"] = 4;
                }
                if ($row->deleted_at != null or $row->active == 0) {
                    $data->forget($key);
                    $forget = true;
                    $total_count = $total_count - 1;
                }
            }
            if ($forget) {
                $data = $data->flatten(1);
            }
            return response([
                'data' => $data,
                'total_count' => $total_count,
                'message' => "Artist List",
                'error' => false
            ], 200);
        } else {
            return response([
                'message' => "Artist Not Found",
                'error' => true
            ], 200);
        }
    }

    public function videoSave(Request $request)
    {
        try {

            $validation = Validator::make($request->all(), [
                'name' => 'required',
                'composer_name' => 'required',
                // 'album_id' => 'required',
                'category' => 'required'
               
            ]);
            /* if nearby is 1 
            * order by based on distance and name
            */
            if($validation->fails()){
                $error = $validation->errors()->first();
                return $this->errorResponse($error, 200);
            }
            $user = auth()->user();
            $save = new video();
            $save->name = $request->name;
            $save->category = $request->category;
            $save->composer_name = $request->composer_name;
            if($request->album_id){
                $save->album_id = $request->album_id;

            }
            $save->album_id = $request->album_id;
            $save->artist_id = $user->id;
            if ($request->hasFile('thumbnail')) {
                if ($request->file('thumbnail')->isValid()) {
                    $this->validate($request, [
                        'thumbnail' => 'required|mimes:jpeg,png,jpg'
                    ]);
                    $file = $request->file('thumbnail');
                    $destinationPath = public_path('/uploads/video');
                    //$extension = $file->getClientOriginalExtension('logo');
                    $thumbnail = $file->getClientOriginalName('thumbnail');
                    $thumbnail = rand() . $thumbnail;
                    $request->file('thumbnail')->move($destinationPath, $thumbnail);
                    $save->thumbnail = $thumbnail;
                }
            }
            if ($request->hasFile('video')) {
                if ($request->file('video')->isValid()) {
                    $this->validate($request, [
                        'video' => 'required|mimetypes:video/x-ms-asf,video/x-flv,video/mp4,application/x-mpegURL,video/MP2T,video/3gpp,video/quicktime,video/x-msvideo,video/x-ms-wmv,video/avi'
                    ]);
                    $file = $request->file('video');
                    $destinationPath = public_path('/uploads/video');
                    //$extension = $file->getClientOriginalExtension('logo');
                    $video = $file->getClientOriginalName('video');
                    $video = rand() . $video;
                    $request->file('video')->move($destinationPath, $video);
                    $save->video = $video;
                }
            }
            $save->save();
            $fb_not = new FirebaseNotification();
            $fb_not->title = "New Song";
            $fb_not->message = "New Song ($request->name) Uploaded by $user->name ";
            $fb_not->sent = 0;
            $fb_not->status = 4;
            $fb_not->artist_id = $user->id;
            $fb_not->save();
            if ($save) {
                return response([
                    'data' => $save,
                    'message' => "Video Saved",
                    'error' => false
                ], 200);
            } else {
                return response([
                    'message' => "Video Not Saved",
                    'error' => true
                ], 200);
            }
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'error' => true], 200);
        }
    }

    public function audioList(Request $request)
    {
        try {

            
            $user = auth()->user();

            $offset = $request->offset;
            $data = Audio::where([["artist_id", $user->id], ["audio.status", 1]])
                ->select('audio.*')
                ->selectRaw('datediff(NOW(),created_at)  AS date_difference')
                ->skip($offset)->take(15)->get();
            $total_count = Audio::where([["artist_id", $user->id], ["status", 1]])->get()->count();
            if ($data->isNotEmpty()) {
                return response([
                    'data' => $data,
                    'total_count' => $total_count,
                    'message' => "Audio List",
                    'error' => false
                ], 200);
            } else {
                return response([
                    'message' => "Audio Not Found",
                    'error' => true
                ], 200);
            }
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'error' => true], 200);
        }
    }
    public function audioSearch(Request $request)
    {
        try {

            $validation = Validator::make($request->all(), [
                'search'=>'required'
                
                // 'categories'   =>'required'
            ]);
            /* if nearby is 1 
            * order by based on distance and name
            */
            if($validation->fails()){
                $error = $validation->errors()->first();
                return $this->errorResponse($error, 200);
            }
            $user = auth()->user();
            $search = $request->search;
            $data = Audio::where([["artist_id", $user->id], ["audio.status", 1], ["name", 'like', '%' .$search. '%']])
                ->orWhere([["artist_id", $user->id], ["audio.status", 1]])
                ->select('audio.*')
                ->selectRaw('datediff(NOW(),audio.created_at)  AS date_difference')
                ->get();
            //        $total_count = Audio::where([["artist_id",$user->id],["status",1]])->get()->count();
            if ($data->isNotEmpty()) {
                return response([
                    'data' => $data,
                    //                'total_count' => $total_count,
                    'message' => "Audio List",
                    'error' => false
                ], 200);
            } else {
                return response([
                    'message' => "Audio Not Found",
                    'error' => true
                ], 200);
            }
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'error' => true], 200);
        }
    }
    public function audioSearchAlbum(Request $request)
    {
        try {
            $user = auth()->user();
            $search = $request->search;
            $album = Albums::where([["name", 'like', "%{$search}%"], ["artist_id", $user->id]])->first();
            if ($album) {
                $data = Audio::where([["album_id", $album->id], ["audio.status", 1]])
                    ->select('audio.*')
                    ->selectRaw('datediff(NOW(),created_at)  AS date_difference')
                    ->get();
                //        $total_count = Audio::where([["artist_id",$user->id],["status",1]])->get()->count();
                if ($data->isNotEmpty()) {
                    return response([
                        'data' => $data,
                        //                'total_count' => $total_count,
                        'message' => "Audio List",
                        'error' => false
                    ], 200);
                } else {
                    return response([
                        'message' => "Audio Not Found",
                        'error' => true
                    ], 200);
                }
            } else {
                return response([
                    'message' => "Album Not Found",
                    'error' => true
                ], 200);
            }
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'error' => true], 200);
        }
    }
    public function videoSearchAlbum(Request $request)
    {
        try {

            $validation = Validator::make($request->all(), [
                'search'=>'required'
               
            
            ]);
            if($validation->fails()){
                $error = $validation->errors()->first();
                return $this->errorResponse($error, 200);
            }
            $user = auth()->user();

            $search = $request->search;

            $album = Albums::where([['name', 'like', "%{$search}%"], ['artist_id', $user->id]])->first();

            if ($album) {
                $data = Video::where([['videos.album_id', $album->id], ["videos.status", 1]])
                    ->select('videos.*')
                    ->selectRaw('datediff(NOW(),videos.created_at)  AS date_difference')
                    ->get();
                //        $total_count = Audio::where([["artist_id",$user->id],["status",1]])->get()->count();
                if ($data->isNotEmpty()) {
                    return response([
                        'data' => $data,
                        //                'total_count' => $total_count,
                        'message' => "Video List",
                        'error' => false
                    ], 200);
                } else {
                    return response([
                        'message' => "Video Not Found",
                        'error' => true
                    ], 200);
                }
            } else {
                return response([
                    'message' => "Album Not Found",
                    'error' => true
                ], 200);
            }
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'error' => true], 200);
        }
    }
    public function videoSearchUserAlbum(Request $request)
    {
        try {
            $validation = Validator::make($request->all(), [
                'search'=>'required'
               
            
            ]);
            if($validation->fails()){
                $error = $validation->errors()->first();
                return $this->errorResponse($error, 200);
            }
            $user = auth()->user();
            $search = $request->search;
            $album = Albums::where("name", 'like', "%{$search}%")->first();
            if ($album) {
                $data = Video::where([["album_id", $album->id], ["videos.status", 1]])
                    ->select('videos.*')
                    ->selectRaw('datediff(NOW(),created_at)  AS date_difference')
                    ->get();
                //        $total_count = Audio::where([["artist_id",$user->id],["status",1]])->get()->count();
                if ($data->isNotEmpty()) {
                    foreach ($data as $row) {
                        $found = FavrateVideo::where([["user_id", $user->id], ["video_id", $row->id]])->first();
                        if ($found) {
                            $row["fav"] = 1;
                        } else {
                            $row["fav"] = 0;
                        }
                    }
                    return response([
                        'data' => $data,
                        //                'total_count' => $total_count,
                        'message' => "Video List",
                        'error' => false
                    ], 200);
                } else {
                    return response([
                        'message' => "Video Not Found",
                        'error' => true
                    ], 200);
                }
            } else {
                return response([
                    'message' => "Album Not Found",
                    'error' => true
                ], 200);
            }
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'error' => true], 200);
        }
    }
    public function audioSearchUserAlbum(Request $request)
    {
        try {

            $validation = Validator::make($request->all(), [
                'search'=>'required'
               
            
            ]);
            if($validation->fails()){
                $error = $validation->errors()->first();
                return $this->errorResponse($error, 200);
            }
            $user = auth()->user();
            $search = $request->search;
            $album = Albums::where("name", 'like', "%{$search}%")->first();
         
            if ($album) {
                $data = Audio::where([["audio.album_id", $album->id], ["audio.status", 1]])
                    ->select('audio.*')
                    ->selectRaw('datediff(NOW(),created_at)  AS date_difference')
                    ->get();
                //        $total_count = Audio::where([["artist_id",$user->id],["status",1]])->get()->count();
                if ($data->isNotEmpty()) {
                    foreach ($data as $row) {
                        $found = FavrateAudio::where([["user_id", $user->id], ["audio_id", $row->id]])->first();
                        if ($found) {
                            $row["fav"] = 1;
                        } else {
                            $row["fav"] = 0;
                        }
                    }
                    return response([
                        'data' => $data,
                        //                'total_count' => $total_count,
                        'message' => "Video List",
                        'error' => false
                    ], 200);
                } else {
                    return response([
                        'message' => "Audio Not Found",
                        'error' => true
                    ], 200);
                }
            } else {
                return response([
                    'message' => "Album Not Found",
                    'error' => true
                ], 200);
            }
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'error' => true], 200);
        }
    }
    public function videoSearchArtist(Request $request)
    {
        try {
            $validation = Validator::make($request->all(), [
                'search'=>'required',
              
                // 'categories'   =>'required'
            ]);
            /* if nearby is 1 
            * order by based on distance and name
            */
            if($validation->fails()){
                $error = $validation->errors()->first();
                return $this->errorResponse($error, 200);
            }
            $user = auth()->user();
          
            $search = $request->search;
          
            $artist = Artist::where("name", 'like', "%{$search}%")->first();
       
          
           

         
            if ($artist) {
                $data = Video::where([["artist_id", $artist->id], ["videos.status", 1]])
                    ->select('videos.*')
                    ->selectRaw('datediff(NOW(),created_at)  AS date_difference')
                    ->get();
                //        $total_count = Audio::where([["artist_id",$user->id],["status",1]])->get()->count();
                if ($data->isNotEmpty()) {
                    foreach ($data as $row) {
                        $found = FavrateVideo::where([["user_id", $user->id], ["video_id", $row->id]])->first();
                        if ($found) {
                            $row["fav"] = 1;
                        } else {
                            $row["fav"] = 0;
                        }
                    }
                    return response([
                        'data' => $data,
                        //                'total_count' => $total_count,
                        'message' => "Video List",
                        'error' => false
                    ], 200);
                } else {
                    return response([
                        'message' => "Video Not Found",
                        'error' => true
                    ], 200);
                }
            } else {
                return response([
                    'message' => "Artist Not Found",
                    'error' => true
                ], 200);
            }
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'error' => true], 200);
        }
    }
    public function audioSearchArtist(Request $request)
    {
        try {
            $validation = Validator::make($request->all(), [
                'search'=>'required',
              
                // 'categories'   =>'required'
            ]);
            /* if nearby is 1 
            * order by based on distance and name
            */
            if($validation->fails()){
                $error = $validation->errors()->first();
                return $this->errorResponse($error, 200);
            }
            $user = auth()->user();
            $search = $request->search;
            $artist = Artist::where("name", 'like', "%{$search}%")->first();

            if ($artist) {
                $data = Audio::where([["artist_id", $artist->id], ["audio.status", 1]])
                    ->select('audio.*')
                    ->selectRaw('datediff(NOW(),created_at)  AS date_difference')
                    ->get();
                //        $total_count = Audio::where([["artist_id",$user->id],["status",1]])->get()->count();
                if ($data->isNotEmpty()) {
                    foreach ($data as $row) {
                        $found = FavrateAudio::where([["user_id", $user->id], ["audio_id", $row->id]])->first();
                        if ($found) {
                            $row["fav"] = 1;
                        } else {
                            $row["fav"] = 0;
                        }
                    }
                    return response([
                        'data' => $data,
                        //                'total_count' => $total_count,
                        'message' => "Audio List",
                        'error' => false
                    ], 200);
                } else {
                    return response([
                        'message' => "Audio Not Found",
                        'error' => true
                    ], 200);
                }
            } else {
                return response([
                    'message' => "Artist Not Found",
                    'error' => true
                ], 200);
            }
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'error' => true], 200);
        }
    }

    public function audioSearchName(Request $request)
    {
        try {
            $validation = Validator::make($request->all(), [
                'search'=>'required',
              
                // 'categories'   =>'required'
            ]);
            /* if nearby is 1 
            * order by based on distance and name
            */
            if($validation->fails()){
                $error = $validation->errors()->first();
                return $this->errorResponse($error, 200);
            }
            $user = auth()->user();
            $search = $request->search;

            $data = Audio::where([['audio.name', 'like', '%' . $search . '%'], ["audio.status", 1]])
                //                    ->orWhere('licenseNumber','like','%'.$search.'%')
                ->orWhereHas('artist', function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                })
                ->join('artists', 'audio.artist_id', '=', 'artists.id')
                ->select('audio.*')
                ->selectRaw('datediff(NOW(),audio.created_at)  AS date_difference')
                ->selectRaw('artists.name AS artist_name')
                ->get();

            //        $total_count = Audio::where([["artist_id",$user->id],["status",1]])->get()->count();
            if ($data->isNotEmpty()) {
                foreach ($data as $row) {
                    $found = FavrateAudio::where([["user_id", $user->id], ["audio_id", $row->id]])->first();
                    if ($found) {
                        $row["fav"] = 1;
                    } else {
                        $row["fav"] = 0;
                    }
                }
                return response([
                    'data' => $data,
                    //                'total_count' => $total_count,
                    'message' => "Audio List",
                    'error' => false
                ], 200);
            } else {
                return response([
                    'message' => "Audio Not Found",
                    'error' => true
                ], 200);
            }
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'error' => true], 200);
        }
   
    }
    public function audioSearchNameCat(Request $request)
    {
        try {
            $validation = Validator::make($request->all(), [
                'search'=>'required',
                'category' => 'required'
              
                // 'categories'   =>'required'
            ]);
            /* if nearby is 1 
            * order by based on distance and name
            */
            if($validation->fails()){
                $error = $validation->errors()->first();
                return $this->errorResponse($error, 200);
            }

            $user = auth()->user();
            $search = $request->search;
            $category = $request->category;

            $data = Audio::where([['audio.name', 'like', '%' . $search . '%'], ["audio.status", 1], ["category", $category]])
                //                    ->orWhere('licenseNumber','like','%'.$search.'%')
                ->orWhereHas('artist', function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                })
                ->join('artists', 'audio.artist_id', '=', 'artists.id')
                ->select('audio.*')
                ->selectRaw('datediff(NOW(),audio.created_at)  AS date_difference')
                ->selectRaw('artists.name AS artist_name')
                ->get();

            //        $total_count = Audio::where([["artist_id",$user->id],["status",1]])->get()->count();
            if ($data->isNotEmpty()) {
                foreach ($data as $row) {
                    $found = FavrateAudio::where([["user_id", $user->id], ["audio_id", $row->id]])->first();
                    if ($found) {
                        $row["fav"] = 1;
                    } else {
                        $row["fav"] = 0;
                    }
                }
                return response([
                    'data' => $data,
                    //                'total_count' => $total_count,
                    'message' => "Audio List",
                    'error' => false
                ], 200);
            } else {
                return response([
                    'message' => "Audio Not Found",
                    'error' => true
                ], 200);
            }
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'error' => true], 200);
        }
    }
    public function audioSearchCategory(Request $request)
    {
        try {
            $validation = Validator::make($request->all(), [
                'search'=>'required'
              
              
                // 'categories'   =>'required'
            ]);
            /* if nearby is 1 
            * order by based on distance and name
            */
            if($validation->fails()){
                $error = $validation->errors()->first();
                return $this->errorResponse($error, 200);
            }
            $user = auth()->user();
            $search = $request->search;
            if (!$search) {
                return response([
                    'message' => "Select Category First",
                    'error' => true
                ], 200);
            }
            $data = Audio::where([['category', $search], ["audio.status", 1]])
                ->select('audio.*')
                ->selectRaw('datediff(NOW(),created_at)  AS date_difference')
                ->get();
            //        $total_count = Audio::where([["artist_id",$user->id],["status",1]])->get()->count();
            if ($data->isNotEmpty()) {
                foreach ($data as $row) {
                    $found = FavrateAudio::where([["user_id", $user->id], ["audio_id", $row->id]])->first();
                    if ($found) {
                        $row["fav"] = 1;
                    } else {
                        $row["fav"] = 0;
                    }
                }
                return response([
                    'data' => $data,
                    //                'total_count' => $total_count,
                    'message' => "Audio List",
                    'error' => false
                ], 200);
            } else {
                return response([
                    'message' => "Audio Not Found",
                    'error' => true
                ], 200);
            }
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'error' => true], 200);
        }
    }
    public function videoSearchName(Request $request)
    {
        try {
            $validation = Validator::make($request->all(), [
                'search'=>'required',
                
                // 'categories'   =>'required'
            ]);
            /* if nearby is 1 
            * order by based on distance and name
            */
            if($validation->fails()){
                $error = $validation->errors()->first();
                return $this->errorResponse($error, 200);
            }
            $user = auth()->user();
            $search = $request->search;

            $data = Video::where([['videos.name', 'like', '%' . $search . '%'], ["videos.status", 1]])
                //                    ->orWhere('licenseNumber','like','%'.$search.'%')
                ->orWhereHas('artist', function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                })
                ->join('artists', 'videos.artist_id', '=', 'artists.id')
                ->select('videos.*')
                ->selectRaw('datediff(NOW(),videos.created_at)  AS date_difference')
                ->selectRaw('artists.name AS artist_name')
                ->get();


            //        $total_count = Audio::where([["artist_id",$user->id],["status",1]])->get()->count();
            if ($data->isNotEmpty()) {
                foreach ($data as $row) {
                    $found = FavrateVideo::where([["user_id", $user->id], ["video_id", $row->id]])->first();
                    if ($found) {
                        $row["fav"] = 1;
                    } else {
                        $row["fav"] = 0;
                    }
                }
                return response([
                    'data' => $data,
                    //                'total_count' => $total_count,
                    'message' => "Video List",
                    'error' => false
                ], 200);
            } else {
                return response([
                    'message' => "Video Not Found",
                    'error' => true
                ], 200);
            }
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'error' => true], 200);
        }
    }
    public function videoSearchNameCat(Request $request)
    {
        try {
            $validation = Validator::make($request->all(), [
                'search'=>'required',
                
                // 'categories'   =>'required'
            ]);
            /* if nearby is 1 
            * order by based on distance and name
            */
            if($validation->fails()){
                $error = $validation->errors()->first();
                return $this->errorResponse($error, 200);
            }
            $user = auth()->user();
            $search = $request->search;
            $category = $request->search;

            $data = Video::where([['videos.name', 'like', '%' . $search . '%'], ["videos.status", 1], ["category", $category]])
                //                    ->orWhere('licenseNumber','like','%'.$search.'%')
                ->orWhereHas('artist', function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                })
                ->join('artists', 'videos.artist_id', '=', 'artists.id')
                ->select('videos.*')
                ->selectRaw('datediff(NOW(),videos.created_at)  AS date_difference')
                ->selectRaw('artists.name AS artist_name')
                ->get();


            //        $total_count = Audio::where([["artist_id",$user->id],["status",1]])->get()->count();
            if ($data->isNotEmpty()) {
                foreach ($data as $row) {
                    $found = FavrateVideo::where([["user_id", $user->id], ["video_id", $row->id]])->first();
                    if ($found) {
                        $row["fav"] = 1;
                    } else {
                        $row["fav"] = 0;
                    }
                }
                return response([
                    'data' => $data,
                    //                'total_count' => $total_count,
                    'message' => "Video List",
                    'error' => false
                ], 200);
            } else {
                return response([
                    'message' => "Video Not Found",
                    'error' => true
                ], 200);
            }
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'error' => true], 200);
        }
    }
    public function videoSearchCategory(Request $request)
    {
        try {

            $validation = Validator::make($request->all(), [
                'search'=>'required',
                
                // 'categories'   =>'required'
            ]);
            /* if nearby is 1 
            * order by based on distance and name
            */
            if($validation->fails()){
                $error = $validation->errors()->first();
                return $this->errorResponse($error, 200);
            }
            $user = auth()->user();
            $search = $request->search;
            $search = $request->search;
            if (!$search) {
                return response([
                    'message' => "Select Category First",
                    'error' => true
                ], 200);
            }
            $data = Video::where([["category", $search], ["videos.status", 1]])
                ->select('videos.*')
                ->selectRaw('datediff(NOW(),created_at)  AS date_difference')
                ->get();
            //        $total_count = Audio::where([["artist_id",$user->id],["status",1]])->get()->count();
            if ($data->isNotEmpty()) {
                foreach ($data as $row) {
                    $found = FavrateVideo::where([["user_id", $user->id], ["video_id", $row->id]])->first();
                    if ($found) {
                        $row["fav"] = 1;
                    } else {
                        $row["fav"] = 0;
                    }
                }
                return response([
                    'data' => $data,
                    //                'total_count' => $total_count,
                    'message' => "Video List",
                    'error' => false
                ], 200);
            } else {
                return response([
                    'message' => "Video Not Found",
                    'error' => true
                ], 200);
            }
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'error' => true], 200);
        }
    }

    public function audioSave(Request $request)
    {
        try {

            $validation = Validator::make($request->all(), [
                'name' => 'required',
                'composer_name' => 'required',
                // 'album_id' => 'required',
                'category' => 'required'
       
            
            ]);
            if($validation->fails()){
                $error = $validation->errors()->first();
                return $this->errorResponse($error, 200);
            }
            $user = auth()->user();

               

            $save = new Audio();
            $save->name = $request->name;
            $save->category = $request->category;
            $save->composer_name = $request->composer_name;
            if($request->album_id){
             $save->album_id = $request->album_id;

            }
            $save->album_id = $request->album_id;
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
                        'audio' => 'required|mimes:mpga,wav,mp3,mp4'
                    ]);
                    $file = $request->file('audio');
                    $destinationPath = public_path('/uploads/audio');
                    //$extension = $file->getClientOriginalExtension('logo');
                    $audio = $file->getClientOriginalName('audio');
                    $audio = rand() . $audio;
                    $request->file('audio')->move($destinationPath, $audio);
                    $save->audio = $audio;
                }
            }
            $save->save();
            $fb_not = new FirebaseNotification();
            $fb_not->title = "New Song";
            $fb_not->message = "New Song ($request->name) Uploaded by $user->name ";
            $fb_not->sent = 0;
            $fb_not->status = 3;
            $fb_not->artist_id = $user->id;
            $fb_not->save();

            if ($save) {
                return response([
                    'data' => $save,
                    'message' => "Audio Saved",
                    'error' => false
                ], 200);
            } else {
                return response([
                    'message' => "Audio Not Saved",
                    'error' => true
                ], 200);
            }
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'error' => true], 200);
        }
    }
    public function imageList(Request $request)
    {
        $user = auth()->user();
        $offset = $request->offset;
        $data = Image::where([["artist_id", $user->id], ["images.status", 1]])
            ->select('images.*')
            ->selectRaw('datediff(NOW(),created_at)  AS date_difference')
            ->skip($offset)->take(15)->get();
        $total_count = Image::where([["artist_id", $user->id], ["status", 1]])->get()->count();
        if ($data->isNotEmpty()) {
            return response([
                'data' => $data,
                'total_count' => $total_count,
                'message' => "Image List",
                'error' => false
            ], 200);
        } else {
            return response([
                'message' => "Image Not Found",
                'error' => true
            ], 200);
        }
    }
    public function eventList(Request $request)
    {
        try {
            $user = auth()->user();
            $offset = $request->offset;
            $data = Event::where([["artist_id", $user->id], ["events.status", 1]])
                ->select('events.*')
                ->selectRaw('datediff(NOW(),created_at)  AS date_difference')
                ->skip($offset)->take(15)->get();
            $total_count = Event::where([["artist_id", $user->id], ["status", 1]])->get()->count();
            if ($data->isNotEmpty()) {
                return response([
                    'data' => $data,
                    'total_count' => $total_count,
                    'message' => "Event List",
                    'error' => false
                ], 200);
            } else {
                return response([
                    'message' => "Event Not Found",
                    'error' => true
                ], 200);
            }
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'error' => true], 200);
        }
    }
    public function categories()
    {

        $data = Category::all();

        if ($data->isNotEmpty()) {
            return response([
                'data' => $data,
                'message' => "Categories List",
                'error' => false
            ], 200);
        } else {
            return response([
                'message' => "Categories Not Found",
                'error' => true
            ], 200);
        }
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
}
