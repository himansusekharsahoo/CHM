<div class="col-sm-10 no_pad">
    <div class="row">
        <div class="col-sm-6">
            <label for = 'user_name' class = 'col-sm-4 col-form-label'>Name</label>
            <div class = 'col-sm-8'>
                <?= (isset($data["user_name"])) ? ucfirst($data["user_name"]) : "" ?>
            </div>
        </div>
        <div class="col-sm-6">
            <label for = 'card_no' class = 'col-sm-4 col-form-label'>Card no.</label>
            <div class = 'col-sm-8'>
                <?= (isset($data["card_no"])) ? $data["card_no"] : "" ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <label for = 'date_issue' class = 'col-sm-4 col-form-label'>Date issue</label>
            <div class = 'col-sm-8'>
                <?= (isset($data["date_issue"])) ? $data["date_issue"] : "" ?>
            </div>
        </div>
        <div class="col-sm-6">
            <label for = 'expiry_date' class = 'col-sm-4 col-form-label'>Expiry date</label>
            <div class = 'col-sm-8'>
                <?= (isset($data["expiry_date"])) ? $data["expiry_date"] : "" ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <label for = 'email' class = 'col-sm-4 col-form-label'>Email</label>
            <div class = 'col-sm-8'>
                <?= (isset($data["email"])) ? $data["email"] : "" ?>
            </div>
        </div>
        <div class="col-sm-6">
            <label for = 'mobile' class = 'col-sm-4 col-form-label'>Mobile</label>
            <div class = 'col-sm-8'>
                <?= (isset($data["mobile"])) ? $data["mobile"] : "" ?>
            </div>
        </div>
    </div>   
    <div class="row">
        <div class="col-sm-6">
            <label for = 'user_type' class = 'col-sm-4 col-form-label'>User type</label>
            <div class = 'col-sm-8'>
                <?= (isset($data["user_type"])) ? $data["user_type"] : "" ?>
            </div>
        </div>
        <div class="col-sm-6">
            <label for = 'code_list' class = 'col-sm-4 col-form-label'>User roles</label>
            <div class = 'col-sm-8'>
                <?= (isset($data["code_list"])) ? rtrim($data["code_list"],',') : "" ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <label for = 'created_by_name' class = 'col-sm-4 col-form-label'>Created by</label>
            <div class = 'col-sm-8'>
                <?= (isset($data["created_by_name"])) ? ucfirst($data["created_by_name"]) : "" ?>
            </div>
        </div>
        <div class="col-sm-6">
            <label for = 'status' class = 'col-sm-4 col-form-label'>Status</label>
            <div class = 'col-sm-8'>
                <?= (isset($data["status"])) ? ucfirst(rtrim($data["status"],',')) : "" ?>
            </div>
        </div>
    </div>
    <div class = 'form-group row'>
        <div class = 'col-sm-1'>
            <a class="text-right btn btn-default" href="<?= base_url('library-users') ?>">
                <span class="glyphicon glyphicon-th-list"></span> Cancel
            </a>
        </div>
    </div>

</div>