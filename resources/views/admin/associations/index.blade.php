@extends('layouts.dashboard')

@section('page-title')
    Associations <small><a href="{{ route('associations.create') }}" class="btn btn-sm btn-outline-primary">Create</a></small>
@endsection

@section('content')
            <x-flash-message  />

{{--    @if ($flashMessage)--}}
{{--        <div class="alert alert-success"> {{ $flashMessage }} </div>--}}
{{--    @endif--}}

    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Address</th>
                <th>email</th>
                <th>Created At</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody>

                        @foreach ($associations as $association)
                            <tr>
                                <td>{{ $association->id }}</td>
                                <td><a href="{{ route('associations.show', ['association' => $association->id]) }}">{{ $association->name }}</a></td>
                                <td>{{ $association->address }}</td>
                                <td>{{ $association->email }}</td>
                                <td>{{ $association->created_at }}</td>
                                <td>
                                    <form action="{{ route('associations.destroy', $association->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center">
        {!! $associations->links() !!}
    </div>
{{--    {{ $associations->withQueryString()->appends(['q' => 'test'])->links() }}--}}

@endsection
