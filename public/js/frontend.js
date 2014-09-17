var url_developer = '';
// var url_developer = '/idata';


$(".sidebar ul.nav li.current").parents('ul.children').addClass("active in");

$('#nav-profile a').click(function (e) {
	e.preventDefault();
	$(this).tab('show');
});
$.porcentaje = function (total, number) {
	a = parseInt(number * 100);
	a = parseInt(a / total);
	return a.toFixed(1);
}

$.progressbar = function (a) {
	var b = 0;
	var c = '';
	if (a > 0 && a < 100) {
		c = '<div class="progress"><div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="' + a + '" aria-valuemin="0" aria-valuemax="100" style="width: ' + a + '%;">' + a + '%</div></div>';
    } else {
		b = a * -1.5;
		c = '<div class="progress"><div class="progress-bar progress-bar-danger progress-bar-striped active" role="progressbar" aria-valuenow="' + b + '" aria-valuemin="0" aria-valuemax="100" style="width: ' + b + '%;">' + a + '%</div></div>';
    };
	return c;
};


$.fn.centerToWindow = function() {
    var obj           = $(this);
    var obj_width     = $(this).outerWidth(true);
    var obj_height    = $(this).outerHeight(true);
    var window_width  = window.innerWidth ? window.innerWidth : $(window).width();
    var window_height = window.innerHeight ? window.innerHeight : $(window).height();

    obj.css({
	    "position": "fixed",
	    "top": ((window_height / 2) - (obj_height / 2)) + "px",
	    "left": ((window_width / 2) - (obj_width / 2)) + "px",
	    "padding": "800px",
	    'z-index': 99999999999999,
	    'background-color': "rgba(0,0,0,0.5)"
    });
}

$.convNumberToMonth = function(n) {
    var months = {1: 'Enero', 2: 'Febrero', 3: 'Marzo', 4: 'Abril', 5: 'Mayo', 6: 'Junio', 7: 'Julio', 8: 'Agosto', 9: 'Septiembre', 10: 'Octubre', 11: 'Noviembre', 12: 'Diciembre', };
    return months[n];
}

$.convMonthToNumber = function(m) {
    m = m.toLowerCase();
    var numbers = {'enero': 1, 'febrero': 2, 'marzo': 3, 'abril': 4, 'mayo': 5, 'junio': 6, 'julio': 7, 'agosto': 8, 'septiembre': 9, 'octubre': 10, 'noviembre': 11, 'diciembre': 12, };
    return numbers[m];
}

$.canvas_show = function (cl){
	cl.setColor('#ffffff'); // default is '#000000'
	cl.setShape('spiral'); // default is 'oval'
	cl.setDiameter(60); // default is 40
	cl.setDensity(50); // default is 40
	cl.setRange(1); // default is 1.3
	cl.setSpeed(1); // default is 2
	cl.setFPS(60); // default is 24
	cl.show();
};;/*!
 * numeral.js
 * version : 1.5.3
 * author : Adam Draper
 * license : MIT
 * http://adamwdraper.github.com/Numeral-js/
 */
