<?php
class hmsInfo {

    function getTaxInfoFetchAllRecords() {

        $hms_info_fetch_allrec_sql = "SELECT `tax_info_id`,`tax_category_id`,`tax_info_name`,`charge`,`live`,`active`,`date_added`,`date_modified` FROM " .TABLE_HMS_TAX_INFO ." ORDER BY `tax_info_name` ";
        $hms_info_all_records = db_query ($hms_info_fetch_allrec_sql);
        return $hms_info_all_records;
    }

    function taxSchemeInsert($formDate) {

		if (count($_POST["tax_info"])>0) {
		$comma_tax_info = implode(",", $_POST["tax_info"]);
		} else {
			$comma_tax_info = "";
		}
        $taxSchemeInsert=db_query ("INSERT INTO " . TABLE_HMS_TAX_SCHEME. " ( `tax_scheme_id`,`tax_scheme_name`,`from_date`,`active`,`date_added`,`date_modified`) VALUES ( '', '" . addslashes( $_POST["scheme_name"] ) . "','" . $formDate . "','" . $_POST["active"] . "', NOW(),'')");
    }

    function getTaxSchemeTotalRecords() {

        $hms_info_total_rows_sql = "SELECT count(`tax_scheme_id`) FROM " . TABLE_HMS_TAX_SCHEME ."";
        $hms_info_rows_result = db_query($hms_info_total_rows_sql);
        return db_result($hms_info_rows_result,0);
    }

    function getTaxSchemeFetchAllRecords($start_limit=0, $limit_rows=1) {

        $hms_info_fetch_allrec_sql = "SELECT `tax_scheme_id`,`tax_scheme_name`,`from_date`,`active`,`date_added`,`date_modified` FROM " . TABLE_HMS_TAX_SCHEME. " ORDER BY `date_added` LIMIT " . $start_limit . ", ". $limit_rows ."";
        $hms_info_all_records = db_query ($hms_info_fetch_allrec_sql);
        return $hms_info_all_records;
    }

    function taxSchemeDelete() {

        if (not_null($_GET["id"])) {
           $newsdelete = db_query ("DELETE FROM " . TABLE_HMS_TAX_SCHEME . " WHERE `tax_scheme_id` = '" . $_GET["id"] . "'");
        }
    }

	function deleteTaxSchemeMultipleRecord() {

        if (count($_GET["newsletter_manage_ids"])) {
            foreach($_GET["newsletter_manage_ids"] as $newsletter_manage_ids) {
                db_query("DELETE FROM " . TABLE_HMS_TAX_SCHEME . " WHERE `tax_scheme_id` = '" . $newsletter_manage_ids . "'");
            }
        }
    }

    function taxSchemeUpdateActive() {

        $paymentUpdateActive_sql = "UPDATE " . TABLE_HMS_TAX_SCHEME . " SET `active` = '" . $_GET["value"] . "', `date_modified` = NOW() WHERE `tax_scheme_id` = " . $_GET["id"] ;
        $paymentUpdateActive_update = db_query ($paymentUpdateActive_sql);
        return $paymentUpdateActive_update;
    }


    function taxSchemeSingRec() {

		$taxSchemeSingRec =  "SELECT `tax_scheme_id`,`tax_scheme_name`,`from_date`,`active`,`date_added`,`date_modified` FROM " . TABLE_HMS_TAX_SCHEME . " WHERE `tax_scheme_id` = '" .$_GET["id"]."'";
        $taxSchemeSingRec_records = db_query ($taxSchemeSingRec);
        return $taxSchemeSingRec_records;
    }

    function taxSchemeUpdate($formDate) {

		if (count($_POST["tax_info"])>0) {
		$comma_tax_info = implode(",", $_POST["tax_info"]);
		} else {
			$comma_tax_info = "";
		}
        $newsupdate = db_query ("UPDATE " . TABLE_HMS_TAX_SCHEME . " SET `tax_scheme_name` = '" . addslashes( $_POST["scheme_name"] ) . "', `from_date` = '" . $formDate . "', `active` = '" . $_POST["active"] . "', `date_modified` = NOW() WHERE `tax_scheme_id` = '" . (int)$_POST["id"] . "'");
        return $newsupdate;
    }

}
?>