<?php ?>
<style>
    .rbtn span.glyphicon {    			
        opacity: 0;				
    }
    .rbtn.active span.glyphicon {				
        opacity: 1;				
    }
    #search_txt{
        font-size: 14px !important;
    }
    .typeahead__hint{
        font-size: 14px !important;
    }
    .typeahead__result {
        font-size: 14px;
        color: #000;    
    }
    .box-border{
        box-shadow: 0 1px 1px 1px rgba(0,0,0,0.1);        
    }
    .nav_search_user_li{
        margin-top: 3px;
        margin-bottom: 3px;
        height: 25px;
    }    
</style>
<div class="row">
    <div class="col-sm-12">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#new_user_tab" data-toggle="tab" aria-expanded="true">New user</a></li>
                <li class=""><a href="#existing_user_tab" data-toggle="tab" aria-expanded="false">Existing user</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="new_user_tab">
                    <?php
                    $form_attribute = array(
                        "name" => "library_new_users",
                        "id" => "library_new_users",
                        "method" => "POST",
                        "auto-complete" => "off"
                    );
                    $form_action = base_url("create-library-user");
                    echo form_open($form_action, $form_attribute);
                    ?>
                    <div class="row">
                        <div class="col-sm-6">                            
                            <div class = 'form-group row'>
                                <label for = 'first_name' class = 'col-sm-5 col-form-label ele_required'>First name</label>
                                <div class = 'col-sm-7'>
                                    <?php
                                    $attribute = array(
                                        "name" => "tab_user_type",
                                        "class" => "form-control",
                                        "type" => "hidden",
                                        "value" => "new_user"
                                    );
                                    echo form_input($attribute);

                                    $attribute = array(
                                        "name" => "first_name",
                                        "id" => "first_name",
                                        "class" => "form-control",
                                        "type" => "text",
                                        "value" => (isset($data["first_name"])) ? $data["first_name"] : ""
                                    );
                                    echo form_error("first_name");
                                    echo form_input($attribute);
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
                                    echo form_error("last_name");
                                    echo form_input($attribute);
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
                                    echo form_error("email");
                                    echo form_input($attribute);
                                    ?>
                                </div>
                            </div>                            
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
                                    echo form_error("mobile");
                                    echo form_input($attribute);
                                    ?>
                                </div>
                            </div>                            
                        </div>
                    </div>
                    <div class = 'form-group row'>
                        <div class = 'col-sm-1'>
                            <a class="text-right btn btn-default" href="<?= base_url('library-users') ?>">
                                <span class="glyphicon glyphicon-th-list"></span> Cancel
                            </a>
                        </div>
                        <div class = 'col-sm-1'>
                            <input type="submit" id="submit" value="Save" class="btn btn-primary">
                        </div>
                    </div>
                    <?= form_close() ?>
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="existing_user_tab">
                    <?php
                    $form_attribute = array(
                        "name" => "library_existing_users",
                        "id" => "library_existing_users",
                        "method" => "POST"
                    );
                    $form_action = base_url("create-library-member");
                    echo form_open($form_action, $form_attribute);
                    ?>
                    <div class="form-group row">
                        <div class="col-sm-12 no_pad">
                            <div class="row">
                                <div class = 'form-group col-sm-5'>
                                    <label for = 'mobile' class = 'col-sm-5 col-form-label ele_required'>Select User type</label>
                                    <div class = 'col-sm-7'>                                       
                                        <div class="btn-group" data-toggle="buttons">

                                            <label class="rbtn btn btn-success active">
                                                <input type="radio" class="user_type_radio" name="user_type_radio" id="employee_radio" value="employee" autocomplete="off" chacked>
                                                <span class="glyphicon glyphicon-ok"></span> Employee
                                            </label>

                                            <label class="rbtn btn btn-primary">
                                                <input type="radio" class="user_type_radio" name="user_type_radio" id="student_radio" value="student" autocomplete="off">
                                                <span class="glyphicon glyphicon-ok"></span> Student
                                            </label>                                       

                                        </div>
                                    </div>
                                </div>                            
                                <div class = 'form-group col-sm-7'>
                                    <label for = 'mobile' class = 'col-sm-3 ele_required'>Search user</label>
                                    <div class = 'col-sm-9'>   
                                        <var id="result-container" class="result-container"></var>
                                        <div class="typeahead__container">
                                            <div class="typeahead__field">
                                                <div class="typeahead__query">
                                                    <input class="form-control" name="search_txt" id="search_txt" type="search" placeholder="Search by Email/Employee id" autocomplete="off">
                                                </div>                                                    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>                    
                    </div>
                    <div id = 'user_details_container' class="row"></div>
                    <div class = 'form-group row-fluid'>
                        <a class="text-right btn btn-default" href="<?= base_url('library-users') ?>">
                            <span class="glyphicon glyphicon-th-list"></span> Back
                        </a>
                    </div>
                </div>
                <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function ($) {
        
        $('#library_new_users').validate({
            rules: {
                first_name: {
                    required: true,
                    letters_space_only: true
                },
                last_name: {
                    required: true,
                    letters_space_only: true
                },
                email: {
                    required: true,
                    email: true
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
                email: {
                    required: "Please enter email id.",
                    email: "Please enter valid email id."
                },
                mobile: {
                    required: "Please enter your 10 digit mobile number.",
                }
            },
            submitHandler: function (form) {
                if ($(form).valid())
                    form.submit();
                return false;
            }
        });

        $('#library_members').on('click', '#submit', function (e) {
            if ($('#library_members').valid()) {
                $('#library_members').submit();
            }
            e.preventDefault();
        });
        var user_type_radio = 'employee';
        $('.user_type_radio').on('change', function () {
            //console.log('checked', $("input[name=user_type_radio]").filter(":checked").val());
            var checked_val = $("input[name=user_type_radio]").filter(":checked").val();
            if (checked_val == 'student') {
                $('#search_txt').attr('placeholder', 'Search by Email/Registration id');
                user_type_radio = 'student';
            } else {
                $('#search_txt').attr('placeholder', 'Search by Email/Employee id');
                user_type_radio = 'employee';
            }
        });
        var fetched_user_id = '';
        function _get_radio_value() {
            return user_type_radio;
        }
        $.typeahead({
            input: '#search_txt',
            minLength: 1,
            maxItem: 20,
            order: "asc",
            hint: true,
            dynamic: true,
            emptyTemplate: "No result found!",
            source: {
                user: {
                    display: "name",
                    ajax: {
                        method: 'post',
                        url: base_url + 'search-lib-user',
                        data: {
                            search_text: "{{query}}",
                            user_type: _get_radio_value
                        },
                        path: "data"
                    }
                }
            },
            callback: {
                onNavigateAfter: function (node, lis, a, item, query, event) {
                    if (~[38, 40].indexOf(event.keyCode)) {
                        var resultList = node.closest("form").find("ul.typeahead__list"),
                                activeLi = lis.filter("li.active"),
                                offsetTop = activeLi[0] && activeLi[0].offsetTop - (resultList.height() / 2) || 0;

                        resultList.scrollTop(offsetTop);
                    }

                },
                onClickAfter: function (node, a, item, event) {

                    event.preventDefault();
                    $('#result-container').text('');
                    fetched_user_id = item.id;
                    fetch_user_data(item.id);
                    //console.log(node, a, item, event);
                    //console.log('item', item);
                },
                onResult: function (node, query, result, resultCount) {
                    if (query === "")
                        return;
                    var text = "";
                    if (result.length > 0 && result.length < resultCount) {
                        text = "Showing <strong>" + result.length + "</strong> of <strong>" + resultCount + '</strong> elements matching "' + query + '"';
                    } else if (result.length > 0) {
                        text = 'Showing <strong>' + result.length + '</strong> elements matching "' + query + '"';
                    } else {
                        text = 'No results matching "' + query + '"';
                    }
                    $('#result-container').html(text);

                }
            }
        });

        $(document).on('click', '#cancel_old_user', function () {
            $('#user_details_container').html('');
            fetched_user_id = '';
        });
        $(document).on('click', '#create_lib_member', function () {
            create_lib_user(fetched_user_id);
            $('#user_details_container').html('');
        });
    });

    function fetch_user_data(user_id) {
        //console.log('user_id',user_id);
        const user_promise = new Promise(function (resolve, reject) {
            var form_data = {
                user_id: user_id
            };
            $.ajax({
                url: "<?= base_url('show-library-user-data') ?>",
                type: 'POST',
                dataType: 'html',
                data: form_data,
                success: function (result) {
                    resolve(result);
                },
                error: function (result) {
                    reject(result);
                }
            });
        });
        user_promise.then(function (resolve) {
            $('#user_details_container').html(resolve);
        }, function (reject) {
            show_message(reject);
        });
    }

    function create_lib_user(user_id) {
        //console.log('user_id',user_id);
        const create_user_promise = new Promise(function (resolve, reject) {
            var form_data = {
                user_id: user_id,
                tab_user_type: 'old_user'
            };
            $.ajax({
                url: "<?= base_url('create-library-user') ?>",
                type: 'POST',
                dataType: 'html',
                data: form_data,
                success: function (result) {
                    resolve(result);
                },
                error: function (result) {
                    reject(result);
                }
            });
        }
        );
        create_user_promise.then(function (resolve) {
            resolve = JSON.parse(resolve);
            show_message(resolve);
        }, function (reject) {
            show_message(reject);
        });
    }
    function show_message(reject) {
        console.log('show message', reject);
        var errMsg = {
            'type': 'default',
            title: (typeof reject.title != 'undefined' && reject.title != '') ? reject.title : 'Manage Library User',
            message: (reject.message != '') ? reject.message : 'There are some error, please try again!'
        }
        myApp.modal.alert(errMsg);
    }
</script>