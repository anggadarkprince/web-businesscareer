<!-- Delete Modal -->
<div class="modal fade" id="deleteFeedback" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="formDelete" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Delete Confirmation</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" class="id-label">
                    Are you sure delete feedback from email : <strong class="text-custom email-label"></strong> ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger" id="submitDelete">Delete Now</button>
                </div>
            </form>
        </div>
    </div>
</div>