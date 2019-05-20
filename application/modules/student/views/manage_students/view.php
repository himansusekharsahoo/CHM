<div class="row">
    <div class="col-md-4">
        <!-- Profile Image -->
        <div class="box box-primary">
            <div class="box-body box-profile">
                <img class="profile-user-img img-responsive img-circle" src="<?= base_url(); ?>images/user-icon.png" alt="User profile picture"/>
                <h3 class="profile-username text-center">
                    <?php
                    echo (isset($data["first_name"])) ? ucfirst($data["first_name"]) : "";
                    echo (isset($data["last_name"])) ? ' ' . ucfirst($data["last_name"]) : ""
                    ?>
                </h3>
                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <b>Email: </b> <a class="pull-right"><?php echo (isset($data["email"])) ? $data["email"] : "" ?></a>
                    </li>
                    <li class="list-group-item">
                        <b>Mobile:</b> <a class="pull-right"><?php echo (isset($data["mobile"])) ? $data["mobile"] : "" ?></a>
                    </li>
                </ul>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <div class="col-md-4">
        <!-- About Me Box -->
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">About Me</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <b>Registration id: </b> <a class="pull-right"><?php echo (isset($data["login_id"])) ? $data["login_id"] : "" ?></a>
                    </li>
                    <li class="list-group-item">
                        <b>Login status: </b> <a class="pull-right"><?php echo (isset($data["login_status"])) ? ucfirst($data["login_status"]) : "" ?></a>
                    </li>
                    <li class="list-group-item">
                        <b>Status:</b> <a class="pull-right"><?php echo (isset($data["status"])) ? ucfirst($data["status"]) : "" ?></a>
                    </li>
                </ul>
                <br/><br/><br/>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
</div>