<div class="content-wrapper">
    <div class="top-panel">
        <h3 class="icon-player"> Player Detail</h3>
    </div>
    <div class="titlebar">
        <span>Player Data Detail</span>
    </div>
    <div class="content">
        <div class="row" id="printable">
            <div class="col-md-12">
                <table class="table table-striped table-hover table-condensed mtl" id="example">
                    <thead>
                        <tr>
                            <th>ID-LOGGING</th>
                            <th>TIMESTAMP</th>
                            <th>MODULE</th>
                            <th>OPERATION</th>
                            <th>VALUE</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(isset($player_logging)){
                        foreach($player_logging as $logging){
                            ?>
                            <tr>
                                <td><?=$logging["lgg_id"]?></td>
                                <td><?=$logging["lgg_created_at"]?></td>
                                <td><?=$logging["lgg_module"]?></td>
                                <td><?=$logging["lgg_operation"]?></td>
                                <td><?=$logging["lgg_value"]?></td>
                            </tr>
                        <?php
                        }
                    }
                    ?>
                    </tbody>
                </table>
                <div class="mtl">
                    <div class="pull-left">
                        <a href="<?=$this->framework->url->get_base_url()?>/player/detail/<?=$this->framework->url->url_part(3)?>" class="btn btn-embossed btn-sm btn-custom" data-toggle='tooltip' data-placement='top' data-original-title='Back to Player Profile'><span class="glyphicon glyphicon-chevron-left"></span> BACK TO PROFILE</a>
                    </div>
                    <div class="pull-right">
                        <a href="<?=$this->framework->url->get_base_url()?>/report/get_player_logging/<?=$this->framework->url->url_part(3)?>" class="btn btn-embossed btn-sm btn-danger" data-toggle='tooltip' data-placement='top' data-original-title='Print Logging'><span class="glyphicon glyphicon-print"></span> PRINT</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>