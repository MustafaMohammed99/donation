@extends('layouts.dashboard_admin')

@section('page-title')
     عرض الاقسام
@endsection

@section('content')
{{--            <x-flash-message />--}}

    @if ($flashMessage)
        <div class="alert alert-success"> {{ $flashMessage }} </div>
    @endif
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
{{--                        <th>ID</th>--}}
                        <th>الاسم</th>
                        <th>عدد مشاريع الفسم</th>
                        <th>تاريخ الانشاء</th>
                        <th>تعديل</th>
                        <th>حذف</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach ($categories as $category)
                        <tr>
{{--                            <td>{{ $category->id }}</td>--}}
                            <td>
                                <a href="{{ route('categories.show', ['category' => $category->id]) }}">{{ $category->name }}</a>
                            </td>
                            <td>{{ $category->projects_count }}</td>
                            <td>{{ $category->created_at }}</td>
                            <td><a href="{{ route('categories.edit', [$category->id]) }}" class="btn btn-sm btn-dark">Edit</a>
                            </td>
                            <td>
                                <form action="{{ route('categories.destroy', $category->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center">
        {!! $categories->links() !!}
    </div>

@endsection
