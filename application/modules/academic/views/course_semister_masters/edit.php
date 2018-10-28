<div class="col-sm-12">
 <?php $form_attribute = array(
                "name" => "course_semister_master",
                "id" => "course_semister_master",
                "method" => "POST"
            );
$form_action= "/academic/course_semister_masters/edit";
 echo form_open($form_action, $form_attribute); ?>
<?php $attribute=array(
                "name" =>"semister_id",
                "id" => "semister_id",
                "class" => "form-control",
                "title" => "",
"required"=>"", 
"type"=>"hidden", 
"value" => (isset($data["semister_id"]))?$data["semister_id"]:""
); 
echo form_error("semister_id"); echo form_input($attribute); ?><div class = 'form-group row'>
                                <label for = 'name' class = 'col-sm-2 col-form-label'>Name</label>
                                <div class = 'col-sm-3'>
                                    <?php $attribute=array(
                "name" =>"name",
                "id" => "name",
                "class" => "form-control",
                "title" => "",
"required"=>"", 
"type"=>"text", 
"value" => (isset($data["name"]))?$data["name"]:""
); 
echo form_error("name"); echo form_input($attribute); ?>
                                </div>
                           </div>
<div class = 'form-group row'>
                                <label for = 'code' class = 'col-sm-2 col-form-label'>Code</label>
                                <div class = 'col-sm-3'>
                                    <?php $attribute=array(
                "name" =>"code",
                "id" => "code",
                "class" => "form-control",
                "title" => "",
"required"=>"", 
"type"=>"text", 
"value" => (isset($data["code"]))?$data["code"]:""
); 
echo form_error("code"); echo form_input($attribute); ?>
                                </div>
                           </div>

<div class = 'form-group row'>
<div class = 'col-sm-1'>
<a class="text-right btn btn-default" href="<?=APP_BASE?>academic/course_semister_masters/index">
<span class="glyphicon glyphicon-th-list"></span> Cancel
</a>
</div>
<div class = 'col-sm-1'>
<input type="submit" id="submit" value="Update" class="btn btn-primary">
</div>
</div>
 <?= form_close() ?>
</div>