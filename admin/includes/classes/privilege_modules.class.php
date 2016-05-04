<?php

class privilegeModulesClass {

function getPrivilegeMaxSortOrder($tablename, $cond='')
{
    $max_sort_order_sql = "SELECT MAX(sort_order) as sort_order FROM " . $tablename . ( ( not_null($cond) ) ? " WHERE " . $cond : '' );
    $max_sort_order = db_query ($max_sort_order_sql);
    $max_sort_order_values = db_fetch_array ($max_sort_order);
    if ( not_null ($max_sort_order_values["sort_order"]) ) {
        return $max_sort_order_values["sort_order"] ;
    } else {
        return 0;
    }
}

function privilegeModuleInsert ($parent_id, $sort_order, $name, $short_descr, $filename, $parameters, $active) {
        $module_sql_cond='';
    if (not_null($parent_id)) {
        $module_sql_cond = "parent_id = '" . (int)$parent_id . "'";
    }
    if (!not_null($sort_order)) {
        $sort_order = $this->getPrivilegeMaxSortOrder(TABLE_MODULE_MASTER, $module_sql_cond ) + 1 ;
    } else {
        db_query ("UPDATE " . TABLE_MODULE_MASTER . " SET sort_order = (sort_order + 1) WHERE sort_order >= '" . $sort_order . "' AND " . $module_sql_cond);
    }
    db_query ("INSERT INTO " . TABLE_MODULE_MASTER . " ( `id`, `parent_id`, `name`, `short_descr`, `filename`, `parameters`, `sort_order`, `active` , `date_added` , `date_modified` ) VALUES ( '', '" . $parent_id . "', '" . addslashes($name) . "', '". addslashes($short_descr) . "', '" . addslashes($filename) . "', '" . addslashes($parameters) . "', '" . $sort_order . "', '" . $active . "', NOW(), NULL)");

}

function getPrivilegeSortOrder($id, $tablename)
{
    $get_sort_order_result = db_query("select sort_order from " . $tablename . " where id = " . $id );
    if (db_num_rows($get_sort_order_result) > 0) {
        $get_sort_order = db_fetch_array($get_sort_order_result);
    } else {
        $get_sort_order["sort_order"] = '';
    }
    return $get_sort_order["sort_order"];
}


function updateRemainingPrivilegeSortorder($id, $tablename, $cond)
{
    $privilege_update_sort_order_sql = "UPDATE " . $tablename . " SET sort_order = (sort_order - 1) WHERE sort_order > '" . $this->getPrivilegeSortOrder ($id, $tablename) . "' AND " . $cond;
    $privilege_update_sort_order = db_query ($privilege_update_sort_order_sql);
}


function get_privilege_max_sort_order($tablename, $cond='')
{
    $max_sort_order_sql = "SELECT MAX(sort_order) as sort_order FROM " . $tablename . ( ( not_null($cond) ) ? " WHERE " . $cond : '' );
    $max_sort_order = db_query ($max_sort_order_sql);
    $max_sort_order_values = db_fetch_array ($max_sort_order);
    if ( not_null ($max_sort_order_values["sort_order"]) ) {
        return $max_sort_order_values["sort_order"] ;
    } else {
        //return 0 when not found
    }
}

function privilegeModuleUpdate ($id, $parent_id, $sort_order, $previous_parent_id, $previous_sort_order, $name, $short_descr, $filename, $parameters, $active) {
    if (not_null($id)) {
        $module_sql_cond='';
        if (not_null($parent_id)) {
            $module_sql_cond = "parent_id = '" . (int)$parent_id . "'";
        }
        if (!not_null($sort_order)) {
            if (not_null($previous_parent_id) && $previous_parent_id == $parent_id) {
                $sort_order = $previous_sort_order;
            } elseif (not_null($previous_parent_id)) {
                $previous_parent_cond = "parent_id = '" . (int)$previous_parent_id . "'";
                $this->updateRemainingPrivilegeSortorder($id, TABLE_MODULE_MASTER, $previous_parent_cond);
                $sort_order = $this->getPrivilegeMaxSortOrder(TABLE_MODULE_MASTER, $module_sql_cond) + 1;
            } else {
                $sort_order = $this->getPrivilegeMaxSortOrder   (TABLE_MODULE_MASTER, $module_sql_cond) + 1;
            }
        } else {
            if (not_null($previous_parent_id) && $previous_parent_id != $parent_id) {
                $previous_parent_cond = "parent_id = '" . (int)$previous_parent_id . "'";
                $this->updateRemainingPrivilegeSortorder($id, TABLE_MODULE_MASTER, $previous_parent_cond);
                db_query ("UPDATE " . TABLE_MODULE_MASTER . " SET sort_order = (sort_order + 1) WHERE sort_order >= '" . $sort_order . "' AND " . $module_sql_cond);
            } elseif( not_null($previous_parent_id) ) {
                db_query ("UPDATE " . TABLE_MODULE_MASTER . " SET sort_order = IF ('" . (int)$sort_order . "' < '" . (int)$previous_sort_order . "', (sort_order + 1), (sort_order - 1)) WHERE IF ('" . (int)$sort_order . "' < '" . (int)$previous_sort_order . "', sort_order >= '" . (int)$sort_order . "' AND sort_order <= '" . (int)$previous_sort_order . "', sort_order >= '" . (int)$previous_sort_order . "' AND sort_order <= '" . (int)$sort_order . "') AND " . $module_sql_cond);
            }
        }
        db_query ("UPDATE " . TABLE_MODULE_MASTER . " SET `parent_id` = '" . (int)$parent_id . "' , `name` = '" . addslashes($name) . "', `short_descr` ='". addslashes($short_descr) . "', `filename` = '" . addslashes($filename) . "', `parameters` = '" . addslashes($parameters) . "', `sort_order` = '" . (int)$sort_order . "' , `active` = '" . $active . "' , `date_modified` = NOW() WHERE  id = '" . (int)$id . "'");
    }
}


function noOfChildOf($parent_id, $tablename)
{
    $get_privilege_childs_sql = db_query("select * from " . $tablename . " where parent_id = '" . (int)$parent_id . "'");
    return db_num_rows($get_privilege_childs_sql);
}

function getAllEvents($module_id)
{
    $privilege_module_event_result = db_query("SELECT id FROM " . TABLE_MODULE_EVENT_MASTER ." WHERE admin_modules_mst_id = '" . $module_id . "'");
    if(db_num_rows($privilege_module_event_result)>0) {
        while($privilege_module_childs=db_fetch_array($privilege_module_event_result)) {
            $all_events[]=$privilege_module_childs["id"];
        }
        return $all_events;
    }
    return array();
}

function deleteAllReferenceEvents($string_event_arr)
{
    $privilege_admin_module_event_delete = db_query("DELETE FROM " . TABLE_MODULE_EVENT_ADMIN ." WHERE admin_modules_events_mst_id IN ('" . $string_event_arr . "')");
    $privilege_admin_module_event_delete = db_query("DELETE FROM " . TABLE_MODULE_EVENT_MASTER ." WHERE id IN ('" . $string_event_arr . "')");
}

function getModulesForDelete($id)
{
    $all_id='';
    if($id>0 && $this->noOfChildOf($id, TABLE_MODULE_MASTER)>0) {
        $privilege_module_child_result = db_query("SELECT id FROM " . TABLE_MODULE_MASTER ." WHERE parent_id = '" . $id . "'");
        while($privilege_module_childs=db_fetch_array($privilege_module_child_result)) {
            if (not_null($all_id)) $all_id = $all_id . "','";
                $all_id = $all_id . $this->getModulesForDelete($privilege_module_childs["id"]);
        }
    }
    $event_arr = $this->getAllEvents($id);
    if (count($event_arr)>0) {
        $string_event_arr = implode("','", $event_arr);
        $this->deleteAllReferenceEvents($string_event_arr);
    }
    if (not_null($all_id)) $all_id = $all_id . "','";
    return $all_id . $id;
}

function deleteAllReferenceModules($string_module_arr)
{
    $privilege_module_event_delete = db_query("DELETE FROM " . TABLE_MODULE_EVENT_MASTER ." WHERE admin_modules_mst_id IN ('" . $string_module_arr . "')");
    $privilege_module_admin_delete = db_query("DELETE FROM " . TABLE_MODULE_ADMIN ." WHERE admin_modules_mst_id IN ('" . $string_module_arr . "')");
    $privilege_module_role_delete = db_query("DELETE FROM " . TABLE_MODULE_ROLE ." WHERE admin_modules_mst_id IN ('" . $string_module_arr . "')");
}

function update_remaining_privilege_sortorder($id, $tablename, $cond)
{
    $privilege_update_sort_order_sql = "UPDATE " . $tablename . " SET sort_order = (sort_order - 1) WHERE sort_order > '" . $this->getPrivilegeSortOrder ($id, $tablename) . "' AND " . $cond;
    $privilege_update_sort_order = db_query ($privilege_update_sort_order_sql);
}

function privilegeModuleDelete($id, $parent_id) {

        if (not_null($_POST["id"]) && not_null($_GET["parent_id"])) {
        $module_sql_cond = "parent_id = '" . (int)$_GET["parent_id"] . "'";
        $string_module_arr = $this->getModulesForDelete($_POST["id"]);
        if (not_null($string_module_arr)) {
            $this->deleteAllReferenceModules($string_module_arr);
            $this->update_remaining_privilege_sortorder($id, TABLE_MODULE_MASTER, $module_sql_cond);
            db_query ("DELETE from " . TABLE_MODULE_MASTER . "  WHERE  id IN ('" . $string_module_arr . "')");
        }
    }
}

function privilegeModuleUpdateActive ($value, $id) {
    $privilege_module_update_sql = "UPDATE " . TABLE_MODULE_MASTER. " SET `active` = '" . $value . "', `date_modified` = NOW() WHERE `id` = " . $id ;
    $privilege_module_update = db_query ($privilege_module_update_sql);

}

function getPrivilegeId($sort_order, $tablename, $cond='')
{
    $get_sort_order_id_result = db_query("select id from " . $tablename . " where " . ( not_null ($cond) ? $cond . " AND " : '' ) . " sort_order = " . $sort_order );
    if (db_num_rows($get_sort_order_id_result) > 0) {
        $get_sort_order_id = db_fetch_array($get_sort_order_id_result);
    } else {
        $get_sort_order_id["id"]='';
    }
    return $get_sort_order_id["id"];
}


function privilegeModuleUpdateSortOrder($id, $value) {

     $previous_sort_order = $this->getPrivilegeSortOrder ($id, TABLE_MODULE_MASTER);
    if ($value == "d") $sort_order = $previous_sort_order + 1;
    else $sort_order = $previous_sort_order - 1;

    $swap_id = $this->getPrivilegeId($sort_order,TABLE_MODULE_MASTER, $module_sql_cond);

    $privilege_module_update_sql = "UPDATE " . TABLE_MODULE_MASTER . " SET `sort_order` = '" . $previous_sort_order  . "', `date_modified` = NOW() WHERE `id` = '" . $swap_id . "'";
    $privilege_module_update = db_query ($privilege_module_update_sql);

    $privilege_module_update_sql = "UPDATE " . TABLE_MODULE_MASTER . " SET `sort_order` = '" . $sort_order  . "', `date_modified` = NOW() WHERE `id` = '" . $id . "'";
    $privilege_module_update = db_query ($privilege_module_update_sql);
}

function modulesMasterSql($module_sql_cond) {
    $modules_master_sql = "SELECT id, name, filename, parameters, sort_order, active, date_added, date_modified FROM " . TABLE_MODULE_MASTER . " WHERE " . $module_sql_cond . " ORDER BY sort_order, name";
    $modules_master = db_query ($modules_master_sql);
    return $modules_master;

}

function privilegeModuleNavigator($parent_id, $first=true)
{
    $module_master_sql = "SELECT id, name, parent_id from " . TABLE_MODULE_MASTER . " WHERE id = '" . $parent_id . "'";
    $module_master_result = db_query ($module_master_sql);
    if(db_num_rows($module_master_result)>0) {
        $module_master_values = db_fetch_array ( $module_master_result );
        if($first) {
            return (($module_master_values["parent_id"]>0)?$this->privilegeModuleNavigator($module_master_values["parent_id"], false):'<img src="images/arrow-l.gif" width="16" height="16" border="0" align="absmiddle">&nbsp;<a href = "' . href_link(FILENAME_PRIVILEGE_MODULES, 'parent_id=0') . '" title="go to main module list" target = "_top" class="normaltext" >Back to Main list</a>');
        } else {
            return (($module_master_values["parent_id"]>0)?$this->privilegeModuleNavigator($module_master_values["parent_id"], false):'<img src="images/arrow-l.gif" width="16" height="16" border="0" align="absmiddle">&nbsp;<a href = "' . href_link(FILENAME_PRIVILEGE_MODULES, 'parent_id=0') . '" title="go to main module list" target = "_top" class="normaltext">Back to Main list</a>&nbsp;').'<img src="images/arrow-l.gif" width="16" height="16" border="0" align="absmiddle">&nbsp;<a href = "' . href_link(FILENAME_PRIVILEGE_MODULES, 'parent_id=' . $module_master_values["id"]) . '" title="go to ' . $module_master_values["name"]  . ' module list" target = "_top" class="normaltext" >' . "Back to " . $module_master_values["name"] . '</a>';
        }
    }
}


function privilegeModuleMasterSql ($id) {
            $privilege_module_master_sql = "SELECT id, parent_id, name, short_descr, filename, parameters, sort_order, active FROM " . TABLE_MODULE_MASTER . " WHERE id = " . $id ;
            $privilege_module_master_result = db_query ($privilege_module_master_sql);
        return $privilege_module_master_result;

}

function getPrivilegeModuleTree ($parent_id = '0', $spacing = '', $exclude = '', $module_tree_array = '', $include_itself = false)
{
    if ( !is_array( $module_tree_array ) )
        $module_tree_array = array();
    if ( ( sizeof( $module_tree_array ) < 1 ) && ( $exclude != '0' ) )
        $module_tree_array[] = array('id' => '0', 'text' => 'Select a module');

    if ( $include_itself ) {
        $module_query = db_query("select name from " . TABLE_MODULE_MASTER . " where id = '" . (int)$parent_id . "' order by sort_order, name");
        $module = db_fetch_array($module_query);
        $module_tree_array[] = array('id' => $parent_id, 'text' => $module['name']);
    }

    $modules_query = db_query("select id, name, parent_id from " . TABLE_MODULE_MASTER . " where parent_id = '" . (int)$parent_id . "' order by sort_order, name");

    while ( $modules = db_fetch_array( $modules_query ) ) {
        if ((int)$exclude != $modules['id']) {
            $module_tree_array[] = array('id' => $modules['id'], 'text' => $spacing . $modules['name']);
            $module_tree_array = $this->getPrivilegeModuleTree ($modules['id'], $spacing . '&nbsp;&nbsp;&nbsp;', $exclude, $module_tree_array);
        }
    }
    return $module_tree_array;
}


}

?>