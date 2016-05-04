<?php
class bedDetails {

    function getStudentUserTotalRecords() {
        $hms_info_total_rows_sql = "SELECT count(`hms_bed_details_id`) FROM " . TABLE_HMS_BED_DETAILS ."";
        $hms_info_rows_result = db_query($hms_info_total_rows_sql);
        return db_result($hms_info_rows_result,0);
    }

    function studentUserFetchAllRecords($start_limit=0, $limit_rows=1) {
       $hms_info_fetch_allrec_sql = "SELECT `hms_bed_details_id`,`hms_bed_details`,`active`,`date_added`,`date_modified` FROM " . TABLE_HMS_BED_DETAILS . " ORDER BY `date_added` LIMIT " . $start_limit . ", ". $limit_rows ."";
       $hms_info_all_records = db_query ($hms_info_fetch_allrec_sql);
        return $hms_info_all_records;
    }

    function bedDetailsEntrySingRec() {

        $bedDetailsEntry_fetch_singrec_sql = "SELECT `hms_bed_details_id`,`hms_bed_details`,`active`,`date_added`,`date_modified` FROM " . TABLE_HMS_BED_DETAILS. " WHERE `hms_bed_details_id` = '" .$_GET["id"]."'";
        $bedDetailsEntry_sing_records = db_query ($bedDetailsEntry_fetch_singrec_sql);
        return $bedDetailsEntry_sing_records;
    }

    function bedDetailsInsert() {

     if ($_POST["active"] == 'Y') {

        $banner_update_sql = "UPDATE  " . TABLE_HMS_BED_DETAILS . " SET `active` = 'N' WHERE `hms_bed_details_id` != '" . $_GET["id"] . "'";
        $banner_update = db_query($banner_update_sql);

        $bedDetailsInsert=db_query ("INSERT INTO " . TABLE_HMS_BED_DETAILS. " ( `hms_bed_details_id`,`hms_bed_details`,`active`,`date_added`,`date_modified`) VALUES ( '', '" . addslashes( $_POST["hms_bed_details"] ) . "','" . $_POST["active"] . "', NOW(),'')");
        return $bedDetailsInsert;
    }
    else{

        $bedDetailsInsert=db_query ("INSERT INTO " . TABLE_HMS_BED_DETAILS. " ( `hms_bed_details_id`,`hms_bed_details`,`active`,`date_added`,`date_modified`) VALUES ( '', '" . addslashes( $_POST["hms_bed_details"] ) . "','" . $_POST["active"] . "', NOW(),'')");
        return $bedDetailsInsert;
        }
    }

    function bedDetailsUpdate() {

        if ($_POST["active"] == 'Y') {

            $banner_update_sql = "UPDATE  " . TABLE_HMS_BED_DETAILS . " SET `active` = 'N' WHERE `hms_bed_details_id` != '" . $_GET["id"] . "'";
            $banner_update = db_query($banner_update_sql);

            $newsupdate = db_query ("UPDATE " .TABLE_HMS_BED_DETAILS . " SET `hms_bed_details` = '" . addslashes( $_POST[   "hms_bed_details"] ) . "', `active` = '" . $_POST["active"] . "', `date_modified` = NOW() WHERE `hms_bed_details_id` = '" . (int)$_POST["id"] . "'");
            return $newsupdate;
         } else {
            $newsupdate = db_query ("UPDATE " .TABLE_HMS_BED_DETAILS . " SET `hms_bed_details` = '" . addslashes( $_POST[   "hms_bed_details"] ) . "', `active` = '" . $_POST["active"] . "', `date_modified` = NOW() WHERE `hms_bed_details_id` = '" . (int)$_POST["id"] . "'");
            return $newsupdate;
         }
    }

    function bedDetailsUpdateActive() {

        if ($_GET["value"] == 'Y') {

            $banner_update_sql = "UPDATE  " . TABLE_HMS_BED_DETAILS . " SET `active` = 'N' WHERE `hms_bed_details_id` != '" . $_GET["id"] . "'";
            $banner_update = db_query($banner_update_sql);

            $bedDetailsUpdateActive_sql = "UPDATE " . TABLE_HMS_BED_DETAILS . " SET `active` = '" . $_GET["value"] . "', `date_modified` = NOW() WHERE `hms_bed_details_id` = " . $_GET["id"] ;
            $bedDetailsUpdateActive_update = db_query ($bedDetailsUpdateActive_sql);

        } else {

            $bedDetailsUpdateActive_sql = "UPDATE " . TABLE_HMS_BED_DETAILS . " SET `active` = '" . $_GET["value"] . "', `date_modified` = NOW() WHERE `hms_bed_details_id` = " . $_GET["id"] ;
            $bedDetailsUpdateActive_update = db_query ($bedDetailsUpdateActive_sql);

        }
    }

    function bedDetailsDelete() {

        if (not_null($_GET["id"])) {
           $newsdelete = db_query ("DELETE FROM " .  TABLE_HMS_BED_DETAILS . " WHERE `hms_bed_details_id` = '" . $_GET["id"] . "'");
        }
    }

    function deletebedDetailsMultipleRecord() {

        if (count($_GET["newsletter_manage_ids"])) {
            foreach($_GET["newsletter_manage_ids"] as $newsletter_manage_ids) {
                db_query("DELETE FROM " . TABLE_HMS_BED_DETAILS . " WHERE `hms_bed_details_id` = '" . $newsletter_manage_ids . "'");
            }
        }
    }
}
?>