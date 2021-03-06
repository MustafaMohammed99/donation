@extends('layouts.dashboard_admin')

@section('page-title', "عرض الطلبات")

@section('content')

    <div class="container">
        @if ($flashMessage)
            <div class="alert alert-success"> {{ $flashMessage }} </div>
        @endif

        <div class="row">
            <div class="col-12">
                <div class="card card-primary card-tabs ">
                    <!-- ./card-header -->
                    <div class="card-header p-0 pt-1">
                        <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">

                            <li class="nav-item">
                                <a class="nav-link active" id="custom-tabs-one-request-tab" data-toggle="pill"
                                   href="#custom-tabs-one-request" role="tab"
                                   aria-controls="custom-tabs-one-request" aria-selected="true">add project </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-one-request-stopping-tab" data-toggle="pill"
                                   href="#custom-tabs-one-request-stopping" role="tab"
                                   aria-controls="custom-tabs-one-request-stopping-" aria-selected="false">project
                                    stopping</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-one-tabContent">

                            <div class="tab-pane show active " id="custom-tabs-one-request" role="tabpanel"
                                 aria-labelledby="custom-tabs-one-request-tab">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <!-- ./card-header -->
                                            <div class="card-body">
                                                <table class="table table-bordered table-hover">
                                                    <thead>
                                                    <tr>
                                                        <th>اسم الجمعية</th>
                                                        <th>القسم</th>
                                                        <th>عنوان الحاله</th>
                                                        <th>المبلغ الطلوب</th>
                                                        <th>تاريخ الانشاء</th>
                                                        <th>قبول</th>
                                                        <th>رفض</th>
                                                    </tr>
                                                    </thead>

                                                    <tbody>

                                                    @foreach ( $projects as $project)
                                                        <tr data-widget="expandable-table" aria-expanded="false">
                                                            <td>{{$project->association->name}}</td>
                                                            <td>{{$project->category->name}}</td>
                                                            <td>{{$project->title}}</td>
                                                            <td>{{$project->require_amount}}</td>
                                                            <td>{{$project->created_at}}</td>

                                                            <td>
                                                                <form
                                                                    action="{{ route('requests.update', ['id' => $project->id,"page_request"]) }}"
                                                                    method="post">
                                                                    @csrf
                                                                    @method('put')
                                                                    <button class="btn btn-sm btn-success">قبول</button>
                                                                </form>
                                                            </td>
                                                            <td>
                                                                <form
                                                                    action="{{ route('requests.destroy' ,['id' => $project->id,"page_request"]) }}"
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

                            <div class="tab-pane fade" id="custom-tabs-one-request-stopping" role="tabpanel"
                                 aria-labelledby="custom-tabs-one-request-stopping-tab">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <!-- ./card-header -->
                                            <div class="card-body">
                                                <table class="table table-bordered table-hover">
                                                    <thead>
                                                    <tr>
                                                        <th>اسم الجمعية</th>
                                                        <th>القسم</th>
                                                        <th>عنوان الحاله</th>
                                                        <th>المبلغ الطلوب</th>
                                                        <th>المبلغ المستلم</th>
                                                        <th>تاريخ ارسال الطلب</th>
                                                        <th>قبول</th>
                                                        <th>رفض</th>
                                                    </tr>
                                                    </thead>

                                                    <tbody>

                                                    @foreach ( $projects_stopping as $project)
                                                        <tr data-widget="expandable-table" aria-expanded="false">
                                                            <td>{{$project->project->association->name}}</td>
                                                            <td>{{$project->project->category->name}}</td>
                                                            <td>{{$project->project->title}}</td>
                                                            <td>{{$project->project->require_amount}}</td>
                                                            <td>{{$project->project->received_amount}}</td>
                                                            <td>{{$project->created_at}}</td>

                                                            <td>
                                                                <form
                                                                    action="{{ route('requests.accept_stopping', ['project' => $project->id,'index'=>'requests']) }}"
                                                                    method="post">
                                                                    @csrf
                                                                    @method('put')
                                                                    <button class="btn btn-sm btn-success">قبول</button>
                                                                </form>
                                                            </td>
                                                            <td>
                                                                <form
                                                                    action="{{ route('requests.decline_stopping' ,['project' => $project->id,'index'=>'requests']) }}"
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
                                                                        <label>Reason Stopping
                                                                            :</label>{{  "\t".$project->reason_stopping }}
                                                                        <br>
                                                                        <label>Description:</label>{{  "\t".$project->project->description }}

                                                                    @if($project->interval)
                                                                        <p>
                                                                            <label>Interval:</label>{{  "\t".$project->project->interval  }}
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
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>

    </div>

@endsection

