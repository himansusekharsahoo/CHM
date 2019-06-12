<div class="col-sm-12">
    <div class = 'form-group row'>
        <label for = 'floor' class = 'col-sm-2 col-form-label'>Floor</label>
        <div class = 'col-sm-3'>
            <?= (isset($data["floor"])) ? $data["floor"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'block' class = 'col-sm-2 col-form-label'>Block</label>
        <div class = 'col-sm-3'>
            <?= (isset($data["block"])) ? $data["block"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'rack_no' class = 'col-sm-2 col-form-label'>Rack no</label>
        <div class = 'col-sm-3'>
            <?= (isset($data["rack_no"])) ? $data["rack_no"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'self_no' class = 'col-sm-2 col-form-label'>Self no</label>
        <div class = 'col-sm-3'>
            <?= (isset($data["self_no"])) ? $data["self_no"] : "" ?>
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
            <a class="text-right btn btn-default" href="<?= base_url('manage-book-location') ?>">
                <span class="glyphicon glyphicon-th-list"></span> Cancel
            </a>
        </div>
    </div>

</div>