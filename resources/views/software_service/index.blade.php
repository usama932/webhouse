@extends('layouts.index')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Software Development Service Page</h4>
                    </div>
                    <div class="card-body">
                        {{-- <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Add</a>
                            </li>
                        </ul> --}}
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade active show" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <form action="{{ route('update_admin_software_service') }}" class="form-horizontal form-bordered frm-submit-data" enctype="multipart/form-data" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-3 control-label">Main heading</label>
                                            <div class="col-md-6">
                                                <input name="main_heading" class="form-control" value="{{isset($software_service->main_heading) ? $software_service->main_heading : '' }}" >
                                            </div>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-3 control-label">Main Description</label>
                                            <div class="col-md-6">
                                                @if (isset($software_service->main_description))
                                                    <textarea name="main_description" class="form-control" cols='5'>{{ $software_service->main_description }}</textarea>
                                                @else
                                                    <textarea name="main_description" class="form-control" cols='5'></textarea>
                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                                                
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-3 control-label">Image</label>
                                            <div class="col-md-6">
                                                <input type="file" name="image" class="form-control" >
                                            </div>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-3 control-label">Description Heading</label>
                                            <div class="col-md-6">
                                                @if (isset($software_service->description_heading))
                                                    <textarea name="description_heading" class="form-control" cols='5'>{{ $software_service->description_heading }}</textarea>
                                                @else
                                                    <textarea name="description_heading" class="form-control" cols='5'></textarea>
                                                @endif
                                            </div>

                                        </div>
                                    </div><div class="form-group">
                                        <div class="row">
                                            <label class="col-md-3 control-label">Description Text</label>
                                            <div class="col-md-6">
                                                @if (isset($software_service->description_text))
                                                    <textarea name="description_text" class="form-control" cols='5'>{{ $software_service->description_text }}</textarea>
                                                @else
                                                    <textarea name="description_text" class="form-control" cols='5'></textarea>
                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                   
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-3 control-label">Service 1 heading</label>
                                            <div class="col-md-6">
                                                <input name="service_1_heading" class="form-control" value="{{isset($software_service->service_1_heading) ? $software_service->service_1_heading : '' }}" >
                                            </div>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-3 control-label">Service 1 Description</label>
                                            <div class="col-md-6">
                                                @if (isset($software_service->service_1_text))
                                                    <textarea name="service_1_text" class="form-control" cols='5'>{{ $software_service->service_1_text }}</textarea>
                                                @else
                                                    <textarea name="service_1_text" class="form-control" cols='5'></textarea>
                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-3 control-label">Service 2 heading</label>
                                            <div class="col-md-6">
                                                <input name="service_2_heading" class="form-control" value="{{isset($software_service->service_2_heading) ? $software_service->service_2_heading : '' }}" >
                                            </div>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-3 control-label">Service 2 Description</label>
                                            <div class="col-md-6">
                                                @if (isset($software_service->service_2_text))
                                                    <textarea name="service_2_text" class="form-control" cols='5'>{{ $software_service->service_2_text }}</textarea>
                                                @else
                                                    <textarea name="service_2_text" class="form-control" cols='5'></textarea>
                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-3 control-label">Service 3 heading</label>
                                            <div class="col-md-6">
                                                <input name="service_3_heading" class="form-control" value="{{isset($software_service->service_3_heading) ? $software_service->service_3_heading : '' }}" >
                                            </div>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-3 control-label">Service 3 Description</label>
                                            <div class="col-md-6">
                                                @if (isset($software_service->service_3_text))
                                                    <textarea name="service_3_text" class="form-control" cols='5'>{{ $software_service->service_3_text }}</textarea>
                                                @else
                                                    <textarea name="service_3_text" class="form-control" cols='5'></textarea>
                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-3 control-label">Service 4 heading</label>
                                            <div class="col-md-6">
                                                <input name="service_4_heading" class="form-control" value="{{isset($software_service->service_4_heading) ? $software_service->service_4_heading : '' }}" >
                                            </div>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-3 control-label">Service 4 Description</label>
                                            <div class="col-md-6">
                                                @if (isset($software_service->service_4_text))
                                                    <textarea name="service_4_text" class="form-control" cols='5'>{{ $software_service->service_4_text }}</textarea>
                                                @else
                                                    <textarea name="service_4_text" class="form-control" cols='5'></textarea>
                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-3 control-label">Service 5 heading</label>
                                            <div class="col-md-6">
                                                <input name="service_5_heading" class="form-control" value="{{isset($software_service->service_5_heading) ? $software_service->service_5_heading : '' }}" >
                                            </div>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-3 control-label">Service 5 Description</label>
                                            <div class="col-md-6">
                                                @if (isset($software_service->service_5_text))
                                                    <textarea name="service_5_text" class="form-control" cols='5'>{{ $software_service->service_5_text }}</textarea>
                                                @else
                                                    <textarea name="service_5_text" class="form-control" cols='5'></textarea>
                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-3 control-label">Service 6 heading</label>
                                            <div class="col-md-6">
                                                <input name="service_6_heading" class="form-control" value="{{isset($software_service->service_6_heading) ? $software_service->service_6_heading : '' }}" >
                                            </div>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-3 control-label">Service 6 Description</label>
                                            <div class="col-md-6">
                                                @if (isset($software_service->service_6_text))
                                                    <textarea name="service_6_text" class="form-control" cols='5'>{{ $software_service->service_6_text }}</textarea>
                                                @else
                                                    <textarea name="service_6_text" class="form-control" cols='5'></textarea>
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
