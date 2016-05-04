<?php
class houseKeep {

    function getStudentUserTotalRecords() {
        $hms_info_total_rows_sql = "SELECT count(`house_keep_id`) FROM " . TABLE_HMS_HOUSE_KEEP ."";
        $hms_info_rows_result = db_query($hms_info_total_rows_sql);
        return db_result($hms_info_rows_result,0);
    }

    function studentUserFetchAllRecords($start_limit=0, $limit_rows=1) {

        $hms_info_fetch_allrec_sql = "SELECT `house_keep_id`,`room_number_id`,`type_work`, `housekeep_name`, `assign_user_id`,`date`,`esp_com_date`,`exp_com_time`,`status_id` FROM " . TABLE_HMS_HOUSE_KEEP . " LIMIT " . $start_limit . ", ". $limit_rows ."";
        $hms_info_all_records = db_query ($hms_info_fetch_allrec_sql);
        return $hms_info_all_records;
    }
	
	
    function roomsNumber ($TableType_array = '') {
        if ( !is_array( $TableType_array ) )
            $TableType_array = array();
        if ( ( sizeof( $TableType_array ) < 1 ))
            $TableType_array[] = array('id' => '0', 'text' => 'Select a Room');
			$country_query = db_query("SELECT `house_keep_id`,`room_number_id`,`type_work`,`assign_user_id`,`date`,`esp_com_date`,`exp_com_time`,`status_id` FROM " . TABLE_HMS_HOUSE_KEEP);
            while($allTableType = db_fetch_array($country_query)) {
                $TableType_array[] = array('id' => $allTableType['room_number_id'], 'text' => $allTableType['room_number_id']);
            }
        return $TableType_array;
    }	


