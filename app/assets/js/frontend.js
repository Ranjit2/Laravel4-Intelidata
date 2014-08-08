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
        chart.groupedPulled = true;

        chart.addListener("clickSlice", function (event) {
            if (event.dataItem.dataContext.id != undefined) {
                selected = event.dataItem.dataContext.id;
                b = parseInt(a+(a*0.15));
                $('#chartdiv svg').css('min-height',b + 'px');
                $('#chartdiv div:first-child').css('min-height',b + 'px');
                chart.marginTop = 100;
                chart.labelRadius = 2;
// $('#legenddiv').empty().show();
}
else {
    selected = undefined;
    $('#chartdiv svg').css('min-height',a + 'px');
    $('#chartdiv div:first-child').css('min-height',a + 'px');
    chart.marginTop = 10;
    chart.labelRadius = 20;
    $('#legenddiv').show();
}
chart.dataProvider = $.generateChartData(types, selected);
chart.validateData();
});
        chart.write(div);
        var a = $('#chartdiv svg').height();
        var b = 0;
    });
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

$(document).ready(function() {
    var panels = $('.user-infos');
    var panelsButton = $('.dropdown-user');
    panels.hide();

    panelsButton.click(function() {
        var dataFor = $(this).attr('data-for');
        var idFor = $(dataFor);

        var currentButton = $(this);
        idFor.slideToggle(400, function() {
            if(idFor.is(':visible')) {
                currentButton.html('<i class="glyphicon glyphicon-chevron-up text-muted"></i>');
            } else {
                currentButton.html('<i class="glyphicon glyphicon-chevron-down text-muted"></i>');
            }
        })
    });
    $('[data-toggle="tooltip"]').tooltip();
});