<div class="col-sm-12">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Add new book</h3>
        </div>
        <div class="box-body">
            <?php
            $form_attribute = array(
                "name" => "books",
                "id" => "books",
                "method" => "POST"
            );
            $form_action = "/library/books/create";
            echo form_open($form_action, $form_attribute);
            ?>
            <div class = 'form-group row'>
                <label for = 'name' class = 'col-sm-3 col-form-label'>Book name</label>
                <div class = 'col-sm-4'>
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
                        "placeholder" => "Book name",
                        "value" => (isset($data["name"])) ? $data["name"] : ""
                    );
                    echo form_error("name");
                    echo form_textarea($attribute);
                    ?>
                </div>
            </div>
            <div class = 'form-group row'>
                <label for = 'code' class = 'col-sm-3 col-form-label'>Product Code</label>
                <div class = 'col-sm-4'>
                    <?php
                    $attribute = array(
                        "name" => "code",
                        "id" => "code",
                        "class" => "form-control",
                        "title" => "",
                        "required" => "",
                        "type" => "text",
                        "placeholder" => "Book Code",
                        "value" => (isset($data["code"])) ? $data["code"] : ""
                    );
                    echo form_error("code");
                    echo form_input($attribute);
                    ?>
                </div>
            </div>
            <div class = 'form-group row'>
                <label for = 'language' class = 'col-sm-3 col-form-label'>Language</label>
                <div class = 'col-sm-4'>
                    <?php
                    $attribute = array(
                        "name" => "language",
                        "id" => "language",
                        "class" => "form-control",
                        "title" => "",
                        "required" => "",
                        "type" => "text",
                        "placeholder" => "Language",
                        "autocomplete"=> "off",
                        "value" => (isset($data["code"])) ? $data["code"] : ""
                    );
                    echo form_error("code");
                    echo form_input($attribute);
                    ?>
                </div>
            </div>
            <div class="box-footer">
                <div class="pull-right">
                    <a class="text-right btn btn-default" href="<?= APP_BASE ?>library/books/index">
                        <span class="glyphicon glyphicon-th-list"></span> Cancel
                    </a>
                    <button type="submit" id="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                </div>
            </div>
        </div>
        <?= form_close() ?>
    </div>
</div>
</div>