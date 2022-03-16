<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class comparaTotalObitos implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */

     public $totalObitos;
     public $totalObitosFaixaEtaria;


    public function __construct($totalObitos,$totalObitosFaixaEtaria)
    {
        //
        $this->totalObitos = $totalObitos;
        $this->totalObitosFaixaEtaria = $totalObitosFaixaEtaria;
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
        return $this->totalObitos == $this->totalObitosFaixaEtaria;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'O total de óbitos por faixa etária (' . $this->totalObitosFaixaEtaria 
        . ') deve ser igual ao total de óbitos informados no registro diário (' . $this->totalObitos . ').'; 
        
        
      
    }
}
