<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ObitosFaixaEtaria extends Model
{
    //
    protected $fillable = [

    'ate1ano', 'de1a4anos', 'de5a9anos', 'de10a14anos',
         'de15a19anos', 'de20a29anos', 'de30a39anos', 'de40a49anos', 'de50a59anos', 'de60a69anos',
          'de70a79anos', 'de80oumais'
    ];

    protected $table = 'obitos_faixa_etaria';

}
