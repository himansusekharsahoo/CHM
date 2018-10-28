<div class="col-sm-12">
    <div class = 'form-group row'>
        <label for = 'category_name' class = 'col-sm-2 col-form-label'>Category name</label>
        <div class = 'col-sm-3'>
            <?= (isset($data["category_name"])) ? $data["category_name"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'category_code' class = 'col-sm-2 col-form-label'>Category code</label>
        <div class = 'col-sm-3'>
            <?= (isset($data["category_code"])) ? $data["category_code"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'category_parent_id' class = 'col-sm-2 col-form-label'>Category parent id</label>
        <div class = 'col-sm-3'>
            <?= (isset($data["category_parent_id"])) ? $data["category_parent_id"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'publication_name' class = 'col-sm-2 col-form-label'>Publication name</label>
        <div class = 'col-sm-3'>
            <?= (isset($data["publication_name"])) ? $data["publication_name"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'publication_code' class = 'col-sm-2 col-form-label'>Publication code</label>
        <div class = 'col-sm-3'>
            <?= (isset($data["publication_code"])) ? $data["publication_code"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'publication_remarks' class = 'col-sm-2 col-form-label'>Publication remarks</label>
        <div class = 'col-sm-3'>
            <?= (isset($data["publication_remarks"])) ? $data["publication_remarks"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'author_name' class = 'col-sm-2 col-form-label'>Author name</label>
        <div class = 'col-sm-3'>
            <?= (isset($data["author_name"])) ? $data["author_name"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'author_remarks' class = 'col-sm-2 col-form-label'>Author remarks</label>
        <div class = 'col-sm-3'>
            <?= (isset($data["author_remarks"])) ? $data["author_remarks"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'location_floor' class = 'col-sm-2 col-form-label'>Location floor</label>
        <div class = 'col-sm-3'>
            <?= (isset($data["location_floor"])) ? $data["location_floor"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'location_block' class = 'col-sm-2 col-form-label'>Location block</label>
        <div class = 'col-sm-3'>
            <?= (isset($data["location_block"])) ? $data["location_block"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'location_rack_no' class = 'col-sm-2 col-form-label'>Location rack no</label>
        <div class = 'col-sm-3'>
            <?= (isset($data["location_rack_no"])) ? $data["location_rack_no"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'location_self_no' class = 'col-sm-2 col-form-label'>Location self no</label>
        <div class = 'col-sm-3'>
            <?= (isset($data["location_self_no"])) ? $data["location_self_no"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'ledger_id' class = 'col-sm-2 col-form-label'>Ledger id</label>
        <div class = 'col-sm-3'>
            <?= (isset($data["ledger_id"])) ? $data["ledger_id"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'ledger_page' class = 'col-sm-2 col-form-label'>Ledger page</label>
        <div class = 'col-sm-3'>
            <?= (isset($data["ledger_page"])) ? $data["ledger_page"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'ledger_mrp' class = 'col-sm-2 col-form-label'>Ledger mrp</label>
        <div class = 'col-sm-3'>
            <?= (isset($data["ledger_mrp"])) ? $data["ledger_mrp"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'ledger_isbn' class = 'col-sm-2 col-form-label'>Ledger isbn</label>
        <div class = 'col-sm-3'>
            <?= (isset($data["ledger_isbn"])) ? $data["ledger_isbn"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'ledger_edition' class = 'col-sm-2 col-form-label'>Ledger edition</label>
        <div class = 'col-sm-3'>
            <?= (isset($data["ledger_edition"])) ? $data["ledger_edition"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'ledger_bar_code' class = 'col-sm-2 col-form-label'>Ledger bar code</label>
        <div class = 'col-sm-3'>
            <?= (isset($data["ledger_bar_code"])) ? $data["ledger_bar_code"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'ledger_qr_code' class = 'col-sm-2 col-form-label'>Ledger qr code</label>
        <div class = 'col-sm-3'>
            <?= (isset($data["ledger_qr_code"])) ? $data["ledger_qr_code"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'ledger_created' class = 'col-sm-2 col-form-label'>Ledger created</label>
        <div class = 'col-sm-3'>
            <?= (isset($data["ledger_created"])) ? $data["ledger_created"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'ledger_created_by' class = 'col-sm-2 col-form-label'>Ledger created by</label>
        <div class = 'col-sm-3'>
            <?= (isset($data["ledger_created_by"])) ? $data["ledger_created_by"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'ledger_modified' class = 'col-sm-2 col-form-label'>Ledger modified</label>
        <div class = 'col-sm-3'>
            <?= (isset($data["ledger_modified"])) ? $data["ledger_modified"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'ledger_modified_by' class = 'col-sm-2 col-form-label'>Ledger modified by</label>
        <div class = 'col-sm-3'>
            <?= (isset($data["ledger_modified_by"])) ? $data["ledger_modified_by"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'book_id' class = 'col-sm-2 col-form-label'>Book id</label>
        <div class = 'col-sm-3'>
            <?= (isset($data["book_id"])) ? $data["book_id"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'book_name' class = 'col-sm-2 col-form-label'>Book name</label>
        <div class = 'col-sm-3'>
            <?= (isset($data["book_name"])) ? $data["book_name"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'book_code' class = 'col-sm-2 col-form-label'>Book code</label>
        <div class = 'col-sm-3'>
            <?= (isset($data["book_code"])) ? $data["book_code"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'book_status' class = 'col-sm-2 col-form-label'>Book status</label>
        <div class = 'col-sm-3'>
            <?= (isset($data["book_status"])) ? $data["book_status"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'book_created' class = 'col-sm-2 col-form-label'>Book created</label>
        <div class = 'col-sm-3'>
            <?= (isset($data["book_created"])) ? $data["book_created"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'book_created_by' class = 'col-sm-2 col-form-label'>Book created by</label>
        <div class = 'col-sm-3'>
            <?= (isset($data["book_created_by"])) ? $data["book_created_by"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'book_modified' class = 'col-sm-2 col-form-label'>Book modified</label>
        <div class = 'col-sm-3'>
            <?= (isset($data["book_modified"])) ? $data["book_modified"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'book_modified_by' class = 'col-sm-2 col-form-label'>Book modified by</label>
        <div class = 'col-sm-3'>
            <?= (isset($data["book_modified_by"])) ? $data["book_modified_by"] : "" ?>
        </div>
    </div>

    <div class = 'form-group row'>
        <div class = 'col-sm-1'>
            <a class="text-right btn btn-default" href="<?= APP_BASE ?>library/book_logs/index">
                <span class="glyphicon glyphicon-th-list"></span> Cancel
            </a>
        </div>
    </div>

</div>