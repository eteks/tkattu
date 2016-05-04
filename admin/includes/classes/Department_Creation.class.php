<?php
class hmsInfo {

    function getStudentUserTotalRecords() {
            $hms_info_total_rows_sql = "SELECT count(`department_creation_id`) FROM " . TABLE_HMS_DEPARTMENT_CREATION ."";
            $hms_info_rows_result = db_query($hms_info_total_rows_sql);
        return db_result($hms_info_rows_result,0);
    }

    function studentUserFetchAllRecords($start_limit=0, $limit_rows=1) {

            $hms_info_fetch_allrec_sql = "SELECT `department_creation_id`,`department_creation_name`,`active`,`created_date`,`modified_date` FROM " .TABLE_HMS_DEPARTMENT_CREATION . " ORDER BY `created_date` LIMIT " . $start_limit . ", ". $limit_rows ."";
            $hms_info_all_records = db_query ($hms_info_fetch_allrec_sql);
        return $hms_info_all_records;
    }

    function departmentEntrySingRec() {

		$departmentEntry_fetch_singrec_sql = "SELECT `department_creation_id`,`department_creation_name`,`active`,`created_date`,`modified_date` FROM " .TABLE_HMS_DEPARTMENT_CREATION . " WHERE `department_creation_id` = '" .$_GET["id"]."'";
        $departmentEntry_sing_records = db_query ($departmentEntry_fetch_singrec_sql);
        return $departmentEntry_sing_records;
    }

    function departmentInsert() {

        $departmentInsert=db_query ("INSERT INTO " .TABLE_HMS_DEPARTMENT_CREATION. " ( `department_creation_id`,`department_creation_name`,`active`,`created_date`,`modified_date`) VALUES ( '', '" . addslashes( $_POST["department_name"] ) . "','" . $_POST["active"] . "', NOW(),'')");
        return $departmentInsert;
    }

    function departmentUpdate() {

            $newsupdate = db_query ("UPDATE " .TABLE_HMS_DEPARTMENT_CREATION . " SET `department_creation_name` = '" . addslashes( $_POST["department_name"] ) . "', `active` = '" . $_POST["active"] . "', `modified_date` = NOW() WHERE `department_creation_id` = '" . (int)$_POST["id"] . "'");
            return $newsupdate;
    }

    function departmentUpdateActive() {
	 
	        $departmentUpdateActive_sql = "UPDATE " . TABLE_HMS_DEPARTMENT_CREATION . " SET `active` = '" . $_GET["value"] . "', `modified_date` = NOW() WHERE `department_creation_id` = " . $_GET["id"] ;
	        $departmentUpdateActive_update = db_query ($departmentUpdateActive_sql);
	}

    function departmentDelete() {

        if (not_null($_GET["id"])) {
           $newsdelete = db_query ("DELETE FROM " .TABLE_HMS_DEPARTMENT_CREATION . " WHERE `department_creation_id` = '" . $_GET["id"] . "'");
        }
    }

	function deletedepartmentMultipleRecord() {

        if (count($_GET["newsletter_manage_ids"])) {
            foreach($_GET["newsletter_manage_ids"] as $newsletter_manage_ids) {
                db_query("DELETE FROM " .TABLE_HMS_DEPARTMENT_CREATION . " WHERE `department_creation_id` = '" . $newsletter_manage_ids . "'");
            }
        }
    }
}
?>