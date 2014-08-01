    $(document).ready(function() {
        $.loadChart('chartdiv', '/getChartPie/'+id, 'donut', 7, 'POST');
        $.loadChart('chartdiv2', '/getChartPie/'+id, 'donut', 6, 'POST');
        $.loadChart('chartdiv3', '/getChartPie/'+id, 'donut', 2, 'POST');
        $.loadChart('chartdiv4', '/getChartPie/'+id, 'donut', '', 'POST');
        $.loadChart('chartdiv5', '/getChartSerial/'+id, 'column', '', 'POST');
        $.loadChart('chartdiv6', '/getChartSerial/'+id, 'stackbar', '', 'POST');
        // $.loadChart('chartdiv7', '/getBreakChart/'+id, 'breakchart', '', 'POST');
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

$.breakChart = function(){
     //grafico
     var chart;
     var legend;
     var selected;

     var types = [{
        type: "84465285",
        percent: 50000,
        color: "#ff9e01",
        subs: [
        { type: "servicio1", percent: 25000 },
        { type: "servicio2", percent: 10000 },
        { type: "servicio3", percent: 15000 }
        ]},
        {
            type: "86624454",
            percent: 100000,
            color: "#b0de09",
            subs: [
            { type: "servicio1", percent: 60000 },
            { type: "servicio2", percent: 15000 },
            { type: "servicio3", percent: 25000 }
            ]}
            ];

            function generateChartData () {
                var chartData = [];
                for (var i = 0; i < types.length; i++) {
                    if (i == selected) {
                        for (var x = 0; x < types[i].subs.length; x++) {
                            chartData.push({
                                type: types[i].subs[x].type,
                                percent: types[i].subs[x].percent,
                                color: types[i].color,
                                pulled: true
                            });
                        }
                    }
                    else {
                        chartData.push({
                            type: types[i].type,
                            percent: types[i].percent,
                            color: types[i].color,
                            id: i
                        });
                    }
                }

                return chartData;
            }

            AmCharts.ready(function() {
        // PIE CHART
        chart                  = new AmCharts.AmPieChart();
        chart.dataProvider     = generateChartData();
        chart.titleField       = "type";
        chart.valueField       = "percent";
        chart.outlineColor     = "#FFFFFF";
        chart.outlineAlpha     = 0.8;
        chart.outlineThickness = 2;
        chart.colorField       = "color";
        chart.pulledField      = "pulled";
        chart.type             = "serial";
        chart.balloonText      = "<b>[[percent]]</b>";
        chart.labelText        = "[[type]]";
        chart.radius           = "30%",

        // ADD TITLE
        chart.addTitle("ENERO");

        // AN EVENT TO HANDLE SLICE CLICKS
        chart.addListener("clickSlice", function (event) {
            if (event.dataItem.dataContext.id != undefined) {
                selected = event.dataItem.dataContext.id;
            }
            else {
                selected = undefined;
            }
            chart.dataProvider = generateChartData();
            chart.validateData();
        });

        // WRITE
        chart.write("chartdiv7");
    });
}

$.breakChart();