
AmCharts.loadJSON = function (url, method) {
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
        var data  = AmCharts.loadJSON(url, method);
        AmCharts.ready(function(){
            var chart = AmCharts.makeChart(div, data);
        });
    } catch(err) {
        console.log('Error: ' + err);
    }
};

$.graficoBroken = function (div, url, method) {
    var chart; var legend; var selected;

    var types = AmCharts.loadJSON(url, method);

    AmCharts.ready(function () {
        chart      = new AmCharts.AmPieChart();
        var legend = new AmCharts.AmLegend();
        legend.valueText = "";
        chart.addLegend(legend, "legenddiv");

        chart.dataProvider     = $.generateChartData(types, selected);
        chart.titleField       = "<numero></numero>";
        chart.valueField       = "percent";
        chart.outlineColor     = "#FFFFFF";
        chart.outlineAlpha     = 0.8;
        chart.outlineThickness = 2;
        chart.colorField       = "color";
        chart.pulledField      = "pulled";
        chart.balloonText      = "<b>$[[percent]] ([[percents]]%)</b>";
        chart.labelText        = "[[numero]]";
        chart.radius           = "30%";
        chart.exportConfig     =  exportConfig;

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

        chart.addTitle("ENERO");

        chart.addListener("clickSlice", function (event) {
            if (event.dataItem.dataContext.id != undefined) {
                selected = event.dataItem.dataContext.id;
                $('#legenddiv').empty().show();
            }
            else {
                selected = undefined;
                $('#legenddiv').show();
            }
            chart.dataProvider = $.generateChartData(types, selected);
            chart.validateData();
        });
        chart.write(div);
    });
}


$.generateChartData = function (types, selected) {
    $('.lista').hide();
    $('.lista tbody').empty();
    $('.lista tfoot').empty();
    var chartData = [];
    var total = 0;
    for (var i = 0; i < types.length; i++) {
        if (types[i].subs.length > 0 && i == selected) {
            $('#legenddiv').hide();
            $('.lista').show();

            for (var x = 0; x < types[i].subs.length; x++) {
                console.log(types[i].subs.length);
                chartData.push({
                    type: types[i].subs[x].type,
                    percent: types[i].subs[x].percent,
                    pulled: true
                });

                if (types[i].subs[x].percent < 0) {
                    $('.lista tbody').append('<tr class="danger">'+'<td>'+types[i].subs[x].type+'</td>'+'<td>$'+types[i].subs[x].percent+'</td>'+'</tr>');
                } else {
                    $('.lista tbody').append('<tr>'+'<td>'+types[i].subs[x].type+'</td>'+'<td>$'+types[i].subs[x].percent+'</td>'+'</tr>');
                }
                console.log(types[i].subs[x].percent);
                total += types[i].subs[x].percent;
            }
            $('.lista').append('<tfoot><tr class="info" style="font-weight: bold;">'+'<td>TOTAL</td><td>$'+total+'</td>'+'</tr></tfoot>');
            console.log(total);
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