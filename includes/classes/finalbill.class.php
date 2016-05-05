<?php
class finalbill {

    function getTableTree () {

        $RoomType_query = db_query("SELECT `table_entry_id`,`table_type_id`,`table_no`,`numbers_of_chairs`,`active`,`date_added`,`date_modified` FROM " . TABLE_HMS_TABLE_ENTRY . " WHERE `active` = 'Y'");

        return $RoomType_query;
    }

	 function customerFetchAllRecords() {
	
			$hms_info_fetch_allrec_sql = ("SELECT * FROM " . TABLE_HMS_CUSTOMER_TABLE);
			$hms_info_all_records = db_query ($hms_info_fetch_allrec_sql);
			return $hms_info_all_records;
	  }

    function getCustomerNameTree () {

     $getCustomerTree = db_query("SELECT hct.`customer_id`,hct.`customer_name` , hct.`customer_address` , hct.`customer_city`,hct.`customer_zip`,hct.`customer_state`,hct.`customer_country`,hct.customer_contact_no,hct.`customer_email_id`,hct.`customer_id_type`,hct.`customer_id_no`,hct.`customer_veh_no`,hct.`created_by`,hct.`created_on`,hbs.`booking_id`,hbs.`customer_id`,hbs.`booking_no`,hbs.`checking_no`,hbs.`no_adults`,hbs.`no_child`,hbs.`room_type_id`,hbs.`rooms_id`,hbs.`no_of_rooms`,hbs.`extra_bed`,hbs.`extra_bed_charge`,hbs.`payment_type`,hbs.`total_amount`,hbs.`advance_pay`,hbs.`balance_amount`,hbs.`room_change_status`,hbs.`old_room`,hbs.`status`,hbs.`checkin_date`,hbs.`checkout_date`,hbs.`created_by`,hbs.`created_on` FROM " . TABLE_HMS_CUSTOMER_TABLE . " as hct, " . TABLE_HMS_BOOKING_STATUS . " as hbs WHERE hct.`customer_id` = hbs.`customer_id` AND hbs.`rooms_id` = '".$_POST["roomid"]."'");    
    $cust = db_fetch_array($getCustomerTree);
    return $cust;

    }
	
    function getCustomerDetails () {

        $getCustomerDetails = db_query("SELECT hct.`customer_id`,hct.`customer_name`,hct.`customer_address`,hct.`customer_city`,hct.`customer_zip`,hct.`customer_state`,hct.`customer_country`,hct.customer_contact_no,hct.`customer_email_id`,hct.`customer_id_type`,hct.`customer_id_no`,hct.`customer_veh_no`,hct.`created_by`,hct.`created_on`,hbs.`booking_id`,hbs.`customer_id`,hbs.`booking_no`,hbs.`checking_no`,hbs.`no_adults`,hbs.`no_child`,hbs.`room_type_id`,hbs.`rooms_id`,hbs.`no_of_rooms`,hbs.`rooms_no`,hbs.`room_amount`,hbs.`extra_bed`,hbs.`extra_bed_charge`,hbs.`payment_type`,hbs.`total_amount`,hbs.`advance_pay`,hbs.`discount`,hbs.`balance_amount`,hbs.`vat_tax`,hbs.`service_tax`,hbs.`sale_tax`,hbs.`room_change_status`,hbs.`old_room`,hbs.`status`,hbs.`checkin_date`,hbs.`checkout_date`,hbs.`created_by`,hbs.`created_on` FROM " . TABLE_HMS_CUSTOMER_TABLE . " as hct, " . TABLE_HMS_BOOKING_STATUS . " as hbs WHERE hct.`customer_id` = hbs.`customer_id` AND hbs.`customer_id` = '".trim($_POST["customerId"])."' AND hbs.`rooms_id` = '".trim($_POST["roomid"])."' AND hbs.`status` = 'C'");
    
		$cust1 = db_fetch_array($getCustomerDetails);
		return $cust1;
    }
	

