@extends('layouts.index')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Contact Page</h4>
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
                                    <form action="{{ route('update_admin_contact_page') }}"
                                        class="form-horizontal form-bordered frm-submit-data" enctype="multipart/form-data"
                                        method="POST">
                                        @csrf
                                        
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-md-3 control-label">Contact Page Heading</label>
                                                <div class="col-md-6">
                                                    <input type="text" name="heading" class="form-control"
                                                        value="{{ isset($contact_page->heading) ? $contact_page->heading : '' }}"
                                                        required>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-md-3 control-label">Contact Page Text</label>
                                                <div class="col-md-6">
                                                    @if (isset($contact_page->text))
                                                        <textarea name="text" class="form-control" cols='5'>{{ $contact_page->text }}</textarea>
                                                    @else
                                                        <textarea name="text" class="form-control" cols='5'></textarea>
                                                    @endif
                                                </div>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-md-3 control-label">Form Heading</label>
                                                <div class="col-md-6">
                                                    <input type="text" name="form_heading" class="form-control"
                                                        value="{{ isset($contact_page->form_heading) ? $contact_page->form_heading : '' }}"
                                                        required>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-md-3 control-label">Form Text</label>
                                                <div class="col-md-6">
                                                    @if (isset($contact_page->form_text))
                                                        <textarea name="form_text" class="form-control" cols='5'>{{ $contact_page->form_text }}</textarea>
                                                    @else
                                                        <textarea name="form_text" class="form-control" cols='5'></textarea>
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
