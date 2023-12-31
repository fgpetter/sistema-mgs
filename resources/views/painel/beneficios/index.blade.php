@extends('layouts.master')
@section('title')
    Listagem de beneficios
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Pessoas
        @endslot
        @slot('title')
            Listagem de beneficios
        @endslot
    @endcomponent

    <div class="row">
        <div class="col">
            <x-painel.beneficios.list :beneficios="$beneficios" />
        </div>
    </div>
@endsection

@section('script')
@endsection
