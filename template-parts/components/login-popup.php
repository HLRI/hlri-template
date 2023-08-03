<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-dialog-login" role="document">
        <div class="modal-content modal-content-login clearfix">
            <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button> -->
            <div class="modal-body body-login">

                <div class="modal-body-login login-form">

                    <div class="form-loading d-none">
                        <div class="spinner-border text-primary" role="status"></div>
                    </div>

                    <h3 class="title">Login Form</h3>
                    <p class="description"></p>
                    <div class="form-group">
                        <span class="input-icon"><i class="fa fa-user"></i></span>
                        <input type="text" class="form-control" id="username" placeholder="Enter Email or Username">
                    </div>
                    <div class="form-group">
                        <span class="input-icon"><i class="fas fa-key"></i></span>
                        <input type="password" class="form-control" id="password" placeholder="Enter Password">
                    </div>
                    <div class="notif-info d-none"></div>


                    <!-- <div class="form-group checkbox">
                        <input id="remember" type="checkbox">
                        <label for="remember">Remamber me</label>
                    </div> -->

                    <?php wp_nonce_field('ajax-login-nonce', 'security'); ?>

                    <div class="sign-in-btn">
                        <button class="btn" id="submit-login">Login</button>
                        <button class="btn btn-register btn-orange-form">Register</button>
                    </div>

                    <div class="login-by-social">
                        <?php echo do_shortcode('[nextend_social_login]'); ?>
                        <?php do_action('login_hlri_form'); ?>
                    </div>

                    <div class="wrap-bottom-login">
                        <br>
                        <a href="#" class="forgot-pass btn-forgot-password">Forgot Password?</a>
                    </div>
                </div>

                <div class="modal-body-login forgot-password-form d-none">

                    <div class="form-loading d-none">
                        <div class="spinner-border text-primary" role="status"></div>
                    </div>

                    <h3 class="title">Password Recovery</h3>
                    <p class="description"></p>
                    <div class="form-group">
                        <span class="input-icon"><i class="fa fa-user"></i></span>
                        <input type="text" class="form-control" id="username" placeholder="Enter Email Or Username">
                    </div>
                    <div class="notif-info d-none"></div>

                    <?php wp_nonce_field('ajax-login-nonce', 'security'); ?>

                    <div class="sign-in-btn">
                        <button class="btn" id="submit-forgot-password">Submit</button>
                        <button class="btn btn-login btn-orange-form">Login</button>
                    </div>
                </div>

                <div class="modal-body-login register-form d-none">

                    <div class="form-loading d-none">
                        <div class="spinner-border text-primary" role="status"></div>
                    </div>

                    <h3 class="title">Register Form</h3>
                    <p class="description"></p>
                    <div class="form-group">
                        <span class="input-icon"><i class="fa fa-user"></i></span>
                        <input type="text" class="form-control" id="username" placeholder="Enter Username">
                    </div>
                    <div class="form-group">
                        <span class="input-icon"><i class="fa fa-envelope"></i></span>
                        <input type="email" class="form-control" id="email" placeholder="Enter Email">
                    </div>
                    <div class="form-group">
                        <span class="input-icon"><i class="fas fa-key"></i></span>
                        <input type="password" class="form-control" id="password" placeholder="Enter Password">
                    </div>
                    <div class="notif-info d-none"></div>

                    <?php wp_nonce_field('ajax-login-nonce', 'security'); ?>
                    <div class="sign-in-btn">
                        <button class="btn" id="submit-register">Register</button>
                        <button class="btn btn-login btn-orange-form">Login</button>
                    </div>
                </div>

            </div>
            
        </div>
    </div>
</div>