    function searchFetchAllRecords($start_limit=0, $limit_rows=1) {

	$formdate = explode('/',$_POST["ddDateFrom"]);
	$formdate1 = $formdate[2]."-".$formdate[0]."-".$formdate[1];
	
	$todate = explode('/',$_POST["ExDate"]);
	$todate1 = $todate[2]."-".$todate[0]."-".$todate[1];
		
 $select_userdetails ="SELECT `house_keep_id`, `room_number_id`,`type_work`, `housekeep_name`, `assign_user_id`,`date`,`esp_com_date`,`exp_com_time`,`status_id` FROM " . TABLE_HMS_HOUSE_KEEP . " ";
		
 if(isset($_POST["search"]) == "search"){
				if($_POST["room_number"])
					$val1 = "AND `room_number_id` LIKE'%" . $_POST["room_number"] . "%'";
				else
				  $val1 = "";
				if($_POST["status"])
					$val3= "AND `status_id` LIKE'%" . $_POST["status"] . "%'";
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
        $hms_info_all_records = db_query ($select_userdetails);
        return $hms_info_all_records;
    }

    function houseKeepInsert() {

	$formdate = explode('/',$_POST["ddDateFrom"]);
	$formdate1 = $formdate[2]."-".$formdate[0]."-".$formdate[1];
	
	$todate = explode('/',$_POST["ExDate"]);
	$todate1 = $todate[2]."-".$todate[0]."-".$todate[1];

		if (isset($_POST["status"]) && $_POST["status"] == "1")
		{		
	$customerStatusAdd = db_query("UPDATE " . TABLE_HMS_BOOKING_STATUS . " SET `status` = 'E',`updated_on` = now() WHERE `rooms_no` = '" . trim($_POST["room_number"]) . "'");	
	echo '<script>alert('.$customerStatusAdd.');</script>';		
		}		
		
		if (isset($_POST["status"]) && $_POST["status"] == "2")
		{		
	$customerStatusAdd = db_query("UPDATE " . TABLE_HMS_BOOKING_STATUS . " SET `status` = 'HP',`updated_on` = now() WHERE `rooms_no` = '" . trim($_POST["room_number"]) . "'");	
	echo '<script>alert('.$customerStatusAdd.');</script>';		
		}

	if (isset($_POST["status"]) && $_POST["status"] == "3")
		{		
	$customerStatusAdd = db_query("UPDATE " . TABLE_HMS_BOOKING_STATUS . " SET `status` = 'HP',`updated_on` = now() WHERE `rooms_no` = '" . trim($_POST["room_number"]) . "'");	
	echo '<script>alert('.$customerStatusAdd.');</script>';		
		}

	 //$house_keep_values = db_fetch_array ($house_keep_result);
		
	$servicesEntryInsert=db_query ("INSERT INTO " . TABLE_HMS_HOUSE_KEEP. " ( `house_keep_id`,`room_number_id`, `housekeep_name`, `type_work`,`assign_user_id`,`date`,`esp_com_date`,`exp_com_time`,`status_id`) VALUES ( '', '" . trim($_POST["room_number"]) . "', '" . $_POST["house_keep"] . "', '". $_POST["type_work"]."','". $_SESSION["userid"]."','" . $formdate1 . "','" . $todate1 . "','" . $_POST["ExTime"] . "','" . $_POST["status"] . "')");
	
			return $servicesEntryInsert;
    }


function houseKeepUpdate() {
	
		if (isset($_POST["status"]) && $_POST["status"] == "2") {
	 $customerStatusAdd = db_query("UPDATE " . TABLE_HMS_BOOKING_STATUS . " SET `status` = 'H',`updated_on` = now() WHERE `rooms_no` = '" . trim($_POST["room_number"]) . "'");		
		}
			
		if (isset($_POST["status"]) && $_POST["status"] == "3") {
	 $customerStatusAdd = db_query("UPDATE " . TABLE_HMS_BOOKING_STATUS . " SET `status` = 'H',`updated_on` = now() WHERE `rooms_no` = '" . trim($_POST["room_number"]) . "'");		
		}		
		
		if (isset($_POST["status"]) && $_POST["status"] == "1") {		
	$customerStatusAdd = db_query("UPDATE " . TABLE_HMS_BOOKING_STATUS . " SET `status` = 'E',`updated_on` = now() WHERE `rooms_no` = '" . trim($_POST["room_number"]) . "'");		
		}

           $formdate = explode('/',$_POST["ddDateFrom"]);
			$formdate1 = $formdate[2]."-".$formdate[0]."-".$formdate[1];
			
			$todate = explode('/',$_POST["ExDate"]);
			$todate1 = $todate[2]."-".$todate[0]."-".$todate[1];	
			
		$servicesEntryUpdate = db_query ("UPDATE " . TABLE_HMS_HOUSE_KEEP . " SET `room_number_id` = '" .  $_POST["room_number"] . "', `housekeep_name`= '" . $_POST["house_keep"]. "', `type_work` = '" . addslashes( $_POST["type_work"] ) . "',`assign_user_id` = '". $_SESSION["userid"]."' ,`date` = '".$formdate1."', `esp_com_date` = '" . $todate1 . "', `exp_com_time` = '" . $_POST["ExTime"] . "',`status_id` = '" . $_POST["status"] . "' WHERE `house_keep_id` = '" . (int)$_POST["id"] . "'");
		return $servicesEntryUpdate;
    }

    function getRoomNo($id) {

        $hms_info_fetch_allrec_sql = "SELECT `room_id`,`room_no`,`floor`,`room_type`,`adults`,`child`,`smoking`,`active`,`date_added`,`date_modified` FROM " . TABLE_HMS_ROOM_CREATION . " WHERE `room_id` = '". $id ."'";
        $hms_info_all_records = db_query ($hms_info_fetch_allrec_sql);
        $allHouseKeep         = db_fetch_array($hms_info_all_records);
        return $allHouseKeep;
    }
	function getdepartment($id){
	$hmsdepartment="SELECT `department_creation_id`,`department_creation_name`,`active`,`created_date`,`modified_date` FROM " . TABLE_HMS_DEPARTMENT_CREATION .  " WHERE `department_creation_id` = '". $id ."'";
	$hms_info_all_record = db_query ($hmsdepartment);
	$allDepartment         = db_fetch_array($hms_info_all_record);
	return 	$allDepartment;
	}

    function servicesEntrySingRec() {

		$servicesEntrySingRec_sql = "SELECT `house_keep_id`,`room_number_id`,`type_work`, `housekeep_name`, `assign_user_id`,`date`,`esp_com_date`,`exp_com_time`,`status_id` FROM " . TABLE_HMS_HOUSE_KEEP . " WHERE `house_keep_id` = '" .$_GET["id"]."'";
        $servicesEntrySingRec_records = db_query ($servicesEntrySingRec_sql);
        return $servicesEntrySingRec_records;
    }
	
	
	
	    function ClothservicesEntrySingRec()
		{
		$clothservicesEntrySingRec_sql = "SELECT `house_keep_id`,`room_number_id`,`type_work`, `housekeep_name`, `assign_user_id`,`date`,`esp_com_date`,`exp_com_time`,`status_id` FROM " . TABLE_HMS_HOUSE_KEEP . " WHERE `house_keep_id` = '" .$_GET["id"]."'";
        $clothservicesEntrySingRec_records = db_query ($clothservicesEntrySingRec_sql);
        return $clothservicesEntrySingRec_records;
  		}
	
	
	
function houseDelete() {
	if (not_null($_POST["housekeepid"])) {
	   $newsdelete = db_query ("DELETE FROM " . TABLE_HMS_HOUSE_KEEP . " WHERE `house_keep_id` = '" . $_POST["housekeepid"] . "'");
	}
}


function getServicesTree ($TableType_array = '') {
	if ( !is_array( $TableType_array ) )
		$TableType_array = array();
	if ( ( sizeof( $TableType_array ) < 1 ))
		$TableType_array[] = array('id' => '0', 'text' => 'Select a Room');
		
		//$country_query = db_query("SELECT `room_id`,`room_no`,`floor`,`room_type`,`adults`,`child`,`smoking`,`active`,`date_added`,`date_modified` FROM " . TABLE_HMS_ROOM_CREATION . "");
		$country_query = db_query("SELECT `booking_id`,`customer_id`, `booking_no` , `checking_no`,`rooms_no` FROM " . TABLE_HMS_BOOKING_STATUS . " WHERE `status` = 'H'");
		while($allTableType = db_fetch_array($country_query)) {
			$TableType_array[] = array('id' => $allTableType['rooms_no'], 'text' => $allTableType['rooms_no']);
		}
	return $TableType_array;
}
	
	
/*?>	<?php
$Selecthousekeep=db_query("Select id,name From ".TABLE_HMS_HOUSE_KEEPING_USER_CREATION." ");
while(list($Id,$Name)=db_fetch_array($Selecthousekeep))
{		?>
<option  value="<?php echo $Id; ?>"  ><?php echo $Name; ?></option><?php 
}?><?php */

	

    function getDepartTree ($TableType_array = '') {
        if ( !is_array( $TableType_array ) )
            $TableType_array = array();
        if ( ( sizeof( $TableType_array ) < 1 ))
            $TableType_array[] = array('id' => '0', 'text' => 'Select a Department');
            $country_query = db_query("SELECT `department_creation_id`,`department_creation_name`,`active`,`created_date`,`modified_date` FROM " . TABLE_HMS_DEPARTMENT_CREATION . "");
            while($allTableType = db_fetch_array($country_query)) {
                $TableType_array[] = array('id' => $allTableType['department_creation_id'], 'text' => $allTableType['department_creation_name']);
            }
        return $TableType_array;
    }

    function servicesUpdateActive() {

        $servicesUpdateActive = "UPDATE " . TABLE_HMS_SERVICES_ENTRY. " SET `active` = '" . $_GET["value"] . "', `date_modified` = NOW() WHERE `hms_services_entry_id` = " . $_GET["id"] ;
        $servicesUpdateActive_update = db_query ($servicesUpdateActive);
        return $servicesUpdateActive_update;
    }
	
	


}

function getHousekeepname($housekeepname){
$queryhousekeep=db_query("SELECT name FROM  ".TABLE_HMS_HOUSE_KEEPING_USER_CREATION." WHERE  `id` ='".$housekeepname."'");
$Fetchhousekeep=mysql_fetch_array($queryhousekeep);
if($Fetchhousekeep['name']!=''){
echo $Fetchhousekeep['name'];
}
}	
	

?>