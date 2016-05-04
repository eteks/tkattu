<?php
class hmsInfo {

    function occasionEntrySingRec() {

		$occasionEntry_fetch_singrec_sql = "SELECT `supplier_id`,`supplier_name`,`active`,`date_added`,`date_modified` FROM " . TABLE_HMS_SUPPLIER_CREATION . " WHERE `supplier_id` = '" .$_GET["id"]."'";
        $occasionEntry_sing_records = db_query ($occasionEntry_fetch_singrec_sql);
        return $occasionEntry_sing_records;
    }

}
?>