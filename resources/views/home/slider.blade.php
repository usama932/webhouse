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
                                <a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="false">View</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Add</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade active show" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <tbody>
                                            <tr>
                                                <th>Sno</th>
                                                <th>Image</th>
                                                <th>Heading Text</th>
                                                <th>Description</th>
                                                <th>Button text</th>
                                                <th>Button URL</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                           <?php $count = 1;  ?>
                                            @foreach($slider as $row)
                                            <tr>
                                                <td>{{$count++}}</td>
                                                <td>
                                                    <img alt="image" src="images/slider/{{ $row->img}}" class="rounded-circle" width="35" data-toggle="tooltip" title="" data-original-title="Wildan Ahdian">
                                                </td>
                                                <td>{{ $row->heading_text }}</td>
                                                <td>{{ $row->description }}</td>
                                                <td>{{ $row->button_text }}</td>
                                                <td>{{ $row->button_url }}</td>
                                                <td><a  href="status/{{$row->id}}" class="btn btn-sm btn-warning">@if($row->status==1)Active @else Deactive  @endif</a></td>
                                                <td>
                                                    <button  class="btn btn-sm btn-icon btn-danger" onclick="confirm_modal('deleteslider/{{$row->id}}')"><i class="far fa-trash-alt"></i></button>
                                                    <a href="sliderEdit/{{$row->id}}" class="btn btn-sm btn-icon btn-success"><i class="far fa-edit"></i></a>
                                                </td>
                                                
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
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