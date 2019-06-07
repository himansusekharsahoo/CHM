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
    .created{width:90px !important;}
    .created_by{width:100px !important;}
    .action_td{width:100px !important; vertical-align: middle !important;}
</style>
<div class="col-sm-12">
    <div class="box box-primary">
        <div class="box-header with-border">
        </div>
        <div class="box-body">
            <?php
            $form_attribute = array(
                "name" => "book_ledgers",
                "id" => "book_ledgers",
                "method" => "POST"
            );
            $form_action = base_url('edit-book-ledger-save');
            echo form_open($form_action, $form_attribute);
            ?>
            <div class = 'form-group row'>                
                <div class = 'col-sm-6 text-danger'>
                    <?php
                    if ($this->session->flashdata('ledger_error')) {
                        echo $this->session->flashdata('ledger_error');
                    } else {
                        echo validation_errors();
                    }
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <?php
                    $attribute = array(
                        "name" => "purchase_details_flag",
                        "id" => "purchase_details_flag",
                        "class" => "form-control required",
                        "type" => "hidden",
                        "value" => (isset($purchase_details_flag)) ? $purchase_details_flag : 0
                    );
                    echo form_input($attribute);
                    $bledger_id = (isset($data["bledger_id"])) ? c_encode($data["bledger_id"]) : "";
