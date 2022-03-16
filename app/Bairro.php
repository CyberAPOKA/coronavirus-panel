<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Bairro extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'nome', 'coordenada'
    ];

    public function caso()
    {
        return $this->hasMany(CasosConfirmadosBairro::class);
    }
}
