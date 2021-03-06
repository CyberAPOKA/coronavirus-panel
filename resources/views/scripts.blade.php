{{-- SCRIPT CHAMA API E POPULA INFORMACOES COMPARATIVAS ------------------------------ --}}

<script type="text/javascript" src="{{ asset('js/api.js') }}"></script>

{{-- CÓDIGO RESPONSÁVEL PELOS GRÁFICOS DE LEITOS OCUPADOS ------------------------------ --}}
<script>
    var el = $('#graph');
    var al = $('#graph2');
    var il = $('#graph3');
    var e4 = $('#graph4');
    var e5 = $('#graph5');
    var e6 = $('#graph6');
    var e7 = $('#graph7');
    var e8 = $('#graph8');
    var e9 = $('#graph9');



    var options = {
        percent: el.attr('data-percent') || 25,
        size: el.attr('data-size') || 100,
        lineWidth: el.attr('data-line') || 7,
        rotate: el.attr('data-rotate') || 0
    }

    var options2 = {
        percent: al.attr('data-percent') || 25,
        size: al.attr('data-size') || 100,
        lineWidth: al.attr('data-line') || 7,
        rotate: al.attr('data-rotate') || 0
    }

    var options3 = {
        percent: il.attr('data-percent') || 25,
        size: il.attr('data-size') || 100,
        lineWidth: il.attr('data-line') || 7,
        rotate: il.attr('data-rotate') || 0
    }
    var options4 = {
        percent: e4.attr('data-percent') || 25,
        size: e4.attr('data-size') || 100,
        lineWidth: e4.attr('data-line') || 7,
        rotate: e4.attr('data-rotate') || 0
    }

    var options5 = {
        percent: e5.attr('data-percent') || 25,
        size: e5.attr('data-size') || 100,
        lineWidth: e5.attr('data-line') || 7,
        rotate: e5.attr('data-rotate') || 0
    }

    var options6 = {
        percent: e6.attr('data-percent') || 25,
        size: e6.attr('data-size') || 100,
        lineWidth: e6.attr('data-line') || 7,
        rotate: e6.attr('data-rotate') || 0
    }

    var options7 = {
        percent: e7.attr('data-percent') || 25,
        size: e7.attr('data-size') || 100,
        lineWidth: e7.attr('data-line') || 7,
        rotate: e7.attr('data-rotate') || 0
    }

    var options8 = {
        percent: e8.attr('data-percent') || 25,
        size: e8.attr('data-size') || 100,
        lineWidth: e8.attr('data-line') || 7,
        rotate: e8.attr('data-rotate') || 0
    }

    var options9 = {
        percent: e9.attr('data-percent') || 25,
        size: e9.attr('data-size') || 100,
        lineWidth: e9.attr('data-line') || 7,
        rotate: e9.attr('data-rotate') || 0
    }

    var canvas = document.createElement('canvas');
    var span = '<span class="porcentagem">' + options.percent + '%</span>';

    var canvas2 = document.createElement('canvas');
    var span2 = '<span class="porcentagem">' + options2.percent + '%</span>';

    var canvas3 = document.createElement('canvas');
    var span3 = '<span class="porcentagem">' + options3.percent + '%</span>';

    var canvas4 = document.createElement('canvas');
    var span4 = '<span class="porcentagem">' + options4.percent + '%</span>';

    var canvas5 = document.createElement('canvas');
    var span5 = '<span class="porcentagem">' + options5.percent + '%</span>';

    var canvas6 = document.createElement('canvas');
    var span6 = '<span class="porcentagem">' + options6.percent + '%</span>';

    var canvas7 = document.createElement('canvas');
    var span7 = '<span class="porcentagem">' + options7.percent + '%</span>';

    var canvas8 = document.createElement('canvas');
    var span8 = '<span class="porcentagem">' + options8.percent + '%</span>';

    var canvas9 = document.createElement('canvas');
    var span9 = '<span class="porcentagem">' + options9.percent + '%</span>';

    if (typeof(G_vmlCanvasManager) !== 'undefined') {
        G_vmlCanvasManager.initElement(canvas);
        G_vmlCanvasManager.initElement(canvas2);
        G_vmlCanvasManager.initElement(canvas3);
        G_vmlCanvasManager.initElement(canvas4);
        G_vmlCanvasManager.initElement(canvas5);
        G_vmlCanvasManager.initElement(canvas6);
        G_vmlCanvasManager.initElement(canvas7);
        G_vmlCanvasManager.initElement(canvas8);
        G_vmlCanvasManager.initElement(canvas9);

    }

    var ctx = canvas.getContext('2d');
    canvas.width = canvas.height = options.size;

    var ctx2 = canvas2.getContext('2d');
    canvas2.width = canvas2.height = options2.size;

    var ctx3 = canvas3.getContext('2d');
    canvas3.width = canvas3.height = options3.size;

    var ctx4 = canvas4.getContext('2d');
    canvas4.width = canvas4.height = options4.size;

    var ctx5 = canvas5.getContext('2d');
    canvas5.width = canvas5.height = options5.size;

    var ctx6 = canvas6.getContext('2d');
    canvas6.width = canvas6.height = options6.size;


    var ctx7 = canvas7.getContext('2d');
    canvas7.width = canvas7.height = options7.size;

    var ctx8 = canvas8.getContext('2d');
    canvas8.width = canvas8.height = options8.size;

    var ctx9 = canvas9.getContext('2d');
    canvas9.width = canvas9.height = options9.size;


    el.append(span.replace(".",","));
    el.append(canvas);

    al.append(span2.replace(".",","));
    al.append(canvas2);

    il.append(span3.replace(".",","));
    il.append(canvas3);

    e4.append(span4.replace(".",","));
    e4.append(canvas4);

    e5.append(span5.replace(".",","));
    e5.append(canvas5);

    e6.append(span6.replace(".",","));
    e6.append(canvas6);

    e7.append(span7.replace(".",","));
    e7.append(canvas7);

    e8.append(span8.replace(".",","));
    e8.append(canvas8);

    e9.append(span9.replace(".",","));
    e9.append(canvas9);



    ctx.translate(options.size / 2, options.size / 2); // change center
    ctx.rotate((-1 / 2 + options.rotate / 180) * Math.PI); // rotate -90 deg

    ctx2.translate(options2.size / 2, options2.size / 2); // change center
    ctx2.rotate((-1 / 2 + options2.rotate / 180) * Math.PI); // rotate -90 deg

    ctx3.translate(options3.size / 2, options3.size / 2); // change center
    ctx3.rotate((-1 / 2 + options3.rotate / 180) * Math.PI); // rotate -90 deg

    ctx4.translate(options4.size / 2, options4.size / 2); // change center
    ctx4.rotate((-1 / 2 + options4.rotate / 180) * Math.PI); // rotate -90 deg

    ctx5.translate(options5.size / 2, options5.size / 2); // change center
    ctx5.rotate((-1 / 2 + options5.rotate / 180) * Math.PI); // rotate -90 deg

    ctx6.translate(options6.size / 2, options6.size / 2); // change center
    ctx6.rotate((-1 / 2 + options6.rotate / 180) * Math.PI); // rotate -90 deg

    ctx7.translate(options7.size / 2, options7.size / 2); // change center
    ctx7.rotate((-1 / 2 + options7.rotate / 180) * Math.PI); // rotate -90 deg

    ctx8.translate(options8.size / 2, options8.size / 2); // change center
    ctx8.rotate((-1 / 2 + options8.rotate / 180) * Math.PI); // rotate -90 deg

    ctx9.translate(options9.size / 2, options9.size / 2); // change center
    ctx9.rotate((-1 / 2 + options9.rotate / 180) * Math.PI); // rotate -90 deg


    //imd = ctx.getImageData(0, 0, 240, 24a0);
    var radius = (options.size - options.lineWidth) / 2;

    var radius2 = (options2.size - options2.lineWidth) / 2;

    var radius3 = (options3.size - options3.lineWidth) / 2;

    var radius4 = (options4.size - options4.lineWidth) / 2;

    var radius5 = (options5.size - options5.lineWidth) / 2;

    var radius6 = (options6.size - options6.lineWidth) / 2;

    var radius7 = (options7.size - options7.lineWidth) / 2;

    var radius8 = (options8.size - options8.lineWidth) / 2;

    var radius9 = (options9.size - options9.lineWidth) / 2;



    var drawCircle = function(color, lineWidth, percent) {
            percent = Math.min(Math.max(0, percent || 1), 1);
            ctx.beginPath();
            ctx.arc(0, 0, radius, 0, Math.PI * 2 * percent, false);
            ctx.strokeStyle = color;
            ctx.lineCap = 'round'; // butt, round or square
            ctx.lineWidth = lineWidth;
            ctx.stroke();
    };

    var drawCircle2 = function(color, lineWidth, percent) {
            percent = Math.min(Math.max(0, percent || 1), 1);
            ctx2.beginPath();
            ctx2.arc(0, 0, radius, 0, Math.PI * 2 * percent, false);
            ctx2.strokeStyle = color;
            ctx2.lineCap = 'round'; // butt, round or square
            ctx2.lineWidth = lineWidth;
            ctx2.stroke();
    };

    var drawCircle3 = function(color, lineWidth, percent) {
            percent = Math.min(Math.max(0, percent || 1), 1);
            ctx3.beginPath();
            ctx3.arc(0, 0, radius, 0, Math.PI * 2 * percent, false);
            ctx3.strokeStyle = color;
            ctx3.lineCap = 'round'; // butt, round or square
            ctx3.lineWidth = lineWidth;
            ctx3.stroke();
    };

    var drawCircle4 = function(color, lineWidth, percent) {
            percent = Math.min(Math.max(0, percent || 1), 1);
            ctx4.beginPath();
            ctx4.arc(0, 0, radius, 0, Math.PI * 2 * percent, false);
            ctx4.strokeStyle = color;
            ctx4.lineCap = 'round'; // butt, round or square
            ctx4.lineWidth = lineWidth;
            ctx4.stroke();
    };

    var drawCircle5 = function(color, lineWidth, percent) {
            percent = Math.min(Math.max(0, percent || 1), 1);
            ctx5.beginPath();
            ctx5.arc(0, 0, radius, 0, Math.PI * 2 * percent, false);
            ctx5.strokeStyle = color;
            ctx5.lineCap = 'round'; // butt, round or square
            ctx5.lineWidth = lineWidth;
            ctx5.stroke();
    };

    var drawCircle6 = function(color, lineWidth, percent) {
            percent = Math.min(Math.max(0, percent || 1), 1);
            ctx6.beginPath();
            ctx6.arc(0, 0, radius, 0, Math.PI * 2 * percent, false);
            ctx6.strokeStyle = color;
            ctx6.lineCap = 'round'; // butt, round or square
            ctx6.lineWidth = lineWidth;
            ctx6.stroke();
    };

    var drawCircle7 = function(color, lineWidth, percent) {
            percent = Math.min(Math.max(0, percent || 1), 1);
            ctx7.beginPath();
            ctx7.arc(0, 0, radius, 0, Math.PI * 2 * percent, false);
            ctx7.strokeStyle = color;
            ctx7.lineCap = 'round'; // butt, round or square
            ctx7.lineWidth = lineWidth;
            ctx7.stroke();
    };

    var drawCircle8 = function(color, lineWidth, percent) {
            percent = Math.min(Math.max(0, percent || 1), 1);
            ctx8.beginPath();
            ctx8.arc(0, 0, radius, 0, Math.PI * 2 * percent, false);
            ctx8.strokeStyle = color;
            ctx8.lineCap = 'round'; // butt, round or square
            ctx8.lineWidth = lineWidth;
            ctx8.stroke();
    };

    var drawCircle9 = function(color, lineWidth, percent) {
            percent = Math.min(Math.max(0, percent || 1), 1);
            ctx9.beginPath();
            ctx9.arc(0, 0, radius, 0, Math.PI * 2 * percent, false);
            ctx9.strokeStyle = color;
            ctx9.lineCap = 'round'; // butt, round or square
            ctx9.lineWidth = lineWidth;
            ctx9.stroke();
    };







    if($('#graph').attr('data-percent') > 100) {
        var cor = '#7f2dd6';
    }else if ($('#graph').attr('data-percent') >= 80){
        var cor = "#F25961";
    }else if($('#graph').attr('data-percent') >= 60){
        var cor = "#FFAD46";
    }else if($('#graph').attr('data-percent') == 0){
        var cor = "#efefef";
    }else{
        var cor = "#31CE36";
    }

    if($('#graph2').attr('data-percent') > 100) {
        var cor2 = '#7f2dd6';
    }else if ($('#graph2').attr('data-percent') >= 80){
        var cor2 = "#F25961";
    }else if($('#graph2').attr('data-percent') >= 60){
        var cor2 = "#FFAD46";
    }else if($('#graph2').attr('data-percent') == 0){
        var cor2 = "#efefef";
    }else{
        var cor2 = "#31CE36";
    }

    if($('#graph3').attr('data-percent') > 100) {
        var cor3 = '#31CE36';
    }else if ($('#graph3').attr('data-percent') >= 80){
        var cor3 = "#31CE36";
    }else if($('#graph3').attr('data-percent') >= 60){
        var cor3 = "#31CE36";
    }else if($('#graph3').attr('data-percent') == 0){
        var cor3 = "#efefef";
    }else{
        var cor3 = "#31CE36";
    }

    if($('#graph4').attr('data-percent') > 100) {
        var cor4 = '#31CE36';
    }else if ($('#graph4').attr('data-percent') >= 80){
        var cor4 = "#31CE36";
    }else if($('#graph4').attr('data-percent') >= 60){
        var cor4 = "#31CE36";
    }else if($('#graph4').attr('data-percent') == 0){
        var cor4 = "#efefef";
    }else{
        var cor4 = "#31CE36";
    }

    if($('#graph5').attr('data-percent') > 100) {
        var cor5 = '#31CE36';
    }else if ($('#graph5').attr('data-percent') >= 80){
        var cor5 = "#31CE36";
    }else if($('#graph5').attr('data-percent') >= 60){
        var cor5 = "#31CE36";
    }else if($('#graph5').attr('data-percent') == 0){
        var cor5 = "#efefef";
    }else{
        var cor5 = "#31CE36";
    }

    if($('#graph6').attr('data-percent') > 100) {
        var cor6 = '#31CE36';
    }else if ($('#graph6').attr('data-percent') >= 80){
        var cor6 = "#31CE36";
    }else if($('#graph6').attr('data-percent') >= 60){
        var cor6 = "#31CE36";
    }else if($('#graph6').attr('data-percent') == 0){
        var cor6 = "#efefef";
    }else{
        var cor6 = "#31CE36";
    }

    if($('#graph7').attr('data-percent') > 100) {
        var cor7 = '#31CE36';
    }else if ($('#graph7').attr('data-percent') >= 80){
        var cor7 = "#31CE36";
    }else if($('#graph7').attr('data-percent') >= 60){
        var cor7 = "#31CE36";
    }else if($('#graph7').attr('data-percent') == 0){
        var cor7 = "#efefef";
    }else{
        var cor7 = "#31CE36";
    }

    if($('#graph8').attr('data-percent') > 100) {
        var cor8 = '#31CE36';
    }else if ($('#graph8').attr('data-percent') >= 80){
        var cor8 = "#31CE36";
    }else if($('#graph8').attr('data-percent') >= 60){
        var cor8 = "#31CE36";
    }else if($('#graph8').attr('data-percent') == 0){
        var cor8 = "#efefef";
    }else{
        var cor8 = "#31CE36";
    }

    if($('#graph9').attr('data-percent') > 100) {
        var cor9 = '#31CE36';
    }else if ($('#graph9').attr('data-percent') >= 80){
        var cor9 = "#31CE36";
    }else if($('#graph9').attr('data-percent') >= 60){
        var cor9 = "#31CE36";
    }else if($('#graph9').attr('data-percent') == 0){
        var cor9 = "#efefef";
    }else{
        var cor9 = "#31CE36";
    }

    drawCircle('#efefef', options.lineWidth, 100 / 100);
    drawCircle(cor, options.lineWidth, options.percent / 100);

    drawCircle2('#efefef', options2.lineWidth, 100 / 100);
    drawCircle2(cor2, options2.lineWidth, options2.percent / 100);

    drawCircle3('#efefef', options3.lineWidth, 100 / 100);
    drawCircle3(cor3, options3.lineWidth, options3.percent / 100);

    drawCircle4('#efefef', options4.lineWidth, 100 / 100);
    drawCircle4(cor4, options4.lineWidth, options4.percent / 100);

    drawCircle5('#efefef', options5.lineWidth, 100 / 100);
    drawCircle5(cor5, options5.lineWidth, options5.percent / 100);

    drawCircle6('#efefef', options6.lineWidth, 100 / 100);
    drawCircle6(cor6, options6.lineWidth, options6.percent / 100);

    drawCircle7('#efefef', options7.lineWidth, 100 / 100);
    drawCircle7(cor7, options7.lineWidth, options7.percent / 100);

    drawCircle8('#efefef', options8.lineWidth, 100 / 100);
    drawCircle8(cor8, options8.lineWidth, options8.percent / 100);

    drawCircle9('#efefef', options9.lineWidth, 100 / 100);
    drawCircle9(cor9, options9.lineWidth, options9.percent / 100);

