<?php

namespace App\Http\Controllers;

use App\Models\Dependente;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class DependenteController extends Controller
{

  /**
   * Adiciona dependente
   *
   * @param Request $request
   * @return RedirectResponse
   **/
  public function create(Request $request): RedirectResponse
  {
    $validated = $request->validate([
        'funcionario_id' => ['required', 'exists:funcionarios,id'],
        'nome' => ['nullable','string'],
        'nascimento' => ['nullable','date'],
        'parentesco' => ['nullable','string'],
        'sexo' => ['nullable','string', 'in:MASCULINO,FEMININO,OUTRO'],
        'est_civil' => ['nullable','string', 'in:SOLTEIRO,CASADO,DIVORCIADO,SEPARADO,VIUVO'],
        'cartorio' => ['nullable','string'],
        'num_registro' => ['nullable','string'],
        'livro' => ['nullable','string'],
        'folha' => ['nullable','string'],
        'nome_pensao' => ['nullable', 'string'],
        'cpf_pensao' => ['nullable', 'string'],
        'banco_pensao' => ['nullable', 'string'],
        'agencia_pensao' => ['nullable', 'string'],
        'conta_pensao' => ['nullable', 'string'],
    ],[
        'funcionario_id.required' => ['Funcionário inválido'],
        'funcionario_id.exists' => ['Funcionário inválido'],
        'nome.string' => ['Dado informado é inválido'],
        'nascimento.date' => ['Dado informado é inválido'],
        'parentesco.string' => ['Dado informado é inválido'],
        'sexo.in' => ['Selecione uma opção válida'],
        'est_civil.in' => ['Selecione uma opção válida'],
        'cartorio.string' => ['Dado informado é inválido'],
        'num_registro.string' => ['Dado informado é inválido'],
        'livro.string' => ['Dado informado é inválido'],
        'folha.string' => ['Dado informado é inválido'],
        'nome_pensao.string' => ['Dado informado é inválido'],
        'cpf_pensao.string' => ['Dado informado é inválido'],
        'banco_pensao.string' => ['Dado informado é inválido'],
        'agencia_pensao.string' => ['Dado informado é inválido'],
        'conta_pensao.string' => ['Dado informado é inválido'],
    ]);

    $validated['uid'] = config('hashing.uid');

    $dependente = Dependente::create($validated);

    if(!$dependente){
      return back()->with('error', 'Ocorreu um erro!');
    }

    return back()->with('funcionario-success', 'Dependente cadastrado com sucesso');
  }

  /**
   * Edita dados de unidade
   *
   * @param Request $request
   * @param Dependente $dependente
   * @return RedirectResponse
   **/
  public function update(Request $request, Dependente $dependente): RedirectResponse
  {
    $validated = $request->validate([
        'nome' => ['nullable','string'],
        'nascimento' => ['nullable','date'],
        'parentesco' => ['nullable','string'],
        'sexo' => ['nullable','string', 'in:MASCULINO,FEMININO,OUTRO'],
        'est_civil' => ['nullable','string', 'in:SOLTEIRO,CASADO,DIVORCIADO,SEPARADO,VIUVO'],
        'cartorio' => ['nullable','string'],
        'num_registro' => ['nullable','string'],
        'livro' => ['nullable','string'],
        'folha' => ['nullable','string'],
        'nome_pensao' => ['nullable', 'string'],
        'cpf_pensao' => ['nullable','string', 'max:14', 'min:14'], // TODO - adicionar validação de CPF/CNPJ
        'banco_pensao' => ['nullable', 'string'],
        'agencia_pensao' => ['nullable', 'string'],
        'conta_pensao' => ['nullable', 'string'],
    ],[
        'nome.string' => ['Dado informado é inválido'],
        'nascimento.date' => ['Dado informado é inválido'],
        'parentesco.string' => ['Dado informado é inválido'],
        'sexo.in' => ['Selecione uma opção válida'],
        'est_civil.in' => ['Selecione uma opção válida'],
        'cartorio.string' => ['Dado informado é inválido'],
        'num_registro.string' => ['Dado informado é inválido'],
        'livro.string' => ['Dado informado é inválido'],
        'folha.string' => ['Dado informado é inválido'],
        'nome_pensao.string' => ['Dado informado é inválido'],
        'cpf_pensao.min' => 'CPF inválido',
        'cpf_pensao.max' => 'CPF inválido',
        'banco_pensao.string' => ['Dado informado é inválido'],
        'agencia_pensao.string' => ['Dado informado é inválido'],
        'conta_pensao.string' => ['Dado informado é inválido'],
    ]);

    $dependente->update($validated);

    return redirect()->back()->with('funcionario-success', 'Dependente atualizado com sucesso');
  }

  /**
   * Remove conta
   *
   * @param Dependente $user
   * @return RedirectResponse
   **/
  public function delete(Dependente $dependente): RedirectResponse
  {
    $dependente->delete();

    return redirect()->back()->with('funcionario-success', 'Dependente removio');
  }

}