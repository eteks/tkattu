<?php
class checkout {

    function getStudentUserTotalRecords() {
            $hms_info_total_rows_sql = "SELECT count(`hms_checkout_id`) FROM " . TABLE_HMS_CHECKOUT_TIME ."";
            $hms_info_rows_result = db_query($hms_info_total_rows_sql);
        return db_result($hms_info_rows_result,0);
    }

    function studentUserFetchAllRecords($start_limit=0, $limit_rows=1) {

            $hms_info_fetch_allrec_sql = "SELECT `hms_checkout_id`,`hms_checkout_time`,`active`,`date_added`,`date_modified` FROM " . TABLE_HMS_CHECKOUT_TIME . " ORDER BY `date_added` LIMIT " . $start_limit . ", ". $limit_rows ."";
            $hms_info_all_records = db_query ($hms_info_fetch_allrec_sql);
        return $hms_info_all_records;
    }

    function checkoutEntrySingRec() {

		$checkoutEntry_fetch_singrec_sql = "SELECT `hms_checkout_id`,`hms_checkout_time`,`active`,`date_added`,`date_modified` FROM " . TABLE_HMS_CHECKOUT_TIME. " WHERE `hms_checkout_id` = '" .$_GET["id"]."'";
        $checkoutEntry_sing_records = db_query ($checkoutEntry_fetch_singrec_sql);
        return $checkoutEntry_sing_records;
    }

    function checkoutInsert() {
	
	 if ($_POST["active"] == 'Y') {

            $banner_update_sql = "UPDATE  " . TABLE_HMS_CHECKOUT_TIME . " SET `active` = 'N' WHERE `hms_checkout_id` != '" . $_GET["id"] . "'";
            $banner_update = db_query($banner_update_sql);

        $checkoutInsert=db_query ("INSERT INTO " . TABLE_HMS_CHECKOUT_TIME. " ( `hms_checkout_id`,`hms_checkout_time`,`active`,`date_added`,`date_modified`) VALUES ( '', '" . addslashes( $_POST["hms_checkout_time"] ) . "','" . $_POST["active"] . "', NOW(),'')");
        return $checkoutInsert;
    }
	else{
	
	 $checkoutInsert=db_query ("INSERT INTO " . TABLE_HMS_CHECKOUT_TIME. " ( `hms_checkout_id`,`hms_checkout_time`,`active`,`date_added`,`date_modified`) VALUES ( '', '" . addslashes( $_POST["hms_checkout_time"] ) . "','" . $_POST["active"] . "', NOW(),'')");
        return $checkoutInsert;
		}
		}
	

    function checkoutUpdate() {
	
        if ($_POST["active"] == 'Y') {

            $banner_update_sql = "UPDATE  " . TABLE_HMS_CHECKOUT_TIME . " SET `active` = 'N' WHERE `hms_checkout_id` != '" . $_GET["id"] . "'";
            $banner_update = db_query($banner_update_sql);

   $newsupdate = db_query ("UPDATE " .TABLE_HMS_CHECKOUT_TIME . " SET `hms_checkout_time` = '" . addslashes( $_POST[   "hms_checkout_time"] ) . "', `active` = '" . $_POST["active"] . "', `date_modified` = NOW() WHERE `hms_checkout_id` = '" . (int)$_POST["id"] . "'");
            return $newsupdate;
    }
	else
	{
	 $newsupdate = db_query ("UPDATE " .TABLE_HMS_CHECKOUT_TIME . " SET `hms_checkout_time` = '" . addslashes( $_POST[   "hms_checkout_time"] ) . "', `active` = '" . $_POST["active"] . "', `date_modified` = NOW() WHERE `hms_checkout_id` = '" . (int)$_POST["id"] . "'");
            return $newsupdate;
			}
			}
		
	

    function checkoutUpdateActive() {
	

        if ($_GET["value"] == 'Y') {

            $banner_update_sql = "UPDATE  " . TABLE_HMS_CHECKOUT_TIME . " SET `active` = 'N' WHERE `hms_checkout_id` != '" . $_GET["id"] . "'";
            $banner_update = db_query($banner_update_sql);

	        $checkoutUpdateActive_sql = "UPDATE " . TABLE_HMS_CHECKOUT_TIME . " SET `active` = '" . $_GET["value"] . "', `date_modified` = NOW() WHERE `hms_checkout_id` = " . $_GET["id"] ;
	        $checkoutUpdateActive_update = db_query ($checkoutUpdateActive_sql);

        } else {

	        $checkoutUpdateActive_sql = "UPDATE " . TABLE_HMS_CHECKOUT_TIME . " SET `active` = '" . $_GET["value"] . "', `date_modified` = NOW() WHERE `hms_checkout_id` = " . $_GET["id"] ;
	        $checkoutUpdateActive_update = db_query ($checkoutUpdateActive_sql);

        }
    }

    function checkoutDelete() {

        if (not_null($_GET["id"])) {
           $newsdelete = db_query ("DELETE FROM " .  TABLE_HMS_CHECKOUT_TIME . " WHERE `hms_checkout_id` = '" . $_GET["id"] . "'");
        }
    }

	function deletecheckoutMultipleRecord() {

        if (count($_GET["newsletter_manage_ids"])) {
            foreach($_GET["newsletter_manage_ids"] as $newsletter_manage_ids) {
                db_query("DELETE FROM " . TABLE_HMS_CHECKOUT_TIME . " WHERE `hms_checkout_id` = '" . $newsletter_manage_ids . "'");
            }
        }
    }
}
?>