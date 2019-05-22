<?php ?>
<div class="row-fluid">
    <div class="col-sm-6 col_centered">
        <div class="row-fluid">
            <div class="col-sm-12 no_pad text-danger" id="utility_error">
                <?php
                if ($this->session->flashdata('upload_file')) {
                    echo $this->session->flashdata('upload_file');
                } else {
                    echo validation_errors();
                }
                ?>
            </div>
        </div>
        <div class="row-fluid marginT10 marginB10">
            <!--            <a href="uploads/upload_templates/book_ledger_batch_upload_template.xlsx" class="chm_link">Download Template</a>-->
            <a href="#"  id="download_ledger_template" class="chm_link">Download Template</a>
        </div>        
        <div class="row">
            <div class="form-group ">
                <form action="book-ledger-upload-process" enctype="multipart/form-data" method="post" name="upload_utility_form" id="upload_utility_form">
                    <div class="col-sm-12">
                        <div class="col-sm-10 no_lpad">
                            <input type="file" name="upload_file" id="upload_file" class="custom_file">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-file-excel-o"></i></span>
                                <input type="text" class="form-control input-lg" disabled placeholder="Upload File">
                                <span class="input-group-btn">
                                    <button class="browse btn btn-primary input-lg" type="button"><i class="fa fa-search"></i> Browse</button>
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-1 no_pad">
                            <button class="btn btn-primary input-lg" type="button" id="utility_submit"><i class="fa fa-upload"></i> Upload</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row marginT10">
            <div class="col-sm-8 no_rpad">
                <div class="col-sm-1 text-danger no_pad text-bold">
                    <i class="fa fa-chevron-right font_12"></i>
                    <i class="fa fa-chevron-right font_12"></i>
                </div>
                <div class="col-sm-10 text-center text-danger no_lpad">
                    Only xls/xlsx files are allowed.
                </div>
                <div class="col-sm-1 text-danger no_pad text-bold">
                    <i class="fa fa-chevron-left font_12"></i>
                    <i class="fa fa-chevron-left font_12"></i>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $(document).on('click', '.browse', function () {
            var file = $(this).parent().parent().parent().find('.custom_file');
            file.trigger('click');
        });
        $(document).on('change', '.custom_file', function () {
            $(this).parent().find('.form-control').val($(this).val().replace(/C:\\fakepath\\/i, ''));
        });

        $('#upload_file').on('change', function () {
            $('#utility_error').hide();
        });
        $('#utility_submit').on('click', function (e) {
            e.preventDefault();
            var err_msg = 'Please select file to upload.';
            $('#utility_error').html('');
            $('#utility_error').hide();
            $("#upload_utility_form").validate({
                rules: {
                    upload_file: {
                        required: true,
                        extension: "xls|xlsx|csv"
                    }
                },
                errorLabelContainer: $("#utility_error"),
                messages: {
                    upload_file: {
                        required: err_msg,
                        extension: 'Only xls/xlsx/csv files are allowed.'
                    }
                }
            });
            if ($("#upload_utility_form").valid()) {
                jQuery('#loading').css('display', 'block');
                $("#upload_utility_form").submit();
            }
        });
        //download template 
        $('#download_ledger_template').on('click', function (e) {            
            e.preventDefault();
            $('#loading').css('display', 'block');            
            $.ajax({
                type: 'POST',
                url: "book-ledger-upload-template-download",                
                dataType: 'json'
            }).done(function (data) {
                download(data.file, data.file_name, 'application/octet-stream');
                $('#loading').css('display', 'none');
            });
        });
    });
</script>