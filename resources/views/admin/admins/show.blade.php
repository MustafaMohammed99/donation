{{--@extends('layouts.dashboard_admin')--}}

@section('page-title', 'عرض المشرف')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 ">
                <div class="card card-primary card-tabs">
                    <div class="card-header p-0 pt-1">
                        <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="custom-tabs-one-profile-tab" data-toggle="pill"
                                   href="#custom-tabs-one-profile" role="tab"
                                   aria-controls="custom-tabs-one-profile" aria-selected="true">Profile</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-one-projects-tab" data-toggle="pill"
                                   href="#custom-tabs-one-projects" role="tab"
                                   aria-controls="custom-tabs-one-projects" aria-selected="false">Projects</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-one-tabContent">
                            <div class="tab-pane show active " id="custom-tabs-one-profile" role="tabpanel"
                                 aria-labelledby="custom-tabs-one-profile-tab">
                                <div>
                                    <ul>
                                        <li><label>Name:</label>{{  "\t".$admin->name }}</li>
                                        <li><label>Email:</label>{{ "\t".   $admin->email }}</li>
                                        <li><label>Address:</label>{{ "\t".  $admin->address }}</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-one-projects" role="tabpanel"
                                 aria-labelledby="custom-tabs-one-projects-tab">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">

                                            <!-- ./card-header -->
                                            <div class="card-body">
                                                <table class="table">
                                                    <thead>
                                                    <tr>
                                                        <th>Category</th>
{{--                                                        <th>Category</th>--}}
{{--                                                        <th>Title</th>--}}
{{--                                                        <th>Require Amount</th>--}}
{{--                                                        <th>Received Amount</th>--}}
{{--                                                        <th>Before Status</th>--}}
{{--                                                        <th>Status</th>--}}
{{--                                                        <th>Created At</th>--}}
                                                    </tr>
                                                    </thead>

                                                    <tbody>

                                                    @foreach ( $projects as $project)
                                                        <tr >
{{--                                                            <td>{{$project->admin_monitor_status_of_projects->project_monitor->association->name}}</td>--}}
{{--                                                            <td>{{$project->admin_monitor_status_of_projects->project_monitor->category->name}}</td>--}}
{{--                                                            <td>{{$project->admin_monitor_status_of_projects->project_monitor->title}}</td>--}}
{{--                                                            <td>{{$project->admin_monitor_status_of_projects->project_monitor->require_amount}}</td>--}}
{{--                                                            <td>--}}
{{--                                                                {{$project->admin_monitor_status_of_projects->project_monitor->received_amount ?: 0}}--}}
{{--                                                            </td>--}}
                                                            <td>{{$project->admin_monitor_status_of_projects->before_edit}}</td>
{{--                                                            <td>{{$project->admin_monitor_status_of_projects->status}}</td>--}}
{{--                                                            <td>{{$project->admin_monitor_status_of_projects->project_monitor->created_at}}</td>--}}
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

