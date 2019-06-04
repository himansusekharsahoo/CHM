<style>    
    .book_name{
        width: 200px !important;
    }
</style>
<div class="col-sm-11">
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
            $form_action = base_url('create-book-ledger');
            echo form_open($form_action, $form_attribute);
            ?>
            <div class = 'form-group row'>                
                <div class = 'col-sm-6 text-danger'>
                    <?php
                    if ($this->session->flashdata('ledger_error'))
                    {
                        echo $this->session->flashdata('ledger_error');
                    } else
                    {
                        echo validation_errors();
                    }
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">

                    <div class = 'form-group row'>
                        <label for = 'book_id' class = 'col-sm-4 col-form-label ele_required'>Book name </label>
                        <div class = 'col-sm-7'>
                            <?php
                            $attribute = array(
                                "name" => "book_id",
                                "id" => "book_id",
                                "class" => "form-control chosen-select",
                            );
                            $book_id = (isset($data['book_id'])) ? $data['book_id'] : '';
                            echo form_dropdown($attribute, $book_id_list, $book_id);
                            ?>
                        </div>
                    </div>
                    <div class = 'form-group row'>
                        <label for = 'bcategory_id' class = 'col-sm-4 col-form-label ele_required'>Book category </label>
                        <div class = 'col-sm-7'>
                            <?php
                            $attribute = array(
                                "name" => "bcategory_id",
                                "id" => "bcategory_id",
                                "class" => "form-control chosen-select",
                            );
                            $bcategory_id = (isset($data['bcategory_id'])) ? $data['bcategory_id'] : '';
                            echo form_dropdown($attribute, $bcategory_id_list, $bcategory_id);
                            ?>
                        </div>
                    </div>
                    <div class = 'form-group row'>
                        <label for = 'bpublication_id' class = 'col-sm-4 col-form-label ele_required'>Book publication </label>
                        <div class = 'col-sm-7'>
                            <?php
                            $attribute = array(
                                "name" => "bpublication_id",
                                "id" => "bpublication_id",
                                "class" => "form-control chosen-select",
                            );
                            $bpublication_id = (isset($data['bpublication_id'])) ? $data['bpublication_id'] : '';
                            echo form_dropdown($attribute, $bpublication_id_list, $bpublication_id);
                            ?>
                        </div>
                    </div>
                    <div class = 'form-group row'>
                        <label for = 'bauthor_id' class = 'col-sm-4 col-form-label ele_required'>Book author </label>
                        <div class = 'col-sm-7'>
                            <?php
                            $attribute = array(
                                "name" => "bauthor_id",
                                "id" => "bauthor_id",
                                "class" => "form-control chosen-select",
                            );
                            $bauthor_id = (isset($data['bauthor_id'])) ? $data['bauthor_id'] : '';
                            echo form_dropdown($attribute, $bauthor_id_list, $bauthor_id);
                            ?>
                        </div>
                    </div>
                    <div class = 'form-group row'>
                        <label for = 'blocation_id' class = 'col-sm-4 col-form-label ele_required'>Book location </label>
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
                        <label for = 'page' class = 'col-sm-4 col-form-label ele_required'>Pages </label>
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
                        <label for = 'mrp' class = 'col-sm-4 col-form-label'>MRP </label>
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
                        <label for = 'isbn_no' class = 'col-sm-4 col-form-label'>ISBN </label>
                        <div class = 'col-sm-7'>
                            <?php
                            $attribute = array(
                                "name" => "isbn_no",
                                "id" => "isbn_no",
                                "class" => "form-control",
                                "title" => "",
                                "type" => "text",
                                "value" => (isset($data["isbn_no"])) ? $data["isbn_no"] : ""
                            );
                            echo form_input($attribute);
                            ?>
                        </div>
                    </div>
                    <div class = 'form-group row'>
                        <label for = 'edition' class = 'col-sm-4 col-form-label'>Edition </label>
                        <div class = 'col-sm-7'>
                            <?php
                            $attribute = array(
                                "name" => "edition",
                                "id" => "edition",
                                "class" => "form-control",
                                "title" => "",
                                "type" => "text",
                                "value" => (isset($data["edition"])) ? $data["edition"] : ""
                            );
                            echo form_input($attribute);
                            ?>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row-fluid">
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
                                <div class="col-sm-6">
                                    <div class = 'form-group row'>
                                        <label for = 'bill_number' class = 'col-sm-4 col-form-label ele_required'>Bill number</label>
                                        <div class = 'col-sm-7'>
                                            <?php
                                            $attribute = array(
                                                "name" => "bill_number",
                                                "id" => "bill_number",
                                                "class" => "form-control",
                                                "type" => "text",
                                                "value" => (isset($data["bill_number"])) ? $data["bill_number"] : ""
                                            );
                                            echo form_input($attribute);
                                            ?>
                                        </div>
                                    </div>
                                    <div class = 'form-group row'>
                                        <label for = 'purchase_date' class = 'col-sm-4 col-form-label ele_required'>Purchase date</label>
                                        <div class = 'col-sm-7'>
                                            <div class="input-group date">                
                                                <input type="text" class="form-control pull-right" id="purchase_date" name="purchase_date" value="<?= (isset($data["purchase_date"])) ? $data["purchase_date"] : set_value('purchase_date') ?>">
                                                <div class="input-group-addon focus_date">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                            </div>
                                            <span></span>                                            
                                        </div>
                                    </div>
                                    <div class = 'form-group row'>
                                        <label for = 'price' class = 'col-sm-4 col-form-label ele_required'>Price</label>
                                        <div class = 'col-sm-7'>
                                            <?php
                                            $attribute = array(
                                                "name" => "price",
                                                "id" => "price",
                                                "class" => "form-control",
                                                "type" => "text",
                                                "value" => (isset($data["price"])) ? $data["price"] : ""
                                            );
                                            echo form_input($attribute);
                                            ?>
                                        </div>
                                    </div>
                                    <div class = 'form-group row'>
                                        <label for = 'edition' class = 'col-sm-4 col-form-label ele_required'>Total copies </label>
                                        <div class = 'col-sm-7'>
                                            <?php
                                            $attribute = array(
                                                "name" => "total_copies",
                                                "id" => "total_copies",
                                                "class" => "form-control",
                                                "title" => "",
                                                "type" => "number",
                                                "value" => (isset($data["total_copies"])) ? $data["total_copies"] : ""
                                            );
                                            echo form_input($attribute);
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class = 'form-group row'>
                                        <label for = 'vendor_name' class = 'col-sm-4 col-form-label'>Vendor name</label>
                                        <div class = 'col-sm-7'>
                                            <?php
                                            $attribute = array(
                                                "name" => "vendor_name",
                                                "id" => "vendor_name",
                                                "class" => "form-control",
                                                "type" => "text",
                                                "value" => (isset($data["vendor_name"])) ? $data["vendor_name"] : ""
                                            );
                                            echo form_input($attribute);
                                            ?>
                                        </div>
                                    </div>
                                    <div class = 'form-group row'>
                                        <label for = 'remarks' class = 'col-sm-4 col-form-label'>Remarks</label>
                                        <div class = 'col-sm-7'>
                                            <?php
                                            $attribute = array(
                                                "name" => "remarks",
                                                "id" => "remarks",
                                                "class" => "form-control",
                                                "style" => "height:83px"
                                            );
                                            $value = (isset($data["remarks"])) ? $data["remarks"] : "";
                                            echo form_textarea($attribute, $value);
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                        <div class ='col-sm-2'>
                            <input type="submit" id="submit" name="submit" value="Save" class="btn btn-primary">
                        </div>
                    </span>
                </div>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $.validator.setDefaults({ignore: ":hidden:not(.chosen-select)"})
        $('#book_ledgers').validate({
            rules: {
                book_id: "required",
                bcategory_id: "required",
                bpublication_id: "required",
                bauthor_id: "required",
                blocation_id: "required",
                page: {
                    required: true,
                    number: true
                }
            },
            messages: {
                book_id: 'Book name is required',
                bcategory_id: 'Book category is required',
                bpublication_id: 'Book publication is required',
                bauthor_id: 'Book author is required',
                blocation_id: 'Books location is required',
                page: {
                    'required': 'Number of pages in books is required',
                    'number': 'Please enter valid number.'
                }
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
        $('.chosen-select').chosen({allow_single_deselect: true});
    });
</script>