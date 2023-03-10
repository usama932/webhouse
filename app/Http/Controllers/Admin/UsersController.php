<?php
namespace App\Http\Controllers\Admin;

use App\ArtistSubscribe;
use App\CronJob;
use App\Event;
use App\FavrateAudio;
use App\FavrateVideo;
use App\Http\Controllers\Controller;
use App\Image;
use App\Permission;
use App\User;
use Auth;
use Datatables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Mail;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $obj_user;

    public function __construct(User $userObject)
    {
        $this->middleware('auth:admin');
        $this->obj_user = $userObject;
    }

    public function index()
    {

        return view('admin.users.index', ['title' => 'Registered users List']);
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

        $totalData = User::count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if(empty($request->input('search.value'))){
            $users = User::offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();
            $totalFiltered = User::count();
        }else{
            $search = $request->input('search.value');
            $users = User::where('name', 'like', "%{$search}%")
                ->orWhere('email','like',"%{$search}%")
                ->orWhere('created_at','like',"%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            $totalFiltered = User::where('name', 'like', "%{$search}%")
                ->orWhere('email','like',"%{$search}%")
                ->count();
        }


        $data = array();

        if($users){
            foreach($users as $r){
                $edit_url = route('users.edit',$r->id);
                $nestedData['id'] = '
                                <td>
                                <div class="checkbox checkbox-success m-0">
                                        <input id="checkbox3" type="checkbox" name="users[]" value="'.$r->id.'">
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
                                    <a title="Edit User" class="btn btn-primary btn-circle"
                                       href="'.$edit_url.'">
                                       <i class="fa fa-edit"></i>
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

        return view('admin.users.create', ['title' => 'Registere User']);
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
        $user = new User();
        $user->name = $input['name'];
        $user->email = $input['email'];
        $user->phone = $input['phone'];
        $user->gender = $input['gender'];
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
        $res = array_key_exists('active', $input);
        if ($res == false) {
            $user->active = 0;
        } else {
            $user->active = 1;

        }
        $user->password = bcrypt($input['password']);
        $user->save();

        Session::flash('success_message', 'Great! User has been saved successfully!');
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
        return view('admin.users.profile-setting', ['title' => 'Edit Profile'])->withUser($user);
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



        return view('admin.users.edit', ['title' => 'Update User Details'])->withUser($user);
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
        $res = array_key_exists('active', $input);
        if ($res == false) {
            $user->active = 0;
        } else {
            $user->active = 1;

        }
        if(!empty($input['password'])) {
            $user->password = bcrypt($input['password']);
        }

        $user->save();

        Session::flash('success_message', 'Great! user successfully updated!');
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
        $fav_audios = FavrateAudio::where("user_id",$id)->get();
        foreach ($fav_audios as $fav_audio){
            $fav_audio->delete();
        }
        $fav_videos = FavrateVideo::where("user_id",$id)->get();
        foreach ($fav_videos as $fav_video){
            $fav_video->delete();
        }
        $subs = ArtistSubscribe::where("user_id",$id)->get();
        foreach ($subs as $sub){
            $sub->delete();
        }
        $user = $this->obj_user->findOrFail($id);
        $user->delete();
        Session::flash('success_message', 'User successfully deleted!');
        return redirect()->route('users.index');
    }

    public function DeleteSelectedUsers(Request $request)
    {
        $input = $request->all();
        $this->validate($request, [
            'users' => 'required',

        ]);
        foreach ($input['users'] as $index => $id) {

            $user = $this->obj_user->findOrFail($id);
            $user->delete();

        }
        Session::flash('success_message', 'Users successfully deleted!');
        return redirect()->back();

    }
    public function userDetail(Request $request)
    {

        $user = User::findOrFail($request->input('id'));


        return view('admin.users.single', ['title' => 'User Detail', 'user' => $user]);
    }


}
