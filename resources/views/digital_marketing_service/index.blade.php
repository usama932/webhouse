@extends('layouts.index')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Digital Marketing Service Page</h4>
                    </div>
                    <div class="card-body">
                        {{-- <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Add</a>
                            </li>
                        </ul> --}}
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade active show" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <form action="{{ route('update_admin_digital_marketing_service') }}" class="form-horizontal form-bordered frm-submit-data" enctype="multipart/form-data" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-3 control-label">Main heading</label>
                                            <div class="col-md-6">
                                                <input name="main_heading" class="form-control" value="{{isset($digital_marketing_service->main_heading) ? $digital_marketing_service->main_heading : '' }}" >
                                            </div>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-3 control-label">Main Description</label>
                                            <div class="col-md-6">
                                                @if (isset($digital_marketing_service->main_description))
                                                    <textarea name="main_description" class="form-control" cols='5'>{{ $digital_marketing_service->main_description }}</textarea>
                                                @else
                                                    <textarea name="main_description" class="form-control" cols='5'></textarea>
                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                                                
                
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-3 control-label">Main Image</label>
                                            <div class="col-md-6">
                                                <input type="file" name="main_image" class="form-control" >
                                            </div>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-3 control-label">Service Description Heading</label>
                                            <div class="col-md-6">
                                                @if (isset($digital_marketing_service->service_description_heading))
                                                    <textarea name="service_description_heading" class="form-control" cols='5'>{{ $digital_marketing_service->service_description_heading }}</textarea>
                                                @else
                                                    <textarea name="service_description_heading" class="form-control" cols='5'></textarea>
                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-3 control-label">Service Description</label>
                                            <div class="col-md-6">
                                                @if (isset($digital_marketing_service->service_description))
                                                    <textarea name="service_description" class="form-control" cols='5'>{{ $digital_marketing_service->service_description }}</textarea>
                                                @else
                                                    <textarea name="service_description" class="form-control" cols='5'></textarea>
                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-3 control-label">Service Image</label>
                                            <div class="col-md-6">
                                                <input type="file" name="service_image" class="form-control" >
                                            </div>

                                        </div>
                                    </div>
                                    
    
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-3 control-label">Portfolio Heading</label>
                                            <div class="col-md-6">
                                                @if (isset($digital_marketing_service->portfolio_heading))
                                                    <textarea name="portfolio_heading" class="form-control" cols='5'>{{ $digital_marketing_service->portfolio_heading }}</textarea>
                                                @else
                                                    <textarea name="portfolio_heading" class="form-control" cols='5'></textarea>
                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-3 control-label">Portfolio Text</label>
                                            <div class="col-md-6">
                                                @if (isset($digital_marketing_service->portfolio_text))
                                                    <textarea name="portfolio_text" class="form-control" cols='5'>{{ $digital_marketing_service->portfolio_text }}</textarea>
                                                @else
                                                    <textarea name="portfolio_text" class="form-control" cols='5'></textarea>
                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-3 control-label">Custom Service Heading</label>
                                            <div class="col-md-6">
                                                @if (isset($digital_marketing_service->custom_service_heading))
                                                    <textarea name="custom_service_heading" class="form-control" cols='5'>{{ $digital_marketing_service->custom_service_heading }}</textarea>
                                                @else
                                                    <textarea name="custom_service_heading" class="form-control" cols='5'></textarea>
                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-3 control-label">Custom Service Text</label>
                                            <div class="col-md-6">
                                                @if (isset($digital_marketing_service->custom_service_text))
                                                    <textarea name="custom_service_text" class="form-control" cols='5'>{{ $digital_marketing_service->custom_service_text }}</textarea>
                                                @else
                                                    <textarea name="custom_service_text" class="form-control" cols='5'></textarea>
                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-3 control-label">Social Media Service Heading</label>
                                            <div class="col-md-6">
                                                @if (isset($digital_marketing_service->social_media_services_heading))
                                                    <textarea name="social_media_services_heading" class="form-control" cols='5'>{{ $digital_marketing_service->social_media_services_heading }}</textarea>
                                                @else
                                                    <textarea name="social_media_services_heading" class="form-control" cols='5'></textarea>
                                                @endif
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
