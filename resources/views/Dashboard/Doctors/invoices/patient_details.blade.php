@extends('Dashboard.layouts.master')
@section('css')
    <link href="{{ URL::asset('dashboard/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
@endsection
@section('title')
    معلومات المريض
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الكشوفات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    الفواتير</span><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ معلومات المريض</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    @include('Dashboard.messages_alert')
    <!-- row opened -->
    <div class="row row-sm">
        <div class="col-lg-12 col-md-12">
            <div class="card" id="basic-alert">
                <div class="card-body">
                    <div class="text-wrap">
                        <div class="example">
                            <div class="panel panel-primary tabs-style-1">
                                <div class=" tab-menu-heading">
                                    <div class="tabs-menu1">
                                        <!-- Tabs -->
                                        <ul class="nav panel-tabs main-nav-line">
                                            <li class="nav-item"><a href="#tab1" class="nav-link active"
                                                    data-toggle="tab">سجل المريض</a></li>
                                            <li class="nav-item"><a href="#tab2" class="nav-link"
                                                    data-toggle="tab">الاشعة</a></li>
                                            <li class="nav-item"><a href="#tab3" class="nav-link"
                                                    data-toggle="tab">المختبر</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="panel-body tabs-menu-body main-content-body-right border-top-0 border">
                                    <div class="tab-content">


                                        {{-- Strat Show Information Patient --}}

                                        <div class="tab-pane active" id="tab1">
                                            <br>
                                            <div class="vtimeline">
                                                @foreach ($patient_records as $patient_record)
                                                    <div
                                                        class="timeline-wrapper {{ $loop->iteration % 2 == 0 ? 'timeline-inverted' : '' }} timeline-wrapper-primary">
                                                        <div class="timeline-badge"><i class="las la-check-circle"></i>
                                                        </div>
                                                        <div class="timeline-panel">
                                                            <div class="timeline-heading">
                                                                <h6 class="timeline-title">Art Ramadani posted a status
                                                                    update</h6>
                                                            </div>
                                                            <div class="timeline-body">
                                                                <p>{{ $patient_record->diagnosis }}</p>
                                                            </div>
                                                            <div
                                                                class="timeline-footer d-flex align-items-center flex-wrap">
                                                                <i class="fas fa-user-md"></i>&nbsp;
                                                                <span>{{ $patient_record->Doctor->name }}</span>
                                                                <span class="mr-auto"><i
                                                                        class="fe fe-calendar text-muted mr-1"></i>{{ $patient_record->date }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>

                                        {{-- End Show Information Patient --}}



                                        {{-- Start Invices Patient --}}

                                        <div class="tab-pane" id="tab2">

                                            <div class="table-responsive">
                                                <table class="table table-hover text-md-nowrap text-center">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>اسم الخدمه</th>
                                                            <th>اسم الدكتور</th>
                                                            <th>اسم موظف الاشعة</th>
                                                            <th>حالة الكشف</th>
                                                            <th>العمليات</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($patient_rays as $patient_ray)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{ $patient_ray->description }}</td>
                                                                <td>{{ $patient_ray->doctor->name }}</td>
                                                                <td>{{ $patient_ray->employee->name }}</td>


                                                                @if ($patient_ray->case == 0)
                                                                    <td class="text-danger">غير مكتملة</td>
                                                                @else
                                                                    <td class="text-success"> مكتملة</td>
                                                                @endif


                                                                @if ($patient_ray->doctor_id == auth()->user()->id)
                                                                    @if ($patient_ray->case == 0)
                                                                        <td>
                                                                            <a class="modal-effect btn btn-sm btn-primary"
                                                                                data-effect="effect-scale"
                                                                                data-toggle="modal"
                                                                                href="#edit_xray_conversion{{ $patient_ray->id }}"><i
                                                                                    class="fas fa-edit"></i></a>
                                                                            <a class="modal-effect btn btn-sm btn-danger"
                                                                                data-effect="effect-scale"
                                                                                data-toggle="modal"
                                                                                href="#delete{{ $patient_ray->id }}"><i
                                                                                    class="las la-trash"></i></a>
                                                                        </td>
                                                                    @else
                                                                        <td>
                                                                            <a class="modal-effect btn btn-sm btn-warning"
                                                                                href="{{ route('invoices.show', $patient_ray->id) }}"><i
                                                                                    class="fas fa-binoculars"></i></a>
                                                                        </td>
                                                                    @endif
                                                                @endif
                                                            </tr>
                                                            <!-- Modal -->
                                                            <div class="modal fade"
                                                                id="edit_xray_conversion{{ $patient_ray->id }}"
                                                                tabindex="-1" role="dialog"
                                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel">
                                                                                تحويل الي قسم الاشعة</h5>
                                                                            <button type="button" class="close"
                                                                                data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <form
                                                                            action="{{ route('rays.update', $patient_ray->id) }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            <div class="modal-body">
                                                                                <div class="form-group">
                                                                                    <label
                                                                                        for="exampleFormControlTextarea1">المطلوب</label>
                                                                                    <textarea class="form-control" name="description" rows="6">{{ $patient_ray->description }}</textarea>
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button"
                                                                                    class="btn btn-secondary"
                                                                                    data-dismiss="modal">اغلاق</button>
                                                                                <button type="submit"
                                                                                    class="btn btn-primary">حفظ
                                                                                    البيانات</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- Deleted insurance -->
                                                            <div class="modal fade" id="delete{{ $patient_ray->id }}"
                                                                tabindex="-1" aria-labelledby="exampleModalLabel"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title"
                                                                                id="exampleModalLabel">حذف تفاصيل اشعة</h5>
                                                                            <button type="button" class="close"
                                                                                data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form
                                                                                action="{{ route('rays.destroy', $patient_ray->id) }}"
                                                                                method="post">
                                                                                @csrf
                                                                                <div class="row">
                                                                                    <div class="col">
                                                                                        <p class="h5 text-danger"> هل انت
                                                                                            متاكد من حذف بيانات الاشعة ؟
                                                                                        </p>
                                                                                        <input type="text"
                                                                                            class="form-control" readonly
                                                                                            value="{{ $patient_ray->description }}">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button"
                                                                                        class="btn btn-secondary"
                                                                                        data-dismiss="modal">{{ trans('insurance.close') }}</button>
                                                                                    <button
                                                                                        class="btn btn-success">{{ trans('insurance.save') }}</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        {{-- End Invices Patient --}}



                                        {{-- Start Receipt Patient  --}}

                                        <div class="tab-pane" id="tab3">
                                            <div class="table-responsive">
                                                <table class="table table-hover text-md-nowrap text-center">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>اسم الخدمه</th>
                                                            <th>اسم الدكتور</th>
                                                            <th>العمليات</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($patient_Laboratories as $patient_Laboratorie)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{ $patient_Laboratorie->description }}</td>
                                                                <td>{{ $patient_Laboratorie->doctor->name }}</td>

                                                                @if ($patient_Laboratorie->doctor_id == auth()->user()->id)
                                                                    @if ($patient_Laboratorie->case == 0)
                                                                        <td>
                                                                            <a class="modal-effect btn btn-sm btn-primary"
                                                                                data-effect="effect-scale"
                                                                                data-toggle="modal"
                                                                                href="#edit_laboratorie_conversion{{ $patient_Laboratorie->id }}"><i
                                                                                    class="fas fa-edit"></i></a>
                                                                            <a class="modal-effect btn btn-sm btn-danger"
                                                                                data-effect="effect-scale"
                                                                                data-toggle="modal"
                                                                                href="#deleted_laboratorie{{ $patient_Laboratorie->id }}"><i
                                                                                    class="las la-trash"></i></a>
                                                                        </td>
                                                                    @else
                                                                        <td>
                                                                            <a class="modal-effect btn btn-sm btn-warning"
                                                                                href="{{ route('show.laboratorie', $patient_Laboratorie->id) }}"><i
                                                                                    class="fas fa-binoculars"></i></a>
                                                                        </td>
                                                                    @endif
                                                                @endif

                                                            </tr>
                                                            <!-- Modal -->
                                                            <div class="modal fade"
                                                                id="edit_laboratorie_conversion{{ $patient_Laboratorie->id }}"
                                                                tabindex="-1" role="dialog"
                                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title"
                                                                                id="exampleModalLabel">تحويل الي قسم
                                                                                المختبر</h5>
                                                                            <button type="button" class="close"
                                                                                data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <form
                                                                            action="{{ route('Laboratories.update', $patient_Laboratorie->id) }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            <div class="modal-body">
                                                                                <div class="form-group">
                                                                                    <label
                                                                                        for="exampleFormControlTextarea1">المطلوب</label>
                                                                                    <textarea class="form-control" name="description" rows="6">{{ $patient_Laboratorie->description }}</textarea>
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button"
                                                                                    class="btn btn-secondary"
                                                                                    data-dismiss="modal">اغلاق</button>
                                                                                <button type="submit"
                                                                                    class="btn btn-primary">حفظ
                                                                                    البيانات</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- Deleted insurance -->
                                                            <div class="modal fade"
                                                                id="deleted_laboratorie{{ $patient_Laboratorie->id }}"
                                                                tabindex="-1" aria-labelledby="exampleModalLabel"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title"
                                                                                id="exampleModalLabel">حذف تفاصيل مختبر
                                                                            </h5>
                                                                            <button type="button" class="close"
                                                                                data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form
                                                                                action="{{ route('Laboratories.destroy', $patient_Laboratorie->id) }}"
                                                                                method="post">
                                                                                @csrf
                                                                                <div class="row">
                                                                                    <div class="col">
                                                                                        <p class="h5 text-danger"> هل انت
                                                                                            متاكد من حذف بيانات الاشعة ؟
                                                                                        </p>
                                                                                        <input type="text"
                                                                                            class="form-control" readonly
                                                                                            value="{{ $patient_Laboratorie->description }}">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button"
                                                                                        class="btn btn-secondary"
                                                                                        data-dismiss="modal">{{ trans('insurance.close') }}</button>
                                                                                    <button
                                                                                        class="btn btn-success">{{ trans('insurance.save') }}</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        {{-- End Receipt Patient  --}}

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Prism Precode -->
                    </div>
                </div>
            </div>
        </div>


    </div>
    </div>
    <!-- /row -->
    </div>
    <!-- Container closed -->
    </div>
@endsection
@section('js')
    <script src="{{ URL::asset('dashboard/plugins/notify/js/notifIt.js') }}"></script>
    <script src="{{ URL::asset('/plugins/notify/js/notifit-custom.js') }}"></script>
@endsection
