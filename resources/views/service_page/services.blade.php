@extends('layouts.index')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Services</h4>
                            <a class="btn btn-primary" href="{{ route('admin_add_service') }}">Add Service</a>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Image</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!$services->isEmpty())
                                        @foreach ($services as $item)
                                            <tr>
                                                <td>{{ $item->name }}</td>
                                                <td><img src="{{ asset($item->image) }}" height="20px" width="20px" alt="" srcset=""></td>
                                                <td><a href="{{ route('admin_edit_service', $item->id) }}"><i class="fa fa-edit" aria-hidden="true"></i></a></td>
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
