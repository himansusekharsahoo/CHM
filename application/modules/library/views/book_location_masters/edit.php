<div class="col-sm-12">
    <?php
    $form_attribute = array(
        "name" => "book_location_masters",
        "id" => "book_location_masters",
        "method" => "POST"
    );
    $form_action = "/library/book_location_masters/edit";
    echo form_open($form_action, $form_attribute);
    ?>
    <?php
    $attribute = array(
        "name" => "blocation_id",
        "id" => "blocation_id",
        "class" => "form-control",
        "title" => "",
        "required" => "",
        "type" => "hidden",
        "value" => (isset($data["blocation_id"])) ? $data["blocation_id"] : ""
    );
    echo form_error("blocation_id");
    echo form_input($attribute);
    ?><div class = 'form-group row'>
        <label for = 'floor' class = 'col-sm-2 col-form-label'>Floor</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "floor",
                "id" => "floor",
                "class" => "form-control",
                "title" => "",
                "required" => "",
                "type" => "text",
                "value" => (isset($data["floor"])) ? $data["floor"] : ""
            );
            echo form_error("floor");
            echo form_input($attribute);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'block' class = 'col-sm-2 col-form-label'>Block</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "block",
                "id" => "block",
                "class" => "form-control",
                "title" => "",
                "required" => "",
                "type" => "text",
                "value" => (isset($data["block"])) ? $data["block"] : ""
            );
            echo form_error("block");
            echo form_input($attribute);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'rack_no' class = 'col-sm-2 col-form-label'>Rack no</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "rack_no",
                "id" => "rack_no",
                "class" => "form-control",
                "title" => "",
                "required" => "",
                "type" => "text",
                "value" => (isset($data["rack_no"])) ? $data["rack_no"] : ""
            );
            echo form_error("rack_no");
            echo form_input($attribute);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'self_no' class = 'col-sm-2 col-form-label'>Self no</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "self_no",
                "id" => "self_no",
                "class" => "form-control",
                "title" => "",
                "required" => "",
                "type" => "text",
                "value" => (isset($data["self_no"])) ? $data["self_no"] : ""
            );
            echo form_error("self_no");
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
            <a class="text-right btn btn-default" href="<?= APP_BASE ?>library/book_location_masters/index">
                <span class="glyphicon glyphicon-th-list"></span> Cancel
            </a>
        </div>
        <div class = 'col-sm-1'>
            <input type="submit" id="submit" value="Update" class="btn btn-primary">
        </div>
    </div>
    <?= form_close() ?>
</div>