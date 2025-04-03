<?php

namespace App\Actions;

use App\Models\Funcionario;
use Illuminate\Support\Str;
use PhpOffice\PhpWord\TemplateProcessor;

class GenerateDocAdimissaoAction
{
  public $templateProcessor;

  public function __construct()
  {
    $this->templateProcessor = new TemplateProcessor( storage_path('app/templates/admissao.docx') );
  }

  public function execute(Funcionario $funcionario)
  {

    $data = [
      'nome' => $funcionario->nome ?? '',
      'telefone' => $funcionario->telefone ?? '',
      'nascimento' => $funcionario->nascimento ?? '',
      'nacionalidade' => $funcionario->nacionalidade ?? '',
      'nome_pai' => $funcionario->nome_pai ?? '',
      'nome_mae' => $funcionario->nome_mae ?? '',
      'raca_cor' => $funcionario->raca_cor ?? '',
      'sexo' => $funcionario->sexo ?? '',
      'est_civil' => $funcionario->est_civil ?? '',
      'escolaridade' => $funcionario->escolaridade ?? '',
      'ctps' => $funcionario->ctps ?? '',
      'ctps_serie' => $funcionario->ctps_serie ?? '',
      'ctps_uf' => $funcionario->ctps_uf ?? '',
      'ctps_emissao' => $funcionario->ctps_emissao ?? '',
      'cpf' => $funcionario->cpf ?? '',
      'pis' => $funcionario->pis ?? '',
      'rg' => $funcionario->rg ?? '',
      'emissor_rg' => $funcionario->emissor_rg ?? '',
      'emissao_rg' => $funcionario->emissao_rg ?? '',
      'titulo_eleitor' => $funcionario->titulo_eleitor ?? '',
      'titulo_eleitor_zona' => $funcionario->titulo_eleitor_zona ?? '',
      'titulo_eleitor_secao' => $funcionario->titulo_eleitor_secao ?? '',
      'titulo_eleitor_cidade' => $funcionario->titulo_eleitor_cidade ?? '',
      'cert_reserv' => $funcionario->cert_reserv ?? '',
      'endereco' => $funcionario->endereco ?? '',
      'complemento' => $funcionario->complemento ?? '',
      'cep' => $funcionario->cep ?? '',
      'bairro' => $funcionario->bairro ?? '',
      'cidade' => $funcionario->cidade ?? '',
      'uf' => $funcionario->uf ?? '',
      'admissao' => $funcionario->admissao ?? '',
      'funcao' => $funcionario->funcao ?? '',
      'salario' => $funcionario->salario ?? '',
      'vale_transporte' => $funcionario->vale_transporte ?? '',
      'contribuicao' => $funcionario->contribuicao ?? '',
    ];

    for ($i = 0; $i < 5; $i++) {
      $dependente = $funcionario->dependentes[$i] ?? null;
      $data['dependente_' . ($i + 1) . '_nome'] = $dependente?->nome ?? '';
      $data['dependente_' . ($i + 1) . '_data_nascimento'] = $dependente?->data_nascimento ?? '';
      $data['dependente_' . ($i + 1) . '_parentesco'] = $dependente?->parentesco ?? '';
      $data['dependente_' . ($i + 1) . '_sexo'] = $dependente?->sexo ?? '';
      $data['dependente_' . ($i + 1) . '_cartorio'] = $dependente?->cartorio ?? '';
      $data['dependente_' . ($i + 1) . '_registro'] = $dependente?->registro ?? '';
      $data['dependente_' . ($i + 1) . '_livro'] = $dependente?->livro ?? '';
      $data['dependente_' . ($i + 1) . '_folha'] = $dependente?->folha ?? '';
    }

    $this->templateProcessor->setValues($data);

    $filename = 'doc_admissao_' . Str::slug($funcionario->nome) . '.docx';
    $this->templateProcessor->saveAs( storage_path('app/public/docs/'. $filename) );

    return $filename;
  }
}