$(document).ready(function() {
// GENERAL AJAX ======================================================
$(document).ajaxStart(function () {
    $('#progressbar').fadeIn('fast');
    setTimeout(function(){
        $('#progressbar').each(function() {
            var perc         = $('#progressbar').attr('aria-valuemax');
            var current_perc = 0;
            var progress     = setInterval(function () {
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
    // /* stuff to do when all AJAX calls have completed */
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


// // FUNCTIONS ======================================================
$('.radioChart').change(function (e) {
    e.preventDefault();
    var type  = $(this).attr('value');
    var chart = $(this).attr('data-chart');
    $.loadChart('chartdiv', '/getChart'+chart+'/111-1', type, 'POST');
});

$.loadChart('chartdiv', '/getChartPie/111-1', 'pie', 7, 'POST');
$.loadChart('chartdiv2', '/getChartPie/111-1', 'donut', 6, 'POST');
$.loadChart('chartdiv3', '/getChartPie/111-1', 'pie', 2, 'POST');
$.loadChart('chartdiv4', '/getChartPie/111-1', 'donut', '', 'POST');
$.loadChart('chartdiv5', '/getChartSerial/111-1', 'column', '', 'POST');
$.loadChart('chartdiv6', '/getChartSerial/111-1', 'stackbar', '', 'POST');

});

AmCharts.loadJSON = function (url, method) {
    return JSON.parse($.ajax({type: method, url: url, async: false, cache: false, dataType: 'json' }).responseText);
};

$.loadChart = function (div, url, type, mes, method) {
    var div    = typeof div !== 'undefined' ? div : '#chartdiv';
    var type   = typeof type !== 'undefined' ? type : '';
    var mes    = typeof mes !== 'undefined' ? '/'+mes : '';
    var method = typeof method !== 'undefined' ? method : 'POST';
    var url    = typeof url !== 'undefined' ? url+'/'+type+mes : '';
    var data  = AmCharts.loadJSON(url, method);
    var chart = AmCharts.makeChart(div, data);

};


