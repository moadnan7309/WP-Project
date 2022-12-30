<?php
 /*
 Template Name: Demo Page
 */
if(!empty($_GET['id'])){
  $userid = $_GET['id'];
  update_user_meta($userid,"is_activated",1);
}
 ?>
<style>
body {
  background-image: url("https://img.freepik.com/free-vector/blue-curve-frame-template_53876-116707.jpg?w=2000");
}
.class{
    text-align:center;
    margin-top:22%;
}
</style>
<h1 class="class">Your Email is Verified</h1>
