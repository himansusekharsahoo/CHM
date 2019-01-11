<div class="col-sm-10">
    <div class="box box-primary">
        <div class="box-header with-border">
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-sm-6">
                    <div class = 'form-group row'>
                        <label for = 'book_id' class = 'col-sm-4 col-form-label'>Book name</label>
                        <div class = 'col-sm-5'>
                            <?= (isset($data["book_id"])) ? $data["book_id"] : "" ?>
                        </div>
                    </div>
                    <div class = 'form-group row'>
                        <label for = 'bcategory_id' class = 'col-sm-4 col-form-label'>Category</label>
                        <div class = 'col-sm-5'>
                            <?= (isset($data["bcategory_id"])) ? $data["bcategory_id"] : "" ?>
                        </div>
                    </div>
                    <div class = 'form-group row'>
                        <label for = 'bpublication_id' class = 'col-sm-4 col-form-label'>Publication</label>
                        <div class = 'col-sm-5'>
                            <?= (isset($data["bpublication_id"])) ? $data["bpublication_id"] : "" ?>
                        </div>
                    </div>
                    <div class = 'form-group row'>
                        <label for = 'bauthor_id' class = 'col-sm-4 col-form-label'>Author</label>
                        <div class = 'col-sm-5'>
                            <?= (isset($data["bauthor_id"])) ? $data["bauthor_id"] : "" ?>
                        </div>
                    </div>
                    <div class = 'form-group row'>
                        <label for = 'blocation_id' class = 'col-sm-4 col-form-label'>Location</label>
                        <div class = 'col-sm-5'>
                            <?= (isset($data["blocation_id"])) ? $data["blocation_id"] : "" ?>
                        </div>
                    </div>
                    <div class = 'form-group row'>
                        <label for = 'page' class = 'col-sm-4 col-form-label'>Page</label>
                        <div class = 'col-sm-5'>
                            <?= (isset($data["page"])) ? $data["page"] : "" ?>
                        </div>
                    </div>
                    <div class = 'form-group row'>
                        <label for = 'mrp' class = 'col-sm-4 col-form-label'>Mrp</label>
                        <div class = 'col-sm-5'>
                            <?= (isset($data["mrp"])) ? $data["mrp"] : "" ?>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class = 'form-group row'>
                        <label for = 'isbn_no' class = 'col-sm-4 col-form-label'>ISBN No</label>
                        <div class = 'col-sm-5'>
                            <?= (isset($data["isbn_no"])) ? $data["isbn_no"] : "" ?>
                        </div>
                    </div>
                    <div class = 'form-group row'>
                        <label for = 'edition' class = 'col-sm-4 col-form-label'>Edition</label>
                        <div class = 'col-sm-5'>
                            <?= (isset($data["edition"])) ? $data["edition"] : "" ?>
                        </div>
                    </div>
                    <div class = 'form-group row'>
                        <label for = 'bar_code' class = 'col-sm-4 col-form-label'>Bar code</label>
                        <div class = 'col-sm-5'>
                            <?= (isset($data["bar_code"])) ? $data["bar_code"] : "" ?>
                        </div>
                    </div>
                    <div class = 'form-group row'>
                        <label for = 'qr_code' class = 'col-sm-4 col-form-label'>Qr code</label>
                        <div class = 'col-sm-5'>
                            <?= (isset($data["qr_code"])) ? $data["qr_code"] : "" ?>
                        </div>
                    </div>
                    <div class = 'form-group row'>
                        <label for = 'midified_by' class = 'col-sm-4 col-form-label'>Midified by</label>
                        <div class = 'col-sm-5'>
                            <?= (isset($data["midified_by"])) ? $data["midified_by"] : "" ?>
                        </div>
                    </div>
                </div> 
            </div>
            <div class = 'row'>
                <div class="col-sm-12">
                    <span class="pull-right">
                        <div class = 'col-sm-6'>
                            <a class="text-right btn btn-default" href="<?= base_url('manage-book-ledger') ?>">
                                <span class="glyphicon glyphicon-th-list"></span> Back
                            </a>
                        </div>                        
                    </span>
                </div>
            </div>

        </div>
    </div>
</div>