<div class="col-sm-12">
    <div class="row">
        <div class="col-sm-10">
            <div class="col-sm-6">
                <div class = 'form-group row'>
                    <label for = 'card_no' class = 'col-sm-4 col-form-label ele_required'>Card no</label>
                    <div class = 'col-sm-8'>
                        <?php
                        $attribute = array(
                            "name" => "card_no",
                            "id" => "card_no",
                            "class" => "form-control",
                            "title" => "",
                            "required" => "",
                            "readonly" => "",
                            "type" => "text",
                            "value" => (isset($data["card_no"])) ? $data["card_no"] : ""
                        );
                        echo form_error("card_no");
                        echo form_input($attribute);
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <label for = 'card_no' class = 'col-sm-4 col-form-label ele_required'>Card no</label>
                <div class = 'col-sm-8'>
                    <?php
                    $attribute = array(
                        "name" => "card_no",
                        "id" => "card_no",
                        "class" => "form-control",
                        "title" => "",
                        "required" => "",
                        "readonly" => "",
                        "type" => "text",
                        "value" => (isset($data["card_no"])) ? $data["card_no"] : ""
                    );
                    echo form_error("card_no");
                    echo form_input($attribute);
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>