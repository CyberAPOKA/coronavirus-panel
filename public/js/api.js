$(document).ready(function () {
    $.ajax({
        url: 'https://api.apify.com/v2/key-value-stores/TyToNta7jGKkpszMZ/records/LATEST?disableRedirect=true',
        contentType: "application/json",
        dataType: 'json',
        success: function (result) {
            $("#confirmadosBrasil").append((result.infected).toLocaleString('pt-BR'));
            $("#mortesBrasil").append((result.deceased).toLocaleString('pt-BR'));
            $("#confirmadosRS").append(result.infectedByRegion.find(a => a.state == "RS").count.toLocaleString('pt-BR'));
            $("#mortesRS").append((result.deceasedByRegion.find(a => a.state == "RS")).count.toLocaleString('pt-BR'));
            $("#proporcaoMortesRS").append((result.infectedByRegion.find(a => a.state == "RS").count / result.deceasedByRegion.find(a => a.state == "RS").count).toFixed(2).replace(".", ","));
            $("#proporcaoMortesBR").append((result.infected / result.deceased).toFixed(2).replace(".", ","));
        },
        error: function (result) {
            $("#confirmadosBrasil").append('Erro');
            $("#mortesBrasil").append('Erro');
            $("#confirmadosRS").append('Erro');
            $("#mortesRS").append('Erro');
        }
    })
});
