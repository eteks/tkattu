<?php
require_once ("includes/application_top.php");
checklogin();

$classChangeProfile = new changeProfile;

$username     = urldecode($_GET["username"]);
$password     = urldecode($_GET["password"]);
$new_password = urldecode($_GET["new_password"]);

$adminSql = $classChangeProfile->selectAdminPwd($username, $password, $_COOKIE["admin_id"]);

if ( db_num_rows ($adminSql) ) { 
    $adminValues = db_fetch_array ($adminSql);
    $adminSql = $classChangeProfile->updateAdminPwd($new_password, $adminValues["id"]);
    deletecookie();
    setcookie ("admin_id", $adminValues["id"]);
    setcookie ("admin_username", $username);
    echo 1;
} else {
    echo 0;
}

require_once('mysql_close.php');
?>