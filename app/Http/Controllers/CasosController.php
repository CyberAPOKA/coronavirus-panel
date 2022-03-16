<?php

namespace App\Http\Controllers;

use App\Bairro;
use App\CasosConfirmado;
use App\CasosConfirmadosBairro;
use App\Formulario;
use App\ObitosFaixaEtaria;
use App\Http\Requests\CadastroValidacao;
use App\Http\Requests\CadastroVacina;
use App\Http\Requests\UpdateCasosRequest;
use App\Rules\ComparaValorTotal;
use App\Rules\ComparaTotalObitos;
// use App\Rules\DadosVacinacao;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Log;


class CasosController extends Controller
{
    public function index()
    {
        $somaCasos = CasosConfirmado::selectRaw('dia, SUM(casos) as casos, SUM(obitos) as obitos, SUM(recuperados) as recuperados')->groupBy('dia')->orderBy('dia')->get();

        $diaCasos = [];
        $casos = [];
        $obitos = [];
        $recuperados = [];
        $virusAtivo = [];

        // $testesRealizados = [];

        $soma_casos = 0;
        $soma_obitos = 0;
        $soma_recuperados = 0;
        $soma_virusAtivo = 0;
        // $soma_testesRealizados = 0;

        foreach ($somaCasos as $soma) {
            $soma_casos += $soma->casos;
            $soma_obitos += $soma->obitos;
            $soma_recuperados += $soma->recuperados;
            $soma_virusAtivo += $soma->casos - ($soma->recuperados + $soma->obitos);
            // $soma_testesRealizados += $soma->casos + $soma->suspeitos + $soma->leitos_clinicos_em_uso + $soma->leitos_uti_em_uso + $soma->positivoOutrasCidades;

            array_push($casos, $soma_casos);
            array_push($obitos, $soma_obitos);
            array_push($recuperados, $soma_recuperados);
            array_push($virusAtivo, $soma_virusAtivo);

            // array_push($testesRealizados, $soma_testesRealizados);

            array_push($diaCasos, $soma->dia);
        }

        if ($soma_obitos > 0) {
            $numeroProporcaoObitosSaoLeo = end($casos) / end($obitos);
        } else {
            $numeroProporcaoObitosSaoLeo = 0;
        }

        //para a tabela de números de leitos de UTI e Clínicos
        $numerosLeitos = CasosConfirmado::get()->last();
        if (!is_null($numerosLeitos)) {
            $hospitalizados = $numerosLeitos->leitos_clinicos_em_uso + $numerosLeitos->leitos_uti_em_uso;
        }else {
            $hospitalizados = 0;
        }
        $formatter = \Lava::NumberFormat([
            'groupingSymbol' => '.',
            'fractionDigits' => 0,

        ]);

        $formulario = Formulario::latest('updated_at')->first();
        $casosConfirmadoLastRecord = CasosConfirmado::latest('updated_at')->first();
        $casosConfirmadosBairroLastRecord = CasosConfirmadosBairro::latest('updated_at')->first();

        $lastRecord = $formulario;

        if (!empty($lastRecord)) {
            if (!empty($casosConfirmadosBairroLastRecord)) {
                if ($casosConfirmadosBairroLastRecord->updated_at > $lastRecord->updated_at) {
                    $lastRecord = $casosConfirmadosBairroLastRecord;
                }
            }

            if (!empty($casosConfirmadoLastRecord)) {
                if ($casosConfirmadoLastRecord->updated_at > $lastRecord->updated_at) {
                    $lastRecord = $casosConfirmadoLastRecord;
                }
            }
        }

        return view('index', compact('casos', 'formulario', 'obitos', 'recuperados',
            'numeroProporcaoObitosSaoLeo', 'virusAtivo', 'lastRecord', 'hospitalizados', 'numerosLeitos'));
    }

    public function create()
    {
        $bairros = Bairro::orderBy('nome', 'ASC')->get();

        $formulario = Formulario::first();

        $casosConfirmados = CasosConfirmado::get()->last();

        $obitosFaixaEtaria = ObitosFaixaEtaria::first();

        return view('cadastro', compact('bairros', 'formulario', 'casosConfirmados','obitosFaixaEtaria'));
    }


