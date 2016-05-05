<?php
class hmsInfo {

    function getStudentUserTotalRecords() {
        $hms_info_total_rows_sql = "SELECT count(`item_type_id`) FROM " . TABLE_HMS_ITEM_TYPE ."";
        $hms_info_rows_result = db_query($hms_info_total_rows_sql);
        return db_result($hms_info_rows_result,0);
    }

    function getItemInfoFetchAllRecords($start_limit=0, $limit_rows=1) {

        $hms_info_fetch_allrec_sql = "SELECT `item_type_id`,`item_type_name`,`ingredient`,`active`,`date_added`,`date_modified` FROM " . TABLE_HMS_ITEM_TYPE. " ORDER BY `date_added` LIMIT " . $start_limit . ", ". $limit_rows ."";
        $hms_info_all_records = db_query ($hms_info_fetch_allrec_sql);
        return $hms_info_all_records;
    }

    function itemSingRec() {

		$item_fetch_singrec_sql =  "SELECT `item_type_id`,`item_type_name`,`ingredient`,`active`,`date_added`,`date_modified` FROM " . TABLE_HMS_ITEM_TYPE. " WHERE `item_type_id` = " .$_GET["id"];
        $item_sing_records = db_query ($item_fetch_singrec_sql);
        return $item_sing_records;
    }

    function itemInsert() {

		if ($_POST["ingredient"] == 'Y') $ingredient = 'Y'; 
		else $ingredient = 'N';
        $itemInsert=db_query ("INSERT INTO " . TABLE_HMS_ITEM_TYPE . " ( `item_type_id`,`item_type_name`,`ingredient`,`active`,`date_added`,`date_modified`) VALUES ( '', '" .addslashes( $_POST["item_type_name"] ) . "',
		'" . $ingredient . "','" . $_POST["active"] . "', NOW(),'')");
        return $itemInsert;
    }

    function itemUpdate() {

		if ($_POST["ingredient"] == 'Y') $ingredient = 'Y'; 
		else $ingredient = 'N';

        $newsupdate = db_query ("UPDATE " . TABLE_HMS_ITEM_TYPE . " SET `item_type_name` = '" . addslashes( $_POST["item_type_name"] ) . "',`ingredient` = '" . $ingredient . "', `active` = '" . $_POST["active"] . "', `date_modified` = NOW() WHERE `item_type_id` = '" . (int)$_POST["id"] . "'");
        return $newsupdate;
    }

	 function itemUpdateIngredient() {

        $itemUpdateLive_sql = "UPDATE " . TABLE_HMS_ITEM_TYPE. " SET `ingredient` = '" . $_GET["value"] . "', `date_modified` = NOW() WHERE `item_type_id` = " . $_GET["id"] ;
        $itemUpdateIngredient_update = db_query ($itemUpdateIngredient_sql);
        return $itemUpdateIngredient_update;
	 }

    function itemUpdateActive() {

        $itemUpdateActive_sql = "UPDATE " . TABLE_HMS_ITEM_TYPE. " SET `active` = '" . $_GET["value"] . "', `date_modified` = NOW() WHERE `item_type_id` = " . $_GET["id"] ;
        $itemUpdateActive_update = db_query ($itemUpdateActive_sql);
        return $itemUpdateActive_update;
    }

    function itemDelete() {

        if (not_null($_GET["id"])) {
           $newsdelete = db_query ("DELETE FROM " . TABLE_HMS_ITEM_TYPE . " WHERE `item_type_id` = '" . $_GET["id"] . "'");
        }
    }

	function deleteitemMultipleRecord() {

        if (count($_GET["newsletter_manage_ids"])) {
            foreach($_GET["newsletter_manage_ids"] as $newsletter_manage_ids) {
                db_query("DELETE FROM " . TABLE_HMS_ITEM_TYPE . " WHERE `item_type_id` = '" . $newsletter_manage_ids . "'");
            }
        }
    }
}
?>