<?php

use App\Http\Controllers\Doctor_Dash\AddImageDoctorController;
use App\Http\Controllers\Doctor_Dash\DiagnosisController;
use App\Http\Controllers\Doctor_Dash\invoicesController;
use App\Http\Controllers\Doctor_Dash\LaboratorieController;
use App\Http\Controllers\Doctor_Dash\PatientDetailsController;
use App\Http\Controllers\Doctor_Dash\ProfileDoctorController;
use App\Http\Controllers\Doctor_Dash\RaysController;
use App\Http\Livewire\Chat\Createchat;
use App\Http\Livewire\Chat\Main;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| doctor Routes
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

    //################################ dashboard doctor ########################################
    Route::get('/dashboard/doctor', function () {
        return view('Dashboard.Doctors.dashboard_doctor');
    })->middleware(['auth:doctor'])->name('dashboard.doctor');

    //################################ end dashboard doctor #####################################


    Route::middleware(['auth:doctor'])->group(function () {


        Route::group(['prefix' => 'invoices'], function () {
            Route::get('index', [invoicesController::class, 'index'])->name('invoices.index');
            Route::get('completedInvoices', [invoicesController::class, 'completedInvoices'])->name('completedInvoices');
            Route::get('reviewInvoices', [invoicesController::class, 'reviewInvoices'])->name('reviewInvoices');
            Route::get('show/{id}', [invoicesController::class, 'show'])->name('invoices.show');
        });

        Route::group(['prefix' => 'Diagnostics'], function () {
            Route::post('add_review', [DiagnosisController::class, 'addReview'])->name('add_review');
            Route::get('invoice_status', [DiagnosisController::class, 'invoice_status'])->name('invoice_status');
            Route::post('store', [DiagnosisController::class, 'store'])->name('Diagnostics.store');
            // Route::get('show/{id}', [DiagnosisController::class, 'show'])->name('Diagnostics.show');
        });

        Route::group(['prefix' => 'rays'], function () {
            Route::post('store', [RaysController::class, 'store'])->name('rays.store');
            Route::post('update/{id}', [RaysController::class, 'update'])->name('rays.update');
            Route::post('destroy/{id}', [RaysController::class, 'destroy'])->name('rays.destroy');
        });

        Route::group(['prefix' => 'PatientDetails'], function () {
            Route::get('index/{id}', [PatientDetailsController::class, 'index'])->name('PatientDetails.index');
        });

        Route::group(['prefix' => 'Laboratories'], function () {
            Route::post('store', [LaboratorieController::class, 'store'])->name('Laboratories.store');
            Route::post('update/{id}', [LaboratorieController::class, 'update'])->name('Laboratories.update');
            Route::post('destroy/{id}', [LaboratorieController::class, 'destroy'])->name('Laboratories.destroy');
        });


        //############################# Chat route ##########################################
        Route::get('list/patients', Createchat::class)->name('list.patients');
        Route::get('chat/patients', Main::class)->name('chat.patients');
        //############################# end Chat route ######################################

        Route::group(['prefix' => 'ProfileDoctor'], function () {
            Route::get('index', [ProfileDoctorController::class, 'index'])->name('ProfileDoctor.index');
            Route::post('update/{id}', [ProfileDoctorController::class, 'update'])->name('ProfileDoctor.update');
        });

        Route::post('/AddimageDoctor', [AddImageDoctorController::class, 'update'])->name('AddimageDoctor.update');

        Route::get('/404', function () {
            return view('Dashboard.404');
        })->name('404');
    });

    require __DIR__ . '/auth.php';
});
