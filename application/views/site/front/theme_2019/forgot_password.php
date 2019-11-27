<?php if ( !defined('BASEPATH' ) )exit('No direct script access allowed');?>
<div class="pad">
    <div class="devine">
        <div class="frame">
            <div class="wrap">
                <h2>Forgot Password</h2>
                <!-- <span></span> -->
            </div>
        </div>
    </div>
</div>
<div class="bg_pattern pac60">
    <div class="white_space">
        <div class="frame">
            <div class="wrap">
                <div class="pic">
                    <div class="change_pass_panel">
                        <form role="form" method="POST" class="form_validation" id="forgotPassword">
                            <label>New Password</label>
                            <input type="password" class="form_login" name="new_pass" placeholder="New Password" data-rule-minlength="8" required>

                            <label>Confirm Password</label>
                            <input type="password" class="form_login" name="confirm_pass" data-rule-minlength="8" data-rule-equalTo="[name='new_pass']" placeholder="Confirm Password" required>
                            <input type="hidden" name="frm_token" value="<?php echo $token ?>">
                            <input type="hidden" name="frm_email" value="<?php echo $email ?>">

                            <button id="change_fpassBtn" class="btn btn_change_pass btn-block btn-lg bg-indigo waves-effect" type="submit">SUBMIT</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
