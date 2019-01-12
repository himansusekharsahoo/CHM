<div class="col-sm-10">
    <div class="box box-primary">
        <div class="box-header with-border">
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-sm-6">
                    <div class = 'form-group row'>
                        <label for = 'book_name' class = 'col-sm-4 col-form-label'>Book name</label>
                        <div class = 'col-sm-5'>
                            <?= (isset($data["book_name"])) ? $data["book_name"] : "" ?>
                        </div>
                    </div>
                    <div class = 'form-group row'>
                        <label for = 'bcategory_name' class = 'col-sm-4 col-form-label'>Book Category</label>
                        <div class = 'col-sm-5'>
                            <?= (isset($data["bcategory_name"])) ? $data["bcategory_name"] : "" ?>
                        </div>
                    </div>
                    <div class = 'form-group row'>
                        <label for = 'publicatoin_name' class = 'col-sm-4 col-form-label'>Book publication</label>
                        <div class = 'col-sm-5'>
                            <?= (isset($data["publicatoin_name"])) ? $data["publicatoin_name"] : "" ?>
                        </div>
                    </div>
                    <div class = 'form-group row'>
                        <label for = 'author_name' class = 'col-sm-4 col-form-label'>Book author</label>
                        <div class = 'col-sm-5'>
                            <?= (isset($data["author_name"])) ? $data["author_name"] : "" ?>
                        </div>
                    </div>   
                    <div class = 'form-group row'>
                        <label for = 'location' class = 'col-sm-4 col-form-label'>Book location</label>
                        <div class = 'col-sm-5'>
                            <?= (isset($data["location"])) ? $data["location"] : "" ?>
                        </div>
                    </div>
                    <div class = 'form-group row'>
                        <label for = 'created' class = 'col-sm-4 col-form-label'>Created</label>
                        <div class = 'col-sm-5'>
                            <?= (isset($data["created"])) ? $data["created"] : "" ?>
                        </div>
                    </div>
                    <div class = 'form-group row'>
                        <label for = 'created_by' class = 'col-sm-4 col-form-label'>Created by</label>
                        <div class = 'col-sm-5'>
                            <?= (isset($data["created_by"])) ? $data["created_by"] : "" ?>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">

                    <div class = 'form-group row'>
                        <label for = 'page' class = 'col-sm-4 col-form-label'>Pages</label>
                        <div class = 'col-sm-5'>
                            <?= (isset($data["page"])) ? $data["page"] : "" ?>
                        </div>
                    </div>
                    <div class = 'form-group row'>
                        <label for = 'mrp' class = 'col-sm-4 col-form-label'>MRP</label>
                        <div class = 'col-sm-5'>
                            <?= (isset($data["mrp"])) ? $data["mrp"] : "" ?>
                        </div>
                    </div>
                    <div class = 'form-group row'>
                        <label for = 'isbn_no' class = 'col-sm-4 col-form-label'>ISBN</label>
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
                        <label for = 'modified' class = 'col-sm-4 col-form-label'>Modified</label>
                        <div class = 'col-sm-5'>
                            <?= (isset($data["modified"])) ? $data["modified"] : "" ?>
                        </div>
                    </div>
                    <div class = 'form-group row'>
                        <label for = 'midified_by' class = 'col-sm-4 col-form-label'>Modified by</label>
                        <div class = 'col-sm-5'>
                            <?= (isset($data["midified_by"])) ? $data["midified_by"] : "" ?>
                        </div>
                    </div>
                </div> 
            </div>
            <div class="row-fluid">
                <div class="panel-body no_pad criteria_panel">
                    <div class="panel panel-default orange_border">
                        <div class="panel-heading" data-toggle="collapse" data-target="#purchase_detail_panel" aria-expanded="true" style="cursor: pointer">
                            <h1 class="panel-title text-left white-text" data-toggle="collapse" data-target="#purchase_detail_panel" aria-expanded="true" style="cursor: pointer">
                                Purchase details <span><i class="fa fa-chevron-down pull-right"></i></span>
                            </h1>
                        </div>
                        <div class="panel-body no_pad collapse" id="purchase_detail_panel" aria-expanded="true">
                            <div class="row-fluid marginT10">
                                <div class="col-sm-6">
                                    <div class = 'form-group row'>
                                        <label for = 'bill_number' class = 'col-sm-4 col-form-label '>Bill number</label>
                                        <div class = 'col-sm-7'>
                                            <?= (isset($data["bill_number"])) ? $data["bill_number"] : "" ?>                                            
                                        </div>
                                    </div>
                                    <div class = 'form-group row'>
                                        <label for = 'purchase_date' class = 'col-sm-4 col-form-label '>Purchase date</label>
                                        <div class = 'col-sm-7'>
                                            <?= (isset($data["purchase_date"])) ? $data["purchase_date"] : "" ?>                                            
                                        </div>
                                    </div>
                                    <div class = 'form-group row'>
                                        <label for = 'price' class = 'col-sm-4 col-form-label '>Price</label>
                                        <div class = 'col-sm-7'>
                                            <?= (isset($data["price"])) ? $data["price"] : "" ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class = 'form-group row'>
                                        <label for = 'vendor_name' class = 'col-sm-4 col-form-label'>Vendor name</label>
                                        <div class = 'col-sm-7'>
                                            <?= (isset($data["vendor_name"])) ? $data["vendor_name"] : "" ?>
                                        </div>
                                    </div>
                                    <div class = 'form-group row'>
                                        <label for = 'remarks' class = 'col-sm-4 col-form-label'>Remarks</label>
                                        <div class = 'col-sm-7'>
                                            <?= (isset($data["remarks"])) ? $data["remarks"] : "" ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
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