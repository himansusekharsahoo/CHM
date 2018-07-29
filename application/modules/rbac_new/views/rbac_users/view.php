<div class="col-sm-12">
<div class = 'form-group row'>
                                <label for = 'first_name' class = 'col-sm-2 col-form-label'>First name</label>
                                <div class = 'col-sm-3'>
                                    <?=(isset($data["first_name"]))?$data["first_name"]:""  ?>
                                </div>
                           </div>
<div class = 'form-group row'>
                                <label for = 'last_name' class = 'col-sm-2 col-form-label'>Last name</label>
                                <div class = 'col-sm-3'>
                                    <?=(isset($data["last_name"]))?$data["last_name"]:""  ?>
                                </div>
                           </div>
<div class = 'form-group row'>
                                <label for = 'login_id' class = 'col-sm-2 col-form-label'>Login id</label>
                                <div class = 'col-sm-3'>
                                    <?=(isset($data["login_id"]))?$data["login_id"]:""  ?>
                                </div>
                           </div>
<div class = 'form-group row'>
                                <label for = 'email' class = 'col-sm-2 col-form-label'>Email</label>
                                <div class = 'col-sm-3'>
                                    <?=(isset($data["email"]))?$data["email"]:""  ?>
                                </div>
                           </div>
<div class = 'form-group row'>
                                <label for = 'password' class = 'col-sm-2 col-form-label'>Password</label>
                                <div class = 'col-sm-3'>
                                    <?=(isset($data["password"]))?$data["password"]:""  ?>
                                </div>
                           </div>
<div class = 'form-group row'>
                                <label for = 'login_status' class = 'col-sm-2 col-form-label'>Login status</label>
                                <div class = 'col-sm-3'>
                                    <?=(isset($data["login_status"]))?$data["login_status"]:""  ?>
                                </div>
                           </div>
<div class = 'form-group row'>
                                <label for = 'mobile' class = 'col-sm-2 col-form-label'>Mobile</label>
                                <div class = 'col-sm-3'>
                                    <?=(isset($data["mobile"]))?$data["mobile"]:""  ?>
                                </div>
                           </div>
<div class = 'form-group row'>
                                <label for = 'mobile_verified' class = 'col-sm-2 col-form-label'>Mobile verified</label>
                                <div class = 'col-sm-3'>
                                    <?=(isset($data["mobile_verified"]))?$data["mobile_verified"]:""  ?>
                                </div>
                           </div>
<div class = 'form-group row'>
                                <label for = 'emial_verified' class = 'col-sm-2 col-form-label'>Emial verified</label>
                                <div class = 'col-sm-3'>
                                    <?=(isset($data["emial_verified"]))?$data["emial_verified"]:""  ?>
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
                                <label for = 'created_by' class = 'col-sm-2 col-form-label'>Created by</label>
                                <div class = 'col-sm-3'>
                                    <?=(isset($data["created_by"]))?$data["created_by"]:""  ?>
                                </div>
                           </div>
<div class = 'form-group row'>
                                <label for = 'modified_by' class = 'col-sm-2 col-form-label'>Modified by</label>
                                <div class = 'col-sm-3'>
                                    <?=(isset($data["modified_by"]))?$data["modified_by"]:""  ?>
                                </div>
                           </div>
<div class = 'form-group row'>
                                <label for = 'status' class = 'col-sm-2 col-form-label'>Status</label>
                                <div class = 'col-sm-3'>
                                    <?=(isset($data["status"]))?$data["status"]:""  ?>
                                </div>
                           </div>

<div class = 'form-group row'>
<div class = 'col-sm-1'>
<a class="text-right btn btn-default" href="<?=APP_BASE?>rbac_new/rbac_users/index">
<span class="glyphicon glyphicon-th-list"></span> Cancel
</a>
</div>
</div>

</div>