@extends('layouts.master')
@section('title') Editar Funcionário @endsection
@section('content')
  @component('components.breadcrumb')
    @slot('li_1') Funcionários @endslot
    @slot('page') 
      @if ($funcionario->id) Editar Funcionário
      @else Cadastrar Funcionario @endif 
    @endslot
    @slot('title')
      @if ($funcionario->id) Editar: {{$funcionario->nome}} {{ !$funcionario->cargo ? '' : '-'.$funcionario->cargo}}
      @else Cadastrar Funcionario @endif
    @endslot
  @endcomponent

  @if (session('funcionario-success'))
    <div class="alert alert-success"> {{ session('funcionario-success') }} </div>
  @endif

  <div class="row">
    <div class="col">
      <x-painel.funcionarios.insert :funcionario="$funcionario"/>
    </div>
  </div>

@endsection

@section('script')
<script src="{{ URL::asset('build/js/imask.js') }}"></script>
<script src="{{ URL::asset('build/js/jquery-3.7.1.min.js') }}"></script>
<script src="{{ URL::asset('build/js/jquery.mask.min.js') }}"></script>
<script src="{{ URL::asset('build/js/custom.js') }}"></script>
@endsection