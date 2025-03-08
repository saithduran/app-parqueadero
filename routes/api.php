<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistroController;

Route::post('/ingreso', [RegistroController::class, 'store']);
Route::post('/salida/{id}', [RegistroController::class, 'update']);
Route::get('/registros', [RegistroController::class, 'index']);
