<?php
 /*
 Plugin Name:Custom Plugin Backend
 Description:This is custom plugin for Backend purpose.
 Version:1.0.0
 Author:Adnan
 */

 /* Create Manger & Employee User Role */
add_role(
    'manager', //  System name of the role.
    __( 'Manager'  ), // Display name of the role.
    array(
        'read'  => true,
        'delete_posts'  => true,
        'delete_published_posts' => true,
        'edit_posts'   => true,
        'publish_posts' => true,
        'edit_published_posts'   => true,
        'upload_files'  => true,
        'moderate_comments'=> true, // This user will be able to moderate the comments.
    )
);
add_role(
    'employee',
    __( 'Employee'  ),
    array(
        'read'  => true,
        'delete_posts'  => true,
        'delete_published_posts' => true,
        'edit_posts'   => true,
        'publish_posts' => true,
        'edit_published_posts'   => true,
        'upload_files'  => true,
        'moderate_comments'=> true,
    )
);

define("PLUGIN_DIR_PATH",plugin_dir_path(__FILE__));
define("PLUGIN_URL",plugins_url());

// add_action( 'wp_enqueue_scripts', 'themeslug_enqueue_script' );
// function themeslug_enqueue_script() {
//     wp_register_script( 'theme-js', plugin_dir_url(__FILE__).'/assets/js/script.js', false );
// }

