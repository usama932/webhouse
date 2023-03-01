<?php

namespace App\Http\Controllers\User;

use App\Albums;
use App\Category;
use App\Event;
use App\FaverateEvent;
use App\Http\Controllers\Controller;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class EventController extends Controller
{
    public function events(){
        $data = Event::latest()->paginate(10);
        return view("user.events.index", ["data" => $data]);
    }
    public function fav_events(){
        $user_id = Auth::id();
        $data = FaverateEvent::where('user_id' ,$user_id)->with('event')
                                ->join('events','faverate_events.event_id','=','events.id')
                                ->select(
                                    'faverate_events.id',
                                    'events.name',
                                    'events.image',
                                    'events.venue',
                                    'events.date_time',
                                    'events.status',
                                    'events.created_at',
                                  
                                )
                                ->latest()->paginate(10);
        return view("user.events.fav_events", ["data" => $data]);
    }
    public function eventsearch(Request $request)
    {
        $user_id = Auth::id();
        $fav = $request->fav;
        $search = $request->search;
        
        if($fav == 0){
            $data = Event::where('name', 'like', "%{$search}%")
            ->get();

            return view("user.events.index", ["data" => $data]);    
        }
        elseif($fav == 1){
            $data = FaverateEvent::where('user_id' ,$user_id)->with('event')
                                ->join('events','faverate_events.event_id','=','events.id')
                                ->select(
                                    'faverate_events.id',
                                    'events.name',
                                    'events.image',
                                    'events.venue',
                                    'events.date_time',
                                    'events.status',
                                    'events.created_at',
                                  
                                )
                                ->where('events.name' ,'like',"%{$search}%")
                                ->latest()->paginate(10);
                                return view("user.events.fav_events", ["data" => $data]);
        }
        return redirect()->back();
       
    }
    public function eventDetail($id)
    {
        $event = Event::find($id);


        return view('user.events.event_detail', ['title' => 'Event Detail', 'event' => $event]);
    }
    public function favourEvent($id){
       
        $user_id = Auth::id();
        $save = FaverateEvent::where([["event_id", $id], ["user_id", $user_id]])->first();
        if(empty($save)){
            $event = new FaverateEvent();
            $event->user_id = $user_id;
            $event->event_id = $id;
            $event->save();

            return response()->json(['status' => true, 'msg' => 'Added to Favourite']);
        }
        else{
            return response()->json(['status' => true, 'msg' => 'Already Added']);
        }
   
    }
    public function unfavourEvent($id){
       
        $user_id = Auth::id();
        $event = FaverateEvent::find($id);
      
        if(!empty($event)){
            $event->delete();
            return response()->json(['status' => true, 'msg' => 'Added to unwanted']);
        }
        return response()->json(['status' => true, 'msg' => 'Not found event']);


        return response()->json(['status' => true, 'msg' => 'Added to Favourite']);
    }

}
