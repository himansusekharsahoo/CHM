<div class="col-sm-12">
    <div class = 'form-group row'>
        <label for = 'card_no' class = 'col-sm-2 col-form-label'>Card no</label>
        <div class = 'col-sm-3'>
            <?= (isset($data["card_no"])) ? $data["card_no"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'date_issue' class = 'col-sm-2 col-form-label'>Date issue</label>
        <div class = 'col-sm-3'>
            <?= (isset($data["date_issue"])) ? $data["date_issue"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'expiry_date' class = 'col-sm-2 col-form-label'>Expiry date</label>
        <div class = 'col-sm-3'>
            <?= (isset($data["expiry_date"])) ? $data["expiry_date"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'user_id' class = 'col-sm-2 col-form-label'>User id</label>
        <div class = 'col-sm-3'>
            <?= (isset($data["user_id"])) ? $data["user_id"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'role_name' class = 'col-sm-2 col-form-label'>User role</label>
        <div class = 'col-sm-3'>
            <?= (isset($data["role_name"])) ? $data["role_name"] : "" ?>
        </div>
    </div>

    <div class = 'form-group row'>
        <div class = 'col-sm-1'>
            <a class="text-right btn btn-default" href="<?= APP_BASE ?>library-members">
                <span class="glyphicon glyphicon-th-list"></span> Cancel
            </a>
        </div>
    </div>

</div>