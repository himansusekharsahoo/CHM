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
                <span><input type="submit" name="import_data" id="import_data" style="display:none;float: left;" value="Import"  class="btn btn-default pannel_button pannel_button_w90" >&nbsp;&nbsp;</span>
                <span><a href="book-ledger-upload" class="btn btn-default pannel_button pannel_button_w90 ">Cancel</a></span>
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
                $('#import_data').css('display','block');
            } else if ($(this).val() == 'invalid') {
                $('#valid_rec_grid').removeClass('show').addClass('hide');
                $('#invalid_rec_grid').removeClass('hide').addClass('show');
                $('#import_data').css('display','none');
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
                                url: 'book-ledger-upload-delete-row',
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

        $(document).on('click', '#import_data', function () {
            //save valid data
            $('#loading').css('display', 'none');
            $.ajax({
                type: 'POST',
                url: "<?= base_url('book-ledger-upload-import') ?>",                
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
                    BootstrapDialog.show({
                        type: BootstrapDialog.TYPE_DEFAULT,
                        title: data.title,
                        message: data.message,
                        buttons: [
                            {
                                label: '<?= $this->lang->line('POP_UP_CLOSE') ?>',
                                action: function (dialogItself) {
                                    window.location.href = 'book-ledger-upload';
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
                url: "book-ledger-upload-export",
                data: param,
                dataType: 'json'
            }).done(function (data) {
                download(data.file, data.file_name, 'application/octet-stream');
                $('#loading').css('display', 'none');
            });
        }
    });//ready
</script>