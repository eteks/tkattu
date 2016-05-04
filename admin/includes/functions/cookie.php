<?php
function checklogin () {
    global $_COOKIE;
    if ((!isset ($_COOKIE["admin_id"]) ) || (!isset ($_COOKIE["admin_username"]))) {
        redirect (FILENAME_LOGIN);
    }    
}

function deletecookie () {
    global $_COOKIE;
    $cookiesSet = array_keys($_COOKIE);
    for ($x = 0; $x < count($cookiesSet); $x++) {
       if (is_array($_COOKIE[$cookiesSet[$x]])) {
           $cookiesSetA = array_keys($_COOKIE[$cookiesSet[$x]]);
           for ($c = 0; $c < count($cookiesSetA); $c++) {
               $aCookie = $cookiesSet[$x].'['.$cookiesSetA[$c].']';
               setcookie($aCookie,"",time()-1);
           }
       }
       setcookie($cookiesSet[$x],"",time()-1);
    }
}

function is_allow_event($userid, $eventid) {
    $event_sql="SELECT * FROM " . TABLE_MODULE_EVENT_ADMIN . " WHERE admin_modules_events_mst_id = '" . $eventid . "' AND  admin_mst_id = '" . $userid . "'";
    $event_result = db_query($event_sql);
    if(db_num_rows($event_result)>0) {
        return true;
    } else {
        return false;
    }
}

function is_allow_module($userid, $moduleid) {
    $module_sql="SELECT * FROM " . TABLE_MODULE_ADMIN . " WHERE admin_modules_mst_id = '" . $moduleid . "' AND  admin_mst_id = '" . $userid . "'";
    $module_result = db_query($module_sql);
    if(db_num_rows($module_result)>0) {
        return true;
    } else {
        return false;
    }
}
function get_administrator_role_id ($admin_user_id) {
    $admin_mst_role = db_query ("SELECT admin_role_mst_id as role from ". TABLE_ADMIN_MASTER ." WHERE id ='". $admin_user_id ."'");
	$admin_mst_role_values = db_fetch_array ($admin_mst_role);
	if ($admin_mst_role_values['role']==SUPER_ADMINISTRATOR_ROLE_ID)  return true;
    else return false;
}

function get_administrator_full_name ($admin_id) {
	$admin_mst_name =db_query(" SELECT first_name as fname, last_name as lname from ". TABLE_ADMIN_MASTER ." WHERE id ='". $admin_id ."'");
	$admin_mst_name_values = db_fetch_array ($admin_mst_name);
	return $admin_mst_name_values['fname']." ".$admin_mst_name_values['lname'];
}

function getAdminUsersList() {
    $admin_usr_arr = "";
    $admin_mst_name = db_query ("SELECT `id`, `first_name` FROM " . TABLE_ADMIN_MASTER . " ORDER BY `first_name` asc");
    if (db_num_rows ($admin_mst_name)) {
        while ($admin_mst_values = db_fetch_array($admin_mst_name)) {
           $admin_usr_arr[$admin_mst_values["id"]] = $admin_mst_values["first_name"];
        }
    }
return $admin_usr_arr;
}

function is_allow_sidelink($userid, $moduleid) {
   $module_sql="SELECT * FROM " . TABLE_MODULE_ADMIN . " WHERE admin_modules_mst_id = '" . $moduleid . "' AND  admin_mst_id = '" . $userid . "'";
    $module_result = db_query($module_sql);
	$module_fetch  = db_fetch_array($module_result);
    if($module_fetch["count"] > 0) {
        return true;
    } else {
        return false;
    }
}

?>