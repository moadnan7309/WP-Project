// Save Register Form Data And Show Data and Pagination.
const show_data = {
    save_data_function: function(form) {
        var formdata = new FormData(form);
        formdata.append("action", "save_register_form_data");
        jQuery.ajax({
            url: 'admin-ajax.php',
            type: 'post',
            dataType: 'json',
            data: formdata,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.results) {
                    alert("Data Saved Successfully");
                    jQuery("#register_form").trigger("reset");
                    show_data.show_register_data_function(1);
                } else {
                    alert(response.error);
                }
            }
        });
        return false;
    },
    bootpage: null,
    current_page: null,
    show_register_data_function: function(page) {
        var formdata = new FormData();
        formdata.append("action", "show_register_form_data");
        formdata.append("page", page);
        jQuery.ajax({
            url: 'admin-ajax.php',
            type: 'post',
            dataType: 'json',
            data: formdata,
            contentType: false,
            processData: false,
            success: function(response) {
                console.log(response);
                var x = response.page_results;
                var body_row = '';
                for (i = 0; i < x.length; i++) {
                    body_row += `<tr><td>${x[i].id}</</td><td>${x[i].name}</td><td>${x[i].email}</td><td>${x[i].phone}</td></tr>`;
                }
                jQuery("#tbody_id").html(body_row);
                if (show_data.bootpage == null && page == 1) {
                    show_data.bootpage = jQuery('#pagination').bootpag({
                        total: response.total_pages,
                        page: response.current_page,
                        maxVisible: 3,
                        leaps: true,
                        first: '←',
                        last: '→'
                    }).off('page').on('page', function(event, num) {
                        // jQuery("#content").html("Page " + num);
                        show_data.show_register_data_function(num);
                    });
                    jQuery('[data-lp]').addClass('page-item');
                    jQuery('.page-item > a').addClass('page-link');
                }
            }
        });
    }
}


//For Add Meta boxes.
var index = 1;

