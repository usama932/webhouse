@extends('layouts.index')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Portfolio Types</h4>
                            <a class="btn btn-primary" href="{{ route('admin_add_portfolio_type') }}">Add Portfolio Type</a>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!$portfolio_types->isEmpty())
                                        @foreach ($portfolio_types as $item)
                                            <tr>
                                                <td>{{ $item->name }}</td>
                                                <td><a href="{{ route('admin_edit_portfolio_type', $item->id) }}"><i class="fa fa-edit" aria-hidden="true"></i></a></td>
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
