<?php
class hmsInfo {

    function getStudentUserTotalRecords() {
        $hms_info_total_rows_sql = "SELECT count(`room_services_id`) FROM " . TABLE_HMS_ROOM_SERVICES ."";
        $hms_info_rows_result = db_query($hms_info_total_rows_sql);
        return db_result($hms_info_rows_result,0);
    }

    function studentUserFetchAllRecords($start_limit=0, $limit_rows=1) {

        $hms_info_fetch_allrec_sql = "SELECT `room_services_id`,`customer_name`,`room_number`,`date`,`time`,`department`,`services`,`ser_description`,`other_description`,`charges`,`esp_com_date`,`exp_com_time`,`status` FROM " . TABLE_HMS_ROOM_SERVICES . " LIMIT " . $start_limit . ", ". $limit_rows ."";
        $hms_info_all_records = db_query ($hms_info_fetch_allrec_sql);
        return $hms_info_all_records;
    }

    function searchFetchAllRecords($start_limit=0, $limit_rows=1) {

        $formdate = explode('/',$_POST["ddDateFrom"]);
	$formdate1 = $formdate[2]."-".$formdate[0]."-".$formdate[1];
	
	$todate = explode('/',$_POST["ExDate"]);
	$todate1 = $todate[2]."-".$todate[0]."-".$todate[1];

        $hms_info_fetch_allrec_sql = "SELECT `room_services_id`,`customer_name`,`room_number`,`date`,`time`,`department`,`services`,`ser_description`,`other_description`,`charges`,`esp_com_date`,`exp_com_time`,`status` FROM " . TABLE_HMS_ROOM_SERVICES . " ";
		if(isset($_POST["search"]) == "search"){
				if($_POST["room_number"])
					$val1 = "AND `room_number` LIKE'%" . $_POST["room_number"] . "%'";
				else
				  $val1 = "";
				if($_POST["status"])
					$val3= "AND `status` LIKE'%" . $_POST["status"] . "%'";
				else
					$val3 = "";
				if($_POST["ddDateFrom"])
					$val4 = "AND `date` LIKE'%" . trim($formdate1) . "%'";
				else
					$val4 = "";
				if($_POST["ExDate"])
					$val5 = "AND `esp_com_date` LIKE'%" . trim($todate1) . "%'";
				else
					$val5 = "";
          $select_userdetails .=" WHERE 1 ".$val1." ".$val2." ".$val3." ".$val4. " ".$val5." LIMIT " . $start_limit . ", ". $limit_rows ."";
			}
	      
        $hms_info_all_records = db_query ($hms_info_fetch_allrec_sql);
        return $hms_info_all_records;
    }

    function servicesEntryInsert() {

        $servicesEntryInsert=db_query ("INSERT INTO " . TABLE_HMS_ROOM_SERVICES. " ( `room_services_id`,`customer_name`,`room_number`,`date`,`time`,`department`,`services`,`ser_description`,`other_description`,`charges`,`esp_com_date`,`exp_com_time`,`status`) VALUES ( '', '" . addslashes( $_POST["customer_name"] ) . "','". $_POST["room_number"]."','" . $_POST["ddDateFrom"] . "','" . $_POST["cur_time"] . "','" . $_POST["depart"] . "','" . $_POST["services"] . "', '" . $_POST["service_description"] . "','" . $_POST["other_service"] . "','" . $_POST["charge"] . "','" . $_POST["ExDate"] . "','" . $_POST["ExTime"] . "','" . $_POST["status"] . "')");
        return $servicesEntryInsert;
    }

	function deleteServicesEntryMultipleRecord() {

        if (count($_GET["value"])) {
	        $checkValue = explode(" ", $_GET["value"]);
			for ($j=0; $j<count($checkValue); $j++) {
                db_query("DELETE FROM " . TABLE_HMS_ROOM_SERVICES . " WHERE `room_services_id` = '" . $checkValue[$j] . "'");
            }
        }
    }

    function getServicesTree ($TableType_array = '') {
        if ( !is_array( $TableType_array ) )
            $TableType_array = array();
        if ( ( sizeof( $TableType_array ) < 1 ))
            $TableType_array[] = array('id' => '0', 'text' => 'Select a Room');
            $country_query = db_query("SELECT `booking_id`,`customer_id`, `booking_no` , `checking_no`,`rooms_no` FROM " . TABLE_HMS_BOOKING_STATUS . " WHERE `status` = 'C'");
            while($allTableType = db_fetch_array($country_query)) {
                $TableType_array[] = array('id' => $allTableType['rooms_no'], 'text' => $allTableType['rooms_no']);
            }
        return $TableType_array;
    }