(function(){function a(a){this._value=a}function b(a,b,c,d){var e,f,g=Math.pow(10,b);return f=(c(a*g)/g).toFixed(b),d&&(e=new RegExp("0{1,"+d+"}$"),f=f.replace(e,"")),f}function c(a,b,c){var d;return d=b.indexOf("$")>-1?e(a,b,c):b.indexOf("%")>-1?f(a,b,c):b.indexOf(":")>-1?g(a,b):i(a._value,b,c)}function d(a,b){var c,d,e,f,g,i=b,j=["KB","MB","GB","TB","PB","EB","ZB","YB"],k=!1;if(b.indexOf(":")>-1)a._value=h(b);else if(b===q)a._value=0;else{for("."!==o[p].delimiters.decimal&&(b=b.replace(/\./g,"").replace(o[p].delimiters.decimal,".")),c=new RegExp("[^a-zA-Z]"+o[p].abbreviations.thousand+"(?:\\)|(\\"+o[p].currency.symbol+")?(?:\\))?)?$"),d=new RegExp("[^a-zA-Z]"+o[p].abbreviations.million+"(?:\\)|(\\"+o[p].currency.symbol+")?(?:\\))?)?$"),e=new RegExp("[^a-zA-Z]"+o[p].abbreviations.billion+"(?:\\)|(\\"+o[p].currency.symbol+")?(?:\\))?)?$"),f=new RegExp("[^a-zA-Z]"+o[p].abbreviations.trillion+"(?:\\)|(\\"+o[p].currency.symbol+")?(?:\\))?)?$"),g=0;g<=j.length&&!(k=b.indexOf(j[g])>-1?Math.pow(1024,g+1):!1);g++);a._value=(k?k:1)*(i.match(c)?Math.pow(10,3):1)*(i.match(d)?Math.pow(10,6):1)*(i.match(e)?Math.pow(10,9):1)*(i.match(f)?Math.pow(10,12):1)*(b.indexOf("%")>-1?.01:1)*((b.split("-").length+Math.min(b.split("(").length-1,b.split(")").length-1))%2?1:-1)*Number(b.replace(/[^0-9\.]+/g,"")),a._value=k?Math.ceil(a._value):a._value}return a._value}function e(a,b,c){var d,e,f=b.indexOf("$"),g=b.indexOf("("),h=b.indexOf("-"),j="";return b.indexOf(" $")>-1?(j=" ",b=b.replace(" $","")):b.indexOf("$ ")>-1?(j=" ",b=b.replace("$ ","")):b=b.replace("$",""),e=i(a._value,b,c),1>=f?e.indexOf("(")>-1||e.indexOf("-")>-1?(e=e.split(""),d=1,(g>f||h>f)&&(d=0),e.splice(d,0,o[p].currency.symbol+j),e=e.join("")):e=o[p].currency.symbol+j+e:e.indexOf(")")>-1?(e=e.split(""),e.splice(-1,0,j+o[p].currency.symbol),e=e.join("")):e=e+j+o[p].currency.symbol,e}function f(a,b,c){var d,e="",f=100*a._value;return b.indexOf(" %")>-1?(e=" ",b=b.replace(" %","")):b=b.replace("%",""),d=i(f,b,c),d.indexOf(")")>-1?(d=d.split(""),d.splice(-1,0,e+"%"),d=d.join("")):d=d+e+"%",d}function g(a){var b=Math.floor(a._value/60/60),c=Math.floor((a._value-60*b*60)/60),d=Math.round(a._value-60*b*60-60*c);return b+":"+(10>c?"0"+c:c)+":"+(10>d?"0"+d:d)}function h(a){var b=a.split(":"),c=0;return 3===b.length?(c+=60*Number(b[0])*60,c+=60*Number(b[1]),c+=Number(b[2])):2===b.length&&(c+=60*Number(b[0]),c+=Number(b[1])),Number(c)}function i(a,c,d){var e,f,g,h,i,j,k=!1,l=!1,m=!1,n="",r=!1,s=!1,t=!1,u=!1,v=!1,w="",x="",y=Math.abs(a),z=["B","KB","MB","GB","TB","PB","EB","ZB","YB"],A="",B=!1;if(0===a&&null!==q)return q;if(c.indexOf("(")>-1?(k=!0,c=c.slice(1,-1)):c.indexOf("+")>-1&&(l=!0,c=c.replace(/\+/g,"")),c.indexOf("a")>-1&&(r=c.indexOf("aK")>=0,s=c.indexOf("aM")>=0,t=c.indexOf("aB")>=0,u=c.indexOf("aT")>=0,v=r||s||t||u,c.indexOf(" a")>-1?(n=" ",c=c.replace(" a","")):c=c.replace("a",""),y>=Math.pow(10,12)&&!v||u?(n+=o[p].abbreviations.trillion,a/=Math.pow(10,12)):y<Math.pow(10,12)&&y>=Math.pow(10,9)&&!v||t?(n+=o[p].abbreviations.billion,a/=Math.pow(10,9)):y<Math.pow(10,9)&&y>=Math.pow(10,6)&&!v||s?(n+=o[p].abbreviations.million,a/=Math.pow(10,6)):(y<Math.pow(10,6)&&y>=Math.pow(10,3)&&!v||r)&&(n+=o[p].abbreviations.thousand,a/=Math.pow(10,3))),c.indexOf("b")>-1)for(c.indexOf(" b")>-1?(w=" ",c=c.replace(" b","")):c=c.replace("b",""),g=0;g<=z.length;g++)if(e=Math.pow(1024,g),f=Math.pow(1024,g+1),a>=e&&f>a){w+=z[g],e>0&&(a/=e);break}return c.indexOf("o")>-1&&(c.indexOf(" o")>-1?(x=" ",c=c.replace(" o","")):c=c.replace("o",""),x+=o[p].ordinal(a)),c.indexOf("[.]")>-1&&(m=!0,c=c.replace("[.]",".")),h=a.toString().split(".")[0],i=c.split(".")[1],j=c.indexOf(","),i?(i.indexOf("[")>-1?(i=i.replace("]",""),i=i.split("["),A=b(a,i[0].length+i[1].length,d,i[1].length)):A=b(a,i.length,d),h=A.split(".")[0],A=A.split(".")[1].length?o[p].delimiters.decimal+A.split(".")[1]:"",m&&0===Number(A.slice(1))&&(A="")):h=b(a,null,d),h.indexOf("-")>-1&&(h=h.slice(1),B=!0),j>-1&&(h=h.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g,"$1"+o[p].delimiters.thousands)),0===c.indexOf(".")&&(h=""),(k&&B?"(":"")+(!k&&B?"-":"")+(!B&&l?"+":"")+h+A+(x?x:"")+(n?n:"")+(w?w:"")+(k&&B?")":"")}function j(a,b){o[a]=b}function k(a){var b=a.toString().split(".");return b.length<2?1:Math.pow(10,b[1].length)}function l(){var a=Array.prototype.slice.call(arguments);return a.reduce(function(a,b){var c=k(a),d=k(b);return c>d?c:d},-1/0)}var m,n="1.5.3",o={},p="en",q=null,r="0,0",s="undefined"!=typeof module&&module.exports;m=function(b){return m.isNumeral(b)?b=b.value():0===b||"undefined"==typeof b?b=0:Number(b)||(b=m.fn.unformat(b)),new a(Number(b))},m.version=n,m.isNumeral=function(b){return b instanceof a},m.language=function(a,b){if(!a)return p;if(a&&!b){if(!o[a])throw new Error("Unknown language : "+a);p=a}return(b||!o[a])&&j(a,b),m},m.languageData=function(a){if(!a)return o[p];if(!o[a])throw new Error("Unknown language : "+a);return o[a]},m.language("en",{delimiters:{thousands:",",decimal:"."},abbreviations:{thousand:"k",million:"m",billion:"b",trillion:"t"},ordinal:function(a){var b=a%10;return 1===~~(a%100/10)?"th":1===b?"st":2===b?"nd":3===b?"rd":"th"},currency:{symbol:"$"}}),m.zeroFormat=function(a){q="string"==typeof a?a:null},m.defaultFormat=function(a){r="string"==typeof a?a:"0.0"},"function"!=typeof Array.prototype.reduce&&(Array.prototype.reduce=function(a,b){"use strict";if(null===this||"undefined"==typeof this)throw new TypeError("Array.prototype.reduce called on null or undefined");if("function"!=typeof a)throw new TypeError(a+" is not a function");var c,d,e=this.length>>>0,f=!1;for(1<arguments.length&&(d=b,f=!0),c=0;e>c;++c)this.hasOwnProperty(c)&&(f?d=a(d,this[c],c,this):(d=this[c],f=!0));if(!f)throw new TypeError("Reduce of empty array with no initial value");return d}),m.fn=a.prototype={clone:function(){return m(this)},format:function(a,b){return c(this,a?a:r,void 0!==b?b:Math.round)},unformat:function(a){return"[object Number]"===Object.prototype.toString.call(a)?a:d(this,a?a:r)},value:function(){return this._value},valueOf:function(){return this._value},set:function(a){return this._value=Number(a),this},add:function(a){function b(a,b){return a+c*b}var c=l.call(null,this._value,a);return this._value=[this._value,a].reduce(b,0)/c,this},subtract:function(a){function b(a,b){return a-c*b}var c=l.call(null,this._value,a);return this._value=[a].reduce(b,this._value*c)/c,this},multiply:function(a){function b(a,b){var c=l(a,b);return a*c*b*c/(c*c)}return this._value=[this._value,a].reduce(b,1),this},divide:function(a){function b(a,b){var c=l(a,b);return a*c/(b*c)}return this._value=[this._value,a].reduce(b),this},difference:function(a){return Math.abs(m(this._value).subtract(a).value())}},s&&(module.exports=m),"undefined"==typeof ender&&(this.numeral=m),"function"==typeof define&&define.amd&&define([],function(){return m})}).call(this);;var canvas = new CanvasLoader('animation_image');

