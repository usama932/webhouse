@extends("artist.layouts.master")
@section("meta")
<title>Subscribes | Soul Entertainment</title>
@endsection
@section("content")

<main class="d-flex flex-column justify-content-start flex-grow-1">

    <!-- Start -->
    <div class="section_space d-flex flex-column justify-content-center ">
        <div class="container">
            <div class="row justify-content-center">
                <!-- Start -->
                <div class="col-md-8">
                    <h3 class="section_heading text-center section_heading_divider section_heading_divider_center mb-5">Subscribers</h3>
                </div>

                <div class="col-md-8 text-center">

                    <ul class="nav nav-tabs justify-content-evenly">
                        <li class="nav-item flex-fill">
                            <button class="nav-link {{$subscriber}} w-100" data-bs-toggle="tab" data-bs-target="#subscribers" type="button" aria-selected="true">Subscribers</button>
                        </li>
                        <li class="nav-item flex-fill">
                            <button class="nav-link {{$request}} w-100" data-bs-toggle="tab" data-bs-target="#requests" type="button" aria-selected="false">Requests</button>
                        </li>
                    </ul>

                    <div class="tab-content main_tab_content">
                        <div class="tab-pane show {{$subscriber}} " id="subscribers">
                            <form action="{{route('artist-subscribe-search')}}" method="POST" enctype="multipart/form-data" class="mb-3">
                                @csrf
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search" name="search">
                                    <button class="input-group-text"><i class="fas fa-search"></i></button>
                                </div>
                            </form>
                            <ul class="list_items p-0 m-0">


                                @foreach($subscribers as $subscribe)
                                <li class="list_item d-flex align-items-center">
                                    <a href="#" class="list_item_thumb">
                                        <img alt="" src="{{asset('uploads/'.$subscribe->users->image)}}" width="60" />
                                    </a>
                                    <div class="list_item_info mx-3">
                                        <a class="list_item_info_title" href="#">{{$subscribe->users->name}}</a>
                                        <a class="" href="#">{{$subscribe->users->email}}</a>
                                    </div>
                                    <div class="list_item_icons ms-auto">
                                        <a href="javascript:;" data-bs-toggle="tooltip" class="unsub" title="UnSubscribe" data-id="{{ $subscribe->id }}"><i class="far fa-times-circle"></i></a>

                                    </div>
                                </li>
                                @endforeach
                                <!-- ltem -->
                          

                                <!-- ltem -->


                            </ul>
                        </div>
                        <div class="tab-pane show {{$request}}" id="requests">
                            <form action="{{route('artist-request-search')}}" method="POST" enctype="multipart/form-data" class="mb-3">
                                @csrf
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search" name="search">
                                    <button class="input-group-text"><i class="fas fa-search"></i></button>
                                </div>
                            </form>
                            <ul class="list_items p-0 m-0">

                                <!-- ltem -->
                                @foreach($requests as $request)
                                <li class="list_item d-flex align-items-center">
                                    <a href="#" class="list_item_thumb">
                                        <img alt="" src="{{asset('uploads/'.$request->users->image)}}" width="60" />
                                    </a>
                                    <div class="list_item_info mx-3">
                                        <a class="list_item_info_title" href="#">{{$request->users->name}}</a>
                                        <a class="" href="#">{{$request->users->email}}</a>
                                    </div>
                                    <div class="list_item_icons ms-auto">
                                        <a href="javascript:;" data-bs-toggle="tooltip" title="Accept" class="accept" data-id="{{ $request->id }}"><i class="far fa-check-circle"></i></a>

                                        <a href="javascript:;" data-bs-toggle="tooltip" title="Reject" class="reject" data-id="{{ $request->id }}"><i class="far fa-times-circle"></i></a>
                                    </div>
                                </li>
                                @endforeach
                                <!-- ltem -->


                            </ul>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
    <!-- End -->



</main>

@endsection

@section("scripts")
<script>
    $(document).on('click', '.unsub', function(e) {
        var uid = $(this).data('id');
        tr = $(this).closest('tr');


        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Unsubscribe it!'
        }).then((result) => {
            if (result.value) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    method: 'POST',
                    data: {
                        '_method': 'POST'
                    },
                    url: "{{url('artist/UnSubscribe')}}/" + uid,

                }).done(function(response) {

                    Swal.fire("Unsubscribe!", response.msg, "success");
                    location.reload();





                }).fail(function(response) {
                    swal.fire("Cancelled", response.statusText, "error");
                });
            }
        })
    });

    $(document).on('click', '.accept', function(e) {
        var uid = $(this).data('id');
        tr = $(this).closest('tr');


        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Accept this Subscription!'
        }).then((result) => {
            if (result.value) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    method: 'POST',
                    data: {
                        '_method': 'POST'
                    },
                    url: "{{url('artist/acceptRequest')}}/" + uid,

                }).done(function(response) {

                    Swal.fire("Unsubscribe!", response.msg, "success");
                    location.reload();





                }).fail(function(response) {
                    swal.fire("Cancelled", response.statusText, "error");
                });
            }
        })
    });

    $(document).on('click', '.reject', function(e) {
        var uid = $(this).data('id');
        tr = $(this).closest('tr');


        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Reject this Subscription!'
        }).then((result) => {
            if (result.value) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    method: 'POST',
                    data: {
                        '_method': 'POST'
                    },
                    url: "{{url('artist/rejectRequest')}}/" + uid,

                }).done(function(response) {

                    Swal.fire("Rejected!", response.msg, "success");
                    location.reload();





                }).fail(function(response) {
                    swal.fire("Cancelled", response.statusText, "error");
                });
            }
        })
    });
</script>
@endsection