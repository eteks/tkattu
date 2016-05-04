<?php
class hmsInfo {

    function occasionEntrySingRec() {

	$occasionEntry_fetch_singrec_sql = "SELECT `suppliermap_id`,c.table_type_name,b.table_no,d.supplier_name,a.active,a.date_added,a.date_modified FROM " . TABLE_HMS_SUPPLIER_MAPPING. " a LEFT JOIN ".TABLE_HMS_TABLE_ENTRY." b ON a.table_no_id=b.table_entry_id LEFT JOIN ".TABLE_HMS_TABLE_TYPE_CREATION." c ON b.table_type_id=c.table_type_id LEFT JOIN ".TABLE_HMS_SUPPLIER_CREATION." d ON a.supplier_id=d.supplier_id WHERE `suppliermap_id` = '" .$_GET["id"]."'";
        $occasionEntry_sing_records = db_query ($occasionEntry_fetch_singrec_sql);
        return $occasionEntry_sing_records;
    }

}
?>