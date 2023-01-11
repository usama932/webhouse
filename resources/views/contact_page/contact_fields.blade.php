@extends('layouts.index')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Contact Fields</h4>
                            <a class="btn btn-primary" href="{{ route('add_admin_contact_field') }}">Add Contact Field</a>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Label</th>
                                        <th>Name</th>
                                        <th>Placeholder</th>
                                        <th>Type</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!$contact_fields->isEmpty())
                                        @foreach ($contact_fields as $item)
                                            <tr>
                                                <td>{{ $item->label }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->placeholder }}</td>
                                                <td>{{ $item->type }}</td>
                                                <td><a href="{{ route('edit_admin_contact_field', $item->id) }}"><i class="fa fa-edit" aria-hidden="true"></i></a></td>
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
