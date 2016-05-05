<?php
class hmsInfo {

    function getStudentUserTotalRecords() {
        $hms_info_total_rows_sql = "SELECT count(`tax_info_id`) FROM " . TABLE_HMS_TAX_INFO ."";
        $hms_info_rows_result = db_query($hms_info_total_rows_sql);
        return db_result($hms_info_rows_result,0);
    }

    function getTaxInfoFetchAllRecords($start_limit=0, $limit_rows=1) {

        $hms_info_fetch_allrec_sql = "SELECT `tax_info_id`,`tax_info_name`,`charge`,`live`,`active`,`date_added`,`date_modified` FROM " . TABLE_HMS_TAX_INFO. " ORDER BY `date_added` LIMIT " . $start_limit . ", ". $limit_rows ."";
        $hms_info_all_records = db_query ($hms_info_fetch_allrec_sql);
        return $hms_info_all_records;
    }

    function taxSingRec() {

		$tax_fetch_singrec_sql =  "SELECT `tax_info_id`,`tax_info_name`,`charge`,`live`,`active`,`date_added`,`date_modified` FROM " . TABLE_HMS_TAX_INFO. " WHERE `tax_info_id` = " .$_GET["id"];
        $tax_sing_records = db_query ($tax_fetch_singrec_sql);
        return $tax_sing_records;
    }

    function taxInsert() {
		
		if ($_POST["live"] == 'Y') $live = 'Y'; 
		else $live = 'N';
        $taxInsert=db_query ("INSERT INTO " . TABLE_HMS_TAX_INFO . " ( `tax_info_id`,`tax_info_name`,`charge`,`live`,`active`,`date_added`,`date_modified`) VALUES ( '','".$_POST["tax_category"]."', '" .addslashes( $_POST["tax_info_name"] ) . "','" . $_POST["charge"] . "',
		'" . $live . "','" . $_POST["active"] . "', NOW(),'')");
        return $taxInsert;
    }

    function taxUpdate() {

        $newsupdate = db_query ("UPDATE " . TABLE_HMS_TAX_INFO . " SET `tax_info_name` = '" . addslashes( $_POST["tax_info_name"] ) . "',`charge` = '" . $_POST["charge"] . "',`live` = '" . $_POST["live"] . "', `active` = '" . $_POST["active"] . "', `date_modified` = NOW() WHERE `tax_info_id` = '" . (int)$_POST["id"] . "'");
        return $newsupdate;
    }

	 function taxUpdateLive() {

        $taxUpdateLive_sql = "UPDATE " . TABLE_HMS_TAX_INFO. " SET `live` = '" . $_GET["value"] . "', `date_modified` = NOW() WHERE `tax_info_id` = " . $_GET["id"] ;
        $taxUpdateLive_update = db_query ($taxUpdateLive_sql);
        return $taxUpdateLive_update;
	 }

    function taxUpdateActive() {

        $taxUpdateActive_sql = "UPDATE " . TABLE_HMS_TAX_INFO. " SET `active` = '" . $_GET["value"] . "', `date_modified` = NOW() WHERE `tax_info_id` = " . $_GET["id"] ;
        $taxUpdateActive_update = db_query ($taxUpdateActive_sql);
        return $taxUpdateActive_update;
    }

    function taxDelete() {

        if (not_null($_GET["id"])) {
           $newsdelete = db_query ("DELETE FROM " . TABLE_HMS_TAX_INFO . " WHERE `tax_info_id` = '" . $_GET["id"] . "'");
        }
    }

	function deletetaxMultipleRecord() {

        if (count($_GET["newsletter_manage_ids"])) {
            foreach($_GET["newsletter_manage_ids"] as $newsletter_manage_ids) {
                db_query("DELETE FROM " . TABLE_HMS_TAX_INFO . " WHERE `tax_info_id` = '" . $newsletter_manage_ids . "'");
            }
        }
    }
}
?>