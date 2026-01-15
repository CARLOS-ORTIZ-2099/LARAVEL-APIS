<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# Creacion de APIS

ejecutamos el siguiente comando para tener un archivo de rutas que sirvan recursos REST FULL

Esto creara un archivo en routes/api.php

```shell
  php artisan install:api
```

## Definición de rutas

Luego definimos las rutas de la siguiente manera

```php
  // ver usuarios
  Route::get('/users/index', [StudentController::class, 'index']);

  // ver usuario en especifico
  Route::get('/user/show/{id}', [StudentController::class, 'show']);
```

## Definición de controladores

Nuestros controladores tienen que estar listos para devolver JSON

```php
    public function index()
    {

      $students =  Student::all();

      if ($students->isEmpty()) {
        $response = [
          "message" => "no hay datos disponibles",
          "status" => 200
        ];
        return response()->json($response);
      }
      return response()->json($students, 200);
    }
```
