<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SheltersController;
use App\Http\Controllers\Api\CatsController;
use App\Http\Controllers\Api\EmployeesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('api')->group(function () {
    /** @see SheltersController::getAll() */
    Route::get('/shelters/getAll', [SheltersController::class, 'getAll']);

    /** @see SheltersController::getById() */
    Route::get('/shelters/getById/{id}', [SheltersController::class, 'getById']);

    /** @see SheltersController::create() */
    Route::put('/shelters/create', [SheltersController::class, 'create']);

    /** @see SheltersController::edit() */
    Route::put('/shelters/edit/{id}', [SheltersController::class, 'edit']);

    /** @see SheltersController::delete() */
    Route::delete('/shelters/delete/{id}', [SheltersController::class, 'delete']);


    /** @see CatsController::getAll() */
    Route::get('/cats/getAll', [CatsController::class, 'getAll']);

    /** @see CatsController::getById() */
    Route::get('/cats/getById/{id}', [CatsController::class, 'getById']);

    /** @see CatsController::create() */
    Route::put('/cats/create', [CatsController::class, 'create']);

    /** @see CatsController::edit() */
    Route::put('/cats/edit/{id}', [CatsController::class, 'edit']);

    /** @see CatsController::delete() */
    Route::delete('/cats/delete/{id}', [CatsController::class, 'delete']);


    /** @see EmployeesController::getAll() */
    Route::get('/employees/getAll', [EmployeesController::class, 'getAll']);

    /** @see EmployeesController::getById() */
    Route::get('/employees/getById/{id}', [EmployeesController::class, 'getById']);

    /** @see EmployeesController::create() */
    Route::put('/employees/create', [EmployeesController::class, 'create']);

    /** @see EmployeesController::edit() */
    Route::put('/employees/edit/{id}', [EmployeesController::class, 'edit']);

    /** @see EmployeesController::delete() */
    Route::delete('/employees/delete/{id}', [EmployeesController::class, 'delete']);


});