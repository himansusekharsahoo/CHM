<div class="col-sm-12">
    <?php
    $form_attribute = array(
        "name" => "requested_books",
        "id" => "requested_books",
        "method" => "POST"
    );
    $form_action = "/library/requested_books/edit";
    echo form_open($form_action, $form_attribute);
    ?>
    <?php
    $attribute = array(
        "name" => "request_id",
        "id" => "request_id",
        "class" => "form-control",
        "title" => "",
        "required" => "",
        "type" => "hidden",
        "value" => (isset($data["request_id"])) ? $data["request_id"] : ""
    );
    echo form_error("request_id");
    echo form_input($attribute);
    ?><div class = 'form-group row'>
        <label for = 'requested_by' class = 'col-sm-2 col-form-label'>Requested by</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "requested_by",
                "id" => "requested_by",
                "class" => "form-control",
                "title" => "",
                "required" => "",
                "type" => "text",
                "value" => (isset($data["requested_by"])) ? $data["requested_by"] : ""
            );
            echo form_error("requested_by");
            echo form_input($attribute);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'requested_by_id' class = 'col-sm-2 col-form-label'>Requested by id</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "requested_by_id",
                "id" => "requested_by_id",
                "class" => "form-control",
                "title" => "",
                "required" => "",
                "type" => "number",
                "value" => (isset($data["requested_by_id"])) ? $data["requested_by_id"] : ""
            );
            echo form_error("requested_by_id");
            echo form_input($attribute);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'bledger_id' class = 'col-sm-2 col-form-label'>Bledger id</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "bledger_id",
                "id" => "bledger_id",
                "class" => "form-control",
                "title" => "",
                "required" => "",
            );
            $bledger_id = (isset($data['bledger_id'])) ? $data['bledger_id'] : '';
            echo form_error("bledger_id");
            echo form_dropdown($attribute, $bledger_id_list, $bledger_id);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'purchage_status' class = 'col-sm-2 col-form-label'>Purchage status</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "purchage_status",
                "id" => "purchage_status",
                "class" => "form-control",
                "title" => "",
                "required" => "",
            );
            $purchage_status = (isset($data['purchage_status'])) ? $data['purchage_status'] : '';
            echo form_error("purchage_status");
            echo form_dropdown($attribute, $purchage_status_list, $purchage_status);
            ?>
        </div>
    </div>

    <div class = 'form-group row'>
        <div class = 'col-sm-1'>
            <a class="text-right btn btn-default" href="<?= APP_BASE ?>library/requested_books/index">
                <span class="glyphicon glyphicon-th-list"></span> Cancel
            </a>
        </div>
        <div class = 'col-sm-1'>
            <input type="submit" id="submit" value="Update" class="btn btn-primary">
        </div>
    </div>
    <?= form_close() ?>
</div>