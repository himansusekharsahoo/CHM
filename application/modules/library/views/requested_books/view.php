<div class="col-sm-12">
    <div class = 'form-group row'>
        <label for = 'requested_by' class = 'col-sm-2 col-form-label'>Requested by</label>
        <div class = 'col-sm-3'>
            <?= (isset($data["requested_by"])) ? $data["requested_by"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'requested_by_id' class = 'col-sm-2 col-form-label'>Requested by id</label>
        <div class = 'col-sm-3'>
            <?= (isset($data["requested_by_id"])) ? $data["requested_by_id"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'bledger_id' class = 'col-sm-2 col-form-label'>Bledger id</label>
        <div class = 'col-sm-3'>
            <?= (isset($data["bledger_id"])) ? $data["bledger_id"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'purchage_status' class = 'col-sm-2 col-form-label'>Purchage status</label>
        <div class = 'col-sm-3'>
            <?= (isset($data["purchage_status"])) ? $data["purchage_status"] : "" ?>
        </div>
    </div>

    <div class = 'form-group row'>
        <div class = 'col-sm-1'>
            <a class="text-right btn btn-default" href="<?= APP_BASE ?>library/requested_books/index">
                <span class="glyphicon glyphicon-th-list"></span> Cancel
            </a>
        </div>
    </div>

</div>