<div class="col-sm-12">
    <?php
    $form_attribute = array(
        "name" => "academic_courses",
        "id" => "academic_courses",
        "method" => "POST"
    );
    $form_action = "/academic/academic_courses/create";
    echo form_open($form_action, $form_attribute);
    ?>
    <div class = 'form-group row'>
        <label for = 'course_id' class = 'col-sm-2 col-form-label'>Course id</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "course_id",
                "id" => "course_id",
                "class" => "form-control",
                "title" => "",
                "required" => "",
            );
            $course_id = (isset($data['course_id'])) ? $data['course_id'] : '';
            echo form_error("course_id");
            echo form_dropdown($attribute, $course_id_list, $course_id);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'semister_id' class = 'col-sm-2 col-form-label'>Semister id</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "semister_id",
                "id" => "semister_id",
                "class" => "form-control",
                "title" => "",
                "required" => "",
            );
            $semister_id = (isset($data['semister_id'])) ? $data['semister_id'] : '';
            echo form_error("semister_id");
            echo form_dropdown($attribute, $semister_id_list, $semister_id);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'course_aca_batch_id' class = 'col-sm-2 col-form-label'>Course aca batch id</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "course_aca_batch_id",
                "id" => "course_aca_batch_id",
                "class" => "form-control",
                "title" => "",
                "required" => "",
            );
            $course_aca_batch_id = (isset($data['course_aca_batch_id'])) ? $data['course_aca_batch_id'] : '';
            echo form_error("course_aca_batch_id");
            echo form_dropdown($attribute, $course_aca_batch_id_list, $course_aca_batch_id);
            ?>
        </div>
    </div>

    <div class = 'form-group row'>
        <div class = 'col-sm-1'>
            <a class="text-right btn btn-default" href="<?= APP_BASE ?>academic/academic_courses/index">
                <span class="glyphicon glyphicon-th-list"></span> Cancel
            </a>
        </div>
        <div class = 'col-sm-1'>
            <input type="submit" id="submit" value="Save" class="btn btn-primary">
        </div>
    </div>
    <?= form_close() ?>
</div>