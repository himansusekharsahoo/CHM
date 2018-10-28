<div class="col-sm-12">
    <?php
    $form_attribute = array(
        "name" => "book_logs",
        "id" => "book_logs",
        "method" => "POST"
    );
    $form_action = "/library/book_logs/edit";
    echo form_open($form_action, $form_attribute);
    ?>
    <?php
    $attribute = array(
        "name" => "book_log_id",
        "id" => "book_log_id",
        "class" => "form-control",
        "title" => "",
        "required" => "",
        "type" => "hidden",
        "value" => (isset($data["book_log_id"])) ? $data["book_log_id"] : ""
    );
    echo form_error("book_log_id");
    echo form_input($attribute);
    ?><div class = 'form-group row'>
        <label for = 'category_name' class = 'col-sm-2 col-form-label'>Category name</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "category_name",
                "id" => "category_name",
                "class" => "form-control",
                "title" => "",
                "required" => "",
                "type" => "text",
                "value" => (isset($data["category_name"])) ? $data["category_name"] : ""
            );
            echo form_error("category_name");
            echo form_input($attribute);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'category_code' class = 'col-sm-2 col-form-label'>Category code</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "category_code",
                "id" => "category_code",
                "class" => "form-control",
                "title" => "",
                "required" => "",
                "type" => "text",
                "value" => (isset($data["category_code"])) ? $data["category_code"] : ""
            );
            echo form_error("category_code");
            echo form_input($attribute);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'category_parent_id' class = 'col-sm-2 col-form-label'>Category parent id</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "category_parent_id",
                "id" => "category_parent_id",
                "class" => "form-control",
                "title" => "",
                "required" => "",
                "type" => "text",
                "value" => (isset($data["category_parent_id"])) ? $data["category_parent_id"] : ""
            );
            echo form_error("category_parent_id");
            echo form_input($attribute);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'publication_name' class = 'col-sm-2 col-form-label'>Publication name</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "publication_name",
                "id" => "publication_name",
                "class" => "form-control",
                "title" => "",
                "required" => "",
                "type" => "text",
                "value" => (isset($data["publication_name"])) ? $data["publication_name"] : ""
            );
            echo form_error("publication_name");
            echo form_input($attribute);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'publication_code' class = 'col-sm-2 col-form-label'>Publication code</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "publication_code",
                "id" => "publication_code",
                "class" => "form-control",
                "title" => "",
                "required" => "",
                "type" => "text",
                "value" => (isset($data["publication_code"])) ? $data["publication_code"] : ""
            );
            echo form_error("publication_code");
            echo form_input($attribute);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'publication_remarks' class = 'col-sm-2 col-form-label'>Publication remarks</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "publication_remarks",
                "id" => "publication_remarks",
                "class" => "form-control",
                "title" => "",
                "required" => "",
                "type" => "text",
                "value" => (isset($data["publication_remarks"])) ? $data["publication_remarks"] : ""
            );
            echo form_error("publication_remarks");
            echo form_input($attribute);
            ?>
        </div>
    </div>
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
        <label for = 'author_remarks' class = 'col-sm-2 col-form-label'>Author remarks</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "author_remarks",
                "id" => "author_remarks",
                "class" => "form-control",
                "title" => "",
                "required" => "",
                "type" => "text",
                "value" => (isset($data["author_remarks"])) ? $data["author_remarks"] : ""
            );
            echo form_error("author_remarks");
            echo form_input($attribute);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'location_floor' class = 'col-sm-2 col-form-label'>Location floor</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "location_floor",
                "id" => "location_floor",
                "class" => "form-control",
                "title" => "",
                "required" => "",
                "type" => "text",
                "value" => (isset($data["location_floor"])) ? $data["location_floor"] : ""
            );
            echo form_error("location_floor");
            echo form_input($attribute);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'location_block' class = 'col-sm-2 col-form-label'>Location block</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "location_block",
                "id" => "location_block",
                "class" => "form-control",
                "title" => "",
                "required" => "",
                "type" => "text",
                "value" => (isset($data["location_block"])) ? $data["location_block"] : ""
            );
            echo form_error("location_block");
            echo form_input($attribute);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'location_rack_no' class = 'col-sm-2 col-form-label'>Location rack no</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "location_rack_no",
                "id" => "location_rack_no",
                "class" => "form-control",
                "title" => "",
                "required" => "",
                "type" => "text",
                "value" => (isset($data["location_rack_no"])) ? $data["location_rack_no"] : ""
            );
            echo form_error("location_rack_no");
            echo form_input($attribute);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'location_self_no' class = 'col-sm-2 col-form-label'>Location self no</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "location_self_no",
                "id" => "location_self_no",
                "class" => "form-control",
                "title" => "",
                "required" => "",
                "type" => "text",
                "value" => (isset($data["location_self_no"])) ? $data["location_self_no"] : ""
            );
            echo form_error("location_self_no");
            echo form_input($attribute);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'ledger_id' class = 'col-sm-2 col-form-label'>Ledger id</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "ledger_id",
                "id" => "ledger_id",
                "class" => "form-control",
                "title" => "",
                "required" => "",
                "type" => "text",
                "value" => (isset($data["ledger_id"])) ? $data["ledger_id"] : ""
            );
            echo form_error("ledger_id");
            echo form_input($attribute);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'ledger_page' class = 'col-sm-2 col-form-label'>Ledger page</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "ledger_page",
                "id" => "ledger_page",
                "class" => "form-control",
                "title" => "",
                "required" => "",
                "type" => "text",
                "value" => (isset($data["ledger_page"])) ? $data["ledger_page"] : ""
            );
            echo form_error("ledger_page");
            echo form_input($attribute);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'ledger_mrp' class = 'col-sm-2 col-form-label'>Ledger mrp</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "ledger_mrp",
                "id" => "ledger_mrp",
                "class" => "form-control",
                "title" => "",
                "required" => "",
                "type" => "text",
                "value" => (isset($data["ledger_mrp"])) ? $data["ledger_mrp"] : ""
            );
            echo form_error("ledger_mrp");
            echo form_input($attribute);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'ledger_isbn' class = 'col-sm-2 col-form-label'>Ledger isbn</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "ledger_isbn",
                "id" => "ledger_isbn",
                "class" => "form-control",
                "title" => "",
                "required" => "",
                "type" => "text",
                "value" => (isset($data["ledger_isbn"])) ? $data["ledger_isbn"] : ""
            );
            echo form_error("ledger_isbn");
            echo form_input($attribute);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'ledger_edition' class = 'col-sm-2 col-form-label'>Ledger edition</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "ledger_edition",
                "id" => "ledger_edition",
                "class" => "form-control",
                "title" => "",
                "required" => "",
                "type" => "text",
                "value" => (isset($data["ledger_edition"])) ? $data["ledger_edition"] : ""
            );
            echo form_error("ledger_edition");
            echo form_input($attribute);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'ledger_bar_code' class = 'col-sm-2 col-form-label'>Ledger bar code</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "ledger_bar_code",
                "id" => "ledger_bar_code",
                "class" => "form-control",
                "title" => "",
                "required" => "",
                "type" => "text",
                "value" => (isset($data["ledger_bar_code"])) ? $data["ledger_bar_code"] : ""
            );
            echo form_error("ledger_bar_code");
            echo form_input($attribute);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'ledger_qr_code' class = 'col-sm-2 col-form-label'>Ledger qr code</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "ledger_qr_code",
                "id" => "ledger_qr_code",
                "class" => "form-control",
                "title" => "",
                "required" => "",
                "type" => "text",
                "value" => (isset($data["ledger_qr_code"])) ? $data["ledger_qr_code"] : ""
            );
            echo form_error("ledger_qr_code");
            echo form_input($attribute);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'ledger_created' class = 'col-sm-2 col-form-label'>Ledger created</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "ledger_created",
                "id" => "ledger_created",
                "class" => "form-control",
                "title" => "",
                "required" => "",
                "type" => "text",
                "value" => (isset($data["ledger_created"])) ? $data["ledger_created"] : ""
            );
            echo form_error("ledger_created");
            echo form_input($attribute);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'ledger_created_by' class = 'col-sm-2 col-form-label'>Ledger created by</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "ledger_created_by",
                "id" => "ledger_created_by",
                "class" => "form-control",
                "title" => "",
                "required" => "",
                "type" => "text",
                "value" => (isset($data["ledger_created_by"])) ? $data["ledger_created_by"] : ""
            );
            echo form_error("ledger_created_by");
            echo form_input($attribute);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'ledger_modified' class = 'col-sm-2 col-form-label'>Ledger modified</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "ledger_modified",
                "id" => "ledger_modified",
                "class" => "form-control",
                "title" => "",
                "required" => "",
                "type" => "text",
                "value" => (isset($data["ledger_modified"])) ? $data["ledger_modified"] : ""
            );
            echo form_error("ledger_modified");
            echo form_input($attribute);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'ledger_modified_by' class = 'col-sm-2 col-form-label'>Ledger modified by</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "ledger_modified_by",
                "id" => "ledger_modified_by",
                "class" => "form-control",
                "title" => "",
                "required" => "",
                "type" => "text",
                "value" => (isset($data["ledger_modified_by"])) ? $data["ledger_modified_by"] : ""
            );
            echo form_error("ledger_modified_by");
            echo form_input($attribute);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'book_id' class = 'col-sm-2 col-form-label'>Book id</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "book_id",
                "id" => "book_id",
                "class" => "form-control",
                "title" => "",
                "required" => "",
                "type" => "text",
                "value" => (isset($data["book_id"])) ? $data["book_id"] : ""
            );
            echo form_error("book_id");
            echo form_input($attribute);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'book_name' class = 'col-sm-2 col-form-label'>Book name</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "book_name",
                "id" => "book_name",
                "class" => "form-control",
                "title" => "",
                "required" => "",
                "type" => "text",
                "value" => (isset($data["book_name"])) ? $data["book_name"] : ""
            );
            echo form_error("book_name");
            echo form_input($attribute);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'book_code' class = 'col-sm-2 col-form-label'>Book code</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "book_code",
                "id" => "book_code",
                "class" => "form-control",
                "title" => "",
                "required" => "",
                "type" => "text",
                "value" => (isset($data["book_code"])) ? $data["book_code"] : ""
            );
            echo form_error("book_code");
            echo form_input($attribute);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'book_status' class = 'col-sm-2 col-form-label'>Book status</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "book_status",
                "id" => "book_status",
                "class" => "form-control",
                "title" => "",
                "required" => "",
                "type" => "text",
                "value" => (isset($data["book_status"])) ? $data["book_status"] : ""
            );
            echo form_error("book_status");
            echo form_input($attribute);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'book_created' class = 'col-sm-2 col-form-label'>Book created</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "book_created",
                "id" => "book_created",
                "class" => "form-control",
                "title" => "",
                "required" => "",
                "type" => "text",
                "value" => (isset($data["book_created"])) ? $data["book_created"] : ""
            );
            echo form_error("book_created");
            echo form_input($attribute);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'book_created_by' class = 'col-sm-2 col-form-label'>Book created by</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "book_created_by",
                "id" => "book_created_by",
                "class" => "form-control",
                "title" => "",
                "required" => "",
                "type" => "text",
                "value" => (isset($data["book_created_by"])) ? $data["book_created_by"] : ""
            );
            echo form_error("book_created_by");
            echo form_input($attribute);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'book_modified' class = 'col-sm-2 col-form-label'>Book modified</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "book_modified",
                "id" => "book_modified",
                "class" => "form-control",
                "title" => "",
                "required" => "",
                "type" => "text",
                "value" => (isset($data["book_modified"])) ? $data["book_modified"] : ""
            );
            echo form_error("book_modified");
            echo form_input($attribute);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'book_modified_by' class = 'col-sm-2 col-form-label'>Book modified by</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "book_modified_by",
                "id" => "book_modified_by",
                "class" => "form-control",
                "title" => "",
                "required" => "",
                "type" => "text",
                "value" => (isset($data["book_modified_by"])) ? $data["book_modified_by"] : ""
            );
            echo form_error("book_modified_by");
            echo form_input($attribute);
            ?>
        </div>
    </div>

    <div class = 'form-group row'>
        <div class = 'col-sm-1'>
            <a class="text-right btn btn-default" href="<?= APP_BASE ?>library/book_logs/index">
                <span class="glyphicon glyphicon-th-list"></span> Cancel
            </a>
        </div>
        <div class = 'col-sm-1'>
            <input type="submit" id="submit" value="Update" class="btn btn-primary">
        </div>
    </div>
    <?= form_close() ?>
</div>