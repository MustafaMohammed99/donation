@extends('layouts.dashboard')

@section('page-title', "Show Requests")

@section('content')

    <div class="container">
        @if ($flashMessage)
            <div class="alert alert-success"> {{ $flashMessage }} </div>
        @endif

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- ./card-header -->
                    <div class="card-body">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>اسم الجمعية </th>
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
                                    <form action="{{ route('requests.update', ['id' => $project->id]) }}" method="post">
                                            @csrf
                                            @method('put')
                                            <button class="btn btn-sm btn-success">قبول</button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="{{ route('requests.destroy' ,['id' => $project->id]) }}" method="post">
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

