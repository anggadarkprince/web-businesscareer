<!-- Mark Modal -->
<div class="modal fade" id="markFeedback" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="formImportant" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Mark Confirmation</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" class="id-label">
                    Mark as important feedback : <strong class="text-custom email-label"></strong> ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-custom" id="submitMark">Mark as Important</button>
                </div>
            </form>
        </div>
    </div>
</div>