add_action( 'admin_enqueue_scripts', 'wpdocs_theme_name_scripts' );
function wpdocs_theme_name_scripts()
{
    wp_enqueue_style( 'font-css','https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css',array(),false);
    wp_enqueue_style( 'select-css','https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css',array(),false);
    wp_enqueue_style( 'my-bootsrtap1','https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css',array(),false);
    wp_enqueue_style( 'my-bootsrtap2','https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css',array(),false);
    wp_enqueue_script( 'my-bootsrtap3','https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js',array(),true);
    wp_enqueue_script( 'my-bootsrtap4','https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js',array(),true);
    wp_enqueue_script( 'jquery-cdn1','https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js',array(),true);
    wp_enqueue_script( 'jquery-cdn2','https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.js',array(),true);
    wp_enqueue_script( 'bootpag-cdn1','https://cdnjs.cloudflare.com/ajax/libs/jquery-bootpag/1.0.4/jquery.bootpag.min.js',array(),true);
    wp_enqueue_script( 'bootpag-cdn2','https://cdnjs.cloudflare.com/ajax/libs/jquery-bootpag/1.0.4/jquery.bootpag.js',array(),true);
    wp_enqueue_script( 'my-axios','https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js',array(),true);
    wp_enqueue_script( 'select-js','https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',array(),true);
    // wp_enqueue_script( 'text-editor-tinymce','https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js',array(),true);
    if (@$_GET['page']=='custom-forms'||@$_GET['page']=='form-a'||@$_GET['page']=='form-b'||@$_GET['page']=='form-c'||@$_GET['page']=='form-d'||@$_GET['page']=='form-e'||@$_GET['page']=='form-f'||@$_GET['page']=='form-g'||@$_GET['page']=='form-h')
    {
        wp_enqueue_style('style-css', PLUGIN_URL.'/custom-plugin-backend/assets/css/style.css', '', '1.0.0');
    }
    if (@$_GET['page']=='custom-schedule')
    {
        wp_enqueue_style('toggle-css', PLUGIN_URL.'/custom-plugin-backend/assets/css/toggle.css', '', '1.0.0');
    }
    if (@$_GET['page']=='register'||@$_GET['page']=='custom-search-user')
    {
        wp_enqueue_style('register-css', PLUGIN_URL.'/custom-plugin-backend/assets/css/paginate.css', '', '1.0.0');
    }
    wp_enqueue_script( 'script-js',PLUGIN_URL.'/custom-plugin-backend/assets/js/script.js',array(),'1.0.0',false );
    wp_enqueue_script( 'tinymce-js',PLUGIN_URL.'/custom-plugin-backend/assets/js/tinymce/tinymce.min.js',array(),false );   
}
// Create Menu
add_action('admin_menu','custom_admin_menu');
function custom_admin_menu()
{
    if(is_user_logged_in())
    {
        $user = wp_get_current_user();
        $role = (array)$user->roles;
        if(in_array('subscriber',$role)){
            // Redirect browser
            header("Location: http://localhost/wpproject/");
            exit;
        }
    }
    add_menu_page(
        'Custom Search User',
        'Custom Search User',
        'manage_options',
        'custom-search-user',
        'custom_search_user',
        'dashicons-cart',
        11
    );
    add_menu_page(
        'Register',
        'Register',
        'manage_options',
        'register',
        'register',
        'dashicons-cart',
        12
    );
    add_menu_page(
        'Custom Schedule',
        'Custom Schedule',
        'manage_options',
        'custom-schedule',
        'custom_schedule',
        'dashicons-cart',
        13
    );
    add_menu_page(
        'Custom Forms',
        'Custom Forms',
        'manage_options',
        'custom-forms',
        'custom_forms',
        'dashicons-cart',
        14
    );
    add_submenu_page(
        'custom-forms',
        'Form A',
        null,
        'manage_options',
        'form-a',
        'form_a'
    );
    add_submenu_page(
        'custom-forms',
        'Form B',
        null,
        'manage_options',
        'form-b',
        'form_b'
    );
    add_submenu_page(
        'custom-forms',
        'Form C',
        null,
        'manage_options',
        'form-c',
        'form_c'
    );
    add_submenu_page(
        'custom-forms',
        'Form D',
        null,
        'manage_options',
        'form-d',
        'form_d'
    );
    add_submenu_page(
        'custom-forms',
        'Form E',
        null,
        'manage_options',
        'form-e',
        'form_e'
    );
    add_submenu_page(
        'custom-forms',
        'Form F',
        null,
        'manage_options',
        'form-f',
        'form_f'
    );
    add_submenu_page(
        'custom-forms',
        'Form G',
        null,
        'manage_options',
        'form-g',
        'form_g'
    );
    add_submenu_page(
        'custom-forms',
        'Form H',
        null,
        'manage_options',
        'form-h',
        'form_h'
    );
}
// Callback function for Menu
function custom_search_user()
{
    include_once(PLUGIN_DIR_PATH."views/custom-search-user.php");
}
function register()
{
    include_once(PLUGIN_DIR_PATH."views/register.php");
}
function custom_schedule()
{
    include_once(PLUGIN_DIR_PATH."views/custom-schedule.php");
}
function custom_forms()
{
    include_once(PLUGIN_DIR_PATH."views/custom-forms.php");
}
function form_a()
{
    include_once(PLUGIN_DIR_PATH."views/form-a.php");
}
function form_b()
{
    include_once(PLUGIN_DIR_PATH."views/form-b.php");
}
function form_c()
{
    include_once(PLUGIN_DIR_PATH."views/form-c.php");
}
function form_d()
{
    include_once(PLUGIN_DIR_PATH."views/form-d.php");
}
function form_e()
{
    include_once(PLUGIN_DIR_PATH."views/form-e.php");
}
function form_f()
{
    include_once(PLUGIN_DIR_PATH."views/form-f.php");
}
function form_g()
{
    include_once(PLUGIN_DIR_PATH."views/form-g.php");
}
function form_h()
{
    include_once(PLUGIN_DIR_PATH."views/form-h.php");
}
//  Create Meta Boxes.
add_action( 'add_meta_boxes', 'register_meta_boxes' );
function register_meta_boxes()
{
    add_meta_box(
        'meta-1',
        'Product',
        'meta_boxes_callback',
        'receipe'
    );
}
function meta_boxes_callback( $post )
{
    include_once(PLUGIN_DIR_PATH."views/meta-boxes.php");
}
// Product Retrieve Data in to Database for (select2 )
add_action( "wp_ajax_product_select_data",'custom_product_select_data' );
function custom_product_select_data()
{
    $args = array(
        'post_type'		=> 'products'
    );
    $products_posts = get_posts( $args );
    $product=[];
    foreach($products_posts as $post)
    {
        $product['id'] = $post->ID;
        $product['text'] = $post->post_title;
        $results[] = $product;
    }
    wp_send_json($results,200);
}
// Unit Retrieve Data in to Database for (select2 )
add_action( "wp_ajax_unit_select_data",'custom_unit_select_data' );
function custom_unit_select_data()
{
    $args = array(
        'post_type'		=> 'unit'
    );
    $unit_posts = get_posts( $args );
    $unit=[];
    foreach($unit_posts as $post)
    {
        $unit['id'] = $post->ID;
        $unit['text'] = $post->post_title;
        $results[] = $unit;
    }
    wp_send_json($results,200);
}
// Insert Data in to Database for (select2 ) meta box data.
add_action('save_post', 'cd_save_custom_metabox');
function cd_save_custom_metabox($post_id)
{
    $post_type = get_post_type();
    if($post_type=="receipe")
    {
        $product_name = $_POST['product_name'];
        $quantity = $_POST['quantity'];
        $unit = $_POST['unit'];
        if(!empty($product_name))
        {
            update_post_meta($post_id, "product_name", $product_name);
        }
        if(!empty($quantity))
        {
            update_post_meta($post_id, "quantity", $quantity);
        }
        if(!empty($unit))
        {
            update_post_meta($post_id, "unit", $unit);
        }
    }
}
// Custom Form (A, B, C, D, E, F, G, H) Data in to Database Save Json Format And Update.
add_action( "wp_ajax_form_a_save_data",'custom_form_a_save_data' );
function custom_form_a_save_data()
{
    if ($_POST){
        global $wpdb;
        $tablename = $wpdb->prefix.'custom_form';
        $form_type = $_POST['form_type'];
        $date = $_POST['date'];
        if($form_type=='form_a'||$form_type=='form_b'||$form_type=='form_c'||$form_type=='form_d')
        {
            $store_data = array(
                $form_type.'_input_1'=>$_POST[$form_type.'_input_1'],
                $form_type.'_input_2'=>$_POST[$form_type.'_input_2'],
                $form_type.'_input_3'=>$_POST[$form_type.'_input_3'],
                $form_type.'_input_4'=>$_POST[$form_type.'_input_4'],
                $form_type.'_radio_1'=>$_POST[$form_type.'_radio_1'],
                $form_type.'_radio_2'=>$_POST[$form_type.'_radio_2'],
                $form_type.'_select_1'=>$_POST[$form_type.'_select_1'],
                $form_type.'_select_2'=>$_POST[$form_type.'_select_2'],
                $form_type.'_textarea'=>$_POST[$form_type.'_textarea']
           );
        }        
        if($form_type=='form_e'||$form_type=='form_f'||$form_type=='form_g'||$form_type=='form_h')
        {
            $store_data = array(
                $form_type.'_input_1'=>$_POST[$form_type.'_input_1'],
                $form_type.'_input_2'=>$_POST[$form_type.'_input_2'],
                $form_type.'_text_editor'=>$_POST[$form_type.'_text_editor'],
                $form_type.'_file'=>$_FILES[$form_type.'_file']['name']
           );
        }       
        $record = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM {$wpdb->prefix}custom_form WHERE form_type = '$form_type'" ) );
        if($record)
        {
            $json_data = json_encode($store_data);
            $results = $wpdb->update($tablename, array(
                'form_data'=>$json_data,
                'updated_date'=>$date
            ), 
            array('id'=>$record->id));
            $messege = "Updated Form Data Succesfully.";
        }
        else
        {
            $user_id = rand(100,999);
            $json_data = json_encode($store_data);
            $results = $wpdb->insert( $tablename,array(
                'user_id'=>$user_id,
                'form_type'=>$form_type,
                'form_data'=>$json_data,
                'date'=>$date,
                'updated_date'=>$date
            ));
            $messege = "Submitted Form Data Succesfully.";
        }
    }
    $All = array("data"=>$results,"messege"=>$messege);
    wp_send_json($All,200);
}
// Custom Form (A, B, C, D, E, F, G, H) Data is Populate.
add_action( "wp_ajax_form_a_populate_data",'custom_form_a_populate_data' );
function custom_form_a_populate_data()
{
    global $wpdb;
    $total_data = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}custom_form",ARRAY_A);    
    foreach($total_data as $data)
    {
        $form_a = $_POST['page_name']=='form-a' && $data['form_type'] == 'form_a';
        $form_b = $_POST['page_name']=='form-b' && $data['form_type'] == 'form_b';
        $form_c = $_POST['page_name']=='form-c' && $data['form_type'] == 'form_c';
        $form_d = $_POST['page_name']=='form-d' && $data['form_type'] == 'form_d';
        $form_e = $_POST['page_name']=='form-e' && $data['form_type'] == 'form_e';
        $form_f = $_POST['page_name']=='form-f' && $data['form_type'] == 'form_f';
        $form_g = $_POST['page_name']=='form-g' && $data['form_type'] == 'form_g';
        $form_h = $_POST['page_name']=='form-h' && $data['form_type'] == 'form_h';
        if($form_a || $form_b || $form_c || $form_d || $form_e || $form_f || $form_g || $form_h)
        {
            $fom_data = $data['form_data'];
            $form_data['form_data']= json_decode($fom_data);
            $form_data['form_type']= $data['form_type'];
        }
    }
    wp_send_json($form_data);
}

