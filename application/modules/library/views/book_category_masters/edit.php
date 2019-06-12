<div class="col-sm-12">
    <?php
    $form_attribute = array(
        "name" => "book_category_masters",
        "id" => "book_category_masters",
        "method" => "POST"
    );
    $form_action = base_url('edit-book-category-save');
    echo form_open($form_action, $form_attribute);
    ?>
    <?php
    $attribute = array(
        "name" => "bcategory_id",
        "id" => "bcategory_id",
        "class" => "form-control",
        "title" => "",
        "required" => "",
        "type" => "hidden",
        "value" => (isset($data["bcategory_id"])) ? $data["bcategory_id"] : ""
    );
    echo form_error("bcategory_id");
    echo form_input($attribute);
    ?><div class = 'form-group row'>
        <label for = 'name' class = 'col-sm-2 col-form-label'>Name</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "name",
                "id" => "name",
                "class" => "form-control",
                "title" => "",
                "required" => "",
                "type" => "text",
                "value" => (isset($data["name"])) ? $data["name"] : ""
            );
            echo form_error("name");
            echo form_input($attribute);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <div class = 'col-sm-1'>
            <a class="text-right btn btn-default" href="<?= base_url('manage-book-category')?>">
                <span class="glyphicon glyphicon-th-list"></span> Cancel
            </a>
        </div>
        <div class = 'col-sm-1'>
            <input type="submit" id="submit" value="Update" class="btn btn-primary">
        </div>
    </div>
    <?= form_close() ?>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('#book_category_masters').validate({
            rules: {
                name: {
                    required: true,
                    letter_number_only: true
                }
            },
            messages: {
                name:{
                    required:'Please enter book category name'                    
                }
            },
            submitHandler: function (form) {
                if ($(form).valid())
                    form.submit();
                return false; // prevent normal form posting
            }
        });
    });
</script>