<?php
class reservation {

    function customerDetailsAdd(){
	
	$formdate = explode('/',$_POST["ddDateFrom"]);
	$formdate1 = $formdate[2]."-".$formdate[0]."-".$formdate[1];
	
	$todate = explode('/',$_POST["ddDateTo"]);
	$todate1 = $todate[2]."-".$todate[0]."-".$todate[1];	

       $customerDetailsAdd = db_query( "INSERT INTO " . TABLE_HMS_CUSTOMER_TABLE . "( `customer_name` , `customer_address` , `customer_city` , `customer_zip`,`customer_state`, `customer_country` , customer_contact_no, `customer_email_id`,`customer_id_type` , `customer_id_no`,`customer_veh_no`, `created_by` , `created_on` ) VALUES  ('" . $_POST["cut_name"] . "', '" . $_POST["address"] . "', '" . $_POST["city"] . "', '" .  $_POST["pincode"] . "','" . $_POST["State"] . "', '" . $_POST["country"] . "','" . $_POST["phone"] . "', '" . $_POST["email"] . "', '" . $_POST["id_type"] . "', '" . $_POST["id_no"] . "','" . $_POST["vechile_no"] . "', '".$_SESSION["userid"]."',NOW())");
       $customerId = db_insert_id();
	     
	 
       $customerStatusAdd = db_query("INSERT INTO " . TABLE_HMS_BOOKING_STATUS . "( `customer_id`, `booking_no` , `checking_no` , `no_adults` , `no_child` , `room_type_id` , `rooms_id` , `no_of_rooms` , `rooms_no` , `no_of_days` , `extra_bed` , `extra_bed_charge` , `nature_of_guest` , `payment_type` , `room_amount` , `total_amount` ,`advance_pay` , `amount_status` , `status` , `checkin_date` , `checkout_date` , `created_by` , `created_on`  ) VALUES ('" . $customerId . "', '".$_POST["booking_no"]."', '0' , '" . $_POST["no_of_adults"] . "', '" . $_POST["no_of_children"] . "', '" . $_POST["room_type_id"] . "', '" . $_POST["rooms_id"] . "', '" . $_POST["no_of_rooms"] . "' , '" . $_POST["rooms_no"] . "' , '" . $_POST["no_of_days"] . "' , '" . $_POST["extra_bed"] . "' , '" . $_POST["extra_bed_charge"] . "' , '" . $_POST["nature_of_guest"] . "' , '" . $_POST["payment_mode"] . "' , '" . $_POST["room_amount"] . "' , '" . $_POST["total_amount"] . "' , '" . $_POST["advance_pay"] . "' , 'NC' , 'B' , '" . $formdate1 . "','" . $todate1 . "','" . $_SESSION["userid"] . "',NOW())");
       $customerStatusId = db_insert_id();
    }
    function customerDetailsCheckInAdd(){
	
	$formdate1 = explode('/',$_POST["ddDateFrom"]);
	$formdate2 = $formdate1[2]."-".$formdate1[0]."-".$formdate1[1];
	
	$todate1 = explode('/',$_POST["ddDateTo"]);
	$todate2 = $todate1[2]."-".$todate1[0]."-".$todate1[1];	
	
       $customerDetailsAdd = db_query( "INSERT INTO " . TABLE_HMS_CUSTOMER_TABLE . "( `customer_name` , `customer_address` , `customer_city` , `customer_zip`,`customer_state`, `customer_country` , customer_contact_no, `customer_email_id`,`customer_id_type` , `customer_id_no`,`customer_veh_no`, `created_by` , `created_on` ) VALUES 
       ('" . $_POST["cut_name"] . "', '" . $_POST["address"] . "', '" . $_POST["city"] . "', '" .  $_POST["pincode"] . "','" . $_POST["State"] . "', '" . $_POST["country"] . "','" . $_POST["phone"] . "', '" . $_POST["email"] . "', '" . $_POST["id_type"] . "', '" . $_POST["id_no"] . "','" . $_POST["vechile_no"] . "', '" . $_SESSION["userid"] . "',NOW())");
       $customerId = db_insert_id();

       $customerStatusAdd = db_query("INSERT INTO " . TABLE_HMS_BOOKING_STATUS . "( `customer_id`, `booking_no` , `checking_no` , `no_adults` , `no_child` , `room_type_id` , `rooms_id` , `no_of_rooms` , `rooms_no` , `no_of_days` , `extra_bed` , `extra_bed_charge` , `nature_of_guest` , `payment_type` , `room_amount` , `total_amount` , `advance_pay` , `discount` , `balance_amount` , `amount_status` , `status` , `checkin_date` , `checkout_date` , `created_by` , `created_on` ,`vat_tax` , `service_tax` , `sale_tax`) VALUES ('" . $customerId . "', '0', '".$_POST["confirm_no"]."' , '" . $_POST["no_of_adults"] . "', '" . $_POST["no_of_children"] . "', '" . $_POST["room_type_id"] . "', '" . $_POST["rooms_id"] . "', '" . $_POST["no_of_rooms"] . "' , '" . $_POST["rooms_no"] . "' , '" . $_POST["no_of_days"] . "' , '" . $_POST["extra_bed"] . "' , '" . $_POST["extra_bed_charge"] . "' , '" . $_POST["natureofguest"] . "' , '" . $_POST["payment_mode"] . "' , '" . $_POST["room_amount"] . "' , '" . $_POST["total_amount"] . "' ,  '" . $_POST["advance_pay"] . "' , '" . $_POST["discount"] . "' ,  '" . $_POST["balance_amount"] . "' ,  'NC' , 'C' ,  '" . $formdate2 . "','" . $todate2 . "','" . $_SESSION["userid"] . "',NOW(),'".$_POST["vat_tax"]."','".$_POST["ser_tax"]."','".$_POST["sale_tax"]."')");
       $customerStatusId = db_insert_id();
    }
    function customerDetailsCheckInUpdate(){
	
	$formdate1 = explode('/',$_POST["ddDateFrom"]);
	$formdate2 = $formdate1[2]."-".$formdate1[0]."-".$formdate1[1];
	
	$todate1 = explode('/',$_POST["ddDateTo"]);
	$todate2 = $todate1[2]."-".$todate1[0]."-".$todate1[1];		

      $customerDetailsAdd = db_query("UPDATE " . TABLE_HMS_CUSTOMER_TABLE . " SET `customer_name`='" . $_POST["cut_name"] . "' , `customer_address` = '" . $_POST["address"] . "' ,   `customer_city` =  '" . $_POST["city"] . "' , `customer_zip` = '" . $_POST["pincode"] . "',`customer_state` = '" . $_POST["State"] . "', `customer_country` = '" . $_POST["country"] . "' , customer_contact_no = '" . $_POST["phone"] . "', `customer_email_id` = '" . $_POST["email"] . "',`customer_id_type` = '" . $_POST["id_type"] . "', `customer_id_no` = '" . $_POST["id_no"] . "' ,`customer_veh_no` = '" . $_POST["vechile_no"] . "',`created_by` = '" . $_SESSION["userid"] . "' WHERE customer_id = '".$_POST["customer_id"]."'");

      $customerStatusAdd = db_query("UPDATE " . TABLE_HMS_BOOKING_STATUS . " SET `checking_no` = '".$_POST["confirm_no"]."', `no_adults` = '" . $_POST["no_of_adults"] . "', `no_child` = '" . $_POST["no_of_children"] . "',`room_type_id` = '" . $_POST["room_type_id"] . "' , `rooms_id` = '" . $_POST["rooms_id"] . "' , `no_of_rooms` = '" . $_POST["no_of_rooms"] . "',`rooms_no` = '" . $_POST["rooms_no"] . "', `no_of_days` = '" . $_POST["no_of_days"] . "' , `extra_bed` = '" . $_POST["extra_bed"] . "', `extra_bed_charge` = '" . $_POST["extra_bed_charge"] . "' , `nature_of_guest` = '" . $_POST["nature_of_guest"] . "' , `payment_type` = '" . $_POST["payment_mode"] . "', `room_amount` = '" . $_POST["room_amount"] . "', `total_amount` = '" . $_POST["total_amount"] . "' , `advance_pay` = '" . $_POST["advance_pay"] . "' , `discount` = '" . $_POST["discount"] . "' , `balance_amount` = '" . $_POST["balance_amount"] . "', `amount_status` = 'NC' , `status` = 'C' , `checkin_date` =  '" . $formdate2 . "', `checkout_date` = '" . $todate2 . "' , `created_by` = '" . $_SESSION["userid"] . "',`updated_on` = now(), `vat_tax`='".$_POST["vat_tax"]."', `service_tax`='".$_POST["ser_tax"]."', `sale_tax`='".$_POST["sale_tax"]."'	 WHERE booking_id = '".$_POST["booking_no"]."'");
    }
	
   function customerDetailsPreCheckoutUpdate(){
	
	$formdate1 = explode('/',$_POST["ddDateFrom"]);
	$formdate2 = $formdate1[2]."-".$formdate1[0]."-".$formdate1[1];
	
	$todate1 = explode('/',$_POST["ddDateTo"]);
	$todate2 = $todate1[2]."-".$todate1[0]."-".$todate1[1];	

      $customerStatusAdd = db_query("UPDATE " . TABLE_HMS_BOOKING_STATUS . " SET `no_of_days` = '" . $_POST["no_of_days"] . "' , `room_amount` = '" . $_POST["room_amount"] . "', `total_amount` = '" . $_POST["total_amount"] . "' , `advance_pay` = '" . $_POST["advance_pay"] . "' , `discount` = '" . $_POST["discount"] . "' , `balance_amount` = '" . $_POST["balance_amount"] . "', `amount_status` = 'NC' , `status` = 'H' , `checkin_date` =  '" . $formdate2 . "', `checkout_date` = '" . $todate2 . "' , `created_by` = '" . $_SESSION["userid"] . "',`updated_on` = now() WHERE checking_no = '".trim($_POST["confirm_no"])."'");
    }	


function customercheckout() {
      
       $customerStatusAdd = db_query("UPDATE " . TABLE_HMS_BOOKING_STATUS . " SET `status` = 'H' , `checkin_date` =  '" . $_POST["checkin"] . "', `checkout_date` = '" . $_POST["checkout"] . "' ,`updated_on` = now() WHERE checking_no = '".trim($_POST["checkinno"])."'");
   }
   
   
   function customerBookingCancel() {

      $customerUpdate = db_query( "UPDATE " . TABLE_HMS_BOOKING_STATUS . " SET updated_on = '".$_POST["booking_cancel_date"]."', amt_refund = '".$_POST["amount_refund"]."' , refund_reason = '".$_POST["refund_reason"]."' , status = 'BC' ,`created_by`= '" . $_SESSION["userid"] . "' WHERE booking_id = '".$_POST["bookingid"]."'");
   }

   function bookingNo(){
		$hms_info_fetch_allrec_sql = db_query("SELECT MAX(`checking_no`) as checking_no FROM " . TABLE_HMS_BOOKING_STATUS );
		$booking = db_fetch_array($hms_info_fetch_allrec_sql);
		return $booking;
    }

   function booking(){
		$hms_info_fetch_allrec_sql = db_query("SELECT MAX(booking_no) as booking_no FROM " . TABLE_HMS_BOOKING_STATUS );
		$booking = db_fetch_array($hms_info_fetch_allrec_sql);
		return $booking;
    }

    function getPaymentMode ($RoomType_array = '') {
        if ( !is_array( $RoomType_array ) )
            $RoomType_array = array();
        if ( ( sizeof( $RoomType_array ) < 1 ))
            $RoomType_array[] = array('id' => '0', 'text' => 'Select Payment Mode');
            $RoomType_query = db_query("SELECT `payment_mode_id`,`payment_mode`,`active`,`date_added`,`date_modified` FROM " . TABLE_HMS_PAYMENT_MODE . " WHERE `active` = 'Y' ORDER BY `date_added`");
            while($allRoomType = db_fetch_array($RoomType_query)) {
                $RoomType_array[] = array('id' => $allRoomType['payment_mode_id'], 'text' => $allRoomType['payment_mode']);
            }
        return $RoomType_array;
    }

    function getRoomType ($RoomType_array = '') {
        if ( !is_array( $RoomType_array ) )
            $RoomType_array = array();
        if ( ( sizeof( $RoomType_array ) < 1 ))
            $RoomType_array[] = array('id' => '0', 'text' => 'Select Room Type');
            $RoomType_array[] = array('id' => 'all', 'text' => 'ALL');
            $RoomType_query = db_query("SELECT `room_type_id`,`room_type_name`,`facility_id`,`bed_size`,`charge`,`note`,`active`,`date_added`,`date_modified` FROM " . TABLE_HMS_ROOM_TYPE_CREATION . " WHERE `active` = 'Y' ORDER BY `date_added`");
            while($allRoomType = db_fetch_array($RoomType_query)) {
                $RoomType_array[] = array('id' => $allRoomType['room_type_id'], 'text' => $allRoomType['room_type_name']);
            }
        return $RoomType_array;
    }

    function roomTypeFetchAllRecords() {

        $hms_info_fetch_allrec_sql = "SELECT `room_type_id`,`room_type_name`,`facility_id`,`bed_size`,`charge`,`note`,`active`,`date_added`,`date_modified` FROM " . TABLE_HMS_ROOM_TYPE_CREATION . " ORDER BY `date_added`";
        $hms_info_all_records = db_query ($hms_info_fetch_allrec_sql);
        return $hms_info_all_records;
    }

    function confirmation() {

        $hms_info_fetch_allrec_sql = "SELECT `booking_id`,`customer_id`, `booking_no` , `checking_no` FROM " . TABLE_HMS_BOOKING_STATUS . " WHERE `status` = 'B'";
        $hms_info_all_records = db_query ($hms_info_fetch_allrec_sql);
        return $hms_info_all_records;
    }
	
    function confirmationCheckOut() {

        $hms_info_fetch_allrec_sql = "SELECT `booking_id`,`customer_id`, `booking_no` , `checking_no` FROM " . TABLE_HMS_BOOKING_STATUS . " WHERE `status` = 'C'";
        $hms_info_all_records = db_query ($hms_info_fetch_allrec_sql);
        return $hms_info_all_records;
    }	

    function confirmationbooking($bookingid) {

        $RoomType_query = db_query("SELECT `customer_id`, `booking_no` , `no_adults`,`no_child`,`room_type_id`,`rooms_id`,`checkin_date`,`checkout_date`,`created_by`,`created_on` FROM " . TABLE_HMS_BOOKING_STATUS . " WHERE `booking_id` = '". $bookingid ."' ");

        return $RoomType_query;
    }

    
    function customerDetailSelect(){

		$hms_info_fetch_allrec_sql = db_query("SELECT hct.`customer_name` , hct.`customer_address` , hct.`customer_city`,hct.`customer_zip`,hct.`customer_state`,hct.`customer_country`,hct.customer_contact_no,hct.`customer_email_id`,hct.`customer_id_type`,hct.`customer_id_no`,hct.`customer_veh_no`,hct.`created_by`,hct.`created_on`,hbs.`customer_id`,hbs.`booking_no`,hbs.`checking_no`,hbs.`no_adults`,hbs.`no_child`,hbs.`room_type_id`,hbs.`rooms_id`,hbs.`no_of_rooms`,hbs.`no_of_days`,hbs.`advance_pay`,hbs.`total_amount`,hbs.`room_amount`,hbs.`extra_bed`,hbs.`extra_bed_charge`,hbs.`balance_amount`,hbs.`rooms_no`,hbs.`payment_type`,hbs.`nature_of_guest`,hbs.`discount`,hbs.`checkin_date`,hbs.`checkout_date`,hbs.`created_by`,hbs.`created_on`, hbs.`vat_tax`, hbs.`service_tax`, hbs.`sale_tax` FROM " . TABLE_HMS_CUSTOMER_TABLE . " as hct, " . TABLE_HMS_BOOKING_STATUS . "  as hbs WHERE hct.`customer_id` = hbs.`customer_id` AND hbs.`customer_id` = '". $_POST["bookingid"] ."'");
		
//confirm($hms_info_fetch_allrec_sql);

		
		$hms_customer_details = db_fetch_array($hms_info_fetch_allrec_sql);
		
		
		
		return $hms_customer_details;
    }
	
   function preCheckoutDetailselect(){

		$hms_info_fetch_allrec_sql = db_query("SELECT hct.`customer_name` , hct.`customer_address` , hct.`customer_city`,hct.`customer_zip`,hct.`customer_state`,hct.`customer_country`,hct.customer_contact_no,hct.`customer_email_id`,hct.`customer_id_type`,hct.`customer_id_no`,hct.`customer_veh_no`,hct.`created_by`,hct.`created_on`,hbs.`customer_id`,hbs.`booking_no`,hbs.`checking_no`,hbs.`no_adults`,hbs.`no_child`,hbs.`room_type_id`,hbs.`rooms_id`,hbs.`no_of_rooms`,hbs.`no_of_days`,hbs.`advance_pay`,hbs.`total_amount`,hbs.`extra_bed`,hbs.`extra_bed_charge`,hbs.`balance_amount`,hbs.`rooms_no`,hbs.`payment_type`,hbs.`nature_of_guest`,hbs.`discount`,hbs.`checkin_date`,hbs.`checkout_date`,hbs.`created_by`,hbs.`created_on`,hbs.`vat_tax`,hbs.`service_tax`,hbs.`sale_tax` FROM " . TABLE_HMS_CUSTOMER_TABLE . " as hct, " . TABLE_HMS_BOOKING_STATUS . "  as hbs WHERE hct.`customer_id` = hbs.`customer_id` AND hbs.`checking_no` = '". trim($_POST["checkingno"]) ."'");
		$hms_customer_details = db_fetch_array($hms_info_fetch_allrec_sql);
		return $hms_customer_details;
    }	
	
    function CheckoutDetailselect(){

		$hms_info_fetch_allrec_sql = db_query("SELECT hct.`customer_name` , hct.`customer_address` , hct.`customer_city`,hct.`customer_zip`,hct.`customer_state`,hct.`customer_country`,hct.customer_contact_no,hct.`customer_email_id`,hct.`customer_id_type`,hct.`customer_id_no`,hct.`customer_veh_no`,hct.`created_by`,hct.`created_on`,hbs.`customer_id`,hbs.`booking_no`,hbs.`checking_no`,hbs.`no_adults`,hbs.`no_child`,hbs.`room_type_id`,hbs.`rooms_id`,hbs.`no_of_rooms`,hbs.`no_of_days`,hbs.`advance_pay`,hbs.`total_amount`,hbs.`extra_bed`,hbs.`extra_bed_charge`,hbs.`balance_amount`,hbs.`rooms_no`,hbs.`payment_type`,hbs.`nature_of_guest`,hbs.`discount`,hbs.`checkin_date`,hbs.`checkout_date`,hbs.`created_by`,hbs.`created_on` FROM " . TABLE_HMS_CUSTOMER_TABLE . " as hct, " . TABLE_HMS_BOOKING_STATUS . "  as hbs WHERE hct.`customer_id` = hbs.`customer_id` AND hbs.`checking_no` = '". trim($_POST["checkingno"]) ."'");
		$hms_customer_details = db_fetch_array($hms_info_fetch_allrec_sql);
		return $hms_customer_details;
    }	

    function roomFetchAllRecords() {

        $hms_info_fetch_allrec_sql = ("SELECT `room_id`,`room_no`,`floor`,`room_type`,`adults`,`child`,`smoking`,`active`,`date_added`,`date_modified` FROM " . TABLE_HMS_ROOM_CREATION . " WHERE `room_id`= '". $_POST["bookingid"] ."'");
        $hms_info_all_records = db_query ($hms_info_fetch_allrec_sql);
        return $hms_info_all_records;
    }

    function bookingRoom() {

        if ( !is_array( $RoomType_array ) )
            $RoomType_array = array();
        if ( ( sizeof( $RoomType_array ) < 1 ))
            $RoomType_array[] = array('id' => '0', 'text' => 'Room Type');
            $RoomType_query = db_query("SELECT `customer_id`, `booking_no` , `no_adults`,`no_child`,`room_type_id`,`rooms_id`,`checkin_date`,`checkout_date`,`created_by`,`created_on` FROM " . TABLE_HMS_BOOKING_STATUS . " ");
            while($allRoomType = db_fetch_array($RoomType_query)) {
                $RoomType_array[] = array('id' => $allRoomType['room_type_id'], 'text' => $allRoomType['rooms_id']);
            }
        return $RoomType_array;
    }

}



//function customercheckout(){
//	 $customerStatusAdd = db_query("UPDATE " . TABLE_HMS_BOOKING_STATUS . " SET `status` = 'H' , `checkin_date` =  '" . $_GET["checkin"] . "', `checkout_date` = '" . $_GET["checkout"] . "' , `created_by` = '" . $_SESSION["userid"] . "',`updated_on` = now() WHERE checking_no = '".trim($_GET["checkinno"])."'");
//	
//	
//}

?>