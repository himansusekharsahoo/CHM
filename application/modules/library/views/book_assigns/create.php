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
        <label for = 'bledger_id' class = 'col-sm-2 col-form-label ele_required'>Bledger id</label>
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
        <label for = 'user_type' class = 'col-sm-2 col-form-label ele_required'>User type</label>
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
        <label for = 'member_id' class = 'col-sm-2 col-form-label ele_required'>Card number</label>
        <div class = 'col-sm-3 ui-widget'>
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
            echo form_dropdown($attribute,$member_id_list,$member_id);
            ?>
        </div>
        <label for = 'issue_date' class = 'col-sm-2 col-form-label ele_required'>Issue date</label>
        <div class = 'col-sm-3'>
            <div class="input-group date">                
                <input type="text" class="form-control pull-right" id="issue_date" name="issue_date" value="<?= (isset($data["issue_date"])) ? $data["issue_date"] : set_value('issue_date') ?>">
                <div class="input-group-addon focus_date">
                    <i class="fa fa-calendar"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-2"></div>
        <div class="col-sm-3"><a href="create-library-member" target="_blank" id="issue_library_card">Click here</a> to issue Library Card</div>
        <div class="col-sm-3">
            <a class="text-right btn btn-default" href="#">
                <span class="glyphicon glyphicon-print"></span> Print Library Card
            </a>
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
            clearBtn: true
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
  
        $('#book_assigns').validate({
            rules: {
                bledger_id: "required",
                user_type: "required",
                member_id: "required",
                issue_date: "required"
            },
            messages: {
                bledger_id: 'Ledger id is required',
                user_type: 'User Type is required',
                member_id: 'Card Number is required',
                issue_date: 'Issue date is required'
            },
            errorPlacement: function (error, element) {                
                if (element.attr("name") == "issue_date") {
                    error.appendTo(element.parent("div").next("span"));
                } else {
                    error.insertAfter(element);
                }
            },
            submitHandler: function (form) {
                if ($(form).valid())
                    form.submit();
                return false; // prevent normal form posting
            }
        });

        $('#book_assigns').on('click', '#submit', function (e) {

            if ($('#book_assigns').valid()) {
                $('#book_assigns').submit();
            }
            e.preventDefault();
        });
        
        
    });
</script>