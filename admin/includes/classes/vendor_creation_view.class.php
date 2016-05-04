<?php
class hmsInfo 

{

  function vendorSingRec() {

		$vendor_fetch_singrec_sql =  "SELECT `vendor_id`,`vendor_name`,`vendor_address`,`vendor_city` , `vendor_state`, `vendor_country`, `vendor_zip`,`vendor_phone`, `vendor_mobile`, `vendor_contact`,`item_id`,`active`,`date_added`,`date_modified` FROM " . TABLE_HMS_VENDOR_CREATION. " WHERE `vendor_id` = " .$_GET["id"];
        $vendor_sing_records = db_query ($vendor_fetch_singrec_sql);
        return $vendor_sing_records;
    }

}



?>