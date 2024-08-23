<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\{Obra, Funcionario, LancamentoPonto, PontoConsolidado};

class LancamentoPontoController extends Controller
{
    /**
     * Exibe formulário de ponto
     * 
     * @param Funcionario $funcionario
     * @param Request $request
     * @return View
     */
    public function index(Funcionario $funcionario, Request $request)
    {
        if($request->competencia){
            $ano_mes = explode('-',$request->competencia);
        } else {
            $ano_mes[0] = Carbon::now()->format('Y');
            $ano_mes[1] = Carbon::now()->format('m');
        }


        $ponto = LancamentoPonto::select()
            ->where('funcionario_id', $funcionario->id)
            ->where('competencia', $ano_mes[0].'-'.$ano_mes[1])
            ->orderBy('data')
            ->get();

        // transforma a data como chave do array
        $lancamentos = [];
        foreach ($ponto->toarray() as $item) {
            $key = $item['data'];
            $lancamentos[$key] = $item;
        }

        // retorna dados computados do ponto
        $lancamentos['total_minutos_trabalhados'] = array_sum(array_column($lancamentos, 'min_trabalhados'));
        $lancamentos['total_qtd_min_50'] = array_sum(array_column($lancamentos, 'qtd_min_50'));
        $lancamentos['total_qtd_min_100'] = array_sum(array_column($lancamentos, 'qtd_min_100'));
        $lancamentos['status'] = $ponto->first()->status ?? null;

        // trata horario de entrada e saida
        if($funcionario->hr_entrada){
            $hr_padrao = explode(':', $funcionario->hr_entrada);
        } else {
            $hr_padrao = [7,30];
        }

        $obras = Obra::select('id', 'nome')->get();

        return view('painel.ponto.index', [
            'ponto' => $lancamentos, 
            'funcionario' => $funcionario, 
            'hr_padrao' => $hr_padrao,
            'obras' => $obras
        ]);
    }

    /**
     * Salva informações de ponto
     * 
     * @param Funcionario $funcionario
     * @param Request $request
     */
    public function insert(Funcionario $funcionario, Request $request)
    {
        $data = $request->except('_token');

        foreach($data['data'] as $key => $date){
            
            $qtd_min_50 = 0;
            $qtd_min_100 = 0;
            $qtd_min_desc = 0;

            // zera entrada e saida para dias não trabalhados
            if( in_array($data['anotacao'][$key], ['FOLGA','ABONADO','FERIAS', 'FALTA', 'FERIADO', 'ATESTADO', 'INSS', 'CASA']) ){
                $data['entrada_1'][$key] = 0;
                $data['saida_1'][$key] = 0;
                $data['entrada_2'][$key] = 0;
                $data['saida_2'][$key] = 0;
            }
            
            // se falta abonada, adiciona minutos trabalhados
            if( in_array($data['anotacao'][$key], ['FOLGA','ABONADO','CASA','ATESTADO'])){
                $min_trabalhados = 540;

            // se não abonado define minutos a serem descontados
            } elseif ($data['anotacao'][$key] == 'FALTA') {
                $min_trabalhados = 0;
                $qtd_min_desc = 540;

            } else {
                $entrada_1 = strtotime($data['entrada_1'][$key]);
                $saida_1 = strtotime($data['saida_1'][$key]);
                $entrada_2 = strtotime($data['entrada_2'][$key]);
                $saida_2 = strtotime($data['saida_2'][$key]);
    
                $t_manha = (($saida_1 - $entrada_1) > 0) ? $saida_1 - $entrada_1 : 0;
                $t_tarde = (($saida_2 - $entrada_2) > 0) ? $saida_2 - $entrada_2 : 0;
    
                $min_trabalhados = ($t_manha + $t_tarde)/60;
                $min_extras = $min_trabalhados - 540; // 540 = 9H
                
                if($data['dia_da_semana'][$key] == 0 || $data['anotacao'][$key] == 'FERIADO'){ // feriados e domingos

                    $qtd_min_100 = $min_trabalhados > 0 ? $min_trabalhados : 0;                    

                } elseif($data['dia_da_semana'][$key] == 6){ // sabados

                    $qtd_min_50 = $min_trabalhados > 0 ? $min_trabalhados : 0;

                } else { // dias uteis

                    // se o funcionario trabalhou menos de 9h
                    if($min_trabalhados < 540 ){
                        $qtd_min_desc = 540 - $min_trabalhados;
                    }

                    // se o funcionário trabalhou entre 9 e 11h
                    // aplica calculo de HE 50%
                    if($min_trabalhados > 540 && $min_trabalhados <= 660 ){
                        $qtd_min_50 = $min_extras;
                        $qtd_min_100 = 0;
                    }
        
                    // se o funcionário trabalhou mais de 11h
                    // aplica calculo de HE 100% descontado 2h em 50%
                    if($min_trabalhados > 660 ){
                        $qtd_min_50 = 120;
                        $qtd_min_100 = $min_extras - $qtd_min_50;
                    }

                }
    
            }

            LancamentoPonto::updateOrCreate(
                ['data' => $date, 'funcionario_id' => $funcionario->id],
                [
                    'competencia' => $request->competencia,
                    'entrada_1' => $data['entrada_1'][$key],
                    'saida_1' => $data['saida_1'][$key],
                    'entrada_2' => $data['entrada_2'][$key],
                    'saida_2' => $data['saida_2'][$key],
                    'anotacao' => $data['anotacao'][$key],
                    'obra_id' => $data['obra'][$key] ?? null,
                    'min_trabalhados' => $min_trabalhados,
                    'qtd_min_50' => $qtd_min_50,
                    'qtd_min_100' => $qtd_min_100,
                    'qtd_min_desc' => $qtd_min_desc,
                ]
            );
        }

        return back();
        
    }

