<div class="col-sm-12">
    <?php
    $form_attribute = array(
        "name" => "course_department_masters",
        "id" => "course_department_masters",
        "method" => "POST"
    );
    $form_action = "/academic/course_department_masters/create";
    echo form_open($form_action, $form_attribute);
    ?>
    <div class = 'form-group row'>
        <label for = 'name' class = 'col-sm-2 col-form-label'>Name</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "name",
                "id" => "name",
                "class" => "form-control",
                "title" => "",
                "required" => "",
                "type" => "text",
                "value" => (isset($data["name"])) ? $data["name"] : ""
            );
            echo form_error("name");
            echo form_input($attribute);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'code' class = 'col-sm-2 col-form-label'>Code</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "code",
                "id" => "code",
                "class" => "form-control",
                "title" => "",
                "required" => "",
                "type" => "text",
                "value" => (isset($data["code"])) ? $data["code"] : ""
            );
            echo form_error("code");
            echo form_input($attribute);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'course_category_id' class = 'col-sm-2 col-form-label'>Course category id</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "course_category_id",
                "id" => "course_category_id",
                "class" => "form-control",
                "title" => "",
                "required" => "",
                "type" => "number",
                "value" => (isset($data["course_category_id"])) ? $data["course_category_id"] : ""
            );
            echo form_error("course_category_id");
            echo form_input($attribute);
            ?>
        </div>
    </div>

    <div class = 'form-group row'>
        <div class = 'col-sm-1'>
            <a class="text-right btn btn-default" href="<?= APP_BASE ?>academic/course_department_masters/index">
                <span class="glyphicon glyphicon-th-list"></span> Cancel
            </a>
        </div>
        <div class = 'col-sm-1'>
            <input type="submit" id="submit" value="Save" class="btn btn-primary">
        </div>
    </div>
    <?= form_close() ?>
</div>