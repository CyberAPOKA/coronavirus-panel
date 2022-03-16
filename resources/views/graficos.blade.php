@php
    use App\Bairro;
    use App\CasosConfirmado; 
    use App\CasosConfirmadosBairro;
    use Carbon\Carbon;
    use \App\Http\Controllers\CasosController;
    use App\ObitosFaixaEtaria; 


       $dataInicialUmMes = date_sub(now(), date_interval_create_from_date_string('30 days'));
       $dataInicialTresMeses = date_sub(now(), date_interval_create_from_date_string('90 days'));
       $dataInicialSeisMeses = date_sub(now(), date_interval_create_from_date_string('180 days'));

     //  error_log("dataInicialUmMes:" . date_format($dataInicialUmMes, 'Y-m-d'));

    // INFORMAÇÕES PARA OS GRÁFICOS COMPARATIVOS E CASOS DIÁRIOS

        $somaCasosTotal = CasosController::consultarDadosComparativosPorPeriodo(null);
        $somaCasosUmMes = CasosController::consultarDadosComparativosPorPeriodo($dataInicialUmMes);
        $somaCasosTresMeses = CasosController::consultarDadosComparativosPorPeriodo($dataInicialTresMeses);
        $somaCasosSeisMeses = CasosController::consultarDadosComparativosPorPeriodo($dataInicialSeisMeses);


        $casosTotais = array_sum(array_column($somaCasosTotal->toArray(), 'casos'));
        $casosTotaisUmMes = array_sum(array_column($somaCasosUmMes->toArray(), 'casos'));
        $casosTotaisTresMeses = array_sum(array_column($somaCasosTresMeses->toArray(), 'casos'));
        $casosTotaisSeisMeses = array_sum(array_column($somaCasosSeisMeses->toArray(), 'casos'));

        //Total
        $diaCasos = [];
        $casos = [];
        $obitos = [];
        $recuperados = [];
        
        $casosDiariosTudo = [];
        $obitosDiariosTudo = [];

        $virusAtivoTudo = [];
        $virusAtivoUmMes = [];
        $virusAtivoTresMeses = [];
        $virusAtivoSeisMeses = [];

        $soma_casos = 0;
        $soma_obitos = 0;
        $soma_recuperados = 0;
        $soma_virusAtivo = 0;
        
        $data = DateTime::createFromFormat('d/m/Y', '10/03/2021');

        foreach ($somaCasosTotal as $soma) {
            $soma_casos += $soma->casos;
            $soma_obitos += $soma->obitos;
            $soma_recuperados += $soma->recuperados;
            
            array_push($casos, $soma_casos);
            array_push($obitos, $soma_obitos);
            array_push($recuperados, $soma_recuperados);
            
            array_push($diaCasos, $soma->dia);
            array_push($casosDiariosTudo, $soma->casos);
            array_push($obitosDiariosTudo, $soma->obitos);
            
           $virusAtivo = $soma_casos - ($soma_recuperados + $soma_obitos);

           array_push($virusAtivoTudo, $virusAtivo);

            if ($soma->dia->format('Y-m-d') >= $dataInicialUmMes->format('Y-m-d') )
            {
                array_push($virusAtivoUmMes, $virusAtivo);
            }
            if ($soma->dia->format('Y-m-d') >= $dataInicialTresMeses->format('Y-m-d') )
            {
              //  error_log("Virus ativo: " . $virusAtivoUmMes);  
            // error_log("Dia: " . $soma->dia . "Vírus Ativo Tres meses: " . $virusAtivo);
            array_push($virusAtivoTresMeses, $virusAtivo);
            }

            if ($soma->dia->format('Y-m-d') >= $dataInicialSeisMeses->format('Y-m-d') )
            {
              //  error_log("Virus ativo: " . $virusAtivoUmMes);  
            //error_log("Dia: " . $soma->dia . "Vírus Ativo: " . $virusAtivo);
            array_push($virusAtivoSeisMeses, $virusAtivo);
            }

        }

       // error_log("Virus ativo: " . implode(",", $virusAtivoTudo));
      // error_log("Virus ativo um mês: " . implode(",", $virusAtivoUmMes));
       

        $mediaMovelCasosTudo = CasosController::calculaMediaMovel($casosDiariosTudo);
        $mediaMovelObitosTudo = CasosController::calculaMediaMovel($obitosDiariosTudo);

        //1 Mes
        $diaCasosUmMes = [];
        $casosUmMes = [];
        $obitosUmMes = [];
        $recuperadosUmMes = [];
        $casosDiariosUmMes = [];
        $obitosDiariosUmMes = [];
        
        $soma_casosUmMes = 0;
        $soma_obitosUmMes = 0;
        $soma_recuperadosUmMes = 0;
        
      //  error_log("somaCasosUmMes: " . $somaCasosUmMes);
     

        foreach ($somaCasosUmMes as $soma) {
            $soma_casosUmMes += $soma->casos;
            $soma_obitosUmMes += $soma->obitos;
            $soma_recuperadosUmMes += $soma->recuperados;
            
            array_push($casosUmMes, $soma_casosUmMes);
            array_push($obitosUmMes, $soma_obitosUmMes);
            array_push($recuperadosUmMes, $soma_recuperadosUmMes);

            array_push($casosDiariosUmMes,$soma->casos);
            array_push($obitosDiariosUmMes, $soma->obitos);
            
            array_push($diaCasosUmMes, $soma->dia);
            //array_push($virusAtivoUmMes, $soma_casos - ($soma_recuperados + $soma_obitos));
        }
     

        $mediaMovelCasosUmMes = CasosController::calculaMediaMovel($casosDiariosUmMes);
        $mediaMovelObitosUmMes = CasosController::calculaMediaMovel($obitosDiariosUmMes);

        //3 Mes
        $diaCasosTresMeses = [];
        $casosTresMeses = [];
        $obitosTresMeses = [];
        $recuperadosTresMeses = [];
        $casosDiariosTresMeses = [];
        $obitosDiariosTresMeses = [];
        
        $soma_casosTresMeses = 0;
        $soma_obitosTresMeses = 0;
        $soma_recuperadosTresMeses = 0;
        
        foreach ($somaCasosTresMeses as $soma) {
            $soma_casosTresMeses += $soma->casos;
            $soma_obitosTresMeses += $soma->obitos;
            $soma_recuperadosTresMeses += $soma->recuperados;
            
            array_push($casosTresMeses, $soma_casosTresMeses);
            array_push($obitosTresMeses, $soma_obitosTresMeses);
            array_push($recuperadosTresMeses, $soma_recuperadosTresMeses);
            
            array_push($diaCasosTresMeses, $soma->dia);
            array_push($casosDiariosTresMeses,$soma->casos);
            array_push($obitosDiariosTresMeses, $soma->obitos);
            //array_push($virusAtivoTresMeses, $soma_casos - ($soma_recuperados + $soma_obitos));
        }

      
        $mediaMovelCasosTresMeses = CasosController::calculaMediaMovel($casosDiariosTresMeses);
        $mediaMovelObitosTresMeses  = CasosController::calculaMediaMovel($obitosDiariosTresMeses);

        //6 Meses
        $diaCasosSeisMeses = [];
        $casosSeisMeses = [];
        $obitosSeisMeses = [];
        $recuperadosSeisMeses = [];
        $casosDiariosSeisMeses = [];
        $obitosDiariosSeisMeses = [];
      
               
        $soma_casosSeisMeses = 0;
        $soma_obitosSeisMeses = 0;
        $soma_recuperadosSeisMeses = 0;
        
        foreach ($somaCasosSeisMeses as $soma) {
            $soma_casosSeisMeses += $soma->casos;
            $soma_obitosSeisMeses += $soma->obitos;
            $soma_recuperadosSeisMeses += $soma->recuperados;
           
            array_push($casosSeisMeses, $soma_casosSeisMeses);
            array_push($obitosSeisMeses, $soma_obitosSeisMeses);
            array_push($recuperadosSeisMeses, $soma_recuperadosSeisMeses);
            
            array_push($diaCasosSeisMeses, $soma->dia);
            array_push($casosDiariosSeisMeses,$soma->casos);
            array_push($obitosDiariosSeisMeses, $soma->obitos);
            //array_push($virusAtivoSeisMeses, $soma_casos - ($soma_recuperados + $soma_obitos));
        }

        $mediaMovelCasosSeisMeses = CasosController::calculaMediaMovel($casosDiariosSeisMeses);
        $mediaMovelObitosSeisMeses  = CasosController::calculaMediaMovel($obitosDiariosSeisMeses);


    // OCUPAÇÃO ÁREA COVID

        $dataInicialRegistroLeitos = DateTime::createFromFormat('d/m/Y', '13/01/2021');

        // error_log("dataInicialRegistroLeitos:" . date_format($dataInicialRegistroLeitos, 'Y-m-d'));
        $leitosPorData = CasosConfirmado::selectRaw('dia, leitos_clinicos_em_uso, leitos_uti_em_uso')
        ->whereDate('dia','>=', $dataInicialRegistroLeitos)->get();
        $somaLeitosPorDataUmMes = CasosConfirmado::selectRaw('dia, leitos_clinicos_em_uso, leitos_uti_em_uso')
        ->whereDay('dia', '>=', $dataInicialUmMes)->get();
        $somaLeitosPorDataTresMeses = CasosConfirmado::selectRaw('dia, leitos_clinicos_em_uso, leitos_uti_em_uso')
        ->whereDay('dia', '>=', $dataInicialTresMeses)->get();
        $somaLeitosPorDataSeisMeses = CasosConfirmado::selectRaw('dia, leitos_clinicos_em_uso, leitos_uti_em_uso')
        ->whereDay('dia', '>=', $dataInicialSeisMeses)->get();

        $datasLeitosTudo = [];
        $leitosClinicosTudo = [];
        $leitosUTITudo = [];

        foreach ($leitosPorData as $leitos) {
            array_push($datasLeitosTudo, $leitos->dia);
            array_push($leitosClinicosTudo, $leitos->leitos_clinicos_em_uso);
            array_push($leitosUTITudo, $leitos->leitos_uti_em_uso);
        }

    // INFORMAÇÕES GRÁFICOS CASOS POR SEXO -------------------------------------------------------------------------
    $somaCasosSexoUmMes = CasosConfirmado::selectRaw('SUM(masculino) as masculino, SUM(feminino) as feminino')
        ->whereDate('dia','>=', $dataInicialUmMes)
        ->get();
        $somaCasosSexo = CasosConfirmado::selectRaw('SUM(masculino) as masculino, SUM(feminino) as feminino')->get();
        
        $somaCasosSexoTresMeses = CasosConfirmado::selectRaw('SUM(masculino) as masculino, SUM(feminino) as feminino')
        ->whereDate('dia','>=', $dataInicialTresMeses)
        ->get();
        $somaCasosSexoSeisMeses = CasosConfirmado::selectRaw('SUM(masculino) as masculino, SUM(feminino) as feminino')
        ->whereDate('dia','>=', $dataInicialSeisMeses)
        ->get();

        $MasculinoTotal = $somaCasosSexo[0]->masculino;
        $FemininoTotal = $somaCasosSexo[0]->feminino;

        $MasculinoUmMes = $somaCasosSexoUmMes[0]->masculino;
        $FemininoUmMes = $somaCasosSexoUmMes[0]->feminino;

        $MasculinoTresMeses = $somaCasosSexoTresMeses[0]->masculino;
        $FemininoTresMeses = $somaCasosSexoTresMeses[0]->feminino;

        $MasculinoSeisMeses = $somaCasosSexoSeisMeses[0]->masculino;
        $FemininoSeisMeses = $somaCasosSexoSeisMeses[0]->feminino;
        

    // INFORMAÇÕES GRÁFICO POR ESCOLARIDADE ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        $somaEscolaridadeCasos = CasosConfirmado::selectRaw('SUM(analfabeto) as analfabeto, SUM(ensino_fundamental) as ensino_fundamental, SUM(ensino_medio) as ensino_medio, SUM(ensino_superior) as ensino_superior, SUM(escolaridade_nao_informada) as escolaridade_nao_informada, SUM(nao_aplicado) as nao_aplicado')->get();
        $somaEscolaridadeCasosUmMes = CasosConfirmado::selectRaw('SUM(analfabeto) as analfabeto, SUM(ensino_fundamental) as ensino_fundamental, SUM(ensino_medio) as ensino_medio, SUM(ensino_superior) as ensino_superior, SUM(escolaridade_nao_informada) as escolaridade_nao_informada, SUM(nao_aplicado) as nao_aplicado')
        ->whereDate('dia','>=', $dataInicialUmMes)
        ->get();
        $somaEscolaridadeCasosTresMeses = CasosConfirmado::selectRaw('SUM(analfabeto) as analfabeto, SUM(ensino_fundamental) as ensino_fundamental, SUM(ensino_medio) as ensino_medio, SUM(ensino_superior) as ensino_superior, SUM(escolaridade_nao_informada) as escolaridade_nao_informada, SUM(nao_aplicado) as nao_aplicado')
        ->whereDate('dia','>=', $dataInicialTresMeses)
        ->get();
        $somaEscolaridadeCasosSeisMeses = CasosConfirmado::selectRaw('SUM(analfabeto) as analfabeto, SUM(ensino_fundamental) as ensino_fundamental, SUM(ensino_medio) as ensino_medio, SUM(ensino_superior) as ensino_superior, SUM(escolaridade_nao_informada) as escolaridade_nao_informada, SUM(nao_aplicado) as nao_aplicado')
        ->whereDate('dia','>=', $dataInicialSeisMeses)
        ->get();
        
        //total
        $analfabetoTotal = $somaEscolaridadeCasos[0]->analfabeto;
        $fundamentalTotal = $somaEscolaridadeCasos[0]->ensino_fundamental;
        $medioTotal = $somaEscolaridadeCasos[0]->ensino_medio;
        $superiorTotal = $somaEscolaridadeCasos[0]->ensino_superior;
        $naoInformadaTotal = $somaEscolaridadeCasos[0]->escolaridade_nao_informada;
        $naoAplicadoTotal = $somaEscolaridadeCasos[0]->nao_aplicado;
        
        //1 mes
        $analfabetoUmMes = $somaEscolaridadeCasosUmMes[0]->analfabeto;
        $fundamentalUmMes = $somaEscolaridadeCasosUmMes[0]->ensino_fundamental;
        $medioUmMes = $somaEscolaridadeCasosUmMes[0]->ensino_medio;
        $superiorUmMes = $somaEscolaridadeCasosUmMes[0]->ensino_superior;
        $naoInformadaUmMes = $somaEscolaridadeCasosUmMes[0]->escolaridade_nao_informada;
        $naoAplicadoUmMes = $somaEscolaridadeCasosUmMes[0]->nao_aplicado;
        
        //3 meses
        $analfabetoTresMeses = $somaEscolaridadeCasosTresMeses[0]->analfabeto;
        $fundamentalTresMeses = $somaEscolaridadeCasosTresMeses[0]->ensino_fundamental;
        $medioTresMeses = $somaEscolaridadeCasosTresMeses[0]->ensino_medio;
        $superiorTresMeses = $somaEscolaridadeCasosTresMeses[0]->ensino_superior;
        $naoInformadaTresMeses = $somaEscolaridadeCasosTresMeses[0]->escolaridade_nao_informada;
        $naoAplicadoTresMeses = $somaEscolaridadeCasosTresMeses[0]->nao_aplicado;
        
        //6 meses
        $analfabetoSeisMeses = $somaEscolaridadeCasosSeisMeses[0]->analfabeto;
        $fundamentalSeisMeses = $somaEscolaridadeCasosSeisMeses[0]->ensino_fundamental;
        $medioSeisMeses = $somaEscolaridadeCasosSeisMeses[0]->ensino_medio;
        $superiorSeisMeses = $somaEscolaridadeCasosSeisMeses[0]->ensino_superior;
        $naoInformadaSeisMeses = $somaEscolaridadeCasosSeisMeses[0]->escolaridade_nao_informada;
        $naoAplicadoSeisMeses = $somaEscolaridadeCasosSeisMeses[0]->nao_aplicado;

    // INFORMAÇÕES GRÁFICO POR RAÇA ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        $SomaCasosRaca = CasosConfirmado::selectRaw('SUM(branca) as branca, SUM(parda) as parda, SUM(preta) as preta, SUM(amarela) as amarela, SUM(indigena) as indigena, SUM(cor_raca_nao_informada) as cor_raca_nao_informada')->get();
        $SomaCasosRacaUmMes = CasosConfirmado::selectRaw('SUM(branca) as branca, SUM(parda) as parda, SUM(preta) as preta, SUM(amarela) as amarela, SUM(indigena) as indigena, SUM(cor_raca_nao_informada) as cor_raca_nao_informada')
        ->whereDate('dia','>=', $dataInicialUmMes)
        ->get();
        $SomaCasosRacaTresMeses = CasosConfirmado::selectRaw('SUM(branca) as branca, SUM(parda) as parda, SUM(preta) as preta, SUM(amarela) as amarela, SUM(indigena) as indigena, SUM(cor_raca_nao_informada) as cor_raca_nao_informada')
        ->whereDate('dia','>=', $dataInicialTresMeses)
        ->get();
        $SomaCasosRacaSeisMeses = CasosConfirmado::selectRaw('SUM(branca) as branca, SUM(parda) as parda, SUM(preta) as preta, SUM(amarela) as amarela, SUM(indigena) as indigena, SUM(cor_raca_nao_informada) as cor_raca_nao_informada')
        ->whereDate('dia','>=', $dataInicialSeisMeses)
        ->get();
        
        //total
        $brancaTotal = $SomaCasosRaca[0]->branca;
        $pardaTotal = $SomaCasosRaca[0]->parda;
        $pretaTotal = $SomaCasosRaca[0]->preta;
        $amarelaTotal = $SomaCasosRaca[0]->amarela;
        $indigenaTotal = $SomaCasosRaca[0]->indigena;
        $naoInformadaTotal = $SomaCasosRaca[0]->cor_raca_nao_informada;
        
        //1 mes
        $brancaUmMes = $SomaCasosRacaUmMes[0]->branca;
        $pardaUmMes = $SomaCasosRacaUmMes[0]->parda;
        $pretaUmMes = $SomaCasosRacaUmMes[0]->preta;
        $amarelaUmMes = $SomaCasosRacaUmMes[0]->amarela;
        $indigenaUmMes = $SomaCasosRacaUmMes[0]->indigena;
        $naoInformadaUmMes = $SomaCasosRacaUmMes[0]->cor_raca_nao_informada;
        
        //3 meses
        $brancaTresMeses = $SomaCasosRacaTresMeses[0]->branca;
        $pardaTresMeses = $SomaCasosRacaTresMeses[0]->parda;
        $pretaTresMeses = $SomaCasosRacaTresMeses[0]->preta;
        $amarelaTresMeses = $SomaCasosRacaTresMeses[0]->amarela;
        $indigenaTresMeses = $SomaCasosRacaTresMeses[0]->indigena;
        $naoInformadaTresMeses = $SomaCasosRacaTresMeses[0]->cor_raca_nao_informada;
        
        //6 meses
        $brancaSeisMeses = $SomaCasosRacaSeisMeses[0]->branca;
        $pardaSeisMeses = $SomaCasosRacaSeisMeses[0]->parda;
        $pretaSeisMeses = $SomaCasosRacaSeisMeses[0]->preta;
        $amarelaSeisMeses = $SomaCasosRacaSeisMeses[0]->amarela;
        $indigenaSeisMeses = $SomaCasosRacaSeisMeses[0]->indigena;
        $naoInformadaSeisMeses = $SomaCasosRacaSeisMeses[0]->cor_raca_nao_informada;

    // INFORMAÇÕES GRAFICO POR BAIRRO ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        $casosBairrosTotal = DB::table('casos_confirmados_bairros')->groupBy('bairro_id')
        ->join('bairros', function ($join) {
            $join->on('bairros.id', '=', 'casos_confirmados_bairros.bairro_id');
        })
        ->selectRaw('SUM(casos) as casos, bairros.*')
        ->whereRaw('casos > 0')
        ->orderByRaw('casos DESC')
        ->get();
        $casosBairrosUmMes = DB::table('casos_confirmados_bairros')->groupBy('bairro_id')
        ->join('bairros', function ($join) {
            $join->on('bairros.id', '=', 'casos_confirmados_bairros.bairro_id');
        })
        ->selectRaw('SUM(casos) as casos, bairros.*')
        ->whereRaw('casos > 0')
        ->orderByRaw('casos DESC')
        ->whereDate('dia','>=', $dataInicialUmMes)
        ->get();
        $casosBairrosTresMeses = DB::table('casos_confirmados_bairros')->groupBy('bairro_id')
        ->join('bairros', function ($join) {
            $join->on('bairros.id', '=', 'casos_confirmados_bairros.bairro_id');
        })
        ->selectRaw('SUM(casos) as casos, bairros.*')
        ->whereRaw('casos > 0')
        ->orderByRaw('casos DESC')
        ->whereDate('dia','>=', $dataInicialTresMeses)
        ->get();
        $casosBairrosSeisMeses = DB::table('casos_confirmados_bairros')->groupBy('bairro_id')
        ->join('bairros', function ($join) {
            $join->on('bairros.id', '=', 'casos_confirmados_bairros.bairro_id');
        })
        ->selectRaw('SUM(casos) as casos, bairros.*')
        ->whereRaw('casos > 0')
        ->orderByRaw('casos DESC')
        ->whereDate('dia','>=', $dataInicialSeisMeses)
        ->get();

        //total
        $casosPorBairroTotal = [];
        $bairrosTotal = [];
        
        for ($i = 1; $i <= count($casosBairrosTotal); $i++){
            array_push($casosPorBairroTotal, $casosBairrosTotal[$i - 1]->casos);
            array_push($bairrosTotal, $casosBairrosTotal[$i - 1]->nome);
        }

        //1 mes
        $casosPorBairroUmMes = [];
        $bairrosUmMes = [];
        
        for ($i = 1; $i <= count($casosBairrosUmMes); $i++){
            array_push($casosPorBairroUmMes, $casosBairrosUmMes[$i - 1]->casos);
            array_push($bairrosUmMes, $casosBairrosUmMes[$i - 1]->nome);
        }

        //3 mes
        $casosPorBairroTresMeses = [];
        $bairrosTresMeses = [];
        
        for ($i = 1; $i <= count($casosBairrosTresMeses); $i++){
            array_push($casosPorBairroTresMeses, $casosBairrosTresMeses[$i - 1]->casos);
            array_push($bairrosTresMeses, $casosBairrosTresMeses[$i - 1]->nome);
        }

        //6 mes
        $casosPorBairroSeisMeses = [];
        $bairrosSeisMeses = [];
        
        for ($i = 1; $i <= count($casosBairrosSeisMeses); $i++){
            array_push($casosPorBairroSeisMeses, $casosBairrosSeisMeses[$i - 1]->casos);
            array_push($bairrosSeisMeses, $casosBairrosSeisMeses[$i - 1]->nome);
        }

    // INFORMAÇÕES GRAFICO POR FAIXA ETÁRIA --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        $casosFaixaEtariaTotal = CasosConfirmado::selectRaw('SUM(ate1ano) as ate1ano, SUM(de1a4anos) as de1a4anos, SUM(de5a9anos) as de5a9anos
            , SUM(de10a14anos) as de10a14anos, SUM(de15a19anos) as de15a19anos, SUM(de20a29anos) as de20a29anos, SUM(de30a39anos) as de30a39anos
            , SUM(de40a49anos) as de40a49anos, SUM(de50a59anos) as de50a59anos, SUM(de60a69anos) as de60a69anos, SUM(de70a79anos) as de70a79anos
            , SUM(de80oumais) as de80oumais')
        ->get();
        $casosFaixaEtariaUmMes = CasosConfirmado::selectRaw('SUM(ate1ano) as ate1ano, SUM(de1a4anos) as de1a4anos, SUM(de5a9anos) as de5a9anos
            , SUM(de10a14anos) as de10a14anos, SUM(de15a19anos) as de15a19anos, SUM(de20a29anos) as de20a29anos, SUM(de30a39anos) as de30a39anos
            , SUM(de40a49anos) as de40a49anos, SUM(de50a59anos) as de50a59anos, SUM(de60a69anos) as de60a69anos, SUM(de70a79anos) as de70a79anos
            , SUM(de80oumais) as de80oumais')
            ->whereDate('dia','>=', $dataInicialUmMes)
            ->get();
        $casosFaixaEtariaTresMeses = CasosConfirmado::selectRaw('SUM(ate1ano) as ate1ano, SUM(de1a4anos) as de1a4anos, SUM(de5a9anos) as de5a9anos
            , SUM(de10a14anos) as de10a14anos, SUM(de15a19anos) as de15a19anos, SUM(de20a29anos) as de20a29anos, SUM(de30a39anos) as de30a39anos
            , SUM(de40a49anos) as de40a49anos, SUM(de50a59anos) as de50a59anos, SUM(de60a69anos) as de60a69anos, SUM(de70a79anos) as de70a79anos
            , SUM(de80oumais) as de80oumais')
            ->whereDate('dia','>=', $dataInicialTresMeses)
            ->get();
        $casosFaixaEtariaSeisMeses = CasosConfirmado::selectRaw('SUM(ate1ano) as ate1ano, SUM(de1a4anos) as de1a4anos, SUM(de5a9anos) as de5a9anos
            , SUM(de10a14anos) as de10a14anos, SUM(de15a19anos) as de15a19anos, SUM(de20a29anos) as de20a29anos, SUM(de30a39anos) as de30a39anos
            , SUM(de40a49anos) as de40a49anos, SUM(de50a59anos) as de50a59anos, SUM(de60a69anos) as de60a69anos, SUM(de70a79anos) as de70a79anos
            , SUM(de80oumais) as de80oumais')
            ->whereDate('dia','>=', $dataInicialSeisMeses)
            ->get();

        //total
        $faixaEtariaTotal = [];
        foreach ($casosFaixaEtariaTotal as $item) {
            array_push($faixaEtariaTotal, $item->ate1ano);
            array_push($faixaEtariaTotal, $item->de1a4anos);
            array_push($faixaEtariaTotal, $item->de5a9anos);
            array_push($faixaEtariaTotal, $item->de10a14anos);
            array_push($faixaEtariaTotal, $item->de15a19anos);
            array_push($faixaEtariaTotal, $item->de20a29anos);
            array_push($faixaEtariaTotal, $item->de30a39anos);
            array_push($faixaEtariaTotal, $item->de40a49anos);
            array_push($faixaEtariaTotal, $item->de50a59anos);
            array_push($faixaEtariaTotal, $item->de60a69anos);
            array_push($faixaEtariaTotal, $item->de70a79anos);
            array_push($faixaEtariaTotal, $item->de80oumais);
        };
        
        //1 mes
        $faixaEtariaUmMes = [];
        foreach ($casosFaixaEtariaUmMes as $item) {
            array_push($faixaEtariaUmMes, $item->ate1ano);
            array_push($faixaEtariaUmMes, $item->de1a4anos);
            array_push($faixaEtariaUmMes, $item->de5a9anos);
            array_push($faixaEtariaUmMes, $item->de10a14anos);
            array_push($faixaEtariaUmMes, $item->de15a19anos);
            array_push($faixaEtariaUmMes, $item->de20a29anos);
            array_push($faixaEtariaUmMes, $item->de30a39anos);
            array_push($faixaEtariaUmMes, $item->de40a49anos);
            array_push($faixaEtariaUmMes, $item->de50a59anos);
            array_push($faixaEtariaUmMes, $item->de60a69anos);
            array_push($faixaEtariaUmMes, $item->de70a79anos);
            array_push($faixaEtariaUmMes, $item->de80oumais);
        };
        
        //3 meses
        $faixaEtariaTresMeses = [];
        foreach ($casosFaixaEtariaTresMeses as $item) {
            array_push($faixaEtariaTresMeses, $item->ate1ano);
            array_push($faixaEtariaTresMeses, $item->de1a4anos);
            array_push($faixaEtariaTresMeses, $item->de5a9anos);
            array_push($faixaEtariaTresMeses, $item->de10a14anos);
            array_push($faixaEtariaTresMeses, $item->de15a19anos);
            array_push($faixaEtariaTresMeses, $item->de20a29anos);
            array_push($faixaEtariaTresMeses, $item->de30a39anos);
            array_push($faixaEtariaTresMeses, $item->de40a49anos);
            array_push($faixaEtariaTresMeses, $item->de50a59anos);
            array_push($faixaEtariaTresMeses, $item->de60a69anos);
            array_push($faixaEtariaTresMeses, $item->de70a79anos);
            array_push($faixaEtariaTresMeses, $item->de80oumais);
        };

        //6 meses
        $faixaEtariaSeisMeses = [];
        foreach ($casosFaixaEtariaSeisMeses as $item) {
            array_push($faixaEtariaSeisMeses, $item->ate1ano);
            array_push($faixaEtariaSeisMeses, $item->de1a4anos);
            array_push($faixaEtariaSeisMeses, $item->de5a9anos);
            array_push($faixaEtariaSeisMeses, $item->de10a14anos);
            array_push($faixaEtariaSeisMeses, $item->de15a19anos);
            array_push($faixaEtariaSeisMeses, $item->de20a29anos);
            array_push($faixaEtariaSeisMeses, $item->de30a39anos);
            array_push($faixaEtariaSeisMeses, $item->de40a49anos);
            array_push($faixaEtariaSeisMeses, $item->de50a59anos);
            array_push($faixaEtariaSeisMeses, $item->de60a69anos);
            array_push($faixaEtariaSeisMeses, $item->de70a79anos);
            array_push($faixaEtariaSeisMeses, $item->de80oumais);
        };

        // Organizando Arrays Faixas Etartias por Ordem Descrencentes
        $faixaEtariaTotalDesc = $faixaEtariaTotal;
        rsort($faixaEtariaTotalDesc);

        $faixaEtariaUmMesDesc = $faixaEtariaUmMes;
        rsort($faixaEtariaUmMesDesc);

        $faixaEtariaTresMesesDesc = $faixaEtariaTresMeses;
        rsort($faixaEtariaTresMesesDesc);

        $faixaEtariaSeisMesesDesc = $faixaEtariaSeisMeses;
        rsort($faixaEtariaSeisMesesDesc);


        


      

        $obitosFaixaEtaria = ObitosFaixaEtaria::selectRaw('ate1ano, de1a4anos, de5a9anos
            , de10a14anos, de15a19anos, de20a29anos, de30a39anos
            , de40a49anos, de50a59anos, de60a69anos, de70a79anos, de80oumais')
        ->get()->first();

        
        error_log('obitosFaixaBanco: ' . $obitosFaixaEtaria);

        $obitosFaixa = [];
        

            array_push($obitosFaixa,  $obitosFaixaEtaria->ate1ano);
            array_push($obitosFaixa,  $obitosFaixaEtaria->de1a4anos);
            array_push($obitosFaixa,  $obitosFaixaEtaria->de5a9anos);
            array_push($obitosFaixa,  $obitosFaixaEtaria->de10a14anos);
            array_push($obitosFaixa,  $obitosFaixaEtaria->de15a19anos);
            array_push($obitosFaixa,  $obitosFaixaEtaria->de20a29anos);
            array_push($obitosFaixa,  $obitosFaixaEtaria->de30a39anos);
            array_push($obitosFaixa,  $obitosFaixaEtaria->de40a49anos);
            array_push($obitosFaixa,  $obitosFaixaEtaria->de50a59anos);
            array_push($obitosFaixa,  $obitosFaixaEtaria->de60a69anos);
            array_push($obitosFaixa,  $obitosFaixaEtaria->de70a79anos);
            array_push($obitosFaixa,  $obitosFaixaEtaria->de80oumais);
           
        
            $obitosTotais = array_sum($obitosFaixa) ;
        

        $obitosFaixaEtariaDesc = $obitosFaixa;
        rsort($obitosFaixaEtariaDesc);

        error_log('obitosFaixa: ' .  implode(",",$obitosFaixa));
        error_log('obitos totais: ' .  $obitosTotais );
        error_log('obitosFaixaDesc: ' .  implode(",",$obitosFaixaEtariaDesc));



@endphp
<script>
    // Variaveis Usadas em Mais de um Gráfico
    registroDatas = @json($diaCasos);
    casosTotais = @json($casosTotais);
    obitosTotais = @json($obitosTotais);
    casosTotaisSeisMeses = @json($casosTotaisSeisMeses);
    casosTotaisTresMeses = @json($casosTotaisTresMeses);
    casosTotaisUmMes = @json($casosTotaisUmMes);



    // GRAFICO COMPARATIVO CASOS E RECUPERADOS ------------------------------------------------------------------------------------------------------------------------------
       // casos = @json($casos);
      //  obitos = @json($obitos);
      //  recuperados = @json($recuperados);

        
        casosUmMes = @json($casosUmMes);
        recuperadosUmMes = @json($recuperadosUmMes);
        datasUmMes = @json($diaCasosUmMes);
        
        var pao = {
            chart: {
                height: 350,
                type: 'line',
                background: 'transparent',
                zoom: {
                    autoScaleYaxis: true,
                },
                locales: [{
                    'name': "br",
                    'options': {
                        "shortMonths": ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez"]
                    }
                }] ,
                defaultLocale: "br"  
            },
            series: [{
                name: 'Casos',
                data: casosUmMes
            }, {
                name: 'Recuperados',
                data: recuperadosUmMes
            }],
            xaxis: {
                type: "datetime",
                categories: datasUmMes,
                labels: {
                    datetimeFormatter:{
                        year: 'yyyy',
                        month: "MMM yyyy",
                        day: 'dd MMM',
                        hour: 'HH:mm',
                    },
                },
            },

            yAxes: {
      ticks: {
        beginAtZero: false,
        callback: function(value, index, values) {
          return value.toLocaleString();
        },
      },
      },

            theme: {
                mode: 'dark',
            },
            responsive: [{
                breakpoint: 478,
                options: {
                    chart: {
                        toolbar: {
                            show: false
                        }
                    }
                }
            }]
        }

        var chart = new ApexCharts(document.querySelector("#compCasosRecuperados"), pao);
        chart.render();

        // Reseta estilo 'active' dos Botões Comparativo
        var botoesComparativo = function(activeEl) {
            var els = document.querySelectorAll('.botaoComparativo')
            Array.prototype.forEach.call(els, function(el) {
                el.classList.remove('active')
            })

            activeEl.target.classList.add('active')
        }

        // Botão 1 Mes Grafico Comparativo
            $('#umMesComparativo').click(function(e) {
                botoesComparativo(e);
                chart.updateOptions(pao)
            })
        // Botão 3 Meses Grafico Comparativo
            $('#tresMesesComparativo').click(function(e) {
                botoesComparativo(e);

                casosTresMeses = @json($casosTresMeses);
                recuperadosTresMeses = @json($recuperadosTresMeses);
                                registroDatasTresMeses = @json($diaCasosTresMeses);
            
                var arr = {
                    series: [{
                        name: 'Casos',
                        data: casosTresMeses
                    }, {
                        name: 'Recuperados',
                        data: recuperadosTresMeses
                    }],
                    xaxis: {
                        type: "datetime",
                        categories: registroDatasTresMeses,
                        labels: {
                            datetimeFormatter:{
                                year: 'yyyy',
                                month: "MMM yyyy",
                                day: 'dd MMM',
                                hour: 'HH:mm',
                            },
                        },
                    }
                }
                chart.updateOptions(arr);
            })
        // Botão 6 Meses Grafico Comparativo
            $('#seisMesesComparativo').click(function(e) {
                botoesComparativo(e);

                casosSeisMeses = @json($casosSeisMeses);
                recuperadosSeisMeses = @json($recuperadosSeisMeses);
                registroDatasSeisMeses = @json($diaCasosSeisMeses);

                var arr = {
                    series: [{
                        name: 'Casos',
                        data: casosSeisMeses
                    }, {
                        name: 'Recuperados',
                        data: recuperadosSeisMeses
                    }],
                    xaxis: {
                        type: "datetime",
                        categories: registroDatasSeisMeses,
                        labels: {
                            datetimeFormatter:{
                                year: 'yyyy',
                                month: "MMM yyyy",
                                day: 'dd MMM',
                                hour: 'HH:mm',
                            },
                        },
                    }
                }
                chart.updateOptions(arr);
            })
        // Botão Tudo Grafico Comparativo
            $('#tudoComparativo').click(function(e) {
                botoesComparativo(e);
                
                
                casosTudo = @json($casos);
                recuperadosTudo= @json($recuperados);
                datasTudo = @json($diaCasos);

                var arr = {
                    series: [{
                        name: 'Casos',
                        data: casosTudo
                    }, {
                        name: 'Recuperados',
                        data: recuperadosTudo
                    }],
                    xaxis: {
                        type: "datetime",
                        categories: datasTudo,
                        labels: {
                            datetimeFormatter:{
                                year: 'yyyy',
                                month: "MMM yyyy",
                                day: 'dd MMM',
                                hour: 'HH:mm',
                            },
                        },
                    }
                }
                chart.updateOptions(arr);

            })



  // GRAFICO LEITOS POR DATA

  leitosClinicosTudo = @json($leitosClinicosTudo);
        leitosUTITudo = @json($leitosUTITudo);
        datasLeitosTudo = @json($datasLeitosTudo);
        
        var graficoLeitosOpcoes = {
            chart: {
                height: 350,
                type: 'line',
                background: 'transparent',
                zoom: {
                    autoScaleYaxis: true,
                },
                locales: [{
                    'name': "br",
                    'options': {
                        "shortMonths": ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez"]
                    }
                }] ,
                defaultLocale: "br"  
            },
            series: [{
                name: 'Leitos Clínicos',
                data: leitosClinicosTudo
            }, {
                name: 'Leitos UTI',
                data: leitosUTITudo
            }],
            xaxis: {
                type: "datetime",
                categories: datasLeitosTudo,
                labels: {
                    datetimeFormatter:{
                        year: 'yyyy',
                        month: "MMM yyyy",
                        day: 'dd MMM',
                        hour: 'HH:mm',
                    },
                },
            },

            yAxes: {
      ticks: {
        beginAtZero: false,
        callback: function(value, index, values) {
          return value.toLocaleString();
        },
      },
      },

            theme: {
                mode: 'dark',
            },
            responsive: [{
                breakpoint: 478,
                options: {
                    chart: {
                        toolbar: {
                            show: false
                        }
                    }
                }
            }]
        }

        var graficosLeitosPorData = new ApexCharts(document.querySelector("#leitosPorData"), graficoLeitosOpcoes);
        graficosLeitosPorData.render();

        // Reseta estilo 'active' dos Botões Comparativo
        // var botoesComparativo = function(activeEl) {
        //     var els = document.querySelectorAll('.botaoComparativo')
        //     Array.prototype.forEach.call(els, function(el) {
        //         el.classList.remove('active')
        //     })

        //     activeEl.target.classList.add('active')
        // }

        // // Botão 1 Mes Grafico Comparativo
        //     $('#umMesComparativo').click(function(e) {
        //         botoesComparativo(e);
        //         chart.updateOptions(pao)
        //     })
        // // Botão 3 Meses Grafico Comparativo
        //     $('#tresMesesComparativo').click(function(e) {
        //         botoesComparativo(e);

        //         casosTresMeses = @json($casosTresMeses);
        //         recuperadosTresMeses = @json($recuperadosTresMeses);
        //                         registroDatasTresMeses = @json($diaCasosTresMeses);
            
        //         var arr = {
        //             series: [{
        //                 name: 'Casos',
        //                 data: casosTresMeses
        //             }, {
        //                 name: 'Recuperados',
        //                 data: recuperadosTresMeses
        //             }],
        //             xaxis: {
        //                 type: "datetime",
        //                 categories: registroDatasTresMeses,
        //                 labels: {
        //                     datetimeFormatter:{
        //                         year: 'yyyy',
        //                         month: "MMM yyyy",
        //                         day: 'dd MMM',
        //                         hour: 'HH:mm',
        //                     },
        //                 },
        //             }
        //         }
        //         chart.updateOptions(arr);
        //     })
        // // Botão 6 Meses Grafico Comparativo
        //     $('#seisMesesComparativo').click(function(e) {
        //         botoesComparativo(e);

        //         casosSeisMeses = @json($casosSeisMeses);
        //         recuperadosSeisMeses = @json($recuperadosSeisMeses);
        //         registroDatasSeisMeses = @json($diaCasosSeisMeses);

        //         var arr = {
        //             series: [{
        //                 name: 'Casos',
        //                 data: casosSeisMeses
        //             }, {
        //                 name: 'Recuperados',
        //                 data: recuperadosSeisMeses
        //             }],
        //             xaxis: {
        //                 type: "datetime",
        //                 categories: registroDatasSeisMeses,
        //                 labels: {
        //                     datetimeFormatter:{
        //                         year: 'yyyy',
        //                         month: "MMM yyyy",
        //                         day: 'dd MMM',
        //                         hour: 'HH:mm',
        //                     },
        //                 },
        //             }
        //         }
        //         chart.updateOptions(arr);
        //     })
        // // Botão Tudo Grafico Comparativo
        //     $('#tudoComparativo').click(function(e) {
        //         botoesComparativo(e);
                
                
        //         casosTudo = @json($casos);
        //         recuperadosTudo= @json($recuperados);
        //         datasTudo = @json($diaCasos);

        //         var arr = {
        //             series: [{
        //                 name: 'Casos',
        //                 data: casosTudo
        //             }, {
        //                 name: 'Recuperados',
        //                 data: recuperadosTudo
        //             }],
        //             xaxis: {
        //                 type: "datetime",
        //                 categories: datasTudo,
        //                 labels: {
        //                     datetimeFormatter:{
        //                         year: 'yyyy',
        //                         month: "MMM yyyy",
        //                         day: 'dd MMM',
        //                         hour: 'HH:mm',
        //                     },
        //                 },
        //             }
        //         }
        //         chart.updateOptions(arr);

        //     })


  // GRAFICO COMPARATIVO VIRUS ATIVO E OBITOS-----------------------------------------------------------------------------------------------------------------------------
     

        
      
        obitosUmMes = @json($obitosUmMes);
        datasUmMes= @json($diaCasosUmMes);
        virusAtivoUmMes = @json($virusAtivoUmMes);
        
        var opcoesAtivoObitos = {
            chart: {
                height: 350,
                type: 'line',
                background: 'transparent',
                zoom: {
                    autoScaleYaxis: true,
                },
                locales: [{
                    'name': "br",
                    'options': {
                        "shortMonths": ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez"]
                    }
                }] ,
                defaultLocale: "br"  
            },
            series: [{
                name: 'Óbitos',
                data: obitosUmMes
            },
            {
                name: 'Vírus Ativo',
                data: virusAtivoUmMes
            }
           ],
            xaxis: {
                type: "datetime",
                categories: datasUmMes,
                labels: {
                    datetimeFormatter:{
                        year: 'yyyy',
                        month: "MMM yyyy",
                        day: 'dd MMM',
                        hour: 'HH:mm',
                    },
                },
            },

            yAxes: {
      ticks: {
        beginAtZero: false,
        callback: function(value, index, values) {
          return value.toLocaleString();
        },
      },
      },

            theme: {
                mode: 'dark',
            },
            responsive: [{
                breakpoint: 478,
                options: {
                    chart: {
                        toolbar: {
                            show: false
                        }
                    }
                }
            }]
        }

        var graficoAtivoObitos = new ApexCharts(document.querySelector("#compAtivosObitos"), opcoesAtivoObitos);
        graficoAtivoObitos.render();

        // Reseta estilo 'active' dos Botões Comparativo
        var botoesComparativoAtivoObitos = function(activeEl) {
            var els = document.querySelectorAll('.botaoComparativoAtivoObitos')
            Array.prototype.forEach.call(els, function(el) {
                el.classList.remove('active')
            })

            activeEl.target.classList.add('active')
        }

        // Botão 1 Mes Grafico Comparativo
            $('#umMesComparativoAtivoObitos').click(function(e) {
                botoesComparativoAtivoObitos(e);
                graficoAtivoObitos.updateOptions(opcoesAtivoObitos)
            })
        // Botão 3 Meses Grafico Comparativo
            $('#tresMesesComparativoAtivoObitos').click(function(e) {
                botoesComparativoAtivoObitos(e);

                obitosTresMeses = @json($obitosTresMeses);
                datasTresMeses = @json($diaCasosTresMeses);
                virusAtivoTresMeses = @json($virusAtivoTresMeses);
            
                var arr = {
                    series: [{
                        name: 'Óbitos',
                        data: obitosTresMeses
                    },{
                        name: 'Vírus Ativo',
                        data: virusAtivoTresMeses
                    }],
                    xaxis: {
                        type: "datetime",
                        categories: datasTresMeses,
                        labels: {
                            datetimeFormatter:{
                                year: 'yyyy',
                                month: "MMM yyyy",
                                day: 'dd MMM',
                                hour: 'HH:mm',
                            },
                        },
                    }
                }
                graficoAtivoObitos.updateOptions(arr);
            })
        // Botão 6 Meses Grafico Comparativo
            $('#seisMesesComparativoAtivoObitos').click(function(e) {
                botoesComparativoAtivoObitos(e);

                obitosSeisMeses = @json($obitosSeisMeses);
                datasSeisMeses = @json($diaCasosSeisMeses);
                virusAtivoSeisMeses = @json($virusAtivoSeisMeses);

                var arr = {
                    series: [{
                        name: 'Óbitos',
                        data: obitosSeisMeses
                    },{
                        name: 'Vírus Ativo',
                        data: virusAtivoSeisMeses
                    }],
                    xaxis: {
                        type: "datetime",
                        categories: datasSeisMeses,
                        labels: {
                            datetimeFormatter:{
                                year: 'yyyy',
                                month: "MMM yyyy",
                                day: 'dd MMM',
                                hour: 'HH:mm',
                            },
                        },
                    }
                }
                graficoAtivoObitos.updateOptions(arr);
            })
        // Botão Tudo Grafico Comparativo
            $('#tudoComparativoAtivoObitos').click(function(e) {
                botoesComparativoAtivoObitos(e);
                
                
                obitosTudo = @json($obitos);
                datasTudo = @json($diaCasos);
                virusAtivoTudo = @json($virusAtivoTudo);

                var arr = {
                    series: [{
                        name: 'Óbitos',
                        data: obitosTudo
                    }, {
                name: 'Vírus Ativo',
                data: virusAtivoTudo
                }],
                    xaxis: {
                        type: "datetime",
                        categories: datasTudo,
                        labels: {
                            datetimeFormatter:{
                                year: 'yyyy',
                                month: "MMM yyyy",
                                day: 'dd MMM',
                                hour: 'HH:mm',
                            },
                        },
                    }
                }
                graficoAtivoObitos.updateOptions(arr);

            })

    // GRAFICO CASOS POR DATA --------------------------------------------------------------------------------------------------------------------------------------------------------------
    umMes = @json($casosDiariosUmMes);
                datasUmMes = @json($diaCasosUmMes );
               mediaMovelUmMes = @json($mediaMovelCasosUmMes);

        var optionsData = {
            chart: {
                type: 'line',
                height: 350,
                background: 'transparent',
                zoom: {
                    autoScaleYaxis: true,
                },
                locales: [{
                    'name': "pt",
                    'options': {
                        "shortMonths": ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez"]
                    }
                }] ,
                defaultLocale: "pt" 
            },
            series: [{
                type: 'column',
                name: 'Casos',
                data: umMes
            },{
                type: 'line',
                name: 'Média móvel (7 dias)',
                data: mediaMovelUmMes 

            }
            
            ],


            xaxis: {
                type: "datetime",
                categories: datasUmMes,
                labels: {
                    datetimeFormatter:{
                        year: 'yyyy',
                        month: "MMM 'yy",
                        day: 'dd MMM',
                        hour: 'HH:mm',
                    },
                },
            },
           
            theme: {
                mode: 'dark',
            },
        }

        var graficoCasosPorData = new ApexCharts(document.querySelector("#casosPorData"), optionsData);
        graficoCasosPorData.render();

        // Reseta estilo 'active' dos Botões Casos Por Data
        var botoesCasosPorData = function(activeEl) {
            var els = document.querySelectorAll('.botaoCasosData')
            Array.prototype.forEach.call(els, function(el) {
                el.classList.remove('active')
            })

            activeEl.target.classList.add('active')
        }

        // Botão 1 Mês Grafico Por Data
            $('#mesPorData').click(function(e) {
                botoesCasosPorData(e)
            graficoCasosPorData.updateOptions(optionsData);
            })

        // Botão 3 Meses Grafico Por Data
            $('#tresMesesPorData').click(function(e) {
                botoesCasosPorData(e)

                tresMeses = @json($casosDiariosTresMeses);

            datasTresMeses = @json($diaCasosTresMeses );

            mediaMovelTresMeses = @json($mediaMovelCasosTresMeses);

/*graficoCasosPorData.zoomX(
    new Date(umMes[0]).getTime(),
    new Date(umMes[umMes.length - 1]).getTime()
    // new Date('30 Apr 2020').getTime()
)*/
            var optionsData = {
                series: [{
             type: 'column',
            name: 'Casos',
            data: tresMeses
                },
    
                 {
            type: 'line',
            name: 'Média móvel (7 dias)',
            data: mediaMovelTresMeses 

                }
                ],
            xaxis: {
            type: "datetime",
            categories: datasTresMeses,
            labels: {
    datetimeFormatter:{
        year: 'yyyy',
        month: "MMM 'yy",
        day: 'dd MMM',
        hour: 'HH:mm',
            },
        },
        }
        }
        graficoCasosPorData.updateOptions(optionsData);
            })

        // Botão 6 Meses Grafico Por Data
            $('#seisMesesPorData').click(function(e) {
                botoesCasosPorData(e)

                seisMeses = @json($casosDiariosSeisMeses);

                datasSeisMeses = @json($diaCasosSeisMeses );

                mediaMovelSeisMeses = @json($mediaMovelCasosSeisMeses);

            /*graficoCasosPorData.zoomX(
            new Date(umMes[0]).getTime(),
            new Date(umMes[umMes.length - 1]).getTime()
            // new Date('30 Apr 2020').getTime()
            )*/
            var optionsData = {
                series: [{
            type: 'column',
            name: 'Casos',
            data: seisMeses
                },

                {
            type: 'line',
            name: 'Média móvel (7 dias)',
            data: mediaMovelSeisMeses 

                }
                ],
            xaxis: {
            type: "datetime",
            categories: datasSeisMeses,
            labels: {
            datetimeFormatter:{
            year: 'yyyy',
            month: "MMM 'yy",
            day: 'dd MMM',
            hour: 'HH:mm',
            },
            },
            }
            }
            graficoCasosPorData.updateOptions(optionsData);
            })
        // Botão Tudo Grafico Por Data
            $('#tudoPorData').click(function(e) {
                botoesCasosPorData(e)

               
               casosDiariosTudo = @json($casosDiariosTudo);
                mediaMovelTudo = @json($mediaMovelCasosTudo);
                datasTudo = @json($diaCasos);
            

              
                var optionsData = {
                series: [{
                type: 'column',
                name: 'Casos',
                data: casosDiariosTudo
                    },
                    
                    {
                type: 'line',
                name: 'Média móvel (7 dias)',
                data: mediaMovelTudo 

            }
            ],
                xaxis: {
                type: "datetime",
                categories: datasTudo,
                labels: {
                    datetimeFormatter:{
                        year: 'yyyy',
                        month: "MMM 'yy",
                        day: 'dd MMM',
                        hour: 'HH:mm',
                    },
                },
                }
                }
            graficoCasosPorData.updateOptions(optionsData);
                
            })



     // GRAFICO OBITOS POR DATA --------------------------------------------------------------------------------------------------------------------------------------------------------------
     obitosUmMes = @json($obitosDiariosUmMes);
                datasUmMes = @json($diaCasosUmMes );
               mediaMovelObitosUmMes = @json($mediaMovelObitosUmMes);

        var graficoObitosOpcoes = {
            chart: {
                type: 'line',
                height: 350,
                background: 'transparent',
                zoom: {
                    autoScaleYaxis: true,
                },
                locales: [{
                    'name': "pt",
                    'options': {
                        "shortMonths": ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez"]
                    }
                }] ,
                defaultLocale: "pt" 
            },
            series: [{
                type: 'column',
                name: 'Óbitos',
                data: obitosUmMes
            },{
                type: 'line',
                name: 'Média móvel (7 dias)',
                data: mediaMovelObitosUmMes 

            }
            
            ],


            xaxis: {
                type: "datetime",
                categories: datasUmMes,
                labels: {
                    datetimeFormatter:{
                        year: 'yyyy',
                        month: "MMM 'yy",
                        day: 'dd MMM',
                        hour: 'HH:mm',
                    },
                },
            },
           
            theme: {
                mode: 'dark',
            },
        }

        var graficoObitosPorData = new ApexCharts(document.querySelector("#obitosPorData"), graficoObitosOpcoes);
        graficoObitosPorData.render();

        // Reseta estilo 'active' dos Botões Casos Por Data
        var botoesObitosPorData = function(activeEl) {
            var els = document.querySelectorAll('.botaoObitosData')
            Array.prototype.forEach.call(els, function(el) {
                el.classList.remove('active')
            })

            activeEl.target.classList.add('active')
        }

        // Botão 1 Mês Grafico Por Data
            $('#umMesObitosPorData').click(function(e) {
                botoesObitosPorData(e)
            graficoObitosPorData.updateOptions(graficoObitosOpcoes);
            })

        // Botão 3 Meses Grafico Por Data
            $('#tresMesesObitosPorData').click(function(e) {
                botoesObitosPorData(e)

                obitosTresMeses = @json($obitosDiariosTresMeses);

            datasTresMeses = @json($diaCasosTresMeses );

            mediaMovelObitosTresMeses = @json($mediaMovelObitosTresMeses);

/*graficoCasosPorData.zoomX(
    new Date(umMes[0]).getTime(),
    new Date(umMes[umMes.length - 1]).getTime()
    // new Date('30 Apr 2020').getTime()
)*/
            var graficoObitosOpcoes = {
                series: [{
             type: 'column',
            name: 'Óbitos',
            data: obitosTresMeses
                },
    
                 {
            type: 'line',
            name: 'Média móvel (7 dias)',
            data: mediaMovelObitosTresMeses 

                }
                ],
            xaxis: {
            type: "datetime",
            categories: datasTresMeses,
            labels: {
    datetimeFormatter:{
        year: 'yyyy',
        month: "MMM 'yy",
        day: 'dd MMM',
        hour: 'HH:mm',
            },
        },
        }
        }
        graficoObitosPorData.updateOptions(graficoObitosOpcoes);
            })

        // Botão 6 Meses Grafico Por Data
            $('#seisMesesObitosPorData').click(function(e) {
                botoesObitosPorData(e)

                obitosSeisMeses = @json($obitosDiariosSeisMeses);

                datasSeisMeses = @json($diaCasosSeisMeses );

                mediaMovelObitosSeisMeses = @json($mediaMovelObitosSeisMeses);

            /*graficoCasosPorData.zoomX(
            new Date(umMes[0]).getTime(),
            new Date(umMes[umMes.length - 1]).getTime()
            // new Date('30 Apr 2020').getTime()
            )*/
            var graficoObitosOpcoes = {
                series: [{
            type: 'column',
            name: 'Óbitos',
            data: obitosSeisMeses
                },

                {
            type: 'line',
            name: 'Média móvel (7 dias)',
            data: mediaMovelObitosSeisMeses 

                }
                ],
            xaxis: {
            type: "datetime",
            categories: datasSeisMeses,
            labels: {
            datetimeFormatter:{
            year: 'yyyy',
            month: "MMM 'yy",
            day: 'dd MMM',
            hour: 'HH:mm',
            },
            },
            }
            }
            graficoObitosPorData.updateOptions(graficoObitosOpcoes);
            })
        // Botão Tudo Grafico Por Data
            $('#tudoObitosPorData').click(function(e) {
                botoesObitosPorData(e)

               
               obitosTudo = @json($obitosDiariosTudo);
                mediaMoveObitosTudo = @json($mediaMovelObitosTudo);
                datasTudo = @json($diaCasos);
            

              
                var graficoObitosOpcoes = {
                series: [{
                type: 'column',
                name: 'Óbitos',
                data: obitosTudo
                    },
                    
                    {
                type: 'line',
                name: 'Média móvel (7 dias)',
                data: mediaMoveObitosTudo 

            }
            ],
                xaxis: {
                type: "datetime",
                categories: datasTudo,
                labels: {
                    datetimeFormatter:{
                        year: 'yyyy',
                        month: "MMM 'yy",
                        day: 'dd MMM',
                        hour: 'HH:mm',
                    },
                },
                }
                }
            graficoObitosPorData.updateOptions(graficoObitosOpcoes);
                
            })

    // GRAFICO CASOS POR SEXO -------------------------------------------------------------------------------------------------------------------------
    MasculinoUmMes = @json($MasculinoUmMes);
    FemininoUmMes = @json($FemininoUmMes);
        
                
        var m = parseInt(MasculinoUmMes);
        var f = parseInt(FemininoUmMes);

        var casosPorSexo = {
            chart: {
                height: 210,
                width: '95%',
                background: 'transparent',
                type: 'pie',
            },
            series: [m,f],
            labels: ['Masculino', 'Feminino'],
            responsive: [{
                breakpoint: 478,
                options: {
                    chart: {
                        width: '100%',
                        height: 230
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }],
            colors: ['#0288d1', '#d32f2f'],
            theme: {
                mode: 'dark',
            },
            
        };
        
        var graficoCasosPorSexo = new ApexCharts(document.querySelector("#casosPorSexo"), casosPorSexo);
        graficoCasosPorSexo.render();

        // Reseta estilo 'active' dos Botões Casos Por Sexo
        var botoesSexo = function(activeEl) {
            var els = document.querySelectorAll('.botaoSexo')
            Array.prototype.forEach.call(els, function(el) {
                el.classList.remove('active')
            })

            activeEl.target.classList.add('active')
        }

        // Filtro Casos por Sexo
            $('#seisMesesSexo').click(function(e) {
                botoesSexo(e);
                MasculinoSeisMeses = parseInt(@json($MasculinoSeisMeses));
                FemininoSeisMeses = parseInt(@json($FemininoSeisMeses));
                var arr = [MasculinoSeisMeses, FemininoSeisMeses];
                graficoCasosPorSexo.updateSeries(arr);
            })

            $('#tresMesesSexo').click(function(e) {
                botoesSexo(e);
                MasculinoTresMeses = parseInt(@json($MasculinoTresMeses));
                FemininoTresMeses = parseInt(@json($FemininoTresMeses));
                var arr = [MasculinoTresMeses, FemininoTresMeses];
                graficoCasosPorSexo.updateSeries(arr);
            })
            
            $('#umMesSexo').click(function(e) {
                botoesSexo(e);
                

                graficoCasosPorSexo.updateSeries(casosPorSexo.series);
            })

            $('#tudoSexo').click(function(e) {
                botoesSexo(e);
                MasculinoTotal = parseInt(@json($MasculinoTotal));
                FemininoTotal = parseInt(@json($FemininoTotal));
                
                var arr = [MasculinoTotal, FemininoTotal];
                graficoCasosPorSexo.updateSeries(arr);
        
            })

    
    // GRAFICO CASOS POR ESCOLARIDADE ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    analfabetoUmMes = parseInt(@json($analfabetoUmMes));
    fundamentalUmMes = parseInt(@json($fundamentalUmMes));
    medioUmMes = parseInt(@json($medioUmMes));
    superiorUmMes = parseInt(@json($superiorUmMes));
    naoInformadaUmMes = parseInt(@json($naoInformadaUmMes));
    naoAplicadoUmMes = parseInt(@json($naoAplicadoUmMes));

        var casosPorEscolaridade = {
            chart: {
                height: 210,
                width: '100%',
                background: 'transparent',
                type: 'pie',
            },
            series: [analfabetoUmMes, fundamentalUmMes, medioUmMes, superiorUmMes, naoInformadaUmMes, naoAplicadoUmMes],
            labels: ['Analfabeto', 'Ensino Fundamental','Ensino Médio', 'Ensino Superior', 'Não Informada', 'Não Aplicado'],
            responsive: [{
                breakpoint: 478,
                options: {
                    chart: {
                        width: '100%',
                        height: 270,
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }],
            colors: ['#0288d1', '#d32f2f', '#f57c00', '#fbc02d', '#388e3c', '#512da8'],
            theme: {
                mode: 'dark',
            },
            
        };

        var graficoCasosPorEscolaridade = new ApexCharts(document.querySelector("#casosPorEscolaridade"), casosPorEscolaridade);
        graficoCasosPorEscolaridade.render();

        // Reseta estilo 'active' dos Botões Casos Por Escolaridade
        var botoesEscolaridade = function(activeEl) {
            var els = document.querySelectorAll('.botaoEscolaridade')
            Array.prototype.forEach.call(els, function(el) {
                el.classList.remove('active')
            })

            activeEl.target.classList.add('active')
        }

        // Filtro Casos por Escolaridade
            $('#seisMesesEscolaridade').click(function(e) {
                botoesEscolaridade(e);

                analfabetoSeisMeses = parseInt(@json($analfabetoSeisMeses));
                fundamentalSeisMeses = parseInt(@json($fundamentalSeisMeses));
                medioSeisMeses = parseInt(@json($medioSeisMeses));
                superiorSeisMeses = parseInt(@json($superiorSeisMeses));
                naoInformadaSeisMeses = parseInt(@json($naoInformadaSeisMeses));
                naoAplicadoSeisMeses = parseInt(@json($naoAplicadoSeisMeses));

                var arr = [analfabetoSeisMeses, fundamentalSeisMeses, medioSeisMeses, superiorSeisMeses, naoInformadaSeisMeses, naoAplicadoSeisMeses];
                graficoCasosPorEscolaridade.updateSeries(arr);
            })

            $('#tresMesesEscolaridade').click(function(e) {
                botoesEscolaridade(e);

                analfabetoTresMeses = parseInt(@json($analfabetoTresMeses));
                fundamentalTresMeses = parseInt(@json($fundamentalTresMeses));
                medioTresMeses = parseInt(@json($medioTresMeses));
                superiorTresMeses = parseInt(@json($superiorTresMeses));
                naoInformadaTresMeses = parseInt(@json($naoInformadaTresMeses));
                naoAplicadoTresMeses = parseInt(@json($naoAplicadoTresMeses));

                var arr = [analfabetoTresMeses, fundamentalTresMeses, medioTresMeses, superiorTresMeses, naoInformadaTresMeses, naoAplicadoTresMeses];
                graficoCasosPorEscolaridade.updateSeries(arr);
            })

            $('#umMesEscolaridade').click(function(e) {
                botoesEscolaridade(e);

                

                graficoCasosPorEscolaridade.updateSeries(casosPorEscolaridade.series);
            })
            
            $('#tudoEscolaridade').click(function(e) {
                botoesEscolaridade(e);
                analfabetoTotal = parseInt(@json($analfabetoTotal));
                fundamentalTotal = parseInt(@json($fundamentalTotal));
                medioTotal = parseInt(@json($medioTotal));
                superiorTotal = parseInt(@json($superiorTotal));
                naoInformadaTotal = parseInt(@json($naoInformadaTotal));
                naoAplicadoTotal = parseInt(@json($naoAplicadoTotal));

                var arr = [analfabetoTotal, fundamentalTotal, medioTotal, superiorTotal, naoInformadaTotal, naoAplicadoTotal];
                graficoCasosPorEscolaridade.updateSeries(arr);

               
            })
    
    // GRAFICO CASOS POR RAÇA -----------------------------------------------------------------------------------------------------------------------------------------------------------------------------
                brancaUmMes = parseInt(@json($brancaUmMes));
                pardaUmMes = parseInt(@json($pardaUmMes));
                pretaUmMes = parseInt(@json($pretaUmMes));
                amarelaUmMes = parseInt(@json($amarelaUmMes));
                indigenaUmMes = parseInt(@json($indigenaUmMes));
                naoInformadaUmMes = parseInt(@json($naoInformadaUmMes));

        var casosPorRaca = {
            chart: {
                height: 210,
                width: '100%',
                background: 'transparent',
                type: 'pie',
            },
            series: [brancaUmMes, pardaUmMes, pretaUmMes, amarelaUmMes, indigenaUmMes, naoInformadaUmMes],
            labels: ['Branca', 'Parda','Preta', 'Amarela', 'Indígena', 'Não Informada'],
            responsive: [{
                breakpoint: 478,
                options: {
                    chart: {
                        width: '100%',
                        height: 250,
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }],
            colors: ['#0288d1', '#d32f2f', '#f57c00', '#fbc02d', '#388e3c', '#512da8'],
            theme: {
                mode: 'dark',
            },
            
        };

        var graficoCasosPorRaca = new ApexCharts(document.querySelector("#casosPorRaca"), casosPorRaca);
        graficoCasosPorRaca.render();

        // Reseta estilo 'active' dos Botões Casos Por Raca
        var botoesRaca = function(activeEl) {
            var els = document.querySelectorAll('.botaoRaca')
            Array.prototype.forEach.call(els, function(el) {
                el.classList.remove('active')
            })

            activeEl.target.classList.add('active')
        }

        // Filtro Casos por Raca
            $('#seisMesesRaca').click(function(e) {
                botoesRaca(e);
                brancaSeisMeses = parseInt(@json($brancaSeisMeses));
                pardaSeisMeses = parseInt(@json($pardaSeisMeses));
                pretaSeisMeses = parseInt(@json($pretaSeisMeses));
                amarelaSeisMeses = parseInt(@json($amarelaSeisMeses));
                indigenaSeisMeses = parseInt(@json($indigenaSeisMeses));
                naoInformadaSeisMeses = parseInt(@json($naoInformadaSeisMeses));

                var arr = [brancaSeisMeses, pardaSeisMeses, pretaSeisMeses, amarelaSeisMeses, indigenaSeisMeses, naoInformadaSeisMeses];
                graficoCasosPorRaca.updateSeries(arr);
            })

            $('#tresMesesRaca').click(function(e) {
                botoesRaca(e);
                brancaTresMeses = parseInt(@json($brancaTresMeses));
                pardaTresMeses = parseInt(@json($pardaTresMeses));
                pretaTresMeses = parseInt(@json($pretaTresMeses));
                amarelaTresMeses = parseInt(@json($amarelaTresMeses));
                indigenaTresMeses = parseInt(@json($indigenaTresMeses));
                naoInformadaTresMeses = parseInt(@json($naoInformadaTresMeses));

                var arr = [brancaTresMeses, pardaTresMeses, pretaTresMeses, amarelaTresMeses, indigenaTresMeses, naoInformadaTresMeses];
                graficoCasosPorRaca.updateSeries(arr);
            })

            $('#umMesRaca').click(function(e) {
                botoesRaca(e); 
                graficoCasosPorRaca.updateSeries(casosPorRaca.series); 
            })
            
            $('#tudoRaca').click(function(e) {
                botoesRaca(e);
                brancaTotal = parseInt(@json($brancaTotal));
                pardaTotal = parseInt(@json($pardaTotal));
                pretaTotal = parseInt(@json($pretaTotal));
                amarelaTotal = parseInt(@json($amarelaTotal));
                indigenaTotal = parseInt(@json($indigenaTotal));
                NaoInformadaTotal = parseInt(@json($naoInformadaTotal));

                var arr = [brancaTotal, pardaTotal, pretaTotal, amarelaTotal, indigenaTotal, NaoInformadaTotal];
                graficoCasosPorRaca.updateSeries(arr);
               
            })

    
    // GRAFICO CASOS POR BAIRRO ---------------------------------------------------------------------------------------------------------------------------------------------------
            casosPorBairroUmMes = @json($casosPorBairroUmMes);
            bairrosUmMes = @json($bairrosUmMes);
        

        var opcoes = {
            series: [{
                name: 'Casos',
                data: casosPorBairroUmMes,
            }],
            chart: {
                type: 'bar',
                width: '100%',
                background: 'transparent',
                height: 1100,
            },
            plotOptions: {
                bar: {
                    horizontal: true,
                    dataLabels: {
                        position: 'top', // top, center, bottom
                    },
                }
            },
            dataLabels: {
                enabled: true,
                distributed: true,
                formatter: function (val) {
                    porcent = (val/casosTotaisUmMes)*100
                    arr = porcent.toFixed(2)
                    return val + ' (' + arr + "%)";
                    // if(val >= 250){
                    //     return val + ' (' + arr + "%)";
                        
                    // }else if(val < 250 && val >= 200){
                    //     return '(' + arr + "%)";
                    // }else {
                    //     return;
                    // }
                },
                offsetX: 60,
                style: {
                    fontSize: '12px',
                    // colors: ["#304758"]
                }
            },
            xaxis: {
                categories: bairrosUmMes,
                max: (parseInt(casosPorBairroUmMes[0]) + 50),
                forceNiceScale: true,
            },
            yaxis: {
                labels: {
                    align: 'left',
                    maxWidth: 190,
                    style: {
                        fontSize: '15px',
                    },
                }
            },
            theme: {
                mode: 'dark',
            },
            responsive: [{
                breakpoint: 478,
                options: {
                    chart: {
                        offsetX: -15,
                        toolbar: {
                            show: false
                        }
                    },
                    dataLabels: {
                        offsetX: 60,
                        style: {
                            fontSize: '10px',
                        }
                    },
                    xaxis: {
                        max: (parseInt(casosPorBairroUmMes[0]) + 200),
                    },
                    yaxis: {
                        labels: {
                            align: 'left',
                            maxWidth: 170,
                            offsetX: 0,
                            style: {
                                fontSize: '13px'
                            }
                        }
                    }
                }
            }],
        }

        var graficoCasosPorBairro = new ApexCharts(document.querySelector('#casosPorBairro'), opcoes);
        graficoCasosPorBairro.render();

        // Reseta estilo 'active' dos Botões Casos Por Bairro
        var botoesBairro = function(activeEl) {
            var els = document.querySelectorAll('.botaoBairro')
            Array.prototype.forEach.call(els, function(el) {
                el.classList.remove('active')
            })

            activeEl.target.classList.add('active')
        }

        // Filtro Casos por Bairro
            $('#seisMesesBairros').click(function(e) {
                casosPorBairroSeisMeses = @json($casosPorBairroSeisMeses);
                bairrosSeisMeses = @json($bairrosSeisMeses);
                

                botoesBairro(e);

                var arr = {
                    series: [{
                        name: 'Casos',
                        data: casosPorBairroSeisMeses
                    }],
                    dataLabels: {
                        formatter: function (val) {
                            porcent = (val/casosTotaisSeisMeses)*100
                            arr = porcent.toFixed(2)
                            return val + ' (' + arr + "%)";
                        },
                        style: {
                            // fontSize: '10px',
                            // colors: ["#304758"]
                        }
                    },
                    xaxis: {
                        categories: bairrosSeisMeses,
                        max: (parseInt(casosPorBairroSeisMeses[0]) + 300)
                    },
                    responsive: [{
                        breakpoint: 478,
                        options: {
                            xaxis: {
                                max: (parseInt(casosPorBairroSeisMeses[0]) + 1200),
                            },
                        }
                    }],
                }
                graficoCasosPorBairro.updateOptions(arr);
            })
            
            $('#tresMesesBairros').click(function(e) {
                casosPorBairroTresMeses = @json($casosPorBairroTresMeses);
                bairrosTresMeses = @json($bairrosTresMeses);
                
                
                botoesBairro(e);
                
                var arr = {
                    series: [{
                        name: 'Casos',
                        data: casosPorBairroTresMeses
                    }],
                    dataLabels: {
                        formatter: function (val) {
                            porcent = (val/casosTotaisTresMeses)*100
                            arr = porcent.toFixed(2)
                            return val + ' (' + arr + "%)";
                        },
                    },
                    xaxis: {
                        categories: bairrosTresMeses,
                        max: (parseInt(casosPorBairroTresMeses[0]) + 100)
                    },
                    responsive: [{
                        breakpoint: 478,
                        options: {
                            xaxis: {
                                max: (parseInt(casosPorBairroTresMeses[0]) + 500),
                            },
                        }
                    }],
                }
                graficoCasosPorBairro.updateOptions(arr);
            })

            $('#umMesBairros').click(function(e) {
                casosPorBairroUmMes = @json($casosPorBairroUmMes);
                bairrosUmMes = @json($bairrosUmMes);
                
                botoesBairro(e);

                graficoCasosPorBairro.updateOptions(opcoes);
            })
            
            $('#tudoBairros').click(function(e) {
                botoesBairro(e);

                bairros = @json($bairrosTotal);
                casosPorBairro = @json($casosPorBairroTotal);

        var arr = {
                    series: [{
                        name: 'Casos',
                        data: casosPorBairro
                    }],
                    dataLabels: {
                        formatter: function (val) {
                            porcent = (val/casosTotais)*100
                            arr = porcent.toFixed(2)
                            return val + ' (' + arr + "%)";
                        },
                    },
                    xaxis: {
                        categories: bairros,
                        max: (parseInt(casosPorBairro[0]) + 400)
                    },
                    responsive: [{
                        breakpoint: 478,
                        options: {
                            xaxis: {
                                max: (parseInt(casosPorBairro[0]) + 1230),
                            },
                        }
                    }],
                }
               
             
                graficoCasosPorBairro.updateOptions(arr);
              
            })

    
    // GRAFICO CASOS POR FAIXA ETARIA ----------------------------------------------------------------------------------------------------------------------------------------
                faixaEtariaUmMes = @json($faixaEtariaUmMes);
                faixaEtariaUmMesDesc = @json($faixaEtariaUmMesDesc);
        
        var casosPorFaixaEtaria = {
            series: [{
                name: 'Casos',
                data: faixaEtariaUmMes
            }],
            chart: {
                type: 'bar',
                width: "100%",
                height: 450,
                // stacked: true,
                background: 'transparent',
            },
            plotOptions: {
                bar: {
                    horizontal: true,
                    dataLabels: {
                        position: 'top', // top, center, bottom
                    },
                }
            },
            dataLabels: {
                enabled: true,
                distributed: true,
                formatter: function (val) {
                    porcent = (val/casosTotaisUmMes)*100
                    arr = porcent.toFixed(2)
                    return val + ' (' + arr + "%)";
                },
                offsetX: 60,
                style: {
                    fontSize: '12px',
                }
            },
            xaxis: {
                categories: ['Menor que 1','1 - 4','5 - 9','10 - 14','15 - 19','20 - 29','30 - 39','40 - 49','50 - 59','60 - 69','70 - 79','80 ou mais'],
                max: (parseInt(faixaEtariaUmMesDesc[0]) + 100),
                forceNiceScale: true,
            },
            yaxis: {
                labels: {
                    style: {
                        fontSize: '15px'
                    }
                }
            },
            theme: {
                mode: 'dark',
            },
            responsive: [{
                breakpoint: 478,
                options: {
                    chart: {
                        offsetX: -15
                    },
                    dataLabels: {
                        style: {
                            fontSize: '10px',
                        }
                    },
                    xaxis: {
                        max: (parseInt(faixaEtariaUmMesDesc[0]) + 200),
                    },
                    yaxis: {
                        labels: {
                            align: 'left',
                            offsetX: 0,
                            style: {
                                fontSize: '13px'
                            }
                        }
                    }
                }
            }]
        }

        var graficoCasosPorFaixaEtaria = new ApexCharts(document.querySelector('#casosPorFaixaEtaria'), casosPorFaixaEtaria);
        graficoCasosPorFaixaEtaria.render();

        // Reseta estilo 'active' dos Botões Casos Por Faixa Etária
        var botoesFaixaEtararia = function(activeEl) {
            var els = document.querySelectorAll('.botaoFaixaEtaria')
            Array.prototype.forEach.call(els, function(el) {
                el.classList.remove('active')
            })

            activeEl.target.classList.add('active')
        }

        // Filtro Casos por Faixa Etaria
            $('#seisMesesFaixaEtaria').click(function(e) {
                faixaEtariaSeisMeses = @json($faixaEtariaSeisMeses);
                faixaEtariaSeisMesesDesc = @json($faixaEtariaSeisMesesDesc);

                botoesFaixaEtararia(e);

                var arr = {
                    series: [{
                        name: 'Casos',
                        data: faixaEtariaSeisMeses
                    }],
                    dataLabels: {
                        formatter: function (val) {
                            porcent = (val/casosTotaisSeisMeses)*100
                            arr = porcent.toFixed(2)
                            return val + ' (' + arr + "%)";
                        },
                    },
                    xaxis: {
                        max: (parseInt(faixaEtariaSeisMesesDesc[0]) + 200)
                    },
                    responsive: [{
                        breakpoint: 478,
                        options: {
                            xaxis: {
                                max: (parseInt(faixaEtariaSeisMesesDesc[0]) + 800),
                            },
                        }
                    }]
                }

                graficoCasosPorFaixaEtaria.updateOptions(arr);
            })

            $('#tresMesesFaixaEtaria').click(function(e) {
                faixaEtariaTresMeses = @json($faixaEtariaTresMeses);
                faixaEtariaTresMesesDesc = @json($faixaEtariaTresMesesDesc);
                
                botoesFaixaEtararia(e);

                var arr = {
                    series: [{
                        name: 'Casos',
                        data: faixaEtariaTresMeses
                    }],
                    dataLabels: {
                        formatter: function (val) {
                            porcent = (val/casosTotaisTresMeses)*100
                            arr = porcent.toFixed(2)
                            return val + ' (' + arr + "%)";
                        },
                    },
                    xaxis: {
                        max: (parseInt(faixaEtariaTresMesesDesc[0]) + 100)
                    },
                    responsive: [{
                        breakpoint: 478,
                        options: {
                            xaxis: {
                                max: (parseInt(faixaEtariaTresMesesDesc[0]) + 400),
                            },
                        }
                    }]
                }

                graficoCasosPorFaixaEtaria.updateOptions(arr);
            })

            $('#umMesFaixaEtaria').click(function(e) {
                faixaEtariaUmMes = @json($faixaEtariaUmMes);
                faixaEtariaUmMesDesc = @json($faixaEtariaUmMesDesc);

                botoesFaixaEtararia(e);

                graficoCasosPorFaixaEtaria.updateOptions(casosPorFaixaEtaria);
            })
            
            $('#tudoFaixaEtaria').click(function(e) {
                botoesFaixaEtararia(e);

                faixaEtariaTotal = @json($faixaEtariaTotal);
                faixaEtariaTotalDesc = @json($faixaEtariaTotalDesc);

                var arr = {
                    series : [{
                        name: 'Casos',
                        data: faixaEtariaTotal
                    }],
                    dataLabels: {
                        formatter: function (val) {
                            porcent = (val/casosTotais)*100
                            arr = porcent.toFixed(2)
                            return val + ' (' + arr + "%)";
                        },
                    },
                    xaxis: {
                        max: (parseInt(faixaEtariaTotalDesc[0]) + 400)
                    },
                    responsive: [{
                        breakpoint: 478,
                        options: {
                            xaxis: {
                                max: (parseInt(faixaEtariaTotalDesc[0]) + 1500),
                            },
                        }
                    }]
                }

                graficoCasosPorFaixaEtaria.updateOptions(arr);
            })


        //GRÁFICO DE ÓBITOS POR FAIXA ETÁRIA

            obitosFaixaEtaria = @json($obitosFaixa);
            obitosFaixaEtariaDesc = @json($obitosFaixaEtariaDesc);
        
        
        var obitosPorFaixaEtaria = {
            series: [{
                name: 'Óbitos',
                data: obitosFaixaEtaria
            }],
            chart: {
                type: 'bar',
                width: "100%",
                height: 450,
                // stacked: true,
                background: 'transparent',
            },
            plotOptions: {
                bar: {
                    horizontal: true,
                    dataLabels: {
                        position: 'top', // top, center, bottom
                    },
                }
            },
            dataLabels: {
                enabled: true,
                distributed: true,
                formatter: function (val) {
                    porcent = (val/obitosTotais)*100
                    arr = porcent.toFixed(2)
                    return val + ' (' + arr + "%)";
                },
                offsetX: 60,
                style: {
                    fontSize: '12px',
                }
            },
            xaxis: {
                categories: ['Menor que 1','1 - 4','5 - 9','10 - 14','15 - 19','20 - 29','30 - 39','40 - 49','50 - 59','60 - 69','70 - 79','80 ou mais'],
                max: (parseInt(obitosFaixaEtariaDesc[0]) + 100),
                forceNiceScale: true,
            },
            yaxis: {
                labels: {
                    style: {
                        fontSize: '15px'
                    }
                }
            },
            theme: {
                mode: 'dark',
            },
           
            responsive: [{
                breakpoint: 478,
                options: {
                    chart: {
                        offsetX: -15
                    },
                    dataLabels: {
                        style: {
                            fontSize: '10px',
                        }
                    },
                    xaxis: {
                        max: (parseInt(obitosFaixaEtariaDesc[0]) + 200),
                    },
                    yaxis: {
                        labels: {
                            align: 'left',
                            offsetX: 0,
                            style: {
                                fontSize: '13px'
                            }
                        }
                    }
                }
            }]
        }

        var graficoObitosPorFaixaEtaria = new ApexCharts(document.querySelector('#obitosPorFaixaEtaria'), obitosPorFaixaEtaria);
        graficoObitosPorFaixaEtaria.render();

      

    
</script>