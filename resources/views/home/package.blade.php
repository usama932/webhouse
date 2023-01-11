@extends('layouts.index')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Home Page Package</h4>
                    </div>
                    <div class="card-body">
                        {{-- <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Add</a>
                            </li>
                        </ul> --}}
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade active show" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <form action="{{ route('update_home_package') }}" class="form-horizontal form-bordered frm-submit-data" enctype="multipart/form-data" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-3 control-label">Heading Text</label>
                                             <div class="col-md-6">
                                                @if (isset($home_package->heading_text))
                                                <textarea name="heading_text" class="form-control" cols='4'>{{ $home_package->heading_text }}</textarea>
                                                @else
                                                <textarea name="heading_text" class="form-control" cols='4'></textarea>
                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-3 control-label">Sub Heading Text</label>
                                            <div class="col-md-6">
                                                @if (isset($home_package->sub_heading_text))
                                                <textarea name="sub_heading_text" class="form-control" cols='4'>{{ $home_package->sub_heading_text }}</textarea>
                                                @else
                                                <textarea name="sub_heading_text" class="form-control" cols='4'></textarea>
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
