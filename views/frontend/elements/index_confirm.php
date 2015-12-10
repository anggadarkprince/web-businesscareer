<div class="container content" style="padding-top: 70px; padding-bottom: 70px">
    <?php
    session_start();
    if(isset($_SESSION['operation']))
    {
        $status = $_SESSION['operation'];
        if($status=='success'){
            ?>
            <div class="row form-menu">
                <div class="col-md-4 col-sm-4 col-xs-4 text-right">
                    <span class="fui-mail" style="font-size: 4em"></span>
                </div>
                <div class="col-md-8 col-sm-8 col-xs-8">
                    <h1>Registration Complete</h1>
                    <h3>Thank for join, enjoy playful business</h3>
                    <p>User has been confirmed. Thank-You!!, <a href="<?=$this->framework->url->get_base_url()?>">click here</a> to login</p>
                </div>
            </div>
        <?php
        }
        else if($status=='error'){
            ?>
            <div class="row form-menu">
                <div class="col-md-4 col-sm-4 col-xs-4 text-right">
                    <span class="fui-cross" style="font-size: 4em"></span>
                </div>
                <div class="col-md-8 col-sm-8 col-xs-8">
                    <h1>Confirm Failed</h1>
                    <h3>Double check your email</h3>
                    <p>Confirmation failed, <a href="<?=$this->framework->url->get_base_url()?>">click here</a> to register</p>
                </div>
            </div>
        <?php
        }
        unset($_SESSION['operation']);
    }
    else{
        transport("page");
    }
    ?>


    <div class="row discovery">
        <div class="col-md-3 col-sm-6">
            <h1>Learn</h1>
            <h3>Basic Accounting</h3>
            <img src="<?=$this->framework->url->get_base_url()?>/assets/images/layout/icon-list.png" class="img-responsive">
            <p>Creating your finance report, writing, tracing, managing. keep your money and assets recorded actually.</p>
            <a href="<?=$this->framework->url->get_base_url()?>/seriousgame/index/learn" class="btn btn-default">Discovery</a>
        </div>
        <div class="col-md-3 col-sm-6">
            <h1>Manage</h1>
            <h3>Stock and Finance</h3>
            <img src="<?=$this->framework->url->get_base_url()?>/assets/images/layout/icon-basket.png" class="img-responsive">
            <p>Buy what you want, but notice how long your stock keep good and sold as customer request regularly and control them.</p>
            <a href="<?=$this->framework->url->get_base_url()?>/seriousgame/index/manage" class="btn btn-default">Discovery</a>
        </div>
        <div class="col-md-3 col-sm-6">
            <h1>Forecast</h1>
            <h3>Customer Behavior</h3>
            <img src="<?=$this->framework->url->get_base_url()?>/assets/images/layout/icon-chart.png" class="img-responsive">
            <p>Predict your consumer, what they are looking for, how they are reject you in bad weather and much more another effect.</p>
            <a href="<?=$this->framework->url->get_base_url()?>/seriousgame/index/forecast" class="btn btn-default">Discovery</a>
        </div>
        <div class="col-md-3 col-sm-6">
            <h1>Build</h1>
            <h3>Your Small Business</h3>
            <img src="<?=$this->framework->url->get_base_url()?>/assets/images/layout/icon-shop.png" class="img-responsive">
            <p>Make your performance keep going up, analyze environment, customer, stock, your employee, and stay sharp the advert</p>
            <a href="<?=$this->framework->url->get_base_url()?>/seriousgame/index/build" class="btn btn-default">Discovery</a>
        </div>
    </div>

</div>