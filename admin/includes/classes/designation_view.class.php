<?php
class hmsInfo {

    function designationEntrySingRec() {

		$departmentEntry_fetch_singrec_sql = "SELECT `designation_id`,`designation_name`,`active`,`created_date`,`modified_date` FROM " .TABLE_HMS_DESIGNATION . " WHERE `designation_id` = '" .$_GET["id"]."'";
        $departmentEntry_sing_records = db_query ($departmentEntry_fetch_singrec_sql);
        return $departmentEntry_sing_records;
    }

}
?>