$(window).resize(function () {
	$('.animation_image').centerToWindow();
	if ('matchMedia' in window) {
		// Chrome, Firefox, and IE 10 support mediaMatch listeners
		window.matchMedia('print').addListener(function (media) {
			chart.validateNow();
		});
	} else {
		// IE and Firefox fire before/after events
		window.onbeforeprint = function () {
			chart.validateNow();
		}
	}
});

// LOAD DATA FROM GRAFFCONTROLLER
$.loadJSON = function (url) {
	try {
		var request = $.ajax({
			url: url_developer + url,
			type: "POST",
			async: false,
			cache: false,
			dataType: 'json',
		});
		request.done(function () {
			//console.log("success");
		});
		request.fail(function () {
			console.log("Error:\n" + JSON.stringify(jqXHR) + '\n' + textStatus + ': ' + errorThrown + '\n');
		});
		request.always(function () {
			//console.log("complete");
		});
		request.error(function (jqXHR, exception) {
			if (jqXHR.status === 0) {
				console.log('Not connect.n Verify Network.');
			} else if (jqXHR.status == 404) {
				console.log('Requested page not found. [404]');
			} else if (jqXHR.status == 500) {
				console.log('Internal Server Error [500].');
			} else if (exception === 'parsererror') {
				console.log('Requested JSON parse failed.');
			} else if (exception === 'timeout') {
				console.log('Time out error.');
			} else if (exception === 'abort') {
				console.log('Ajax request aborted.');
			} else {
				console.log('Uncaught Error.n' + jqXHR.responseText);
			}
			$('.animation_image').hide();
		});
// RETURN DATA
		return request.responseJSON;
	} catch (err) {
		console.log('Error:\n' + err);
		$('.animation_image').hide();
	}
};

