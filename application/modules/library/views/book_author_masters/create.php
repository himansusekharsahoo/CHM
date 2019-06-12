<div class="col-sm-12">
    <?php
    $form_attribute = array(
        "name" => "book_author_masters",
        "id" => "book_author_masters",
        "method" => "POST"
    );
    $form_action = base_url('create-book-author');
    echo form_open($form_action, $form_attribute);
    ?>
    <div class = 'form-group row'>
        <label for = 'author_name' class = 'col-sm-2 col-form-label'>Author name</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "author_name",
                "id" => "author_name",
                "class" => "form-control",                
                "type" => "text",
                "value" => (isset($data["author_name"])) ? $data["author_name"] : ""
            );
            echo form_error("author_name");
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
                "type" => "text",
                "value" => (isset($data["remarks"])) ? $data["remarks"] : ""
            );
            echo form_error("remarks");
            echo form_input($attribute);
            ?>
        </div>
    </div>

    <div class = 'form-group row'>
        <div class = 'col-sm-1'>
            <a class="text-right btn btn-default" href="<?= base_url('manage-book-author')?>">
                <span class="glyphicon glyphicon-th-list"></span> Cancel
            </a>
        </div>
        <div class = 'col-sm-1'>
            <input type="submit" id="submit" value="Save" class="btn btn-primary">
        </div>
    </div>
    <?= form_close() ?>
</div>
<script type="text/javascript">
    $(document).ready(function () {       
        
        $('#book_author_masters').validate({
            rules: {
                author_name: {
                    required: true,
                    letters_space_only: true
                }
            },
            messages: {
                author_name:{
                    required:'Please enter book author name'                    
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