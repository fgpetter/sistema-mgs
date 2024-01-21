@extends('layouts.master')
@section('title')
    Listagem de epis
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Pessoas
        @endslot
        @slot('title')
            Listagem de EPIs
        @endslot
    @endcomponent

    <div class="row">
        <div class="col">
            <x-painel.epis.list :epis="$epis" />
        </div>
    </div>
@endsection

@section('script')
@endsection
