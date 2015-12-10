<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Administrator Business Career</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Loading Bootstrap -->
        <link rel="stylesheet" href="<?=$this->framework->url->get_base_url()?>/assets/bootstrap/css/bootstrap.css">

        <!-- Loading Flat UI -->
        <link rel="stylesheet" href="<?=$this->framework->url->get_base_url()?>/assets/css/flat-ui.css">

        <!-- Loading Private Styles -->
        <link rel="stylesheet" href="<?=$this->framework->url->get_base_url()?>/assets/css/private.css">

        <!-- Loading Font Awesome Styles -->
        <link rel="stylesheet" href="<?=$this->framework->url->get_base_url()?>/assets/css/font-awesome.min.css">

        <!-- Loading Data Table Styles -->
        <link rel="stylesheet" href="<?=$this->framework->url->get_base_url()?>/assets/extended/jQueryDatatable/css/jquery.dataTables.css"/>

        <!-- Favicon -->
        <link rel="shortcut icon" href="<?=$this->framework->url->get_base_url()?>/assets/images/favicon.png">

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
        <!--[if lt IE 9]>
        <script src="<?=$this->framework->url->get_base_url()?>/assets/js/html5shiv.js"></script>
        <script src="<?=$this->framework->url->get_base_url()?>/assets/js/respond.min.js"></script>
        <![endif]-->

        <!-- JQuery -->
        <script src="<?=$this->framework->url->get_base_url()?>/assets/js/jquery-1.8.3.min.js"></script>

    </head>

    <body>
        <?php $this->framework->view->show("/backend/elements/header"); ?>
        <?php $this->framework->view->show("/backend/elements/navigation"); ?>

        <div class="main-container">
            <div class="main-content">
                <?php $this->framework->view->show($content); ?>
            </div>
        </div>


        <?php $this->framework->view->show("/backend/elements/footer"); ?>


        <!-- Load JS here for greater good =============================-->
        <script src="<?=$this->framework->url->get_base_url()?>/assets/js/jquery-ui-1.10.3.custom.min.js"></script>
        <script src="<?=$this->framework->url->get_base_url()?>/assets/js/jquery.ui.touch-punch.min.js"></script>
        <script src="<?=$this->framework->url->get_base_url()?>/assets/js/bootstrap.min.js"></script>
        <script src="<?=$this->framework->url->get_base_url()?>/assets/js/bootstrap-select.js"></script>
        <script src="<?=$this->framework->url->get_base_url()?>/assets/js/bootstrap-switch.js"></script>
        <script src="<?=$this->framework->url->get_base_url()?>/assets/js/flatui-checkbox.js"></script>
        <script src="<?=$this->framework->url->get_base_url()?>/assets/js/flatui-radio.js"></script>
        <script src="<?=$this->framework->url->get_base_url()?>/assets/js/jquery.tagsinput.js"></script>
        <script src="<?=$this->framework->url->get_base_url()?>/assets/js/jquery.placeholder.js"></script>

        <!-- Highchart plugins -->
        <script src="<?=$this->framework->url->get_base_url()?>/assets/extended/HighChart/highcharts.js"></script>
        <script src="<?=$this->framework->url->get_base_url()?>/assets/extended/HighChart/modules/exporting.js"></script>
        <script src="<?=$this->framework->url->get_base_url()?>/assets/extended/HighChart/modules/data.js"></script>
        <script src="<?=$this->framework->url->get_base_url()?>/assets/extended/HighChart/highcharts-more.js"></script>

        <!-- Datatable plugins -->
        <script src="<?=$this->framework->url->get_base_url()?>/assets/extended/jQueryDatatable/js/jquery.dataTables.min.js" type="text/javascript" ></script>
        <script src="<?=$this->framework->url->get_base_url()?>/assets/extended/jQueryDatatable/extra/js/TableTools.min.js" type="text/javascript" ></script>

        <!-- Validation plugins -->
        <script src="<?=$this->framework->url->get_base_url()?>/assets/extended/jQueryValidation/jquery.validate.min.js"></script>

        <!-- App js -->
        <script src="<?=$this->framework->url->get_base_url()?>/assets/js/datatables.js" type="text/javascript"></script>
        <script src="<?=$this->framework->url->get_base_url()?>/assets/js/application.js"></script>

        <script>
            $(document).ready(function(){

                check_vertical();

                $(window).resize(function(){
                    check_vertical();
                });

                function check_vertical(){
                    var content_height = $("body").height();
                    var window_height = $(window).height();
                    if(content_height < window_height){
                        $(".main-container").addClass("content-stretch");
                        $(".bottom-footer").addClass("bottom-footer-fixed");
                    }
                    else{
                        $(".main-container").removeClass("content-stretch");
                        $(".bottom-footer").removeClass("bottom-footer-fixed");
                    }
                }

            });
        </script>

    </body>
</html>