@extends('Dashboard.layouts.master')
@section('css')
    <!--  Owl-carousel css-->
    <link href="{{ URL::asset('Dashboard/plugins/owl-carousel/owl.carousel.css') }}" rel="stylesheet" />
    <!-- Maps css -->
    <link href="{{ URL::asset('Dashboard/plugins/jqvmap/jqvmap.min.css') }}" rel="stylesheet">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <div>
                <h2 class="main-content-title tx-24 mb-2 mb-lg-1">لوحة التحكم الادمن</h2>
                <p class="mg-b-0">مرحبا بعودتك مرة اخري {{ auth()->user()->name }}</p>
            </div>
        </div>
        <div class="main-dashboard-header-right">
            <div>
                <label class="tx-13">عدد الخدمات المفردة</label>
                <h5>{{ \App\Models\Service::count() }}</h5>
            </div>
            <div>
                <label class="tx-13">عدد الخدمات المجمعة</label>
                <h5>{{ \App\Models\Group::count() }}</h5>
            </div>
        </div>
    </div>
    <!-- /breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row row-sm">
        <div class="col-xl-4 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-primary-gradient">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-12 text-white">عدد الاطباء</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h4 class="tx-20 font-weight-bold mb-1 text-white">{{ App\Models\Doctor::count() }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <span id="compositeline" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-danger-gradient">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-12 text-white">عدد المرضي</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h4 class="tx-20 font-weight-bold mb-1 text-white">{{ App\Models\Patient::count() }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <span id="compositeline2" class="pt-1">3,2,4,6,12,14,8,7,14,16,12,7,8,4,3,2,2,5,6,7</span>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-success-gradient">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-12 text-white">عدد الاقسام</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h4 class="tx-20 font-weight-bold mb-1 text-white">{{ App\Models\Section::count() }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <span id="compositeline3" class="pt-1">5,10,5,20,22,12,15,18,20,15,8,12,22,5,10,12,22,15,16,10</span>
            </div>
        </div>
    </div>
    <!-- row closed -->


    <div class="row">
        <div class="col-xl-12">
            <!-- div -->
            <div class="card mg-b-20" id="tabs-style2">
                <div class="card-body">
                    <div class="main-content-label mg-b-5">
                        <h5 style="font-family: 'Cairo', sans-serif" class="card-title">اخر العمليات
                            علي النظام</h5>
                    </div>
                    <div class="text-wrap">
                        <div class="example">
                            <div class="panel panel-primary tabs-style-2">
                                <div class=" tab-menu-heading">
                                    <div class="tabs-menu1">
                                        <!-- Tabs -->
                                        <ul class="nav panel-tabs main-nav-line">

                                            <li><a href="#admins" class="nav-link active" data-toggle="tab">الادمن</a></li>

                                            <li><a href="#doctors" class="nav-link" data-toggle="tab">الاطباء</a></li>

                                            <li><a href="#patients" class="nav-link" data-toggle="tab">المرضي</a></li>

                                            <li><a href="#Rays" class="nav-link" data-toggle="tab">موظفين الاشعة</a></li>

                                            <li><a href="#laboratories" class="nav-link" data-toggle="tab">موظفين
                                                    المختبر</a></li>

                                            <li><a href="#invoices" class="nav-link" data-toggle="tab">الفواتير</a></li>

                                        </ul>
                                    </div>
                                </div>
                                <div class="panel-body tabs-menu-body main-content-body-right border">
                                    <div class="tab-content">

                                        {{-- admins Table --}}
                                        <div class="tab-pane active" id="admins">
                                            <div class="table-responsive mt-15">
                                                <table style="text-align: center"
                                                    class="table center-aligned-table table-hover mb-0">
                                                    <thead>
                                                        <tr class="table-info text-danger">
                                                            <th>#</th>
                                                            <th>اسم المستخدم</th>
                                                            <th>البريد الالكتروني</th>
                                                            <th>تاريخ الاضافة</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse(\App\Models\Admin::latest()->get() as $admin)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{ $admin->name }}</td>
                                                                <td>{{ $admin->email }}</td>
                                                                <td class="text-success">
                                                                    {{ $admin->created_at->diffForHumans() }}</td>
                                                            @empty
                                                                <td class="alert-danger" colspan="4">لاتوجد بيانات</td>
                                                            </tr>
                                                        @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        {{-- doctors Table --}}
                                        <div class="tab-pane" id="doctors">
                                            <div class="table-responsive mt-15">
                                                <table style="text-align: center"
                                                    class="table center-aligned-table table-hover mb-0">
                                                    <thead>
                                                        <tr class="table-info text-danger">
                                                            <th>#</th>
                                                            <th>اسم الدكتور</th>
                                                            <th>البريد الالكتروني</th>
                                                            <th>القسم</th>
                                                            <th>رقم الهاتف</th>
                                                            <th>الحالة</th>
                                                            <th>عدد الكشوفات اليومية</th>
                                                            <th>تاريخ الاضافة</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse(\App\Models\Doctor::latest()->get() as $doctor)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{ $doctor->name }}</td>
                                                                <td>{{ $doctor->email }}</td>
                                                                <td>{{ $doctor->section->name }}</td>
                                                                <td>{{ $doctor->phone }}</td>
                                                                <td>
                                                                    <div
                                                                        class="dot-label bg-{{ $doctor->status == 1 ? 'success' : 'danger' }} ml-1">
                                                                    </div>
                                                                    {{ $doctor->status == 1 ? trans('doctors.Enabled') : trans('doctors.Not_enabled') }}
                                                                </td>
                                                                <td>{{ $doctor->number_of_statements }}</td>
                                                                <td class="text-success">
                                                                    {{ $doctor->created_at->diffForHumans() }}</td>
                                                            @empty
                                                                <td class="alert-danger" colspan="8">لاتوجد بيانات</td>
                                                            </tr>
                                                        @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        {{-- patients Table --}}
                                        <div class="tab-pane" id="patients">
                                            <div class="table-responsive mt-15">
                                                <table style="text-align: center"
                                                    class="table center-aligned-table table-hover mb-0">
                                                    <thead>
                                                        <tr class="table-info text-danger">
                                                            <th>#</th>
                                                            <th>اسم المريض</th>
                                                            <th>البريد الالكتروني</th>
                                                            <th>تاريخ الميلاد</th>
                                                            <th>رقم الهاتف</th>
                                                            <th>النوع</th>
                                                            <th>فصيلة الدم</th>
                                                            <th>تاريخ الاضافة</th>
                                                        </tr>
                                                    </thead>

                                                    @forelse(\App\Models\Patient::latest()->get() as $patient)
                                                        <tbody>
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{ $patient->name }}</td>
                                                                <td>{{ $patient->email }}</td>
                                                                <td>{{ $patient->Date_Birth }}</td>
                                                                <td>{{ $patient->Phone }}</td>
                                                                <td>
                                                                    @if ($patient->Gender == 1)
                                                                        ذكر
                                                                    @else
                                                                        مؤنث
                                                                    @endif
                                                                </td>
                                                                <td>{{ $patient->Blood_Group }}</td>
                                                                <td class="text-success">
                                                                    {{ $patient->created_at->diffForHumans() }}</td>
                                                            @empty
                                                                <td class="alert-danger" colspan="8">لاتوجد بيانات</td>
                                                            </tr>
                                                        </tbody>
                                                    @endforelse
                                                </table>
                                            </div>
                                        </div>

                                        {{-- Rays Table --}}
                                        <div class="tab-pane" id="Rays">
                                            <div class="table-responsive mt-15">
                                                <table style="text-align: center"
                                                    class="table center-aligned-table table-hover mb-0">
                                                    <thead>
                                                        <tr class="table-info text-danger">
                                                            <th>#</th>
                                                            <th>اسم موظف الاشعة</th>
                                                            <th>البريد الالكتروني</th>
                                                            <th>تاريخ الاضافة</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse(\App\Models\RayEmployee::latest()->get() as $parent)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{ $parent->name }}</td>
                                                                <td>{{ $parent->email }}</td>
                                                                <td class="text-success">
                                                                    {{ $parent->created_at->diffForHumans() }}</td>
                                                            @empty
                                                                <td class="alert-danger" colspan="4">لاتوجد بيانات</td>
                                                            </tr>
                                                        @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        {{-- laboratories Table --}}
                                        <div class="tab-pane" id="laboratories">
                                            <div class="table-responsive mt-15">
                                                <table style="text-align: center"
                                                    class="table center-aligned-table table-hover mb-0">
                                                    <thead>
                                                        <tr class="table-info text-danger">
                                                            <th>#</th>
                                                            <th>اسم موظف المختبر</th>
                                                            <th>البريد الالكتروني</th>
                                                            <th>تاريخ الاضافة</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse(\App\Models\LaboratorieEmployee::latest()->take(10)->get() as $LaboratorieEmployee)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{ $LaboratorieEmployee->name }}</td>
                                                                <td>{{ $LaboratorieEmployee->email }}</td>
                                                                <td class="text-success">
                                                                    {{ $LaboratorieEmployee->created_at->diffForHumans() }}
                                                                </td>
                                                            </tr>
                                                        @empty
                                                            <tr>
                                                                <td class="alert-danger" colspan="4">لاتوجد بيانات</td>
                                                            </tr>
                                                        @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        {{-- invoices Table --}}
                                        <div class="tab-pane" id="invoices">
                                            <div class="table-responsive mt-15">
                                                <table style="text-align: center"
                                                    class="table center-aligned-table table-hover mb-0">
                                                    <thead>
                                                        <tr class="table-info text-danger">
                                                            <th>#</th>
                                                            <th>اسم الخدمة</th>
                                                            <th>نوع خدمة الفاتورة</th>
                                                            <th>تاريخ الفاتورة</th>
                                                            <th>اسم المريض</th>
                                                            <th>اسم الدكتور</th>
                                                            <th>القسم</th>
                                                            <th>السعر</th>
                                                            <th>قيمة الخصم</th>
                                                            <th>نسبة الضريبة</th>
                                                            <th>قيمة الضريبة</th>
                                                            <th>الاجمالي مع الضريبة</th>
                                                            <th>النوع الفاتورة</th>
                                                            <th>تاريخ الاضافة</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse(\App\Models\Invoice::latest()->get() as $Invoice)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>
                                                                    @if ($Invoice->Group_id == 1)
                                                                        {{ $Invoice->Group->name }}
                                                                    @else
                                                                        {{ $Invoice->Service->name }}
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if ($Invoice->invoice_type == 1)
                                                                        فاتورة خدمة مفردة
                                                                    @else
                                                                        فاتورة مجموعة خدمات
                                                                    @endif
                                                                </td>
                                                                <td>{{ $Invoice->invoice_date }}</td>
                                                                <td>{{ $Invoice->Patient->name }}</td>
                                                                <td>{{ $Invoice->Doctor->name }}</td>
                                                                <td>{{ $Invoice->Section->name }}</td>
                                                                <td>{{ number_format($Invoice->price, 2) }} </td>
                                                                <td>{{ number_format($Invoice->discount_value, 2) }}</td>
                                                                <td>{{ $Invoice->tax_rate }}%</td>
                                                                <td>{{ number_format($Invoice->tax_value, 2) }}</td>
                                                                <td>{{ number_format($Invoice->total_with_tax, 2) }}</td>
                                                                <td>{{ $Invoice->type == 1 ? 'نقدي' : 'اجل' }}</td>
                                                                <td class="text-success">
                                                                    {{ $Invoice->created_at->diffForHumans() }}</td>
                                                            </tr>
                                                        @empty
                                                            <tr>
                                                                <td class="alert-danger" colspan="14">لاتوجد بيانات</td>
                                                            </tr>
                                                        @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /div -->
    </div>




    </div>
    </div>
    <!-- Container closed -->