function add_row() {
    index++;
    const html = `<div class="border" id="rem_div_${index}">
    <label>Product Name :</label>
    <select id="select_product_${index}" class="form-control"></select>
    <label>Quantity :</label>
    <input type="number" name="quantity[]" class="form-control">
    <label>Unit :</label>
    <select id="select_unit_${index}" class="form-control" name="unit[]">
    </select>
    <input type="button" class="btn btn-primary" value="Add" onclick="add_row()">
    <input type="button" class="btn btn-danger" value="Remove" onclick="remove_form(rem_div_${index})">
    </div>`;
    jQuery('#add_row').append(html);
    product_select_2('select_product_' + index);
    unit_select_2('select_unit_' + index);
}
// For Remove meta Boxes.
function remove_form(element) {
    console.log(element);
    element.remove();
}
// For Form (A, B, C, D, E, F, G, H) AJax Call.
function form_a_func(form) {
    if (jQuery("#form_a_input_1").val() == "" || jQuery("#form_a_input_2").val() == "" || jQuery("#form_a_input_3").val() == "" || jQuery("#form_a_input_4").val() == "" || jQuery("#form_a_select_1").val() == "" || jQuery("#form_a_select_2").val() == "" || jQuery("#form_a_textarea").val() == "") {
        alert("Please all Input Field is Required");
    } else if (jQuery("#form_b_input_1").val() == "" || jQuery("#form_b_input_2").val() == "" || jQuery("#form_b_input_3").val() == "" || jQuery("#form_b_input_4").val() == "" || jQuery("#form_b_select_1").val() == "" || jQuery("#form_b_select_2").val() == "" || jQuery("#form_b_textarea").val() == "") {
        alert("Please all Input Field is Required");
    } else if (jQuery("#form_c_input_1").val() == "" || jQuery("#form_c_input_2").val() == "" || jQuery("#form_c_input_3").val() == "" || jQuery("#form_c_input_4").val() == "" || jQuery("#form_c_select_1").val() == "" || jQuery("#form_c_select_2").val() == "" || jQuery("#form_c_textarea").val() == "") {
        alert("Please all Input Field is Required");
    } else if (jQuery("#form_d_input_1").val() == "" || jQuery("#form_d_input_2").val() == "" || jQuery("#form_d_input_3").val() == "" || jQuery("#form_d_input_4").val() == "" || jQuery("#form_d_select_1").val() == "" || jQuery("#form_d_select_2").val() == "" || jQuery("#form_d_textarea").val() == "") {
        alert("Please all Input Field is Required");
    } else if (jQuery("#form_e_input_1").val() == "" || jQuery("#form_e_input_2").val() == "" || jQuery("#form_e_text_editor").val() == "" || jQuery("#form_e_file").val() == "") {
        alert("Please all Input Field is Required");
    } else if (jQuery("#form_f_input_1").val() == "" || jQuery("#form_f_input_2").val() == "" || jQuery("#form_f_text_editor").val() == "" || jQuery("#form_f_file").val() == "") {
        alert("Please all Input Field is Required");
    } else if (jQuery("#form_g_input_1").val() == "" || jQuery("#form_g_input_2").val() == "" || jQuery("#form_g_text_editor").val() == "" || jQuery("#form_g_file").val() == "") {
        alert("Please all Input Field is Required");
    } else if (jQuery("#form_h_input_1").val() == "" || jQuery("#form_h_input_2").val() == "" || jQuery("#form_h_text_editor").val() == "" || jQuery("#form_h_file").val() == "") {
        alert("Please all Input Field is Required");
    } else {
        var form_id = jQuery(form).attr('id');
        const date2 = new Date();
        const date = date2.toDateString();
        var formdata = new FormData(form);
        formdata.append("action", "form_a_save_data");
        formdata.append("date", date);
        formdata.append("form_type", form_id);
        if (form_id == 'form_e') {
            var content = tinymce.get("form_e_text_editor").getContent();
            formdata.append("form_e_text_editor", content);
        }
        if (form_id == 'form_f') {
            var content = tinymce.get("form_f_text_editor").getContent();
            formdata.append("form_f_text_editor", content);
        }
        if (form_id == 'form_g') {
            var content = tinymce.get("form_g_text_editor").getContent();
            formdata.append("form_g_text_editor", content);
        }
        if (form_id == 'form_h') {
            var content = tinymce.get("form_h_text_editor").getContent();
            formdata.append("form_h_text_editor", content);
        }
        jQuery.ajax({
            url: 'admin-ajax.php',
            type: 'post',
            dataType: 'json',
            data: formdata,
            contentType: false,
            processData: false,
            success: function(response) {
                // console.log(response);
                if (response) {
                    alert(response.messege);
                    jQuery("#form_a").trigger("reset");
                    jQuery("#form_b").trigger("reset");
                    jQuery("#form_c").trigger("reset");
                    jQuery("#form_d").trigger("reset");
                    jQuery("#form_e").trigger("reset");
                    jQuery("#form_f").trigger("reset");
                    jQuery("#form_g").trigger("reset");
                    jQuery("#form_h").trigger("reset");
                }
            }
        });
    }
}
// Show data in form input box. For All form (A,B,C,D,E,F,G,H).
function populate_data() {
    var formdata = new FormData();
    formdata.append("action", "form_a_populate_data");
    formdata.append("page_name", page_name);
    jQuery.ajax({
        url: 'admin-ajax.php',
        type: 'post',
        data: formdata,
        contentType: false,
        processData: false,
        success: function(response) {
            // console.log(response);
            var form_type = response.form_type;
            var form_data = response.form_data;
            if (form_type == 'form_a' || form_type == 'form_b' || form_type == 'form_c' || form_type == 'form_d') {
                jQuery("#" + form_type + "_input_1").val(form_data[form_type + '_input_1']);
                jQuery("#" + form_type + "_input_2").val(form_data[form_type + '_input_2']);
                jQuery("#" + form_type + "_input_3").val(form_data[form_type + '_input_3']);
                jQuery("#" + form_type + "_input_4").val(form_data[form_type + '_input_4']);
                jQuery('input[name="' + form_type + '_radio_1"][value="' + form_data[form_type + '_radio_1'] + '"]').prop('checked', true);
                jQuery('input[name="' + form_type + '_radio_2"][value="' + form_data[form_type + '_radio_2'] + '"]').prop('checked', true);
                jQuery("#" + form_type + "_select_1").val(form_data[form_type + '_select_1']);
                jQuery("#" + form_type + "_select_2").val(form_data[form_type + '_select_2']);
                jQuery("#" + form_type + "_textarea").val(form_data[form_type + '_textarea']);
            }
            if (form_type == 'form_e' || form_type == 'form_f' || form_type == 'form_g' || form_type == 'form_h') {
                jQuery("#" + form_type + "_input_1").val(form_data[form_type + '_input_1']);
                jQuery("#" + form_type + "_input_2").val(form_data[form_type + '_input_2']);
                tinyMCE.get(form_type + '_text_editor').setContent(form_data[form_type + '_text_editor']);
                jQuery("#" + form_type + "_img").attr('src', 'http://localhost/wpproject/wp-content/uploads/2022/12/' + form_data[form_type + '_file'][0]);
            }
        }
    });
}
// Save data in database for Custom Schedule.
function schedule_data(form) {
    var formdata = new FormData(form);
    formdata.append("action", "schedule_form_data");
    jQuery.ajax({
        url: 'admin-ajax.php',
        type: 'post',
        data: formdata,
        contentType: false,
        processData: false,
        success: function(response) {
            // console.log(response);
            if (response) {
                alert(response.messege);
                schedule_populate_data();
            }
        }
    });
}

