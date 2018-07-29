<div class="col-sm-12">
<div class = 'form-group row'>
                                <label for = 'name' class = 'col-sm-2 col-form-label'>Name</label>
                                <div class = 'col-sm-3'>
                                    <?=(isset($data["name"]))?$data["name"]:""  ?>
                                </div>
                           </div>
<div class = 'form-group row'>
                                <label for = 'menu_order' class = 'col-sm-2 col-form-label'>Menu order</label>
                                <div class = 'col-sm-3'>
                                    <?=(isset($data["menu_order"]))?$data["menu_order"]:""  ?>
                                </div>
                           </div>
<div class = 'form-group row'>
                                <label for = 'parent' class = 'col-sm-2 col-form-label'>Parent</label>
                                <div class = 'col-sm-3'>
                                    <?=(isset($data["parent"]))?$data["parent"]:""  ?>
                                </div>
                           </div>
<div class = 'form-group row'>
                                <label for = 'icon_class' class = 'col-sm-2 col-form-label'>Icon class</label>
                                <div class = 'col-sm-3'>
                                    <?=(isset($data["icon_class"]))?$data["icon_class"]:""  ?>
                                </div>
                           </div>
<div class = 'form-group row'>
                                <label for = 'menu_class' class = 'col-sm-2 col-form-label'>Menu class</label>
                                <div class = 'col-sm-3'>
                                    <?=(isset($data["menu_class"]))?$data["menu_class"]:""  ?>
                                </div>
                           </div>
<div class = 'form-group row'>
                                <label for = 'attribute' class = 'col-sm-2 col-form-label'>Attribute</label>
                                <div class = 'col-sm-3'>
                                    <?=(isset($data["attribute"]))?$data["attribute"]:""  ?>
                                </div>
                           </div>
<div class = 'form-group row'>
                                <label for = 'permission_id' class = 'col-sm-2 col-form-label'>Permission id</label>
                                <div class = 'col-sm-3'>
                                    <?=(isset($data["permission_id"]))?$data["permission_id"]:""  ?>
                                </div>
                           </div>
<div class = 'form-group row'>
                                <label for = 'url' class = 'col-sm-2 col-form-label'>Url</label>
                                <div class = 'col-sm-3'>
                                    <?=(isset($data["url"]))?$data["url"]:""  ?>
                                </div>
                           </div>
<div class = 'form-group row'>
                                <label for = 'menu_type' class = 'col-sm-2 col-form-label'>Menu type</label>
                                <div class = 'col-sm-3'>
                                    <?=(isset($data["menu_type"]))?$data["menu_type"]:""  ?>
                                </div>
                           </div>
<div class = 'form-group row'>
                                <label for = 'status' class = 'col-sm-2 col-form-label'>Status</label>
                                <div class = 'col-sm-3'>
                                    <?=(isset($data["status"]))?$data["status"]:""  ?>
                                </div>
                           </div>
<div class = 'form-group row'>
                                <label for = 'created' class = 'col-sm-2 col-form-label'>Created</label>
                                <div class = 'col-sm-3'>
                                    <?=(isset($data["created"]))?$data["created"]:""  ?>
                                </div>
                           </div>
<div class = 'form-group row'>
                                <label for = 'modified' class = 'col-sm-2 col-form-label'>Modified</label>
                                <div class = 'col-sm-3'>
                                    <?=(isset($data["modified"]))?$data["modified"]:""  ?>
                                </div>
                           </div>

<div class = 'form-group row'>
<div class = 'col-sm-1'>
<a class="text-right btn btn-default" href="<?=APP_BASE?>rbac_new/rbac_menus/index">
<span class="glyphicon glyphicon-th-list"></span> Cancel
</a>
</div>
</div>

</div>