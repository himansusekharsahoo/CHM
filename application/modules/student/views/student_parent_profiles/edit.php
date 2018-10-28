<div class="col-sm-12">
    <?php
    $form_attribute = array(
        "name" => "student_parent_profiles",
        "id" => "student_parent_profiles",
        "method" => "POST"
    );
    $form_action = "/student/student_parent_profiles/edit";
    echo form_open($form_action, $form_attribute);
    ?>
    <?php
    $attribute = array(
        "name" => "student_parent_id",
        "id" => "student_parent_id",
        "class" => "form-control",
        "title" => "",
        "required" => "",
        "type" => "hidden",
        "value" => (isset($data["student_parent_id"])) ? $data["student_parent_id"] : ""
    );
    echo form_error("student_parent_id");
    echo form_input($attribute);
    ?><div class = 'form-group row'>
        <label for = 'student_user_id' class = 'col-sm-2 col-form-label'>Student user id</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "student_user_id",
                "id" => "student_user_id",
                "class" => "form-control",
                "title" => "",
                "required" => "",
            );
            $student_user_id = (isset($data['student_user_id'])) ? $data['student_user_id'] : '';
            echo form_error("student_user_id");
            echo form_dropdown($attribute, $student_user_id_list, $student_user_id);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'father_name' class = 'col-sm-2 col-form-label'>Father name</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "father_name",
                "id" => "father_name",
                "class" => "form-control",
                "title" => "",
                "required" => "",
                "type" => "text",
                "value" => (isset($data["father_name"])) ? $data["father_name"] : ""
            );
            echo form_error("father_name");
            echo form_input($attribute);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'mother_name' class = 'col-sm-2 col-form-label'>Mother name</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "mother_name",
                "id" => "mother_name",
                "class" => "form-control",
                "title" => "",
                "required" => "",
                "type" => "text",
                "value" => (isset($data["mother_name"])) ? $data["mother_name"] : ""
            );
            echo form_error("mother_name");
            echo form_input($attribute);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'spouse_name' class = 'col-sm-2 col-form-label'>Spouse name</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "spouse_name",
                "id" => "spouse_name",
                "class" => "form-control",
                "title" => "",
                "required" => "",
                "type" => "text",
                "value" => (isset($data["spouse_name"])) ? $data["spouse_name"] : ""
            );
            echo form_error("spouse_name");
            echo form_input($attribute);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'contact_no' class = 'col-sm-2 col-form-label'>Contact no</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "contact_no",
                "id" => "contact_no",
                "class" => "form-control",
                "title" => "",
                "required" => "",
                "type" => "text",
                "value" => (isset($data["contact_no"])) ? $data["contact_no"] : ""
            );
            echo form_error("contact_no");
            echo form_input($attribute);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'emergency_contact_no' class = 'col-sm-2 col-form-label'>Emergency contact no</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "emergency_contact_no",
                "id" => "emergency_contact_no",
                "class" => "form-control",
                "title" => "",
                "required" => "",
                "type" => "text",
                "value" => (isset($data["emergency_contact_no"])) ? $data["emergency_contact_no"] : ""
            );
            echo form_error("emergency_contact_no");
            echo form_input($attribute);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'email_id' class = 'col-sm-2 col-form-label'>Email id</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "email_id",
                "id" => "email_id",
                "class" => "form-control",
                "title" => "",
                "required" => "",
                "type" => "text",
                "value" => (isset($data["email_id"])) ? $data["email_id"] : ""
            );
            echo form_error("email_id");
            echo form_input($attribute);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'address' class = 'col-sm-2 col-form-label'>Address</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "address",
                "id" => "address",
                "class" => "form-control",
                "title" => "",
                "required" => "",
            );
            $value = (isset($data["address"])) ? $data["address"] : "";
            echo form_error("address");
            echo form_textarea($attribute, $value);
            ?>
        </div>
    </div>

    <div class = 'form-group row'>
        <div class = 'col-sm-1'>
            <a class="text-right btn btn-default" href="<?= APP_BASE ?>student/student_parent_profiles/index">
                <span class="glyphicon glyphicon-th-list"></span> Cancel
            </a>
        </div>
        <div class = 'col-sm-1'>
            <input type="submit" id="submit" value="Update" class="btn btn-primary">
        </div>
    </div>
    <?= form_close() ?>
</div>