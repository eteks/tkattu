<?php
class facility {

    function getFacility() {

        $hms_info_fetch_allrec_sql = "SELECT `hms_facility_entry_id`,`hms_facility_entry_name`,`active`,`date_added`,`date_modified` FROM " . TABLE_HMS_FACILITY_ENTRY . " WHERE `active` ='Y' ORDER BY `hms_facility_entry_name`";
        $hms_info_all_records = db_query ($hms_info_fetch_allrec_sql);
        return $hms_info_all_records;
    }

    function roomFetchAllRecords($room_type){

//echo "SELECT hrc.`room_id`,hrc.`room_no`,hrc.`floor`,hrc.`room_type`,hrc.`adults`,hrc.`child`,hrc.`smoking`,hrtc.`room_type_id`,hrtc.`room_type_name`,hrtc.`facility_id`,hrtc.`bed_size`,hrtc.`charge`,hrtc.`note` FROM " . TABLE_HMS_ROOM_CREATION . " as hrc, " . TABLE_HMS_ROOM_TYPE_CREATION . "  as hrtc WHERE hrc.`room_type` = hrtc.`room_type_id` AND hrc.`active` = 'Y' AND hrc.`room_type` = '". $room_type ."' GROUP BY hrc.`room_type`";


    $hms_info_fetch_allrec_sql = db_query("SELECT hrc.`room_id`,hrc.`room_no`,hrc.`floor`,hrc.`room_type`,hrc.`adults`,hrc.`child`,hrc.`smoking`,hrtc.`room_type_id`,hrtc.`room_type_name`,hrtc.`facility_id`,hrtc.`bed_size`,hrtc.`charge`,hrtc.`note` FROM " . TABLE_HMS_ROOM_CREATION . " as hrc, " . TABLE_HMS_ROOM_TYPE_CREATION . "  as hrtc WHERE hrc.`room_type` = hrtc.`room_type_id` AND hrc.`active` = 'Y' AND hrc.`room_type` = '". $room_type ."' GROUP BY hrc.`room_no`");
    return $hms_info_fetch_allrec_sql;
    }

}
?>