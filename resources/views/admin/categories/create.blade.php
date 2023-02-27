@extends('admin.layouts.master')
@section('content')
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Dashboard</h4></div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="{{ route('categories.index') }}">Manage Categories</a></li>
                    <li class="active">Add Category</li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    @include('admin.partials._msg')
                    <h3 class="box-title m-b-0">Add Category</h3>
                    {{ Form::open([ 'route' => 'categories.store','class'=>'form-horizontal generalForm','enctype'=>'multipart/form-data']) }}
                    <div class="col-md-offset-3 col-md-6">
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            {!! Form::label('Name:') !!}
                            {{ Form::text('name', null, ['class' => 'form-control','id'=>'name','placeholder'=>'Enter Name']) }}

                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        </div>

                    </div>
                    <div class="col-md-offset-3 col-md-6">
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label class="">Image</label>
                            {{ Form::file('image', null, ['class' => 'form-control','id'=>'logo']) }}
                            <span class="text-danger">{{ $errors->first('image') }}</span>
                        </div>

                    </div>

                    <div class="form-group m-b-0">
                        <div class="col-sm-offset-3 col-sm-4 text-center">
                            <a href="{{ route('categories.index') }}" class="btn btn-info waves-effect waves-light
                                 m-t-10"><i class="fa fa-backward"></i> Back</a>
                            <button type="submit" class="btn btn-success waves-effect waves-light m-t-10">
                                <i class="fa fa-check"></i> Save</button>
                        </div>
                    </div>
                    {{Form::close()}}

                </div>
            </div>
        </div>
        <!-- /.row -->

        <!-- /.row -->
    </div>
@stop
@section("scripts")
    <script type="text/javascript">

        $('.generalForm').submit(function () {
            $('body').LoadingOverlay("show");
            $("#generalForm").submit();
        });
    </script>
@endsection
