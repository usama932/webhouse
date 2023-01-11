@extends('layouts.index')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Enquiries</h4>
                            {{-- <a class="btn btn-primary" href="{{ route('add_admin_contact_field') }}">Add Contact Field</a> --}}
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Sender Name</th>
                                        <th>Sender Email</th>
                                        <th>Message</th>
                                        {{-- <th>Type</th> --}}
                                        {{-- <th>Actions</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!$enquiries->isEmpty())
                                        @foreach ($enquiries as $item)
                                            <tr>
                                                <td>{{ $item->sender_name }}</td>
                                                <td>{{ $item->sender_email }}</td>
                                                <td>{{ $item->message }}</td>
                                            
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
