<nav class="navbar navbar-default" role="navigation">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
            <span class="sr-only">Toggle navigation</span>
        </button>
        <a class="navbar-brand" href="<?=$this->framework->url->get_base_url()?>">Business Career</a>
    </div>
    <div>
        <ul class="nav navbar-nav">
            <li class="hidden-sm hidden-xs">
                <a href="#fakelink" id="toogle-collapse"><span class="fui-list"></span></a>
            </li>
            <li>
                <div class="dropdown" style="width: 150px">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><strong>Control Panel</strong> <b class="caret"></b></a>
                    <span class="dropdown-arrow"></span>
                    <ul class="dropdown-menu">
                        <li><a href="<?=$this->framework->url->get_base_url()?>/player"><span class="fui-user"></span> &nbsp; Player</a></li>
                        <li><a href="<?=$this->framework->url->get_base_url()?>/statistic"><span class="fui-list"></span> &nbsp; Statistic</a></li>
                        <li class="divider"></li>
                        <li><a href="<?=$this->framework->url->get_base_url()?>/administrator/logout"><span class="fui-lock"></span> &nbsp; Sign Out</a></li>
                    </ul>
                </div>
            </li>
            <li class="hidden-sm hidden-xs">
                <a href="<?=$this->framework->url->get_base_url()?>/dashboard/about"><span class="fui-heart"></span> About</a>
            </li>
            <li class="hidden-xs">
                <a href="<?=$this->framework->url->get_base_url()?>" target="_blank"><span class="fui-gear"></span> Goto Web</a>
            </li>
        </ul>
        <div class="player pull-right">
            <p class="text-muted">Total Player</p>
            <h3><?=$_SESSION['web_total_player']?></h3>
        </div>
    </div>
</nav>