// LOAD DIFERENTS CHARTS
$.loadChart = function (div, url, type, date) {
	$.canvas_show(canvas);
	$('.animation_image').centerToWindow();
	$('.animation_image').show();
// DIV ID
	var div = typeof div !== 'undefined' ? div : 'chartdiv';
// DATE OF DATA
	var date = typeof date !== 'undefined' && date.length != 0 ? '/' + date : '';
// TYPE OF CHART
	var type = typeof type !== 'undefined' && type.length != 0 ? type : 'column';
// URL TO GET DATA
	var url = typeof url !== 'undefined' ? url + date : '';
// JSON VAR
	var json = $.loadJSON(url);
	json = typeof json !== 'undefined' || json.length != 0 ? json : 'NULL';
// console.log(json);
// READY CHART
	try {
// GET DATA
		if (json.length < 1 || json == 'NULL') {
			//console.log("No hay datos disponibles.");
			$('#error').show();
			$('#' + div).hide();
			return false;
		} else {
			//console.log("JSON correcto");
			$('#error').hide();
			$('#' + div).show();
			// SWITCH CHART DEPENDS VAR "TYPE"
			switch (type) {
				// BREAK CHART
				case 'broken':
					$.broken(div, json);
					break;
				// COLUMN CHART
				case 'column':
					$.column(div, json);
					break;

				// COMPARATIVE CHART
				case 'comparative':
					$.comparative(div, json);
					break;

				// DONUT CHART
				case 'donut':
					$.donut(div, json);
					break;

				// EVOLUTION CHART
				case 'evolution':
					$.evolution(div, json);
					break;

				// LINE CHART
				case 'line':
					$.line(div, json);
					break;

				// PIE CHART
				case 'pie':
					$.pie(div, json);
					break;

				// SMOOTHLINE CHART
				case 'smoothline':
					$.smoothline(div, json);
					break;

				case 'stackbar':
					$.stackbar(div, json);
					break;

				case 'historicoCategoria':
					$.historicoCategoria(div, json);
					break;

				case 'telefonosPorProducto':
					$.telefonosPorProducto(div, json);
					break;

				case 'grafHistoricoMes':
					$.historicoMes(div, json);
					break;
			}
			;
		}
		$('.animation_image').hide();
	} catch (err) {
		// SHOW ERRORS
		console.log('Error:\n' + err);
		$('.animation_image').hide();
	}
};

var chart;
// COLUMN CHART
$.column = function (div, json) {
// INIT
	chart = new AmCharts.AmSerialChart();
	var chartScrollbar = new AmCharts.ChartScrollbar();
	chart.addChartScrollbar(chartScrollbar);
	chart.dataProvider = json.data;
	chart.graphs = json.graphs;
	chart.gridAboveGraphs = true;
	chart.pathToImages = "http://www.amcharts.com/lib/3/images/";
	chart.categoryField = "fecha";
	chart.language = "es";
	chart.numberFormatter = $.formatNumber();

// DATE
	chart.dataDateFormat = "YYYY-MM-DD HH:NN";

// ANIMATION
	$.animation(chart, false);

// MARGIN
	$.margin(chart);

// AXIS X
	$.categoryAxis(chart);

// VALUE AXIS X
	var valueAxis = new AmCharts.ValueAxis();
	valueAxis.dashLength = 1;
	valueAxis.axisColor = "#DADADA";
	valueAxis.axisAlpha = 1;
	valueAxis.unit = "$";
	valueAxis.unitPosition = "left";
	chart.addValueAxis(valueAxis);

// LEGEND
	$.legend(chart);

// CURSOR
// var chartCursor              = new AmCharts.ChartCursor();
// chart.addChartCursor(chartCursor);

// EXPORT
	chart.exportConfig = $.export();

// WRITE
	chart.write(div);
};


$.historicoMes = function (div, json) {

// INIT
	chart = new AmCharts.AmSerialChart();
	var chartScrollbar = new AmCharts.ChartScrollbar();
	chart.addChartScrollbar(chartScrollbar);

	chart.dataProvider = json.data;
	chart.graphs = json.graphs;
	chart.gridAboveGraphs = true;
	chart.pathToImages = "http://www.amcharts.com/lib/3/images/";
	chart.categoryField = "fecha";
	chart.language = "es";
	chart.numberFormatter = $.formatNumber();

// DATE
	chart.dataDateFormat = "YYYY-MM-DD HH:NN";

// ANIMATION
	$.animation(chart, false);

// MARGIN
	$.margin(chart);

// AXIS X
	$.categoryAxis(chart);

// VALUE AXIS X
	var valueAxis = new AmCharts.ValueAxis();
	valueAxis.dashLength = 1;
	valueAxis.axisColor = "#DADADA";
	valueAxis.axisAlpha = 1;
	valueAxis.unit = "$";
	valueAxis.unitPosition = "left";
	chart.addValueAxis(valueAxis);

// LEGEND
	$.legend(chart);


// CURSORS
// var chartCursor                    = new AmCharts.ChartCursor();
// chartCursor.categoryBalloonEnabled = true;
// chartCursor.cursorAlpha            = 0;
// chartCursor.zoomable               = true;
// chart.addChartCursor(chartCursor);

// EXPORT
	chart.exportConfig = $.export();

// WRITE
	chart.write(div);
};

