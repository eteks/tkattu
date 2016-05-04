<?php
class hmsInfo {

    function facilityEntrySingRec() {

		$facilityEntrySingRec_sql = "SELECT `hms_facility_entry_id`,`hms_facility_entry_name`,`hms_facility_charges`,`active`,`date_added`,`date_modified` FROM " . TABLE_HMS_FACILITY_ENTRY . " WHERE `hms_facility_entry_id` = '" .$_GET["id"]."'";
        $facilityEntrySingRec_records = db_query ($facilityEntrySingRec_sql);
        return $facilityEntrySingRec_records;
    }

}
?>