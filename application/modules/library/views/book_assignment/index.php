<style>
    table{table-layout: fixed;}
    .ledger_id { width:80px !important;}
    .card_no { width:120px !important;}
    .issue_date { width:120px !important;}
    .due_date { width:120px !important;}
    .return_date { width:120px !important;}
    .return_delay_fine { width:120px !important;}
    .book_return_condition { width:120px !important;}
    .remarks { width:120px !important;}
    .user_type { width:120px !important;}
    .action { width:100px !important;}
</style>
<div class="row-fluid">
    <div class="col-sm-12 no_pad table-responsive">
        <?php
        $this->load->library('c_datatable');
        $dt_data = $this->c_datatable->generate_grid($config);
        echo $dt_data;
        ?>
    </div>
</div><script type="text/javascript">
    $(function ($) {
//delete record
        $(document).on('click', '.delete-record', function (e) {
            e.preventDefault();
            var data = {'bassign_id': $(this).data('bassign_id')}
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
                                url: '<?= APP_BASE ?>delete-book-assign',
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
//export raw data as excel 

        $(document).on('click', '#export_table_xls', function (e) {
            e.preventDefault();
            $('#loading').css('display', 'block');
            var param = {
                "export_type": 'xlsx'
            };
            $.ajax({
                type: 'POST',
                url: "<?= base_url('export-book-assigns') ?>",
                data: param,
                dataType: 'json'
            }).done(function (data) {
                download(data.file, data.file_name, 'application/octet-stream');
                $('#loading').css('display', 'none');
            });
        });
//export raw data as csv 

        $(document).on('click', '#export_table_csv', function (e) {
            e.preventDefault();
            $('#loading').css('display', 'block');
            var param = {
                "export_type": 'csv'
            };
            $.ajax({
                type: 'POST',
                url: "<?= base_url('export-book-assigns') ?>",
                data: param,
                dataType: 'json'
            }).done(function (data) {
                download(data.file, data.file_name, 'application/octet-stream');
                $('#loading').css('display', 'none');
            });
        });

    });
</script>