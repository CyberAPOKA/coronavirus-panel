var map = L.map("map").setView([-29.7424, -51.1441], 12);
  
L.tileLayer(
    "https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw",
    {
        maxZoom: 18,
        attribution:
            'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
            '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
            'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        id: "mapbox/light-v9",
        tileSize: 512,
        zoomOffset: -1,
    }
).addTo(map);
  
var info = L.control();
info.onAdd = function (map) {
    this._div = L.DomUtil.create("div", "info infoBairros");
    this.update();
    return this._div;
};
  
info.update = function (props) {
    var largura = window.innerWidth;
    this._div.innerHTML =
      `<h4>Números de Casos Covid-19 </h4><br>`+
      (props
        ? "<b>" +
          ` <h5>${props.name} </h5>`+
          "</b>" +
          `<h5> Casos : ${props.Covid19}  </h5> `
        : largura <= 478 ? "Clique em algum bairro" : "Passe o mouse");
  };

info.addTo(map);
  
  
//cores gráfico
function getColor(porcent) {
    return porcent > 600
    ? "#59011b"
    : porcent > 500
    ? "#800026"
    : porcent > 400
    ? "#BD0026"
    : porcent > 300
    ? "#E31A1C"
    : porcent > 200
    ? "#FC4E2A"
    : porcent > 100
    ? "#FD8D3C"
    : porcent > 50
    ? "#FEB24C"
    : porcent > 0
    ? "#FED976"
    : "#FFEDA0"
    ;
}
  
function style(feature) {
    const getPorcent =
        feature.properties.Covid19;
    return {
        weight: 2,
        opacity: 1,
        color: "white",
        dashArray: "3",
        fillOpacity: 0.7,
        fillColor: getColor(getPorcent),
    };
}
  
function highlightFeature(e) {
    var layer = e.target;
  
    layer.setStyle({
        weight: 5,
        color: "#666",
        dashArray: "",
        fillOpacity: 0.7,
    });
  
    if (!L.Browser.ie && !L.Browser.opera && !L.Browser.edge) {
        layer.bringToFront();
    }
        info.update(layer.feature.properties);
}
  
var geojson;
  
function resetHighlight(e) {
    geojson.resetStyle(e.target);
    info.update();
}
  
function zoomToFeature(e) {
    map.fitBounds(e.target.getBounds());
}
  
function onEachFeature(feature, layer) {
    layer.on({
        mouseover: highlightFeature,
        mouseout: resetHighlight,
        click: zoomToFeature,
    });
}
  
geojson = L.geoJson(districtData, {
    style: style,
    onEachFeature: onEachFeature,
}).addTo(map);
  
map.attributionControl.addAttribution(
    'Corona Virus em Sao Leopoldo &copy; <a href="https://www.saoleopoldo.rs.gov.br/coronavirus/">Prefeitura de Sao Leopoldo</a>'
);
  
var legend = L.control({ position: "bottomright" });
legend.onAdd = function (map) {
    var div = L.DomUtil.create("div", "info legend"),
    grades = [00, 50, 100, 200, 300, 400, 500, 600],
    labels = [],
    from,
    to;
        
    for (var i = 0; i < grades.length; i++) {
        from = grades[i];
        to = grades[i + 1];
  
        labels.push(
          '<i style="background:' +
            getColor(from) +
            '"></i> ' +
            (to ? (from +1) : (from)) +
            (to ? " &ndash; " + to + " " : " +")
        );
    }
  
    div.innerHTML = labels.join("<br>");
    return div;
};
  
legend.addTo(map);