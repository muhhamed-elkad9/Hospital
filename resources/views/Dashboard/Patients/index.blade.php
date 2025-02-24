@extends('Dashboard.layouts.master')
@section('css')
    <link href="{{ URL::asset('dashboard/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">المرضي</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمة
                    المرضي</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    @include('Dashboard.messages_alert')
    <!-- row opened -->
    <div class="row row-sm">
        <!--div-->
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('Patients.create') }}" class="btn btn-primary">اضافة مريض جديد</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-md-nowrap" id="example1">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>اسم المريض</th>
                                    <th>البريد الالكتروني</th>
                                    <th>تاريخ الميلاد</th>
                                    <th>رقم الهاتف</th>
                                    <th>الجنس</th>
                                    <th>فصلية الدم</th>
                                    <th>العنوان</th>
                                    <th>العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($Patients as $Patient)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><a href="{{ route('Patients.show', $Patient->id) }}">{{ $Patient->name }}</a>
                                        </td>
                                        <td>{{ $Patient->email }}</td>
                                        <td>{{ $Patient->Date_Birth }}</td>
                                        <td>{{ $Patient->Phone }}</td>
                                        <td>{{ $Patient->Gender == 1 ? 'ذكر' : 'انثي' }}</td>
                                        <td>{{ $Patient->Blood_Group }}</td>
                                        <td>{{ $Patient->Address }}</td>
                                        <td>
                                            <a href="{{ route('Patients.edit', $Patient->id) }}"
                                                class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>
                                            <button class="btn btn-sm btn-danger" data-toggle="modal"
                                                data-target="#Deleted{{ $Patient->id }}"><i
                                                    class="fas fa-trash"></i></button>
                                            <a href="{{ route('Patients.show', $Patient->id) }}"
                                                class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a>

                                        </td>
                                    </tr>
                                    <!-- Deleted insurance -->
                                    <div class="modal fade" id="Deleted{{ $Patient->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">حذف بيانات مريض</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('Patients.destroy', $Patient->id) }}"
                                                        method="post">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{ $Patient->id }}">
                                                        <div class="row">
                                                            <div class="col">
                                                                <p class="h5 text-danger"> هل انت متاكد من حذف بيانات المريض
                                                                    ؟ </p>
                                                                <input type="text" class="form-control" readonly
                                                                    value="{{ $Patient->name }}">
                                                            </div>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
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
                </div><!-- bd -->
            </div><!-- bd -->
        </div>
        <!--/div-->
    </div>
    <!-- /row -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!--Internal  Notify js -->
    <script src="{{ URL::asset('dashboard/plugins/notify/js/notifIt.js') }}"></script>
    <script src="{{ URL::asset('/plugins/notify/js/notifit-custom.js') }}"></script>
@endsection
