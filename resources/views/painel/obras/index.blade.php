@extends('layouts.master')
@section('title')
    Listagem de Obras
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')@endslot
        @slot('title')
            Listagem de Obras
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-sm-8">
            <x-painel.obras.list :obras="$obras" />
        </div>
    </div>
@endsection

@section('script')
@endsection
