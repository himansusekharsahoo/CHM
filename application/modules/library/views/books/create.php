<div class="col-sm-6">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Book information</h3>
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
                        "placeholder" => "Book name",
                        "value" => (isset($data["name"])) ? $data["name"] : ""
                    );
                    echo form_error("name");
                    echo form_input($attribute);
                    ?>
                </div>
            </div>
            <div class = 'form-group row'>
                <label for = 'code' class = 'col-sm-3 col-form-label'>Book code</label>
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
                <div class = 'col-sm-2 col-sm-offset-3'>
                    <a class="text-right btn btn-default" href="<?= APP_BASE ?>library/books/index">
                        <span class="glyphicon glyphicon-th-list"></span> Cancel
                    </a>
                </div>
                <div class = 'col-sm-3'>
                    <input type="submit" id="submit" value="Save" class="btn btn-primary">
                </div>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>