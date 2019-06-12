<?php ?>
<div class="col-md-9 col-sm-9">
    <h1>Login</h1>
    <div class="content-form-page">
        <div class="row">
            <div class="col-md-7 col-sm-7">                
                <div class="row">
                    <div class="col-lg-8 col-md-offset-4 padding-left-0" style="color: red;">
                        <?php
                        
                        if ($this->session->flashdata('error')) {
                            echo $this->session->flashdata('error');
                        }else{
                            echo validation_errors();    
                        }
                        ?>
                    </div>
                </div>
                <form class="form-horizontal form-without-legend" role="form" action="<?= base_url('users/sign_in'); ?>" method="post" id="sign_in" name="sign_in">
                    <div class="form-group">
                        <label for="email" class="col-lg-5 control-label">Email/Library Card No. <span class="require">*</span></label>
                        <div class="col-lg-7">
                            <input type="text" class="form-control" id="user_email" name="user_email" value="<?=set_value('user_email')?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-lg-5 control-label">Password <span class="require">*</span></label>
                        <div class="col-lg-7">
                            <input type="password" class="form-control" id="password" name="user_pass">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-5 col-md-offset-5 padding-left-0">
                            <a href="page-forgotton-password.html">Forget Password?</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-2 padding-top-20 pull-right" style="margin-right:27px;">
                            <button type="submit" class="btn btn-primary">Login</button>
                        </div>
                    </div>                    
                </form>
            </div>
            <div class="col-md-4 col-sm-4 pull-right">
                <div class="form-info">
                    <h2><em>Important</em> Information</h2>
                    <p>Duis autem vel eum iriure at dolor vulputate velit esse vel molestie at dolore.</p>

                    <button type="button" class="btn btn-default">More details</button>
                </div>
            </div>
        </div>
    </div>
</div>