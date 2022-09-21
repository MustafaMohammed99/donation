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
                                   aria-controls="custom-tabs-one-request" aria-selected="true">قيد انتظار القبول </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-one-request-stopping-tab" data-toggle="pill"
                                   href="#custom-tabs-one-request-stopping" role="tab"
                                   aria-controls="custom-tabs-one-request-stopping-" aria-selected="false">قيد انتظار
                                    التوقيف</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-one-pending-failed-tab" data-toggle="pill"
                                   href="#custom-tabs-one-pending-failed" role="tab"
                                   aria-controls="custom-tabs-one-pending-failed" aria-selected="false">قيد انتظار
                                    الفشل</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-one-tabContent">

                            <div class="tab-pane show active " id="custom-tabs-one-request" role="tabpanel"
                                 aria-labelledby="custom-tabs-one-request-tab">

                                <div class="card">
                                    <!-- ./card-header -->
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="datatable_pending" class="table">
                                                <thead>
                                                <tr>
                                                    <th> اسم الجمعية</th>
                                                    <th> اسم القسم</th>
                                                    <th>عنوان المشروع</th>
                                                    <th> المبلغ الطلوب</th>
                                                    <th>تاريخ الانشاء</th>
                                                    <th> العمليات</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                </div>

                            </div>

                            <div class="tab-pane fade" id="custom-tabs-one-request-stopping" role="tabpanel"
                                 aria-labelledby="custom-tabs-one-request-stopping-tab">
                                <div class="card">
                                    <!-- ./card-header -->
                                    <div class="card-body">
                                        <div class="table-responsive ">
                                            <table class="table " id="datatable_pending_stopping">
                                                <thead>
                                                <tr>
                                                    <th> اسم الجمعية</th>
                                                    <th> اسم القسم</th>
                                                    <th>عنوان المشروع</th>
                                                    <th> المبلغ الطلوب</th>
                                                    <th> المبلغ المتبقي</th>
                                                    <th> الوقت المتبقي</th>
                                                    <th width="300px"> العمليات</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                </div>

                            </div>

                            <div class="tab-pane " id="custom-tabs-one-pending-failed" role="tabpanel"
                                 aria-labelledby="custom-tabs-one-pending-failed-tab">

                                <div class="card">
                                    <!-- ./card-header -->
                                    <div class="card-body">
                                        <div class="table-responsive ">
                                            <table class="table " id="datatable_pending_failed">
                                                <thead>
                                                <tr>
                                                    <th>اسم الجمعية</th>
                                                    <th>اسم القسم</th>
                                                    <th> عنوان المشروع</th>
                                                    <th>المبلغ المطلوب</th>
                                                    <th>المبلغ المتبقي</th>
                                                    <th> الوقت المتبقي</th>
                                                    <th width="300px">العمليات</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->


                            </div>

                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>

    </div>

    <div class="scrolling-inside-modal">
        <!-- Modal -->
        <div class="modal fade" id="modalScrollable" tabindex="-1" aria-labelledby="exampleModalScrollableTitle"
             style="display: none;" aria-hidden="true">

            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalScrollableTitle">عرض تفاصيل المشروع </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>

                    <div class="modal-body">

                        <h4 class="modal_admin" style=" color: cornflowerblue; text-align: center;">المشرفين الذين
                            اشرفوا على المشروع</h4>
                        <div class="modal_admin">
                            <table class="table" id="modal_table">
                                <thead>
                                <tr>
                                    <th>اسم المشرف</th>
                                    <th>ايميل</th>
                                    <th>تاريخ العملية</th>
                                </tr>
                                </thead>
                                <tbody id="modal_body_table">

                                </tbody>
                            </table>
                            <hr>
                        </div>

                        <div>
                            <div id="class_modal_reason_stopping">
                                <span style="font-weight: bold"> السبب   </span>
                                <span id="modal_reason_stopping">    </span>
                                <br>
                            </div>
                            <br>

                            <span style="font-weight: bold"> اسم الجمعية:  </span>
                            <span id="modal_association">    </span>
                            <br>
                            <br>
                            <span style="font-weight: bold"> القسم:  </span>
                            <span id="modal_category">    </span>
                            <br>
                            <br>
                            <span style="font-weight: bold"> عنوان المشروع:  </span>
                            <span id="modal_title">    </span>
                            <br>
                            <br>
                            <span style="font-weight: bold"> الوصف:  </span>
                            <span id="modal_description">    </span>
                            <br>
                            <br>
                            <span style="font-weight: bold"> المبلغ المطلوب:  </span>
                            <span id="modal_require_amount">    </span>
                            <br>
                            <br>
                            <span style="font-weight: bold"> المبلغ المستلم:  </span>
                            <span id="modal_received_amount">    </span>
                            <br>
                            <br>

                            <span style="font-weight: bold"> بداية قبول المشروع:  </span>
                            <span id="modal_start_period">    </span>
                            <br>
                            <br>
                            <span style="font-weight: bold"> نهاية فترةالمشروع:  </span>
                            <span id="modal_end_period">    </span>
                            <br>
                            <br>
                            <span style="font-weight: bold"> عدد ايام المشروع:  </span>
                            <span id="modal_interval">    </span>
                            <br>
                            <br>
                            <span style="font-weight: bold"> عدد المستفيدين:  </span>
                            <span id="modal_num_benf">    </span>
                            <br>
                            <br>
                            <span style="font-weight: bold"> الحالة:  </span>
                            <span id="modal_status">    </span>
                            <br>
                            <br>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary waves-effect waves-float waves-light"
                                data-dismiss="modal">Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function () {

            // tap pending
            $('#datatable_pending').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "{{ route('adminProjects.ajax_project_pending') }}",
                "columns": [

                    {"data": "association"},
                    {"data": "category"},
                    {"data": "title"},
                    {"data": "require_amount"},
                    {"data": "created_at"},
                    {
                        data: "action", render: function (data, type, row) {
                            var btn = "<button  style='display: inline-block' id='project_:id'  data-id= ':id' data-original-title='show'" +
                                " class='btn btn-sm btn-primary show_project_pending'>عرض</button>";

                            btn += "<button  style='display: inline-block' id='project_:id'  data-id= ':id' data-original-title='accept'" +
                                " class='btn btn-sm btn-success m-1 accept_project_pending'>قبول</button>";

                            btn += "<button  style='display: inline-block' id='project_:id'  data-id= ':id' data-original-title='decliened'" +
                                " class='btn btn-sm btn-danger m-1  declined_project_pending'>رفض</button>";

                            return btn.replaceAll(':id', row.id);
                        }
                    },
                ]
            });

            // tap pending_stopping
            $('#datatable_pending_stopping').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "{{ route('adminProjects.ajax_project_pending_stopping') }}",
                "columns": [

                    {"data": "association"},
                    {"data": "category"},
                    {"data": "title"},
                    {"data": "require_amount"},
                    {"data": "remaining_amount"},
                    {"data": "remaining_days"},
                    {
                        data: "action", render: function (data, type, row) {
                            var btn = "<button  style='display: inline-block' id='project_:id'  data-id= ':id' data-original-title='show'" +
                                " class='btn btn-sm btn-primary show_project_pending_stopping'>عرض</button>";

                            btn += "<button  style='display: inline-block' id='project_:id'  data-id= ':id' data-original-title='accept'" +
                                " class='btn btn-sm btn-success m-1 accept_project_pending_stopping'>قبول</button>";

                            btn += "<button  style='display: inline' id='project_:id'  data-id= ':id' data-original-title='decliened'" +
                                " class='btn btn-sm btn-danger m-1  declined_project_pending_stopping'>رفض</button>";

                            return btn.replaceAll(':id', row.id);
                        }
                    },
                ]
            });

            //tab pending_failed
            $('#datatable_pending_failed').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "{{ route('adminProjects.ajax_project_pending_failed') }}",
                "columns": [
                    {"data": "association"},
                    {"data": "category"},
                    {"data": "title"},
                    {"data": "require_amount"},
                    {"data": "remaining_amount"},
                    {"data": "remaining_days"},
                    {
                        data: "action", render: function (data, type, row) {
                            var btn = "<button  style='display: inline-block' id='project_:id'  data-id= ':id' data-original-title='show'" +
                                " class='btn btn-sm btn-primary show_project_pending_failed'>عرض</button>";

                            btn += "<button  style='display: inline-block' id='project_:id'  data-id= ':id' data-original-title='accept'" +
                                " class='btn btn-sm btn-success m-1 accept_project_pending_failed'>قبول</button>";

                            btn += "<button  style='display: inline' id='project_:id'  data-id= ':id' data-original-title='decliened'" +
                                " class='btn btn-sm btn-danger m-1  declined_project_pending_failed'>رفض</button>";

                            return btn.replaceAll(':id', row.id);
                        }
                    },
                ]
            });


        });

        // tap pending
        $(document).on('click', '.accept_project_pending', function (e) {
            e.preventDefault();
            let project_id = $(this).data("id");
            var url = '{{ route("requests.update", ["project"=> ":project" ]) }}';
            url = url.replace(':project', project_id);

            Swal.fire({
                title: 'هل أنت متأكد من قبول المشروع؟',
                text: "لن تتمكن من التراجع عن هذا!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'نعم ، قبول!',
                cancelButtonText: 'إلغاء'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            _token: '{{csrf_token()}}',
                            _method: 'PUT',
                            project: project_id,
                        },
                        success: function (response) {
                            var table_pending = $('#datatable_pending').dataTable();
                            table_pending.fnDraw(false);
                            console.log(response);
                            Swal.fire(
                                'قبول!',
                                'تم قبول المشروع.',
                                'success'
                            )
                        }
                    });
                }
            })
        });

        $(document).on('click', '.declined_project_pending', function (e) {
            e.preventDefault();
            let project_id = $(this).data("id");
            var url = '{{ route("requests.destroy", ["project"=> ":project" ]) }}';
            url = url.replace(':project', project_id);

            Swal.fire({
                title: 'هل أنت متأكد من رفض المشروع؟',
                text: "لن تتمكن من التراجع عن هذا!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'نعم ، رفض!',
                cancelButtonText: 'إلغاء'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            _token: '{{csrf_token()}}',
                            _method: 'PUT',
                            project: project_id,
                        },
                        success: function (response) {
                            var table_pending = $('#datatable_pending').dataTable();
                            table_pending.fnDraw(false);
                            console.log(response);
                            Swal.fire(
                                'إلفاء!',
                                'تم رفض المشروع.',
                                'success'
                            )
                        }
                    });
                }
            })
        });

        $(document).on('click', '.show_project_pending', function (e) {
            e.preventDefault();
            let project_id = $(this).data("id");
            $('#modalScrollable').modal('show');
            var url = '{{ route("adminProjects.ajax_show_project_pending", ["project"=> ":project" ]) }}';
            url = url.replace(':project', project_id);
            $.ajax({
                url: url,
                type: 'get',
                dataType: 'json',
                success: function (response) {
                    showDetailModal(response, false);
                }
            });
        });

        // tap pending_stopping
        $(document).on('click', '.accept_project_pending_stopping', function (e) {
            e.preventDefault();
            let project_id = $(this).data("id");
            var url = '{{ route("requests.accept_stopping", ["project"=> ":project" ]) }}';
            url = url.replace(':project', project_id);

            Swal.fire({
                title: 'هل أنت متأكد من قبول  توقيف المشروع؟',
                text: "لن تتمكن من التراجع عن هذا!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'نعم ،  قبول!',
                cancelButtonText: 'إلغاء'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            _token: '{{csrf_token()}}',
                            _method: 'PUT',
                            project: project_id,
                        },
                        success: function (response) {
                            var table_pending_stopping = $('#datatable_pending_stopping').dataTable();
                            table_pending_stopping.fnDraw(false);
                            console.log(response);
                            Swal.fire(
                                'قبول!',
                                'تم قبول  توقيف المشروع بنجاح.',
                                'success'
                            )
                        }
                    });
                }
            })
        });

        $(document).on('click', '.declined_project_pending_stopping', function (e) {
            e.preventDefault();
            let project_id = $(this).data("id");
            var url = '{{ route("requests.decline_stopping", ["project"=> ":project" ]) }}';
            url = url.replace(':project', project_id);

            Swal.fire({
                title: 'هل أنت متأكد من رفض  توقيف المشروع؟',
                text: "لن تتمكن من التراجع عن هذا!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'نعم ، رفض!',
                cancelButtonText: 'إلغاء'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            _token: '{{csrf_token()}}',
                            _method: 'PUT',
                            project: project_id,
                        },
                        success: function (response) {
                            var table_pending_stopping = $('#datatable_pending_stopping').dataTable();
                            table_pending_stopping.fnDraw(false);
                            console.log(response);
                            Swal.fire(
                                'إلفاء!',
                                'تم رفض توقيف المشروع.',
                                'success'
                            )
                        }
                    });
                }
            })
        });

        $(document).on('click', '.show_project_pending_stopping', function (e) {
            e.preventDefault();
            let project_id = $(this).data("id");
            $('#modalScrollable').modal('show');
            var url = '{{ route("adminProjects.ajax_show_project_pending_stopping", ["project"=> ":project" ]) }}';
            url = url.replace(':project', project_id);
            $.ajax({
                url: url,
                type: 'get',
                dataType: 'json',
                success: function (response) {
                    showDetailModal(response, true);
                    // console.log(response)
                }
            });
        });


        // tap pending_failed

        $(document).on('click', '.accept_project_pending_failed', function (e) {
            e.preventDefault();
            let project_id = $(this).data("id");
            var url = '{{ route("requests.accept_failed", ["project"=> ":project" ]) }}';
            url = url.replace(':project', project_id);

            Swal.fire({
                title: 'هل أنت متأكد من قبول  افشال المشروع؟',
                text: "لن تتمكن من التراجع عن هذا!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'نعم ،  افشال!',
                cancelButtonText: 'إلغاء'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            _token: '{{csrf_token()}}',
                            _method: 'PUT',
                            project: project_id,
                        },
                        success: function (response) {
                            var table_pending_failed = $('#datatable_pending_failed').dataTable();
                            var table_failed = $('#datatable_failed').dataTable();
                            table_pending_failed.fnDraw(false);
                            table_failed.fnDraw(false);
                            console.log(response);
                            Swal.fire(
                                'قبول!',
                                'تم قبول  ايقاف المشروع بنجاح.',
                                'success'
                            )
                        }
                    });
                }
            })
        });

        $(document).on('click', '.declined_project_pending_failed', function (e) {
            e.preventDefault();
            let project_id = $(this).data("id");
            var url = '{{ route("requests.decline_failed", ["project"=> ":project" ]) }}';
            url = url.replace(':project', project_id);

            Swal.fire({
                title: 'هل أنت متأكد من رفض  افشال المشروع؟',
                text: "لن تتمكن من التراجع عن هذا!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'نعم ، رفض!',
                cancelButtonText: 'إلغاء'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            _token: '{{csrf_token()}}',
                            _method: 'PUT',
                            project: project_id,
                        },
                        success: function (response) {
                            var table_pending_failed = $('#datatable_pending_failed').dataTable();
                            var table_failed = $('#datatable_failed').dataTable();
                            table_pending_failed.fnDraw(false);
                            table_failed.fnDraw(false);
                            console.log(response);
                            Swal.fire(
                                'إلفاء!',
                                'تم رفض توقيف المشروع.',
                                'success'
                            )
                        }
                    });
                }
            })
        });

        $(document).on('click', '.show_project_pending_failed', function (e) {
            e.preventDefault();
            let project_id = $(this).data("id");
            $('#modalScrollable').modal('show');
            var url = '{{ route("adminProjects.ajax_show_project_pending_failed", ["project"=> ":project" ]) }}';
            url = url.replace(':project', project_id);
            $.ajax({
                url: url,
                type: 'get',
                dataType: 'json',
                success: function (response) {
                    console.log(response)
                    showDetailModal(response, true);
                }
            });
        });

        function showDetailModal(response, isStopping) {

            $("#modal_body_table").empty();

            // is stopping tree json different normal
            $.each(response['project'], function (i, value) {
                if (isStopping) {
                    console.log('is_stopping' + value);
                    console.log(value['reason_stopping']);
                    entryDetailModal(value['project'], value['reason_stopping']);
                } else {
                    entryDetailModal(value,);
                    //     value['project_stopping']['reason_stopping']
                }
            });
        }

        function entryDetailModal(details_project, reason_stopping) {
            if (typeof reason_stopping !== 'undefined') {
                console.log('not empty' + reason_stopping);
                $('#modal_reason_stopping').text(reason_stopping);
                $('#class_modal_reason_stopping').show();
            } else {
                console.log('not defined' + reason_stopping);
                $('#class_modal_reason_stopping').hide();
            }


            $('#modal_association').text(details_project['association']['name']);
            $('#modal_category').text(details_project['category']['name']);
            $('#modal_title').text(details_project['title']);
            $('#modal_description').text(details_project['description']);
            $('#modal_require_amount').text(details_project['require_amount']);
            $('#modal_received_amount').text(details_project['received_amount']);
            $('#modal_start_period').text(details_project['start_period']);
            $('#modal_end_period').text(details_project['end_period']);
            $('#modal_interval').text(details_project['interval']);
            $('#modal_num_benf').text(details_project['num_beneficiaries']);
            $('#modal_status').text(details_project['status'])
            console.log(details_project)
            if (details_project.hasOwnProperty('monitor_status_of_projects')) {

                $('.modal_admin').show();
                $.each(details_project['monitor_status_of_projects'], function (index_project_status, project_status) {
                    $('#modal_body_table').append(
                        '<tr >' +
                        '<td>' + project_status['admin_project']['name'] + '</td>' +
                        '<td>' + project_status['admin_project']['email'] + '</td>' +
                        // '<td>' + project_status['admin_project']['created_at'] + '</td>' +
                        '<td>' + project_status['created_at'] + '</td>' +
                        '</tr>');
                });
            } else {
                console.log('hide');
                $('.modal_admin').hide();
            }
        }
    </script>

@endsection
