<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Serious Game</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Loading Bootstrap -->
        <link href="<?=$this->framework->url->get_base_url()?>/assets/bootstrap/css/bootstrap.css" rel="stylesheet">

        <!-- Loading Flat UI -->
        <link href="<?=$this->framework->url->get_base_url()?>/assets/css/flat-ui.css" rel="stylesheet">

        <!-- Loading Template Style -->
        <link href="<?=$this->framework->url->get_base_url()?>/assets/css/default.css" rel="stylesheet">

        <!-- Loading Favicon -->
        <link rel="shortcut icon" href="images/favicon.ico">

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
        <!--[if lt IE 9]>
          <script src="js/html5shiv.js"></script>
          <script src="js/respond.min.js"></script>
        <![endif]-->
    </head>
    <body style="background: #e5e9ec">
    <div class="error404">

        <h1 class="text-muted"><span class="glyphicon glyphicon-list-alt icon"></span> ERROR<span class="text-primary">404</span></h1>
        <p class="lead unavailable">Sorry, this page unavailable</p>
        <p class="lead description">The page your looking for is not here</p>

        <a href="<?php echo $targetlink; ?>" class="btn btn-lg btn-primary btn-embossed"><span class="glyphicon glyphicon-chevron-left"></span> Turn Back, <strong>Click Here</strong></a>

        <p class="available">AVAILABLE CONTENT</p>

        <ul class="footer-links list-inline center-block text-primary">
            <li><a href="#">Privacy</a></li>
            <li><a href="#">Help</a></li>
            <li><a href="#">Disclaimer</a></li>
            <li><a href="#">Help &amp; FAQ</a></li>
            <li><a href="#">Reports</a></li>
            <li><a href="#">Search</a></li>
        </ul>
        <ul class="footer-links list-inline small center-block">
            <li><a href="#">Home</a></li>
            <li><a href="#">Game</a></li>
            <li><a href="#">Accounting</a></li>
            <li><a href="#">Serious Game</a></li>
            <li><a href="#">Contact</a></li>
        </ul>

        <footer class="center-block">
            All work copyright of respective owner, &copy 2014 SeriousGame.Inc, made with <span class="glyphicon glyphicon-heart"></span> and PHP
        </footer>
    </div>

    </body>
</html>
