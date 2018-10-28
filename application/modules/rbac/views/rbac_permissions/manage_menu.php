<div class="row-fluid">
    <form class="form-horizontal" action="#" name="manage_menu_form" id="manage_menu_form" method="post">
        <div class="row-fluid">
            <div class="col-sm-4" style="padding-left: 0px;">
                <label for="menu_module_id" class="col-sm-3">Modules</label>        
                <div class="col-sm-9" id="menu_module_id_div">
                    <select name="menu_module_id[]" multiple id="menu_module_id" class="multiple form-control">
                        <?php
                        foreach ($module_list as $key => $val) {
                            echo "<option value=\"$key\">$val</option>";
                        }
                        ?>
                    </select>                    
                </div>
            </div>
            <div class="col-sm-4" style="padding-left: 0px;">
                <input class="btn btn-success" type="button" id="show_menu_actions" value="Show">           
            </div>
        </div>
        <br><br>    
        <div class="row" id="manage_menu_table" style="margin-left: 4px;">

        </div>
        <br>
        <div class="row-fluid">
            <input class="btn btn-primary" type="submit" name="save_menu_table" id="save_menu_table" value="Save">
        </div>
    </form>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        //$(".chosen-select").chosen({no_results_text: "Oops, nothing found!"});
        $('.multiple').multiselect({
            columns: 1,
            placeholder: 'Select Table',
            search: true,
            selectAll: true
        });
    });
</script>