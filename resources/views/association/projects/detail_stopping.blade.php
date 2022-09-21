@extends('layouts.dashboard_association')

@section('page-title', 'تفاصيل ايقاف المشروع')

@section('content')
    <div class="card">
        <div class="card-body">
            @if($type === 'failed')
                <form action="{{ route('projects.failed') }}" method="post">
                    @csrf
                    @include('association.projects._form_detail_stopping')
                </form>
            @else
                <form action="{{ route('projects.stopping') }}" method="post">
                    @csrf
                    @include('association.projects._form_detail_stopping')
                </form>
            @endif

        </div>
    </div>
@endsection
