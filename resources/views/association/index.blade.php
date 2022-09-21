@extends('layouts.dashboard_association')

@section('page-title', "الصفحة الرئيسية")

@section('content')


    <div class="container-fluid">
        <div class="row invoice-card-row">
            <div class="col-xl-3 col-xxl-3 col-sm-6">
                <div class="card bg-primary invoice-card">
                    <div class="card-body ">
                        <div>
                            <h2 class="text-white invoice-num">{{$count_projects?? '-'}}</h2>
                            <p class="text-white fs-18" >عدد المشاريع</p>
                            <a href="{{route('projects.index')}}" class="small-box-footer text-white">مزيد من المعلومات
                                <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-xxl-3 col-sm-6">
                <div class="card bg-secondary invoice-card">
                    <div class="card-body ">
                        <div>
                            <h2 class="text-white invoice-num">{{$sum_received_amount?? '-'}}</h2>
                            <p class="text-white fs-18">مجموع التبرعات</p>
                            <a href="#" class="small-box-footer text-white">مزيد من المعلومات <i class="fas fa-arrow-circle-right"></i></a>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-xxl-3 col-sm-6">
                <div class="card bg-dark invoice-card">
                    <div class="card-body ">
                        <div>
                            <h2 class="text-white invoice-num">{{$sum_num_beneficiaries?? '-'}}</h2>
                            <p class="text-white fs-18">عدد المستفيدين</p>
                            <a href="#" class="small-box-footer text-white">مزيد من المعلومات <i class="fas fa-arrow-circle-right"></i></a>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
