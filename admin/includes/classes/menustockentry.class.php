<?php
class hmsInfo {

    function getTableTypeTotalRecords() {
            $hms_info_total_rows_sql = "SELECT count(`mse_id`) FROM " . TABLE_HMS_MENU_STOCK_ENTRY ."";
            $hms_info_rows_result = db_query($hms_info_total_rows_sql);
        return db_result($hms_info_rows_result,0);
    }

    function tableTypeFetchAllRecords($start_limit=0, $limit_rows=1) {

            $hms_info_fetch_allrec_sql = "SELECT c.hms_menu_category_name,`mse_id`,menu_name,mse_qty,mse_createdon FROM " . TABLE_HMS_MENU_STOCK_ENTRY. " a LEFT JOIN ".TABLE_HMS_MENUENTRY." b   ON a.mse_menu_id=b.menu_id  LEFT JOIN ".TABLE_HMS_MENUCATEGORY_CREATION." c ON b.menu_category_id=c.hms_menu_category_id order by mse_id  desc LIMIT " . $start_limit . ", ". $limit_rows ."";
            $hms_info_all_records = db_query ($hms_info_fetch_allrec_sql);
        return $hms_info_all_records;
    }
   
    function getMenuEntryTree ($MenuType_array = '') { 
        if ( !is_array( $MenuType_array ) )
            $MenuType_array = array();
        if ( ( sizeof( $MenuType_array ) < 1 ))
            $MenuType_array[] = array('id' => '0', 'text' => 'Select Menu Category');
            $country_query = db_query("SELECT `hms_menu_category_id`,`hms_menu_category_name`,`active`,`date_added`,`date_modified` FROM " . TABLE_HMS_MENUCATEGORY_CREATION. " WHERE `active` = 'Y' ORDER BY `date_added`");
            while($allMenuType = db_fetch_array($country_query)) {
                $MenuType_array[] = array('id' => $allMenuType['hms_menu_category_id'], 'text' => $allMenuType['hms_menu_category_name']);
            }
        return $MenuType_array;
    }
    
    
    function tableTypeInsert() {

        $occasionInsert=db_query ("INSERT INTO " . TABLE_HMS_MENU_STOCK_ENTRY. " (mse_menu_id,mse_qty,mse_createdon) VALUES ('" . addslashes( $_POST["mse_menu"] ) . "', '" . addslashes( $_POST["mse_qty"] ) . "', '" .date('Y-m-d h:m:i'). "')");
        return $occasionInsert;
    }

    

    function tableTypeDelete() {

        if (not_null($_GET["id"])) {
           $newsdelete = db_query ("DELETE FROM " . TABLE_HMS_MENU_STOCK_ENTRY . " WHERE `mse_id` = '" . $_GET["id"] . "'");
        }
    }

	function deleteTableTypeMultipleRecord() {

        if (count($_GET["newsletter_manage_ids"])) {
            foreach($_GET["newsletter_manage_ids"] as $newsletter_manage_ids) {
                db_query("DELETE FROM " . TABLE_HMS_MENU_STOCK_ENTRY . " WHERE `mse_id` = '" . $newsletter_manage_ids . "'");
            }
        }
    }
    
}
?>