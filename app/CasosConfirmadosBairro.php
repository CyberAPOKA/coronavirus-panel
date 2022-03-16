<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CasosConfirmadosBairro extends Model
{
    protected $fillable = [
        'bairro_id', 'dia', 'casos'
    ];

    public function bairro()
    {
        return $this->belongsTo(Bairro::class);
    }
}
