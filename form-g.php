<div class="wrapper">
    <?php include_once(PLUGIN_DIR_PATH."views/custom-forms.php"); ?>
    <div id="content">
        <h2>Form G</h2>
        <form id="form_g" enctype="multipart/form-data">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="FormGInput1">Form G Input 1</label>
                    <input type="text" class="form-control" name="form_g_input_1" id="form_g_input_1">
                    <span id="msg_form_g_input_1" class="messege"></span>
                </div>
                <div class="form-group col-md-6">
                    <label for="FormGInput2">Form G Input 2</label>
                    <input type="text" class="form-control" name="form_g_input_2" id="form_g_input_2">
                    <span id="msg_form_g_input_2" class="messege"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="FormGTextEditor">Form G Text Editor</label>
                <textarea name="form_g_text_editor" id="form_g_text_editor" cols="100" rows="5">
                </textarea>
            </div>
            <div class="form-group">
                <label for="FormGFile">Form G File</label>
                <input type="file" class="form-control" name="form_g_file[]" id="form_g_file" multiple>
                <span id="msg_form_g_file" class="messege"></span>
                <img id="form_g_img" src="" height="100px">
            </div>
            <input type="button" class="btn btn-primary" value="Submit" onclick="form_a_func(form)">
        </form>
    </div>
</div>
<script>
    var page_name="<?php echo $_GET['page'] ?>";
</script>