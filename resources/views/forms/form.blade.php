
<body>
    <div>
    <form action="{{ route('casos.salvar')}}" method="POST" >
        @csrf
        <div class="card">
            <div class="card-header">
                <h5 class="col-12 modal-title text-center">Novo registro de casos</h5>
             </div>
             <div class="container col-8 " style="margin-top: 20px;margin-bottom: 20px;">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach

                    </ul>
                </div>
            @endif

            <input type="hidden" id="id" class="form-control">
            <div class="form-row ">
                <div class="form-group col-md-4">
                    <label for="dia" class="control-label">Dia:</label>
                    <div class="input-group">
                        <input type="date" class="form-control" id="dia" name="dia" value="{{ old('dia', '0') }}"/>
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <label for="casos" class="control-label">Total de casos do dia:</label>
                    <div class="input-group">
                        <input type="number" min="0" onkeypress="return event.charCode >= 48" class="form-control" id="casos" name="casos" value="{{ old('casos', '0') }}" />
                    </div>
                </div>

                <div class="form-group col-md-4">
                    <label for="obitos" class="control-label">Óbitos:</label>
                    <div class="input-group">
                        <input type="number" min="0" onkeypress="return event.charCode >= 48" class="form-control" id="obitos" name="obitos" value="{{ old('obitos', '0') }}" />
                    </div>
                </div>

                <div class="form-group col-md-4">
                    <label for="recuperados" class="control-label">Recuperados:</label>
                    <div class="input-group">
                        <input type="number" min="0" onkeypress="return event.charCode >= 48" class="form-control" id="recuperados" name="recuperados" value="{{ old('recuperados', '0') }}" />
                    </div>
                </div>

                <div class="form-group col-md-4">
                    <label for="suspeitos" class="control-label">Suspeitos:</label>
                    <div class="input-group">
                        <input type="number" min="0" onkeypress="return event.charCode >= 48" class="form-control" id="suspeitos" name="suspeitos" value="{{ old('suspeitos') != 0 ? old('suspeitos') : $formulario->suspeitos}}" />
                    </div>
                </div>
                {{-- <div class="form-group col-md-4">
                    <label for="testesRealizados" class="control-label"> Total de Testes Realizados:</label>
                    <div class="input-group">
                        <input type="number" min="0" onkeypress="return event.charCode >= 48" class="form-control" id="testesRealizados"
                        name="testesRealizados" value="{{ old('testesRealizados') != 0 ? old('testesRealizados') : $formulario->testesRealizados }}"/>
                    </div>
                </div> --}}
                <div class="form-group col-md-4">
                    <label for="testesRapidoRealizados" class="control-label">Testes Rápidos Anticorpo:</label>
                    <div class="input-group">
                        <input type="number" min="0" onkeypress="return event.charCode >= 48" class="form-control" id="testesRapidoRealizados"
                        name="testesRapidoRealizados" value="{{ old('testesRapidoRealizados') != 0 ? old('testesRapidoRealizados') : $formulario->testesRapidoRealizados }}"/>
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <label for="testesPcrRealizados" class="control-label">Testes RT-PCR Realizados:</label>
                    <div class="input-group">
                        <input type="number" min="0" onkeypress="return event.charCode >= 48" class="form-control" id="testesPcrRealizados"
                        name="testesPcrRealizados" value="{{ old('testesPcrRealizados') != 0 ? old('testesPcrRealizados') : $formulario->testesPcrRealizados }}"/>
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <label for="teste_rapido_antigeno" class="control-label">Testes Rápidos Antigeno:</label>
                    <div class="input-group">
                        <input type="number" min="0" onkeypress="return event.charCode >= 48" class="form-control" id="teste_rapido_antigeno"
                        name="teste_rapido_antigeno" value="{{ old('teste_rapido_antigeno') != 0 ? old('teste_rapido_antigeno') : $formulario->teste_rapido_antigeno }}"/>
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <label for="teste_sorologico" class="control-label">Testes Sorológicos:</label>
                    <div class="input-group">
                        <input type="number" min="0" onkeypress="return event.charCode >= 48" class="form-control" id="teste_sorologico"
                        name="teste_sorologico" value="{{ old('teste_sorologico') != 0 ? old('teste_sorologico') : $formulario->teste_sorologico }}"/>
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <label for="outrosTestesRealizados" class="control-label">Tomográfia:</label>
                    <div class="input-group">
                        <input type="number" min="0" onkeypress="return event.charCode >= 48" class="form-control" id="outrosTestesRealizados"
                        name="outrosTestesRealizados" value="{{ old('outrosTestesRealizados') != 0 ? old('outrosTestesRealizados') : $formulario->outrosTestesRealizados }}"/>
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <label for="testesNegativos" class="control-label">Testes Negativos:</label>
                    <div class="input-group">
                        <input type="number" min="0" onkeypress="return event.charCode >= 48" class="form-control" id="testesNegativos"
                        name="testesNegativos" value="{{ old('testesNegativos') != 0 ? old('testesNegativos') : $formulario->testesNegativos }}"/>
                    </div>
                </div>
                <div class="form-group col-md-12">
                    <label for="exames" class="control-label">Exames em Residentes de Outras Cidades:</label>
                    <div class="input-group">
                        <input type="number" min="0" onkeypress="return event.charCode >= 48" class="form-control" id="exames"
                        name="exames" value="{{ old('exames') != 0 ? old('exames') : $formulario->exames }}"/>
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <label for="total_leitos_clinicos" class="control-label">Total de Leitos Clínicos:</label>
                    <div class="input-group">
                        <input type="number" min="0" onkeypress="return event.charCode >= 48" class="form-control" id="total_leitos_clinicos" name="total_leitos_clinicos"
                            value="{{ old('total_leitos_clinicos') != 0 ? old('total_leitos_clinicos') : $casosConfirmados->total_leitos_clinicos }}" />
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label for="leitos_clinicos_em_uso" class="control-label">Leitos Clínicos em uso:</label>
                    <div class="input-group">
                        <input type="number" min="0" onkeypress="return event.charCode >= 48" class="form-control" id="leitos_clinicos_em_uso" name="leitos_clinicos_em_uso"
                            value="{{ old('leitos_clinicos_em_uso') != 0 ? old('leitos_clinicos_em_uso') : $casosConfirmados->leitos_clinicos_em_uso }}" />
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label for="total_leitos_uti" class="control-label">Total de Leitos de UTI:</label>
                    <div class="input-group">
                        <input type="number" min="0" onkeypress="return event.charCode >= 48" class="form-control" id="total_leitos_uti" name="total_leitos_uti"
                            value="{{ old('total_leitos_uti') != 0 ? old('total_leitos_uti') : $casosConfirmados->total_leitos_uti }}" />
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label for="leitos_uti_em_uso" class="control-label">Leitos de UTI em uso:</label>
                    <div class="input-group">
                        <input type="number" min="0" onkeypress="return event.charCode >= 48" class="form-control" id="leitos_uti_em_uso" name="leitos_uti_em_uso"
                            value="{{ old('leitos_uti_em_uso') != 0 ? old('leitos_uti_em_uso') : $casosConfirmados->leitos_uti_em_uso }}" />
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <label for="total_leitos_upa" class="control-label">Total de Leitos de UPA:</label>
                    <div class="input-group">
                        <input type="number" min="0" onkeypress="return event.charCode >= 48" class="form-control" id="total_leitos_upa" name="total_leitos_upa"
                            value="{{ old('total_leitos_upa') != 0 ? old('total_leitos_upa') : $casosConfirmados->total_leitos_upa }}" />
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label for="leitos_upa_em_uso" class="control-label">Leitos de UPA em uso:</label>
                    <div class="input-group">
                        <input type="number" min="0" onkeypress="return event.charCode >= 48" class="form-control" id="leitos_upa_em_uso" name="leitos_upa_em_uso"
                            value="{{ old('leitos_upa_em_uso') != 0 ? old('leitos_upa_em_uso') : $casosConfirmados->leitos_upa_em_uso }}" />
                    </div>
                </div>


            </div>
            <div class="form-row ">
                <div class="form-group col-md-12" ><h5>Casos por bairro:</h5></div>
                @foreach ($bairros as $bairro)
                    <div class="form-group col-md-3">
                        <label for="{{ $bairro->id }}_casos" class="control-label">{{ $bairro->nome }}</label>
                        <input type="number" min="0" onkeypress="return event.charCode >= 48" class="form-control"
                        id="{{ $bairro->id }}_casos" name="{{ $bairro->id }}_casos" value="{{ old($bairro->id.'_casos', '0') }}" />
                    </div>
                @endforeach
                <div class="form-group col-md-12" ><h5>Detalhamento de casos confirmados:</h5></div>
                <div class="form-group-row col-md-12" ><h5 class="text-left">Sexo:</h5></div>
                <div class="form-group col-md-6">
                    <label for="masculino" class="control-label">Masculino:</label>
                    <div class="input-group">
                        <input type="number" min="0" onkeypress="return event.charCode >= 48" class="form-control" id="masculino" name="masculino" value="{{ old('masculino', '0') }}" />
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <label for="feminino" class="control-label">Feminino:</label>
                    <div class="input-group">
                        <input type="number" min="0" onkeypress="return event.charCode >= 48" class="form-control" id="feminino" name="feminino" value="{{ old('feminino', '0') }}" />
                    </div>
                </div>
                <div class="form-group-row col-md-12" ><h5 class="text-left">Idade:</h5></div>
                <div class="form-group col-md-3">
                    <label for="ate1ano" class="control-label">Menor que 1 ano:</label>
                    <div class="input-group">
                        <input type="number" min="0" onkeypress="return event.charCode >= 48" class="form-control" id="ate1ano" name="ate1ano" value="{{ old('ate1ano', '0') }}" />
                    </div>
                </div>

                <div class="form-group col-md-3">
                    <label for="de1a4anos" class="control-label">1 a 4 anos:</label>
                    <div class="input-group">
                        <input type="number" min="0" onkeypress="return event.charCode >= 48" class="form-control" id="de1a4anos" name="de1a4anos" value="{{ old('de1a4anos', '0') }}" />
                    </div>
                </div>

                <div class="form-group col-md-3">
                    <label for="de5a9anos" class="control-label">5 a 9 anos:</label>
                    <div class="input-group">
                        <input type="number" min="0" onkeypress="return event.charCode >= 48" class="form-control" id="de5a9anos" name="de5a9anos" value="{{ old('de5a9anos', '0') }}" />
                    </div>
                </div>

                <div class="form-group col-md-3">
                    <label for="de10a14anos" class="control-label">10 a 14 anos:</label>
                    <div class="input-group">
                        <input type="number" min="0" onkeypress="return event.charCode >= 48" class="form-control" id="de10a14anos" name="de10a14anos" value="{{ old('de10a14anos', '0') }}" />
                    </div>
                </div>

                <div class="form-group col-md-3">
                    <label for="de15a19anos" class="control-label">15 a 19 anos:</label>
                    <div class="input-group">
                        <input type="number" min="0" onkeypress="return event.charCode >= 48" class="form-control" id="de15a19anos" name="de15a19anos" value="{{ old('de15a19anos', '0') }}" />
                    </div>
                </div>

                <div class="form-group col-md-3">
                    <label for="de20a29anos" class="control-label">20 a 29 anos:</label>
                    <div class="input-group">
                        <input type="number" min="0" onkeypress="return event.charCode >= 48" class="form-control" id="de20a29anos" name="de20a29anos" value="{{ old('de20a29anos', '0') }}" />
                    </div>
                </div>

                <div class="form-group col-md-3">
                    <label for="de30a39anos" class="control-label">30 a 39 anos:</label>
                    <div class="input-group">
                        <input type="number" min="0" onkeypress="return event.charCode >= 48" class="form-control" id="de30a39anos" name="de30a39anos" value="{{ old('de30a39anos', '0') }}" />
                    </div>
                </div>

                <div class="form-group col-md-3">
                    <label for="de40a49anos" class="control-label">40 a 49 anos:</label>
                    <div class="input-group">
                        <input type="number" min="0" onkeypress="return event.charCode >= 48" class="form-control" id="de40a49anos" name="de40a49anos" value="{{ old('de40a49anos', '0') }}" />
                    </div>
                </div>

                <div class="form-group col-md-3">
                    <label for="de50a59anos" class="control-label">50 a 59 anos:</label>
                    <div class="input-group">
                        <input type="number" min="0" onkeypress="return event.charCode >= 48" class="form-control" id="de50a59anos" name="de50a59anos" value="{{ old('de50a59anos', '0') }}" />
                    </div>
                </div>

                <div class="form-group col-md-3">
                    <label for="de60a69anos" class="control-label">60 a 69 anos:</label>
                    <div class="input-group">
                        <input type="number" min="0" onkeypress="return event.charCode >= 48" class="form-control" id="de60a69anos" name="de60a69anos" value="{{ old('de60a69anos', '0') }}" />
                    </div>
                </div>

                <div class="form-group col-md-3">
                    <label for="de70a79anos" class="control-label">70 a 79 anos:</label>
                    <div class="input-group">
                        <input type="number" min="0" onkeypress="return event.charCode >= 48" class="form-control" id="de70a79anos" name="de70a79anos" value="{{ old('de70a79anos', '0') }}" />
                    </div>
                </div>

                <div class="form-group col-md-3">
                    <label for="de80oumais" class="control-label">80 ou mais:</label>
                    <div class="input-group">
                        <input type="number" min="0" onkeypress="return event.charCode >= 48" class="form-control" id="de80oumais" name="de80oumais" value="{{ old('de80oumais', '0') }}" />
                    </div>
                </div>
                <div class="form-group-row col-md-12" ><h5 class="text-left">Cor/Raça:</h5></div>
                <div class="form-group col-md-3">
                    <label for="branca" class="control-label">Branca:</label>
                    <div class="input-group">
                        <input type="number" min="0" onkeypress="return event.charCode >= 48" class="form-control" id="branca" name="branca" value="{{ old('branca', '0') }}" />
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <label for="parda" class="control-label">Parda:</label>
                    <div class="input-group">
                        <input type="number" min="0" onkeypress="return event.charCode >= 48" class="form-control" id="parda" name="parda" value="{{ old('parda', '0') }}" />
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <label for="preta" class="control-label">Preta:</label>
                    <div class="input-group">
                        <input type="number" min="0" onkeypress="return event.charCode >= 48" class="form-control" id="preta" name="preta" value="{{ old('preta', '0') }}" />
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <label for="amarela" class="control-label">Amarela:</label>
                    <div class="input-group">
                        <input type="number" min="0" onkeypress="return event.charCode >= 48" class="form-control" id="amarela" name="amarela" value="{{ old('amarela', '0') }}" />
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <label for="indigena" class="control-label">Indígena:</label>
                    <div class="input-group">
                        <input type="number" min="0" onkeypress="return event.charCode >= 48" class="form-control" id="indigena" name="indigena" value="{{ old('indigena', '0') }}" />
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <label for="cor_raca_nao_informada" class="control-label">Cor/Raça não informada:</label>
                    <div class="input-group">
                        <input type="number" min="0" onkeypress="return event.charCode >= 48" class="form-control" id="cor_raca_nao_informada" name="cor_raca_nao_informada" value="{{ old('cor_raca_nao_informada', '0') }}" />
                    </div>
                </div>
                <div class="form-group-row col-md-12" ><h5 class="text-left">Escolaridade:</h5></div>
                <div class="form-group col-md-4">
                    <label for="analfabeto" class="control-label">Analfabeto:</label>
                    <div class="input-group">
                        <input type="number" min="0" onkeypress="return event.charCode >= 48" class="form-control" id="analfabeto" name="analfabeto" value="{{ old('analfabeto', '0') }}" />
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <label for="ensino_fundamental" class="control-label">Ensino Fundamental:</label>
                    <div class="input-group">
                        <input type="number" min="0" onkeypress="return event.charCode >= 48" class="form-control" id="ensino_fundamental" name="ensino_fundamental" value="{{ old('ensino_fundamental', '0') }}" />
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <label for="ensino_medio" class="control-label">Ensino Médio:</label>
                    <div class="input-group">
                        <input type="number" min="0" onkeypress="return event.charCode >= 48" class="form-control" id="ensino_medio" name="ensino_medio" value="{{ old('ensino_medio', '0') }}" />
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <label for="ensino_superior" class="control-label">Ensino Superior:</label>
                    <div class="input-group">
                        <input type="number" min="0" onkeypress="return event.charCode >= 48" class="form-control" id="ensino_superior" name="ensino_superior" value="{{ old('ensino_superior', '0') }}" />
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <label for="escolaridade_nao_informada" class="control-label">Escolaridade não informada:</label>
                    <div class="input-group">
                        <input type="number" min="0" onkeypress="return event.charCode >= 48" class="form-control" id="escolaridade_nao_informada" name="escolaridade_nao_informada" value="{{ old('escolaridade_nao_informada', '0') }}" />
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <label for="nao_Aplicado" class="control-label">Não se aplica:</label>
                    <div class="input-group">
                        <input type="number" min="0" onkeypress="return event.charCode >= 48" class="form-control" id="nao_aplicado" name="nao_aplicado" value="{{ old('nao_aplicado', '0') }}" />
                    </div>
                </div>


            <div class="form-group col-md-12" ><h5>Atualização de óbitos por faixa etária:</h5></div>

                <div class="form-group col-md-3">
                    <label for="ate1ano" class="control-label">Menor que 1 ano:</label>
                    <div class="input-group">
                        <input type="number" min="0" onkeypress="return event.charCode >= 48" class="form-control" id="obitos_ate1ano" name="obitos_ate1ano"
                        value="{{ old('obitos_ate1ano') != 0 ? old('obitos_ate1ano') : $obitosFaixaEtaria->ate1ano }}"/>
                    </div>
                </div>

                <div class="form-group col-md-3">
                    <label for="de1a4anos" class="control-label">1 a 4 anos:</label>
                    <div class="input-group">
                        <input type="number" min="0" onkeypress="return event.charCode >= 48" class="form-control" id="obitos_de1a4anos" name="obitos_de1a4anos"
                        value="{{ old('obitos_de1a4anos') != 0 ? old('obitos_de1a4anos') : $obitosFaixaEtaria->de1a4anos }}"/>
                    </div>
                </div>

                <div class="form-group col-md-3">
                    <label for="de5a9anos" class="control-label">5 a 9 anos:</label>
                    <div class="input-group">
                        <input type="number" min="0" onkeypress="return event.charCode >= 48" class="form-control" id="obitos_de5a9anos" name="obitos_de5a9anos"
                        value="{{ old('obitos_de5a9anos') != 0 ? old('obitos_de5a9anos') : $obitosFaixaEtaria->de5a9anos }}"/>
                    </div>
                </div>

                <div class="form-group col-md-3">
                    <label for="de10a14anos" class="control-label">10 a 14 anos:</label>
                    <div class="input-group">
                        <input type="number" min="0" onkeypress="return event.charCode >= 48" class="form-control" id="obitos_de10a14anos" name="obitos_de10a14anos"
                        value="{{ old('obitos_de10a14anos') != 0 ? old('obitos_de10a14anos') : $obitosFaixaEtaria->de10a14anos }}"/>
                    </div>
                </div>

                <div class="form-group col-md-3">
                    <label for="de15a19anos" class="control-label">15 a 19 anos:</label>
                    <div class="input-group">
                        <input type="number" min="0" onkeypress="return event.charCode >= 48" class="form-control" id="obitos_de15a19anos" name="obitos_de15a19anos"
                        value="{{ old('obitos_de15a19anos') != 0 ? old('obitos_de15a19anos') : $obitosFaixaEtaria->de15a19anos }}"/>

                    </div>
                </div>

                <div class="form-group col-md-3">
                    <label for="de20a29anos" class="control-label">20 a 29 anos:</label>
                    <div class="input-group">
                        <input type="number" min="0" onkeypress="return event.charCode >= 48" class="form-control" id="obitos_de20a29anos" name="obitos_de20a29anos"
                        value="{{ old('obitos_de20a29anos') != 0 ? old('obitos_de20a29anos') : $obitosFaixaEtaria->de20a29anos }}"/>

                    </div>
                </div>

                <div class="form-group col-md-3">
                    <label for="de30a39anos" class="control-label">30 a 39 anos:</label>
                    <div class="input-group">
                        <input type="number" min="0" onkeypress="return event.charCode >= 48" class="form-control" id="obitos_de30a39anos" name="obitos_de30a39anos"
                        value="{{ old('obitos_de30a39anos') != 0 ? old('obitos_de30a39anos') : $obitosFaixaEtaria->de30a39anos }}"/>
                    </div>
                </div>

                <div class="form-group col-md-3">
                    <label for="de40a49anos" class="control-label">40 a 49 anos:</label>
                    <div class="input-group">
                        <input type="number" min="0" onkeypress="return event.charCode >= 48" class="form-control" id="obitos_de40a49anos" name="obitos_de40a49anos"
                        value="{{ old('obitos_de40a49anos') != 0 ? old('obitos_de40a49anos') : $obitosFaixaEtaria->de40a49anos }}"/>
                    </div>
                </div>

                <div class="form-group col-md-3">
                    <label for="de50a59anos" class="control-label">50 a 59 anos:</label>
                    <div class="input-group">
                        <input type="number" min="0" onkeypress="return event.charCode >= 48" class="form-control" id="obitos_de50a59anos" name="obitos_de50a59anos"
                        value="{{ old('obitos_de50a59anos') != 0 ? old('obitos_de50a59anos') : $obitosFaixaEtaria->de50a59anos }}"/>
                    </div>
                </div>

                <div class="form-group col-md-3">
                    <label for="de60a69anos" class="control-label">60 a 69 anos:</label>
                    <div class="input-group">
                        <input type="number" min="0" onkeypress="return event.charCode >= 48" class="form-control" id="obitos_de60a69anos" name="obitos_de60a69anos"
                        value="{{ old('obitos_de60a69anos') != 0 ? old('obitos_de60a69anos') : $obitosFaixaEtaria->de60a69anos }}"/>

                    </div>
                </div>

                <div class="form-group col-md-3">
                    <label for="de70a79anos" class="control-label">70 a 79 anos:</label>
                    <div class="input-group">
                        <input type="number" min="0" onkeypress="return event.charCode >= 48" class="form-control" id="obitos_de70a79anos" name="obitos_de70a79anos"
                        value="{{ old('obitos_de70a79anos') != 0 ? old('obitos_de70a79anos') : $obitosFaixaEtaria->de70a79anos }}"/>

                    </div>
                </div>

                <div class="form-group col-md-3">
                    <label for="de80oumais" class="control-label">80 ou mais:</label>
                    <div class="input-group">
                        <input type="number" min="0" onkeypress="return event.charCode >= 48" class="form-control" id="obitos_de80oumais" name="obitos_de80oumais"
                        value="{{ old('obitos_de80oumais') != 0 ? old('obitos_de80oumais') : $obitosFaixaEtaria->de80oumais }}"/>
                    </div>
                </div>


                <div class="form-group col-md-12" ><h5>Dados de vacinação (Totais):</h5></div>

                <div class="form-group col-md-3">
                    <label for="totalDose" class="control-label">Doses recebidas:</label>
                    <div class="input-group">
                        <input type="number" min="0" onkeypress="return event.charCode >= 48" class="form-control" id="totalDose" name="totalDose" value="{{ old('totalDose') != 0 ? old('totalDose') : $formulario->totalDose }}"/>

                    </div>
                </div>
                <div class="form-group col-md-3">
                    <label for="primeiraDose" class="control-label">1º Dose:</label>
                    <div class="input-group">
                        <input type="number" min="0" onkeypress="return event.charCode >= 48" class="form-control" id="primeiraDose" name="primeiraDose" value="{{ old('primeiraDose') != 0 ? old('primeiraDose') : $formulario->primeiraDose }}"/>
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <label for="segundaDose" class="control-label">2º Dose/Dose única:</label>
                    <div class="input-group">
                        <input type="number" min="0" onkeypress="return event.charCode >= 48" class="form-control" id="segundaDose" name="segundaDose" value="{{ old('segundaDose') != 0 ? old('segundaDose') : $formulario->segundaDose }}"/>
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <label for="terceiraDose" class="control-label">3º Dose:</label>
                    <div class="input-group">
                        <input type="number" min="0" onkeypress="return event.charCode >= 48" class="form-control" id="terceiraDose" name="terceiraDose" value="{{ old('terceiraDose') != 0 ? old('terceiraDose') : $formulario->terceiraDose }}"/>
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <label for="quartaDose" class="control-label">4º Dose:</label>
                    <div class="input-group">
                        <input type="number" min="0" onkeypress="return event.charCode >= 48" class="form-control" id="quartaDose" name="quartaDose" value="{{ old('quartaDose') != 0 ? old('quartaDose') : $formulario->quartaDose }}"/>
                    </div>
                </div>


                   <p id="errodoses" style="display: none; color: red">A 1º dose aplicada não pode ser maior que as doses recebidas</p>


        </div>




            <button onclick="myFunction()" style="margin-bottom: 10px" class="btn btn-primary" type="submit">Salvar</button>
            <a style="margin-bottom: 10px" href="{{ route('casos.menu') }}" class="btn btn-secondary">Cancelar</a>
        </div>

        </div>

    </form>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>

    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\CadastroValidacao'); !!}

    @include('sweetalert::alert')
    <script>

        function checkDose(){

            if($("#primeiraDose").val() > $("#totalDose").val()){
              $("#errodoses").css("display", "block", );
                return false;
            }

        }



    </script>


    </div>
</body>

