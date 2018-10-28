<div class="col-sm-12">
    <div class = 'form-group row'>
        <label for = 'name' class = 'col-sm-2 col-form-label'>Name</label>
        <div class = 'col-sm-3'>
            <?= (isset($data["name"])) ? $data["name"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'description' class = 'col-sm-2 col-form-label'>Description</label>
        <div class = 'col-sm-3'>
            <?= (isset($data["description"])) ? $data["description"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'start_year' class = 'col-sm-2 col-form-label'>Start year</label>
        <div class = 'col-sm-3'>
            <?= (isset($data["start_year"])) ? $data["start_year"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'end_year' class = 'col-sm-2 col-form-label'>End year</label>
        <div class = 'col-sm-3'>
            <?= (isset($data["end_year"])) ? $data["end_year"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'terms' class = 'col-sm-2 col-form-label'>Terms</label>
        <div class = 'col-sm-3'>
            <?= (isset($data["terms"])) ? $data["terms"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'course_dept_id' class = 'col-sm-2 col-form-label'>Course dept id</label>
        <div class = 'col-sm-3'>
            <?= (isset($data["course_dept_id"])) ? $data["course_dept_id"] : "" ?>
        </div>
    </div>

    <div class = 'form-group row'>
        <div class = 'col-sm-1'>
            <a class="text-right btn btn-default" href="<?= APP_BASE ?>academic/course_aca_batch_masters/index">
                <span class="glyphicon glyphicon-th-list"></span> Cancel
            </a>
        </div>
    </div>

</div>