@extends('Dashboard.layouts.master')
@section('title')
    {{ trans('main-sidebar_trans.Single_service') }}
@stop
@section('css')
    <!--Internal   Notify -->
    <link href="{{ URL::asset('dashboard/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{ trans('main-sidebar_trans.Services') }}</h4><span
                    class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ trans('main-sidebar_trans.Single_service') }}</span>
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
                            {{ trans('Services.add_Service') }}
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-md-nowrap" id="example2">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th> {{ trans('Services.name') }}</th>
                                    <th> {{ trans('Services.price') }}</th>
                                    <th> {{ trans('doctors.Status') }}</th>
                                    <th> {{ trans('Services.description') }}</th>
                                    <th>{{ trans('sections_trans.created_at') }}</th>
                                    <th>{{ trans('sections_trans.Processes') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($services as $service)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $service->name }}</td>
                                        <td>{{ $service->price }}</td>
                                        <td>
                                            <div
                                                class="dot-label bg-{{ $service->status == 1 ? 'success' : 'danger' }} ml-1">
                                            </div>
                                            {{ $service->status == 1 ? trans('doctors.Enabled') : trans('doctors.Not_enabled') }}
                                        </td>
                                        <td> {{ Str::limit($service->description, 50) }}</td>
                                        <td>{{ $service->created_at->diffForHumans() }}</td>
                                        <td>
                                            <a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"
                                                data-toggle="modal" href="#edit{{ $service->id }}"><i
                                                    class="las la-pen"></i></a>
                                            <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                                data-toggle="modal" href="#delete{{ $service->id }}"><i
                                                    class="las la-trash"></i></a>
                                        </td>
                                    </tr>

                                    <!-- Modal -->
                                    <div class="modal fade" id="edit{{ $service->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">
                                                        {{ trans('Services.edit_Service') }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{ route('Service.update', $service->id) }}" method="post">
                                                    {{ csrf_field() }}
                                                    @csrf
                                                    <div class="modal-body">
                                                        <label for="name">{{ trans('Services.name') }}</label>
                                                        <input type="text" name="name" id="name"
                                                            value="{{ $service->name }}" class="form-control"><br>

                                                        <input type="hidden" name="id" value="{{ $service->id }}"
                                                            class="form-control"><br>

                                                        <label for="price">{{ trans('Services.price') }}</label>
                                                        <input type="number" name="price" id="price"
                                                            value="{{ $service->price }}" class="form-control"><br>

                                                        <label
                                                            for="description">{{ trans('Services.description') }}</label>
                                                        <textarea class="form-control" name="description" id="description" rows="5">{{ $service->description }}</textarea>

                                                        <div class="form-group">
                                                            <label for="status">{{ trans('doctors.Status') }}</label>
                                                            <select class="form-control" id="status" name="status"
                                                                required>
                                                                <option value="{{ $service->status }}" selected>
                                                                    {{ $service->status == 1 ? trans('doctors.Enabled') : trans('doctors.Not_enabled') }}
                                                                </option>
                                                                <option value="1">{{ trans('doctors.Enabled') }}
                                                                </option>
                                                                <option value="0">{{ trans('doctors.Not_enabled') }}
                                                                </option>
                                                            </select>
                                                        </div>
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
                                    <div class="modal fade" id="delete{{ $service->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">
                                                        {{ trans('Services.delete_Service') }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{ route('Service.destroy', $service->id) }}"
                                                    method="post">
                                                    {{ csrf_field() }}
                                                    <div class="modal-body">
                                                        <input type="hidden" name="id"
                                                            value="{{ $service->id }}">
                                                        <h5>{{ trans('Dashboard/sections_trans.Warning') }}
                                                            {{ $service->name }} </h5>
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
                        <h5 class="modal-title" id="exampleModalLabel">{{ trans('Services.add_Service') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('Service.store') }}" method="post" autocomplete="off">
                        @csrf
                        <div class="modal-body">
                            <label for="name">{{ trans('Services.name') }}</label>
                            <input type="text" name="name" id="name" class="form-control"><br>

                            <label for="price">{{ trans('Services.price') }}</label>
                            <input type="number" name="price" id="price" class="form-control"><br>

                            <label for="description">{{ trans('Services.description') }}</label>
                            <textarea class="form-control" name="description" id="description" rows="5"></textarea>
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
    <script src="{{ URL::asset('dashboard/plugins/notify/js/notifIt.js') }}"></script>
    <script src="{{ URL::asset('/plugins/notify/js/notifit-custom.js') }}"></script>
@endsection
