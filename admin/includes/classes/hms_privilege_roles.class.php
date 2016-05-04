<?php

class privilegeRolesClass {


    function privilegeRolesInsert () {
        if ( !not_null ($_POST["sort_order"]) ) {
        $admin_role_mst_max_sort_order_sql = "SELECT MAX(sort_order) as sort_order FROM " . TABLE_HMS_ROLE_MASTER . " WHERE parent_id = " . $_POST["role_parent_id"] . " ";
        $admin_role_mst_max_sort_order = db_query($admin_role_mst_max_sort_order_sql);
        $admin_role_mst_max_sort_order_values = db_fetch_array ($admin_role_mst_max_sort_order);
        if (not_null($admin_role_mst_max_sort_order_values["sort_order"])) {
            $sort_order = $admin_role_mst_max_sort_order_values["sort_order"] + 1;
        } else {
            $sort_order = 1;
        }
    } else {
        $admin_role_master_update_sort_order_sql = "UPDATE " . TABLE_HMS_ROLE_MASTER . " SET sort_order = (sort_order + 1) WHERE  sort_order >= '" . $_POST["sort_order"] . "' AND parent_id = " . $_POST["role_parent_id"] . " ";
        $admin_role_master_update_sort_order     = db_query($admin_role_master_update_sort_order_sql);
		$sort_order = $_POST["sort_order"];
    }
    $admin_role_insert_sql = "INSERT INTO " . TABLE_HMS_ROLE_MASTER . " (`id`, `parent_id`, `name`, `short_descr`, `sort_order`, `active`, `date_added`) VALUES ('', " . $_POST["role_parent_id"] . ", '" . addslashes($_POST["role_name"]) . "', '" . addslashes($_POST["short_desc"]) . "', " . $sort_order . ", '" . $_POST["active"] . "', NOW())";
    $admin_role_insert     = db_query ($admin_role_insert_sql);
    $admin_role_insert_id  = db_insert_id ();
    $role_string = "";
    if (isset ($_POST["parent"])) {
        foreach ($_POST["parent"] as $role) {
            if ($role_string =="") {
                $role_string = "(" . $role . ", " . $admin_role_insert_id . ") ";
            } else {
                $role_string.= ", (" . $role . ", " . $admin_role_insert_id . ")";
            }
        }
        $admin_module_to_admin_role_insert_sql = "INSERT INTO " . TABLE_HMS_MODULE_ROLE . "(`admin_modules_mst_id`, `admin_role_mst_id`) VALUES " . $role_string . " ";
        $admin_module_to_admin_role_insert = db_query ($admin_module_to_admin_role_insert_sql);
    }
  }

function get_admin_role_master_sort_number($id)
{
    $adminrole_mst_query = db_query("select sort_order from " . TABLE_HMS_ROLE_MASTER . " where id = '" . (int)$id . "'");
    $adminrole_mst       = db_fetch_array($adminrole_mst_query);
    return $adminrole_mst["sort_order"];
}

function get_admin_role_master_parent_id ($id)
{
    $adminrole_mst_query = db_query("select parent_id from " . TABLE_HMS_ROLE_MASTER . " where id = '" . (int)$id . "'");
    $adminrole_mst       = db_fetch_array($adminrole_mst_query);
    return $adminrole_mst["parent_id"];
}


