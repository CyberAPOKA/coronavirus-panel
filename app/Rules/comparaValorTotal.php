<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ComparaValorTotal implements Rule
{
  /**
    * Create a new rule instance.
    *
    * @return void
  */
  public $valor;
  public $tipo;

  public function __construct($tipo,$valor)
  {
    //
    /*valor1 = $valor;
    valor2 = $soma;*/
    $this->valor = $valor;
    $this->tipo = $tipo;
  }

  /**
    * Determine if the validation rule passes.
    *
    * @param  string  $attribute
    * @param  mixed  $value
    * @return bool
  */
  public function passes($attribute, $value)
  {
    //
    return $this->valor == $value;

  }

  /**
    * Get the validation error message.
    *
    * @return string
  */
  public function message() {
      //dd($this->tipo);
    if ($this->tipo == "sexo")
    {
      return 'A quantidade de casos informada deve ser igual a soma dos valores informados nos campos Masculino/Feminino.';
    }
    else if ($this->tipo == "faixaEtaria")
    {
      return 'A quantidade de casos informada deve ser igual a soma dos valores informados nos campos de Faixa Etária.';
    }
    if ($this->tipo == "bairros")
    {
      return 'A quantidade de casos informada deve ser igual a soma dos valores informados nos Bairros.';
    }
    if ($this->tipo == "escolaridade")
    {
      return 'A quantidade de casos informada deve ser igual a soma dos valores informados nos campos de Escolaridade.';
    }
    if ($this->tipo == "corRaca")
    {
      return 'A quantidade de casos informada deve ser igual a soma dos valores informados nos campos de Cor/Raça.';
    }
    if ($this->tipo == "obitosRecuperados")
    {
      return 'A soma dos valores de óbitos e recuperados não deve ultrapassar o valor do total de casos.';
    }
    else {
      return 'Ocorreu um erro de validação.';
    }
  }
}
