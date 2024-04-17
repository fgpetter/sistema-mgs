@extends('layouts.master')
@section('title') Editar Item da Folha @endsection
@section('content')
  @component('components.breadcrumb')
    @slot('li_1') Item da Folha @endslot
    @slot('page') 
      @if ($itemFolha->id) Editar Item da Folha
      @else Cadastrar Item da Folha @endif 
    @endslot
    @slot('title')
      @if ($itemFolha->id) Editar: {{$itemFolha->nome}}
      @else Cadastrar Item da Folha @endif
    @endslot
  @endcomponent

  @if (session('success'))
    <div class="alert alert-success"> {{ session('success') }} </div>
  @endif

  <div class="row">
    <div class="col">
      <x-painel.item-folha.insert :itemFolha="$itemFolha"/>
    </div>
  </div>

@endsection

@section('script')
<script src="{{ URL::asset('build/js/imask.js') }}"></script>
<script src="{{ URL::asset('build/js/jquery-3.7.1.min.js') }}"></script>
<script src="{{ URL::asset('build/js/jquery.mask.min.js') }}"></script>
<script src="{{ URL::asset('build/js/custom.js') }}"></script>
@endsection