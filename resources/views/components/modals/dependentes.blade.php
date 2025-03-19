@props([
  'index' => $dependente->uid ?? null,
  'funcionario',
  'dependente' => null
])

<div class="modal fade" id="{{ ($index) ? "modal_dependente_$index" : "modal_dependente_cadastro"}}" 
  tabindex="-1" aria-labelledby="{{ ($index) ? "modalgridDependente$index" : "modalgridDependente" }}" aria-modal="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="{{ ($index) ? "modalgridDependente$index" : "modalgridDependente" }}"> 
            {{$dependente->nome ?? 'Cadastrar Dependente'}}
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <form action="{{ isset($dependente->uid) ? route('dependente-update', $dependente->uid) : route('dependente-create') }}" method="POST">
          @csrf

          <input type="hidden" name="funcionario_id" value="{{ $funcionario->id }}">

          <div class="row gy-3">
            <div class="col-lg-6">
              <label class="form-label">Nome</label>
              <input type="text" class="form-control" name="nome" value="{{old('nome') ?? $dependente->nome ?? ''}}">
            </div>

            <div class="col-lg-2">
              <label class="form-label">Nascimento</label>
              <input type="date" class="form-control" name="nascimento" value="{{old('nascimento') ?? $dependente->nascimento ?? ''}}">
            </div>

            <div class="col-md-4">
              <label class="form-label">Parentesco</label>
              <input type="text" class="form-control" name="parentesco" value="{{old('parentesco') ?? $dependente->parentesco ?? ''}}">
            </div>

            <div class="col-md-4">
              <label class="form-label">Sexo</label>
              <select class="form-select" name="sexo">
                <option value="MASCULINO" @selected($dependente?->sexo == 'MASCULINO')>Masculino</option>
                <option value="FEMININO" @selected($dependente?->sexo == 'FEMININO')>Feminino</option>
                <option value="OUTRO" @selected($dependente?->sexo == 'OUTRO')>Outro</option>
              </select>
            </div>

            <div class="col-md-4">
              <label class="form-label">Estado Civil</label>
              <select class="form-select" name="est_civil">
                <option value="SOLTEIRO" @selected($dependente?->est_civil == 'SOLTEIRO')>Solteiro</option>
                <option value="CASADO" @selected($dependente?->est_civil == 'CASADO')>Casado</option>
                <option value="DIVORCIADO" @selected($dependente?->est_civil == 'DIVORCIADO')>Divorciado</option>
                <option value="SEPARADO" @selected($dependente?->est_civil == 'SEPARADO')>Separado</option>
                <option value="VIUVO" @selected($dependente?->est_civil == 'VIUVO')>Viúvo</option>
              </select>
            </div>

            <div class="col-md-4">
              <label class="form-label">Cartório</label>
              <input type="text" class="form-control" name="cartorio" value="{{old('cartorio') ?? $dependente->cartorio ?? ''}}">
            </div>

            <div class="col-md-4">
              <label class="form-label">Nº de Registro</label>
              <input type="text" class="form-control" name="num_registro" value="{{old('num_registro') ?? $dependente->num_registro ?? ''}}">
            </div>

            <div class="col-md-4">
              <label class="form-label">Livro</label>
              <input type="text" class="form-control" name="livro" value="{{old('livro') ?? $dependente->livro ?? ''}}">
            </div>

            <div class="col-md-4">
              <label class="form-label">Folha</label>
              <input type="text" class="form-control" name="folha" value="{{old('folha') ?? $dependente->folha ?? ''}}">
            </div>

            <div class="col-12">
              <hr> <!-- Linha separadora -->
            </div>

            <div class="col-12">
              <h5>Dados para pensão alimentícia</h5>
            </div>

            <div class="col-md-8">
              <label class="form-label">Nome</label>
              <input type="text" class="form-control" name="nome_pensao" value="{{old('nome_pensao') ?? $dependente->nome_pensao ?? ''}}">
            </div>

            <div class="col-md-4">
              <label class="form-label">CPF</label>
              <input type="text" class="form-control cpf-mask" name="cpf_pensao" value="{{old('cpf_pensao') ?? $dependente->cpf_pensao ?? ''}}">
            </div>

            <div class="col-md-4">
              <label class="form-label">Banco</label>
              <input type="text" class="form-control" name="banco_pensao" value="{{old('banco_pensao') ?? $dependente->banco_pensao ?? ''}}">
            </div>

            <div class="col-md-4">
              <label class="form-label">Agência</label>
              <input type="text" class="form-control" name="agencia_pensao" value="{{old('agencia_pensao') ?? $dependente->agencia_pensao ?? ''}}">
            </div>

            <div class="col-md-4">
              <label class="form-label">Conta</label>
              <input type="text" class="form-control" name="conta_pensao" value="{{old('conta_pensao') ?? $dependente->conta_pensao ?? ''}}">
            </div>

            <div class="col-12">
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

{{-- melhorar a mascara do cpf, não consegui usar a que esta importada no funcionarios.inset --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    $('.cpf-mask').mask('000.000.000-00', {reverse: true});
  });
</script>
