@extends("artist.layouts.master")
@section("meta")
<title>Videos | Soul Entertainment</title>
@endsection
@section("content")
<main class="d-flex flex-column justify-content-start flex-grow-1">

    <!-- Start -->
    <div class="section_space d-flex flex-column justify-content-center ">
        <div class="container">
            <div class="row justify-content-center">
                <!-- Start -->
                <div class="col-md-12 ">

                    <div class="row justify-content-md-between">
                        <div class="col-md-6 d-flex align-items-center mb-5">
                            <h3 class="section_heading section_heading_divider">Albums</h3>
                            <a href="{{route('artist-albums.create')}}" data-bs-toggle="tooltip" title="Add New Album" class="ms-4 btn_plus"><i class="fas fa-plus"></i></a>
                        </div>
                        <div class="col-md-5 mb-5">
                            <form method="POST" enctype="multipart/form-data" action="{{route('artist-albums-search')}}">
                                @csrf
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search" name="search">
                                    <button type="submit" class="input-group-text"><i class="fas fa-search"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="row g-4">
                        @foreach($albums as $album)
                        <div class="col-sm-6 col-md-4 col-lg-3">
                            <div class="item_box">
                                <a href="{{route('artist-albums.show',$album->id)}}" class="stretched-link"></a>
                                <div class="item_box_thumb item_box_thumb_link">
                                    <img alt="" src="{{ asset("uploads/album/$album->image") }}" />
                                </div>

                                <!-- <a href="" class="btn_del"><i class="far fa-trash-alt"></i></a> -->
                                <a href="javascript:;" class="btn_del" data-id="{{ $album->id }}">
                                    <i class="far fa-trash-alt"></i>
                                </a>

                                <div class="item_box_content">
                                    <h5 class="item_box_title">{{$album->name}}</h5>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>

                </div>
                <!-- End -->

            </div>
        </div>
    </div>
    <!-- End -->



</main>

@endsection
@section("scripts")
<script>
    $(document).on('click', '.btn_del', function(e) {
        var uid = $(this).data('id');
        tr = $(this).closest('tr');


        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
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
                        '_method': 'DELETE'
                    },
                    url: "{{url('artist/artist-albums/')}}/" + uid,

                }).done(function(response) {

                    Swal.fire("Deleted!", response.msg, "success");
                    location.reload();





                }).fail(function(response) {
                    swal.fire("Cancelled", response.statusText, "error");
                });
            }
        })
    });
</script>
@endsection