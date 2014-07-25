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


    function mostrarGrafico(productos)
    {
        var data = new Array();
        data = [
            {
                "mes": "Enero",
                "Telefonia": 23.5,
                "Television": 18.1,
                "Internet": 15
            },
            {
                "mes": "Febrero",
                "Telefonia": 23.5,
                "Internet": 17.1,
                "Television": 16
            },
            {
                "mes": "Marzo",
                "Telefonia": 30.5,
                "Internet": 40.1,
                "Television": 20
            },
            {
                "mes": "Abril",
                "Telefonia": 26.5,
                "Internet": 30.1,
                "Television": 31
            },
            {
                "mes": "Mayo",
                "Telefonia": 33.5,
                "Internet": 38.1,
                "Television": 27
            }
            ];

        console.log(productos);
        console.log(data);
        var chart = AmCharts.makeChart("chartdiv", {
            "type": "serial",
            "theme": "none",
            "pathToImages": "http://cdn.amcharts.com/lib/3/images/",
            "categoryField": "mes",
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
            "dataProvider": data ,
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

    



;// Chart.defaults.global = {
//     // Boolean - Whether to animate the chart
//     animation: true,

//     // Number - Number of animation steps
//     animationSteps: 60,

//     // String - Animation easing effect
//     animationEasing: "easeOutQuart",

//     // Boolean - If we should show the scale at all
//     showScale: true,

//     // Boolean - If we want to override with a hard coded scale
//     scaleOverride: false,

//     // ** Required if scaleOverride is true **
//     // Number - The number of steps in a hard coded scale
//     scaleSteps: null,
//     // Number - The value jump in the hard coded scale
//     scaleStepWidth: null,
//     // Number - The scale starting value
//     scaleStartValue: null,

//     // String - Colour of the scale line
//     scaleLineColor: "rgba(0,0,0,.1)",

//     // Number - Pixel width of the scale line
//     scaleLineWidth: 1,

//     // Boolean - Whether to show labels on the scale
//     scaleShowLabels: true,

//     // Interpolated JS string - can access value
//     scaleLabel: "<%=value%>",

//     // Boolean - Whether the scale should stick to integers, not floats even if drawing space is there
//     scaleIntegersOnly: true,

//     // Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
//     scaleBeginAtZero: false,

//     // String - Scale label font declaration for the scale label
//     scaleFontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif",

//     // Number - Scale label font size in pixels
//     scaleFontSize: 12,

//     // String - Scale label font weight style
//     scaleFontStyle: "normal",

//     // String - Scale label font colour
//     scaleFontColor: "#666",

//     // Boolean - whether or not the chart should be responsive and resize when the browser does.
//     responsive: true,

//     // Boolean - Determines whether to draw tooltips on the canvas or not
//     showTooltips: true,

//     // Array - Array of string names to attach tooltip events
//     tooltipEvents: ["mousemove", "touchstart", "touchmove"],

//     // String - Tooltip background colour
//     tooltipFillColor: "rgba(0,0,0,0.8)",

//     // String - Tooltip label font declaration for the scale label
//     tooltipFontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif",

//     // Number - Tooltip label font size in pixels
//     tooltipFontSize: 14,

//     // String - Tooltip font weight style
//     tooltipFontStyle: "normal",

//     // String - Tooltip label font colour
//     tooltipFontColor: "#fff",

//     // String - Tooltip title font declaration for the scale label
//     tooltipTitleFontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif",

//     // Number - Tooltip title font size in pixels
//     tooltipTitleFontSize: 14,

//     // String - Tooltip title font weight style
//     tooltipTitleFontStyle: "bold",

//     // String - Tooltip title font colour
//     tooltipTitleFontColor: "#fff",

//     // Number - pixel width of padding around tooltip text
//     tooltipYPadding: 6,

//     // Number - pixel width of padding around tooltip text
//     tooltipXPadding: 6,

//     // Number - Size of the caret on the tooltip
//     tooltipCaretSize: 8,

//     // Number - Pixel radius of the tooltip border
//     tooltipCornerRadius: 6,

//     // Number - Pixel offset from point x to tooltip edge
//     tooltipXOffset: 10,

//     // String - Template string for single tooltips
//     tooltipTemplate: "<%if (label){%><%=label%>: <%}%><%= datasets[0].label %>",

//     // String - Template string for single tooltips
//     multiTooltipTemplate: "<%= value %>",

//     // Function - Will fire on animation progression.
//     onAnimationProgress : function(){},

//     // Function - Will fire on animation completion.
//     onAnimationComplete: function(){}
// }



// <!-- Editar valores grafico   -->
// myLineChart.datasets[0].points[2].value = 150;
// myLineChart.update();