@extends('layouts.index')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>About Page</h4>
                        </div>
                        <div class="card-body">
                            {{-- <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Add</a>
                            </li>
                        </ul> --}}
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade active show" id="profile" role="tabpanel"
                                    aria-labelledby="profile-tab">
                                    <form action="{{ route('update_admin_about_page') }}"
                                        class="form-horizontal form-bordered frm-submit-data" enctype="multipart/form-data"
                                        method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-md-3 control-label">Heading One</label>
                                                <div class="col-md-6">
                                                    <input type="text" name="about_heading_one" class="form-control"
                                                        value="{{ isset($about->about_heading_one) ? $about->about_heading_one : '' }}"
                                                        required>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-md-3 control-label">Heading Two</label>
                                                <div class="col-md-6">
                                                    <input type="text" name="about_heading_two" class="form-control"
                                                        value="{{ isset($about->about_heading_two) ? $about->about_heading_two : '' }}"
                                                        required>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-md-3 control-label">About us Text</label>
                                                <div class="col-md-6">
                                                    @if (isset($about->about_content))
                                                        <textarea name="about_content" class="form-control" cols='5'>{{ $about->about_content }}</textarea>
                                                    @else
                                                        <textarea name="about_content" class="form-control" cols='5'></textarea>
                                                    @endif
                                                </div>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-md-3 control-label">About Image</label>
                                                <div class="col-md-6">
                                                    <input type="file" name="about_image" class="form-control" required>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-md-3 control-label">Mission Heading</label>
                                                <div class="col-md-6">
                                                    <input type="text" name="mission_heading" class="form-control"
                                                        value="{{ isset($about->mission_heading) ? $about->mission_heading : '' }}"
                                                        required>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-md-3 control-label">Mission Text</label>
                                                <div class="col-md-6">
                                                    @if (isset($about->mission_content))
                                                        <textarea name="mission_content" class="form-control" cols='5'>{{ $about->mission_content }}</textarea>
                                                    @else
                                                        <textarea name="mission_content" class="form-control" cols='5'></textarea>
                                                    @endif
                                                </div>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-md-3 control-label">Mission Image</label>
                                                <div class="col-md-6">
                                                    <input type="file" name="mission_image" class="form-control"
                                                        required>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-md-3 control-label">Vision Heading</label>
                                                <div class="col-md-6">
                                                    <input type="text" name="vision_heading" class="form-control"
                                                        value="{{ isset($about->vision_heading) ? $about->vision_heading : '' }}"
                                                        required>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-md-3 control-label">Vision Text</label>
                                                <div class="col-md-6">
                                                    @if (isset($about->vision_content))
                                                        <textarea name="vision_content" class="form-control" cols='5'>{{ $about->vision_content }}</textarea>
                                                    @else
                                                        <textarea name="vision_content" class="form-control" cols='5'></textarea>
                                                    @endif
                                                </div>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-md-3 control-label">Vision Image</label>
                                                <div class="col-md-6">
                                                    <input type="file" name="vision_image" class="form-control" required>
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
