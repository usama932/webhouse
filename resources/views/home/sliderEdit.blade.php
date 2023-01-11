@extends('layouts.index')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Home Page Slider</h4>
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link" id="home-tab" data-toggle="tab" href="slider" role="tab" aria-controls="home" aria-selected="false">View</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Edit</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
                            </div>
                            <div class="tab-pane fade  active show" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <!-- //frm-submit-data -->
                                <form action="addSlider" class="form-horizontal form-bordered frm-submit-data" enctype="multipart/form-data" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-3 control-label">Heading Text</label>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" name="title">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            
                                            <label class="col-md-3 control-label">Description</label>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" name="descripton">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-3 control-label">Button Text</label>
                                            <div class="col-md-6">
                                                 <input type="text" class="form-control" name='button_text'>
                                                 <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-3 control-label">Button URL</label>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" name="button_url">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-3 control-label">File</label>
                                            <div class="col-md-6">
                                                 <input type="file" class="form-control" name="img">
                                                 <div class="invalid-feedback"></div>
                                            </div>
                                           
                                        </div>

                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Submit</button>
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