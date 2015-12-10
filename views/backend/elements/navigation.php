<?php
if(isset($page))
{
    $active_dashboard = null;
    $active_player = null;
    $active_statistic = null;
    $active_report = null;
    $active_feedback = null;

    switch($page){
        case 'dashboard':
            $active_dashboard = "active";
            break;
        case 'setting':
            $active_setting = "active";
            break;
        case 'player':
            $active_player = "active";
            break;
        case 'statistic':
            $active_statistic = "active";
            break;
        case 'report':
            $active_report = "active";
            break;
        case 'feedback':
            $active_feedback = "active";
            break;
        case 'about':
            $active_about = "active";
            break;
    }
}
?>

<nav class="main-sidebar" role="navigation">
    <div class="sidebar-collapse">
        <header class="avatar">
            <img src="<?=$this->framework->url->get_base_url()?>/assets/images/avatar/<?=$_SESSION['web_avatar'];?>" class="img-responsive pull-left">
            <div class="info">
                <P class="name"><?=$_SESSION['web_name']?></P>
                <p class="role">Game Super User</p>
            </div>
            <div class="clearfix"></div>
        </header>
        <ul class="nav navigation">
            <li class="<?=$active_dashboard?> dashboard"><a href="<?=$this->framework->url->get_base_url()?>/dashboard">Dashboard</a></li>
            <li class="<?=$active_setting?> setting"><a href="<?=$this->framework->url->get_base_url()?>/dashboard/setting">Settings</a></li>
            <li class="<?=$active_player?> player"><a href="<?=$this->framework->url->get_base_url()?>/player">Players <span class="navbar-new"><?=$_SESSION['web_new_player']?></span></a></li>
            <li class="<?=$active_statistic?> statistic"><a href="<?=$this->framework->url->get_base_url()?>/statistic">Statistic</a></li>
            <li class="<?=$active_report?> report"><a href="<?=$this->framework->url->get_base_url()?>/report">Report</a></li>
            <li class="<?=$active_feedback?> feedback"><a href="<?=$this->framework->url->get_base_url()?>/feedback">Feedback</a></li>
            <li class="<?=$active_about?> about"><a href="<?=$this->framework->url->get_base_url()?>/dashboard/about">About</a></li>
        </ul>
    </div>
</nav>