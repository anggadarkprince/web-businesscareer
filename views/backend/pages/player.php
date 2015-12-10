<div class="content-wrapper">
<div class="top-panel">
    <h3 class="icon-player"> Player</h3>
</div>
<div class="titlebar">
    <span>Player Data</span>
</div>
<div class="content">
<table class="table table-hover table-condensed table-responsive" id="example">
<thead>
<tr>
    <th width="5%">
        <div class="checkbox">
            <input type="checkbox" data-toggle="checkbox" value="1" class="checkall">
        </div>
    </th>
    <th width="5%">No</th>
    <th width="20%">Player</th>
    <th width="20%">Rating</th>
    <th width="15%">Detail</th>
    <th width="15%">Asset</th>
    <th width="10%">Status</th>
</tr>
</thead>
<tbody>
<?php

    if(isset($data_player)){
        $number = 1;
        foreach($data_player as $player){

        ?>

            <tr >
                <td>
                    <div class="checkbox">
                        <input type="checkbox" data-toggle="checkbox">
                    </div>
                </td>
                <td><?=$number++?></td>
                <td><img src="<?=$this->framework->url->get_base_url()?>/assets/images/avatar/<?=$player['ply_avatar']?>" class="img-circle mini-avatar"> <span><?=$player['ply_name']?></span></td>
                <td><div class="star-rating"><?=$player['ply_star']?></div></td>
                <td><a href="<?=$this->framework->url->get_base_url()?>/player/detail/<?=$player['ply_id']?>">Player Details</a></td>
                <td><span class="muted">IDR <?=$player['ply_cash']?></span></td>
                <td>
                    <?php
                        $label = "label-default";
                        if($player['ply_state']==player::ACTIVE){
                            $label = "label-success";
                        }
                        else if($player['ply_state']==player::PENDING){
                            $label = "label-default";
                        }
                        else if($player['ply_state']==player::SUSPEND){
                            $label = "label-danger";
                        }
                    ?>
                    <span class="label <?=$label?>"><?=$player['ply_state']?></span>
                </td>
            </tr>
<?php
        }
    }
?>
</tbody>
</table>
</div>
</div>