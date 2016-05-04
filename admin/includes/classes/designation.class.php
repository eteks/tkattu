<?php
class hmsInfo {

    function getStudentUserTotalRecords() {
            $hms_info_total_rows_sql = "SELECT count(`designation_id`) FROM " . TABLE_HMS_DESIGNATION ."";
            $hms_info_rows_result = db_query($hms_info_total_rows_sql);
        return db_result($hms_info_rows_result,0);
    }

    function studentUserFetchAllRecords($start_limit=0, $limit_rows=1) {

            $hms_info_fetch_allrec_sql = "SELECT `designation_id`,`designation_name`,`active`,`created_date`,`modified_date` FROM " .TABLE_HMS_DESIGNATION . " ORDER BY `created_date` LIMIT " . $start_limit . ", ". $limit_rows ."";
            $hms_info_all_records = db_query ($hms_info_fetch_allrec_sql);
        return $hms_info_all_records;
    }

    function designationEntrySingRec() {

		$designationEntry_fetch_singrec_sql = "SELECT `designation_id`,`designation_name`,`active`,`created_date`,`modified_date` FROM " .TABLE_HMS_DESIGNATION . " WHERE `designation_id` = '" .$_GET["id"]."'";
        $designationEntry_sing_records = db_query ($designationEntry_fetch_singrec_sql);
        return $designationEntry_sing_records;
    }

    function designationInsert() {

        $designationInsert=db_query ("INSERT INTO " .TABLE_HMS_DESIGNATION. " ( `designation_id`,`designation_name`,`active`,`created_date`,`modified_date`) VALUES ( '', '" . addslashes( $_POST["designation_name"] ) . "','" . $_POST["active"] . "', NOW(),'')");
        return $designationInsert;
    }

    function designationUpdate() {

            $newsupdate = db_query ("UPDATE " .TABLE_HMS_DESIGNATION . " SET `designation_name` = '" . addslashes( $_POST["designation_name"] ) . "', `active` = '" . $_POST["active"] . "', `modified_date` = NOW() WHERE `designation_id` = '" . (int)$_POST["id"] . "'");
            return $newsupdate;
    }

    function designationUpdateActive() {
	 
	        $designationUpdateActive_sql = "UPDATE " . TABLE_HMS_DESIGNATION . " SET `active` = '" . $_GET["value"] . "', `modified_date` = NOW() WHERE `designation_id` = " . $_GET["id"] ;
	        $designationUpdateActive_update = db_query ($designationUpdateActive_sql);
	}

    function designationDelete() {

        if (not_null($_GET["id"])) {
           $newsdelete = db_query ("DELETE FROM " .TABLE_HMS_DESIGNATION . " WHERE `designation_id` = '" . $_GET["id"] . "'");
        }
    }

	function deletedesignationMultipleRecord() {

        if (count($_GET["newsletter_manage_ids"])) {
            foreach($_GET["newsletter_manage_ids"] as $newsletter_manage_ids) {
                db_query("DELETE FROM " .TABLE_HMS_DESIGNATION . " WHERE `designation_id` = '" . $newsletter_manage_ids . "'");
            }
        }
    }
}
?>