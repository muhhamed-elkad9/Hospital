<?php

use App\Http\Controllers\Patient_Dash\AddImagePatientController;
use App\Http\Controllers\Patient_Dash\PatientController;
use App\Http\Controllers\Patient_Dash\ProfilePatientController;
use App\Http\Controllers\RayEmployee_Dash\invoicesController;
use App\Http\Livewire\Chat\Createchat;
use App\Http\Livewire\Chat\Main;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| ray_employee Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function () {

    //################################ dashboard patient ########################################
    Route::get('/dashboard/patient', function () {
        return view('Dashboard.patients.dashboard');
    })->middleware(['auth:patient'])->name('dashboard.patient');

    //################################ end dashboard patient #####################################


    Route::middleware(['auth:patient'])->group(function () {

        Route::group(['prefix' => 'invoices'], function () {
            Route::get('invoices', [PatientController::class, 'invoices'])->name('invoices.patient');
            Route::get('laboratories', [PatientController::class, 'laboratories'])->name('laboratories.patient');
            Route::get('view_laboratories/{id}', [PatientController::class, 'viewLaboratories'])->name('laboratories.view');
            Route::get('rays', [PatientController::class, 'rays'])->name('rays.patient');
            Route::get('view_rays/{id}', [PatientController::class, 'viewRays'])->name('rays.view');
            Route::get('payments', [PatientController::class, 'payments'])->name('payments.patient');
        });


        //############################# Chat route ##########################################
        Route::get('list/doctors', Createchat::class)->name('list.doctors');
        Route::get('chat/doctors', Main::class)->name('chat.doctors');
        //############################# end Chat route ######################################


        Route::group(['prefix' => 'ProfilePatient'], function () {
            Route::get('index', [ProfilePatientController::class, 'index'])->name('ProfilePatient.index');
            Route::post('update/{id}', [ProfilePatientController::class, 'update'])->name('ProfilePatient.update');
        });

        Route::post('/AddimagePatient', [AddImagePatientController::class, 'update'])->name('AddimagePatient.update');
    });

    require __DIR__ . '/auth.php';
});
