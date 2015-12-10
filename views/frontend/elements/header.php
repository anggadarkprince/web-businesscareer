<?php
if(isset($page))
{
    $active_index = null;
    $active_accounting = null;
    $active_seriousgame = null;
    $active_contact = null;

    switch($page){
        case 'index':
            $active_index = "class='active'";
            break;
        case 'accounting':
            $active_accounting = "class='active'";
            break;
        case 'seriousgame':
            $active_seriousgame = "class='active'";
            break;
        case 'contact':
            $active_contact = "class='active'";
            break;
    }
}
?>

<header class="top-header hidden-xs">
    <ul class="navigation list-inline">
        <li <?=$active_index?>><a href="<?=$this->framework->url->get_base_url()?>">Home</a></li>
        <li <?=$active_accounting?>><a href="<?=$this->framework->url->get_base_url()?>/page/accounting">Accounting</a></li>
        <li <?=$active_seriousgame?>><a href="<?=$this->framework->url->get_base_url()?>/page/seriousgame">Serious Game</a></li>
        <li <?=$active_contact?>><a href="<?=$this->framework->url->get_base_url()?>/page/contact">Contact</a></li>
    </ul>
    <a href="<?=$this->framework->url->get_base_url()?>" class="logo"><h1>Business Career</h1></a>
    <div class="clearfix"></div>
</header>

<header class="top-header-mobile visible-xs">
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">SERIOUS GAME</a>
        </div>

        <!-- Collect the nav links and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li <?=$active_index?>><a href="<?=$this->framework->url->get_base_url()?>">Home</a></li>
                <li <?=$active_accounting?>><a href="<?=$this->framework->url->get_base_url()?>/page/accounting">Accounting</a></li>
                <li <?=$active_seriousgame?>><a href="<?=$this->framework->url->get_base_url()?>/page/seriousgame">Serious Game</a></li>
                <li <?=$active_contact?>><a href="<?=$this->framework->url->get_base_url()?>/page/contact">Contact</a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
    <img src="<?=$this->framework->url->get_base_url()?>/assets/images/layout/cover1.png" class="img-responsive center-block visible-xs mobile-cover">
</header>

