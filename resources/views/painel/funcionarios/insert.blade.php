@extends('layouts.master')
@section('title') Editar Funcionário @endsection
@section('content')
  @component('components.breadcrumb')
  @slot('li_1') Pessoas @endslot
  @slot('title') @if ($funcionario->id) Editar Funcionario @else Cadastrar Funcionario @endif @endslot
  @endcomponent
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