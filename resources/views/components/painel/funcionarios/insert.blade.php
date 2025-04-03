@if (session('funcionario-error'))
  <div class="alert alert-danger"> {{ session('error') }} </div>
@endif

<div class="card">
  <div class="card-body">

    <form method="POST"
      action="{{ isset($funcionario->uid) ? route('funcionario-update', $funcionario->uid) : route('funcionario-create') }}"
      enctype="multipart/form-data">
      @csrf

      <!-- Nav tabs -->
      <ul class="nav nav-tabs nav-justified mb-3" role="tablist">
        <li class="nav-item">
          <a class="nav-link {{ session('activeTab') == 'principal' || !session('activeTab') ? 'active' : '' }}"
            data-bs-toggle="tab" href="#principal" role="tab" aria-selected="true">
            Dados Principais
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ session('activeTab') == 'documentos' ? 'active' : '' }}" data-bs-toggle="tab"
            href="#documentos" role="tab">
            Documentos
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ session('activeTab') == 'endereco' ? 'active' : '' }}" data-bs-toggle="tab"
            href="#endereco" role="tab">
            Endereços e contatos
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ session('activeTab') == 'financeiro' ? 'active' : '' }}" data-bs-toggle="tab"
            href="#financeiro" role="tab">
            Dados Prof. e Financeiro
          </a>
        </li>
        @if ($funcionario->id)
          <li class="nav-item">
            <a class="nav-link {{ session('activeTab') == 'dependentes' ? 'active' : '' }}"
              data-bs-toggle="tab" href="#dependentes" role="tab">
              Dependentes
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ session('activeTab') == 'epi' ? 'active' : '' }}" data-bs-toggle="tab"
              href="#epi" role="tab">
              EPIs
            </a>
          </li>
        @endif
      </ul>

      <!-- Tab panes -->
      <div class="tab-content">
        <div class="tab-pane {{ session('activeTab') == 'principal' || !session('activeTab') ? 'active show' : '' }}"
          id="principal" role="tabpanel">
          <!-- Dados principais -->

          <div class="row gy-3">
            <div class="col-sm-6">
              <x-forms.input-field :value="old('nome') ?? ($funcionario->nome ?? null)" name="nome" label="Nome Completo"
                :required="true" />
              @error('nome')<div class="text-warning">{{ $message }}</div>@enderror
            </div>

            <div class="col-sm-3">
              <x-forms.input-select name="situacao" label="Situação">
                <option value="INSS" @selected($funcionario->situacao == 'INSS')>INSS</option>
                <option value="ATIVO" @selected($funcionario->situacao == 'ATIVO')>ATIVO</option>
                <option value="DEMITIDO POR JUSTA CAUSA" @selected($funcionario->situacao == 'DEMITIDO POR JUSTA CAUSA')>DEMITIDO POR JUSTA
                  CAUSA</option>
                <option value="DEMITIDO SEM JUSTA CAUSA" @selected($funcionario->situacao == 'DEMITIDO SEM JUSTA CAUSA')>DEMITIDO SEM JUSTA
                  CAUSA</option>
                <option value="INATIVO" @selected($funcionario->situacao == 'INATIVO')>INATIVO</option>
                <option value="LICENÇA MATERNIDADE" @selected($funcionario->situacao == 'LICENÇA MATERNIDADE')>LICENÇA MATERNIDADE
                </option>
              </x-forms.input-select>
              @error('situacao')<div class="text-warning">{{ $message }}</div>@enderror
            </div>


            <div class="col-sm-3">
              <x-forms.input-select name="sexo" label="Sexo">

                <option @selected($funcionario->sexo == 'MASCULINO') value="MASCULINO">MASCULINO</option>
                <option @selected($funcionario->sexo == 'FEMININO') value="FEMININO">FEMININO</option>
                <option @selected($funcionario->sexo == 'OUTRO') value="OUTRO">OUTRO</option>

              </x-forms.input-select>
              @error('sexo')<div class="text-warning">{{ $message }}</div>@enderror
            </div>

            <div class="col-sm-3">
              <x-forms.input-select name="est_civil" label="Estado Civil">
                <option @selected($funcionario->est_civil == 'SOLTEIRO') value="SOLTEIRO">SOLTEIRO</option>
                <option @selected($funcionario->est_civil == 'CASADO') value="CASADO">CASADO</option>
                <option @selected($funcionario->est_civil == 'DIVORCIADO') value="DIVORCIADO">DIVORCIADO</option>
                <option @selected($funcionario->est_civil == 'SEPARADO') value="SEPARADO">SEPARADO</option>
                <option @selected($funcionario->est_civil == 'VIUVO') value="VIUVO">VIUVO</option>
              </x-forms.input-select>
              @error('est_civil')<div class="text-warning">{{ $message }}</div>@enderror
            </div>

            <div class="col-sm-3">
              <x-forms.input-field :value="old('nacionalidade') ?? ($funcionario->nacionalidade ?? 'Brasileiro')" name="nacionalidade" label="Nacionalidade" />
              @error('nacionalidade')<div class="text-warning">{{ $message }}</div>@enderror
            </div>

            <div class="col-sm-2">
              <x-forms.input-field :value="old('naturalidade_uf') ?? ($funcionario->naturalidade_uf ?? null)" name="naturalidade_uf" label="UF Naturalidade"
                placeholder="Ex. RS" pattern="[A-Z]{2}" title="Sigla do estado com 2 dígitos"
                :uppercase="true" />
              @error('naturalidade_uf')<div class="text-warning">{{ $message }}</div>@enderror
            </div>

            <div class="col-sm-4">
              <x-forms.input-field :value="old('naturalidade') ?? ($funcionario->naturalidade ?? null)" name="naturalidade" label="Cidade Naturalidade" />
              @error('naturalidade')<div class="text-warning">{{ $message }}</div>@enderror
            </div>

            <div class="col-sm-2">
              <x-forms.input-field :value="old('nascimento') ?? ($funcionario->nascimento ?? null)" type="date" name="nascimento"
                label="Data de Nascimento" />
              @error('nascimento')<div class="text-warning">{{ $message }}</div>@enderror
            </div>

            <div class="col-sm-5">
              <x-forms.input-field :value="old('nome_mae') ?? ($funcionario->nome_mae ?? null)" name="nome_mae" label="Nome da Mãe" />
              @error('nome_mae')<div class="text-warning">{{ $message }}</div>@enderror
            </div>

            <div class="col-sm-5">
              <x-forms.input-field :value="old('nome_pai') ?? ($funcionario->nome_pai ?? null)" name="nome_pai" label="Nome do Pai" />
              @error('nome_pai')<div class="text-warning">{{ $message }}</div>@enderror
            </div>

            <div class="col-sm-4">
              <x-forms.input-field :value="old('nome_conjuge') ?? ($funcionario->nome_conjuge ?? null)" name="nome_conjuge" label="Nome do Conjuge" />
              @error('nome_conjuge')<div class="text-warning">{{ $message }}</div>@enderror
            </div>

            <div class="col-sm-2">
              <x-forms.input-field :value="old('tipo_sanguineo') ?? ($funcionario->tipo_sanguineo ?? null)" name="tipo_sanguineo" label="Tipo Sanguineo"
                placeholder="Ex. AB+" pattern="^[A-Z]{2}[+\-]?$|^[A-Z][+\-]$"
                title="Somente 2 letras maiusculas e + ou -" />
              @error('tipo_sanguineo')<div class="text-warning">{{ $message }}</div>@enderror
            </div>

            <div class="col-sm-2">
              <x-forms.input-select name="pcd" label="PCD">

                <option @selected($funcionario->pcd == '0') value="0">NÃO</option>
                <option @selected($funcionario->pcd == '1') value="1">SIM</option>

              </x-forms.input-select>
              @error('pcd')<div class="text-warning">{{ $message }}</div>@enderror
            </div>

            <div class="col-sm-3">
              <x-forms.input-select name="raca_cor" label="Raça / Cor">

                <option @selected($funcionario->raca_cor == 'BRANCA') value="BRANCA">BRANCA</option>
                <option @selected($funcionario->raca_cor == 'BRANCA') value="BRANCA">BRANCA</option>
                <option @selected($funcionario->raca_cor == 'PARDA') value="PARDA">PARDA</option>
                <option @selected($funcionario->raca_cor == 'AMARELA') value="AMARELA">AMARELA</option>
                <option @selected($funcionario->raca_cor == 'INDIGENA') value="INDIGENA">INDIGENA</option>
                <option @selected($funcionario->raca_cor == 'OUTRO') value="OUTRO">OUTRO</option>

              </x-forms.input-select>
              @error('raca_cor')<div class="text-warning">{{ $message }}</div>@enderror
            </div>

            <div class="col-sm-12">
              <x-forms.input-textarea name="observacoes" label="Observações">
                {{ old('observacoes') ?? ($funcionario->observacoes ?? null) }}
              </x-forms.input-textarea>
              @error('observacoes')<div class="text-warning">{{ $message }}</div>@enderror
            </div>

          </div>
        </div>

        <div class="tab-pane {{ session('activeTab') == 'documentos' ? 'active show' : '' }}" id="documentos"
          role="tabpanel">
          <div class="row gy-3">
            <!-- Linha 1: CPF, RG, Emissor RG, Emissão RG -->
            <div class="col-sm-3">
              <x-forms.input-field :value="old('cpf') ?? ($funcionario->cpf ?? null)" name="cpf" id="input-cpf" label="CPF" />
              @error('cpf')<div class="text-warning">{{ $message }}</div>@enderror
            </div>

            <div class="col-sm-3">
              <x-forms.input-field :value="old('rg') ?? ($funcionario->rg ?? null)" type="number" name="rg" label="RG" />
              @error('rg')<div class="text-warning">{{ $message }}</div>@enderror
            </div>

            <div class="col-sm-3">
              <x-forms.input-field :value="old('emissor_rg') ?? ($funcionario->emissor_rg ?? null)" name="emissor_rg" label="Emissor do RG" />
              @error('emissor_rg')<div class="text-warning">{{ $message }}</div>@enderror
            </div>

            <div class="col-sm-3">
              <x-forms.input-field :value="old('emissao_rg') ?? ($funcionario->emissao_rg ?? null)" type="date" name="emissao_rg"
                label="Emissão do RG" />
              @error('emissao_rg')<div class="text-warning">{{ $message }}</div>@enderror
            </div>

            <!-- Linha 2: CTPS, Série CTPS, UF Emissão CTPS -->
            <div class="col-sm-4">
              <x-forms.input-field :value="old('ctps') ?? ($funcionario->ctps ?? null)" type="number" name="ctps" label="CTPS" />
              @error('ctps')<div class="text-warning">{{ $message }}</div>@enderror
            </div>

            <div class="col-sm-4">
              <x-forms.input-field :value="old('ctps_serie') ?? ($funcionario->ctps_serie ?? null)" name="ctps_serie" label="Série CTPS" />
              @error('ctps_serie')<div class="text-warning">{{ $message }}</div>@enderror
            </div>

            <div class="col-sm-4">
              <x-forms.input-field :value="old('ctps_uf') ?? ($funcionario->ctps_uf ?? null)" name="ctps_uf" label="UF Emissão CTPS"
                pattern="[A-Z]{2}" title="Sigla do estado com 2 dígitos" :uppercase="true" />
              @error('ctps_uf')<div class="text-warning">{{ $message }}</div>@enderror
            </div>

            <!-- Linha 3: Nº CNH, Data de Reg. CNH, Validade da CNH, Categoria CNH, Cert. Reservista -->
            <div class="col-sm-2">
              <x-forms.input-field :value="old('cnh') ?? ($funcionario->cnh ?? null)" type="number" name="cnh" label="Nº CNH" />
              @error('cnh')<div class="text-warning">{{ $message }}</div>@enderror
            </div>

            <div class="col-sm-2">
              <x-forms.input-field :value="old('cnh_registro') ?? ($funcionario->cnh_registro ?? null)" type="date" name="cnh_registro"
                label="Data de Reg. CNH" />
              @error('cnh_registro')<div class="text-warning">{{ $message }}</div>@enderror
            </div>

            <div class="col-sm-2">
              <x-forms.input-field :value="old('cnh_val') ?? ($funcionario->cnh_val ?? null)" type="date" name="cnh_val"
                label="Validade da CNH" />
              @error('cnh_val')<div class="text-warning">{{ $message }}</div>@enderror
            </div>

            <div class="col-sm-2">
              <x-forms.input-field :value="old('cnh_categ') ?? ($funcionario->cnh_categ ?? null)" name="cnh_categ" class="cnh_categ"
                label="Categoria CNH" :uppercase="true" pattern="[A-Z]{1,2}"
                title="Somente 1 ou 2 letras em maiusculo" />
              @error('cnh_categ')<div class="text-warning">{{ $message }}</div>@enderror
            </div>

            <div class="col-sm-4">
              <x-forms.input-field :value="old('cert_reserv') ?? ($funcionario->cert_reserv ?? null)" type="number" name="cert_reserv"
                label="Cert. Reservista" />
              @error('cert_reserv')<div class="text-warning">{{ $message }}</div>@enderror
            </div>

            <!-- Linha 4: Título de Eleitor, Zona Eleitoral, Sessão Eleitoral -->
            <div class="col-sm-4">
              <x-forms.input-field :value="old('titulo_eleitor') ?? ($funcionario->titulo_eleitor ?? null)" type="number" name="titulo_eleitor"
                label="Título de Eleitor" />
              @error('titulo_eleitor')<div class="text-warning">{{ $message }}</div>@enderror
            </div>

            <div class="col-sm-4">
              <x-forms.input-field :value="old('titulo_eleitor_zona') ?? ($funcionario->titulo_eleitor_zona ?? null)" type="number" name="titulo_eleitor_zona"
                label="Zona Eleitoral" />
              @error('titulo_eleitor_zona')<div class="text-warning">{{ $message }}</div>@enderror
            </div>

            <div class="col-sm-4">
              <x-forms.input-field :value="old('titulo_eleitor_cecao') ?? ($funcionario->titulo_eleitor_cecao ?? null)" type="number" name="titulo_eleitor_cecao"
                label="Sessão Eleitoral" />
              @error('titulo_eleitor_cecao')<div class="text-warning">{{ $message }}</div>@enderror
            </div>

            <!-- Linha 5: Número do PIS, E-Social, Data de opção do FGTS, Conta FGTS -->
            <div class="col-sm-3">
              <x-forms.input-field :value="old('pis') ?? ($funcionario->pis ?? null)" type="number" name="pis"
                label="Número do PIS" />
              @error('pis')<div class="text-warning">{{ $message }}</div>@enderror
            </div>

            <div class="col-sm-3">
              <x-forms.input-field :value="old('e_social') ?? ($funcionario->e_social ?? null)" name="e_social" label="E-Social" />
              @error('e_social')<div class="text-warning">{{ $message }}</div>@enderror
            </div>

            <div class="col-sm-3">
              <x-forms.input-field :value="old('data_opcao_fgts') ?? ($funcionario->data_opcao_fgts ?? null)" type="date" name="data_opcao_fgts"
                label="Data de opção do FGTS" />
              @error('data_opcao_fgts')<div class="text-warning">{{ $message }}</div>@enderror
            </div>

            <div class="col-sm-3">
              <x-forms.input-field :value="old('conta_fgts') ?? ($funcionario->conta_fgts ?? null)" name="conta_fgts" label="Conta FGTS" />
              @error('conta_fgts')<div class="text-warning">{{ $message }}</div>@enderror
            </div>

            <!-- Linha 6: Matricula, CBO, Descrição CBO -->
            <div class="col-sm-3">
              <x-forms.input-field :value="old('matricula') ?? ($funcionario->matricula ?? null)" name="matricula" label="Matricula" />
              @error('matricula')<div class="text-warning">{{ $message }}</div>@enderror
            </div>

            <div class="col-sm-3">
              <x-forms.input-field :value="old('cbo') ?? ($funcionario->cbo ?? null)" type="number" name="cbo" label="CBO" />
              @error('cbo')<div class="text-warning">{{ $message }}</div>@enderror
            </div>
              {{-- Melhorar tratamento de CBO --}}
            @if ($funcionario->cbo)
              <div class="col-sm-6">
                <label for="cbo_desc" class="form-label">Descrição CBO</label>
                @php
                  $cboValue = isset($funcionario->cbo) ? $funcionario->cbo : null;
                  try {
                    $cboDesc = CboList($cboValue);
                  } catch (ErrorException $e) {
                    $cboDesc = null;
                  }
                @endphp

                <input type="text" name="cbo_desc" value="{{ $cboDesc ?? 'CBO inválido' }}"
                  class="form-control {{ $cboDesc ? 'text-secondary' : 'text-danger' }}" disabled>
              </div>
            @endif
          </div>
        </div>

        <div class="tab-pane {{ session('activeTab') == 'endereco' ? 'active show' : '' }}" id="endereco"
          role="tabpanel"><!-- Endereços e contatos -->
          <div class="row gy-3">
            <div class="col-sm-4">
              <x-forms.input-field :value="old('endereco') ?? ($funcionario->endereco ?? null)" name="endereco" label="Endereço com Nº"
                placeholder="Ex. Av. Brasil, 1234" />
              @error('endereco')<div class="text-warning">{{ $message }}</div>@enderror
            </div>

            <div class="col-sm-2">
              <x-forms.input-field :value="old('complemento') ?? ($funcionario->complemento ?? null)" name="complemento" label="Complemento"
                placeholder="Ex. Bl-1, AP 101" />
              @error('complemento')<div class="text-warning">{{ $message }}</div>@enderror
            </div>

            <div class="col-sm-3">
              <x-forms.input-field :value="old('bairro') ?? ($funcionario->bairro ?? null)" name="bairro" label="Bairro" />
              @error('bairro')<div class="text-warning">{{ $message }}</div>@enderror
            </div>

            <div class="col-sm-3">
              <x-forms.input-field :value="old('cidade') ?? ($funcionario->cidade ?? null)" name="cidade" label="Cidade" />
              @error('cidade')<div class="text-warning">{{ $message }}</div>@enderror
            </div>

            <div class="col-sm-2">
              <x-forms.input-field :value="old('uf') ?? ($funcionario->uf ?? null)" name="uf" label="UF" :uppercase="true"
                pattern="[A-Z]{2}" title="Sigla do estado com 2 dígitos" />
              @error('uf')<div class="text-warning">{{ $message }}</div>@enderror
            </div>

            <div class="col-sm-2">
              <x-forms.input-field :value="old('cep') ?? ($funcionario->cep ?? null)" name="cep" label="CEP" class="cep" />
              @error('cep')<div class="text-warning">{{ $message }}</div>@enderror
            </div>

            <div class="col-sm-2">
              <x-forms.input-field :value="old('telefone') ?? ($funcionario->telefone ?? null)" name="telefone" label="Telefone"
                class="telefone" />
              @error('telefone')<div class="text-warning">{{ $message }}</div>@enderror
            </div>

            <div class="col-sm-2">
              <x-forms.input-field :value="old('telefone_2') ?? ($funcionario->telefone_2 ?? null)" name="telefone_2" label="Telefone 2"
                class="telefone" />
              @error('telefone_2')<div class="text-warning">{{ $message }}</div>@enderror
            </div>

            <div class="col-sm-4">
              <x-forms.input-field :value="old('email') ?? ($funcionario->email ?? null)" type="email" name="email" label="Email" />
              @error('email')<div class="text-warning">{{ $message }}</div>@enderror
            </div>

          </div>
        </div>

        <div class="tab-pane {{ session('activeTab') == 'financeiro' ? 'active show' : '' }}" id="financeiro"
          role="tabpanel"> <!-- Dados Prof. e Financeiro -->
          <div class="row gy-3">

            <div class="col-sm-4">
              <x-forms.input-field :value="old('cargo') ?? ($funcionario->cargo ?? null)" name="cargo" label="Cargo" />
              @error('cargo')<div class="text-warning">{{ $message }}</div>@enderror
            </div>

            <div class="col-sm-4">
              <x-forms.input-field :value="old('funcao') ?? ($funcionario->funcao ?? null)" name="funcao" label="Função"
                list="funcaoList" />
              <datalist id="funcaoList">
                @foreach ($funcionario->funcoes as $funcao)
                  <option value="{{ $funcao->funcao }}">
                @endforeach
              </datalist>
              @error('funcao')<div class="text-warning">{{ $message }}</div>@enderror

            </div>

            <div class="col-sm-4">
              <x-forms.input-select name="obra_id" label="Obra">
                <option value="">Selecione</option>
                @foreach ($obras as $obra)
                  <option @selected($funcionario->obra_id == $obra->id) value="{{ $obra->id }}">
                    {{ $obra->nome }} </option>
                @endforeach
              </x-forms.input-select>
              @error('obra_id')<div class="text-warning">{{ $message }}</div>@enderror
            </div>

            <div class="col-sm-4">
              <x-forms.input-select name="escolaridade" label="Escolaridade">
                <option value="">SELECIONE</option>
                <option @selected($funcionario->escolaridade == '01') value="01">Fundamental - Incompleto </option>
                <option @selected($funcionario->escolaridade == '02') value="02">Fundamental - Completo </option>
                <option @selected($funcionario->escolaridade == '03') value="03">Médio - Incompleto </option>
                <option @selected($funcionario->escolaridade == '04') value="04">Médio - Completo </option>
                <option @selected($funcionario->escolaridade == '05') value="05">Superior - Incompleto </option>
                <option @selected($funcionario->escolaridade == '06') value="06">Superior - Completo </option>
                <option @selected($funcionario->escolaridade == '07') value="07">Pós-graduação - Incompleto
                </option>
                <option @selected($funcionario->escolaridade == '08') value="08">Pós-graduação - Completo </option>
                <option @selected($funcionario->escolaridade == '09') value="09">Mestrado - Incompleto </option>
                <option @selected($funcionario->escolaridade == '10') value="10">Mestrado - Completo </option>
                <option @selected($funcionario->escolaridade == '11') value="11">Doutorado - Incompleto </option>
                <option @selected($funcionario->escolaridade == '12') value="12">Doutorado - Completo </option>
              </x-forms.input-select>
              @error('escolaridade')<div class="text-warning">{{ $message }}</div>@enderror
            </div>

            <div class="col-sm-4">
              <x-forms.input-select name="local_trabalho" label="Local de trabalho">
                <option value="">Selecione</option>
                <option @selected($funcionario->local_trabalho == 'canteiro') value="canteiro">Canteiro de Obras</option>
                <option @selected($funcionario->local_trabalho == 'administrativo') value="administrativo">Administrativo</option>
                <option @selected($funcionario->local_trabalho == 'deposito') value="deposito">Depósito/Pátio</option>
              </x-forms.input-select>
              @error('local_trabalho')<div class="text-warning">{{ $message }}</div>@enderror
            </div>

            <div class="col-sm-2">
              <x-forms.input-field :value="old('admissao') ?? ($funcionario->admissao ?? null)" type="date" name="admissao"
                label="Data Admissão" />
              @error('admissao')<div class="text-warning">{{ $message }}</div>@enderror
            </div>

            <div class="col-sm-2">
              <x-forms.input-field :value="old('demissao') ?? ($funcionario->demissao ?? null)" type="date" name="demissao"
                label="Data Demissão" />
              @error('demissao')<div class="text-warning">{{ $message }}</div>@enderror
            </div>

            <div class="col-sm-2">
              <x-forms.input-field :value="old('salario') ?? ($funcionario->salario ?? null)" name="salario" label="Salário" class="money" />
              @error('salario')<div class="text-warning">{{ $message }}</div>@enderror
            </div>

            <div class="col-sm-2">
              <x-forms.input-field :value="old('assiduidade') ?? ($funcionario->assiduidade ?? null)" name="assiduidade" label="Assiduidade"
                class="money" />
              @error('assiduidade')<div class="text-warning">{{ $message }}</div>@enderror
            </div>

            <div class="col-sm-2">
              <x-forms.input-field :value="old('insalubridade') ?? ($funcionario->insalubridade ?? null)" name="insalubridade" label="Insalubridade"
                class="money" />
              @error('insalubridade')<div class="text-warning">{{ $message }}</div>@enderror
            </div>

            <div class="col-sm-2">
              <x-forms.input-select name="vale_transporte" label="Vale Transporte">
                <option @selected($funcionario->vale_transporte == 1) value="1">SIM</option>
                <option @selected($funcionario->vale_transporte == 0) value="0">NÃO</option>
              </x-forms.input-select>
              @error('vale_transporte')<div class="text-warning">{{ $message }}</div>@enderror
            </div>

            <div class="col-sm-2">
              <x-forms.input-select name="contribuicao" label="Contribuição Sindical">
                <option @selected($funcionario->contribuicao == 1) value="1">SIM</option>
                <option @selected($funcionario->contribuicao == 0) value="0">NÃO</option>
              </x-forms.input-select>
              @error('contribuicao')<div class="text-warning">{{ $message }}</div>@enderror
            </div>


            <div class="col-sm-2">
              <x-forms.input-field type="time" :value="old('hr_entrada') ?? ($funcionario->hr_entrada ?? null)" name="hr_entrada"
                label="Horário de entrada" />
              @error('hr_entrada')<div class="text-warning">{{ $message }}</div>@enderror
            </div>

            @if ($funcionario->id)
              <div class="col-12">
                <a href="{{ route('funcionario-generate-doc-adimissao', $funcionario->uid) }}" 
                  class="btn btn-sm btn-primary">
                  Gerar Documento de Admissão
                </a>
              </div>

              <h6 class="mt-4 mb-1 ps-3">Dados Bancários</h6>
              <div class="table-responsive" style="min-height: 25vh">
                <table class="table table-responsive table-striped align-middle table-nowrap mb-0">
                  <thead>
                    <tr>
                      <th scope="col">Banco</th>
                      <th scope="col">Código</th>
                      <th scope="col">Agencia</th>
                      <th scope="col">Conta</th>
                      <th scope="col"></th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse ($funcionario->dadosBancarios as $banco)
                      <tr>
                        <td>{{ $banco->banco }}</td>
                        <td>{{ $banco->cod_banco }}</td>
                        <td>{{ $banco->agencia }}</td>
                        <td>{{ $banco->conta }}</td>
                        <td>
                          <div class="dropdown">
                            <a href="#" role="button" id="dropdownMenuLink1"
                              data-bs-toggle="dropdown" aria-expanded="false">
                              <i class="ph-dots-three-outline-vertical"
                                style="font-size: 1.5rem" data-bs-toggle="tooltip"
                                data-bs-placement="top" title="Detalhes e edição"></i>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                              <li><a class="dropdown-item" data-bs-toggle="modal"
                                  data-bs-target="{{ "#modal_banco_$banco->uid" }}">Editar</a>
                              </li>
                              <li><button class="dropdown-item"
                                  onclick="document.getElementById('banco-delete-{{ $banco->uid }}').submit(); return false;">Deletar</button>
                              </li>
                            </ul>
                          </div>
                        </td>
                      </tr>
                    @empty
                      <tr>
                        <td colspan="6" class="text-center"> Não há conta cadastrada.
                          &nbsp; &nbsp;
                          <a class="btn btn-sm btn-primary" data-bs-toggle="modal"
                            data-bs-target="#modal_banco_cadastro">Cadastrar conta
                            bancária</a>
                        </td>
                      </tr>
                    @endforelse
                  </tbody>
                </table>
              </div>
            @endif

          </div>
        </div>

        @if ($funcionario->id)

          <div class="tab-pane {{ session('activeTab') == 'dependentes' ? 'active show' : '' }}"
            id="dependentes" role="tabpanel"> <!-- Dependentes -->

            <a class="btn btn-sm btn-primary my-3" data-bs-toggle="modal"
              data-bs-target="#modal_dependente_cadastro">Cadastrar dependente</a>

            <div class="row gy-3">
              <div class="table-responsive" style="min-height: 25vh">
                <table class="table table-responsive table-striped align-middle table-nowrap mb-0">
                  <thead>
                    <tr>
                      <th scope="col">Nome</th>
                      <th scope="col">Nascimento</th>
                      <th scope="col">Parentesco</th>
                      <th scope="col" style="width: 5%; white-space: nowrap;"></th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse ($funcionario->dependentes as $dependente)
                      <tr>
                        <td>{{ $dependente->nome }}</td>
                        <td>{{ \Carbon\Carbon::parse($dependente->nascimento)->format('d-m-Y') }}
                        </td>
                        <td>{{ $dependente->parentesco }}</td>
                        <td>
                          <div class="dropdown">
                            <a href="#" role="button" id="dropdownMenuLink1"
                              data-bs-toggle="dropdown" aria-expanded="false">
                              <i class="ph-dots-three-outline-vertical"
                                style="font-size: 1.5rem" data-bs-toggle="tooltip"
                                data-bs-placement="top" title="Detalhes e edição"></i>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                              <li><a class="dropdown-item" data-bs-toggle="modal"
                                  data-bs-target="{{ "#modal_dependente_$dependente->uid" }}">Editar</a>
                              </li>
                              <li><button class="dropdown-item"
                                  onclick="document.getElementById('dependente-delete-{{ $dependente->uid }}').submit(); return false;">Deletar</button>
                              </li>
                            </ul>
                          </div>
                        </td>
                      </tr>

                    @empty
                      <tr>
                        <td colspan="6" class="text-center"> Não há dependentes
                          cadastrados. </td>
                      </tr>
                    @endforelse
                  </tbody>
                </table>
              </div>

            </div>
          </div>

          <div class="tab-pane {{ session('activeTab') == 'epi' ? 'active show' : '' }}" id="epi"
            role="tabpanel"> <!-- EPIs -->
            <div class="row gy-3">

              <div class="col-sm-3">
                <x-forms.input-field :value="old('botina') ?? ($funcionario->epi->botina ?? null)" name="botina" label="Botina"
                  placeholder="Digite o tamanho" />
                @error('botina')<div class="text-warning">{{ $message }}</div>@enderror
              </div>

              <div class="col-sm-3">
                <x-forms.input-field :value="old('calca') ?? ($funcionario->epi->calca ?? null)" name="calca" label="Calça"
                  placeholder="Digite o tamanho" />
                @error('calca')<div class="text-warning">{{ $message }}</div>@enderror
              </div>

              <div class="col-sm-3">
                <x-forms.input-field :value="old('camiseta') ?? ($funcionario->epi->camiseta ?? null)" name="camiseta" label="Camiseta"
                  placeholder="Digite o tamanho" />
                @error('camiseta')<div class="text-warning">{{ $message }}</div>@enderror
              </div>

            </div>
          </div>
        @endif

      </div>

      <!-- Btn -->
      <div class="row mt-3">
        <div class="col-sm-12">
          <button type="submit"
            class="btn btn-success px-4">{{ $funcionario->id ? 'Atualizar' : 'Cadastrar' }}
          </button>
        </div>
      </div>
    </form>

    @if ($funcionario->id)
      {{-- Modal de dados bancários --}}
      <x-modals.dados-bancarios :funcionario="$funcionario" />
      @foreach ($funcionario->dadosBancarios as $banco)
        <x-modals.dados-bancarios :banco="$banco" :funcionario="$funcionario" />
        <form id="banco-delete-{{ $banco->uid }}" method="POST" action="{{ route('conta-delete', $banco->uid) }}">
          @csrf
        </form>
      @endforeach

      <x-painel.funcionarios.form-delete route="funcionario-delete" id="{{ $funcionario->uid }}" />

      @foreach ($funcionario->dependentes as $dependente)
        <x-modals.dependentes :dependente="$dependente" :funcionario="$funcionario" />
        <form id="dependente-delete-{{ $dependente->uid }}" method="POST" action="{{ route('dependente-delete', $dependente->uid) }}">
          @csrf
        </form>
      @endforeach

      <x-modals.dependentes :funcionario="$funcionario" />

    @endif
  </div>

</div>
