<style type="text/css">
    .typeahead__query{
        font-size: 12px;
    }
    .ui-select-choices {
        position: fixed;
        top: auto;
        left: auto;
        width: inherit;
    }
</style>
<div class="row no_pad">
    <div class="col-md-12">
        <div class="box box-default">
            <div class="box-header with-border">
                <i class="fa fa-search"></i>
                <h3 class="box-title">Book return:</h3>
            </div>
            <div class="box-body">
                <div class="col-md-6">
                    <var id="book-result-container" class="book-result-container"></var>
                    <div class="typeahead__container">
                        <div class="typeahead__field">
                            <div class="typeahead__query">
                                <input type="text" name="book_kw" id="book_kw" class="form-control book_kw" placeholder="Enter library card number" autocomplete="off"/>
                                <small class="help-block">Note:Search by entering text / Scan barcode</small>
                            </div>                                                    
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <table id="books_table" class="table table-bordered table-hover" width="100%"></table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="return_modal_box" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-label="Close" data-dismiss="modal" class="close" type="button">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Confirmation</h4>
            </div>
            <div class="modal-body">
                <form name="form_return_books" id="form_return_books" method="POST">
                    <div id="fine_details" class="text-bold"></div><br/>
                    <p>Are you sure you want return this book ?</p>
                    <input type="hidden" name="book_assign_id" id="book_assign_id"/>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success" id="return_modal_box_btn" type="button">Ok</button>
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
        $('#books_table').on('click', '.btn_return_book', function (e) {
            $('#fine_details').html('');
            e.preventDefault();
            var id = $(this).data('id');
            var fine_amt = 0;
            $.ajax({
                url: "<?= base_url('get-delayed-fine') ?>",
                type: 'POST',
                dataType: 'json',
                data: {book_assign_id: id},
                success: function (result) {
                    var days = result.data.date_diff;
                    fine_amt = result.data.fine_amount;
                    if (fine_amt > 0) {
                        $('#fine_details').html('As the book return is delayed by ' + days + ' days there will be fine of Rs. <span class="label label-danger">' + fine_amt + ' INR</span>');
                    }
                },
                error: function (result) {
                    console.log(result);
                }
            });

            $('#return_modal_box #book_assign_id').val(id);
            $('#form_return_books #book_name').html();
            $('#return_modal_box').modal('show');
        });
        $('#return_modal_box').on('click', '#return_modal_box_btn', function () {
            var form_data = $('#form_return_books').serializeArray();
            $.ajax({
                url: "<?= base_url('return-borrowed-books') ?>",
                type: 'POST',
                dataType: 'json',
                data: form_data,
                success: function (result) {
                    populate_table(user_data);
                    $('#return_modal_box').modal('hide');
                },
                error: function (result) {
                    console.log(result);
                }
            });
        });
        var user_data = '';
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
                    display: "card_info",
                    ajax: {
                        method: 'post',
                        url: base_url + 'search-card-details',
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
                    //$('#book_details_container').text('');
                    //fetch_book_data(item);
                    user_data = item;
                    populate_table(item);
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

        var columns = [
            {
                title: "Book name",
                class: "",
                data: function (item) {
                    return item.name;
                }
            },
            {
                title: "Author",
                class: "",
                data: function (item) {
                    return item.author_name;
                }
            },
            {
                title: "Edition",
                class: "",
                data: function (item) {
                    return item.edition;
                }
            },
            {
                title: "Borrowed on",
                class: "",
                data: function (item) {
                    return item.date_issue;
                }
            },
            {
                title: "Due date",
                class: "",
                data: function (item) {
                    return item.due_date;
                }
            },
            {
                title: "Return",
                class: "",
                data: function (item) {
                    return '<button class="btn btn-primary btn_return_book" data-id="' + item.bassign_id + '">Return book</button>';
                }
            },
            {
                title: "Lost",
                class: "",
                data: function (item) {
                    return '<button class="btn btn-info btn_lost_book" data-id="' + item.bassign_id + '">Lost</button>';
                }
            }
        ];
        function populate_table(card_data) {
            var books_table = $('#books_table').dataTable({
                "initComplete": function (settings, json) {
                },
                'columns': columns,
                'columnDefs': [
                    {className: "", "targets": [5]}
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
                'lengthChange': true,
                'aLengthMenu': [25, 50, 100],
                'processing': true,
                'serverSide': true,
                'ajax': {
                    'url': '<?= base_url('get-assignment-details'); ?>',
                    'type': 'POST',
                    'dataType': 'json',
                    'data': card_data
                },
                order: [[0, 'desc']],
                info: true,
                sScrollX: true,
                ordering: false,
                drawCallback: function () {
                },
                rowCallback: function (row, data, index) {

                }
            });

        }
    });
</script>