@props([
  'index' => $banco->uid ?? null,
  'funcionario',
  'banco' => null
])

<div class="modal fade" id="{{ ($index) ? "modal_banco_$index" : "modal_banco_cadastro"}}" 
  tabindex="-1" aria-labelledby="{{ ($index) ? "modalgridBanco$index" : "modalgridBanco" }}" aria-modal="true">
  <div class="modal-dialog modal-dialog-right modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" 
        id="{{ ($index) ? "modalgridBanco$index" : "modalgridBanco" }}">
        {{$banco->banco ?? 'Cadastrar Banco'}}
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ isset($banco->uid) ? route('conta-update', $banco->uid) : route('conta-create') }}" method="POST">
          @csrf
          <input type="hidden" name="funcionario_id" value="{{ $funcionario->id }}">
          <div class="row gy-3">
            <div class="col-sm-6">
              <label class="form-label">Nome do banco <small class="text-danger">*</small></label>
              <input type="text" class="form-control" name="banco" required 
                value="{{old('banco') ?? $banco->banco ?? ''}}">
            </div>

            <div class="col-sm-6">
              <label class="form-label">Código do banco <small class="text-danger">*</small></label>
              <input type="text" class="form-control" name="cod_banco" required 
                value="{{old('cod_banco') ?? $banco->cod_banco ?? ''}}">
            </div>

            <div class="col-sm-6">
              <label class="form-label">Agencia <small class="text-danger">*</small></label>
              <input type="text" class="form-control" name="agencia" required 
                value="{{old('agencia') ?? $banco->agencia ?? ''}}">
            </div>

            <div class="col-sm-6">
              <label class="form-label">Conta <small class="text-danger">*</small></label>
              <input type="text" class="form-control" name="conta" required 
                value="{{old('conta') ?? $banco->conta ?? ''}}">
            </div>

            <div class="col-lg-12">
              <div class="hstack gap-2 justify-content-end">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Sair</button>
                <button type="submit" class="btn btn-primary">Salvar</button>
              </div>
            </div>

          </div><!--end row-->
        </form>
      </div>
    </div>
  </div>
</div>