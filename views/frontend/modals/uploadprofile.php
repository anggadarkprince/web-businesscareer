<!-- Update Profile Modal -->
<div class="modal fade" id="uploadProfile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?=$this->framework->url->get_base_url()?>/player/update_avatar" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Avatar User</h4>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <p>Select Your Favorite Photo as Your Avatar</p>
                        <div class="avatar-crop-wrapper">
                            <!-- image preview area-->
                            <img id="uploadPreview" style="display:none; height: 100%"/>
                            <img id="uploadPreviewTemp" style="display: none; height: 100%"/>
                        </div>

                        <!-- hidden inputs -->
                        <input type="hidden" id="x" name="x" />
                        <input type="hidden" id="y" name="y" />
                        <input type="hidden" id="w" name="w" />
                        <input type="hidden" id="h" name="h" />

                        <div class="file-chooser">
                            <button type="button" class="btn btn-primary">CHOOSE AVATAR</button>
                            <input id="uploadImage" type="file" accept="image/jpeg" name="avatar">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn btn-embossed" id="closecrop" data-dismiss="modal">CANCEL</button>
                    <button type="submit" class="btn btn-primary btn btn-embossed">CONFIRM AVATAR</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){

    });
</script>