</script>

{{-- REQUERIMENTO DOS DADOS DO MAPA ---------------------------------------------------------- --}}
@php
    use App\CasosConfirmadosBairro;

       $dataInicialUmMes = date_sub(now(), date_interval_create_from_date_string('30 days'));
       $dataInicialTresMeses = date_sub(now(), date_interval_create_from_date_string('90 days'));
       $dataInicialSeisMeses = date_sub(now(), date_interval_create_from_date_string('180 days'));

    $casosBairrosTotal = CasosConfirmadosBairro::selectRaw('SUM(casos) as casos, bairro_id')
    ->groupBy('bairro_id')
    ->get();
    $casosBairrosUltimoMes = CasosConfirmadosBairro::selectRaw('SUM(casos) as casos, bairro_id')
    ->groupBy('bairro_id')
    ->whereDate('dia', '>=', $dataInicialUmMes)
    ->get();
    $casosBairrosTresMeses = CasosConfirmadosBairro::selectRaw('SUM(casos) as casos, bairro_id')
    ->groupBy('bairro_id')
    ->whereDate('dia', '>=', $dataInicialTresMeses)
    ->get();
    $casosBairrosSeisMeses = CasosConfirmadosBairro::selectRaw('SUM(casos) as casos, bairro_id')
    ->groupBy('bairro_id')
    ->whereDate('dia', '>=', $dataInicialSeisMeses)
    ->get();


    $casosBairrosTotalRevisado;
    $casosBairrosUltimoMesRevisado;
    $casosBairrosTresMesesRevisado;
    $casosBairrosSeisMesesRevisado;


    for ($x=0;$x<=23;$x++){

        $casosTotal = $casosBairrosTotal->where('bairro_id', $x + 1)->first();

        if ($casosTotal)
        $casosBairrosTotalRevisado[$x] = $casosTotal->casos;
        else
        $casosBairrosTotalRevisado[$x] = 0;


        $casosUltimosMes = $casosBairrosUltimoMes->where('bairro_id', $x + 1)->first();

        if ($casosUltimosMes)
        $casosBairrosUltimoMesRevisado[$x] = $casosUltimosMes->casos;
        else
        $casosBairrosUltimoMesRevisado[$x] = 0;


        $casosTresMeses = $casosBairrosTresMeses->where('bairro_id', $x + 1)->first();

        if ($casosTresMeses)
        $casosBairrosTresMesesRevisado[$x] = $casosTresMeses->casos;
        else
        $casosBairrosTresMesesRevisado[$x] = 0;

        $casosSeisMeses = $casosBairrosSeisMeses->where('bairro_id', $x + 1)->first();

        if ($casosSeisMeses)
        $casosBairrosSeisMesesRevisado[$x] = $casosSeisMeses->casos;
        else
        $casosBairrosSeisMesesRevisado[$x] = 0;

     }

@endphp

