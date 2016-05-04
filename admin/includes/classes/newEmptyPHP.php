<?php

function privilegeUserUpdate () {
    
  if(!empty($_POST["id"]) && $_POST["id"]>0 ) {
        $privilege_user_update_sql = "UPDATE " . TABLE_ADMIN_MASTER . " SET  `admin_role_mst_id` = '" . $_POST["parent_id"] . "', `username` = '" . addslashes($_POST["uname"]) . "', `password` = '" . addslashes($_POST["pword"]) . "', `first_name` = '" . addslashes($_POST["fname"]) . "', `last_name` = '" . addslashes($_POST["lname"]) . "', `email` = '" . addslashes($_POST["email"]) . "', `active` = '" . $_POST["active"] . "', `date_modified` = NOW()  WHERE id = '". $_POST["id"] ."'";
        $privilege_user_update = db_query ($privilege_user_update_sql);

        db_query ("DELETE FROM " . TABLE_MODULE_ADMIN . " WHERE  `admin_mst_id` = '" . $_POST["id"] . "'");
        if(not_null($_POST["admin_modules"]) && count($_POST["admin_modules"]) > 0) {
            $selected_modules_str = "VALUES ('" . implode("', '" . $_POST["id"] . "'), ('", $_POST["admin_modules"]) . "', '" . $_POST["id"] . "');";
            $privilege_user_module_insert_sql = "INSERT INTO " . TABLE_MODULE_ADMIN . " (`admin_modules_mst_id`, `admin_mst_id`) " . $selected_modules_str;
            db_query($privilege_user_module_insert_sql);
        }
        db_query ("DELETE FROM " . TABLE_MODULE_EVENT_ADMIN . " WHERE  `admin_mst_id` = '" . $_POST["id"] . "'");
        if (not_null($_POST["admin_events"]) && count($_POST["admin_events"]) > 0) {
            $selected_events_str = "VALUES ('" . implode("', '" . $_POST["id"] . "'), ('", $_POST["admin_events"]) . "', '" . $_POST["id"]. "');";
            $privilege_user_event_insert_sql = "INSERT INTO " . TABLE_MODULE_EVENT_ADMIN . " (`admin_modules_events_mst_id`, `admin_mst_id`) " . $selected_events_str;
            db_query($privilege_user_event_insert_sql);
        }
    }
 }
 
 ?>