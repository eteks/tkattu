<?php
require_once ("includes/application_top.php");
$username=urldecode($_GET["username"]);
$password=urldecode($_GET["password"]);
$admin_sql = "SELECT `id`, `username`, `active` FROM " . TABLE_ADMIN_MASTER . " WHERE `username` = '" . $username . "' AND `password` = '" . $password . "'";
$admin = db_query($admin_sql);

if ( db_num_rows ($admin) ) {
    $admin_values = db_fetch_array ($admin);
    if($admin_values["active"]!='Y') {
        echo "Disabled Username!";
        exit;
        //echo 0;
    } else {
        setcookie ("admin_id", $admin_values["id"]);
        setcookie ("admin_username", $admin_values["username"]);
        //wp_press_user_logged($admin_values["username"]);
        //echo 1;
		//$_SESSION["USERNAME"] = $admin_values["username"];
        exit;
    }    
} else {
    deletecookie ();
    echo "Invalid username and/or password";
    exit;
    //echo 0;
}
require_once('mysql_close.php');
?>