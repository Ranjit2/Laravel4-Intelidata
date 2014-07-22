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

    $(document).ajaxComplete(function( event, xhr, settings ) {
<<<<<<< HEAD
        //
=======
        // 
>>>>>>> d054bc23dc830711bf7a32ff901c2a6740c96e07
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
<<<<<<< HEAD

    $('#pdf').on('click', function (e) {
        e.preventDefault();
        // var img = putImage();
        // $.post('/pdf', {canvas:img}, function (data) {
        // });
        exportCanvas();
    });
})

function convertCanvas(strType) {
    if (strType == "PNG")
        var oImg = Canvas2Image.saveAsPNG(oCanvas, true);
    if (strType == "BMP")
        var oImg = Canvas2Image.saveAsBMP(oCanvas, true);
    if (strType == "JPEG")
        var oImg = Canvas2Image.saveAsJPEG(oCanvas, true);

    if (!oImg) {
        alert("Sorry, this browser is not capable of saving " + strType + " files!");
        return false;
    }

    oImg.id = "canvasimage";

    oImg.style.border = oCanvas.style.border;
    oCanvas.parentNode.replaceChild(oImg, oCanvas);

    showDownloadText();
}

function putImage()
{
    var canvas = document.getElementById("barChart");
    if (canvas.getContext) {
        var ctx = canvas.getContext("2d");
        var myImage = canvas.toDataURL("image/png");
    }
    var imageElement = document.getElementById("MyPix");
    imageElement.src = myImage;
    return myImage;
}

function getCanvasContext() {
    var mycanvas = document.getElementById("barChart");
    var canvas_context = null;
    var x,y = 0;

    if(mycanvas && mycanvas.getContext) {
        canvas_context = mycanvas.getContext("2d");
    }
    else {
        return false;
    }
    return canvas_context;
}
function canvasImgExperiment() {
    canvas_context = getCanvasContext();
    if(canvas_context) {
        canvas_context.fillStyle = "#FFFFFF";
        canvas_context.fillRect(0,0,700,700);
        // draw something
        canvas_context.fillStyle = "#C00000";
        canvas_context.font = "40px arial";
        canvas_context.fillText("This canvas will be exported",100,300);
    }
}
function exportCanvas(){
    var mycanvas = document.getElementById("barChart");
    if(mycanvas && mycanvas.getContext) {
        var img = mycanvas.toDataURL("image/png;base64;");
        //img = img.replace("image/png","image/octet-stream"); // force download, user would have to give the file name.
        // you can also use anchor tag with download attribute to force download the canvas with file name.
        window.open(img,"","width=700,height=700");
    }
    else {
        alert("Can not export");
    }
}
canvasImgExperiment();;// Chart.defaults.global = {
=======
});;// Chart.defaults.global = {
>>>>>>> d054bc23dc830711bf7a32ff901c2a6740c96e07
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

<<<<<<< HEAD

=======
// var data = {
//     labels: ["January", "February", "March", "April", "May", "June", "July"],
//     datasets: [
//         {
//             label: "My First dataset",
//             title: "My First dataset",
//             fillColor: "rgba(220,220,220,0.2)",
//             strokeColor: "rgba(220,220,220,1)",
//             pointColor: "rgba(220,220,220,1)",
//             pointStrokeColor: "#fff",
//             pointHighlightFill: "#fff",
//             pointHighlightStroke: "rgba(220,220,220,1)",
//             data: [65, 59, 80, 81, 56, 55, 40]
//         },
//         {   
//             label: "My Second dataset",
//             title: "My Second dataset",
//             fillColor: "rgba(151,187,205,0.2)",
//             strokeColor: "rgba(151,187,205,1)",
//             pointColor: "rgba(151,187,205,1)",
//             pointStrokeColor: "#fff",
//             pointHighlightFill: "#fff",
//             pointHighlightStroke: "rgba(151,187,205,1)",
//             data: [28, 48, 40, 19, 86, 27, 90]
//         }
//     ]
// };

// var ctx = $("#barChart").get(0).getContext("2d");
// Chart.defaults.global.responsive = true;
// var myLineChart = new Chart(ctx).Bar(data);

// legend(document.getElementById("barLegend"), data);

  
>>>>>>> d054bc23dc830711bf7a32ff901c2a6740c96e07

// <!-- Editar valores grafico   -->
// myLineChart.datasets[0].points[2].value = 150;
// myLineChart.update();