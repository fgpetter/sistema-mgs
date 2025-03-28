@extends('layouts.master')
@section('title')
  Lançamento de ponto
  @endsection
@section('content')
@component('components.breadcrumb')
  @slot('li_1')
  @endslot
  @slot('title')
    Lançamento de ponto &nbsp; | &nbsp; {{ $funcionario->nome }}
  @endslot
@endcomponent

<div class="row">
  <div class="col-4">

    <div class="card">
      <div class="card-body">
        <div class="row align-items-end">
          <div class="col-xxl-8">
            <form method="get">
              <div class="input-group">
                <input type="month" class="form-control" name="competencia" value="{{ request()->competencia ?? date('Y-m') }}">
                <button class="btn btn-primary" type="submit" ><strong><i class="ri-arrow-right-line"></i></strong></button>
              </div>
            </form>
          </div>
          <div class="col">
            @if($ponto['status'])
            <form method="post" action="{{ route('status-ponto', $funcionario->uid) }}">
              @csrf
              <input type="hidden" name="competencia" value="{{ request()->competencia ?? date('Y-m') }}">
              <input type="hidden" name="status" value="{{ $ponto['status'] == 'FECHADO' ? 'ABERTO' : 'FECHADO' }}">
              <button class="btn btn-success mt-2" type="submit" >{{ $ponto['status'] == 'FECHADO' ? 'REABRIR PONTO' : 'FECHAR PONTO' }}</button>
            </form>
            @endif
          </div>
        </div>

      </div>
    </div>
  </div>

  <div class="col">
    <div class="card py-2">
      <div class="card-body text-center fs-5">
        Total horas trabalhadas: <strong> {{ sprintf("%02d:%02d", floor($ponto['total_minutos_trabalhados']/60), $ponto['total_minutos_trabalhados']%60) }} </strong>
      </div>
    </div>
  </div>

  <div class="col">
    <div class="card py-2">
      <div class="card-body text-center fs-5">
        Total horas extra 50%: <strong> {{ sprintf("%02d:%02d", floor($ponto['total_qtd_min_50']/60), $ponto['total_qtd_min_50']%60) }} </strong>
      </div>
    </div>
  </div>

  <div class="col">
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
        $mes = ($ano_mes[1] == 1) ? 12 : $ano_mes[1]-1;
        $ano = ($mes == 12) ? $ano_mes[0]-1 : $ano_mes[0]; 
        $primeiro_dia = Carbon\Carbon::createFromDate($ano, $mes)->startOfMonth();
        $dias = $primeiro_dia->diffInDays( Carbon\Carbon::createFromDate($ano, $mes)->endOfMonth() );

        $ano_atual = Carbon\Carbon::createFromDate($ano, $mes)->format('Y');
        $mes_atual = Carbon\Carbon::createFromDate($ano, $mes)->format('m');
      } else {
        $primeiro_dia = Carbon\Carbon::now()->subMonth(1)->startOfMonth();
        $dias = $primeiro_dia->diffInDays( Carbon\Carbon::now()->subMonth(1)->endOfMonth() );
        $ano_atual = Carbon\Carbon::now()->subMonth(1)->format('Y');
        $mes_atual = Carbon\Carbon::now()->subMonth(1)->format('m');
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
            <th scope="col" class="px-3" style="width: 1%">Anotação</th>
            <th scope="col" class="px-3" style="width: 15%">Obra</th>
            <th scope="col" class="px-3" style="width: 1%; white-space: nowrap">HE 50%</th>
            <th scope="col" class="px-3" style="width: 1%; white-space: nowrap">HE 100%</th>
          </tr>
        </thead>
        <tbody>
          <form action="{{ route('lancamento-ponto-insert', $funcionario->uid) }}" method="post" id="formPonto">
            @for ($i = 1; $i <= $dias+1; $i++)
              @php
                $carbonday = Carbon\Carbon::create($ano_atual, $mes_atual, $i)->addDays(25);
                $data = $carbonday->format('d/m/Y');
                $data_banco = $carbonday->format('Y-m-d');
                $nome_do_dia = $carbonday->dayName;
                $dia_da_semana = $carbonday->dayOfWeek;
                $rand_min = rand(0, 5);

                $entrada_1 = Carbon\Carbon::createFromtime( $hr_padrao[0]  , $hr_padrao[1]+$rand_min)->format('H:i'); // 7:30
                $saida_1   = Carbon\Carbon::createFromtime( $hr_padrao[0]+4, $hr_padrao[1]+30+$rand_min)->format('H:i'); // 12:00
                $entrada_2 = Carbon\Carbon::createFromtime( $hr_padrao[0]+5, $hr_padrao[1]+30+$rand_min)->format('H:i'); // 13:00
                $saida_2   = Carbon\Carbon::createFromtime( $hr_padrao[0]+10, $hr_padrao[1]+$rand_min)->format('H:i');  // 17:30
              @endphp
              <tr>
                @csrf
                <input type="hidden" name="data[]" value="{{$data_banco}}" >
                <input type="hidden" name="dia_da_semana[]" value="{{$dia_da_semana}}" >
                <input type="hidden" name="competencia" value="{{ isset($ano_mes) ? $ano_mes[0].'-'.$ano_mes[1] : Carbon\Carbon::now()->format('Y-m')}}" >

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
                  <select class="form-select form-select-sm" aria-label=".form-select-sm example" style="min-width: 120px" name="anotacao[]">
                    <option></option>
                    <option @selected( isset($ponto[$data_banco]) && $ponto[$data_banco]['anotacao'] == 'FOLGA') value="FOLGA">FOLGA</option>
                    <option @selected( isset($ponto[$data_banco]) && $ponto[$data_banco]['anotacao'] == 'ABONADO') value="ABONADO">ABONADO</option>
                    <option @selected( isset($ponto[$data_banco]) && $ponto[$data_banco]['anotacao'] == 'FERIAS') value="FERIAS">FERIAS</option>
                    <option @selected( isset($ponto[$data_banco]) && $ponto[$data_banco]['anotacao'] == 'FALTA') value="FALTA">FALTA</option>
                    <option @selected( isset($ponto[$data_banco]) && $ponto[$data_banco]['anotacao'] == 'ATESTADO') value="ATESTADO">ATESTADO</option>
                    <option @selected( isset($ponto[$data_banco]) && $ponto[$data_banco]['anotacao'] == 'INSS') value="INSS">INSS</option>
                    <option @selected( isset($ponto[$data_banco]) && $ponto[$data_banco]['anotacao'] == 'CASA') value="CASA">CASA</option>
                    <option 
                      @selected( (isset($ponto[$data_banco]) && $ponto[$data_banco]['anotacao'] == 'FERIADO') ) 
                      value="FERIADO">
                      FERIADO
                    </option>
                  </select>
                </td>

                <td class="px-3 @if($dia_da_semana == 6 || $dia_da_semana == 0) bg-warning bg-opacity-25 @endif"  >
                  <select class="form-select form-select-sm" aria-label=".form-select-sm example" style="min-width: 120px" name="obra[]">
                    <option></option>
                    @foreach ($obras as $obra)
                      <option @selected( isset($ponto[$data_banco]) && $ponto[$data_banco]['obra_id'] == $obra->id) value="{{ $obra->id }}">{{ $obra->nome }}</option>
                    @endforeach
                  </select>
                </td>

                <td class="px-3 @if($dia_da_semana == 6 || $dia_da_semana == 0) bg-warning bg-opacity-25 @endif"  >
                  {{ (isset($ponto[$data_banco]) && $ponto[$data_banco]['qtd_min_50'] > 0) ? date('H:i', mktime(0,$ponto[$data_banco]['qtd_min_50'])) : '-' }}
                </td>

                <td class="px-3 @if($dia_da_semana == 6 || $dia_da_semana == 0) bg-warning bg-opacity-25 @endif"  >
                  {{ (isset($ponto[$data_banco]) && $ponto[$data_banco]['qtd_min_100'] > 0) ? date('H:i', mktime(0,$ponto[$data_banco]['qtd_min_100'])) : '-'}}
                </td>

              </tr>
              
              @if($nome_do_dia == 'domingo') 
                <tr>
                  <td colspan="9">
                    @if($ponto['status'] != 'FECHADO')
                    <button class="btn btn-sm btn-success float-end px-3" onclick="getElementById('formPonto').submit()">
                      <span class="fs-5"> SALVAR </span> 
                    </button>
                    @endif
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
