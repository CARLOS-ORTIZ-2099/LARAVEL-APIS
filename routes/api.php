<?php

use App\Http\Controllers\api\StudentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// ver usuarios
Route::get('/users/index', [StudentController::class, 'index']);

// ver usuario en especifico
Route::get('/user/show/{id}', [StudentController::class, 'show']);

// crear usuario
Route::post('/user/store', [StudentController::class, 'store']);

// editar usuario
Route::put('/user/update/{id}', [StudentController::class, 'update']);

// eliminar usuario
Route::delete('/user/destroy/{id}', [StudentController::class, 'destroy']);
