<?php
class hmsInfo {

    function menucaegorySingRec() {

		$menucategory_fetch_singrec_sql =  "SELECT `hms_menu_category_id`,`hms_menu_category_name`,`taxable`,`active`,`date_added`,`date_modified`,session FROM " . TABLE_HMS_MENUCATEGORY_CREATION . " WHERE `hms_menu_category_id` = '" .$_GET["id"]."'";
        $menucategory_sing_records = db_query ($menucategory_fetch_singrec_sql);
        return $menucategory_sing_records;
    }


}
?>