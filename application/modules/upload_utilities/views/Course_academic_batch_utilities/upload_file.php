<?php ?>
<div class="row-fluid">
    <div class="col-sm-12 no-pad">
        <div class="col-sm-6 no-pad">
            <label class="radio-inline">
                <input class="radio-inline record_radio" type="radio" name="records" value="invalid" checked> Invalid
            </label>
            <label class="radio-inline">
                <input class="radio-inline record_radio valid_radio" type="radio" name="records" value="valid"> Valid
            </label>
        </div>
        <div class="col-sm-6 no-pad">
            <div class="pull-right">
                <input type="hidden" id="temp_table_name" name="temp_table_name" value="<?= ($temp_table) ? c_encode($temp_table) : set_value('temp_table_name') ?>" />
                <input type="submit" name="import_hrbp_upload" id="import_hrbp_upload" value="Import"  class="btn btn-default pannel_button pannel_button_w90" >&nbsp;&nbsp;
                <a href="course-academic-batch-upload" class="btn btn-default pannel_button pannel_button_w90 ">Cancel</a>
            </div>
        </div>
    </div>
</div>
<div class="row-fluid">
    <div class="col-sm-12 no_pad table-responsive marginT10">
        <?php
        $this->load->library('c_datatable');
        //valid record grid
        echo '<div class="col-sm-12 no_pad hide " id="valid_rec_grid">';
        $dt_data = $this->c_datatable->generate_grid($valid_table_config);
        echo $dt_data;
        echo '</div>';
        //invalid record grid
        echo '<div class="col-sm-12 no_pad" id="invalid_rec_grid">';
        $dt_data = $this->c_datatable->generate_grid($invalid_table_config);
        echo $dt_data;
        echo '</div>';
        ?>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {

        $(document).on('change', '.record_radio', function () {
            //console.log('radio value',$(this).val());
            if ($(this).val() == 'valid') {
                $('#invalid_rec_grid').removeClass('show').addClass('hide');
                $('#valid_rec_grid').removeClass('hide').addClass('show');
            } else if ($(this).val() == 'invalid') {
                $('#valid_rec_grid').removeClass('show').addClass('hide');
                $('#invalid_rec_grid').removeClass('hide').addClass('show');
            }
        });

        $(document).on('click', '.delete-record', function (e) {
            e.preventDefault();
            var data = {'record_no': $(this).data('row_id')}
            var row = $(this).closest('tr');
            BootstrapDialog.show({
                title: 'Alert',
                message: 'Do you want to delete the record?',
                buttons: [{
                        label: 'Cancel',
                        action: function (dialog) {
                            dialog.close();
                        }
                    }, {
                        label: 'Delete',
                        action: function (dialog) {
                            $.ajax({
                                url: 'course-academic-batch-delete-row',
                                method: 'POST',
                                data: data,
                                success: function (result) {
                                    if (result == 1) {
                                        dialog.close();
                                        row.hide();
                                        BootstrapDialog.alert('Record successfully deleted!');
                                    } else {
                                        dialog.close();
                                        BootstrapDialog.alert('Data deletion error,please contact site admin!');
                                    }
                                },
                                error: function (error) {
                                    dialog.close();
                                    BootstrapDialog.alert('Error:' + error);
                                }
                            });
                        }
                    }]
            });

        });

        $(document).on('click', '#import_hrbp_upload', function () {
            //save valid data
            $('#loading').css('display', 'none');
            $.ajax({
                type: 'POST',
                url: "<?= base_url('/osa/osa_hrbp_uploads/import_hrbp_data') ?>",
                data: {
                    table_name: $('#temp_table_name').val()
                },
                dataType: 'json'
            }).done(function (data) {

                if (typeof data.type !== 'undefined' && data.type == 'error') {
                    var errMsg = {
                        type: 'default',
                        title: data.title,
                        message: data.message
                    };
                    $('#loading').css('display', 'none');
                    myApp.modal.alert(errMsg);
                } else if (typeof data.type !== 'undefined' && data.type == 'success') {
                    $('#loading').css('display', 'none');
                    if (data.has_inv_record) {
                        download_invalid_data();
                    }

                    BootstrapDialog.show({
                        type: BootstrapDialog.TYPE_DEFAULT,
                        title: data.title,
                        message: data.message,
                        buttons: [
                            {
                                label: '<?= $this->lang->line('POP_UP_CLOSE') ?>',
                                action: function (dialogItself) {
                                    window.location.href = '/osa/osa_hrbp_uploads';
                                    dialogItself.close();
                                }
                            }]
                    });
                }
            });
        });

        $(document).on('click', '#export_valid_xls', function (e) {
            e.preventDefault();
            $('#loading').css('display', 'block');
            var param = {
                "export_type": 'xlsx',
                "data": 'valid'
            };
            download_grid_data(param);
        });

        $(document).on('click', '#export_valid_csv', function (e) {
            e.preventDefault();
            $('#loading').css('display', 'block');
            var param = {
                "export_type": 'csv',
                "data": 'valid'
            };
            download_grid_data(param);

        });

        $(document).on('click', '#export_invalid_xls', function (e) {
            e.preventDefault();
            $('#loading').css('display', 'block');
            var param = {
                "export_type": 'xlsx',
                "data": 'invalid'
            };
            download_grid_data(param);
        });

        $(document).on('click', '#export_invalid_csv', function (e) {
            e.preventDefault();
            $('#loading').css('display', 'block');
            var param = {
                "export_type": 'csv',
                "data": 'invalid'
            };
            download_grid_data(param);

        });
        function download_grid_data(param) {
            $.ajax({
                type: 'POST',
                url: "course-academic-batch-export",
                data: param,
                dataType: 'json'
            }).done(function (data) {
                download(data.file, data.file_name, 'application/octet-stream');
                $('#loading').css('display', 'none');
            });
        }
    });//ready
</script>