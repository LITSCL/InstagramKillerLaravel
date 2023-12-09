<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();

Route::get("/", [App\Http\Controllers\HomeController::class, "home"])->name("home"); //El método "name", permite redireccionar desde las vistas de la siguiente forma "<a href='{{ route('home') }}'>".

Route::get("/usuario/configuracion", [App\Http\Controllers\UsuarioController::class, "configuracion"])->name("usuario.vista.configuracion"); //El método "name", permite redireccionar desde las vistas de la siguiente forma "<a href='{{ route('usuario.vista.configuracion') }}'>".
Route::post("/usuario/actualizar", [App\Http\Controllers\UsuarioController::class, "update"])->name("usuario.accion.update");
Route::get("/usuario/avatar/{nombreArchivo}", [App\Http\Controllers\UsuarioController::class, "getImagen"])->name("usuario.archivo.getImagen");
Route::get("/usuario/perfil/{id}", [App\Http\Controllers\UsuarioController::class, "perfil"])->name("usuario.vista.perfil");
Route::get("/usuarios/{buscar?}", [App\Http\Controllers\UsuarioController::class, "usuarios"])->name("usuario.vista.usuarios");

Route::get("/imagen/subir", [App\Http\Controllers\ImagenController::class, "subir"])->name("imagen.vista.subir");
Route::post("/imagen/guardar", [App\Http\Controllers\ImagenController::class, "save"])->name("imagen.accion.save");
Route::get("/imagen/borrar/{id}", [App\Http\Controllers\ImagenController::class, "delete"])->name("imagen.accion.delete");
Route::get("/imagen/publicacion/{nombreArchivo}", [App\Http\Controllers\ImagenController::class, "getImagen"])->name("imagen.archivo.getImagen");
Route::get("/imagen/publicacion/detalle/{id}", [App\Http\Controllers\ImagenController::class, "detalle"])->name("imagen.vista.detalle");
Route::get("/imagen/publicacion/editar/{id}", [App\Http\Controllers\ImagenController::class, "editar"])->name("imagen.vista.editar");
Route::post("/imagen/actualizar", [App\Http\Controllers\ImagenController::class, "update"])->name("imagen.accion.update");

Route::post("/comentario/guardar", [App\Http\Controllers\ComentarioController::class, "save"])->name("comentario.accion.save");
Route::get("/comentario/borrar/{id}", [App\Http\Controllers\ComentarioController::class, "delete"])->name("comentario.accion.delete");

Route::get("/like/guardar/{idImagen}", [App\Http\Controllers\LikeController::class, "save"])->name("like.accion.save");
Route::get("/like/borrar/{idImagen}", [App\Http\Controllers\LikeController::class, "delete"])->name("like.accion.delete");
Route::get("/like/favoritos", [App\Http\Controllers\LikeController::class, "favoritos"])->name("like.vista.favoritos");