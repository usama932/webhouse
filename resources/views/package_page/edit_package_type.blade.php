@extends('layouts.index')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit Package Type</h4>
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
                                    <form action="{{ route('admin_update_package_type') }}"
                                        class="form-horizontal form-bordered frm-submit-data" enctype="multipart/form-data"
                                        method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $package_type->id }}">
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-md-3 control-label">Name</label>
                                                <div class="col-md-6">
                                                    <input type="text" name="name" class="form-control"
                                                        value="{{ $package_type->name }}"
                                                        required>
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
