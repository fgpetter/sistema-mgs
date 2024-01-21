<?php

use App\Models\Beneficio;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EpiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BeneficioController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\DadoBancarioController;

Auth::routes();
Route::get('/', function(){
  return redirect()->route('login');
});

/* Rotas do template */
// Route::get('{any}', [App\Http\Controllers\HomeController::class, 'index'])->name('index');

/* Rotas do painel */
Route::prefix('painel')->middleware('auth')->group(function () {

  Route::get('/', function () {
    return view('index');
  });

  /* Usuários */
  Route::group(['prefix' => 'user'], function () {
    Route::get('index', [UserController::class, 'index'])->name('user-index');
    Route::get('edit/{user}', [UserController::class, 'view'])->name('user-edit');
    Route::post('create', [UserController::class, 'create'])->name('user-create');
    Route::post('update/{user}', [UserController::class, 'update'])->name('user-update');
    Route::post('delete/{user}', [UserController::class, 'delete'])->name('user-delete');
  });

  /* Funcionarios */
  Route::group(['prefix' => 'funcionario'], function () {
    Route::get('index', [FuncionarioController::class, 'index'])->name('funcionario-index');
    Route::get('insert/{funcionario:uid?}', [FuncionarioController::class, 'insert'])->name('funcionario-insert');
    Route::post('create', [FuncionarioController::class, 'create'])->name('funcionario-create');
    Route::post('update/{funcionario:uid}', [FuncionarioController::class, 'update'])->name('funcionario-update');
    Route::post('delete/{funcionario:uid}', [FuncionarioController::class, 'delete'])->name('funcionario-delete');
    Route::post('delete-curriculo/{funcionario:uid}', [FuncionarioController::class, 'curriculoDelete'])->name('curriculo-delete');
  });

  /* Dados bancários */
  Route::group(['prefix' => 'conta'], function () {
    Route::post('create', [DadoBancarioController::class, 'create'])->name('conta-create');
    Route::post('update/{conta:uid}', [DadoBancarioController::class, 'update'])->name('conta-update');
    Route::post('delete/{conta:uid}', [DadoBancarioController::class, 'delete'])->name('conta-delete');
  });

  /* Beneficios */
  Route::group(['prefix' => 'beneficio'], function () {
    Route::get('index', [BeneficioController::class, 'index'])->name('beneficio-index');
    Route::get('insert/{beneficio:uid?}', [BeneficioController::class, 'insert'])->name('beneficio-insert');
    Route::post('create', [BeneficioController::class, 'create'])->name('beneficio-create');
    Route::post('update/{beneficio:uid}', [BeneficioController::class, 'update'])->name('beneficio-update');
    Route::post('delete/{beneficio:uid}', [BeneficioController::class, 'delete'])->name('beneficio-delete');
  });

  /* EPIs */
  Route::group(['prefix' => 'epi'], function () {
    Route::get('index', [EpiController::class, 'index'])->name('epi-index');
    Route::post('create', [EpiController::class, 'create'])->name('epi-create');
    Route::post('update/{epi:uid}', [EpiController::class, 'update'])->name('epi-update');
    Route::post('delete/{epi:uid}', [EpiController::class, 'delete'])->name('epi-delete');
  });

});
