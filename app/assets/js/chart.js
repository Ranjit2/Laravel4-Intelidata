$.loadJSON = function (url, method) {
    try {
        return JSON.parse($.ajax({type: method, url: url, async: false, cache: false, dataType: 'json' }).responseText);
    } catch(err) {
        console.log('Error: ' + err);
    }
};

$.loadChart = function (div, url, type, mes, method) {
    var div    = typeof div !== 'undefined' ? div : '#chartdiv';
    var type   = typeof type !== 'undefined' && type.length != 0 ? '/'+type : '';
    var mes    = typeof mes !== 'undefined' && mes.length != 0 ? '/'+mes : '';
    var method = typeof method !== 'undefined' ? method : 'POST';
    var url    = typeof url !== 'undefined' ? url+type+mes : '';
    try {
        var data  = $.loadJSON(url, method);
        AmCharts.ready(function(){
            var chart = AmCharts.makeChart(div, data);
        });
    } catch(err) {
        console.log('Error: ' + err);
    }
};

$.graficoBroken = function (div, url, method) {
    var chart;
    var legend;
    var selected;
    var types = $.loadJSON(url, method);

    // INIT
    chart = new AmCharts.AmPieChart();

    // LEGEND
    var legend = new AmCharts.AmLegend();
    legend.valueText = "";
    chart.addLegend(legend, "legenddiv");

    // EXPORT
    var exportConfig = {
        menuTop: "30px",
        menuBottom: "auto",
        menuRight: "70px",
        backgroundColor: "#efefef",
        menuItems: [{
            textAlign: 'center',
            icon: 'http://www.amcharts.com/lib/3/images/export.png',
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

    // OPTIONS
    chart.dataProvider     = $.generateChartData(types, selected);
    chart.titleField       = "type";
    chart.valueField       = "percent";
    chart.outlineColor     = ""; // "#FFFFFF";
    chart.outlineAlpha     = 0.8;
    chart.outlineThickness = 2;
    chart.colorField       = "color";
    chart.pulledField      = "pulled";
    chart.balloonText      = "<b>$[[percent]] ([[percents]]%)</b>";
    chart.labelText        = "[[type]]";
    chart.radius           = "30%";
    chart.exportConfig     = exportConfig;
    chart.depth3D          = 10;
    chart.groupedPulled    = true;

    // LISTENERS
    chart.addListener("clickSlice", function (event) {
        if (event.dataItem.dataContext.id != undefined) {
            selected = event.dataItem.dataContext.id;
        }
        else {
            selected = undefined;
            $('#legenddiv').show();
        }
        chart.dataProvider = $.generateChartData(types, selected);
        chart.validateData();
    });

    // WRITE
    chart.write(div);
}

$.generateChartData = function (types, selected) {
    $('#lista').hide();
    $('#lista tbody').empty();
    $('#lista tfoot').empty();
    var chartData = [];
    var total = 0;
    var porcent = 0;
    for (var i = 0; i < types.length; i++) {
        if (types[i].subs.length > 0 && i == selected) {
            $('#legenddiv').hide();
            $('#lista').show();
            for (var x = 0; x < types[i].subs.length; x++) {
                chartData.push({
                    type: types[i].subs[x].type,
                    percent: types[i].subs[x].percent,
                    pulled: true
                });
                total += parseInt(types[i].subs[x].percent);
            }
            for (var x = 0; x < types[i].subs.length; x++) {
                porcent = $.porcentaje(total, types[i].subs[x].percent, 1, ',', '.');
                if (types[i].subs[x].percent < 0) {
                    $('#lista tbody').append('<tr class="danger">'+
                        '<td class="col-md-5">'+types[i].subs[x].type+'</td>'+
                        '<td class="col-md-4">'+$.progressbar(porcent)+'</td>'+
                        '<td class="col-md-2 text-right">- $'+types[i].subs[x].percent*-1+'</td>'+
                        '</tr>');
                } else {
                    $('#lista tbody').append('<tr>'+
                        '<td class="col-md-5">'+types[i].subs[x].type+'</td>'+
                        '<td class="col-md-4">'+$.progressbar(porcent)+'</td>'+
                        '<td class="col-md-2 text-right">$'+types[i].subs[x].percent+'</td>'+
                        '</tr>');
                }
            };
            $('#lista').append('<tfoot><tr class="info" style="font-weight: bold;">'+'<td class="col-md-5">TOTAL</td><td class="col-md-4"></td><td class="col-md-2 text-right">$'+total+'</td>'+'</tr></tfoot>');
        } else {
            chartData.push({
                type: types[i].type,
                percent: types[i].percent,
                id: i
            });
        }
    }
    return chartData;
}