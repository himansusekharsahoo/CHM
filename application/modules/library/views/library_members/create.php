<div class="col-sm-12">
    <?php
    $form_attribute = array(
        "name" => "library_members",
        "id" => "library_members",
        "method" => "POST"
    );
    $form_action = base_url("create-library-member");
    echo form_open($form_action, $form_attribute);
    ?>
    <div class = 'form-group row'>
        <label for = 'user_role_id' class = 'col-sm-2 col-form-label ele_required'>User role id</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "user_role_id",
                "id" => "user_role_id",
                "class" => "form-control",
                "required" => "",
                "value" => (isset($data["user_role_id"])) ? $data["user_role_id"] : ""
            );
            $user_type = (isset($data['user_role_id'])) ? $data['user_role_id'] : '';
            echo form_error("user_role_id");
            echo form_dropdown($attribute, $user_type_list, $user_type);
            ?>
        </div>
    
        <label for = 'user_id' class = 'col-sm-2 col-form-label ele_required'>User email</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "user_id",
                "id" => "user_id",
                "class" => "form-control",
                "required" => "",
                "value" => (isset($data["user_id"])) ? $data["user_id"] : ""
            );
            $user_email = (isset($data['user_id'])) ? $data['user_id'] : '';
            echo form_error("user_id");
            echo form_dropdown($attribute, $user_list, $user_email);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'card_no' class = 'col-sm-2 col-form-label ele_required'>Card no</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "card_no",
                "id" => "card_no",
                "class" => "form-control",
                "title" => "",
                "required" => "",
                "type" => "text",
                "value" => (isset($data["card_no"])) ? $data["card_no"] : ""
            );
            echo form_error("card_no");
            echo form_input($attribute);
            ?>
        </div>
        <label for = 'date_issue' class = 'col-sm-2 col-form-label'>Date issue</label>
        <div class = 'col-sm-3'>
            <div class="input-group date">                
                <input type="text" class="form-control pull-right" id="date_issue" name="date_issue" value="<?= (isset($data["date_issue"])) ? $data["date_issue"] : set_value('date_issue') ?>">
                <div class="input-group-addon focus_date">
                    <i class="fa fa-calendar"></i>
                </div>
            </div>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'expiry_date' class = 'col-sm-2 col-form-label'>Expiry date</label>
        <div class = 'col-sm-3'>
            <div class="input-group date">                
                <input type="text" class="form-control pull-right" id="expiry_date" name="expiry_date" value="<?= (isset($data["expiry_date"])) ? $data["expiry_date"] : set_value('expiry_date') ?>">
                <div class="input-group-addon focus_date">
                    <i class="fa fa-calendar"></i>
                </div>
            </div>
        </div>
    </div>
    
    <div class = 'form-group row'>
        <div class = 'col-sm-1'>
            <a class="text-right btn btn-default" href="<?= APP_BASE ?>library-members">
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
        $('#date_issue').datepicker({
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
        $('#expiry_date').datepicker({
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
        
        
        $('#library_members').validate({
            rules: {
                user_role_id: "required",
                user_id: {
                    required:true,
                    remote: {
                        url: '<?= APP_BASE ?>unique-user',
                        type: 'post',
                        data: {
                            user_id: function(){
                                return $('#library_members :input[name="user_id"]').val();
                            }
                        }
                    }
                },
                card_no: {required:true,
                            remote: {
                            url: '<?= APP_BASE ?>unique-card-number',
                            type: "post",
                            data:{
                                    card_no: function()
                                    {
                                        return $('#library_members :input[name="card_no"]').val();
                                    }
                                }
                            } 
                        },
                date_issue: "required"
            },
            messages: {
                user_role_id: 'User Type is required',
                user_id: {required: 'User Email is required', remote: jQuery.validator.format('This mail id exists in Library records')},
                card_no: {required: 'Card Number is required', remote: jQuery.validator.format('{0} Card number exists')},
                date_issue: 'Issue date is required'
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

        $('#library_members').on('click', '#submit', function (e) {

            if ($('#library_members').valid()) {
                $('#library_members').submit();
            }
            e.preventDefault();
        });
    });
</script>