<style>
    .label_adj{
        padding: 4px 0px 0px 5px;
        padding-to:4px;
    }
    .fieldset_hold{
        border:1px solid gray !important;
    }
    .legend_hold{
        widht:auto !important;
    }
</style>
<?php
$form_attribute = array(
    "name" => "app_config",
    "id" => "app_config",
    "method" => "POST"
);
$form_action = base_url('save-app-configs');
echo form_open($form_action, $form_attribute);
?>
<div class="row">
    <div class="col-sm-12">
        <div class="box box-default  collapsed-box col-sm-10">
            <div class="box-header with-border" data-widget="collapse">
                <h3 class="box-title">Library Configurations</h3>                    
                <div class="box-tools pull-right">                        
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>                        
                </div>
                <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="display: none;">
                <div class="row">
                    <label class = 'col-sm-5 col-form-label no_pad'>Role based configuration</label>
                </div>
                <div class="box box-warning collapsed-box row">
                    <div class="box-header with-border" data-widget="collapse">
                        <h3 class="box-title">Default</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                            </button>
                        </div>
                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body" style="display: none;">                            
                        <div class = 'form-group row'>
                            <div class="col-sm-3 no_rpad">
                                <label class = 'col-sm-7 col-form-label no_pad'>Max assigned book</label>
                                <div class = 'col-sm-5 no_pad'>
                                    <?php
                                    $attribute = array(
                                        "name" => "app_configs_category",
                                        "id" => "default_app_configs_category",
                                        "class" => "form-control",
                                        "type" => "hidden",
                                        "value" => 'LIBRARY'
                                    );
                                    echo form_input($attribute);
                                    $attribute = array(
                                        "name" => "app_configs[library][role_config][default][max_assigned_book]",
                                        "id" => "max_assigned_book",
                                        "class" => "form-control",
                                        "title" => "Maximum assigned book",
                                        "type" => "number",
                                        "min" => 1,
                                        "placeholder" => "Maximum assigned book",
                                        "value" => (isset($data['library']['role_config']['default']['max_assigned_book'])) ? $data['library']['role_config']['default']['max_assigned_book'] : '1'
                                    );
                                    echo form_input($attribute);
                                    ?>
                                </div>
                            </div>
                            <div class="col-sm-3 no_rpad">
                                <label class = 'col-sm-7 col-form-label no_pad'>Return books within</label>
                                <div class = 'col-sm-5 no_pad'>
                                    <?php
                                    $attribute = array(
                                        "name" => "app_configs[library][role_config][default][return_book_after_days]",
                                        "id" => "default_return_book_after_days",
                                        "class" => "form-control",
                                        "title" => "Book shoud be returned within specified days",
                                        "type" => "number",
                                        "min" => 5,
                                        "placeholder" => "Book shoud be returned within specified days",
                                        "value" => (isset($data['library']['role_config']['default']['return_book_after_days'])) ? $data['library']['role_config']['default']['return_book_after_days'] : '5'
                                    );
                                    echo form_input($attribute);
                                    ?>
                                </div>
                            </div>
                            <div class="col-sm-3 no_rpad">
                                <label class = 'col-sm-7 col-form-label no_pad'>Return delay fine</label>
                                <div class = 'col-sm-5 no_pad'>
                                    <?php
                                    $attribute = array(
                                        "name" => "app_configs[library][role_config][default][return_delay_fine]",
                                        "id" => "default_return_delay_fine",
                                        "class" => "form-control",
                                        "title" => "Book return delay fine per day.",
                                        "type" => "number",
                                        "min" => 1,
                                        "placeholder" => "Book return delay fine per day",
                                        "value" => (isset($data['library']['role_config']['default']['return_delay_fine'])) ? $data['library']['role_config']['default']['return_delay_fine'] : '1'
                                    );
                                    echo form_input($attribute);
                                    ?>                                        
                                </div>
                            </div>                                
                            <div class="col-sm-3 no_rpad">
                                <label class = 'col-sm-7 col-form-label no_pad'>Book lost fine</label>
                                <div class = 'col-sm-5 no_pad'>
                                    <?php
                                    $attribute = array(
                                        "name" => "app_configs[library][role_config][default][book_lost_fine]",
                                        "id" => "default_book_lost_fine",
                                        "class" => "form-control",
                                        "title" => "Default book lost fine.",
                                        "type" => "number",
                                        "min" => 50,
                                        "placeholder" => "Book lost fine",
                                        "value" => (isset($data['library']['role_config']['default']['book_lost_fine'])) ? $data['library']['role_config']['default']['book_lost_fine'] : '50'
                                    );
                                    echo form_input($attribute);
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class = 'form-group row'>
                            <div class="col-sm-3 no_rpad">
                                <label class = 'col-sm-7 col-form-label no_pad'>Registration No. Prefix</label>
                                <div class = 'col-sm-5 no_pad'>
                                    <?php
                                    $attribute = array(
                                        "name" => "app_configs[library][lib_card_num_prefix]",
                                        "id" => "lib_card_num_prefix",
                                        "class" => "form-control",
                                        "title" => "Library card no pre-fix",
                                        "type" => "text",
                                        "placeholder" => "Library card no pre-fix",
                                        "value" => (isset($data['library']['lib_card_num_prefix'])) ? $data['library']['lib_card_num_prefix'] : 'USR'
                                    );
                                    echo form_input($attribute);
                                    ?>
                                </div>
                            </div>
                            <div class="col-sm-3 no_rpad">
                                <label class = 'col-sm-7 col-form-label no_pad'>Registration No. Zero Prefix</label>
                                <div class = 'col-sm-5 no_pad'>
                                    <?php
                                    $attribute = array(
                                        "name" => "app_configs[library][lib_card_num_zero_prefix]",
                                        "id" => "lib_card_num_zero_prefix",
                                        "class" => "form-control",
                                        "title" => "Library card no pre-fix",
                                        "type" => "text",
                                        "placeholder" => "Library card no pre-fix",
                                        "value" => (isset($data['library']['lib_card_num_zero_prefix'])) ? $data['library']['lib_card_num_zero_prefix'] : 5
                                    );
                                    echo form_input($attribute);
                                    ?>
                                </div>
                            </div>
                            <div class="col-sm-3 no_rpad">
                                <label class = 'col-sm-7 col-form-label no_pad'>I-card validity</label>
                                <div class = 'col-sm-5 no_pad'>                                    
                                    <?php
                                    $month_list = array(
                                        1 => '1 Month',2 => '2 Months',3 => '3 Months',
                                        4 => '4 Months',5 => '5 Months',6 => '6 Months',
                                        7 => '7 Months',8 => '8 Months',9 => '9 Months',
                                        10 => '10 Months',11 => '11 Months',12 => '1 Year',
                                        24 => '2 Years',36 => '3 Years',48 => '4 Years',
                                        60 => '5 Years',100 => 'Life time'
                                    );//100 means life time
                                    $attribute = array(
                                        "name" => "app_configs[library][lib_card_expire_month]",
                                        "id" => "lib_card_num_prefix",
                                        "class" => "form-control",
                                        "title" => "Library card no pre-fix",
                                        "type" => "text",
                                        "placeholder" => "Library card no pre-fix",
                                        "value" => (isset($data['library']['lib_card_expire_month'])) ? $data['library']['lib_card_expire_month'] : 'USR'
                                    );
                                    echo form_dropdown($attribute, $month_list, 6);
                                    ?>
                                </div>
                            </div>
                        </div> 
                    </div>
                    <!-- /.box-body -->
                </div>
                <span class="pull-right">
                    <button type="submit" id="library_submit" class="btn btn-primary btn-small"><i class="fa fa-save"></i> Save</button>
                </span>
            </div>
        </div>
    </div>
</div>
<?= form_close() ?>
<script type="text/javascript">
    $(function () {
        $('#submit').on('click', function () {
            $('#chart_config').submit();
        });
//lib_card_num_prefix validateion allows only a-z A-Z 0-9
        $('#lib_card_num_prefix').on('keypress', function (event) {
            var regex = new RegExp("^[a-zA-Z0-9\b]+$");
            var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
            if (!regex.test(key)) {
                event.preventDefault();
                return false;
            }
        });

    });


</script>