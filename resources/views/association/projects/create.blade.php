@extends('layouts.dashboard')

@section('page-title', 'Create Project')

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
        <form action="{{route('projects.store')}}" method="post">
            @csrf
            @include('association.projects._form')
        </form>
    </div>
@endsection

