<?php

use Illuminate\Support\Facades\Route;

// todas las rutas que definas aquí se asignaran al middleware "web"
// este proporciona estados para la sessión
// proteccion CSRF (esto es una manera de enviar datos se manera segura de un formulario)

Route::get('/', function () {
  return view('welcome');
});
