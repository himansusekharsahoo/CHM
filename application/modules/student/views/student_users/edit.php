<div class="col-sm-12">
    <?php
    $form_attribute = array(
        "name" => "student_users",
        "id" => "student_users",
        "method" => "POST"
    );
    $form_action = "/student/student_users/edit";
    echo form_open($form_action, $form_attribute);
    ?>
    <?php
    $attribute = array(
        "name" => "user_id",
        "id" => "user_id",
        "class" => "form-control",
        "title" => "",
        "required" => "",
        "type" => "hidden",
        "value" => (isset($data["user_id"])) ? $data["user_id"] : ""
    );
    echo form_error("user_id");
    echo form_input($attribute);
    ?><div class = 'form-group row'>
        <label for = 'first_name' class = 'col-sm-2 col-form-label'>First name</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "first_name",
                "id" => "first_name",
                "class" => "form-control",
                "title" => "",
                "required" => "",
                "type" => "text",
                "value" => (isset($data["first_name"])) ? $data["first_name"] : ""
            );
            echo form_error("first_name");
            echo form_input($attribute);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'last_name' class = 'col-sm-2 col-form-label'>Last name</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "last_name",
                "id" => "last_name",
                "class" => "form-control",
                "title" => "",
                "required" => "",
                "type" => "text",
                "value" => (isset($data["last_name"])) ? $data["last_name"] : ""
            );
            echo form_error("last_name");
            echo form_input($attribute);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'login_id' class = 'col-sm-2 col-form-label'>Login id</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "login_id",
                "id" => "login_id",
                "class" => "form-control",
                "title" => "",
                "required" => "",
                "type" => "text",
                "value" => (isset($data["login_id"])) ? $data["login_id"] : ""
            );
            echo form_error("login_id");
            echo form_input($attribute);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'email' class = 'col-sm-2 col-form-label'>Email</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "email",
                "id" => "email",
                "class" => "form-control",
                "title" => "",
                "required" => "",
                "type" => "text",
                "value" => (isset($data["email"])) ? $data["email"] : ""
            );
            echo form_error("email");
            echo form_input($attribute);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'password' class = 'col-sm-2 col-form-label'>Password</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "password",
                "id" => "password",
                "class" => "form-control",
                "title" => "",
                "required" => "",
                "type" => "text",
                "value" => (isset($data["password"])) ? $data["password"] : ""
            );
            echo form_error("password");
            echo form_input($attribute);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'temp_registration_no' class = 'col-sm-2 col-form-label'>Temp registration no</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "temp_registration_no",
                "id" => "temp_registration_no",
                "class" => "form-control",
                "title" => "",
                "required" => "",
                "type" => "text",
                "value" => (isset($data["temp_registration_no"])) ? $data["temp_registration_no"] : ""
            );
            echo form_error("temp_registration_no");
            echo form_input($attribute);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'registration_no' class = 'col-sm-2 col-form-label'>Registration no</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "registration_no",
                "id" => "registration_no",
                "class" => "form-control",
                "title" => "",
                "required" => "",
                "type" => "text",
                "value" => (isset($data["registration_no"])) ? $data["registration_no"] : ""
            );
            echo form_error("registration_no");
            echo form_input($attribute);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'login_status' class = 'col-sm-2 col-form-label'>Login status</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "login_status",
                "id" => "login_status",
                "class" => "form-control",
                "title" => "",
                "required" => "",
            );
            $login_status = (isset($data['login_status'])) ? $data['login_status'] : '';
            echo form_error("login_status");
            echo form_dropdown($attribute, $login_status_list, $login_status);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'mobile' class = 'col-sm-2 col-form-label'>Mobile</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "mobile",
                "id" => "mobile",
                "class" => "form-control",
                "title" => "",
                "required" => "",
                "type" => "text",
                "value" => (isset($data["mobile"])) ? $data["mobile"] : ""
            );
            echo form_error("mobile");
            echo form_input($attribute);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'mobile_verified' class = 'col-sm-2 col-form-label'>Mobile verified</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "mobile_verified",
                "id" => "mobile_verified",
                "class" => "form-control",
                "title" => "",
                "required" => "",
            );
            $mobile_verified = (isset($data['mobile_verified'])) ? $data['mobile_verified'] : '';
            echo form_error("mobile_verified");
            echo form_dropdown($attribute, $mobile_verified_list, $mobile_verified);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'email_verified' class = 'col-sm-2 col-form-label'>Email verified</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "email_verified",
                "id" => "email_verified",
                "class" => "form-control",
                "title" => "",
                "required" => "",
            );
            $email_verified = (isset($data['email_verified'])) ? $data['email_verified'] : '';
            echo form_error("email_verified");
            echo form_dropdown($attribute, $email_verified_list, $email_verified);
            ?>
        </div>
    </div>

    <div class = 'form-group row'>
        <div class = 'col-sm-1'>
            <a class="text-right btn btn-default" href="<?= APP_BASE ?>student/student_users/index">
                <span class="glyphicon glyphicon-th-list"></span> Cancel
            </a>
        </div>
        <div class = 'col-sm-1'>
            <input type="submit" id="submit" value="Update" class="btn btn-primary">
        </div>
    </div>
    <?= form_close() ?>
</div>