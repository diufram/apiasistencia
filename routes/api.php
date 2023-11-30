<?php

use App\Http\Controllers\AsistenciaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\TallerController;
use App\Http\Controllers\TecnicoController;
use App\Http\Controllers\VehiculoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::post('login',[AuthController::class,'login']);


Route::post('register',[AuthController::class,'register']);


Route::middleware(['auth:sanctum'])->group((function(){
    Route::get('logout',[AuthController::class,'logout']);
    Route::get('vehiculos',[VehiculoController::class,'index']);
    Route::post('vehiculos/create',[VehiculoController::class,'create']);
    Route::post('token',[AuthController::class,'token']);

    Route::get('taller',[TallerController::class,'index']);
    Route::get('tallers',[TallerController::class,'tallers']);
    
    Route::post('taller/create',[TallerController::class,'create']);
    Route::post('addServicioToTaller',[TallerController::class,'addServicioToTaller']);

    Route::get('asistencia',[AsistenciaController::class,'asistencia']);
    Route::post('asistencia/create',[AsistenciaController::class,'create']);
    Route::post('cancelarAsistencia',[AsistenciaController::class,'cancelarAsistencia']);
    Route::post('cobroasistencia',[AsistenciaController::class,'cobroasistencia']);


    Route::get('servicio',[ServicioController::class,'index']);
    Route::post('servicioToTallers',[ServicioController::class,'servicioToTallers']);
    
    
    Route::post('addtecnico',[TecnicoController::class,'addtecnico']);
    Route::post('addTecnicoToAsistencia',[TecnicoController::class,'addTecnicoToAsistencia']);
    Route::get('tecnicoToTaller',[TecnicoController::class,'tecnicoToTaller']);


    Route::get('getServicioToTaller',[TallerController::class,'getServicioToTaller']);

    //TALLER
    Route::get('asistencias',[AsistenciaController::class,'index']);

}));

Route::get('tecnicos',[TecnicoController::class,'tecnicos']);






