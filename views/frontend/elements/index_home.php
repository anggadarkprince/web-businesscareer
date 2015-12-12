<?php if(!isset($_SESSION['operation'])){ ?>

    <section class="featured hidden-xs">
        <div class="cover">
            <div class="ss-slides">
                <div class="ss-slide" title="Serious Game, Playful Business" data-subtitle="High Design Concept for Learning Game">
                    <img src="<?=$this->framework->url->get_base_url()?>/assets/images/layout/cover1.png" class="img-responsive center-block">
                </div>
                <div class="ss-slide" title="Application Snap Screenshot" data-subtitle="High Design Concept for Learning Game">
                    <img src="<?=$this->framework->url->get_base_url()?>/assets/images/layout/cover2.png" class="img-responsive center-block">
                </div>
				<div class="ss-slide" title="Game World Map Open" data-subtitle="High Design Concept for Learning Game">
                    <img src="<?=$this->framework->url->get_base_url()?>/assets/images/layout/cover3.png" class="img-responsive center-block">
                </div>
                <div class="ss-slide" title="Different Challenges Everyday" data-subtitle="High Design Concept for Learning Game">
                    <img src="<?=$this->framework->url->get_base_url()?>/assets/images/layout/cover4.png" class="img-responsive center-block">
                </div>
            </div>
        </div>
        <div class="featured-bottom"></div>
    </section>

<?php } else{ ?>

    <div style="padding-top: 90px; padding-bottom: 70px"></div>

<?php } ?>

<div class="container">
    <div class="row form-menu">
        <div class="col-md-4 menu-login">
            <h1>Sign In Now</h1>
            <h3>Learn and Training Game</h3>
            <p class="hidden-xs">Your data will load automatically, after login, system will trace your activity and save in log file, you can access your history.</p>
            
            <?php
            if(isset($_SESSION['operation']))
            {
                $status = $_SESSION['operation'];
                if($status=='error'){
                    ?>

                    <div class="alert alert-danger alert-block pam" style="margin-top: 20px">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <span class='fui-cross mrs'></span> <?php echo $_SESSION['message']; ?>
                    </div>

                <?php
                }
                unset($_SESSION['operation']);
                unset($_SESSION['message']);
            }
            ?>

            <form action="<?=$this->framework->url->get_base_url()?>/player/login" method="post" id="loginForm">
                <div class="control-group">
                    <label class="control-label">Email</label>
                    <input class="form-control" type="text" name="log-email" id="email" placeholder="Put your Email address" required>
                </div>
                <div class="control-group">
                    <label class="control-label">Password</label>
                    <input class="form-control" type="password" name="log-password" id="password" placeholder="Put your Password here" required>
                </div>
                <button type="submit" class="btn btn-embossed btn-lg btn-danger pull-right btn-sign-in"><span class="fui-lock"></span> SIGN IN</button>
            </form>
        </div>

        <div class="col-md-4 text-center menu-play hidden-xs">
            <div class="play">
                <a href="#" type="button" class="btn btn-embossed btn-info btn-hg" data-toggle='modal' data-target='#gameLogin'>PLAY</a>
                <p>Serious Game</p>
            </div>
            <img src="<?=$this->framework->url->get_base_url()?>/assets/images/layout/play-icon.png" class="img-responsive avatar">
        </div>

        <div class="col-md-4 menu-registration">
            <h1>Register Now</h1>
            <h3>Take a Seconds to Play the Game</h3>
            <form action="<?=$this->framework->url->get_base_url()?>/player/register" method="post" id="registerForm">
                <div class="control-group">
                    <label class="control-label">Full Name</label>
                    <span class="text-muted small">e.g. "Angga Ari Wijaya"</span>
                    <input class="form-control" type="text" name="reg-name" id="name" placeholder="Put your real name here" required>
                </div>
                <div class="control-group">
                    <label class="control-label">Email</label>
                    <span class="text-muted small">e.g. "anggadarkprince@gmail.com"</span>
                    <input class="form-control" type="email" name="reg-email" id="email" placeholder="Email address as User ID" required>
                </div>
                <div class="control-group">
                    <label class="control-label">Password</label>
                    <span class="text-muted small">e.g. "Secret789Labour"</span>
                    <input class="form-control" type="password" name="reg-password" id="password" placeholder="Type a sensitive wolds as password" required>
                </div>
                <button type="submit" class="btn btn-embossed btn-lg btn-danger"><span class="fui-check"></span> SIGN UP</button>
            </form>
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

<?php $this->framework->view->show('frontend/modals/gamelogin')?>