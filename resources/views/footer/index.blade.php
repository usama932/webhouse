@extends('layouts.index')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Footer</h4>
                    </div>
                    <div class="card-body">
                        {{-- <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Add</a>
                            </li>
                        </ul> --}}
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade active show" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <form action="{{ route('update_admin_footer') }}" class="form-horizontal form-bordered frm-submit-data" enctype="multipart/form-data" method="POST">
                                    @csrf
                                    {{-- <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-3 control-label">Background Color</label>
                                            <div class="col-md-6">
                                                <input name="bg_color" class="form-control" value="{{isset($footer->bg_color) ? $footer->bg_color : '' }}" required>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-3 control-label">Heading Color</label>
                                            <div class="col-md-6">
                                                <input name="heading_color" class="form-control" value="{{isset($footer->heading_color) ? $footer->heading_color : '' }}" required>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-3 control-label">Text Color</label>
                                            <div class="col-md-6">
                                                <input name="text_color" class="form-control" value="{{isset($footer->text_color) ? $footer->text_color : '' }}" required>
                                            </div>

                                        </div>
                                    </div> --}}
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-3 control-label">Facebook Link</label>
                                            <div class="col-md-6">
                                                <input name="fb_link" class="form-control" value="{{isset($footer->fb_link) ? $footer->fb_link : '' }}" required>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-3 control-label">Instagram Link</label>
                                            <div class="col-md-6">
                                                <input name="insta_link" class="form-control" value="{{isset($footer->insta_link) ? $footer->insta_link : '' }}" required>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-3 control-label">Twitter Link</label>
                                            <div class="col-md-6">
                                                <input name="tw_link" class="form-control" value="{{isset($footer->tw_link) ? $footer->tw_link : '' }}" required>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-3 control-label">LinkedIn Link</label>
                                            <div class="col-md-6">
                                                <input name="li_link" class="form-control" value="{{isset($footer->li_link) ? $footer->li_link : '' }}" required>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-3 control-label">Email</label>
                                            <div class="col-md-6">
                                                <input name="email" class="form-control" value="{{isset($footer->email) ? $footer->email : '' }}" required>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-3 control-label">Address</label>
                                            <div class="col-md-6">
                                                <input name="address" class="form-control" value="{{isset($footer->address) ? $footer->address : '' }}" required>
                                            </div>

                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-3 control-label">Contact Numbers</label>
                                            <div class="col-md-6">
                                                @if (isset($footer->contact_numbers))
                                                <textarea name="contact_numbers" class="form-control" cols='5'>{{ $footer->contact_numbers }}</textarea>
                                                @else
                                                <textarea name="contact_numbers" class="form-control" cols='5'></textarea>
                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-3 control-label">Copyright Text</label>
                                            <div class="col-md-6">
                                                @if (isset($footer->copyright_text))
                                                    <textarea name="copyright_text" class="form-control" cols='5'>{{ $footer->copyright_text }}</textarea>
                                                @else
                                                    <textarea name="copyright_text" class="form-control" cols='5'></textarea>
                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-3 control-label">Background Image</label>
                                            <div class="col-md-6">
                                                <input type="file" name="bg_image" class="form-control" required>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-3 control-label">Main Logo</label>
                                            <div class="col-md-6">
                                                <input type="file" name="main_logo" class="form-control" required>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-3 control-label">Image</label>
                                            <div class="col-md-6">
                                                <input type="file" name="image" class="form-control" required>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-3 control-label">Logo One</label>
                                            <div class="col-md-6">
                                                <input type="file" name="logo_1" class="form-control" required>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-3 control-label">Logo Two</label>
                                            <div class="col-md-6">
                                                <input type="file" name="logo_2" class="form-control" required>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-3 control-label">Logo Three</label>
                                            <div class="col-md-6">
                                                <input type="file" name="logo_3" class="form-control" required>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-3 control-label">Logo Four</label>
                                            <div class="col-md-6">
                                                <input type="file" name="logo_4" class="form-control" required>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

</div>
</section>
</div>
@endsection
