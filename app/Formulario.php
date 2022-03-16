<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Formulario extends Model
{
    protected $fillable = [
        'testesRealizados', 'testesNegativos', 'exames', 'suspeitos', 'hospitalizados',
         'totalDose', 'primeiraDose','segundaDose','terceiraDose', 'quartaDose'
    ];

}
