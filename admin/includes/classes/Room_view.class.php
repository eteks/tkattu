<?php
class hmsInfo {


    function roomEntrySingRec() {

		$roomEntrySingRec = "SELECT `room_id`,`room_no`,`floor`,`room_type`,`adults`,`child`,`smoking`,`active`,`date_added`,`date_modified` FROM " . TABLE_HMS_ROOM_CREATION . " WHERE `room_id` = '" .$_GET["id"]."'";
        $roomEntrySingRec_records = db_query ($roomEntrySingRec);
		$roomEntrySingRec = db_fetch_array($roomEntrySingRec_records);
        return $roomEntrySingRec;
    }

    function FloorSingRec() {
		$roomEntrySingRec = $this->roomEntrySingRec();
		$roomEntrySingRec = "SELECT `floor_creation_id`,`floor_creation_name`,`active`,`created_date`,`modified_date` FROM " . TABLE_HMS_FLOOR_CREATION . " WHERE `floor_creation_id` = '" . $roomEntrySingRec["floor"] ."'";
        $roomEntrySingRec_records = db_query ($roomEntrySingRec);
		$roomEntrySingRec = db_fetch_array($roomEntrySingRec_records);
        return $roomEntrySingRec;
    }

    function RoomTypeSingRec() {
		$roomEntrySingRec = $this->roomEntrySingRec();
		$roomEntrySingRec = "SELECT `room_type_id`,`room_type_name`,`facility_id`,`bed_size`,`charge`,`note`,`active`,`date_added`,`date_modified` FROM " . TABLE_HMS_ROOM_TYPE_CREATION . " WHERE `room_type_id` = '" . $roomEntrySingRec["room_type"] ."'";
        $roomEntrySingRec_records = db_query ($roomEntrySingRec);
		$roomEntrySingRec = db_fetch_array($roomEntrySingRec_records);
        return $roomEntrySingRec;
    }

}
?>