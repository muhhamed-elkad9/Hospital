<?php

use App\Http\Controllers\LaboratorieEmployee_Dash\AddImageLaboratorieController;
use App\Http\Controllers\LaboratorieEmployee_Dash\invoicesController;
use App\Http\Controllers\LaboratorieEmployee_Dash\ProfileLaboratorieController;
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

    //################################ dashboard doctor ########################################
    Route::get('/dashboard/laboratorie_employee', function () {
        return view('Dashboard.laboratorie_employee.dashboard');
    })->middleware(['auth:laboratorie_employee'])->name('dashboard.laboratorie_employee');

    //################################ end dashboard doctor #####################################


    Route::middleware(['auth:laboratorie_employee'])->group(function () {

        Route::group(['prefix' => 'invoices_laboratorie_employee'], function () {
            Route::get('index', [invoicesController::class, 'index'])->name('invoices_laboratorie_employee.index');
            Route::get('edit/{id}', [invoicesController::class, 'edit'])->name('invoices_laboratorie_employee.edit');
            Route::post('update/{id}', [invoicesController::class, 'update'])->name('invoices_laboratorie_employee.update');
            Route::get('completed_invoices', [invoicesController::class, 'completed_invoices'])->name('completed_invoices');
            Route::get('view_rays/{id}', [invoicesController::class, 'view_rays'])->name('view_rays');
        });

        Route::group(['prefix' => 'ProfileLaboratorie'], function () {
            Route::get('index', [ProfileLaboratorieController::class, 'index'])->name('ProfileLaboratorie.index');
            Route::post('update/{id}', [ProfileLaboratorieController::class, 'update'])->name('ProfileLaboratorie.update');
        });

        Route::post('/AddimageLaboratorie', [AddImageLaboratorieController::class, 'update'])->name('AddimageLaboratorie.update');
    });

    require __DIR__ . '/auth.php';
});