    function getCustomerDetailsFinalbill () {

        $getCustomerDetails = db_query("SELECT hct.`customer_id`,hct.`customer_name`,hct.`customer_address`,hct.`customer_city`,hct.`customer_zip`,hct.`customer_state`,hct.`customer_country`,hct.customer_contact_no,hct.`customer_email_id`,hct.`customer_id_type`,hct.`customer_id_no`,hct.`customer_veh_no`,hct.`created_by`,hct.`created_on`,hbs.`booking_id`,hbs.`customer_id`,hbs.`booking_no`,hbs.`checking_no`,hbs.`no_adults`,hbs.`no_child`,hbs.`room_type_id`,hbs.`rooms_id`,hbs.`no_of_rooms`,hbs.`rooms_no`,hbs.`room_amount`,hbs.`extra_bed`,hbs.`extra_bed_charge`,hbs.`payment_type`,hbs.`total_amount`,hbs.`advance_pay`,hbs.`balance_amount`,hbs.`discount`,hbs.`room_change_status`,hbs.`old_room`,hbs.`status`,hbs.`checkin_date`,hbs.`checkout_date`,hbs.`created_by`,hbs.`vat_tax`,hbs.`service_tax`,hbs.`sale_tax`,hbs.`created_on` FROM " . TABLE_HMS_CUSTOMER_TABLE . " as hct, " . TABLE_HMS_BOOKING_STATUS . " as hbs WHERE hct.`customer_id` = hbs.`customer_id` AND hbs.`customer_id` = '".trim($_GET["custId"])."' AND hbs.`rooms_id` = '".trim($_GET["roomid"])."' AND hbs.`status` = 'C'");
    
		$cust1 = db_fetch_array($getCustomerDetails);
		return $cust1;
    }

    function MenuCardFetchAllRecords() {

        $hms_info_fetch_allrec_sql = "SELECT `menu_card_id`,`menu_card_name`,`active`,`date_added`,`date_modified` FROM " .TABLE_HMS_MENU_CARD . " ORDER BY `menu_card_name`";
        $hms_info_all_records = db_query ($hms_info_fetch_allrec_sql);
        return $hms_info_all_records;
    }
    
    function MenuCardBarView () {

        $MenuCardBarView = db_query("SELECT HMCS.`menu_card_selection_id`,HMCS.`menu_card_id` , HMCS.`menu_id` , HMCS.`menu_category_id`,HMCS.`quty`,HMCS.`price`,HME.`menu_id`,HME.`menu_category_id`,HME.`menu_name`,HME.`active`,HME.`date_added`,HME.`date_modified`,HMC.hms_menu_category_id  FROM " . TABLE_HMS_MENU_CARD_SELECTION . " as HMCS, " . TABLE_HMS_MENU_ENTRY . " as HME, " . TABLE_HMS_MENU_CATEGORY . " as HMC WHERE HMCS.`menu_id` = HME.`menu_id` AND  HMCS.`menu_category_id` =  HMC.`hms_menu_category_id` AND HMCS.`menu_card_id` = '". $_POST["MenuCardid"] ."'");
        return $MenuCardBarView;
    }
    
    function getTaxInfoFetchAllRecords() {

        $hms_info_fetch_allrec_sql = "SELECT `tax_info_id`,`tax_info_name`,`charge`,`live`,`active`,`date_added`,`date_modified` FROM " . TABLE_HMS_TAX_INFO. "";
        $hms_info_all_records = db_query ($hms_info_fetch_allrec_sql);
        return $hms_info_all_records;
    }
    
    function taxChargeAdd() {

        $hms_info_fetch_allrec_sql = "SELECT `tax_info_id`,`tax_info_name`,`charge`,`live`,`active`,`date_added`,`date_modified` FROM " . TABLE_HMS_TAX_INFO. " WHERE `tax_info_id` = '". $_POST["taxid"] ."'";
        $hms_info_all_records = db_query ($hms_info_fetch_allrec_sql);
        return $hms_info_all_records;
    }

    function roomFetchAllRecords() {

        $hms_info_fetch_allrec_sql = "SELECT `room_id`,`room_no`,`floor`,`room_type`,`adults`,`child`,`smoking`,`active`,`date_added`,`date_modified` FROM " . TABLE_HMS_ROOM_CREATION . " ORDER BY `date_added`";
        $hms_info_all_records = db_query ($hms_info_fetch_allrec_sql);
        return $hms_info_all_records;
    }