  function privilege_roles_update ($sort_order, $role_parent_id, $role_name, $short_desc, $active, $parent, $id) {
      
    if (!not_null($sort_order)) {

        $admin_role_mst_max_sort_order_sql = "SELECT MAX(sort_order) as sort_order FROM " . TABLE_HMS_ROLE_MASTER . " WHERE parent_id = " . $role_parent_id . " ";
        $admin_role_mst_max_sort_order = db_query($admin_role_mst_max_sort_order_sql);
        $admin_role_mst_max_sort_order_values = db_fetch_array ($admin_role_mst_max_sort_order);
        $previous_sort_order = $this->get_admin_role_master_sort_number ($id);
        $previous_parent_id  = $this->get_admin_role_master_parent_id ($id);
        if (not_null($admin_role_mst_max_sort_order_values["sort_order"])) { 
            if ((int)$previous_parent_id != (int)$role_parent_id) {
                $sort_order = $admin_role_mst_max_sort_order_values["sort_order"] + 1;
            } else {
                $sort_order = $admin_role_mst_max_sort_order_values["sort_order"];
            }
        } else {
            $sort_order = 1;
        }
        if ($previous_parent_id != $role_parent_id) {
            $adminrole_mst_update_sort_order_sql = "UPDATE " . TABLE_HMS_ROLE_MASTER . " SET sort_order = (sort_order - 1) WHERE  sort_order > ".$previous_sort_order."  AND parent_id =".$previous_parent_id."";
            $adminrole_mst_update_sort_order     = db_query($adminrole_mst_update_sort_order_sql);
        } else {

            $admin_role_mst_update_sort_order_sql = "UPDATE " . TABLE_HMS_ROLE_MASTER . " SET sort_order = (sort_order - 1) WHERE  sort_order > ".$previous_sort_order." AND sort_order <= ".$sort_order." AND parent_id = " . $role_parent_id . " "; 
            $admin_role_mst_update_sort_order  = db_query($admin_role_mst_update_sort_order_sql);
        }
    } else {

        $previous_sort_order = $this->get_admin_role_master_sort_number ($id);
        $previous_parent_id  = $this->get_admin_role_master_parent_id ($id);
        if ($previous_parent_id != $role_parent_id) {
            $adminrole_mst_update_sort_order_sql1 = "UPDATE " . TABLE_HMS_ROLE_MASTER . " SET sort_order = (sort_order - 1) WHERE  sort_order > ".$previous_sort_order."  AND parent_id = " . $previous_parent_id . " ";
            $adminrole_mst_update_sort_order1     = db_query($adminrole_mst_update_sort_order_sql1);
            $adminrole_mst_update_sort_order_sql2 = "UPDATE " . TABLE_HMS_ROLE_MASTER . " SET sort_order = (sort_order + 1) WHERE  sort_order >= ".$sort_order." AND parent_id =".$role_parent_id."";
            $adminrole_mst_update_sort_order2     = db_query($adminrole_mst_update_sort_order_sql2);
        }else {
            if ($previous_sort_order < $sort_order ) {
                $adminrole_mst_update_sort_order_sql = "UPDATE " . TABLE_HMS_ROLE_MASTER . " SET sort_order = (sort_order - 1) WHERE  sort_order > " . $previous_sort_order . " AND sort_order <= " . $sort_order . " AND parent_id =".$role_parent_id."";
                $adminrole_mst_update_sort_order     = db_query($adminrole_mst_update_sort_order_sql);
            } else if ($previous_sort_order > $sort_order) {
                $adminrole_mst_update_sort_order_sql = "UPDATE " . TABLE_HMS_ROLE_MASTER . " SET sort_order = (sort_order + 1)WHERE  sort_order >=" . $sort_order . " AND sort_order < " . $previous_sort_order . " AND parent_id = " . $role_parent_id . " ";
                $adminrole_mst_update_sort_order     = db_query($adminrole_mst_update_sort_order_sql);
            }
        }
    }
    $admin_role_mst_update_sql = "UPDATE " . TABLE_HMS_ROLE_MASTER . " SET parent_id = " . $role_parent_id . ", name = '" . $role_name . "', short_descr = '" . addslashes($short_desc) . "', sort_order = '" . $sort_order . "' , active = '" . $active . "', date_modified = NOW() WHERE id = '" . $id . "' ";
    $admin_role_mst_update     = db_query($admin_role_mst_update_sql);

    $admin_module_to_role_delete_sql = "DELETE FROM ".TABLE_HMS_MODULE_ROLE." WHERE admin_role_mst_id='".(int)$id."' ";
    $admin_module_to_role_delete = db_query ($admin_module_to_role_delete_sql);
    $role_string ="";
    if (isset ($parent)) {
        foreach ($parent as $role) {
            if ($role_string =="") {
                $role_string = "(" . $role . ", " . $id . ") ";
            } else {
                $role_string.= ", (" . $role . ", " . $id . ") ";
            }
        }
        $admin_module_to_admin_role_insert_sql = "INSERT INTO " . TABLE_HMS_MODULE_ROLE . "(`admin_modules_mst_id`, `admin_role_mst_id`) VALUES " . $role_string . " ";
        $admin_module_to_admin_role_insert = db_query ($admin_module_to_admin_role_insert_sql);     
    }
  }


function get_admin_roles_ids_for_delete ($id)
{
    $all_id='';
    if ($id>0) {
        $privilege_role_child_result = db_query("SELECT id, parent_id, sort_order FROM " . TABLE_HMS_ROLE_MASTER ." WHERE parent_id = '" . $id . "'");
        while ($privilege_role_child = db_fetch_array($privilege_role_child_result)) {
            if (not_null($all_id)) $all_id = $all_id . "','";
            $all_id = $all_id . $this->get_admin_roles_ids_for_delete($privilege_role_child["id"]);
        }
    }
    if (not_null($all_id)) $all_id = $all_id . "','";
    return $all_id . $id;
}

function get_privilege_sort_order($id, $tablename)
{
    $get_sort_order_result = db_query("select sort_order from " . $tablename . " where id = " . $id );
    if (db_num_rows($get_sort_order_result) > 0) {
        $get_sort_order = db_fetch_array($get_sort_order_result);
    } else {
        $get_sort_order["sort_order"] = '';
    }
    return $get_sort_order["sort_order"];
}


function update_remaining_privilege_sortorder($id, $tablename, $cond)
{
    //update sor_order of other records of tablename as per cond
    $privilege_update_sort_order_sql = "UPDATE " . $tablename . " SET sort_order = (sort_order - 1) WHERE sort_order > '" . $this->get_privilege_sort_order ($id, $tablename) . "' AND " . $cond;
    $privilege_update_sort_order = db_query ($privilege_update_sort_order_sql);
}

function get_admin_users_ids_for_delete ($role_id_string)
{
    if (not_null($role_id_string)) {
        $all_userid="";
        $admin_mst_sql = "SELECT id FROM " . TABLE_HMS_ADMIN_MASTER ." WHERE  admin_role_mst_id IN ('".$role_id_string."')";
        $admin_mst     = db_query($admin_mst_sql);
        if (db_num_rows ($admin_mst) >0) {
            while ($admin_mst_values = db_fetch_array($admin_mst)) {
                if ($all_userid=="") {
                    $all_userid = "'".$admin_mst_values["id"]."'";
                } else  {
                    $all_userid.= ",'". $admin_mst_values["id"]."'";
                }
            }
            if (not_null($all_userid)) return $all_userid ;
        }
    }
}

