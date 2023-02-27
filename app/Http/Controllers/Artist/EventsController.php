<?php

namespace App\Http\Controllers\Artist;

use App\Albums;
use App\Category;
use App\Event;
use App\Http\Controllers\Controller;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Event::where("artist_id", Auth::id())->get();
        return view("artist.events.index", ["data" => $data]);
    }

    public function search(Request $request)
    {
        $search = $request->search;

        $data = Event::where([["artist_id", Auth::id()], ['name', 'like', "%{$search}%"]])
            ->orWhere([["artist_id", Auth::id()], ['composer_name', 'like', "%{$search}%"]])
            ->get();

        return view("artist.events.index", ["data" => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $albums = Albums::where("artist_id", Auth::id())->get();
        return view("artist.events.create", ["categories" => $categories, "albums" => $albums]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'image' => 'required',
            'name' => 'required',
            'venue' => 'required'
       

        ]);

        try {
            DB::beginTransaction();
            $user = Auth::user();
            $event = new Event();
            $event->name = $request->name;
            $event->venue = $request->venue;
            $event->description = $request->description;
            $date = $request->date;

            $time = $request->time;
            $event->date_time = date('Y-m-d H:i:s', strtotime("$date $time"));

            $event->artist_id = $user->id;
            // dd($event);
            if ($request->hasFile('image')) {
                if ($request->file('image')->isValid()) {
                    $this->validate($request, [
                        'image' => 'required|mimes:jpeg,png,jpg'
                    ]);
                    $file = $request->file('image');
                    $destinationPath = public_path('/uploads/image');
                    //$extension = $file->getClientOriginalExtension('logo');
                    $image = $file->getClientOriginalName('image');
                    $image = rand() . $image;
                    $request->file('image')->move($destinationPath, $image);
                    $event->image = $image;
                }
            }

            $event->save();
            
            Session::flash('success_message', 'Great! Event has been Created successfully!');
            DB::commit();
            return redirect()->back();
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error_message', $th->getMessage());
        }
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

    public function eventDetail($id)
    {
        $event = Event::find($id);


        return view('artist.events.event_detail', ['title' => 'Event Detail', 'event' => $event]);
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
        $album = Event::find($id);

        if ($album) {
            $album->delete();
            return response()->json(['status' => true, 'msg' => 'Event has been deleted']);
        } else {
            return response()->json(['status' => false, 'msg' => 'Event  not Found']);
        }
    }
}
