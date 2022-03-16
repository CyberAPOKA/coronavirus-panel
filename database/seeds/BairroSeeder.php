<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BairroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bairros')->insert(
            [
                ['nome' => 'Jardim América','coordenada' => '-29.780893, -51.131771'],
                ['nome' => 'Campina','coordenada' => '-29.749805, -51.157572'],
                ['nome' => 'Santos Dumont','coordenada' => '-29.737096, -51.144137'],
                ['nome' => 'Arroio da Manteiga','coordenada' => '-29.727000, -51.184338'],
                ['nome' => 'Feitoria','coordenada' => '-29.754110, -51.098114'],
                ['nome' => 'Centro','coordenada' => '-29.767401, -51.146300'],
                ['nome' => 'Scharlau','coordenada' => '-29.727456, -51.154711'],
                ['nome' => 'Cristo Rei','coordenada' => '-29.781314, -51.152835'],
                ['nome' => 'São Miguel','coordenada' => '-29.765000, -51.159357'],
                ['nome' => 'Santa Tereza','coordenada' => '-29.787768, -51.134062'],
                ['nome' => 'Fazenda São Borja','coordenada' => '-29.785810, -51.116706'],
                ['nome' => 'Campestre','coordenada' => '-29.779556, -51.105037'],
                ['nome' => 'Morro do Espelho','coordenada' => '-29.779945, -51.140437'],
                ['nome' => 'Rio dos Sinos','coordenada' => '-29.750391, -51.147860'],
                ['nome' => 'Rio Branco','coordenada' => '-29.772442, -51.129676'],
                ['nome' => 'Boa Vista','coordenada' => '-29.705170, -51.179913'],
                ['nome' => 'Duque de Caxias','coordenada' => '-29.796017, -51.133687'],
                ['nome' => 'Fião','coordenada' => '-29.774156, -51.150780'],
                ['nome' => 'Padre Reus','coordenada' => '-29.783730, -51.144151'],
                ['nome' => 'Pinheiro','coordenada' => '-29.761503, -51.124825'],
                ['nome' => 'Santo André','coordenada' => '-29.770526, -51.118461'],
                ['nome' => 'São João Batista','coordenada' => '-29.793399, -51.164484'],
                ['nome' => 'São José','coordenada' => '-29.767790, -51.133771'],
                ['nome' => 'Vicentina','coordenada' => '-29.772508, -51.164635']

            ]
        );
    }
}
