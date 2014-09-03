$('#nav-profile a').click(function (e) {
  e.preventDefault()
  $(this).tab('show')
});

$.porcentaje = function (total, number) {
  a = number*100;
  a = a/total;
  return a.toFixed(1);
}

$.progressbar = function (a) {
  var b = 0;
  var c = '';
  if (a > 0 && a < 100) {
    c = '<div class="progress"><div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="'+a+'" aria-valuemin="0" aria-valuemax="100" style="width: '+a+'%;">'+a+'%</div></div>';
  } else {
    b = a * -1.5;
    c = '<div class="progress"><div class="progress-bar progress-bar-danger progress-bar-striped active" role="progressbar" aria-valuenow="'+b+'" aria-valuemin="0" aria-valuemax="100" style="width: '+b+'%;">'+a+'%</div></div>';
  };
  return c;
}

$.fn.centerToWindow = function() {
  var obj           = $(this);
  var obj_width     = $(this).outerWidth(true);
  var obj_height    = $(this).outerHeight(true);
  var window_width  = window.innerWidth ? window.innerWidth : $(window).width();
  var window_height = window.innerHeight ? window.innerHeight : $(window).height();

  obj.css({
    "position" : "fixed",
    "top"      : ((window_height / 2) - (obj_height / 2))+"px",
    "left"     : ((window_width / 2) - (obj_width / 2))+"px"
  });
}

$.convNumberToMonth = function(n) {
  var months = {1: 'Enero', 2: 'Febrero', 3: 'Marzo', 4: 'Abril', 5: 'Mayo', 6: 'Junio', 7: 'Julio', 8: 'Agosto', 9: 'Septiembre', 10: 'Octubre', 11: 'Noviembre', 12: 'Diciembre', };
  return months[n];
}

$.convMonthToNumber = function(m) {
  m = m.toLowerCase();
  var numbers = {'enero': 1, 'febrero': 2, 'marzo': 3, 'abril': 4, 'mayo': 5, 'junio': 6, 'julio': 7, 'agosto': 8, 'septiembre': 9, 'octubre': 10, 'noviembre': 11, 'diciembre': 12, };
  return numbers[m];
};// LOAD DATA FROM GRAFFCONTROLLER
$.loadJSON = function (url) {
    try {
        var request = $.ajax({
            url: url,
            type: "POST",
            async: false,
            cache: false,
        });
        request.done(function() {
            // console.log("success");
        });
        request.fail(function() {
            // console.log("Error:\n" + JSON.stringify(jqXHR) + '\n' + textStatus + ': ' + errorThrown + '\n');
        });
        request.always(function() {
            // console.log("complete");
        });
        request.error(function (jqXHR, exception) {
            if (jqXHR.status === 0) {
                // console.log('Not connect.n Verify Network.');
            } else if (jqXHR.status == 404) {
                // console.log('Requested page not found. [404]');
            } else if (jqXHR.status == 500) {
                // console.log('Internal Server Error [500].');
            } else if (exception === 'parsererror') {
                // console.log('Requested JSON parse failed.');
            } else if (exception === 'timeout') {
                // console.log('Time out error.');
            } else if (exception === 'abort') {
                // console.log('Ajax request aborted.');
            } else {
                // console.log('Uncaught Error.n' + jqXHR.responseText);
            }
        });
        // RETURN DATA
        return request.responseJSON;
    } catch(err) {
        console.log('Error:\n' + err);
    }
};

