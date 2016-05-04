<?php
class hmsInfo {

    function getStudentUserTotalRecords() {
            $hms_info_total_rows_sql = "SELECT count(`hms_occasion_entry_id`) FROM " . TABLE_HMS_OCCASION_ENTRY ."";
            $hms_info_rows_result = db_query($hms_info_total_rows_sql);
        return db_result($hms_info_rows_result,0);
    }

    function studentUserFetchAllRecords($start_limit=0, $limit_rows=1) {

            $hms_info_fetch_allrec_sql = "SELECT `hms_occasion_entry_id`,`hms_occasion_entry_name`,`active`,`date_added`,`date_modified` FROM " . TABLE_HMS_OCCASION_ENTRY . " ORDER BY `date_added` LIMIT " . $start_limit . ", ". $limit_rows ."";
            $hms_info_all_records = db_query ($hms_info_fetch_allrec_sql);
        return $hms_info_all_records;
    }

    function occasionEntrySingRec() {

		$occasionEntry_fetch_singrec_sql = "SELECT `hms_occasion_entry_id`,`hms_occasion_entry_name`,`active`,`date_added`,`date_modified` FROM " . TABLE_HMS_OCCASION_ENTRY . " WHERE `hms_occasion_entry_id` = '" .$_GET["id"]."'";
        $occasionEntry_sing_records = db_query ($occasionEntry_fetch_singrec_sql);
        return $occasionEntry_sing_records;
    }

    function occasionInsert() {

        $occasionInsert=db_query ("INSERT INTO " . TABLE_HMS_OCCASION_ENTRY. " ( `hms_occasion_entry_id`,`hms_occasion_entry_name`,`active`,`date_added`,`date_modified`) VALUES ( '', '" . addslashes( $_POST["occasion_name"] ) . "','" . $_POST["active"] . "', NOW(),'')");
        return $occasionInsert;
    }

    function occasionUpdate() {

            $newsupdate = db_query ("UPDATE " . TABLE_HMS_OCCASION_ENTRY . " SET `hms_occasion_entry_name` = '" . addslashes( $_POST["occasion_name"] ) . "', `active` = '" . $_POST["active"] . "', `date_modified` = NOW() WHERE `hms_occasion_entry_id` = '" . (int)$_POST["id"] . "'");
            return $newsupdate;
    }

    function occasionUpdateActive() {

        $occasionUpdateActive_sql = "UPDATE " . TABLE_HMS_OCCASION_ENTRY. " SET `active` = '" . $_GET["value"] . "', `date_modified` = NOW() WHERE `hms_occasion_entry_id` = " . $_GET["id"] ;
        $occasionUpdateActive_update = db_query ($occasionUpdateActive_sql);
        return $occasionUpdateActive_update;
    }

    function occasionDelete() {

        if (not_null($_GET["id"])) {
           $newsdelete = db_query ("DELETE FROM " . TABLE_HMS_OCCASION_ENTRY . " WHERE `hms_occasion_entry_id` = '" . $_GET["id"] . "'");
        }
    }

	function deleteOccasionMultipleRecord() {

        if (count($_GET["newsletter_manage_ids"])) {
            foreach($_GET["newsletter_manage_ids"] as $newsletter_manage_ids) {
                db_query("DELETE FROM " . TABLE_HMS_OCCASION_ENTRY . " WHERE `hms_occasion_entry_id` = '" . $newsletter_manage_ids . "'");
            }
        }
    }
}
?>