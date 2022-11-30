am4core.useTheme(am4themes_animated);

$(document).ready(function () {
    get_sells();
    function get_sells() {
        $.ajax({
            type: 'get',
            url: "sell/get_all_sell",
            dataType: 'json',
            success: datos => {
                console.log(datos)                
                crearGraficoXY(datos);
            }
        });
    }

    function crearGraficoXY(datos) {

         // Create chart instance
         var chart = am4core.create("chartdiv", am4charts.PieChart);

         chart.data = datos;
 
         // Add and configure Series
         var pieSeries = chart.series.push(new am4charts.PieSeries());
         pieSeries.dataFields.value = "cantidad";
         pieSeries.dataFields.category = "nombre";
 
         // Let's cut a hole in our Pie chart the size of 40% the radius
         chart.innerRadius = am4core.percent(30);
 
         // Disable ticks and labels
         pieSeries.labels.template.disabled = true;
         pieSeries.ticks.template.disabled = true;
       
         // Add a legend
         chart.legend = new am4charts.Legend();

    }
});