<div class="content-wrapper">
    <div class="top-panel">
        <h3 class="icon-statistic"> Statistic</h3>
    </div>
    <div class="title-bar">
        <span>Static Information</span>
    </div>
    <div class="content">
        <h3 class="lead man">Top 10 Player</h3>
        <div class="row">
            <div class="col-md-12">
                <table id="datatable" class="table table-hover table-condensed">
                    <thead>
                    <tr>
                        <th></th>
                        <th>Game Point</th>
                        <th>Game Cash</th>
                        <th class="text-center">Rank</th>
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
                        <td><?=number_format($player["ply_point"], 0, ',', '.')?> PTS</td>
                        <td>IDR <?=number_format($player["ply_cash"], 0, ',', '.')?></td>
                        <td class="text-center"><?=$number++?></td>
                    </tr>

                    <?php
                        }
                    }
                    ?>
                    </tbody>
                </table>
            </div>
            <div class="col-md-12 mtl hidden-xs">
                <div id="chartdatatable"></div>
            </div>
        </div>
        <a href="<?=$this->framework->url->get_base_url()?>/statistic/get_player_top_10" class="btn btn-embossed btn-sm btn-danger" data-toggle='tooltip' data-placement='top' data-original-title='Print Top 10 Player'><span class="glyphicon glyphicon-print"></span> PRINT</a>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('#chartdatatable').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Top 10 Player Statistic'
            },
            subtitle: {
                text: 'Serious Game : Business Career The Game'
            },
            colors: ['#81a249', '#a2c566'],
            xAxis: {
                categories: [
                    <?php
                        if(isset($leaderboard)){
                            foreach($leaderboard as $row){
                                echo "'".$row["ply_name"]."',";
                            }
                        }
                    ?>
                ]
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Player Total'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y}</b></td></tr>',
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
                name: 'Game Point (X100)',
                data: [
                    <?php
                        if(isset($leaderboard)){
                            foreach($leaderboard as $row){
                                echo ($row["ply_point"] * 100).",";
                            }
                        }
                    ?>
                ]

            },{
                name: 'Game Cash',
                data: [
                    <?php
                        if(isset($leaderboard)){
                            foreach($leaderboard as $row){
                                echo $row["ply_cash"].",";
                            }
                        }
                    ?>
                ]

            }]
        });

        $(".highcharts-axis-labels").first().find("text").attr("y", 340);
        $(".highcharts-title").attr("y", 20);
    });
</script>