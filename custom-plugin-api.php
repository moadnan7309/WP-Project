<?php
 /*
 Plugin Name:Custom Plugin API
 Description:This is custom plugin for Api purpose.
 Version:1.0.0
 Author:Adnan
 */
 
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class REST_APIS extends WP_REST_Controller
{
    private $api_namespace;
    private $api_version;
    public $user_token;
    public $user_id;

    public function __construct()
    {
        $this->api_namespace = "api/v";
        $this->api_version = "1";
        $this->init();
        $headers = getallheaders();
        if(isset($headers['Authorization']))
        {
            if(preg_match('/Bearer\s(\S+)/',$headers['Authorization'],$matches))
            {
                $this->user_token = $matches[1];
            }
        }
    }
    
    private function successResponse($message='',$data=array(),$total=array())
    {
        $response = array();
        $response['status'] = "Success";
        $response['error_type'] = "";
        $response['message'] = $message;
        $response['data'] = $data;
        if(!empty($total))
        {
            $response['pagination'] = $total;
        }
        return new WP_REST_Response($response, 200);
    }

    private function errorResponse($message='',$type='ERROR')
    {
        $response = array();
        $response['status'] = "failed";
        $response['error_type'] = $type;
        $response['message'] = $message;
        $response['data'] = array();
        return new WP_REST_Response($response, 400);
    }

    public function register_routes()
    {
        $namespace =$this->api_namespace . $this->api_version;
        $privateItems = array('get_profile_by_id');
        $getItems = array('get_posts_api');
        $publicItems = array('register_user','forget_password','verify_otp','reset_password','user_role_register','forget_user_role_login','user_role_login','create_post');
        foreach($privateItems as $Items)
        {
            register_rest_route($namespace,"/".$Items,array(
                array(
                    "methods" => "POST",
                    "callback" => array($this,$Items),
                    "permission_callback" => !empty($this->user_token)?'__return_true':'__return_false'
                ),
            ));
        }
        foreach($getItems as $Items)
        {
            register_rest_route($namespace,"/".$Items,array(
                array(
                    "methods" => "GET",
                    "callback" => array($this, $Items)
                ),
            ));
        }
        foreach($publicItems as $Items)
        {
            register_rest_route($namespace,"/".$Items,array(
                array(
                    "methods" => "POST",
                    "callback" => array($this, $Items)
                ),
            ));
        }
    }

    public function init()
    {
        add_action('rest_api_init',array($this,'register_routes'));
        add_action('rest_api_init',function()
        {
            remove_filter('rest_pre_serve_request','rest_send_cors_headers');
            add_filter('rest_pre_serve_request',function($value)
            {
                header('Access-Control-Allow-Origin: *');
                header('Access-Control-Allow-Methods: POST,GET,PUT,OPTIONS,DELETE');
                header('Access-Control-Allow-Credentials: true');
                return $value;
            });
        },15);
    }

    public function isUserExists($user)
    {
        global $wpdb;
        $count = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM $wpdb->users WHERE ID = %d",$user));
        if($count == 1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function getUserIdByToken($token)
    {
        $decoded_array = array();
        if($token)
        {
            try
            {
                // $decoded = JWT::decode($token,JWT_AUTH_SECRET_KEY,array('HS256'));
                $decoded = JWT::decode($token, new Key(JWT_AUTH_SECRET_KEY, 'HS256'));
                $decoded_array = (array) $decoded;
            }
            catch(\Firebase\JWT\ExpiredException $e)
            {
                return false;
            }
        }
        if(count($decoded_array) > 0)
        {
            $user_id = $decoded_array['data']->user->id;
        }
        if($this->isUserExists($user_id))
        {
            return $user_id;
        }
        else
        {
            return false;
        }
    }

    function jwt_auth($data,$user)
    {
        unset($data['user_nicename']);
        unset($data['user_display_name']);
        $site_url = site_url();
        $result = $this->get_profile($user->ID);
        $result['token'] = $data['token'];
        return $this->successResponse('User Logged in successfully',$result);
    }

    private function isValidToken()
    {
        $this->user_id = $this->getUserIdByToken($this->user_token);
    }

    public function get_profile($user_id)
    {
        global $wpdb;
        $userInfo = get_user_by('ID',$user_id);
        $first_name = get_user_meta($user_id,"first_name",true);
        $last_name = get_user_meta($user_id,"last_name",true);
        $f_name = !empty($first_name)?$first_name:"";
        $l_name = !empty($last_name)?$last_name:"";
        $full_name = $f_name." ".$l_name;
        $result = array(
            "user_id" => $userInfo->ID,
            "user_email" => $userInfo->user_email,
            "full_name" => $full_name,
        );
        if(!empty($userInfo))
        {
            return $result;
        }
        else
        {
            return 0;
        }

    }

    public function get_profile_by_id($request)
    {
        global $wpdb;
        $param = $request->get_params();
        $this->isValidToken();
        $user_id = isset($this->user_id)?$this->user_id:$param['user_id'];
        if(empty($user_id))
        {
            return $this->errorResponse('Please Enter Valid Token.');
        }
        else
        {
            $userInfo = get_userdata($user_id);
            $user_email = $userInfo->user_email;
            $f_name = get_user_meta($user_id,"first_name",true);
            $l_name = get_user_meta($user_id,"last_name",true);
            $first_name = isset($f_name)?$f_name:"";
            $last_name = isset($l_name)?$l_name:"";
            $full_name = $first_name." ".$last_name;
            $user_array[]=array(
                "id" => $user_id,
                "email" => $user_email,
                "name" => $full_name
            );
            return $this->successResponse('User Get Successfully.',$user_array);
        }
    }
    

    // For User Register.
    public function register_user($request)
    {
        global $wpdb;
        $param = $request->get_params();
        $first_name = $param['first_name'];
        $last_name = $param['last_name'];
        $email = $param['email'];
        $phone = $param['phone_no'];
        $password = $param['password'];
        $user_id = wp_create_user($email,$password,$email);
        update_user_meta($user_id,"first_name",$first_name);
        update_user_meta($user_id,"last_name",$last_name);
        update_user_meta($user_id,"phone_no",$phone);
        return $this->successResponse('User registered successfully.');
    }

    // For Send OTP for Mail.
    public function forget_password($request)
    {
        global $wpdb;
        $param = $request->get_params();
        $user_login = sanitize_text_field($param['email']);
        if(empty($user_login))
        {
             return $this->errorResponse('User email is empty');
        }
        elseif(!is_email($user_login))
        {
            return $this->errorResponse('Please provide valid email');
        }
        elseif(strpos($user_login,'@'))
        {
            $user_data = get_user_by('email',trim($user_login));
        }
        if(!$user_data)
        {
           return $this->errorResponse('Email not matched with our records');
        }
        $user_email=$user_data->user_email;
        $user_id=$user_data->ID;
        if($user_id > 0)
        {
            $digits = 4;
            $rand_pass = rand(1000,9999);
            $meta_otp=update_user_meta($user_id,"otp",$rand_pass);
            update_user_meta($user_id,'otp_send_time',date('Y-m-d h:i:s'));
            if($meta_otp)
            {
                $message = "4 digit configuration code $rand_pass";
                $message = __('Hello ,') . "<br><br>";
                $message .= __('You recently created account with email <b>'.$user_email.'</b> on <b>Legacy Care Giving</b>.<br>To verify this
                email address belongs to you, please enter the code below on the email on your confirmation page') . "<br><br>";
                $message .=__('<big><b> '.$rand_pass.'<b></big>')."<br><br>";
                $message .= __('Sincerely') . "<br>";
                $message .= __('Support Team') . "<br>";
                $subject = "Confirmation code for Legacy Care Giving";
                $admin_email = get_option('admin_email');
                $headers[] = 'From: Wordpress<'.$admin_email.'>';
                wp_mail($user_email,$subject,$message, $headers);
                $result = array(
                    "user_email" => $user_email,
                    "user_id"    => $user_id
                );
                return $this->successResponse('A Special code has been sent to your email.',$result);   
            }
            else
            {
                return $this->errorResponse('Something Went Wrong');
            }
        }
    }
    // For verify otp.
    public function verify_otp($request)
    {
        global $wpdb;
        $param = $request->get_params();
        $user_login = $param['email'];
        $verify_otp = $param['forget_otp'];
        $user_info = get_user_by('email',$user_login);
        $user_email = $user_info->user_email;
        $user_id=$user_info->ID;
        if($user_id)
        {
            if(empty($verify_otp))
            {
                return $this->errorResponse('Otp field is empty');
            }
            else
            {
                $user_meta_otp = get_user_meta($user_id,"otp",true);
                if($user_meta_otp == $verify_otp)
                {
                    add_user_meta($user_id,'verify_otp',$verify_otp,true);
                    update_user_meta($user_id,'otp_send_time',null);
                    update_user_meta($user_id,'otp',null);
                    return $this->successResponse('OTP Verified Successfully');
                }
                else
                {
                    return $this->errorResponse('Please Enter Valid OTP');
                }
            }
        }
    }
    // For Create New password.
    public function reset_password($request)
    {
        global $wpdb;
        $param = $request->get_params();
        $user_login = $param['email'];
        $password = $param['password'];
        $confirm_password = $param['confirm_password'];
        $user_info = get_user_by('email',$user_login);
        $user_email = $user_info->user_email;
        $user_id = $user_info->ID;
        $verify_otp = get_user_meta($user_id,'verify_otp',true);
        if($user_id)
        {
            if($verify_otp)
            {
                if($password === $confirm_password)
                {
                    wp_set_password($password,$user_id);
                    update_user_meta($user_id,'verify_otp',null);
                    return $this->successResponse('Your Password has been changed!');
                }
                else
                {
                    return $this->errorResponse('Password does not match. Please try again!');
                }
            }
            else
            {
                return $this->errorResponse('OTP does not Verify. Please try again!');
            }
        }
        else
        {
            return $this->errorResponse('User not found.');
        }
    }

    // For User Role Register.
    public function user_role_register($request)
    {
        global $wpdb;
        $param = $request->get_params();
        $user_data = [];
        $user_data['ID'] = @$param['ID'];
        $user_data['role'] = strtolower($param['role']);
        $user_data['user_login'] = $param['user_name'];
        $user_data['first_name'] = $param['first_name'];
        $user_data['last_name'] = $param['last_name'];
        $user_data['user_email'] = $param['email'];
        $user_data['user_pass'] = $param['password'];
        if($user_data['ID'])
        {
            $user_datas = wp_insert_user($user_data);
            $message = "User Role updated successfully.";
        }
        else
        {
            $user_datas = wp_insert_user($user_data);
            $message = "User Role Registered successfully.";
        }
        $user_info = get_user_by('email',$user_data['user_email']);
        $user_id = $user_info->ID;
        if($user_id > 0)
        {
            return $this->successResponse($message,$user_datas);
        }
        else
        {
            return $this->errorResponse('User not found.');
        }
    }

    // For User Role Login
    function forget_user_role_login($request)
    {
        global $wpdb;
        $param = $request->get_params();
        $user_login = sanitize_text_field($param['email']);
        if(empty($user_login))
        {
             return $this->errorResponse('User email is empty');
        }
        elseif(!is_email($user_login))
        {
            return $this->errorResponse('Please provide valid email');
        }
        elseif(strpos($user_login,'@'))
        {
            $user_data = get_user_by('email',trim($user_login));
        }
        if(!$user_data)
        {
           return $this->errorResponse('Email not matched with our records');
        }
        $user_email=$user_data->user_email;
        $user_id=$user_data->ID;
        if($user_id > 0)
        {
            $link = "http://localhost/wpproject/home?id=".$user_id;
            $message = __('Hello ,') . "<br><br>";
            $message .= __('You recently created account with email <b>'.$user_email.'</b> on <b>Legacy Care Giving</b>.<br>To verify this
            email address belongs to you, please enter the link below on the email on your confirmation page') . "<br><br>";
            $message .=__('<big><b> '.$link.'<b></big>')."<br><br>";
            $message .= __('Sincerely') . "<br>";
            $message .= __('Support Team') . "<br>";
            $subject = "Confirmation Link for Legacy Care Giving";
            $admin_email = get_option('admin_email');
            $headers[] = 'From: Wordpress<'.$admin_email.'>';
            wp_mail($user_email,$subject,$message, $headers);
            $result = array(
                "user_email" => $user_email,
                "user_id"    => $user_id
            );
            return $this->successResponse('A Special Link has been sent to your email.',$result);   
        }
        else
        {
            return $this->errorResponse('User Id Not Found');
        }
    }

    

    public function create_post($request)
    {
        global $wpdb;
       $param = $request->get_params();
       $this->isValidToken();
       $user_id = !empty($this->user_id)?$this->user_id:$param['user_id'];
       $post_title = $param['post_title'];
       $content = $param['post_content'];
            
       if(empty($user_id)){
           return $this->errorResponse('Please enter valid token.');
        }
        else{
            $args = array(
                "post_title" => $post_title,
                "post_status" => "publish",
                "post_content" => $content,
                "post_type" => "post"
            );
            wp_insert_post($args);
            return $this->successResponse('Post Created successfully.');
        }
    }

    // For get Reciepe Post Data.
    public function get_posts_api($request)
    {
         global $wpdb;
         global $post;
         $post_title = "Reciepe Post";
         $result = get_page_by_title($post_title,"OBJECT","receipe");
         $post_id = $result->ID;
         if($post_id > 0)
         {
             $product_name = get_post_meta($post_id,'product_name',false);
             $quantity = get_post_meta($post_id,'quantity',false);
             $unit = get_post_meta($post_id,'unit',false);
             $post_array[]=array(
                 "id" => $post_id,
                 "product_name" => $product_name,
                 "quantity" => $quantity,
                 "unit" => $unit
             );
             return $this->successResponse('Reciepe Post Get Successfully.',$post_array);
         }
         else
         {
             return $this->errorResponse('Post Not Found');            
         }
     }
}
$serverApi = new REST_APIS();
$serverApi->init();
add_filter('jwt_auth_token_before_dispatch',array($serverApi,'jwt_auth'),10,2);
 
// add_filter('authenticate', 'checkAccountLogin', 99, 1);
// function checkAccountLogin($user)
// {
//     if ($user instanceof WP_User)
//     {
//         // print_r($user->roles);die;
//         if(in_array('administrator', $user->roles))
//         {
//             $user_id=$user->ID;
//             $status = get_user_meta($user_id,'is_activated',true);
//             if ($status == 1)
//             {
//                 return $user;
//             }
//             else
//             {
//                 $user = new WP_Error( 'authentication_failed', __( "Your Email is Not verified" ) );
//                 return $user;
//             }
//         }
//     }
// }


//  http://localhost/wpproject/wp-json/api/v1/register_user
//  http://localhost/wpproject/wp-json/jwt-auth/v1/token
//  https://wordpress.org/plugins/jwt-authentication-for-wp-rest-api/       // For JWT Setup.
//  https://websblog.in/how-to-create-gravity-form-in-wordpress-in-hindi/  // For Gravity Form.
//  https://www.tiny.cloud/get-tiny/   // For TinyMce Editor.
//  https://wordpress.org/download/    // For Wordpress project.
?>