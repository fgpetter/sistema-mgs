@extends('layouts.master')
@section('title')
  Lançamento de ponto
  @endsection
@section('content')
@component('components.breadcrumb')
  @slot('li_1')
    Pessoas
  @endslot
  @slot('title')
    Lançamento de ponto &nbsp; | &nbsp; {{ $funcionario->nome }}
  @endslot
@endcomponent

<div class="row mx-4">
  <div class="col-3">

    <div class="card">
      <div class="card-body">
        <form method="get">
          <div class="input-group">
            <input type="month" class="form-control" name="competencia" value="{{ request()->competencia ?? date('Y-m') }}">
            <button class="btn btn-primary" type="submit" ><strong><i class="ri-arrow-right-line"></i></strong></button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="col-3">

    <div class="card py-2">
      <div class="card-body text-center fs-5">
        Total horas trabalhadas: <strong> {{ sprintf("%02d:%02d", floor($ponto['total_minutos_trabalhados']/60), $ponto['total_minutos_trabalhados']%60) }} </strong>
      </div>
    </div>
  </div>
  <div class="col-3">
    <div class="card py-2">
      <div class="card-body text-center fs-5">
        Total horas extra 50%: <strong> {{ sprintf("%02d:%02d", floor($ponto['total_qtd_min_50']/60), $ponto['total_qtd_min_50']%60) }} </strong>
      </div>
    </div>
  </div>
  <div class="col-3">
    <div class="card py-2">
      <div class="card-body text-center fs-5">
        Total horas extra 100%: <strong> {{ sprintf("%02d:%02d", floor($ponto['total_qtd_min_100']/60), $ponto['total_qtd_min_100']%60) }} </strong>
      </div>
    </div>
  </div>
  <div class="col-12 mt-3">
    @php
      if(request()->has('competencia')){
        $ano_mes = explode('-',request()->competencia);
        $primeiro_dia = Carbon\Carbon::createFromDate($ano_mes[0], $ano_mes[1])->startOfMonth();
        $dias = $primeiro_dia->diffInDays( Carbon\Carbon::createFromDate($ano_mes[0], $ano_mes[1])->endOfMonth() );

        $ano_atual = Carbon\Carbon::createFromDate($ano_mes[0], $ano_mes[1])->format('Y');
        $mes_atual = Carbon\Carbon::createFromDate($ano_mes[0], $ano_mes[1])->format('m');
      } else {
        $primeiro_dia = Carbon\Carbon::now()->startOfMonth();
        $dias = $primeiro_dia->diffInDays( Carbon\Carbon::now()->endOfMonth() );
        $ano_atual = Carbon\Carbon::now()->format('Y');
        $mes_atual = Carbon\Carbon::now()->format('m');
      }
    @endphp
    <div class="table-responsive" style="min-height: 25vh">
      <table class="table table-responsive table-striped table-nowrap">
        <thead>
          <tr>
            <th scope="col" class="px-3 bg-primary bg-opacity-25" style="width: 1%">Data</th>
            <th scope="col" class="px-3">Entrada</th>
            <th scope="col" class="px-3">Saída</th>
            <th scope="col" class="px-3">Entrada</th>
            <th scope="col" class="px-3">Saída</th>
            <th scope="col" class="px-3" style="width: 1%">HE 50%</th>
            <th scope="col" class="px-3" style="width: 1%">HE 100%</th>
            <th scope="col" class="px-3" style="width: 1%">Anotação</th>
          </tr>
        </thead>
        <tbody>
          <form action="{{ route('lancamento-ponto-insert', $funcionario->uid) }}" method="post" id="formPonto">
            @for ($i = 1; $i <= $dias+1; $i++)
              @php
                if($funcionario->hr_entrada){
                  $hr = explode(':', $funcionario->hr_entrada);
                }
                $carbonday = Carbon\Carbon::createFromDate($ano_atual, $mes_atual, $i);
                $data = $carbonday->format('d/m/Y');
                $data_banco = $carbonday->format('Y-m-d');
                $nome_do_dia = $carbonday->dayName;
                $dia_da_semana = $carbonday->dayOfWeek;
                $rand_min = rand(0, 15);

                $entrada_1 = Carbon\Carbon::createFromtime($hr[0] ?? 8, ($hr[1] ?? 0)+$rand_min)->format('H:i');
                $saida_1 = Carbon\Carbon::createFromtime(($hr[0] ?? 8)+4, ($hr[1] ?? 0)+$rand_min)->format('H:i');
                $entrada_2 = Carbon\Carbon::createFromtime(($hr[0] ?? 8)+5, ($hr[1] ?? 0)+$rand_min)->format('H:i');
                $saida_2 = Carbon\Carbon::createFromtime(($hr[0] ?? 8)+9, ($hr[1] ?? 0)+$rand_min)->format('H:i');
              @endphp
              <tr>
                @csrf
                <input type="hidden" name="data[]" value="{{$data_banco}}" >
                <input type="hidden" name="dia_da_semana[]" value="{{$dia_da_semana}}" >

                <td class="px-3 @if($dia_da_semana == 6 || $dia_da_semana == 0) bg-warning bg-opacity-25 @else bg-primary bg-opacity-10 @endif " style="width: 1%">
                  {{$data}} <br> <small> {{ Str::ucfirst($nome_do_dia) }} </small>
                </td scope="row">

                <td class="px-3 @if($dia_da_semana == 6 || $dia_da_semana == 0) bg-warning bg-opacity-25 @endif ">
                  <input type="time" 
                  class="form-control form-control-sm" 
                  name="entrada_1[]" 
                  value="{{ $ponto[$data_banco]['entrada_1'] ?? (($dia_da_semana == 6 || $dia_da_semana == 0) ? '' : $entrada_1) }}" >
                </td>

                <td class="px-3 @if($dia_da_semana == 6 || $dia_da_semana == 0) bg-warning bg-opacity-25 @endif"  >
                  <input type="time" 
                  class="form-control form-control-sm"
                  name="saida_1[]" 
                  value="{{ $ponto[$data_banco]['saida_1'] ?? (($dia_da_semana == 6 || $dia_da_semana == 0) ? '' :  $saida_1) }}" >
                </td>

                <td class="px-3 @if($dia_da_semana == 6 || $dia_da_semana == 0) bg-warning bg-opacity-25 @endif"  >
                  <input type="time" 
                  class="form-control form-control-sm" 
                  name="entrada_2[]" 
                  value="{{ $ponto[$data_banco]['entrada_2'] ?? (($dia_da_semana == 6 || $dia_da_semana == 0) ? '' :  $entrada_2) }}" >
                </td>

                <td class="px-3 @if($dia_da_semana == 6 || $dia_da_semana == 0) bg-warning bg-opacity-25 @endif"  >
                  <input type="time" 
                  class="form-control form-control-sm" 
                  name="saida_2[]" 
                  value="{{ $ponto[$data_banco]['saida_2'] ?? (($dia_da_semana == 6 || $dia_da_semana == 0) ? '' :  $saida_2) }}" >
                </td>

                <td class="px-3 @if($dia_da_semana == 6 || $dia_da_semana == 0) bg-warning bg-opacity-25 @endif"  >
                  {{ (isset($ponto[$data_banco]) && $ponto[$data_banco]['qtd_min_50'] > 0) ? date('H:i', mktime(0,$ponto[$data_banco]['qtd_min_50'])) : '-' }}
                </td>

                <td class="px-3 @if($dia_da_semana == 6 || $dia_da_semana == 0) bg-warning bg-opacity-25 @endif"  >
                  {{ (isset($ponto[$data_banco]) && $ponto[$data_banco]['qtd_min_100'] > 0) ? date('H:i', mktime(0,$ponto[$data_banco]['qtd_min_100'])) : '-'}}
                </td>

                <td class="px-3 @if($dia_da_semana == 6 || $dia_da_semana == 0) bg-warning bg-opacity-25 @endif"  >
                  <select class="form-select form-select-sm" aria-label=".form-select-sm example" style="min-width: 120px" name="anotacao[]">
                    <option></option>
                    <option @selected( isset($ponto[$data_banco]) && $ponto[$data_banco]['anotacao'] == 'FOLGA') value="FOLGA">FOLGA</option>
                    <option @selected( isset($ponto[$data_banco]) && $ponto[$data_banco]['anotacao'] == 'ABONADO') value="ABONADO">ABONADO</option>
                    <option @selected( isset($ponto[$data_banco]) && $ponto[$data_banco]['anotacao'] == 'FERIAS') value="FERIAS">FERIAS</option>
                    <option @selected( isset($ponto[$data_banco]) && $ponto[$data_banco]['anotacao'] == 'FALTA') value="FALTA">FALTA</option>
                    <option 
                      @selected( (isset($ponto[$data_banco]) && $ponto[$data_banco]['anotacao'] == 'FERIADO') ) 
                      value="FERIADO">
                      FERIADO
                    </option>
                  </select>
                </td>

              </tr>
              
              @if($nome_do_dia == 'domingo') 
                <tr>
                  <td colspan="8">
                    <button class="btn btn-sm btn-success float-end px-3" onclick="getElementById('formPonto').submit()">
                      <span class="fs-5"> SALVAR </span> 
                    </button>
                  </td>
                </tr> 
              @endif
                
            @endfor
          </form>
        </tbody>
      </table>
    </div>

  </div>
</div>
@endsection

@section('script')
@endsection
