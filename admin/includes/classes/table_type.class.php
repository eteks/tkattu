<?php
class hmsInfo {

    function getTableTypeTotalRecords() {
            $hms_info_total_rows_sql = "SELECT count(`table_type_id`) FROM " . TABLE_HMS_TABLE_TYPE_CREATION ."";
            $hms_info_rows_result = db_query($hms_info_total_rows_sql);
        return db_result($hms_info_rows_result,0);
    }

    function tableTypeFetchAllRecords($start_limit=0, $limit_rows=1) {

            $hms_info_fetch_allrec_sql = "SELECT `table_type_id`,`table_type_name`,`active`,`date_added`,`date_modified` FROM " . TABLE_HMS_TABLE_TYPE_CREATION . "  ORDER BY `table_type_id` desc LIMIT " . $start_limit . ", ". $limit_rows ."";
            $hms_info_all_records = db_query ($hms_info_fetch_allrec_sql);
        return $hms_info_all_records;
    }

    function tableTypeSingRec() {

		$occasionEntry_fetch_singrec_sql = "SELECT `table_type_id`,`table_type_name`,`active`,`date_added`,`date_modified` FROM " . TABLE_HMS_TABLE_TYPE_CREATION . " WHERE `table_type_id` = '" .$_GET["id"]."'";
        $occasionEntry_sing_records = db_query ($occasionEntry_fetch_singrec_sql);
        return $occasionEntry_sing_records;
    }

    function tableTypeInsert() {

        $occasionInsert=db_query ("INSERT INTO " . TABLE_HMS_TABLE_TYPE_CREATION. " ( `table_type_id`,`table_type_name`,`active`,`date_added`,`date_modified`) VALUES ( '', '" . addslashes( $_POST["table_type_name"] ) . "','" . $_POST["active"] . "', NOW(),'')");
        return $occasionInsert;
    }

    function tableTypeUpdate() {

            $newsupdate = db_query ("UPDATE " . TABLE_HMS_TABLE_TYPE_CREATION . " SET `table_type_name` = '" . addslashes( $_POST["table_type_name"] ) . "', `active` = '" . $_POST["active"] . "', `date_modified` = NOW() WHERE `table_type_id` = '" . (int)$_POST["id"] . "'");
            return $newsupdate;
    }

    function tableTypeUpdateActive() {

        $occasionUpdateActive_sql = "UPDATE " . TABLE_HMS_TABLE_TYPE_CREATION. " SET `active` = '" . $_GET["value"] . "', `date_modified` = NOW() WHERE `table_type_id` = " . $_GET["id"] ;
        $occasionUpdateActive_update = db_query ($occasionUpdateActive_sql);
        return $occasionUpdateActive_update;
    }

    function tableTypeDelete() {

        if (not_null($_GET["id"])) {
           $newsdelete = db_query ("DELETE FROM " . TABLE_HMS_TABLE_TYPE_CREATION . " WHERE `table_type_id` = '" . $_GET["id"] . "'");
        }
    }

	function deleteTableTypeMultipleRecord() {

        if (count($_GET["newsletter_manage_ids"])) {
            foreach($_GET["newsletter_manage_ids"] as $newsletter_manage_ids) {
                db_query("DELETE FROM " . TABLE_HMS_TABLE_TYPE_CREATION . " WHERE `table_type_id` = '" . $newsletter_manage_ids . "'");
            }
        }
    }
}
?>