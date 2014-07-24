$(document).ready(function() {
    // GENERAL AJAX ======================================================
    $(document).ajaxStart(function () {
        $('#progressbar').fadeIn('fast');
        setTimeout(function(){
            $('#progressbar').each(function() {
                var perc         = $('#progressbar').attr("aria-valuemax");
                var current_perc = 0;
                var progress     = setInterval(function() {
                    if (current_perc >= perc) {
                        clearInterval(progress);
                    } else {
                        current_perc += Math.floor((Math.random()*10)+1);
                        $('#progressbar').css('width', (current_perc)+'%').attr('aria-valuenow', current_perc);
                    }
                }, 300);
            });
        }, 150);
        return false;
    });

    $(document).ajaxStop(function() {
        /* stuff to do when all AJAX calls have completed */
        // console.log("Triggered ajaxComplete handler. The result is " + xhr.responseText);
        setTimeout(function(){
            setTimeout(function(){
                $("#progressbar").fadeOut('slow', function() {
                    $("#progressbar").css('width', '0%').attr('aria-valuenow', '0');
                });
            }, 4500);
            $("#progressbar").css('width', '100%').attr('aria-valuenow', '100');
        }, 4500);
        return false;
    });


    // FUNCTIONS ======================================================
    $("#get").click(function (e) {
        e.preventDefault();
        $.get('/get', function(data) {
            $(".modal-body").append(data);
        });
    });

    $("#mail").click(function (e) {
        e.preventDefault();
        $.get('/mail', function(data) {
            $('.info').hide().find('ul').empty();
            $('.info').find('ul').append('<li>'+data.message+'</li>');
            $('.info').slideDown('fast');
        });
    });

    $("#cerrar").click(function (e) {
        e.preventDefault();
        $(".modal-body").empty();
    });

    $("#post").submit(function (e) {
        e.preventDefault();
        var nombre = $(this).find('input[name=name]').val();
        var edad   = $(this).find('input[name=age]').val();
        $.post('/get', {name:nombre, age:edad}, function(data) {
            console.log("Nombre: " + data.name);
            console.log("Edad: " + data.age);
        }, 'json');
    });

    $("#post2").submit(function (e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "/get2",
            data: $(this).serialize(),
            dataType: "",
            success: function(data) {
                console.log("Datos: " + data);
            },
            error: function(){
                console.log('error handing here');
            }
        });
    });

    $("#fError").submit(function (e) {
        e.preventDefault();
        var formData = new FormData();
        formData.append('name', $("#name2").val());
        $.ajax({
            type: "POST",
            url: "submit",
            processData: false,
            contentType: false,
            cache: false,
            dataType: "json",
            data: formData,
            success: function(data) {
                $('.info').hide().find('ul').empty();
                if (!data.success) {
                    $.each(data.errors, function(index, error) {
                        $('.info').find('ul').append('<li>Field: '+index+' </br> Error: '+error+'</li>');
                    });
                    $('.info').slideDown('fast');
                }
            },
            error: function(){
                console.log('error handing here');
            }
        });
    });

    $("#btnEnviar").on('click',function (e) {
        e.preventDefault();
        var idEmpresa = $('#txtEmpresa').val();
        // if(idEmpresa)
            $.post('/graffs'+idEmpresa, function(data) {
                console.log("DATA: " + data);
                // $.each(data, function(index, value) {
                //     $('#datos').append(value.nombre);
                // });
            }, 'json');
        // } else {
        //     $.get('/graffs', function(data) {
        //         $('#datos').html(data);
        //     });
        // }
    });

    AmCharts.loadJSON = function(url, id, method) {
        url    = typeof url !== 'undefined' ? url : '';
        id     = typeof id !== 'undefined' ? id : '';
        method = typeof method !== 'undefined' ? method : 'GET';
        if(url !== '')
            return eval($.ajax({type: method, url: url+id, async: false}).responseText);
            // return $.ajax({type: method, url: url+id, async: false}).responseText;
    };

    // create chart
    // AmCharts.ready(function() {

    //     // load the data
    //     var chartData = AmCharts.loadJSON('/graf1');

    //     var chart = AmCharts.makeChart("chartdiv2", {
    //         "type": "serial",
    //         "theme": "none",
    //         "pathToImages": "http://cdn.amcharts.com/lib/3/images/",
    //         "categoryField": "category",
    //         "rotate": false,
    //         "startDuration": 1,
    //         "categoryAxis": {
    //             "gridPosition": "start",
    //             "position": "left"
    //         },
    //         "trendLines": [],
    //         "legend": {
    //             "autoMargins": false,
    //             "borderAlpha": 0.8,
    //             "equalWidths": true,
    //             "horizontalGap": 10,
    //             "markerSize": 10,
    //             "useGraphSettings": true,
    //             "valueAlign": "left",
    //             "align": "center",
    //             "valueWidth": 0,
    //         },
    //         "dataProvider": chartData,
    //         "graphs": [
    //         {
    //             "id": "AmGraph-1",
    //             "balloonText": "[[title]], [[category]]<br><span style='font-size:14px;'><b>[[value]]</b> ([[percents]]%)</span>",
    //             "fillAlphas": 1,
    //             "lineAlpha": 1,
    //             "title": "value1",
    //             "type": "column",
    //             "valueField": "value1"
    //         },
    //         {
    //             "id": "AmGraph-2",
    //             "balloonText": "[[title]], [[category]]<br><span style='font-size:14px;'><b>[[value]]</b> ([[percents]]%)</span>",
    //             "fillAlphas": 1,
    //             "lineAlpha": 1,
    //             "title": "value2",
    //             "type": "column",
    //             "valueField": "value2"
    //         }
    //         ],
    //         "guides": [],
    //         "valueAxes": [
    //         {
    //             "id": "ValueAxis-1",
    //             "position": "left",
    //             "axisAlpha": 0
    //         }
    //         ],
    //         "allLabels": [],
    //         "amExport": {
    //             "right": 20,
    //             "top": 20
    //         },
    //         "balloon": {},
    //         "titles": [],
    //         "pathToImages":"http://www.amcharts.com/lib/3/images/",
    //         "amExport":{
    //            "top":21,
    //            "right":20,
    //            "exportJPG":true,
    //            "exportPNG":true,
    //            "exportSVG":true,
    //            "exportPDF":true
    //        }
    //    });
