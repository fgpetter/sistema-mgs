@if (session('beneficio-error'))
    <div class="alert alert-danger"> {{ session('error') }} </div>
@endif

<div class="card">
  <div class="card-body">

    <form method="POST" action="{{ isset($beneficio->uid) ? route('beneficio-update', $beneficio->uid) : route('beneficio-create') }}" enctype="multipart/form-data">
      @csrf

      <div class="row gy-3">

        <div class="col-sm-5">
          <x-forms.input-field 
            :value="old('nome') ?? $beneficio->nome ?? null" 
            name="nome" label="Nome" :required="true"
          />
          @error('nome') <div class="text-warning">{{ $message }}</div> @enderror 
        </div>

        <div class="col-sm-7">
          <x-forms.input-field 
            :value="old('descricao') ?? $beneficio->descricao ?? null" 
            name="descricao" label="Descrição" :required="true"
          />
          @error('descricao') <div class="text-warning">{{ $message }}</div> @enderror 
        </div>

        <div class="col-sm-3">
          <x-forms.input-select name="mostrar_folha" label="Mostrar em Folha">
            <option @selected($beneficio->mostrar_folha == 1) value=1>SIM</option>
            <option @selected($beneficio->mostrar_folha == 0) value=0>NÃO</option>
          </x-forms.input-select>
          @error('mostrar_folha') <div class="text-warning">{{ $message }}</div> @enderror 
        </div>

        <div class="col-sm-3">
          <x-forms.input-select name="desconto" label="Descontar">
            <option @selected($beneficio->desconto == 1) value=1>SIM</option>
            <option @selected($beneficio->desconto == 0) value=0>NÃO</option>
          </x-forms.input-select>
          @error('desconto') <div class="text-warning">{{ $message }}</div> @enderror 
        </div>

        <div class="col-sm-3">
          <x-forms.input-field 
            :value="old('codigo') ?? $beneficio->codigo ?? null" 
            name="codigo" label="Código" :required="true"
          />
          @error('codigo') <div class="text-warning">{{ $message }}</div> @enderror 
        </div>

        <div class="col-sm-4">
          <x-forms.input-field 
            :value="old('empresa') ?? $beneficio->empresa ?? null" 
            name="empresa" label="Empresa" :required="true"
          />
          @error('empresa') <div class="text-warning">{{ $message }}</div> @enderror 
        </div>

        <div class="col-sm-4">
          <x-forms.input-field 
            :value="old('evento_folha') ?? $beneficio->evento_folha ?? null" 
            name="evento_folha" label="Evento Folha" :required="true"
          />
          @error('evento_folha') <div class="text-warning">{{ $message }}</div> @enderror 
        </div>

        <div class="col-sm-3">
          <x-forms.input-select name="tipo_evento" label="Tipo Evento">
            <option @selected($beneficio->tipo_evento == "ADIANTAMENTO") value="ADIANTAMENTO">ADIANTAMENTO</option>
            <option @selected($beneficio->tipo_evento == "ADICIONAL NOTURNO") value="ADICIONAL NOTURNO">ADICIONAL NOTURNO</option>
            <option @selected($beneficio->tipo_evento == "ALIMENTAÇÃO") value="ALIMENTAÇÃO">ALIMENTAÇÃO</option>
            <option @selected($beneficio->tipo_evento == "ATRASO") value="ATRASO">ATRASO</option>
            <option @selected($beneficio->tipo_evento == "DIÁRIAS") value="DIÁRIAS">DIÁRIAS</option>
            <option @selected($beneficio->tipo_evento == "FALTAS") value="FALTAS">FALTAS</option>
            <option @selected($beneficio->tipo_evento == "HORAS-EXTRAS 100%") value="HORAS-EXTRAS 100%">HORAS-EXTRAS 100%</option>
            <option @selected($beneficio->tipo_evento == "HORAS-EXTRAS 50%") value="HORAS-EXTRAS 50%">HORAS-EXTRAS 50%</option>
            <option @selected($beneficio->tipo_evento == "PLANO DE SAÚDE") value="PLANO DE SAÚDE">PLANO DE SAÚDE</option>
            <option @selected($beneficio->tipo_evento == "SALÁRIO BASE") value="SALÁRIO BASE">SALÁRIO BASE</option>
            <option @selected($beneficio->tipo_evento == "SEGURO DE VIDA") value="SEGURO DE VIDA">SEGURO DE VIDA</option>
            <option @selected($beneficio->tipo_evento == "VALE-TRANSPORTE") value="VALE-TRANSPORTE">VALE-TRANSPORTE</option>
          </x-forms.input-select>
          @error('tipo_evento') <div class="text-warning">{{ $message }}</div> @enderror 
        </div>

        <div class="col-sm-3">
          <x-forms.input-select name="permite_lancamento" label="Permite Lançamento">
            <option @selected($beneficio->permite_lancamento == 1) value=1>SIM</option>
            <option @selected($beneficio->permite_lancamento == 0) value=0>NÃO</option>
          </x-forms.input-select>
          @error('permite_lancamento') <div class="text-warning">{{ $message }}</div> @enderror 
        </div>

        <div class="col-sm-3">
          <x-forms.input-select name="tipo_beneficio" label="Tipo Beneficio">
            <option @selected($beneficio->tipo_beneficio == "DESCONTO") value="DESCONTO">DESCONTO</option>
            <option @selected($beneficio->tipo_beneficio == "PROVENTO") value="PROVENTO">PROVENTO</option>
          </x-forms.input-select>
          @error('tipo_beneficio') <div class="text-warning">{{ $message }}</div> @enderror 
        </div>

        <div class="col-sm-12">
          <x-forms.input-textarea 
            name="observacoes" label="Observações"
          >
            {{old("observacoes") ?? $beneficio->observacoes ?? null}}
          </x-forms.input-textarea>
          @error('observacoes') <div class="text-warning">{{ $message }}</div> @enderror 
        </div>


      </div>

      <!-- Btn -->
      <div class="row mt-3">
        <div class="col-sm-12">
          <button type="submit"
            class="btn btn-primary px-4">{{ $beneficio->id ? 'Atualizar' : 'Cadastrar' }}
          </button>
        </div>
      </div>
    </form>

    @if ($beneficio->id)
      <x-painel.beneficios.form-delete route="beneficio-delete" id="{{ $beneficio->uid }}" />
    @endif
  </div>

</div>
