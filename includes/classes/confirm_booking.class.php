<?php
class confirmBooking {

    function getConfirmBooking($roomId){

        $hms_info_fetch_allrec_sql = db_query("SELECT hrc.`room_id`,hrc.`room_no`,hrc.`floor`,hrc.`room_type`,hrc.`adults`,hrc.`child`,hrc.`smoking`,hrtc.`room_type_id`,hrtc.`room_type_name`,hrtc.`facility_id`,hrtc.`bed_size`,hrtc.`charge`,hrtc.`note` FROM " . TABLE_HMS_ROOM_CREATION . " as hrc, " . TABLE_HMS_ROOM_TYPE_CREATION . "  as hrtc WHERE hrc.`room_type` = `room_type_id` AND hrc.`room_id` = '" . $roomId . "' AND hrc.`active` = 'Y'");
        return $hms_info_fetch_allrec_sql;
    }

    function getRoomType($typeId){

        $hms_info_fetch_allrec_sql = db_query("SELECT `room_type_id`,`room_type_name`,`facility_id`,`bed_size`,`charge`,`note` FROM " . TABLE_HMS_ROOM_TYPE_CREATION . " WHERE `room_type_id` = '" . $typeId . "'");
        $booking = db_fetch_array($hms_info_fetch_allrec_sql);
        return $booking;
    }

    function customerDetailsAdd(){
    
        $roomvalues = explode(' ',$_POST["roomvalue"]);

        $customerDetailsAdd = db_query( "INSERT INTO " . TABLE_HMS_CUSTOMER_TABLE . "( `customer_name` , `customer_address` , `customer_city` , `customer_zip`,`customer_state`, `customer_country` , `customer_phone`,`customer_mobile`, `arrival_date` , `departure_date`,`adults`, `children` , `date_added` )
    VALUES ('" . $_POST["txtCust"] . "', '" . $_POST["txtAddress"] . "', '" . $_POST["city"] . "', '" .  $_POST["zip"] . "','" . $_POST["state"] . "', '" . $_POST["country"] . "','" . $_POST["txtMob"] . "', '" . $_POST["txtphone"] . "', '" . $_POST["formDate"] . "', '" . $_POST["toDate"] . "','" . $_POST["adults"] . "', '" . $_POST["child"] . "',NOW())");
        $customerId = db_insert_id();
        for ($i=0; $i < count($roomvalues); $i++) {

            $customerDetailsAdd = db_query("INSERT INTO " . TABLE_HMS_BOOKING_STATUS . "( `customer_id`, `room_id` , `arrival_date` , `departure_date` , `arrival_time`,`departure_time` ) VALUES ('" . $customerId . "', '" . $roomvalues[$i] . "', '" . $_POST["formDate"] . "', '" . $_POST["toDate"] . "', '','')");
        }
    }

    function paymode() {

        $payment_fetch_singrec_sql =  "SELECT `payment_mode_id`,`payment_mode`,`active`,`date_added`,`date_modified` FROM " . TABLE_HMS_PAYMENT_MODE . " WHERE `active` = 'Y'";
        $payment_sing_records = db_query ($payment_fetch_singrec_sql);
        return $payment_sing_records;
    }

    function getCustDetails($custId){

       $hms_info_fetch_allrec_sql = db_query("SELECT hct.`customer_id`, hct.`customer_name`, hct.`customer_address`, hct.`customer_city`, hct.`customer_zip`, hct.`customer_state`, hct.`customer_country`, hct.`customer_phone`, hct.`customer_mobile`, hct.`arrival_date`, hct.`departure_date`, hct.`adults`, hct.`children`, hbs.`booking_id`, hbs.`room_id` FROM " . TABLE_HMS_CUSTOMER_TABLE . " as hct, " . TABLE_HMS_BOOKING_STATUS . "  as hbs WHERE hct.`customer_id` = hbs.`customer_id` AND hbs.`booking_status` = 'Booking' AND hct.`customer_id` = '" . $custId . "'");
       return $hms_info_fetch_allrec_sql;
    }


}
?>