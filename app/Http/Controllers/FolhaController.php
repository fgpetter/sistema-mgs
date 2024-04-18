<?php

namespace App\Http\Controllers;

use App\Models\ItemFolha;
use App\Models\Funcionario;
use Illuminate\Http\Request;
use App\Models\LancamentoFolha;
use App\Models\LancamentoFolhaItem;
use App\Models\LancamentoPonto;
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
    $folhasPonto = Funcionario::select('id', 'nome')
      ->whereIn('id', function($query) use ($lancamento){
        $query->select('funcionario_id')
          ->from('lancamento_ponto')
          ->where('competencia', $lancamento->competencia)
          ->where('status', 'FECHADO')
          ->groupBy('funcionario_id');
      })->get();

    $funcionarios = Funcionario::select('id', 'nome')->where('situacao', 'ATIVO')->get();

    $itensFolha = ItemFolha::select('id', 'nome')->get();
    
    return view('painel.folha.insert', [
      'lancamento' => $lancamento, 
      'funcionarios' => $funcionarios,
      'folhasPonto' => $folhasPonto,
      'itensFolha' => $itensFolha
    ]);
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
      return redirect()->route('folha-insert')->with('error', 'Essa competência já existe');
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

    return redirect()->route('folha-insert', $uid)->with('success', 'Lancamento de folha salvo com sucesso');
  }

  /**
   * Insere ponto na folha
   *
   * @param Request $request
   * @return RedirectResponse
   */
  public function inserePonto(Request $request): RedirectResponse
  {
    $request->validate([
      'funcionario_id' => ['required', 'integer', 'exists:funcionarios,id'],
      'competencia' => ['required', 'date_format:Y-m', 'exists:lancamento_ponto,competencia'],
      'folha' => ['required', 'integer', 'exists:lancamentos_folha,id'],
    ],[
      'funcionario_id.required' => 'Funcionário obrigatório',
      'funcionario_id.integer' => 'Funcionário inválido',
      'funcionario_id.exists' => 'Funcionário inválido',
    ]);

    $ponto = LancamentoPonto::select('qtd_min_50', 'qtd_min_100', 'qtd_min_desc')
      ->where('funcionario_id', $request->funcionario_id)
      ->where('competencia', $request->competencia)
      ->where('status', 'FECHADO')
      ->get();

    if($ponto->isEmpty()){
      return redirect()->back()->with('error', 'Funcionário não possui ponto ');
    }

    $totalHe50 = $ponto->sum('qtd_min_50');
    $totalHe100 = $ponto->sum('qtd_min_100');
    $totalDesc = $ponto->sum('qtd_min_desc');

    if($totalHe50 > 0){
      LancamentoFolhaItem::create([
        'lancamento_folha_id' => $request->folha,
        'funcionario_id' => $request->funcionario_id,
        'item_descricao' => 'Horas Extras 50%',
        'competencia' => $request->competencia,
        'quantidade' => round($totalHe50/60, 2)
      ]);
    }

    if($totalHe100 > 0){
      LancamentoFolhaItem::create([
        'lancamento_folha_id' => $request->folha,
        'funcionario_id' => $request->funcionario_id,
        'item_descricao' => 'Horas Extras 100%',
        'competencia' => $request->competencia,
        'quantidade' => round($totalHe100/60, 2)
      ]);
    }

    if($totalDesc > 0){
      LancamentoFolhaItem::create([
        'lancamento_folha_id' => $request->folha,
        'funcionario_id' => $request->funcionario_id,
        'item_descricao' => 'Faltas / Atrasos',
        'competencia' => $request->competencia,
        'quantidade' => round($totalDesc/60, 2)
      ]);
    }
          

    return redirect()->back()->with('success', 'Ponto inserido com sucesso');
  }


}
