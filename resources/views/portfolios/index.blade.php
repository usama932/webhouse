@extends('layouts.index')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Portfolios</h4>
                            <a class="btn btn-primary" href="{{ route('admin_add_portfolio') }}">Add Portfolio</a>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Type</th>
                                        <th>Image</th>
                                        <th>Link</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!$portfolios->isEmpty())
                                        @foreach ($portfolios as $item)
                                            <tr>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->portfolio_type->name }}</td>
                                                <td><img src="{{ asset($item->image) }}" height="20px" width="20px" alt="" srcset=""></td>
                                                <td><a href="{{ $item->link }}" target="__blank">Portfolio Link</a></td>
                                                <td>
                                                    <a href="{{ route('admin_edit_portfolio', $item->id) }}"><i class="fa fa-edit" aria-hidden="true"></i></a>
                                                    <form action="{{ route('admin_delete_portfolio') }}" method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input type="hidden" name="id" value="{{ $item->id }}">
                                                        <button class="btn btn-sm btn-danger" type="submit"><i class="fa fa-trash" aria-hidden="true"></i></button>
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
