<?php
class hmsInfo {

    function getStudentUserTotalRecords() {
        $hms_info_total_rows_sql = "SELECT count(`vendor_id`) FROM " . TABLE_HMS_VENDOR_CREATION ."";
        $hms_info_rows_result = db_query($hms_info_total_rows_sql);
        return db_result($hms_info_rows_result,0);
    }

    function getvendorInfoFetchAllRecords($start_limit=0, $limit_rows=1) {

        $hms_info_fetch_allrec_sql = "SELECT `vendor_id`,`vendor_name`,`vendor_address`,`vendor_city` , `vendor_state`, `vendor_country`, `vendor_zip`,`vendor_phone`, `vendor_mobile`, `vendor_contact`,`item_id`,`active`,`date_added`,`date_modified` FROM " . TABLE_HMS_VENDOR_CREATION. " ORDER BY `date_added` LIMIT " . $start_limit . ", ". $limit_rows ."";
        $hms_info_all_records = db_query ($hms_info_fetch_allrec_sql);
        return $hms_info_all_records;
    }

    function vendorSingRec() {

		$vendor_fetch_singrec_sql =  "SELECT `vendor_id`,`vendor_name`,`vendor_address`,`vendor_city` , `vendor_state`, `vendor_country`, `vendor_zip`,`vendor_phone`, `vendor_mobile`, `vendor_contact`,`item_id`,`active`,`date_added`,`date_modified` FROM " . TABLE_HMS_VENDOR_CREATION. " WHERE `vendor_id` = " .$_GET["id"];
        $vendor_sing_records = db_query ($vendor_fetch_singrec_sql);
        return $vendor_sing_records;
    }

    function vendorInsert() {

        $vendorInsert=db_query ("INSERT INTO " . TABLE_HMS_VENDOR_CREATION . " ( `vendor_id`,`vendor_name`,`vendor_address`,`vendor_city` , `vendor_state`, `vendor_country`, `vendor_zip`,`vendor_phone`, `vendor_mobile`, `vendor_contact`,`item_id`,`active`,`date_added`,`date_modified`) VALUES ( '', '" . addslashes( $_POST["vendor_name"] ) . "','" . addslashes($_POST["vendor_address"]) . "','" . addslashes($_POST["vendor_city"]) . "','" . addslashes($_POST["vendor_state"]) . "','" . addslashes($_POST["country_name"]) . "','" . $_POST["vendor_zip"] . "','" . $_POST["vendor_phone"] . "','" . $_POST["vendor_mobile"] . "','" . $_POST["vendor_contact"] . "','" . $_POST["item_id"] . "','" . $_POST["active"] . "', NOW(),'')");
        return $vendorInsert;
    }

    function vendorUpdate() {

        $newsupdate = db_query ("UPDATE " . TABLE_HMS_VENDOR_CREATION . " SET `vendor_name` = '" . addslashes( $_POST["vendor_name"] ) . "',`vendor_address`='" .addslashes($_POST["vendor_address"]) . "',`vendor_city`='" . addslashes($_POST["vendor_city"]) . "',`vendor_state`='" . addslashes($_POST["vendor_state"]) . "',`vendor_country`='" . addslashes($_POST["country_name"]) . "',`vendor_zip`='" . $_POST["vendor_zip"] . "',`vendor_phone`='" . $_POST["vendor_phone"] . "',`vendor_mobile`='" . $_POST["vendor_mobile"] . "',`vendor_contact`='" . $_POST["vendor_contact"] . "',`item_id`='" .$_POST["item_id"] ."', `active` = '" . $_POST["active"] . "', `date_modified` = NOW() WHERE `vendor_id` = '" . (int)$_POST["id"] . "'");
        return $newsupdate;
    }

    function vendorUpdateActive() {

        $vendorUpdateActive_sql = "UPDATE " . TABLE_HMS_VENDOR_CREATION. " SET `active` = '" . $_GET["value"] . "', `date_modified` = NOW() WHERE `vendor_id` = " . $_GET["id"] ;
        $vendorUpdateActive_update = db_query ($vendorUpdateActive_sql);
        return $vendorUpdateActive_update;
    }

    function vendorDelete() {

        if (not_null($_GET["id"])) {
           $newsdelete = db_query ("DELETE FROM " . TABLE_HMS_VENDOR_CREATION . " WHERE `vendor_id` = '" . $_GET["id"] . "'");
        }
    }

	function deletevendorMultipleRecord() {

        if (count($_GET["newsletter_manage_ids"])) {
            foreach($_GET["newsletter_manage_ids"] as $newsletter_manage_ids) {
                db_query("DELETE FROM " . TABLE_HMS_VENDOR_CREATION . " WHERE `vendor_id` = '" . $newsletter_manage_ids . "'");
            }
        }
    }
}
?>