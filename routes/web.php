<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EpiController;
use App\Http\Controllers\ObraController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FolhaController;
use App\Http\Controllers\ItemFolhaController;
use App\Http\Controllers\DependenteController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\DadoBancarioController;
use App\Http\Controllers\LancamentoPontoController;

Auth::routes();
Route::get('/', function(){
  return redirect('/painel');
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
    Route::get('generate-doc-adimissao/{funcionario:uid}', [FuncionarioController::class, 'generateDocAdimissao'])->name('funcionario-generate-doc-adimissao');
  });

  /* Dados bancários */
  Route::group(['prefix' => 'dependente'], function () {
    Route::post('create', [DependenteController::class, 'create'])->name('dependente-create');
    Route::post('update/{dependente:uid}', [DependenteController::class, 'update'])->name('dependente-update');
    Route::post('delete/{dependente:uid}', [DependenteController::class, 'delete'])->name('dependente-delete');
  });

  /* Dados bancários */
  Route::group(['prefix' => 'conta'], function () {
    Route::post('create', [DadoBancarioController::class, 'create'])->name('conta-create');
    Route::post('update/{conta:uid}', [DadoBancarioController::class, 'update'])->name('conta-update');
    Route::post('delete/{conta:uid}', [DadoBancarioController::class, 'delete'])->name('conta-delete');
  });

  /* Itens Folha */
  Route::group(['prefix' => 'item-folha'], function () {
    Route::get('index', [ItemFolhaController::class, 'index'])->name('item-folha-index');
    Route::get('insert/{itemFolha:uid?}', [ItemFolhaController::class, 'insert'])->name('item-folha-insert');
    Route::post('create', [ItemFolhaController::class, 'create'])->name('item-folha-create');
    Route::post('update/{itemFolha:uid}', [ItemFolhaController::class, 'update'])->name('item-folha-update');
    Route::post('delete/{itemFolha:uid}', [ItemFolhaController::class, 'delete'])->name('item-folha-delete');
  });

  /* EPIs */
  Route::group(['prefix' => 'epi'], function () {
    Route::get('index', [EpiController::class, 'index'])->name('epi-index');
    Route::get('controle', [EpiController::class, 'controleEpi'])->name('epi-controle');
    Route::post('create', [EpiController::class, 'create'])->name('epi-create');
    Route::post('update/{epi:uid}', [EpiController::class, 'update'])->name('epi-update');
    Route::post('delete/{epi:uid}', [EpiController::class, 'delete'])->name('epi-delete');
    Route::post('registra-entrega/{controle?}', [EpiController::class, 'registraEntregaEpi'])->name('registra-entrega-epi');
    Route::post('remove-entrega/{controle?}', [EpiController::class, 'removeEntregaEpi'])->name('remove-entrega-epi');
  });

    /* Obras */
    Route::group(['prefix' => 'obra'], function () {
      Route::get('index', [ObraController::class, 'index'])->name('obra-index');
      Route::post('create/{obra?}', [ObraController::class, 'create'])->name('obra-create');
      Route::post('update/{obra}', [ObraController::class, 'update'])->name('obra-update');
      Route::post('delete/{obra}', [ObraController::class, 'delete'])->name('obra-delete');
    });
  

  /* Lancamento Ponto */
  Route::group(['prefix' => 'lancamentoPonto'], function () {
    Route::get('ponto/{funcionario:uid?}', [LancamentoPontoController::class, 'index'])->name('lancamento-ponto-index');
    Route::post('insert/{funcionario:uid}', [LancamentoPontoController::class, 'insert'])->name('lancamento-ponto-insert');
    Route::post('delete', [LancamentoPontoController::class, 'destroy'])->name('lancamento-ponto-delete');
    Route::post('status-ponto/{funcionario:uid}', [LancamentoPontoController::class, 'statusPonto'])->name('status-ponto');
    Route::get('relatorio-ponto', [LancamentoPontoController::class, 'relatorio'])->name('relatorio-ponto');
  });

  /* Folha de pagamento */
  Route::group(['prefix' => 'folha'], function () {
    Route::get('index', [FolhaController::class, 'index'])->name('folha-index');
    Route::get('insert/{lancamento:uid?}', [FolhaController::class, 'insert'])->name('folha-insert');
    Route::post('salva-folha', [FolhaController::class, 'salvaFolha'])->name('salvar-folha');
    Route::post('inserir-ponto', [FolhaController::class, 'inserePonto'])->name('inserir-ponto');

  });
  

});
