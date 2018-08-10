<?php ?>
<form id="save_details_form" name="save_details_form" method="post">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Menu Details</h3>
        </div>
        <div class="box-body">
            <div class="row-fluid">
                <div class="col-sm-6 no_lpad">
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Menu Name</label>
                        <div class="col-sm-8">
                            <input name="menu_name" id="menu_name" value="" class="form-control" type="text">                            
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 no_lpad">
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Menu type</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="menu_type" id="menu_type">
                                <option value="l" selected="selected">Left</option>
                                <option value="r">Right</option>
                                <option value="t">Top</option>
                                <option value="o">Other</option>
                            </select>
                        </div>
                    </div>
                </div> 
            </div>  
            <div class="row-fluid">
                <div class="col-sm-6 no_lpad">
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Permission</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="permission" id="permission">
                                <option value="">Select parent</option>
                                <option value="94">user - view</option>
                                <option value="95">user - edit</option>
                                <option value="96">user - delete</option>
                                <option value="97">user - list</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 no_lpad">
                    <div class="form-group">
                        <label class="col-sm-4 control-label">URL</label>
                        <div class="col-sm-8">
                            <input name="url" id="url" value="" class="form-control" type="text">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row-fluid">  
                <div class="col-sm-6 no_lpad">                
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Icon Class</label>
                        <div class="col-sm-8">
                            <input name="icon_class" id="icon_class" value="" class="form-control" type="text">
                        </div>
                    </div>                 
                </div>
                <div class="col-sm-6 no_lpad">
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Menu Class</label>
                        <div class="col-sm-8">
                            <input name="menu_class" id="menu_class" value="" class="form-control" type="text">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row-fluid">
                <div class="col-sm-12 no_lpad">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Attributes</label>
                        <div class="col-sm-10">
                            <input name="attribute" id="attribute" value="" class="form-control" type="text">
                        </div>
                    </div>
                </div>            
            </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <div class="pull-right">
                <button type="button" class="btn btn-default" >Cancel</button>&nbsp;&nbsp;
                <button type="button" class="btn btn-primary" id="save_menu_detail">Save</button>
            </div>
        </div>
    </div>
</form>
