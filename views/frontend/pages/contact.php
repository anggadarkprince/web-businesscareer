<div class="container content">
    <div class="row form-menu feedback">
        <div class="col-md-6">
            <h1>Contact Us</h1>
            <h3>Give us feedback then we develop better</h3>
            <p>Your personal information will not published, we just retrieve your suggestion and keep your privacy.</p>

            <div class="alert alert-danger pam alert-feedback"></div>

            <form method="post" id="feedbackForm">
                <div class="control-group">
                    <label class="control-label">Name</label>
                    <input class="form-control" type="text" id="name" name="name" placeholder="Put your name here" required>
                </div>
                <div class="control-group">
                    <label class="control-label">Email</label>
                    <input class="form-control" type="email" id="email" name="email" placeholder="Put your email address" required>
                </div>
                <div class="control-group">
                    <label class="control-label">Subject</label>
                    <input class="form-control" type="text" id="subject" name="subject" placeholder="Feedback subject or topic" required>
                </div>
                <div class="control-group">
                    <label class="control-label">Message</label>
                    <textarea class="form-control" name="message" id="message" placeholder="Some critic and suggest" rows="4" required></textarea>
                </div>
                <button type="submit" class="btn btn-embossed btn-lg btn-danger" id="feedbackSubmit"><span class="fui-chat"></span> SUBMIT</button>
            </form>
        </div>
        <div class="col-md-6 menu-icon hidden-xs">
            <img src="<?=$this->framework->url->get_base_url()?>/assets/images/layout/contact-icon.png" class="img-responsive">
        </div>
    </div>
</div>
