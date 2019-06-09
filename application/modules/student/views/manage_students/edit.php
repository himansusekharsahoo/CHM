<div class="col-sm-10">
    <div class="row">
        <?php
        $form_attribute = array(
            "name" => "student_users",
            "id" => "student_users",
            "method" => "POST",
            "autocomplete" => "off"
        );
        $form_action = base_url('edit-student-profile-save');
        echo form_open($form_action, $form_attribute);

        $attribute = array(
            "name" => "user_id",
            "id" => "user_id",
            "class" => "form-control",
            "title" => "",
            "required" => "",
            "type" => "hidden",
            "value" => (isset($data["user_id"])) ? c_encode($data["user_id"]) : ""
        );
        echo form_input($attribute);
        echo form_error("user_id");
        ?>
        <div class="col-sm-6">
            <div class = 'form-group row'>
                <label for = 'first_name' class = 'col-sm-5 col-form-label ele_required'>First name</label>
                <div class = 'col-sm-7'>
                    <?php
                    $attribute = array(
                        "name" => "first_name",
                        "id" => "first_name",
                        "class" => "form-control",
                        "type" => "text",
                        "value" => (isset($data["first_name"])) ? $data["first_name"] : ""
                    );
                    echo form_input($attribute);
                    echo form_error("first_name");
                    ?>
                </div>
            </div>
            <div class = 'form-group row'>
                <label for = 'last_name' class = 'col-sm-5 col-form-label ele_required'>Last name</label>
                <div class = 'col-sm-7'>
                    <?php
                    $attribute = array(
                        "name" => "last_name",
                        "id" => "last_name",
                        "class" => "form-control",
                        "type" => "text",
                        "value" => (isset($data["last_name"])) ? $data["last_name"] : ""
                    );
                    echo form_input($attribute);
                    echo form_error("last_name");
                    ?>
                </div>
            </div>            
            <div class = 'form-group row'>
                <label for = 'login_id' class = 'col-sm-5 col-form-label ele_required'>Registration id</label>
                <div class = 'col-sm-7'>
                    <?php
                    $attribute = array(
                        "name" => "login_id",
                        "id" => "login_id",
                        "class" => "form-control",
                        "type" => "text",
                        "value" => (isset($data["login_id"])) ? $data["login_id"] : ""
                    );
                    echo form_input($attribute);
                    echo form_error("login_id");
                    ?>
                </div>
            </div>
        </div>

        <div class="col-sm-6">
            <div class = 'form-group row'>
                <label for = 'mobile' class = 'col-sm-5 col-form-label ele_required'>Mobile</label>
                <div class = 'col-sm-7'>
                    <?php
                    $attribute = array(
                        "name" => "mobile",
                        "id" => "mobile",
                        "class" => "form-control",
                        "type" => "text",
                        "value" => (isset($data["mobile"])) ? $data["mobile"] : ""
                    );
                    echo form_input($attribute);
                    echo form_error("mobile");
                    ?>
                </div>
            </div>
            <div class = 'form-group row'>
                <label for = 'email' class = 'col-sm-5 col-form-label ele_required'>Email</label>
                <div class = 'col-sm-7'>
                    <?php
                    $attribute = array(
                        "name" => "email",
                        "id" => "email",
                        "class" => "form-control",
                        "type" => "text",
                        "value" => (isset($data["email"])) ? $data["email"] : ""
                    );
                    echo form_input($attribute);
                    echo form_error("email");
                    ?>
                </div>
            </div>
            <div class = 'form-group row'>
                <label for = '' class = 'col-sm-5 col-form-label'></label>
                <div class = 'col-sm-7'>
                    <a class="btn btn-block btn-social btn-google" href="#" id="change_my_pass">
                        <i class="fa fa-key fa-sm"></i> Reset Student Password
                    </a>
                </div>
            </div>

        </div>
    </div>
    <div class="row-fluid">
        <div class = 'form-group row'>  
            <div class="col-sm-12">
                <a class="text-right btn btn-default" href="<?= base_url('student-list') ?>">
                    <span class="glyphicon glyphicon-th-list"></span> Cancel
                </a>
                <input type="submit" id="submit" value="Save" class="btn btn-primary">
            </div>
        </div>
    </div>
    <?php echo form_close() ?>
</div>

