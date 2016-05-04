<?php
class hmsInfo {

    function getStudentUserTotalRecords() {
        $hms_info_total_rows_sql = "SELECT count(`unit_entry_id`) FROM " . TABLE_HMS_UNIT_ENTRY ."";
        $hms_info_rows_result = db_query($hms_info_total_rows_sql);
        return db_result($hms_info_rows_result,0);
    }

    function studentUserFetchAllRecords($start_limit=0, $limit_rows=1) {

        $hms_info_fetch_allrec_sql = "SELECT `unit_entry_id`,`unit_name`,`active`,`date_added`,`date_modified` FROM " . TABLE_HMS_UNIT_ENTRY. " ORDER BY `date_added` DESC LIMIT " . $start_limit . ", ". $limit_rows ."";
        $hms_info_all_records = db_query ($hms_info_fetch_allrec_sql);
        return $hms_info_all_records;
    }

    function unitSingRec() {

		$unit_fetch_singrec_sql =  "SELECT `unit_entry_id`,`unit_name`,`active`,`date_added`,`date_modified` FROM " . TABLE_HMS_UNIT_ENTRY . " WHERE `unit_entry_id` = '" .$_GET["id"]."'";
        $unit_sing_records = db_query ($unit_fetch_singrec_sql);
        return $unit_sing_records;
    }

    function unitInsert() {

        $unitInsert=db_query ("INSERT INTO " . TABLE_HMS_UNIT_ENTRY. " ( `unit_entry_id`,`unit_name`,`active`,`date_added`,`date_modified`) VALUES ( '', '" . addslashes( $_POST["unit_name"] ) . "','" . $_POST["active"] . "', NOW(),'')");
        return $unitInsert;
    }

    function unitUpdate() {

        $newsupdate = db_query ("UPDATE " . TABLE_HMS_UNIT_ENTRY . " SET `unit_name` = '" . addslashes( $_POST["unit_name"] ) . "', `active` = '" . $_POST["active"] . "', `date_modified` = NOW() WHERE `unit_entry_id` = '" . (int)$_POST["id"] . "'");
        return $newsupdate;
    }

    function unitUpdateActive() {

        $unitUpdateActive_sql = "UPDATE " . TABLE_HMS_UNIT_ENTRY. " SET `active` = '" . $_GET["value"] . "', `date_modified` = NOW() WHERE `unit_entry_id` = " . $_GET["id"] ;
        $unitUpdateActive_update = db_query ($unitUpdateActive_sql);
        return $unitUpdateActive_update;
    }

    function unitDelete() {

        if (not_null($_GET["id"])) {
           $newsdelete = db_query ("DELETE FROM " . TABLE_HMS_UNIT_ENTRY . " WHERE `unit_entry_id` = '" . $_GET["id"] . "'");
        }
    }

	function deleteunitMultipleRecord() {

        if (count($_GET["newsletter_manage_ids"])) {
            foreach($_GET["newsletter_manage_ids"] as $newsletter_manage_ids) {
                db_query("DELETE FROM " . TABLE_HMS_UNIT_ENTRY . " WHERE `unit_entry_id` = '" . $newsletter_manage_ids . "'");
            }
        }
    }
}
?>