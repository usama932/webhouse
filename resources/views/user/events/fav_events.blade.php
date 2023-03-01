@extends("user.layouts.master")
@section("meta")
<title>Events | Soul Entertainment</title>
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
                        <div class="col-md-6">
                            <h3 class="section_heading section_heading_divider mb-5">Events</h3>
                        </div>
                        <div class="col-md-5">
                            <form action="{{route('user.event')}}" class="mb-5" method="post">
                                @csrf
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search" name="search">
                                     <input type="hidden" class="form-control" value="1" name="fav">
                                    <button class="input-group-text"><i class="fas fa-search"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>



                    <div class="row g-4">
                        @foreach($data as $event)
                        <div class="col-sm-6 col-md-4 col-lg-3">
                            <div class="item_box" >
                                <a href="{{route('user.eventDetail',$event->id)}}" class="stretched-link"></a>
                                <div class=" item_box_thumb_link" >
                                    <img alt="" src="{{ asset("uploads/image") }}/{{$event->image}}" style="width:300px !important; height:200px !important;"/>
                                </div>

                                <a href="javascript:;" class="btn_del" data-id="{{ $event->id}}">
                                    <i class="fa fa-heart"></i>
                                </a>
                               
                         
                                    <h5 class="item_box">  <i class="far fa-calendar-alt"></i>
                                          {{date('d-m-Y', strtotime($event->date_time))}}</h5>
                              
                                          <h5 class="item_box_title">{{$event->name}}</h5>
                                
                                <div class="item_box_content">
                                    
                                </div>

                                
                            </div>
                        </div>
                        @endforeach
                       <div class="d-flex justify-content-center">
                            {!! $data ->links() !!}
                        </div>

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
                    url: "{{url('user/unfavourEvent/')}}/" + uid,

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