@extends('layouts.master')
@section('title') Editar Funcionário @endsection
@section('content')
  @component('components.breadcrumb')
    @slot('li_1')  @endslot
    @slot('page')  @endslot
    @slot('title')
      @if ($lancamento->id) Editar Folha
      @else Criar Folha @endif
    @endslot
  @endcomponent

  @if (session('lancamento-success'))
    <div class="alert alert-success"> {{ session('lancamento-success') }} </div>
  @endif
  @if (session('folha-error'))
    <div class="alert alert-danger"> {{ session('folha-error') }} </div>
  @endif


  <div class="row">
    <div class="col">
      <x-painel.folha.insert :lancamento="$lancamento"/>
    </div>
  </div>

@endsection

@section('script')
<script src="{{ URL::asset('build/js/imask.js') }}"></script>
<script src="{{ URL::asset('build/js/jquery-3.7.1.min.js') }}"></script>
<script src="{{ URL::asset('build/js/jquery.mask.min.js') }}"></script>
<script src="{{ URL::asset('build/js/custom.js') }}"></script>
@endsection