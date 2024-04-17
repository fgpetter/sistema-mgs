@extends('layouts.master')
@section('title')
    Listagem de itens da folha de pagamento
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1') @endslot
        @slot('title') @endslot
    @endcomponent

    <div class="row">
        <div class="col">
            <x-painel.item-folha.list :itensFolha="$itensFolha" />
        </div>
    </div>
@endsection

@section('script')
@endsection
