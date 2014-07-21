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
        //
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
canvasImgExperiment();