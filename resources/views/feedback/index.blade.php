@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-10">
            <div class="card">
                <div class="card-header">
                    Feedbacks list
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Message</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @forelse($feedbacks as $feedback)
                            <tr>
                                <th scope="row">{{ $feedback->id  }}</th>
                                <td>{{ $feedback->name }}</td>
                                <td>{{ $feedback->email }}</td>
                                <td>{{ $feedback->message }}</td>
                                <td>
                                    <a href="{{ action('FeedbackController@destroy', $feedback->id) }}" class="btn btn-outline-danger btn-sm">
                                        Delete
                                    </a>
                                </td>
                            </tr>
                            @empty
                                <tr class="table-warning">
                                    <td class="text-center" colspan="5">
                                        There are no feedbacks yet.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $feedbacks->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
