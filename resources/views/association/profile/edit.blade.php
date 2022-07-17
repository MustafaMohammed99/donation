@extends('layouts.dashboard_association')

@section('page-title', 'Edit Profile')

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('profile.update', $association->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')

                @include('association.profile._form')
            </form>
        </div>
    </div>
@endsection
