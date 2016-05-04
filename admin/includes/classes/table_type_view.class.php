<?php
class hmsInfo {

    function occasionEntrySingRec() {

		$occasionEntry_fetch_singrec_sql = "SELECT `table_type_id`,`table_type_name`,`active`,`date_added`,`date_modified` FROM " . TABLE_HMS_TABLE_TYPE_CREATION . " WHERE `table_type_id` = '" .$_GET["id"]."'";
        $occasionEntry_sing_records = db_query ($occasionEntry_fetch_singrec_sql);
        return $occasionEntry_sing_records;
    }

}
?>