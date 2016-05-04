<?php
class hmsInfo {

    function taxSingRec() {

		$tax_fetch_singrec_sql =  "SELECT `tax_info_id`,`tax_info_name`,`charge`,`live`,`active`,`date_added`,`date_modified` FROM " . TABLE_HMS_TAX_INFO. " WHERE `tax_info_id` = '" .$_GET["id"]."'";
        $tax_sing_records = db_query ($tax_fetch_singrec_sql);
        return $tax_sing_records;
    }

}
?>