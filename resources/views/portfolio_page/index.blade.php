@extends('layouts.index')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Portfolio Page</h4>
                    </div>
                    <div class="card-body">
                        {{-- <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Add</a>
                            </li>
                        </ul> --}}
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade active show" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <form action="{{ route('update_admin_portfolio_page') }}" class="form-horizontal form-bordered frm-submit-data" enctype="multipart/form-data" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-3 control-label">heading</label>
                                            <div class="col-md-6">
                                                <input name="heading" class="form-control" value="{{isset($portfolio_page->heading) ? $portfolio_page->heading : '' }}" >
                                            </div>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-3 control-label">Description</label>
                                            <div class="col-md-6">
                                                @if (isset($portfolio_page->description))
                                                    <textarea name="description" class="form-control" cols='5'>{{ $portfolio_page->description }}</textarea>
                                                @else
                                                    <textarea name="description" class="form-control" cols='5'></textarea>
                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                                                
                
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-3 control-label">Image One</label>
                                            <div class="col-md-6">
                                                <input type="file" name="image_1" class="form-control" >
                                            </div>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-3 control-label">Image Two</label>
                                            <div class="col-md-6">
                                                <input type="file" name="image_2" class="form-control" >
                                            </div>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-3 control-label">Image Three</label>
                                            <div class="col-md-6">
                                                <input type="file" name="image_3" class="form-control" >
                                            </div>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-3 control-label">Image Four</label>
                                            <div class="col-md-6">
                                                <input type="file" name="image_4" class="form-control" >
                                            </div>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-3 control-label">Image Five</label>
                                            <div class="col-md-6">
                                                <input type="file" name="image_5" class="form-control" >
                                            </div>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-3 control-label">Image Six</label>
                                            <div class="col-md-6">
                                                <input type="file" name="image_6" class="form-control" >
                                            </div>

                                        </div>
                                    </div>
                                    
    
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-3 control-label">Portfolio Heading</label>
                                            <div class="col-md-6">
                                                @if (isset($portfolio_page->portfolio_heading))
                                                    <textarea name="portfolio_heading" class="form-control" cols='5'>{{ $portfolio_page->portfolio_heading }}</textarea>
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
                                                @if (isset($portfolio_page->portfolio_text))
                                                    <textarea name="portfolio_text" class="form-control" cols='5'>{{ $portfolio_page->portfolio_text }}</textarea>
                                                @else
                                                    <textarea name="portfolio_text" class="form-control" cols='5'></textarea>
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
