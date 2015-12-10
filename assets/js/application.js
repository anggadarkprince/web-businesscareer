// Some general UI pack related JS
// Extend JS String with repeat method
String.prototype.repeat = function (num) {
    return new Array(num + 1).join(this);
};


(function ($) {

    hide_side();

    function show_side(){
        $("#toogle-collapse").one("click",function(){
            $(".main-sidebar").addClass("show").removeClass("hidden");
            $(".main-container").addClass("collapse-off").removeClass("collapse-on");
            hide_side();
        });
    }
    function hide_side(){
        $("#toogle-collapse").one("click",function(){
            $(".main-sidebar").addClass("hidden").removeClass("show");
            $(".main-container").addClass("collapse-on").removeClass("collapse-off");
            show_side();
        });
    }

	// toggle responsive navigation
	$(window).bind("load resize", function () {
		if ($(this).width() < 768) {
            $(".main-sidebar").removeClass("hidden");
			$('div.sidebar-collapse').addClass('collapse');
            $(".main-container").removeClass("collapse-off").removeClass("collapse-on");
            hide_side();
		} else {
			$('div.sidebar-collapse').removeClass('collapse')
		}
	});
	
	// static stars
	$(".star-rating").each(function(){
		var widthstar = 25 * $(this).text();
		$(this).css("width",widthstar);
	});

    // Add segments to a slider
    $.fn.addSliderSegments = function (amount, orientation) {
        return this.each(function () {
            if (orientation == "vertical") {
                var output = ''
                    , i;
                for (i = 1; i <= amount - 2; i++) {
                    output += '<div class="ui-slider-segment" style="top:' + 100 / (amount - 1) * i + '%;"></div>';
                }
                ;
                $(this).prepend(output);
            } else {
                var segmentGap = 100 / (amount - 1) + "%"
                    , segment = '<div class="ui-slider-segment" style="margin-left: ' + segmentGap + ';"></div>';
                $(this).prepend(segment.repeat(amount - 2));
            }
        });
    };

    $(function () {

        // Todo list
        $(".todo").on('click', 'li', function () {
            $(this).toggleClass("todo-done");
        });

        // Custom Selects
        $("select[name='huge']").selectpicker({style: 'btn-hg btn-primary', menuStyle: 'dropdown-inverse'});
        $(".selection").selectpicker({style: 'btn-custom btn-sm', menuStyle: 'dropdown-inverse-custom'});
        $("select[name='info']").selectpicker({style: 'btn-info', menuStyle: 'dropdown-inverse'});
        $("select[name='control']").selectpicker({style: 'btn-primary', menuStyle: 'dropdown-inverse'});

        $('#example_wrapper .dataTables_length label button').css("width", "100");
        $('#example_wrapper .dataTables_length label div ul').css("min-width", "auto");
        $('#example_wrapper .dataTables_length label div').css("padding-left", "0");

        $("#example_wrapper .dataTables_info").css("margin-top", "15");

        // Tooltips
        $("[data-toggle=tooltip]").tooltip();

        // Popover
        $("[data-toggle=popover]").popover();

        // Tags Input
        $(".tagsinput").tagsInput();

        // jQuery UI Sliders
        var $slider = $("#slider");
        if ($slider.length) {
            $slider.slider({
                min: 1,
                max: 5,
                value: 2,
                orientation: "horizontal",
                range: "min"
            }).addSliderSegments($slider.slider("option").max);
        }

        var $verticalSlider = $("#vertical-slider");
        if ($verticalSlider.length) {
            $verticalSlider.slider({
                min: 1,
                max: 5,
                value: 3,
                orientation: "vertical",
                range: "min"
            }).addSliderSegments($verticalSlider.slider("option").max, "vertical");
        }

        // Placeholders for input/textarea
        $(":text, textarea").placeholder();

        // Focus state for append/prepend inputs
        $('.input-group').on('focus', '.form-control',function () {
            $(this).closest('.input-group, .form-group').addClass('focus');
        }).on('blur', '.form-control', function () {
                $(this).closest('.input-group, .form-group').removeClass('focus');
            });

        // Make pagination demo work
        $(".pagination").on('click', "a", function () {
            $(this).parent().siblings("li").removeClass("active").end().addClass("active");
        });

        $(".btn-group").on('click', "a", function () {
            $(this).siblings().removeClass("active").end().addClass("active");
        });

        // Disable link clicks to prevent page scrolling
        $(document).on('click', 'a[href="#fakelink"]', function (e) {
            e.preventDefault();
        });

        // Switch
        $("[data-toggle='switch']").wrap('<div class="switch" />').parent().bootstrapSwitch();

        // make code pretty
        window.prettyPrint && prettyPrint();

        // Grid
        $(".grid-control").find(".glyphicon-chevron-down").one("click", slide_grid_down);
        $(".grid-control").find(".glyphicon-remove").click(function (e) {
            e.preventDefault();
            $(this).parent().parent().parent().parent().slideUp(500);
        });

        function slide_grid_down(e) {
            e.preventDefault();
            $(this).parent().parent().parent().next().slideUp(500);
            $(this).one("click", slide_grid_up);
        }

        function slide_grid_up(e) {
            e.preventDefault();
            $(this).parent().parent().parent().next().slideDown(500);
            $(this).one("click", slide_grid_down);
        }

    });



    // validate
    $("#setting-form").validate();
    $("#profile-form").validate({
        rules: {
            profile_newpassword: {
                minlength: 5
            },
            profile_confirmpassword: {
                minlength: 5,
                equalTo: "#profile_newpassword"
            }
        },
        messages: {
            profile_password: {
                minlength: "Minimum length is 5 character"
            },
            profile_confirmpassword: {
                minlength: "Your password must be at least 5 characters long",
                equalTo: "Please enter the same password as above"
            }
        }
    });

})(jQuery);



