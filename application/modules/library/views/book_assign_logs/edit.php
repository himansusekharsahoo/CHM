<div class="col-sm-12">
    <?php
    $form_attribute = array(
        "name" => "book_assign_logs",
        "id" => "book_assign_logs",
        "method" => "POST"
    );
    $form_action = "/library/book_assign_logs/edit";
    echo form_open($form_action, $form_attribute);
    ?>
    <?php
    $attribute = array(
        "name" => "bassign_id",
        "id" => "bassign_id",
        "class" => "form-control",
        "title" => "",
        "required" => "",
        "type" => "hidden",
        "value" => (isset($data["bassign_id"])) ? $data["bassign_id"] : ""
    );
    echo form_error("bassign_id");
    echo form_input($attribute);
    ?><div class = 'form-group row'>
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
        <label for = 'member_id' class = 'col-sm-2 col-form-label'>Member id</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "member_id",
                "id" => "member_id",
                "class" => "form-control",
                "title" => "",
                "required" => "",
                "type" => "number",
                "value" => (isset($data["member_id"])) ? $data["member_id"] : ""
            );
            echo form_error("member_id");
            echo form_input($attribute);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'user_type' class = 'col-sm-2 col-form-label'>User type</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "user_type",
                "id" => "user_type",
                "class" => "form-control",
                "title" => "",
                "required" => "",
                "type" => "text",
                "value" => (isset($data["user_type"])) ? $data["user_type"] : ""
            );
            echo form_error("user_type");
            echo form_input($attribute);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'issue_date' class = 'col-sm-2 col-form-label'>Issue date</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "issue_date",
                "id" => "issue_date",
                "class" => "form-control",
                "title" => "",
                "required" => "",
                "type" => "datetime ",
                "value" => (isset($data["issue_date"])) ? $data["issue_date"] : ""
            );
            echo form_error("issue_date");
            echo form_input($attribute);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'due_date' class = 'col-sm-2 col-form-label'>Due date</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "due_date",
                "id" => "due_date",
                "class" => "form-control",
                "title" => "",
                "required" => "",
                "type" => "datetime ",
                "value" => (isset($data["due_date"])) ? $data["due_date"] : ""
            );
            echo form_error("due_date");
            echo form_input($attribute);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'return_date' class = 'col-sm-2 col-form-label'>Return date</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "return_date",
                "id" => "return_date",
                "class" => "form-control",
                "title" => "",
                "required" => "",
                "type" => "datetime ",
                "value" => (isset($data["return_date"])) ? $data["return_date"] : ""
            );
            echo form_error("return_date");
            echo form_input($attribute);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'return_delay_fine' class = 'col-sm-2 col-form-label'>Return delay fine</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "return_delay_fine",
                "id" => "return_delay_fine",
                "class" => "form-control",
                "title" => "",
                "required" => "",
                "type" => "text",
                "value" => (isset($data["return_delay_fine"])) ? $data["return_delay_fine"] : ""
            );
            echo form_error("return_delay_fine");
            echo form_input($attribute);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'book_return_condition' class = 'col-sm-2 col-form-label'>Book return condition</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "book_return_condition",
                "id" => "book_return_condition",
                "class" => "form-control",
                "title" => "",
                "required" => "",
            );
            $book_return_condition = (isset($data['book_return_condition'])) ? $data['book_return_condition'] : '';
            echo form_error("book_return_condition");
            echo form_dropdown($attribute, $book_return_condition_list, $book_return_condition);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'book_lost_fine' class = 'col-sm-2 col-form-label'>Book lost fine</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "book_lost_fine",
                "id" => "book_lost_fine",
                "class" => "form-control",
                "title" => "",
                "required" => "",
                "type" => "text",
                "value" => (isset($data["book_lost_fine"])) ? $data["book_lost_fine"] : ""
            );
            echo form_error("book_lost_fine");
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
            <a class="text-right btn btn-default" href="<?= APP_BASE ?>library/book_assign_logs/index">
                <span class="glyphicon glyphicon-th-list"></span> Cancel
            </a>
        </div>
        <div class = 'col-sm-1'>
            <input type="submit" id="submit" value="Update" class="btn btn-primary">
        </div>
    </div>
    <?= form_close() ?>
</div>