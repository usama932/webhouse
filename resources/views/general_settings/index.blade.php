@extends('layouts.index')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>General Settings</h4>
                    </div>
                    <div class="card-body">
                        {{-- <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Add</a>
                            </li>
                        </ul> --}}
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade active show" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <form action="{{ route('update_admin_general_settings') }}" class="form-horizontal form-bordered frm-submit-data" enctype="multipart/form-data" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-3 control-label">Website Background Color</label>
                                            <div class="col-md-6">
                                                <input name="bg_color" class="form-control" value="{{isset($general_settings->bg_color) ? $general_settings->bg_color : '' }}" required>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-3 control-label">Heading Color</label>
                                            <div class="col-md-6">
                                                <input name="heading_color" class="form-control" value="{{isset($general_settings->heading_color) ? $general_settings->heading_color : '' }}" required>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-3 control-label">Text Color</label>
                                            <div class="col-md-6">
                                                <input name="text_color" class="form-control" value="{{isset($general_settings->text_color) ? $general_settings->text_color : '' }}" required>
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
