@extends('admin.layouts.master')
@section('content')
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Dashboard</h4></div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="{{ route('users.index') }}">Manage Users</a></li>
                    <li class="active">Add User</li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    @include('admin.partials._msg')
                    <h3 class="box-title m-b-0">Add User</h3>
                    {{ Form::open([ 'route' => 'users.store','class'=>'form-horizontal','enctype'=>'multipart/form-data']) }}
                    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                        <label class="col-sm-3 control-label">Name</label>
                        <div class="col-sm-4">
                            {{ Form::text('name', null, ['class' => 'form-control','id'=>'name','placeholder'=>'Enter Name']) }}
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                        <label class="col-sm-3 control-label">E-Mail Address</label>
                        <div class="col-sm-4">
                            {{ Form::email('email', null, ['class' => 'form-control','id'=>'email','placeholder'=>'Enter Email Address']) }}
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
                        <label class="col-sm-3 control-label">Phone</label>
                        <div class="col-sm-4">
                            {{ Form::text('phone', null,['class' => 'form-control','id'=>'password','placeholder'=>'Enter Phone ']) }}
                            <span class="text-danger">{{ $errors->first('phone') }}</span>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                        <label class="col-sm-3 control-label">Password</label>
                        <div class="col-sm-4">
                            {{ Form::text('password', null,['class' => 'form-control','id'=>'password','placeholder'=>'Enter Password ']) }}
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-sm-3 control-label">Status</label>
                        <div class="col-sm-4">
                            <input type="checkbox" checked class="js-switch" data-color="#99d683" name="active"  value="1" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Gender</label>
                        <div class="col-sm-4">
                            <input type="radio" id="male" name="gender" value="1" checked>
                            <label for="male">Male</label><br>
                            <input type="radio" id="female" name="gender" value="0">
                            <label for="female">Female</label><br>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('image') ? 'has-error' : '' }}">
                        <label class="col-sm-3 control-label">Image</label>
                        <div class="col-sm-4">
                            {{ Form::file('image', null, ['class' => 'form-control','id'=>'logo']) }}
                            <span class="text-danger">{{ $errors->first('image') }}</span>
                        </div>
                    </div>
                    <div class="form-group m-b-0">
                        <div class="col-sm-offset-3 col-sm-4 text-center">
                            <a href="{{ route('users.index') }}" class="btn btn-info waves-effect waves-light
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
    </div>
@stop
