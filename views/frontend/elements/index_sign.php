<div class="container content" style="padding-top: 90px; padding-bottom: 70px">
    <div class="row form-menu">
        <div class="col-md-4 menu-login">
            <div class="row">
                <div class="col-md-12 col-sm-4 mbl text-center">
                    <div class="avatar-player-wrapper">
                        <img src="<?=$this->framework->url->get_base_url()?>/assets/images/avatar/<?php echo $_SESSION['ply_avatar'];?>" class="img-responsive img-circle avatar-player">
                    </div>
                    <a href="#fakelink" data-toggle='modal' data-target='#uploadProfile' class="btn btn-embossed btn-lg btn-danger" style="margin-top:20px"><span class="fui-user"></span></a>
                    <a href="<?=$this->framework->url->get_base_url()?>/player/logout" class="btn btn-embossed btn-lg btn-danger" style="margin-top:20px"><span class="fui-lock"></span> SIGN OUT</a>
                </div>
                <div class="col-md-12 col-sm-8">
                    <form class="form-horizontal basic-information" role="form">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Email</label>
                            <div class="col-sm-9">
                                <p class="form-control-static"><?php echo $_SESSION['ply_username'];?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Name</label>
                            <div class="col-sm-9">
                                <p class="form-control-static"><?php echo $_SESSION['ply_name'];?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Balance</label>
                            <div class="col-sm-9">
                                <p class="form-control-static">IDR <?php if(isset($summary)){echo $summary["gme_cash"];} else{ echo "0";} ?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Rating</label>
                            <div class="col-sm-9">
                                <p class="form-control-static"><div class="star-rating"><?php if(isset($summary)){echo $summary["star"];} else{ echo "0";}?></div></p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4 menu-registration">
            <h1>Player Data</h1>
            <h3>Update your personal data</h3>
            <?php
            if(isset($_SESSION['operation']))
            {
                $status = $_SESSION['operation'];
                if($status=='success'){
                    ?>
                    <div class="alert alert-success alert-block pam">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <small>Alhamdulillah sesuatu banget, berhasil</small>
                    </div>
                <?php
                }
                else if($status=='error'){
                    ?>
                    <div class="alert alert-danger alert-block pam">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <small>Innalilahi, ada yang salah, gagal</small>
                    </div>
                <?php
                }
                unset($_SESSION['operation']);
            }
            ?>
            <form action="<?=$this->framework->url->get_base_url()?>/player/update_profile" method="post" id="profileForm">
                <div class="control-group">
                    <label class="control-label">Full Name</label>
                    <span class="text-muted small">e.g. "Angga Ari Wijaya"</span>
                    <input class="form-control" type="text" name="sgn-name" id="name" value="<?php echo $_SESSION['ply_name'];?>" placeholder="Put your real name here" required>
                </div>
                <div class="control-group">
                    <label class="control-label">Change Password</label>
                    <span class="text-muted small">e.g. "Secret789Labour"</span>
                    <input class="form-control" type="password" name="sgn-password" id="password" placeholder="Type a sensitive wolds as password">
                </div>
                <div class="control-group">
                    <label class="control-label">Confirm Password</label>
                    <input class="form-control" type="password" name="sgn-confirmpassword" id="confirmpassword" placeholder="Type same as password">
                </div>
                <button type="submit" class="btn btn-embossed btn-lg btn-danger" style="margin-top:20px"><span class="fui-new"></span> UPDATE</button>
            </form>
        </div>
        <div class="col-md-4 text-center menu-play">
            <div class="play">
                <a href="<?=$this->framework->url->get_base_url()?>/page/game" class="btn btn-embossed btn-info btn-hg">PLAY</a></button>
                <p>Serious Game</p>
            </div>
            <img src="<?=$this->framework->url->get_base_url()?>/assets/images/layout/play-icon.png" class="img-responsive avatar">
        </div>
    </div>

    <div class="row discovery">
        <div class="col-md-3 col-sm-6">
            <h1>Learn</h1>
            <h3>Basic Accounting</h3>
            <img src="<?=$this->framework->url->get_base_url()?>/assets/images/layout/icon-list.png" class="img-responsive">
            <p>Creating your finance report, writing, tracing, managing. keep your money and assets recorded actually.</p>
            <a href="<?=$this->framework->url->get_base_url()?>/page/seriousgame" class="btn btn-default">Discovery</a>
        </div>
        <div class="col-md-3 col-sm-6">
            <h1>Manage</h1>
            <h3>Stock and Finance</h3>
            <img src="<?=$this->framework->url->get_base_url()?>/assets/images/layout/icon-basket.png" class="img-responsive">
            <p>Buy what you want, but notice how long your stock keep good and sold as customer request regularly and control them.</p>
            <a href="<?=$this->framework->url->get_base_url()?>/page/seriousgame" class="btn btn-default">Discovery</a>
        </div>
        <div class="col-md-3 col-sm-6">
            <h1>Forecast</h1>
            <h3>Customer Behavior</h3>
            <img src="<?=$this->framework->url->get_base_url()?>/assets/images/layout/icon-chart.png" class="img-responsive">
            <p>Predict your consumer, what they are looking for, how they are reject you in bad weather and much more another effect.</p>
            <a href="<?=$this->framework->url->get_base_url()?>/page/seriousgame" class="btn btn-default">Discovery</a>
        </div>
        <div class="col-md-3 col-sm-6">
            <h1>Build</h1>
            <h3>Your Small Business</h3>
            <img src="<?=$this->framework->url->get_base_url()?>/assets/images/layout/icon-shop.png" class="img-responsive">
            <p>Make your performance keep going up, analyze environment, customer, stock, your employee, and stay sharp the advert</p>
            <a href="<?=$this->framework->url->get_base_url()?>/page/seriousgame" class="btn btn-default">Discovery</a>
        </div>
    </div>
</div>

<?php $this->framework->view->show('frontend/modals/uploadprofile')?>