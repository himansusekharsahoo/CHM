<style>
    /*    .profile-user-img{
            margin-right:25%;
        }
        .profile-username{
            margin-right:27%;
            text-align: right;
        }*/
    .profile_links{
        position: relative;
        right: 10px;

        bottom:0px;            
    }
</style>
<div class="row">
    <div class="col-md-9">
        <!-- Profile Image -->
        <div class="box box-primary">
            <div class="box-body box-profile">
                <div class="row">
                    <div class="col-sm-12">
                        <img class="profile-user-img img-responsive img-circle" src="<?= base_url(); ?>images/user-icon.png" alt="User profile picture"/>
                        <h3 class="profile-username text-center">
                            <?php
                            echo (isset($data["first_name"])) ? ucfirst($data["first_name"]) : "";
                            echo (isset($data["last_name"])) ? ' ' . ucfirst($data["last_name"]) : ""
                            ?>
                        </h3>                        
                    </div>
                    <!--                    <div class="col-sm-3">
                                            <a class="btn btn-block btn-social btn-twitter" href="#">
                                                <i class="fa fa-key fa-sm"></i> Change Password
                                            </a>
                    
                                        </div>-->
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>Email: </b>                                 
                                <a href="#" id="verify_email" class="label bg-red pull-right marginL10 todo_dev">Verify</a>
                                <a class="pull-right"><?php echo (isset($data["email"])) ? $data["email"] : "" ?></a>                                
                            </li>
                            <li class="list-group-item">
                                <b>Mobile:</b> 
                                <a href="#" id="verify_mobile" class="label bg-red pull-right marginL10 todo_dev">Verify</a>
                                <a class="pull-right"><?php echo (isset($data["mobile"])) ? $data["mobile"] : "" ?></a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-sm-6">
                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>Roles:</b> <a class="pull-right">
                                    <?php
                                    if (isset($data["employee_roles"])) {
                                        $role_codes = $this->rbac->get_role_codes();
                                        $sorted = $this->rbac->sort_user_roles($role_codes);
                                        $loop = 0;
                                        foreach ($sorted as $role_code) {
                                            if ($loop > 0) {
                                                echo ", " . ucfirst($this->rbac->get_role_desc($role_code));
                                            } else {
                                                echo ucfirst($this->rbac->get_role_desc($role_code));
                                            }
                                            $loop++;
                                        }
                                    }
                                    ?>

                                </a>
                            </li>
                            <li class="list-group-item">
                                <b>Active Since: </b> <a class="pull-right"><?php echo (isset($data["created"])) ? date_format(date_create($data["created"]), 'd-m-Y') : "" ?></a>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>    
    <div class="col-sm-3">
        <a class="btn btn-block btn-social btn-twitter todo_dev" href="#">
            <i class="fa fa-file-image-o fa-sm"></i> Upload Image
        </a>
        <a class="btn btn-block btn-social btn-twitter todo_dev" href="#">
            <i class="fa fa-key fa-sm"></i> Change Password
        </a>        
    </div>
</div>