<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Business Career - Serious Game</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="google" value="notranslate" />
	
	<style type="text/css" media="screen">
		object:focus { outline:none; }
        #flashContent { display:none; }
	</style>

    <!-- Loading Bootstrap -->
    <link href="<?=$this->framework->url->get_base_url()?>/assets/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Loading Flat UI -->
    <link href="<?=$this->framework->url->get_base_url()?>/assets/css/flat-ui.css" rel="stylesheet">

    <!-- Loading Public Styles -->
    <link href="<?=$this->framework->url->get_base_url()?>/assets/css/public.css" rel="stylesheet">

    <link rel="shortcut icon" href="<?=$this->framework->url->get_base_url()?>/assets/images/favicon.png">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
    <!--[if lt IE 9]>
    <script src="<?=$this->framework->url->get_base_url()?>/assets/js/html5shiv.js"></script>
    <script src="<?=$this->framework->url->get_base_url()?>/assets/js/respond.min.js"></script>
    <![endif]-->

	<script type="text/javascript" src="<?=$this->framework->url->get_base_url()?>/game/bin-debug/swfobject.js"></script>
	<script type="text/javascript">
		// For version detection, set to min. required Flash Player version, or 0 (or 0.0.0), for no version detection. 
		var swfVersionStr = "11.1.0";
		// To use express install, set to playerProductInstall.swf, otherwise the empty string. 
		var xiSwfUrlStr = "playerProductInstall.swf";
		var flashvars = {};
		var params = {};
		params.quality = "high";
		params.wmode = "direct";
		params.bgcolor = "#333333";
		params.allowscriptaccess = "sameDomain";
		params.allowfullscreen = "true";
		var attributes = {};
		attributes.id = "BusinessCareer";
		attributes.name = "BusinessCareer";
		attributes.align = "middle";
		swfobject.embedSWF(
			"<?=$this->framework->url->get_base_url()?>/game/bin-debug/BusinessCareer.swf", "flashContent", 
			"1000", "560", 
			swfVersionStr, xiSwfUrlStr, 
			flashvars, params, attributes);
		// JavaScript enabled so display the flashContent div in case it is not replaced with a swf object.
		swfobject.createCSS("#flashContent", "display:block;text-align:left;");
	</script>
</head>

