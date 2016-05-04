<?php
class hmsInfo {

 function itemSingRec() {

		$item_fetch_singrec_sql =  "SELECT `item_entry_id`,`vendor_name`,`item_entry_name`,`item_entry_type`,`item_unit`,`opening_stock`,`item_maxqty`,`item_minqty`,`standard_qty`,`standard_rate`,`active`,`date_added`,`date_modified` FROM " . TABLE_HMS_ITEM_ENTRY. " WHERE `item_entry_id` = " .$_GET["id"];
		
        $item_sing_records = db_query ($item_fetch_singrec_sql);
		
        return $item_sing_records;
		
    }

}

?>