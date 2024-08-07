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
      'cpf' => ['nullable','string', 'max:14', 'min:14'], // TODO - adicionar validação de CPF/CNPJ
      'raca_cor' => Rule::in(['BRANCA', 'PRETA', 'PARDA', 'AMARELA', 'INDIGENA', 'OUTRO']),
      'sexo' => Rule::in(['MASCULINO', 'FEMININO', 'OUTRO']),
      'est_civil' => Rule::in(['SOLTEIRO', 'CASADO', 'DIVORCIADO', 'SEPARADO', 'VIUVO']),
      'cep' => ['nullable','string', 'max:9', 'min:9'],
      'uf' => ['nullable', 'string', 'max:2', 'min:2'],
      'salario' => ['nullable', 'decimal:2'],
      'assiduidade' => ['nullable', 'decimal:2'],
      'insalubridade' => ['nullable', 'decimal:2'],
      'func_gratificada' => ['nullable', 'decimal:2'],
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
      'func_gratificada' => 'Inváldo',

    ];
  }

  public function prepareForValidation()
  {
    $this->merge([
      'salario' => ($this->salario) ? str_replace(',','.', str_replace('.','', $this->salario)) : null,
      'assiduidade' => ($this->periculosidade) ? str_replace(',','.', str_replace('.','', $this->periculosidade)) : null,
      'insalubridade' => ($this->quinquenio) ? str_replace(',','.', str_replace('.','', $this->quinquenio)) : null,
      'func_gratificada' => ($this->func_gratificada) ? str_replace(',','.', str_replace('.','', $this->func_gratificada)) : null,
    ]);
  }
}
