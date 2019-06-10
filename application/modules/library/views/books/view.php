<div class="col-sm-12">
    <div class="box box-default">
        <div class="box-body">
            <div class = 'form-group row'>
                <label for = 'name' class = 'col-sm-2 col-form-label'>Book name:</label>
                <div class = 'col-sm-3'>
                    <?= (isset($data["name"])) ? $data["name"] : "" ?>
                </div>
            </div>
            <div class = 'form-group row'>
                <label for = 'code' class = 'col-sm-2 col-form-label'>Product code:</label>
                <div class = 'col-sm-3'>
                    <?= (isset($data["code"])) ? $data["code"] : "" ?>
                </div>
            </div>
            <div class = 'form-group row'>
                <label for = 'language' class = 'col-sm-2 col-form-label'>Language:</label>
                <div class = 'col-sm-3'>
                    <?= (isset($data["language"])) ? $data["language"] : "" ?>
                </div>
            </div>
        </div>
        <div class="box-footer">
            <div class = 'pull-right'>
                <div class = 'col-sm-1'>
                    <a class="text-right btn btn-default" href="<?= APP_BASE ?>library/books/index">
                        <i class="fa fa-list"></i> Cancel
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>