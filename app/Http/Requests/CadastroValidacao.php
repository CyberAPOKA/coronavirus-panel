<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\ComparaValorTotal;
use App\Rules\DadosVacinacao;

class CadastroValidacao extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        /*$valorTotalSexo = input('masculino') + input('feminino');*/

        return [
           'obitos' => 'required',
            'dia' => 'required|unique:casos_confirmados,dia',
            'masculino' => 'required',
            'feminino' => 'required',
            'ate1ano' => 'required',
            'de1a4anos' => 'required',
            'de5a9anos' => 'required',
            'de10a14anos' => 'required',
            'de15a19anos' => 'required',
            'de20a29anos' => 'required',
            'de30a39anos' => 'required',
            'de40a49anos' => 'required',
            'de50a59anos' => 'required',
            'de60a69anos' => 'required',
            'de70a79anos' => 'required',
            'de80oumais' => 'required',
            '1_casos' => 'required',
            '2_casos' => 'required',
            '3_casos' => 'required',
            '4_casos' => 'required',
            '5_casos' => 'required',
            '6_casos' => 'required',
            '7_casos' => 'required',
            '8_casos' => 'required',
            '9_casos' => 'required',
            '10_casos' => 'required',
            '11_casos' => 'required',
            '12_casos' => 'required',
            '13_casos' => 'required',
            '14_casos' => 'required',
            '15_casos' => 'required',
            '16_casos' => 'required',
            '17_casos' => 'required',
            '18_casos' => 'required',
            '19_casos' => 'required',
            '20_casos' => 'required',
            '21_casos' => 'required',
            '22_casos' => 'required',
            '23_casos' => 'required',
            '24_casos' => 'required',
            'branca' => 'required',
            'parda' => 'required',
            'preta' => 'required',
            'amarela' => 'required',
            'indigena' => 'required',
            'cor_raca_nao_informada' => 'required',
            'analfabeto' => 'required',
            'ensino_fundamental' => 'required',
            'ensino_medio' => 'required',
            'ensino_superior' => 'required',
            'escolaridade_nao_informada' => 'required',
            'nao_aplicado' => 'required',
            'total_leitos_clinicos' => 'required',
            'leitos_clinicos_em_uso' => 'required',
            'total_leitos_uti' => 'required',
            'leitos_uti_em_uso' => 'required',

            //'totalDose' => ['required', new DadosVacinacao],
            'totalDose' => 'required',
            'primeiraDose' => 'required',
            'segundaDose' => 'required',
            'terceiraDose' => 'required',
            'quartaDose' => 'required',



        ];
    }

    public function messages()
    {
        return [
            'required' => 'Campo é necessario',
            'unique' => 'O dia já consta em nossa base de dados'

        ];
    }
}
