<script src="<?php echo base_url('assets/bower_components/jquery-validation/dist/jquery.validate.js'); ?>"></script>
<div class="col-sm-6">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Create book record</h3>
        </div>
        <div class="box-body">
            <?php
            $form_attribute = array(
                "name" => "book_ledgers",
                "id" => "book_ledgers",
                "method" => "POST"
            );
            $form_action = "/library/book_ledgers/create";
            echo form_open($form_action, $form_attribute);
            ?>
            <div class = 'form-group row'>
                <label for = 'book_id' class = 'col-sm-3 col-form-label'>Book name: </label>
                <div class = 'col-sm-5'>
                    <?php
                    $attribute = array(
                        "name" => "book_id",
                        "id" => "book_id",
                        "class" => "form-control required",
                        "title" => "",
                    );
                    $book_id = (isset($data['book_id'])) ? $data['book_id'] : '';
                    echo form_error("book_id");
                    echo form_dropdown($attribute, $book_id_list, $book_id);
                    ?>
                </div>
            </div>
            <div class = 'form-group row'>
                <label for = 'bcategory_id' class = 'col-sm-3 col-form-label'>Book category: </label>
                <div class = 'col-sm-5'>
                    <?php
                    $attribute = array(
                        "name" => "bcategory_id",
                        "id" => "bcategory_id",
                        "class" => "form-control required",
                        "title" => "",
                    );
                    $bcategory_id = (isset($data['bcategory_id'])) ? $data['bcategory_id'] : '';
                    echo form_error("bcategory_id");
                    echo form_dropdown($attribute, $bcategory_id_list, $bcategory_id);
                    ?>
                </div>
            </div>
            <div class = 'form-group row'>
                <label for = 'bpublication_id' class = 'col-sm-3 col-form-label'>Book publication: </label>
                <div class = 'col-sm-5'>
                    <?php
                    $attribute = array(
                        "name" => "bpublication_id",
                        "id" => "bpublication_id",
                        "class" => "form-control required",
                        "title" => "",
                    );
                    $bpublication_id = (isset($data['bpublication_id'])) ? $data['bpublication_id'] : '';
                    echo form_error("bpublication_id");
                    echo form_dropdown($attribute, $bpublication_id_list, $bpublication_id);
                    ?>
                </div>
            </div>
            <div class = 'form-group row'>
                <label for = 'bauthor_id' class = 'col-sm-3 col-form-label'>Book author: </label>
                <div class = 'col-sm-5'>
                    <?php
                    $attribute = array(
                        "name" => "bauthor_id",
                        "id" => "bauthor_id",
                        "class" => "form-control required",
                        "title" => "",
                    );
                    $bauthor_id = (isset($data['bauthor_id'])) ? $data['bauthor_id'] : '';
                    echo form_error("bauthor_id");
                    echo form_dropdown($attribute, $bauthor_id_list, $bauthor_id);
                    ?>
                </div>
            </div>
            <div class = 'form-group row'>
                <label for = 'blocation_id' class = 'col-sm-3 col-form-label'>Book location: </label>
                <div class = 'col-sm-5'>
                    <?php
                    $attribute = array(
                        "name" => "blocation_id",
                        "id" => "blocation_id",
                        "class" => "form-control required",
                        "title" => "",
                    );
                    $blocation_id = (isset($data['blocation_id'])) ? $data['blocation_id'] : '';
                    echo form_error("blocation_id");
                    echo form_dropdown($attribute, $blocation_id_list, $blocation_id);
                    ?>
                </div>
            </div>
            <div class = 'form-group row'>
                <label for = 'page' class = 'col-sm-3 col-form-label'>Pages: </label>
                <div class = 'col-sm-5'>
                    <?php
                    $attribute = array(
                        "name" => "page",
                        "id" => "page",
                        "class" => "form-control required",
                        "title" => "",
                        "type" => "number",
                        "value" => (isset($data["page"])) ? $data["page"] : ""
                    );
                    echo form_error("page");
                    echo form_input($attribute);
                    ?>
                </div>
            </div>
            <div class = 'form-group row'>
                <label for = 'mrp' class = 'col-sm-3 col-form-label'>MRP: </label>
                <div class = 'col-sm-5'>
                    <?php
                    $attribute = array(
                        "name" => "mrp",
                        "id" => "mrp",
                        "class" => "form-control required",
                        "title" => "",
                        "type" => "text",
                        "value" => (isset($data["mrp"])) ? $data["mrp"] : ""
                    );
                    echo form_error("mrp");
                    echo form_input($attribute);
                    ?>
                </div>
            </div>
            <div class = 'form-group row'>
                <label for = 'isbn_no' class = 'col-sm-3 col-form-label'>ISBN: </label>
                <div class = 'col-sm-5'>
                    <?php
                    $attribute = array(
                        "name" => "isbn_no",
                        "id" => "isbn_no",
                        "class" => "form-control required",
                        "title" => "",
                        "type" => "text",
                        "value" => (isset($data["isbn_no"])) ? $data["isbn_no"] : ""
                    );
                    echo form_error("isbn_no");
                    echo form_input($attribute);
                    ?>
                </div>
            </div>
            <div class = 'form-group row'>
                <label for = 'edition' class = 'col-sm-3 col-form-label'>Edition: </label>
                <div class = 'col-sm-5'>
                    <?php
                    $attribute = array(
                        "name" => "edition",
                        "id" => "edition",
                        "class" => "form-control required",
                        "title" => "",
                        "type" => "text",
                        "value" => (isset($data["edition"])) ? $data["edition"] : ""
                    );
                    echo form_error("edition");
                    echo form_input($attribute);
                    ?>
                </div>
            </div>
            <div class = 'form-group row'>
                <label for = 'bar_code' class = 'col-sm-3 col-form-label'>Bar code: </label>
                <div class = 'col-sm-5'>
                    <?php
                    $attribute = array(
                        "name" => "bar_code",
                        "id" => "bar_code",
                        "class" => "form-control required",
                        "title" => "",
                        "type" => "text",
                        "value" => (isset($data["bar_code"])) ? $data["bar_code"] : ""
                    );
                    echo form_error("bar_code");
                    echo form_input($attribute);
                    ?>
                </div>
            </div>
            <div class = 'form-group row'>
                <label for = 'qr_code' class = 'col-sm-3 col-form-label'>QR code: </label>
                <div class = 'col-sm-5'>
                    <?php
                    $attribute = array(
                        "name" => "qr_code",
                        "id" => "qr_code",
                        "class" => "form-control required",
                        "title" => "",
                        "type" => "text",
                        "value" => (isset($data["qr_code"])) ? $data["qr_code"] : ""
                    );
                    echo form_error("qr_code");
                    echo form_input($attribute);
                    ?>
                </div>
            </div>

            <div class = 'form-group row'>
                <div class = 'col-sm-2 col-sm-offset-3'>
                    <a class="text-right btn btn-default" href="<?= APP_BASE ?>library/book_ledgers/index">
                        <span class="glyphicon glyphicon-th-list"></span> Cancel
                    </a>
                </div>
                <div class = 'col-sm-3'>
                    <input type="submit" id="submit" name="submit" value="Save" class="btn btn-primary">
                </div>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('#book_ledgers').validate({
            messages: {
                book_id: 'Book name is required',
                bcategory_id: 'Book category is required',
                bpublication_id: 'Book publication is required',
                bauthor_id: 'Book author is required',
                blocation_id: 'Books location is required',
                page: 'Number of pages in books is required',
                mrp: 'MRP of book is required',
                isbn_no: 'ISBN of book is required',
                edition: 'Book edition is required',
                bar_code: 'Bar code of books is required',
                qr_code: 'QR code is required',

            }
        });
        $('#book_ledgers').on('click', '#submit', function (e) {

            if ($('#book_ledgers').valid()) {
                $('#book_ledgers').submit();
            } else {
                alert('invalid');
            }
            e.preventDefault();
        });
    });
</script>