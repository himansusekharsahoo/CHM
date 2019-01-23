<div class="col-sm-12">
    <?php
    $form_attribute = array(
        "name" => "book_category_masters",
        "id" => "book_category_masters",
        "method" => "POST"
    );
    $form_action = base_url('edit-book-category-save');
    echo form_open($form_action, $form_attribute);
    ?>
    <?php
    $attribute = array(
        "name" => "bcategory_id",
        "id" => "bcategory_id",
        "class" => "form-control",
        "title" => "",
        "required" => "",
        "type" => "hidden",
        "value" => (isset($data["bcategory_id"])) ? $data["bcategory_id"] : ""
    );
    echo form_error("bcategory_id");
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
<!--    <div class = 'form-group row'>
        <label for = 'parent_id' class = 'col-sm-2 col-form-label'>Parent id</label>
        <div class = 'col-sm-3'>-->
            <?php
            $attribute = array(
                "name" => "parent_id",
                "id" => "parent_id",
                "class" => "form-control",
                "type" => "hidden",
                "value" => (isset($data["parent_id"])) ? $data["parent_id"] : "0"
            );
            echo form_error("parent_id");
            echo form_input($attribute);
            ?>
<!--        </div>
    </div>-->

    <div class = 'form-group row'>
        <div class = 'col-sm-1'>
            <a class="text-right btn btn-default" href="<?= base_url('manage-book-category')?>">
                <span class="glyphicon glyphicon-th-list"></span> Cancel
            </a>
        </div>
        <div class = 'col-sm-1'>
            <input type="submit" id="submit" value="Update" class="btn btn-primary">
        </div>
    </div>
    <?= form_close() ?>
</div>