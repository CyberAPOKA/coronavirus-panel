<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ObitosFaixaEtariaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        {
            DB::table('obitos_faixa_etaria')->insert(
                [
                    'ate1ano'=>'0',
                    'de1a4anos'=>'0',
                    'de5a9anos'=>'0',
                    'de10a14anos'=>'0',
                    'de15a19anos'=>'0',
                    'de20a29anos'=>'0',
                    'de30a39anos'=>'0',
                    'de40a49anos'=>'0',
                    'de50a59anos'=>'0',
                    'de60a69anos'=>'0',
                    'de70a79anos'=>'0',
                    'de80oumais'=>'0',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]
            );
        }
    }
}



    
  
