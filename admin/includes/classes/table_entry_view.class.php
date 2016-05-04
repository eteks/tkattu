<?php
class hmsInfo {

    function tableEntrySingRec($id) {

		$occasionEntry_fetch_singrec_sql = "SELECT `table_entry_id`,`table_type_id`,`table_no`,`numbers_of_chairs`,`active`,`date_added`,`date_modified` FROM " . TABLE_HMS_TABLE_ENTRY . " WHERE `table_entry_id` = '" .$id."'";
        $occasionEntry_sing_records = db_query ($occasionEntry_fetch_singrec_sql);
		$table_entry_values     = db_fetch_array($occasionEntry_sing_records);
        return $table_entry_values;
    }

    function tableTypeSingRec($id) {

        $tableEntry = $this->tableEntrySingRec($id);
		$occasionEntry_fetch_singrec_sql = "SELECT `table_type_id`,`table_type_name`,`active`,`date_added`,`date_modified` FROM " . TABLE_HMS_TABLE_TYPE_CREATION . " WHERE `table_type_id` = '" .$tableEntry["table_type_id"]."'";
        $occasionEntry_sing_records = db_query ($occasionEntry_fetch_singrec_sql);
		$table_type_values     = db_fetch_array($occasionEntry_sing_records);
        return $table_type_values;
    }

}
?>