$.loadJSON = function (url) {
    try {
        var request = $.ajax({

        });
        $.ajax({
            url: url,
            type: "POST",
            dataType: 'html',
            async: false,
            cache: false,
        })
        .done(function() {
            console.log("success");
        })
        .fail(function() {
            console.log("error");
            console.log(JSON.stringify(jqXHR));
            console.log(textStatus+': '+errorThrown);
        })
        .always(function() {
            console.log("complete");
        });

        return request.responseJSON;
    } catch(err) {
        console.log('Error: ' + err);
    }
};

$.loadChart = function (div, url, type, date) {
    var div  = typeof div  !== 'undefined' ? div : 'chartdiv';
    var date = typeof date !== 'undefined' && date.length != 0 ? '/'+date : '';
    var type = typeof type !== 'undefined' && type.length != 0 ? type : 'column';
    var url  = typeof url  !== 'undefined' ? url+date : '';
    try {
        var json  = $.loadJSON(url);
        AmCharts.ready(function(){
            $.column(div, json);
        });
    } catch(err) {
        console.log('Error: ' + err);
    }
};

// COLUMN CHART
$.column = function (div, json) {

    // INIT
    var chart                          = new AmCharts.AmSerialChart();
    chart.dataProvider                 = json.data;
    chart.graphs                       = json.graphs;
    chart.gridAboveGraphs              = true;
    chart.pathToImages                 = "http://www.amcharts.com/lib/3/images/";
    chart.categoryField                = "fecha";
    chart.language                     = "es";
    chart.numberFormatter              = formatNumber;

    var formatNumber                   = {
        decimalSeparator: ",",
        thousandsSeparator: ".",
        precision: -1,
    };

    // DATE
    chart.dataDateFormat               = "YYYY-MM-DD",

    // ANIMATION
    chart.startDuration                = 0;
    chart.startAlpha                   = 0;

    // MARGIN
    chart.autoMargins                  = false;
    chart.marginRight                  = 0;
    chart.marginLeft                   = 75;
    chart.marginBottom                 = 20;
    chart.marginTop                    = 20;

    // AXIS X
    var categoryAxis                   = chart.categoryAxis;
    categoryAxis.inside                = false;
    categoryAxis.axisAlpha             = 0;
    categoryAxis.gridAlpha             = 0;
    categoryAxis.tickLength            = 0;
    categoryAxis.parseDates            = true;
    categoryAxis.minPeriod             = "MM";

    // VALUE AXIS X
    var valueAxis                      = new AmCharts.ValueAxis();
    valueAxis.dashLength               = 1;
    valueAxis.axisColor                = "#DADADA";
    valueAxis.axisAlpha                = 1;
    valueAxis.unit                     = "$";
    valueAxis.unitPosition             = "left";
    chart.addValueAxis(valueAxis);

    // LEGEND
    var legend                         = new AmCharts.AmLegend();
    legend.labelText                   = "[[title]]";
    legend.valueText                   = "";
    legend.useGraphSettings            = true;
    chart.addLegend(legend);

    // CURSORS
    var chartCursor                    = new AmCharts.ChartCursor();
    chartCursor.categoryBalloonEnabled = true;
    chartCursor.cursorAlpha            = 0;
    chartCursor.zoomable               = true;
    chart.addChartCursor(chartCursor);

    chart.exportConfig                 = exportConfig;
    var exportConfig                   = {
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
        }],
    };

    // WRITE
    chart.write(div);
}

// STACK CHART
$.stack = function (div, json) {

    // INIT
    var chart                          = new AmCharts.AmSerialChart();
    chart.dataProvider                 = json.data;
    chart.graphs                       = json.graphs;
    chart.gridAboveGraphs              = true;
    chart.pathToImages                 = "http://www.amcharts.com/lib/3/images/";
    chart.categoryField                = "fecha";
    chart.language                     = "es";
    chart.numberFormatter              = formatNumber;

    var formatNumber                   = {
        decimalSeparator: ",",
        thousandsSeparator: ".",
        precision: -1,
    };

    // DATE
    chart.dataDateFormat               = "YYYY-MM-DD",

    // ANIMATION
    chart.startDuration                = 0;
    chart.startAlpha                   = 0;

    // MARGIN
    chart.autoMargins                  = false;
    chart.marginRight                  = 0;
    chart.marginLeft                   = 75;
    chart.marginBottom                 = 20;
    chart.marginTop                    = 20;

    // AXIS X
    var categoryAxis                   = chart.categoryAxis;
    categoryAxis.inside                = false;
    categoryAxis.axisAlpha             = 0;
    categoryAxis.gridAlpha             = 0;
    categoryAxis.tickLength            = 0;
    categoryAxis.parseDates            = true;
    categoryAxis.minPeriod             = "MM";

    // VALUE AXIS X
    var valueAxis                      = new AmCharts.ValueAxis();
    valueAxis.dashLength               = 1;
    valueAxis.axisColor                = "#DADADA";
    valueAxis.axisAlpha                = 1;
    valueAxis.unit                     = "$";
    valueAxis.unitPosition             = "left";
    valueAxis.stackType                = "regular";
    chart.addValueAxis(valueAxis);

    // LEGEND
    var legend                         = new AmCharts.AmLegend();
    legend.labelText                   = "[[title]]";
    legend.valueText                   = "";
    legend.useGraphSettings            = true;
    chart.addLegend(legend);

    // CURSORS
    var chartCursor                    = new AmCharts.ChartCursor();
    chartCursor.categoryBalloonEnabled = true;
    chartCursor.cursorAlpha            = 0;
    chartCursor.zoomable               = true;
    chart.addChartCursor(chartCursor);

    chart.exportConfig                 = exportConfig;
    var exportConfig                   = {
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
        }],
    };

    // WRITE
    chart.write(div);
}

// DONUT CHART
$.donut = function (div, json) {}

// LINE CHART
$.linea = function (div, json) {}

// PIE CHART
$.pie = function (div, json) {}

// BROKEN CHART
$.broken = function (div, json) {
    var selected;
    var types = $.loadJSON(url);

    // INIT
    var chart = new AmCharts.AmPieChart();

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