// Custom schedule form data Data in to Database Save And Update.
add_action( "wp_ajax_schedule_form_data",'custom_schedule_form_data' );
function custom_schedule_form_data()
{
    if ($_POST){
        global $wpdb;
        $tablename = $wpdb->prefix.'custom_schedule';
        if(isset($_POST['is_monday']))
        {
            $monday = "True";
        }
        else
        {
            $monday = "False";
        }
        if(isset($_POST['is_tuesday']))
        {
            $tuesday = "True";
        }
        else
        {
            $tuesday = "False";
        }
        if(isset($_POST['is_wednesday']))
        {
            $wednesday = "True";
        }
        else
        {
            $wednesday = "False";
        }
        if(isset($_POST['is_thursday']))
        {
            $thursday = "True";
        }
        else
        {
            $thursday = "False";
        }
        if(isset($_POST['is_friday']))
        {
            $friday = "True";
        }
        else
        {
            $friday = "False";
        }
        if(isset($_POST['is_saturday']))
        {
            $saturday = "True";
        }
        else
        {
            $saturday = "False";
        }
        $record = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM {$wpdb->prefix}custom_schedule WHERE id = 2" ) );
        if($record)
        {
            $results = $wpdb->update($tablename, array(
                'is_monday'=>$monday,
                'start_monday'=>$_POST['start_monday'],
                'end_monday'=>$_POST['end_monday'],
                'is_tuesday'=>$tuesday,
                'start_tuesday'=>$_POST['start_tuesday'],
                'end_tuesday'=>$_POST['end_tuesday'],
                'is_wednesday'=>$wednesday,
                'start_wednesday'=>$_POST['start_wednesday'],
                'end_wednesday'=>$_POST['end_wednesday'],
                'is_thursday'=>$thursday,
                'start_thursday'=>$_POST['start_thursday'],
                'end_thursday'=>$_POST['end_thursday'],
                'is_friday'=>$friday,
                'start_friday'=>$_POST['start_friday'],
                'end_friday'=>$_POST['end_friday'],
                'is_saturday'=>$saturday,
                'start_saturday'=>$_POST['start_saturday'],
                'end_saturday'=>$_POST['end_saturday'],
            ), 
            array('id'=>$record->id));
            $messege = "Updated Schedule Succesfully.";
        }
        else
        {
            $uniq_id = rand(100,999);
            $results = $wpdb->insert( $tablename,array(
                'uniq_id'=>$uniq_id,
                'is_monday'=>$monday,
                'start_monday'=>$_POST['start_monday'],
                'end_monday'=>$_POST['end_monday'],
                'is_tuesday'=>$tuesday,
                'start_tuesday'=>$_POST['start_tuesday'],
                'end_tuesday'=>$_POST['end_tuesday'],
                'is_wednesday'=>$wednesday,
                'start_wednesday'=>$_POST['start_wednesday'],
                'end_wednesday'=>$_POST['end_wednesday'],
                'is_thursday'=>$thursday,
                'start_thursday'=>$_POST['start_thursday'],
                'end_thursday'=>$_POST['end_thursday'],
                'is_friday'=>$friday,
                'start_friday'=>$_POST['start_friday'],
                'end_friday'=>$_POST['end_friday'],
                'is_saturday'=>$saturday,
                'start_saturday'=>$_POST['start_saturday'],
                'end_saturday'=>$_POST['end_saturday'],
            ));
            $messege = "Submitted Schedule Succesfully.";
        }
    }
    $All = array("data"=>$results,"messege"=>$messege);
    wp_send_json($All,200);
}
// Custom Schedule Data is Populate.
add_action( "wp_ajax_schedule_populate",'custom_schedule_populate' );
function custom_schedule_populate()
{
    global $wpdb;
    $total_data = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}custom_schedule",ARRAY_A);
    // $store=[];
    foreach($total_data as $data)
    {
        // $store['monday'] = $data['is_monday'];
        // $store['start_monday'] = $data['start_monday'];
        // $store['end_monday'] = $data['end_monday'];
        // print_r($data);
        // die;
    }
    wp_send_json($data);
}