$.historicoCategoria = function (div, json) {

// INIT
	chart = new AmCharts.AmPieChart();
	chart.dataProvider = json.data;
	chart.titleField = "nombre";
	chart.valueField = "cantidad";
	chart.outlineColor = "#FFFFFF";
	chart.outlineAlpha = 0.8;
	chart.outlineThickness = 2;
	chart.labelText = "[[nombre]]";
	chart.balloonTex = "[[title]]<br><span style='font-size:11px'><b>[[value]]</b> ([[percents]]%)</span>";
	chart.pathToImages = "http://www.amcharts.com/lib/3/images/";
	chart.categoryField = "nombre";
	chart.radius = "35%";
	chart.language = "es";
	chart.numberFormatter = $.formatNumber();

// DATE
	chart.dataDateFormat = "YYYY-MM-DD HH:NN";

// ANIMATION
	$.animation(chart, false);

// LEGEND
	$.legend(chart);

// EXPORT
	chart.exportConfig = $.export();

// WRITE
	chart.write(div);
};

// STACK CHART
$.stackbar = function (div, json) {

// INIT
	chart = new AmCharts.AmSerialChart();
	chart.dataProvider = json.data;
	chart.graphs = json.graphs;
	chart.gridAboveGraphs = true;
	chart.pathToImages = "http://www.amcharts.com/lib/3/images/";
	chart.categoryField = "fecha";
	chart.language = "es";
	chart.numberFormatter = $.formatNumber();

// DATE
	chart.dataDateFormat = "YYYY-MM-DD HH:NN";

// ANIMATION
	$.animation(chart, false);

// MARGIN
	$.margin(chart);

// AXIS X
	$.categoryAxis(chart);

// VALUE AXIS X
	var valueAxis = new AmCharts.ValueAxis();
	valueAxis.dashLength = 1;
	valueAxis.axisColor = "#DADADA";
	valueAxis.axisAlpha = 1;
	valueAxis.unit = "$";
	valueAxis.unitPosition = "left";
	valueAxis.stackType = "regular";
	chart.addValueAxis(valueAxis);

// LEGEND
	$.legend(chart);

// CURSOR
// var chartCursor              = new AmCharts.ChartCursor();
// chart.addChartCursor(chartCursor);

// EXPORT
	chart.exportConfig = $.export();

// WRITE
	chart.write(div);
};

// DONUT CHART
$.donut = function (div, json) {

// INIT
	chart = new AmCharts.AmPieChart();
	chart.dataProvider = json.data;
	chart.titleField = "mes";
	chart.valueField = "monto";
	chart.outlineColor = "#FFFFFF";
	chart.outlineAlpha = 0.8;
	chart.outlineThickness = 2;
	chart.labelText = "[[numero]]";
	chart.balloonTex = "[[title]]<br><span style='font-size:11px'><b>[[value]]</b> ([[percents]]%)</span>";
	chart.pathToImages = "http://www.amcharts.com/lib/3/images/";
	chart.categoryField = "fecha";
	chart.language = "es";
	chart.numberFormatter = $.formatNumber();

// EXTRAS
	chart.labelRadius = 5;
	chart.radius = "35%";
	chart.innerRadius = "60%";

// DATE
	chart.dataDateFormat = "YYYY-MM-DD HH:NN";

// ANIMATION
	$.animation(chart, false);

// LEGEND
	$.legend(chart);

// CURSOR
// var chartCursor              = new AmCharts.ChartCursor();
// chart.addChartCursor(chartCursor);

// EXPORT
	chart.exportConfig = $.export();

// WRITE
	chart.write(div);
};

