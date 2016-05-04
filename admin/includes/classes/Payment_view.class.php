<?php
class hmsInfo {

    function paymentSingRec() {

		$payment_fetch_singrec_sql =  "SELECT `payment_mode_id`,`payment_mode`,`active`,`date_added`,`date_modified` FROM " . TABLE_HMS_PAYMENT_MODE . " WHERE `payment_mode_id` = '" .$_GET["id"]."'";
        $payment_sing_records = db_query ($payment_fetch_singrec_sql);
        return $payment_sing_records;
    }


}
?>