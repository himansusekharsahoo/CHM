<div class="col-sm-12">
    <div class = 'form-group row'>
        <label for = 'course_id' class = 'col-sm-2 col-form-label'>Course id</label>
        <div class = 'col-sm-3'>
            <?= (isset($data["course_id"])) ? $data["course_id"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'semister_id' class = 'col-sm-2 col-form-label'>Semister id</label>
        <div class = 'col-sm-3'>
            <?= (isset($data["semister_id"])) ? $data["semister_id"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'course_aca_batch_id' class = 'col-sm-2 col-form-label'>Course aca batch id</label>
        <div class = 'col-sm-3'>
            <?= (isset($data["course_aca_batch_id"])) ? $data["course_aca_batch_id"] : "" ?>
        </div>
    </div>

    <div class = 'form-group row'>
        <div class = 'col-sm-1'>
            <a class="text-right btn btn-default" href="<?= APP_BASE ?>academic/academic_courses/index">
                <span class="glyphicon glyphicon-th-list"></span> Cancel
            </a>
        </div>
    </div>

</div>