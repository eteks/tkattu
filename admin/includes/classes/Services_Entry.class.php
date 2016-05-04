<?php
class hmsInfo {

    function getStudentUserTotalRecords() {
        $hms_info_total_rows_sql = "SELECT count(`hms_services_entry_id`) FROM " . TABLE_HMS_SERVICES_ENTRY ."";
        $hms_info_rows_result = db_query($hms_info_total_rows_sql);
        return db_result($hms_info_rows_result,0);
    }

    function studentUserFetchAllRecords($start_limit=0, $limit_rows=1) {

        $hms_info_fetch_allrec_sql = "SELECT `hms_services_entry_id`,`hms_services_entry_department`,`hms_services_entry_name`,`hms_services_entry_charges`,`active`,`date_added`,`date_modified` FROM " . TABLE_HMS_SERVICES_ENTRY . " ORDER BY `date_added` LIMIT " . $start_limit . ", ". $limit_rows ."";
        $hms_info_all_records = db_query ($hms_info_fetch_allrec_sql);
        return $hms_info_all_records;
    }

    function servicesEntrySingRec() {

		$servicesEntrySingRec_sql = "SELECT `hms_services_entry_id`,`hms_services_entry_department`,`hms_services_entry_name`,`hms_services_entry_charges`,`active`,`date_added`,`date_modified` FROM " . TABLE_HMS_SERVICES_ENTRY . " WHERE `hms_services_entry_id` = '" .$_GET["id"]."'";
        $servicesEntrySingRec_records = db_query ($servicesEntrySingRec_sql);
        return $servicesEntrySingRec_records;
    }

    function servicesEntryInsert() {

        $servicesEntryInsert=db_query ("INSERT INTO " . TABLE_HMS_SERVICES_ENTRY. " ( `hms_services_entry_id`,`hms_services_entry_department`,`hms_services_entry_name`,`hms_services_entry_charges`,`active`,`date_added`,`date_modified`) VALUES ( '', '" . addslashes( $_POST["department"] ) . "','". addslashes( $_POST["services_name"])."','".$_POST["charges"]."','" . $_POST["active"] . "', NOW(),'')");
        return $servicesEntryInsert;
    }

    function servicesEntryUpdate() {

		$servicesEntryUpdate = db_query ("UPDATE " . TABLE_HMS_SERVICES_ENTRY . " SET `hms_services_entry_department` = '" . addslashes( $_POST["department"] ) . "',`hms_services_entry_name` = '" . addslashes( $_POST["services_name"] ) . "',`hms_services_entry_charges` = '".$_POST["charges"]."', `active` = '" . $_POST["active"] . "', `date_modified` = NOW() WHERE `hms_services_entry_id` = '" . (int)$_POST["id"] . "'");
		return $servicesEntryUpdate;
    }

    function servicesUpdateActive() {

        $servicesUpdateActive = "UPDATE " . TABLE_HMS_SERVICES_ENTRY. " SET `active` = '" . $_GET["value"] . "', `date_modified` = NOW() WHERE `hms_services_entry_id` = " . $_GET["id"] ;
        $servicesUpdateActive_update = db_query ($servicesUpdateActive);
        return $servicesUpdateActive_update;
    }

    function servicesEntryDelete() {

        if (not_null($_GET["id"])) {
           $servicesEntryDelete = db_query ("DELETE FROM " . TABLE_HMS_SERVICES_ENTRY . " WHERE `hms_services_entry_id` = '" . $_GET["id"] . "'");
        }
    }

	function deleteServicesEntryMultipleRecord() {

        if (count($_GET["newsletter_manage_ids"])) {
            foreach($_GET["newsletter_manage_ids"] as $newsletter_manage_ids) {
                db_query("DELETE FROM " . TABLE_HMS_SERVICES_ENTRY . " WHERE `hms_services_entry_id` = '" . $newsletter_manage_ids . "'");
            }
        }
    }

    function checkDuplicate($mode) {

        if ($mode == 'insert') {
            $check_duplicate_sql = "SELECT `hms_services_entry_id` FROM " . TABLE_HMS_SERVICES_ENTRY . " WHERE `hms_services_entry_name` = '" . $_GET["services_name"] . "'";
            $check_duplicate = db_query ($check_duplicate_sql);
            if ( db_num_rows($check_duplicate) ) return "0";
            else return "1";
        } else if ($mode == 'update' && $_GET["id"]) {
            $check_duplicate_sql1 = "SELECT `hms_services_entry_id` FROM " . TABLE_HMS_SERVICES_ENTRY . " WHERE `hms_services_entry_name` = '" . $_GET["services_name"] . "' and `hms_services_entry_id` != '" . (int)$_GET["id"] . "' ";
            $check_duplicate1 = db_query ($check_duplicate_sql1);
            if ( db_num_rows($check_duplicate1) ) return "0";
            else return "1";
        }
    }
}
?>