//echo c_decode($bledger_id);
                    $attribute = array(
                        "name" => "bledger_id",
                        "id" => "bledger_id",
                        "class" => "form-control required",
                        "type" => "hidden",
                        "value" => $bledger_id
                    );
                    echo form_input($attribute);
                    ?>
                    <div class = 'form-group row'>
                        <label for = 'book_id' class = 'col-sm-4 col-form-label'>Book name</label>
                        <div class = 'col-sm-7'>
                            <?php
                            $attribute = array(
                                "name" => "book_id",
                                "id" => "book_id",
                                "class" => "form-control chosen-select"
                            );
                            $book_id = (isset($data['book_id'])) ? $data['book_id'] : '';
                            if ($purchase_details_flag === TRUE) {
                                $attributeH = array(
                                    "name" => "book_id",
                                    "id" => "book_id",
                                    "class" => "form-control required",
                                    "type" => "hidden",
                                    "value" => $book_id
                                );
                                echo form_input($attributeH);
                                $attribute['disabled'] = "true";
                                echo form_dropdown($attribute, $book_id_list, $book_id);
                            } else {
                                echo form_dropdown($attribute, $book_id_list, $book_id);
                            }
                            ?>
                        </div>
                    </div>
                    <div class = 'form-group row'>
                        <label for = 'bcategory_id' class = 'col-sm-4 col-form-label'>Book category</label>
                        <div class = 'col-sm-7'>
                            <?php
                            $attribute = array(
                                "name" => "bcategory_id",
                                "id" => "bcategory_id",
                                "class" => "form-control chosen-select"
                            );
                            $bcategory_id = (isset($data['bcategory_id'])) ? $data['bcategory_id'] : '';
                            if ($purchase_details_flag === TRUE) {
                                $attributeH = array(
                                    "name" => "bcategory_id",
                                    "id" => "bcategory_id",
                                    "class" => "form-control required",
                                    "type" => "hidden",
                                    "value" => $bcategory_id
                                );
                                echo form_input($attributeH);
                                $attribute['disabled'] = "true";
                                echo form_dropdown($attribute, $bcategory_id_list, $bcategory_id);
                            } else {
                                echo form_dropdown($attribute, $bcategory_id_list, $bcategory_id);
                            }
                            ?>
                        </div>
                    </div>
                    <div class = 'form-group row'>
                        <label for = 'bpublication_id' class = 'col-sm-4 col-form-label'>Book publication</label>
                        <div class = 'col-sm-7'>
                            <?php
                            $attribute = array(
                                "name" => "bpublication_id",
                                "id" => "bpublication_id",
                                "class" => "form-control chosen-select",
                            );
                            $bpublication_id = (isset($data['bpublication_id'])) ? $data['bpublication_id'] : '';
                            if ($purchase_details_flag === TRUE) {
                                $attributeH = array(
                                    "name" => "bpublication_id",
                                    "id" => "bpublication_id",
                                    "class" => "form-control required",
                                    "type" => "hidden",
                                    "value" => $bpublication_id
                                );
                                echo form_input($attributeH);
                                $attribute['disabled'] = "true";
                                echo form_dropdown($attribute, $bpublication_id_list, $bpublication_id);
                            } else {
                                echo form_dropdown($attribute, $bpublication_id_list, $bpublication_id);
                            }
                            ?>
                        </div>
                    </div>
                    <div class = 'form-group row'>
                        <label for = 'bauthor_id' class = 'col-sm-4 col-form-label'>Book author</label>
                        <div class = 'col-sm-7'>
                            <?php
                            $attribute = array(
                                "name" => "bauthor_id",
                                "id" => "bauthor_id",
                                "class" => "form-control chosen-select",
                            );
                            $bauthor_id = (isset($data['bauthor_id'])) ? $data['bauthor_id'] : '';
                            if ($purchase_details_flag === TRUE) {
                                $attributeH = array(
                                    "name" => "bauthor_id",
                                    "id" => "bauthor_id",
                                    "class" => "form-control required",
                                    "type" => "hidden",
                                    "value" => $bauthor_id
                                );
                                echo form_input($attributeH);
                                $attribute['disabled'] = "true";
                                echo form_dropdown($attribute, $bauthor_id_list, $bauthor_id);
                            } else {
                                echo form_dropdown($attribute, $bauthor_id_list, $bauthor_id);
                            }
                            ?>
                        </div>
                    </div>
                    <div class = 'form-group row'>
                        <label for = 'blocation_id' class = 'col-sm-4 col-form-label ele_required'>Book location</label>
                        <div class = 'col-sm-7'>
                            <?php
                            $attribute = array(
                                "name" => "blocation_id",
                                "id" => "blocation_id",
                                "class" => "form-control chosen-select",
                            );
                            $blocation_id = (isset($data['blocation_id'])) ? $data['blocation_id'] : '';
                            echo form_dropdown($attribute, $blocation_id_list, $blocation_id);
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class = 'form-group row'>
                        <label for = 'page' class = 'col-sm-4 col-form-label ele_required'>Pages</label>
                        <div class = 'col-sm-7'>
                            <?php
                            $attribute = array(
                                "name" => "page",
                                "id" => "page",
                                "class" => "form-control",
                                "type" => "number",
                                "value" => (isset($data["page"])) ? $data["page"] : ""
                            );
                            echo form_input($attribute);
                            ?>
                        </div>
                    </div>
                    <div class = 'form-group row'>
                        <label for = 'mrp' class = 'col-sm-4 col-form-label'>MRP</label>
                        <div class = 'col-sm-7'>
                            <?php
                            $attribute = array(
                                "name" => "mrp",
                                "id" => "mrp",
                                "class" => "form-control",
                                "type" => "text",
                                "value" => (isset($data["mrp"])) ? $data["mrp"] : ""
                            );
                            echo form_input($attribute);
                            ?>
                        </div>
                    </div>
                    <div class = 'form-group row'>
                        <label for = 'isbn_no' class = 'col-sm-4 col-form-label'>ISBN</label>
                        <div class = 'col-sm-7'>
                            <?php
                            $attribute = array(
                                "name" => "isbn_no",
                                "id" => "isbn_no",
                                "class" => "form-control",
                                "type" => "text",
                                "value" => (isset($data["isbn_no"])) ? $data["isbn_no"] : ""
                            );
                            echo form_input($attribute);
                            ?>
                        </div>
                    </div>
                    <div class = 'form-group row'>
                        <label for = 'edition' class = 'col-sm-4 col-form-label'>Edition</label>
                        <div class = 'col-sm-7'>
                            <?php
                            $attribute = array(
                                "name" => "edition",
                                "id" => "edition",
                                "class" => "form-control",
                                "type" => "text",
                                "value" => (isset($data["edition"])) ? $data["edition"] : ""
                            );
                            echo form_input($attribute);
                            ?>
                        </div>
                    </div>
                    <div class = 'form-group row'>
                        <label for = 'edition' class = 'col-sm-4 col-form-label'>Total copies</label>
                        <div class = 'col-sm-7'>                            
                            <?php
                            $attribute = array(
                                "name" => "ledger_total_copies",
                                "id" => "ledger_total_copies",
                                "disabled" => "true",
                                "class" => "form-control disabled",
                                "type" => "text",
                                "value" => (isset($data["ledger_total_copies"])) ? $data["ledger_total_copies"] : "0"
                            );
                            echo form_input($attribute);
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class = 'row'>
                <div class="col-sm-12">
                    <span class="pull-right">
                        <div class = 'col-sm-6'>
                            <a class="text-right btn btn-default" href="<?= base_url('manage-book-ledger') ?>">
                                <span class="glyphicon glyphicon-th-list"></span> Cancel
                            </a>
                        </div>
                        <div class = 'col-sm-3'>
                            <input type="submit" id="submit" value="Update" class="btn btn-primary">
                        </div>
                    </span>
                </div>
            </div>
            <?= form_close() ?>
            <div class="row-fluid marginT10">
                <div class="panel-body no_pad criteria_panel">
                    <div class="panel panel-default orange_border">
                        <label style="width: 100%;">
                            <div class="panel-heading" data-toggle="collapse" data-target="#purchase_detail_panel" aria-expanded="true" style="cursor: pointer">
                                <h1 class="panel-title text-left white-text" data-toggle="collapse" data-target="#purchase_detail_panel" aria-expanded="true" style="cursor: pointer">
                                    <input type="checkbox" name="purchase_det_flag" id="purchase_det_flag" value="1"> Purchase details <span><i class="fa fa-chevron-down pull-right"></i></span>
                                </h1>
                            </div>
                        </label>
                        <div class="panel-body no_pad collapse" id="purchase_detail_panel" aria-expanded="true">
                            <div class="row-fluid marginT10">
                                <div class="col-sm-12 table-responsive">
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
            </div>

        </div>
    </div>
