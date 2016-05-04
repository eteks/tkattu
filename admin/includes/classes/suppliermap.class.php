<?php
class hmsInfo {

    function getTableTypeTotalRecords() {
            $hms_info_total_rows_sql = "SELECT count(`suppliermap_id`) FROM " . TABLE_HMS_SUPPLIER_MAPPING ."";
            $hms_info_rows_result = db_query($hms_info_total_rows_sql);
        return db_result($hms_info_rows_result,0);
    }

    function tableTypeFetchAllRecords($start_limit=0, $limit_rows=1) {

            $hms_info_fetch_allrec_sql = "SELECT `suppliermap_id`,c.table_type_name,b.table_no,d.supplier_name,a.active,a.date_added,a.date_modified FROM " . TABLE_HMS_SUPPLIER_MAPPING. " a LEFT JOIN ".TABLE_HMS_TABLE_ENTRY." b ON a.table_no_id=b.table_entry_id LEFT JOIN ".TABLE_HMS_TABLE_TYPE_CREATION." c ON b.table_type_id=c.table_type_id LEFT JOIN ".TABLE_HMS_SUPPLIER_CREATION." d ON a.supplier_id=d.supplier_id order by suppliermap_id  desc LIMIT " . $start_limit . ", ". $limit_rows ."";
            $hms_info_all_records = db_query ($hms_info_fetch_allrec_sql);
        return $hms_info_all_records;
    }
   
    function getTableTypeTree ($TableType_array = '') {
        if ( !is_array( $TableType_array ) )
            $TableType_array = array();
        if ( ( sizeof( $TableType_array ) < 1 ))
            $TableType_array[] = array('id' => '0', 'text' => 'Select Table Type');
            $country_query = db_query("SELECT `table_type_id`,`table_type_name`,`active`,`date_added`,`date_modified` FROM " . TABLE_HMS_TABLE_TYPE_CREATION . " WHERE active=1  ORDER BY `date_added`");
            while($allTableType = db_fetch_array($country_query)) {
                $TableType_array[] = array('id' => $allTableType['table_type_id'], 'text' => $allTableType['table_type_name']);
            }
        return $TableType_array;
    }
    function getSupplierTree ($Supplier_array = '') {
        if ( !is_array( $Supplier_array ) )
            $Supplier_array = array();
        if ( ( sizeof( $Supplier_array ) < 1 ))
            $Supplier_array[] = array('id' => '0', 'text' => 'Select Supplier');
            $country_query = db_query("SELECT `supplier_id`,`supplier_name`,`active`,`date_added`,`date_modified` FROM " . TABLE_HMS_SUPPLIER_CREATION . " WHERE active=1 ORDER BY `date_added`");
            while($allTableType = db_fetch_array($country_query)) {
                $Supplier_array[] = array('id' => $allTableType['supplier_id'], 'text' => $allTableType['supplier_name']);
            }
        return $Supplier_array;
    }

    function tableTypeSingRec() {

		$occasionEntry_fetch_singrec_sql = "SELECT `suppliermap_id`,`table_type_id`,`table_no_id`,`supplier_id`,`active`,`date_added`,`date_modified` FROM " . TABLE_HMS_SUPPLIER_MAPPING . " WHERE `suppliermap_id` = '" .$_GET["id"]."'";
        $occasionEntry_sing_records = db_query ($occasionEntry_fetch_singrec_sql);
        return $occasionEntry_sing_records;
    }

    function tableTypeInsert() {

        $occasionInsert=db_query ("INSERT INTO " . TABLE_HMS_SUPPLIER_MAPPING. " ( `suppliermap_id`,`table_type_id`,`table_no_id`,`supplier_id`,`active`,`date_added`,`date_modified`) VALUES ( '', '" . addslashes( $_POST["suppliermap_type"] ) . "', '" . addslashes( $_POST["suppliermap_table"] ) . "', '" . addslashes( $_POST["suppliermap_supplier"] ) . "','" . $_POST["active"] . "', NOW(),'')");
        return $occasionInsert;
    }

    function tableTypeUpdate() {

            $newsupdate = db_query ("UPDATE " . TABLE_HMS_SUPPLIER_MAPPING . " SET `table_type_id` = '" . addslashes( $_POST["suppliermap_type"] ) . "',`table_no_id` = '" . addslashes( $_POST["suppliermap_table"] ) . "',`supplier_id` = '" . addslashes( $_POST["suppliermap_supplier"] ) . "', `active` = '" . $_POST["active"] . "', `date_modified` = NOW() WHERE `suppliermap_id` = '" . (int)$_POST["id"] . "'");
            return $newsupdate;
    }

    function tableTypeUpdateActive() {

        $occasionUpdateActive_sql = "UPDATE " . TABLE_HMS_SUPPLIER_MAPPING. " SET `active` = '" . $_GET["value"] . "', `date_modified` = NOW() WHERE `suppliermap_id` = " . $_GET["id"] ;
        $occasionUpdateActive_update = db_query ($occasionUpdateActive_sql);
        return $occasionUpdateActive_update;
    }

    function tableTypeDelete() {

        if (not_null($_GET["id"])) {
           $newsdelete = db_query ("DELETE FROM " . TABLE_HMS_SUPPLIER_MAPPING . " WHERE `suppliermap_id` = '" . $_GET["id"] . "'");
        }
    }

	function deleteTableTypeMultipleRecord() {

        if (count($_GET["newsletter_manage_ids"])) {
            foreach($_GET["newsletter_manage_ids"] as $newsletter_manage_ids) {
                db_query("DELETE FROM " . TABLE_HMS_SUPPLIER_MAPPING . " WHERE `suppliermap_id` = '" . $newsletter_manage_ids . "'");
            }
        }
    }
    function checkDuplicate($mode) {
       
        if ($mode == 'insert') {
            $check_duplicate_sql = "SELECT `suppliermap_id` FROM " . TABLE_HMS_SUPPLIER_MAPPING . " WHERE `table_type_id` ='".$_GET["suppliermap_type"]."' AND table_no_id='".$_GET["suppliermap_table"]."'";
            $check_duplicate = db_query ($check_duplicate_sql);
            if ( db_num_rows($check_duplicate) ) return "0";
            else return "1";
        } else if ($mode == 'update' && $_GET["id"] && $_GET["suppliermap_type"] && $_GET["suppliermap_table"]) { 
            $check_duplicate_sql1 = "SELECT `suppliermap_id` FROM " . TABLE_HMS_SUPPLIER_MAPPING . " WHERE `suppliermap_id` != '" . (int)$_GET["id"]. "' and `table_type_id` ='".$_GET["suppliermap_type"]."' AND table_no_id='".$_GET["suppliermap_table"]."'";
            $check_duplicate1 = db_query ($check_duplicate_sql1); 
            if ( db_num_rows($check_duplicate1)>0 ) 
            return 0;
            else 
            return 1;
        }
    }
}
?>