$(document).ready(function() {
    // GENERAL AJAX ======================================================
    // $(document).ajaxStart(function () {
    //     $('#progressbar').fadeIn('fast');
    //     setTimeout(function(){
    //         $('#progressbar').each(function() {
    //             var perc         = $('#progressbar').attr("aria-valuemax");
    //             var current_perc = 0;
    //             var progress     = setInterval(function() {
    //                 if (current_perc >= perc) {
    //                     clearInterval(progress);
    //                 } else {
    //                     current_perc += Math.floor((Math.random()*10)+1);
    //                     $('#progressbar').css('width', (current_perc)+'%').attr('aria-valuenow', current_perc);
    //                 }
    //             }, 300);
    //         });
    //     }, 150);
    //     return false;
    // });

    // $(document).ajaxStop(function() {
    //     /* stuff to do when all AJAX calls have completed */
    //     // console.log("Triggered ajaxComplete handler. The result is " + xhr.responseText);
    //     setTimeout(function(){
    //         setTimeout(function(){
    //             $("#progressbar").fadeOut('slow', function() {
    //                 $("#progressbar").css('width', '0%').attr('aria-valuenow', '0');
    //             });
    //         }, 4500);
    //         $("#progressbar").css('width', '100%').attr('aria-valuenow', '100');
    //     }, 4500);
    //     return false;
    // });

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



    AmCharts.loadJSON = function(url) {
        return eval($.ajax({type: "GET", url: url, async: false}).responseText);
    };

})    


    function mostrarGrafico()
    {
        var chart = AmCharts.makeChart("chartdiv", {
            "type": "serial",
            "theme": "none",
            "pathToImages": "http://cdn.amcharts.com/lib/3/images/",
            "categoryField": "year",
            "rotate": false,
            "startDuration": 1,
            "categoryAxis": {
                "gridPosition": "start",
                "position": "left"
            },
            "trendLines": [],
            "legend": {
                "autoMargins": false,
                "borderAlpha": 0.8,
                "equalWidths": true,
                "horizontalGap": 10,
                "markerSize": 10,
                "useGraphSettings": true,
                "valueAlign": "left",
                "align": "center",
                "valueWidth": 0,
            },
            "graphs": [
            {
                "id": "AmGraph-1",
                "balloonText": "[[title]], [[category]]<br><span style='font-size:14px;'><b>[[value]]</b> ([[percents]]%)</span>",
                "fillAlphas": 1,
                "lineAlpha": 1,
                "title": "Telefonía",
                "type": "column",
                "valueField": "Telefonia"
            },
            {
                "id": "AmGraph-2",
                "balloonText": "[[title]], [[category]]<br><span style='font-size:14px;'><b>[[value]]</b> ([[percents]]%)</span>",
                "fillAlphas": 1,
                "lineAlpha": 1,
                "title": "Internet",
                "type": "column",
                "valueField": "Internet"
            },
            {
                "id": "AmGraph-3",
                "balloonText": "[[title]], [[category]]<br><span style='font-size:14px;'><b>[[value]]</b> ([[percents]]%)</span>",
                "fillAlphas": 1,
                "lineAlpha": 1,
                "title": "Televisión",
                "type": "column",
                "valueField": "Television"
            }
            ],
            "guides": [],
            "valueAxes": [
            {
                "id": "ValueAxis-1",
                "position": "left",
                "axisAlpha": 0
            }
            ],
            "allLabels": [],
            "amExport": {
                "right": 20,
                "top": 20
            },
            "balloon": {},
            "titles": [],
            "dataProvider": [
            {
                "year": "Enero",
                "Telefonia": 23.5,
                "Television": 18.1,
                "Internet": 15
            },
            {
                "year": "Febrero",
                "Telefonia": 23.5,
                "Internet": 17.1,
                "Television": 16
            },
            {
                "year": "Marzo",
                "Telefonia": 30.5,
                "Internet": 40.1,
                "Television": 20
            },
            {
                "year": "Abril",
                "Telefonia": 26.5,
                "Internet": 30.1,
                "Television": 31
            },
            {
                "year": "Mayo",
                "Telefonia": 33.5,
                "Internet": 38.1,
                "Television": 27
            }
            ],
            "pathToImages":"http://www.amcharts.com/lib/3/images/",
            "amExport":{
               "top":21,
               "right":20,
               "exportJPG":true,
               "exportPNG":true,
               "exportSVG":true,
               "exportPDF":true
            }
        });
    }

    



