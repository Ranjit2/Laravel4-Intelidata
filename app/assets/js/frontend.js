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

// // FUNCTIONS ======================================================
$('.radioChart').change(function (e) {
    e.preventDefault();
    var type  = $(this).attr('value');
    var chart = $(this).attr('data-chart');
    $.loadChart('chartdiv', '/getChart'+chart+'/111-1', type, 'POST');
});

$.loadChart('chartdiv', '/getChartPie/111-1', 'donut', 'POST');
$.loadChart('chartdiv2', '/getChartSerial/222-2', 'column', 'POST');
$.loadChart('chartdiv3', '/getChartSerial/333-3', 'stackbar', 'POST');

});

AmCharts.loadJSON = function (url, method) {
    return JSON.parse($.ajax({type: method, url: url, async: false, cache: false, dataType: 'json' }).responseText);
};

$.loadChart = function (div, url, type, method) {
    var div    = typeof div !== 'undefined' ? div : '#chartdiv';
    var type   = typeof type !== 'undefined' ? type : '';
    var method = typeof method !== 'undefined' ? method : 'GET';
    var url   = typeof url !== 'undefined' ? url+'/'+type : '';
    var data  = AmCharts.loadJSON(url, method);
    var chart = AmCharts.makeChart(div, data);

};


