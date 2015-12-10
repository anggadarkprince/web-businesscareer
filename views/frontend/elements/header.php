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

<header class="top-header">
    <ul class="navigation list-inline">
        <li <?=$active_index?>><a href="<?=$this->framework->url->get_base_url()?>">Home</a></li>
        <li <?=$active_accounting?>><a href="<?=$this->framework->url->get_base_url()?>/page/accounting">Accounting</a></li>
        <li <?=$active_seriousgame?>><a href="<?=$this->framework->url->get_base_url()?>/page/seriousgame">Serious Game</a></li>
        <li <?=$active_contact?>><a href="<?=$this->framework->url->get_base_url()?>/page/contact">Contact</a></li>
    </ul>
    <a href="<?=$this->framework->url->get_base_url()?>" class="logo"><h1>Business Career</h1></a>
    <div class="clearfix"></div>
</header>