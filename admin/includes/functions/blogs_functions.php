<?php
require('../blogs/wp-load.php' );
function wp_press_create_user($insert_id) {
   require_once(ABSPATH . WPINC .  '/registration.php');
   //$user_data = array ('ID'=>3 , 'role' => 'administrator', 'user_login' => 'admin123', 'user_pass' => 'admin123', 'user_email' => '123' );
   $blog_role = 'administrator';
   $user_data = array ('ID'=>$wp_user_id , 'role' => $blog_role, 'user_login' => $_POST["uname"], 'user_pass' => $_POST["pword"], 'user_email' => $_POST["email"], 'user_nicename'=>$_POST["uname"], 'display_name' =>$_POST["uname"]);
   $wp_users_insert_id = wp_create_user($_POST["uname"], $_POST["pword"], $_POST["email"], $user_data); //declared in blogs/wp-includes/registration.php   
   db_query("UPDATE " . TABLE_WP_USERS . " SET `admin_mst_id` = '" . $insert_id . "' WHERE `ID` = '" . $wp_users_insert_id . "'");
   db_query("UPDATE " . TABLE_WP_USERMETA . " SET `meta_value` = 'a:1:{s:13:\"administrator\";b:1;}' WHERE `meta_key` = 'wp_capabilities' AND `user_id` = '" . $wp_users_insert_id . "'");

}

function wp_press_update_user($admin_mst_id) {
   require_once(ABSPATH . WPINC .  '/registration.php');
   $wp_user_id = getwp_press_user_id($admin_mst_id);
   $user_data = array ('ID'=>$wp_user_id , 'user_login' => $_POST["uname"], 'user_pass' => $_POST["pword"], 'user_email' => $_POST["email"], 'user_nicename'=>$_POST["uname"], 'display_name' =>$_POST["uname"]);
   $wp_user_insert_id = wp_update_user($user_data);

   if (!$wp_user_id) {
       db_query("UPDATE " . TABLE_WP_USERS . " SET `admin_mst_id` = '" . $admin_mst_id . "' WHERE `ID` = '" . $wp_user_insert_id . "'");
       db_query("UPDATE " . TABLE_WP_USERMETA . " SET `meta_value` = 'a:1:{s:13:\"administrator\";b:1;}' WHERE `meta_key` = 'wp_capabilities' AND `user_id` = '" . $wp_user_insert_id . "'");
   }
}

function wp_press_delete_user($admin_mst_id) {
    if ($admin_mst_id) $wp_user_id = getwp_press_user_id($admin_mst_id);
    if ($wp_user_id) { 
        db_query ("DELETE FROM " . TABLE_WP_USERS . " WHERE `ID` = '" . $wp_user_id . "' ");
        db_query ("DELETE FROM " . TABLE_WP_USERMETA . " WHERE `user_id` = '" . $wp_user_id . "' ");
    }
}

function wp_press_user_logged($user_name) {
    setcookie(TEST_COOKIE, 'WP Cookie check', 0, COOKIEPATH);
    if ( SITECOOKIEPATH != COOKIEPATH) setcookie(TEST_COOKIE, 'WP Cookie check', 0, SITECOOKIEPATH);
    wp_setcookie($user_name);// declared in blogs/wp-includes/pluggable.php
}

function wp_press_user_loggedout() {
   wp_logout();
}

function getwp_press_user_id($admin_mst_id) {
    $wp_users_id = db_query("SELECT `id` FROM " . TABLE_WP_USERS . " WHERE `admin_mst_id` = '" . $admin_mst_id . "' ");
    if (db_num_rows ($wp_users_id)) {
        $wp_user_values = db_fetch_array($wp_users_id);
        return $wp_user_values['id'];
   } return "0";
}
?>