<?php ?> 
<style type="text/css">    
    .id-card-holder {
        width: 280px;
        padding: 4px;
        margin: 0 auto;
        background-color: #1f1f1f;
        border-radius: 5px;
        position: relative;
    }
    .id-card-holder:after {
        content: '';
        width: 7px;
        display: block;
        background-color: #0a0a0a;
        height: 100px;
        position: absolute;
        top: 105px;
        border-radius: 0 5px 5px 0;
    }
    .id-card-holder:before {
        content: '';
        width: 7px;
        display: block;
        background-color: #0a0a0a;
        height: 100px;
        position: absolute;
        top: 105px;
        left: 269px;
        border-radius: 5px 0 0 5px;
    }
    .id-card {
        background-color: #fff;
        padding: 10px;
        border-radius: 10px;
        text-align: center;
        box-shadow: 0 0 1.5px 0px #b9b9b9;
        border:1px solid gray;
    }    
    .library_header{font-family: Georgia;font-weight: bold;font-style: italic; font-size: 20px;}
    .id-card hr{margin: 3px 0px 3px 0px !important;}
    .id-card .company_name{font-size: 12px;margin: 2px; color:#E02222; font-weight: bold;font-size: 11px;}
    .id-card .bar-code img{margin: 0 auto; width: 100%; height: 40px;}        
    .id-card .photo img {width: 100px;border: 1px solid gray;}
    .id-card h2 {font-size: 15px;margin: 5px 0;}
    .id-card h3 {font-size: 12px;margin: 2.5px 0;font-weight: 300;}
    .qr-code img {margin: 0 auto;width: 80px;}    
    .id-card p {font-size: 8px;margin: 2px 0px 0px 0px !important;
        
    }
    .id-card-hook {
        background-color: #000;
        width: 70px;
        margin: 0 auto;
        height: 15px;
        border-radius: 5px 5px 0 0;
    }
    .id-card-hook:after {
        content: '';
        background-color: #d7d6d3;
        width: 47px;
        height: 6px;
        display: block;
        margin: 0px auto;
        position: relative;
        top: 6px;
        border-radius: 4px;
    }
</style>
<div class="row-fluid">
    <div class="col-sm-12 no_pad table-responsive">
        <?php
        $this->load->library('c_datatable');
        $dt_data = $this->c_datatable->generate_grid($config);
        echo $dt_data;
        ?>
    </div>
</div>
<div class="modal fade" id="lib_card_popup">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-label="Close" data-dismiss="modal" class="close" type="button">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Library Card</h4>
            </div>
            <div class="modal-body">
                <div class="id-card-hook"></div>
                <div class="id-card-holder library_card_print">
                    <div class="id-card">
                        <div class="library_header">
                            Library Card
                        </div>
                        <p class="company_name">Sharada Ayurvedic Medical College & Hospital<p>
                        <p><strong>"PENGG"</strong>HOUSE,4th Floor, TC 11/729(4), Division Office Road <p>
                        <p>Near PMG Junction, Thiruvananthapuram Kerala, India <strong>695033</strong></p>
                        <p>Ph: 9446062493 | E-ail: info@onetikk.info</p>
                        <hr>                        
                        <div class="photo">
                            <img src="./images/user-icon.png">
                        </div>
                        <h2 id="lcard_name"></h2>
                        <div class="qr-code">
                            <img id="lcard_qrcode" src="">
                        </div>                        
                        <hr>                      
                        <div class="bar-code">
                            <img id="lcard_barcode" src="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-success" id="print_library_card" type="button">Print</button>
                <button data-dismiss="modal" class="btn btn-danger" id="default_modal_box_btn_cancel" type="button">Cancel</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<script type="text/javascript">
    $(function ($) {
//delete record

        $(document).on('click', '.renew_member_card', function (e) {
            e.preventDefault();
            var data = {'member_id': $(this).data('member_id')}
            var row = $(this).closest('tr');
            BootstrapDialog.show({
                title: 'Alert',
                message: 'Do you want to renew the library card?',
                buttons: [{
                        label: 'Cancel',
                        action: function (dialog) {
                            dialog.close();
                        }
                    }, {
                        label: 'Renew',
                        action: function (dialog) {
                            $.ajax({
                                url: '<?= base_url('renew-library-user') ?>',
                                method: 'POST',
                                data: data,
                                success: function (result) {
                                    result = JSON.parse(result);
                                    if (result.status == 'success') {
                                        dialog.close();
                                        BootstrapDialog.alert(result.message);
                                    } else {
                                        dialog.close();
                                        BootstrapDialog.alert(result.message);
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
        $(document).on('click', '.delete-record', function (e) {
            e.preventDefault();
            var data = {'member_id': $(this).data('member_id')}
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
                                url: '<?= base_url('delete-library-user') ?>',
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
                url: "<?= base_url('export-library-user') ?>",
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
                url: "<?= base_url('export-library-user') ?>",
                data: param,
                dataType: 'json'
            }).done(function (data) {
                download(data.file, data.file_name, 'application/octet-stream');
                $('#loading').css('display', 'none');
            });
        });
        $(document).on('click', '.show_icard_modal', function (e) {
            e.preventDefault();
            $('#loading').css('display', 'block');
            var param = {
                "member_id": $(this).attr('data-member_id')
            };
            $.ajax({
                type: 'POST',
                url: "<?= base_url('library/library_users/generate_library_card') ?>",
                data: param,
                dataType: 'json'
            }).done(function (data) {
                console.log(data);
                $('#lcard_qrcode').attr('src',data.data.qrcode_image);
                $('#lcard_barcode').attr('src',data.data.barcode_image);
                $('#lcard_name').html(data.data.user_name);
                $('#loading').css('display', 'none');
            });

            $('#lib_card_popup').modal('show');
        });
        $('#print_library_card').on('click', function () {
            printDiv(document.getElementsByClassName('id-card'));
        });
        function printDiv(element_obj) {
            PrintElements.print(element_obj);
        }
    });
</script>