@props([
  'index' => $controle->id ?? null,
  'controle' => $controle ?? null,
])

<div class="modal fade" id="{{ ($index) ? "modal_epi_$index" : "modal_epi_controle"}}" 
  tabindex="-1" aria-labelledby="{{ ($index) ? "modal_epi_$index" : "modal_epi_controle" }}" aria-modal="true">
  <div class="modal-dialog modal-dialog-right modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="{{ ($index) ? "modal_epi_$index" : "modal_epi_controle" }}">
        {{$epi->epi ?? 'Cadastrar Entrega de EPI'}}
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('registra-entrega-epi', $controle->id ?? null) }}" method="POST">
          @csrf
          <div class="row gy-3">

            <div class="col-6">
              <label class="form-label">EPI</label>
              <select name="epi_id" id="epi" class="form-select">
                @foreach (\App\Models\CadastroEpi::all() as $epi)
                  <option value="{{$epi->id}}" >{{$epi->nome}}</option>
                @endforeach
              </select>
            </div>

            <div class="col-6">
              <label class="form-label">Funcionario</label>
              <select name="funcionario_id" id="funcionario_id" class="form-select">
                @foreach (\App\Models\Funcionario::all() as $funcionario)
                  <option value="{{$funcionario->id}}" >{{$funcionario->nome}}</option>
                @endforeach
              </select>
            </div>

            <div class="col-6">
              <label class="form-label">Tamanho</label>
              <input type="text" class="form-control" name="tamanho" 
                value="{{old('tamanho') ?? $controle->tamanho ?? ''}}" 
                placeholder="Ex. P,M,G">
            </div>

            <div class="col-6">
              <label class="form-label">Quantidade</label>
              <input type="text" class="form-control" name="quantidade" 
                value="{{old('quantidade') ?? $controle->quantidade ?? ''}}" 
                placeholder="Ex. P,M,G">
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