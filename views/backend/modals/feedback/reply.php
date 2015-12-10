<!-- Reply Modal -->
<div class="modal fade" id="replyFeedback" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="formReply" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Reply <span class="fui-arrow-right"></span> <span class="text-custom email-label"></span></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <ul class="list-unstyled small">
                                <li>Sent : <strong class="text-custom date-label"></strong></li>
                                <li>Subject : <strong class="text-custom subject-label"></strong></li>
                                <li>Content :</li>
                            </ul>
                                    <p class="text-justify content-label"></p>
                        </div>
                        <div class="col-md-6">
                            <input type="hidden" name="name">
                            <input type="hidden" name="email">
                            <div class="control-group">
                                <label class="control-label">Subject</label>
                                <span class="text-muted small">e.g. "re : subject from feedback"</span>
                                <input class="form-control" type="text" name="subject" placeholder="subject message here" required>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Content</label>
                                <textarea class="form-control" rows="5" name="message" placeholder="content message here" required></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-custom">Reply Feedback</button>
                </div>
            </form>
        </div>
    </div>
</div>