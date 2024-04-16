<?php

namespace App\Http\Controllers;

use App\Models\Funcionario;
use Illuminate\Support\Arr;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\FuncionarioRequest;

class FuncionarioController extends Controller
{
    /**
   * Gera pagina de listagem de usuários
   *
   * @return View
   **/
  public function index(): View
  {
    $funcionarios = Funcionario::all();
    return view('painel.funcionarios.index', ['funcionarios' => $funcionarios]);
  }

  /**
   * Adiciona usuários na base
   *
   * @param FuncionarioRequest $request
   * @return RedirectResponse
   **/
  public function create(FuncionarioRequest $request): RedirectResponse
  {
    $validated = $request->except('uid', '_token');
    
    $validated = Arr::add($validated,'uid', config('hashing.uid'));

    $funcionario = Funcionario::create($validated);

    if(!$funcionario){
      return back()->with('funcionario-error', 'Ocorreu um erro! Revise os dados e tente novamente');
    }

    return redirect()->route('funcionario-insert', $funcionario)->with('funcionario-success', 'Funcionario cadastrado com sucesso');
  }

  /**
   * Tela de edição de usuário
   *
   * @param Funcionario $funcionario
   * @return View
   **/
  public function insert(Funcionario $funcionario): View|RedirectResponse
  {
    return view('painel.funcionarios.insert', ['funcionario' => $funcionario]);
  }

  /**
   * Edita dados de usuário
   *
   * @param FuncionarioRequest $request
   * @param Funcionario $user
   * @return RedirectResponse
   **/
  public function update(FuncionarioRequest $request, Funcionario $funcionario): RedirectResponse
  {
    $validated = $request->except('uid', '_token');
    $validated = Arr::map($validated, function ($value, string $key) {
      if(str_contains($value, ',')){
        $value = floatval(str_replace(',','.', $value));
      }
      return $value;
    });

    $funcionario->update($validated);

    return redirect()->back()->with('funcionario-success', 'Funcionario atualizado com sucesso');
  }

  /**
   * Remove usuário
   *
   * @param User $user
   * @return RedirectResponse
   **/
    public function delete(Funcionario $funcionario): RedirectResponse
    {
      $funcionario->delete();
      return redirect()->route('funcionario-index')->with('funcionario-success', 'Funcionario removido');
    }

}