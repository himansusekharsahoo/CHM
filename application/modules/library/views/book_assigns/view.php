<div class="col-sm-12">
    <div class = 'form-group row'>
        <label for = 'bledger_id' class = 'col-sm-2 col-form-label'>Bledger id</label>
        <div class = 'col-sm-3'>
            <?= (isset($data["bledger_id"])) ? $data["bledger_id"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'member_id' class = 'col-sm-2 col-form-label'>Member id</label>
        <div class = 'col-sm-3'>
            <?= (isset($data["member_id"])) ? $data["member_id"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'issue_date' class = 'col-sm-2 col-form-label'>Issue date</label>
        <div class = 'col-sm-3'>
            <?= (isset($data["issue_date"])) ? $data["issue_date"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'due_date' class = 'col-sm-2 col-form-label'>Due date</label>
        <div class = 'col-sm-3'>
            <?= (isset($data["due_date"])) ? $data["due_date"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'return_date' class = 'col-sm-2 col-form-label'>Return date</label>
        <div class = 'col-sm-3'>
            <?= (isset($data["return_date"])) ? $data["return_date"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'return_delay_fine' class = 'col-sm-2 col-form-label'>Return delay fine</label>
        <div class = 'col-sm-3'>
            <?= (isset($data["return_delay_fine"])) ? $data["return_delay_fine"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'book_return_condition' class = 'col-sm-2 col-form-label'>Book return condition</label>
        <div class = 'col-sm-3'>
            <?= (isset($data["book_return_condition"])) ? $data["book_return_condition"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'book_lost_fine' class = 'col-sm-2 col-form-label'>Book lost fine</label>
        <div class = 'col-sm-3'>
            <?= (isset($data["book_lost_fine"])) ? $data["book_lost_fine"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'remarks' class = 'col-sm-2 col-form-label'>Remarks</label>
        <div class = 'col-sm-3'>
            <?= (isset($data["remarks"])) ? $data["remarks"] : "" ?>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'user_type' class = 'col-sm-2 col-form-label'>User type</label>
        <div class = 'col-sm-3'>
            <?= (isset($data["user_type"])) ? $data["user_type"] : "" ?>
        </div>
    </div>

    <div class = 'form-group row'>
        <div class = 'col-sm-1'>
            <a class="text-right btn btn-default" href="<?= APP_BASE ?>library/book_assigns/index">
                <span class="glyphicon glyphicon-th-list"></span> Cancel
            </a>
        </div>
    </div>

</div>