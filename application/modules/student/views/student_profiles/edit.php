<div class="col-sm-12">
    <?php
    $form_attribute = array(
        "name" => "student_profiles",
        "id" => "student_profiles",
        "method" => "POST"
    );
    $form_action = "/student/student_profiles/edit";
    echo form_open($form_action, $form_attribute);
    ?>
    <?php
    $attribute = array(
        "name" => "sprofile_id",
        "id" => "sprofile_id",
        "class" => "form-control",
        "title" => "",
        "required" => "",
        "type" => "hidden",
        "value" => (isset($data["sprofile_id"])) ? $data["sprofile_id"] : ""
    );
    echo form_error("sprofile_id");
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
        <label for = 'user_id' class = 'col-sm-2 col-form-label'>User id</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "user_id",
                "id" => "user_id",
                "class" => "form-control",
                "title" => "",
                "required" => "",
            );
            $user_id = (isset($data['user_id'])) ? $data['user_id'] : '';
            echo form_error("user_id");
            echo form_dropdown($attribute, $user_id_list, $user_id);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'course_aca_batch_id' class = 'col-sm-2 col-form-label'>Course aca batch id</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "course_aca_batch_id",
                "id" => "course_aca_batch_id",
                "class" => "form-control",
                "title" => "",
                "required" => "",
            );
            $course_aca_batch_id = (isset($data['course_aca_batch_id'])) ? $data['course_aca_batch_id'] : '';
            echo form_error("course_aca_batch_id");
            echo form_dropdown($attribute, $course_aca_batch_id_list, $course_aca_batch_id);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'course_semister_id' class = 'col-sm-2 col-form-label'>Course semister id</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "course_semister_id",
                "id" => "course_semister_id",
                "class" => "form-control",
                "title" => "",
                "required" => "",
            );
            $course_semister_id = (isset($data['course_semister_id'])) ? $data['course_semister_id'] : '';
            echo form_error("course_semister_id");
            echo form_dropdown($attribute, $course_semister_id_list, $course_semister_id);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'photo' class = 'col-sm-2 col-form-label'>Photo</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "photo",
                "id" => "photo",
                "class" => "form-control",
                "title" => "",
                "required" => "",
                "type" => "text",
                "value" => (isset($data["photo"])) ? $data["photo"] : ""
            );
            echo form_error("photo");
            echo form_input($attribute);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'sign' class = 'col-sm-2 col-form-label'>Sign</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "sign",
                "id" => "sign",
                "class" => "form-control",
                "title" => "",
                "required" => "",
                "type" => "text",
                "value" => (isset($data["sign"])) ? $data["sign"] : ""
            );
            echo form_error("sign");
            echo form_input($attribute);
            ?>
        </div>
    </div>

    <div class = 'form-group row'>
        <div class = 'col-sm-1'>
            <a class="text-right btn btn-default" href="<?= APP_BASE ?>student/student_profiles/index">
                <span class="glyphicon glyphicon-th-list"></span> Cancel
            </a>
        </div>
        <div class = 'col-sm-1'>
            <input type="submit" id="submit" value="Update" class="btn btn-primary">
        </div>
    </div>
    <?= form_close() ?>
</div>