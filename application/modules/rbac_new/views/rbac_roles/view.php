<div class="col-sm-12">
    <div class = 'form-group row'>
        <label for = 'name' class = 'col-sm-2 col-form-label'>Name</label>
        <div class = 'col-sm-3'>
            <?= (isset($data["name"])) ? $data["name"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'code' class = 'col-sm-2 col-form-label'>Code</label>
        <div class = 'col-sm-3'>
            <?= (isset($data["code"])) ? $data["code"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'status' class = 'col-sm-2 col-form-label'>Status</label>
        <div class = 'col-sm-3'>
            <?= (isset($data["status"])) ? $data["status"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'created' class = 'col-sm-2 col-form-label'>Created</label>
        <div class = 'col-sm-3'>
            <?= (isset($data["created"])) ? $data["created"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'modified' class = 'col-sm-2 col-form-label'>Modified</label>
        <div class = 'col-sm-3'>
            <?= (isset($data["modified"])) ? $data["modified"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'created_by' class = 'col-sm-2 col-form-label'>Created by</label>
        <div class = 'col-sm-3'>
            <?= (isset($data["created_by"])) ? $data["created_by"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'modified_by' class = 'col-sm-2 col-form-label'>Modified by</label>
        <div class = 'col-sm-3'>
            <?= (isset($data["modified_by"])) ? $data["modified_by"] : "" ?>
        </div>
    </div>

    <div class = 'form-group row'>
        <div class = 'col-sm-1'>
            <a class="text-right btn btn-default" href="<?= APP_BASE ?>rbac_new/rbac_roles/index">
                <span class="glyphicon glyphicon-th-list"></span> Cancel
            </a>
        </div>
    </div>

</div>