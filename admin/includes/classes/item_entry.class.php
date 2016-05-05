<?php
class hmsInfo {

    function getStudentUserTotalRecords() {
        $hms_info_total_rows_sql = "SELECT count(`item_entry_id`) FROM " . TABLE_HMS_ITEM_ENTRY ."";
        $hms_info_rows_result = db_query($hms_info_total_rows_sql);
        return db_result($hms_info_rows_result,0);
    }

    function getItemInfoFetchAllRecords($start_limit=0, $limit_rows=1) {

        $hms_info_fetch_allrec_sql ="SELECT `vendor_name`, `item_entry_id`, `item_entry_type`, `item_entry_name`, `item_unit`, `opening_stock`, `item_maxqty`, `item_minqty`, `standard_qty`, `standard_rate`, active`, date_added`, `date_modified` FROM " . TABLE_HMS_ITEM_ENTRY.  " ORDER BY `date_added` LIMIT " . $start_limit . ", ". $limit_rows ."";
        $hms_info_all_records = db_query ($hms_info_fetch_allrec_sql);
        return $hms_info_all_records;
    }

    function itemSingRec() {

		$item_fetch_singrec_sql = "SELECT `vendor_name`, `item_entry_id`, `item_entry_name`, `item_entry_type`, `item_unit`, `opening_stock`, `item_maxqty`, `item_minqty`, `standard_qty`, `standard_rate`, `active`, `date_added`, `date_modified` FROM " . TABLE_HMS_ITEM_ENTRY. " WHERE `item_entry_id` = " .$_GET["id"];
        $item_sing_records = db_query ($item_fetch_singrec_sql);
        return $item_sing_records;
    }

    function itemInsert() {

		
        $itemInsert=db_query ("INSERT INTO " . TABLE_HMS_ITEM_ENTRY . " ( `vendor_name`, `item_entry_type`, `item_entry_name`, `item_unit`, `opening_stock`, `item_maxqty`, `item_minqty`, `standard_qty`, `standard_rate`, `active`, `date_added`, `date_modified`) VALUES ( '" . $_POST["vendor_name"] . "', '" .addslashes( $_POST["item_entry_type"] ) . "','" .addslashes( $_POST["item_entry_name"] ) . "','" . $_POST["item_unit"] . "','" . $_POST["opening_stock"] . "','" . $_POST["item_maxqty"] . "','" . $_POST["item_minqty"] . "','" . $_POST["standard_qty"] . "','" . $_POST["standard_rate"] . "','" . $_POST["active"] . "', NOW(),'')");
		
		
		
        return $itemInsert;
    }

    function itemUpdate() {
		
        $newsupdate = db_query ("UPDATE " . TABLE_HMS_ITEM_ENTRY . " SET `vendor_name`= '" . $_POST["vendor_name"] . "' , `item_entry_type` = '" . addslashes( $_POST["item_entry_type"] ) . "',`item_entry_name` = '" . addslashes( $_POST["item_entry_name"] ) . "' ,`item_unit`= '" . $_POST["item_unit"] . "' ,`opening_stock`= '" . $_POST["opening_stock"] . "' ,`item_maxqty`= '" . $_POST["item_maxqty"] . "',`item_minqty`= '" . $_POST["item_minqty"] . "',`standard_qty`= '" . $_POST["standard_qty"] . "',`standard_rate`= '" . $_POST["standard_rate"] . "',`active` = '" . $_POST["active"] . "', `date_modified` = NOW() WHERE `item_entry_id` = '" . (int)$_POST["id"] . "'");
        return $newsupdate;
    }

	

    function itemUpdateActive() {

        $itemUpdateActive_sql = "UPDATE " . TABLE_HMS_ITEM_ENTRY. " SET `active` = '" . $_GET["value"] . "', `date_modified` = NOW() WHERE `item_entry_id` = " . $_GET["id"] ;
        $itemUpdateActive_update = db_query ($itemUpdateActive_sql);
        return $itemUpdateActive_update;
    }

    function itemDelete() {

        if (not_null($_GET["id"])) {
           $newsdelete = db_query ("DELETE FROM " . TABLE_HMS_ITEM_ENTRY . " WHERE `item_entry_id` = '" . $_GET["id"] . "'");
        }
    }

	function deleteitemMultipleRecord() {

        if (count($_GET["newsletter_manage_ids"])) {
            foreach($_GET["newsletter_manage_ids"] as $newsletter_manage_ids) {
                db_query("DELETE FROM " . TABLE_HMS_ITEM_ENTRY . " WHERE `item_entry_id` = '" . $newsletter_manage_ids . "'");
            }
        }
    }
    function itemtypename($id)
    {
       $hms_info_fetch_allrec_sql = "SELECT item_type_name FROM " . TABLE_HMS_ITEM_TYPE. " WHERE item_type_id='".$id."'";
        $hms_info_all_records = db_query ($hms_info_fetch_allrec_sql);
        $hms_info_fetch_records = db_fetch_array($hms_info_all_records);
        return $hms_info_fetch_records['item_type_name']; 
    }
    function unitname($id)
    {
       $unit_fetch_singrec_sql =  "SELECT unit_name FROM " . TABLE_HMS_UNIT_ENTRY . " WHERE `unit_entry_id` = '$id'";
        $unit_sing_records = db_query ($unit_fetch_singrec_sql);
        $unit_sing_fetch_records = db_fetch_array($unit_sing_records);
        return $unit_sing_fetch_records['unit_name'];
    }
}
?>