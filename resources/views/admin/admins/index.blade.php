@extends('layouts.dashboard_admin')

@section('page-title')
    عرض المشرفين
@endsection

@section('content')
    <x-flash-message/>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive ">
                <table class="table" id="datatable">
                    <thead>
                    <tr>
                        <th>الاسم</th>
                        <th>العنوان</th>
                        <th>الايميل</th>
                        <th>نوع المشرف</th>
                        <th>العمليات</th>
                        {{--                        <th width="300px">Action</th>--}}
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
            $('#datatable').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "{{ route('admins.ajax') }}",
                "columns": [
                    {
                        data: "name", render: function (data, type, row) {
                            var url = '{{ route("admins.show", ["admin"=> ":admin" ]) }}';
                            url = url.replace(':admin', row.id);
                            return '<a href="' + url + '" > ' + row.name + ' </a>'
                        }
                    },
                    {"data": "address"},
                    {"data": "email"},
                    {"data": "isSuperAdmin"},
                    {
                        data: "action", render: function (data, type, row) {
                            var btn = "<button  id='admin_:id'  data-id= ':id' data-original-title='delete'" +
                                " class='btn btn-sm btn-danger deleteAdmin'>حذف</button>";

                            return btn.replaceAll(':id', row.id);
                        }
                    },

                ]
            });
        });


        $(document).on('click', '.deleteAdmin', function (e) {
            e.preventDefault();
            let admin_id = $(this).data("id");
            var url = '{{ route("admins.destroy", ["admin"=> ":admin" ]) }}';
            url = url.replace(':admin', admin_id);

            Swal.fire({
                title: 'هل أنت متأكد؟' ,
                // title: 'Are you sure?' + admin_id,
                text: "لن تتمكن من التراجع عن هذا!",
                // text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'نعم ، احذفها!',
                cancelButtonText: 'إلغاء'
                // confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    let isSuccess = false;
                    $.ajax({
                        url: url,
                        method: 'delete',
                        data: {
                            admin: admin_id,
                            // _token: csrf
                        },
                        success: function (response) {
                            var oTable = $('#datatable').dataTable();
                            oTable.fnDraw(false);
                            console.log(response);
                            Swal.fire(
                                'حذف!',
                                'تم حذف الجمعية.',
                                'نجاح'
                            )
                        }
                    });
                }
            })
        });

    </script>

@endsection



