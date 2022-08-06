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

    Route::controller(HomeController::class)->group(function () {
        Route::get('/home', 'index')->name('home');
        Route::post('/buscar-cep', 'buscarCep')->name('buscarCep');
    });

    Route::controller(ClienteController::class)->group(function () {
        Route::get('/clientes', 'listarClientes')->name('listarClientes');
        Route::get('/cliente/editar/{id?}', 'editarCliente')->name('editarCliente');
        Route::post('/buscar-cliente', 'buscarCliente')->name('buscarCliente');
        Route::post('/buscar-cliente-completo', 'buscarClienteLike')->name('buscarClienteLike');
        Route::post('/criar-cliente',  'saveCreateCliente')->name('saveCreateCliente');
        Route::post('/editar-cliente',  'saveEditCliente')->name('saveEditCliente');
    });

    Route::controller(GerenteController::class)->group(function () {
        Route::post('/criar-gerente',  'saveCreateGerente')->name('saveCreateGerente');
        Route::post('/editar-gerente',  'saveEditGerente')->name('saveEditGerente');
        Route::get('/funcionarios', 'listarFuncionarios')->name('listarFuncionarios');
        Route::get('/funcionario/editar/{id?}', 'editarFuncionario')->name('editarFuncionario');
        Route::post('/criar-funcionario',  'saveCreateFuncionario')->name('saveCreateFuncionario');
        Route::post('/editar-funcionario',  'saveEditFuncionario')->name('saveEditFuncionario');
        Route::post('/buscar-funcionario', 'buscarFuncionario')->name('buscarFuncionario');
        Route::post('/buscar-funcionario-completo', 'buscarFuncionarioLike')->name('buscarFuncionarioLike');
        Route::get('/gerente/editar/{id?}', 'editarGerente')->name('editarGerente');
        Route::get('/gerentes', 'listarGerentes')->name('listarGerentes');
    });
//Route::get('/home', [HomeController::class, 'index'])->name('home');
//
//Route::get('/funcionarios', [UserController::class, 'listarFuncionarios'])->name('listarFuncionarios');
//Route::get('/funcionario/editar/{id?}', [UserController::class, 'editarFuncionario'])->name('editarFuncionario');
//Route::post('/gerentes', [UserController::class, 'salvarFuncionario'])->name('salvarFuncionario');
//
//Route::get('/gerente/editar/{id?}', [GerenteController::class, 'editarGerente'])->name('editarGerente');
//Route::get('/gerentes', [GerenteController::class, 'listarGerentes'])->name('listarGerentes');
//Route::post('/gerentes', [GerenteController::class, 'salvarGerente'])->name('salvarGerente');
//
//Route::post('/buscar-cep', [HomeController::class, 'buscarCep'])->name('buscarCep');


