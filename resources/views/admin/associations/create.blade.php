@extends('layouts.dashboard')

@section('page-title', 'Create Association')

@section('content')
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $message)
                        <li>{{ $message }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{route('associations.store')}}" method="post">
            @csrf
            @include('admin.associations._form')
        </form>
    </div>
@endsection

