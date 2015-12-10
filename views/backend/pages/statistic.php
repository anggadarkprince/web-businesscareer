<div class="content-wrapper">
    <div class="top-panel">
        <h3 class="icon-statistic"> Statistic</h3>
    </div>
    <div class="titlebar">
        <span>Static Information</span>
    </div>
    <div class="content">
        <h3 class="lead man">Top 10 Player</h3>
        <div class="row">
            <div class="col-md-6">
                <table id="datatable" class="table table-hover table-condensed">
                    <thead>
                    <tr>
                        <th></th>
                        <th>Game Point</th>
                        <th>Game Cash</th>
                        <th>Rank</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php

                    if(isset($leaderboard)){
                        $number = 1;
                        foreach($leaderboard as $player){
                    ?>
                    <tr>
                        <th><?=$player["ply_name"]?></th>
                        <td><?=$player["ply_point"]?></td>
                        <td><?=$player["ply_cash"]?></td>
                        <td>1</td>
                    </tr>

                    <?php
                        }
                    }
                    ?>
                    </tbody>
                </table>
            </div>
            <div class="col-md-6">
                <div id="chartdatatable"></div>
            </div>
        </div>
        <a href="<?=$this->framework->url->get_base_url()?>/report/get_player_top_10" class="btn btn-embossed btn-sm btn-danger" data-toggle='tooltip' data-placement='top' data-original-title='Print Top 10 Player'><span class="glyphicon glyphicon-print"></span> PRINT</a>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('#chartdatatable').highcharts({
            data: {
                table: document.getElementById('datatable')
            },
            chart: {
                type: 'column'
            },
            title: {
                text: 'Data extracted from a HTML table in the page'
            },
            colors: ['#81a249', '#88ac4c', '#94b857'],
            yAxis: {
                allowDecimals: false,
                title: {
                    text: 'Units'
                }
            },
            tooltip: {
                formatter: function() {
                    return '<b>'+ this.series.name +'</b><br/>'+
                        this.y +' '+ this.x.toLowerCase();
                }
            }
        });
    });
</script>