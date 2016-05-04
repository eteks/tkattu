<?php
class hmsInfo {

    function getRoomTypeTotalRecords() {
            $hms_info_total_rows_sql = "SELECT count(`room_type_id`) FROM " . TABLE_HMS_ROOM_TYPE_CREATION ."";
            $hms_info_rows_result = db_query($hms_info_total_rows_sql);
        return db_result($hms_info_rows_result,0);
    }

    function roomTypeFetchAllRecords($start_limit=0, $limit_rows=1) {

            $hms_info_fetch_allrec_sql = "SELECT `room_type_id`,`room_type_name`,`facility_id`,`bed_size`,`charge`,`note`,`active`,`date_added`,`date_modified` FROM " . TABLE_HMS_ROOM_TYPE_CREATION . " ORDER BY `date_added` LIMIT " . $start_limit . ", ". $limit_rows ."";
            $hms_info_all_records = db_query ($hms_info_fetch_allrec_sql);
        return $hms_info_all_records;
    }

    function FacilitiesFetchAllRecords($start_limit=0, $limit_rows=1) {

            $hms_info_fetch_allrec_sql = "SELECT `hms_facility_entry_id`,`hms_facility_entry_name`,`active`,`date_added`,`date_modified` FROM " . TABLE_HMS_FACILITY_ENTRY . " ORDER BY `hms_facility_entry_name` ";
            $hms_info_all_records = db_query ($hms_info_fetch_allrec_sql);
        return $hms_info_all_records;
    }

    function roomTypeEntrySingRec() {

		$occasionEntry_fetch_singrec_sql = "SELECT `room_type_id`,`room_type_name`,`facility_id`,`bed_size`,`charge`,`note`,`active`,`date_added`,`date_modified` FROM " . TABLE_HMS_ROOM_TYPE_CREATION . " WHERE `room_type_id` = '" .$_GET["id"]."'";
        $occasionEntry_sing_records = db_query ($occasionEntry_fetch_singrec_sql);
        return $occasionEntry_sing_records;
    }

    function roomTypeInsert() {

		if (count($_POST["facilities"])>0) {
		$comma_separated = implode(",", $_POST["facilities"]);
		} else {
			$comma_separated = "";
		}
        $occasionInsert=db_query ("INSERT INTO " . TABLE_HMS_ROOM_TYPE_CREATION. " ( `room_type_id`,`room_type_name`,`facility_id`,`bed_size`,`charge`,`note`,`active`,`date_added`,`date_modified`) VALUES ( '', '" . addslashes( $_POST["room_type"] ) . "','" . $comma_separated . "','" . $_POST["bed_size"] . "','" . $_POST["charge"] . "','" . $_POST["room_type_note"] . "','" . $_POST["active"] . "', NOW(),'')");
        return $occasionInsert;
    }

    function roomTypeUpdate() {

		if (count($_POST["facilities"])>0) {
		$comma_separated = implode(",", $_POST["facilities"]);
		} else {
			$comma_separated = "";
		}

            $newsupdate = db_query ("UPDATE " . TABLE_HMS_ROOM_TYPE_CREATION . " SET `room_type_name` = '" . addslashes( $_POST["room_type"] ) . "',`facility_id`='" . $comma_separated . "',`bed_size` = '" . $_POST["bed_size"] . "', `charge` = '" . $_POST["charge"] . "', `note` = '" . $_POST["room_type_note"] . "', `active` = '" . $_POST["active"] . "', `date_modified` = NOW() WHERE `room_type_id` = '" . (int)$_POST["id"] . "'");
            return $newsupdate;
    }

    function roomTypeUpdateActive() {

        $occasionUpdateActive_sql = "UPDATE " . TABLE_HMS_ROOM_TYPE_CREATION. " SET `active` = '" . $_GET["value"] . "', `date_modified` = NOW() WHERE `room_type_id` = " . $_GET["id"] ;
        $occasionUpdateActive_update = db_query ($occasionUpdateActive_sql);
        return $occasionUpdateActive_update;
    }

    function roomTypeDelete() {

        if (not_null($_GET["id"])) {
           $newsdelete = db_query ("DELETE FROM " . TABLE_HMS_ROOM_TYPE_CREATION . " WHERE `room_type_id` = '" . $_GET["id"] . "'");
        }
    }

	function deleteRoomTypeMultipleRecord() {

        if (count($_GET["newsletter_manage_ids"])) {
            foreach($_GET["newsletter_manage_ids"] as $newsletter_manage_ids) {
                db_query("DELETE FROM " . TABLE_HMS_ROOM_TYPE_CREATION . " WHERE `room_type_id` = '" . $newsletter_manage_ids . "'");
            }
        }
    }

    function checkDuplicate($mode) {

        if ($mode == 'insert') {
            $check_duplicate_sql = "SELECT `room_type_id` FROM " . TABLE_HMS_ROOM_TYPE_CREATION . " WHERE `room_type_name` = '" . $_GET["room_type"] . "'";
            $check_duplicate = db_query ($check_duplicate_sql);
            if ( db_num_rows($check_duplicate) ) return "0";
            else return "1";
        } else if ($mode == 'update' && $_GET["id"]) {
            $check_duplicate_sql1 = "SELECT `room_type_id` FROM " . TABLE_HMS_ROOM_TYPE_CREATION . " WHERE `room_type_name` = '" . $_GET["room_type"] . "' and `room_type_id` != '" . (int)$_GET["id"] . "' ";
            $check_duplicate1 = db_query ($check_duplicate_sql1);
            if ( db_num_rows($check_duplicate1) ) return "0";
            else return "1";
        }
    }
}
?>