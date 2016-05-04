<?php

class privilegeUserClass {

 function privilegeUserInsert () {
    $privilege_user_insert_sql = "INSERT INTO " . TABLE_ADMIN_MASTER . " ( `id`, `admin_role_mst_id`, `username`, `password`, `first_name` , `last_name`, `email`, `active` , `date_added` , `date_modified` ) VALUES ( '', '" . $_GET["parent_id"] ."' ,  '" . addslashes($_POST["uname"]) . "', '" . addslashes($_POST["pword"]) . "', '" . addslashes($_POST["fname"]) . "', '" . addslashes($_POST["lname"]) . "', '" . addslashes($_POST["email"]) . "', '" . $_POST["active"] . "', NOW(), NULL)";
    db_query ($privilege_user_insert_sql);
    $privilege_user_insert_id = db_insert_id();

    if(not_null($_POST["admin_modules"]) && count($_POST["admin_modules"]) > 0) {
        $selected_modules_str = "VALUES ('" . implode("', '" . $privilege_user_insert_id . "'), ('", $_POST["admin_modules"]) . "', '" . $privilege_user_insert_id . "');";
        $privilege_user_module_insert_sql = "INSERT INTO " . TABLE_MODULE_ADMIN . " (`admin_modules_mst_id`, `admin_mst_id`) " . $selected_modules_str;
        db_query($privilege_user_module_insert_sql);
    }
    if(not_null($_POST["admin_events"]) && count($_POST["admin_events"]) > 0) {
        $selected_events_str = "VALUES ('" . implode("', '" . $privilege_user_insert_id . "'), ('", $_POST["admin_events"]) . "', '" . $privilege_user_insert_id . "');";
        $privilege_user_event_insert_sql = "INSERT INTO " . TABLE_MODULE_EVENT_ADMIN . " (`admin_modules_events_mst_id`, `admin_mst_id`) " . $selected_events_str;
        db_query($privilege_user_event_insert_sql);
    }
 }

 function privilegeUserUpdate () {

  if( not_null($_GET["id"]) && $_GET["id"]>0 ) {
        $privilege_user_update_sql = "UPDATE " . TABLE_ADMIN_MASTER . " SET  `admin_role_mst_id` = '" . $_GET["parent_id"] . "', `username` = '" . addslashes($_POST["uname"]) . "', `password` = '" . addslashes($_POST["pword"]) . "', `first_name` = '" . addslashes($_POST["fname"]) . "', `last_name` = '" . addslashes($_POST["lname"]) . "', `email` = '" . addslashes($_POST["email"]) . "', `active` = '" . $_POST["active"] . "', `date_modified` = NOW()  WHERE id = '". $_GET["id"] ."'";
        $privilege_user_update = db_query ($privilege_user_update_sql);

        db_query ("DELETE FROM " . TABLE_MODULE_ADMIN . " WHERE  `admin_mst_id` = '" . $_GET["id"] . "'");
        if(not_null($_POST["admin_modules"]) && count($_POST["admin_modules"]) > 0) {
            $selected_modules_str = "VALUES ('" . implode("', '" . $_GET["id"] . "'), ('", $_POST["admin_modules"]) . "', '" . $_GET["id"] . "');";
            $privilege_user_module_insert_sql = "INSERT INTO " . TABLE_MODULE_ADMIN . " (`admin_modules_mst_id`, `admin_mst_id`) " . $selected_modules_str;
            db_query($privilege_user_module_insert_sql);
        }
        db_query ("DELETE FROM " . TABLE_MODULE_EVENT_ADMIN . " WHERE  `admin_mst_id` = '" . $_GET["id"] . "'");
        if (not_null($_POST["admin_events"]) && count($_POST["admin_events"]) > 0) {
            $selected_events_str = "VALUES ('" . implode("', '" . $_GET["id"] . "'), ('", $_POST["admin_events"]) . "', '" . $_GET["id"]. "');";
            $privilege_user_event_insert_sql = "INSERT INTO " . TABLE_MODULE_EVENT_ADMIN . " (`admin_modules_events_mst_id`, `admin_mst_id`) " . $selected_events_str;
            db_query($privilege_user_event_insert_sql);
        }
    }
 }

