<div class="col-sm-12">
    <?php
    $form_attribute = array(
        "name" => "library_members",
        "id" => "library_members",
        "method" => "POST"
    );
    $form_action = "/library/library_members/edit";
    echo form_open($form_action, $form_attribute);
    ?>
    <?php
    $attribute = array(
        "name" => "member_id",
        "id" => "member_id",
        "class" => "form-control",
        "title" => "",
        "required" => "",
        "type" => "hidden",
        "value" => (isset($data["member_id"])) ? $data["member_id"] : ""
    );
    echo form_error("member_id");
    echo form_input($attribute);
    ?><div class = 'form-group row'>
        <label for = 'card_no' class = 'col-sm-2 col-form-label'>Card no</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "card_no",
                "id" => "card_no",
                "class" => "form-control",
                "title" => "",
                "required" => "",
                "type" => "text",
                "value" => (isset($data["card_no"])) ? $data["card_no"] : ""
            );
            echo form_error("card_no");
            echo form_input($attribute);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'date_issue' class = 'col-sm-2 col-form-label'>Date issue</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "date_issue",
                "id" => "date_issue",
                "class" => "form-control",
                "title" => "",
                "required" => "",
                "type" => "text",
                "value" => (isset($data["date_issue"])) ? $data["date_issue"] : ""
            );
            echo form_error("date_issue");
            echo form_input($attribute);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'expiry_date' class = 'col-sm-2 col-form-label'>Expiry date</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "expiry_date",
                "id" => "expiry_date",
                "class" => "form-control",
                "title" => "",
                "required" => "",
                "type" => "text",
                "value" => (isset($data["expiry_date"])) ? $data["expiry_date"] : ""
            );
            echo form_error("expiry_date");
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
                "type" => "number",
                "value" => (isset($data["user_id"])) ? $data["user_id"] : ""
            );
            echo form_error("user_id");
            echo form_input($attribute);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'user_role_id' class = 'col-sm-2 col-form-label'>User role id</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "user_role_id",
                "id" => "user_role_id",
                "class" => "form-control",
                "title" => "",
                "required" => "",
                "type" => "number",
                "value" => (isset($data["user_role_id"])) ? $data["user_role_id"] : ""
            );
            echo form_error("user_role_id");
            echo form_input($attribute);
            ?>
        </div>
    </div>

    <div class = 'form-group row'>
        <div class = 'col-sm-1'>
            <a class="text-right btn btn-default" href="<?= APP_BASE ?>library/library_members/index">
                <span class="glyphicon glyphicon-th-list"></span> Cancel
            </a>
        </div>
        <div class = 'col-sm-1'>
            <input type="submit" id="submit" value="Update" class="btn btn-primary">
        </div>
    </div>
    <?= form_close() ?>
</div>