function schedule_populate_data() {
    var formdata = new FormData();
    formdata.append("action", "schedule_populate");
    formdata.append("page_name", page_name);
    jQuery.ajax({
        url: 'admin-ajax.php',
        type: 'post',
        data: formdata,
        contentType: false,
        processData: false,
        success: function(response) {
            if (response.is_monday == "True") {
                jQuery("#is_monday").prop("checked", true);
                jQuery('#monday_input_1').css("display", "block");
                jQuery('#monday_input_2').css("display", "block");
                jQuery('#start_monday').val(response.start_monday);
                jQuery('#end_monday').val(response.end_monday);
            }
            if (response.is_tuesday == "True") {
                jQuery("#is_tuesday").prop("checked", true);
                jQuery('#tuesday_input_1').css("display", "block");
                jQuery('#tuesday_input_2').css("display", "block");
                jQuery('#start_tuesday').val(response.start_tuesday);
                jQuery('#end_tuesday').val(response.end_tuesday);
            }
            if (response.is_wednesday == "True") {
                jQuery("#is_wednesday").prop("checked", true);
                jQuery('#wednesday_input_1').css("display", "block");
                jQuery('#wednesday_input_2').css("display", "block");
                jQuery('#start_wednesday').val(response.start_wednesday);
                jQuery('#end_wednesday').val(response.end_wednesday);
            }
            if (response.is_thursday == "True") {
                jQuery("#is_thursday").prop("checked", true);
                jQuery('#thursday_input_1').css("display", "block");
                jQuery('#thursday_input_2').css("display", "block");
                jQuery('#start_thursday').val(response.start_thursday);
                jQuery('#end_thursday').val(response.end_thursday);
            }
            if (response.is_friday == "True") {
                jQuery("#is_friday").prop("checked", true);
                jQuery('#friday_input_1').css("display", "block");
                jQuery('#friday_input_2').css("display", "block");
                jQuery('#start_friday').val(response.start_friday);
                jQuery('#end_friday').val(response.end_friday);
            }
            if (response.is_saturday == "True") {
                jQuery("#is_saturday").prop("checked", true);
                jQuery('#saturday_input_1').css("display", "block");
                jQuery('#saturday_input_2').css("display", "block");
                jQuery('#start_saturday').val(response.start_saturday);
                jQuery('#end_saturday').val(response.end_saturday);
            }
        }
    });
}

