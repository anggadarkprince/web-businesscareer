
<div class="content-wrapper">
    <div class="top-panel">
        <h3 class="icon-player"> Player Detail</h3>
    </div>
    <div class="title-bar">
        <span>Player Data Detail</span>
    </div>
    <div class="content">
        <div class="row" id="printable">
            <div class="col-md-7">
                <?php
                if(isset($_SESSION['operation']))
                {
                    $status = $_SESSION['operation'];
                    if($status=='success'){
                        ?>
                        <div class="alert alert-warning alert-block pam">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <small><span class="fui-check-inverted"></span> &nbsp; Player's state updated successfully, Player Now <?php if(isset($player_detail)) echo $player_detail["ply_state"]?></small>
                        </div>
                    <?php
                    }
                    else if($status=='error'){
                        ?>
                        <div class="alert alert-danger alert-block pam">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <small><span class="fui-cross"></span> &nbsp; Player's state update failed.</small>
                        </div>
                    <?php
                    }
                    unset($_SESSION['operation']);
                }
                ?>
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <div class="avatar-player-wrapper">
                            <img src="<?=$this->framework->url->get_base_url()?>/assets/images/avatar/<?php if(isset($player_detail)) echo $player_detail["ply_avatar"]?>" class="img-responsive img-circle avatar-player">
                        </div>
                    </div>
                    <div class="col-md-8 col-sm-8">
                        <form class="form-horizontal basic-information" role="form">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Email</label>
                                <div class="col-sm-9">
                                    <p class="form-control-static"><?php if(isset($player_detail["ply_email"])) echo $player_detail["ply_email"]?></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Name</label>
                                <div class="col-sm-9">
                                    <p class="form-control-static"><?php if(isset($player_detail["ply_name"])) echo $player_detail["ply_name"]?></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Cash</label>
                                <div class="col-sm-9">
                                    <p class="form-control-static">IDR <?php if(isset($player_summary["ply_cash"])) echo Utility::thousandsCurrencyFormat($player_summary["ply_cash"])?></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Rating</label>
                                <div class="col-sm-9">
                                    <p class="form-control-static"><div class="star-rating"><?php if(isset($player_summary)) echo $player_summary["ply_star"]?></div></p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-hover table-condensed mtl">
                            <tr>
                                <th class="text-center">No</th>
                                <th>Detail</th>
                                <th>Value</th>
                            </tr>
                            <tr>
                                <th class="text-center">1</th>
                                <th>Assets</th>
                                <td>IDR <?=Utility::format_currency($player_finance["assets"])?></td>
                            </tr>
                            <tr>
                                <th class="text-center">2</th>
                                <th>Revenue</th>
                                <td>IDR <?=Utility::format_currency($player_finance["revenue"])?></td>
                            </tr>
                            <tr>
                                <th class="text-center">3</th>
                                <th>Equity</th>
                                <td>IDR <?=Utility::format_currency($player_finance["equity"])?></td>
                            </tr>
                            <tr>
                                <th class="text-center">4</th>
                                <th>Payable</th>
                                <td>IDR <?=Utility::format_currency($player_finance["payable"])?></td>
                            </tr>
                            <tr>
                                <th class="text-center">5</th>
                                <th>Receivable</th>
                                <td>IDR <?=Utility::format_currency($player_finance["expense"])?></td>
                            </tr>
                        </table>
                        <div class="clearfix mtl"></div>
                        <div class="pull-left">
                            <a href="<?=$this->framework->url->get_base_url()?>/player" class="btn btn-embossed btn-sm btn-custom" data-toggle='tooltip' data-placement='top' data-original-title='Back to Player List'><span class="glyphicon glyphicon-chevron-left"></span> BACK TO LIST</a>
                        </div>
                        <div class="pull-right">
                            <?php
                            if(isset($player_detail)){
                                if($player_detail["ply_state"]==player::ACTIVE){
                                    ?>
                                    <a href="<?=$this->framework->url->get_base_url()?>/player/suspend/<?=$this->framework->url->url_part(3)?>" class="btn btn-embossed btn-sm btn-danger" data-toggle='tooltip' data-placement='top' data-original-title='Disable Player'><span class="glyphicon glyphicon-collapse-down"></span> SUSPEND</a>
                            <?php
                                }
                                else if($player_detail["ply_state"]==player::SUSPEND){
                                    ?>
                                    <a href="<?=$this->framework->url->get_base_url()?>/player/reactive/<?=$this->framework->url->url_part(3)?>" class="btn btn-embossed btn-sm btn-custom" data-toggle='tooltip' data-placement='top' data-original-title='Enable Player'><span class="glyphicon glyphicon-collapse-up"></span> REACTIVE</a>
                            <?php
                                }
                            }
                            ?>

                            <a href="<?=$this->framework->url->get_base_url()?>/player/get_player_detail/<?=$this->framework->url->url_part(3)?>" data-toggle='tooltip' data-placement='top' data-original-title='Print Player Achievement' class="btn btn-embossed btn-sm btn-danger"><span class="glyphicon glyphicon-print"></span> PRINT</a>
                            <a href="<?=$this->framework->url->get_base_url()?>/player/logging/<?=$this->framework->url->url_part(3)?>" data-toggle='tooltip' data-placement='top' data-original-title='Generate Player Logging' class="btn btn-embossed btn-sm btn-danger"><span class="glyphicon glyphicon-time"></span> LOGGING</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div id="player-statistic"></div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){

        $('#player-statistic').highcharts({

            chart: {
                polar: true,
                type: 'line'
            },
            title: {
                text: 'Player Achievements'
            },
            subtitle: {
                text: 'Player: <?php if(isset($player_detail["ply_name"])) echo $player_detail["ply_name"]?>'
            },
            pane: {
                size: '80%'
            },
            xAxis: {
                categories: ['Shop', 'Sales Promotion', 'Employee', 'Game Booster',
                    'Assets', 'Game Achievement'],
                tickmarkPlacement: 'on',
                lineWidth: 0
            },
            yAxis: {
                gridLineInterpolation: 'polygon',
                lineWidth: 0,
                min: -2,
                max: 10,
            },
            tooltip: {
                shared: true,
                pointFormat: '<span style="color:{series.color}">{series.name}: <b>${point.y:,.0f}</b><br/>'
            },
            series: [{
                name: 'Business Achievements',
                data: [
                    <?=$player_performance["shop"]?>,
                    <?=$player_performance["advertisement"]?>,
                    <?=$player_performance["employee"]?>,
                    <?=$player_performance["booster"]?>,
                    <?=$player_performance["assets"]?>,
                    <?=$player_performance["achievement"]?>
                ],
                pointPlacement: 'on'
            }]

        });
    });
</script>