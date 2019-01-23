<div class="col-sm-12">
    <div class = 'form-group row'>
        <label for = 'author_name' class = 'col-sm-2 col-form-label'>Author name</label>
        <div class = 'col-sm-3'>
            <?= (isset($data["author_name"])) ? $data["author_name"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'remarks' class = 'col-sm-2 col-form-label'>Remarks</label>
        <div class = 'col-sm-3'>
            <?= (isset($data["remarks"])) ? $data["remarks"] : "" ?>
        </div>
    </div>

    <div class = 'form-group row'>
        <div class = 'col-sm-1'>
            <a class="text-right btn btn-default" href="<?= base_url('manage-book-author')?>">
                <span class="glyphicon glyphicon-th-list"></span> Cancel
            </a>
        </div>
    </div>

</div>