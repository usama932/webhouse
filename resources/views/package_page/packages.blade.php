@extends('layouts.index')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Packages</h4>
                            <a class="btn btn-primary" href="{{ route('admin_add_package') }}">Add Package</a>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Type</th>
                                        <th>Price</th>
                                        <th>Content</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!$packages->isEmpty())
                                        @foreach ($packages as $item)
                                            <tr>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->package_type->name }}</td>
                                                <td>{{ $item->price }}</td>
                                                <td>{{ $item->content }}</td>
                                                <td>
                                                    <a href="{{ route('admin_edit_package', $item->id) }}"><i class="fa fa-edit" aria-hidden="true"></i></a>
                                                    <form action="{{ route('admin_delete_package') }}" method="post" enctype="multipart/form-data">
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
