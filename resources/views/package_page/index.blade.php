@extends('layouts.index')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Package Page</h4>
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
                                    <form action="{{ route('update_admin_package_page') }}"
                                        class="form-horizontal form-bordered frm-submit-data" enctype="multipart/form-data"
                                        method="POST">
                                        @csrf
                                        
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-md-3 control-label">Package Page Heading</label>
                                                <div class="col-md-6">
                                                    <input type="text" name="package_heading" class="form-control"
                                                        value="{{ isset($package_page->package_heading) ? $package_page->package_heading : '' }}"
                                                        required>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-md-3 control-label">Package Page Text</label>
                                                <div class="col-md-6">
                                                    @if (isset($package_page->package_content))
                                                        <textarea name="package_content" class="form-control" cols='5'>{{ $package_page->package_content }}</textarea>
                                                    @else
                                                        <textarea name="package_content" class="form-control" cols='5'></textarea>
                                                    @endif
                                                </div>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-md-3 control-label">Pricing Heading</label>
                                                <div class="col-md-6">
                                                    <input type="text" name="pricing_heading" class="form-control"
                                                        value="{{ isset($package_page->pricing_heading) ? $package_page->pricing_heading : '' }}"
                                                        required>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-md-3 control-label">Pricing Text</label>
                                                <div class="col-md-6">
                                                    @if (isset($package_page->pricing_content))
                                                        <textarea name="pricing_content" class="form-control" cols='5'>{{ $package_page->pricing_content }}</textarea>
                                                    @else
                                                        <textarea name="pricing_content" class="form-control" cols='5'></textarea>
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
