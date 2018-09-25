
<div class="row-fluid">
    <div class="col-sm-12 no_pad">
        <?php
        $this->load->library('c_datatable');
        $dt_data = $this->c_datatable->generate_grid($config);
        echo $dt_data;
        ?>
    </div>
</div>
<script type="text/javascript">
    $(function ($) {


        $(document).on('click', '.delete-record', function (e) {
            e.preventDefault();
            var data = {'role_id': $(this).data('role_id')}
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
                                url: '<?= APP_BASE ?>rbac_new/rbac_roles/delete',
                                method: 'POST',
                                data: data,
                                success: function (result) {
                                    if (result) {
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

//export raw data
        $('#export_table').on('click', function (e) {
            e.preventDefault();
            $('#loading').css('display', 'block');
            var param={
                "export":1
            };
            $.ajax({
                type: 'POST',
                url: "<?= base_url('rbac_new/rbac_roles/index') ?>",
                data: param,
                dataType: 'json'
            }).done(function (data) {
                download(data.file, data.file_name, 'application/octet-stream');
                $('#loading').css('display', 'none');
            });
        });
    });
</script>