<div class="modal fade" id="change_my_pass_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <?php
            $form_attribute = array(
                "name" => "change_student_pass_form",
                "id" => "change_student_pass_form",
                "method" => "POST"
            );
            $form_action = base_url('reset-student-password');
            echo form_open($form_action, $form_attribute);
            ?>
            <div class="modal-header">
                <button aria-label="Close" data-dismiss="modal" class="close" type="button">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Password details</h4>
            </div>
            <div class="modal-body">                                
                <div class = 'form-group row'>
                    <label for = 'npassword' class = 'col-sm-4 col-form-label ele_required'>New password</label>
                    <div class = 'col-sm-5'>
                        <?php
                        $attribute = array(
                            "name" => "npassword",
                            "id" => "npassword",
                            "class" => "form-control inputPassword",
                            "title" => "",
                            "required" => "",
                            "type" => "password",
                            "value" => ""
                        );
                        echo form_error("npassword");
                        echo form_input($attribute);
                        ?>
                        <span toggle="#npassword" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                        <span class="form-control default complexity"></span>
                    </div>
                </div>
                <div class = 'form-group row'>
                    <label for = 'cpassword' class = 'col-sm-4 col-form-label ele_required'>Confirm password</label>
                    <div class = 'col-sm-5'>
                        <?php
                        $attribute = array(
                            "name" => "cpassword",
                            "id" => "cpassword",
                            "class" => "form-control",
                            "title" => "",
                            "required" => "",
                            "type" => "password",
                            "value" => ""
                        );
                        echo form_error("cpassword");
                        echo form_input($attribute);
                        ?>
                        <span toggle="#cpassword" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button class="btn btn-success" id="update_password">Save</button>
                <button data-dismiss="modal" class="btn btn-danger" id="default_modal_box_btn_cancel" type="button">Cancel</button>
            </div>
            <?= form_close() ?>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('#student_users').validate({
            rules: {
                first_name: {
                    required: true,
                    letters_space_only: true
                },
                last_name: {
                    required: true,
                    letters_space_only: true
                },
                login_id: {
                    required: true,
                    letter_number_nospace: true
                },
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                    alphanumeric: true
                },
                re_password: {
                    required: true,
                    alphanumeric: true,
                    equalTo: "#password"
                },
                mobile: {
                    required: true,
                    'mobile_no': true
                }
            },
            messages: {
                first_name: {
                    required: "Please enter your first name.",
                    letters_space_only: "Only alphabates are allowed."
                },
                last_name: {
                    required: "Please enter your last name.",
                    letters_space_only: "Only alphabates are allowed."
                },
                login_id: {
                    required: "Please enter registration id."
                },
                email: {
                    required: "Please enter email id.",
                    email: "Please enter valid email id."
                },
                password: {
                    required: "Please enter password.",
                    alphanumeric: "Please enter alphanumeric value."
                },
                re_password: {
                    required: "Please re-enter password.",
                    alphanumeric: "Please enter alphanumeric value.",
                    equalTo: "Your password and confirmation password do not match."
                },
                mobile: {
                    required: "Please enter your 10 digit mobile number.",
                }
            },
            errorElement: 'div',
            errorPlacement: function (error, element) {
                error.insertAfter(element.closest("div").find("span:last"));
            },
            submitHandler: function (form) {
                if ($(form).valid())
                    form.submit();
                return false;
            }
        });

        $(document).on('click', '#change_my_pass', function (e) {
            e.preventDefault();
            $('.complexity').css('display', 'none');
            $('#password').val('');
            $('#npassword').val('');
            $('#cpassword').val('');

            $('#loading').css('display', 'block');
            $('#change_my_pass_modal').modal({backdrop: 'static', keyboard: false});
        });

        $('#change_student_pass_form').validate({
            rules: {
                npassword: "required",
                cpassword: {
                    equalTo: '#npassword'
                }
            },
            messages: {
                npassword: 'New password is required',
                cpassword: {
                    equalTo: 'New password and Confirm password does not match'
                }
            },
            errorElement: 'div',
            errorPlacement: function (error, element) {
                error.insertAfter(element.closest("div").find("span:last"));
            },
            submitHandler: function (form) {
                if ($(form).valid())
                    form.submit();
                return false; // prevent normal form posting
            }
        });

        $(document).on('click', '#update_password', function (e) {
            $('#loading').css('display', 'block');
            if ($('#change_student_pass_form').valid()) {
                const student_pass_update = new Promise(function (resolve, reject) {
                    var form_data = {
                        "uid": "<?= c_encode($data["user_id"]) ?>",
                        "npassword": $('#npassword').val()
                    };
                    $('#loading').css('display', 'block');
                    $.ajax({
                        url: "<?= base_url('reset-student-password') ?>",
                        type: 'POST',
                        dataType: 'json',
                        data: form_data,
                        success: function (result) {
                            resolve(result);
                        },
                        error: function (result) {
                            reject(result);
                        }
                    });
                });
                student_pass_update.then(function (resolve) {
                    $('#loading').css('display', 'none');
                    $('#change_my_pass_modal').modal('hide');
                    show_message(resolve);
                }, function (reject) {
                    $('#loading').css('display', 'none');
                    show_message(reject);
                });
            }
            return false;
        });

        function show_message(reject) {
            var errMsg = {
                'type': 'default',
                title: (typeof reject.title != 'undefined' && reject.title != '') ? reject.title : 'My Profile',
                message: (reject.message != '') ? reject.message : 'There are some error, please try again!'
            }
            myApp.modal.alert(errMsg);
        }
    });
</script>