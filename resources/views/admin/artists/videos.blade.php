@extends('admin.layouts.master')
@section('content')
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Manage Artist</h4></div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="active">Manage Artist Videos</li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>
    <div class="row">
        @include('admin.partials._msg')
        <div class="col-sm-12">
            <div class="white-box">

                <h3 class="box-title m-b-0">Manage Artist Videos</h3>
                <p class="text-muted m-b-30">Artist Videos List</p>
                <div class="table-responsive">
                    <form action="{{url('admin/delete-selected-artists')}}" method="post" id="uform">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <table id="users" class="table table-striped responsive nowrap" width="100%">
                        <thead>

                        <th>NAME</th>
                        <th>Thumbnail</th>
                        <th>Created at</th>
                        <th>Action</th>
                        </thead>
                        <tbody>
                        @foreach($user->videos as $event)
                        <tr>
                            <td>{{$event->name}}</td>
                            <td><img src="{{asset("uploads/video/$event->thumbnail")}}" alt="" width="200"></td>
                            <td>{{$event->created_at}}</td>
                            <td>
                                <a title="Show Event" class="btn btn-info btn-circle"
                                   href="{{route("artist-video",$event->id)}}">
                                    <i class="fa fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    </form>
                </div>
                <!-- sample modal content -->
                <div id="userModel" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title" id="myModalLabel">Artist Detail</h4> </div>
                            <div class="modal-body">

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-info waves-effect" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->
            </div>
        </div>


    </div>
    </div>

@section('scripts')
    <script type="text/javascript">
        function del(id){
            swal({
                        title: "Are you sure?",
                        text: "This Artist will be deleted permanently",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Yes, delete it!",
                        closeOnConfirm: false
                    },
                    function(){
                        var APP_URL = {!! json_encode(url('/')) !!}

                                window.location.href = APP_URL+"/admin/artists/delete/"+id;
                    });

        }
        function del_selected(){
            swal({
                title: "Are you sure?",
                text: "These Artist/Artists will be deleted permanently",
                type: "warning",
                showCancelButton: true,
                closeOnConfirm: false,
                showLoaderOnConfirm: true
            }, function () {
                $("#uform").submit();
                setTimeout(function () {
                    swal("Artist deleted sucessfully. Thanks");
                }, 2000);
            });
        }
    </script>

    <script>

        $(document).on('click', 'th input:checkbox', function () {
            var that = this;
            $(this).closest('table').find('tr > td:first-child input:checkbox')
                .each(function () {
                    this.checked = that.checked;
                    $(this).closest('tr').toggleClass('selected');
                });
        });

        var users = $('#users').DataTable();
        function viewInfo(id) {
            $.LoadingOverlay("show");
            var CSRF_TOKEN = '{{ csrf_token() }}';
            $.post("{{ route('admin.getArtist') }}", {_token: CSRF_TOKEN, id: id}).done(function (response) {
                // Add response in Modal body
                $('.modal-body').html(response);

                // Display Modal
                $('#userModel').modal('show');
                $.LoadingOverlay("hide");

            });
        }
    </script>
@endsection
@stop