 function privilegeUserDelete () {
     if (not_null($_POST["id"]) && $_POST["id"] > 0) {
            db_query ("DELETE from " . TABLE_MODULE_EVENT_ADMIN . "  WHERE  admin_mst_id = '" . $_POST["id"] . "'");
            db_query ("DELETE from " . TABLE_MODULE_ADMIN . "  WHERE  admin_mst_id = '" . $_POST["id"] . "'");
            db_query ("DELETE from " . TABLE_ADMIN_MASTER . "  WHERE  id = '" . $_POST["id"] . "'");
     }
 }

 function privilegeUserDuplication () {
     $uname = urldecode($_GET["uname"]);
        if (not_null($_GET["id"])) {
            $extra_cond = " AND id != " . $_GET["id"] ;
        } else {
            $extra_cond = "";
        }
      $privilege_user_duplication_sql = "SELECT id FROM " . TABLE_ADMIN_MASTER . " WHERE username = '" . trim($uname) . "'" . $extra_cond . "";
      $privilege_user_duplication = db_query ($privilege_user_duplication_sql);
	  if(db_num_rows($privilege_user_duplication) > 0) {
        $errMsg = "ERROR: Username :" . $uname . " already exists, Please try another";
    }
	  return $errMsg;
 }

 function get_all_users_modules()
{
    $modules_id_str='';
    $privilege_users_module_result = db_query("SELECT admin_modules_mst_id FROM " . TABLE_MODULE_ADMIN ." WHERE admin_mst_id = '" . $_GET["id"] . "'");
       if(db_num_rows($privilege_users_module_result)>0) {
        while($privilege_users_module=db_fetch_array($privilege_users_module_result)) {
            if (not_null($modules_id_str)) $modules_id_str = $modules_id_str . "','";
                $modules_id_str = $modules_id_str . $privilege_users_module["admin_modules_mst_id"];
        }
    }
    return $modules_id_str;
}

function get_all_users_events()
{
    $events_id_str='';
    $privilege_users_event_result = db_query("SELECT admin_modules_events_mst_id FROM " . TABLE_MODULE_EVENT_ADMIN ." WHERE admin_mst_id = '" . $_GET["id"] . "'");
    if(db_num_rows($privilege_users_event_result)>0) {
        while($privilege_users_event=db_fetch_array($privilege_users_event_result)) {
            if (not_null($events_id_str)) $events_id_str = $events_id_str . "','";
            $events_id_str = $events_id_str . $privilege_users_event["admin_modules_events_mst_id"];
        }
    }
    return $events_id_str;
}

function no_of_child_of($parent_id, $tablename)
{
    $get_privilege_childs_sql = db_query("select * from " . $tablename . " where parent_id = '" . (int)$parent_id . "'");
    return db_num_rows($get_privilege_childs_sql);
}


function get_all_roles_modulenames($id)
{
    $modules_id_arr=array();
    $privilege_roles_module_result = db_query("SELECT admin_modules_mst_id, name FROM " . TABLE_MODULE_ROLE .", " . TABLE_MODULE_MASTER . " WHERE " .  TABLE_MODULE_MASTER . ".id = admin_modules_mst_id AND active='Y' AND admin_role_mst_id = '" . $id . "' AND parent_id = 0 ORDER BY sort_order");
    if(db_num_rows($privilege_roles_module_result)>0) {
        $i=0;
        while($privilege_roles_module=db_fetch_array($privilege_roles_module_result)) {
            //assign separator if string already assigned
            $modules_id_arr[$i]["id"] = $privilege_roles_module["admin_modules_mst_id"];
            $modules_id_arr[$i]["name"] = $privilege_roles_module["name"];
            $i++;
        }
    }
    return $modules_id_arr;
}

function get_all_child_modules($parent_id, $role_id)
{
    //make variable to store list of module ids
    $all_id=array();
    //check childs are there or not for requested id
    if($parent_id>0 && $this->no_of_child_of($parent_id, TABLE_MODULE_MASTER)>0) {
        //get all child list
        $privilege_module_child_result = db_query("SELECT admin_modules_mst_id, name FROM " . TABLE_MODULE_MASTER .", " . TABLE_MODULE_ROLE . " WHERE parent_id = '" . (int)$parent_id . "' AND  " .  TABLE_MODULE_MASTER . ".id = admin_modules_mst_id AND admin_role_mst_id = '" . (int)$role_id . "' ORDER BY sort_order");
        $i=0;
        while($privilege_module_childs=db_fetch_array($privilege_module_child_result)) {
            //assign current string and get the child of current id
            $all_id[$i]["id"] = $privilege_module_childs["admin_modules_mst_id"];
            $all_id[$i]["name"] = $privilege_module_childs["name"];
            $i++;
        }
    }
    return $all_id;
}

function get_all_event_names($module_id)
{
    //get the event ids, names of module_id
    $privilege_module_event_result = db_query("SELECT id, name FROM " . TABLE_MODULE_EVENT_MASTER ." WHERE admin_modules_mst_id = '" . $module_id . "'");
    //if found then
    if(db_num_rows($privilege_module_event_result)>0) {
        //get all event ids in array
        $i=0;
        while($privilege_module_childs=db_fetch_array($privilege_module_event_result)) {
            $all_events[$i]["id"]=$privilege_module_childs["id"];
            $all_events[$i]["name"]=$privilege_module_childs["name"];
            $i++;
        }
        //return array
        return $all_events;
    }
    //return blank array
    return array();
}

function get_modules_events_tree($role_id, $module_id=0, $selected_modules_arr=array(), $selected_events_arr=array(), $role_flag=false)
{
    $get_str_tree='';
    if(not_null($role_id)) {
        $modules_ids_arr=array();
        if($role_flag) {
            $modules_ids_arr=$this->get_all_roles_modulenames($role_id);
        } else {
            $modules_ids_arr = $this->get_all_child_modules($module_id, $role_id);
        }
        if(count($modules_ids_arr)>0) {
            $j=0;
            $get_str_tree .= '<table width="100%" align="left" cellpadding="0" cellspacing="0">';
            foreach($modules_ids_arr as $value) {
                $get_str_tree .='<tr><td class="normaltext">';
                $get_str_tree=$get_str_tree . '<input class="noneborder" name="admin_modules[]" onclick="update_user_modules_records(this,\'module_child_'. $value["id"] .'\', \''.$role_id.'\', \''.$value["id"].'\');" type="checkbox" value="'.$value["id"].'"';
                if (count($selected_modules_arr)>0 && in_array($value["id"], $selected_modules_arr)) {
                    $check_flag=true;
                } else {
                    $check_flag=false;
                }
                if ($check_flag) {
                    $get_str_tree .= ' checked';
                }
                $get_str_tree .= '>&nbsp;'.$value["name"];
                $get_str_tree .= '<div id="module_child_'.$value["id"].'" style="'.(($check_flag)?'':'display:none;').'padding-left:20px;">';
                $get_str_tree .= (($check_flag)?$this->get_modules_events_tree($role_id, $value["id"], $selected_modules_arr, $selected_events_arr):'');
                $get_str_tree .= '</div>';
                $get_str_tree .= '</td></tr>';
                $j++;
            }
            $get_str_tree .= '</table>';
        }
        $events_ids_arr=array();
        $events_ids_arr = $this->get_all_event_names($module_id);
        if(count($events_ids_arr)>0) {
            $i=0;
            if(trim($get_str_tree)!='')$get_str_tree.="<br>";
            $get_str_tree.='<table width="100%" align="left" cellpadding="0" cellspacing="0"><tr><td class="normaltext"><b>Events</b></tr></td>';
            foreach($events_ids_arr as $event_value) {
                $get_str_tree.='<tr><td width="100%" class="normaltext">';
                $get_str_tree.='<input class="noneborder" name="admin_events[]" type="checkbox" value="'.$event_value["id"].'"';
                if (count($selected_events_arr)>0 && in_array($event_value["id"], $selected_events_arr)) {
                    $event_check_flag=true;
                } else {
                    $event_check_flag=false;
                }
                if ($event_check_flag) {
                    $get_str_tree = $get_str_tree." checked";
                }
                $get_str_tree .= ">&nbsp;".$event_value["name"];
                $get_str_tree.='</td></tr>';
                $i++;
            }
            $get_str_tree.='</table>';
        }
    }
    return $get_str_tree;
}

function get_user_role_id($user_id) {
    $get_user_role_result = db_query("SELECT admin_role_mst_id FROM " . TABLE_ADMIN_MASTER ." WHERE  id = '" . $user_id . "'");
    if(db_num_rows($get_user_role_result)) {
        $get_user_role_row = db_fetch_array($get_user_role_result);
        return $get_user_role_row["admin_role_mst_id"];
    }
    return 0;
}

