<div class="container">
    <div class="row">
        <div class="border col-sm-5">
            <h2>Registration Form</h2>
            <form id="register_form" onsubmit="return show_data.save_data_function(this);">

                <div class="form-outline mb-4">
                    <label class="form-label" for="form3Example3cg">Your Name</label>
                    <input type="text" name="name" id="form3Example3cg" class="form-control form-control-lg" required />
                </div>

                <div class="form-outline mb-4">
                    <label class="form-label" for="form3Example3cg">Your Email</label>
                    <input type="email" name="email" id="form3Example3cg" class="form-control form-control-lg"
                        required />
                </div>

                <div class="form-outline mb-4">
                    <label class="form-label" for="form3Example4cg">Password</label>
                    <input type="password" name="password" id="form3Example4cg" class="form-control form-control-lg"
                        required />
                </div>

                <div class="form-outline mb-4">
                    <label class="form-label" for="form3Example3cg">Mobile</label>
                    <input type="text" name="phone" id="form3Example3cg" class="form-control form-control-lg"
                        required />
                </div>

                <div class="d-flex justify-content-center">
                    <input type="submit" class="btn btn-success btn-block btn-lg gradient-custom-4 text-body"
                        value="Register" />
                </div>
            </form>
        </div>
        <div class="col-sm-1"></div>
        <div class="col-sm-6">
            <div class="col-sm-12 form-group row">
                <label for="search" class="col-sm-3 col-form-label">Enter the key : </label>
                <input type="text" class="col-sm-9 form-control" id="search_key" placeholder="Search By Name">
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Mobile</th>
                    </tr>
                </thead>
                <tbody id="tbody_id">

                </tbody>
            </table>
            <div id="msg" style="text-align:center; background-color: lightblue; font-size: large;"></div>
            <div id="content"></div>
            <div id="pagination"></div>
        </div>
    </div>
</div>
<script>
    var page_name="<?php echo $_GET['page'] ?>";
</script>