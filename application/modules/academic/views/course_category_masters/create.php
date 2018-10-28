<div class="col-sm-12">
    <?php
    $form_attribute = array(
        "name" => "course_category_masters",
        "id" => "course_category_masters",
        "method" => "POST"
    );
    $form_action = "/academic/course_category_masters/create";
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
        <div class = 'col-sm-1'>
            <a class="text-right btn btn-default" href="<?= APP_BASE ?>academic/course_category_masters/index">
                <span class="glyphicon glyphicon-th-list"></span> Cancel
            </a>
        </div>
        <div class = 'col-sm-1'>
            <input type="submit" id="submit" value="Save" class="btn btn-primary">
        </div>
    </div>
    <?= form_close() ?>
</div>