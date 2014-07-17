var pollChart;
var colors     = Highcharts.getOptions().colors;
var teamsJson  = [{"name":"Team A","voteCount":"98"},{"name":"Team B","voteCount":"32"},  {"name":"Team C ","voteCount":"45"}];
// use underscore to extract the names label
var categories = _.pluck(teamsJson, 'name');
var data       = [];

for(var i = 0, teamJsonLength = teamsJson.length ; i < teamJsonLength ; i++ )
{
    var team = teamsJson[i];
    // alternate colors, then repeat it if exceed the highchart options
    data.push({
        y: parseInt(team.voteCount),
        color: colors[ i % colors.length]
    });
}

pollChart = new Highcharts.Chart({
    chart: {
        renderTo: 'chartContainer',
        type: 'bar' // change this to column if want to show the column chart
    },
    title: {
        text: 'Poll Name Here',
        style:{
            color: '#3E576F',
            fontSize: '23px',
            fontFamily: 'Helvetica Neue,Helvetica,Arial,sans-serif'
        }
    },
    subtitle: {
        text: 'Poll Description here'
    },
    xAxis: {
        categories: categories,
        labels: {
            style: {
                fontSize: '16px',
                fontFamily: 'Helvetica Neue,Helvetica,Arial,sans-serif',
                color: 'black'
            }
        }
    },
    yAxis: {
        title: {
            text: 'Votes',
            style: {
                fontSize: '14px',
                fontFamily: 'Helvetica Neue,Helvetica,Arial,sans-serif',
                color: 'black',
                fontWeight: 'normal'
            }
        }
    },
    legend: {
        enabled: false
    },
    tooltip:{
        enabled: false
    },
    series: [{
        name: 'Vote Count',
        data: data,
        dataLabels: {
            enabled: true,
        }
    }],
    exporting: {
        enabled: false
    }
});

setInterval(function() { getData(); }, 30000);

function getData(){
    console.log("retrieving data from server ");
    var url = "<some server url>";
    $.getJSON (url, function (data) {
        var data = data;
        // update the series data
        pollChart.series[0].setData(data);
    });
}
