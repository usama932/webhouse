@extends("artist.layouts.master")
@section("meta")
<title>Albums | Soul Entertainment</title>
@endsection

@include('artist.partials.validation_styles')
@section("content")
<main class="d-flex flex-column justify-content-start flex-grow-1">

    <!-- Start -->
    <div class="section_space d-flex flex-column justify-content-center ">
        <div class="container">
            @include('admin.partials._messages')
            <div class="row justify-content-center">
                <div class="col-md-12 mb-5 text-center">
                    <h3 class="section_heading section_heading_divider section_heading_divider_center">Upload Video</h3>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-8">
                    <form id="video_add_form" action="{{route('artist-videos.store')}}" class="form" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <label for="video" class="col-sm-3 col-form-label required">Select Video</label>
                            <div class="col-sm-9 {{ $errors->has('video') ? 'has-error' : '' }}">
                                <input class="form-control" type="file" name="video" id="video" required>
                                <span class="text-danger">{{ $errors->first('video') }}</span>

                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="videoCover" class="col-sm-3 col-form-label required">Video Cover</label>
                            <div class="col-sm-9 {{ $errors->has('thumbnail') ? 'has-error' : '' }}">
                                <input class="form-control" type="file" name="thumbnail" id="thumbnail" required>
                                <span class="text-danger">{{ $errors->first('thumbnail') }}</span>

                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="songName" class="col-sm-3 col-form-label required">Song Name</label>
                            <div class="col-sm-9 {{ $errors->has('name') ? 'has-error' : '' }}">
                                <input type="text" class="form-control" id="songName" name="name" id="name" value="" required>
                                <span class="text-danger">{{ $errors->first('name') }}</span>

                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="composerName" class="col-sm-3 col-form-label required">Composer Name</label>
                            <div class="col-sm-9 {{ $errors->has('composer_name') ? 'has-error' : '' }}">
                                <input type="text" class="form-control" id="composer_name" name="composer_name" value="" required>
                                <span class="text-danger">{{ $errors->first('composer_name') }}</span>

                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="albumSelect" class="col-sm-3 col-form-label required">Album</label>
                            <div class="col-sm-9 {{ $errors->has('album') ? 'has-error' : '' }}">
                                <select class="form-select" id="album" name="album" required>
                                    <option selected disabled value="">No album select</option>
                                    @foreach($albums as $album)
                                    <option value="{{$album->id}}">{{$album->name}}</option>
                                    @endforeach
                                </select>
                                <span id="album_error" class="text-danger">{{ $errors->first('album') }}</span>

                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="categorySelect" class="col-sm-3 col-form-label required">Category</label>
                            <div class="col-sm-9 {{ $errors->has('category') ? 'has-error' : '' }}">
                                <select class="form-control select2 form-control-solid" data-size="7" data-live-search="true" id="category" name="category" required>
                                    <option selected disabled value="">No category select</option>
                                    @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach

                                </select>
                                <span id="category_error" class="text-danger">{{ $errors->first('category') }}</span>

                            </div>
                        </div>

                        <div class="row mt-5">
                            <div class="col-sm-9 offset-3">
                                <!-- <button type="submit" onclick="return validated()" class="btn btn_light">Upload Video</button> -->

                                <a href="javascript:void(0);" onclick="return validated()" class="btn btn-primary font-weight-bolder">
                                    <i class="ki ki-check icon-sm"></i>Upload Video</a>
                            </div>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
    <!-- End -->



</main>

@endsection

@section('scripts')

<script>
    // $(document).ready(function() {
    //   $("#article_add_form").validate();
    // });
    function validated() {

        $("#video_add_form").validate({
            ignore: ".note-editor *",
            errorClass: "error fail-alert",
            validClass: "valid success-alert",
            rules: {
                video: {
                    required: true,
                },
                thumbnail: {
                    required: true,
                },

                name: {
                    required: true,
                },
                composer_name: {
                    required: true,
                },
                album: {
                    required: true,
                },
                category: {
                    required: true,
                }

            },
            messages: {
                video: {

                    required: "Please select video",
                },
                thumbnail: {

                    required: "Please select thumbnail",
                },
                name: {

                    required: "Please enter name",
                },
                composer_name: {

                    required: "Please enter composer name",
                },
                album: {

                    required: "Please select album",
                },
                category: {

                    required: "Please select category",
                },
            },

            errorPlacement: function(error, element) {
                if (element.attr("name") == "category") {
                    error.insertAfter("#category_error");
                } else if (element.attr("name") == "album") {
                    error.insertAfter("#album_error");
                } else {
                    error.insertAfter(element);
                }
            }

        });
        if ($('#video_add_form').valid()) // check if form is valid
        {

            $("#video_add_form").submit();
        } else {
            return false;
        }
    }

    $(document).ready(function() {


        $(".select2").select2({

            allowClear: true
        });


        $('select').select2({}).on("change", function(e) {
            $(this).valid()
        });

    });
</script>
@endsection