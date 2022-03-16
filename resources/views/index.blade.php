
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Monitoramento COVID-19 São Leopoldo</title>
        <link rel="icon" href="{{asset('brasao.ico')}}">

        <link href="{{asset('css/css-circular-prog-bar.css')}}" media="all" rel="stylesheet" />

        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
            integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
            crossorigin="" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
            integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


        <link href="{{asset('css/sb-admin-2.min.css')}}" rel="stylesheet">
        <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
        <!-- Custom fonts for this template-->
        <link rel="stylesheet" href="{{ asset('/css/estiloPainel.css') }}">
        <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,700;1,700&display=swap" rel="stylesheet">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
            integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
            crossorigin=""></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
        </script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
        </script>



        {{-- ApexCharts --}}
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>



    </head>

    <body id="page-top">

        <!-- Page Wrapper -->
        <div id="wrapper">
            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column"  style='background-image: url({{asset('assets/img/fundo_verde_claro.png')}});'>
                <!-- Main Content -->
                <div id="content">
                    <nav class="navbar navbar-expand navbar-light topbar static-top shadow navMobile">
                        <div class="w-25 tituloMobile ">
                            <img class="brasao" src="{{asset('assets/img/logoPMSL.png')}}" alt="">
                        </div>

                        <div class="w-50 header tituloMobile">
                            MONITORAMENTO COVID-19
                        </div>
                        <div class="w-25 tituloMobile logo ">
                            <img class="logo" src="{{asset('assets/img/logo_novo_governo.png')}}" alt="">
                      </div>

                        <!-- Topbar Navbar -->
                    </nav>
                </div>

                @if (!is_null($lastRecord))
                    <div class="row align-items-center"
                        style="font-size: 14px;padding-top: 20px;justify-content: center!important;">
                        <i class="fas fa-retweet fa-2x text-gray-400" style="margin: 5px"></i>

                        <div>Atualizado em: {{$lastRecord->updated_at->format('d/m/Y H:i:s')}} </div>
                    </div>
                @endif

                <div class="container-fluid " style="padding-top: 20px;padding-bottom: 50px">

                    <!-- Content Row -->
                    <div class="row infos" style="justify-content: center!important" >


                         <!-- DADOS DA VACINAÇÃO -->

                    <div class="col-xl-11 col-lg-7 col-md-12 " style="padding-bottom: 50px" >
                        <div class="card text-center shadow mb-4" style="background-color: transparent;">
                            <!-- Card Header - Dropdown -->
                            <div style="background-color: transparent"
                                class="card-header py-3 text-center flex-row align-items-center justify-content-between" >
                                <h6 class="m-0 font-weight-bold text-light" style="font-size: 40px">Vacinômetro São Leopoldo </h6>

                            </div>
                            <div class="container graphContainer" style="padding-bottom: 50px;width: 60%">


                                <div class="leitoTitulo" style="padding: 15px;font-size: 35px; ">Total de doses aplicadas: {{ (!is_null($formulario)) ? number_format($formulario->primeiraDose+$formulario->segundaDose+$formulario->terceiraDose+$formulario->quartaDose, 0,'.', '.') : 0}}</div>

                                <div class="col leitoInfo" style="font-size: 50px;"></div>

                                <div class="row" >

                                        <div class="form-group col-md-6">
                                            <div class="row align-items-center">
                                            <div class="col" style="padding-top: 65px; font-size: 30px;">1º Dose:</div>
                                                <div class="col leitoInfo" style="padding-top: 65px; font-size: 50px;">{{ (!is_null($formulario)) ? number_format($formulario->primeiraDose, 0,'.', '.') : 0}}</div>

                                        </div>
                                    </div>

                                        <div class="form-group col-md-6">
                                            <label class="control-label">População total:</label>
                                            @if (!is_null($formulario) )
                                                    <div class="progress-circle over50 p110 mx-auto" id="graph4" data-percent="{{ ($formulario->primeiraDose != 0) ? number_format(($formulario->primeiraDose*100)/238468, 2) : 0 }}"></div>
                                                @else
                                                    <div class="progress-circle over50 p110 mx-auto" id="graph4" data-percent="0"></div>
                                                @endif
                                </div>
                                </div>
                                <div class="row" >

                                    <div class="form-group col-md-6">
                                        <div class="row align-items-center">
                                            <div class="col" style="padding-top: 65px; font-size: 30px;">2º Dose ou dose única:</div>

                                            <div class="col leitoInfo" style="padding-top: 65px; font-size: 50px;">{{ (!is_null($formulario)) ? number_format($formulario->segundaDose, 0,'.', '.') : 0}}
                                            </div>
                                            </div>

                                </div>


                                    <div class="form-group col-md-6">
                                        <label  class="control-label">População total:</label>
                                        @if (!is_null($formulario) )
                                        <div class="progress-circle over50 p110 mx-auto" id="graph6" data-percent="{{ ($formulario->segundaDose != 0) ? number_format(($formulario->segundaDose*100)/238468, 2) : 0 }}"></div>
                                    @else
                                        <div class="progress-circle over50 p110 mx-auto" id="graph6" data-percent="0"></div>
                                    @endif


                            </div>
                            </div>
                            <div class="row" >

                                <div class="form-group col-md-6">
                                    <div class="row align-items-center">
                                         <div class="col" style="padding-top: 65px; font-size: 30px;">3º Dose:</div>
                                        <div class="col leitoInfo" style="padding-top: 65px; font-size: 50px;">{{ (!is_null($formulario)) ? number_format($formulario->terceiraDose, 0,'.', '.') : 0}}
                                        </div>
                                        </div>
                                    </div>


                                <div class="form-group col-md-6">
                                    <label class="control-label">População total:</label>

                                    @if (!is_null($formulario) )
                                                    <div class="progress-circle over50 p110 mx-auto" id="graph8" data-percent="{{ ($formulario->terceiraDose != 0) ? number_format(($formulario->terceiraDose*100)/238468, 2) : 0 }}"></div>
                                                @else
                                                    <div class="progress-circle over50 p110 mx-auto" id="graph8" data-percent="0"></div>
                                                @endif

                            </div>
                        </div>

                        <div class="row" >

                            <div class="form-group col-md-6">
                                <div class="row align-items-center">
                                     <div class="col" style="padding-top: 65px; font-size: 30px;">4º Dose:</div>

                                    <div class="col leitoInfo" style="padding-top: 65px; font-size: 50px;">{{ (!is_null($formulario)) ? number_format($formulario->quartaDose, 0,'.', '.') : 0}}
                                    </div>
                                    </div>
                                </div>



                            <div class="form-group col-md-6">
                                <label class="control-label">População total:</label>

                                @if (!is_null($formulario) )
                                                <div class="progress-circle over50 p110 mx-auto" id="graph9" data-percent="{{ ($formulario->quartaDose != 0) ? number_format(($formulario->quartaDose*100)/238468, 2) : 0 }}"></div>
                                            @else
                                                <div class="progress-circle over50 p110 mx-auto" id="graph9" data-percent="0"></div>
                                            @endif

                        </div>
                    </div>


                                <div class="leitoTitulo" style="padding: 15px;font-size: 30px; ">Total de doses recebidas: {{ (!is_null($formulario)) ? number_format($formulario->totalDose, 0,'.', '.') : 0}}</div>
                                <div class="leitoTitulo" style="padding: 15px;font-size: 20px; ">O percentual de vacinados usa como referência 218.216 habitantes acima de 12 anos, e 238.468 como população total, de acordo com os dados do IBGE e da SES/RS.</div>

                        </div>
                    </div>
                </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-lg-7 col-md-12 mb-4 infos2" >
                            <div class="card border-left-warning shadow h-100 py-2" style="background-color: transparent">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info2 text-uppercase mb-1">
                                                Casos Positivos</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-400">
                                                {{ number_format(end($casos), 0,'.', '.') }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-virus fa-2x text-gray-400"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-lg-7 col-md-12 mb-4 infos2">
                            <div class="card border-left-success shadow h-100 py-2 exames" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background-color: transparent">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info2 text-uppercase mb-1">
                                                Testes Realizados</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-400">
                                                {{ (!is_null($formulario)) ? number_format(($formulario->testesRapidoRealizados + $formulario->testesPcrRealizados + $formulario->outrosTestesRealizados + $formulario->teste_rapido_antigeno + $formulario->teste_sorologico), 0, '.', '.') : 0 }}
                                                {{-- {{ (!is_null($formulario)) ? number_format($formulario->testesRealizados, 0, '.', '.') : 0 }} --}}
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-vial fa-2x text-gray-400"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-lg-7 col-md-12 mb-4 infos2">
                            <div class="card border-left-info shadow h-100 py-2" style="background-color: transparent">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info2 text-uppercase mb-1">
                                                Pessoas com Vírus Ativo</div>
                                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-400">
                                                {{ number_format(end($virusAtivo), 0,'.', '.') }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user-plus fa-2x text-gray-400"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>


                    <!-- Content Row -->
                    <div class="row infos" style="justify-content: center!important;">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-lg-7 col-md-12 mb-4 infos2">
                            <div class="card border-left-warning shadow h-100 py-2" style="background-color: transparent">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info2 text-uppercase mb-1">
                                                Pacientes recuperados</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-400">
                                                {{ number_format(end($recuperados), 0,'.', '.')  }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user-check fa-2x text-gray-400"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-lg-7 col-md-12 mb-4 infos2">
                            <div class="card border-left-success shadow h-100 py-2" style="background-color: transparent">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info2 text-uppercase mb-1">
                                                Suspeitos aguardando resultado</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-400">
                                                {{ (!is_null($formulario)) ? number_format($formulario->suspeitos, 0,'.', '.') : 0 }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user-clock fa-2x text-gray-400"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-lg-7 col-md-12 mb-4 infos2">
                            <div class="card border-left-info shadow h-100 py-2" style="background-color: transparent">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info2 text-uppercase mb-1">
                                                Testes Negativos</div>
                                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-400">
                                                {{ (!is_null($formulario)) ? number_format($formulario->testesNegativos, 0,'.', '.') : 0 }}</div>

                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user-minus fa-2x text-gray-400"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- Content Row -->

                    <!-- Content Row -->
                    <div class="row infos" style="justify-content: center!important;">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-lg-7 col-md-12 mb-4 infos2">
                            <div class="card border-left-warning shadow h-100 py-2" style="background-color: transparent">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info2 text-uppercase mb-1">
                                                Internações/Covid no Hospital Centenário</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-400">
                                                {{$hospitalizados}}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-hospital-user fa-2x text-gray-400"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-lg-7 col-md-12 mb-4 infos2">
                            <div class="card border-left-success shadow h-100 py-2" style="background-color: transparent">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info2 text-uppercase mb-1">
                                                Exames em residentes de outros municípios</div>

                                            <div class="h5 mb-0 font-weight-bold text-gray-400">
                                                {{ (!is_null($formulario)) ? number_format($formulario->exames, 0,'.', '.') : 0 }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x text-gray-400"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-lg-7 col-md-12 mb-4 infos2">
                            <div class="card border-left-info shadow h-100 py-2" style="background-color: transparent">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info2 text-uppercase mb-1">Óbitos</div>

                                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-400">
                                                {{  number_format(end($obitos), 0,'.', '.') }}</div>

                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-cross fa-2x text-gray-400"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- Content Row -->

                </div>

                <!-- Area Chart -->
                <div class="Container">

                    <div class="teste3">

                    <div class="col-xl-11 col-lg-7 quadroAviso" style="padding-bottom: 50px;" >
                       <div class="card text-center shadow mb-4 justify-content-between " style="background-color: transparent;padding: 15px;">
                       <i class="fas fa-exclamation-circle fa-3x text-gray-400"></i>
                       <div style="padding-top: 5px">
                        <a href="https://www.saoleopoldo.rs.gov.br/examescorona" target="_blanc"> Acesse aqui o resultado do seu exame Covid.</a>
                       </div>
                    </div>
                </div>



                        <div class="col-xl-11 col-lg-7" style="padding-bottom: 50px" >
                            <div class="card text-center shadow mb-4" style="background-color: transparent;">
                                <!-- Card Header - Dropdown -->
                                <div style="background-color: transparent"
                                    class="card-header py-3 text-center flex-row align-items-center justify-content-between" >
                                    <h6 class="m-0 font-weight-bold text-light">Ocupação Área COVID-19</h6>

                                </div>
                                <div class="container graphContainer" style="padding-bottom: 50px;width: 60%">

                                    <div class="leitoTitulo" style="padding: 15px;font-size: 30px; ">Leitos Clínicos Covid - Hospital Centenário</div>

                                    <div class="row" >
                                        <div class="col-xl-6" >
                                            <div class="row align-items-center">
                                                <div class="col leitoIcone">
                                                    <i class="fas fa-bed fa-3x text-gray-400"></i>
                                                </div>
                                                <div class="col">Totais:</div>
                                                <div class="col leitoInfo" style="font-size: 50px;">{{ (!is_null($formulario)) ? $numerosLeitos->total_leitos_clinicos : 0}}</div>
                                            </div>

                                            <div class="row align-items-center">
                                                <div class="col leitoIcone">
                                                    <i class="fas fa-user fa-3x text-gray-400"></i>
                                                </div>
                                                <div class="col">Ocupados:</div>
                                                <div class="col leitoInfo" style="font-size: 50px;">{{ (!is_null($formulario)) ? $numerosLeitos->leitos_clinicos_em_uso : 0}}</div>
                                            </div>

                                        </div>

                                        <div class="col-xl-6 align-items-center graphLeito">
                                            <div class="row align-items-center" style="height: 100%;">

                                                <div class="col align-items-center">Percentual de ocupação:</div>

                                                @if (!is_null($formulario) )
                                                    <div class="progress-circle over50 p110 mx-auto" id="graph" data-percent="{{ ($numerosLeitos->total_leitos_clinicos != 0) ? number_format(($numerosLeitos->leitos_clinicos_em_uso*100)/$numerosLeitos->total_leitos_clinicos, 2) : 0 }}"></div>
                                                @else
                                                    <div class="progress-circle over50 p110 mx-auto" id="graph" data-percent="0"></div>
                                                @endif


                                            </div>
                                        </div>
                                    </div>



                                    <div class="leitoTitulo" style="padding: 15px;font-size: 30px;">Leitos UTI Covid - Hospital Centenário</div>

                                    <div class="row">
                                        <div class="col-xl-6">
                                            <div class="row align-items-center" >
                                                <div class="col leitoIcone">
                                                    <i class="fas fa-bed fa-3x text-gray-400"></i>
                                                </div>
                                                <div class="col">Totais:</div>
                                                <div class="col leitoInfo" style="font-size: 50px;">{{ (!is_null($formulario)) ? $numerosLeitos->total_leitos_uti : 0 }}</div>
                                            </div>

                                            <div class="row align-items-center">
                                                <div class="col leitoIcone">
                                                    <i class="fas fa-user fa-3x text-gray-400"></i>
                                                </div>
                                                <div class="col">Ocupados:</div>
                                                <div class="col leitoInfo" style="font-size: 50px;">{{ (!is_null($formulario)) ? $numerosLeitos->leitos_uti_em_uso : 0}}</div>
                                            </div>

                                        </div>

                                        <div class="col-xl-6 align-items-center graphLeito">
                                            <div class="row  align-items-center" style="height: 100%;">

                                                <div class="col align-items-center">Percentual de ocupação:</div>

                                                @if (!is_null($formulario))
                                                    <div class="progress-circle over50 p110 mx-auto" id="graph2" data-percent="{{ ($numerosLeitos->total_leitos_uti != 0) ? number_format(($numerosLeitos->leitos_uti_em_uso*100)/$numerosLeitos->total_leitos_uti, 2) : 0 }}"></div>
                                                @else
                                                   <div class="progress-circle over50 p110 mx-auto" id="graph2" data-percent="0"></div>
                                                @endif

                                            </div>
                                        </div>
                                    </div>

                                <!--
                                    <div class="leitoTitulo" style="padding: 15px;font-size: 30px;">Lotação Covid- UPA Zona Norte</div>

                                    <div class="row">
                                        <div class="col-xl-6">
                                            <div class="row align-items-center" >
                                                <div class="col leitoIcone">
                                                    <i class="fas fa-bed fa-3x text-gray-400"></i>
                                                </div>
                                                <div class="col">Totais:</div>
                                                <div class="col leitoInfo" style="font-size: 50px;">{{ (!is_null($formulario)) ? $numerosLeitos->total_leitos_upa : 0 }}</div>
                                            </div>

                                            <div class="row align-items-center">
                                                <div class="col leitoIcone">
                                                    <i class="fas fa-user fa-3x text-gray-400"></i>
                                                </div>
                                                <div class="col">Ocupados:</div>
                                                <div class="col leitoInfo" style="font-size: 50px;">{{ (!is_null($formulario)) ? $numerosLeitos->leitos_upa_em_uso : 0}}</div>
                                            </div>

                                        </div>

                                        <div class="col-xl-6 align-items-center graphLeito">
                                            <div class="row  align-items-center" style="height: 100%;">

                                                <div class="col align-items-center">Percentual de ocupação:</div>

                                                @if (!is_null($formulario))
                                                    <div class="progress-circle over50 p110 mx-auto" id="graph3" data-percent="{{ ($numerosLeitos->total_leitos_upa != 0) ? number_format(($numerosLeitos->leitos_upa_em_uso*100)/$numerosLeitos->total_leitos_upa, 2) : 0 }}"></div>
                                                @else
                                                   <div class="progress-circle over50 p110 mx-auto" id="graph3" data-percent="0"></div>
                                                @endif

                                            </div>
                                        </div>
                                    </div>

                                    -->

                                </div>
                            </div>
                        </div>

                        <div class="col-xl-11 col-lg-7" style="padding-bottom: 50px">
                            <div class="card shadow mb-4" style="background-color: transparent">
                                <!-- Card Header - Dropdown -->
                                <div style="background-color: transparent"
                                    class="card-header text-center py-3 flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-light text-center">Hospital Centenário - Ocupação de Leitos por Data </h6>

                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    {{-- <div>
                                        <div align="center">
                                            <button id="umMesComparativo" class="btn btn-info botao active botaoOcupacaoLeitos" onclick="">
                                                1 Mês
                                            </button>
                                            <button id="tresMesesComparativo" class="btn btn-info botao botaoOcupacaoLeitos" onclick="">
                                                3 Meses
                                            </button>
                                            <button id="seisMesesComparativo" class="btn btn-info botao botaoOcupacaoLeitos" onclick="">
                                                6 Meses
                                            </button>
                                            <button id="tudoComparativo" class="btn btn-info botao botaoOcupacaoLeitos" onclick="">
                                                Tudo
                                            </button>
                                        </div>
                                    </div> --}}
                                    <div id="leitosPorData"></div>
                                </div>
                            </div>
                        </div>



                        <div class="col-xl-11 col-lg-7" style="padding-bottom: 50px">
                            <div class="card text-center shadow mb-4" style="background-color: transparent;">
                                <!-- Card Header - Dropdown -->
                                <div style="background-color: transparent; " class="card-header py-3  flex-row align-items-center justify-content-between" >
                                    <h6 class="m-0 font-weight-bold text-light">Ampliação da Testagem do Coronavírus em
                                        São Leopoldo</h6>

                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class='infTestagem'>
                                        População de acordo com IBGE(2019): <span id='infDestaque'>236.835</span>
                                    </div>

                                    <div class='infTestagem'>
                                        Pessoas testadas:
                                        <span id='infDestaque'>
                                            {{ (!is_null($formulario)) ? number_format(($formulario->testesRapidoRealizados + $formulario->testesPcrRealizados + $formulario->outrosTestesRealizados + $formulario->teste_rapido_antigeno + $formulario->teste_sorologico), 0, '.', '.') : 0 }}
                                            {{-- {{ (!is_null($formulario)) ? number_format($formulario->testesRealizados, 0, '.', '.') : 0 }} --}}
                                        </span>
                                    </div>

                                    <div class="infTestagem">
                                        RT-PCR: <span id="infDestaque">{{ (!is_null($formulario)) ? number_format($formulario->testesPcrRealizados, 0, '.', '.') : 0 }}</span>
                                    </div>
                                    <div class="infTestagem">
                                        Teste Rápido Antígeno: <span id="infDestaque">{{ (!is_null($formulario)) ? number_format($formulario->teste_rapido_antigeno, 0, '.', '.') : 0 }}</span>
                                    </div>
                                    <div class="infTestagem">
                                        Teste Rápido Anticorpo: <span id="infDestaque">{{ (!is_null($formulario)) ? number_format($formulario->testesRapidoRealizados, 0,'.', '.') : 0 }}</span>
                                    </div>
                                    <div class="infTestagem">
                                        Teste Sorológico: <span id="infDestaque">{{ (!is_null($formulario)) ? number_format($formulario->teste_sorologico, 0, '.', '.') : 0 }}</span>
                                    </div>
                                    <div class="infTestagem">
                                        Clínico Imagem/Tomografia: <span id="infDestaque">{{ (!is_null($formulario)) ? number_format($formulario->outrosTestesRealizados, 0, '.', '.') : 0 }}</span>
                                    </div>

                                    <div class='infTestagem'>
                                        Média de <span id='infDestaque'>
                                            {{ (!is_null($formulario)) ? number_format(floor((($formulario->testesRapidoRealizados + $formulario->testesPcrRealizados + $formulario->outrosTestesRealizados)/236835)*100000), 0,'.', '.') : 0}} testes
                                            {{-- {{ (!is_null($formulario)) ? number_format(floor(($formulario->testesRealizados/236835)*100000), 0,'.', '.') : 0}} testes --}}
                                        </span> por 100 mil habitantes
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-11 col-lg-7" style="padding-bottom: 50px ">
                            <div class="card shadow mb-4" style="background-color: transparent">
                                <!-- Card Header - Dropdown -->
                                <div style="background-color: transparent;"
                                    class="card-header text-center py-3 flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-light text-center">Comparativo entre Casos
                                        Positivos e Recuperados</h6>

                                </div>
                                <!-- Card Body -->
                                <div class="card-body" >
                                    <div>
                                        <div align="center">
                                            <button id="umMesComparativo" class="btn btn-info botao active botaoComparativo" onclick="">
                                                1 Mês
                                            </button>
                                            <button id="tresMesesComparativo" class="btn btn-info botao botaoComparativo" onclick="">
                                                3 Meses
                                            </button>
                                            <button id="seisMesesComparativo" class="btn btn-info botao botaoComparativo" onclick="">
                                                6 Meses
                                            </button>
                                            <button id="tudoComparativo" class="btn btn-info botao  botaoComparativo" onclick="">
                                                Tudo
                                            </button>
                                        </div>
                                    </div>
                                    <div id="compCasosRecuperados"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-11 col-lg-7" style="padding-bottom: 50px">
                            <div class="card shadow mb-4" style="background-color: transparent">
                                <!-- Card Header - Dropdown -->
                                <div style="background-color: transparent"
                                    class="card-header text-center py-3 flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-light text-center">Comparativo entre Vírus Ativo e Óbitos</h6>

                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div>
                                        <div align="center">
                                            <button id="umMesComparativoAtivoObitos" class="btn btn-info botao active botaoComparativoAtivoObitos" onclick="">
                                                1 Mês
                                            </button>
                                            <button id="tresMesesComparativoAtivoObitos" class="btn btn-info botao botaoComparativoAtivoObitos" onclick="">
                                                3 Meses
                                            </button>
                                            <button id="seisMesesComparativoAtivoObitos" class="btn btn-info botao botaoComparativoAtivoObitos" onclick="">
                                                6 Meses
                                            </button>
                                            <button id="tudoComparativoAtivoObitos" class="btn btn-info botao botaoComparativoAtivoObitos" onclick="">
                                                Tudo
                                            </button>
                                        </div>
                                    </div>
                                    <div id="compAtivosObitos"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-11 col-lg-7" style="padding-bottom: 50px">
                            <div class="card shadow mb-4" style="background-color: transparent">
                                <!-- Card Header - Dropdown -->
                                <div style="background-color: transparent"
                                    class="card-header text-center py-3 flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-light">Novos Casos Positivos por Data</h6>

                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div>
                                        <div align="center">
                                            <button id="mesPorData" class="btn btn-info botao active botaoCasosData">1 Mês</button>
                                            <button id="tresMesesPorData" class="btn btn-info botao botaoCasosData">3 Meses</button>
                                            <button id="seisMesesPorData" class="btn btn-info botao botaoCasosData">6 Meses</button>
                                            <button id="tudoPorData" class="btn btn-info botao botaoCasosData">Tudo</button>
                                        </div>
                                    </div>
                                    <div id="casosPorData"></div>
                                </div>
                            </div>
                        </div>


                        <div class="col-xl-11 col-lg-7" style="padding-bottom: 50px">
                            <div class="card shadow mb-4" style="background-color: transparent">
                                <!-- Card Header - Dropdown -->
                                <div style="background-color: transparent"
                                    class="card-header text-center py-3 flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-light text-center">Novos óbitos por data</h6>

                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div>
                                        <div align="center">
                                            <button id="umMesObitosPorData" class="btn btn-info botao active botaoObitosData" onclick="">
                                                1 Mês
                                            </button>
                                            <button id="tresMesesObitosPorData" class="btn btn-info botao botaoObitosData" onclick="">
                                                3 Meses
                                            </button>
                                            <button id="seisMesesObitosPorData" class="btn btn-info botao botaoObitosData" onclick="">
                                                6 Meses
                                            </button>
                                            <button id="tudoObitosPorData" class="btn btn-info botao botaoObitosData" onclick="">
                                                Tudo
                                            </button>
                                        </div>
                                    </div>
                                    <div id="obitosPorData"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-11 col-lg-7" style="padding-bottom: 50px">
                            <div class="card shadow mb-4" style="background-color: transparent">
                                <!-- Card Header - Dropdown -->
                                <div style="background-color: transparent"
                                    class="card-header text-center py-3 flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-light text-center">Óbitos por faixa etária</h6>

                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div>

                                    </div>
                                    <div id="obitosPorFaixaEtaria"></div>
                                </div>
                            </div>
                        </div>


                        <div class="col-xl-11 col-lg-7" style="padding-bottom: 50px">
                            <div class="card shadow mb-4" style="background-color: transparent">
                                <!-- Card Header - Dropdown -->
                                <div style="background-color: transparent"
                                    class="card-header py-3 text-center flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-light">Casos Positivos por Sexo</h6>

                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div>
                                        <div align="center">
                                    <button id="umMesSexo" class="btn btn-info botao active botaoSexo" onclick="">
                                        1 Mês
                                    </button>
                                    <button id="tresMesesSexo" class="btn btn-info botao botaoSexo" onclick="">
                                        3 Meses
                                    </button>
                                    <button id="seisMesesSexo" class="btn btn-info botao botaoSexo" onclick="">
                                        6 Meses
                                    </button>
                                    <button id="tudoSexo" class="btn btn-info botao botaoSexo" onclick="">
                                        Tudo
                                    </button>
                                        </div>
                                    </div>

                                    <div id="casosPorSexo" class="graficoPizza"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-11 col-lg-7" style="padding-bottom: 50px">
                            <div class="card shadow mb-4" style="background-color: transparent">
                                <!-- Card Header - Dropdown -->
                                <div style="background-color: transparent"
                                    class="card-header py-3 text-center flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-light">Casos Positivos por Escolaridade</h6>

                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div>
                                        <div align="center">

                                    <button id="umMesEscolaridade" class="btn btn-info botao active botaoEscolaridade" onclick="">
                                        1 Mês
                                    </button>
                                    <button id="tresMesesEscolaridade" class="btn btn-info botao botaoEscolaridade" onclick="">
                                        3 Meses
                                    </button>
                                    <button id="seisMesesEscolaridade" class="btn btn-info botao botaoEscolaridade" onclick="">
                                        6 Meses
                                    </button>
                                    <button id="tudoEscolaridade" class="btn btn-info botao botaoEscolaridade" onclick="">
                                        Tudo
                                    </button>
                                        </div>
                                    </div>
                                    <div id="casosPorEscolaridade" class="graficoPizza"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-11 col-lg-7" style="padding-bottom: 50px">
                            <div class="card shadow mb-4" style="background-color: transparent">
                                <!-- Card Header - Dropdown -->
                                <div style="background-color: transparent"
                                    class="card-header py-3 text-center flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-light">Casos Positivos por Cor/Raça</h6>

                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div>
                                        <div align="center">
                                    <button id="umMesRaca" class="btn btn-info botao active botaoRaca" onclick="">
                                        1 Mês
                                    </button>
                                    <button id="tresMesesRaca" class="btn btn-info botao botaoRaca" onclick="">
                                        3 Meses
                                    </button>
                                    <button id="seisMesesRaca" class="btn btn-info botao botaoRaca" onclick="">
                                        6 Meses
                                    </button>
                                    <button id="tudoRaca" class="btn btn-info botao botaoRaca" onclick="">
                                        Tudo
                                    </button>
                                        </div>
                                    </div>
                                    <div id="casosPorRaca" class="graficoPizza"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-11 col-lg-7" style="padding-bottom: 50px">
                            <div class="card shadow mb-4" style="background-color: transparent">
                                <!-- Card Header - Dropdown -->
                                <div style="background-color: transparent"
                                    class="card-header py-3 text-center flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-light">Casos Positivos por Bairro</h6>

                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div>
                                        <div align="center">
                                            <button id="umMesBairros" class="btn btn-info botao active botaoBairro" onclick="">
                                                1 Mês
                                            </button>
                                            <button id="tresMesesBairros" class="btn btn-info botao botaoBairro" onclick="">
                                                3 Meses
                                            </button>
                                            <button id="seisMesesBairros" class="btn btn-info botao botaoBairro" onclick="">
                                                6 Meses
                                            </button>
                                            <button id="tudoBairros" class="btn btn-info botao botaoBairro" onclick="">
                                                Tudo
                                            </button>
                                        </div>
                                    </div>
                                    <div id="casosPorBairro"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-11 col-lg-7" style="padding-bottom: 50px">
                            <div class="card shadow mb-4" style="background-color: transparent">
                                <!-- Card Header - Dropdown -->
                                <div style="background-color: transparent"
                                    class="card-header py-3 text-center flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-light">Casos Positivos por Faixa Etária</h6>

                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div>
                                        <div align="center">
                                            <button  id="umMesFaixaEtaria" class="btn btn-info botao active botaoFaixaEtaria" onclick="">
                                                1 Mês
                                            </button>
                                            <button id="tresMesesFaixaEtaria" class="btn btn-info botao botaoFaixaEtaria" onclick="">
                                                3 Meses
                                            </button>
                                            <button id="seisMesesFaixaEtaria" class="btn btn-info botao botaoFaixaEtaria" onclick="">
                                                6 Meses
                                            </button>
                                            <button id="tudoFaixaEtaria" class="btn btn-info   botaoFaixaEtaria" onclick="">
                                                Tudo
                                            </button>
                                        </div>
                                    </div>
                                    <div id="casosPorFaixaEtaria" class="casos_positivos_etaria"></div>
                                </div>
                            </div>
                        </div>


                        <div class="col-xl-11 col-lg-7" style="padding-bottom: 50px">
                            <div class="card shadow mb-4"style="background-color: transparent">
                                <!-- Card Header - Dropdown -->
                                <div style="background-color: transparent"
                                    class="card-header py-3 text-center flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-light">Mapa de Casos Positivos por Bairro</h6>

                                </div>
                                <div class="card-body">
                                    <!-- Card Body -->
                                    <div>
                                        <div align="center">
                                            <button id="umMesMapa" class="btn btn-info botao active mapa01">
                                                1 Mês
                                            </button>
                                            <button id="tresMesesMapa" class="btn btn-info botao mapa01">
                                                3 Meses
                                            </button>
                                            <button id="seisMesesMapa" class="btn btn-info botao mapa01">
                                                6 Meses
                                            </button>
                                            <button id="tudoMapa" class="btn btn-info botao mapa01">
                                                Tudo
                                            </button>
                                        </div>
                                        <div class="card-body">
                                            <div id="mapaContainer" class="d-flex justify-content-center">
                                                <div id="map"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-xl-11 col-lg-7" style="padding-bottom: 50px">
                            <div class="card text-center shadow mb-4" style="background-color: transparent">
                                <!-- Card Header - Dropdown -->
                                <div style="background-color: transparent"
                                    class="card-header py-3 text-center flex-row align-items-center justify-content-between" style="color:#c20000">
                                    <h6 class="m-0 font-weight-bold text-light">
                                        Análise Comparativa dos Casos Brasil - RS - São Leopoldo
                                    </h6>

                                </div>

                                <div class="container">

                                    <table class="table">

                                        <tbody>
                                            <tr>
                                                <td class="semBorda"> Brasil</td>
                                                <td class="semBorda"><span id="confirmadosBrasil"></span> casos positivos
                                                </td>
                                                <td class="semBorda"><span id="mortesBrasil"></span> óbitos</td>

                                                <td class="semBorda"> 1 óbito para cada <span id="proporcaoMortesBR"></span>
                                                    casos.</td>

                                            </tr>
                                            <tr>
                                                <td class="semBorda">RS</td>
                                                <td class="semBorda"><span id="confirmadosRS"></span> casos positivos</td>
                                                <td class="semBorda"><span id="mortesRS"></span> óbitos</td>
                                                <td class="semBorda"> 1 óbito para cada <span id="proporcaoMortesRS"></span> casos.</td>
                                            </tr>
                                            <tr>
                                                <td class="semBorda">São Leopoldo</td>
                                                <td class="semBorda">{{ number_format(end($casos), 0, '.', '.') }} casos positivos</td>
                                                <td class="semBorda">{{ number_format(end($obitos), 0, '.', '.') }} óbitos</td>

                                                <td class="semBorda">
                                                    <div id="proporcaoMortes"></div>
                                                    1 óbito para cada
                                                    {{ number_format($numeroProporcaoObitosSaoLeo, 2,',','.') }} casos.
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-11 col-lg-7" style="padding-bottom: 50px">
                            <div class="card text-center shadow mb-4" style="background-color: transparent">
                                <!-- Card Header - Dropdown -->
                                <div style="background-color: transparent"
                                    class="card-header py-3 text-center flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-light">Links Úteis</h6>

                                </div>

                                <div class="container">

                                    <table class="table">

                                        <tbody>
                                            <tr>
                                                <td class="semBorda">
                                                    <span id="confirmadosBrasil"></span>
                                                    <a style="text-decoration:none" href="https://sites.google.com/view/saudesaoleopoldo/protocolos-assistenciais-e-notas-técnicas?authuser=0">
                                                        {{--Acesso ao --}}Protocolo de Critérios Municipais para Notificação
                                                        Exame de Detecção de COVID-19 nos Serviços Públicos
                                                    </a>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td class="semBorda">
                                                    <a style="text-decoration:none" href="https://coronavirus.saude.gov.br">
                                                        Informações sobre o Coronavírus do Ministério da Saúde
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="semBorda">
                                                    <a style="text-decoration:none" href="https://coronavirus.rs.gov.br/inicial">
                                                        Informações sobre o Coronavírus da Secretaria Estadual de Saúde
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="semBorda">
                                                    <a style="text-decoration:none" href="https://sites.google.com/view/saudesaoleopoldo/numesc?authuser=0#h.p_HPoTyRq5k9Ld">
                                                        Informações e cursos sobre COVID-19 para profissionais de saúde
                                                    </a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-11 col-lg-7" style="padding-bottom: 50px">
                            <div class="card text-center shadow mb-4" style="background-color: transparent">
                                <!-- Card Header - Dropdown -->
                                <div style="background-color: transparent"
                                    class="card-header py-3 text-center flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-light">Arquivos Informativos sobre o COVID-19</h6>

                                </div>

                                <div class="container">

                                    <table class="table">

                                        <tbody>

                                            <tr>
                                                <td class="semBorda">
                                                    <span id="confirmadosBrasil"></span>
                                                    <a style="text-decoration:none" target="_blank" href="{{asset('assets/arquivos/CRITERIOS_MUNICIPAIS_COLETA_COVID_PÚBLICOS_Atualização_0102.pdf')}}">
                                                        NOVOS PROTOCOLOS COVID FEV 2022
                                                    </a>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="semBorda">
                                                    <span id="criterios_coleta"></span>
                                                    <a style="text-decoration:none" target="_blank" href="{{asset('assets/arquivos/CRITERIOS_COLETA_COVID_19-01.pdf')}}">
                                                        Crit&eacute;rios para Notifica&ccedil;&atilde;o e Exame Covid-19 - Atualiza&ccedil;&atilde;o 19/01
                                                    </a>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="semBorda">
                                                    <span id="confirmadosBrasil"></span>
                                                    <a style="text-decoration:none" target="_blank" href="{{asset('assets/arquivos/03093259-nota-informativa-15-31-07-2020-final.pdf')}}">
                                                        Nota informativa 15.31.07.2020 - Final
                                                    </a>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="semBorda">
                                                    <a style="text-decoration:none" target="_blank" href="{{asset('assets/arquivos/estrategiavacinacaocovid19.pdf')}}">PLANO MUNICIPAL DE VACINAÇÃO</a>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="semBorda">
                                                    <a style="text-decoration:none" target="_blank" href="{{asset('assets/arquivos/CRITERIOS MUNICIPAIS COLETA COVID PÚBLICOS atualização 06.08.20.pdf')}}">
                                                        CRITERIOS MUNICIPAIS PARA COLETA DE COVID - PÚBLICOS - atualização 06.08.20
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="semBorda">
                                                    <a style="text-decoration:none" target="_blank" href="{{asset('assets/arquivos/Planosdecontingencia.pdf')}}">
                                                        Nota Informativa 04.2020 ILPI Planos de Contingencia
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="semBorda">
                                                    <a style="text-decoration:none" target="_blank" href="{{asset('assets/arquivos/Nota_Informativa_05_2020_PCR_PM.pdf')}}">Nota Informativa 05.2020 Critérios de exame pós-morte</a>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="semBorda">
                                                    <a style="text-decoration:none" target="_blank" href="{{asset('assets/arquivos/Boletim_Epidemiologico_de_Obitos_COVID_21_agosto_2020.pdf')}}">Boletim Epidemiológico de Óbitos COVID 21 agosto 2020</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="semBorda">
                                                    <a style="text-decoration:none" target="_blank" href="{{asset('assets/arquivos/boletim_epidemiologico_covid_SL_setembro.pdf')}}">Boletim Epidemiológico COVID setembro 2020</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="semBorda">
                                                    <a style="text-decoration:none" target="_blank" href="{{asset('assets/arquivos/Boletim Epidemiológico de Óbitos COVID maio 2021.pdf')}}">Boletim Epidemiológico COVID setembro 2021</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="semBorda">
                                                    <a style="text-decoration:none" target="_blank" href="{{asset('assets/arquivos/Boletim_Epidemiológico_de_Obitos_COVID_maio_2021.pdf')}}">Boletim Epidemiológico COVID maio 2021</a>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="semBorda">
                                                    <a style="text-decoration:none" target="_blank" href="{{asset('assets/arquivos/Apresentacao_2_TC_UFPel_20201104.pptx')}}">Apresentação pesquisa da UFPel</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="semBorda">
                                                    <a style="text-decoration:none" target="_blank" href="{{asset('assets/arquivos/informe_epidemiologico_covid_31052021.pdf')}}">INFORME EPIDEMIOLÓGICO COVID19</a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="text-center rodape" style="padding-top: 100px;">
                            <p style="margin-bottom: 0rem">Desenvolvido pelo Departamento de Desenvolvimento de Sistemas</p>

                            <p>Coordenadoria de Tecnologia da Informação e Comunicação</p>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        @include('graficos')
        @include('scripts')

         <script src="{{asset('js/map.js')}}"></script>


    </body>

</html>
