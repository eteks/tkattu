<?php
class hmsInfo {

    function getTableEntryTotalRecords() {
            $hms_info_total_rows_sql = "SELECT count(`table_entry_id`) FROM " . TABLE_HMS_TABLE_ENTRY ."";
            $hms_info_rows_result = db_query($hms_info_total_rows_sql);
        return db_result($hms_info_rows_result,0);
    }

    function tableEntryFetchAllRecords($start_limit=0, $limit_rows=1) {

            $hms_info_fetch_allrec_sql = "SELECT `table_entry_id`,`table_type_id`,`table_no`,`numbers_of_chairs`,`active`,`date_added`,`date_modified` FROM " . TABLE_HMS_TABLE_ENTRY . " ORDER BY `table_entry_id` desc LIMIT " . $start_limit . ", ". $limit_rows ."";
            $hms_info_all_records = db_query ($hms_info_fetch_allrec_sql);
        return $hms_info_all_records;
    }

    function getTableTypeTree ($TableType_array = '') {
        if ( !is_array( $TableType_array ) )
            $TableType_array = array();
        if ( ( sizeof( $TableType_array ) < 1 ))
            $TableType_array[] = array('id' => '0', 'text' => 'Select Table Type');
            $country_query = db_query("SELECT `table_type_id`,`table_type_name`,`active`,`date_added`,`date_modified` FROM " . TABLE_HMS_TABLE_TYPE_CREATION . " WHERE active=1 ORDER BY `date_added`");
            while($allTableType = db_fetch_array($country_query)) {
                $TableType_array[] = array('id' => $allTableType['table_type_id'], 'text' => $allTableType['table_type_name']);
            }
        return $TableType_array;
    }


    function tableEntrySingRec() {

		$occasionEntry_fetch_singrec_sql = "SELECT `table_entry_id`,`table_type_id`,`table_no`,`numbers_of_chairs`,`active`,`date_added`,`date_modified` FROM " . TABLE_HMS_TABLE_ENTRY . " WHERE `table_entry_id` = '" .$_GET["id"]."'";
        $occasionEntry_sing_records = db_query ($occasionEntry_fetch_singrec_sql);
		$table_entry_values     = db_fetch_array($occasionEntry_sing_records);
        return $table_entry_values;
    }

    function tableTypeSingRec($id) {

		$occasionEntry_fetch_singrec_sql = "SELECT a.table_type_id,a.table_type_name,a.active,a.date_added,a.date_modified,table_no FROM " . TABLE_HMS_TABLE_TYPE_CREATION . " a LEFT JOIN ".TABLE_HMS_TABLE_ENTRY." b on b.table_type_id=a.table_type_id WHERE a.table_type_id = '" . $id ."'";
        $occasionEntry_sing_records = db_query ($occasionEntry_fetch_singrec_sql);
		$table_type_values     = db_fetch_array($occasionEntry_sing_records);
        return $table_type_values;
    }

    function tableEntryInsert() {
        $occasionInsert=db_query ("INSERT INTO " . TABLE_HMS_TABLE_ENTRY. " ( `table_entry_id`,`table_type_id`,`table_no`,`numbers_of_chairs`,`active`,`date_added`,`date_modified`) VALUES ( '','" . $_POST["table_type"] . "','" . $_POST["table_no"] . "', '" . $_POST["no_of_chairs"] . "','" . $_POST["active"] . "', NOW(),'')");
        return $occasionInsert;
    }

    function tableTypeUpdate() {

            $newsupdate = db_query ("UPDATE " . TABLE_HMS_TABLE_ENTRY . " SET `table_type_id` = '" . $_POST["table_type"] . "', `table_no` = '" . $_POST["table_no"] . "',`numbers_of_chairs` = '" . $_POST["no_of_chairs"] . "',`active` = '" . $_POST["active"] . "', `date_modified` = NOW() WHERE `table_entry_id` = '" . (int)$_POST["id"] . "'");
            return $newsupdate;
    }

    function tableEntryUpdateActive() {

        $occasionUpdateActive_sql = "UPDATE " . TABLE_HMS_TABLE_ENTRY. " SET `active` = '" . $_GET["value"] . "', `date_modified` = NOW() WHERE `table_entry_id` = " . $_GET["id"] ;
        $occasionUpdateActive_update = db_query ($occasionUpdateActive_sql);
        return $occasionUpdateActive_update;
    }

    function tableEntryDelete() {

        if (not_null($_GET["id"])) {
           $newsdelete = db_query ("DELETE FROM " . TABLE_HMS_TABLE_ENTRY . " WHERE `table_entry_id` = '" . $_GET["id"] . "'");
        }
    }

	function deleteTableTypeMultipleRecord() {

        if (count($_GET["newsletter_manage_ids"])) {
            foreach($_GET["newsletter_manage_ids"] as $newsletter_manage_ids) {
                db_query("DELETE FROM " . TABLE_HMS_TABLE_ENTRY . " WHERE `table_entry_id` = '" . $newsletter_manage_ids . "'");
            }
        }
    }

    function checkDuplicate($mode) {
        
        

        if ($mode == 'insert') {
            $check_duplicate_sql = "SELECT `table_entry_id`,`table_no` FROM " . TABLE_HMS_TABLE_ENTRY . " WHERE `table_no` ='".$_GET["table_no"]."' AND `table_no` ='".$_GET["table_no"]."'";
            $check_duplicate = db_query ($check_duplicate_sql);
            if ( db_num_rows($check_duplicate) ) return "0";
            else return "1";
        } else if ($mode == 'update' && $_GET["id"] && $_GET["table_no"] && $_GET["table_type"]) { 
            $check_duplicate_sql1 = "SELECT `table_entry_id`,`table_no` FROM " . TABLE_HMS_TABLE_ENTRY . " WHERE `table_entry_id` != '" . (int)$_GET["id"]. "' and `table_no` ='".$_GET["table_no"]."'";
            $check_duplicate1 = db_query ($check_duplicate_sql1); 
            if ( db_num_rows($check_duplicate1)>0 ) 
            return 0;
            else 
            return 1;
        }
    }

}
?>