 function privilegeUpdateActive () {
	 if(ADVERTISE_ADVERTISER_ROLE_ID == $this->get_user_role_id($_GET["id"])) {
        $privilege_user_update_sql = "UPDATE " . TABLE_ADVERTISE_ADVERTISER_MASTER . " aam, " . TABLE_ADMIN_MASTER . " am SET am.active = '" . $_GET["value"] . "', am.date_modified = NOW(), aam.active = '" . $_GET["value"] . "', aam.date_modified = NOW() WHERE am.id = '" . (int)$_GET["id"] . "' AND am.id = aam.admin_mst_id";
    } else {
        $privilege_user_update_sql = "UPDATE " . TABLE_ADMIN_MASTER . " SET active = '" . $_GET["value"] . "', date_modified = NOW() WHERE id = '" . (int)$_GET["id"] . "'";
    }
    $privilege_user_update = db_query($privilege_user_update_sql);
 }


function privilegeUserMastreTotalSql ($user_sql_cond) {
    $user_master_total_sql = "SELECT id, username, first_name, last_name, email, active ,date_added, date_modified FROM " . TABLE_ADMIN_MASTER . " WHERE " . $user_sql_cond . " ORDER BY username"; 

	return $user_master_total_sql;

}

function get_privilege_role_tree($parent_id = '0', $spacing = '', $exclude = '', $role_tree_array = '', $include_itself = false)
{
    if ( !is_array( $role_tree_array ))
        $role_tree_array = array();
    if ( ( sizeof( $role_tree_array ) < 1 ) && ( $exclude != '0' ) )
        $role_tree_array[] = array('id' => NULL, 'text' => 'Select main role');
    if ($include_itself ) {
        $role_query = db_query("SELECT name FROM " . TABLE_ROLE_MASTER . " WHERE id = '" . (int)$parent_id . "' ORDER BY sort_order, name");
        $role = db_fetch_array($role_query);
        $role_tree_array[] = array('id' => $parent_id, 'text' => stripslashes($role['name']));
    }

    $roles_query = db_query("SELECT id, name, parent_id FROM " .TABLE_ROLE_MASTER . " WHERE parent_id = '" . (int)$parent_id . "' ORDER BY sort_order, name");
    while ( $roles = db_fetch_array( $roles_query ) ) {
        if ((int)$exclude != $roles['id']) {
            $role_tree_array[] = array('id' => $roles['id'], 'text' => $spacing . stripslashes($roles['name']));
            $role_tree_array = $this->get_privilege_role_tree ($roles['id'], $spacing . '&nbsp;&nbsp;&nbsp;', $exclude, $role_tree_array);
        }
    }
    return $role_tree_array;
}


 function totalDbUserMasterNo() {

     $total_db_user_master_no = db_num_rows(db_query("SELECT id FROM " . TABLE_ADMIN_MASTER ));
     return $total_db_user_master_no;
}

 function privilegeUserMasterSql($id) {
            $privilege_user_master_sql = "SELECT id, admin_role_mst_id, username, password, first_name, last_name, email, active FROM " . TABLE_ADMIN_MASTER . " WHERE id = '" . $id . "'";
            $privilege_user_master_result = db_query ($privilege_user_master_sql);
            $privilege_user_master_values = db_fetch_array ( $privilege_user_master_result );
            return $privilege_user_master_values;

 }
}
?>