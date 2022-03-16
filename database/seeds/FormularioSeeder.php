<?php

use Illuminate\Database\Seeder;

class FormularioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        {
            DB::table('formularios')->insert(
                [
                    'testesRapidoRealizados'=>'0',
                    'testesPcrRealizados'=>'0',
                    'testesNegativos'=>'0',
                    'exames'=>'0'
                ]
            );
        }
    }
}
