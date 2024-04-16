@extends('layouts.master')
@section('title')
    Listagem de folhas de pagamento
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Pessoas
        @endslot
        @slot('title')
            Listagem de folhas de pagamento
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-sm-6">
            <x-painel.folha.list :lancamentos="$lancamentos"/>
        </div>
    </div>
@endsection

@section('script')
@endsection
