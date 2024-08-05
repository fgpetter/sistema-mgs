@extends('layouts.master')
@section('title')
    Listagem de funcionarios
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Pessoas
        @endslot
        @slot('title')
            Listagem de funcionarios
        @endslot
    @endcomponent

    <div class="row">
        <div class="col">
            <x-painel.funcionarios.list :funcionarios="$funcionarios" />
        </div>
    </div>
@endsection

@section('script')
<script src="{{ URL::asset('build/js/jquery-3.7.1.min.js') }}"></script>
<script src="{{ URL::asset('build/js/custom.js') }}"></script>
@endsection
