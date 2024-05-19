@extends('layouts.master')
@section('title')
    Controle de epis
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')@endslot
        @slot('title')
            Controle de EPIs
        @endslot
    @endcomponent

    <div class="row">
        <div class="col">
            <x-painel.epis.controle :controles="$controles" />
        </div>
    </div>
@endsection

@section('script')
@endsection
