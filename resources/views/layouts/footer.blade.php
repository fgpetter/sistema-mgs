<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                V1.0 @ 2023
            </div>
            <div class="col-sm-6">
                <div class="text-sm-end d-none d-sm-block">
                    Desenvolvido por Escritório Móvel
                </div>
            </div>
        </div>
    </div>
</footer>
@section('script')
<script src="{{ URL::asset('build/js/app.js') }}"></script>
<script src="{{ URL::asset('build/js/jquery-3.7.1.min.js') }}"></script>
<script src="{{ URL::asset('build/js/jquery.mask.min.js') }}"></script>
<script src="{{ URL::asset('build/js/custom.js') }}"></script>
@endsection