<div class="wrapper">
    <?php include_once(PLUGIN_DIR_PATH."views/custom-forms.php"); ?>
    <div id="content">
        <h2>Form F</h2>
        <form id="form_f" enctype="multipart/form-data">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="FormFInput1">Form F Input 1</label>
                    <input type="text" class="form-control" name="form_f_input_1" id="form_f_input_1">
                    <span id="msg_form_f_input_1" class="messege"></span>
                </div>
                <div class="form-group col-md-6">
                    <label for="FormFInput2">Form F Input 2</label>
                    <input type="text" class="form-control" name="form_f_input_2" id="form_f_input_2">
                    <span id="msg_form_f_input_2" class="messege"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="FormFTextEditor">Form F Text Editor</label>
                <textarea name="form_f_text_editor" id="form_f_text_editor" cols="100" rows="5">
                </textarea>
            </div>
            <div class="form-group">
                <label for="FormFFile">Form F File</label>
                <input type="file" class="form-control" name="form_f_file[]" id="form_f_file" multiple>
                <span id="msg_form_f_file" class="messege"></span>
                <img id="form_f_img" src="" height="100px">
            </div>
            <input type="button" class="btn btn-primary" value="Submit" onclick="form_a_func(form)">
        </form>
    </div>
</div>
<script>
    var page_name="<?php echo $_GET['page'] ?>";
</script>