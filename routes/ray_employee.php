<?php

use App\Http\Controllers\RayEmployee_Dash\AddImageRayController;
use App\Http\Controllers\RayEmployee_Dash\invoicesController;
use App\Http\Controllers\RayEmployee_Dash\ProfileRayController;
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
    Route::get('/dashboard/ray_employee', function () {
        return view('Dashboard.ray_employee.dashboard');
    })->middleware(['auth:ray_employee'])->name('dashboard.ray_employee');

    //################################ end dashboard doctor #####################################


    Route::middleware(['auth:ray_employee'])->group(function () {

        Route::group(['prefix' => 'invoices_ray_employee'], function () {
            Route::get('index', [invoicesController::class, 'index'])->name('invoices_ray_employee.index');
            Route::get('edit/{id}', [invoicesController::class, 'edit'])->name('invoices_ray_employee.edit');
            Route::post('update/{id}', [invoicesController::class, 'update'])->name('invoices_ray_employee.update');
            Route::get('completed_invoices', [invoicesController::class, 'completed_invoices'])->name('completed_invoices');
            Route::get('view_rays/{id}', [invoicesController::class, 'view_rays'])->name('view_rays');
        });

        Route::group(['prefix' => 'ProfileRay'], function () {
            Route::get('index', [ProfileRayController::class, 'index'])->name('ProfileRay.index');
            Route::post('update/{id}', [ProfileRayController::class, 'update'])->name('ProfileRay.update');
        });

        Route::post('/AddimageRay', [AddImageRayController::class, 'update'])->name('AddimageRay.update');
    });


    require __DIR__ . '/auth.php';
});
