@extends('layouts.dashboard')

@section('page-title', "عرض المشاريع في قسم :\n$category->name")


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- ./card-header -->
                    <div class="card-body">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Category</th>
                                <th>Title</th>
                                <th>Require Amount</th>
                                <th>Received Amount</th>
                                <th>Status</th>
                                <th>Created At</th>
                            </tr>
                            </thead>

                            <tbody>

                            @foreach ( $projects as $project)
                                <tr data-widget="expandable-table" aria-expanded="false">
                                    <td>{{$category->name}}</td>
                                    <td>{{$project->title}}</td>
                                    <td>{{$project->require_amount}}</td>
                                    <td>
                                        {{$project->received_amount ?: 0}}
                                    </td>
                                    <td>{{$project->status}}</td>
                                    <td>{{$project->created_at}}</td>
                                </tr>
                                <tr class="expandable-body d-none">
                                    <td colspan="5">
                                        <ul style="display: none;">
                                            <p>
                                                <label>Description:</label>{{  "\t".$project->description }}

                                            @if($project->interval)
                                                <p>
                                                    <label>Interval:</label>{{  "\t".$project->interval ."\t    ".'Duration Unit:'."\t".$project->duration_unit }}
                                                </p>
                                            @endif


                                        </ul>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>


    </div>



@endsection

