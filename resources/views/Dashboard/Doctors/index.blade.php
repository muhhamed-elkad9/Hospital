@extends('Dashboard.layouts.master')
@section('title')
    {{ trans('main-sidebar_trans.doctors') }}
@stop
@section('css')
    <link href="{{ URL::asset('dashboard/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
@endsection


@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{ trans('main-sidebar_trans.doctors') }}</h4>
                <span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    {{ trans('main-sidebar_trans.view_all') }}</span>
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
            <div class="card mg-b-20">
                <div class="card-header pb-0">

                    <a href="{{ route('Doctors.create') }}" class="btn btn-primary" role="button"
                        aria-pressed="true">{{ trans('doctors.add_doctor') }}</a>
                    <button type="button" class="btn btn-danger"
                        id="btn_delete_all">{{ trans('doctors.delete_select') }}</button>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table key-buttons text-md-nowrap">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th><input name="select_all" id="example-select-all" type="checkbox" /></th>
                                    <th>{{ trans('doctors.name') }}</th>
                                    <th>{{ trans('doctors.img') }}</th>
                                    <th>{{ trans('doctors.email') }}</th>
                                    <th>{{ trans('doctors.section') }}</th>
                                    <th>{{ trans('doctors.phone') }}</th>
                                    <th>{{ trans('doctors.appointments') }}</th>
                                    <th>{{ trans('doctors.number_of_statements') }}</th>
                                    <th>{{ trans('doctors.Status') }}</th>
                                    <th>{{ trans('doctors.created_at') }}</th>
                                    <th>{{ trans('doctors.Processes') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($doctors as $doctor)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <input type="checkbox" name="delete_select" value="{{ $doctor->id }}"
                                                class="delete_select">
                                        </td>
                                        <td>{{ $doctor->name }}</td>
                                        <td>
                                            @if ($doctor->image)
                                                <img src="{{ Url::asset('Dashboard/img/doctors/' . $doctor->image->filename) }}"
                                                    height="50px" width="50px" alt="">
                                            @else
                                                <img src="{{ Url::asset('Dashboard/img/doctor_default.png') }}"
                                                    height="50px" width="50px" alt="">
                                            @endif
                                        </td>
                                        <td>{{ $doctor->email }}</td>
                                        <td>{{ $doctor->section->name }}</td>
                                        <td>{{ $doctor->phone }}</td>
                                        <td>
                                            @foreach ($doctor->doctordateworks as $date)
                                                {{ $date->name }}
                                            @endforeach
                                        </td>
                                        <td>
                                            {{ $doctor->number_of_statements }}
                                        </td>
                                        <td>
                                            <div
                                                class="dot-label bg-{{ $doctor->status == 1 ? 'success' : 'danger' }} ml-1">
                                            </div>
                                            {{ $doctor->status == 1 ? trans('doctors.Enabled') : trans('doctors.Not_enabled') }}
                                        </td>

                                        <td>{{ $doctor->created_at->diffForHumans() }}</td>
                                        <td>

                                            <div class="dropdown">
                                                <button aria-expanded="false" aria-haspopup="true"
                                                    class="btn ripple btn-outline-primary btn-sm" data-toggle="dropdown"
                                                    type="button">{{ trans('doctors.Processes') }}<i
                                                        class="fas fa-caret-down mr-1"></i></button>
                                                <div class="dropdown-menu tx-13">
                                                    <a class="dropdown-item"
                                                        href="{{ route('Doctors.edit', $doctor->id) }}"><i
                                                            style="color: #0ba360"
                                                            class="text-success ti-user"></i>&nbsp;&nbsp;تعديل البيانات</a>
                                                    <a class="dropdown-item" href="#" data-toggle="modal"
                                                        data-target="#update_password{{ $doctor->id }}"><i
                                                            class="text-primary ti-key"></i>&nbsp;&nbsp;تغير كلمة المرور</a>
                                                    <a class="dropdown-item" href="#" data-toggle="modal"
                                                        data-target="#update_status{{ $doctor->id }}"><i
                                                            class="text-warning ti-back-right"></i>&nbsp;&nbsp;تغير
                                                        الحالة</a>
                                                    <a class="dropdown-item" href="#" data-toggle="modal"
                                                        data-target="#delete{{ $doctor->id }}"><i
                                                            class="text-danger  ti-trash"></i>&nbsp;&nbsp;حذف البيانات</a>
                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                    <!-- Modal -->
                                    <div class="modal fade" id="delete{{ $doctor->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">
                                                        {{ trans('doctors.delete_doctor') }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{ route('Doctors.destroy', $doctor->id) }}" method="post">
                                                    {{ csrf_field() }}
                                                    <div class="modal-body">
                                                        <h5>{{ trans('sections_trans.Warning') }} {{ $doctor->name }}</h5>
                                                        <input type="hidden" value="1" name="page_id">
                                                        @if ($doctor->image)
                                                            <input type="hidden" name="filename"
                                                                value="{{ $doctor->image->filename }}">
                                                        @endif
                                                        <input type="hidden" name="id" value="{{ $doctor->id }}">
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

                                    <!-- Modal -->
                                    <div class="modal fade" id="delete_select" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">
                                                        {{ trans('doctors.delete_select') }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{ route('Doctors.destroy', $doctor->id) }}"
                                                    method="post">
                                                    {{ csrf_field() }}
                                                    <div class="modal-body">
                                                        <h5>{{ trans('sections_trans.Warning') }}</h5>
                                                        <input type="hidden" id="delete_select_id"
                                                            name="delete_select_id" value=''>
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

                                    <!-- Modal -->
                                    <div class="modal fade" id="update_password{{ $doctor->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">
                                                        {{ trans('doctors.update_password') }} {{ $doctor->name }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{ route('update_password') }}" method="post"
                                                    autocomplete="off">
                                                    {{ csrf_field() }}
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label
                                                                for="password">{{ trans('doctors.new_password') }}</label>
                                                            <input type="password" class="form-control" id="password"
                                                                name="password">
                                                        </div>

                                                        <div class="form-group">
                                                            <label
                                                                for="password_confirmation">{{ trans('doctors.confirm_password') }}</label>
                                                            <input type="password" class="form-control"
                                                                name="password_confirmation" id="password_confirmation">
                                                        </div>

                                                        <input type="hidden" name="id"
                                                            value="{{ $doctor->id }}">
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
                                    <div class="modal fade" id="update_status{{ $doctor->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">
                                                        {{ trans('doctors.Status_change') }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{ route('update_status') }}" method="post"
                                                    autocomplete="off">
                                                    {{ csrf_field() }}
                                                    <div class="modal-body">

                                                        <div class="form-group">
                                                            <label for="status">{{ trans('doctors.Status') }}</label>
                                                            <select class="form-control" id="status" name="status"
                                                                required>
                                                                <option value="" selected disabled>
                                                                    --{{ trans('doctors.Choose') }}--</option>
                                                                <option value="1">{{ trans('doctors.Enabled') }}
                                                                </option>
                                                                <option value="0">{{ trans('doctors.Not_enabled') }}
                                                                </option>
                                                            </select>
                                                        </div>

                                                        <input type="hidden" name="id"
                                                            value="{{ $doctor->id }}">
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
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
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

    <script>
        $(function() {
            jQuery("[name=select_all]").click(function(source) {
                checkboxes = jQuery("[name=delete_select]");
                for (var i in checkboxes) {
                    checkboxes[i].checked = source.target.checked;
                }
            });
        })
    </script>


    <script type="text/javascript">
        $(function() {
            $("#btn_delete_all").click(function() {
                var selected = [];
                $("#example input[name=delete_select]:checked").each(function() {
                    selected.push(this.value);
                });

                if (selected.length > 0) {
                    $('#delete_select').modal('show')
                    $('input[id="delete_select_id"]').val(selected);
                }
            });
        });
    </script>



@endsection
