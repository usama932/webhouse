@extends('layouts.index')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>New Contact Field</h4>
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
                                    <form action="{{ route('store_admin_contact_field') }}"
                                        class="form-horizontal form-bordered frm-submit-data" enctype="multipart/form-data"
                                        method="POST">
                                        @csrf
                                        
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-md-3 control-label">Label</label>
                                                <div class="col-md-6">
                                                    <input type="text" name="label" class="form-control"
                                                        value=""
                                                        required>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-md-3 control-label">Name</label>
                                                <div class="col-md-6">
                                                    <input type="text" name="name" class="form-control"
                                                        value=""
                                                        required>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-md-3 control-label">Placeholder</label>
                                                <div class="col-md-6">
                                                    <input type="text" name="placeholder" class="form-control"
                                                        value=""
                                                        required>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-md-3 control-label">Type</label>
                                                <div class="col-md-6">
                                                    <input type="text" name="type" class="form-control"
                                                        value=""
                                                        required>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-md-3 control-label">Is Required</label>
                                                <div class="col-md-6">
                                                    <select class="form-control" name="is_required" id="" required>
                                                        <option disabled selected>Is this field required ?</option>
                                                        <option value="1">Yes</option>
                                                        <option value="0">No</option>
                                                    </select>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Add</button>
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
