<?php
class hmsInfo {


    function roomTypeEntrySingRec() {

		$occasionEntry_fetch_singrec_sql = "SELECT `room_type_id`,`room_type_name`,`facility_id`,`bed_size`,`charge`,`note`,`active`,`date_added`,`date_modified` FROM " . TABLE_HMS_ROOM_TYPE_CREATION . " WHERE `room_type_id` = '" .$_GET["id"]."'";
        $occasionEntry_sing_records = db_query ($occasionEntry_fetch_singrec_sql);
        return $occasionEntry_sing_records;
    }

}
?>