 function privilegeRolesDelete($id, $parentid) {
    $id_string = $this->get_admin_roles_ids_for_delete ($id);
    $module_sql_cond = "parent_id = '" . (int)$parentid . "'";
    $this->update_remaining_privilege_sortorder($id, TABLE_HMS_ROLE_MASTER, $module_sql_cond);
    if (not_null ($id_string )) {
        $admin_id_string = $this->get_admin_users_ids_for_delete ($id_string);
        if (not_null ($admin_id_string)) {
            $admin_module_event_delete_sql = "DELETE FROM " .TABLE_HMS_MODULE_EVENT_ADMIN. " WHERE admin_mst_id  IN (".$admin_id_string.")";
            $admin_module_event_delete = db_query ($admin_module_event_delete_sql);
            $admin_module_delete_sql = "DELETE FROM " .TABLE_HMS_MODULE_ADMIN. " WHERE admin_mst_id  IN (".$admin_id_string.")";
            $admin_module_delete = db_query ($admin_module_delete_sql);
            $admin_master_delete_sql = "DELETE FROM " .TABLE_HMS_ADMIN_MASTER. " WHERE id  IN (".$admin_id_string.")";
            $admin_master_delete = db_query ($admin_master_delete_sql);
            $role_ids_arr = explode(',', $id_string);            
        } 
        $admin_module_to_role_delete_sql = "DELETE FROM " .TABLE_HMS_MODULE_ROLE. " WHERE admin_role_mst_id IN ('".$id_string."')";
        $admin_module_to_role_delete = db_query ($admin_module_to_role_delete_sql); 
        $admin_role_delete_sql = "DELETE FROM " .TABLE_HMS_ROLE_MASTER. " WHERE id IN ('".$id_string."')";
        $admin_role_delete = db_query ($admin_role_delete_sql);
    }
 }


