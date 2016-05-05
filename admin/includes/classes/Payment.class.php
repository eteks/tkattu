<?php
class hmsInfo {

    function getStudentUserTotalRecords() {
        $hms_info_total_rows_sql = "SELECT count(`payment_mode_id`) FROM " . TABLE_HMS_PAYMENT_MODE ."";
        $hms_info_rows_result = db_query($hms_info_total_rows_sql);
        return db_result($hms_info_rows_result,0);
    }

    function studentUserFetchAllRecords($start_limit=0, $limit_rows=1) {

        $hms_info_fetch_allrec_sql = "SELECT `payment_mode_id`,`payment_mode`,`active`,`date_added`,`date_modified` FROM " . TABLE_HMS_PAYMENT_MODE. " ORDER BY `date_added` LIMIT " . $start_limit . ", ". $limit_rows ."";
        $hms_info_all_records = db_query ($hms_info_fetch_allrec_sql);
        return $hms_info_all_records;
    }

    function paymentSingRec() {

		$payment_fetch_singrec_sql =  "SELECT `payment_mode_id`,`payment_mode`,`active`,`date_added`,`date_modified` FROM " . TABLE_HMS_PAYMENT_MODE . " WHERE `payment_mode_id` = '" .$_GET["id"]."'";
        $payment_sing_records = db_query ($payment_fetch_singrec_sql);
        return $payment_sing_records;
    }

    function paymentInsert() {

        $paymentInsert=db_query ("INSERT INTO " . TABLE_HMS_PAYMENT_MODE. " ( `payment_mode_id`,`payment_mode`,`active`,`date_added`,`date_modified`) VALUES ( '', '" . addslashes( $_POST["payment_mode"] ) . "','" . $_POST["active"] . "', NOW(),'')");
        return $paymentInsert;
    }

    function paymentUpdate() {

        $newsupdate = db_query ("UPDATE " . TABLE_HMS_PAYMENT_MODE . " SET `payment_mode` = '" . addslashes( $_POST["payment_mode"] ) . "', `active` = '" . $_POST["active"] . "', `date_modified` = NOW() WHERE `payment_mode_id` = '" . (int)$_POST["id"] . "'");
        return $newsupdate;
    }

    function paymentUpdateActive() {

        $paymentUpdateActive_sql = "UPDATE " . TABLE_HMS_PAYMENT_MODE. " SET `active` = '" . $_GET["value"] . "', `date_modified` = NOW() WHERE `payment_mode_id` = " . $_GET["id"] ;
        $paymentUpdateActive_update = db_query ($paymentUpdateActive_sql);
        return $paymentUpdateActive_update;
    }

    function paymentDelete() {

        if (not_null($_GET["id"])) {
           $newsdelete = db_query ("DELETE FROM " . TABLE_HMS_PAYMENT_MODE . " WHERE `payment_mode_id` = '" . $_GET["id"] . "'");
        }
    }

	function deletepaymentMultipleRecord() {

        if (count($_GET["newsletter_manage_ids"])) {
            foreach($_GET["newsletter_manage_ids"] as $newsletter_manage_ids) {
                db_query("DELETE FROM " . TABLE_HMS_PAYMENT_MODE . " WHERE `payment_mode_id` = '" . $newsletter_manage_ids . "'");
            }
        }
    }
}
?>