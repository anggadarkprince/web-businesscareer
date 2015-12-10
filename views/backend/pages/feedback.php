<div class="content-wrapper">
    <div class="top-panel">
        <h3 class="icon-feedback"> Player Feedback</h3>
    </div>
    <div class="titlebar">
        <span>Data Suggest and Critic</span>
    </div>
    <div class="content">
        <div class="row" id="printable">
            <div class="col-md-12">
                <div class="alert pam">Hello</div>
                <!-- Nav tabs -->
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#feedback" data-toggle="tab"><span class="fui-mail"></span> Feedback Record</a></li>
                    <li><a href="#important" data-toggle="tab"><span class="fui-heart"></span> Important Mark</a></li>
                    <li class="hidden-xs"><a href="#delete" data-toggle="tab"><span class="fui-cross"></span> Deleted History</a></li>
                </ul>

                <script>
                    $(document).ready(function(){
                        $("#detailButton").live('click',function(){
                            var email = $(this).parent().parent().data("email");
                            var date = $(this).parent().parent().data("date");
                            var subject = $(this).parent().parent().data("subject");
                            var content = $(this).parent().parent().data("content");
                            $(".email-label").text(email);
                            $(".date-label").text(date);
                            $(".subject-label").text(subject);
                            $(".content-label").text(content);
                        });

                        $("#replyButton").live('click',function(){
                            var name = $(this).parent().parent().parent().data("name");
                            var email = $(this).parent().parent().parent().data("email");
                            var date = $(this).parent().parent().parent().data("date");
                            var subject = $(this).parent().parent().parent().data("subject");
                            var content = $(this).parent().parent().parent().data("content");

                            $(".email-label").text(email);
                            $(".date-label").text(date);
                            $(".subject-label").text(subject);
                            $(".content-label").text(content);
                            $("input[name=name]").val(name);
                            $("input[name=subject]").val("Re : "+subject);
                            $("input[name=email]").attr("value",email);
                        });

                        $("#deleteButton").live('click',function(){
                            var email = $(this).parent().parent().parent().data("email");
                            var id = $(this).parent().parent().parent().data("id");
                            $(".email-label").text(email);
                            $(".id-label").attr("value",id);
                        });

                        $("#markButton").live('click',function(){
                            var email = $(this).parent().parent().parent().data("email");
                            var id = $(this).parent().parent().parent().data("id");
                            $(".email-label").text(email);
                            $(".id-label").attr("value",id);
                        });

                        $("#unmarkButton").live('click',function(){
                            var email = $(this).parent().parent().parent().data("email");
                            var id = $(this).parent().parent().parent().data("id");
                            $(".email-label").text(email);
                            $(".id-label").attr("value",id);
                        });


                        reload_table();

                        var form_important = $('#formImportant');
                        var form_unimportant = $("#formUnimportant");
                        var form_delete = $("#formDelete");
                        var form_reply = $("#formReply");

                        var alert = $('.alert');

                        alert.hide();

                        // form reply submit event
                        form_reply.on('submit', function(e) {
                            e.preventDefault(); // prevent default form submit
                            // sending ajax request through jQuery
                            $.ajax({
                                url: '<?=$this->framework->url->get_base_url()?>/feedback/reply_feedback', // form action url
                                type: 'POST', // form submit method get/post
                                dataType: 'html', // request type html/json/xml
                                data: form_reply.serialize(), // serialize form data
                                beforeSend: function() {
                                    $('#replyFeedback').modal('hide');

                                    reset_alert();
                                    alert.fadeIn().addClass("alert-info");
                                    alert.html("<span class='fui-time'></span> Data updating, Please wait...."); // change submit button text
                                },
                                success: function(data) {
                                    if(data){
                                        reset_alert();
                                        alert.fadeIn().addClass("alert-success");
                                        alert.html("<span class='fui-check'></span> Feedback successfully replied"); // fade in response data
                                        form_important.trigger('reset'); // reset form
                                        reload_table();
                                    }
                                    else{
                                        reset_alert();
                                        alert.fadeIn().addClass("alert-danger");
                                        alert.html("<span class='fui-cross'></span> Feedback reply failed, try again..."+data);
                                    }

                                },
                                error: function(e) {
                                    console.log(e);
                                    reset_alert();
                                    alert.html("<span class='fui-cross'></span> Sending request failed, try again...");
                                }
                            });
                        });

                        // form important submit event
                        form_important.on('submit', function(e) {
                            e.preventDefault(); // prevent default form submit
                            // sending ajax request through jQuery
                            $.ajax({
                                url: '<?=$this->framework->url->get_base_url()?>/feedback/mark_important', // form action url
                                type: 'POST', // form submit method get/post
                                dataType: 'html', // request type html/json/xml
                                data: form_important.serialize(), // serialize form data
                                beforeSend: function() {
                                    $('#markFeedback').modal('hide');

                                    reset_alert();
                                    alert.fadeIn().addClass("alert-info");
                                    alert.html("<span class='fui-time'></span> Data updating, Please wait...."); // change submit button text
                                },
                                success: function(data) {
                                    if(data == 1){
                                        reset_alert();
                                        alert.fadeIn().addClass("alert-success");
                                        alert.html("<span class='fui-check'></span> Data successfully updated"); // fade in response data
                                        form_important.trigger('reset'); // reset form
                                        reload_table();
                                    }
                                    else{
                                        reset_alert();
                                        alert.fadeIn().addClass("alert-danger");
                                        alert.html("<span class='fui-cross'></span> Updating failed, try again...");
                                    }

                                },
                                error: function(e) {
                                    console.log(e);
                                    reset_alert();
                                    alert.html("<span class='fui-cross'></span> Sending request failed, try again...");
                                }
                            });
                        });

                        // form unimportant submit event
                        form_unimportant.on('submit', function(e) {
                            e.preventDefault(); // prevent default form submit
                            // sending ajax request through jQuery
                            $.ajax({
                                url: '<?=$this->framework->url->get_base_url()?>/feedback/remove_important', // form action url
                                type: 'POST', // form submit method get/post
                                dataType: 'html', // request type html/json/xml
                                data: form_unimportant.serialize(), // serialize form data
                                beforeSend: function() {
                                    $('#unmarkFeedback').modal('hide');

                                    reset_alert();
                                    alert.fadeIn().addClass("alert-info");
                                    alert.html("<span class='fui-time'></span> Data updating, Please wait...."); // change submit button text
                                },
                                success: function(data) {
                                    if(data == 1){
                                        reset_alert();
                                        alert.fadeIn().addClass("alert-success");
                                        alert.html("<span class='fui-check'></span> Data successfully updated"); // fade in response data
                                        form_important.trigger('reset'); // reset form
                                        reload_table();
                                    }
                                    else{
                                        reset_alert();
                                        alert.fadeIn().addClass("alert-danger");
                                        alert.html("<span class='fui-cross'></span> Updating failed, try again...");
                                    }

                                },
                                error: function(e) {
                                    console.log(e);
                                    reset_alert();
                                    alert.html("<span class='fui-cross'></span> Sending request failed, try again...");
                                }
                            });
                        });

                        // form remove submit event
                        form_delete.on('submit', function(e) {
                            e.preventDefault(); // prevent default form submit
                            // sending ajax request through jQuery
                            $.ajax({
                                url: '<?=$this->framework->url->get_base_url()?>/feedback/remove_feedback', // form action url
                                type: 'POST', // form submit method get/post
                                dataType: 'html', // request type html/json/xml
                                data: form_delete.serialize(), // serialize form data
                                beforeSend: function() {
                                    $('#deleteFeedback').modal('hide');

                                    reset_alert();
                                    alert.fadeIn().addClass("alert-info");
                                    alert.html("<span class='fui-time'></span> Data updating, Please wait...."); // change submit button text
                                },
                                success: function(data) {
                                    if(data == 1){
                                        reset_alert();
                                        alert.fadeIn().addClass("alert-success");
                                        alert.html("<span class='fui-check'></span> Data successfully deleted"); // fade in response data
                                        form_important.trigger('reset'); // reset form
                                        reload_table();
                                    }
                                    else{
                                        reset_alert();
                                        alert.fadeIn().addClass("alert-danger");
                                        alert.html("<span class='fui-cross'></span> Deleting failed, try again...").addClass("alert-danger");
                                    }

                                },
                                error: function(e) {
                                    console.log(e);
                                    reset_alert();
                                    alert.html("<span class='fui-cross'></span> Sending request failed, try again...").addClass("alert-danger");
                                }
                            });
                        });

                        function reset_alert(){
                            alert.hide();
                            alert.removeClass("alert-success");
                            alert.removeClass("alert-info");
                            alert.removeClass("alert-danger");
                        }

                        function reload_table(){
                            generate_standard();
                            generate_important();
                            generate_deleted();
                        }

                        function generate_standard(){
                            $.ajax({
                                type:"POST",
                                url:"<?=$this->framework->url->get_base_url()?>/feedback/get_data_feedback_standard",
                                cache:false,
                                success: function(data){
                                    var json_data = JSON.parse(data);
                                    var output = "";
                                    var count = 1;
                                    if(json_data.length == 0){
                                        output+="<tr class='text-center'><td colspan='6'>No Data Available</td></tr>";
                                    }
                                    else{
                                        $.each(json_data,function(i,row){
                                            output+="<tr data-name='"+row.fdb_name+"' data-id='"+row.fdb_id+"' data-email='"+row.fdb_email+"' data-date='"+row.fdb_timestamp+"' data-subject='"+row.fdb_subject+"' data-content='"+row.fdb_message+"'>";
                                            output+="<td>"+(count++)+"</td>";
                                            output+="<td>"+row.fdb_name+"</td>";
                                            output+="<td>"+row.fdb_subject+"</td>";
                                            output+="<td>"+row.fdb_email+"</td>";
                                            output+="<td><a href='#' id='detailButton' data-toggle='modal' data-target='#detailFeedback'>Detail</a></td>";
                                            output+="<td>";
                                            output+="   <span data-toggle='tooltip' data-placement='top' data-original-title='Reply Feedback'><a href='#' class='btn btn-embossed btn-xs btn-custom' id='replyButton' data-toggle='modal' data-target='#replyFeedback'><span class='fui-mail'></span></a></span>";
                                            output+="   <span data-toggle='tooltip' data-placement='top' data-original-title='Mark as Important'><a href='#' class='btn btn-embossed btn-xs btn-info' id='markButton' data-toggle='modal' data-target='#markFeedback'><span class='fui-heart'></span></a></span>";
                                            output+="   <span data-toggle='tooltip' data-placement='top' data-original-title='Remove Record'><a href='#' class='btn btn-embossed btn-xs btn-danger' id='deleteButton' data-toggle='modal' data-target='#deleteFeedback'><span class='fui-cross'></span></a></span>";
                                            output+="</td>";
                                            output+="</tr>";
                                        });
                                    }
                                    $("#data_standard").html(output);
                                },
                                error: function(e) {
                                    alert.html(e);
                                    console.log(e)
                                }
                            });
                        }
                        function generate_important(){
                            $.ajax({
                                type:"POST",
                                url:"<?=$this->framework->url->get_base_url()?>/feedback/get_data_feedback_important",
                                cache:false,
                                success: function(data){
                                    var json_data = JSON.parse(data);
                                    var output = "";
                                    var count = 1;
                                    if(json_data.length == 0){
                                        output+="<tr class='text-center'><td colspan='6'>No Data Available</td></tr>";
                                    }
                                    else{
                                        $.each(json_data,function(i,row){
                                            output+="<tr data-id='"+row.fdb_id+"' data-email='"+row.fdb_email+"' data-date='"+row.fdb_timestamp+"' data-subject='"+row.fdb_subject+"' data-content='"+row.fdb_message+"'>";
                                            output+="<td>"+(count++)+"</td>";
                                            output+="<td>"+row.fdb_name+"</td>";
                                            output+="<td>"+row.fdb_subject+"</td>";
                                            output+="<td>"+row.fdb_email+"</td>";
                                            output+="<td><a href='#' id='detailButton' data-toggle='modal' data-target='#detailFeedback'>Detail</a></td>";
                                            output+="<td>";
                                            output+="   <span data-toggle='tooltip' data-placement='top' data-original-title='Reply Feedback'><a href='#' class='btn btn-embossed btn-xs btn-custom' id='replyButton' data-toggle='modal' data-target='#replyFeedback'><span class='fui-mail'></span></a></span>";
                                            output+="   <span data-toggle='tooltip' data-placement='top' data-original-title='Remove as Important'><a href='#' class='btn btn-embossed btn-xs btn-danger' id='unmarkButton' data-toggle='modal' data-target='#unmarkFeedback'><span class='fui-heart'></span></a></span>";
                                            output+="   <span data-toggle='tooltip' data-placement='top' data-original-title='Remove Record'><a href='#' class='btn btn-embossed btn-xs btn-danger' id='deleteButton' data-toggle='modal' data-target='#deleteFeedback'><span class='fui-cross'></span></a></span>";
                                            output+="</td>";
                                            output+="</tr>";
                                        });
                                    }
                                    $("#data_important").html(output);
                                },
                                error: function(e) {
                                    alert.html(e);
                                    console.log(e)
                                }
                            });
                        }
                        function generate_deleted(){
                            $.ajax({
                                type:"POST",
                                url:"<?=$this->framework->url->get_base_url()?>/feedback/get_data_feedback_deleted",
                                cache:false,
                                success: function(data){
                                    var json_data = JSON.parse(data);
                                    var output = "";
                                    if(json_data.length == 0){
                                        output+="<tr class='text-center'><td colspan='6'>No Data Available</td></tr>";
                                    }
                                    else{
                                        $.each(json_data,function(i,row){
                                            output+="<tr>";
                                            output+="<td>"+row.fdb_timestamp+"</td>";
                                            output+="<td>"+row.fdb_id+"</td>";
                                            output+="<td>"+row.fdb_subject+"</td>";
                                            output+="<td>"+row.fdb_email+"</td>";
                                            output+="</tr>";
                                        });
                                    }
                                    $("#data_deleted").html(output);
                                },
                                error: function(e) {
                                    alert.html(e);
                                    console.log(e)
                                }
                            });
                        }

                    });


                </script>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane active" id="feedback">
                        <table class="table table-striped table-hover table-condensed mtl">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Subject</th>
                                    <th>Email</th>
                                    <th>Feedback</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="data_standard">

                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="important">
                        <table class="table table-striped table-hover table-condensed mtl">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Subject</th>
                                    <th>Email</th>
                                    <th>Feedback</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="data_important">

                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="delete">
                        <table class="table table-hover table-condensed mtl">
                            <thead>
                                <tr>
                                    <th>Timestamps</th>
                                    <th>Id Feedback</th>
                                    <th>Subject</th>
                                    <th>Email</th>
                                </tr>
                            </thead>
                            <tbody id="data_deleted">
                                <tr>
                                    <td>26/05/2014 18:45:67</td>
                                    <td>4565</td>
                                    <td>Fuck You</td>
                                    <td>ff45@gmail.com</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<?php $this->framework->view->show('backend/modals/feedback/detail')?>
<?php $this->framework->view->show('backend/modals/feedback/mark')?>
<?php $this->framework->view->show('backend/modals/feedback/unmark')?>
<?php $this->framework->view->show('backend/modals/feedback/reply')?>
<?php $this->framework->view->show('backend/modals/feedback/delete')?>
