<div class="row"> {{-- cadastro de folha --}}

  <div class="col-6">
    <div class="card">
      <div class="card-body">
    
        <h4 class="card-title">Lancamento de folha</h4>
    
        <form method="POST" action="{{ route('folha-salvar') }}" >
          @csrf
    
          <div class="row">
            @if ($lancamento->uid)
              <input type="hidden" name="uid" value="{{ $lancamento->uid }}">
            @endif
    
            <div class="col">
              <label for="competencia" class="form-label">Competência<span class="text-danger"> * </span> </label>
              <input type="month" class="form-control" name="competencia" 
                value="{{ $lancamento->competencia ?? date('Y-m') }}" 
                required="required"
                @readonly($lancamento->competencia)>
              @error('competencia') <div class="text-warning">{{ $message }}</div> @enderror 
            </div>
    
            <div class="col">
              <x-forms.input-select name="status" label="Status">
                <option @selected($lancamento->status == "ABERTO") value="ABERTO">ABERTO</option>
                <option @selected($lancamento->status == "FECHADO") value="FECHADO">FECHADO</option>
              </x-forms.input-select>
              @error('status') <div class="text-warning">{{ $message }}</div> @enderror
            </div>
    
            <div class="col">
              <label for="dias_uteis" class="form-label">Dias Uteis<span class="text-danger"> * </span> </label>
              <input type="number" class="form-control" name="dias_uteis" 
                value="{{ old('dias_uteis') ?? $lancamento->dias_uteis ?? '' }}" required="required"
                min="1" max="30"
              >
              @error('dias_uteis') <div class="text-warning">{{ $message }}</div> @enderror
            </div>
    
          </div>
    
          <div class="row mt-3">
            <div class="col-sm-12">
              <button type="submit"
                class="btn btn-primary px-4">{{ $lancamento->id ? 'Atualizar Lançamento' : 'Gerar Lançamento' }}
              </button>
            </div>
          </div>
    
        </form>
    
      </div>
    </div>

  </div>

</div>

@if ($lancamento->uid)
<div class="row">

  <div class="col-5">
    
    <div class="card"> {{-- Lancamento de ponto --}}
      <div class="card-body">
    
        <h4 class="card-title">Lancamento de ponto</h4>
    
        <form method="POST" action="{{-- route('folha-salvar') --}}" enctype="multipart/form-data">
          @csrf
    
          <div class="row">
    
            <div class="col">
              <x-forms.input-select name="adiciona_ponto" label="Adicionar ponto de funcionário" tooltip="Listados somente pontos fechados">
                <option>Selecione</option>
                @foreach ($funcionarios as $funcionario)
                  <option value="{{ $funcionario->uid }}">{{ $funcionario->nome }}</option>                  
                @endforeach
              </x-forms.input-select>
              @error('adiciona_ponto') <div class="text-warning">{{ $message }}</div> @enderror
            </div>
    
          </div>
    
          <div class="row mt-3">
            <div class="col-sm-12">
              <button type="submit" class="btn btn-primary px-4"> Adicionar </button>
            </div>
          </div>
    
        </form>
    
      </div>
    </div>
    
    <div class="card"> {{-- Lancamento de beneficios --}}
      <div class="card-body">
    
        <h4 class="card-title">Lancamento de beneficios</h4>
    
        <form method="POST" action="{{-- route('lancamento-insert') --}}" enctype="multipart/form-data">
          @csrf
    
          <div class="row gy-3">
    
            <div class="col-12">
              <x-forms.input-select name="funcionario" label="Funcionario">
                <option>Selecione</option>
              </x-forms.input-select>
              @error('funcionario') <div class="text-warning">{{ $message }}</div> @enderror
            </div>

            <div class="col-12">
              <x-forms.input-select name="beneficio" label="Beneficio">
                <option>Selecione</option>
              </x-forms.input-select>
              @error('beneficio') <div class="text-warning">{{ $message }}</div> @enderror
            </div>

            <div class="col-4">
              <x-forms.input-field 
                :value="old('quantidade') ?? $lancamento->quantidade ?? null" 
                name="quantidade" label="Quantidade" type="number"
              />
              @error('quantidade') <div class="text-warning">{{ $message }}</div> @enderror 
  
            </div>
            <div class="col-4">
              <x-forms.input-field 
                :value="old('val_unit') ?? $lancamento->val_unit ?? null" 
                name="val_unit" label="Valor Unitário" type="number"
              />
              @error('val_unit') <div class="text-warning">{{ $message }}</div> @enderror
            </div>
            <div class="col-4">
              <x-forms.input-field 
                :value="old('val_total') ?? $lancamento->val_total ?? null" 
                name="val_total" label="Total" type="number"
              />
              @error('val_total') <div class="text-warning">{{ $message }}</div> @enderror
            </div>

            <div class="col-12">
              <x-forms.input-textarea name="observacoes" label="Observações" >{{old("observacoes") ?? $lancamento->observacoes ?? null}}</x-forms.input-textarea>
              @error('observacoes') <div class="text-warning">{{ $message }}</div> @enderror
            </div>
    
          </div>
    
          <div class="row mt-3">
            <div class="col">
              <button type="submit" class="btn btn-primary px-4"> Adicionar </button>
            </div>
          </div>
    
        </form>
    
      </div>
    </div>

  </div>

  <div class="col-7"> {{-- Extrato da folha --}}
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Extrato da folha</h4>
        <div class="table-responsive" style="min-height: 25vh">
          <table class="table table-responsive table-striped align-middle table-nowrap mb-0">
          <thead>
            <tr>
              <th scope="col">Pessoa</th>
              <th scope="col">Beneficio</th>
              <th scope="col">Quantidade</th>
              <th scope="col">Valor</th>
              <th scope="col" style="width: 1%; white-space: nowrap;"></th>
            </tr>
          </thead>
          <tbody>
            <th>Fulano</th>
            <td>Vale Refeicao</td>
            <td>2</td>
            <td>R$ 200,00</td>
            <td>
              <div class="dropdown">
                <a href="#" role="button" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="ph-dots-three-outline-vertical" style="font-size: 1.5rem" 
                    data-bs-toggle="tooltip" data-bs-placement="top" title="Detalhes e edição"></i>
                </a>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                  <li><a class="dropdown-item" href="{{-- route('funcionario-insert', ['funcionario' => $funcionario->uid]) --}}">Editar</a></li>
                  <li><a class="dropdown-item" href="{{-- route('lancamento-ponto-index', ['funcionario' => $funcionario->uid]) --}}">Ponto</a></li>
                  <li>
                    <form method="POST" action="{{-- route('funcionario-delete', $funcionario->uid) --}}">
                      @csrf
                      <button class="dropdown-item" type="submit">Deletar</button>
                    </form>
                  </li>
                </ul>
              </div>

            </td>
            
          </tbody>
          </table>
        </div>
    
      </div>
    </div>
  </div>

</div>
@endif