// LOAD DIFERENTS CHARTS
$.loadChart = function (div, url, type, date) {

    // DIV ID
    var div  = typeof div  !== 'undefined' ? div : 'chartdiv';
    // DATE OF DATA
    var date = typeof date !== 'undefined' && date.length != 0 ? '/'+date : '';
    // TYPE OF CHART
    var type = typeof type !== 'undefined' && type.length != 0 ? type : 'column';
    // URL TO GET DATA
    var url  = typeof url  !== 'undefined' ? url+date : '';
    // READY CHART
    try {
        // GET DATA
        var json  = $.loadJSON(url);
        json = typeof json !== 'undefined' && json.length != 0 ? json : 'NULL';
        if(json == 'NULL') {
            // console.log("No hay datos disponibles.");
        } else {
            // SWITCH CHART DEPENDS VAR "TYPE"
            switch(type) {
                // BREAK CHART
                case 'broken':
                $.broken(div, json);
                break;
                // COLUMN CHART
                case 'column':
                $.column(div, json);
                break;

                // COMPARATIVE CHART
                case 'comparative':
                $.comparative(div, json);
                break;

                // DONUT CHART
                case 'donut':
                $.donut(div, json);
                break;

                // EVOLUTION CHART
                case 'evolution':
                $.evolution(div, json);
                break;

                // LINE CHART
                case 'line':
                $.line(div, json);
                break;

                // PIE CHART
                case 'pie':
                $.pie(div, json);
                break;

                // SMOOTHLINE CHART
                case 'smoothline':
                $.smoothline(div, json);
                break;

                case 'stackbar':
                $.stackbar(div, json);
                break;

                case 'historicoCategoria':
                $.historicoCategoria(div, json);
                break;

                case 'telefonosPorProducto':
                $.telefonosPorProducto(div, json);
                break;
            };
        }
    } catch(err) {
        // SHOW ERRORS
        // console.log('Error:\n' + err);
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
    chart.numberFormatter              = $.formatNumber();

    // DATE
    chart.dataDateFormat               = "YYYY-MM-DD HH:NN";

    // ANIMATION
    $.animation(chart, false);

    // MARGIN
    $.margin(chart);

    // AXIS X
    $.categoryAxis(chart);

    // VALUE AXIS X
    var valueAxis                      = new AmCharts.ValueAxis();
    valueAxis.dashLength               = 1;
    valueAxis.axisColor                = "#DADADA";
    valueAxis.axisAlpha                = 1;
    valueAxis.unit                     = "$";
    valueAxis.unitPosition             = "left";
    chart.addValueAxis(valueAxis);

    // LEGEND
    $.legend(chart);

     // CURSOR
     var chartCursor              = new AmCharts.ChartCursor();
     chart.addChartCursor(chartCursor);

    // EXPORT
    chart.exportConfig                 = $.export();

    // WRITE
    chart.write(div);
};

$.historicoCategoria = function (div, json) {

    // INIT
    chart                              = new AmCharts.AmPieChart();
    chart.dataProvider                 = json.data;
    chart.titleField                   = "nombre";
    chart.valueField                   = "cantidad";
    chart.outlineColor                 = "#FFFFFF";
    chart.outlineAlpha                 = 0.8;
    chart.outlineThickness             = 2;
    chart.labelText                    = "[[nombre]]";
    chart.balloonTex                   = "[[title]]<br><span style='font-size:11px'><b>[[value]]</b> ([[percents]]%)</span>";
    chart.pathToImages                 = "http://www.amcharts.com/lib/3/images/";
    chart.categoryField                = "nombre";
    chart.radius                       = "35%";
    chart.language                     = "es";
    chart.numberFormatter              = $.formatNumber();

    // DATE
    chart.dataDateFormat               = "YYYY-MM-DD HH:NN";

    // ANIMATION
    $.animation(chart, false);

    // LEGEND
    $.legend(chart);

    // EXPORT
    chart.exportConfig                 = $.export();

    // CURSOR
    var chartCursor              = new AmCharts.ChartCursor();
    chart.addChartCursor(chartCursor);

    // WRITE
    chart.write(div);
};

// STACK CHART
$.stackbar = function (div, json) {

    // INIT
    var chart                          = new AmCharts.AmSerialChart();
    chart.dataProvider                 = json.data;
    chart.graphs                       = json.graphs;
    chart.gridAboveGraphs              = true;
    chart.pathToImages                 = "http://www.amcharts.com/lib/3/images/";
    chart.categoryField                = "fecha";
    chart.language                     = "es";
    chart.numberFormatter              = $.formatNumber();

    // DATE
    chart.dataDateFormat               = "YYYY-MM-DD HH:NN";

    // ANIMATION
    $.animation(chart, false);

    // MARGIN
    $.margin(chart);

    // AXIS X
    $.categoryAxis(chart);

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
    $.legend(chart);

     // CURSOR
     var chartCursor              = new AmCharts.ChartCursor();
     chart.addChartCursor(chartCursor);

    // EXPORT
    chart.exportConfig                 = $.export();

    // WRITE
    chart.write(div);
};

// DONUT CHART
$.donut = function (div, json) {

    // INIT
    chart                              = new AmCharts.AmPieChart();
    chart.dataProvider                 = json.data;
    chart.titleField                   = "mes";
    chart.valueField                   = "monto";
    chart.outlineColor                 = "#FFFFFF";
    chart.outlineAlpha                 = 0.8;
    chart.outlineThickness             = 2;
    chart.labelText                    = "[[numero]]";
    chart.balloonTex                   = "[[title]]<br><span style='font-size:11px'><b>[[value]]</b> ([[percents]]%)</span>";
    chart.pathToImages                 = "http://www.amcharts.com/lib/3/images/";
    chart.categoryField                = "fecha";
    chart.language                     = "es";
    chart.numberFormatter              = $.formatNumber();

    // EXTRAS
    chart.labelRadius                  = 5;
    chart.radius                       = "35%";
    chart.innerRadius                  = "60%";

    // DATE
    chart.dataDateFormat               = "YYYY-MM-DD HH:NN";

    // ANIMATION
    $.animation(chart, false);

    // LEGEND
    $.legend(chart);

     // CURSOR
     var chartCursor              = new AmCharts.ChartCursor();
     chart.addChartCursor(chartCursor);

    // EXPORT
    chart.exportConfig                 = $.export();

    // WRITE
    chart.write(div);
};

// COMPARATIVE CHART
$.comparative = function (div, json) {

    // INIT
    var chart                    = new AmCharts.AmSerialChart();
    chart.dataProvider           = json.data;
    chart.pathToImages           = "http://www.amcharts.com/lib/3/images/";
    chart.categoryField          = "date";
    chart.language               = "es";
    chart.numberFormatter        = $.formatNumber();

    // DATE
    chart.dataDateFormat         = "YYYY-MM-DD HH:NN";

    // AXIS X
    $.categoryAxis(chart, false);

    // VALUE AXIS X
    var valueAxis                = new AmCharts.ValueAxis();
    valueAxis.dashLength         = 1;
    valueAxis.axisColor          = "#DADADA";
    valueAxis.axisAlpha          = 1;
    valueAxis.unit               = "$";
    valueAxis.unitPosition       = "left";
    chart.addValueAxis(valueAxis);

    // ANIMATION
    $.animation(chart, false);

    // LEGEND
    $.legend(chart);

    // GRAPH 1
    var graph                    = new AmCharts.AmGraph();
    graph.title                  = json.years[0];
    graph.balloonText            = "<strong>[[date]] - [[year1]]</strong> <br>Monto: $[[value]]";
    graph.type                   = "line";
    graph.valueField             = "val1";
    graph.lineColor              = "#60c6cf";
    graph.lineThickness          = 3;
    graph.bullet                 = "round";
    graph.bulletColor            = "#60c6cf";
    graph.bulletBorderColor      = "#ffffff";
    graph.bulletBorderAlpha      = 1;
    graph.bulletBorderThickness  = 3;
    graph.bulletSize             = 15;
    chart.addGraph(graph);

    // GRAPH 2
    var graph1                   = new AmCharts.AmGraph();
    graph1.title                 = json.years[1];
    graph1.balloonText           = "<strong>[[date]] - [[year2]]</strong> <br>Monto: $[[value]]";
    graph1.type                  = "line";
    graph1.valueField            = "val2";
    graph1.lineColor             = "#f35958";
    graph1.lineThickness         = 3;
    graph1.bullet                = "round";
    graph1.bulletColor           = "#f35958";
    graph1.bulletBorderColor     = "#ffffff";
    graph1.bulletBorderAlpha     = 1;
    graph1.bulletBorderThickness = 3;
    graph1.bulletSize            = 12;
    chart.addGraph(graph1);

    // GRAPH 3
    var graph2                   = new AmCharts.AmGraph();
    graph2.title                 = json.years[2];
    graph2.balloonText           = "<strong>[[date]] - [[year3]]</strong> <br>Monto: $[[value]]";
    graph2.type                  = "line";
    graph2.valueField            = "val3";
    graph2.lineThickness         = 3;
    graph2.bullet                = "round";
    graph2.bulletBorderColor     = "#ffffff";
    graph2.bulletBorderAlpha     = 1;
    graph2.bulletBorderThickness = 3;
    graph2.bulletSize            = 12;
    chart.addGraph(graph2);

    // EXPORT
    chart.exportConfig           = $.export();

    // CURSOR
    var chartCursor              = new AmCharts.ChartCursor();
    chart.addChartCursor(chartCursor);

    // WRITE
    chart.write(div);
};

// EVOLUTION CHART
$.evolution = function (div, json) {

    // INIT
    var chart                    = new AmCharts.AmSerialChart();
    chart.dataProvider           = json.data;
    chart.pathToImages           = "http://www.amcharts.com/lib/3/images/";
    chart.categoryField          = "fecha";
    chart.language               = "es";
    chart.numberFormatter        = $.formatNumber();

    // DATE
    chart.dataDateFormat         = "YYYY-MM-DD HH:NN";

     // AXIS X
     $.categoryAxis(chart);

    // VALUE AXIS X
    var valueAxis                = new AmCharts.ValueAxis();
    valueAxis.dashLength         = 1;
    valueAxis.axisColor          = "#DADADA";
    valueAxis.axisAlpha          = 1;
    valueAxis.unit               = "$";
    valueAxis.unitPosition       = "left";
    chart.addValueAxis(valueAxis);

    // ANIMATION
    $.animation(chart, false);

    // LEGEND
    $.legend(chart);

    // GRAPH
    var graph                    = new AmCharts.AmGraph();
    graph.title                  = "";
    graph.balloonText            = "[[category]]<br><b><span style='font-size:14px;'>$ [[value]]</span></b>";
    graph.type                   = "line";
    graph.valueField             = "value";
    graph.lineColor              = "#60c6cf";
    graph.lineThickness          = 3;
    graph.bullet                 = "round";
    graph.bulletColor            = "#60c6cf";
    graph.bulletBorderColor      = "#ffffff";
    graph.bulletBorderAlpha      = 1;
    graph.bulletBorderThickness  = 3;
    graph.bulletSize             = 12;
    chart.addGraph(graph);

    // EXPORT
    chart.exportConfig           = $.export();

    // CURSOR
    var chartCursor              = new AmCharts.ChartCursor();
    chart.addChartCursor(chartCursor);

    // WRITE
    chart.write(div);
};

// PIE CHART
$.pie = function (div, json) {

    // INIT
    chart                              = new AmCharts.AmPieChart();
    chart.dataProvider                 = json.data;
    chart.titleField                   = "mes";
    chart.valueField                   = "monto";
    chart.outlineColor                 = "#FFFFFF";
    chart.outlineAlpha                 = 0.8;
    chart.outlineThickness             = 2;
    chart.labelText                    = "[[numero]]";
    chart.balloonTex                   = "[[title]]<br><span style='font-size:11px'><b>[[value]]</b> ([[percents]]%)</span>";
    chart.pathToImages                 = "http://www.amcharts.com/lib/3/images/";
    chart.categoryField                = "fecha";
    chart.language                     = "es";
    chart.numberFormatter              = $.formatNumber();

    // DATE
    chart.dataDateFormat               = "YYYY-MM-DD HH:NN";

    // ANIMATION
    $.animation(chart, false);

    // LEGEND
    $.legend(chart);

     // EXPORT
     chart.exportConfig                 = $.export();

    // WRITE
    chart.write(div);
};

$.telefonosPorProducto = function (div, json) {

    // INIT
    chart                              = new AmCharts.AmPieChart();
    chart.dataProvider                 = json.data;
    chart.titleField                   = "numero" // "nombre";
    chart.valueField                   = "monto" // "cantidad";
    chart.outlineColor                 = "#FFFFFF";
    chart.outlineAlpha                 = 0.8;
    chart.outlineThickness             = 2;
    chart.labelText                    = "[[numero]]" // "[[nombre]]";
    chart.balloonTex                   = "[[title]]<br><span style='font-size:11px'><b>[[value]]</b> ([[percents]]%)</span>";
    chart.pathToImages                 = "http://www.amcharts.com/lib/3/images/";
    chart.categoryField                = "numero" //"nombre";
    chart.radius                       = "35%";
    chart.language                     = "es";
    chart.numberFormatter              = $.formatNumber();

    // DATE
    chart.dataDateFormat               = "YYYY-MM-DD HH:NN";

    // ANIMATION
    $.animation(chart, false);

    // LEGEND
    $.legend(chart);

    // EXPORT
    chart.exportConfig                 = $.export();

    // WRITE
    chart.write(div);
};

// BROKEN CHART
$.broken = function (div, json) {
    var selected;
    var types                         = json.data;

    // INIT
    var chart                         = new AmCharts.AmPieChart();
    chart.dataProvider                = $.generateChartData(types, selected);
    chart.titleField                  = "type";
    chart.valueField                  = "percent";
    chart.outlineColor                = "#FFFFFF";
    chart.outlineAlpha                = 0.8;
    chart.outlineThickness            = 0.5;
    chart.colorField                  = "color";
    chart.pulledField                 = "pulled";
    chart.balloonText                 = "<b>$[[percent]] ([[percents]]%)</b>";
    chart.labelText                   = "[[type]]";
    chart.radius                      = "35%";
    chart.depth3D                     = 0;
    chart.groupedPulled               = true;

    // DATE
    chart.dataDateFormat               = "YYYY-MM-DD HH:NN";

    // ANIMATION
    $.animation(chart, false);

    // EXPORT
    chart.exportConfig                = $.export();

    // LEGEND
    $.legend(chart, 'legenddiv', 'Producto: [[title]]');

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
};

// GENERATE DATA TO BROKEN CHART
$.generateChartData = function (types, selected) {
    $('#lista').hide();
    $('#lista tbody').empty();
    $('#lista tfoot').empty();
    var chartData = [];
    var total     = 0;
    var porcent   = 0;
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
};

$.animation = function(chart, bool) {
    if(bool) {
        chart.sequencedAnimation = true;
        chart.startDuration      = 5;
        chart.startAlpha         = 10;
    } else {
        chart.sequencedAnimation = false;
        chart.startDuration      = 0;
        chart.startAlpha         = 0;
    }
}

$.export = function () {
    var exportConfig = {
        menuTop: "0px",
        menuBottom: "0px",
        menuRight: "0px",
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
    return exportConfig;
};

$.legend = function (chart, legenddiv, text) {
    legenddiv = typeof legenddiv !== 'undefined' && legenddiv.length != 0 ? legenddiv : false;
    text      = typeof text !== 'undefined' && text.length != 0 ? text : false;

    var legend              = new AmCharts.AmLegend();
    legend.align            = "center";
    legend.markerType       = "circle";
    legend.valueText        = "";
    legend.useGraphSettings = false;
    if (!text) {
        legend.labelText        = "[[title]]";
    } else {
        legend.labelText        = text;
    };
    if(!legenddiv) {
        chart.addLegend(legend);
    } else {
        chart.addLegend(legend, legenddiv);
    }
};

$.margin = function (chart) {
    chart.autoMargins  = false;
    chart.marginRight  = 0;
    chart.marginLeft   = 80;
    chart.marginBottom = 20;
    chart.marginTop    = 20;
};

$.formatNumber = function() {
    var formatNumber = {
        decimalSeparator: ",",
        thousandsSeparator: ".",
        precision: -1,
    };
    return formatNumber;
};

$.categoryAxis = function (chart, parse) {
    parse = typeof parse !== 'undefined' && parse.length != 0 ? parse : true;
    var categoryAxis                   = chart.categoryAxis;
    categoryAxis.inside                = false;
    categoryAxis.axisAlpha             = 0;
    categoryAxis.gridAlpha             = 0;
    categoryAxis.tickLength            = 0;
    categoryAxis.minPeriod             = "MM";
    categoryAxis.equalSpacing          = false;
    if (parse) {
        categoryAxis.parseDates        = true;
    };
};