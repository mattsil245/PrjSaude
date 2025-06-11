<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/usuarios', [UsuarioController::class,'indexApi']);
Route::post('/usuarios', [UsuarioController::class,'storeApi']);
Route::put('/usuarios/{id}', [UsuarioController::class,'updateApi']);   // PUT para atualizar
Route::delete('/usuarios/{id}', [UsuarioController::class,'destroyApi']); // DELETE para deletar
Route::post('/login', [UsuarioController::class, 'login']);
