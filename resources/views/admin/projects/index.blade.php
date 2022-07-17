@extends('layouts.dashboard_admin')


@section('page-title')
    عرض المشاريع
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

                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-one-pending-stopping-tab" data-toggle="pill"
                                   href="#custom-tabs-one-pending-stopping" role="tab"
                                   aria-controls="custom-tabs-one-pending-stopping" aria-selected="false">Pending
                                    Stopping</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-one-declined-stopping-tab" data-toggle="pill"
                                   href="#custom-tabs-one-declined-stopping" role="tab"
                                   aria-controls="custom-tabs-one-declined-stopping" aria-selected="false">Declined
                                    Stopping</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-one-accepted-stopping-tab" data-toggle="pill"
                                   href="#custom-tabs-one-accepted-stopping" role="tab"
                                   aria-controls="custom-tabs-one-accepted-stopping" aria-selected="false">Complete
                                    partial</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-one-complete-tab" data-toggle="pill"
                                   href="#custom-tabs-one-complete" role="tab"
                                   aria-controls="custom-tabs-one-complete" aria-selected="false">Completed</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-one-failed-tab" data-toggle="pill"
                                   href="#custom-tabs-one-failed" role="tab"
                                   aria-controls="custom-tabs-one-failed" aria-selected="false">Failed</a>
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
                                                        <th>Association</th>
                                                        <th>Category</th>
                                                        <th>Title</th>
                                                        <th>Require Amount</th>
                                                        <th>Received Amount</th>
                                                        <th>Begin Project</th>
                                                        <th>Remaining Time</th>
                                                        <th>Stopping</th>
                                                        <th>Failed</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    @foreach ( $projects_accepted as $project)
                                                        <tr data-widget="expandable-table" aria-expanded="false">
                                                            <td>{{$project->association->name}}</td>
                                                            <td>{{$project->category->name}}</td>
                                                            <td>{{$project->title}}</td>
                                                            <td>{{$project->require_amount}}</td>
                                                            <td>
                                                                {{$project->received_amount ?: 0}}
                                                            </td>
                                                            <td>{{$project->start_period}}</td>
                                                            <td>{{$project->remaining_days}}</td>

                                                            <td>
                                                                <form
                                                                    action="{{ route('adminProjects.stopping', ['project' => $project->id]) }}"
                                                                    method="post">
                                                                    @csrf
                                                                    @method('put')
                                                                    <button class="btn btn-sm btn-success">إيقاف
                                                                    </button>
                                                                </form>
                                                            </td>
                                                            <td>
                                                                <form
                                                                    action="{{ route('adminProjects.failed' ,['project' => $project->id]) }}"
                                                                    method="post">
                                                                    @csrf
                                                                    @method('put')
                                                                    <button class="btn btn-sm btn-danger">فشل</button>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                        <tr class="expandable-body d-none">
                                                            <td colspan="5">
                                                                <ul style="display: none;">
                                                                    <p>
                                                                        <label>Description:</label>{{  "\t".$project->description }}
                                                                    @if($project->interval)
                                                                        <p>
                                                                            <label>Interval:</label>{{  "\t".$project->interval  }}
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
                                                        <th>Association</th>
                                                        <th>Category</th>
                                                        <th>Title</th>
                                                        <th>Require Amount</th>
                                                        <th>Created At</th>
                                                        <th>Accept</th>
                                                        <th>Declined</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach ( $projects_pending as $project)
                                                        <tr data-widget="expandable-table" aria-expanded="false">
                                                            <td>{{$project->association->name}}</td>
                                                            <td>{{$project->category->name}}</td>
                                                            <td>{{$project->title}}</td>
                                                            <td>{{$project->require_amount}}</td>
                                                            <td>{{$project->created_at}}</td>
                                                            <td>
                                                                <form
                                                                    action="{{ route('requests.update', ['id' => $project->id,"page_project"]) }}"
                                                                    method="post">
                                                                    @csrf
                                                                    @method('put')
                                                                    <button class="btn btn-sm btn-success">قبول</button>
                                                                </form>
                                                            </td>
                                                            <td>
                                                                <form
                                                                    action="{{ route('requests.destroy' ,['id' => $project->id,"page_project"]) }}"
                                                                    method="post">
                                                                    @csrf
                                                                    @method('put')
                                                                    <button class="btn btn-sm btn-danger">رفض</button>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                        <tr class="expandable-body d-none">
                                                            <td colspan="5">
                                                                <ul style="display: none;">
                                                                    <p>
                                                                        <label>Description:</label>{{  "\t".$project->description }}
                                                                    @if($project->interval)
                                                                        <p>
                                                                            <label>Interval:</label>{{  "\t".$project->interval  }}
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
                                                        <th>Association</th>
                                                        <th>Category</th>
                                                        <th>Title</th>
                                                        <th>Require Amount</th>
                                                        <th>Received Amount</th>
                                                        <th>Denial time</th>

                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach ( $projects_declined as $project)
                                                        <tr data-widget="expandable-table" aria-expanded="false">
                                                            <td>{{$project->association->name}}</td>
                                                            <td>{{$project->category->name}}</td>
                                                            <td>{{$project->title}}</td>
                                                            <td>{{$project->require_amount}}</td>
                                                            <td>
                                                                {{$project->received_amount ?: 0}}
                                                            </td>
                                                            <td>{{$project->start_period}}</td>


                                                        </tr>
                                                        <tr class="expandable-body d-none">
                                                            <td colspan="5">
                                                                <ul style="display: none;">
                                                                    <p>
                                                                        <label>Description:</label>{{  "\t".$project->description }}
                                                                    @if($project->interval)
                                                                        <p>
                                                                            <label>Interval:</label>{{  "\t".$project->interval  }}
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


                            <div class="tab-pane fade" id="custom-tabs-one-pending-stopping" role="tabpanel"
                                 aria-labelledby="custom-tabs-one-pending-stopping-tab">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <!-- ./card-header -->
                                            <div class="card-body">
                                                <table class="table table-bordered table-hover">
                                                    <thead>
                                                    <tr>
                                                        <th>Association</th>
                                                        <th>Category</th>
                                                        <th>Title</th>
                                                        <th>Require Amount</th>
                                                        <th>Received Amount</th>
                                                        <th>Created At</th>
                                                        <th>Accept</th>
                                                        <th>Declined</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @if($projects_pending_stopping !=null)
                                                        @foreach ( $projects_pending_stopping as $project)
                                                            <tr data-widget="expandable-table" aria-expanded="false">
                                                                <td>{{$project->project->association->name}}</td>
                                                                <td>{{$project->project->category->name}}</td>
                                                                <td>{{$project->project->title}}</td>
                                                                <td>{{$project->project->require_amount}}</td>
                                                                <td>
                                                                    {{$project->received_amount ?: 0}}
                                                                </td>
                                                                <td>{{$project->created_at}}</td>

                                                                <td>
                                                                    <form
                                                                        action="{{ route('requests.accept_stopping', ['project' => $project->id,'index'=>'requests']) }}"
                                                                        method="post">
                                                                        @csrf
                                                                        @method('put')
                                                                        <button class="btn btn-sm btn-success">قبول
                                                                        </button>
                                                                    </form>
                                                                </td>
                                                                <td>
                                                                    <form
                                                                        action="{{ route('requests.decline_stopping' ,['project' => $project->id,'index'=>'requests']) }}"
                                                                        method="post">
                                                                        @csrf
                                                                        @method('put')
                                                                        <button class="btn btn-sm btn-danger">رفض
                                                                        </button>
                                                                    </form>
                                                                </td>
                                                            </tr>
                                                            <tr class="expandable-body d-none">
                                                                <td colspan="5">
                                                                    <ul style="display: none;">
                                                                        <label>Reason
                                                                            Stopping:</label>{{  $project->reason_stopping }}
                                                                        <br>
                                                                        <label>Description:</label>{{  $project->project->description }}
                                                                        @if($project->project->interval)
                                                                            <p>
                                                                                <label>Interval:</label>{{  $project->project->interval }}
                                                                            </p>
                                                                        @endif
                                                                    </ul>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                            <!-- /.card-body -->
                                        </div>
                                        <!-- /.card -->
                                    </div>
                                </div>

                            </div>

                            <div class="tab-pane fade" id="custom-tabs-one-declined-stopping" role="tabpanel"
                                 aria-labelledby="custom-tabs-one-declined-stopping-tab">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <!-- ./card-header -->
                                            <div class="card-body">
                                                <table class="table table-bordered table-hover">
                                                    <thead>
                                                    <tr>
                                                        <th>Association</th>
                                                        <th>Category</th>
                                                        <th>Title</th>
                                                        <th>Require Amount</th>
                                                        <th>Received Amount</th>
                                                        <th>Created At</th>

                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    @if($projects_declined_stopping !=null)
                                                        @foreach ( $projects_declined_stopping as $project)
                                                            <tr data-widget="expandable-table" aria-expanded="false">
                                                                <td>{{$project->project->association->name}}</td>
                                                                <td>{{$project->project->category->name}}</td>
                                                                <td>{{$project->project->title}}</td>
                                                                <td>{{$project->project->require_amount}}</td>
                                                                <td>{{$project->project->received_amount}}</td>
                                                                <td>{{$project->updated_at}}</td>

                                                            </tr>
                                                            <tr class="expandable-body d-none">
                                                                <td colspan="5">
                                                                    <ul style="display: none;">
                                                                        <label>Reason
                                                                            Stopping:</label>{{  $project->reason_stopping }}
                                                                        <br>
                                                                        <label>Description:</label>{{  $project->project->description }}
                                                                        @if($project->project->interval)
                                                                            <p>
                                                                                <label>Interval:</label>{{  $project->project->interval }}
                                                                            </p>
                                                                        @endif
                                                                    </ul>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @endif

                                                    </tbody>
                                                </table>
                                            </div>
                                            <!-- /.card-body -->
                                        </div>
                                        <!-- /.card -->
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="custom-tabs-one-accepted-stopping" role="tabpanel"
                                 aria-labelledby="custom-tabs-one-accepted-stopping-tab">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <!-- ./card-header -->
                                            <div class="card-body">
                                                <table class="table table-bordered table-hover">
                                                    <thead>
                                                    <tr>
                                                        <th>Association</th>
                                                        <th>Category</th>
                                                        <th>Title</th>
                                                        <th>Require Amount</th>
                                                        <th>Received Amount</th>
                                                        <th>Created At</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @if($projects_completed_partial !=null)
                                                        @foreach ( $projects_completed_partial as $project)
                                                            <tr data-widget="expandable-table" aria-expanded="false">
                                                                <td>{{$project->association->name}}</td>
                                                                <td>{{$project->category->name}}</td>
                                                                <td>{{$project->title}}</td>
                                                                <td>{{$project->require_amount}}</td>
                                                                <td>
                                                                    {{$project->received_amount ?: 0}}
                                                                </td>
                                                                <td>{{$project->updated_at}}</td>

                                                            </tr>
                                                            <tr class="expandable-body d-none">
                                                                <td colspan="5">
                                                                    <ul style="display: none;">
                                                                        <label>Reason
                                                                            Stopping:</label>{{  $project->project_stopping->reason_stopping ?? "المشرف من قام بالايقاف" }}
                                                                        <br>
                                                                        <label>Description:</label>{{  $project->description }}
                                                                        @if($project->interval)
                                                                            <p>
                                                                                <label>Interval:</label>{{  $project->interval }}
                                                                            </p>
                                                                        @endif
                                                                    </ul>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                            <!-- /.card-body -->
                                        </div>
                                        <!-- /.card -->
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="custom-tabs-one-complete" role="tabpanel"
                                 aria-labelledby="custom-tabs-one-complete-tab">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <!-- ./card-header -->
                                            <div class="card-body">
                                                <table class="table table-bordered table-hover">
                                                    <thead>
                                                    <tr>
                                                        <th>Association</th>
                                                        <th>Category</th>
                                                        <th>Title</th>
                                                        <th>Require Amount</th>
                                                        <th>Received Amount</th>
                                                        <th>Created At</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach ( $projects_completed as $project)
                                                        <tr data-widget="expandable-table" aria-expanded="false">
                                                            <td>{{$project->association->name}}</td>
                                                            <td>{{$project->category->name}}</td>
                                                            <td>{{$project->title}}</td>
                                                            <td>{{$project->require_amount}}</td>
                                                            <td>
                                                                {{$project->received_amount ?: 0}}
                                                            </td>
                                                            <td>{{$project->start_period}}</td>

                                                        </tr>
                                                        <tr class="expandable-body d-none">
                                                            <td colspan="5">
                                                                <ul style="display: none;">
                                                                    <label>Description:</label>{{  $project->description }}
                                                                    @if($project->interval)
                                                                        <p>
                                                                            <label>Interval:</label>{{  $project->interval  }}
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

                            <div class="tab-pane fade" id="custom-tabs-one-failed" role="tabpanel"
                                 aria-labelledby="custom-tabs-one-failed-tab">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <!-- ./card-header -->
                                            <div class="card-body">
                                                <table class="table table-bordered table-hover">
                                                    <thead>
                                                    <tr>
                                                        <th>Association</th>
                                                        <th>Category</th>
                                                        <th>Title</th>
                                                        <th>Require Amount</th>
                                                        <th>Received Amount</th>
                                                        <th>Created At</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach ( $projects_failed as $project)
                                                        <tr data-widget="expandable-table" aria-expanded="false">
                                                            <td>{{$project->association->name}}</td>
                                                            <td>{{$project->category->name}}</td>
                                                            <td>{{$project->title}}</td>
                                                            <td>{{$project->require_amount}}</td>
                                                            <td>
                                                                {{$project->received_amount ?: 0}}
                                                            </td>
                                                            <td>{{$project->start_period}}</td>

                                                        </tr>
                                                        <tr class="expandable-body d-none">
                                                            <td colspan="5">
                                                                <ul style="display: none;">
                                                                    <label>Description:</label>{{  $project->description }}
                                                                    @if($project->interval)
                                                                        <p>
                                                                            <label>Interval:</label>{{  $project->interval  }}
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

