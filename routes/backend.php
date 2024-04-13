<?php

use App\Events\MyEvent;
use App\Http\Controllers\AddImageAdminController;
use App\Http\Controllers\Dashboard\AmbulanceController;
use App\Http\Controllers\Dashboard\appointments\AppointmentControllerr;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\DoctorController;
use App\Http\Controllers\Dashboard\insuranceController;
use App\Http\Controllers\Dashboard\LaboratorieEmployeeController;
use App\Http\Controllers\Dashboard\PatientsController;
use App\Http\Controllers\Dashboard\PaymentController;
use App\Http\Controllers\Dashboard\ProfileAdminController;
use App\Http\Controllers\Dashboard\ProfileControllerr;
use App\Http\Controllers\Dashboard\RayEmployeeController;
use App\Http\Controllers\Dashboard\ReceiptController;
use App\Http\Controllers\Dashboard\SectionController;
use App\Http\Controllers\Dashboard\ServiceController;
use App\Http\Livewire\CreateGroupServices;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Backend Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/Dashboard_admin', [DashboardController::class, 'index']);

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function () {

    //################################ dashboard user ##########################################
    Route::get('/dashboard/user', function () {
        return view('Dashboard.User.dashboard_user');
    })->middleware(['auth'])->name('dashboard.user');
    //################################ end dashboard user #####################################

    //################################ dashboard admin ########################################
    Route::get('/dashboard/admin', function () {
        return view('Dashboard.Admin.dashboard_admin');
    })->middleware(['auth:admin'])->name('dashboard.admin');

    //################################ end dashboard admin #####################################


    Route::middleware(['auth:admin'])->group(function () {


        Route::group(['prefix' => 'Sections'], function () {
            Route::get('index', [SectionController::class, 'index'])->name('Sections.index');
            Route::post('store', [SectionController::class, 'store'])->name('Sections.store');
            Route::get('show/{id}', [SectionController::class, 'show'])->name('Sections.show');
            Route::post('update/{id}', [SectionController::class, 'update'])->name('Sections.update');
            Route::post('destroy/{id}', [SectionController::class, 'destroy'])->name('Sections.destroy');
        });

        Route::group(['prefix' => 'Doctors'], function () {
            Route::get('index', [DoctorController::class, 'index'])->name('Doctors.index');
            Route::get('create', [DoctorController::class, 'create'])->name('Doctors.create');
            Route::post('store', [DoctorController::class, 'store'])->name('Doctors.store');
            Route::get('edit/{id}', [DoctorController::class, 'edit'])->name('Doctors.edit');
            Route::get('show/{id}', [DoctorController::class, 'show'])->name('Doctors.show');
            Route::post('update/{id}', [DoctorController::class, 'update'])->name('Doctors.update');
            Route::post('destroy/{id}', [DoctorController::class, 'destroy'])->name('Doctors.destroy');
            Route::post('update_password', [DoctorController::class, 'update_password'])->name('update_password');
            Route::post('update_status', [DoctorController::class, 'update_status'])->name('update_status');
        });

        Route::group(['prefix' => 'Service'], function () {
            Route::get('index', [ServiceController::class, 'index'])->name('Service.index');
            Route::post('store', [ServiceController::class, 'store'])->name('Service.store');
            Route::post('update/{id}', [ServiceController::class, 'update'])->name('Service.update');
            Route::post('destroy/{id}', [ServiceController::class, 'destroy'])->name('Service.destroy');
        });

        Route::view('Add_GroupServices', 'livewire.GroupServices.include_create')->name('Add_GroupServices');

        Route::group(['prefix' => 'insurance'], function () {
            Route::get('index', [insuranceController::class, 'index'])->name('insurance.index');
            Route::get('create', [insuranceController::class, 'create'])->name('insurance.create');
            Route::post('store', [insuranceController::class, 'store'])->name('insurance.store');
            Route::get('edit/{id}', [insuranceController::class, 'edit'])->name('insurance.edit');
            Route::get('show/{id}', [insuranceController::class, 'show'])->name('insurance.show');
            Route::post('update/{id}', [insuranceController::class, 'update'])->name('insurance.update');
            Route::post('destroy/{id}', [insuranceController::class, 'destroy'])->name('insurance.destroy');
        });

        Route::group(['prefix' => 'Ambulance'], function () {
            Route::get('index', [AmbulanceController::class, 'index'])->name('Ambulance.index');
            Route::get('create', [AmbulanceController::class, 'create'])->name('Ambulance.create');
            Route::post('store', [AmbulanceController::class, 'store'])->name('Ambulance.store');
            Route::get('edit/{id}', [AmbulanceController::class, 'edit'])->name('Ambulance.edit');
            Route::get('show/{id}', [AmbulanceController::class, 'show'])->name('Ambulance.show');
            Route::post('update/{id}', [AmbulanceController::class, 'update'])->name('Ambulance.update');
            Route::post('destroy/{id}', [AmbulanceController::class, 'destroy'])->name('Ambulance.destroy');
        });

        Route::group(['prefix' => 'Patients'], function () {
            Route::get('index', [PatientsController::class, 'index'])->name('Patients.index');
            Route::get('create', [PatientsController::class, 'create'])->name('Patients.create');
            Route::post('store', [PatientsController::class, 'store'])->name('Patients.store');
            Route::get('edit/{id}', [PatientsController::class, 'edit'])->name('Patients.edit');
            Route::get('show/{id}', [PatientsController::class, 'show'])->name('Patients.show');
            Route::post('update/{id}', [PatientsController::class, 'update'])->name('Patients.update');
            Route::post('destroy/{id}', [PatientsController::class, 'destroy'])->name('Patients.destroy');
        });

        Route::view('single_invoices', 'livewire.single_invoices.index')->name('single_invoices');
        Route::view('Print_single_invoices', 'livewire.single_invoices.print')->name('Print_single_invoices');

        Route::view('group_invoices', 'livewire.group_invoices.index')->name('group_invoices');
        Route::view('group_Print_single_invoices', 'livewire.group_invoices.print')->name('group_Print_single_invoices');

        Route::group(['prefix' => 'Receipt'], function () {
            Route::get('index', [ReceiptController::class, 'index'])->name('Receipt.index');
            Route::get('create', [ReceiptController::class, 'create'])->name('Receipt.create');
            Route::post('store', [ReceiptController::class, 'store'])->name('Receipt.store');
            Route::get('edit/{id}', [ReceiptController::class, 'edit'])->name('Receipt.edit');
            Route::get('show/{id}', [ReceiptController::class, 'show'])->name('Receipt.show');
            Route::post('update/{id}', [ReceiptController::class, 'update'])->name('Receipt.update');
            Route::post('destroy/{id}', [ReceiptController::class, 'destroy'])->name('Receipt.destroy');
        });

        Route::group(['prefix' => 'Payment'], function () {
            Route::get('index', [PaymentController::class, 'index'])->name('Payment.index');
            Route::get('create', [PaymentController::class, 'create'])->name('Payment.create');
            Route::post('store', [PaymentController::class, 'store'])->name('Payment.store');
            Route::get('edit/{id}', [PaymentController::class, 'edit'])->name('Payment.edit');
            Route::get('show/{id}', [PaymentController::class, 'show'])->name('Payment.show');
            Route::post('update/{id}', [PaymentController::class, 'update'])->name('Payment.update');
            Route::post('destroy/{id}', [PaymentController::class, 'destroy'])->name('Payment.destroy');
        });

        Route::group(['prefix' => 'ray_employee'], function () {
            Route::get('index', [RayEmployeeController::class, 'index'])->name('ray_employee.index');
            Route::post('store', [RayEmployeeController::class, 'store'])->name('ray_employee.store');
            Route::post('update/{id}', [RayEmployeeController::class, 'update'])->name('ray_employee.update');
            Route::post('destroy/{id}', [RayEmployeeController::class, 'destroy'])->name('ray_employee.destroy');
        });

        Route::group(['prefix' => 'laboratorie_employee'], function () {
            Route::get('index', [LaboratorieEmployeeController::class, 'index'])->name('laboratorie_employee.index');
            Route::post('store', [LaboratorieEmployeeController::class, 'store'])->name('laboratorie_employee.store');
            Route::post('update/{id}', [LaboratorieEmployeeController::class, 'update'])->name('laboratorie_employee.update');
            Route::post('destroy/{id}', [LaboratorieEmployeeController::class, 'destroy'])->name('laboratorie_employee.destroy');
        });

        Route::group(['prefix' => 'appointments'], function () {
            Route::get('index', [AppointmentControllerr::class, 'index'])->name('appointments.index');
            Route::get('index2', [AppointmentControllerr::class, 'index2'])->name('appointments.index2');
            Route::get('index3', [AppointmentControllerr::class, 'index3'])->name('appointments.index3');
            Route::post('approval/{id}', [AppointmentControllerr::class, 'approval'])->name('appointments.approval');
            Route::post('destroy/{id}', [AppointmentControllerr::class, 'destroy'])->name('appointments.destroy');
        });

        Route::group(['prefix' => 'ProfileAdmin'], function () {
            Route::get('index', [ProfileAdminController::class, 'index'])->name('ProfileAdmin.index');
            Route::post('update/{id}', [ProfileAdminController::class, 'update'])->name('ProfileAdmin.update');
        });

        Route::post('/AddimageAdmin', [AddImageAdminController::class, 'update'])->name('AddimageAdmin.update');
    });


    require __DIR__ . '/auth.php';
});
