@extends('layouts.dashboard')


@section('page-title')
    Projects <small><a href="{{ route('projects.create') }}" class="btn btn-sm btn-outline-primary">Create</a></small>
@endsection

@section('content')
    <div class="container">
        <x-flash-message/>

        <div class="row">
            <div class="col-12 ">
                <div class="card card-primary card-tabs">
                    <div class="card-header p-0 pt-1">
                        <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="custom-tabs-one-accepted-tab" data-toggle="pill"
                                   href="#custom-tabs-one-accepted" role="tab"
                                   aria-controls="custom-tabs-one-accepted" aria-selected="true">Accepted</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-one-pending-tab" data-toggle="pill"
                                   href="#custom-tabs-one-pending" role="tab"
                                   aria-controls="custom-tabs-one-pending" aria-selected="false">Pending</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-one-declined-tab" data-toggle="pill"
                                   href="#custom-tabs-one-declined" role="tab"
                                   aria-controls="custom-tabs-one-declined" aria-selected="false">Declined</a>
                            </li>


                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-one-tabContent">
                            <div class="tab-pane show active " id="custom-tabs-one-accepted" role="tabpanel"
                                 aria-labelledby="custom-tabs-one-accepted-tab">
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
                                                        <th>Created At</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    @foreach ( $projects_accepted as $project)
                                                        <tr data-widget="expandable-table" aria-expanded="false">
                                                            <td>{{$project->category->name}}</td>
                                                            <td>{{$project->title}}</td>
                                                            <td>{{$project->require_amount}}</td>
                                                            <td>
                                                                {{$project->received_amount ?: 0}}
                                                            </td>
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

                            <div class="tab-pane fade" id="custom-tabs-one-pending" role="tabpanel"
                                 aria-labelledby="custom-tabs-one-pending-tab">
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
                                                        <th>Created At</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach ( $projects_pending as $project)
                                                        <tr data-widget="expandable-table" aria-expanded="false">
                                                            <td>{{$project->category->name}}</td>
                                                            <td>{{$project->title}}</td>
                                                            <td>{{$project->require_amount}}</td>
                                                            <td>
                                                                {{$project->received_amount ?: 0}}
                                                            </td>
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

                            <div class="tab-pane fade" id="custom-tabs-one-declined" role="tabpanel"
                                 aria-labelledby="custom-tabs-one-declined-tab">
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
                                                        <th>Created At</th>

                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach ( $projects_declined as $project)
                                                        <tr data-widget="expandable-table" aria-expanded="false">
                                                            <td>{{$project->category->name}}</td>
                                                            <td>{{$project->title}}</td>
                                                            <td>{{$project->require_amount}}</td>
                                                            <td>
                                                                {{$project->received_amount ?: 0}}
                                                            </td>
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

                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </div>

@endsection