// Insert Data in to Database For Registration Page
add_action( "wp_ajax_save_register_form_data",'custom_save_register_form_data' );
function custom_save_register_form_data()
{
    if ($_POST){
        global $wpdb;
        $tablename = $wpdb->prefix.'custom_registration';
        $data = array(
           'name' => $_POST['name'], 
           'email' => $_POST['email'],
           'password' => $_POST['password'], 
           'phone' => $_POST['phone']
       );
       if(email_exists($_POST['email']))
        {
            $error = "Email is Already Registered.";
        }
        else
        {
            $results = $wpdb->insert( $tablename,$data);
        }
        $response = array("results"=>$results,"error"=>$error);
        wp_send_json($response,200);
    }
}

// Show Data and Pagination from Registration Form Data.
add_action( "wp_ajax_show_register_form_data",'custom_show_register_form_data' );
function custom_show_register_form_data()
{
    global $wpdb;
    $record_per_page = 3;
    $messege = '';
    $page = '';
    if (isset($_POST["page"])) { 
        $page  = $_POST["page"];
    } else { 
        $page=1; 
    }
    $start_from = ($page-1) * $record_per_page;
    $page_results = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}custom_registration ORDER BY id DESC LIMIT $start_from,$record_per_page", ARRAY_A );
    $total_records = $wpdb->get_var( "SELECT count(*) FROM {$wpdb->prefix}custom_registration");
    $total_pages = ceil($total_records/$record_per_page);
    $data = [];
    $data['page_results'] = $page_results;
    $data['record_per_page'] = $record_per_page;
    $data['total_records'] = $total_records;
    $data['current_page'] = $page;
    $data['total_pages'] = $total_pages;
    wp_send_json($data,200);
}
// Register Search Data With Ajax.
add_action( "wp_ajax_register_search_data",'custom_register_search_data' );
function custom_register_search_data()
{
    if (!empty($_POST["search"]))
    { 
        global $wpdb;
        // $search_data = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}custom_registration where name = '{$_POST['search']}'");
        $search_data = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}custom_registration where name like '%".$_POST["search"]."%'");
        if(empty($search_data))
        { 
            $messege = "No Matching Records Found";
        }
    }
    $All = array("search_data"=>$search_data,"messege"=>$messege);
    wp_send_json($All,200);
}

