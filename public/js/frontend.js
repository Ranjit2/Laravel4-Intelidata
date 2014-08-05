
AmCharts.loadJSON = function (url, method) {
    try {
        return JSON.parse($.ajax({type: method, url: url, async: false, cache: false, dataType: 'json' }).responseText);
    } catch(err) {
        console.log('Error: ' + err);
    }
};

$.loadChart = function (div, url, type, mes, method) {
    var div    = typeof div !== 'undefined' ? div : '#chartdiv';
    var type   = typeof type !== 'undefined' && type.length != 0 ? '/'+type : '';
    var mes    = typeof mes !== 'undefined' && mes.length != 0 ? '/'+mes : '';
    var method = typeof method !== 'undefined' ? method : 'POST';
    var url    = typeof url !== 'undefined' ? url+type+mes : '';
    try {
        var data  = AmCharts.loadJSON(url, method);
        AmCharts.ready(function(){
            var chart = AmCharts.makeChart(div, data);
        });
    } catch(err) {
        console.log('Error: ' + err);
    }
};

$.graficoBroken = function (div, url, method) {

    var chart;
    var legend;
    var selected;

    var types = AmCharts.loadJSON(url, method);

    AmCharts.ready(function () {
        // PIE CHART
        chart      = new AmCharts.AmPieChart();
        var legend = new AmCharts.AmLegend();
        legend.valueText = "";
        chart.addLegend(legend, "legenddiv");

<<<<<<< HEAD
chart.dataProvider     = $.generateChartData(types, selected);
chart.titleField       = "<numero></numero>";
chart.valueField       = "percent";
chart.outlineColor     = "#FFFFFF";
chart.outlineAlpha     = 0.8;
chart.outlineThickness = 2;
chart.colorField       = "color";
chart.pulledField      = "pulled";
chart.balloonText      = "<b>$[[percent]] ([[percents]]%)</b>";
chart.labelText        = "[[numero]]";
chart.radius           = "30%";
chart.exportConfig     =  exportConfig;

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
    chart.dataProvider = $.generateChartData(types, selected);

    chart.validateData();
});
=======
        var exportConfig = {
            menuTop: "30px",
            menuBottom: "auto",
            menuRight: "70px",
            backgroundColor: "#efefef",
            menuItems: [{
                textAlign: 'center',
                icon: 'http://www.amcharts.com/lib/3/images/export.png',
                title: 'Bajar',
                items: [{
                    title: 'JPG',
                    format: 'jpg'
                }, {
                    title: 'PNG',
                    format: 'png'
                }, {
                    title: 'SVG',
                    format: 'svg'
                }, {
                    title: 'PDF',
                    format: 'pdf'
                }]
            }]
        };

        chart.dataProvider     = $.generateChartData(types, selected);
        chart.titleField       = "type";
        chart.valueField       = "percent";
        chart.outlineColor     = "#FFFFFF";
        chart.outlineAlpha     = 0.8;
        chart.outlineThickness = 2;
        chart.colorField       = "color";
        chart.pulledField      = "pulled";
        chart.balloonText      = "<b>$[[percent]] ([[percents]]%)</b>";
        chart.labelText        = "[[type]]";
        chart.radius           = "30%";
        chart.exportConfig     =  exportConfig;

        // ADD TITLE
        chart.addTitle("ENERO");

        // AN EVENT TO HANDLE SLICE CLICKS
        chart.addListener("clickSlice", function (event) {
            if (event.dataItem.dataContext.id != undefined) {
                selected = event.dataItem.dataContext.id;  
                // $('#legenddiv').empty();
                // $('#legenddiv').show();
                alert("clickSlice ON");
            }
            else {
                selected = undefined;
                alert("clickSlice OFF");
                // $('#legenddiv').show();
            }
            chart.dataProvider = $.generateChartData(types, selected);
            chart.validateData();
        });
        
        // legend.addListener("clickMarker", function (event) 
        // {
        //      return false;
        // });

        // legend.addListener("clickLabel", function (event) 
        // {
        //      alert('click label on');
        // });

        legend.removeListener(chart, 'clickMarker');
>>>>>>> origin/dev


        // WRITE
        chart.write(div);
    });
}


$.generateChartData = function (types, selected) {
    var chartData = [];
    // $('.lista').empty();
    for (var i = 0; i < types.length; i++) {
        if (i == selected) {
            // $('#legenddiv').hide();
            for (var x = 0; x < types[i].subs.length; x++) {
                chartData.push({
                    type: types[i].subs[x].type,
                    percent: types[i].subs[x].percent,
                    //color: types[i].color,
                    pulled: true
                });
                // $('.lista').append('<li>'+types[i].subs[x].type+':'+types[i].subs[x].percent+'</li>');
            }
        }
        else {
            chartData.push({
                type: types[i].type,
                percent: types[i].percent,
                //color: types[i].color,
                id: i
            });
        }
    }
    return chartData;
}

<<<<<<< HEAD
$.graficoBroken();

var html = "<ul>
    <li>HOLA</li>
</ul>"
$('dasd').on('click', '.selector', function(event) {
    event.preventDefault();
    $('x').html(hmml);

});
=======

>>>>>>> origin/dev
