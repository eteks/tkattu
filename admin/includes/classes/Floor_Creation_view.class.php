<?php
class hmsInfo {

    function floorEntrySingRec() {

		$floorEntry_fetch_singrec_sql = "SELECT `floor_creation_id`,`floor_creation_name`,`active`,`created_date`,`modified_date` FROM " . TABLE_HMS_FLOOR_CREATION . " WHERE `floor_creation_id` = '" .$_GET["id"]."'";
        $floorEntry_sing_records = db_query ($floorEntry_fetch_singrec_sql);
        return $floorEntry_sing_records;
    }

}
?>