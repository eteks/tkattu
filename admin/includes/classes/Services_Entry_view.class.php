<?php
class hmsInfo {

    function servicesEntrySingRec() {

		$servicesEntrySingRec_sql = "SELECT `hms_services_entry_id`,`hms_services_entry_department`,`hms_services_entry_name`,`hms_services_entry_charges`,`active`,`date_added`,`date_modified` FROM " . TABLE_HMS_SERVICES_ENTRY . " WHERE `hms_services_entry_id` = '" .$_GET["id"]."'";
        $servicesEntrySingRec_records = db_query ($servicesEntrySingRec_sql);
        return $servicesEntrySingRec_records;
    }

}
?>