@extends('Dashboard.layouts.master')
@section('title')
    قائمة الموظفين
@stop
@section('css')
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('Dashboard/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!--Internal   Notify -->
    <link href="{{ URL::asset('dashboard/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الاشعة</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمة
                    الموظفين</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    @include('Dashboard.messages_alert')
    <!-- row -->
    <!-- row opened -->
    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add">
                            اضافة موظف جديد
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table style="text-align: center" class="table text-md-nowrap" id="example1">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>الاسم</th>
                                    <th>البريد الالكتروني</th>
                                    <th>تاريخ الاضافة</th>
                                    <th>العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ray_employees as $ray_employee)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $ray_employee->name }}</td>
                                        <td>{{ $ray_employee->email }}</td>
                                        <td>{{ $ray_employee->created_at->diffForHumans() }}</td>
                                        <td>
                                            <a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"
                                                data-toggle="modal" href="#edit{{ $ray_employee->id }}"><i
                                                    class="las la-pen"></i></a>
                                            <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                                data-toggle="modal" href="#delete{{ $ray_employee->id }}"><i
                                                    class="las la-trash"></i></a>
                                        </td>
                                    </tr>

                                    <!-- Modal -->
                                    <div class="modal fade" id="edit{{ $ray_employee->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">تعديل بيانات موظف</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{ route('ray_employee.update', $ray_employee->id) }}"
                                                    method="post">
                                                    {{ csrf_field() }}
                                                    @csrf
                                                    <div class="modal-body">
                                                        <label for="exampleInputPassword1">الاسم</label>
                                                        <input type="text" value="{{ $ray_employee->name }}"
                                                            name="name" class="form-control"><br>

                                                        <label for="exampleInputPassword1">البريد الالكتروني</label>
                                                        <input type="email" value="{{ $ray_employee->email }}"
                                                            name="email" class="form-control"><br>

                                                        <label for="exampleInputPassword1">كلمة المرور</label>
                                                        <input type="password" name="password" class="form-control"
                                                            autocomplete="new-password">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">{{ trans('Dashboard/sections_trans.Close') }}</button>
                                                        <button type="submit"
                                                            class="btn btn-primary">{{ trans('Dashboard/sections_trans.submit') }}</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal -->
                                    <div class="modal fade" id="delete{{ $ray_employee->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">حذف بيانات موظف</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{ route('ray_employee.destroy', $ray_employee->id) }}"
                                                    method="post">
                                                    {{ csrf_field() }}
                                                    <div class="modal-body">
                                                        <h5>{{ trans('Dashboard/sections_trans.Warning') }}
                                                            {{ $ray_employee->name }}</h5>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">{{ trans('Dashboard/sections_trans.Close') }}</button>
                                                        <button type="submit"
                                                            class="btn btn-danger">{{ trans('Dashboard/sections_trans.submit') }}</button>
                                                    </div>
                                                </form>
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

        <!-- Modal -->
        <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">اضافة موظف جديد</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('ray_employee.store') }}" method="post" autocomplete="off">
                        @csrf
                        <div class="modal-body">
                            <label for="exampleInputPassword1">الاسم</label>
                            <input type="text" name="name" class="form-control"><br>

                            <label for="exampleInputPassword1">البريد الالكتروني</label>
                            <input type="email" name="email" class="form-control"><br>

                            <label for="exampleInputPassword1">كلمة المرور</label>
                            <input type="password" name="password" class="form-control"><br>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">{{ trans('Dashboard/sections_trans.Close') }}</button>
                            <button type="submit"
                                class="btn btn-primary">{{ trans('Dashboard/sections_trans.submit') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- /row -->

    </div>
    <!-- row closed -->

    <!-- Container closed -->

    <!-- main-content closed -->
@endsection
@section('js')


    <!--Internal  Notify js -->
    <script src="{{ URL::asset('dashboard/plugins/notify/js/notifIt.js') }}"></script>
    <script src="{{ URL::asset('/plugins/notify/js/notifit-custom.js') }}"></script>

@endsection
