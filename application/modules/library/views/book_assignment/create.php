<style type="text/css">
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
                    <var id="book-result-container" class="book-result-container"></var>
                    <div class="typeahead__container">
                        <div class="typeahead__field">
                            <div class="typeahead__query">
                                <input type="text" name="book_kw" id="book_kw" class="form-control" placeholder="Enter Book title, author Or ISBN" autocomplete="off"/>
                                <small class="help-block">Note:Search by entering text / Scan barcode</small>
                            </div>                                                    
                        </div>
                    </div>
                </div>
                <div id='book_details_container' class="row"></div>
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
<script type="text/javascript">
    var current_avail_copies = '';
    $(function ($) {
        function show_message(reject) {
            var errMsg = {
                'type': 'default',
                title: (typeof reject.title != 'undefined' && reject.title != '') ? reject.title : 'Book assignment',
                message: (reject.message != '') ? reject.message : 'There are some error, please try again!'
            }
            myApp.modal.alert(errMsg);
        }
        $('#issue_date').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            clearBtn: true,
            endDate: '0d'
        }).on('change', function () {
            $(this).valid(); // triggers the validation test
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
            $(this).valid(); // triggers the validation test
            // '$(this)' refers to '$("#datepicker")'
        });
        $('.focus_date').on('click', function () {
            $(this).parent('div').find('input').focus();
        });
        $('#return_date').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            clearBtn: true,
            endDate: '0d'
        }).on('change', function () {
            $(this).valid(); // triggers the validation test
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
                            user_id: function () {
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
                bledger_id: {required: 'Ledger id is required', remote: jQuery.validator.format('This book is assigned to other user!')},
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
        $('#member_id').change(function () {
            var data = {'member_id': $(this).val()};
            $.ajax({
                url: '<?= APP_BASE ?>encode-id',
                method: 'POST',
                data: data,
                success: function (result) {
                    if (result != '') {
                        $('#member_encode_id').val(result);
                    }
                }
            });
        });
        $('#user_details_container').on('click', '#print_library_card', function (e) {
            e.preventDefault(e);
            var card_no = $(this).data('id');
            if (card_no != '') {
                var url = '<?= APP_BASE ?>print-library-card/' + card_no;
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

        function fetch_book_data(book_item) {
            var book_info_html = '';
            book_info_html = '<div class="col-md-12"><div class="box box-primary">' +
                    '<div class="box-body box-profile">' +
                    '<h3 class="profile-username text-center">Book title: ' + book_item.name + '</h3>' +
                    '<p class="text-muted text-center">Edition: ' + book_item.edition + '</p>' +
                    '<ul class="list-group list-group-unbordered">' +
                    '<li class="list-group-item">' +
                    '<b>ISBN:</b> <a class="pull-right"> ' + book_item.isbn_no + '</a>' +
                    '</li>' +
                    '<li class="list-group-item">' +
                    '<b>Author:</b> <a class="pull-right">' + book_item.author_name + '</a>' +
                    '</li>' +
                    '<li class="list-group-item">' +
                    '<b>Publication</b> <a class="pull-right">' + book_item.publication + '</a>' +
                    '</li>' +
                    '<li class="list-group-item">' +
                    '<b>Total copies: </b> <a class="pull-right">' + book_item.total_copies + '</a>' +
                    '</li>' +
                    '<li class="list-group-item">' +
                    '<b>Lost copies: </b> <a class="pull-right">' + book_item.lost_copies + '</a>' +
                    '</li>' +
                    '<li class="list-group-item">' +
                    '<b>Currently available copies: </b> <a class="pull-right">' + book_item.copies_instock + '</a>' +
                    '</li>' +
                    '</ul>' +
                    '<a href="#" class="btn btn-primary btn-block" id="assign_book"><b>Assign</b></a>' +
                    '</div></div><br/>';
            current_avail_copies = book_item.copies_instock;
            $('#book_details_container').html(book_info_html);
        }

        $('#book_details_container').on('click', '#assign_book', function () {
            var search_txt = $('#search_txt').val();
            if (current_avail_copies == 0 || current_avail_copies === '') {
                $('#default_modal_box .modal-title').html('Warning');
                $('#default_modal_box .modal-body').html('Book copy is not available for assignment.');
                $('#default_modal_box #default_modal_box_btn_cancel').hide();
                $('#default_modal_box').modal('show');
                return;
            }
            if (!search_txt) {
                $('#default_modal_box .modal-title').html('Warning');
                $('#default_modal_box .modal-body').html('please select member for assignment');
                $('#default_modal_box #default_modal_box_btn_cancel').hide();
                $('#default_modal_box').modal('show');
                return;
            } else {
                $.ajax({
                    url: base_url + 'assign-book',
                    type: 'POST',
                    dataType: 'json',
                    data: {'ledger_id': fetched_book_ledger_id, 'user_id': fetched_user_id},
                    success: function (res) {
                        if (res.status) {
                            $('#primary_modal_box .modal-title').html('Success');
                            $('#primary_modal_box .modal-body').html(res.msg);
                            $('#primary_modal_box').modal('show');
                        } else {
                            $('#default_modal_box .modal-title').html('Error in assignment');
                            $('#default_modal_box .modal-body').html(res.msg);
                            $('#default_modal_box #default_modal_box_btn_cancel').hide();
                            $('#default_modal_box').modal('show');
                        }
                    },
                    error: function (xhr, status, error) {
                        var err = xhr.responseText;
                        console.log(err);
                    }
                });
            }
        });

        $('#primary_modal_box').on('click', '#primary_modal_box_btn', function () {
            location.reload();
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
        var fetched_book_ledger_id = '';
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
                    console.log('item', item);
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
        //type head for book search
        $.typeahead({
            input: '#book_kw',
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
                        url: base_url + 'search-book-data',
                        data: {
                            search_text: "{{query}}"
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
                    $('#book_details_container').text('');
                    fetched_book_ledger_id = item.bledger_id;
                    fetch_book_data(item);
                    //console.log(node, a, item, event);
                    console.log('item', item);
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
                    $('#book-result-container').html(text);
                }
            }
        });
    });
</script>