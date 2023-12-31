<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
      'cpf' => ['nullable','string', 'max:14', 'min:14'], // TODO - adicionar validação de CPF/CNPJ
      'raca_cor' => Rule::in(['BRANCA', 'PRETA', 'PARDA', 'AMARELA', 'INDIGENA', 'OUTRO']),
      'sexo' => Rule::in(['MASCULINO', 'FEMININO', 'OUTRO']),
      'est_civil' => Rule::in(['SOLTEIRO', 'CASADO', 'DIVORCIADO', 'SEPARADO', 'VIUVO']),
      'cep' => ['nullable','string', 'max:9', 'min:9'],
      'uf' => ['nullable', 'string', 'max:2', 'min:2'],
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
      'nome_razao.required' => 'Preencha o campo nome ou razão social',
      'cpf_cnpj.min' => 'CPF inválido',
      'cpf_cnpj.max' => 'CPF inválido',
      'cep.min' => 'CEP inválido',
      'cep.mmax' => 'CEP inválido',
      'uf.min' => 'Inválido',
      'uf.max' => 'Inválido',
      'admissao.date' => 'A data não é válida',
    ];
  }
}
