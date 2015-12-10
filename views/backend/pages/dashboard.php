<div class="content-wrapper">
    <div class="top-panel">
        <h3 class="icon-dashboard"> Dashboard</h3>
    </div>
    <div class="titlebar">
        <span>Personal Information</span>
    </div>
    <div class="content">
        <p>SeriousGame.Inc provide best practice learning and training game, Business Career The Game is product which give player excellent experience with financial transaction.</p>
        <div id="chart"></div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('#chart').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Daily Average Registration'
            },
            subtitle: {
                text: 'Serious Game : Business Career The Game'
            },
            colors: ['#81a249', '#88ac4c', '#94b857', '#9cc05f', '#629393', '#527A7A', '#416262', '#314949', '#669999', '#5A8787'],
            xAxis: {
                categories: [
                    <?php
                        if(isset($registration_statistic)){
                            foreach($registration_statistic as $row){
                                echo "'".$row["date"]."',";
                            }
                        }
                    ?>
                ]
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Total'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: 'Registration',
                data: [
                    <?php
                        if(isset($registration_statistic)){
                            foreach($registration_statistic as $row){
                                echo $row["total"].",";
                            }
                        }
                    ?>
                ]

            }]
        });
    });
</script>