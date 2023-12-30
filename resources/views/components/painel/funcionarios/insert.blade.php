@if (session('funcionario-error'))
    <div class="alert alert-danger"> {{ session('error') }} </div>
@endif

<div class="card">
  <div class="card-body">

    <form method="POST" action="{{ isset($funcionario->uid) ? route('funcionario-update', $funcionario->uid) : route('funcionario-create') }}" enctype="multipart/form-data">
      @csrf

      <!-- Nav tabs -->
      <ul class="nav nav-tabs nav-justified mb-3" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" data-bs-toggle="tab" href="#principal" role="tab" aria-selected="true">
                Dados Principais
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#documentos" role="tab" aria-selected="false">
                Documentos
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#endereco" role="tab" aria-selected="false">
                Endereços e contatos
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#financeiro" role="tab" aria-selected="false">
                Dados Prof. e Financeiro
            </a>
        </li>
      </ul>

      <!-- Tab panes -->
      <div class="tab-content">
          <div class="tab-pane active" id="principal" role="tabpanel"> <!-- Dados principais -->

            <div class="row gy-3">
              <div class="col-sm-6">
                <x-forms.input-field 
                  :value="old('nome') ?? $pessoa->nome ?? null" 
                  name="nome" label="Nome Completo <span class='text-danger' >*</span>" :required="true"
                />
                @error('nome') <div class="text-warning">{{ $message }}</div> @enderror 
              </div>
    
              <div class="col-sm-3">
                <x-forms.input-select name="raca_cor" label="Raça / Cor">
                  
                    <option @selected($funcionario->raca_cor == "BRANCA") value="BRANCA">BRANCA</option>
                    <option @selected($funcionario->raca_cor == "BRANCA") value="BRANCA">BRANCA</option>
                    <option @selected($funcionario->raca_cor == "PARDA") value="PARDA">PARDA</option>
                    <option @selected($funcionario->raca_cor == "AMARELA") value="AMARELA">AMARELA</option>
                    <option @selected($funcionario->raca_cor == "INDIGENA") value="INDIGENA">INDIGENA</option>
                    <option @selected($funcionario->raca_cor == "OUTRO") value="OUTRO">OUTRO</option>
                  
                </x-forms.input-select>
                @error('raca_cor') <div class="text-warning">{{ $message }}</div> @enderror 
              </div>
      
              <div class="col-sm-3">
                <x-forms.input-select name="sexo" label="Sexo">
                  
                    <option @selected($funcionario->sexo == "MASCULINO") value="MASCULINO">MASCULINO</option>
                    <option @selected($funcionario->sexo == "FEMININO") value="FEMININO">FEMININO</option>
                    <option @selected($funcionario->sexo == "OUTRO") value="OUTRO">OUTRO</option>
                  
                </x-forms.input-select>
                @error('sexo') <div class="text-warning">{{ $message }}</div> @enderror 
              </div>

              <div class="col-sm-3">
                <x-forms.input-select name="est_civil" label="Estado Civil">
                    <option @selected($funcionario->est_civil == "SOLTEIRO") value="SOLTEIRO">SOLTEIRO</option>
                    <option @selected($funcionario->est_civil == "CASADO") value="CASADO">CASADO</option>
                    <option @selected($funcionario->est_civil == "DIVORCIADO") value="DIVORCIADO">DIVORCIADO</option>
                    <option @selected($funcionario->est_civil == "SEPARADO") value="SEPARADO">SEPARADO</option>
                    <option @selected($funcionario->est_civil == "VIUVO") value="VIUVO">VIUVO</option>
                </x-forms.input-select>
                @error('est_civil') <div class="text-warning">{{ $message }}</div> @enderror 
              </div>

              <div class="col-sm-3">
                <x-forms.input-field 
                  :value="old('nacionalidade') ?? $pessoa->nacionalidade ?? 'Brasileiro'" 
                  name="nacionalidade" label="Nacionalidade"
                />
                @error('nacionalidade') <div class="text-warning">{{ $message }}</div> @enderror 
              </div>

              <div class="col-sm-2">
                <x-forms.input-field 
                  :value="old('naturalidade_uf') ?? $pessoa->naturalidade_uf ?? null" 
                  name="naturalidade_uf" label="UF Naturalidade" placeholder="Ex. RS"
                  pattern="[A-Z]{2}" title="Sigla do estado com 2 dígitos" :uppercase="true"
                />
                @error('naturalidade_uf') <div class="text-warning">{{ $message }}</div> @enderror 
              </div>
      
              <div class="col-sm-4">
                <x-forms.input-field 
                  :value="old('naturalidade') ?? $pessoa->naturalidade ?? null" 
                  name="naturalidade" label="Cidade Naturalidade"
                />
                @error('naturalidade') <div class="text-warning">{{ $message }}</div> @enderror 
              </div>
      
              <div class="col-sm-2">
                <x-forms.input-field 
                  :value="old('nascimento') ?? $pessoa->nascimento ?? null" 
                  type="date" name="nascimento" label="Data de Nascimento"
                />
                @error('nascimento') <div class="text-warning">{{ $message }}</div> @enderror 
              </div>

              <div class="col-sm-5">
                <x-forms.input-field 
                  :value="old('nome_mae') ?? $pessoa->nome_mae ?? null" 
                  name="nome_mae" label="Nome da Mãe"
                />
                @error('nome_mae') <div class="text-warning">{{ $message }}</div> @enderror 
              </div>
      
              <div class="col-sm-5">
                <x-forms.input-field 
                  :value="old('nome_pai') ?? $pessoa->nome_pai ?? null" 
                  name="nome_pai" label="Nome do Pai"
                />
                @error('nome_pai') <div class="text-warning">{{ $message }}</div> @enderror 
              </div>
      
              <div class="col-sm-4">
                <x-forms.input-field 
                  :value="old('nome_conjuge') ?? $pessoa->nome_conjuge ?? null" 
                  name="nome_conjuge" label="Nome do Conjuge"
                />
                @error('nome_conjuge') <div class="text-warning">{{ $message }}</div> @enderror 
              </div>

              <div class="col-sm-2">
                <x-forms.input-field 
                  :value="old('tipo_sanguineo') ?? $pessoa->tipo_sanguineo ?? null" 
                  name="tipo_sanguineo" label="Tipo Sanguineo" placeholder="Ex. AB+"
                  pattern="^[A-Z]{2}[+\-]?$|^[A-Z][+\-]$" title="Somente 2 letras maiusculas e + ou -"
                />
                @error('tipo_sanguineo') <div class="text-warning">{{ $message }}</div> @enderror 
              </div>
      
              <div class="col-sm-2">
                <x-forms.input-select name="pcd" label="PCD">
                  
                    <option @selected($funcionario->pcd == "0") value="0">NÃO</option>
                    <option @selected($funcionario->pcd == "1") value="1">SIM</option>
                  
                </x-forms.input-select>
                @error('pcd') <div class="text-warning">{{ $message }}</div> @enderror 
              </div>

              <div class="col-sm-12">
                <x-forms.input-textarea 
                  name="observacoes" label="Observações"
                >
                  {{old("observacoes") ?? $pessoa->observacoes ?? null}}
                </x-forms.input-textarea>
                @error('observacoes') <div class="text-warning">{{ $message }}</div> @enderror 
              </div>

            </div>
          </div>

          <div class="tab-pane" id="documentos" role="tabpanel"> <!-- Documentos -->

            <div class="row gy-3">
              <div class="col-sm-3">
                <x-forms.input-field 
                  :value="old('cpf') ?? $pessoa->cpf ?? null" 
                  name="cpf" id="input-cpf" label="CPF"
                />
                @error('cpf') <div class="text-warning">{{ $message }}</div> @enderror 
              </div>
      
              <div class="col-sm-3">
                <x-forms.input-field 
                  :value="old('cert_reserv') ?? $pessoa->cert_reserv ?? null" 
                  type="number" name="cert_reserv" label="Cert. Reservista"
                />
                @error('cert_reserv') <div class="text-warning">{{ $message }}</div> @enderror 
              </div>
      
              <div class="col-sm-3">
                <x-forms.input-field 
                  :value="old('rg') ?? $pessoa->rg ?? null" 
                  type="number" name="rg" label="RG"
                />
                @error('rg') <div class="text-warning">{{ $message }}</div> @enderror 
              </div>
      
              <div class="col-sm-3">
                <x-forms.input-field 
                  :value="old('emissor_rg') ?? $pessoa->emissor_rg ?? null" 
                  name="emissor_rg" label="Emissor do RG"
                />
                @error('emissor_rg') <div class="text-warning">{{ $message }}</div> @enderror 
              </div>

              <div class="col-sm-2">
                <x-forms.input-field 
                  :value="old('emissao_rg') ?? $pessoa->emissao_rg ?? null" 
                  type="date" name="emissao_rg" label="Emissão do RG"
                />
                @error('emissao_rg') <div class="text-warning">{{ $message }}</div> @enderror 
              </div>

      
              <div class="col-sm-3">
                <x-forms.input-field 
                  :value="old('ctps') ?? $pessoa->ctps ?? null" 
                  type="number" name="ctps" label="CTPS"
                />
                @error('ctps') <div class="text-warning">{{ $message }}</div> @enderror 
              </div>
      
              <div class="col-sm-3">
                <x-forms.input-field 
                  :value="old('ctps_serie') ?? $pessoa->ctps_serie ?? null" 
                  name="ctps_serie" label="Série CTPS"
                />
                @error('ctps_serie') <div class="text-warning">{{ $message }}</div> @enderror 
              </div>
      
              <div class="col-sm-2">
                <x-forms.input-field 
                  :value="old('ctps_uf') ?? $pessoa->ctps_uf ?? null" 
                  name="ctps_uf" label="UF Emissão CTPS"
                  pattern="[A-Z]{2}" title="Sigla do estado com 2 dígitos" :uppercase="true"
                />
                @error('ctps_uf') <div class="text-warning">{{ $message }}</div> @enderror 
              </div>
      
              <div class="col-sm-3">
                <x-forms.input-field 
                  :value="old('cnh') ?? $pessoa->cnh ?? null" 
                  type="number" name="cnh" label="Nº CNH"
                />
                @error('cnh') <div class="text-warning">{{ $message }}</div> @enderror 
              </div>

              <div class="col-sm-2">
                <x-forms.input-field 
                  :value="old('cnh_registro') ?? $pessoa->cnh_registro ?? null" 
                  type="date" name="cnh_registro" label="Data de Reg. CNH"
                />
                @error('cnh_registro') <div class="text-warning">{{ $message }}</div> @enderror 
              </div>

              <div class="col-sm-2">
                <x-forms.input-field 
                  :value="old('cnh_val') ?? $pessoa->cnh_val ?? null" 
                  type="date" name="cnh_val" label="Validade da CNH"
                />
                @error('cnh_val') <div class="text-warning">{{ $message }}</div> @enderror 
              </div>

              <div class="col-sm-2">
                <x-forms.input-field 
                  :value="old('cnh_categ') ?? $pessoa->cnh_categ ?? null" 
                  name="cnh_categ" class="cnh_categ" label="Categoria CNH" :uppercase="true"
                  pattern="[A-Z]{1,2}" title="Somente 1 ou 2 letras em maiusculo"
                />
                @error('cnh_categ') <div class="text-warning">{{ $message }}</div> @enderror 
              </div>
            </div>
            <div class="row gy-3 pt-3">
              <div class="col-sm-3">
                <x-forms.input-field 
                  :value="old('titulo_eleitor') ?? $pessoa->titulo_eleitor ?? null" 
                  type="number" name="titulo_eleitor" label="Título de Eleitor"
                />
                @error('titulo_eleitor') <div class="text-warning">{{ $message }}</div> @enderror 
              </div>
      
              <div class="col-sm-3">
                <x-forms.input-field 
                  :value="old('titulo_eleitor_zona') ?? $pessoa->titulo_eleitor_zona ?? null" 
                  type="number" name="titulo_eleitor_zona" label="Zona Eleitoral"
                />
                @error('titulo_eleitor_zona') <div class="text-warning">{{ $message }}</div> @enderror 
              </div>
      
              <div class="col-sm-3">
                <x-forms.input-field 
                  :value="old('titulo_eleitor_cessao') ?? $pessoa->titulo_eleitor_cessao ?? null" 
                  type="number" name="titulo_eleitor_cessao" label="Cessão Eleitoral"
                />
                @error('titulo_eleitor_cessao') <div class="text-warning">{{ $message }}</div> @enderror 
              </div>
      
              <div class="col-sm-3">
                <x-forms.input-field 
                  :value="old('pis') ?? $pessoa->pis ?? null" 
                  type="number" name="pis" label="Número do PIS"
                />
                @error('pis') <div class="text-warning">{{ $message }}</div> @enderror 
              </div>
      
              <div class="col-sm-2">
                <x-forms.input-field 
                  :value="old('data_opcao_fgts') ?? $pessoa->data_opcao_fgts ?? null" 
                  type="date" name="data_opcao_fgts" label="Data de opção do FGTS"
                />
                @error('data_opcao_fgts') <div class="text-warning">{{ $message }}</div> @enderror 
              </div>
      
              <div class="col-sm-3">
                <x-forms.input-field 
                  :value="old('conta_fgts') ?? $pessoa->conta_fgts ?? null" 
                  name="conta_fgts" label="Conta FGTS"
                />
                @error('conta_fgts') <div class="text-warning">{{ $message }}</div> @enderror 
              </div>
      
              <div class="col-sm-3">
                <x-forms.input-field 
                  :value="old('cbo') ?? $pessoa->cbo ?? null" 
                  type="number" name="cbo" label="CBO"
                />
                @error('cbo') <div class="text-warning">{{ $message }}</div> @enderror 
              </div>
      
            </div>
          </div>

          <div class="tab-pane" id="endereco" role="tabpanel"> <!-- Endereços e contatos -->
            <div class="row gy-3">
              <div class="col-sm-4">
                <x-forms.input-field 
                  :value="old('endereco') ?? $pessoa->endereco ?? null" 
                  name="endereco" label="Endereço com Nº" placeholder="Ex. Av. Brasil, 1234"
                />
                @error('endereco') <div class="text-warning">{{ $message }}</div> @enderror 
              </div>
      
              <div class="col-sm-2">
                <x-forms.input-field 
                  :value="old('complemento') ?? $pessoa->complemento ?? null" 
                  name="complemento" label="Complemento" placeholder="Ex. Bl-1, AP 101"
                />
                @error('complemento') <div class="text-warning">{{ $message }}</div> @enderror 
              </div>
      
              <div class="col-sm-3">
                <x-forms.input-field 
                  :value="old('bairro') ?? $pessoa->bairro ?? null" 
                  name="bairro" label="Bairro"
                />
                @error('bairro') <div class="text-warning">{{ $message }}</div> @enderror 
              </div>
      
              <div class="col-sm-3">
                <x-forms.input-field 
                  :value="old('cidade') ?? $pessoa->cidade ?? null" 
                  name="cidade" label="Cidade"
                />
                @error('cidade') <div class="text-warning">{{ $message }}</div> @enderror 
              </div>
      
              <div class="col-sm-2">
                <x-forms.input-field 
                  :value="old('uf') ?? $pessoa->uf ?? null" 
                  name="uf" label="UF" :uppercase="true"
                  pattern="[A-Z]{2}" title="Sigla do estado com 2 dígitos"
                />
                @error('uf') <div class="text-warning">{{ $message }}</div> @enderror 
              </div>
      
              <div class="col-sm-2">
                <x-forms.input-field 
                  :value="old('cep') ?? $pessoa->cep ?? null"
                  name="cep" label="CEP" class="cep"
                />
                @error('cep') <div class="text-warning">{{ $message }}</div> @enderror 
              </div>
      
              <div class="col-sm-2">
                <x-forms.input-field 
                  :value="old('telefone') ?? $pessoa->telefone ?? null" 
                  name="telefone" label="Telefone" class="telefone"
                />
                @error('telefone') <div class="text-warning">{{ $message }}</div> @enderror 
              </div>
      
              <div class="col-sm-2">
                <x-forms.input-field 
                  :value="old('telefone_2') ?? $pessoa->telefone_2 ?? null" 
                  name="telefone_2" label="Telefone 2" class="telefone"
                />
                @error('telefone_2') <div class="text-warning">{{ $message }}</div> @enderror 
              </div>
      
              <div class="col-sm-4">
                <x-forms.input-field 
                  :value="old('email') ?? $pessoa->email ?? null" 
                  type="email" name="email" label="Email"
                />
                @error('email') <div class="text-warning">{{ $message }}</div> @enderror 
              </div>
      
            </div>
          </div>

          <div class="tab-pane" id="financeiro" role="tabpanel"> <!-- Dados Prof. e Financeiro -->
            <div class="row gy-3">

              <div class="col-sm-4">
                <x-forms.input-field 
                  :value="old('cargo') ?? $pessoa->cargo ?? null" 
                  name="cargo" label="Cargo"
                />
                @error('cargo') <div class="text-warning">{{ $message }}</div> @enderror 
              </div>

              <div class="col-sm-4">
                <x-forms.input-field 
                  :value="old('funcao') ?? $pessoa->funcao ?? null" 
                  name="funcao" label="Função"
                />
                @error('funcao') <div class="text-warning">{{ $message }}</div> @enderror 
              </div>

              <div class="col-sm-4">
                <x-forms.input-select name="prestador_servico" label="Prestador de Serviços">
                    <option @selected($funcionario->est_civil == "01") value="01">Selecione</option>
                </x-forms.input-select>
                @error('prestador_servico') <div class="text-warning">{{ $message }}</div> @enderror
              </div>

              <div class="col-sm-4">
                <x-forms.input-select name="escolaridade" label="Escolaridade">
                    <option value="">SELECIONE</option>
                    <option @selected($funcionario->escolaridade == "01") value="01">Fundamental - Incompleto </option>
                    <option @selected($funcionario->escolaridade == "02") value="02">Fundamental - Completo </option>
                    <option @selected($funcionario->escolaridade == "03") value="03">Médio - Incompleto </option>
                    <option @selected($funcionario->escolaridade == "04") value="04">Médio - Completo </option>
                    <option @selected($funcionario->escolaridade == "05") value="05">Superior - Incompleto </option>
                    <option @selected($funcionario->escolaridade == "06") value="06">Superior - Completo </option>
                    <option @selected($funcionario->escolaridade == "07") value="07">Pós-graduação - Incompleto </option>
                    <option @selected($funcionario->escolaridade == "08") value="08">Pós-graduação - Completo </option>
                    <option @selected($funcionario->escolaridade == "09") value="09">Mestrado - Incompleto </option>
                    <option @selected($funcionario->escolaridade == "10") value="10">Mestrado - Completo </option>
                    <option @selected($funcionario->escolaridade == "11") value="11">Doutorado - Incompleto </option>
                    <option @selected($funcionario->escolaridade == "12") value="12">Doutorado - Completo </option>
                </x-forms.input-select>
                @error('escolaridade') <div class="text-warning">{{ $message }}</div> @enderror 
              </div>
      
              <div class="col-sm-4">
                <x-forms.input-select name="local_trabalho" label="Local de trabalho">
                  
                    <option @selected($funcionario->est_civil == "01") value="01">Selecione</option>
                  
                </x-forms.input-select>
                @error('local_trabalho') <div class="text-warning">{{ $message }}</div> @enderror 
              </div>
      
              <div class="col-sm-2">
                <x-forms.input-field 
                  :value="old('admissao') ?? $pessoa->admissao ?? null" 
                  type="date" name="admissao" label="Data Admissão"
                />
                @error('admissao') <div class="text-warning">{{ $message }}</div> @enderror 
              </div>

              <div class="col-sm-2">
                <x-forms.input-field 
                  :value="old('demissao') ?? $pessoa->demissao ?? null" 
                  type="date" name="demissao" label="Data Demissão"
                />
                @error('demissao') <div class="text-warning">{{ $message }}</div> @enderror 
              </div>

              <div class="col-sm-2">
                <x-forms.input-field 
                  :value="old('salario') ?? $pessoa->salario ?? null" 
                  name="salario" label="Salário" class="money"
                />
                @error('salario') <div class="text-warning">{{ $message }}</div> @enderror 
              </div>

              <div class="col-sm-2">
                <x-forms.input-field 
                  :value="old('periculosidade') ?? $pessoa->periculosidade ?? null" 
                  name="periculosidade" label="Periculosidade" class="money"
                />
                @error('periculosidade') <div class="text-warning">{{ $message }}</div> @enderror 
              </div>

              <div class="col-sm-2">
                <x-forms.input-field 
                  :value="old('quinquenio') ?? $pessoa->quinquenio ?? null" 
                  name="quinquenio" label="Quinquenio" class="money"
                />
                @error('quinquenio') <div class="text-warning">{{ $message }}</div> @enderror 
              </div>
      
              <div class="col-sm-2">
                <x-forms.input-field 
                  :value="old('func_gratificada') ?? $pessoa->func_gratificada ?? null" 
                  name="func_gratificada" label="Função Gratificada" class="money"
                />
                @error('func_gratificada') <div class="text-warning">{{ $message }}</div> @enderror 
              </div>

              <div class="col-sm-2">
                <x-forms.input-field 
                  :value="old('vale_transporte') ?? $pessoa->vale_transporte ?? null" 
                  name="vale_transporte" label="Vale Transporte" class="money"
                />
                @error('vale_transporte') <div class="text-warning">{{ $message }}</div> @enderror 
              </div>
      
              <div class="col-sm-2">
                <x-forms.input-field 
                  :value="old('contribuicao') ?? $pessoa->contribuicao ?? null" 
                  name="contribuicao" label="Contribuicao" class="money"
                />
                @error('contribuicao') <div class="text-warning">{{ $message }}</div> @enderror 
              </div>
      
              <div class="col-sm-4">
                <x-forms.input-select name="situacao" label="Situação">
                    <option @selected($funcionario->situacao == "ATIVO") value="ATIVO">ATIVO</option>
                    <option @selected($funcionario->situacao == "INATIVO") value="INATIVO">INATIVO</option>
                    <option @selected($funcionario->situacao == "INSS") value="INSS">INSS</option>
                    <option @selected($funcionario->situacao == "DEMITIDO_JUS_CAUS") value="DEMITIDO_JUS_CAUS">DEMITIDO POR J. CAUSA</option>
                    <option @selected($funcionario->situacao == "DEMITIDO") value="DEMITIDO">DEMITIDO SEM J. CAUSA</option>
                    <option @selected($funcionario->situacao == "LICENCA_MATERNIDADE") value="LICENCA_MATERNIDADE">LICENÇA MATERNIDADE</option>
                </x-forms.input-select>
                @error('situacao') <div class="text-warning">{{ $message }}</div> @enderror 
              </div>
      
            </div>
          </div>

      </div>

      <!-- Btn -->
      <div class="row mt-3">
        <div class="col-sm-12">
          <button type="submit"
            class="btn btn-primary px-4">{{ $funcionario->id ? 'Atualizar' : 'Cadastrar' }}
          </button>
        </div>
      </div>
    </form>

    @if ($funcionario->id)
      <x-painel.funcionarios.form-delete route="funcionario-delete" id="{{ $funcionario->uid }}" />

      <form method="POST" id="curriculo-delete" action="{{ route('curriculo-delete', $funcionario->uid) }}">
        @csrf
      </form>
    @endif
  </div>

</div>
