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
    <div class="col-md-12">
        <div class="box box-default">
            <div class="box-header with-border">
                <i class="fa fa-search"></i>
                <h3 class="box-title">Book details</h3>
            </div>
            <div class="box-body">
                <div class = 'col-md-6'>
                    <var id="book-result-container" class="book-result-container"></var>
                    <div class="typeahead__container">
                        <div class="typeahead__field">
                            <div class="typeahead__query">
                                <input type="text" name="book_kw" id="book_kw" class="form-control" placeholder="Enter Book title, author Or ISBN" autocomplete="off" style="font-size: 14px;"/>
                                <small class="help-block">Note:Search by entering text / Scan barcode</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div id='book_details_container' class="row"></div>
                <div class="row-fluid">
                    <div class="col-md-12">
                        <table id="raw_cert_data_dt_table" class="table dataTable table-sm table-bordered table-striped table-hover dataTable" width="99%" cellpadding="0" cellpadding="0"></table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-default" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Default Modal</h4>
            </div>
            <div class="modal-body">
                <div class="book-info">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="callout callout-info"> 
                                <div class="" id="book_isbn_id"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class='form-group col-sm-12' style="padding-top: 0%;">
                    <div class='col-sm-12'>                 
                        <div class="btn-group" data-toggle="buttons">
                            <label class="rbtn btn btn-success active btn-sm">
                                <input type="radio" class="user_type_radio" name="user_type_radio" id="employee_radio" value="employee" autocomplete="off" chacked>
                                <span class="glyphicon glyphicon-ok"></span> Employee
                            </label>

                            <label class="rbtn btn btn-primary btn-sm">
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
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="assign_book">Assign</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="modal fade" id="return-modal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-label="Close" data-dismiss="modal" class="close" type="button">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Confirmation</h4>
            </div>
            <div class="modal-body">
                <form name="form_return_books" id="form_return_books" method="POST">
                    <input type="checkbox" name="book_lost" id="book_lost" value="1"/> Mark book as lost.
                    <div id="fine_details" class="text-bold error"></div><br/>
                    <div id="lost_fine_details" class="text-bold"></div><br/>
                    <input type="hidden" name="book_assign_id" id="book_assign_id"/>
                    <input type="hidden" name="member_id" id="member_id"/>
                    <div class="form-group">
                        <label for="book_condition">Book return condition:</label>
                        <input type="text" name="book_condition" id="book_condition" placeholder="Book condition" class="form-control required" required="required"/>
                    </div>
                    <p id="confim_msg">Are you sure you want return this book ?</p>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success" id="return_book_confirm" type="button">Ok</button>
                <button data-dismiss="modal" class="btn btn-danger" id="return_modal_box_btn_cancel" type="button">Cancel</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<script type="text/javascript">
    $(document).ready(function () {
        function show_message(reject) {
            var errMsg = {
                'type': 'default',
                title: (typeof reject.title != 'undefined' && reject.title != '') ? reject.title : 'Book assignment',
                message: (reject.message != '') ? reject.message : 'There are some error, please try again!'
            }
            myApp.modal.alert(errMsg);
        }

        var book_copy_id = '';
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
        var raw_cert_data_dt_table = '';
        function fetch_book_data(item) {
            populate_table(item.bledger_id);
        }

        var columns = [
            {
                title: "Sl. No",
                class: "",
                data: function (item) {
                    return item.book_copy_count;
                }
            },
            {
                title: "Book ID",
                class: "",
                data: function (item) {
                    return item.book_barcode_info;
                }
            },
            {
                title: "Assigned to",
                class: "",
                data: function (item) {
                    var name = '';
                    if (item.first_name || item.last_name) {
                        name = item.first_name + ' ' + item.last_name;
                    }
                    return name;
                }
            },
            {
                title: "Status",
                class: "",
                data: function (item) {
                    var book_status_btn = '<i class="fa fa-close text-danger"></i>';
                    if (item.book_availability == 'A') {
                        book_status_btn = '<i class="fa fa-check text-success"></i>';
                    }
                    return book_status_btn;
                }
            },
            {
                title: "Action",
                class: "",
                data: function (item) {
                    var btn_disabled = 'disabled="disabled"';
                    if (item.book_availability == 'A') {
                        btn_disabled = '';
                    }
                    var action_mark_up = '<button data-unique_id="' + item.book_barcode_info + '" data-id="' + item.book_copies_id + '" class="btn btn-sm btn-primary assign_book_to" ' + btn_disabled + ' id="assign_book_to">Assign to</button>' +
                            ' <button class="btn btn-sm btn-success return_book" data-member_id="' + item.member_id + '" data-unique_id="' + item.book_barcode_info +
                            '" data-id="' + item.book_copies_id + '" id="return_book">Return</button>';
                    return action_mark_up;
                }
            }
        ];

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
        typeahead_user();
        function typeahead_user() {
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
                            fetched_user_id = '';
                            text = 'No results matching "' + query + '"';
                            $('#user_details_container').empty();
                        }
                        $('#result-container').html(text);
                    }
                }
            });
        }

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

        function populate_table(ledger_id) {
            raw_cert_data_dt_table = $('#raw_cert_data_dt_table').dataTable({
                "initComplete": function (settings, json) {
                },
                'columns': columns,
                'columnDefs': [
                    {className: "", "targets": [2]}
                ],
                "bDestroy": true,
                language: {
                    sZeroRecords: "<div class='no_records'>No data found</div>",
                    sEmptyTable: "<div class='no_records'>No data found</div>",
                    sProcessing: "<div class='no_records'>Loading</div>",
                },
                'searching': true,
                'paging': true,
                'pageLength': 25,
                'lengthChange': false,
                'aLengthMenu': [25, 50, 100],
                'processing': true,
                'serverSide': true,
                'ajax': {
                    'url': '<?= base_url('get-books-list'); ?>',
                    'type': 'POST',
                    'dataType': 'json',
                    'data': {bledger_id: ledger_id}
                },
                bSort: true,
                order: [[0, 'desc']],
                info: true,
                sScrollX: true,
                ordering: false
            });

        }
        $('#raw_cert_data_dt_table').on('click', '.assign_book_to', function () {
            $('#search_txt').val('');
            $('#search_txt').prev(".typeahead__cancel-button").trigger('click');
            $('#user_details_container').empty();
            book_copy_id = $(this).data('id');
            var unique_id = $(this).data('unique_id');
            $('#modal-default .modal-header .modal-title').html($('#book_kw').val());
            $('#modal-default .modal-body .book-info #book_isbn_id ').html('Book ID: ' + unique_id);
            $('#modal-default').modal('show');
        });
        var member_id = '';
        $('#raw_cert_data_dt_table').on('click', '.return_book', function (e) {
            book_copy_id = $(this).data('id');
            member_id = $(this).data('member_id');
            var unique_id = $(this).data('unique_id');
            $('#fine_details').html('');
            e.preventDefault();
            var id = $(this).data('id');
            var fine_amt = 0;
            $.ajax({
                url: "<?= base_url('get-delayed-fine') ?>",
                type: 'POST',
                dataType: 'json',
                data: {book_assign_id: id, member_id: member_id},
                success: function (result) {
                    console.log(result);
                    var days = result.data.date_diff;
                    fine_amt = result.data.fine_amount;
                    if (fine_amt > 0) {
                    $('#form_return_books #fine_details').html('As the book return is delayed by ' + days + ' days there will be fine of Rs. <span class="label label-danger">' + fine_amt + ' INR</span>');
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log('error' + textStatus);
                }
            });

            $('#return-modal #book_assign_id').val(id);
            $('#return-modal #member_id').val(member_id);
            $('#form_return_books #book_name').html();

            $('#return-modal .modal-header .modal-title').html($('#book_kw').val());
            $('#return-modal .modal-body .book-info #book_isbn_id ').html('Book ID: ' + unique_id);
            $('#return-modal').modal('show');
        });

        $('#return-modal').on('change', '#book_lost', function () {
            if ($('#book_lost').is(":checked")) {
                $.ajax({
                    url: "<?= base_url('get-lost-fine') ?>",
                    type: 'POST',
                    dataType: 'json',
                    data: '',
                    success: function (result) {
                        var amt = 0;
                        amt = result.book_lost_fine;
                        $('#fine_details').hide();
                        $('#lost_fine_details').html('As the book is lost there will be fine of Rs. <input type="text" name="book_lost_fine" id="book_lost_fine class="form-control" value="' + amt + '"/>');
                        $('#lost_fine_details').show();
                        $('#book_condition').val('LOST');
                        $('#confim_msg').html('Are you sure you want to mark this book as lost?');
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.log('error' + textStatus);
                    }
                });
            } else {
                $('#fine_details').show();
                $('#lost_fine_details').hide();
                $('#book_condition').val('');
                $('#confim_msg').html('Are you sure you want to return this book?');
            }
        });

        $('#form_return_books').validate();
        $('#return-modal').on('click', '#return_book_confirm', function () {
            var form_data = $('#form_return_books').serializeArray();
            if ($('#form_return_books').valid()) {
                $.ajax({
                    url: "<?= base_url('return-borrowed-books') ?>",
                    type: 'POST',
                    dataType: 'json',
                    data: form_data,
                    success: function (result) {
                        populate_table(fetched_book_ledger_id);
                        $('#return_modal_box').modal('hide');
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.log('error' + textStatus);
                    }
                });
            }
        });

        $('#modal-default').on('click', '#assign_book', function () {
            var search_txt = $('#search_txt').val();
            if (!search_txt) {
                $('#modal-default').modal('hide');
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
                    data: {'ledger_id': fetched_book_ledger_id, 'book_copy_id': book_copy_id, 'user_id': fetched_user_id},
                    success: function (res) {
                        $('#modal-default').modal('hide');
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
                        populate_table(fetched_book_ledger_id);
                    },
                    error: function (xhr, status, error) {
                        var err = xhr.responseText;
                        console.log(err);
                    }
                });
            }
        });
    });
</script>