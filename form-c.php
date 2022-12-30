<div class="wrapper">
    <?php include_once(PLUGIN_DIR_PATH."views/custom-forms.php"); ?>
    <div id="content">
        <h2>Form C</h2>
        <form id="form_c">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="FormCInput1">Form C Input 1</label>
                    <input type="text" class="form-control" name="form_c_input_1" id="form_c_input_1">
                    <span id="msg_form_c_input_1" class="messege"></span>
                </div>
                <div class="form-group col-md-6">
                    <label for="FormCInput2">Form C Input 2</label>
                    <input type="text" class="form-control" name="form_c_input_2" id="form_c_input_2">
                    <span id="msg_form_c_input_2" class="messege"></span>
                </div>
                <div class="form-group col-md-6">
                    <label for="FormCInput3">Form C Input 3</label>
                    <input type="text" class="form-control" name="form_c_input_3" id="form_c_input_3">
                    <span id="msg_form_c_input_3" class="messege"></span>
                </div>
                <div class="form-group col-md-6">
                    <label for="FormCInput4">Form C Input 4</label>
                    <input type="text" class="form-control" name="form_c_input_4" id="form_c_input_4">
                    <span id="msg_form_c_input_4" class="messege"></span>
                </div>
                <div class="form-group col-md-6">
                    <label for="FormCRadio1">Form C Radio 1</label>
                    <input type="radio" class="form-control" name="form_c_radio_1" value="radio11">Radio 11
                    <input type="radio" class="form-control" name="form_c_radio_1" value="radio12">Radio 12
                </div>
                <div class="form-group col-md-6">
                    <label for="FormCRadio2">Form C Radio 2</label>
                    <input type="radio" class="form-control" name="form_c_radio_2" value="radio21">Radio 21
                    <input type="radio" class="form-control" name="form_c_radio_2" value="radio22">Radio 22
                </div>
                <div class="form-group col-md-6">
                    <label for="FormCSelect1">Form C Select 1</label>
                    <select name="form_c_select_1" id="form_c_select_1" class="form-control">
                        <option selected>Choose...</option>
                        <option value="form_c_select_1_option_1">Form C Select 1 Option 1</option>
                        <option value="form_c_select_1_option_2">Form C Select 1 Option 2</option>
                        <option value="form_c_select_1_option_3">Form C Select 1 Option 3</option>
                        <option value="form_c_select_1_option_4">Form C Select 1 Option 4</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="FormCSelect2">Form C Select 2</label>
                    <select name="form_c_select_2" id="form_c_select_2" class="form-control">
                        <option selected>Choose...</option>
                        <option value="form_c_select_2_option_1">Form C Select 2 Option 1</option>
                        <option value="form_c_select_2_option_2">Form C Select 2 Option 2</option>
                        <option value="form_c_select_2_option_3">Form C Select 2 Option 3</option>
                        <option value="form_c_select_2_option_4">Form C Select 2 Option 4</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="FormCTextArea">Form C Text Area</label>
                <textarea name="form_c_textarea" id="form_c_textarea" cols="100" rows="3"></textarea>
            </div>
            <input type="button" class="btn btn-primary" value="Submit" onclick="form_a_func(form)">
        </form>
    </div>
</div>
<script>
    var page_name="<?php echo $_GET['page'] ?>";
</script>