jQuery(document).ready(function() {
    //For Custom Search Data.
    jQuery("#search_key_user").keyup(function() {
        var search = $(this).val();
        var body_row = '';
        if (search != '') {
            jQuery.ajax({
                url: "admin-ajax.php",
                type: "POST",
                data: { 'search': search, "action": 'custom_search_user_data' },
                dataType: "json",
                success: function(response) {
                    console.log(response);
                    var x = response.search_data;
                    for (i = 0; i < x.length; i++) {
                        body_row += `<tr><td>${x[i].id}</</td><td>${x[i].user_id}</td><td>${x[i].meta_value}</td><td>${x[i].user_email}</td><td>${x[i].messege}</td></tr>`;
                    }
                    jQuery("#tbody_id_user").html(body_row);
                    $("#msg_user").text(response.messege);
                    $("#msg_user").css("display", "block");
                }
            });
        } else {
            custom_search_user(1);
            $("#msg_user").css("display", "none");
        }
    });
    //For Registration Search Data.
    jQuery("#search_key").keyup(function() {
        var search = $(this).val();
        var body_row = '';
        if (search != '') {
            jQuery.ajax({
                url: "admin-ajax.php",
                type: "POST",
                data: { 'search': search, "action": 'register_search_data' },
                dataType: "json",
                success: function(response) {
                    console.log(response);
                    var x = response.search_data;
                    for (i = 0; i < x.length; i++) {
                        body_row += `<tr><td>${x[i].id}</</td><td>${x[i].name}</td><td>${x[i].email}</td><td>${x[i].phone}</td></tr>`;
                    }
                    jQuery("#tbody_id").html(body_row);
                    $("#msg").text(response.messege);
                    $("#msg").css("display", "block");
                }
            });
        } else {
            show_data.show_register_data_function(1);
            $("#msg").css("display", "none");
        }
    });
    // For Custom Schedule Menu column Show and Hide.
    jQuery('#is_monday').click(function() {
        if (jQuery(this).is(':checked')) {
            jQuery('#monday_input_1').css("display", "block");
            jQuery('#monday_input_2').css("display", "block");
        } else {
            jQuery('#monday_input_1').css("display", "none");
            jQuery('#monday_input_2').css("display", "none");
        }
    });
    jQuery('#is_tuesday').click(function() {
        if (jQuery(this).is(':checked')) {
            jQuery('#tuesday_input_1').css("display", "block");
            jQuery('#tuesday_input_2').css("display", "block");
        } else {
            jQuery('#tuesday_input_1').css("display", "none");
            jQuery('#tuesday_input_2').css("display", "none");
        }
    });
    jQuery('#is_wednesday').click(function() {
        if (jQuery(this).is(':checked')) {
            jQuery('#wednesday_input_1').css("display", "block");
            jQuery('#wednesday_input_2').css("display", "block");
        } else {
            jQuery('#wednesday_input_1').css("display", "none");
            jQuery('#wednesday_input_2').css("display", "none");
        }
    });
    jQuery('#is_thursday').click(function() {
        if (jQuery(this).is(':checked')) {
            jQuery('#thursday_input_1').css("display", "block");
            jQuery('#thursday_input_2').css("display", "block");
        } else {
            jQuery('#thursday_input_1').css("display", "none");
            jQuery('#thursday_input_2').css("display", "none");
        }
    });
    jQuery('#is_friday').click(function() {
        if (jQuery(this).is(':checked')) {
            jQuery('#friday_input_1').css("display", "block");
            jQuery('#friday_input_2').css("display", "block");
        } else {
            jQuery('#friday_input_1').css("display", "none");
            jQuery('#friday_input_2').css("display", "none");
        }
    });
    jQuery('#is_saturday').click(function() {
        if (jQuery(this).is(':checked')) {
            jQuery('#saturday_input_1').css("display", "block");
            jQuery('#saturday_input_2').css("display", "block");
        } else {
            jQuery('#saturday_input_1').css("display", "none");
            jQuery('#saturday_input_2').css("display", "none");
        }
    });
    // For TinyMce Editor lock
    tinymce.init({
        selector: '#form_e_text_editor',
        height: '300px',
    });
    tinymce.init({
        selector: '#form_f_text_editor',
        height: '300px',
    });
    tinymce.init({
        selector: '#form_g_text_editor',
        height: '300px',
    });
    tinymce.init({
        selector: '#form_h_text_editor',
        height: '300px',
    });
    // populate_data();
    // schedule_populate_data();
    // show_data.show_register_data_function(1);
    custom_search_user(1);
    // For Select 2 In Meta box For Reciepe Post.
    //For Custom Product Select Retrieve Data.
    jQuery('.product-select-2-ajax').select2({
        data: [{ id: 8, text: 'Chiken' }],
        placeholder: "Select Product Name",
        ajax: {
            url: 'admin-ajax.php',
            type: 'GET',
            dataType: 'json',
            data: function(params) {
                var query = {
                    search: params.term,
                    action: 'product_select_data'
                }
                return query;
            },
            processResults: function(data) {
                return {
                    results: data,
                };
            },
            cache: true
        }
    });
    //For Custom Unit Select Retrieve Data.
    jQuery('.unit-select-2-ajax').select2({
        data: [{ id: 8, text: 'jar' }],
        placeholder: "Select Unit Name",
        ajax: {
            url: 'admin-ajax.php',
            type: 'GET',
            dataType: 'json',
            data: function(params) {
                var query = {
                    search: params.term,
                    action: 'unit_select_data'
                }
                return query;
            },
            processResults: function(data) {
                return {
                    results: data
                };
            }
        }
    });
});
//After Add Custom Meta Boxes Product Select Retrieve Data.
function product_select_2(element) {
    jQuery("#" + element).select2({
        placeholder: "Select Product Name",
        ajax: {
            url: 'admin-ajax.php',
            type: 'GET',
            dataType: 'json',
            data: function(params) {
                var query = {
                    search: params.term,
                    action: 'product_select_data'
                }
                return query;
            },
            processResults: function(data) {
                return {
                    results: data
                };
            }
        }
    });
}
//After Add Custom Meta Boxes Unit Select Retrieve Data.
function unit_select_2(element) {
    jQuery('#' + element).select2({
        placeholder: "Select Unit Name",
        ajax: {
            url: 'admin-ajax.php',
            type: 'GET',
            dataType: 'json',
            data: function(params) {
                var query = {
                    search: params.term,
                    action: 'unit_select_data'
                }
                return query;
            },
            processResults: function(data) {
                return {
                    results: data
                };
            }
        }
    });
}
// For Custom User Pagination And Show Data.bootpage: null,
function custom_search_user(page) {
    var formdata = new FormData();
    formdata.append("action", "show_custom_search_user");
    formdata.append("page", page);
    jQuery.ajax({
        url: 'admin-ajax.php',
        type: 'post',
        dataType: 'json',
        data: formdata,
        contentType: false,
        processData: false,
        success: function(response) {
            console.log(response);
            var x = response;
            var body_row = '';
            for (i = 0; i < x.length; i++) {
                body_row += `<tr><td>${x[i].id}</</td><td>${x[i].user_id}</td><td>${x[i].meta_value}</td><td>${x[i].user_email}</td><td>${x[i].messege}</td></tr>`;
            }
            jQuery("#tbody_id_user").html(body_row);
        }
    });
}