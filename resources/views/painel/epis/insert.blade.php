@extends('layouts.master')
@section('title') Editar EPI @endsection
@section('content')
  @component('components.breadcrumb')
    @slot('li_1') EPIs @endslot
    @slot('page') 
      @if ($epi->id) Editar EPI
      @else Cadastrar EPI @endif 
    @endslot
    @slot('title')
      @if ($epi->id) Editar: {{$epi->nome}}
      @else Cadastrar EPI @endif
    @endslot
  @endcomponent

  @if (session('epi-success'))
    <div class="alert alert-success"> {{ session('epi-success') }} </div>
  @endif

  <div class="row">
    <div class="col">
      <x-painel.epis.insert :epi="$epi"/>
    </div>
  </div>

@endsection

@section('script')
<script src="{{ URL::asset('build/js/imask.js') }}"></script>
<script src="{{ URL::asset('build/js/jquery-3.7.1.min.js') }}"></script>
<script src="{{ URL::asset('build/js/jquery.mask.min.js') }}"></script>
<script src="{{ URL::asset('build/js/custom.js') }}"></script>
@endsection