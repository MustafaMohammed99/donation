@extends('layouts.dashboard')

@section('page-title', 'Create Category')

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
        <form action="{{route('categories.store')}}" method="post">
            @csrf
            @include('admin.categories._form')
        </form>
    </div>
@endsection