// });


// var chart = AmCharts.makeChart("chartdiv", {
//     "type": "serial",
//     "theme": "none",
//     "pathToImages": "http://cdn.amcharts.com/lib/3/images/",
//     "categoryField": "year",
//     "rotate": false,
//     "startDuration": 1,
//     "categoryAxis": {
//         "gridPosition": "start",
//         "position": "left"
//     },
//     "trendLines": [],
//     "legend": {
//         "autoMargins": false,
//         "borderAlpha": 0.8,
//         "equalWidths": true,
//         "horizontalGap": 10,
//         "markerSize": 10,
//         "useGraphSettings": true,
//         "valueAlign": "left",
//         "align": "center",
//         "valueWidth": 0,
//     },
//     "graphs": [
//     {
//         "id": "AmGraph-1",
//         "balloonText": "[[title]], [[category]]<br><span style='font-size:14px;'><b>[[value]]</b> ([[percents]]%)</span>",
//         "fillAlphas": 1,
//         "lineAlpha": 1,
//         "title": "Telefonía",
//         "type": "column",
//         "valueField": "Telefonia"
//     },
//     {
//         "id": "AmGraph-2",
//         "balloonText": "[[title]], [[category]]<br><span style='font-size:14px;'><b>[[value]]</b> ([[percents]]%)</span>",
//         "fillAlphas": 1,
//         "lineAlpha": 1,
//         "title": "Internet",
//         "type": "column",
//         "valueField": "Internet"
//     },
//     {
//         "id": "AmGraph-3",
//         "balloonText": "[[title]], [[category]]<br><span style='font-size:14px;'><b>[[value]]</b> ([[percents]]%)</span>",
//         "fillAlphas": 1,
//         "lineAlpha": 1,
//         "title": "Televisión",
//         "type": "column",
//         "valueField": "Television"
//     }
//     ],
//     "guides": [],
//     "valueAxes": [
//     {
//         "id": "ValueAxis-1",
//         "position": "left",
//         "axisAlpha": 0
//     }
//     ],
//     "allLabels": [],
//     "amExport": {
//         "right": 20,
//         "top": 20
//     },
//     "balloon": {},
//     "titles": [],
//     "dataProvider": [
//     {
//         "year": "Enero",
//         "Telefonia": 23.5,
//         "Television": 18.1,
//         "Internet": 15
//     },
//     {
//         "year": "Febrero",
//         "Telefonia": 23.5,
//         "Internet": 17.1,
//         "Television": 16
//     },
//     {
//         "year": "Marzo",
//         "Telefonia": 30.5,
//         "Internet": 40.1,
//         "Television": 20
//     },
//     {
//         "year": "Abril",
//         "Telefonia": 26.5,
//         "Internet": 30.1,
//         "Television": 31
//     },
//     {
//         "year": "Mayo",
//         "Telefonia": 33.5,
//         "Internet": 38.1,
//         "Television": 27
//     }
//     ],
//     "pathToImages":"http://www.amcharts.com/lib/3/images/",
//     "amExport":{
//        "top":21,
//        "right":20,
//        "exportJPG":true,
//        "exportPNG":true,
//        "exportSVG":true,
//        "exportPDF":true
//    }
// });

})

