@extends('layouts.dashboard_association')

@section('page-title', 'انشاء مشروع')

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
        <form action="{{route('projects.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            @include('association.projects._form')
        </form>
    </div>
@endsection

