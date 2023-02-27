@extends("user.layouts.master")
@section("meta")
    <title>Artist Profile | Soul Entertainment</title>
@endsection
@section("content")

<main class="d-flex flex-column justify-content-start flex-grow-1">

<!-- Songs Start -->
<div class="section_space d-flex flex-column justify-content-center ">
    <div class="container">
    @include('admin.partials._messages')
        <div class="row justify-content-center">
            
            <div class="col-md-12 col-lg-8">
                
                <form method="POST" action="{{route('user.updateprofile')}}" enctype="multipart/form-data">
                 @csrf
                    <div class="row mb-3">
                      <label for="userName" class="col-sm-3 col-form-label">Name</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="userName" name="name" value="{{$user->name}}">
                      </div>
                    </div>

                    <div class="row mb-3">
                        <label for="userEmail" class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9">
                          <input type="email" class="form-control" id="userEmail" name="email" value="{{$user->email}}">
                        </div>
                    </div>

                    <fieldset class="row mb-3">
                      <legend class="col-form-label col-sm-3 pt-0">Gender</legend>
                      <div class="col-sm-9">
                        <div class="form-check">
                          <input class="form-check-input" type="radio"  name="gender" id="userGenderMale" value="1" checked>
                          <label class="form-check-label" for="userGenderMale">Male</label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio"  name="gender" id="userGenderFemale" value="0">
                          <label class="form-check-label" for="userGenderFemale">Female</label>
                        </div>
                      </div>
                    </fieldset>

                    <div class="row mb-3">
                        <label for="userDescription" class="col-sm-3 col-form-label">Description (optional)</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" rows="5" id="userDescription" name="description" value="{{$user->description}}"></textarea>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="userImage" class="col-sm-3 col-form-label">Image</label>
                        <div class="col-sm-9">
                            <img class="mb-3" alt="" src="" width="80">
                            <input class="form-control" type="file" id="userImage" name="image">
                        </div>
                    </div>

                    <div class="row mt-5">
                        <div class="col-sm-9 offset-3">
                            <button type="submit" class="btn btn_light">Update</button>
                        </div>
                    </div>
                    
                  </form>

            </div>

        </div>
    </div>
</div>
<!-- Songs End -->

</main>


@endsection