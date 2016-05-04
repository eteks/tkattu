<?php
class hmsInfo {

    function departmentEntrySingRec() {

		$departmentEntry_fetch_singrec_sql = "SELECT `department_creation_id`,`department_creation_name`,`active`,`created_date`,`modified_date` FROM " .TABLE_HMS_DEPARTMENT_CREATION . " WHERE `department_creation_id` = '" .$_GET["id"]."'";
        $departmentEntry_sing_records = db_query ($departmentEntry_fetch_singrec_sql);
        return $departmentEntry_sing_records;
    }

}
?>