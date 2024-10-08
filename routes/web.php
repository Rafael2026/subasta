<?php

  use Illuminate\Support\Facades\Route;
  /*use App\Support\Csp\Policies\CustomPolicy;
  use Spatie\Csp\AddCspHeaders;

  use App\Http\Controllers\PrincipalController;
  use App\Http\Controllers\LoginController;
  use App\Http\Controllers\RegistroController;
  use App\Http\Controllers\PortalController;
  use App\Http\Controllers\SubastaController;
  use App\Http\Controllers\PujarController;
  use App\Http\Controllers\TablasController;
  use App\Http\Controllers\ProductosController;
  use App\Http\Controllers\UsuariosController;*/

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

  //Route::post('/', [PrincipalController::class, 'request']);
  //Route::post('/login', [LoginController::class, 'request']);
  //Route::post('/registro', [RegistroController::class, 'request']);
  //Route::post('/portal', [PortalController::class, 'request']);
  //Route::post('/subasta', [SubastaController::class, 'request']);
  //Route::post('/pujar', [PujarController::class, 'request']);
  //Route::post('/tablas', [TablasController::class, 'request']);
  //Route::post('/producto', [ProductosController::class, 'request']);

  Route::get('/', function() {
    return view('principal');
  });

  /*Route::get('/login', function() {
    return view('login');
  });

  Route::get('/registro', function() {
    return view('registro');
  });*/

  Route::get('/portal', function() {
    return view('portal');
  });

  Route::get('/subasta', function() {
    return view('subasta');
  });

  Route::get('/pujas', function() {
    return view('pujas');
  });

  Route::get('/tablas', function() {
    return view('tablas');
  });

  Route::get('/producto', function() {
    return view('producto');
  });

  //Route::get('example-route', 'ExampleController')->middleware(AddCspHeaders::class);

?>
