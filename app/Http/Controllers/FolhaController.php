<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LancamentoFolha;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;


class FolhaController extends Controller
{
  /**
   * Gera pagina de listagem de lancamentos de folha
   *
   * @return View
   **/
  public function index(): View
  {
    $lancamentos = LancamentoFolha::all();
    return view('painel.folha.index', ['lancamentos' => $lancamentos]);
  }

  /**
   * Tela de edição de lancamentos de folha
   *
   * @param LancamentoFolha $lancamento$lan
   * @return View
   **/
  public function insert(LancamentoFolha $lancamento): View|RedirectResponse
  {
    return view('painel.folha.insert', ['lancamento' => $lancamento]);
  }

  /**
   * Salva lancamento de folha
   *
   * @param Request $request
   * @return RedirectResponse
   */
  public function salvaFolha(Request $request): RedirectResponse
  {
    // validate data
    $request->validate([
      'uid' => ['nullable', 'string', 'exists:lancamentos_folha,uid'],
      'competencia' => ['required', 'date_format:Y-m'],
      'status' => ['required', 'string', 'in:ABERTO,FECHADO'],
      'dias_uteis' => ['required', 'numeric', 'min:1', 'max:31'],
    ],[
      'uid.exists' => 'Lancamento não encontrado',
      'competencia.required' => 'Data obrigatória',
      'competencia.date_format' => 'Data inválida.',
      'dias_uteis.required' => 'Quantidade de dias úteis obrigatório',
      'dias_uteis.min' => 'Quantidade de dias úteis deve ser maior ou igual a 1',
      'dias_uteis.max' => 'Quantidade de dias úteis deve ser menor ou igual a 31',
      'status.required' => 'Status obrigatório',
      'status.in' => 'Status inválido',
    ]);

    if(!$request->uid && LancamentoFolha::where('competencia', $request->competencia)->exists()){
      return redirect()->route('folha-insert')->with('folha-error', 'Essa competência já existe');
    }

    $uid = $request->uid ?? config('hashing.uid');

    LancamentoFolha::updateorCreate(
      [
        'uid' => $uid, 
        'competencia' => $request->competencia
      ],[
        'status' => $request->status,
        'dias_uteis' => $request->dias_uteis,
      ]
    );

    return redirect()->route('folha-insert', $uid)->with('folha-success', 'Lancamento de folha salvo com sucesso');
  }



}
