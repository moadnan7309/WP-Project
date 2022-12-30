<div class="container">
    <div class="row">
        
        <div class="col-sm-1"></div>
        <div class="col-sm-10">
            <div class="col-sm-12 form-group row">
                <label for="search" class="col-sm-3 col-form-label">Enter the key : </label>
                <input type="text" class="col-sm-9 form-control" id="search_key_user" placeholder="Search By User Email">
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">User ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">User Email</th>
                        <th scope="col">Messege</th>
                    </tr>
                </thead>
                <tbody id="tbody_id_user">

                </tbody>
            </table>
            <div id="msg_user" style="text-align:center; background-color: lightblue; font-size: large;"></div>
            <div id="content_user"></div>
            <div id="pagination_user"></div>
        </div>
    </div>
</div>
<script>
    var page_name="<?php echo $_GET['page'] ?>";
</script>