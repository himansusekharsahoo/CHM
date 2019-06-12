<div class="col-sm-12">
    <div class="box">
        <?php
        $form_attribute = array(
            "name" => "book_category_masters",
            "id" => "book_category_masters",
            "method" => "POST"
        );
        $form_action = base_url('create-book-category');
        echo form_open($form_action, $form_attribute);
        ?>
        <div class="box-body">
            <div class = 'form-group row'>
                <label for = 'name' class = 'col-sm-2 col-form-label ele_required'>Name</label>
                <div class = 'col-sm-3'>
                    <?php
                    $attribute = array(
                        "name" => "name",
                        "id" => "name",
                        "class" => "form-control ",
                        "type" => "text",
                        "value" => (isset($data["name"])) ? $data["name"] : ""
                    );
                    echo form_error("name");
                    echo form_input($attribute);
                    ?>
                </div>
            </div>

        </div>
        <div class="box-footer">
            <div class = 'pull-right'>
                <a class="text-right btn btn-default" href="<?= base_url('manage-book-category') ?>">
                    <i class="fa fa-list"></i> Cancel
                </a>
                <button type="submit" id="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
            </div>
        </div>
        <?= form_close() ?>
    </div>
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
                name: {
                    required: 'Please enter book category name'
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