    /**
     * Gera fechamento do ponto
     *
     * @param Funcionario $funcionario
     * @param Request $request
     */
    public function statusPonto(Funcionario $funcionario, Request $request)
    {
        $competencia = $request->competencia;

        if($request->status == 'FECHADO'){

            // recupera lançamentos do ponto na competencia selecionada
            $ponto = LancamentoPonto::select('funcionario_id', 'min_trabalhados', 'qtd_min_50', 'qtd_min_100', 'qtd_min_desc')
                ->where('funcionario_id', $funcionario->id)
                ->where('competencia', $competencia)
                ->get();

            $total_horas_extras = $ponto->sum('qtd_min_50') + $ponto->sum('qtd_min_100');

            // verifica se a quantidade de horas extra supera 28h 
            // limita pagamento de HE50% para 28h e transbora para HE100%
            if( $total_horas_extras > 1680) {

                PontoConsolidado::create([
                    'funcionario_id' => $funcionario->id,
                    'competencia' => $competencia,
                    'he_50' => round(1680 / 60, 2),
                    'he_100' => round( ($total_horas_extras - 1680) / 60, 2),
                    'faltas' => round($ponto->sum('qtd_min_desc') / 60, 2),
                    'dias_trabalhados' => $ponto->where('min_trabalhados', '>', 0)->count(),
                ]);

            } else {

                PontoConsolidado::create([
                    'funcionario_id' => $funcionario->id,
                    'competencia' => $competencia,
                    'he_50' => round($ponto->sum('qtd_min_50') / 60, 2),
                    'he_100' => round($ponto->sum('qtd_min_100') / 60, 2),
                    'faltas' => round($ponto->sum('qtd_min_desc') / 60, 2),
                    'dias_trabalhados' => $ponto->where('min_trabalhados', '>', 0)->count(),
                ]);
            }
            
        }

        if($request->status == 'ABERTO'){
            PontoConsolidado::where('funcionario_id', $funcionario->id)
                ->where('competencia', $competencia)
                ->delete();
        }
            
        LancamentoPonto::where('funcionario_id', $funcionario->id)->where('competencia', $competencia)->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Ponto atualizado com sucesso');
    }

    /**
     * Apresenta relatório de horas ponto
     *
     * @param Request $request
     * @return View
     */
    public function relatorio(Request $request)
    {
        $ano_mes_atual = Carbon::now()->format('Y-m');

        $pontos = PontoConsolidado::where('competencia', $request->competencia ?? $ano_mes_atual)->get();
        $funcionarios = Funcionario::all();

        return view('painel.ponto.relatorio', compact('pontos', 'funcionarios'));
    }

    
}