    public static function calculaMediaMovel($casosValores)
    {
        $mediaMovelResultado = [];

        for ($x = 0; $x < count($casosValores); $x++) {

            $quantidade = 0;
            $somaValores = 0;
            for ($y = $x; ($x - $y <= 6 && $y >=0); $y--) {
            $quantidade++;
            $somaValores += $casosValores[$y];
            }

            $mediaMovel = $somaValores / $quantidade;

            array_push($mediaMovelResultado,round($mediaMovel,0));


        }
        return $mediaMovelResultado;
    }


    public static function consultarDadosComparativosPorPeriodo($dataInicial){

        $dados = [];

        if (is_null($dataInicial)){
            $dados = CasosConfirmado::selectRaw('dia, casos, obitos, recuperados')
            ->groupBy('dia')
            ->orderBy('dia')
            ->get();
        } else {
            $dados = CasosConfirmado::selectRaw('dia, casos, obitos, recuperados')
            ->groupBy('dia')
            ->orderBy('dia')
            ->whereDate('dia','>=', $dataInicial)
            ->get();
        }
    return $dados;
    }

    public function store(CadastroValidacao $request)
    {



        $valorTotalSexo = $request->input('masculino') + $request->input('feminino');

        $valorTotalFaixaEtaria = $request->input('ate1ano') +
        $request->input('de1a4anos') +
        $request->input('de5a9anos') +
        $request->input('de10a14anos') +
        $request->input('de15a19anos') +
        $request->input('de20a29anos') +
        $request->input('de30a39anos') +
        $request->input('de40a49anos') +
        $request->input('de50a59anos') +
        $request->input('de60a69anos') +
        $request->input('de70a79anos') +
        $request->input('de80oumais');






        $totalDoseAplicadas = $request->input('primeiraDose') +
        $request->input('segundaDose') +
        $request->input('terceiraDose') +
        $request->input('quartaDose');

        $totalDoseRecebidas = $request->input('totalDose');
        $primeiraDose =$request->input('primeiraDose');
        $segundaDose =$request->input('segundaDose');
        $terceiraDose =$request->input('terceiraDose');
        $quartaDose =$request->input('quartaDose');

        if($primeiraDose > $totalDoseRecebidas){
            return redirect()->back()->withInput()->withErrors("O total de 1º doses aplicadas não pode ser maior que o total de doses recebidas.");
        }else if($segundaDose > $primeiraDose ){
            return redirect()->back()->withInput()->withErrors("O total de 2º doses aplicadas não pode ser maior que o total de 1º doses aplicadas.");
        }else if($terceiraDose > $segundaDose ){
            return redirect()->back()->withInput()->withErrors("O total de 3º doses aplicadas não pode ser maior que o total de 2º doses aplicadas.");
        }else if($quartaDose > $terceiraDose ){
            return redirect()->back()->withInput()->withErrors("O total de 4º doses aplicadas não pode ser maior que o total de 3º doses aplicadas.");
        }else if($primeiraDose + $segundaDose + $terceiraDose + $quartaDose > $totalDoseRecebidas){
            return redirect()->back()->withInput()->withErrors("A aplicação de vacinas da 1º, 2º, 3º e 4º são maiores do que a recebidas.");

        }

        $valorTotalCorRaca = $request->input('cor_raca_nao_informada') +
        $request->input('branca') +
        $request->input('parda') +
        $request->input('preta') +
        $request->input('indigena') +
        $request->input('amarela');

        $valorTotalEscolaridade = $request->input('analfabeto') +
        $request->input('ensino_fundamental') +
        $request->input('ensino_medio') +
        $request->input('ensino_superior') +
        $request->input('escolaridade_nao_informada') +
        $request->input('nao_aplicado');

        // $valorTotalTestes = $request->input('testesRapidoRealizados')+
        // $request->input('testesPcrRealizados');

        // Validação que impede soma de Óbitos, Recuperados e Ativos > Casos

        $casosConfirmados = CasosConfirmado::selectRaw('SUM(casos) as casos, SUM(obitos) as obitos, SUM(recuperados) as recuperados')->get();
        error_log("teste" . $casosConfirmados);
        $novoValorCasos = $casosConfirmados[0]->casos + $request->input('casos');
        $novoValorObitos = $casosConfirmados[0]->obitos + $request->input('obitos');
        $novoValorRecuperados = $casosConfirmados[0]->recuperados + $request->input('recuperados');
        $novoValorVirusAtivo = $novoValorCasos - ($novoValorObitos + $novoValorRecuperados);

        //dados vacinacao



       // $casosConfirmados = CasosConfirmado::selectRaw

        if($novoValorVirusAtivo < 0){
            if ($novoValorCasos == ($novoValorObitos + $novoValorRecuperados + ($novoValorVirusAtivo * (-1))) ){
                $obitosRecuperados = $request->input("casos");
            }else{
                $obitosRecuperados = 3.14;
            }
        }else{
            if ($novoValorCasos == ($novoValorObitos + $novoValorRecuperados + $novoValorVirusAtivo) ){
                $obitosRecuperados = $request->input("casos");
            }else{
                $obitosRecuperados = 3.14;
            }
        }

        // Fim da Validação


        $totalObitosFaixaEtaria = ($request->input('obitos_ate1ano')
        + $request->input('obitos_de1a4anos')
        + $request->input('obitos_de5a9anos')
        + $request->input('obitos_de10a14anos')
        + $request->input('obitos_de15a19anos')
        + $request->input('obitos_de20a29anos')
        + $request->input('obitos_de30a39anos')
        + $request->input('obitos_de40a49anos')
        + $request->input('obitos_de50a59anos')
        + $request->input('obitos_de60a69anos')
        + $request->input('obitos_de70a79anos')
        + $request->input('obitos_de80oumais'));




        $bairros = Bairro::all();

        $valorTotalBairros = 0;

        foreach ($bairros as $bairro) {
            if ($request->input($bairro->id . '_casos') !== '0') {
                $valorTotalBairros = $valorTotalBairros + $request->input($bairro->id . '_casos');
            }
        }

        $regras = [
            'casos' => ['required', new ComparaValorTotal("sexo", $valorTotalSexo),
                new ComparaValorTotal("faixaEtaria", $valorTotalFaixaEtaria),
                new ComparaValorTotal("bairros", $valorTotalBairros),
                new ComparaValorTotal("escolaridade", $valorTotalEscolaridade),
                new ComparaValorTotal("corRaca", $valorTotalCorRaca),
                new ComparaValorTotal("obitosRecuperados", $obitosRecuperados),

            ],
            'obitos' => ['required', new ComparaTotalObitos
            ($casosConfirmados[0]->obitos+$request->input('obitos'),$totalObitosFaixaEtaria)
        ],

       /* 'totalDose' => ['required',

        new DadosVacinacao("totalDoseAplicadas",$request->input('totalDoseAplicadas')),
        new DadosVacinacao("primeiraDose", $request->input('primeiraDose')),
        new DadosVacinacao("segundaDose", $request->input('segundaDose')),
        new DadosVacinacao("terceiraDose", $request->input('terceiraDose')),
        ]
        */
        ];



        $mensagens = [
            'required' => 'O campo é necessario',
        ];

        $request->validate($regras, $mensagens);

        $soma = 0;

        foreach ($bairros as $bairro) {
            if ($request->input($bairro->id . '_casos') !== '0') {
                $casosBairro = new CasosConfirmadosBairro();

                $casosBairro->bairro_id = $bairro->id;
                $casosBairro->dia = $request->input('dia');
                $casosBairro->casos = $request->input($bairro->id . '_casos');

                $casosBairro->save();

                $soma = $soma + $casosBairro->casos;
            }
        }

        $casos = new CasosConfirmado();
        $casos->casos = $soma;
        $casos->obitos = $request->input('obitos');
        $casos->recuperados = $request->input('recuperados');
        $casos->dia = $request->input('dia');
        $casos->masculino = $request->input('masculino');
        $casos->feminino = $request->input('feminino');
        $casos->ate1ano = $request->input('ate1ano');
        $casos->de1a4anos = $request->input('de1a4anos');
        $casos->de5a9anos = $request->input('de5a9anos');
        $casos->de10a14anos = $request->input('de10a14anos');
        $casos->de15a19anos = $request->input('de15a19anos');
        $casos->de20a29anos = $request->input('de20a29anos');
        $casos->de30a39anos = $request->input('de30a39anos');
        $casos->de40a49anos = $request->input('de40a49anos');
        $casos->de50a59anos = $request->input('de50a59anos');
        $casos->de60a69anos = $request->input('de60a69anos');
        $casos->de70a79anos = $request->input('de70a79anos');
        $casos->de80oumais = $request->input('de80oumais');
        $casos->analfabeto = $request->input('analfabeto');
        $casos->ensino_fundamental = $request->input('ensino_fundamental');
        $casos->ensino_medio = $request->input('ensino_medio');
        $casos->ensino_superior = $request->input('ensino_superior');
        $casos->escolaridade_nao_informada = $request->input('escolaridade_nao_informada');
        $casos->nao_aplicado = $request->input('nao_aplicado');
        $casos->cor_raca_nao_informada = $request->input('cor_raca_nao_informada');
        $casos->branca = $request->input('branca');
        $casos->parda = $request->input('parda');
        $casos->preta = $request->input('preta');
        $casos->amarela = $request->input('amarela');
        $casos->indigena = $request->input('indigena');
        $casos->total_leitos_clinicos = $request->input('total_leitos_clinicos');
        $casos->leitos_clinicos_em_uso = $request->input('leitos_clinicos_em_uso');
        $casos->total_leitos_uti = $request->input('total_leitos_uti');
        $casos->leitos_uti_em_uso = $request->input('leitos_uti_em_uso');
        $casos->total_leitos_upa = $request->input('total_leitos_upa');
        $casos->leitos_upa_em_uso = $request->input('leitos_upa_em_uso');

        $casos->save();

        $formulario = Formulario::first();

        // $formulario->testesRealizados = $request->input('testesRealizados');
        $formulario->testesNegativos = $request->input('testesNegativos');
        $formulario->exames = $request->input('exames');
        $formulario->suspeitos = $request->input('suspeitos');
        $formulario->testesRapidoRealizados = $request->input('testesRapidoRealizados');
        $formulario->testesPcrRealizados = $request->input('testesPcrRealizados');
        $formulario->teste_rapido_antigeno = $request->input('teste_rapido_antigeno');
        $formulario->teste_sorologico = $request->input('teste_sorologico');
        $formulario->outrosTestesRealizados = $request->input('outrosTestesRealizados');
        $formulario->totalDose = $request->input('totalDose');
        $formulario->primeiraDose = $request->input('primeiraDose');
        $formulario->segundaDose = $request->input('segundaDose');
        $formulario->terceiraDose = $request->input('terceiraDose');
        $formulario->quartaDose = $request->input('quartaDose');

        $formulario->update();

        $obitosPorFaixaEtaria = ObitosFaixaEtaria::first();

        $obitosPorFaixaEtaria->ate1ano = $request->input('obitos_ate1ano');
        $obitosPorFaixaEtaria->de1a4anos = $request->input('obitos_de1a4anos');
        $obitosPorFaixaEtaria->de5a9anos = $request->input('obitos_de5a9anos');
        $obitosPorFaixaEtaria->de10a14anos = $request->input('obitos_de10a14anos');
        $obitosPorFaixaEtaria->de15a19anos = $request->input('obitos_de15a19anos');
        $obitosPorFaixaEtaria->de20a29anos = $request->input('obitos_de20a29anos');
        $obitosPorFaixaEtaria->de30a39anos = $request->input('obitos_de30a39anos');
        $obitosPorFaixaEtaria->de40a49anos = $request->input('obitos_de40a49anos');
        $obitosPorFaixaEtaria->de50a59anos = $request->input('obitos_de50a59anos');
        $obitosPorFaixaEtaria->de60a69anos = $request->input('obitos_de60a69anos');
        $obitosPorFaixaEtaria->de70a79anos = $request->input('obitos_de70a79anos');
        $obitosPorFaixaEtaria->de80oumais = $request->input('obitos_de80oumais');

        $obitosPorFaixaEtaria->update();

        Alert::success('Cadastrado', 'Cadastrado com sucesso');

        return redirect()->route('casos.cadastro'); //->with('success', 'Cadastrado com sucesso!');



    }
    public function lista()
    {
        $casoscadastrados = CasosConfirmado::orderBy('dia','desc')->get();
        return view('lista', compact('casoscadastrados'));
    }




