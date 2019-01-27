<div class="col-sm-12">
    <?php
    $form_attribute = array(
        "name" => "book_assigns",
        "id" => "book_assigns",
        "method" => "POST"
    );
    $form_action = "create-book-assign";
    echo form_open($form_action, $form_attribute);
    ?>
    <div class = 'form-group row'>
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
            );
            $member_id = (isset($data['member_id'])) ? $data['member_id'] : '';
            echo form_error("member_id");
            echo form_dropdown($attribute, $member_id_list, $member_id);
            ?>
            Not a member in Library? <a href="#" id="add_member">Register</a>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'issue_date' class = 'col-sm-2 col-form-label'>Issue date</label>
        <div class = 'col-sm-3'>
            <div class="input-group date">                
                <input type="text" class="form-control pull-right" id="issue_date" name="issue_date" value="<?= (isset($data["issue_date"])) ? $data["issue_date"] : set_value('issue_date') ?>">
                <div class="input-group-addon focus_date">
                    <i class="fa fa-calendar"></i>
                </div>
            </div>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'due_date' class = 'col-sm-2 col-form-label'>Due date</label>
        <div class = 'col-sm-3'>
            <div class="input-group date">                
                <input type="text" class="form-control pull-right" id="due_date" name="due_date" value="<?= (isset($data["due_date"])) ? $data["due_date"] : set_value('due_date') ?>">
                <div class="input-group-addon focus_date">
                    <i class="fa fa-calendar"></i>
                </div>
            </div>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'return_date' class = 'col-sm-2 col-form-label'>Return date</label>
        <div class = 'col-sm-3'>
            <div class="input-group date">                
                <input type="text" class="form-control pull-right" id="return_date" name="return_date" value="<?= (isset($data["return_date"])) ? $data["return_date"] : set_value('return_date') ?>">
                <div class="input-group-addon focus_date">
                    <i class="fa fa-calendar"></i>
                </div>
            </div>
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
            );
            $value = (isset($data["remarks"])) ? $data["remarks"] : "";
            echo form_error("remarks");
            echo form_textarea($attribute, $value);
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
            );
            $user_type = (isset($data['user_type'])) ? $data['user_type'] : '';
            echo form_error("user_type");
            echo form_dropdown($attribute, $user_type_list, $user_type);
            ?>
        </div>
    </div>

    <div class = 'form-group row'>
        <div class = 'col-sm-1'>
            <a class="text-right btn btn-default" href="<?= APP_BASE ?>book-assigns">
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
    $(function ($) {
        $('#issue_date').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            clearBtn: true,
            endDate:'0d'
        }).on('change', function () {
            $(this).valid();  // triggers the validation test
            // '$(this)' refers to '$("#datepicker")'
        });
        $('.focus_date').on('click', function () {
            $(this).parent('div').find('input').focus();
        });
        $('#due_date').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            clearBtn: true,
            endDate:'0d'
        }).on('change', function () {
            $(this).valid();  // triggers the validation test
            // '$(this)' refers to '$("#datepicker")'
        });
        $('.focus_date').on('click', function () {
            $(this).parent('div').find('input').focus();
        });
        $('#return_date').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            clearBtn: true,
            endDate:'0d'
        }).on('change', function () {
            $(this).valid();  // triggers the validation test
            // '$(this)' refers to '$("#datepicker")'
        });
        $('.focus_date').on('click', function () {
            $(this).parent('div').find('input').focus();
        });
  
        $(document).on('click', '#add_member', function (e) {
            e.preventDefault();
            $('#exp_date').datepicker({
                format: 'd-m-yyyy',
                autoclose: true,
                clearBtn: true,
                endDate:'0d'
            }).on('change', function () {
                $(this).valid();  // triggers the validation test
                // '$(this)' refers to '$("#datepicker")'
            });
            $('.focus_date').on('click', function () {
                $(this).parent('div').find('input').focus();
            });
            var new_member_temp = '<div class="form-group row"><label for="user_name" class="col-sm-4 col-form-label">Name</label><div class="col-sm-6"><input type="text " name="user_name" value="" id="user_name" class="form-control" /></div></div>\n\
                                    <div class="form-group row"><label for="user_name" class="col-sm-4 col-form-label">Card number</label><div class="col-sm-6"><input type="text " name="cnumber" value="" id="cnumber" class="form-control" /></div></div>\n\
                                    <div class="form-group row"><label for="exp_date" class="col-sm-4 col-form-label">Expiry Date</label><div class="col-sm-6"><div class="input-group date"><input type="date" class="form-control pull-right" id="exp_date" name="exp_date" ></div></div></div>';
            
            BootstrapDialog.show({
                title: 'Enroll to Library',
                message: new_member_temp,
                buttons: [{
                        label: 'Cancel',
                        action: function (dialog) {
                            dialog.close();
                        }
                    }, {
                        label: 'Enroll',
                        action: function (dialog) {
                            var data = {
                                'user_id': $('#user_name').val(),
                                'card_no': $('#cnumber').val(),
                                'expiry_date': $('#exp_date').val()
                            };
                            $.ajax({
                                url: '<?= APP_BASE ?>add-library-member',
                                method: 'POST',
                                data: data,
                                success: function (result) {
                                    if (result == 1) {
                                        dialog.close();
                                        document.location.reload();
                                        row.hide();
                                        BootstrapDialog.alert('Enrolled successfully!');
                                    } else {
                                        dialog.close();
                                        BootstrapDialog.alert('Enrollment error,please contact site admin!');
                                    }
                                },
                                error: function (error) {
                                    dialog.close();
                                    BootstrapDialog.alert('Error:' + error);
                                }
                            });
                        }
                    }]
            });
        })
    });
</script>