 function get_admin_role_master_max_sort_number($parentid)
{
     $adminrole_mst_max_sort_order_sql    = "SELECT MAX(sort_order) as sort_order FROM " . TABLE_HMS_ROLE_MASTER . " WHERE parent_id=".$parentid."";
     $adminrole_mst_max_sort_order        = db_query($adminrole_mst_max_sort_order_sql);
     $adminrole_mst_max_sort_order_values = db_fetch_array($adminrole_mst_max_sort_order);
     return $adminrole_mst_max_sort_order_values['sort_order'];
}


function adminRoleCheckDuplicate ($role_name, $role_parent_id) {
        $admin_role_check_duplicate_sql = "SELECT id FROM ".TABLE_HMS_ROLE_MASTER." WHERE name  = '" . trim($role_name) . "' AND parent_id =".$role_parent_id."";
        $admin_role_check_duplicate = db_query($admin_role_check_duplicate_sql);
        if (db_num_rows($admin_role_check_duplicate))
          $final =  "0";
        else
          $final =  "1";
        return $final;

}

function privilegeRolesUpdate($role_name, $role_parent_id, $id) {
        $admin_role_check_duplicate_sql = "SELECT id FROM ".TABLE_HMS_ROLE_MASTER." WHERE name  = '" . trim($role_name) . "' AND parent_id =".$role_parent_id." and id != ".$id."";
        $admin_role_check_duplicate = db_query($admin_role_check_duplicate_sql);
        if (db_num_rows($admin_role_check_duplicate) > 0) {
            $final =  "0";
        } else {
            $final = "1";
        }
        return $final;
}


function get_parent_module_checkboxes($parent_id, $selected_array='', $role_edit_id='0')
{
    $admin_module_mst_sql = "SELECT id, parent_id, name from ". TABLE_HMS_MODULE_MASTER ." WHERE active='Y' AND parent_id=".(int)$parent_id."";
    $admin_module_mst     = db_query ($admin_module_mst_sql);
    $tot_rec = db_num_rows ($admin_module_mst);
    $i = 0;
    if ($tot_rec > 0) {
        if ($role_edit_id > 0) { //during editing time
            $child_id_string = "";
            while ($admin_module_values = db_fetch_array($admin_module_mst)) {
                if ($child_id_string=="") $child_id_string = $admin_module_values["id"];
                else $child_id_string.=",". $admin_module_values["id"];
            }
            $admin_module_to_role_sql = "SELECT * from ".TABLE_HMS_MODULE_ROLE." WHERE  admin_role_mst_id='".(int)$role_edit_id."' AND admin_modules_mst_id IN (".$child_id_string.")";
            $admin_module_to_role     = db_query ($admin_module_to_role_sql);
            if (db_num_rows ($admin_module_to_role) >0 ) {
                while ($admin_module_to_role_values = db_fetch_array ($admin_module_to_role)) {
                    $selected_array [$admin_module_to_role_values["admin_modules_mst_id"]] = $admin_module_to_role_values["admin_modules_mst_id"];
                }
            }
            db_seek ($admin_module_mst, 0);
        }
        $javascript_function ="";
        while ($admin_module_values = db_fetch_array($admin_module_mst)) {
            $i++;
            $checked="";
            if (is_array($selected_array)) {
                if (array_key_exists($admin_module_values["id"], $selected_array)) {
                    $checked = "CHECKED";
                    if ($parent_id==0) {$javascript_function.="get_admin_module_child_checkbox(".$admin_module_values["id"].");";}
                    else {$javascript_function.="<NEXTCHILDID>".$admin_module_values["id"];}
                }
            }
            $str_checkbox=(isset($str_checkbox) && !empty($str_checkbox) ? trim($str_checkbox) : '');
            $str_checkbox.="<input class=\"noneborder\" type='checkbox' ".$checked." name=\"parent[]\" id=\"parent".$admin_module_values['id']."\" value=\"".$admin_module_values['id']."\" onClick=\"get_admin_module_child_checkbox(".$admin_module_values['id'].")\"> ".$admin_module_values['name'];
            $str_checkbox.="<div id=\"div_child".$admin_module_values['id']."\" style=\"display:none;padding-left:20px;\"></div>";

            if ($i<$tot_rec) $str_checkbox.="<BR>";
         }

        if (not_null($javascript_function)) {
            if ($parent_id==0) {$str_checkbox.="<script language='javascript'>".$javascript_function."</script>"; }
            else {$str_checkbox.=$javascript_function;}
        }
        print $str_checkbox;
    }
}



function adminroleGenerateSortOrderValues($parent_id) {
        $adminrole_sort_order_sql = "SELECT MAX(sort_order) as sort_order FROM ".TABLE_HMS_ROLE_MASTER." WHERE parent_id =".$parent_id." ";
        $adminrole_sort_order = db_query($adminrole_sort_order_sql);
        return $adminrole_sort_order;

}

function adminRoleUpdateActive($value, $id, $parentid) {
            $adminrole_mst_update_sql = "UPDATE " . TABLE_HMS_ROLE_MASTER . " SET `active` = '" . $value . "', `date_modified` = NOW() WHERE `id` = '" . $id . "' AND parent_id=".$parentid."";
            $adminrole_mst_update = db_query($adminrole_mst_update_sql);
}

function getAdminRoleMasterSortNumber($id)
{
    $adminrole_mst_query = db_query("select sort_order from " . TABLE_HMS_ROLE_MASTER . " where id = '" . (int)$id . "'");
    $adminrole_mst       = db_fetch_array($adminrole_mst_query);
    return $adminrole_mst["sort_order"];
}

function adminRoleUpdateSortOrder($id, $parentid, $value) {

          $previous_sort_order = $this->getAdminRoleMasterSortNumber($id);
            if ($value == "d") {
                $sort_order = $previous_sort_order + 1;
            } else {
                $sort_order = $previous_sort_order - 1;
            }
            if ($previous_sort_order < $sort_order) {
                $adminrole_mst_update_sort_order_sql = "UPDATE " . TABLE_HMS_ROLE_MASTER . " SET sort_order = (sort_order - 1) WHERE  sort_order > ".$previous_sort_order." AND sort_order <= ".$sort_order." AND parent_id = " . $parentid." ";
                $adminrole_mst_update_sort_order = db_query ($adminrole_mst_update_sort_order_sql);
            } else if ($previous_sort_order > $sort_order ) {
                $adminrole_mst_update_sort_order_sql = "UPDATE " . TABLE_HMS_ROLE_MASTER . " SET sort_order = (sort_order + 1)WHERE  sort_order >=".$sort_order." AND sort_order < ".$previous_sort_order." AND parent_id = " . $parentid."";
                $adminrole_mst_update_sort_order = db_query ($adminrole_mst_update_sort_order_sql);
            }
            $adminrole_mst_update_sql = "UPDATE " . TABLE_HMS_ROLE_MASTER . " SET sort_order ='" . $sort_order . "',  date_modified = NOW() WHERE id= '" . $id . "' AND parent_id = " . $parentid . " ";
            $adminrole_mst_update = db_query ($adminrole_mst_update_sql);
}

function adminroleMstSql($parentid) {

        $adminrole_mst_sql = "SELECT * from " . TABLE_HMS_ROLE_MASTER . " WHERE parent_id = ".$parentid." AND active='Y' order by sort_order";
        $adminrole_mst = db_query($adminrole_mst_sql);
        return $adminrole_mst;
}

function getPreviousParentId ($current_parentid)
{
    $admin_role_previous_parent_sql = "SELECT parent_id FROM ".TABLE_HMS_ROLE_MASTER." WHERE id='".$current_parentid."'";
    $admin_role_previous_parent     = db_query ($admin_role_previous_parent_sql);
    if (db_num_rows ($admin_role_previous_parent) >0 ) {
        $admin_role_previous_values = db_fetch_array ($admin_role_previous_parent);
        return $admin_role_previous_values['parent_id'];
    } else {
        return 0;
    }
}

function getAdminRoleMasterParentValue ($id)
{
    $adminrole_mst_parent   = db_query("select id from " . TABLE_HMS_ROLE_MASTER . " where parent_id = '" . (int)$id . "' LIMIT 0, 1");
    if (db_num_rows ($adminrole_mst_parent)>0 ) {
        return 1;
    } else {
        return 0;
    }
}

function adminRoleMasterSql($id) 
{
            $admin_role_master_sql    = "SELECT * FROM " . TABLE_HMS_ROLE_MASTER . " WHERE id = " . $id ;
            $admin_role_master_result = db_query ($admin_role_master_sql);
            return $admin_role_master_result;
}

function adminModulesToAdminRoleMstSql ($id) 
    {
            $admin_modules_to_admin_role_mst_sql ="SELECT * from ".TABLE_HMS_MODULE_ROLE." WHERE admin_role_mst_id='".$id."' ";
            $admin_modules_to_admin_role_mst = db_query ($admin_modules_to_admin_role_mst_sql);
            return $admin_modules_to_admin_role_mst;
    }

function getPrivilegeRoleTree($parent_id = '0', $spacing = '', $exclude = '', $role_tree_array = '', $include_itself = false)
{
    if ( !is_array( $role_tree_array ))
        $role_tree_array = array();
    if ( ( sizeof( $role_tree_array ) < 1 ) && ( $exclude != '0' ) )
        $role_tree_array[] = array('id' => 0, 'text' => 'Select main role');
    if ($include_itself ) {
        $role_query = db_query("SELECT name FROM " . TABLE_HMS_ROLE_MASTER . " WHERE id = '" . (int)$parent_id . "' ORDER BY sort_order, name");
        $role = db_fetch_array($role_query);
        $role_tree_array[] = array('id' => $parent_id, 'text' => stripslashes($role['name']));
    }

    $roles_query = db_query("SELECT id, name, parent_id FROM " .TABLE_HMS_ROLE_MASTER . " WHERE parent_id = '" . (int)$parent_id . "' ORDER BY sort_order, name");
    while ( $roles = db_fetch_array( $roles_query ) ) {
        if ((int)$exclude != $roles['id']) {
            $role_tree_array[] = array('id' => $roles['id'], 'text' => $spacing . stripslashes($roles['name']));
            $role_tree_array = $this->getPrivilegeRoleTree ($roles['id'], $spacing . '&nbsp;&nbsp;&nbsp;', $exclude, $role_tree_array);
        }
    }
    return $role_tree_array;
}

}
?>