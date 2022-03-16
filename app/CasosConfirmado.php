<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;


class CasosConfirmado extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'obitos','masculino','feminino', 'ate1ano', 'de1a4anos', 'de5a9anos', 'de10a14anos',
         'de15a19anos', 'de20a29anos', 'de30a39anos', 'de40a49anos', 'de50a59anos', 'de60a69anos',
          'de70a79anos', 'de80oumais', 'dia', 'recuperados', 'analfabeto',
           'ensino_fundamental', 'ensino_medio', 'ensino_superior', 'escolaridade_nao_informada', 'branca',
            'parda', 'preta', 'amarela', 'indigena', 'cor_raca_nao_informada' 
    ];

 protected $dates = [ 
        'dia'
    ];

}
