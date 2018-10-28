<div class="col-sm-12">
    <?php
    $form_attribute = array(
        "name" => "book_author_masters",
        "id" => "book_author_masters",
        "method" => "POST"
    );
    $form_action = "/library/book_author_masters/create";
    echo form_open($form_action, $form_attribute);
    ?>
    <div class = 'form-group row'>
        <label for = 'author_name' class = 'col-sm-2 col-form-label'>Author name</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "author_name",
                "id" => "author_name",
                "class" => "form-control",
                "title" => "",
                "required" => "",
                "type" => "text",
                "value" => (isset($data["author_name"])) ? $data["author_name"] : ""
            );
            echo form_error("author_name");
            echo form_input($attribute);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'remarks' class = 'col-sm-2 col-form-label'>Remarks</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "remarks",
                "id" => "remarks",
                "class" => "form-control",
                "title" => "",
                "required" => "",
                "type" => "text",
                "value" => (isset($data["remarks"])) ? $data["remarks"] : ""
            );
            echo form_error("remarks");
            echo form_input($attribute);
            ?>
        </div>
    </div>

    <div class = 'form-group row'>
        <div class = 'col-sm-1'>
            <a class="text-right btn btn-default" href="<?= APP_BASE ?>library/book_author_masters/index">
                <span class="glyphicon glyphicon-th-list"></span> Cancel
            </a>
        </div>
        <div class = 'col-sm-1'>
            <input type="submit" id="submit" value="Save" class="btn btn-primary">
        </div>
    </div>
    <?= form_close() ?>
</div>