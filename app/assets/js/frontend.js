$(document).ready(function() {
    $.loadChart('chartdiv', '/getChartPie/'+id, 'pie', 7, 'POST');
    $.loadChart('chartdiv2', '/getChartPie/'+id, 'donut', 6, 'POST');
    $.loadChart('chartdiv3', '/getChartPie/'+id, 'pie', 2, 'POST');
    $.loadChart('chartdiv4', '/getChartPie/'+id, 'donut', '', 'POST');
    $.loadChart('chartdiv5', '/getChartSerial/'+id, 'column', '', 'POST');
    $.loadChart('chartdiv6', '/getChartSerial/'+id, 'stackbar', '', 'POST');
});

/**
 * [loadJSON description]
 * @param  {string} url    [description]
 * @param  {string} method [description]
 * @return {json}          Return json data from database
 */
 AmCharts.loadJSON = function (url, method) {
    try {
        return JSON.parse($.ajax({type: method, url: url, async: false, cache: false, dataType: 'json' }).responseText);
    } catch(err) {
        console.log(err);
    }
};

/**
 * [loadChart description]
 * @param  {string}  div    [description]
 * @param  {string}  url    [description]
 * @param  {string}  type   [description]
 * @param  {integer} mes    [description]
 * @param  {[]}  method     [description]
 * @return {chart}          Return chart
 */
 $.loadChart = function (div, url, type, mes, method) {
    var div    = typeof div !== 'undefined' ? div : '#chartdiv';
    var type   = typeof type !== 'undefined' ? type : '';
    var mes    = typeof mes !== 'undefined' ? '/'+mes : '';
    var method = typeof method !== 'undefined' ? method : 'POST';
    var url    = typeof url !== 'undefined' ? url+'/'+type+mes : '';
    try {
        var data  = AmCharts.loadJSON(url, method);
        AmCharts.ready(function(){
            var chart = AmCharts.makeChart(div, data);
        });
    } catch(err) {
        console.log(err);
    }
};



    