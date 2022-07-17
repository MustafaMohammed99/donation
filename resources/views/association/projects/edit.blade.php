@extends('layouts.dashboard_association')

@section('page-title', "Edit Project $project->title")

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('projects.update', $project->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')

                @include('association.projects._form_edit')
            </form>
        </div>
    </div>
@endsection
