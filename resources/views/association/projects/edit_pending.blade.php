@extends('layouts.dashboard_association')

@section('page-title', "تعديل مشروع  $project->title")

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('projects.update', $project->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')

                @include('association.projects._form')
            </form>
        </div>
    </div>
@endsection
