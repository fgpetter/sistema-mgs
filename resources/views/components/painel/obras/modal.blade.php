@props([
  'obra' => null
])

<div class="modal fade" id="{{ ($obra?->id) ? "modal_obra_$obra?->id" : "modal_obra_cadastro"}}" 
  tabindex="-1" aria-labelledby="{{ ($obra?->id) ? "modalgridEPI$obra?->id" : "modalgridEPI" }}" aria-modal="true">
  <div class="modal-dialog modal-dialog-right modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" 
          id="{{ ($obra?->id) ? "modalgridEPI$obra?->id" : "modalgridEPI" }}">
          {{$obra->nome ?? 'Cadastrar Obra'}}
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('obra-create', ['obra' => $obra?->id]) }}" method="POST">
          @csrf
          <div class="row gy-3">
            <div class="col-12">
              <label class="form-label">Nome</label>
              <input type="text" class="form-control" name="nome" required 
                value="{{old('nome') ?? $obra->nome ?? ''}}">
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