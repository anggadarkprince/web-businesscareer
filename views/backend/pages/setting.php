<div class="content-wrapper">
    <div class="top-panel">
        <h3 class="icon-setting"> Setting</h3>
    </div>
    <div class="title-bar">
        <span>System Setting</span>
    </div>
    <div class="content">
        <div class="row">
			<div class="col-md-5">
				<form id="setting-form" class="form-horizontal" role="form" method="post" enctype="multipart/form-data" action="<?=$this->framework->url->get_base_url()?>/dashboard/setting_update">
					<fieldset>
						<legend>Website Settings</legend>
                        <?php
                        if(isset($_SESSION['setting_operation']))
                        {
                            $status = $_SESSION['setting_operation'];
							if($status=='success'){
								?>
								<div class="alert alert-success alert-block pam">
									<button type="button" class="close" data-dismiss="alert">&times;</button>
									<small><span class="fui-check"></span> &nbsp; Setting updated successfully</small>
								</div>
								<?php
							}
							else if($status=='warning'){
								?>
								<div class="alert alert-warning alert-block pam">
									<button type="button" class="close" data-dismiss="alert">&times;</button>
									<small><span class="fui-cross"></span> &nbsp; Setting failed to update, try again</small>
								</div>
								<?php
							}
							else if($status=='error'){
								?>
								<div class="alert alert-danger alert-block pam">
									<button type="button" class="close" data-dismiss="alert">&times;</button>
									<small><span class="fui-cross"></span> &nbsp; Ouch, something is getting wrong</small>
								</div>
								<?php
							}
                            unset($_SESSION['setting_operation']);
                        }
                        ?>
	                    <div class="control-group">
		                    <label for="website_name" class="control-label">Website Name</label>
		                    <span class="text-muted small">e.g. "Serious Game Official"</span>
		                    <input class="form-control" type="text" id="website_name" name="website_name" placeholder="Put website name" required maxlength="45" value="<?=$data_setting["stg_name"]?>">
		                </div>
		                <div class="control-group">
		                    <label for="website_description" class="control-label">Description</label>
		                    <span class="text-muted small">e.g. "Business Career is something awesome"</span>
		                    <textarea class="form-control" id="website_description" name="website_description" placeholder="Description of site" rows="3" required maxlength="300"><?=$data_setting["stg_description"]?></textarea>
		                </div>
		                <div class="control-group">
		                    <label for="website_keyword" class="control-label">Keyword</label>
		                    <span class="text-muted small">note: separated by coma</span>
		                    <input class="form-control" type="text" id="website_keyword" name="website_keyword" placeholder="Type some keyword" required maxlength="45" value="<?=$data_setting["stg_keyword"]?>">
		                </div>
		                <div class="control-group">
		                    <label for="website_email" class="control-label">Contact Email</label>
		                    <span class="text-muted small">e.g. "anggadakrprince@gmail.com"</span>
		                    <input class="form-control" type="email" id="website_email" name="website_email" placeholder="Type email address" required maxlength="45" value="<?=$data_setting["stg_email"]?>">
		                </div>
		                <div class="control-group">
		                    <label for="website_number" class="control-label">Contact Number</label>
		                    <span class="text-muted small">e.g. "+6285655479868"</span>
		                    <input class="form-control" type="text" id="website_number" name="website_number" placeholder="Type contact number" required maxlength="45" value="<?=$data_setting["stg_number"]?>">
		                </div>
		                <div class="control-group">
		                    <label for="website_address" class="control-label">Contact Address</label>
		                    <span class="text-muted small">e.g. "Avenue Street"</span>
		                    <input class="form-control" type="text" id="website_address" name="website_address" placeholder="Type office address" required maxlength="45" value="<?=$data_setting["stg_address"]?>">
		                </div>
		                <div class="control-group">
		                    <label for="website_facebook" class="control-label">Facebook</label>
		                    <span class="text-muted small">e.g. "https://www.facebook.com/angga.nitsfil"</span>
		                    <input class="form-control" type="url" id="website_facebook" name="website_facebook" placeholder="Facebook ID or name" maxlength="45" value="<?=$data_setting["stg_facebook"]?>">
		                </div>
		                <div class="control-group">
		                    <label for="website_twitter" class="control-label">Twitter</label>
		                    <span class="text-muted small">e.g. "https://www.twitter.com/angga_nitsfil"</span>
		                    <input class="form-control" type="url" id="website_twitter" name="website_twitter" placeholder="Twitter ID" maxlength="45" value="<?=$data_setting["stg_twitter"]?>">
		                </div>
		                <div class="control-group">
		                    <label for="website_favicon" class="control-label">Upload Favicon</label>
		                    <span class="text-muted small">note: File ext. can png or jpg</span>
                            <div class="row">
                                <div class="col-md-2 col-sm-2 col-xs-2">
                                    <img class="img-responsive" width="50" src="<?=$this->framework->url->get_base_url()?>/assets/images/<?=$data_setting["stg_favicon"]?>">
                                </div>
                                <div class="col-md-10 col-sm-10 col-xs-10">
                                    <input class="form-control" type="file" id="website_favicon" name="website_favicon" placeholder="Select favicon">
                                </div>
                            </div>
		                </div>
		                <button type="submit" class="btn btn-embossed btn-lg btn-custom mtl mbl"><span class="fui-new"></span> Update Setting</button>

                    </fieldset>
                </form>
            </div>

            <div class="col-md-1"></div>

			<div class="col-md-6">
				<form id="profile-form" class="form-horizontal" role="form" method="post" enctype="multipart/form-data" action="<?=$this->framework->url->get_base_url()?>/dashboard/profile_update">
					<fieldset>
						<legend>Profile Settings</legend>
                        <?php
                        if(isset($_SESSION['profile_operation']))
                        {
                            $status = $_SESSION['profile_operation'];
                            if($status=='success'){
                                ?>
                                <div class="alert alert-success alert-block pam">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <small><span class="fui-check"></span> &nbsp; Setting updated successfully</small>
                                </div>
                            <?php
                            }
                            else if($status=='warning'){
                                ?>
                                <div class="alert alert-warning alert-block pam">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <small><span class="fui-cross"></span> &nbsp; Current password is mismatch</small>
                                </div>
                            <?php
                            }
                            else if($status=='error'){
                                ?>
                                <div class="alert alert-danger alert-block pam">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <small><span class="fui-cross"></span> &nbsp; Ouch, something is getting wrong</small>
                                </div>
                            <?php
                            }
                            unset($_SESSION['profile_operation']);
                        }
                        ?>
						<div class="profile">
							<div class="row">
								<div class="col-md-4 col-sm-4 col-xs-4">
									<img class="img-responsive" width="120" src="<?=$this->framework->url->get_base_url()?>/assets/images/avatar/<?=$_SESSION['web_avatar'];?>" alt="Administrator">
								</div>
								<div class="col-md-8 col-sm-8 col-xs-8">
									<p class="mbn"><strong>Hai, <?=$_SESSION['web_name']?></strong></p>
									<label for="profile-avatar" class="control-label mtn">Upload Avatar</label>
									<input class="form-control" type="file" id="profile_avatar" name="profile_avatar">
								</div>
							</div>
						</div>
						<div class="control-group">
		                    <label for="profile_name" class="control-label">Name</label>
		                    <span class="text-muted small">e.g. "Angga Ari Wijaya"</span>
		                    <input class="form-control" type="text" id="profile_name" name="profile_name" placeholder="Put profile name" required maxlength="45" value="<?=$data_user["usr_name"]?>">
		                </div>
						<div class="control-group">
		                    <label for="profile_about" class="control-label">About</label>
		                    <span class="text-muted small">note: Describe yourself</span>
		                    <input class="form-control" type="text" id="profile_about" name="profile_about" placeholder="Put profil description" required maxlength="300" value="<?=$data_user["usr_about"]?>">
		                </div>
		                <div class="control-group">
		                    <label for="profile_gender" class="control-label">Gender</label><br>
		                    <input type="radio" id="profile_gender" name="profile_gender" value="Male" <?php if(strtoupper($data_user["usr_gender"])=="MALE") echo "checked"?>> <label>Male</label> &nbsp;
							<input type="radio" name="profile_gender" value="Female" <?php if(strtoupper($data_user["usr_gender"])=="FEMALE") echo "checked"?>> <label>Female</label>
		                </div>						
						<div class="control-group">
		                    <label for="profile_password" class="control-label">Password</label>
		                    <span class="text-muted small">Update with password</span>
		                    <input class="form-control" type="password" id="profile_password" name="profile_password" placeholder="Put your secreet key" required maxlength="45">
		                </div>
		                <div class="control-group">
		                    <label for="profile_newpassword" class="control-label">New Password</label>
		                    <span class="text-muted small">Change password</span>
		                    <input class="form-control" type="password" id="profile_newpassword" name="profile_newpassword" placeholder="Put your secreet key" maxlength="45">
		                </div>
						<div class="control-group">
		                    <label for="profile_confirmpassword" class="control-label">Confirm Password</label>
		                    <span class="text-muted small">note: fill to change password</span>
		                    <input class="form-control" type="password" id="profile_confirmpassword" name="profile_confirmpassword" placeholder="Type same as password" maxlength="45">
		                </div>						

						<button type="submit" class="btn btn-embossed btn-lg btn-custom mtl mbl" style="margin-top:20px"><span class="fui-new"></span> Update Profile</button>
					</fieldset>
				</form>
			</div>
		</div>
	</div>
    </div>
</div>

