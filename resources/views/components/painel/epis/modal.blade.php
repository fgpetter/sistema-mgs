@props([
  'index' => $epi->uid ?? null,
  'epi' => null
])

<div class="modal fade" id="{{ ($index) ? "modal_epi_$index" : "modal_epi_cadastro"}}" 
  tabindex="-1" aria-labelledby="{{ ($index) ? "modalgridBanco$index" : "modalgridBanco" }}" aria-modal="true">
  <div class="modal-dialog modal-dialog-right modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" 
        id="{{ ($index) ? "modalgridBanco$index" : "modalgridBanco" }}">
        {{$epi->epi ?? 'Cadastrar Banco'}}
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ isset($epi->uid) ? route('epi-update', $epi->uid) : route('epi-create') }}" method="POST">
          @csrf
          <div class="row gy-3">
            <div class="col-12">
              <label class="form-label">Nome</label>
              <input type="text" class="form-control" name="nome" required 
                value="{{old('nome') ?? $epi->nome ?? ''}}">
            </div>

            <div class="col-12">
              <label class="form-label">Tamanhos</label>
              <input type="text" class="form-control" name="tamanho" required 
                value="{{old('tamanho') ?? $epi->tamanho ?? ''}}" placeholder="Ex. P,M,G">
            </div>

            <div class="col-12">
              <label class="form-label">Observações</label>
              <textarea class="form-control" name="observacoes" rows="3">{{old('observacoes') ?? $epi->observacoes ?? ''}}</textarea>
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