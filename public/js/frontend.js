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
});