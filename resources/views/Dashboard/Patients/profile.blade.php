@extends('Dashboard.layouts.master')
@section('title')
    الملف الشخصي
@stop
@section('css')
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الملف الشخصي</h4>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <div class="card-body">

        <section style="background-color: #eee;">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card mg-b-20">
                        <div class="card-body">
                            <div class="pl-0">
                                <div class="main-profile-overview">
                                    <div class="main-img-user profile-user">
                                        @if (Auth::user()->avatar == null)
                                            <img src="{{ URL::asset('Dashboard/img/profile/user_icon.png') }}">
                                        @else
                                            <img
                                                src="{{ URL::asset('Dashboard/img/profile/Patient/' . Auth::user()->id . '/' . Auth::user()->avatar) }}">
                                        @endif
                                        <a class="fas fa-camera profile-edit" data-toggle="modal" data-target="#photo_user"
                                            href="JavaScript:void(0);"></a>
                                    </div>
                                    <div class="d-flex justify-content-between mg-b-20">
                                        <div>
                                            <h5 class="main-profile-name">{{ Auth::user()->name }}</h5>
                                            <p class="main-profile-name-text">{{ Auth::user()->email }}</p>
                                        </div>
                                    </div>
                                    <h6>السيرة الذاتية:</h6>
                                    <div class="main-profile-bio">
                                        @if (auth('admin')->check())
                                            Admin
                                        @elseif(auth('doctor')->check())
                                            Doctor
                                        @elseif(auth('ray_employee')->check())
                                            Ray Employee
                                        @elseif(auth('laboratorie_employee')->check())
                                            Laboratorie Employee
                                        @elseif(auth('patient')->check())
                                            Patient
                                        @endif
                                    </div><!-- main-profile-bio -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">

                            <div class="tab-content border-left border-bottom border-right border-top-0 p-4">
                                <div class="tab-pane active" id="settings">
                                    <form action="{{ route('ProfilePatient.update', $info->id) }}" method="POST">
                                        {{ csrf_field() }}

                                        <div class="form-group">
                                            <label for="name">الاسم:</label>
                                            <input type="text" name="name" value="{{ $info->name }}"
                                                class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">البريد الالكتروني:</label>
                                            <input type="email" value="{{ $info->email }}" name="email" id="email"
                                                class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="password">كلمة المرور:</label>
                                            <input type="password" placeholder="6 - 15 Characters" name="password"
                                                id="password" class="form-control">
                                        </div>

                                        <div class="form-group ml-3">
                                            <input type="checkbox" class="form-check-input" onclick="myFunction()"
                                                id="exampleCheck1">
                                            <label class="form-check-label mr-3" for="exampleCheck1">اظهار كلمة
                                                المرور</label>
                                        </div>
                                        <hr>
                                        <button type="submit" class="btn btn-success">تعديل البيانات</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Photo User -->
    <div class="modal fade" id="photo_user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">تغيير صورة الملف الشخصي</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action='{{ route('AddimagePatient.update') }}' method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="modal-body">

                        @if (Auth::user()->avatar == null)
                            <input type="file" name="photo" class="dropify"
                                accept=".pdf,.jpg, .png, image/jpeg, image/png"
                                data-default-file="{{ URL::asset('Dashboard/img/profile/user_icon.png') }}"
                                data-height="100" />
                        @else
                            <input type="file" name="photo" class="dropify"
                                accept=".pdf,.jpg, .png, image/jpeg, image/png"
                                data-default-file="{{ URL::asset('Dashboard/img/profile/Patient/' . Auth::user()->id . '/' . Auth::user()->avatar) }}"
                                data-height="100" />
                        @endif

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">حفظ</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('Dashboard/plugins/select2/js/select2.min.js') }}"></script>
    <!--Internal Fileuploads js-->
    <script src="{{ URL::asset('Dashboard/plugins/fileuploads/js/fileupload.js') }}"></script>
    <script src="{{ URL::asset('Dashboard/plugins/fileuploads/js/file-upload.js') }}"></script>
    <!--Internal Fancy uploader js-->
    <script src="{{ URL::asset('Dashboard/plugins/fancyuploder/jquery.ui.widget.js') }}"></script>
    <script src="{{ URL::asset('Dashboard/plugins/fancyuploder/jquery.fileupload.js') }}"></script>
    <script src="{{ URL::asset('Dashboard/plugins/fancyuploder/jquery.iframe-transport.js') }}"></script>
    <script src="{{ URL::asset('Dashboard/plugins/fancyuploder/jquery.fancy-fileupload.js') }}"></script>
    <script src="{{ URL::asset('Dashboard/plugins/fancyuploder/fancy-uploader.js') }}"></script>
    <!--Internal  Form-elements js-->
    <script src="{{ URL::asset('Dashboard/js/advanced-form-elements.js') }}"></script>
    <script src="{{ URL::asset('Dashboard/js/select2.js') }}"></script>
    <!--Internal Sumoselect js-->
    <script src="{{ URL::asset('Dashboard/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('Dashboard/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!--Internal  jquery.maskedinput js -->
    <script src="{{ URL::asset('Dashboard/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
    <!--Internal  spectrum-colorpicker js -->
    <script src="{{ URL::asset('Dashboard/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
    <!-- Internal form-elements js -->
    <script src="{{ URL::asset('Dashboard/js/form-elements.js') }}"></script>

    <script>
        function myFunction() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
@endsection
