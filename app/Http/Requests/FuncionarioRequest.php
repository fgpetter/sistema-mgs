<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class FuncionarioRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   */
  public function authorize(): bool
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
   */
  public function rules(): array
  {
    return [
      'nome' => ['required', 'string', 'max:255'],
      'raca_cor' => Rule::in(['BRANCA', 'PRETA', 'PARDA', 'AMARELA', 'INDIGENA', 'OUTRO']),
      'sexo' => Rule::in(['MASCULINO', 'FEMININO', 'OUTRO']),
      'est_civil' => Rule::in(['SOLTEIRO', 'CASADO', 'DIVORCIADO', 'SEPARADO', 'VIUVO']),
      'nacionalidade' => ['nullable'],
      'naturalidade_uf' => ['nullable'],
      'naturalidade' => ['nullable'],
      'nascimento' => ['nullable'],
      'nome_pai' => ['nullable'],
      'nome_mae' => ['nullable'],
      'nome_conjuge' => ['nullable'],
      'tipo_sanguineo' => ['nullable'],
      'pcd' => ['nullable'],
      'cpf' => ['nullable','string', 'max:14', 'min:14'], // TODO - adicionar validação de CPF/CNPJ
      'cert_reserv' => ['nullable'],
      'rg' => ['nullable'],
      'emissor_rg' => ['nullable'],
      'emissao_rg' => ['nullable'],
      'ctps' => ['nullable'],
      'ctps_serie' => ['nullable'],
      'ctps_uf' => ['nullable'],
      'e_social' => ['nullable'],
      'cnh' => ['nullable'],
      'cnh_val' => ['nullable'],
      'cnh_registro' => ['nullable'],
      'cnh_categ' => ['nullable'],
      'titulo_eleitor' => ['nullable'],
      'titulo_eleitor_zona' => ['nullable'],
      'titulo_eleitor_cecao' => ['nullable'],
      'pis' => ['nullable'],
      'data_opcao_fgts' => ['nullable'],
      'conta_fgts' => ['nullable'],
      'cbo' => ['nullable'],
      'cbo_desc' => ['nullable'],
      'endereco' => ['nullable'],
      'complemento' => ['nullable'],
      'bairro' => ['nullable'],
      'cidade' => ['nullable'],
      'uf' => ['nullable', 'string', 'max:2', 'min:2'],
      'cep' => ['nullable','string', 'max:9', 'min:9'],
      'telefone' => ['nullable'],
      'telefone_2' => ['nullable'],
      'email' => ['nullable'],
      'cargo' => ['nullable'],
      'funcao' => ['nullable'],
      'escolaridade' => ['nullable'],
      'local_trabalho' => ['nullable'],
      'obra_id' =>  ['nullable', 'numeric', 'exists:obras,id'],
      'admissao' => ['nullable'],
      'demissao' => ['nullable'],
      'salario' => ['nullable', 'decimal:2'],
      'insalubridade' => ['nullable', 'decimal:2'],
      'assiduidade' => ['nullable', 'decimal:2'],
      'vale_transporte' => ['nullable'],
      'contribuicao' => ['nullable'],
      'hr_entrada' => ['nullable'],
      'situacao' => ['nullable'],
      'observacoes' => ['nullable'],
      'matricula' => ['nullable'],
    ];
  }

  /**
   * Get the error messages for the defined validation rules.
   *
   * @return array<string, string>
   */
  public function messages(): array
  {
    return [
      'nome.required' => 'Preencha o campo nome',
      'cpf_cnpj.min' => 'CPF inválido',
      'cpf_cnpj.max' => 'CPF inválido',
      'cep.min' => 'CEP inválido',
      'cep.mmax' => 'CEP inválido',
      'uf.min' => 'Inválido',
      'uf.max' => 'Inválido',
      'admissao.date' => 'A data não é válida',
      'salario' => 'Inváldo',
      'assiduidade' => 'Inváldo',
      'insalubridade' => 'Inváldo',
      'obra_id.in' => 'Selecione uma obra',
    ];
  }

  public function prepareForValidation()
  {
    $this->merge([
      'salario' => ($this->salario) ? str_replace(',','.', str_replace('.','', $this->salario)) : null,
      'assiduidade' => ($this->periculosidade) ? str_replace(',','.', str_replace('.','', $this->periculosidade)) : null,
      'insalubridade' => ($this->quinquenio) ? str_replace(',','.', str_replace('.','', $this->quinquenio)) : null,
    ]);
  }
}
