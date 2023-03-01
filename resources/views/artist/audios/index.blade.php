@extends("artist.layouts.master")
@section("meta")
<title>Audios | Soul Entertainment</title>
@endsection
@section("content")
<main class="d-flex flex-column justify-content-start flex-grow-1">

<!-- Songs Start -->
<div class="section_space d-flex flex-column justify-content-center ">
    <div class="container">
        <div class="row justify-content-center">
            <!-- Songs Start -->
            <div class="col-md-12 ">

                <div class="row justify-content-md-between">
                    <div class="col-md-6 d-flex align-items-center mb-5">
                        <h3 class="section_heading section_heading_divider">Audios</h3>
                        <a href="{{route('artist-audios.create')}}" data-bs-toggle="tooltip" title="Add New Audio" class="ms-4 btn_plus"><i class="fas fa-plus"></i></a>
                    </div>
                    <div class="col-md-5 mb-5">
                        <form method="POST" enctype="multipart/form-data" action="{{route('artist-audio-search')}}">
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
                    @foreach($data as $datum)
                    <li class="list_item d-flex align-items-center">
                        <a href="#" class="list_item_thumb">
                                <img alt="" src="{{asset("uploads/audio/$datum->thumbnail")}}" width="60"/>
                        </a>
                        <div class="list_item_info mx-3">
                            <a class="list_item_info_title" href="#">{{$datum->name}}</a>
                            @if($datum->category)
                                <a class="list_item_info_sub" href="#">{{$datum->cat->name}}</a>
                                @endif
                            <a class="list_item_info_sub" href="#">Category</a>
                        </div>
                        <div class="list_item_icons ms-auto">
                            <audio controls>
                                <source src="{{asset("uploads/audio")}}/{{$datum->audio}}" type="audio/mpeg"> 
                            </audio>
                        </div>
                        <div class="list_item_icons ms-auto">
                            
                            <a href="javascript:;" class="del" data-id="{{ $datum->id }}"><i class="fas fa-trash-alt"></i></a>
                        </div>
                    </li>
                    @endforeach
                    <!-- Song ltem -->
                   

                </ul>
                
            </div>
            <!-- Songs End -->

        </div>
    </div>
</div>
<!-- Songs End -->



</main>

@endsection

@section("scripts")
<script>
    $(document).on('click', '.del', function(e) {
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
                    url: "{{url('artist/artist-audios/')}}/" + uid,

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