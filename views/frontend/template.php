<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Business Career - Serious Game</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Loading Bootstrap -->
    <link rel="stylesheet" href="<?=$this->framework->url->get_base_url()?>/assets/bootstrap/css/bootstrap.css">

    <!-- Loading Flat UI -->
    <link rel="stylesheet" href="<?=$this->framework->url->get_base_url()?>/assets/css/flat-ui.css">

    <!-- Loading Public Styles -->
    <link rel="stylesheet" href="<?=$this->framework->url->get_base_url()?>/assets/css/public.css">

    <!-- Loading Jquery Image Area Select Styles -->
    <link rel="stylesheet" href="<?=$this->framework->url->get_base_url()?>/assets/extended/jQueryImgAreaSelect/css/imgareaselect-animated.css">

    <!-- Loading Smooth Slides -->
    <link rel="stylesheet" href="<?=$this->framework->url->get_base_url()?>/assets/extended/SmoothSlides/smoothslides.theme.css">

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?=$this->framework->url->get_base_url()?>/assets/images/favicon.png">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
    <!--[if lt IE 9]>
    <script src="<?=$this->framework->url->get_base_url()?>/assets/js/html5shiv.js"></script>
    <script src="<?=$this->framework->url->get_base_url()?>/assets/js/respond.min.js"></script>
    <![endif]-->
</head>

<body>
        <?php $this->framework->view->show('/frontend/elements/header')?>

        <?php $this->framework->view->show($content)?>

        <?php $this->framework->view->show('/frontend/elements/footer')?>

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
        <script src="<?=$this->framework->url->get_base_url()?>/assets/extended/jQueryValidation/jquery.validate.min.js"></script>
        <script src="<?=$this->framework->url->get_base_url()?>/assets/extended/jQueryImgAreaSelect/js/jquery.imgareaselect.pack.js"></script>
        <script src="<?=$this->framework->url->get_base_url()?>/assets/extended/SmoothSlides/smoothslides.min.js" type="text/javascript"></script>

        <script src="<?=$this->framework->url->get_base_url()?>/assets/js/application.js"></script>
        <script>
            $(window).load(function() {
                $(document).smoothSlides({
                    duration: 4000,
                    effect:['panLeft', 'panRight'],
                    navigation: 'false'
                });
            });

            $(document).ready(function() {
                function setInfo(i, e) {
                    $('#x').val(e.x1);
                    $('#y').val(e.y1);
                    $('#w').val(e.width);
                    $('#h').val(e.height);
                }

                var p = $("#uploadPreview");
                var t = $("#uploadPreviewTemp");

                // prepare instant preview
                $("#uploadImage").change(function(){
                    // fadeOut or hide preview
                    p.fadeOut();

                    // prepare HTML5 FileReader
                    var oFReader = new FileReader();
                    oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);

                    oFReader.onload = function (oFREvent) {
                        t.attr('src', oFREvent.target.result).show(1,function(){
                            $(this).hide();
                        });

                        p.attr('src', oFREvent.target.result).fadeIn(100,function(){
                            $(".avatar-crop-wrapper").width(p.width());
                        });
                    };
                });

                // implement imgAreaSelect plug in (http://odyniec.net/projects/imgareaselect/)
                $('img#uploadPreview').imgAreaSelect({
                    // set crop ratio (optional)
                    aspectRatio: '1:1',
                    onSelectEnd: setInfo,
                    handles: true,
                    show:true
                });

                $("#closecrop").click(function(){
                    $('img#uploadPreview').imgAreaSelect({hide:true});
                });

            });
            $(document).ready(function(){
                var form = $('#feedbackForm'); // contact form
                var submit = $('#feedbackSubmit');	// submit button
                var alert = $('.alert-feedback'); // alert div for show alert message

                alert.hide();

                function reset_alert(){
                    alert.hide();
                    alert.removeClass("alert-success");
                    alert.removeClass("alert-info");
                    alert.removeClass("alert-danger");
                }

                // form submit event
                function sendFeedback(){
                    // sending ajax request through jQuery
                    $.ajax({
                        url: '<?=$this->framework->url->get_base_url()?>/feedback/send_feedback', // form action url
                        type: 'POST', // form submit method get/post
                        dataType: 'html', // request type html/json/xml
                        data: form.serialize(), // serialize form data
                        beforeSend: function() {
                            reset_alert();
                            alert.fadeIn().addClass("alert-info");
                            alert.html("<span class='fui-time'></span> Data updating, Please wait....");
                            submit.html('<span class="fui-chat"></span> Sending....'); // change submit button text
                        },
                        success: function(data) {
                            reset_alert();
                            alert.fadeIn().addClass("alert-success");
                            alert.html("<button type='button' class='close' data-dismiss='alert'>&times;</button><span class='fui-check'></span> "+data); // fade in response data
                            form.trigger('reset'); // reset form
                            submit.html('<span class="fui-chat"></span> Submit'); // reset submit button text
                        },
                        error: function(e) {
                            reset_alert();
                            alert.html("<button type='button' class='close' data-dismiss='alert'>&times;</button><span class='fui-cross'></span> Sending request failed, try again...").addClass("alert-danger");
                            console.log(e)
                        }
                    });
                }

                $("#feedbackForm").validate({
                    rules: {
                        name: "required",
                        email: {
                            required: true,
                            email: true
                        },
                        subject: "required",
                        message: "required"
                    },
                    messages: {
                        name: "Please enter your complete name",
                        email: {
                            required: "Please enter your email address",
                            email: "Please enter valid email format"
                        },
                        subject: "Please enter a subject",
                        message: "Please enter your comment or critic"
                    },
                    submitHandler: function(form) {
                        sendFeedback();
                    }
                });

                $("#registerForm").validate({
                    rules: {
                        "reg-name": {
                            required: true
                        },
                        "reg-email": {
                            required: true,
                            email: true
                        },
                        "reg-password": {
                            required: true,
                            minlength: 5
                        }
                    },
                    messages: {
                        "reg-name": "Please enter your complete name",
                        "reg-email": {
                            required: "Please enter your email address",
                            email: "Please enter valid email format"
                        },
                        "reg-password": {
                            required: "Please take a password",
                            minlength: "Minimum length is 5 character"
                        }
                    }
                });

                $("#profileForm").validate({
                    rules: {
                        "sgn-name": {
                            required: true
                        },
                        "sgn-password": {
                            minlength: 5
                        },
                        "sgn-confirmpassword": {
                            minlength: 5,
                            equalTo: "#password"
                        }
                    },
                    messages: {
                        "sgn-name": "Please enter your complete name",
                        "sgn-password": {
                            minlength: "Minimum length is 5 character"
                        },
                        "sgn-confirmpassword": {
                            minlength: "Your password must be at least 5 characters long",
                            equalTo: "Please enter the same password as above"
                        }
                    }
                });

                $("#loginForm").validate({
                    rules: {
                        "log-password": "required",
                        "log-email": {
                            required: true,
                            email: true
                        }
                    },
                    messages: {
                        "log-password": "Please enter your secret key",
                        "log-email": {
                            required: "Please enter your email address as ID",
                            email: "Please enter valid email format"
                        }
                    }
                });
            });
        </script>

    </body>

</html>





