<div class="col-sm-12">
    <div class = 'form-group row'>
        <label for = 'book_id' class = 'col-sm-2 col-form-label'>Book id</label>
        <div class = 'col-sm-3'>
            <?= (isset($data["book_id"])) ? $data["book_id"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'bcategory_id' class = 'col-sm-2 col-form-label'>Bcategory id</label>
        <div class = 'col-sm-3'>
            <?= (isset($data["bcategory_id"])) ? $data["bcategory_id"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'bpublication_id' class = 'col-sm-2 col-form-label'>Bpublication id</label>
        <div class = 'col-sm-3'>
            <?= (isset($data["bpublication_id"])) ? $data["bpublication_id"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'bauthor_id' class = 'col-sm-2 col-form-label'>Bauthor id</label>
        <div class = 'col-sm-3'>
            <?= (isset($data["bauthor_id"])) ? $data["bauthor_id"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'blocation_id' class = 'col-sm-2 col-form-label'>Blocation id</label>
        <div class = 'col-sm-3'>
            <?= (isset($data["blocation_id"])) ? $data["blocation_id"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'page' class = 'col-sm-2 col-form-label'>Page</label>
        <div class = 'col-sm-3'>
            <?= (isset($data["page"])) ? $data["page"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'mrp' class = 'col-sm-2 col-form-label'>Mrp</label>
        <div class = 'col-sm-3'>
            <?= (isset($data["mrp"])) ? $data["mrp"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'isbn_no' class = 'col-sm-2 col-form-label'>Isbn no</label>
        <div class = 'col-sm-3'>
            <?= (isset($data["isbn_no"])) ? $data["isbn_no"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'edition' class = 'col-sm-2 col-form-label'>Edition</label>
        <div class = 'col-sm-3'>
            <?= (isset($data["edition"])) ? $data["edition"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'bar_code' class = 'col-sm-2 col-form-label'>Bar code</label>
        <div class = 'col-sm-3'>
            <?= (isset($data["bar_code"])) ? $data["bar_code"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'qr_code' class = 'col-sm-2 col-form-label'>Qr code</label>
        <div class = 'col-sm-3'>
            <?= (isset($data["qr_code"])) ? $data["qr_code"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'midified_by' class = 'col-sm-2 col-form-label'>Midified by</label>
        <div class = 'col-sm-3'>
            <?= (isset($data["midified_by"])) ? $data["midified_by"] : "" ?>
        </div>
    </div>

    <div class = 'form-group row'>
        <div class = 'col-sm-1'>
            <a class="text-right btn btn-default" href="<?= APP_BASE ?>library/book_ledgers/index">
                <span class="glyphicon glyphicon-th-list"></span> Cancel
            </a>
        </div>
    </div>

</div>