// // In Post_Type form for add enctype.
// add_action('post_edit_form_tag', 'add_post_enctype');
// function add_post_enctype() {
//     echo ' enctype="multipart/form-data"';
// }

// // Multiple Images Are Saved in DB.
// add_action('save_post', 'cdf_save_custom_metabox');
// function cdf_save_custom_metabox($post_id){
//     $file_name = ($_FILES['file']['name']);
//     if(!empty($file_name))
//     {
//         update_post_meta($post_id, "file_value", $file_name);
//     }
// }


// For Remove Howdy in Admin Toolbaar & Display Mr. and Mis for Current User.
add_filter('admin_bar_menu', 'change_howdy_in_toolbar', 20);
function change_howdy_in_toolbar($wp_admin_bar){
    $current_user = wp_get_current_user();
    $user_id = $current_user->ID;
    $gender = get_user_meta($user_id,"gender",true);
    if($gender == "Male")
    {
        $replaceWithThis ="Mr ".$current_user->display_name;
    }
    else
    {
        $replaceWithThis ="Mis ".$current_user->display_name;
    }
    $node = array(
        'id' => 'my-account',
        'title' => $replaceWithThis
    );
    $wp_admin_bar->add_node($node);
}
// For Remove Metaboxes In Dashboard.
add_action('wp_dashboard_setup', 'wpdocs_remove_dashboard_widgets');
function wpdocs_remove_dashboard_widgets(){
    remove_meta_box('dashboard_quick_press', 'dashboard', 'side'); //Removes the 'Quick Draft'
    remove_meta_box( 'dashboard_primary',       'dashboard', 'side' ); //Removes the 'wordpress Events And News'
    remove_meta_box('dashboard_right_now', 'dashboard', 'normal'); //Removes the 'At a Glance' widget
    remove_meta_box('dashboard_activity', 'dashboard', 'normal'); //Removes the 'Activity' widget
    remove_meta_box('dashboard_site_health', 'dashboard', 'normal'); //Removes the 'Site Health Status' widget
}
// For Remove Welcome Panel in Dashboard.
add_action('admin_init',function(){
    remove_action('welcome_panel', 'wp_welcome_panel');
});
// For Remove New-Content & Comments In Admin Toolbaar.
add_action( 'wp_before_admin_bar_render', 'remove_new_content' );
function remove_new_content(){
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu( 'new-content' );
    $wp_admin_bar->remove_menu( 'comments' );
}
// Show Data and Pagination from Custom Search User Data.
add_action( "wp_ajax_show_custom_search_user",'custom_show_custom_search_user' );
function custom_show_custom_search_user()
{
    global $wpdb;
    $table_1 = $wpdb->prefix.'custom_search_user';
    $table_2 = $wpdb->prefix.'users';
    $table_3 = $wpdb->prefix.'usermeta';
     $page_results = $wpdb->get_results( "SELECT * FROM $table_1 INNER JOIN $table_2 on $table_1.user_id=$table_2.ID INNER JOIN $table_3 on $table_1.user_id=$table_3.user_id AND $table_3.meta_key='first_name'", ARRAY_A );
    // $page_results .= $wpdb->get_results( "SELECT * FROM $table_1 INNER JOIN $table_2 on $table_1.user_id=$table_2.ID INNER JOIN $table_3 on $table_1.user_id=$table_3.user_id AND $table_3.meta_key='last_name'", ARRAY_A );
    wp_send_json($page_results,200);
}

