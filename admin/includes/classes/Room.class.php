<?php
class hmsInfo {

    function getFloorTree ($Floor_array = '') {
        if ( !is_array( $Floor_array ) )
            $Floor_array = array();
        if ( ( sizeof( $Floor_array ) < 1 ))
            $Floor_array[] = array('id' => '0', 'text' => 'Select a Floor');
            $Floor_query = db_query("SELECT `floor_creation_id`,`floor_creation_name`,`active`,`created_date`,`modified_date` FROM " . TABLE_HMS_FLOOR_CREATION . " WHERE `active` = 'Y' ORDER BY `created_date`");
            while($allFloorType = db_fetch_array($Floor_query)) {
                $Floor_array[] = array('id' => $allFloorType['floor_creation_id'], 'text' => $allFloorType['floor_creation_name']);
            }
        return $Floor_array;
    }

    function getRoomTypeTree ($RoomType_array = '') {
        if ( !is_array( $RoomType_array ) )
            $RoomType_array = array();
        if ( ( sizeof( $RoomType_array ) < 1 ))
            $RoomType_array[] = array('id' => '0', 'text' => 'Select a Room Type');
            $RoomType_query = db_query("SELECT `room_type_id`,`room_type_name`,`active`,`date_added`,`date_modified` FROM " . TABLE_HMS_ROOM_TYPE_CREATION . " WHERE `active` = 'Y' ORDER BY `date_added`");
            while($allRoomType = db_fetch_array($RoomType_query)) {
                $RoomType_array[] = array('id' => $allRoomType['room_type_id'], 'text' => $allRoomType['room_type_name']);
            }
        return $RoomType_array;
    }

    function RoomInsert() {

        $RoomInsert=db_query ("INSERT INTO " . TABLE_HMS_ROOM_CREATION. " ( `room_id`,`room_no`,`floor`,`room_type`,`adults`,`child`,`smoking`,`active`,`date_added`,`date_modified`) VALUES ( '', '" . $_POST["room_no"] . "','" . $_POST["floor"] . "','" . $_POST["room_type"] . "','" . $_POST["adults"] . "','" . $_POST["child"] . "','" . $_POST["smoking"] . "','" . $_POST["active"] . "', NOW(),'')");
        return $RoomInsert;
    }

    function RoomUpdate() {

        $RoomUpdate = db_query ("UPDATE " . TABLE_HMS_ROOM_CREATION . " SET `room_no` = '" . $_POST["room_no"] . "',`floor` ='" . $_POST["floor"] . "', `room_type` = '" . $_POST["room_type"] . "', `adults`  = '" . $_POST["adults"] . "', `child` = '" . $_POST["child"] . "', `smoking` = '" . $_POST["smoking"] . "', `active` = '" . $_POST["active"] . "', `date_modified` = NOW() WHERE `room_id` = '" . (int)$_POST["id"] . "'");
        return $RoomUpdate;
    }

    function getRoomTotalRecords() {
        $hms_info_total_rows_sql = "SELECT count(`room_id`) FROM " . TABLE_HMS_ROOM_CREATION ."";
        $hms_info_rows_result = db_query($hms_info_total_rows_sql);
        return db_result($hms_info_rows_result,0);
    }

    function roomFetchAllRecords($start_limit=0, $limit_rows=1) {

        $hms_info_fetch_allrec_sql = "SELECT `room_id`,`room_no`,`floor`,`room_type`,`adults`,`child`,`smoking`,`active`,`date_added`,`date_modified` FROM " . TABLE_HMS_ROOM_CREATION . " ORDER BY `date_added` LIMIT " . $start_limit . ", ". $limit_rows ."";
        $hms_info_all_records = db_query ($hms_info_fetch_allrec_sql);
        return $hms_info_all_records;
    }

    function roomUpdateActive() {

        $roomUpdateActive_sql = "UPDATE " . TABLE_HMS_ROOM_CREATION. " SET `active` = '" . $_GET["value"] . "', `date_modified` = NOW() WHERE `room_id` = " . $_GET["id"] ;
        $roomUpdateActive_update = db_query ($roomUpdateActive_sql);
        return $roomUpdateActive_update;
    }

    function roomDelete() {

        if (not_null($_GET["id"])) {
           $newsdelete = db_query ("DELETE FROM " . TABLE_HMS_ROOM_CREATION . " WHERE `room_id` = '" . $_GET["id"] . "'");
        }
    }

	function deleteRoomTypeMultipleRecord() {

        if (count($_GET["newsletter_manage_ids"])) {
            foreach($_GET["newsletter_manage_ids"] as $newsletter_manage_ids) {
                db_query("DELETE FROM " . TABLE_HMS_ROOM_CREATION . " WHERE `room_id` = '" . $newsletter_manage_ids . "'");
            }
        }
    }

    function roomEntrySingRec() {

		$roomEntrySingRec = "SELECT `room_id`,`room_no`,`floor`,`room_type`,`adults`,`child`,`smoking`,`active`,`date_added`,`date_modified` FROM " . TABLE_HMS_ROOM_CREATION . " WHERE `room_id` = '" .$_GET["id"]."'";
        $roomEntrySingRec_records = db_query ($roomEntrySingRec);
        return $roomEntrySingRec_records;
    }

    function RoomTypeSingRec($id) {
		//$roomEntrySingRec = $this->roomEntrySingRec();
		$roomEntrySingRec = "SELECT `room_type_id`,`room_type_name`,`facility_id`,`bed_size`,`charge`,`note`,`active`,`date_added`,`date_modified` FROM " . TABLE_HMS_ROOM_TYPE_CREATION . " WHERE `room_type_id` = '" . $id ."'";
        $roomEntrySingRec_records = db_query ($roomEntrySingRec);
		$roomEntrySingRec = db_fetch_array($roomEntrySingRec_records);
        return $roomEntrySingRec;
    }

}
?>