    public function editCasos(Request $request, $id)
    {

        $totalDoseAplicadas = $request->input('primeiraDose') +
        $request->input('segundaDose') +
        $request->input('terceiraDose') +
        $request->input('quartaDose');

        $totalDoseRecebidas = $request->input('totalDose');
        $primeiraDose =$request->input('primeiraDose');
        $segundaDose =$request->input('segundaDose');
        $terceiraDose =$request->input('terceiraDose');
        $quartaDose =$request->input('quartaDose');

        if($primeiraDose > $totalDoseRecebidas){
            return redirect()->back()->withInput()->withErrors("O total de 1º doses aplicadas não pode ser maior que o total de doses recebidas.");
        }else if($segundaDose > $primeiraDose ){
            return redirect()->back()->withInput()->withErrors("O total de 2º doses aplicadas não pode ser maior que o total de 1º doses aplicadas.");
        }else if($terceiraDose > $segundaDose ){
            return redirect()->back()->withInput()->withErrors("O total de 3º doses aplicadas não pode ser maior que o total de 2º doses aplicadas.");
        }else if($quartaDose > $terceiraDose ){
            return redirect()->back()->withInput()->withErrors("O total de 4º doses aplicadas não pode ser maior que o total de 3º doses aplicadas.");
        }else if($primeiraDose + $segundaDose + $terceiraDose + $quartaDose > $totalDoseRecebidas){
            return redirect()->back()->withInput()->withErrors("A aplicação de vacinas da 1º, 2º, 3º e 4º são maiores do que a recebidas.");

        }

        $editar = CasosConfirmado::find($id);


        $dia = $editar->dia;
      /*  $dia2 = $editar->dia->format('d/m/Y');
        $editar->dia = $dia2;*/

        $editarBairros = DB::table('casos_confirmados_bairros')->groupBy('bairro_id')
            ->join('bairros', function ($join) {
                $join->on('bairros.id', '=', 'casos_confirmados_bairros.bairro_id');
            })
            ->selectRaw('casos_confirmados_bairros.*, bairros.*')
            ->where("casos_confirmados_bairros.dia", "=", $dia)
            ->get();

        $bairros = Bairro::orderBy('nome', 'ASC')->get();

        foreach ($editarBairros as $editarBairro) {
            $bairros->find($editarBairro->id)->casos = $editarBairro->casos;
        }

        $formulario = Formulario::first();

        $obitosFaixaEtaria = ObitosFaixaEtaria::first();

        return view('edita', compact('editar', 'bairros', 'formulario','obitosFaixaEtaria'));
    }