@endsection
@section('js')
    <!--Internal  Chart.bundle js -->
    <script src="{{ URL::asset('Dashboard/plugins/chart.js/Chart.bundle.min.js') }}"></script>
    <!-- Moment js -->
    <script src="{{ URL::asset('Dashboard/plugins/raphael/raphael.min.js') }}"></script>
    <!--Internal  Flot js-->
    <script src="{{ URL::asset('Dashboard/plugins/jquery.flot/jquery.flot.js') }}"></script>
    <script src="{{ URL::asset('Dashboard/plugins/jquery.flot/jquery.flot.pie.js') }}"></script>
    <script src="{{ URL::asset('Dashboard/plugins/jquery.flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ URL::asset('Dashboard/plugins/jquery.flot/jquery.flot.categories.js') }}"></script>
    <script src="{{ URL::asset('Dashboard/js/dashboard.sampledata.js') }}"></script>
    <script src="{{ URL::asset('Dashboard/js/chart.flot.sampledata.js') }}"></script>
    <!--Internal Apexchart js-->
    <script src="{{ URL::asset('Dashboard/js/apexcharts.js') }}"></script>
    <!-- Internal Map -->
    <script src="{{ URL::asset('Dashboard/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ URL::asset('Dashboard/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <script src="{{ URL::asset('Dashboard/js/modal-popup.js') }}"></script>
    <!--Internal  index js -->
    <script src="{{ URL::asset('Dashboard/js/index.js') }}"></script>
    <script src="{{ URL::asset('Dashboard/js/jquery.vmap.sampledata.js') }}"></script>
@endsection
