<?php
class hmsInfo {

    function occasionEntrySingRec() {

	$occasionEntry_fetch_singrec_sql = "SELECT `mse_id`,menu_name,mse_qty,mse_createdon FROM " . TABLE_HMS_MENU_STOCK_ENTRY. " a LEFT JOIN ".TABLE_HMS_MENUENTRY." b ON a.mse_menu_id=b.menu_id WHERE `mse_id` = '" .$_GET["id"]."'";
        $occasionEntry_sing_records = db_query ($occasionEntry_fetch_singrec_sql);
        return $occasionEntry_sing_records;
    }

}
?>