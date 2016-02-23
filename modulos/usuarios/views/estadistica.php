<style type="text/css">
${demo.css}
</style>

<script type="text/javascript">
$(function () {
    $('#container').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Estadistica de Usuarios'
        },

        xAxis: {
            type: 'category',
            labels: {
                rotation: -45,
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Total de Usuarios'
            }
        },
        legend: {
            enabled: false
        },
        tooltip: {
            pointFormat: 'Porcentaje de Usuarios {point.y:.0f}</b>'
        },
        series: [{
            name: 'Population',
            data: 
                <?php echo $activo?>,
                
            dataLabels: {
                enabled: true,
                rotation: -90,
                color: '#FFFFFF',
                align: 'right',
                format: '{point.y:.0f}', // one decimal
                y: 10, // 10 pixels down from the top
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        }]
    });
});
</script>

<div id="container" style="min-width: 310px; height: 500px; max-width: 700px; margin: 0 auto"></div>

