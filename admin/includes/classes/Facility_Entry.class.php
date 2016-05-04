<?php
class hmsInfo {

    function getStudentUserTotalRecords() {
            $hms_info_total_rows_sql = "SELECT count(`hms_facility_entry_id`) FROM " . TABLE_HMS_FACILITY_ENTRY ."";
            $hms_info_rows_result = db_query($hms_info_total_rows_sql);
        return db_result($hms_info_rows_result,0);
    }

    function studentUserFetchAllRecords($start_limit=0, $limit_rows=1) {

            $hms_info_fetch_allrec_sql = "SELECT `hms_facility_entry_id`,`hms_facility_entry_name`,`active`,`date_added`,`date_modified` FROM " . TABLE_HMS_FACILITY_ENTRY . " ORDER BY `date_added` LIMIT " . $start_limit . ", ". $limit_rows ."";
            $hms_info_all_records = db_query ($hms_info_fetch_allrec_sql);
        return $hms_info_all_records;
    }

    function facilityEntrySingRec() {

		$occasionEntry_fetch_singrec_sql = "SELECT `hms_facility_entry_id`,`hms_facility_entry_name`,`hms_facility_charges`,`active`,`date_added`,`date_modified` FROM " . TABLE_HMS_FACILITY_ENTRY . " WHERE `hms_facility_entry_id` = '" .$_GET["id"]."'";
        $occasionEntry_sing_records = db_query ($occasionEntry_fetch_singrec_sql);
        return $occasionEntry_sing_records;
    }

    function facilityEntryInsert() {

        $facilityEntryInsert=db_query ("INSERT INTO " . TABLE_HMS_FACILITY_ENTRY. " ( `hms_facility_entry_id`,`hms_facility_entry_name`,`hms_facility_charges`,`active`,`date_added`,`date_modified`) VALUES ( '', '" . addslashes( $_POST["facility_name"] ) . "','".$_POST["charges"]."','" . $_POST["active"] . "', NOW(),'')");
        return $facilityEntryInsert;
    }

    function facilityEntryUpdate() {

		$facilityEntryUpdate = db_query ("UPDATE " . TABLE_HMS_FACILITY_ENTRY . " SET `hms_facility_entry_name` = '" . addslashes( $_POST["facility_name"] ) . "',`hms_facility_charges` = '".$_POST["charges"]."', `active` = '" . $_POST["active"] . "', `date_modified` = NOW() WHERE `hms_facility_entry_id` = '" . (int)$_POST["id"] . "'");
		return $facilityEntryUpdate;
    }

    function facilityEntryUpdateActive() {

        $occasionUpdateActive_sql = "UPDATE " . TABLE_HMS_FACILITY_ENTRY. " SET `active` = '" . $_GET["value"] . "', `date_modified` = NOW() WHERE `hms_facility_entry_id` = " . $_GET["id"] ;
        $occasionUpdateActive_update = db_query ($occasionUpdateActive_sql);
        return $occasionUpdateActive_update;
    }

    function facilityEntryDelete() {

        if (not_null($_GET["id"])) {
           $facilityEntryDelete = db_query ("DELETE FROM " . TABLE_HMS_FACILITY_ENTRY . " WHERE `hms_facility_entry_id` = '" . $_GET["id"] . "'");
        }
    }

	function deleteFacilityEntryMultipleRecord() {

        if (count($_GET["newsletter_manage_ids"])) {
            foreach($_GET["newsletter_manage_ids"] as $newsletter_manage_ids) {
                db_query("DELETE FROM " . TABLE_HMS_FACILITY_ENTRY . " WHERE `hms_facility_entry_id` = '" . $newsletter_manage_ids . "'");
            }
        }
    }

    function checkDuplicate($mode) {

        if ($mode == 'insert') {
            $check_duplicate_sql = "SELECT `hms_facility_entry_id` FROM " . TABLE_HMS_FACILITY_ENTRY . " WHERE `hms_facility_entry_name` = '" . $_GET["facility_name"] . "'";
            $check_duplicate = db_query ($check_duplicate_sql);
            if ( db_num_rows($check_duplicate) ) return "0";
            else return "1";
        } else if ($mode == 'update' && $_GET["id"]) {
            $check_duplicate_sql1 = "SELECT `hms_facility_entry_id` FROM " . TABLE_HMS_FACILITY_ENTRY . " WHERE `hms_facility_entry_name` = '" . $_GET["facility_name"] . "' and `hms_facility_entry_id` != '" . (int)$_GET["id"] . "' ";
            $check_duplicate1 = db_query ($check_duplicate_sql1);
            if ( db_num_rows($check_duplicate1) ) return "0";
            else return "1";
        }
    }
}
?>