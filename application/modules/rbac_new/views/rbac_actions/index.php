<div style="float:right;"><a class="btn btn-primary btn-sm" href="<?= APP_BASE ?>rbac_new/rbac_actions/create">Create</a></div>
<div class="row-fluid">
    <?php
    generate_gird($grid_config, "rbac_actions_list");
    ?>
</div><script type="text/javascript">
    $(function ($) {
        $(document).on('click', '.delete-record', function (e) {
            e.preventDefault();
            var data = {'action_id': $(this).data('action_id')}
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
                                url: '<?= APP_BASE ?>rbac_new/rbac_actions/delete',
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

    });
</script>