// COMPARATIVE CHART
$.comparative = function (div, json) {

// INIT
	chart = new AmCharts.AmSerialChart();
	chart.dataProvider = json.data;
	chart.pathToImages = "http://www.amcharts.com/lib/3/images/";
	chart.categoryField = "date";
	chart.language = "es";
	chart.numberFormatter = $.formatNumber();

// DATE
	chart.dataDateFormat = "YYYY-MM-DD HH:NN";

// AXIS X
	$.categoryAxis(chart, false);

// VALUE AXIS X
	var valueAxis = new AmCharts.ValueAxis();
	valueAxis.dashLength = 1;
	valueAxis.axisColor = "#DADADA";
	valueAxis.axisAlpha = 1;
	valueAxis.unit = "$";
	valueAxis.unitPosition = "left";
	chart.addValueAxis(valueAxis);

// ANIMATION
	$.animation(chart, false);

// LEGEND
	$.legend(chart);

// GRAPH 1
	var graph = new AmCharts.AmGraph();
	graph.title = json.years[0];
	graph.balloonText = "<strong>[[date]] - [[year1]]</strong> <br>Monto: $[[value]]";
	graph.type = "line";
	graph.valueField = "val1";
	graph.lineColor = "#60c6cf";
	graph.lineThickness = 3;
	graph.bullet = "round";
	graph.bulletColor = "#60c6cf";
	graph.bulletBorderColor = "#ffffff";
	graph.bulletBorderAlpha = 1;
	graph.bulletBorderThickness = 3;
	graph.bulletSize = 15;
	chart.addGraph(graph);

// GRAPH 2
	var graph1 = new AmCharts.AmGraph();
	graph1.title = json.years[1];
	graph1.balloonText = "<strong>[[date]] - [[year2]]</strong> <br>Monto: $[[value]]";
	graph1.type = "line";
	graph1.valueField = "val2";
	graph1.lineColor = "#f35958";
	graph1.lineThickness = 3;
	graph1.bullet = "round";
	graph1.bulletColor = "#f35958";
	graph1.bulletBorderColor = "#ffffff";
	graph1.bulletBorderAlpha = 1;
	graph1.bulletBorderThickness = 3;
	graph1.bulletSize = 12;
	chart.addGraph(graph1);

// GRAPH 3
	var graph2 = new AmCharts.AmGraph();
	graph2.title = json.years[2];
	graph2.balloonText = "<strong>[[date]] - [[year3]]</strong> <br>Monto: $[[value]]";
	graph2.type = "line";
	graph2.valueField = "val3";
	graph2.lineThickness = 3;
	graph2.bullet = "round";
	graph2.bulletBorderColor = "#ffffff";
	graph2.bulletBorderAlpha = 1;
	graph2.bulletBorderThickness = 3;
	graph2.bulletSize = 12;
	chart.addGraph(graph2);

// EXPORT
	chart.exportConfig = $.export();

// CURSOR
	var chartCursor = new AmCharts.ChartCursor();
	chart.addChartCursor(chartCursor);

// WRITE
	chart.write(div);

	$.generateTable(json);
};

// EVOLUTION CHART
$.evolution = function (div, json) {

// INIT
	chart = new AmCharts.AmSerialChart();
	chart.dataProvider = json.data;
	chart.pathToImages = "http://www.amcharts.com/lib/3/images/";
	chart.categoryField = "fecha";
	chart.language = "es";
	chart.numberFormatter = $.formatNumber();

// DATE
	chart.dataDateFormat = "YYYY-MM-DD HH:NN";

// AXIS X
	$.categoryAxis(chart);

// VALUE AXIS X
	var valueAxis = new AmCharts.ValueAxis();
	valueAxis.dashLength = 1;
	valueAxis.axisColor = "#DADADA";
	valueAxis.axisAlpha = 1;
	valueAxis.unit = "$";
	valueAxis.unitPosition = "left";
	chart.addValueAxis(valueAxis);

// ANIMATION
	$.animation(chart, false);

// LEGEND
	$.legend(chart);

// GRAPH
	var graph = new AmCharts.AmGraph();
	graph.title = "";
	graph.balloonText = "[[category]]<br><b><span style='font-size:14px;'>$ [[value]]</span></b>";
	graph.type = "line";
	graph.valueField = "value";
	graph.lineColor = "#60c6cf";
	graph.lineThickness = 3;
	graph.bullet = "round";
	graph.bulletColor = "#60c6cf";
	graph.bulletBorderColor = "#ffffff";
	graph.bulletBorderAlpha = 1;
	graph.bulletBorderThickness = 3;
	graph.bulletSize = 12;
	chart.addGraph(graph);

// EXPORT
	chart.exportConfig = $.export();

// CURSOR
	var chartCursor = new AmCharts.ChartCursor();
	categoryBalloonDateFormat = 'MMM, YYYY '
	chart.addChartCursor(chartCursor);

// WRITE
	chart.write(div);
};

// PIE CHART
$.pie = function (div, json) {
// INIT
	chart = new AmCharts.AmPieChart();
	chart.dataProvider = json.data;
	chart.titleField = "mes";
	chart.valueField = "monto";
	chart.outlineColor = "#FFFFFF";
	chart.outlineAlpha = 0.8;
	chart.outlineThickness = 2;
	chart.labelText = "[[numero]]";
	chart.balloonTex = "[[title]]<br><span style='font-size:11px'><b>[[value]]</b> ([[percents]]%)</span>";
	chart.pathToImages = "http://www.amcharts.com/lib/3/images/";
	chart.categoryField = "fecha";
	chart.language = "es";
	chart.numberFormatter = $.formatNumber();

// DATE
	chart.dataDateFormat = "YYYY-MM-DD HH:NN";

// ANIMATION
	$.animation(chart, false);

// LEGEND
	$.legend(chart);

// EXPORT
	chart.exportConfig = $.export();

// WRITE
	chart.write(div);
};

