@extends('layouts.dashboard_admin')

@section('page-title', 'Edit Category')

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('categories.update', $category->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')

                @include('admin.categories._form')
            </form>
        </div>
    </div>
@endsection
