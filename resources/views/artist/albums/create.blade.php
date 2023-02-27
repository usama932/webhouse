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
                <h3 class="section_heading section_heading_divider section_heading_divider_center">Upload Album</h3>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8 ">
                <form id="create-album" method="POST" enctype="multipart/form-data" class="form" action="{{route('artist-albums.store')}}">
                   @csrf
                    <div class="row mb-3">
                        <label for="albumCover" class="col-sm-3 col-form-label required">Album Cover</label>
                        <div class="col-sm-9 {{ $errors->has('image') ? 'has-error' : '' }}">
                            <input class="form-control" type="file" id="image" name="image">
                            <span class="text-danger">{{ $errors->first('image') }}</span>

                        </div>
                    </div>
      
                    <div class="row mb-3">
                        <label for="albumName" class="col-sm-3 col-form-label required">Album Name</label>
                        <div class="col-sm-9 {{ $errors->has('name') ? 'has-error' : '' }}">
                          <input type="text" class="form-control" id="name"  name="name">
                          <span class="text-danger">{{ $errors->first('name') }}</span>

                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="albumDescription" class="col-sm-3 col-form-label">Album Description (optional)</label>
                        <div class="col-sm-9 {{ $errors->has('image') ? 'has-error' : '' }}">
                            <textarea class="form-control" rows="5" id="description" name="description"></textarea>
                            <span class="text-danger">{{ $errors->first('description') }}</span>

                        </div>
                    </div>

                    <div class="row mt-5">
                        <div class="col-sm-9 offset-3">
                            <!-- <button type="submit" class="btn btn_light">Upload Album</button> -->
                            <a href="javascript:void(0);" onclick="return validated()" class="btn btn-primary font-weight-bolder">
                                    <i class="ki ki-check icon-sm"></i>Upload Album</a>
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

        $("#create-album").validate({
            ignore: ".note-editor *",
            errorClass: "error fail-alert",
            validClass: "valid success-alert",
            rules: {
               
                image: {
                    required: true,
                },
                name: {
                    required: true,
                }
                

            },
            messages: {
                image: {
                    required: "Please select image",
                },
        
                name: {
                    required: "Please enter album name",
                }
            }

        

        });
        if ($('#create-album').valid()) // check if form is valid
        {

            $("#create-album").submit();
        } else {
            return false;
        }
    }

    
</script>
@endsection