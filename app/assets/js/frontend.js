$(document).ready(function() {
    // $.loadChart('chartdiv4', '/getChartPie/'+id, 'donut', '', 'POST');
    $.loadChart('chartdiv8', '/getBreakChart/'+id, '', '', 'POST');
});

/**
* [loadJSON description]
* @param  {string} url    [description]
* @param  {string} method [description]
* @return {json}          Return json data from database
*/
AmCharts.loadJSON = function (url, method) {
    try {
        return JSON.parse($.ajax({type: method, url: url, async: false, cache: false, dataType: 'json' }).responseText);
    } catch(err) {
        console.log(err);
    }
};

/**
* [loadChart description]
* @param  {string}  div    [description]
* @param  {string}  url    [description]
* @param  {string}  type   [description]
* @param  {integer} mes    [description]
* @param  {[]}  method     [description]
* @return {chart}          Return chart
*/
$.loadChart = function (div, url, type, mes, method) {
    var div    = typeof div !== 'undefined' ? div : '#chartdiv';
    var type   = typeof type !== 'undefined' && type.length != 0 ? '/'+type : '';
    var mes    = typeof mes !== 'undefined' && mes.length != 0 ? '/'+mes : '';
    var method = typeof method !== 'undefined' ? method : 'POST';
    var url    = typeof url !== 'undefined' ? url+type+mes : '';
    try {
        var data  = AmCharts.loadJSON(url, method);
        AmCharts.ready(function(){
            var chart = AmCharts.makeChart(div, data);
        });
    } catch(err) {
        console.log(err);
    }
};

$.graficoBroken = function () {

    var chart;
    var legend;
    var selected;

    var types = [{
        type: "84465285",
        percent: 50000,
        color: "#ff9e01",
        subs: [
        { type: "servicio1", percent: 25000 },
        { type: "servicio2", percent: 10000 },
        { type: "servicio3", percent: 15000 },
        { type: "servicio4", percent: 5000 },
        { type: "servicio5", percent: 1000 },
        { type: "servicio4", percent: 2000 },
        { type: "servicio5", percent: 6000 },
        { type: "servicio4", percent: 9000 },
        { type: "servicio5", percent: 5000 }
        ]}
        ,
        {
            type: "86624454",
            percent: 100000,
            color: "#b0de09",
            subs: [
            { type: "servicio1", percent: 60000 },
            { type: "servicio2", percent: 15000 },
            { type: "servicio3", percent: 25000 }
            ]}
            ];

            AmCharts.ready(function () {
// PIE CHART
chart            = new AmCharts.AmPieChart();
var exportConfig = {
    menuTop: "30px",
    menuBottom: "auto",
    menuRight: "70px",
    backgroundColor: "#efefef",
    menuItems: [{
        textAlign: 'center',
        icon: 'http://www.amcharts.com/lib/3/images/export.png',
        title: 'Bajar',
        items: [{
            title: 'JPG',
            format: 'jpg'
        }, {
            title: 'PNG',
            format: 'png'
        }, {
            title: 'SVG',
            format: 'svg'
        }, {
            title: 'PDF',
            format: 'pdf'
        }]
    }]
};


chart.dataProvider     = $.generateChartData(types, selected);
chart.titleField       = "type";
chart.valueField       = "percent";
chart.outlineColor     = "#FFFFFF";
chart.outlineAlpha     = 0.8;
chart.outlineThickness = 2;
chart.colorField       = "color";
chart.pulledField      = "pulled";
chart.balloonText      = "<b>$[[percent]] ([[percents]]%)</b>";
chart.labelText        = "[[type]]";
chart.radius           = "30%";
chart.exportConfig     =  exportConfig;

// ADD TITLE
chart.addTitle("ENERO");

// AN EVENT TO HANDLE SLICE CLICKS
chart.addListener("clickSlice", function (event) {
    if (event.dataItem.dataContext.id != undefined) {
        selected = event.dataItem.dataContext.id;
    }
    else {
        selected = undefined;
    }
    chart.dataProvider = $.generateChartData(types, selected);
    chart.validateData();
});

// WRITE
chart.write("chartdiv7");
});
}

$.generateChartData = function (types, selected) {
    var chartData = [];
    for (var i = 0; i < types.length; i++) {
        if (i == selected) {
            for (var x = 0; x < types[i].subs.length; x++) {
                chartData.push({
                    type: types[i].subs[x].type,
                    percent: types[i].subs[x].percent,
                    color: types[i].color,
                    pulled: true
                });
            }
        }
        else {
            chartData.push({
                type: types[i].type,
                percent: types[i].percent,
                color: types[i].color,
                id: i
            });
        }
    }
    return chartData;
}

$.graficoBroken();