<body class="game">
        <div class="game-container">
            <header class="game-header">
                <div class="row">
                    <div class="col-md-7">
                        <a href="<?=$this->framework->url->get_base_url()?>"><img src="<?=$this->framework->url->get_base_url()?>/assets/images/layout/logo-support.png" width="380" class="img-responsive"></a>
                    </div>
                    <div class="col-md-5">
                        <ul class="list-inline social-links">
                            <li><a href="https://www.facebook.com/businesscareer" target="_blank"><img src="<?=$this->framework->url->get_base_url()?>/assets/images/layout/social-facebook.png"> &nbsp; Fans Page</a></li>
                            <li><a href="https://www.twitter.com/businesscareer" target="_blank"><img src="<?=$this->framework->url->get_base_url()?>/assets/images/layout/social-twitter.png"> &nbsp; Twitter</a></li>
                            <li><a href="http://businesscareer.wordpress.com" target="_blank"><img src="<?=$this->framework->url->get_base_url()?>/assets/images/layout/social-rss.png"> &nbsp; Official Blog</a></li>
                        </ul>
                    </div>
                </div>
            </header>

            <section class="game-wrapper">
				<div id="flashContent">
					<p>
						To view this page ensure that Adobe Flash Player version 
						11.1.0 or greater is installed. 
					</p>
					<script type="text/javascript"> 
						var pageHost = ((document.location.protocol == "https:") ? "https://" : "http://"); 
						document.write("<a href='http://www.adobe.com/go/getflashplayer'><img src='" 
										+ pageHost + "www.adobe.com/images/shared/download_buttons/get_flash_player.gif' alt='Get Adobe Flash player' /></a>" ); 
					</script> 
				</div>
				
				<noscript>
					<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="1000" height="560" id="BusinessCareer">
						<param name="movie" value="<?=$this->framework->url->get_base_url()?>/game/bin-debug/BusinessCareer.swf" />
						<param name="quality" value="high" />
						<param name="bgcolor" value="#333333" />
						<param name="allowScriptAccess" value="sameDomain" />
						<param name="allowFullScreen" value="true" />
						<!--[if !IE]>-->
						<object type="application/x-shockwave-flash" data="<?=$this->framework->url->get_base_url()?>/game/bin-debug/BusinessCareer.swf" width="1000" height="560">
							<param name="quality" value="high" />
							<param name="bgcolor" value="#333333" />
							<param name="allowScriptAccess" value="sameDomain" />
							<param name="allowFullScreen" value="true" />
						<!--<![endif]-->
						<!--[if gte IE 6]>-->
							<p> 
								Either scripts and active content are not permitted to run or Adobe Flash Player version
								11.1.0 or greater is not installed.
							</p>
						<!--<![endif]-->
							<a href="http://www.adobe.com/go/getflashplayer">
								<img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash Player" />
							</a>
						<!--[if !IE]>-->
						</object>
						<!--<![endif]-->
					</object>
				</noscript>
            </section>

            <footer class="game-footer">
                <ul class="list-inline center-block">
                    <li><a href="<?=$this->framework->url->get_base_url()?>">Home</a></li>
                    <li><a href="<?=$this->framework->url->get_base_url()?>/page/accounting">Accounting</a></li>
                    <li><a href="<?=$this->framework->url->get_base_url()?>/page/seriousgame">Serious Game</a></li>
                    <li><a href="<?=$this->framework->url->get_base_url()?>/page/privacy">Privacy</a></li>
                    <li><a href="<?=$this->framework->url->get_base_url()?>/page/disclaimer">Disclaimer</a></li>
                    <li><a href="<?=$this->framework->url->get_base_url()?>/page/agreement">Agreement</a></li>
                    <li><a href="<?=$this->framework->url->get_base_url()?>/page/contact">Contact</a></li>
                </ul>
                <p>&copy <?=date("Y")?> SeriousGame.Inc, made with <span class="glyphicon glyphicon-heart"></span> and Actionscript 3.0</p>
            </footer>
        </div>


        <!-- Load JS here for greater good =============================-->
        <script src="<?=$this->framework->url->get_base_url()?>/assets/js/jquery-1.8.3.min.js"></script>
        <script src="<?=$this->framework->url->get_base_url()?>/assets/js/jquery-ui-1.10.3.custom.min.js"></script>
        <script src="<?=$this->framework->url->get_base_url()?>/assets/js/jquery.ui.touch-punch.min.js"></script>
        <script src="<?=$this->framework->url->get_base_url()?>/assets/js/bootstrap.min.js"></script>
        <script src="<?=$this->framework->url->get_base_url()?>/assets/js/bootstrap-select.js"></script>
        <script src="<?=$this->framework->url->get_base_url()?>/assets/js/bootstrap-switch.js"></script>
        <script src="<?=$this->framework->url->get_base_url()?>/assets/js/flatui-checkbox.js"></script>
        <script src="<?=$this->framework->url->get_base_url()?>/assets/js/flatui-radio.js"></script>
        <script src="<?=$this->framework->url->get_base_url()?>/assets/js/jquery.tagsinput.js"></script>
        <script src="<?=$this->framework->url->get_base_url()?>/assets/js/jquery.placeholder.js"></script>
        <script src="<?=$this->framework->url->get_base_url()?>/assets/js/application.js"></script>
        <script>
            $(document).ready(function(){

                check_vertical();

                $(window).resize(function(){
                    check_vertical();
                });

                function check_vertical(){
                    var content_height = $(".game").height();
                    var window_height = $(window).height();
                    if(content_height < window_height){
                        $("body").addClass("center-vertical");
                    }
                    else{
                        $("body").removeClass("center-vertical");
                    }
                }

            });
        </script>
    </body>

</html>