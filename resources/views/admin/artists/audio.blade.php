@extends('admin.layouts.master')
@section('content')
<div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Dashboard</h4></div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="{{ route('artists.index') }}">Manage Artist </a></li>
                    <li class="active">Edit Artist Audio</li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    @include('admin.partials._msg')
                    <h3 class="box-title m-b-0"> Artist Audio-> {{ $user->name }}</h3>
                    {{ Form::model($user, ['method' => 'Post','route' => ['artist-audio-status'],'class'=>'form-horizontal','enctype'=>'multipart/form-data'])}}
                    <p><b>Name : </b> {{$user->name}}</p>
                    <p><b>Composer Name : </b> {{$user->composer_name}}</p>
                    <p><b>Album : </b> {{$user->album->name}}</p>
                    @if($user->thumbnail)
                        <div class="col-md-12 form-group">
                        <label for="">Thumbnail</label>
                        <img src="{{asset("uploads/audio/$user->thumbnail")}}" width="200px" alt="">
                        </div>
                    @endif
                    @if($user->audio)
                        <div class="col-md-12 form-group">
                            <label for="">Audio</label>
                            <audio controls>
                                <source src="{{asset("uploads/audio/$user->audio")}}" >
                                {{--                            <source src="horse.mp3" type="audio/mpeg">--}}
                                Your browser does not support the audio element.
                            </audio>
                        </div>

                    @endif
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Status</label>
                        <input type="hidden" id="" name="id" value="{{$user->id}}">
                        <div class="col-sm-4">
                            <select name="status" id="" class="form-control">
                                <option value="0" @if($user->status == 0) selected @endif>Off</option>
                                <option value="1" @if($user->status == 1) selected @endif>On</option>
                            </select>

                        </div>
                    </div>


                    <div class="form-group m-b-0">
                        <div class="col-sm-offset-3 col-sm-4 text-center">
                            <a href="{{ route('artists.index') }}" class="btn btn-info waves-effect waves-light
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