</div>
<div class="modal fade" id="new_purchase_detail_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <?php
            $form_attribute = array(
                "name" => "book_purchage_detail_logs",
                "id" => "book_purchage_detail_logs",
                "method" => "POST"
            );
            $form_action = base_url('book-ledger-purchase-details-save');
            echo form_open($form_action, $form_attribute);
            ?>
            <div class="modal-header">
                <button aria-label="Close" data-dismiss="modal" class="close" type="button">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Book purchase details</h4>
            </div>
            <div class="modal-body">
                <div class = 'form-group row'>
                    <label for = 'bill_number' class = 'col-sm-3 col-form-label ele_required'>Bill number</label>
                    <div class = 'col-sm-5'>
                        <?php
                        $attribute = array(
                            "name" => "bill_number",
                            "id" => "bill_number",
                            "class" => "form-control",
                            "title" => "",
                            "required" => "",
                            "type" => "text",
                            "value" => ""
                        );
                        echo form_error("bill_number");
                        echo form_input($attribute);
                        ?>
                    </div>
                </div>
                <div class = 'form-group row'>
                    <label for = 'purchase_date' class = 'col-sm-3 col-form-label ele_required'>Purchase date</label>
                    <div class = 'col-sm-5'>
                        <div class="input-group date">                
                            <input type="text" class="form-control pull-right" id="purchase_date" name="purchase_date" value="">
                            <div class="input-group-addon focus_date">
                                <i class="fa fa-calendar"></i>
                            </div>
                        </div>
                        <span></span>                                            
                    </div>
                </div>
                <div class = 'form-group row'>
                    <label for = 'price' class = 'col-sm-3 col-form-label ele_required'>Price</label>
                    <div class = 'col-sm-5'>
                        <?php
                        $attribute = array(
                            "name" => "price",
                            "id" => "price",
                            "class" => "form-control",
                            "title" => "",
                            "required" => "",
                            "type" => "text",
                            "value" => ""
                        );
                        echo form_error("price");
                        echo form_input($attribute);
                        ?>
                    </div>
                </div>
                <div class = 'form-group row'>
                    <label for = 'price' class = 'col-sm-3 col-form-label ele_required'>Total copies</label>
                    <div class = 'col-sm-5'>
                        <?php
                        $attribute = array(
                            "name" => "total_copies",
                            "id" => "total_copies",
                            "class" => "form-control",
                            "title" => "",
                            "required" => "",
                            "type" => "number",
                            "min" => "1",
                            "value" => ""
                        );
                        echo form_error("price");
                        echo form_input($attribute);
                        ?>
                    </div>
                </div>
                <div class = 'form-group row'>
                    <label for = 'vendor_name' class = 'col-sm-3 col-form-label ele_required'>Vendor name</label>
                    <div class = 'col-sm-5'>
                        <?php
                        $attribute = array(
                            "name" => "vendor_name",
                            "id" => "vendor_name",
                            "class" => "form-control",
                            "title" => "",
                            "required" => "",
                            "type" => "text",
                            "value" => ""
                        );
                        echo form_error("vendor_name");
                        echo form_input($attribute);
                        ?>
                    </div>
                </div>
                <div class = 'form-group row'>
                    <label for = 'remarks' class = 'col-sm-3 col-form-label'>Remarks</label>
                    <div class = 'col-sm-5'>
                        <?php
                        $attribute = array(
                            "name" => "remarks",
                            "id" => "remarks",
                            "class" => "form-control",
                            "title" => "",
                            "rows" => "3"
                        );
                        $value = "";
                        echo form_error("remarks");
                        echo form_textarea($attribute, $value);
                        ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success" id="save_purchase_details">Save</button>
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
        $.validator.setDefaults({ignore: ":hidden:not(.chosen-select)"});
        $('.chosen-select').chosen({allow_single_deselect: true});
        //delete record
        $(document).on('click', '.delete-purchase-details', function (e) {
            e.preventDefault();
            var data = {'bpurchase_id': $(this).data('bpurchase_id')}
            var row = $(this).closest('tr');
            var total_copy = $(this).data('purchase-books');
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
                                url: "<?= base_url('delete-book-ledger-purchase-details') ?>",
                                method: 'POST',
                                data: data,
                                success: function (result) {
                                    if (result == 1) {
                                        dialog.close();
                                        var ledg_total_copies = $('#ledger_total_copies').val();
                                        var calc_copy = parseInt(ledg_total_copies) - parseInt(total_copy);
                                        $('#ledger_total_copies').val(calc_copy);
                                        row.remove();
                                        if ($('#book_purchase_details_dt_table tr').length == 1) {
                                            window.location.reload(true);
                                        }
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
                "export_type": 'xlsx',
                "book_ledger_id": $('#bledger_id').val()
            };
            $.ajax({
                type: 'POST',
                url: "<?= base_url('export-book-ledger-purchase-details') ?>",
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
                "export_type": 'csv',
                "book_ledger_id": $('#bledger_id').val()
            };
            $.ajax({
                type: 'POST',
                url: "<?= base_url('export-book-ledger-purchase-details') ?>",
                data: param,
                dataType: 'json'
            }).done(function (data) {
                download(data.file, data.file_name, 'application/octet-stream');
                $('#loading').css('display', 'none');
            });
        });

        $('#book_ledgers').validate({
            rules: {
                book_id: "required",
                bcategory_id: "required",
                bpublication_id: "required",
                bauthor_id: "required",
                blocation_id: "required",
                page: "required"
            },
            messages: {
                book_id: 'Book name is required',
                bcategory_id: 'Book category is required',
                bpublication_id: 'Book publication is required',
                bauthor_id: 'Book author is required',
                blocation_id: 'Books location is required',
                page: 'Number of pages in books is required'
            },
            errorPlacement: function (error, element) {
                if (element.attr("name") == "purchase_date") {
                    error.appendTo(element.parent("div").next("span"));
                } else {
                    if (element.hasClass('chosen-select')) {
                        //console.log(element);
                        error.appendTo(element.parent("div"));
                    } else {
                        error.insertAfter(element);
                    }
                }
            },
            submitHandler: function (form) {
                if ($(form).valid())
                    form.submit();
                return false; // prevent normal form posting
            }
        });

        $('#book_ledgers').on('click', '#submit', function (e) {

            if ($('#book_ledgers').valid()) {
                $('#book_ledgers').submit();
            }
            e.preventDefault();
        });
        $('#purchase_det_flag').on('change', function () {
            // Get the jQuery validation plugin's settings
            var settings = $('#book_ledgers').validate().settings;
            if ($(this).is(':checked')) {
                // Modify validation settings
                $.extend(true, settings, {
                    rules: {
                        bill_number: "required",
                        purchase_date: "required",
                        price: "required",
                        total_copies: {
                            required: true,
                            number: true
                        }
                    },
                    messages: {
                        bill_number: 'Bill number is required',
                        purchase_date: 'Purchase date is required',
                        price: 'Price is required',
                        total_copies: {
                            'required': 'Total copies of books is required',
                            'number': 'Please enter valid number.'
                        }
                    }
                });
            } else {
                // Modify validation settings
                $.extend(true, settings, {
                    rules: {
                        bill_number: {},
                        purchase_date: {},
                        price: {}
                    }
                });
            }
        });

        $('#purchase_date').datepicker({
            format: 'd-m-yyyy',
            autoclose: true,
            clearBtn: true,
            endDate: '0d'
        }).on('change', function () {
            $(this).valid();  // triggers the validation test
            // '$(this)' refers to '$("#datepicker")'
        });
        $('.focus_date').on('click', function () {
            $(this).parent('div').find('input').focus();
        });

        $('#book_purchage_detail_logs').validate({
            rules: {
                bill_number: "required",
                purchase_date: "required",
                price: "required",
                total_copies: {
                    required: true,
                    number: true
                }
            },
            messages: {
                bill_number: 'Bill number is required',
                purchase_date: 'Purchase date is required',
                price: 'Price is required',
                total_copies: {
                    'required': 'Total copies of books is required',
                    'number': 'Please enter valid number.'
                }
            },
            errorPlacement: function (error, element) {
                if (element.attr("name") == "purchase_date") {
                    error.appendTo(element.parent("div").next("span"));
                } else {
                    error.insertAfter(element);
                }
            }
        });

        $(document).on('click', '#log_new_purchage_details', function (e) {
            e.preventDefault();
            $('#loading').css('display', 'block');
            $('#new_purchase_detail_modal').modal({backdrop: 'static', keyboard: false});
        });
        $(document).on('click', '#save_purchase_details', function (e) {
            $('#loading').css('display', 'block');
            if ($('#book_purchage_detail_logs').valid()) {
                const user_promise = new Promise(function (resolve, reject) {
                    var form_data = {
                        "book_ledger_id": $('#bledger_id').val(),
                        "bill_number": $('#bill_number').val(),
                        "purchase_date": $('#purchase_date').val(),
                        "price": $('#price').val(),
                        "vendor_name": $('#vendor_name').val(),
                        "total_copies": $('#total_copies').val(),
                        "remarks": $('#remarks').val(),
                    };
                    $.ajax({
                        url: "<?= base_url('book-ledger-purchase-details-save') ?>",
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
                    $('#loading').css('display', 'none');
                    $('#new_purchase_detail_modal').modal('hide');
                    if ($.fn.DataTable.isDataTable('#book_purchase_details_dt_table')) {
                        var total_copies = $('#total_copies').val();
                        var ledg_total_copies = $('#ledger_total_copies').val();
                        var calc_copy = parseInt(ledg_total_copies) + parseInt(total_copies);
                        $('#ledger_total_copies').val(calc_copy);
                        win_book_purchase_details_dt_table_obj.ajax.reload();
                    }
                    resolve = JSON.parse(resolve);
                    show_message(resolve);
                    //reset form fields                    
                    $('#bill_number').val('');
                    $('#purchase_date').val('');
                    $('#price').val('');
                    $('#vendor_name').val('');
                    $('#remarks').val('');
                    $('#total_copies').val();

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
                title: (typeof reject.title != 'undefined' && reject.title != '') ? reject.title : 'Book Ledger Details',
                message: (reject.message != '') ? reject.message : 'There are some error, please try again!'
            }
            myApp.modal.alert(errMsg);
        }
    });
</script>