    //dados vacinacao

    public function update(UpdateCasosRequest $request, $id)
    {

        $totalDoseAplicadas = $request->input('primeiraDose') +
        $request->input('segundaDose') +
        $request->input('terceiraDose')+
        $request->input('quartaDose');

        $totalDoseRecebidas = $request->input('totalDose');
        $primeiraDose =$request->input('primeiraDose');
        $segundaDose =$request->input('segundaDose');
        $terceiraDose =$request->input('terceiraDose');
        $quartaDose =$request->input('quartaDose');

        if($primeiraDose > $totalDoseRecebidas){
            return redirect()->back()->withInput()->withErrors("O total de 1º doses aplicadas não pode ser maior que o total de doses recebidas.");
        }else if($segundaDose > $primeiraDose ){
            return redirect()->back()->withInput()->withErrors("O total de 2º doses aplicadas não pode ser maior que o total de 1º doses aplicadas.");
        }else if($terceiraDose > $segundaDose ){
            return redirect()->back()->withInput()->withErrors("O total de 3º doses aplicadas não pode ser maior que o total de 2º doses aplicadas.");
        }else if($quartaDose > $terceiraDose ){
            return redirect()->back()->withInput()->withErrors("O total de 4º doses aplicadas não pode ser maior que o total de 3º doses aplicadas.");
        }else if($primeiraDose + $segundaDose + $terceiraDose + $quartaDose > $totalDoseRecebidas){
            return redirect()->back()->withInput()->withErrors("A aplicação de vacinas da 1º, 2º, 3º e 4º são maiores do que a recebidas.");

        }

        $edit = CasosConfirmado::find($id);
        $dataAtual = $edit->dia;

        $edit->obitos = $request->input('obitos');
        $edit->recuperados = $request->input('recuperados');
        $edit->dia = $request->input('dia');
        $edit->masculino = $request->input('masculino');
        $edit->feminino = $request->input('feminino');
        $edit->ate1ano = $request->input('ate1ano');
        $edit->de1a4anos = $request->input('de1a4anos');
        $edit->de5a9anos = $request->input('de5a9anos');
        $edit->de10a14anos = $request->input('de10a14anos');
        $edit->de15a19anos = $request->input('de15a19anos');
        $edit->de20a29anos = $request->input('de20a29anos');
        $edit->de30a39anos = $request->input('de30a39anos');
        $edit->de40a49anos = $request->input('de40a49anos');
        $edit->de50a59anos = $request->input('de50a59anos');
        $edit->de60a69anos = $request->input('de60a69anos');
        $edit->de70a79anos = $request->input('de70a79anos');
        $edit->de80oumais = $request->input('de80oumais');
        $edit->branca = $request->input('branca');
        $edit->parda = $request->input('parda');
        $edit->preta = $request->input('preta');
        $edit->amarela = $request->input('amarela');
        $edit->indigena = $request->input('indigena');
        $edit->analfabeto = $request->input('analfabeto');
        $edit->ensino_fundamental = $request->input('ensino_fundamental');
        $edit->ensino_medio = $request->input('ensino_medio');
        $edit->ensino_superior = $request->input('ensino_superior');
        $edit->escolaridade_nao_informada = $request->input('escolaridade_nao_informada');
        $edit->nao_aplicado = $request->input('nao_aplicado');
        $edit->cor_raca_nao_informada = $request->input('cor_raca_nao_informada');
        $edit->total_leitos_clinicos = $request->input('total_leitos_clinicos');
        $edit->leitos_clinicos_em_uso = $request->input('leitos_clinicos_em_uso');
        $edit->total_leitos_uti = $request->input('total_leitos_uti');
        $edit->leitos_uti_em_uso = $request->input('leitos_uti_em_uso');
        $edit->total_leitos_upa = $request->input('total_leitos_upa');
        $edit->leitos_upa_em_uso = $request->input('leitos_upa_em_uso');

        $valorTotalSexo = $request->input('masculino') + $request->input('feminino');
        $valorTotalFaixaEtaria = $request->input('ate1ano') +
        $request->input('de1a4anos') +
        $request->input('de5a9anos') +
        $request->input('de10a14anos') +
        $request->input('de15a19anos') +
        $request->input('de20a29anos') +
        $request->input('de30a39anos') +
        $request->input('de40a49anos') +
        $request->input('de50a59anos') +
        $request->input('de60a69anos') +
        $request->input('de70a79anos') +
        $request->input('de80oumais');

        $totalDoseAplicadas = $request->input('primeiraDose') +
        $request->input('segundaDose') +
        $request->input('terceiraDose') +
        $request->input('quartaDose');

        $valorTotalCorRaca = $request->input('cor_raca_nao_informada') +
        $request->input('branca') +
        $request->input('parda') +
        $request->input('preta') +
        $request->input('indigena') +
        $request->input('amarela');

        $valorTotalEscolaridade = $request->input('analfabeto') +
        $request->input('ensino_fundamental') +
        $request->input('ensino_medio') +
        $request->input('ensino_superior') +
        $request->input('escolaridade_nao_informada') +
        $request->input('nao_aplicado');

        // Validação que impede soma de Óbitos, Recuperados e Ativos > Casos

        $casosConfirmados = CasosConfirmado::selectRaw('SUM(casos) as casos, SUM(obitos) as obitos, SUM(recuperados) as recuperados')
        ->where('id', '<', function($query){
            $query->selectRaw('MAX(id)')->from('casos_confirmados');
        })
        ->get();

        $novoValorCasos = $casosConfirmados[0]->casos + $request->input('casos');
        $novoValorObitos = $casosConfirmados[0]->obitos + $request->input('obitos');
        $novoValorRecuperados = $casosConfirmados[0]->recuperados + $request->input('recuperados');
        $novoValorVirusAtivo = $novoValorCasos - ($novoValorObitos + $novoValorRecuperados);

        if($novoValorVirusAtivo < 0){
            if ($novoValorCasos == ($novoValorObitos + $novoValorRecuperados + ($novoValorVirusAtivo * (-1))) ){
                $obitosRecuperados = $valorTotalSexo;
            }else{
                $obitosRecuperados = 3.14;
            }
        }else{
            if ($novoValorCasos == ($novoValorObitos + $novoValorRecuperados + $novoValorVirusAtivo) ){
                $obitosRecuperados = $valorTotalSexo;
            }else{
                $obitosRecuperados = 3.14;
            }
        }

        // Fim da Validação

        $totalObitosFaixaEtaria = ($request->input('obitos_ate1ano')
        + $request->input('obitos_de1a4anos')
        + $request->input('obitos_de5a9anos')
        + $request->input('obitos_de10a14anos')
        + $request->input('obitos_de15a19anos')
        + $request->input('obitos_de20a29anos')
        + $request->input('obitos_de30a39anos')
        + $request->input('obitos_de40a49anos')
        + $request->input('obitos_de50a59anos')
        + $request->input('obitos_de60a69anos')
        + $request->input('obitos_de70a79anos')
        + $request->input('obitos_de80oumais'));


        $bairros = Bairro::all();

        $valorTotalBairros = 0;

        foreach ($bairros as $bairro) {
            if ($request->input($bairro->id . '_casos') > '0') {
                $valorTotalBairros = $valorTotalBairros + $request->input($bairro->id . '_casos');
            }
        }

        $regras = [
            'casos' => ['required',
                new ComparaValorTotal("sexo", $valorTotalSexo),
                new ComparaValorTotal("faixaEtaria", $valorTotalFaixaEtaria),
                new ComparaValorTotal("bairros", $valorTotalBairros),
                new ComparaValorTotal("escolaridade", $valorTotalEscolaridade),
                new ComparaValorTotal("corRaca", $valorTotalCorRaca),
                new ComparaValorTotal("obitosRecuperados", $obitosRecuperados),

            ],
            'obitos' => ['required', new ComparaTotalObitos
            ($casosConfirmados[0]->obitos+$request->input('obitos'),$totalObitosFaixaEtaria)
        ],
        /*
        'totalDose' => ['required',

        new DadosVacinacao("totalDoseAplicadas",$request->input('totalDoseAplicadas')),
        new DadosVacinacao("primeiraDose", $request->input('primeiraDose')),
        new DadosVacinacao("segundaDose", $request->input('segundaDose')),
        new DadosVacinacao("terceiraDose", $request->input('terceiraDose')),
        ]*/

        ];




        $mensagens = [
            'required' => 'O campo é necessario',
        ];

        $request->validate($regras, $mensagens);

        $bairros = Bairro::all();

        foreach ($bairros as $bairro) {
            if ($request->input($bairro->id . '_casos') > '0') {

                if ($edit->dia !== $dataAtual) {
                    error_log("Datas diferentes:" . $edit->dia . " " . $dataAtual);
                $casosBairro = CasosConfirmadosBairro::where([
                    ['dia', '=', $dataAtual],
                    ['bairro_id', '=', $bairro->id],
                ])->first();
                } else {
                    $casosBairro = CasosConfirmadosBairro::where([
                        ['dia', '=', $edit->dia],
                        ['bairro_id', '=', $bairro->id],
                    ])->first();

                }

                if (!$casosBairro) {
                    $casosBairro = new CasosConfirmadosBairro();

                    $casosBairro->bairro_id = $bairro->id;
                    $casosBairro->dia = $request->input('dia');
                    $casosBairro->casos = $request->input($bairro->id . '_casos');

                    $casosBairro->save();
                } else {
                    $casosBairro->casos = $request->input($bairro->id . '_casos');
                    $casosBairro->dia = $edit->dia;
                    $casosBairro->update();
                }
            }
        }

        $edit->casos = CasosConfirmadosBairro::where('dia', '=', $edit->dia)->selectRaw('SUM(casos) as casos')->first()->casos;
        $edit->update();

        $formulario = Formulario::first();

        // $formulario->testesRealizados = $request->input('testesRealizados');
        $formulario->testesNegativos = $request->input('testesNegativos');
        $formulario->exames = $request->input('exames');
        $formulario->suspeitos = $request->input('suspeitos');
        $formulario->testesRapidoRealizados = $request->input('testesRapidoRealizados');
        $formulario->testesPcrRealizados = $request->input('testesPcrRealizados');
        $formulario->teste_rapido_antigeno = $request->input('teste_rapido_antigeno');
        $formulario->teste_sorologico = $request->input('teste_sorologico');
        $formulario->outrosTestesRealizados = $request->input('outrosTestesRealizados');
        $formulario->totalDose = $request->input('totalDose');
        $formulario->primeiraDose = $request->input('primeiraDose');
        $formulario->segundaDose = $request->input('segundaDose');
        $formulario->terceiraDose = $request->input('terceiraDose');
        $formulario->quartaDose = $request->input('quartaDose');


        $formulario->update();

        $obitosPorFaixaEtaria = ObitosFaixaEtaria::first();

        $obitosPorFaixaEtaria->ate1ano = $request->input('obitos_ate1ano');
        $obitosPorFaixaEtaria->de1a4anos = $request->input('obitos_de1a4anos');
        $obitosPorFaixaEtaria->de5a9anos = $request->input('obitos_de5a9anos');
        $obitosPorFaixaEtaria->de10a14anos = $request->input('obitos_de10a14anos');
        $obitosPorFaixaEtaria->de15a19anos = $request->input('obitos_de15a19anos');
        $obitosPorFaixaEtaria->de20a29anos = $request->input('obitos_de20a29anos');
        $obitosPorFaixaEtaria->de30a39anos = $request->input('obitos_de30a39anos');
        $obitosPorFaixaEtaria->de40a49anos = $request->input('obitos_de40a49anos');
        $obitosPorFaixaEtaria->de50a59anos = $request->input('obitos_de50a59anos');
        $obitosPorFaixaEtaria->de60a69anos = $request->input('obitos_de60a69anos');
        $obitosPorFaixaEtaria->de70a79anos = $request->input('obitos_de70a79anos');
        $obitosPorFaixaEtaria->de80oumais = $request->input('obitos_de80oumais');

        $obitosPorFaixaEtaria->update();

        Log::info('O cadastro ' . $id . ' foi atualizado.');


        //Alert::success('Editado', 'Editado com sucesso');

        return redirect()->route('casos.editcasos', ['id' => $id])->with('success', 'Salvo com sucesso!');

    }

    public function menu()
    {
        //dd($lastRecord);
        return view('main' /*, compact('lastRecord')*/);
    }

    public function uploadArquivoIndex(){
        return view('uploasArquivos');
    }

    public function uploadArquivos(Request $request){

        $request->file('file')->store('upload');

        // return view('uploasArquivos');
        return redirect()->route('casos.arquivos');
    }

    public function downloadArquivos(){

        return response()->download(public_path('03093259-nota-informativa-15-31-07-2020-final.pdf'));

    }

    public function downloadArquivos2(){

        return response()->download(public_path('CRITERIOS MUNICIPAIS COLETA COVID PÚBLICOS atualização 06.08.20.pdf'));

    }

    public function arquivosdownload(){
        return response()->download(public_path('Planosdecontingencia.pdf'));
    }

}
