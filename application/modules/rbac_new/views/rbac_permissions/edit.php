<div class="col-sm-12">
    <?php
    $form_attribute = array(
        "name" => "rbac_permissions",
        "id" => "rbac_permissions",
        "method" => "POST"
    );
    $form_action = "/rbac_new/rbac_permissions/edit";
    echo form_open($form_action, $form_attribute);
    ?>
    <?php
    $attribute = array(
        "name" => "permission_id",
        "id" => "permission_id",
        "class" => "form-control",
        "title" => "",
        "required" => "",
        "type" => "hidden",
        "value" => (isset($data["permission_id"])) ? $data["permission_id"] : ""
    );
    echo form_error("permission_id");
    echo form_input($attribute);
    ?><div class = 'form-group row'>
        <label for = 'module_id' class = 'col-sm-2 col-form-label'>Module id</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "module_id",
                "id" => "module_id",
                "class" => "form-control",
                "title" => "",
                "required" => "",
            );
            $module_id = (isset($data['module_id'])) ? $data['module_id'] : '';
            echo form_error("module_id");
            echo form_dropdown($attribute, $module_id_list, $module_id);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'action_id' class = 'col-sm-2 col-form-label'>Action id</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "action_id",
                "id" => "action_id",
                "class" => "form-control",
                "title" => "",
                "required" => "",
            );
            $action_id = (isset($data['action_id'])) ? $data['action_id'] : '';
            echo form_error("action_id");
            echo form_dropdown($attribute, $action_id_list, $action_id);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'status' class = 'col-sm-2 col-form-label'>Status</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "status",
                "id" => "status",
                "class" => "form-control",
                "title" => "",
                "required" => "",
            );
            $status = (isset($data['status'])) ? $data['status'] : '';
            echo form_error("status");
            echo form_dropdown($attribute, $status_list, $status);
            ?>
        </div>
    </div>

    <div class = 'form-group row'>
        <div class = 'col-sm-1'>
            <a class="text-right btn btn-default" href="<?= APP_BASE ?>rbac_new/rbac_permissions/index">
                <span class="glyphicon glyphicon-th-list"></span> Cancel
            </a>
        </div>
        <div class = 'col-sm-1'>
            <input type="submit" id="submit" value="Update" class="btn btn-primary">
        </div>
    </div>
    <?= form_close() ?>
</div>