<div class="wrapper">
    <?php include_once(PLUGIN_DIR_PATH."views/custom-forms.php"); ?>
    <div id="content">
        <h2>Form D</h2>
        <form id="form_d">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="FormDInput1">Form D Input 1</label>
                    <input type="text" class="form-control" name="form_d_input_1" id="form_d_input_1">
                    <span id="msg_form_d_input_1" class="messege"></span>
                </div>
                <div class="form-group col-md-6">
                    <label for="FormDInput2">Form D Input 2</label>
                    <input type="text" class="form-control" name="form_d_input_2" id="form_d_input_2">
                    <span id="msg_form_d_input_2" class="messege"></span>
                </div>
                <div class="form-group col-md-6">
                    <label for="FormDInput3">Form D Input 3</label>
                    <input type="text" class="form-control" name="form_d_input_3" id="form_d_input_3">
                    <span id="msg_form_d_input_3" class="messege"></span>
                </div>
                <div class="form-group col-md-6">
                    <label for="FormDInput4">Form D Input 4</label>
                    <input type="text" class="form-control" name="form_d_input_4" id="form_d_input_4">
                    <span id="msg_form_d_input_4" class="messege"></span>
                </div>
                <div class="form-group col-md-6">
                    <label for="FormDRadio1">Form D Radio 1</label>
                    <input type="radio" class="form-control" name="form_d_radio_1" value="radio11">Radio 11
                    <input type="radio" class="form-control" name="form_d_radio_1" value="radio12">Radio 12
                </div>
                <div class="form-group col-md-6">
                    <label for="FormDRadio2">Form D Radio 2</label>
                    <input type="radio" class="form-control" name="form_d_radio_2" value="radio21">Radio 21
                    <input type="radio" class="form-control" name="form_d_radio_2" value="radio22">Radio 22
                </div>
                <div class="form-group col-md-6">
                    <label for="FormDSelect1">Form D Select 1</label>
                    <select name="form_d_select_1" id="form_d_select_1" class="form-control">
                        <option selected>Choose...</option>
                        <option value="form_d_select_1_option_1">Form D Select 1 Option 1</option>
                        <option value="form_d_select_1_option_2">Form D Select 1 Option 2</option>
                        <option value="form_d_select_1_option_3">Form D Select 1 Option 3</option>
                        <option value="form_d_select_1_option_4">Form D Select 1 Option 4</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="FormDSelect2">Form D Select 2</label>
                    <select name="form_b_select_2" id="form_d_select_2" class="form-control">
                        <option selected>Choose...</option>
                        <option value="form_d_select_2_option_1">Form D Select 2 Option 1</option>
                        <option value="form_d_select_2_option_2">Form D Select 2 Option 2</option>
                        <option value="form_d_select_2_option_3">Form D Select 2 Option 3</option>
                        <option value="form_d_select_2_option_4">Form D Select 2 Option 4</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="FormDTextArea">Form D Text Area</label>
                <textarea name="form_d_textarea" id="form_d_textarea" cols="100" rows="3"></textarea>
            </div>
            <input type="button" class="btn btn-primary" value="Submit" onclick="form_a_func(form)">
        </form>
    </div>
</div>
<script>
    var page_name="<?php echo $_GET['page'] ?>";
</script>