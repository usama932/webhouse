<?php
namespace App\Http\Controllers\Admin;

use App\Albums;
use App\Artist;
use App\ArtistSubscribe;
use App\Audio;
use App\CronJob;
use App\Event;
use App\FavrateAudio;
use App\FavrateVideo;
use App\Http\Controllers\Controller;
use App\Image;
use App\Permission;
use App\User;
use App\Video;
use Auth;
use Datatables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Mail;

class ArtistsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $obj_user;

    public function __construct(Artist $userObject)
    {
        $this->middleware('auth:admin');
        $this->obj_user = $userObject;
    }

    public function index()
    {

        return view('admin.artists.index', ['title' => 'Registered users List']);
    }
    public function getUsers(Request $request){
        $columns = array(
            0 => 'id',
            1 => 'name',
            2 => 'email',
            3 => 'status',
            4 => 'created_at',
            5 => 'action'
        );

        $totalData = Artist::count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if(empty($request->input('search.value'))){
            $users = Artist::offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();
            $totalFiltered = Artist::count();
        }else{
            $search = $request->input('search.value');
            $users = Artist::where('name', 'like', "%{$search}%")
                ->orWhere('email','like',"%{$search}%")
                ->orWhere('created_at','like',"%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            $totalFiltered = Artist::where('name', 'like', "%{$search}%")
                ->orWhere('email','like',"%{$search}%")
                ->count();
        }


        $data = array();

        if($users){
            foreach($users as $r){
                $edit_url = route('artists.edit',$r->id);
                $events_url = route('artist-events',$r->id);
                $videos_url = route('artist-videos',$r->id);
                $audios_url = route('artist-audios',$r->id);
                $albums_url = route('artist-albums',$r->id);
                $images_url = route('artist-images',$r->id);
                $nestedData['id'] = '
                                <td>
                                <div class="checkbox checkbox-success m-0">
                                        <input id="checkbox3" type="checkbox" name="artists[]" value="'.$r->id.'">
                                        <label for="checkbox3"></label>
                                    </div>
                                </td>
                            ';
                $nestedData['name'] = $r->name;
                $nestedData['email'] = $r->email;
                if($r->active){
                    $nestedData['active'] = '<span class="btn btn-xs btn-success">Active</span>';
                }else{
                    $nestedData['active'] = '<span class="btn btn-xs btn-warning">Inactive</span>';
                }

                $nestedData['created_at'] = date('d-m-Y',strtotime($r->created_at));
                $nestedData['action'] = '
                                <div>
                                <td>
                                    <a class="btn btn-info btn-circle" onclick="event.preventDefault();viewInfo('.$r->id.');" title="View User" href="javascript:void(0)">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a title="Edit User" class="btn btn-success btn-circle"
                                       href="'.$edit_url.'">
                                       <i class="fa fa-edit"></i>
                                    </a>
                                    <a title="events" class="btn btn-primary btn-circle"
                                       href="'.$events_url.'">
                                       <i class="fa fa-calendar"></i>
                                    </a>
                                    <a title="videos" class="btn btn-primary btn-circle"
                                       href="'.$videos_url.'">
                                       <i class="fa fa-video-camera"></i>
                                    </a>
                                    <a title="audios" class="btn btn-primary btn-circle"
                                       href="'.$audios_url.'">
                                       <i class="fa fa-file-audio-o"></i>
                                    </a>
                                    <a title="albums" class="btn btn-primary btn-circle"
                                       href="'.$albums_url.'">
                                       <i class="fa fa-file-image-o"></i>
                                    </a>
                                    <a title="images" class="btn btn-primary btn-circle"
                                       href="'.$images_url.'">
                                       <i class="fa fa-image"></i>
                                    </a>
                                    <a class="btn btn-danger btn-circle" onclick="event.preventDefault();del('.$r->id.');" title="Delete User" href="javascript:void(0)">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                                </div>
                            ';
                $data[] = $nestedData;
            }
        }

        $json_data = array(
            "draw"			=> intval($request->input('draw')),
            "recordsTotal"	=> intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"			=> $data
        );

        echo json_encode($json_data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.artists.create', ['title' => 'Registere User']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:6',
        ]);

        $input = $request->all();
        $user = new Artist();
        $user->name = $input['name'];
        $user->email = $input['email'];
        $user->phone = $input['phone'];
        $user->gender = $input['gender'];
        $user->facebook_link = $input['facebook_link'];
        $user->youtube_link = $input['youtube_link'];
        $user->instagram_link = $input['instagram_link'];
        $user->twitter_link = $input['twitter_link'];
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
        if ($request->hasFile('cover_photo')) {
            if ($request->file('cover_photo')->isValid()) {
                $this->validate($request, [
                    'cover_photo' => 'required|image|mimes:jpeg,png,jpg'
                ]);
                $file = $request->file('cover_photo');
                $destinationPath = public_path('/uploads');
                //$extension = $file->getClientOriginalExtension('logo');
                $image = $file->getClientOriginalName('cover_photo');
                $image = rand().$image;
                $request->file('cover_photo')->move($destinationPath, $image);
                $user->cover_photo= $image;

            }
        }
        $res = array_key_exists('active', $input);
        if ($res == false) {
            $user->active = 0;
        } else {
            $user->active = 1;

        }
        $res = array_key_exists('feature', $input);
        if ($res == false) {
            $user->feature = 0;
        } else {
            $user->feature = 1;

        }
        $user->password = bcrypt($input['password']);
        $user->save();

        Session::flash('success_message', 'Great! Artist has been saved successfully!');
        $user->save();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->obj_user->findOrFail($id);
        return view('admin.artists.profile-setting', ['title' => 'Edit Profile'])->withUser($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $user = $this->obj_user->findOrFail($id);



        return view('admin.artists.edit', ['title' => 'Update User Details'])->withUser($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = $this->obj_user->findOrFail($id);
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|unique:users,email,'.$id,
        ]);
        $input = $request->all();

        $user->name = $input['name'];
        $user->email = $input['email'];
        $user->phone = $input['phone'];
        $user->gender = $input['gender'];
        $user->facebook_link = $input['facebook_link'];
        $user->youtube_link = $input['youtube_link'];
        $user->instagram_link = $input['instagram_link'];
        $user->twitter_link = $input['twitter_link'];
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
        if ($request->hasFile('cover_photo')) {
            if ($request->file('cover_photo')->isValid()) {
                $this->validate($request, [
                    'cover_photo' => 'required|image|mimes:jpeg,png,jpg'
                ]);
                $file = $request->file('cover_photo');
                $destinationPath = public_path('/uploads');
                //$extension = $file->getClientOriginalExtension('logo');
                $image = $file->getClientOriginalName('cover_photo');
                $image = rand().$image;
                $request->file('cover_photo')->move($destinationPath, $image);
                $user->cover_photo= $image;

            }
        }
        $res = array_key_exists('active', $input);
        if ($res == false) {
            $user->active = 0;
        } else {
            $user->active = 1;

        }
        $res = array_key_exists('feature', $input);
        if ($res == false) {
            $user->feature = 0;
        } else {
            $user->feature = 1;

        }
        if(!empty($input['password'])) {
            $user->password = bcrypt($input['password']);
        }

        $user->save();

        Session::flash('success_message', 'Great! Artist successfully updated!');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $albums = Albums::where("artist_id",$id)->get();
        foreach ($albums as $album){
            $videos = Video::where("album_id",$album->id)->get();
            foreach ($videos as $video){
                $fav_videos = FavrateVideo::where("video_id",$video->id)->get();
                foreach ($fav_videos as $fav_video){
                    $fav_video->delete();
                }
                $video->delete();
            }
            $audios = Audio::where("album_id",$album->id)->get();
            foreach ($audios as $audio){
                $fav_audios = FavrateAudio::where("audio_id",$audio->id)->get();
                foreach ($fav_audios as $fav_audio){
                    $fav_audio->delete();
                }
                $audio->delete();
            }
            $album->delete();
        }
        $events = Event::where("artist_id",$id)->get();
        foreach ($events as $event){
            $event->delete();
        }
        $audios = Audio::where("artist_id",$id)->get();
        foreach ($audios as $audio){
            $audio->delete();
        }
        $videos = Video::where("artist_id",$id)->get();
        foreach ($videos as $video){
            $video->delete();
        }
        $images = Image::where("artist_id",$id)->get();
        foreach ($images as $image){
            $image->delete();
        }
        $subs = ArtistSubscribe::where("artist_id",$id)->get();
        foreach ($subs as $sub){
            $sub->delete();
        }
        $user = $this->obj_user->findOrFail($id);
        $user->delete();
        Session::flash('success_message', 'Artist successfully deleted!');
        return redirect()->route('artists.index');
    }
    public function events($id)
    {
        $user = $this->obj_user->findOrFail($id);
        return view('admin.artists.events', ['title' => 'User Detail', 'user' => $user]);
    }
    public function event($id)
    {
        $user = Event::findOrFail($id);
        return view('admin.artists.event', ['title' => 'User Detail', 'user' => $user]);
    }
    public function eventStatus(Request $request)
    {
        $user = Event::findOrFail($request->id);
        $user->status = $request->status;
        $user->save();
        Session::flash('success_message', 'Great! Status has been updated successfully!');
        return redirect()->back();
    }
    public function albums($id)
    {
        $user = $this->obj_user->findOrFail($id);
        return view('admin.artists.albums', ['title' => 'User Detail', 'user' => $user]);
    }
    public function album($id)
    {
        $user = Albums::findOrFail($id);
        return view('admin.artists.album', ['title' => 'User Detail', 'user' => $user]);
    }
    public function albumStatus(Request $request)
    {
        $user = Albums::findOrFail($request->id);
        $user->status = $request->status;
        $user->save();
        Session::flash('success_message', 'Great! Status has been updated successfully!');

        return redirect()->back();
    }
    public function videos($id)
    {
        $user = $this->obj_user->findOrFail($id);
        return view('admin.artists.videos', ['title' => 'User Detail', 'user' => $user]);
    }
    public function video($id)
    {
        $user = Video::findOrFail($id);
        return view('admin.artists.video', ['title' => 'User Detail', 'user' => $user]);
    }
    public function videoStatus(Request $request)
    {
        $user = Video::findOrFail($request->id);
        $user->status = $request->status;
        $user->save();
        Session::flash('success_message', 'Great! Status has been updated successfully!');

        return redirect()->back();
    }
    public function audios($id)
    {
        $user = $this->obj_user->findOrFail($id);
        return view('admin.artists.audios', ['title' => 'User Detail', 'user' => $user]);
    }
    public function audio($id)
    {
        $user = Audio::findOrFail($id);
        return view('admin.artists.audio', ['title' => 'User Detail', 'user' => $user]);
    }
    public function audioStatus(Request $request)
    {
        $user = Audio::findOrFail($request->id);
        $user->status = $request->status;
        $user->save();
        Session::flash('success_message', 'Great! Status has been updated successfully!');
        return redirect()->back();
    }
    public function images($id)
    {
        $user = $this->obj_user->findOrFail($id);
        return view('admin.artists.images', ['title' => 'User Detail', 'user' => $user]);
    }
    public function image($id)
    {
        $user = Image::findOrFail($id);
        return view('admin.artists.image', ['title' => 'User Detail', 'user' => $user]);
    }
    public function imageStatus(Request $request)
    {
        $user = Image::findOrFail($request->id);
        $user->status = $request->status;
        $user->save();
        Session::flash('success_message', 'Great! Status has been updated successfully!');
        return redirect()->back();
    }

    public function DeleteSelectedUsers(Request $request)
    {
        $input = $request->all();
        $this->validate($request, [
            'artists' => 'required',

        ]);
        foreach ($input['artists'] as $index => $id) {

            $user = $this->obj_user->findOrFail($id);
            $user->delete();

        }
        Session::flash('success_message', 'Artists successfully deleted!');
        return redirect()->back();

    }
    public function userDetail(Request $request)
    {

        $user = Artist::findOrFail($request->input('id'));


        return view('admin.artists.single', ['title' => 'User Detail', 'user' => $user]);
    }


}
