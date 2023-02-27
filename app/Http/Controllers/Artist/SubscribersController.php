<?php

namespace App\Http\Controllers\Artist;

use App\ArtistSubscribe;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class SubscribersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $subscribers = ArtistSubscribe::where([["artist_id", Auth::id()], ['status', 1]])->with('users')->get();
        $requests = ArtistSubscribe::where([["artist_id", Auth::id()], ['status', 0]])->with('users')->get();
        $subscriber = 'active';
        $request ='';

        return view("artist.subscribers.index", ["subscribers" => $subscribers, "requests" => $requests,"subscriber" => $subscriber, "request" => $request]);
    }

    public function unSubscribe($id)
    {
       
        $subscribe = ArtistSubscribe::findOrFail($id);

        if($subscribe){
              $subscribe->delete();
              return response()->json(['status' => true, 'msg' => 'User has been Unsubscribed']);
          } else {
              return response()->json(['status' => false, 'msg' => 'User has  been Unsubscribed']);
          }
    }

    public function accept($id)
    {
       
        $subscribe = ArtistSubscribe::findOrFail($id);

        if($subscribe){
              $subscribe->status = 1;
              $subscribe->save();
              return response()->json(['status' => true, 'msg' => 'Subscription has been Accepted']);
          } else {
              return response()->json(['status' => false, 'msg' => 'Subscription not found']);
          }
    }

    public function reject($id)
    {
       
        $subscribe = ArtistSubscribe::findOrFail($id);

        if($subscribe){
              $subscribe->status = 0;
              $subscribe->save();
              return response()->json(['status' => true, 'msg' => 'Subscription has been Rejected']);
          } else {
              return response()->json(['status' => false, 'msg' => 'Subscription not found']);
          }
    }
    


    public function subscribeSearch(Request $request)
    {

        $search = $request->search;
        $subscribers = ArtistSubscribe::join('users', 'users.id', '=', 'artist_subscribes.user_id')
        ->select('artist_subscribes.*', 'users.*')
        ->where([["artist_subscribes.artist_id", Auth::id()],["artist_subscribes.status", 1], ['users.name', 'like', "%{$search}%"]])
            ->orWhere([["artist_subscribes.artist_id", Auth::id()], ['users.email', 'like', "%{$search}%"]])
            ->with('users')
            ->get();

        $requests = ArtistSubscribe::where([["artist_id", Auth::id()], ['status', 0]])->with('users')->get();

        $subscriber = 'active';
        $request ='';
        return view("artist.subscribers.index", ["subscribers" => $subscribers, "requests" => $requests,"subscriber" => $subscriber, "request" => $request]);
    }

    public function requestSearch(Request $request)
    {

        $search = $request->search;
        $subscribers = ArtistSubscribe::join('users', 'users.id', '=', 'artist_subscribes.user_id')
        ->select('artist_subscribes.*', 'users.*')
        ->where([["artist_subscribes.artist_id", Auth::id()],["artist_subscribes.status", 0], ['users.name', 'like', "%{$search}%"]])
            ->orWhere([["artist_subscribes.artist_id", Auth::id()], ['users.email', 'like', "%{$search}%"]])
            ->with('users')
            ->get();
           
        $requests = ArtistSubscribe::where([["artist_id", Auth::id()], ['status', 0]])->with('users')->get();
        $subscriber = '';
        $request ='active';
         
        return view("artist.subscribers.index", ["subscribers" => $subscribers, "requests" => $requests,"subscriber" => $subscriber, "request" => $request]);
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
    // public function store(Request $request)
    // {


    //     $this->validate($request, [
    //         'name' => 'required',
    //         'image' => 'required',
    //         'description' => 'required'

    //     ]);

    //     try {
    //         DB::beginTransaction();
    //         $user = Auth::user();
    //         $album = new Albums();
    //         $album->name = $request->name;
    //         $album->description = $request->description;

    //         $album->artist_id = $user->id;

    //         if ($request->hasFile('image')) {
    //             if ($request->file('image')->isValid()) {
    //                 $this->validate($request, [
    //                     'image' => 'required|mimes:jpeg,png,jpg'
    //                 ]);
    //                 $file = $request->file('image');
    //                 $destinationPath = public_path('/uploads/album');
    //                 //$extension = $file->getClientOriginalExtension('logo');
    //                 $thumbnail = $file->getClientOriginalName('image');
    //                 $thumbnail = rand() . $thumbnail;
    //                 $request->file('image')->move($destinationPath, $thumbnail);
    //                 $album->image = $thumbnail;
    //             }
    //         }

    //         $album->save();


    //         Session::flash('success_message', 'Great! Album has been saved successfully!');
    //         DB::commit();
    //         return redirect()->back();
    //     } catch (\Throwable $th) {
    //         DB::rollBack();
    //         return redirect()->back()->with('error_message', $th->getMessage());
    //     }
    // }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
    //     $user = Auth::user();
    //     // $album_id =Albums::find($id)->pluck('id')->first();

    //     $album_id = $id;

    //     $audios = Audio::where([['artist_id', $user->id], ['album_id', $id]])->get();

    //     $videos = Video::where([['artist_id', $user->id], ['album_id', $id]])->get();
    //     $videoActive = '';
    //     $audioActive = 'active';
    //     return view("artist.albums.albums", compact('audios', 'videos', 'album_id', 'videoActive', 'audioActive'));
    // }

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
    // public function destroy($id)
    // {
    //     $album = Albums::findOrFail($id);

    //     if ($album) {
    //         $album->delete();
    //         return response()->json(['status' => true, 'msg' => 'Album has been deleted']);
    //     } else {
    //         return response()->json(['status' => false, 'msg' => 'Album has  not Found']);
    //     }
    // }
}
