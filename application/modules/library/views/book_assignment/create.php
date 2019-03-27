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
        height: 35px;
        padding-top: 1.2%;
    }
</style>
<div class="row no_pad">
    <div class="col-md-6">
        <div class="box box-default">
            <div class="box-header with-border">
                <i class="fa fa-search"></i>
                <h3 class="box-title">Book</h3>
            </div>
            <div class="box-body">
                <div class = 'col-sm-12'>
                    <input type="text" name="" id="" class="form-control" placeholder="Enter Book title, author Or ISBN"/>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="box box-default">
            <div class="box-header with-border">
                <i class="fa fa-search"></i>
                <h3 class="box-title">User details</h3>
            </div>
            <div class="box-body">
                <div class='form-group col-sm-12' style="padding-top: 0%;">
                    <div class='col-sm-12'>                                       
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
                    <div class='col-sm-12' style="margin-top: 4%;">   
                        <var id="result-container" class="result-container"></var>
                        <div class="typeahead__container">
                            <div class="typeahead__field">
                                <div class="typeahead__query">
                                    <input class="form-control" name="search_txt" id="search_txt" type="search" placeholder="Search by Email/Employee id" autocomplete="off">
                                    <small class="help-block">Note:Search by entering text / Scan barcode</small>
                                </div>                                                    
                            </div>
                        </div>
                    </div>
                </div>
                <div id='user_details_container' class="row"></div>
            </div>
        </div>
    </div>
</div>

<div class="box box-default color-palette-box">
    <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-search"></i> Search</h3>
    </div>
    <div class="box-body">
        <div class="col-sm-12">
            <?php
            $form_attribute = array(
                "name" => "book_assigns",
                "id" => "book_assigns",
                "method" => "POST"
            );
            $form_action = base_url("create-book-assign");
            echo form_open($form_action, $form_attribute);
            ?>
            <div class="form-group row">
                <div class="col-sm-12 no_pad panel">
                    <div class="panel-body">
                        <div class="row">
                            <div class='form-group col-sm-5'>
                                <label for = 'mobile' class = 'col-sm-5 col-form-label ele_required'>User type: </label>
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
                            <div class = 'form-group col-sm-7   '>
                                <label for = 'mobile' class = 'col-sm-3 ele_required'>Search user</label>
                                <div class = 'col-sm-6' style="padding-left: 4%;">   
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
            </div>
            <div id='user_details_container' class="row"></div>
            <div class = 'form-group row-fluid'>
                <a class="text-right btn btn-default" href="<?= base_url('library-users') ?>">
                    <span class="glyphicon glyphicon-th-list"></span> Back
                </a>
            </div>
            <div class="row">
                <div class="panel">
                    <div class="panel-heading"></div>
                    <div class="panel-body">
                        <label for='bledger_id' class='col-sm-2 col-form-label ele_required'>Search Book:</label>
                        <div class = 'col-sm-5 pull-left'>
                            <input type="text" name="" id="" class="form-control" placeholder="Enter Book title, author Or ISBN"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class = 'form-group row'>
                <label for='bledger_id' class = 'col-sm-2 col-form-label ele_required'>Book:</label>
                <div class = 'col-sm-3'>
                    <?php
                    $attribute = array(
                        "name" => "bledger_id",
                        "id" => "bledger_id",
                        "class" => "form-control chosen",
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
                    echo form_dropdown($attribute, $member_id_list, $member_id);
                    ?>
                </div>
                <label for = 'issue_date' class = 'col-sm-2 col-form-label ele_required'>Issue date</label>
                <div class = 'col-sm-3'>
                    <div class="input-group date">                
                        <input type="text" class="form-control pull-right" id="issue_date" disabled="disabled" name="issue_date" value="<?php echo date('Y-m-d') ?>">
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
                    <a class="text-right btn btn-default" id="print_library_cardsdsd" href="#">
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
                <input type="hidden" id="member_encode_id" value="" />
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
    </div>
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
                bledger_id: {
                    required: true,
                    remote: {
                        url: '<?= APP_BASE ?>isbn-status',
                        type: 'post',
                        data: {
                            user_id: function(){
                                return $('#book_assigns :input[name="bledger_id"]').val();
                            }
                        }
                    }
                },
                user_type: "required",
                member_id: "required",
                issue_date: "required"
            },
            messages: {
                bledger_id: { required: 'Ledger id is required', remote: jQuery.validator.format('This book is assigned to other user!')},
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
        
        $('#member_id').change(function(){
            var data = {'member_id':$(this).val()};
            $.ajax({
                url: '<?= APP_BASE ?>encode-id',
                method: 'POST',
                data: data,
                success: function (result) {   
                    if(result != ''){
                        $('#member_encode_id').val(result);
                    }
                }
            });
        });
        
        $('#user_details_container').on('click','#print_library_card',function(e){
            e.preventDefault(e);
            var card_no = $(this).data('id');
            if(card_no != ''){
                var url = '<?= APP_BASE ?>print-library-card/'+card_no;
                window.open(url, '_blank');
            } else {
                alert('Select Card Number to print');
            }
        });  
        
        function fetch_user_data(user_id) {
            //console.log('user_id',user_id);
            const user_promise = new Promise(function (resolve, reject) {
                var form_data = {
                    user_id: user_id
                };
                $.ajax({
                    url: "<?= base_url('show-user-data') ?>",
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
        //typehead
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
    });
</script>