    function SaveMenuList(){

    $items_qty      = explode("-",$_POST["items_qty"]);
    $items_ttl      = explode("-",$_POST["items_ttl_"]);
    $categoryid_    = explode("-",$_POST["categoryid_"]);
    $subcategoryid_ = explode("-",$_POST["subcategoryid_"]);
    $subname_       = explode("-",$_POST["subname_"]);
	
	if(isset($_POST["customerId"]) && $_POST["customerId"]!="" && isset($_POST["tableid"]) && $_POST["tableid"]!="") {
	
		$select_table = db_query("SELECT order_cart_id FROM ". TABLE_HMS_RESTAURANT_ORDER_DETAILS." WHERE ( customer_id = '".$_POST["customerId"]."' AND table_entry_id = '".$_POST["tableid"]."' ) order by order_id desc limit 1 ");
		$count_table =mysql_num_rows($select_table);	
	} 
	
	if(isset($_POST["customerId"]) && $_POST["customerId"]=="" && isset($_POST["tableid"]) && $_POST["tableid"]!="") {
	
		$select_table = db_query("SELECT order_cart_id FROM ". TABLE_HMS_RESTAURANT_ORDER_DETAILS." WHERE ( table_entry_id = '".$_POST["tableid"]."' AND customer_id = '0' AND room_id = '0') order by order_id desc limit 1 ");
		$count_table =mysql_num_rows($select_table);
	}
	
	if(isset($_POST["customerId"]) && $_POST["customerId"]!="" && isset($_POST["tableid"]) && $_POST["tableid"]=="") {
	
		$select_table = db_query("SELECT order_cart_id FROM ". TABLE_HMS_RESTAURANT_ORDER_DETAILS." WHERE ( customer_id = '".$_POST["customerId"]."' ) order by order_id desc limit 1 ");
		$count_table =mysql_num_rows($select_table);	
	}	

// echo $count_table;
    if($count_table==0) {

        $select_cart_id =db_query("SELECT max(order_cart_id) as cart_id , status,table_entry_id,customer_id  FROM ". TABLE_HMS_RESTAURANT_ORDER_DETAILS." GROUP BY `order_cart_id` order by order_id desc");
        $count = mysql_num_rows($select_cart_id);

        if($count>0){
         $rowcart_id = db_fetch_array($select_cart_id);
           if ($rowcart_id["status"] == "open") {
                if((($_POST["customerId"])==$rowcart_id["customer_id"])&& (($_POST["tableid"])==$rowcart_id["table_entry_id"])) {
                     $cart_value = $rowcart_id["cart_id"];
                } else {
                    $cart_value = $rowcart_id["cart_id"]+1;
                }
           }
           else {
                    $cart_value = $rowcart_id["cart_id"]+1;
                }
        } else {
         $cart_value="1";
        }

    } else {
      $rowcart_table = db_fetch_array($select_table);
      $cart_value = $rowcart_table["order_cart_id"];
    }
        for ($i=0;$i<count($items_qty);$i++) {
             if ($_POST["tableid"]=='') {
                $ordertype = "Room";
             } else {
               $ordertype = "Dine"; 
             }
               if ($items_qty[$i]!=0) {
                    $customerDetailsAdd = db_query( "INSERT INTO " . TABLE_HMS_RESTAURANT_ORDER_DETAILS . "( `order_id` , `customer_id` , `table_entry_id` ,`room_id`, `order_posted_date`,`order_product`, `order_price` , `order_quantity`, `order_cart_id` , `order_category_id`, `order_subcategory_id` , `order_type_id`,`product_name_desc` ) VALUES ('', '".$_POST["customerId"]."','".$_POST["tableid"]."', '".$_POST["roomid"]."', '".$_POST["ddDateFrom"]."','".$subname_[$i]."', '".$items_ttl[$i]."','".$items_qty[$i]."', '".$cart_value."', '".$categoryid_[$i]."', '".$subcategoryid_[$i]."','".$ordertype."', '')");
             }
        }
		
       $AccountDetailsAdd = db_query( "INSERT INTO " . TABLE_HMS_RESTAURANT_ORDER_ACCOUNT_DETAILS . "( `order_act_cart_id` , `order_act_table` , `order_act_subtotal` ,`order_act_discount`, `order_act_tax`,`order_act_total`, `order_act_date` , `order_act_report_date`, `order_act_order_type` , `order_act_payment_type`, `order_act_cust_id` , `order_act_userrole`) VALUES ('".$cart_value."', '".$_POST["tableid"]."','".$_POST["subtotal"]."', '".$_POST["discount2"]."', '".$_POST["tax2"]."','".$_POST["order_total2"]."', now(),'".$_POST["ddDateFrom"]."', '".$ordertype."', '','".$_POST["customerId"]."', '')");
	   
 	   
 }
 
     function tableEntryFetchAllRecords() {

            $hms_info_fetch_allrec_sql = "SELECT `table_entry_id`,`table_type_id`,`table_no`,`numbers_of_chairs`,`active`,`date_added`,`date_modified` FROM " . TABLE_HMS_TABLE_ENTRY . " ORDER BY `date_added`";
            $hms_info_all_records = db_query ($hms_info_fetch_allrec_sql);
        return $hms_info_all_records;
    }

}

?>