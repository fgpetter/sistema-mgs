@if (session('error'))
    <div class="alert alert-danger"> {{ session('error') }} </div>
@endif

<div class="card">
  <div class="card-body">

    <form method="POST" action="{{ isset($itemFolha->uid) ? route('item-folha-update', $itemFolha->uid) : route('item-folha-create') }}">
      @csrf

      <div class="row gy-3">

        <div class="col-sm-5">
          <x-forms.input-field 
            :value="old('nome') ?? $itemFolha->nome ?? null" 
            name="nome" label="Nome" :required="true"
          />
          @error('nome') <div class="text-warning">{{ $message }}</div> @enderror 
        </div>

        <div class="col-sm-7">
          <x-forms.input-field 
            :value="old('descricao') ?? $itemFolha->descricao ?? null" 
            name="descricao" label="Descrição"
          />
          @error('descricao') <div class="text-warning">{{ $message }}</div> @enderror 
        </div>                

        <div class="col-sm-4">
          <x-forms.input-field 
            :value="old('empresa') ?? $itemFolha->empresa ?? null" 
            name="empresa" label="Empresa"
          />
          @error('empresa') <div class="text-warning">{{ $message }}</div> @enderror 
        </div>
        
        <div class="col-sm-2">
          <x-forms.input-field 
            :value="old('codigo') ?? $itemFolha->codigo ?? null" 
            name="codigo" label="Código"
          />
          @error('codigo') <div class="text-warning">{{ $message }}</div> @enderror 
        </div>

        <div class="col-sm-4">
          <x-forms.input-field 
            :value="old('evento_folha') ?? $itemFolha->evento_folha ?? null" 
            name="evento_folha" label="Evento Folha" tooltip="Informação que ira aparecer no lançamento da folha" :required="true" 
          />
          @error('evento_folha') <div class="text-warning">{{ $message }}</div> @enderror 
        </div>

        <div class="col-sm-3">
          <x-forms.input-select name="tipo_evento" label="Tipo">
            <option @selected($itemFolha->tipo_evento == "ADIANTAMENTO") value="ADIANTAMENTO">ADIANTAMENTO</option>
            <option @selected($itemFolha->tipo_evento == "ADICIONAL NOTURNO") value="ADICIONAL NOTURNO">ADICIONAL NOTURNO</option>
            <option @selected($itemFolha->tipo_evento == "ALIMENTACAO") value="ALIMENTACAO">ALIMENTAÇÃO</option>
            <option @selected($itemFolha->tipo_evento == "BONUS") value="BONUS">BONUS</option>
            <option @selected($itemFolha->tipo_evento == "DIARIAS") value="DIARIAS">DIÁRIAS</option>
            <option @selected($itemFolha->tipo_evento == "FALTA") value="FALTA">FALTA</option>
            <option @selected($itemFolha->tipo_evento == "FALTAS") value="FALTAS">FALTAS</option>
            <option @selected($itemFolha->tipo_evento == "HORAS-EXTRAS-100") value="HORAS-EXTRAS-100">HORAS-EXTRAS 100%</option>
            <option @selected($itemFolha->tipo_evento == "HORAS-EXTRAS-50") value="HORAS-EXTRAS-50">HORAS-EXTRAS 50%</option>
            <option @selected($itemFolha->tipo_evento == "PLANO DE SAUDE") value="PLANO DE SAUDE">PLANO DE SAÚDE</option>
            <option @selected($itemFolha->tipo_evento == "SALARIO BASE") value="SALARIO BASE">SALÁRIO BASE</option>
            <option @selected($itemFolha->tipo_evento == "SEGURO DE VIDA") value="SEGURO DE VIDA">SEGURO DE VIDA</option>
            <option @selected($itemFolha->tipo_evento == "VALE TRANSPORTE") value="VALE TRANSPORTE">VALE TRANSPORTE</option>
          </x-forms.input-select>
          @error('tipo_evento') <div class="text-warning">{{ $message }}</div> @enderror 
        </div>

        <div class="col-sm-2">
          <x-forms.input-select name="permite_lancamento" label="Permite Lançamento" tooltip="Define se o item poderá ser lançado na folha">
            <option @selected($itemFolha->permite_lancamento == 1) value=1>SIM</option>
            <option @selected($itemFolha->permite_lancamento == 0) value=0>NÃO</option>
          </x-forms.input-select>
          @error('permite_lancamento') <div class="text-warning">{{ $message }}</div> @enderror 
        </div>

        <div class="col-sm-2">
          <x-forms.input-select name="desconto" label="Permite desconto">
            <option @selected($itemFolha->desconto == 1) value=1>SIM</option>
            <option @selected($itemFolha->desconto == 0) value=0>NÃO</option>
          </x-forms.input-select>
          @error('desconto') <div class="text-warning">{{ $message }}</div> @enderror 
        </div>

        <div class="col-sm-3">
          <x-forms.input-select name="tipo" label="Tipo">
            <option @selected($itemFolha->tipo == "DESCONTO") value="DESCONTO">DESCONTO</option>
            <option @selected($itemFolha->tipo == "PROVENTO") value="PROVENTO">PROVENTO</option>
          </x-forms.input-select>
          @error('tipo_beneficio') <div class="text-warning">{{ $message }}</div> @enderror 
        </div>

        <div class="col-sm-12">
          <x-forms.input-textarea 
            name="observacoes" label="Observações"
          >
            {{old("observacoes") ?? $itemFolha->observacoes ?? null}}
          </x-forms.input-textarea>
          @error('observacoes') <div class="text-warning">{{ $message }}</div> @enderror 
        </div>


      </div>

      <!-- Btn -->
      <div class="row mt-3">
        <div class="col-sm-12">
          <button type="submit"
            class="btn btn-primary px-4">{{ $itemFolha->id ? 'Atualizar' : 'Cadastrar' }}
          </button>
        </div>
      </div>
    </form>

    @if ($itemFolha->id)
      <x-painel.item-folha.form-delete route="item-folha-delete" id="{{ $itemFolha->uid }}" />
    @endif
  </div>

</div>
