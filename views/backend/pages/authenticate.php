<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Administrator Business Career</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Loading Bootstrap -->
    <link href="<?=$this->framework->url->get_base_url()?>/assets/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Loading Flat UI -->
    <link href="<?=$this->framework->url->get_base_url()?>/assets/css/flat-ui.css" rel="stylesheet">

    <!-- Loading Public Styles -->
    <link href="<?=$this->framework->url->get_base_url()?>/assets/css/login.css" rel="stylesheet">

    <link rel="shortcut icon" href="<?=$this->framework->url->get_base_url()?>/assets/images/favicon.png">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
    <!--[if lt IE 9]>
    <script src="<?=$this->framework->url->get_base_url()?>/assets/js/html5shiv.js"></script>
    <script src="<?=$this->framework->url->get_base_url()?>/assets/js/respond.min.js"></script>
    <![endif]-->


</head>

<body>
    <div class="login-wrapper">
        <div class="row">
            <div class="col-md-6">
                <a href="<?=$this->framework->url->get_base_url()?>"><img src="<?=$this->framework->url->get_base_url()?>/assets/images/layout/login-mascot.png" class="img-responsive hidden-xs hidden-sm"></a>
            </div>
            <div class="col-md-6">
                <div class="login-form">
                    <form action="<?=$this->framework->url->get_base_url()?>/administrator/login" method="post">
                        <div class="row">
                            <div class="col-md-3">
                                <h2 class="text-custom mtx mbx text-center"><span class="fui-lock"></span></h2>
                            </div>
                            <div class="col-md-9 title">
                                <h4 class="text-custom mtx mbx">Private Access</h4>
                                <p class="text-muted">Control Panel Sign In</p>
                            </div>
                        </div>


                        <div class="form-group">
                            <input type="text" class="form-control login-field" value="" placeholder="Enter your ID" name="username" id="login-name" />
                            <label class="login-field-icon fui-user" for="login-name"></label>
                        </div>

                        <div class="form-group" id="password_holder">
                            <input type="password" class="form-control login-field" value="" placeholder="Password" name="password" id="login-pass" />
                            <label class="login-field-icon fui-lock" for="login-pass"></label>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-xs-6">
                                    <label class="checkbox mts" for="remember">
                                        <input type="checkbox" name="remember" checked value="" id="remember" data-toggle="checkbox">
                                        Remember Me
                                    </label>
                                </div>
                                <div class="col-xs-6">
                                    <div class="switch pull-right"
                                         data-on-label="<b style='margin-right:5px'>show</b>"
                                         data-off-label="<b style='margin-right:5px'>hide</b>">
                                        <input type="checkbox" id="showpassword" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php
                        if(isset($_SESSION['operation']))
                        {
                            $status = $_SESSION['operation'];
                            if($status=='error'){
                                ?>
                                <div class="alert alert-danger alert-block" style="margin-top: 20px">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <small><?php echo $_SESSION['message']; ?></small>
                                </div>
                            <?php
                            }
                            unset($_SESSION['operation']);
                            unset($_SESSION['message']);
                        }
                        ?>

                        <button type="submit" class="btn btn-custom btn-lg btn-block btn-embossed">Login</button>
                        <a class="login-link" href="#">Lost your password?</a>
                    </form>
                </div>
                <footer class="center-block text-center text-inverse">
                    &copy 2014 made with <span class="glyphicon glyphicon-heart"></span> and Actionscript 3.0<br>
                    All work copyright of respective owner
                </footer>
            </div>
        </div>
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
            $('.login-wrapper').slideDown(500);

            $('#showpassword').change(function(){
                var input_password = $("#login-pass");

                var value = input_password.val();
                var type = input_password.attr('type');
                var name = input_password.attr('name');
                var id = input_password.attr('id');
                var cls = input_password.attr('class');
                var plc = input_password.attr('placeholder');

                input_password.remove();

                var new_type = (type == 'password') ? 'text' : 'password';
                input_password.attr('type',new_type);
                $("#password_holder").prepend("<input type='"+new_type+"' value='"+value+"' name='"+name+"' id='"+id+"' class='"+cls+"' placeholder='"+plc+"' />");
            });
        });
    </script>
</body>
</html>