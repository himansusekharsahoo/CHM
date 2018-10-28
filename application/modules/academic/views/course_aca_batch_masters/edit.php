<div class="col-sm-12">
    <?php
    $form_attribute = array(
        "name" => "course_aca_batch_masters",
        "id" => "course_aca_batch_masters",
        "method" => "POST"
    );
    $form_action = "/academic/course_aca_batch_masters/edit";
    echo form_open($form_action, $form_attribute);
    ?>
    <?php
    $attribute = array(
        "name" => "course_aca_batch_id",
        "id" => "course_aca_batch_id",
        "class" => "form-control",
        "title" => "",
        "required" => "",
        "type" => "hidden",
        "value" => (isset($data["course_aca_batch_id"])) ? $data["course_aca_batch_id"] : ""
    );
    echo form_error("course_aca_batch_id");
    echo form_input($attribute);
    ?><div class = 'form-group row'>
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
        <label for = 'description' class = 'col-sm-2 col-form-label'>Description</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "description",
                "id" => "description",
                "class" => "form-control",
                "title" => "",
                "required" => "",
                "type" => "text",
                "value" => (isset($data["description"])) ? $data["description"] : ""
            );
            echo form_error("description");
            echo form_input($attribute);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'start_year' class = 'col-sm-2 col-form-label'>Start year</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "start_year",
                "id" => "start_year",
                "class" => "form-control",
                "title" => "",
                "required" => "",
                "type" => "number",
                "value" => (isset($data["start_year"])) ? $data["start_year"] : ""
            );
            echo form_error("start_year");
            echo form_input($attribute);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'end_year' class = 'col-sm-2 col-form-label'>End year</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "end_year",
                "id" => "end_year",
                "class" => "form-control",
                "title" => "",
                "required" => "",
                "type" => "number",
                "value" => (isset($data["end_year"])) ? $data["end_year"] : ""
            );
            echo form_error("end_year");
            echo form_input($attribute);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'terms' class = 'col-sm-2 col-form-label'>Terms</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "terms",
                "id" => "terms",
                "class" => "form-control",
                "title" => "",
                "required" => "",
                "type" => "number",
                "value" => (isset($data["terms"])) ? $data["terms"] : ""
            );
            echo form_error("terms");
            echo form_input($attribute);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'course_dept_id' class = 'col-sm-2 col-form-label'>Course dept id</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "course_dept_id",
                "id" => "course_dept_id",
                "class" => "form-control",
                "title" => "",
                "required" => "",
            );
            $course_dept_id = (isset($data['course_dept_id'])) ? $data['course_dept_id'] : '';
            echo form_error("course_dept_id");
            echo form_dropdown($attribute, $course_dept_id_list, $course_dept_id);
            ?>
        </div>
    </div>

    <div class = 'form-group row'>
        <div class = 'col-sm-1'>
            <a class="text-right btn btn-default" href="<?= APP_BASE ?>academic/course_aca_batch_masters/index">
                <span class="glyphicon glyphicon-th-list"></span> Cancel
            </a>
        </div>
        <div class = 'col-sm-1'>
            <input type="submit" id="submit" value="Update" class="btn btn-primary">
        </div>
    </div>
    <?= form_close() ?>
</div>