$.telefonosPorProducto = function (div, json) {

// INIT
	chart = new AmCharts.AmPieChart();
	chart.dataProvider = json.data;
	chart.titleField = "numero" // "nombre";
	chart.valueField = "monto" // "cantidad";
	chart.outlineColor = "#FFFFFF";
	chart.outlineAlpha = 0.8;
	chart.outlineThickness = 2;
	chart.labelText = "[[numero]]" // "[[nombre]]";
	chart.balloonTex = "[[title]]<br><span style='font-size:11px'><b>[[value]]</b> ([[percents]]%)</span>";
	chart.pathToImages = "http://www.amcharts.com/lib/3/images/";
	chart.categoryField = "numero" //"nombre";
	chart.radius = "35%";
	chart.language = "es";
	chart.numberFormatter = $.formatNumber();

// DATE
	chart.dataDateFormat = "YYYY-MM-DD HH:NN";

// ANIMATION
	$.animation(chart, false);

// LEGEND
	$.legend(chart);

// EXPORT
	chart.exportConfig = $.export();

// WRITE
	chart.write(div);
};

// BROKEN CHART
$.broken = function (div, json) {
	var selected;
	var number;
	var types = json.data;

// INIT
	chart = new AmCharts.AmPieChart();
	chart.dataProvider = $.generateChartData(types, selected);
	chart.titleField = "type";
	chart.valueField = "percent";
	chart.outlineColor = "#FFFFFF";
	chart.outlineAlpha = 0.8;
	chart.outlineThickness = 0.5;
	chart.colorField = "color";
	chart.pulledField = "pulled";
	chart.balloonText = "<b>$[[percent]] ([[percents]]%)</b>";
	chart.labelText = "[[type]]";
	chart.radius = "35%";
	chart.depth3D = 0;
	chart.groupedPulled = true;

// DATE
	chart.dataDateFormat = "YYYY-MM-DD HH:NN";

// ANIMATION
	$.animation(chart, false);

// EXPORT
	chart.exportConfig = $.export();

// LEGEND
	$.legend(chart, 'legenddiv', 'Producto: [[title]]');

// LISTENERS
	chart.addListener("clickSlice", function (event) {
		$('#lista').parent().find("h4").empty()
		if (event.dataItem.dataContext.id != undefined) {
			number = event.dataItem.dataContext.type;
			selected = event.dataItem.dataContext.id;
		}
		else {
			number = '';
			selected = undefined;
			$('#legenddiv').show();
		}
		chart.dataProvider = $.generateChartData(types, selected, number);
		chart.validateData();
	});

// WRITE
	chart.write(div);
};

// GENERATE DATA TO BROKEN CHART
$.generateChartData = function (types, selected, number) {
	$('#lista').hide();
	$('#lista tbody').empty();
	$('#lista tfoot').empty();
	var chartData = [];
	var total = 0;
	var porcent = 0;
	for (var i = 0; i < types.length; i++) {
		if (types[i].subs.length > 0 && i == selected) {
			$('#legenddiv').hide();
			$('#lista').show();
			for (var x = 0; x < types[i].subs.length; x++) {
				chartData.push({
					type: types[i].subs[x].type,
					percent: types[i].subs[x].percent,
					pulled: true
				});
				total += parseInt(types[i].subs[x].percent);
			}
			for (var x = 0; x < types[i].subs.length; x++) {
				porcent = $.porcentaje(total, types[i].subs[x].percent, 1, ',', '.');
				if (types[i].subs[x].percent < 0) {
					$('#lista tbody').append('<tr class="danger">' +
					'<td class="col-md-5">' + types[i].subs[x].type + '</td>' +
					'<td class="col-md-4">' + $.progressbar(porcent) + '</td>' +
					'<td class="col-md-2 text-right">- $' + types[i].subs[x].percent * -1 + '</td>' +
					'</tr>');
				} else {
					$('#lista tbody').append('<tr>' +
					'<td class="col-md-5">' + types[i].subs[x].type + '</td>' +
					'<td class="col-md-4">' + $.progressbar(porcent) + '</td>' +
					'<td class="col-md-2 text-right">$' + types[i].subs[x].percent + '</td>' +
					'</tr>');
				}
			}
			;
			$('#lista').parent().prepend('<h4><strong>Detalle N° ' + number + '</strong></h4>');
			$('#lista').append('<tfoot><tr class="info" style="font-weight: bold;">' + '<td class="col-md-5">TOTAL</td><td class="col-md-4"></td><td class="col-md-2 text-right">$' + total + '</td>' + '</tr></tfoot>');
		} else {
			chartData.push({
				type: types[i].type,
				percent: types[i].percent,
				id: i
			});
		}
	}
	return chartData;
};

