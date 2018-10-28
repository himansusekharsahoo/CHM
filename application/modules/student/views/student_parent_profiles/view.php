<div class="col-sm-12">
    <div class = 'form-group row'>
        <label for = 'student_user_id' class = 'col-sm-2 col-form-label'>Student user id</label>
        <div class = 'col-sm-3'>
            <?= (isset($data["student_user_id"])) ? $data["student_user_id"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'father_name' class = 'col-sm-2 col-form-label'>Father name</label>
        <div class = 'col-sm-3'>
            <?= (isset($data["father_name"])) ? $data["father_name"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'mother_name' class = 'col-sm-2 col-form-label'>Mother name</label>
        <div class = 'col-sm-3'>
            <?= (isset($data["mother_name"])) ? $data["mother_name"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'spouse_name' class = 'col-sm-2 col-form-label'>Spouse name</label>
        <div class = 'col-sm-3'>
            <?= (isset($data["spouse_name"])) ? $data["spouse_name"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'contact_no' class = 'col-sm-2 col-form-label'>Contact no</label>
        <div class = 'col-sm-3'>
            <?= (isset($data["contact_no"])) ? $data["contact_no"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'emergency_contact_no' class = 'col-sm-2 col-form-label'>Emergency contact no</label>
        <div class = 'col-sm-3'>
            <?= (isset($data["emergency_contact_no"])) ? $data["emergency_contact_no"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'email_id' class = 'col-sm-2 col-form-label'>Email id</label>
        <div class = 'col-sm-3'>
            <?= (isset($data["email_id"])) ? $data["email_id"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'address' class = 'col-sm-2 col-form-label'>Address</label>
        <div class = 'col-sm-3'>
            <?= (isset($data["address"])) ? $data["address"] : "" ?>
        </div>
    </div>

    <div class = 'form-group row'>
        <div class = 'col-sm-1'>
            <a class="text-right btn btn-default" href="<?= APP_BASE ?>student/student_parent_profiles/index">
                <span class="glyphicon glyphicon-th-list"></span> Cancel
            </a>
        </div>
    </div>

</div>