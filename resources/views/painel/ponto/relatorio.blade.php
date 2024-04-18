@extends('layouts.master')
@section('title')
  Lançamento de ponto
  @endsection
@section('content')
@component('components.breadcrumb')
  @slot('li_1')
  @endslot
  @slot('title')
    Relatório de ponto - {{ \Carbon\Carbon::parse(request()->competencia)->format('m/Y') ?? date('m/Y') }}
  @endslot
@endcomponent

<div class="row mx-4 ">
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
        </div>

      </div>
    </div>
  </div>

  <div class="col-12 mt-3">
    <div class="table-responsive" style="min-height: 25vh">
      <table class="table table-responsive table-striped table-nowrap">
        <thead>
          <tr>
            <th scope="col" class="px-3" style="width: 1%; white-space: nowrap;">Competencia</th>
            <th scope="col" class="px-3">Funcionário</th>
            <th scope="col" class="px-3">Dias trabalhados</th>
            <th scope="col" class="px-3">HE 50%</th>
            <th scope="col" class="px-3">HE 100%</th>
            <th scope="col" class="px-3">Faltas</th>
          </tr>
        </thead>
        <tbody>

          @foreach($pontos as $ponto)
          <tr>
            <td class="px-3">{{ $ponto->competencia }}</td>
            <td class="px-3">{{ $funcionarios->find($ponto->funcionario_id)->nome }}</td>
            <td class="px-3">{{ $ponto->dias_trabalhados }}</td>
            <td class="px-3">{{ $ponto->he_50 }}</td>
            <td class="px-3">{{ $ponto->he_100 }}</td>
            <td class="px-3">{{ $ponto->faltas }}</td>
          </tr>
          @endforeach

        </tbody>
      </table>
    </div>

    <button type="button" class="btn btn-primary">GERAR EXCEL</button>

  </div>
</div>
@endsection

@section('script')
@endsection