$.animation = function (chart, bool) {
	if (bool) {
		chart.sequencedAnimation = true;
		chart.startDuration = 5;
		chart.startAlpha = 10;
	} else {
		chart.sequencedAnimation = false;
		chart.startDuration = 0;
		chart.startAlpha = 0;
	}
}

$.export = function () {
	var exportConfig = {
		menuTop: "0px",
		menuBottom: "0px",
		menuRight: "0px",
		backgroundColor: "#efefef",
		menuItems: [{
			textAlign: 'center',
			icon: 'http://www.amcharts.com/lib/3/images/export.png',
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
		}],
	};
//return exportConfig;
};

$(".buttonExport").click(function () {
	var exp = new AmCharts.AmExport(chart);
	var output = "pdf";
	var id = this.id;
	switch (id) {
		case ('btnPDF'):
			output = 'pdf';
			break;
		case ('btnJPG'):
			output = 'jpg';
			break;
		case ('btnPNG'):
			output = 'png';
			break;
	}
	exp.init();
	exp.output({
		format: output,
		output: 'save'
	});
});


$.legend = function (chart, legenddiv, text) {
	legenddiv = typeof legenddiv !== 'undefined' && legenddiv.length != 0 ? legenddiv : false;
	text = typeof text !== 'undefined' && text.length != 0 ? text : false;

	var legend = new AmCharts.AmLegend();
	legend.align = "center";
	legend.markerType = "circle";
	legend.valueText = "";
	legend.useGraphSettings = false;
	if (!text) {
		legend.labelText = "[[title]]";
	} else {
		legend.labelText = text;
	}
	;
	if (!legenddiv) {
		chart.addLegend(legend);
	} else {
		chart.addLegend(legend, legenddiv);
	}
};

$.margin = function (chart) {
	chart.autoMargins = false;
	chart.marginRight = 10;
	chart.marginLeft = 80;
	chart.marginBottom = 20;
	chart.marginTop = 20;
};

$.formatNumber = function () {
	var formatNumber = {
		decimalSeparator: ",",
		thousandsSeparator: ".",
		precision: -1,
	};
	return formatNumber;
};

$.categoryAxis = function (chart, parse) {
	parse = typeof parse !== 'undefined' && parse.length != 0 ? parse : true;
	var categoryAxis = chart.categoryAxis;
	categoryAxis.inside = false;
	categoryAxis.axisAlpha = 0;
	categoryAxis.gridAlpha = 0;
	categoryAxis.tickLength = 0;
	categoryAxis.minPeriod = "MM";
	// categoryAxis.equalSpacing = false;
	categoryAxis.equalSpacing = true;
	categoryAxis.boldPeriodBeginning = true;
	if (parse) {
		categoryAxis.parseDates = true;
		categoryAxis.dateFormats = [{
			period: 'fff',
			format: 'JJ:NN:SS'
		}, {
			period: 'ss',
			format: 'JJ:NN:SS'
		}, {
			period: 'mm',
			format: 'JJ:NN'
		}, {
			period: 'hh',
			format: 'JJ:NN'
		}, {
			period: 'DD',
			format: 'MMM DD'
		}, {
			period: 'WW',
			format: 'MMM DD'
		}, {
			period: 'MM',
			format: 'MMM YYYY'
		}, {
			period: 'YYYY',
			format: 'MMM YYYY'
		}];
	}
	;
};

$.generateTable = function (json) {
	$('.animation_image').show();
	var date;
	numeral.defaultFormat('$0,0');
	var val2 = numeral();
	var val3 = numeral();
	var variation;
	var resta;
	$.each(json.data, function (key, value) {
		date = value['date-full'];
		val2 = typeof value['val2'] !== 'undefined' && value['val2'].length != 0 ? val2.set(value['val2']) : val2.set(0);
		val3 = typeof value['val3'] !== 'undefined' && value['val3'].length != 0 ? val3.set(value['val3']) : val3.set(0);
		if (val2.value() != 0 && val3.value() != 0) {
			resta = parseInt(val3.value() - val2.value());
			if (resta < 0) {
				resta = parseInt(-1 * resta);
			}
			variation = Math.ceil((resta * 100) / val2.value());
		}
		else {
			variation = 100;
		}
		if (val2.value() > val3.value()) {
			$('#statics tbody').append('<tr>' +
			'<td>' + date + '</td>' +
			'<td>' + val2.format() + '</td>' +
			'<td>' + val3.format() + '</td>' +
			'<td><i class="fa fa-arrow-down fa-fw arrow-down"></i> ' + variation + '%</td>' +
			'</tr>');
		} else {
			$('#statics tbody').append('<tr>' +
			'<td>' + date + '</td>' +
			'<td>' + val2.format() + '</td>' +
			'<td>' + val3.format() + '</td>' +
			'<td><i class="fa fa-arrow-up fa-fw arrow-up"></i> ' + variation + '%</td>' +
			'</tr>');
		}

	});
};