<?php
class hmsInfo {

    function getStudentUserTotalRecords() {
            $hms_info_total_rows_sql = "SELECT count(`floor_creation_id`) FROM " . TABLE_HMS_FLOOR_CREATION ."";
            $hms_info_rows_result = db_query($hms_info_total_rows_sql);
        return db_result($hms_info_rows_result,0);
    }

    function studentUserFetchAllRecords($start_limit=0, $limit_rows=1) {

            $hms_info_fetch_allrec_sql = "SELECT `floor_creation_id`,`floor_creation_name`,`active`,`created_date`,`modified_date` FROM " . TABLE_HMS_FLOOR_CREATION . " ORDER BY `created_date` LIMIT " . $start_limit . ", ". $limit_rows ."";
            $hms_info_all_records = db_query ($hms_info_fetch_allrec_sql);
        return $hms_info_all_records;
    }

    function floorEntrySingRec() {

		$floorEntry_fetch_singrec_sql = "SELECT `floor_creation_id`,`floor_creation_name`,`active`,`created_date`,`modified_date` FROM " . TABLE_HMS_FLOOR_CREATION . " WHERE `floor_creation_id` = '" .$_GET["id"]."'";
        $floorEntry_sing_records = db_query ($floorEntry_fetch_singrec_sql);
        return $floorEntry_sing_records;
    }

    function floorInsert() {

        $floorInsert=db_query ("INSERT INTO " . TABLE_HMS_FLOOR_CREATION. " ( `floor_creation_id`,`floor_creation_name`,`active`,`created_date`,`modified_date`) VALUES ( '', '" . addslashes( $_POST["floor_name"] ) . "','" . $_POST["active"] . "', NOW(),'')");
        return $floorInsert;
    }

    function floorUpdate() {

            $newsupdate = db_query ("UPDATE " . TABLE_HMS_FLOOR_CREATION . " SET `floor_creation_name` = '" . addslashes( $_POST["floor_name"] ) . "', `active` = '" . $_POST["active"] . "', `modified_date` = NOW() WHERE `floor_creation_id` = '" . (int)$_POST["id"] . "'");
            return $newsupdate;
    }

    function floorUpdateActive() {

        $floorUpdateActive_sql = "UPDATE " . TABLE_HMS_FLOOR_CREATION. " SET `active` = '" . $_GET["value"] . "', `modified_date` = NOW() WHERE `floor_creation_id` = " . $_GET["id"] ;
        $floorUpdateActive_update = db_query ($floorUpdateActive_sql);
        return $floorUpdateActive_update;
    }

    function floorDelete() {

        if (not_null($_GET["id"])) {
           $newsdelete = db_query ("DELETE FROM " . TABLE_HMS_FLOOR_CREATION . " WHERE `floor_creation_id` = '" . $_GET["id"] . "'");
        }
    }

	function deletefloorMultipleRecord() {

        if (count($_GET["newsletter_manage_ids"])) {
            foreach($_GET["newsletter_manage_ids"] as $newsletter_manage_ids) {
                db_query("DELETE FROM " . TABLE_HMS_FLOOR_CREATION . " WHERE `floor_creation_id` = '" . $newsletter_manage_ids . "'");
            }
        }
    }
}
?>