<div class="col-sm-12">
    <div class = 'form-group row'>
        <label for = 'bledger_id' class = 'col-sm-2 col-form-label'>Bledger id</label>
        <div class = 'col-sm-3'>
            <?= (isset($data["bledger_id"])) ? $data["bledger_id"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'bill_number' class = 'col-sm-2 col-form-label'>Bill number</label>
        <div class = 'col-sm-3'>
            <?= (isset($data["bill_number"])) ? $data["bill_number"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'purchase_date' class = 'col-sm-2 col-form-label'>Purchase date</label>
        <div class = 'col-sm-3'>
            <?= (isset($data["purchase_date"])) ? $data["purchase_date"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'price' class = 'col-sm-2 col-form-label'>Price</label>
        <div class = 'col-sm-3'>
            <?= (isset($data["price"])) ? $data["price"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'vendor_name' class = 'col-sm-2 col-form-label'>Vendor name</label>
        <div class = 'col-sm-3'>
            <?= (isset($data["vendor_name"])) ? $data["vendor_name"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'remarks' class = 'col-sm-2 col-form-label'>Remarks</label>
        <div class = 'col-sm-3'>
            <?= (isset($data["remarks"])) ? $data["remarks"] : "" ?>
        </div>
    </div>

    <div class = 'form-group row'>
        <div class = 'col-sm-1'>
            <a class="text-right btn btn-default" href="<?= APP_BASE ?>library/book_purchage_detail_logs/index">
                <span class="glyphicon glyphicon-th-list"></span> Cancel
            </a>
        </div>
    </div>

</div>