   function getDepartTree ($TableType_array = '') {
        if ( !is_array( $TableType_array ) )
            $TableType_array = array();
        if ( ( sizeof( $TableType_array ) < 1 ))
            $TableType_array[] = array('id' => '0', 'text' => 'Select a Department');
            $country_query = db_query("SELECT `department_creation_id`,`department_creation_name`,`active`,`created_date`,`modified_date` FROM " . TABLE_HMS_DEPARTMENT_CREATION . "");
            while($allTableType = db_fetch_array($country_query)) {
                $TableType_array[] = array('id' => $allTableType['department_creation_name'], 'text' => $allTableType['department_creation_name']);
            }
        return $TableType_array;
    }

    function servicesEntrySingRec() {

		$servicesEntrySingRec_sql = "SELECT `hms_services_entry_id`,`hms_services_entry_department`,`hms_services_entry_name`,`hms_services_entry_charges`,`active`,`date_added`,`date_modified` FROM " . TABLE_HMS_SERVICES_ENTRY . " WHERE `hms_services_entry_id` = '" .$_GET["id"]."'";
        $servicesEntrySingRec_records = db_query ($servicesEntrySingRec_sql);
        return $servicesEntrySingRec_records;
    }

 function storedroomsNumber ($TableType_array = '') {
        if ( !is_array( $TableType_array ) )
            $TableType_array = array();
        if ( ( sizeof( $TableType_array ) < 1 ))
            $TableType_array[] = array('id' => '0', 'text' => 'Select a Room');
			$country_query = db_query("SELECT `room_services_id`,`customer_name`,`room_number` FROM " . TABLE_HMS_ROOM_SERVICES);
            while($allTableType = db_fetch_array($country_query)) {
                $TableType_array[] = array('id' => $allTableType['room_number'], 'text' => $allTableType['room_number']);
            }
        return $TableType_array;
    }	

    function servicesEntryUpdate() {

		$servicesEntryUpdate = db_query ("UPDATE " . TABLE_HMS_SERVICES_ENTRY . " SET `hms_services_entry_department` = '" . addslashes( $_POST["department"] ) . "',`hms_services_entry_name` = '" . addslashes( $_POST["services_name"] ) . "',`hms_services_entry_charges` = '".$_POST["charges"]."', `active` = '" . $_POST["active"] . "', `date_modified` = NOW() WHERE `hms_services_entry_id` = '" . (int)$_POST["id"] . "'");
		return $servicesEntryUpdate;
    }

    function servicesUpdateActive() {

        $servicesUpdateActive = "UPDATE " . TABLE_HMS_SERVICES_ENTRY. " SET `active` = '" . $_GET["value"] . "', `date_modified` = NOW() WHERE `hms_services_entry_id` = " . $_GET["id"] ;
        $servicesUpdateActive_update = db_query ($servicesUpdateActive);
        return $servicesUpdateActive_update;
    }

    function servicesEntryDelete() {

        if (not_null($_GET["id"])) {
           $servicesEntryDelete = db_query ("DELETE FROM " . TABLE_HMS_SERVICES_ENTRY . " WHERE `hms_services_entry_id` = '" . $_GET["id"] . "'");
        }
    }



    function checkDuplicate($mode) {

        if ($mode == 'insert') {
            $check_duplicate_sql = "SELECT `hms_services_entry_id` FROM " . TABLE_HMS_SERVICES_ENTRY . " WHERE `hms_services_entry_name` = '" . $_GET["services_name"] . "'";
            $check_duplicate = db_query ($check_duplicate_sql);
            if ( db_num_rows($check_duplicate) ) return "0";
            else return "1";
        } else if ($mode == 'update' && $_GET["id"]) {
            $check_duplicate_sql1 = "SELECT `hms_services_entry_id` FROM " . TABLE_HMS_SERVICES_ENTRY . " WHERE `hms_services_entry_name` = '" . $_GET["services_name"] . "' and `hms_services_entry_id` != '" . (int)$_GET["id"] . "' ";
            $check_duplicate1 = db_query ($check_duplicate_sql1);
            if ( db_num_rows($check_duplicate1) ) return "0";
            else return "1";
        }
    }
}
?>