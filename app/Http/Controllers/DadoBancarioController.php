<?php

namespace App\Http\Controllers;

use Illuminate\Support\Arr;
use App\Models\DadoBancario;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class DadoBancarioController extends Controller
{

  /**
   * Adiciona usuários na base
   *
   * @param Request $request
   * @return RedirectResponse
   **/
  public function create(Request $request): RedirectResponse
  {
    $validated = $request->validate([
      'banco' => ['required', 'string'],
      'cod_banco' => ['required', 'string'],
      'agencia' => ['required', 'string'],
      'conta' => ['required', 'string'],
      'funcionario_id' => ['required'],
    ],[
      'banco.required' => 'Preencha o nome do banco',
      'cod_banco.required' => 'Preencha o código do banco',
      'agencia.required' => 'Preencha a agência',
      'conta' => 'Preencha a conta',
    ]);
    $validated = Arr::add($validated,'uid', config('hashing.uid'));

    $conta = DadoBancario::create($validated);

    if(!$conta){
      return redirect()->back()->with('error', 'Ocorreu um erro!');
    }

    return redirect()->back()->with('funcionario-success', 'Conta cadastrada com sucesso');
  }

  /**
   * Edita dados de unidade
   *
   * @param Request $request
   * @param DadoBancario $unidade
   * @return RedirectResponse
   **/
  public function update(Request $request, DadoBancario $conta): RedirectResponse
  {
    $validated = $request->validate([
      'banco' => ['required', 'string'],
      'cod_banco' => ['required', 'string'],
      'agencia' => ['required', 'string'],
      'conta' => ['required', 'string'],
      ],[
        'banco.required' => 'Preencha o nome do banco',
        'cod_banco.required' => 'Preencha o código do banco',
        'agencia.required' => 'Preencha a agência',
        'conta' => 'Preencha a conta',
      ]);

    $conta->update($validated);

    return redirect()->back()->with('funcionario-success', 'Conta atualizada com sucesso');

  }

  /**
   * Remove conta
   *
   * @param DadoBancario $user
   * @return RedirectResponse
   **/
  public function delete(DadoBancario $conta): RedirectResponse
  {
    $conta->delete();

    return redirect()->back()->with('funcionario-success', 'Conta removida');
  }

}