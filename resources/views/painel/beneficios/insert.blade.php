@extends('layouts.master')
@section('title') Editar Beneficio @endsection
@section('content')
  @component('components.breadcrumb')
    @slot('li_1') Beneficios @endslot
    @slot('page') 
      @if ($beneficio->id) Editar Beneficio
      @else Cadastrar Beneficio @endif 
    @endslot
    @slot('title')
      @if ($beneficio->id) Editar: {{$beneficio->nome}}
      @else Cadastrar Beneficio @endif
    @endslot
  @endcomponent

  @if (session('beneficio-success'))
    <div class="alert alert-success"> {{ session('beneficio-success') }} </div>
  @endif

  <div class="row">
    <div class="col">
      <x-painel.beneficios.insert :beneficio="$beneficio"/>
    </div>
  </div>

@endsection

@section('script')
<script src="{{ URL::asset('build/js/imask.js') }}"></script>
<script src="{{ URL::asset('build/js/jquery-3.7.1.min.js') }}"></script>
<script src="{{ URL::asset('build/js/jquery.mask.min.js') }}"></script>
<script src="{{ URL::asset('build/js/custom.js') }}"></script>
@endsection