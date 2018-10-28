<div class="col-sm-12">
    <?php
    $form_attribute = array(
        "name" => "book_ledgers",
        "id" => "book_ledgers",
        "method" => "POST"
    );
    $form_action = "/library/book_ledgers/edit";
    echo form_open($form_action, $form_attribute);
    ?>
    <?php
    $attribute = array(
        "name" => "bledger_id",
        "id" => "bledger_id",
        "class" => "form-control",
        "title" => "",
        "required" => "",
        "type" => "hidden",
        "value" => (isset($data["bledger_id"])) ? $data["bledger_id"] : ""
    );
    echo form_error("bledger_id");
    echo form_input($attribute);
    ?><div class = 'form-group row'>
        <label for = 'book_id' class = 'col-sm-2 col-form-label'>Book id</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "book_id",
                "id" => "book_id",
                "class" => "form-control",
                "title" => "",
                "required" => "",
            );
            $book_id = (isset($data['book_id'])) ? $data['book_id'] : '';
            echo form_error("book_id");
            echo form_dropdown($attribute, $book_id_list, $book_id);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'bcategory_id' class = 'col-sm-2 col-form-label'>Bcategory id</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "bcategory_id",
                "id" => "bcategory_id",
                "class" => "form-control",
                "title" => "",
                "required" => "",
            );
            $bcategory_id = (isset($data['bcategory_id'])) ? $data['bcategory_id'] : '';
            echo form_error("bcategory_id");
            echo form_dropdown($attribute, $bcategory_id_list, $bcategory_id);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'bpublication_id' class = 'col-sm-2 col-form-label'>Bpublication id</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "bpublication_id",
                "id" => "bpublication_id",
                "class" => "form-control",
                "title" => "",
                "required" => "",
            );
            $bpublication_id = (isset($data['bpublication_id'])) ? $data['bpublication_id'] : '';
            echo form_error("bpublication_id");
            echo form_dropdown($attribute, $bpublication_id_list, $bpublication_id);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'bauthor_id' class = 'col-sm-2 col-form-label'>Bauthor id</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "bauthor_id",
                "id" => "bauthor_id",
                "class" => "form-control",
                "title" => "",
                "required" => "",
            );
            $bauthor_id = (isset($data['bauthor_id'])) ? $data['bauthor_id'] : '';
            echo form_error("bauthor_id");
            echo form_dropdown($attribute, $bauthor_id_list, $bauthor_id);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'blocation_id' class = 'col-sm-2 col-form-label'>Blocation id</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "blocation_id",
                "id" => "blocation_id",
                "class" => "form-control",
                "title" => "",
                "required" => "",
            );
            $blocation_id = (isset($data['blocation_id'])) ? $data['blocation_id'] : '';
            echo form_error("blocation_id");
            echo form_dropdown($attribute, $blocation_id_list, $blocation_id);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'page' class = 'col-sm-2 col-form-label'>Page</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "page",
                "id" => "page",
                "class" => "form-control",
                "title" => "",
                "required" => "",
                "type" => "number",
                "value" => (isset($data["page"])) ? $data["page"] : ""
            );
            echo form_error("page");
            echo form_input($attribute);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'mrp' class = 'col-sm-2 col-form-label'>Mrp</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "mrp",
                "id" => "mrp",
                "class" => "form-control",
                "title" => "",
                "required" => "",
                "type" => "text",
                "value" => (isset($data["mrp"])) ? $data["mrp"] : ""
            );
            echo form_error("mrp");
            echo form_input($attribute);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'isbn_no' class = 'col-sm-2 col-form-label'>Isbn no</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "isbn_no",
                "id" => "isbn_no",
                "class" => "form-control",
                "title" => "",
                "required" => "",
                "type" => "text",
                "value" => (isset($data["isbn_no"])) ? $data["isbn_no"] : ""
            );
            echo form_error("isbn_no");
            echo form_input($attribute);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'edition' class = 'col-sm-2 col-form-label'>Edition</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "edition",
                "id" => "edition",
                "class" => "form-control",
                "title" => "",
                "required" => "",
                "type" => "text",
                "value" => (isset($data["edition"])) ? $data["edition"] : ""
            );
            echo form_error("edition");
            echo form_input($attribute);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'bar_code' class = 'col-sm-2 col-form-label'>Bar code</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "bar_code",
                "id" => "bar_code",
                "class" => "form-control",
                "title" => "",
                "required" => "",
                "type" => "text",
                "value" => (isset($data["bar_code"])) ? $data["bar_code"] : ""
            );
            echo form_error("bar_code");
            echo form_input($attribute);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'qr_code' class = 'col-sm-2 col-form-label'>Qr code</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "qr_code",
                "id" => "qr_code",
                "class" => "form-control",
                "title" => "",
                "required" => "",
                "type" => "text",
                "value" => (isset($data["qr_code"])) ? $data["qr_code"] : ""
            );
            echo form_error("qr_code");
            echo form_input($attribute);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'midified_by' class = 'col-sm-2 col-form-label'>Midified by</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "midified_by",
                "id" => "midified_by",
                "class" => "form-control",
                "title" => "",
                "required" => "",
                "type" => "number",
                "value" => (isset($data["midified_by"])) ? $data["midified_by"] : ""
            );
            echo form_error("midified_by");
            echo form_input($attribute);
            ?>
        </div>
    </div>

    <div class = 'form-group row'>
        <div class = 'col-sm-1'>
            <a class="text-right btn btn-default" href="<?= APP_BASE ?>library/book_ledgers/index">
                <span class="glyphicon glyphicon-th-list"></span> Cancel
            </a>
        </div>
        <div class = 'col-sm-1'>
            <input type="submit" id="submit" value="Update" class="btn btn-primary">
        </div>
    </div>
    <?= form_close() ?>
</div>