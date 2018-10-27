<div class="col-sm-12">
    <?php
    $form_attribute = array(
        "name" => "rbac_menu",
        "id" => "rbac_menu",
        "method" => "POST"
    );
    $form_action = "/rbac_new/rbac_menus/create";
    echo form_open($form_action, $form_attribute);
    ?>
    <div class = 'form-group row'>
        <label for = 'name' class = 'col-sm-2 col-form-label'>Name</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "name",
                "id" => "name",
                "class" => "form-control",
                "title" => "",
                "required" => "",
                "type" => "text",
                "value" => (isset($data["name"])) ? $data["name"] : ""
            );
            echo form_error("name");
            echo form_input($attribute);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'menu_order' class = 'col-sm-2 col-form-label'>Menu order</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "menu_order",
                "id" => "menu_order",
                "class" => "form-control",
                "title" => "",
                "required" => "",
                "type" => "number",
                "value" => (isset($data["menu_order"])) ? $data["menu_order"] : ""
            );
            echo form_error("menu_order");
            echo form_input($attribute);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'parent' class = 'col-sm-2 col-form-label'>Parent</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "parent",
                "id" => "parent",
                "class" => "form-control",
                "title" => "",
                "required" => "",
                "type" => "number",
                "value" => (isset($data["parent"])) ? $data["parent"] : ""
            );
            echo form_error("parent");
            echo form_input($attribute);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'icon_class' class = 'col-sm-2 col-form-label'>Icon class</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "icon_class",
                "id" => "icon_class",
                "class" => "form-control",
                "title" => "",
                "required" => "",
                "type" => "text",
                "value" => (isset($data["icon_class"])) ? $data["icon_class"] : ""
            );
            echo form_error("icon_class");
            echo form_input($attribute);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'menu_class' class = 'col-sm-2 col-form-label'>Menu class</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "menu_class",
                "id" => "menu_class",
                "class" => "form-control",
                "title" => "",
                "required" => "",
                "type" => "text",
                "value" => (isset($data["menu_class"])) ? $data["menu_class"] : ""
            );
            echo form_error("menu_class");
            echo form_input($attribute);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'attribute' class = 'col-sm-2 col-form-label'>Attribute</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "attribute",
                "id" => "attribute",
                "class" => "form-control",
                "title" => "",
                "required" => "",
                "type" => "text",
                "value" => (isset($data["attribute"])) ? $data["attribute"] : ""
            );
            echo form_error("attribute");
            echo form_input($attribute);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'permission_id' class = 'col-sm-2 col-form-label'>Permission id</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "permission_id",
                "id" => "permission_id",
                "class" => "form-control",
                "title" => "",
                "required" => "",
                "type" => "number",
                "value" => (isset($data["permission_id"])) ? $data["permission_id"] : ""
            );
            echo form_error("permission_id");
            echo form_input($attribute);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'url' class = 'col-sm-2 col-form-label'>Url</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "url",
                "id" => "url",
                "class" => "form-control",
                "title" => "",
                "required" => "",
                "type" => "text",
                "value" => (isset($data["url"])) ? $data["url"] : ""
            );
            echo form_error("url");
            echo form_input($attribute);
            ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'menu_type' class = 'col-sm-2 col-form-label'>Menu type</label>
        <div class = 'col-sm-3'>
            <?php
            $attribute = array(
                "name" => "menu_type",
                "id" => "menu_type",
                "class" => "form-control",
                "title" => "",
                "required" => "",
            );
            $menu_type = (isset($data['menu_type'])) ? $data['menu_type'] : '';
            echo form_error("menu_type");
            echo form_dropdown($attribute, $menu_type_list, $menu_type);
            ?>
        </div>
    </div>

    <div class = 'form-group row'>
        <div class = 'col-sm-1'>
            <a class="text-right btn btn-default" href="<?php echo APP_BASE ?>rbac_new/rbac_menus/index">
                <span class="glyphicon glyphicon-th-list"></span> Cancel
            </a>
        </div>
        <div class = 'col-sm-1'>
            <input type="submit" id="submit" value="Save" class="btn btn-primary">
        </div>
    </div>
    <?php echo form_close() ?>
</div>