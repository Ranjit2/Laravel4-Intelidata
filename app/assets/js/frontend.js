$(document).ready(function() {
    // GENERAL AJAX ======================================================
    // $(document).ajaxStart(function () {
    //     $('#progressbar').fadeIn('fast');
    //     setTimeout(function(){
    //         $('#progressbar').each(function() {
    //             var perc         = $('#progressbar').attr('aria-valuemax');
    //             var current_perc = 0;
    //             var progress     = setInterval(function () {
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
    //     // /* stuff to do when all AJAX calls have completed */
    //     // // console.log('Triggered ajaxComplete handler. The result is ' + xhr.responseText);
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

    // $(document).ajaxStart(function () {
    //     var config = {
    //         position : 'fixed',
    //         loaderClass : 'loading_bar_body',
    //         debug: false,
    //         speed : 700,
    //         needRelativeParent : false,
    //         hasBackground : true,
    //         backgroundColor : '#34383e',
    //         backgroundOpacity : 1,
    //         zIndex : 99
    //     };
    //     $('body').nimbleLoader('show', config);
    //     return false;
    // });

    // $(document).ajaxStop(function() {
    //     setTimeout(function hideGlobalLoader(){
    //         $('body').nimbleLoader('hide');
    //     }, 2500);
    //     return false;
    // });

    // FUNCTIONS ======================================================
    $('#get').click(function (e) {
        e.preventDefault();
        $.get('/get', function(data) {
            $('.modal-body').append(data);
        });
    });

    $('#mail').click(function (e) {
        e.preventDefault();
        $.get('/mail', function(data) {
            $('.info').hide().find('ul').empty();
            $('.info').find('ul').append('<li>'+data.message+'</li>');
            $('.info').slideDown('fast');
        });
    });

    $('#cerrar').click(function (e) {
        e.preventDefault();
        $('.modal-body').empty();
    });

    $('#post').submit(function (e) {
        e.preventDefault();
        var nombre = $(this).find('input[name=name]').val();
        var edad   = $(this).find('input[name=age]').val();
        $.post('/get', {name:nombre, age:edad}, function(data) {
            console.log('Nombre: ' + data.name);
            console.log('Edad: ' + data.age);
        }, 'json');
    });

    $('#post2').submit(function (e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: '/get2',
            data: $(this).serialize(),
            dataType: '',
            success: function(data) {
                console.log('Datos: ' + data);
            },
            error: function(){
                console.log('error handing here');
            }
        });
    });

    $('#fError').submit(function (e) {
        e.preventDefault();
        var formData = new FormData();
        formData.append('name', $('#name2').val());
        $.ajax({
            type: 'POST',
            url: 'submit',
            processData: false,
            contentType: false,
            cache: false,
            dataType: 'json',
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

    $('#btnEnviar').on('click',function (e) {
        e.preventDefault();
        var idEmpresa = $('#txtEmpresa').val();
        // if(idEmpresa)
        $.post('/graffs'+idEmpresa, function(data) {
            console.log('DATA: ' + data);
            $.each(data, function(index, value) {
                $('#datos').append(value.nombre);
            });
        }, 'json');
    });
});

AmCharts.loadJSON = function (url, method) {
    return JSON.parse($.ajax({type: method, url: url, async: false, cache: false, dataType: 'json' }).responseText);
};

$.barChart = function (div, url, type, method) {
    var url = typeof url !== 'undefined' ? url+'/'+type : '';
};

$.columnChart = function (div, url, type, method) {
    var url   = typeof url !== 'undefined' ? url+'/'+type : '';
    var data  = AmCharts.loadJSON(url, method);
    console.log(data);
    var chart = AmCharts.makeChart(div, data);
};

$.donutChart = function (div, url, type, method) {
    var url   = typeof url !== 'undefined' ? url+'/'+type : '';
    var data  = AmCharts.loadJSON(url, method);
    var chart = AmCharts.makeChart(div,     data);
};

$.lineChart = function (div, url, type, method) {
    var url = typeof url !== 'undefined' ? url+'/'+type : '';
};

$.pieChart = function (div, url, type, method) {
    var url   = typeof url !== 'undefined' ? url+'/'+type : '';
    var data  = AmCharts.loadJSON(url, method);
    var chart = AmCharts.makeChart(div,     data);
};

$.stackbarChart = function (div, url, type, method) {
    var url   = typeof url !== 'undefined' ? url+'/'+type : '';
    var data  = AmCharts.loadJSON(url, method);
    console.log(data);
    // var chart = AmCharts.makeChart(div, data);
};

$.loadChart = function (div, url, type, method) {
    var div    = typeof div !== 'undefined' ? div : '#chartdiv';
    var type   = typeof type !== 'undefined' ? type : '';
    var method = typeof method !== 'undefined' ? method : 'GET';
    switch(type) {
        case 'bar':
        $.barChart(div, url, type, method);
        break;
        case 'column':
        $.columnChart(div, url, type, method);
        break;
        case 'donut':
        $.donutChart(div, url, type, method);
        break;
        case 'line':
        $.lineChart(div, url, type, method);
        break;
        case 'pie':
        $.pieChart(div, url, type, method);
        break;
        case 'stackbar':
        $.stackbarChart(div, url, type, method);
        break;
        default:
        $.donutChart(div, url, type, method);
        break;
    }
};

$('.radioChart').change(function (e) {
    e.preventDefault();
    var type  = $(this).attr('value');
    var chart = $(this).attr('data-chart');
    $.loadChart('chartdiv', '/getChart'+chart+'/111-1', type, 'POST');
});

$.loadChart('chartdiv', '/getChartPie/111-1', 'donut', 'POST');
$.loadChart('chartdiv2', '/getChartSerie/111-1', 'column', 'POST');
