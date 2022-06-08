<?php

use App\Http\Controllers\DET_DIARIOController;
use App\Http\Controllers\DET_DIARIODETController;
use App\Http\Controllers\TMA_PLANCTAController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::view('/planCuentas', 'planCuentas');
Route::view('/diario', 'diario');
Route::view('/detalleDiario', 'detalleDiario');
Route::post('/importarPlannCta', [TMA_PLANCTAController::class, 'importarPlanCta'])->name('importarPlannCta');
Route::post('/importarDiario', [DET_DIARIOController::class, 'importarDiario'])->name('importarDiario');
Route::post('/importarDetDiario', [DET_DIARIODETController::class, 'importarDetalle_diario'])->name('importarDetDiario');
Route::post('/mayorCuentaContable', [DET_DIARIODETController::class, 'mayorCuentaContable'])->name('mayorCuentaContable');
Route::view('/mayorcontable', 'mayorContable');
