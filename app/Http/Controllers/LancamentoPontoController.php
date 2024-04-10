<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Funcionario;
use Illuminate\Http\Request;
use App\Models\LancamentoPonto;

class LancamentoPontoController extends Controller
{
    /**
     * Display a listing of the resource.
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
            ->whereYear('data', $ano_mes[0])
            ->whereMonth('data', $ano_mes[1])
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

        return view('painel.ponto.index', ['ponto' => $lancamentos, 'funcionario' => $funcionario]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function insert(Funcionario $funcionario, Request $request)
    {
        $data = $request->except('_token');

        foreach($data['data'] as $key => $date){
             
            if( in_array($data['anotacao'][$key], ['FOLGA','ABONADO','FERIAS'])){
                $min_trabalhados = 480;
                $data['entrada_1'][$key] = 0;
                $data['saida_1'][$key] = 0;
                $data['entrada_2'][$key] = 0;
                $data['saida_2'][$key] = 0;
                
            } elseif ($request->anotacao == 'FALTA') {
                $min_trabalhados = 0;

            } else {
                $entrada_1 = strtotime($data['entrada_1'][$key]);
                $saida_1 = strtotime($data['saida_1'][$key]);
                $entrada_2 = strtotime($data['entrada_2'][$key]);
                $saida_2 = strtotime($data['saida_2'][$key]);
    
                $t_manha = (($saida_1 - $entrada_1) > 0) ? $saida_1 - $entrada_1 : 0;
                $t_tarde = (($saida_2 - $entrada_2) > 0) ? $saida_2 - $entrada_2 : 0;
    
                $min_trabalhados = ($t_manha + $t_tarde)/60;
                $min_extras = $min_trabalhados - 480; // 480 = 8H
    
                $qtd_min_50 = 0;
                $qtd_min_100 = 0;
    
                // se o funcionário trabalhou entre 8 e 10h
                // aplica calculo de HE 50%
                if($min_trabalhados > 480 && $min_trabalhados <= 600 ){
                    $qtd_min_50 = $min_extras;
                    $qtd_min_100 = 0;
                }
    
                // se o funcionário trabalhou mais de 10h
                // aplica calculo de HE 100% descontado 2h em 50%
                if($min_trabalhados > 600 ){
                    $qtd_min_50 = 120;
                    $qtd_min_100 = $min_extras - $qtd_min_50;
                }
            }
            

            LancamentoPonto::updateOrCreate(
                ['data' => $date, 'funcionario_id' => $funcionario->id],
                [
                    'entrada_1' => $data['entrada_1'][$key],
                    'saida_1' => $data['saida_1'][$key],
                    'entrada_2' => $data['entrada_2'][$key],
                    'saida_2' => $data['saida_2'][$key],
                    'anotacao' => $data['anotacao'][$key],
                    'local_trabalho_id' => 0,
                    'min_trabalhados' => $min_trabalhados,
                    'qtd_min_50' => $qtd_min_50,
                    'qtd_min_100' => $qtd_min_100,
                ]
            );
        }

        return back();
        
    }

    /**
     * Display the specified resource.
     */
    public function show(LancamentoPonto $lancamentoPonto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LancamentoPonto $lancamentoPonto)
    {
        //
    }
}
