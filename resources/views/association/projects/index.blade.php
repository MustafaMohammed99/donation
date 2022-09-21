@extends('layouts.dashboard_association')


@section('page-title')
    المشاريع
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
                                   aria-controls="custom-tabs-one-accepted" aria-selected="true">المقبولة</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-one-pending-tab" data-toggle="pill"
                                   href="#custom-tabs-one-pending" role="tab"
                                   aria-controls="custom-tabs-one-pending" aria-selected="false">قيد انتظار القبول</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-one-declined-tab" data-toggle="pill"
                                   href="#custom-tabs-one-declined" role="tab"
                                   aria-controls="custom-tabs-one-declined" aria-selected="false">المرفوضة</a>
                            </li>


                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-one-pending-stopping-tab" data-toggle="pill"
                                   href="#custom-tabs-one-pending-stopping" role="tab"
                                   aria-controls="custom-tabs-one-pending-stopping" aria-selected="false">قيد انتظار
                                    التوقيف</a>
                            </li>


                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-one-declined-stopping-tab" data-toggle="pill"
                                   href="#custom-tabs-one-declined-stopping" role="tab"
                                   aria-controls="custom-tabs-one-declined-stopping" aria-selected="false">مرفوضة
                                    التوقيف</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-one-accepted-stopping-tab" data-toggle="pill"
                                   href="#custom-tabs-one-accepted-stopping" role="tab"
                                   aria-controls="custom-tabs-one-accepted-stopping" aria-selected="false">مقبولة
                                    التوقيف</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-one-complete-tab" data-toggle="pill"
                                   href="#custom-tabs-one-complete" role="tab"
                                   aria-controls="custom-tabs-one-complete" aria-selected="false">مكتملة</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-one-failed-tab" data-toggle="pill"
                                   href="#custom-tabs-one-failed" role="tab"
                                   aria-controls="custom-tabs-one-failed" aria-selected="false">فاشلة</a>
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
                                                        <th>اسم القسم</th>
                                                        <th> عنوان المشروع</th>
                                                        <th> المبلغ المطلوب</th>
                                                        <th> المبلغ المستلم</th>
                                                        <th> تاريخ الانشاء</th>
                                                        <th>عمليات</th>
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
                                                            <td>{{$project->start_period}}</td>
                                                            <td>
                                                                <a
                                                                    href="{{ route('projects.edit_accepted',['project' => $project->id]) }}"
                                                                    class="btn btn-sm btn-dark">تعديل
                                                                </a>
                                                                <a
                                                                    href="{{ route('projects.detail_stopping',['project' => $project->id, 'type'=>'stopping']) }}"
                                                                    class="btn btn-sm btn-danger">إيقاف
                                                                </a>
                                                                <a
                                                                    href="{{ route('projects.detail_stopping',['project' => $project->id,'type'=>'failed']) }}"
                                                                    class="btn btn-sm btn-danger">إفشال
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        <tr class="expandable-body d-none">
                                                            <td colspan="5">
                                                                <ul style="display: none;">
                                                                    <label>Description:</label>{{  $project->description }}
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
                                                        <th>اسم القسم</th>
                                                        <th> عنوان المشروع</th>
                                                        <th> المبلغ المطلوب</th>
                                                        <th> تاريخ الانشاء</th>
                                                        <th>عمليات</th>

                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach ( $projects_pending as $project)
                                                        <tr data-widget="expandable-table" aria-expanded="false">
                                                            <td>{{$project->category->name}}</td>
                                                            <td>{{$project->title}}</td>
                                                            <td>{{$project->require_amount}}</td>
                                                            <td>{{$project->created_at}}</td>
                                                            <td>
                                                                <a
                                                                    href="{{ route('projects.edit_pending',['project' => $project->id]) }}"
                                                                    class="btn btn-sm btn-dark">تعديل
                                                                </a>

                                                                <a
                                                                    href="{{ route('projects.detail_stopping',['project' => $project->id,'type'=>'failed']) }}"
                                                                    class="btn btn-sm btn-danger">إفشال
                                                                </a>
                                                            </td>
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
                                                        <th>اسم القسم</th>
                                                        <th> عنوان المشروع</th>
                                                        <th> المبلغ المطلوب</th>
                                                        <th> تاريخ الانشاء</th>

                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach ( $projects_declined as $project)
                                                        <tr data-widget="expandable-table" aria-expanded="false">
                                                            <td>{{$project->category->name}}</td>
                                                            <td>{{$project->title}}</td>
                                                            <td>{{$project->require_amount}}</td>
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
                                                        <th>اسم القسم</th>
                                                        <th> عنوان المشروع</th>
                                                        <th> المبلغ المطلوب</th>
                                                        <th> تاريخ الانشاء</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @if($projects_pending_stopping !=null)
                                                        @foreach ( $projects_pending_stopping as $project)
                                                            <tr data-widget="expandable-table" aria-expanded="false">
                                                                <td>{{$project->project->category->name}}</td>
                                                                <td>{{$project->project->title}}</td>
                                                                <td>{{$project->project->require_amount}}</td>
                                                                <td>{{$project->created_at}}</td>

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
                                                        <th>اسم القسم</th>
                                                        <th> عنوان المشروع</th>
                                                        <th> المبلغ المطلوب</th>
                                                        <th> المبلغ المستلم</th>
                                                        <th> تاريخ الانشاء</th>

                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    @if($projects_declined_stopping !=null)
                                                        @foreach ( $projects_declined_stopping as $project)
                                                            <tr data-widget="expandable-table" aria-expanded="false">
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
                                                        <th>اسم القسم</th>
                                                        <th> عنوان المشروع</th>
                                                        <th> المبلغ المطلوب</th>
                                                        <th> تاريخ الانشاء</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @if($projects_accepted_stopping !=null)
                                                        @foreach ( $projects_accepted_stopping as $project)
                                                            <tr data-widget="expandable-table" aria-expanded="false">
                                                                <td>{{$project->project->category->name}}</td>
                                                                <td>{{$project->project->title}}</td>
                                                                <td>{{$project->project->require_amount}}</td>
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
                                                        <th>اسم القسم</th>
                                                        <th> عنوان المشروع</th>
                                                        <th> المبلغ المطلوب</th>
                                                        <th> تاريخ الانشاء</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach ( $projects_completed as $project)
                                                        <tr data-widget="expandable-table" aria-expanded="false">
                                                            <td>{{$project->category->name}}</td>
                                                            <td>{{$project->title}}</td>
                                                            <td>{{$project->require_amount}}</td>
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
                                                        <th>اسم القسم</th>
                                                        <th> عنوان المشروع</th>
                                                        <th> المبلغ المطلوب</th>
                                                        <th> تاريخ الانشاء</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach ( $projects_failed as $project)
                                                        <tr data-widget="expandable-table" aria-expanded="false">
                                                            <td>{{$project->category->name}}</td>
                                                            <td>{{$project->title}}</td>
                                                            <td>{{$project->require_amount}}</td>
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

