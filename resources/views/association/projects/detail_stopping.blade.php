@extends('layouts.dashboard_association')

@section('page-title', 'Detail Stopping')

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('projects.stopping') }}" method="post">
                @csrf
                @include('association.projects._form_detail_stopping')
            </form>
        </div>
    </div>
@endsection
