<?php
class hmsInfo {

    function unitSingRec() {

		$unit_fetch_singrec_sql =  "SELECT `unit_entry_id`,`unit_name`,`active`,`date_added`,`date_modified` FROM " . TABLE_HMS_UNIT_ENTRY . " WHERE `unit_entry_id` = '" .$_GET["id"]."'";
        $unit_sing_records = db_query ($unit_fetch_singrec_sql);
        return $unit_sing_records;
    }


}
?>