@extends('layouts.index')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Digital Marketing Services Section Two</h4>
                            <a class="btn btn-primary" href="{{ route('admin_add_social_media_section_two') }}">Add Social Media Service</a>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Image</th>
                                        <th>Description</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!$marketing->isEmpty())
                                        @foreach ($marketing as $item)
                                            <tr>
                                                <td>{{ $item->name }}</td>
                                                <td> <img src="{{ asset($item->imag) }}" height="10px" width="10px"> </td>
                                                <td>{{ $item->description }}</td>
                                                <td>
                                                    <a href="{{ route('admin_edit_social_media_section_two', $item->id) }}"><i class="fa fa-edit" aria-hidden="true"></i></a>
                                                    <form action="{{ route('admin_delete_social_media_section_two') }}" method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input type="hidden" name="id" value="{{ $item->id }}">
                                                        <button type="submit"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

    </div>
    </section>
    </div>
@endsection
