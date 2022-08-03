<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
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

Route::controller(AuthController::class)->group(function () {
    Route::get('/', 'fazerLogin');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/funcionarios', [UserController::class, 'listarFuncionarios'])->name('listarFuncionarios');

Route::get('/funcionario/editar/{id?}', [UserController::class, 'editarFuncionario'])->name('editarFuncionario');

Route::get('/gerente/editar/{id?}', [GerenteController::class, 'editarGerente'])->name('editarGerente');
Route::get('/gerentes', [GerenteController::class, 'listarGerentes'])->name('listarGerentes');

Route::post('/buscar-cep', [HomeController::class, 'buscarCep'])->name('buscarCep');
