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
              <x-forms.input-field :value="old('nome') ?? ($dependente->nome ?? null)" name="nome" label="Nome" :required="true" />
              @error('nome')<div class="text-warning">{{ $message }}</div>@enderror
            </div>

            <div class="col-lg-2">
              <x-forms.input-field type="date" :value="old('nascimento') ?? ($dependente->nascimento ?? null)" name="nascimento" label="Nascimento" :required="true" />
              @error('nascimento')<div class="text-warning">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-4">
              <x-forms.input-field :value="old('parentesco') ?? ($dependente->parentesco ?? null)" name="parentesco" label="Parentesco" :required="true" />
              @error('parentesco')<div class="text-warning">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-4">
              <x-forms.input-select name="sexo" label="Sexo" :required="true" >
                <option value="MASCULINO" @selected($dependente?->sexo == 'MASCULINO')>Masculino</option>
                <option value="FEMININO" @selected($dependente?->sexo == 'FEMININO')>Feminino</option>
                <option value="OUTRO" @selected($dependente?->sexo == 'OUTRO')>Outro</option>
              </x-forms.input-select>
              @error('sexo')<div class="text-warning">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-4">
              <x-forms.input-select name="est_civil" label="Estado Civil" :required="true" >
                <option value="SOLTEIRO" @selected($dependente?->est_civil == 'SOLTEIRO')>Solteiro</option>
                <option value="CASADO" @selected($dependente?->est_civil == 'CASADO')>Casado</option>
                <option value="DIVORCIADO" @selected($dependente?->est_civil == 'DIVORCIADO')>Divorciado</option>
                <option value="SEPARADO" @selected($dependente?->est_civil == 'SEPARADO')>Separado</option>
                <option value="VIUVO" @selected($dependente?->est_civil == 'VIUVO')>Viúvo</option>
              </x-forms.input-select>
              @error('est_civil')<div class="text-warning">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-4">
              <x-forms.input-field :value="old('cartorio') ?? ($dependente->cartorio ?? null)" name="cartorio" label="Cartório" />
              @error('cartorio')<div class="text-warning">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-4">
              <x-forms.input-field :value="old('num_registro') ?? ($dependente->num_registro ?? null)" name="num_registro" label="Nº de Registro" />
              @error('num_registro')<div class="text-warning">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-4">
              <x-forms.input-field :value="old('livro') ?? ($dependente->livro ?? null)" name="livro" label="Livro" />
              @error('livro')<div class="text-warning">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-4">
              <x-forms.input-field :value="old('folha') ?? ($dependente->folha ?? null)" name="folha" label="Folha" />
              @error('folha')<div class="text-warning">{{ $message }}</div>@enderror
            </div>

            <div class="col-12">
              <hr> <!-- Linha separadora -->
            </div>

            <div class="col-12">
              <h5>Dados para pensão alimentícia</h5>
            </div>

            <div class="col-md-8">
              <x-forms.input-field :value="old('nome_pensao') ?? ($dependente->nome_pensao ?? null)" name="nome_pensao" label="Nome" />
              @error('nome_pensao')<div class="text-warning">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-4">
              <x-forms.input-field :value="old('cpf_pensao') ?? ($dependente->cpf_pensao ?? null)" name="cpf_pensao" label="CPF" class="cpf-mask" />
              @error('cpf_pensao')<div class="text-warning">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-4">
              <x-forms.input-field :value="old('banco_pensao') ?? ($dependente->banco_pensao ?? null)" name="banco_pensao" label="Banco" />
              @error('banco_pensao')<div class="text-warning">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-4">
              <x-forms.input-field :value="old('agencia_pensao') ?? ($dependente->agencia_pensao ?? null)" name="agencia_pensao" label="Agência" />
              @error('agencia_pensao')<div class="text-warning">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-4">
              <x-forms.input-field :value="old('conta_pensao') ?? ($dependente->conta_pensao ?? null)" name="conta_pensao" label="Conta" />
              @error('conta_pensao')<div class="text-warning">{{ $message }}</div>@enderror
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
