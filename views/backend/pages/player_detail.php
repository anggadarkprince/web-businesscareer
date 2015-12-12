
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
                            <small><span class="fui-check-inverted"></span> &nbsp; Alhamdulillah sesuatu banget, Player Now <?php if(isset($player_detail)) echo $player_detail["ply_state"]?></small>
                        </div>
                    <?php
                    }
                    else if($status=='error'){
                        ?>
                        <div class="alert alert-danger alert-block pam">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <small><span class="fui-cross"></span> &nbsp; Innalilahi, ada yang salah, gagal</small>
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
                                    <p class="form-control-static"><?php if(isset($player_detail)) echo $player_detail["ply_email"]?></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Name</label>
                                <div class="col-sm-9">
                                    <p class="form-control-static"><?php if(isset($player_detail)) echo $player_detail["ply_name"]?></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Balance</label>
                                <div class="col-sm-9">
                                    <p class="form-control-static">IDR <?php if(isset($player_summary)) echo Utility::thousandsCurrencyFormat($player_summary["ply_cash"])?></p>
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
                        <table class="table table-striped table-hover table-condensed mtl">
                            <tr>
                                <th class="text-right">Assets</th>
                                <td>IDR 3,500,000</td>
                            </tr>
                            <tr>
                                <th class="text-right">Revenue</th>
                                <td>IDR 2,750,000</td>
                            </tr>
                            <tr>
                                <th class="text-right">Equity</th>
                                <td>IDR 300,000</td>
                            </tr>
                            <tr>
                                <th class="text-right">Payable</th>
                                <td>IDR 2,500,000</td>
                            </tr>
                            <tr>
                                <th class="text-right">Receivable</th>
                                <td>IDR 158,000</td>
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

                            <a href="<?=$this->framework->url->get_base_url()?>/report/get_player_detail/<?=$this->framework->url->url_part(3)?>" data-toggle='tooltip' data-placement='top' data-original-title='Print Player Achievement' class="btn btn-embossed btn-sm btn-danger"><span class="glyphicon glyphicon-print"></span> PRINT</a>
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
                text: 'Player: Sangrila Adiwinanta'
            },
            pane: {
                size: '80%'
            },

            xAxis: {
                categories: ['Sales', 'Marketing', 'Development', 'Customer Support',
                    'Information Technology', 'Administration'],
                tickmarkPlacement: 'on',
                lineWidth: 0
            },

            yAxis: {
                gridLineInterpolation: 'polygon',
                lineWidth: 0,
                min: 0
            },

            tooltip: {
                shared: true,
                pointFormat: '<span style="color:{series.color}">{series.name}: <b>${point.y:,.0f}</b><br/>'
            },


            series: [{
                name: 'Business Achievements',
                data: [43000, 29000, 60000, 35000, 17000, 10000],
                pointPlacement: 'on'
            }]

        });
    });
</script>