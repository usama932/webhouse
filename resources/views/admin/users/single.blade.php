<div class="card-datatable table-responsive">
    <table id="technicians" class="datatables-demo table table-striped table-bordered">
        <tbody>
        <tr>
            <td>Name</td>
            <td>{{$user->name}}</td>
        </tr>
        <tr>
            <td>Email</td>
            <td>{{$user->email}}</td>
        </tr>
        <tr>
            <td>Phone</td>
            <td>{{$user->phone}}</td>
        </tr>
        <tr>
            <td>Status</td>
            <td>
                @if($user->active)
                    <span class="btn btn-sm btn-success">Active</span>
                @else
                    <span class="btn btn-sm btn-warning">Inactive</span>
                @endif
            </td>
        </tr>
        <tr>
            <td>Gender</td>
            <td>
                @if($user->gender)
                    <span class="btn btn-sm btn-success">Male</span>
                @else
                    <span class="btn btn-sm btn-info">Female</span>
                @endif
            </td>
        </tr>
        <tr>
            <td>Image</td>
            <td>
                @if($user->image)
                    <img src="{{asset("uploads/$user->image")}}" alt="" width="200">
                @endif
            </td>
        </tr>
        <tr>
            <td>Created at</td>
            <td>{{$user->created_at}}</td>
        </tr>

        </tbody>
    </table>
</div>