$.columnChart = function(div, data) {

    var chart = AmCharts.makeChart("chartdiv", {
        "type": "serial",
        "theme": "none",
        "dataProvider": [{
            "country": "USA",
            "visits": 2025,
            "visits2": 25,
        }, {
            "country": "China",
            "visits": 1882
        }, {
            "country": "Japan",
            "visits": 1809
        }, {
            "country": "Germany",
            "visits": 1322
        }, {
            "country": "UK",
            "visits": 1122
        }, {
            "country": "France",
            "visits": 1114
        }, {
            "country": "India",
            "visits": 984
        }, {
            "country": "Spain",
            "visits": 711
        }, {
            "country": "Netherlands",
            "visits": 665
        }, {
            "country": "Russia",
            "visits": 580
        }, {
            "country": "South Korea",
            "visits": 443
        }, {
            "country": "Canada",
            "visits": 441
        }, {
            "country": "Brazil",
            "visits": 395
        }],
        "valueAxes": [{
            "gridColor":"#FFFFFF",
            "gridAlpha": 0.2,
            "dashLength": 0
        }],
        "gridAboveGraphs": true,
        "startDuration": 1,
        "graphs": [{
            "balloonText": "[[category]]: <b>[[value]]</b>",
            "fillAlphas": 0.8,
            "lineAlpha": 0.2,
            "type": "column",
            "valueField": "visits"
        },{
            "balloonText": "[[category]]: <b>[[value]]</b>",
            "fillAlphas": 0.8,
            "lineAlpha": 0.2,
            "type": "column",
            "valueField": "visits2"
        }],
        "chartCursor": {
            "categoryBalloonEnabled": false,
            "cursorAlpha": 0,
            "zoomable": false
        },
        "categoryField": "country",
        "categoryAxis": {
            "gridPosition": "start",
            "gridAlpha": 0,
             "tickPosition":"start",
             "tickLength":20
        },
        "exportConfig":{
          "menuTop": 0,
          "menuItems": [{
          "icon": '/lib/3/images/export.png',
          "format": 'png'
          }]
        }
    });
};

$.donutChart = function() {
    var chart = AmCharts.makeChart("chartdiv", {
        "type": "pie",
        "theme": "none",
        "dataProvider": [{
            "title": "New",
            "value": 4852
        }, {
            "title": "Returning",
            "value": 9899
        }],
        "titleField": "title",
        "valueField": "value",
        "labelRadius": 5,

        "radius": "42%",
        "innerRadius": "60%",
        "labelText": "[[title]]"
    });
};

$.lineChart = function() {
    console.log('VER');
};

$.pieChart = function() {
    console.log('VER');
};

$.stackbarChart = function (div,data) {

    var chart = AmCharts.makeChart("chartdiv", { // -------------------------------- ID DIV
        "type": "serial",
        "theme": "none",
        "legend": {
            "horizontalGap": 10,
            "maxColumns": 1,
            "position": "right",
            "useGraphSettings": true,
            "markerSize": 10
        },
        "dataProvider": [ // -------------------------------- DATA
        {
            "year": 2003,
            "europe": 2.5,
            "namerica": 2.5,
            "asia": 2.1,
            "lamerica": 0.3,
            "meast": 0.2,
            "africa": 0.1
        }
        ],
        "valueAxes": [{
            "stackType": "regular",
            "axisAlpha": 0.3,
            "gridAlpha": 0
        }],
        "graphs": [ // -------------------------------- TOOLTIP DEL ITEM
        {
            "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
            "fillAlphas": 0.8,
            "labelText": "[[title]] [[value]]",
            "lineAlpha": 0.3,
            "title": "Europe",
            "type": "column",
            "color": "#000000",
            "valueField": "europe"
        }],
        "categoryField": "year", // -------------------------------- EJE Y
        "categoryAxis": {
            "gridPosition": "start",
            "axisAlpha": 0,
            "gridAlpha": 0,
            "position": "left"
        },
        "exportConfig":{
            "menuTop":"20px",
            "menuRight":"20px",
            "menuItems": [{
            "icon": 'http://www.amcharts.com/lib/3/images/export.png',
            "format": 'png'
            }]
        }
    });
};