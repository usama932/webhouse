@extends("user.layouts.master")
@section("meta")
<title>Audios | Soul Entertainment</title>
@endsection
@section("content")

<main class="d-flex flex-column justify-content-start flex-grow-1">

<!-- Songs Start -->
<div class="section_space d-flex flex-column justify-content-center ">
    <div class="container">
        <div class="row justify-content-center">
            <!-- Songs Audio Start -->
            <div class="col-md-12 ">

                <div class="row justify-content-md-between">
                    <div class="col-md-6">
                        <h3 class="section_heading section_heading_divider mb-5">Audio Songs</h3>
                    </div>
                    <div class="col-md-5">
                        <form action="{{route('audioSongs-search')}}" method="POST" enctype="multipart/form-data" class="mb-5">
                            @csrf
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search" name="search">
                                <button class="input-group-text"><i class="fas fa-search"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
               
                <ul class="list_items p-0 m-0">
                    <!-- Song ltem -->
                    @foreach($audios as $audio)
                    <li class="list_item d-flex align-items-center">
                        <a href="#" class="list_item_thumb">
                                <img alt="" src="{{asset("uploads/audio/$audio->thumbnail")}}" width="60"/>
                        </a>
                        <div class="list_item_info mx-3">
                            <a class="list_item_info_title" href="#">{{$audio->name}}</a>
                            <a class="list_item_info_sub" href="category.html">{{$audio->cat->name}}</a>
                             

                        </div>
                        <div class="list_item_icons ms-auto">
                            <audio controls>
                                <source src="{{asset("uploads/audio")}}/{{$audio->audio}}" type="audio/mpeg"> 
                            </audio>
                        </div>
                        <div class="list_item_icons ms-auto">
                            <a href="javascript:;" class="favour" data-id="{{ $audio->id }}"><i class="far fa-heart"></i></a>
                        </div>
                    </li>
                    @endforeach
                    <!-- Song ltem -->
                   

                </ul>
                
            </div>
            <!-- Songs Audio End -->

        </div>
    </div>
</div>
<!-- Songs End -->



</main>

@endsection

@section("scripts")
<script>
    $(document).on('click', '.favour', function(e) {
        var uid = $(this).data('id');
        tr = $(this).closest('tr');


        Swal.fire({
            title: 'Are you sure?',
            text: "You could be able to revert this!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Favour/unFavour!'
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
                    url: "{{url('user/favourAudio/')}}/" + uid,

                }).done(function(response) {

                    Swal.fire("Favour Added Successfully!", response.msg, "success");
                    location.reload();
                }).fail(function(response) {
                    swal.fire("Cancelled", response.statusText, "error");
                });
            }
        })
    });
</script>
@endsection