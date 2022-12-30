<?php
// $pageName = $_GET['page'];
// print_r($pageName); 
// die;
?>
<div class="wrapper">
    <?php include_once(PLUGIN_DIR_PATH."views/custom-forms.php"); ?>
    <div id="content">
        <h2>Form E</h2>
        <form id="form_e" name="form-e" enctype="multipart/form-data">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="FormEInput1">Form E Input 1</label>
                    <input type="text" class="form-control" name="form_e_input_1" id="form_e_input_1">
                    <span id="msg_form_e_input_1" class="messege"></span>
                </div>
                <div class="form-group col-md-6">
                    <label for="FormEInput2">Form E Input 2</label>
                    <input type="text" class="form-control" name="form_e_input_2" id="form_e_input_2">
                    <span id="msg_form_e_input_2" class="messege"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="FormETextEditor">Form E Text Editor</label>
                <textarea name="form_e_text_editor" id="form_e_text_editor" cols="100" rows="5">
                </textarea>
            </div>
            <div class="form-group">
                <label for="FormEFile">Form E File</label>
                <input type="file" accept="image/gif, image/jpeg, image/png" class="form-control" name="form_e_file[]" id="form_e_file" multiple>
                <span id="msg_form_e_file" class="messege"></span>
                <img id="form_e_img" src="" height="100px">
            </div>
            <input type="button" class="btn btn-primary" value="Submit" onclick="form_a_func(form)">
        </form>
    </div>
</div>
<script>
    var page_name="<?php echo $_GET['page'] ?>";
</script>