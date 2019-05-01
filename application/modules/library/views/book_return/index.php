<style type="text/css">
    .typeahead__query{
        font-size: 12px;
    }
</style>
<div class="row no_pad">
    <div class="col-md-12">
        <div class="box box-default">
            <div class="box-header with-border">
                <i class="fa fa-search"></i>
                <h3 class="box-title">Book return:</h3>
            </div>
            <div class="box-body col-md-6">
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
            <div id='book_details_container' class="row"></div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {

        $('#book_details_container').on('click', '.btn_return_book', function () {
            var assign_id = $(this).data('assign_id');
            $('#default_modal_box .modal-header .modal-title').html('Confirmation');
            $('#default_modal_box .modal-body').html('Are you sure you want to return this book?');
            $('#default_modal_box').modal('show');
        });

        function fetch_book_data(book_item) {
            var book_info_html = '';
            book_info_html = '<div class="col-md-12"><div class="box box-primary">' +
                    '<div class="box-body box-profile">' +
                    '<h3 class="profile-username text-center">Card number: ' + book_item.card_no + '</h3>' +
                    /*'<p class="text-muted text-center">Edition: ' + book_item.edition + '</p>' +
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
                     '</ul>' +
                     '<a href="#" class="btn btn-primary btn-block" id="assign_book"><b>Assign</b></a>' +*/
                    '</div></div><br/>';
            const user_promise = new Promise(function (resolve, reject) {
                var form_data = {
                    card_no: book_item.card_no
                };
                $.ajax({
                    url: "<?= base_url('get-assignment-details') ?>",
                    type: 'POST',
                    dataType: 'json',
                    data: form_data,
                    success: function (result) {
                        resolve(result.data);
                    },
                    error: function (result) {
                        reject(result);
                    }
                });
            });
            user_promise.then(function (resolve) {
                $('#book_details_container').html(resolve);
            }, function (reject) {
                show_message(reject);
            });
            //$('#book_details_container').html(book_info_html);
        }

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
                    $('#book_details_container').text('');
                    //fetched_book_ledger_id = item.bledger_id;
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