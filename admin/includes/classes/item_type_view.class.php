<?php
class hmsInfo {

 function itemSingRec() {

		$item_fetch_singrec_sql =  "SELECT `item_type_id`,`item_type_name`,`ingredient`,`active`,`date_added`,`date_modified` FROM " . TABLE_HMS_ITEM_TYPE. " WHERE `item_type_id` = " .$_GET["id"];
        $item_sing_records = db_query ($item_fetch_singrec_sql);
        return $item_sing_records;
    }
}
?>