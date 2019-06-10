<?php ?> 
<style>
    table{table-layout: fixed;}
    .qr_check_box{width:20px !important;}
    .book_name{width:150px !important;}
    .book_category_name{width:120px !important;}
    .book_publication{width:100px !important;}
    .author_name{width:100px !important;}
    .location{width:80px !important;}
    .book_page{width:80px !important;}
    .book_mrp{width:80px !important;}
    .isbn_no{width:80px !important;}
    .edition{width:80px !important;}
    .total_copies{width:100px !important;}
    .created{width:90px !important;}
    .created_by{width:100px !important;}
    .action_td{width:100px !important; vertical-align: middle !important;}
</style>
<div class="row-fluid">
    <div class="col-sm-12">
        <div class="box">
            <div class="box-body">
                <div class="no_pad table-responsive">
                    <?php
                    $this->load->library('c_datatable');
                    $dt_data = $this->c_datatable->generate_grid($config);
                    echo $dt_data;
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="qrcode_modal_box">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-label="Close" data-dismiss="modal" class="close" type="button">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">                
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                <button class="btn btn-default pull-right marginL5" type="button" id="print_one_barcode">Print</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<script type="text/javascript">
    $(function ($) {
        myApp.CommonMethod.checkAll($('#raw_cert_data_dt_table th:first').find("input:checkbox"), 'book_ledger_chk');
//delete record
        function show_message(reject) {
            var errMsg = {
                'type': 'default',
                title: (typeof reject.title != 'undefined' && reject.title != '') ? reject.title : 'Book Ledger List',
                message: (reject.message != '') ? reject.message : 'There are some error, please try again!'
            }
            myApp.modal.alert(errMsg);
        }
        $(document).on('click', '.delete-record', function (e) {
            e.preventDefault();
            var data = {'bledger_id': $(this).data('bledger_id')}
            var row = $(this).closest('tr');
            BootstrapDialog.show({
                title: 'Alert',
                message: 'Do you want to delete the record?',
                buttons: [{
                        label: 'Cancel',
                        action: function (dialog) {
                            dialog.close();
                        }
                    }, {
                        label: 'Delete',
                        action: function (dialog) {
                            $.ajax({
                                url: '<?= base_url('delete-book-ledger') ?>',
                                method: 'POST',
                                data: data,
                                success: function (result) {
                                    if (result == 1) {
                                        dialog.close();
                                        row.hide();
                                        BootstrapDialog.alert('Record successfully deleted!');
                                    } else {
                                        dialog.close();
                                        BootstrapDialog.alert('Data deletion error,please contact site admin!');
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

        });
//export raw data as excel 

        $(document).on('click', '#export_table_xls', function (e) {
            e.preventDefault();
            $('#loading').css('display', 'block');
            var param = {
                "export_type": 'xlsx'
            };
            $.ajax({
                type: 'POST',
                url: "<?= base_url('export-book-ledger') ?>",
                data: param,
                dataType: 'json'
            }).done(function (data) {
                download(data.file, data.file_name, 'application/octet-stream');
                $('#loading').css('display', 'none');
            });
        });
//export raw data as csv 

        $(document).on('click', '#export_table_csv', function (e) {
            e.preventDefault();
            $('#loading').css('display', 'block');
            var param = {
                "export_type": 'csv'
            };
            $.ajax({
                type: 'POST',
                url: "<?= base_url('export-book-ledger') ?>",
                data: param,
                dataType: 'json'
            }).done(function (data) {
                download(data.file, data.file_name, 'application/octet-stream');
                $('#loading').css('display', 'none');
            });
        });

        $(document).on('click', '#show_qrcode_popup', function (e) {
            e.preventDefault();
            // alert('qrcode');
            $('#loading').css('display', 'block');
            var param = {
                "ledger_id": $(this).attr('data-ledger-id'),
                "enc": 1
            };

            const qr_promise = new Promise(function (resolve, reject) {
                $.ajax({
                    url: "<?= base_url('popup-qr-code') ?>",
                    type: 'POST',
                    dataType: 'html',
                    data: param,
                    success: function (result) {
                        resolve(result);
                    },
                    error: function (result) {
                        reject(result);
                    }
                });
            });
            qr_promise.then(function (resolve) {
                resolve = JSON.parse(resolve);
                var modal_box = $('#qrcode_modal_box');
                modal_box.find('.modal-dialog').removeClass('modal-lg');
                modal_box.find('.modal-title').html(resolve.title);
                modal_box.find('.modal-body').html(resolve.message);
                modal_box.modal('show');
            }, function (reject) {
                show_message(reject);
            });

        });

        $('#print_one_barcode').on('click', function () {
            printDiv(document.getElementsByClassName('qrcode_modal_body'));
        });

        $(document).on('click', '#show_qrcode_batch', function (e) {
            e.preventDefault();
            // alert('qrcode');
            $('#loading').css('display', 'block');
            var ledger_ids = '';
            $('input:checkbox.book_ledger_chk').each(function () {
                if (ledger_ids != '') {
                    ledger_ids += (this.checked ? ',' + $(this).val() : "");
                } else {
                    ledger_ids = (this.checked ? $(this).val() : "");
                }

            });
            if (ledger_ids.length > 0) {
                var param = {
                    "ledger_id": ledger_ids
                };

                const qr_promise = new Promise(function (resolve, reject) {
                    $.ajax({
                        url: "<?= base_url('popup-qr-code') ?>",
                        type: 'POST',
                        dataType: 'html',
                        data: param,
                        success: function (result) {
                            resolve(result);
                        },
                        error: function (result) {
                            reject(result);
                        }
                    });
                });
                qr_promise.then(function (resolve) {
                    resolve = JSON.parse(resolve);
                    var modal_box = $('#qrcode_modal_box');
                    modal_box.find('.modal-dialog').addClass('modal-lg');
                    modal_box.find('.modal-title').html(resolve.title);
                    modal_box.find('.modal-body').html(resolve.message);
                    modal_box.modal('show');
                }, function (reject) {
                    show_message(reject);
                });
            } else {
                var errMsg = {
                    message: 'Please select record to generate QR code.'
                };
                show_message(errMsg);
            }
        });
        function printDiv(element_obj) {
            PrintElements.print(element_obj);
        }
    });
</script>