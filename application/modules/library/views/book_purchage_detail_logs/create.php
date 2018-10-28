<div class="col-sm-12">
    <?php
    $form_attribute = array(
        "name" => "book_purchage_detail_logs",
        "id" => "book_purchage_detail_logs",
        "method" => "POST"
    );
    $form_action = "/library/book_purchage_detail_logs/create";
    echo form_open($form_action, $form_attribute);
    ?>
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
        <label for = 'bill_number' class = 'col-sm-2 col-form-label'>Bill number</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "bill_number",
                "id" => "bill_number",
                "class" => "form-control",
                "title" => "",
                "required" => "",
                "type" => "text",
                "value" => (isset($data["bill_number"])) ? $data["bill_number"] : ""
            );
            echo form_error("bill_number");
            echo form_input($attribute);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'purchase_date' class = 'col-sm-2 col-form-label'>Purchase date</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "purchase_date",
                "id" => "purchase_date",
                "class" => "form-control",
                "title" => "",
                "required" => "",
                "type" => "date ",
                "value" => (isset($data["purchase_date"])) ? $data["purchase_date"] : ""
            );
            echo form_error("purchase_date");
            echo form_input($attribute);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'price' class = 'col-sm-2 col-form-label'>Price</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "price",
                "id" => "price",
                "class" => "form-control",
                "title" => "",
                "required" => "",
                "type" => "text",
                "value" => (isset($data["price"])) ? $data["price"] : ""
            );
            echo form_error("price");
            echo form_input($attribute);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'vendor_name' class = 'col-sm-2 col-form-label'>Vendor name</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "vendor_name",
                "id" => "vendor_name",
                "class" => "form-control",
                "title" => "",
                "required" => "",
                "type" => "text",
                "value" => (isset($data["vendor_name"])) ? $data["vendor_name"] : ""
            );
            echo form_error("vendor_name");
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
            );
            $value = (isset($data["remarks"])) ? $data["remarks"] : "";
            echo form_error("remarks");
            echo form_textarea($attribute, $value);
            ?>
        </div>
    </div>

    <div class = 'form-group row'>
        <div class = 'col-sm-1'>
            <a class="text-right btn btn-default" href="<?= APP_BASE ?>library/book_purchage_detail_logs/index">
                <span class="glyphicon glyphicon-th-list"></span> Cancel
            </a>
        </div>
        <div class = 'col-sm-1'>
            <input type="submit" id="submit" value="Save" class="btn btn-primary">
        </div>
    </div>
    <?= form_close() ?>
</div>