// Custom Search User Data With Ajax.
add_action( "wp_ajax_custom_search_user_data",'custom_custom_search_user_data' );
function custom_custom_search_user_data()
{
    if (!empty($_POST["search"]))
    { 
        global $wpdb;
        $table_1 = $wpdb->prefix.'custom_search_user';
        $table_2 = $wpdb->prefix.'users';
        $table_3 = $wpdb->prefix.'usermeta';
        $search_data = $wpdb->get_results( "SELECT * FROM $table_1 INNER JOIN $table_2 on $table_1.user_id=$table_2.ID INNER JOIN $table_3 on $table_1.user_id=$table_3.user_id AND $table_3.meta_key='first_name'  where $table_3.meta_value like '%".$_POST["search"]."%'", ARRAY_A );
        if(empty($search_data))
        {
            $messege = "No Matching Records Found";
        }
    }
    $All = array("search_data"=>$search_data,"messege"=>$messege);
    wp_send_json($All,200);
}
// For Add Column in User List Table.
add_filter( 'manage_users_columns', 'modify_user_table' );
function modify_user_table( $column ) {
    $column['status'] = 'Status';
    return $column;
 }
add_filter( 'manage_users_custom_column', 'modify_user_table_row', 10, 3 );
function modify_user_table_row( $val, $column_name, $user_id ) { 
    global $wpdb;
    if ($column_name == 'status') {
        return '<select name="" id="">
        <option value="approve">Approve</option>
        <option value="deny">Deny</option>
        </select>'; 
    }
    return $val;
 }













// // Show Data and Pagination from Registration Form Data.
// add_action( "wp_ajax_show_register_form_data",'custom_show_register_form_data' );
// function custom_show_register_form_data()
// {
//     // wp_create_user('user_female', 'user_female', 'user_female@gmail.com');
//     global $wpdb;
//     $record_per_page = 3;
//     $messege = '';
//     $page = '';
//     if (isset($_POST["page"])) { 
//         $page  = $_POST["page"];
//     } else { 
//         $page=1; 
//     }
//     $start_from = ($page-1) * $record_per_page;
//     $args = array(
//         'post_type' => 'page',
//         'post_status' => 'publish',
//         'posts_per_page' => $record_per_page,
//         'offset' => $start_from,
        
//     );
//     $the_query = new WP_Query($args);
//     $total_records  = $the_query->found_posts;
//     $total_pages = ceil($total_records/$record_per_page);
//     $post = $the_query->posts;
//     $response = [];
//     foreach($post as $arr)
//     {
//         $results['id'] = $arr->ID;
//         $results['title'] = $arr->post_title;
//         $results['date'] = $arr->post_modified;
//         $results['content'] = $arr->post_content;
//         $results['status'] = $arr->post_status;
//         $response[] = $results;
//     }
//     $data = [];
//     $data['message'] = "Get Posts Successfully";
//     $data['status'] = "Success";
//     $data['data'] = $response;
//     $data['total_records'] = $total_records;
//     $data['current_page'] = $page;
//     $data['total_pages'] = $total_pages;
//     wp_send_json($data,200);
// }
?>
