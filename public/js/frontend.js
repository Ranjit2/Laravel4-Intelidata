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