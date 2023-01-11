@extends('layouts.index')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Main Menu</h4>
                    </div>
                    <div class="card-body">
                        {{-- <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Add</a>
                            </li>
                        </ul> --}}
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade active show" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <form action="{{ route('update_admin_menu') }}" class="form-horizontal form-bordered frm-submit-data" enctype="multipart/form-data" method="POST">
                                    @csrf
                                    {{-- <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-3 control-label">Background Color</label>
                                            <div class="col-md-6">
                                                <input name="bg_color" class="form-control" value="{{isset($menu->bg_color) ? $menu->bg_color : '' }}" required>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-3 control-label">Heading Color</label>
                                            <div class="col-md-6">
                                                <input name="heading_color" class="form-control" value="{{isset($menu->heading_color) ? $menu->heading_color : '' }}" required>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-3 control-label">Text Color</label>
                                            <div class="col-md-6">
                                                <input name="text_color" class="form-control" value="{{isset($menu->text_color) ? $menu->text_color : '' }}" required>
                                            </div>

                                        </div>
                                    </div> --}}
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-3 control-label">Email</label>
                                            <div class="col-md-6">
                                                <input name="email" class="form-control" value="{{isset($menu->email) ? $menu->email : '' }}" required>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-3 control-label">Address</label>
                                            <div class="col-md-6">
                                                <input name="address" class="form-control" value="{{isset($menu->address) ? $menu->address : '' }}" required>
                                            </div>

                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-3 control-label">Contact Numbers</label>
                                            <div class="col-md-6">
                                                @if (isset($menu->contact_numbers))
                                                <textarea name="contact_numbers" class="form-control" cols='5'>{{ $menu->contact_numbers }}</textarea>
                                                @else
                                                <textarea name="contact_numbers" class="form-control" cols='5'></textarea>
                                                @endif
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
