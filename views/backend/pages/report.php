<div class="content-wrapper">
    <div class="top-panel">
        <h3 class="icon-report"> System Report</h3>
    </div>
    <div class="title-bar">
        <span>Serious Game Report</span>
    </div>
    <div class="content">
        <div class="row" id="printable">
            <div class="col-md-12">
                <div>
                    <div>
                        <img src="<?=$this->framework->url->get_base_url()?>/assets/images/layout/logo-dark.png">
                    </div>
                    <div class="row mtl ptl">
                        <div class="col-md-9">
                            <address>
                                <strong>Jawa Street Block 6th No.5</strong><br>
                                <small>Sumbersari Jember</small><br>
                                <small>Indonesia</small><br>
                                <small><abbr title="Phone">P:</abbr> (+62) 085655479868</small>
                            </address>
                        </div>
                        <div class="col-md-3 small">
                            <div class="pull-right">
                                <p>report no.<?=substr(uniqid(),0,7)?>-AU23</p>
                            </div>
                            <div>
                                <div class="pull-left"> REPORT DATE : </div>
                                <div class="pull-right"> <?=Utility::date() ?></div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>

                    <h4>PLAYER</h4>
                    <table class="table">
                        <thead>
                        <tr>
                            <th width="50" class="text-center"></th>
                            <th class="text-left">PLAYER STATUS</th>
                            <th width="100" class="text-right">TOTAL</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="unseen text-center"></td>
                            <td>Player Registered</td>
                            <td class="text-right"><?php if(isset($player)) echo $player["total_player"]; else echo "0"?></td>
                        </tr>
                        <tr>
                            <td class="unseen text-center"></td>
                            <td>Player Pending</td>
                            <td class="text-right"><?php if(isset($player)) echo $player["player_pending"]; else echo "0"?></td>
                        </tr>
                        <tr>
                            <td class="unseen text-center"></td>
                            <td>Player Suspended</td>
                            <td class="text-right"><?php if(isset($player)) echo $player["player_suspend"]; else echo "0"?></td>
                        </tr>
                        <tr>
                            <td class="unseen text-center"></td>
                            <td>Player Active</td>
                            <td class="text-right"><?php if(isset($player)) echo $player["player_active"]; else echo "0"?></td>
                        </tr>
                        <tr>
                            <td>

                            </td>
                            <td>
                                <h6>Player Total</h6>
                                <p class="small">Player state show active of passive playing behavior, keep active player increase everyday.</p>
                            </td>
                            <td class="text-right"><div class="well-sm palette-wet-asphalt lead"><strong class="text-inverse"><?php if(isset($player)) echo $player["player_suspend"]+$player["player_active"]; else echo "0"?></strong></div></td>
                        </tr>
                        </tbody>
                    </table>


                    <h4>Response</h4>
                    <table class="table">
                        <thead>
                        <tr>
                            <th width="50" class="text-center"></th>
                            <th class="text-left">FEEDBACK STATUS</th>
                            <th width="100" class="text-right">TOTAL</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="unseen text-center"></td>
                            <td>Today Traffic</td>
                            <td class="text-right"><?php if(isset($feedback)) echo $feedback["feedback_today"]; else echo "0"?></td>
                        </tr>
                        <tr>
                            <td class="unseen text-center"></td>
                            <td>Last Week Traffic</td>
                            <td class="text-right"><?php if(isset($feedback)) echo $feedback["last_week"]; else echo "0"?></td>
                        </tr>
                        <tr>
                            <td class="unseen text-center"></td>
                            <td>Last Month Traffic</td>
                            <td class="text-right"><?php if(isset($feedback)) echo $feedback["last_month"]; else echo "0"?></td>
                        </tr>
                        <tr>
                            <td class="unseen text-center"></td>
                            <td>Last Year Traffic</td>
                            <td class="text-right"><?php if(isset($feedback)) echo $feedback["last_year"]; else echo "0"?></td>
                        </tr>
                        <tr>
                            <td>

                            </td>
                            <td>
                                <h6>Total Feedback</h6>
                                <p class="small">We do expect traffic will keep increase everyday and give us some suggest to improve our game.</p>
                            </td>
                            <td class="text-right"><div class="well-sm palette-wet-asphalt lead"><strong class="text-inverse"><?php if(isset($feedback)) echo $feedback["total"]; else echo "0"?></strong></div></td>
                        </tr>
                        </tbody>
                    </table>


                    <h4>TRAFFIC</h4>
                    <table class="table">
                        <thead>
                        <tr>
                            <th width="50" class="text-center"></th>
                            <th class="text-left">TRAFFIC STATUS</th>
                            <th width="100" class="text-right">TOTAL</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="unseen text-center"></td>
                            <td>Highest Traffic</td>
                            <td class="text-right"><?php if(isset($traffic)) echo $traffic["max_traffic"]; else echo "0"?></td>
                        </tr>
                        <tr>
                            <td class="unseen text-center"></td>
                            <td>Lowest Traffic</td>
                            <td class="text-right"><?php if(isset($traffic)) echo $traffic["min_traffic"]; else echo "0"?></td>
                        </tr>
                        <tr>
                            <td colspan="3"><div id="charttraffic"></div></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <h6>Average / Day</h6>
                                <p class="small">We do expect traffic will keep increase everyday and player more excite about Serious Game.</p>
                            </td>
                            <td class="text-right"><div class="well-sm palette-wet-asphalt lead"><strong class="text-inverse"><?php if(isset($traffic)) echo $traffic["avg_traffic"]; else echo "0"?></strong></div></td>
                        </tr>
                        </tbody>
                    </table>


                    <br>
                    <br>
                    <h5 class="text-right"><small class="text-primary">Super Admin</small></h5>
                    <h6 class="text-right lead small">Angga Ari Wijaya</h6>
                </div>
                <div class="mtl">
                    <div class="pull-right">
                        <a href="<?=$this->framework->url->get_base_url()?>/report/get_overall" class="btn btn-embossed btn-sm btn-danger"><span class="glyphicon glyphicon-print"></span> PRINT</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('#charttraffic').highcharts({
            title: {
                text: 'Monthly Average Traffic'
            },
            subtitle: {
                text: 'Serious Game : Business Career The Game',
                style: {
                    color: '#81a249'
                }
            },
            colors: ['#81a249', '#88ac4c', '#94b857'],
            xAxis: {
                categories: [
                    <?php
                        if(isset($chart)){
                            foreach($chart as $row){
                                echo "'".$row["month"]."',";
                            }
                        }
                    ?>
                ]
            },
            yAxis: {
                title: {
                    text: 'Total Player',
                    style: {
                        color: '#81a249'
                    }
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                valueSuffix: '°C'
            },
            series: [{
                name: 'Traffic',
                data: [
                    <?php
                        if(isset($chart)){
                            foreach($chart as $row){
                                echo $row["total"].",";
                            }
                        }
                    ?>
                ]
            }]
        });
    });
</script>