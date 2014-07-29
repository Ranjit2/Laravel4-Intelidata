$(document).ready(function() {
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
$.loadChart('chartdiv5', '/getChartSerial/444-4', 'column', '', 'POST');
$.loadChart('chartdiv6', '/getChartSerial/444-4', 'stackbar', '', 'POST');

});

/**
 * [loadJSON description]
 * @param  {[type]} url    [description]
 * @param  {[type]} method [description]
 * @return {[type]}        [description]
 */
AmCharts.loadJSON = function (url, method) {
    return JSON.parse($.ajax({type: method, url: url, async: false, cache: false, dataType: 'json' }).responseText);
};

/**
 * [loadChart description]
 * @param  {[type]} div    [description]
 * @param  {[type]} url    [description]
 * @param  {[type]} type   [description]
 * @param  {[type]} mes    [description]
 * @param  {[type]} method [description]
 * @return {[type]}        [description]
 */
$.loadChart = function (div, url, type, mes, method) {
    var div    = typeof div !== 'undefined' ? div : '#chartdiv';
    var type   = typeof type !== 'undefined' ? type : '';
    var mes    = typeof mes !== 'undefined' ? '/'+mes : '';
    var method = typeof method !== 'undefined' ? method : 'POST';
    var url    = typeof url !== 'undefined' ? url+'/'+type+mes : '';
    var data  = AmCharts.loadJSON(url, method);
    var chart = AmCharts.makeChart(div, data);
};