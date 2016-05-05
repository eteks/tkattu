<?php

class privilegeModuleEventsClass {

    function privilegeModuleEventInsert ($module_event_parent_id, $event_name, $short_desc, $event_filename, $event_parameters) {
        $admin_module_event_mst_insert_sql = "INSERT INTO " . TABLE_HMS_MODULE_EVENT_MASTER . " ( `id` ,`admin_modules_mst_id`, `name`, `short_descr`, `filename`, `parameters`) VALUES ( '', ". $module_event_parent_id.", '" . $event_name . "', '".$short_desc."', '".$event_filename."', '" . $event_parameters . "')";
        $admin_module_event_mst_insert     = db_query ($admin_module_event_mst_insert_sql);

    }

    function privilegeModuleEventUpdate($module_event_parent_id, $event_name, $short_desc, $event_filename, $event_parameters, $id) {
       $admin_module_event_mst_update_sql = "UPDATE ". TABLE_HMS_MODULE_EVENT_MASTER." SET admin_modules_mst_id= " . $module_event_parent_id . ", name = '" . $event_name . "', short_descr = '" . $short_desc . "', filename = '" . $event_filename . "', parameters = '" . $event_parameters . "' WHERE id = '" . $id . "'";
       $admin_module_event_mst_update     = db_query ($admin_module_event_mst_update_sql); 

    }

    function privilegeModuleEventDelete ($id) {
       $admin_module_event_mst_delete_sql = "DELETE FROM ". TABLE_HMS_MODULE_EVENT_MASTER." WHERE id = '" . $id . "'";
       $admin_module_event_mst_delete     = db_query($admin_module_event_mst_delete_sql);
       $admin_module_event_admin_delete_sql = "DELETE FROM ". TABLE_HMS_MODULE_EVENT_MASTER." WHERE admin_modules_events_mst_id = '" . $id . "'";
       $admin_module_event_admin_delete     = db_query($admin_module_event_admin_delete_sql);

    }

    function modulesEventMasterSql($event_module_parent_id) {
        $modules_event_master_sql = "SELECT id,admin_modules_mst_id, name, filename, parameters, short_descr, filename FROM " . TABLE_HMS_MODULE_EVENT_MASTER . " WHERE `admin_modules_mst_id`=" . $event_module_parent_id. " order by name";
        $modules_event_master = db_query ($modules_event_master_sql);
        return $modules_event_master;

    }

    function adminEventModuleMasterSql ($id) {
            $admin_event_module_master_sql = "SELECT * FROM " . TABLE_HMS_MODULE_EVENT_MASTER . " WHERE id = " . $id ;
            $admin_event_module_master_result = db_query($admin_event_module_master_sql);
            return $admin_event_module_master_result;

    }

    function get_privilege_event_tree ($parent_id = '0', $spacing = '', $exclude = '', $module_tree_array = '', $include_itself = false)
{
    if ( !is_array( $module_tree_array ) )
        $module_tree_array = array();
    if ( ( sizeof( $module_tree_array ) < 1 ) && ( $exclude != '0' ) )
        $module_tree_array[] = array('id' => '0', 'text' => 'Select a module');

    if ( $include_itself ) {
        $module_query = db_query("select name from " . TABLE_HMS_MODULE_MASTER . " where id = '" . (int)$parent_id . "' order by sort_order, name");
        $module = db_fetch_array($module_query);
        $module_tree_array[] = array('id' => $parent_id, 'text' => stripslashes($module['name']));
    }

    $modules_query = db_query("select id, name, parent_id from " . TABLE_HMS_MODULE_MASTER . " where parent_id = '" . (int)$parent_id . "' order by sort_order, name");

    while ( $modules = db_fetch_array( $modules_query ) ) {
        if ((int)$exclude != $modules['id']) {
            $module_tree_array[] = array('id' => $modules['id'], 'text' => $spacing . stripslashes($modules['name']));
            $module_tree_array = $this->get_privilege_event_tree ($modules['id'], $spacing . '&nbsp;&nbsp;&nbsp;', $exclude, $module_tree_array);
        }
    }
    return $module_tree_array;
}
}
?>