@extends('layouts.index')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Industries</h4>
                            <a class="btn btn-primary" href="{{ route('admin_add_industry') }}">Add Industry</a>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Content</th>
                                        <th>Icon</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!$industries->isEmpty())
                                        @foreach ($industries as $item)
                                            <tr>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->text }}</td>
                                                <td><img src="{{ asset($item->icon) }}" alt="" height="15px" width="15px"></td>
                                                <td><a href="{{ route('admin_edit_industry', $item->id) }}"><i class="fa fa-edit" aria-hidden="true"></i></a></td>
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
