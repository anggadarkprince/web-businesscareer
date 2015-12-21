
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
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th>Detail</th>
                                    <th>Value</th>
                                </tr>
                            </thead>
                            <tbody>
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
                                    <th>Expense</th>
                                    <td>IDR <?=Utility::format_currency($player_finance["expense"])?></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="clearfix mtl ptm"></div>
                        <div class="pull-left mbl">
                            <a href="<?=$this->framework->url->get_base_url()?>/player" class="btn btn-embossed btn-sm btn-custom" data-toggle='tooltip' data-placement='top' data-original-title='Back to Player List'><span class="glyphicon glyphicon-chevron-left"></span> BACK TO LIST</a>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div id="player-statistic"></div>
                <div class="pull-right mtl ptm">
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
                    <a href="<?=$this->framework->url->get_base_url()?>/player/logging/<?=$this->framework->url->url_part(3)?>" data-toggle='tooltip' data-placement='top' data-original-title='Generate Player Log' class="btn btn-embossed btn-sm btn-danger"><span class="glyphicon glyphicon-time"></span> LOG</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h3 class="lead mtl mbn">Game Data</h3>
                <table class="table table-hover table-condensed">
                    <thead>
                    <tr>
                        <th class="text-left" width="15%">Game Key</th>
                        <th class="text-left" width="35%">Game Value</th>
                        <th class="text-left" width="15%">Game Key</th>
                        <th class="text-left" width="35%">Game Value</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th class="text-left">Shop Name</th>
                        <td class="text-left"><?=$player_game["shp_name"]?></td>
                        <th class="text-left">Motivation</th>
                        <td class="text-left"><?=$player_game["gme_motivation"]?></td>
                    </tr>
                    <tr>
                        <th class="text-left">Shop Logo</th>
                        <td class="text-left"><?=$player_game["shp_logo"]?></td>
                        <th class="text-left">Game Advisor</th>
                        <td class="text-left"><?=$player_game["gme_advisor"]?></td>
                    </tr>
                    <tr>
                        <th class="text-left" style="vertical-align: top">Personal Objective</th>
                        <td class="text-left" style="vertical-align: top"><?=$player_game["gme_personal_objective"]?></td>
                        <th class="text-left" style="vertical-align: top">Business Plan</th>
                        <td class="text-left" style="vertical-align: top"><?=$player_game["gme_business_plan"]?></td>
                    </tr>
                    <tr>
                        <th class="text-left">District</th>
                        <td class="text-left"><?=$player_game["shp_district"]?></td>
                        <th class="text-left">Game Point</th>
                        <td class="text-left"><?=Utility::format_currency($player_game["gme_point"])?> PTS</td>
                    </tr>
                    <tr>
                        <th class="text-left">Play Time</th>
                        <td class="text-left"><?=$player_game["gme_playtime"]?> Simulation Days</td>
                        <th class="text-left">Seed Money</th>
                        <td class="text-left"><?=$player_game["gme_financing"].' &nbsp; IDR. '.Utility::format_currency($player_game["gme_instalment"])?></td>
                    </tr>
                    <tr>
                        <th class="text-left" style="vertical-align: top">Schedule</th>
                        <td class="text-left">
                            <?php
                            $schedule = json_decode($player_game["shp_schedule"]);
                            foreach($schedule as $key => $value):
                                echo "<span style='display: inline-block; width: 100px;'><strong>".date("l", strtotime("Sunday + {$key} days")). "</strong></span>: {$value[0]}.00 - {$value[1]}.00<br>";
                            endforeach;
                            ?>
                        </td>
                        <?php $advertisement = json_decode($player_game["shp_advertising_data"]); ?>
                        <th class="text-left" style="vertical-align: top">Advertisement</th>
                        <td class="text-left" style="vertical-align: top">
                            <strong style="display: inline-block; width: 100px">Television</strong>: Visibility <?=$advertisement[0][1]?> &nbsp; Level <?=$advertisement[0][2]?><br>
                            <strong style="display: inline-block; width: 100px">Radio</strong>: Visibility <?=$advertisement[1][1]?> &nbsp; Level <?=$advertisement[1][2]?><br>
                            <strong style="display: inline-block; width: 100px">Newspaper</strong>: Visibility <?=$advertisement[2][1]?> &nbsp; Level <?=$advertisement[2][2]?><br>
                            <strong style="display: inline-block; width: 100px">Social Net</strong>: Visibility <?=$advertisement[0][1]?> &nbsp; Level <?=$advertisement[0][2]?><br>
                            <strong style="display: inline-block; width: 100px">Sponsorship</strong>: Visibility <?=$advertisement[1][1]?> &nbsp; Level <?=$advertisement[1][2]?><br>
                            <strong style="display: inline-block; width: 100px">Billboard</strong>: Visibility <?=$advertisement[2][1]?> &nbsp; Level <?=$advertisement[2][2]?>
                        </td>
                    </tr>
                    <tr>
                        <th class="text-left">Sales Today</th>
                        <td class="text-left"><?=$player_game["shp_sales_today"]?> Items</td>
                        <th class="text-left">Sales Total</th>
                        <td class="text-left"><?=$player_game["shp_sales_total"]?> Items</td>
                    </tr>
                    <tr>
                        <th class="text-left" style="vertical-align: top">Game World</th>
                        <td class="text-left">
                            <strong style="display: inline-block; width: 100px">Population</strong>: <?=$player_game["par_population"]?><br>
                            <strong style="display: inline-block; width: 100px">Weather</strong>: <?=$player_game["par_weather"]?><br>
                            <strong style="display: inline-block; width: 100px">Event</strong>: <?=$player_game["par_event"]?><br>
                            <strong style="display: inline-block; width: 100px">Competitor</strong>: <?=$player_game["par_competitor"]?>
                        </td>
                        <th class="text-left" style="vertical-align: top">Consumer</th>
                        <td class="text-left">
                            <strong style="display: inline-block; width: 100px">Variant</strong>: <?=$player_game["par_population"]?><br>
                            <strong style="display: inline-block; width: 100px">Addicted</strong>: <?=$player_game["par_weather"]?><br>
                            <strong style="display: inline-block; width: 100px">Buying Power</strong>: <?=$player_game["par_event"]?><br>
                            <strong style="display: inline-block; width: 100px">Emotion</strong>: <?=$player_game["par_competitor"]?>
                        </td>
                    </tr>
                    <tr>
                        <th class="text-left" style="vertical-align: top">Current Task</th>
                        <td class="text-left" style="vertical-align: top">
                            <?php if($player_game["gme_task"] == "[]"){ ?>
                                No Task Available
                            <?php } else {?>
                                <ol class="mll">
                                    <?php
                                    $tasks = json_decode($player_game["gme_task"]);
                                    foreach($tasks as $task):
                                        ?>
                                        <li>Task <?=ucwords($task[0]).' Reward: '.$task[1]?></li>
                                        <?php
                                    endforeach;
                                    ?>
                                </ol>
                            <?php } ?>
                        </td>
                        <th class="text-left" style="vertical-align: top">Researching</th>
                        <td class="text-left" style="vertical-align: top">
                            <?php $research = json_decode($player_game["shp_research_data"]) ?>
                            <?php if(array_sum($research) == 0){ ?>
                                No Research Available
                            <?php } else {?>
                                <ol class="mll">
                                    <?php
                                    $research_list = ["Marketing Research", "Customer Service", "Point Sale Program", "R&D Product", "Facilities Renovation"];
                                    foreach($research as $key => $value):
                                        if($value == 1){
                                            ?>
                                            <li>Task <?=$research_list[$key]?></li>
                                        <?php }
                                    endforeach;
                                    ?>
                                </ol>
                            <?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <th class="text-left" style="vertical-align: top">Programs</th>
                        <td class="text-left" style="vertical-align: top">
                            <?php $program = json_decode($player_game["shp_program_data"]) ?>
                            <?php if(array_sum($program) == 0){ ?>
                                No Program Available
                            <?php } else {?>
                                <ol class="mll">
                                    <?php
                                    $program_list = ["Performance & Reward", "Career & Promotion", "Cultural Diversity", "Personalization", "Management & Communication", "Health Insurance", "Education Support", "Additional Reward", "Company Practice"];
                                    foreach($program as $key => $value):
                                        if($value == 1){
                                            ?>
                                            <li>Task <?=$program_list[$key]?></li>
                                        <?php }
                                    endforeach;
                                    ?>
                                </ol>
                            <?php } ?>
                        </td>
                        <th class="text-left" style="vertical-align: top">Attributes</th>
                        <td class="text-left" style="vertical-align: top">
                            <?php
                            $decoration = json_decode($player_game["shp_decoration"]);
                            $scent = json_decode($player_game["shp_scent"]);
                            $cleanness = json_decode($player_game["shp_cleanness"]);
                            ?>
                            <ol class="mll">
                                <li class="mbm"><span style="width: 90px; display: inline-block">Decoration</span>
                                    <ul style="display:inline-block; vertical-align: top" class="mll">
                                        <li><span style="width: 80px; display: inline-block;">Modern</span> <?=$decoration[0]?></li>
                                        <li><span style="width: 80px; display: inline-block;">Colorful</span> <?=$decoration[1]?></li>
                                        <li><span style="width: 80px; display: inline-block;">Vintage</span> <?=$decoration[2]?></li>
                                    </ul>
                                </li>
                                <li class="mbm"><span style="width: 90px; display: inline-block">Scent</span>
                                    <ul style="display:inline-block; vertical-align: top" class="mll">
                                        <li><span style="width: 80px; display: inline-block;">Ginger</span> <?=$scent[0]?></li>
                                        <li><span style="width: 80px; display: inline-block;">Jasmine</span> <?=$scent[1]?></li>
                                        <li><span style="width: 80px; display: inline-block;">Rosemary</span> <?=$scent[2]?></li>
                                    </ul>
                                </li>
                                <li><span style="width: 90px; display: inline-block">Cleanness</span>
                                    <ul style="display:inline-block; vertical-align: top" class="mll">
                                        <li><span style="width: 80px; display: inline-block;">Product</span> <?=$cleanness[0]?></li>
                                        <li><span style="width: 80px; display: inline-block;">Price</span> <?=$cleanness[1]?></li>
                                    </ul>
                                </li>
                            </ol>
                        </td>
                    </tr>
                    <tr>
                        <th class="text-left">Data Created At</th>
                        <td class="text-left"><?=date_format(date_create($player_game["gme_created_at"]), "d F Y")?></td>
                        <th class="text-left">Last Saved At</th>
                        <td class="text-left"><?=date_format(date_create($player_game["gme_updated_at"]), "d F Y")?></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-12">
                <h3 class="lead mtl mbn">Player's Achievement</h3>
                <table class="table table-hover table-condensed">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-left">Achievement</th>
                            <th class="text-left">Description</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Earned</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($player_achievements as $key => $achievement): ?>
                            <tr>
                                <th class="text-center" width="75px"><?=($key+1)?></th>
                                <th class="text-left"><?=$achievement["ach_achievement"]?></th>
                                <td class="text-left"><?=$achievement["ach_description"]?></td>
                                <td class="text-center">
                                    <?php
                                    if($achievement["earned"]==0){
                                        $label = "LOCKED";
                                        $class = "default";
                                    } else{
                                        $label = "UNLOCKED";
                                        $class = "success";
                                    }
                                    ?>
                                    <span class="label label-<?=$class?>"><?=$label?></span>
                                </td>
                                <td class="text-center"><?=$achievement["earned"]?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="col-md-12">
                <h3 class="lead mtl mbn">Player's Assets</h3>
                <table class="table table-hover table-condensed">
                    <thead>
                    <tr>
                        <th class="text-center" width="75px">No</th>
                        <th class="text-left">Assets</th>
                        <th class="text-center">Type</th>
                        <th class="text-center">Level</th>
                        <th class="text-right">Deprecation</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($player_assets as $key => $asset): ?>
                        <tr>
                            <th class="text-center"><?=($key+1)?></th>
                            <th class="text-left"><?=$asset["ast_asset"]?></th>
                            <td class="text-center"><?=$asset["ast_type"]?></td>
                            <td class="text-center"><?=$asset["ast_level"]?></td>
                            <td class="text-right">IDR <?=Utility::format_currency($asset["pas_depreciation"])?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="col-md-12">
                <h3 class="lead mtl mbn">Player's Employee</h3>
                <table class="table table-hover table-condensed">
                    <thead>
                    <tr>
                        <th class="text-center" width="75px">No</th>
                        <th class="text-left">Employee</th>
                        <th class="text-left">Salary</th>
                        <th class="text-center">Hired</th>
                        <th class="text-center">Morale</th>
                        <th class="text-center">Service</th>
                        <th class="text-center">Productivity</th>
                        <th class="text-center">Level</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($player_employees as $key => $employee): ?>
                        <tr>
                            <th class="text-center"><?=($key+1)?></th>
                            <th class="text-left"><?=$employee["emp_name"]?></th>
                            <td class="text-left">IDR <?=Utility::format_currency($employee["pem_salary"])?></td>
                            <td class="text-center"><?=$employee["pem_hired"]?> Days</td>
                            <td class="text-center"><?=$employee["pem_morale"]?></td>
                            <td class="text-center"><?=$employee["pem_services"]?></td>
                            <td class="text-center"><?=$employee["pem_productivity"]?></td>
                            <td class="text-center"><?=$employee["pem_level"]?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="col-md-12">
                <h3 class="lead mtl mbn">Player's Material</h3>
                <table class="table table-hover table-condensed">
                    <thead>
                    <tr>
                        <th class="text-center" width="75px">No</th>
                        <th class="text-left">Material</th>
                        <th class="text-left">Price</th>
                        <th class="text-center">Stock</th>
                        <th class="text-center">Expired</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($player_materials as $key => $material): ?>
                        <tr>
                            <th class="text-center"><?=($key+1)?></th>
                            <th class="text-left"><?=$material["mtr_item"]?></th>
                            <td class="text-left">IDR <?=Utility::format_currency($material["mtr_price"])?></td>
                            <td class="text-center"><?=$material["pma_stock"]?></td>
                            <td class="text-center"><?=$material["pma_expired_remaining"]?> Days</td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div> <!-- end of content -->
</div> <!-- end of content-wrapper -->

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