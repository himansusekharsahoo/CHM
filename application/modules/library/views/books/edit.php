<div class="box">
    <?php
    $form_attribute = array(
        "name" => "books",
        "id" => "books",
        "method" => "POST"
    );
    $form_action = "/library/books/edit";
    echo form_open($form_action, $form_attribute);
    ?>
    <div class="box-header with-border"><h3 class="box-title">Edit book details:</h3></div>    
    <div class="box-body">
        <div class="col-sm-12">
            <?php
            $attribute = array(
                "name" => "book_id",
                "id" => "book_id",
                "class" => "form-control",
                "title" => "",
                "required" => "",
                "type" => "hidden",
                "value" => (isset($data["book_id"])) ? $data["book_id"] : ""
            );
            echo form_error("book_id");
            echo form_input($attribute);
            ?><div class = 'form-group row'>
                <label for = 'name' class = 'col-sm-2 col-form-label'>Book name</label>
                <div class = 'col-sm-3'>
                    <?php
                    $attribute = array(
                        "name" => "name",
                        "id" => "name",
                        "class" => "form-control",
                        "title" => "",
                        "required" => "",
                        "type" => "text",
                        "rows" => 5,
                        "cols" => 10,
                        "value" => (isset($data["name"])) ? $data["name"] : ""
                    );
                    echo form_error("name");
                    echo form_textarea($attribute);
                    ?>
                </div>
            </div>
            <div class = 'form-group row'>
                <label for = 'code' class = 'col-sm-2 col-form-label'>Product Code</label>
                <div class = 'col-sm-3'>
                    <?php
                    $attribute = array(
                        "name" => "code",
                        "id" => "code",
                        "class" => "form-control",
                        "title" => "",
                        "required" => "",
                        "type" => "text",
                        "autocomplete" => "off",
                        "value" => (isset($data["code"])) ? $data["code"] : ""
                    );
                    echo form_error("code");
                    echo form_input($attribute);
                    ?>
                </div>
            </div>
            <div class = 'form-group row'>
                <label for = 'language' class = 'col-sm-2 col-form-label'>Language</label>
                <div class = 'col-sm-3'>
                    <?php
                    $attribute = array(
                        "name" => "language",
                        "id" => "language",
                        "class" => "form-control",
                        "title" => "",
                        "required" => "",
                        "type" => "text",
                        "autocomplete" => "off",
                        "value" => (isset($data["language"])) ? $data["language"] : ""
                    );
                    echo form_error("language");
                    echo form_input($attribute);
                    ?>
                </div>
            </div>


        </div>
    </div>
    <div class="box-footer">
        <div class = 'pull-right'>
            <a class="text-right btn btn-default" href="<?= APP_BASE ?>library/books/index"><i class="fa fa-list"></i> Cancel</a>
            <button type="submit" id="submit" value="Update" class="btn btn-primary"><i class="fa fa-save"></i> Update</button>
        </div>
    </div>
    <?= form_close() ?>
</div>