<script>

    var data = {
        01: { name: "Vicentina", population: 13140, cv19: '{{$casosBairrosUltimoMesRevisado[23]}}' },
        02: { name: "Centro", population: 12929, cv19:'{{$casosBairrosUltimoMesRevisado[5]}}' },
        03: { name: "Arroio da Manteiga", population: 21585, cv19: '{{$casosBairrosUltimoMesRevisado[3]}}' },
        04: { name: "Boa Vista", population: 2220, cv19: '{{$casosBairrosUltimoMesRevisado[15]}}' },
        05: { name: "Campestre", population: 6619, cv19: '{{$casosBairrosUltimoMesRevisado[11]}}' },
        06: { name: "Campina", population: 13736, cv19: '{{$casosBairrosUltimoMesRevisado[1]}}' },
        07: { name: "Cristo Rei", population: 3796, cv19: '{{$casosBairrosUltimoMesRevisado[7]}}' },
        08: { name: "Duque de Caxias", population: 9694, cv19: '{{$casosBairrosUltimoMesRevisado[16]}}' },
        09: { name: "Feitoria", population: 36808, cv19: '{{$casosBairrosUltimoMesRevisado[4]}}' },
        10: { name: "Fiao", population: 1506, cv19: '{{$casosBairrosUltimoMesRevisado[17]}}' },
        11: { name: "Jardim América", population: 1222, cv19: '{{$casosBairrosUltimoMesRevisado[0]}}' },
        12: { name: "Morro do Espelho", population: 2526, cv19: '{{$casosBairrosUltimoMesRevisado[12]}}' },
        13: { name: "Rio dos Sinos", population: 4705, cv19: '{{$casosBairrosUltimoMesRevisado[13]}}' },
        14: { name: "Santa Tereza", population: 8486, cv19: '{{$casosBairrosUltimoMesRevisado[9]}}' },
        15: { name: "Fazenda São Borja", population: 2542, cv19: '{{$casosBairrosUltimoMesRevisado[10]}}' },
        16: { name: "Pinheiro", population: 3130, cv19: '{{$casosBairrosUltimoMesRevisado[20]}}' },
        17: { name: "Rio Branco", population: 5779, cv19: '{{$casosBairrosUltimoMesRevisado[14]}}' },
        18: { name: "Santo André", population: 5890, cv19: '{{$casosBairrosUltimoMesRevisado[20]}}' },
        19: { name: "São José", population: 2321, cv19: '{{$casosBairrosUltimoMesRevisado[22]}}' },
        20: { name: "Scharlau", population: 14456, cv19: '{{$casosBairrosUltimoMesRevisado[6]}}' },
        21: { name: "Santos Dumont", population: 24543, cv19: '{{$casosBairrosUltimoMesRevisado[2]}}' },
        22: { name: "São João Batista", population: 2456, cv19: '{{$casosBairrosUltimoMesRevisado[21]}}' },
        23: { name: "Padre Reus", population: 1687, cv19: '{{$casosBairrosUltimoMesRevisado[18]}}' },
        24: { name: "São Miguel", population: 7545, cv19: '{{$casosBairrosUltimoMesRevisado[8]}}' },
    };

    var districtData = {
        type: "FeatureCollection",
        features: [{
            type: "Feature",
            id: 01,
            properties: {
                name: data[1].name,
                population: data[1].population,
                Covid19: data[1].cv19,
            },
            geometry: {
                type: "GeometryCollection",
                geometries: [{
                    type: "MultiPolygon",
                    coordinates: [
                        [
                            [
                                [-51.1793963, -29.783885],
                                [-51.1779523, -29.7816733],
                                [-51.1787177, -29.7802701],
                                [-51.1788817, -29.7777734],
                                [-51.1778247, -29.7753678],
                                [-51.1696485, -29.7651011],
                                [-51.1695883, -29.7650247],
                                [-51.1695013, -29.7649142],
                                [-51.1561495, -29.7726547],
                                [-51.1560009, -29.7727192],
                                [-51.1543897, -29.7724906],
                                [-51.1541084, -29.7724497],
                                [-51.1543841, -29.7734543],
                                [-51.1549217, -29.7752949],
                                [-51.155449, -29.7771834],
                                [-51.1555139, -29.7773953],
                                [-51.1555914, -29.7776128],
                                [-51.1556848, -29.7778338],
                                [-51.1558648, -29.7781743],
                                [-51.1560447, -29.7784112],
                                [-51.1562395, -29.7786436],
                                [-51.1565698, -29.7789921],
                                [-51.1593592, -29.7816164],
                                [-51.1613411, -29.7834638],
                                [-51.1622591, -29.7843363],
                                [-51.1625211, -29.7846484],
                                [-51.1626783, -29.7848739],
                                [-51.1628537, -29.7851929],
                                [-51.1629721, -29.7855027],
                                [-51.1630963, -29.7859571],
                                [-51.1631771, -29.7864047],
                                [-51.16342, -29.787856],
                                [-51.1642208, -29.788371],
                                [-51.164619, -29.78865],
                                [-51.1652334, -29.7890571],
                                [-51.1656115, -29.7893192],
                                [-51.1665842, -29.7899643],
                                [-51.1675718, -29.7906197],
                                [-51.1676113, -29.7906441],
                                [-51.1676022, -29.7905895],
                                [-51.1760644, -29.7858976],
                                [-51.1793963, -29.783885],
                            ],
                        ],
                    ],
                }],
            },
        },
        {
            type: "Feature",
            id: 02,
            properties: {
                name: data[2].name,
                population: data[2].population,
                Covid19: data[2].cv19,
            },
            geometry: {
                type: "GeometryCollection",
                geometries: [{
                    type: "MultiPolygon",
                    coordinates: [
                        [
                            [
                                [-51.1541084, -29.7724497],
                                [-51.1484316, -29.7716046],
                                [-51.1484157, -29.7717276],
                                [-51.1478143, -29.773247],
                                [-51.1477027, -29.7736479],
                                [-51.1478576, -29.7770239],
                                [-51.1479145, -29.7781219],
                                [-51.1477721, -29.7787014],
                                [-51.1477097, -29.7787537],
                                [-51.1474942, -29.7787883],
                                [-51.1467722, -29.7789044],
                                [-51.1458357, -29.779055],
                                [-51.1442234, -29.7793143],
                                [-51.1434034, -29.7794462],
                                [-51.143199, -29.779479],
                                [-51.1431927, -29.7794838],
                                [-51.1438074, -29.7774581],
                                [-51.1438744, -29.7764531],
                                [-51.1437659, -29.7753337],
                                [-51.1436578, -29.77435],
                                [-51.1434766, -29.773375],
                                [-51.1432864, -29.7727773],
                                [-51.1429006, -29.7720003],
                                [-51.141841, -29.7702375],
                                [-51.1410566, -29.7689324],
                                [-51.140175, -29.7672464],
                                [-51.1400187, -29.7667115],
                                [-51.1399629, -29.766156],
                                [-51.139995, -29.7656256],
                                [-51.1402232, -29.7642425],
                                [-51.1403766, -29.7632273],
                                [-51.1405069, -29.7624329],
                                [-51.1408801, -29.7614903],
                                [-51.1415225, -29.7599982],
                                [-51.1416318, -29.7596177],
                                [-51.1415954, -29.7593467],
                                [-51.1415806, -29.7589264],
                                [-51.1416053, -29.7584272],
                                [-51.1417262, -29.7578615],
                                [-51.14192, -29.757364],
                                [-51.1422889, -29.7564169],
                                [-51.142289, -29.7564169],
                                [-51.1442604, -29.7570959],
                                [-51.1460743, -29.7581603],
                                [-51.1462775, -29.7582732],
                                [-51.1479085, -29.7593074],
                                [-51.1483684, -29.759497],
                                [-51.1494493, -29.7597028],
                                [-51.1519876, -29.7591369],
                                [-51.1520537, -29.7606838],
                                [-51.1521106, -29.7611372],
                                [-51.1521824, -29.7614401],
                                [-51.1524068, -29.7618957],
                                [-51.1535594, -29.7638981],
                                [-51.1537508, -29.7642671],
                                [-51.1538601, -29.7645245],
                                [-51.1539193, -29.7647296],
                                [-51.1539672, -29.7651305],
                                [-51.1539717, -29.7654198],
                                [-51.1539512, -29.7656727],
                                [-51.1539057, -29.7659483],
                                [-51.1536095, -29.7672331],
                                [-51.1533043, -29.7685224],
                                [-51.1532359, -29.7688801],
                                [-51.1532246, -29.7691603],
                                [-51.1532473, -29.769445],
                                [-51.1533385, -29.7697981],
                                [-51.1537963, -29.7713904],
                                [-51.1541084, -29.7724497],
                            ],
                        ],
                    ],
                }],
            },
        },
        {
            type: "Feature",
            id: 03,
            properties: {
                name: data[3].name,
                population: data[3].population,
                Covid19: data[3].cv19,
            },
            geometry: {
                type: "GeometryCollection",
                geometries: [{
                    type: "MultiPolygon",
                    coordinates: [
                        [
                            [
                                [-51.2079939, -29.7385213],
                                [-51.2090001, -29.735],
                                [-51.2070001, -29.726],
                                [-51.1960001, -29.714],
                                [-51.1960001, -29.705],
                                [-51.195797, -29.7040866],
                                [-51.1931602, -29.7045516],
                                [-51.1900598, -29.7050892],
                                [-51.1893833, -29.7052532],
                                [-51.1889618, -29.7053945],
                                [-51.1884379, -29.7056132],
                                [-51.187898, -29.7058888],
                                [-51.1875062, -29.7061348],
                                [-51.1871075, -29.7064332],
                                [-51.1867157, -29.7067681],
                                [-51.1864082, -29.707087],
                                [-51.1861667, -29.70739],
                                [-51.1859549, -29.7076839],
                                [-51.1856724, -29.7081622],
                                [-51.1855016, -29.7085245],
                                [-51.1849662, -29.7098856],
                                [-51.1846701, -29.7106065],
                                [-51.1845197, -29.7109232],
                                [-51.1843626, -29.711176],
                                [-51.1841165, -29.7115177],
                                [-51.1839548, -29.7117045],
                                [-51.1835903, -29.7120759],
                                [-51.1832236, -29.7123902],
                                [-51.1827292, -29.7127501],
                                [-51.1717037, -29.7203655],
                                [-51.1710135, -29.7208689],
                                [-51.1708802, -29.7209806],
                                [-51.1705738, -29.7212482],
                                [-51.1702116, -29.7216138],
                                [-51.169494, -29.7225501],
                                [-51.1679377, -29.7245972],
                                [-51.1681477, -29.7261129],
                                [-51.1680976, -29.726769],
                                [-51.1680885, -29.7268829],
                                [-51.1680156, -29.7269239],
                                [-51.1679382, -29.7269466],
                                [-51.1678243, -29.7269603],
                                [-51.1677195, -29.727015],
                                [-51.1665577, -29.7277667],
                                [-51.1662661, -29.7279809],
                                [-51.1659745, -29.7280674],
                                [-51.1655417, -29.7281768],
                                [-51.1652091, -29.7283362],
                                [-51.1649175, -29.7285412],
                                [-51.1643161, -29.7291609],
                                [-51.1639095, -29.7295648],
                                [-51.1636419, -29.7298306],
                                [-51.1630405, -29.7305504],
                                [-51.1606805, -29.7331724],
                                [-51.1603114, -29.7335916],
                                [-51.1600586, -29.7342362],
                                [-51.1600176, -29.7345597],
                                [-51.1601087, -29.7350017],
                                [-51.1601836, -29.7351855],
                                [-51.1602636, -29.7353821],
                                [-51.1605597, -29.7357898],
                                [-51.1626801, -29.738009],
                                [-51.1631134, -29.7385326],
                                [-51.1640426, -29.7393545],
                                [-51.1641931, -29.7394802],
                                [-51.1665486, -29.7408971],
                                [-51.1672593, -29.7413345],
                                [-51.167384, -29.7415144],
                                [-51.1674962, -29.7416762],
                                [-51.1676921, -29.74215],
                                [-51.1689587, -29.7468928],
                                [-51.1847134, -29.7449519],
                                [-51.1847134, -29.7463187],
                                [-51.187119, -29.7462094],
                                [-51.1871555, -29.7498541],
                                [-51.1984543, -29.7498177],
                                [-51.1977982, -29.738774],
                                [-51.2079939, -29.7385213],
                            ],
                        ],
                    ],
                }],
            },
        },
        {
            type: "Feature",
            id: 04,
            properties: {
                name: data[4].name,
                population: data[4].population,
                Covid19: data[4].cv19,
            },
            geometry: {
                type: "GeometryCollection",
                geometries: [{
                    type: "MultiPolygon",
                    coordinates: [
                        [
                            [
                                [-51.195797, -29.7040866],
                                [-51.1940001, -29.696],
                                [-51.1930001, -29.68],
                                [-51.1769655, -29.6719664],
                                [-51.1769485, -29.6721928],
                                [-51.1765623, -29.6730001],
                                [-51.1760458, -29.6740797],
                                [-51.1759221, -29.6744499],
                                [-51.1758655, -29.6747882],
                                [-51.1758474, -29.6749507],
                                [-51.1758514, -29.6752556],
                                [-51.1759292, -29.6755938],
                                [-51.1769664, -29.6781026],
                                [-51.1770281, -29.6783152],
                                [-51.1768497, -29.679375],
                                [-51.1768137, -29.6796126],
                                [-51.1766948, -29.6804001],
                                [-51.1765194, -29.681357],
                                [-51.1764585, -29.6815053],
                                [-51.1767093, -29.682477],
                                [-51.1770652, -29.6835626],
                                [-51.1777079, -29.6849074],
                                [-51.1781236, -29.6857771],
                                [-51.1783946, -29.6863441],
                                [-51.1787892, -29.6871697],
                                [-51.1780001, -29.693],
                                [-51.1670001, -29.695],
                                [-51.1655994, -29.6945103],
                                [-51.1655053, -29.696385],
                                [-51.1649768, -29.6975331],
                                [-51.1657422, -29.6996653],
                                [-51.1655053, -29.7010139],
                                [-51.1659427, -29.7019797],
                                [-51.1666534, -29.7033465],
                                [-51.167109, -29.7046587],
                                [-51.1670543, -29.705661],
                                [-51.1665805, -29.7077932],
                                [-51.1666716, -29.7083946],
                                [-51.1666898, -29.7087044],
                                [-51.1666033, -29.708955],
                                [-51.166503, -29.7091919],
                                [-51.1664256, -29.7094197],
                                [-51.1665395, -29.7096976],
                                [-51.1666078, -29.7098616],
                                [-51.1665987, -29.709971],
                                [-51.1666078, -29.7102626],
                                [-51.166667, -29.7104448],
                                [-51.1674689, -29.7117159],
                                [-51.1675555, -29.7131146],
                                [-51.1675965, -29.7146545],
                                [-51.1672821, -29.7155657],
                                [-51.167232, -29.7161854],
                                [-51.1672229, -29.7165817],
                                [-51.1672958, -29.7170282],
                                [-51.1673869, -29.7175203],
                                [-51.167519, -29.7186821],
                                [-51.1675281, -29.7198712],
                                [-51.1675281, -29.7208462],
                                [-51.1675509, -29.7216526],
                                [-51.1677559, -29.7234841],
                                [-51.1678744, -29.7241401],
                                [-51.1679377, -29.7245972],
                                [-51.169494, -29.7225501],
                                [-51.1702116, -29.7216138],
                                [-51.1705738, -29.7212482],
                                [-51.1708802, -29.7209806],
                                [-51.1710135, -29.7208689],
                                [-51.1717037, -29.7203655],
                                [-51.1827292, -29.7127501],
                                [-51.1832236, -29.7123902],
                                [-51.1835903, -29.7120759],
                                [-51.1839548, -29.7117045],
                                [-51.1841165, -29.7115177],
                                [-51.1843626, -29.711176],
                                [-51.1845197, -29.7109232],
                                [-51.1846701, -29.7106065],
                                [-51.1849662, -29.7098856],
                                [-51.1855016, -29.7085245],
                                [-51.1856724, -29.7081622],
                                [-51.1859549, -29.7076839],
                                [-51.1861667, -29.70739],
                                [-51.1864082, -29.707087],
                                [-51.1867157, -29.7067681],
                                [-51.1871075, -29.7064332],
                                [-51.1875062, -29.7061348],
                                [-51.187898, -29.7058888],
                                [-51.1884379, -29.7056132],
                                [-51.1889618, -29.7053945],
                                [-51.1893833, -29.7052532],
                                [-51.1900598, -29.7050892],
                                [-51.1931602, -29.7045516],
                                [-51.195797, -29.7040866],
                            ],
                        ],
                    ],
                }],
            },
        },
        {
            type: "Feature",
            id: 05,
            properties: {
                name: data[5].name,
                population: data[5].population,
                Covid19: data[5].cv19,
            },
            geometry: {
                type: "GeometryCollection",
                geometries: [{
                    type: "MultiPolygon",
                    coordinates: [
                        [
                            [
                                [-51.1183506, -29.7793771],
                                [-51.1148785, -29.7804449],
                                [-51.1130868, -29.7811842],
                                [-51.112714, -29.7813729],
                                [-51.1116498, -29.7819711],
                                [-51.1115363, -29.782045],
                                [-51.1106465, -29.7825902],
                                [-51.1105264, -29.7826424],
                                [-51.1082519, -29.7836294],
                                [-51.1077841, -29.7838324],
                                [-51.1074365, -29.7839833],
                                [-51.1046169, -29.7851975],
                                [-51.0907501, -29.7908266],
                                [-51.0821369, -29.7728383],
                                [-51.0823542, -29.7725123],
                                [-51.0824937, -29.7722842],
                                [-51.0825312, -29.7719978],
                                [-51.0825822, -29.7715112],
                                [-51.0827646, -29.7712248],
                                [-51.0829201, -29.7709594],
                                [-51.0831106, -29.770843],
                                [-51.0833493, -29.7707266],
                                [-51.0834566, -29.7706568],
                                [-51.0836524, -29.7703355],
                                [-51.0837221, -29.7700817],
                                [-51.0837624, -29.7699117],
                                [-51.0838455, -29.7698093],
                                [-51.0839152, -29.7697185],
                                [-51.0839062, -29.7695203],
                                [-51.0839024, -29.7692899],
                                [-51.0839112, -29.7692481],
                                [-51.084186, -29.769156],
                                [-51.084409, -29.769101],
                                [-51.085088, -29.76896],
                                [-51.08573, -29.768764],
                                [-51.08648, -29.76861],
                                [-51.08729, -29.76852],
                                [-51.087473, -29.768468],
                                [-51.088033, -29.768203],
                                [-51.088701, -29.767937],
                                [-51.089022, -29.767821],
                                [-51.089288, -29.767764],
                                [-51.0894387, -29.7677534],
                                [-51.08983, -29.767726],
                                [-51.090176, -29.767749],
                                [-51.090571, -29.767859],
                                [-51.090966, -29.767942],
                                [-51.091411, -29.76806],
                                [-51.0924071, -29.7684052],
                                [-51.0927228, -29.7683601],
                                [-51.0928072, -29.7683381],
                                [-51.0930189, -29.768283],
                                [-51.0935286, -29.7680781],
                                [-51.0938198, -29.767961],
                                [-51.0943683, -29.7678583],
                                [-51.0948488, -29.767844],
                                [-51.0953714, -29.7678012],
                                [-51.0957792, -29.7677572],
                                [-51.0959118, -29.7677347],
                                [-51.0964098, -29.767662],
                                [-51.0965978, -29.7676106],
                                [-51.0968322, -29.7674692],
                                [-51.0971541, -29.7672285],
                                [-51.0975506, -29.7669846],
                                [-51.0978648, -29.7669384],
                                [-51.0983314, -29.7669123],
                                [-51.0986016, -29.7669333],
                                [-51.098822, -29.7670067],
                                [-51.0992292, -29.7672073],
                                [-51.0993778, -29.7673267],
                                [-51.0995484, -29.7675273],
                                [-51.1001393, -29.7682897],
                                [-51.1003139, -29.7689125],
                                [-51.1004255, -29.7690803],
                                [-51.1007002, -29.7692546],
                                [-51.1010655, -29.7694061],
                                [-51.102803, -29.7698927],
                                [-51.1035243, -29.7699768],
                                [-51.1043529, -29.7699664],
                                [-51.1045824, -29.76992],
                                [-51.1048424, -29.7697874],
                                [-51.1051661, -29.7695103],
                                [-51.1055765, -29.7691301],
                                [-51.1055449, -29.7689447],
                                [-51.1055274, -29.7688277],
                                [-51.1055085, -29.7687256],
                                [-51.1054025, -29.7681142],
                                [-51.1053342, -29.7676169],
                                [-51.1053472, -29.7673877],
                                [-51.1053954, -29.7671822],
                                [-51.1054917, -29.7670271],
                                [-51.1056428, -29.7668691],
                                [-51.106049, -29.7665712],
                                [-51.1062338, -29.7664502],
                                [-51.1064443, -29.7663557],
                                [-51.1066411, -29.7662946],
                                [-51.1074345, -29.7660121],
                                [-51.1098423, -29.7653754],
                                [-51.1101744, -29.7653276],
                                [-51.1104795, -29.7652569],
                                [-51.1107743, -29.7652343],
                                [-51.111984, -29.7652176],
                                [-51.1123416, -29.7652161],
                                [-51.1127261, -29.765154],
                                [-51.1130414, -29.7650886],
                                [-51.1133556, -29.7650263],
                                [-51.1132265, -29.7651694],
                                [-51.1129549, -29.7654475],
                                [-51.1126516, -29.7659846],
                                [-51.1126206, -29.7661172],
                                [-51.1123983, -29.7668052],
                                [-51.1122637, -29.7674202],
                                [-51.1122289, -29.7675004],
                                [-51.11202, -29.7681353],
                                [-51.1118768, -29.7687217],
                                [-51.111503, -29.7693083],
                                [-51.1110929, -29.7707845],
                                [-51.1110793, -29.7711262],
                                [-51.1098918, -29.7754279],
                                [-51.1100507, -29.7755008],
                                [-51.1107421, -29.7758258],
                                [-51.1122496, -29.7765001],
                                [-51.1125753, -29.7766458],
                                [-51.1146074, -29.7774026],
                                [-51.11374, -29.7782869],
                                [-51.1134678, -29.7785852],
                                [-51.1140712, -29.7789934],
                                [-51.1144093, -29.7791171],
                                [-51.1148162, -29.7792408],
                                [-51.11556, -29.7794306],
                                [-51.1157711, -29.7794477],
                                [-51.1171929, -29.7794324],
                                [-51.1183506, -29.7793771],
                            ],
                        ],
                    ],
                }],
            },
        },
        {
            type: "Feature",
            id: 06,
            properties: {
                name: data[6].name,
                population: data[6].population,
                Covid19: data[6].cv19,
            },
            geometry: {
                type: "GeometryCollection",
                geometries: [{
                    type: "MultiPolygon",
                    coordinates: [
                        [
                            [
                                [-51.1693831, -29.7542272],
                                [-51.169323, -29.7540162],
                                [-51.1692731, -29.7538407],
                                [-51.1692457, -29.7536813],
                                [-51.1692366, -29.753499],
                                [-51.1692503, -29.7532849],
                                [-51.169264, -29.7531983],
                                [-51.1693277, -29.7530799],
                                [-51.1694052, -29.7529159],
                                [-51.1694052, -29.7528293],
                                [-51.1693824, -29.7526881],
                                [-51.1693596, -29.7525149],
                                [-51.1694417, -29.7520775],
                                [-51.1695783, -29.7516857],
                                [-51.169797, -29.7514033],
                                [-51.1700373, -29.7509386],
                                [-51.1689587, -29.7468928],
                                [-51.1676921, -29.74215],
                                [-51.1674962, -29.7416762],
                                [-51.167384, -29.7415144],
                                [-51.1672593, -29.7413345],
                                [-51.1665486, -29.7408971],
                                [-51.1641931, -29.7394802],
                                [-51.1640426, -29.7393545],
                                [-51.1640426, -29.7393546],
                                [-51.163233, -29.740033],
                                [-51.1625302, -29.7402775],
                                [-51.1555367, -29.7428289],
                                [-51.15086, -29.7445852],
                                [-51.1513486, -29.7501321],
                                [-51.1519238, -29.7580983],
                                [-51.1519876, -29.7591369],
                                [-51.1522856, -29.7590705],
                                [-51.1539765, -29.7582508],
                                [-51.1575642, -29.7569245],
                                [-51.1614266, -29.7563806],
                                [-51.1629973, -29.7564029],
                                [-51.1643448, -29.7569096],
                                [-51.1657012, -29.757344],
                                [-51.1661129, -29.7574759],
                                [-51.166894, -29.7573643],
                                [-51.1672373, -29.7569394],
                                [-51.167512, -29.7562316],
                                [-51.1680098, -29.7553001],
                                [-51.1686278, -29.7547488],
                                [-51.1693831, -29.7542272],
                            ],
                        ],
                    ],
                }],
            },
        },
        {
            type: "Feature",
            id: 07,
            properties: {
                name: data[7].name,
                population: data[7].population,
                Covid19: data[7].cv19,
            },
            geometry: {
                type: "GeometryCollection",
                geometries: [{
                    type: "MultiPolygon",
                    coordinates: [
                        [
                            [
                                [-51.1638149, -29.7902159],
                                [-51.1619129, -29.7917216],
                                [-51.160783, -29.7925508],
                                [-51.1604663, -29.7927285],
                                [-51.1598786, -29.7929472],
                                [-51.1596349, -29.792995],
                                [-51.1596635, -29.7931625],
                                [-51.16012, -29.7955137],
                                [-51.1604036, -29.7971182],
                                [-51.1608199, -29.7993129],
                                [-51.1609985, -29.8001639],
                                [-51.1585517, -29.7996643],
                                [-51.1546509, -29.7988654],
                                [-51.1488372, -29.7989901],
                                [-51.1487347, -29.7989926],
                                [-51.1478166, -29.7983939],
                                [-51.1476252, -29.7983119],
                                [-51.1474384, -29.7982709],
                                [-51.147099, -29.7982777],
                                [-51.1467186, -29.7983392],
                                [-51.1462265, -29.7984895],
                                [-51.1458074, -29.7984417],
                                [-51.145534, -29.79828],
                                [-51.1452288, -29.7980112],
                                [-51.1449577, -29.7977036],
                                [-51.1448392, -29.7973824],
                                [-51.1448187, -29.7970817],
                                [-51.1448529, -29.7967241],
                                [-51.1449645, -29.7962844],
                                [-51.1449805, -29.7960384],
                                [-51.1449304, -29.7957149],
                                [-51.1442971, -29.7948539],
                                [-51.1437276, -29.7938675],
                                [-51.1434702, -29.7934688],
                                [-51.1433403, -29.7923617],
                                [-51.1432674, -29.7913548],
                                [-51.1432925, -29.7901543],
                                [-51.1433722, -29.7896281],
                                [-51.1435226, -29.7893251],
                                [-51.1437663, -29.7890655],
                                [-51.1441684, -29.7887283],
                                [-51.1443882, -29.7884709],
                                [-51.1454657, -29.7865597],
                                [-51.1460511, -29.7853933],
                                [-51.1462584, -29.7845596],
                                [-51.1468507, -29.7823226],
                                [-51.1477721, -29.7787014],
                                [-51.1478423, -29.778643],
                                [-51.1484291, -29.7783413],
                                [-51.1487323, -29.7781856],
                                [-51.1506644, -29.7771929],
                                [-51.1508999, -29.7770717],
                                [-51.1509591, -29.7770342],
                                [-51.1530446, -29.7778349],
                                [-51.1535435, -29.777926],
                                [-51.1540059, -29.7779215],
                                [-51.1555914, -29.7776128],
                                [-51.1556848, -29.7778338],
                                [-51.1558648, -29.7781743],
                                [-51.1560447, -29.7784112],
                                [-51.1562395, -29.7786436],
                                [-51.1565698, -29.7789921],
                                [-51.1593592, -29.7816164],
                                [-51.1613411, -29.7834638],
                                [-51.1622591, -29.7843363],
                                [-51.1625211, -29.7846484],
                                [-51.1626783, -29.7848739],
                                [-51.1628537, -29.7851929],
                                [-51.1629721, -29.7855027],
                                [-51.1630963, -29.7859571],
                                [-51.1631771, -29.7864047],
                                [-51.16342, -29.787856],
                                [-51.1638149, -29.7902159],
                            ],
                        ],
                    ],
                }],
            },
        },
        {
        type: "Feature",
        id: 08,
        properties: {
            name: data[8].name,
            population: data[8].population,
            Covid19: data[8].cv19,
        },
        geometry: {
            type: "GeometryCollection",
            geometries: [
            {
                type: "MultiPolygon",
                coordinates: [
                [
                    [
                    [-51.1487347, -29.7989926],
                    [-51.1478166, -29.7983939],
                    [-51.1476252, -29.7983119],
                    [-51.1474384, -29.7982709],
                    [-51.147099, -29.7982777],
                    [-51.1467186, -29.7983392],
                    [-51.1462265, -29.7984895],
                    [-51.1458074, -29.7984417],
                    [-51.145534, -29.79828],
                    [-51.1452288, -29.7980112],
                    [-51.1449577, -29.7977036],
                    [-51.1448392, -29.7973824],
                    [-51.1448187, -29.7970817],
                    [-51.1448529, -29.7967241],
                    [-51.1449645, -29.7962844],
                    [-51.1449805, -29.7960384],
                    [-51.1449304, -29.7957149],
                    [-51.1442971, -29.7948539],
                    [-51.1437276, -29.7938675],
                    [-51.1434702, -29.7934688],
                    [-51.1433403, -29.7923617],
                    [-51.1432674, -29.7913548],
                    [-51.1432925, -29.7901543],
                    [-51.1433722, -29.7896281],
                    [-51.1435226, -29.7893251],
                    [-51.1437663, -29.7890655],
                    [-51.1441684, -29.7887283],
                    [-51.1403666, -29.7870518],
                    [-51.1398314, -29.7879245],
                    [-51.1382736, -29.7901078],
                    [-51.1377987, -29.7905984],
                    [-51.1363609, -29.7918777],
                    [-51.1360894, -29.7921567],
                    [-51.1357525, -29.7926285],
                    [-51.1354784, -29.7930897],
                    [-51.1352163, -29.793712],
                    [-51.1350395, -29.7943271],
                    [-51.1348793, -29.7943463],
                    [-51.1332708, -29.7945859],
                    [-51.1325581, -29.7946921],
                    [-51.1324361, -29.7947104],
                    [-51.1323608, -29.7945566],
                    [-51.1322674, -29.7943656],
                    [-51.1321534, -29.7941407],
                    [-51.1319356, -29.7936756],
                    [-51.1316, -29.7930111],
                    [-51.1311907, -29.7924379],
                    [-51.1298274, -29.7905281],
                    [-51.1291893, -29.7906586],
                    [-51.1286595, -29.7907357],
                    [-51.1273529, -29.7909077],
                    [-51.1268386, -29.7909952],
                    [-51.1264034, -29.7910473],
                    [-51.1205011, -29.7917876],
                    [-51.1225567, -29.7990906],
                    [-51.1229684, -29.8005533],
                    [-51.1253473, -29.8003188],
                    [-51.1255249, -29.8017283],
                    [-51.1277768, -29.8014557],
                    [-51.127595, -29.8001251],
                    [-51.1318892, -29.7997588],
                    [-51.1357924, -29.7993673],
                    [-51.1483199, -29.7990029],
                    [-51.1487347, -29.7989926],
                    ],
                ],
                ],
            },
            ],
        },
        },
        {
        type: "Feature",
        id: 09,
        properties: {
            name: data[9].name,
            population: data[9].population,
            Covid19: data[9].cv19,
        },
        geometry: {
            type: "GeometryCollection",
            geometries: [
            {
                type: "MultiPolygon",
                coordinates: [
                [
                    [
                    [-51.1172219, -29.7586667],
                    [-51.1164417, -29.7603216],
                    [-51.1148811, -29.7628321],
                    [-51.1147843, -29.7629925],
                    [-51.1147252, -29.7631004],
                    [-51.114178, -29.7639215],
                    [-51.113766, -29.7645703],
                    [-51.1137257, -29.7646282],
                    [-51.1136827, -29.764682],
                    [-51.1136316, -29.7647362],
                    [-51.1133556, -29.7650263],
                    [-51.1130414, -29.7650886],
                    [-51.1127261, -29.765154],
                    [-51.1123416, -29.7652161],
                    [-51.111984, -29.7652176],
                    [-51.1107743, -29.7652343],
                    [-51.1104795, -29.7652569],
                    [-51.1101744, -29.7653276],
                    [-51.1098423, -29.7653754],
                    [-51.1074345, -29.7660121],
                    [-51.1066411, -29.7662946],
                    [-51.1064443, -29.7663557],
                    [-51.1062338, -29.7664502],
                    [-51.106049, -29.7665712],
                    [-51.1056428, -29.7668691],
                    [-51.1054917, -29.7670271],
                    [-51.1053954, -29.7671822],
                    [-51.1053472, -29.7673877],
                    [-51.1053342, -29.7676169],
                    [-51.1054025, -29.7681142],
                    [-51.1055085, -29.7687256],
                    [-51.1055274, -29.7688277],
                    [-51.1055449, -29.7689447],
                    [-51.1055765, -29.7691301],
                    [-51.1051661, -29.7695103],
                    [-51.1048424, -29.7697874],
                    [-51.1045824, -29.76992],
                    [-51.1043529, -29.7699664],
                    [-51.1035243, -29.7699768],
                    [-51.102803, -29.7698927],
                    [-51.1010655, -29.7694061],
                    [-51.1007002, -29.7692546],
                    [-51.1004255, -29.7690803],
                    [-51.1003139, -29.7689125],
                    [-51.1001393, -29.7682897],
                    [-51.0995484, -29.7675273],
                    [-51.0993778, -29.7673267],
                    [-51.0992292, -29.7672073],
                    [-51.098822, -29.7670067],
                    [-51.0986016, -29.7669333],
                    [-51.0983314, -29.7669123],
                    [-51.0978648, -29.7669384],
                    [-51.0975506, -29.7669846],
                    [-51.0971541, -29.7672285],
                    [-51.0968322, -29.7674692],
                    [-51.0965978, -29.7676106],
                    [-51.0964098, -29.767662],
                    [-51.0959118, -29.7677347],
                    [-51.0957792, -29.7677572],
                    [-51.0953714, -29.7678012],
                    [-51.0948488, -29.767844],
                    [-51.0943683, -29.7678583],
                    [-51.0938198, -29.767961],
                    [-51.0935286, -29.7680781],
                    [-51.0930189, -29.768283],
                    [-51.0928072, -29.7683381],
                    [-51.0927228, -29.7683601],
                    [-51.0924071, -29.7684052],
                    [-51.091411, -29.76806],
                    [-51.090966, -29.767942],
                    [-51.090571, -29.767859],
                    [-51.090176, -29.767749],
                    [-51.08983, -29.767726],
                    [-51.0894387, -29.7677534],
                    [-51.089288, -29.767764],
                    [-51.089022, -29.767821],
                    [-51.088701, -29.767937],
                    [-51.088033, -29.768203],
                    [-51.087473, -29.768468],
                    [-51.08729, -29.76852],
                    [-51.08648, -29.76861],
                    [-51.08573, -29.768764],
                    [-51.085088, -29.76896],
                    [-51.084409, -29.769101],
                    [-51.084186, -29.769156],
                    [-51.0839112, -29.7692481],
                    [-51.0839037, -29.7692006],
                    [-51.0839843, -29.7689719],
                    [-51.0840024, -29.7687197],
                    [-51.0839139, -29.7684182],
                    [-51.0839233, -29.7682517],
                    [-51.0839206, -29.7678466],
                    [-51.0840467, -29.7676021],
                    [-51.0842747, -29.7671388],
                    [-51.0844409, -29.7666475],
                    [-51.084567, -29.7663192],
                    [-51.0849237, -29.7658861],
                    [-51.0849989, -29.7656347],
                    [-51.0852403, -29.7653739],
                    [-51.0855192, -29.7649688],
                    [-51.0856211, -29.7644379],
                    [-51.0854924, -29.7641818],
                    [-51.0854602, -29.7640095],
                    [-51.0855736, -29.7636602],
                    [-51.0858709, -29.7633608],
                    [-51.0863668, -29.7631946],
                    [-51.0866725, -29.7630362],
                    [-51.0869086, -29.7627894],
                    [-51.0870776, -29.7624425],
                    [-51.0870963, -29.7621812],
                    [-51.0870226, -29.7616047],
                    [-51.0872601, -29.7608634],
                    [-51.0867079, -29.7593552],
                    [-51.0865754, -29.7583647],
                    [-51.0860052, -29.7573736],
                    [-51.0861779, -29.7563772],
                    [-51.0867193, -29.7555098],
                    [-51.0866973, -29.7542113],
                    [-51.0862405, -29.7533283],
                    [-51.0864855, -29.752736],
                    [-51.0864342, -29.7515883],
                    [-51.0864764, -29.751303],
                    [-51.086178, -29.7510248],
                    [-51.0859217, -29.7508287],
                    [-51.0859085, -29.7507117],
                    [-51.0858408, -29.7506132],
                    [-51.0856008, -29.7504184],
                    [-51.0852112, -29.7503833],
                    [-51.0849398, -29.7501657],
                    [-51.084742, -29.7499162],
                    [-51.0844546, -29.7497771],
                    [-51.0841766, -29.7492944],
                    [-51.084219, -29.748865],
                    [-51.0840824, -29.7484845],
                    [-51.0839014, -29.7483729],
                    [-51.0839183, -29.7482619],
                    [-51.0840292, -29.748197],
                    [-51.0840823, -29.748086],
                    [-51.0840461, -29.7479582],
                    [-51.0841233, -29.7475708],
                    [-51.0840775, -29.7473509],
                    [-51.084875, -29.7460461],
                    [-51.0859148, -29.7457425],
                    [-51.0870199, -29.7446048],
                    [-51.0870291, -29.7432306],
                    [-51.0864669, -29.742387],
                    [-51.0864402, -29.7419523],
                    [-51.0860537, -29.7416327],
                    [-51.0862561, -29.7400907],
                    [-51.0861097, -29.7388674],
                    [-51.0863721, -29.7384128],
                    [-51.086694, -29.7382219],
                    [-51.0872841, -29.7380449],
                    [-51.0876221, -29.7380169],
                    [-51.0879922, -29.7380309],
                    [-51.0882872, -29.7380355],
                    [-51.0885313, -29.7381101],
                    [-51.0888344, -29.7381357],
                    [-51.0891278, -29.7378989],
                    [-51.0893814, -29.7380631],
                    [-51.0899399, -29.7382279],
                    [-51.0908823, -29.7376909],
                    [-51.0914402, -29.7370723],
                    [-51.0915175, -29.735701],
                    [-51.0919895, -29.7353656],
                    [-51.0928736, -29.7359097],
                    [-51.0931053, -29.7369531],
                    [-51.0941096, -29.7381977],
                    [-51.0953369, -29.7386672],
                    [-51.0958262, -29.7384734],
                    [-51.0963669, -29.7371617],
                    [-51.0970021, -29.7365506],
                    [-51.0977145, -29.736409],
                    [-51.0997143, -29.7367295],
                    [-51.1006584, -29.7365581],
                    [-51.1014824, -29.736096],
                    [-51.1035619, -29.7486332],
                    [-51.1112889, -29.7475398],
                    [-51.1129837, -29.758055],
                    [-51.1172219, -29.7586667],
                    ],
                ],
                ],
            },
            ],
        },
        },
        {
        type: "Feature",
        id: 10,
        properties: {
            name: data[10].name,
            population: data[10].population,
            Covid19: data[10].cv19,
        },
        geometry: {
            type: "GeometryCollection",
            geometries: [
            {
                type: "MultiPolygon",
                coordinates: [
                [
                    [
                    [-51.1555914, -29.7776128],
                    [-51.1555139, -29.7773953],
                    [-51.155449, -29.7771834],
                    [-51.1549217, -29.7752949],
                    [-51.1543841, -29.7734543],
                    [-51.1541084, -29.7724497],
                    [-51.1484316, -29.7716046],
                    [-51.1484157, -29.7717276],
                    [-51.1478143, -29.773247],
                    [-51.1477027, -29.7736479],
                    [-51.1478576, -29.7770239],
                    [-51.1479145, -29.7781219],
                    [-51.1477721, -29.7787014],
                    [-51.1478423, -29.778643],
                    [-51.1484291, -29.7783413],
                    [-51.1487323, -29.7781856],
                    [-51.1506644, -29.7771929],
                    [-51.1508999, -29.7770717],
                    [-51.1509591, -29.7770342],
                    [-51.1530446, -29.7778349],
                    [-51.1535435, -29.777926],
                    [-51.1540059, -29.7779215],
                    [-51.1555914, -29.7776128],
                    ],
                ],
                ],
            },
            ],
        },
        },
        {
        type: "Feature",
        id: 11,
        properties: {
            name: data[11].name,
            population: data[11].population,
            Covid19: data[11].cv19,
        },
        geometry: {
            type: "GeometryCollection",
            geometries: [
            {
                type: "MultiPolygon",
                coordinates: [
                [
                    [
                    [-51.1365863, -29.7774928],
                    [-51.1365831, -29.7775537],
                    [-51.1363856, -29.7780803],
                    [-51.1361073, -29.7789165],
                    [-51.1360895, -29.7797326],
                    [-51.136079, -29.7803846],
                    [-51.1360774, -29.7804852],
                    [-51.1360743, -29.7805193],
                    [-51.1360384, -29.780912],
                    [-51.1357425, -29.7814473],
                    [-51.135224, -29.7823223],
                    [-51.1348237, -29.783007],
                    [-51.1345284, -29.7835287],
                    [-51.1345347, -29.7835631],
                    [-51.1338877, -29.7836005],
                    [-51.1332659, -29.7837429],
                    [-51.1328046, -29.7839502],
                    [-51.1321075, -29.7843842],
                    [-51.1292372, -29.7870881],
                    [-51.1277292, -29.7884288],
                    [-51.1277001, -29.7883521],
                    [-51.12739, -29.7875244],
                    [-51.1271176, -29.7868174],
                    [-51.1268746, -29.78621],
                    [-51.1266698, -29.7855656],
                    [-51.126451, -29.7850755],
                    [-51.1264157, -29.7849346],
                    [-51.1262595, -29.7844751],
                    [-51.1261887, -29.7842677],
                    [-51.1259969, -29.7837045],
                    [-51.125907, -29.7836297],
                    [-51.1258349, -29.7834323],
                    [-51.1257116, -29.7829258],
                    [-51.1252668, -29.7820697],
                    [-51.1248241, -29.7824908],
                    [-51.124764, -29.7825452],
                    [-51.1243678, -29.7828757],
                    [-51.124078, -29.7830431],
                    [-51.1238073, -29.7831517],
                    [-51.1234969, -29.7832112],
                    [-51.1231829, -29.7832313],
                    [-51.1229562, -29.7832313],
                    [-51.1227806, -29.7831946],
                    [-51.1224347, -29.7830292],
                    [-51.1218027, -29.7824736],
                    [-51.1217631, -29.7824205],
                    [-51.123893, -29.7809899],
                    [-51.1263761, -29.7785789],
                    [-51.1304856, -29.7745728],
                    [-51.1315463, -29.7735489],
                    [-51.131597, -29.7735847],
                    [-51.1322546, -29.774091],
                    [-51.1329618, -29.7745581],
                    [-51.1336559, -29.7750167],
                    [-51.1337816, -29.7750998],
                    [-51.133896, -29.7751633],
                    [-51.134372, -29.7754285],
                    [-51.1350058, -29.7757788],
                    [-51.1357549, -29.7759908],
                    [-51.1364018, -29.7761737],
                    [-51.1365353, -29.7768015],
                    [-51.1365863, -29.7774928],
                    ],
                ],
                ],
            },
            ],
        },
        },
        {
        type: "Feature",
        id: 12,
        properties: {
            name: data[12].name,
            population: data[12].population,
            Covid19: data[12].cv19,
        },
        geometry: {
            type: "GeometryCollection",
            geometries: [
            {
                type: "MultiPolygon",
                coordinates: [
                [
                    [
                    [-51.1431813, -29.7794815],
                    [-51.1433084, -29.7789739],
                    [-51.1434952, -29.7784705],
                    [-51.1438074, -29.7774581],
                    [-51.1438688, -29.7769488],
                    [-51.1438744, -29.7764531],
                    [-51.1437659, -29.7753337],
                    [-51.1436578, -29.77435],
                    [-51.1434766, -29.773375],
                    [-51.1432864, -29.7727773],
                    [-51.1429006, -29.7720003],
                    [-51.141841, -29.7702375],
                    [-51.1407442, -29.77002],
                    [-51.1376863, -29.7693266],
                    [-51.1374881, -29.7692924],
                    [-51.1372148, -29.7693084],
                    [-51.1370439, -29.7693471],
                    [-51.13575, -29.7696751],
                    [-51.1357791, -29.7697331],
                    [-51.1360208, -29.7702645],
                    [-51.136131, -29.7705533],
                    [-51.1362123, -29.7710361],
                    [-51.1361794, -29.771481],
                    [-51.1361293, -29.7725263],
                    [-51.1360722, -29.7731527],
                    [-51.1360387, -29.7735216],
                    [-51.1360002, -29.7741685],
                    [-51.136092, -29.7746817],
                    [-51.1360966, -29.7747034],
                    [-51.1361699, -29.7750472],
                    [-51.1364018, -29.7761737],
                    [-51.1365353, -29.7768015],
                    [-51.1365863, -29.7774928],
                    [-51.1365831, -29.7775537],
                    [-51.1363856, -29.7780803],
                    [-51.1361073, -29.7789165],
                    [-51.1360895, -29.7797326],
                    [-51.136079, -29.7803846],
                    [-51.1360774, -29.7804852],
                    [-51.1360743, -29.7805193],
                    [-51.1360384, -29.780912],
                    [-51.1357425, -29.7814473],
                    [-51.135224, -29.7823223],
                    [-51.1348237, -29.783007],
                    [-51.1345284, -29.7835287],
                    [-51.1345347, -29.7835631],
                    [-51.1414017, -29.7837828],
                    [-51.141667, -29.7839666],
                    [-51.1427976, -29.7813059],
                    [-51.142969, -29.7806482],
                    [-51.1431813, -29.7794815],
                    ],
                ],
                ],
            },
            ],
        },
        },
        {
        type: "Feature",
        id: 13,
        properties: {
            name: data[13].name,
            population: data[13].population,
            Covid19: data[13].cv19,
        },
        geometry: {
            type: "GeometryCollection",
            geometries: [
            {
                type: "MultiPolygon",
                coordinates: [
                [
                    [
                    [-51.1519876, -29.7591369],
                    [-51.1519238, -29.7580983],
                    [-51.1513486, -29.7501321],
                    [-51.15086, -29.7445852],
                    [-51.1500073, -29.7449151],
                    [-51.1496935, -29.7451249],
                    [-51.1476133, -29.7461234],
                    [-51.1473918, -29.7464038],
                    [-51.1465661, -29.7467913],
                    [-51.1461945, -29.7469794],
                    [-51.1458663, -29.7472085],
                    [-51.1456303, -29.7474264],
                    [-51.1454329, -29.7477579],
                    [-51.1452491, -29.7481499],
                    [-51.1450269, -29.7481738],
                    [-51.1451358, -29.749043],
                    [-51.1452265, -29.749795],
                    [-51.1452847, -29.7505089],
                    [-51.1452766, -29.750885],
                    [-51.1452177, -29.7512533],
                    [-51.1451285, -29.7516163],
                    [-51.1449642, -29.7520368],
                    [-51.1447194, -29.7524867],
                    [-51.1443684, -29.752917],
                    [-51.1433995, -29.753916],
                    [-51.1430461, -29.7543352],
                    [-51.1426745, -29.7549479],
                    [-51.1426164, -29.7550579],
                    [-51.1424428, -29.755516],
                    [-51.1421095, -29.7563542],
                    [-51.1421097, -29.7563542],
                    [-51.142289, -29.7564169],
                    [-51.1442604, -29.7570959],
                    [-51.1460743, -29.7581603],
                    [-51.1462775, -29.7582732],
                    [-51.1479085, -29.7593074],
                    [-51.1483684, -29.759497],
                    [-51.1494493, -29.7597028],
                    [-51.1519876, -29.7591369],
                    ],
                ],
                ],
            },
            ],
        },
        },
        {
        type: "Feature",
        id: 14,
        properties: {
            name: data[14].name,
            population: data[14].population,
            Covid19: data[14].cv19,
        },
        geometry: {
            type: "GeometryCollection",
            geometries: [
            {
                type: "MultiPolygon",
                coordinates: [
                [
                    [
                    [-51.141667, -29.7839666],
                    [-51.1415783, -29.7841928],
                    [-51.1410025, -29.7857061],
                    [-51.1404596, -29.7868986],
                    [-51.1403666, -29.7870518],
                    [-51.1398314, -29.7879245],
                    [-51.1382736, -29.7901078],
                    [-51.1377987, -29.7905984],
                    [-51.1363609, -29.7918777],
                    [-51.1360894, -29.7921567],
                    [-51.1357525, -29.7926285],
                    [-51.1354784, -29.7930897],
                    [-51.1352163, -29.793712],
                    [-51.1350395, -29.7943271],
                    [-51.1348793, -29.7943463],
                    [-51.1332708, -29.7945859],
                    [-51.1325581, -29.7946921],
                    [-51.1324361, -29.7947104],
                    [-51.1323608, -29.7945566],
                    [-51.1322674, -29.7943656],
                    [-51.1321534, -29.7941407],
                    [-51.1319356, -29.7936756],
                    [-51.1316, -29.7930111],
                    [-51.1311907, -29.7924379],
                    [-51.1298274, -29.7905281],
                    [-51.1291893, -29.7906586],
                    [-51.1286595, -29.7907357],
                    [-51.1283302, -29.7899174],
                    [-51.1280564, -29.7892371],
                    [-51.1278221, -29.7886551],
                    [-51.1277563, -29.7884918],
                    [-51.1277292, -29.7884288],
                    [-51.1292372, -29.7870881],
                    [-51.1321075, -29.7843842],
                    [-51.1328046, -29.7839502],
                    [-51.1332659, -29.7837429],
                    [-51.1338877, -29.7836005],
                    [-51.1345347, -29.7835631],
                    [-51.1414017, -29.7837828],
                    [-51.141667, -29.7839666],
                    ],
                ],
                ],
            },
            ],
        },
        },
        {
        type: "Feature",
        id: 15,
        properties: {
            name: data[15].name,
            population: data[15].population,
            Covid19: data[15].cv19,
        },
        geometry: {
            type: "GeometryCollection",
            geometries: [
            {
                type: "MultiPolygon",
                coordinates: [
                [
                    [
                    [-51.1286595, -29.7907357],
                    [-51.1283302, -29.7899174],
                    [-51.1280564, -29.7892371],
                    [-51.1278221, -29.7886551],
                    [-51.1277563, -29.7884918],
                    [-51.1277292, -29.7884288],
                    [-51.1277001, -29.7883521],
                    [-51.12739, -29.7875244],
                    [-51.1271176, -29.7868174],
                    [-51.1268746, -29.78621],
                    [-51.1266698, -29.7855656],
                    [-51.126451, -29.7850755],
                    [-51.1264157, -29.7849346],
                    [-51.1262595, -29.7844751],
                    [-51.1261887, -29.7842677],
                    [-51.1259969, -29.7837045],
                    [-51.125907, -29.7836297],
                    [-51.1258349, -29.7834323],
                    [-51.1257116, -29.7829258],
                    [-51.1252668, -29.7820697],
                    [-51.1248241, -29.7824908],
                    [-51.124764, -29.7825452],
                    [-51.1243678, -29.7828757],
                    [-51.124078, -29.7830431],
                    [-51.1238073, -29.7831517],
                    [-51.1234969, -29.7832112],
                    [-51.1231829, -29.7832313],
                    [-51.1229562, -29.7832313],
                    [-51.1227806, -29.7831946],
                    [-51.1224347, -29.7830292],
                    [-51.1218027, -29.7824736],
                    [-51.1217631, -29.7824205],
                    [-51.123893, -29.7809899],
                    [-51.1263761, -29.7785789],
                    [-51.126326, -29.7785398],
                    [-51.1262073, -29.7783193],
                    [-51.1223645, -29.7756499],
                    [-51.1220686, -29.7755455],
                    [-51.1219698, -29.775492],
                    [-51.1219134, -29.7754624],
                    [-51.1218677, -29.7754406],
                    [-51.1202802, -29.7772736],
                    [-51.1197667, -29.7778588],
                    [-51.1183506, -29.7793771],
                    [-51.1148785, -29.7804449],
                    [-51.1130868, -29.7811842],
                    [-51.112714, -29.7813729],
                    [-51.1116498, -29.7819711],
                    [-51.1115363, -29.782045],
                    [-51.1106465, -29.7825902],
                    [-51.1105264, -29.7826424],
                    [-51.1082519, -29.7836294],
                    [-51.1077841, -29.7838324],
                    [-51.1074365, -29.7839833],
                    [-51.1046169, -29.7851975],
                    [-51.0907501, -29.7908266],
                    [-51.0983663, -29.8065028],
                    [-51.1060687, -29.8069943],
                    [-51.10623, -29.8034552],
                    [-51.1222637, -29.8006227],
                    [-51.1229684, -29.8005533],
                    [-51.1225567, -29.7990906],
                    [-51.1205011, -29.7917876],
                    [-51.1264034, -29.7910473],
                    [-51.1268386, -29.7909952],
                    [-51.1273529, -29.7909077],
                    [-51.1286595, -29.7907357],
                    ],
                ],
                ],
            },
            ],
        },
        },
        {
        type: "Feature",
        id: 16,
        properties: {
            name: data[16].name,
            population: data[16].population,
            Covid19: data[16].cv19,
        },
        geometry: {
            type: "GeometryCollection",
            geometries: [
            {
                type: "MultiPolygon",
                coordinates: [
                [
                    [
                    [-51.1337773, -29.7605061],
                    [-51.1274087, -29.7598849],
                    [-51.126983, -29.7581221],
                    [-51.125589, -29.7582905],
                    [-51.1256994, -29.7591748],
                    [-51.1172219, -29.7586667],
                    [-51.1164417, -29.7603216],
                    [-51.1148811, -29.7628321],
                    [-51.1147843, -29.7629925],
                    [-51.1147252, -29.7631004],
                    [-51.114178, -29.7639215],
                    [-51.113766, -29.7645703],
                    [-51.1137257, -29.7646282],
                    [-51.1139404, -29.764766],
                    [-51.1144575, -29.7649847],
                    [-51.1157059, -29.7653834],
                    [-51.1167538, -29.7657205],
                    [-51.1184509, -29.7665224],
                    [-51.118837, -29.7666921],
                    [-51.1191696, -29.766757],
                    [-51.1194327, -29.7667547],
                    [-51.1196787, -29.7667274],
                    [-51.1222346, -29.7658777],
                    [-51.1226333, -29.765741],
                    [-51.1232985, -29.7656271],
                    [-51.1237677, -29.7655998],
                    [-51.1240775, -29.765602],
                    [-51.1244033, -29.7656362],
                    [-51.1249432, -29.7657501],
                    [-51.1260982, -29.7661742],
                    [-51.1263236, -29.766257],
                    [-51.1263497, -29.7661999],
                    [-51.1266978, -29.7655201],
                    [-51.1268498, -29.7653499],
                    [-51.1273004, -29.7650426],
                    [-51.1275039, -29.7649435],
                    [-51.1282423, -29.7647682],
                    [-51.1283803, -29.7647343],
                    [-51.129042, -29.7645111],
                    [-51.1301195, -29.7641242],
                    [-51.1311295, -29.7637373],
                    [-51.1318988, -29.7633998],
                    [-51.1326831, -29.7628391],
                    [-51.132826, -29.7625158],
                    [-51.1337773, -29.7605061],
                    ],
                ],
                ],
            },
            ],
        },
        },
        {
        type: "Feature",
        id: 17,
        properties: {
            name: data[17].name,
            population: data[17].population,
            Covid19: data[17].cv19,
        },
        geometry: {
            type: "GeometryCollection",
            geometries: [
            {
                type: "MultiPolygon",
                coordinates: [
                [
                    [
                    [-51.1364018, -29.7761737],
                    [-51.1357549, -29.7759908],
                    [-51.1350058, -29.7757788],
                    [-51.134372, -29.7754285],
                    [-51.133896, -29.7751633],
                    [-51.1337816, -29.7750998],
                    [-51.1336559, -29.7750167],
                    [-51.1329618, -29.7745581],
                    [-51.1322546, -29.774091],
                    [-51.131597, -29.7735847],
                    [-51.1315463, -29.7735489],
                    [-51.1304856, -29.7745728],
                    [-51.1263761, -29.7785789],
                    [-51.126326, -29.7785398],
                    [-51.1262073, -29.7783193],
                    [-51.1223645, -29.7756499],
                    [-51.1220686, -29.7755455],
                    [-51.1219698, -29.775492],
                    [-51.1219134, -29.7754624],
                    [-51.1218677, -29.7754406],
                    [-51.1231356, -29.7739566],
                    [-51.1232276, -29.7738329],
                    [-51.1233229, -29.7736302],
                    [-51.123356, -29.7735579],
                    [-51.123618, -29.7736331],
                    [-51.1236825, -29.7735218],
                    [-51.124084, -29.7729898],
                    [-51.1241997, -29.7727397],
                    [-51.1243298, -29.7722377],
                    [-51.1244744, -29.7717392],
                    [-51.1246283, -29.7712549],
                    [-51.1247818, -29.7707676],
                    [-51.124977, -29.7702265],
                    [-51.1247556, -29.7696728],
                    [-51.1249811, -29.7692154],
                    [-51.1251923, -29.7688879],
                    [-51.1252659, -29.7685624],
                    [-51.1252421, -29.768412],
                    [-51.1251828, -29.7683584],
                    [-51.1250997, -29.7682224],
                    [-51.1251235, -29.7679711],
                    [-51.1252042, -29.7678351],
                    [-51.1254083, -29.7677362],
                    [-51.1254818, -29.7676229],
                    [-51.1254486, -29.7675322],
                    [-51.1255103, -29.7673654],
                    [-51.1257097, -29.7672088],
                    [-51.1259328, -29.7672294],
                    [-51.1260491, -29.7671985],
                    [-51.1261345, -29.7670934],
                    [-51.1261013, -29.7670481],
                    [-51.1259945, -29.7670089],
                    [-51.1259518, -29.7669636],
                    [-51.1258284, -29.7669307],
                    [-51.1258118, -29.7668565],
                    [-51.1257572, -29.7668029],
                    [-51.125756, -29.7667269],
                    [-51.1260337, -29.7663038],
                    [-51.1260982, -29.7661744],
                    [-51.1260982, -29.7661742],
                    [-51.1263236, -29.766257],
                    [-51.1287452, -29.7671602],
                    [-51.1289046, -29.7672354],
                    [-51.1290777, -29.7673333],
                    [-51.131841, -29.7700305],
                    [-51.1343559, -29.7702469],
                    [-51.1348684, -29.7701444],
                    [-51.13575, -29.7696751],
                    [-51.1357791, -29.7697331],
                    [-51.1360208, -29.7702645],
                    [-51.136131, -29.7705533],
                    [-51.1362123, -29.7710361],
                    [-51.1361794, -29.771481],
                    [-51.1361293, -29.7725263],
                    [-51.1360722, -29.7731527],
                    [-51.1360387, -29.7735216],
                    [-51.1360002, -29.7741685],
                    [-51.136092, -29.7746817],
                    [-51.1360966, -29.7747034],
                    [-51.1361699, -29.7750472],
                    [-51.1364018, -29.7761737],
                    ],
                ],
                ],
            },
            ],
        },
        },
        {
        type: "Feature",
        id: 18,
        properties: {
            name: data[18].name,
            population: data[18].population,
            Covid19: data[18].cv19,
        },
        geometry: {
            type: "GeometryCollection",
            geometries: [
            {
                type: "MultiPolygon",
                coordinates: [
                [
                    [
                    [-51.1260982, -29.7661744],
                    [-51.1260982, -29.7661742],
                    [-51.1249432, -29.7657501],
                    [-51.1244033, -29.7656362],
                    [-51.1240775, -29.765602],
                    [-51.1237677, -29.7655998],
                    [-51.1232985, -29.7656271],
                    [-51.1226333, -29.765741],
                    [-51.1222346, -29.7658777],
                    [-51.1196787, -29.7667274],
                    [-51.1194327, -29.7667547],
                    [-51.1191696, -29.766757],
                    [-51.118837, -29.7666921],
                    [-51.1184509, -29.7665224],
                    [-51.1167538, -29.7657205],
                    [-51.1157059, -29.7653834],
                    [-51.1144575, -29.7649847],
                    [-51.1139404, -29.764766],
                    [-51.1137257, -29.7646282],
                    [-51.1136827, -29.764682],
                    [-51.1136316, -29.7647362],
                    [-51.1133556, -29.7650263],
                    [-51.1132265, -29.7651694],
                    [-51.1129549, -29.7654475],
                    [-51.1126516, -29.7659846],
                    [-51.1126206, -29.7661172],
                    [-51.1123983, -29.7668052],
                    [-51.1122637, -29.7674202],
                    [-51.1122289, -29.7675004],
                    [-51.11202, -29.7681353],
                    [-51.1118768, -29.7687217],
                    [-51.111503, -29.7693083],
                    [-51.1110929, -29.7707845],
                    [-51.1110793, -29.7711262],
                    [-51.1098918, -29.7754279],
                    [-51.1100507, -29.7755008],
                    [-51.1107421, -29.7758258],
                    [-51.1122496, -29.7765001],
                    [-51.1125753, -29.7766458],
                    [-51.1146074, -29.7774026],
                    [-51.11374, -29.7782869],
                    [-51.1134678, -29.7785852],
                    [-51.1140712, -29.7789934],
                    [-51.1144093, -29.7791171],
                    [-51.1148162, -29.7792408],
                    [-51.11556, -29.7794306],
                    [-51.1157711, -29.7794477],
                    [-51.1171929, -29.7794324],
                    [-51.1183506, -29.7793771],
                    [-51.1197667, -29.7778588],
                    [-51.1202802, -29.7772736],
                    [-51.1218677, -29.7754406],
                    [-51.1231356, -29.7739566],
                    [-51.1232276, -29.7738329],
                    [-51.1233229, -29.7736302],
                    [-51.123356, -29.7735579],
                    [-51.123618, -29.7736331],
                    [-51.1236825, -29.7735218],
                    [-51.124084, -29.7729898],
                    [-51.1241997, -29.7727397],
                    [-51.1243298, -29.7722377],
                    [-51.1244744, -29.7717392],
                    [-51.1246283, -29.7712549],
                    [-51.1247818, -29.7707676],
                    [-51.124977, -29.7702265],
                    [-51.1247556, -29.7696728],
                    [-51.1249811, -29.7692154],
                    [-51.1251923, -29.7688879],
                    [-51.1252659, -29.7685624],
                    [-51.1252421, -29.768412],
                    [-51.1251828, -29.7683584],
                    [-51.1250997, -29.7682224],
                    [-51.1251235, -29.7679711],
                    [-51.1252042, -29.7678351],
                    [-51.1254083, -29.7677362],
                    [-51.1254818, -29.7676229],
                    [-51.1254486, -29.7675322],
                    [-51.1255103, -29.7673654],
                    [-51.1257097, -29.7672088],
                    [-51.1259328, -29.7672294],
                    [-51.1260491, -29.7671985],
                    [-51.1261345, -29.7670934],
                    [-51.1261013, -29.7670481],
                    [-51.1259945, -29.7670089],
                    [-51.1259518, -29.7669636],
                    [-51.1258284, -29.7669307],
                    [-51.1258118, -29.7668565],
                    [-51.1257572, -29.7668029],
                    [-51.125756, -29.7667269],
                    [-51.1260337, -29.7663038],
                    [-51.1260982, -29.7661744],
                    ],
                ],
                ],
            },
            ],
        },
        },
        {
        type: "Feature",
        id: 19,
        properties: {
            name: data[19].name,
            population: data[19].population,
            Covid19: data[19].cv19,
        },
        geometry: {
            type: "GeometryCollection",
            geometries: [
            {
                type: "MultiPolygon",
                coordinates: [
                [
                    [
                    [-51.14192, -29.757364],
                    [-51.1417262, -29.7578615],
                    [-51.1416053, -29.7584272],
                    [-51.1415806, -29.7589264],
                    [-51.1415954, -29.7593467],
                    [-51.1416318, -29.7596177],
                    [-51.1415225, -29.7599982],
                    [-51.1408801, -29.7614903],
                    [-51.1405069, -29.7624329],
                    [-51.1403766, -29.7632273],
                    [-51.1402232, -29.7642425],
                    [-51.139995, -29.7656256],
                    [-51.1399629, -29.766156],
                    [-51.1400187, -29.7667115],
                    [-51.140175, -29.7672464],
                    [-51.1410566, -29.7689324],
                    [-51.141841, -29.7702375],
                    [-51.1407442, -29.77002],
                    [-51.1376863, -29.7693266],
                    [-51.1374881, -29.7692924],
                    [-51.1372148, -29.7693084],
                    [-51.1370439, -29.7693471],
                    [-51.13575, -29.7696751],
                    [-51.1348684, -29.7701444],
                    [-51.1343559, -29.7702469],
                    [-51.131841, -29.7700305],
                    [-51.1290777, -29.7673333],
                    [-51.1289046, -29.7672354],
                    [-51.1287452, -29.7671602],
                    [-51.1263236, -29.766257],
                    [-51.1263497, -29.7661999],
                    [-51.1266978, -29.7655201],
                    [-51.1268498, -29.7653499],
                    [-51.1273004, -29.7650426],
                    [-51.1275039, -29.7649435],
                    [-51.1282423, -29.7647682],
                    [-51.1283803, -29.7647343],
                    [-51.129042, -29.7645111],
                    [-51.1301195, -29.7641242],
                    [-51.1311295, -29.7637373],
                    [-51.1318988, -29.7633998],
                    [-51.1326831, -29.7628391],
                    [-51.132826, -29.7625158],
                    [-51.1337773, -29.7605061],
                    [-51.1376225, -29.7608342],
                    [-51.1414678, -29.7572623],
                    [-51.14192, -29.757364],
                    ],
                ],
                ],
            },
            ],
        },
        },
        {
        type: "Feature",
        id: 20,
        properties: {
            name: data[20].name,
            population: data[20].population,
            Covid19: data[20].cv19,
        },
        geometry: {
            type: "GeometryCollection",
            geometries: [
            {
                type: "MultiPolygon",
                coordinates: [
                [
                    [
                    [-51.1679377, -29.7245972],
                    [-51.1678744, -29.7241401],
                    [-51.1677559, -29.7234841],
                    [-51.1675509, -29.7216526],
                    [-51.1675281, -29.7208462],
                    [-51.1675281, -29.7198712],
                    [-51.167519, -29.7186821],
                    [-51.1673869, -29.7175203],
                    [-51.1672958, -29.7170282],
                    [-51.1672229, -29.7165817],
                    [-51.167232, -29.7161854],
                    [-51.1672821, -29.7155657],
                    [-51.1675965, -29.7146545],
                    [-51.1675555, -29.7131146],
                    [-51.1674689, -29.7117159],
                    [-51.166667, -29.7104448],
                    [-51.1666078, -29.7102626],
                    [-51.1665987, -29.709971],
                    [-51.1666078, -29.7098616],
                    [-51.1665395, -29.7096976],
                    [-51.1664256, -29.7094197],
                    [-51.166503, -29.7091919],
                    [-51.1666033, -29.708955],
                    [-51.1666898, -29.7087044],
                    [-51.1666716, -29.7083946],
                    [-51.1665805, -29.7077932],
                    [-51.1670543, -29.705661],
                    [-51.167109, -29.7046587],
                    [-51.1666534, -29.7033465],
                    [-51.1659427, -29.7019797],
                    [-51.1655053, -29.7010139],
                    [-51.1657422, -29.6996653],
                    [-51.1649768, -29.6975331],
                    [-51.1655053, -29.696385],
                    [-51.1655994, -29.6945103],
                    [-51.1593328, -29.6923193],
                    [-51.1595303, -29.6926549],
                    [-51.1598135, -29.6934079],
                    [-51.1600109, -29.6940939],
                    [-51.1601912, -29.695093],
                    [-51.1602341, -29.6966512],
                    [-51.1602427, -29.6977472],
                    [-51.1602083, -29.6979709],
                    [-51.1593844, -29.6997006],
                    [-51.1592642, -29.7000659],
                    [-51.1592041, -29.7003865],
                    [-51.1589552, -29.7022429],
                    [-51.1585003, -29.7038458],
                    [-51.1584574, -29.7041515],
                    [-51.158466, -29.7043527],
                    [-51.158672, -29.7053965],
                    [-51.1589466, -29.7074317],
                    [-51.1593414, -29.7105627],
                    [-51.1592041, -29.711502],
                    [-51.1589724, -29.7127022],
                    [-51.1584746, -29.7143199],
                    [-51.1582887, -29.7148793],
                    [-51.1478378, -29.715],
                    [-51.1487642, -29.7239055],
                    [-51.149377, -29.7297896],
                    [-51.1496595, -29.7326337],
                    [-51.1497349, -29.7334139],
                    [-51.1505206, -29.7415486],
                    [-51.15086, -29.7445852],
                    [-51.1555367, -29.7428289],
                    [-51.1625302, -29.7402775],
                    [-51.163233, -29.740033],
                    [-51.1640426, -29.7393546],
                    [-51.1640426, -29.7393545],
                    [-51.1631134, -29.7385326],
                    [-51.1626801, -29.738009],
                    [-51.1605597, -29.7357898],
                    [-51.1602636, -29.7353821],
                    [-51.1601836, -29.7351855],
                    [-51.1601087, -29.7350017],
                    [-51.1600176, -29.7345597],
                    [-51.1600586, -29.7342362],
                    [-51.1603114, -29.7335916],
                    [-51.1606805, -29.7331724],
                    [-51.1630405, -29.7305504],
                    [-51.1636419, -29.7298306],
                    [-51.1639095, -29.7295648],
                    [-51.1643161, -29.7291609],
                    [-51.1649175, -29.7285412],
                    [-51.1652091, -29.7283362],
                    [-51.1655417, -29.7281768],
                    [-51.1659745, -29.7280674],
                    [-51.1662661, -29.7279809],
                    [-51.1665577, -29.7277667],
                    [-51.1677195, -29.727015],
                    [-51.1678243, -29.7269603],
                    [-51.1679382, -29.7269466],
                    [-51.1680156, -29.7269239],
                    [-51.1680885, -29.7268829],
                    [-51.1680976, -29.726769],
                    [-51.1681477, -29.7261129],
                    [-51.1679377, -29.7245972],
                    ],
                ],
                ],
            },
            ],
        },
        },
        {
        type: "Feature",
        id: 21,
        properties: {
            name: data[21].name,
            population: data[21].population,
            Covid19: data[21].cv19,
        },
        geometry: {
            type: "GeometryCollection",
            geometries: [
            {
                type: "MultiPolygon",
                coordinates: [
                [
                    [
                    [-51.15086, -29.7445852],
                    [-51.1505206, -29.7415486],
                    [-51.1497349, -29.7334139],
                    [-51.1496595, -29.7326337],
                    [-51.149377, -29.7297896],
                    [-51.1487642, -29.7239055],
                    [-51.1478378, -29.715],
                    [-51.1470001, -29.715],
                    [-51.1470824, -29.7162841],
                    [-51.1470126, -29.7163473],
                    [-51.1468012, -29.7166348],
                    [-51.1466678, -29.7169224],
                    [-51.1465191, -29.717202],
                    [-51.1464624, -29.7173924],
                    [-51.1465007, -29.7175802],
                    [-51.1466172, -29.7178159],
                    [-51.1466786, -29.7180742],
                    [-51.1468043, -29.7183192],
                    [-51.1468487, -29.7184297],
                    [-51.1468595, -29.7185149],
                    [-51.1469055, -29.7186068],
                    [-51.1470864, -29.7187799],
                    [-51.1472475, -29.7188556],
                    [-51.1473271, -29.7188931],
                    [-51.1473639, -29.7189517],
                    [-51.1473424, -29.7190262],
                    [-51.1473815, -29.7191636],
                    [-51.1473408, -29.7192635],
                    [-51.1473456, -29.7193717],
                    [-51.1472949, -29.7195946],
                    [-51.1472402, -29.7198356],
                    [-51.147221, -29.7202475],
                    [-51.1470725, -29.7204577],
                    [-51.1468257, -29.7206345],
                    [-51.1466533, -29.7208758],
                    [-51.1464975, -29.7210131],
                    [-51.1464784, -29.7211567],
                    [-51.1466315, -29.7213923],
                    [-51.1467275, -29.7227766],
                    [-51.1467635, -29.7229257],
                    [-51.1469412, -29.723229],
                    [-51.1469976, -29.7232665],
                    [-51.147096, -29.7234427],
                    [-51.1474581, -29.7238776],
                    [-51.1474689, -29.7240246],
                    [-51.1475523, -29.724538],
                    [-51.1475402, -29.7246529],
                    [-51.1474656, -29.7247415],
                    [-51.1474558, -29.7247969],
                    [-51.147482, -29.7248427],
                    [-51.147506, -29.72516],
                    [-51.1475569, -29.725264],
                    [-51.1475419, -29.7253914],
                    [-51.1475718, -29.725485],
                    [-51.1475569, -29.7255371],
                    [-51.1475718, -29.7257061],
                    [-51.147518, -29.7257658],
                    [-51.1473582, -29.725858],
                    [-51.1473011, -29.7260701],
                    [-51.1469871, -29.7264474],
                    [-51.1468349, -29.7265382],
                    [-51.1468, -29.7266374],
                    [-51.1468634, -29.7266622],
                    [-51.146984, -29.7266594],
                    [-51.1470157, -29.7267475],
                    [-51.1469681, -29.7267943],
                    [-51.1469364, -29.7269816],
                    [-51.1468539, -29.7272295],
                    [-51.1469269, -29.7273313],
                    [-51.146911, -29.727425],
                    [-51.1468191, -29.7275792],
                    [-51.1467842, -29.7277362],
                    [-51.1467144, -29.7279152],
                    [-51.1465913, -29.7281488],
                    [-51.1464137, -29.7283911],
                    [-51.1461124, -29.7285839],
                    [-51.1457668, -29.7287491],
                    [-51.1454084, -29.7289391],
                    [-51.1448708, -29.7292903],
                    [-51.1444585, -29.7294899],
                    [-51.1441652, -29.7296552],
                    [-51.143079, -29.7303161],
                    [-51.1419334, -29.7308909],
                    [-51.1412635, -29.7312902],
                    [-51.1410057, -29.7314373],
                    [-51.1407419, -29.7315927],
                    [-51.1402805, -29.7319029],
                    [-51.1400178, -29.7321311],
                    [-51.1399039, -29.7322299],
                    [-51.1395709, -29.7325741],
                    [-51.1393331, -29.7329011],
                    [-51.1386275, -29.7337582],
                    [-51.1382112, -29.7342367],
                    [-51.1375215, -29.7349457],
                    [-51.1371211, -29.7353932],
                    [-51.1367525, -29.7358854],
                    [-51.135377, -29.7373792],
                    [-51.1347546, -29.7381089],
                    [-51.1345049, -29.7384566],
                    [-51.1340332, -29.7389935],
                    [-51.1335773, -29.7393893],
                    [-51.1333474, -29.7397576],
                    [-51.1327013, -29.7403978],
                    [-51.1322048, -29.7409824],
                    [-51.1315003, -29.74109],
                    [-51.1300138, -29.7415942],
                    [-51.1298743, -29.7418281],
                    [-51.129797, -29.7420244],
                    [-51.1297397, -29.7421736],
                    [-51.12974, -29.742175],
                    [-51.1301627, -29.7423175],
                    [-51.1304637, -29.742494],
                    [-51.1307156, -29.7427248],
                    [-51.1309589, -29.7431705],
                    [-51.1310919, -29.7453214],
                    [-51.1312741, -29.7461216],
                    [-51.1316457, -29.7468902],
                    [-51.1336893, -29.7504578],
                    [-51.1340681, -29.7508942],
                    [-51.1343924, -29.7511599],
                    [-51.1366109, -29.7523016],
                    [-51.1370881, -29.7525989],
                    [-51.1374669, -29.7530132],
                    [-51.1379551, -29.7539177],
                    [-51.1381736, -29.7541422],
                    [-51.1384104, -29.754294],
                    [-51.1408665, -29.7549568],
                    [-51.1421539, -29.7554108],
                    [-51.1424351, -29.7555104],
                    [-51.1424428, -29.755516],
                    [-51.1426164, -29.7550579],
                    [-51.1426745, -29.7549479],
                    [-51.1430461, -29.7543352],
                    [-51.1433995, -29.753916],
                    [-51.1443684, -29.752917],
                    [-51.1447194, -29.7524867],
                    [-51.1449642, -29.7520368],
                    [-51.1451285, -29.7516163],
                    [-51.1452177, -29.7512533],
                    [-51.1452766, -29.750885],
                    [-51.1452847, -29.7505089],
                    [-51.1452265, -29.749795],
                    [-51.1451358, -29.749043],
                    [-51.1450269, -29.7481738],
                    [-51.1452491, -29.7481499],
                    [-51.1454329, -29.7477579],
                    [-51.1456303, -29.7474264],
                    [-51.1458663, -29.7472085],
                    [-51.1461945, -29.7469794],
                    [-51.1465661, -29.7467913],
                    [-51.1473918, -29.7464038],
                    [-51.1476133, -29.7461234],
                    [-51.1496935, -29.7451249],
                    [-51.1500073, -29.7449151],
                    [-51.15086, -29.7445852],
                    ],
                ],
                ],
            },
            ],
        },
        },
        {
        type: "Feature",
        id: 22,
        properties: {
            name: data[22].name,
            population: data[22].population,
            Covid19: data[22].cv19,
        },
        geometry: {
            type: "GeometryCollection",
            geometries: [
            {
                type: "MultiPolygon",
                coordinates: [
                [
                    [
                    [-51.1676113, -29.7906441],
                    [-51.1675718, -29.7906197],
                    [-51.1665842, -29.7899643],
                    [-51.1656115, -29.7893192],
                    [-51.1652334, -29.7890571],
                    [-51.164619, -29.78865],
                    [-51.1642208, -29.788371],
                    [-51.16342, -29.787856],
                    [-51.1638149, -29.7902159],
                    [-51.1619129, -29.7917216],
                    [-51.160783, -29.7925508],
                    [-51.1604663, -29.7927285],
                    [-51.1598786, -29.7929472],
                    [-51.1596349, -29.792995],
                    [-51.1596635, -29.7931625],
                    [-51.16012, -29.7955137],
                    [-51.1604036, -29.7971182],
                    [-51.1608199, -29.7993129],
                    [-51.1609985, -29.8001639],
                    [-51.1650644, -29.7978976],
                    [-51.1647399, -29.795642],
                    [-51.1682923, -29.7947533],
                    [-51.1676113, -29.7906441],
                    ],
                ],
                ],
            },
            ],
        },
        },
        {
        type: "Feature",
        id: 23,
        properties: {
            name: data[23].name,
            population: data[23].population,
            Covid19: data[23].cv19,
        },
        geometry: {
            type: "GeometryCollection",
            geometries: [
            {
                type: "MultiPolygon",
                coordinates: [
                [
                    [
                    [-51.1477721, -29.7787014],
                    [-51.1477097, -29.7787537],
                    [-51.1474942, -29.7787883],
                    [-51.1467722, -29.7789044],
                    [-51.1458357, -29.779055],
                    [-51.1442234, -29.7793143],
                    [-51.1434034, -29.7794462],
                    [-51.143199, -29.779479],
                    [-51.1431813, -29.7794815],
                    [-51.142969, -29.7806482],
                    [-51.1427976, -29.7813059],
                    [-51.141667, -29.7839666],
                    [-51.1415783, -29.7841928],
                    [-51.1410025, -29.7857061],
                    [-51.1404596, -29.7868986],
                    [-51.1403666, -29.7870518],
                    [-51.1441684, -29.7887283],
                    [-51.1443882, -29.7884709],
                    [-51.1454657, -29.7865597],
                    [-51.1460511, -29.7853933],
                    [-51.1462584, -29.7845596],
                    [-51.1468507, -29.7823226],
                    [-51.1477721, -29.7787014],
                    ],
                ],
                ],
            },
            ],
        },
        },
        {
        type: "Feature",
        id: 24,
        properties: {
            name: data[24].name,
            population: data[24].population,
            Covid19: data[24].cv19,
        },
        geometry: {
            type: "GeometryCollection",
            geometries: [
            {
                type: "MultiPolygon",
                coordinates: [
                [
                    [
                    [-51.1695013, -29.7649142],
                    [-51.1561495, -29.7726547],
                    [-51.1560009, -29.7727192],
                    [-51.1543897, -29.7724906],
                    [-51.1541084, -29.7724497],
                    [-51.1537963, -29.7713904],
                    [-51.1533385, -29.7697981],
                    [-51.1532473, -29.769445],
                    [-51.1532246, -29.7691603],
                    [-51.1532359, -29.7688801],
                    [-51.1533043, -29.7685224],
                    [-51.1536095, -29.7672331],
                    [-51.1539057, -29.7659483],
                    [-51.1539512, -29.7656727],
                    [-51.1539717, -29.7654198],
                    [-51.1539672, -29.7651305],
                    [-51.1539193, -29.7647296],
                    [-51.1538601, -29.7645245],
                    [-51.1537508, -29.7642671],
                    [-51.1535594, -29.7638981],
                    [-51.1524068, -29.7618957],
                    [-51.1521824, -29.7614401],
                    [-51.1521106, -29.7611372],
                    [-51.1520537, -29.7606838],
                    [-51.1519876, -29.7591369],
                    [-51.1522856, -29.7590705],
                    [-51.1539765, -29.7582508],
                    [-51.1575642, -29.7569245],
                    [-51.1614266, -29.7563806],
                    [-51.1629973, -29.7564029],
                    [-51.1643448, -29.7569096],
                    [-51.1657012, -29.757344],
                    [-51.1657194, -29.7578546],
                    [-51.1658652, -29.7610984],
                    [-51.165888, -29.7613353],
                    [-51.1659335, -29.7615358],
                    [-51.1660246, -29.7617226],
                    [-51.1661978, -29.7619504],
                    [-51.1664438, -29.7621053],
                    [-51.1675782, -29.7627021],
                    [-51.1678379, -29.7628616],
                    [-51.1680521, -29.7630302],
                    [-51.1683209, -29.76334],
                    [-51.1693514, -29.7647235],
                    [-51.1694296, -29.7648229],
                    [-51.1695013, -29.7649142],
                    ],
                ],
                ],
            },
            ],
        },
        },
    ],
    };



    var botoesMapa = function(activeEl) {
        var els = $('.mapa01')
        Array.prototype.forEach.call(els, function(el) {
            el.classList.remove('active')
        })
        activeEl.target.classList.add('active')
    }

    // Filtro meses mapa

    $('#umMesMapa').click(function(e){
        botoesMapa(e);
        $('script[src="{{asset('js/map.js')}}"]').remove();
        $('#map').remove();

        districtData.features[0].properties.Covid19 = '{{$casosBairrosUltimoMesRevisado[23]}}'; /*Vicentina*/
        districtData.features[1].properties.Covid19 = '{{$casosBairrosUltimoMesRevisado[5]}}';/*Centro*/
        districtData.features[2].properties.Covid19 = '{{$casosBairrosUltimoMesRevisado[3]}}';/*Arroio da Manteiga*/
        districtData.features[3].properties.Covid19 = '{{$casosBairrosUltimoMesRevisado[15]}}';/*Boa Vista*/
        districtData.features[4].properties.Covid19 = '{{$casosBairrosUltimoMesRevisado[11]}}';/*Campestre*/
        districtData.features[5].properties.Covid19 = '{{$casosBairrosUltimoMesRevisado[1]}}';/*Campina*/
        districtData.features[6].properties.Covid19 = '{{$casosBairrosUltimoMesRevisado[7]}}';/*Cristo Rei*/
        districtData.features[7].properties.Covid19 = '{{$casosBairrosUltimoMesRevisado[16]}}';/*Duque de Caxias*/
        districtData.features[8].properties.Covid19 = '{{$casosBairrosUltimoMesRevisado[4]}}';/*Feitoria*/
        districtData.features[9].properties.Covid19 = '{{$casosBairrosUltimoMesRevisado[17]}}';/*Fiao*/
        districtData.features[10].properties.Covid19 = '{{$casosBairrosUltimoMesRevisado[0]}}';/*Jardim América*/
        districtData.features[11].properties.Covid19 = '{{$casosBairrosUltimoMesRevisado[12]}}';/*Morro do Espelho*/
        districtData.features[12].properties.Covid19 = '{{$casosBairrosUltimoMesRevisado[13]}}';/*Rio dos Sinos*/
        districtData.features[13].properties.Covid19 = '{{$casosBairrosUltimoMesRevisado[9]}}';/*Santa Tereza*/
        districtData.features[14].properties.Covid19 = '{{$casosBairrosUltimoMesRevisado[10]}}';/*Fazenda São Borja*/
        districtData.features[15].properties.Covid19 = '{{$casosBairrosUltimoMesRevisado[20]}}';/*Pinheiro*/
        districtData.features[16].properties.Covid19 = '{{$casosBairrosUltimoMesRevisado[14]}}';/*Rio Branco*/
        districtData.features[17].properties.Covid19 = '{{$casosBairrosUltimoMesRevisado[20]}}';/*Santo André*/
        districtData.features[18].properties.Covid19 = '{{$casosBairrosUltimoMesRevisado[22]}}';/*São José*/
        districtData.features[19].properties.Covid19 = '{{$casosBairrosUltimoMesRevisado[6]}}';/*Scharlau*/
        districtData.features[20].properties.Covid19 = '{{$casosBairrosUltimoMesRevisado[2]}}';/*Santos Dumont*/
        districtData.features[21].properties.Covid19 = '{{$casosBairrosUltimoMesRevisado[21]}}';/*São João Batista*/
        districtData.features[22].properties.Covid19 = '{{$casosBairrosUltimoMesRevisado[18]}}';/*Padre Reus*/
        districtData.features[23].properties.Covid19 = '{{$casosBairrosUltimoMesRevisado[8]}}';/*São Miguel*/

        $('#mapaContainer').append('<div id="map"></div>');
        $('<script>').attr('src', '{{asset('js/map.js')}}').appendTo('body');
    })

    $('#tresMesesMapa').click(function(e){
        botoesMapa(e);
        $('script[src="{{asset('js/map.js')}}"]').remove();
        $('#map').remove();

        districtData.features[0].properties.Covid19 = '{{$casosBairrosTresMesesRevisado[23]}}'; /*Vicentina*/
        districtData.features[1].properties.Covid19 = '{{$casosBairrosTresMesesRevisado[5]}}';/*Centro*/
        districtData.features[2].properties.Covid19 = '{{$casosBairrosTresMesesRevisado[3]}}';/*Arroio da Manteiga*/
        districtData.features[3].properties.Covid19 = '{{$casosBairrosTresMesesRevisado[15]}}';/*Boa Vista*/
        districtData.features[4].properties.Covid19 = '{{$casosBairrosTresMesesRevisado[11]}}';/*Campestre*/
        districtData.features[5].properties.Covid19 = '{{$casosBairrosTresMesesRevisado[1]}}';/*Campina*/
        districtData.features[6].properties.Covid19 = '{{$casosBairrosTresMesesRevisado[7]}}';/*Cristo Rei*/
        districtData.features[7].properties.Covid19 = '{{$casosBairrosTresMesesRevisado[16]}}';/*Duque de Caxias*/
        districtData.features[8].properties.Covid19 = '{{$casosBairrosTresMesesRevisado[4]}}';/*Feitoria*/
        districtData.features[9].properties.Covid19 = '{{$casosBairrosTresMesesRevisado[17]}}';/*Fiao*/
        districtData.features[10].properties.Covid19 = '{{$casosBairrosTresMesesRevisado[0]}}';/*Jardim América*/
        districtData.features[11].properties.Covid19 = '{{$casosBairrosTresMesesRevisado[12]}}';/*Morro do Espelho*/
        districtData.features[12].properties.Covid19 = '{{$casosBairrosTresMesesRevisado[13]}}';/*Rio dos Sinos*/
        districtData.features[13].properties.Covid19 = '{{$casosBairrosTresMesesRevisado[9]}}';/*Santa Tereza*/
        districtData.features[14].properties.Covid19 = '{{$casosBairrosTresMesesRevisado[10]}}';/*Fazenda São Borja*/
        districtData.features[15].properties.Covid19 = '{{$casosBairrosTresMesesRevisado[20]}}';/*Pinheiro*/
        districtData.features[16].properties.Covid19 = '{{$casosBairrosTresMesesRevisado[14]}}';/*Rio Branco*/
        districtData.features[17].properties.Covid19 = '{{$casosBairrosTresMesesRevisado[20]}}';/*Santo André*/
        districtData.features[18].properties.Covid19 = '{{$casosBairrosTresMesesRevisado[22]}}';/*São José*/
        districtData.features[19].properties.Covid19 = '{{$casosBairrosTresMesesRevisado[6]}}';/*Scharlau*/
        districtData.features[20].properties.Covid19 = '{{$casosBairrosTresMesesRevisado[2]}}';/*Santos Dumont*/
        districtData.features[21].properties.Covid19 = '{{$casosBairrosTresMesesRevisado[21]}}';/*São João Batista*/
        districtData.features[22].properties.Covid19 = '{{$casosBairrosTresMesesRevisado[18]}}';/*Padre Reus*/
        districtData.features[23].properties.Covid19 = '{{$casosBairrosTresMesesRevisado[8]}}';/*São Miguel*/

        $('#mapaContainer').append('<div id="map"></div>');
        $('<script>').attr('src', '{{asset('js/map.js')}}').appendTo('body');
    })

    $('#seisMesesMapa').click(function(e){
        botoesMapa(e);
        $('script[src="{{asset('js/map.js')}}"]').remove();
        $('#map').remove();

        districtData.features[0].properties.Covid19 = '{{$casosBairrosSeisMesesRevisado[23]}}'; /*Vicentina*/
        districtData.features[1].properties.Covid19 = '{{$casosBairrosSeisMesesRevisado[5]}}';/*Centro*/
        districtData.features[2].properties.Covid19 = '{{$casosBairrosSeisMesesRevisado[3]}}';/*Arroio da Manteiga*/
        districtData.features[3].properties.Covid19 = '{{$casosBairrosSeisMesesRevisado[15]}}';/*Boa Vista*/
        districtData.features[4].properties.Covid19 = '{{$casosBairrosSeisMesesRevisado[11]}}';/*Campestre*/
        districtData.features[5].properties.Covid19 = '{{$casosBairrosSeisMesesRevisado[1]}}';/*Campina*/
        districtData.features[6].properties.Covid19 = '{{$casosBairrosSeisMesesRevisado[7]}}';/*Cristo Rei*/
        districtData.features[7].properties.Covid19 = '{{$casosBairrosSeisMesesRevisado[16]}}';/*Duque de Caxias*/
        districtData.features[8].properties.Covid19 = '{{$casosBairrosSeisMesesRevisado[4]}}';/*Feitoria*/
        districtData.features[9].properties.Covid19 = '{{$casosBairrosSeisMesesRevisado[17]}}';/*Fiao*/
        districtData.features[10].properties.Covid19 = '{{$casosBairrosSeisMesesRevisado[0]}}';/*Jardim América*/
        districtData.features[11].properties.Covid19 = '{{$casosBairrosSeisMesesRevisado[12]}}';/*Morro do Espelho*/
        districtData.features[12].properties.Covid19 = '{{$casosBairrosSeisMesesRevisado[13]}}';/*Rio dos Sinos*/
        districtData.features[13].properties.Covid19 = '{{$casosBairrosSeisMesesRevisado[9]}}';/*Santa Tereza*/
        districtData.features[14].properties.Covid19 = '{{$casosBairrosSeisMesesRevisado[10]}}';/*Fazenda São Borja*/
        districtData.features[15].properties.Covid19 = '{{$casosBairrosSeisMesesRevisado[20]}}';/*Pinheiro*/
        districtData.features[16].properties.Covid19 = '{{$casosBairrosSeisMesesRevisado[14]}}';/*Rio Branco*/
        districtData.features[17].properties.Covid19 = '{{$casosBairrosSeisMesesRevisado[20]}}';/*Santo André*/
        districtData.features[18].properties.Covid19 = '{{$casosBairrosSeisMesesRevisado[22]}}';/*São José*/
        districtData.features[19].properties.Covid19 = '{{$casosBairrosSeisMesesRevisado[6]}}';/*Scharlau*/
        districtData.features[20].properties.Covid19 = '{{$casosBairrosSeisMesesRevisado[2]}}';/*Santos Dumont*/
        districtData.features[21].properties.Covid19 = '{{$casosBairrosSeisMesesRevisado[21]}}';/*São João Batista*/
        districtData.features[22].properties.Covid19 = '{{$casosBairrosSeisMesesRevisado[18]}}';/*Padre Reus*/
        districtData.features[23].properties.Covid19 = '{{$casosBairrosSeisMesesRevisado[8]}}';/*São Miguel*/

        $('#mapaContainer').append('<div id="map"></div>');
        $('<script>').attr('src', '{{asset('js/map.js')}}').appendTo('body');
    })

    $('#tudoMapa').click(function(e){
        botoesMapa(e);
        $('script[src="{{asset('js/map.js')}}"]').remove();
        $('#map').remove();

        districtData.features[0].properties.Covid19 = '{{$casosBairrosTotalRevisado[23]}}'; /*Vicentina*/
        districtData.features[1].properties.Covid19 = '{{$casosBairrosTotalRevisado[5]}}';/*Centro*/
        districtData.features[2].properties.Covid19 = '{{$casosBairrosTotalRevisado[3]}}';/*Arroio da Manteiga*/
        districtData.features[3].properties.Covid19 = '{{$casosBairrosTotalRevisado[15]}}';/*Boa Vista*/
        districtData.features[4].properties.Covid19 = '{{$casosBairrosTotalRevisado[11]}}';/*Campestre*/
        districtData.features[5].properties.Covid19 = '{{$casosBairrosTotalRevisado[1]}}';/*Campina*/
        districtData.features[6].properties.Covid19 = '{{$casosBairrosTotalRevisado[7]}}';/*Cristo Rei*/
        districtData.features[7].properties.Covid19 = '{{$casosBairrosTotalRevisado[16]}}';/*Duque de Caxias*/
        districtData.features[8].properties.Covid19 = '{{$casosBairrosTotalRevisado[4]}}';/*Feitoria*/
        districtData.features[9].properties.Covid19 = '{{$casosBairrosTotalRevisado[17]}}';/*Fiao*/
        districtData.features[10].properties.Covid19 = '{{$casosBairrosTotalRevisado[0]}}';/*Jardim América*/
        districtData.features[11].properties.Covid19 = '{{$casosBairrosTotalRevisado[12]}}';/*Morro do Espelho*/
        districtData.features[12].properties.Covid19 = '{{$casosBairrosTotalRevisado[13]}}';/*Rio dos Sinos*/
        districtData.features[13].properties.Covid19 = '{{$casosBairrosTotalRevisado[9]}}';/*Santa Tereza*/
        districtData.features[14].properties.Covid19 = '{{$casosBairrosTotalRevisado[10]}}';/*Fazenda São Borja*/
        districtData.features[15].properties.Covid19 = '{{$casosBairrosTotalRevisado[20]}}';/*Pinheiro*/
        districtData.features[16].properties.Covid19 = '{{$casosBairrosTotalRevisado[14]}}';/*Rio Branco*/
        districtData.features[17].properties.Covid19 = '{{$casosBairrosTotalRevisado[20]}}';/*Santo André*/
        districtData.features[18].properties.Covid19 = '{{$casosBairrosTotalRevisado[22]}}';/*São José*/
        districtData.features[19].properties.Covid19 = '{{$casosBairrosTotalRevisado[6]}}';/*Scharlau*/
        districtData.features[20].properties.Covid19 = '{{$casosBairrosTotalRevisado[2]}}';/*Santos Dumont*/
        districtData.features[21].properties.Covid19 = '{{$casosBairrosTotalRevisado[21]}}';/*São João Batista*/
        districtData.features[22].properties.Covid19 = '{{$casosBairrosTotalRevisado[18]}}';/*Padre Reus*/
        districtData.features[23].properties.Covid19 = '{{$casosBairrosTotalRevisado[8]}}';/*São Miguel*/

        $('#mapaContainer').append('<div id="map"></div>');
        $('<script>').attr('src', '{{asset('js/map.js')}}').appendTo('body');
    })


</script>



