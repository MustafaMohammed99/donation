@extends('layouts.dashboard_admin')

@section('page-title', 'انشاء مشرف')

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
        <form action="{{route('admins.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            @include('admin.admins._form')
        </form>
    </div>
@endsection

