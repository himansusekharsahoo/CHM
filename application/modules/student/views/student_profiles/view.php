<div class="col-sm-12">
    <div class = 'form-group row'>
        <label for = 'first_name' class = 'col-sm-2 col-form-label'>First name</label>
        <div class = 'col-sm-3'>
            <?= (isset($data["first_name"])) ? $data["first_name"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'last_name' class = 'col-sm-2 col-form-label'>Last name</label>
        <div class = 'col-sm-3'>
            <?= (isset($data["last_name"])) ? $data["last_name"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'user_id' class = 'col-sm-2 col-form-label'>User id</label>
        <div class = 'col-sm-3'>
            <?= (isset($data["user_id"])) ? $data["user_id"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'course_aca_batch_id' class = 'col-sm-2 col-form-label'>Course aca batch id</label>
        <div class = 'col-sm-3'>
            <?= (isset($data["course_aca_batch_id"])) ? $data["course_aca_batch_id"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'course_semister_id' class = 'col-sm-2 col-form-label'>Course semister id</label>
        <div class = 'col-sm-3'>
            <?= (isset($data["course_semister_id"])) ? $data["course_semister_id"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'photo' class = 'col-sm-2 col-form-label'>Photo</label>
        <div class = 'col-sm-3'>
            <?= (isset($data["photo"])) ? $data["photo"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'sign' class = 'col-sm-2 col-form-label'>Sign</label>
        <div class = 'col-sm-3'>
            <?= (isset($data["sign"])) ? $data["sign"] : "" ?>
        </div>
    </div>

    <div class = 'form-group row'>
        <div class = 'col-sm-1'>
            <a class="text-right btn btn-default" href="<?= APP_BASE ?>student/student_profiles/index">
                <span class="glyphicon glyphicon-th-list"></span> Cancel
            </a>
        </div>
    </div>

</div>