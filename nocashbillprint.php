<?php 
	session_start(); 
	require_once ("includes/application_top.php");
	$tabel=(isset($_GET['chairs']) && !empty($_GET['chairs']) ? $_GET['chairs']:"");
	$accountsession=(isset($_GET['accountsession']) && !empty($_GET['accountsession']) ? $_GET['accountsession']:"");
	$cardid=$_GET['card_id'];
	$tbldtls = explode(',',$tabel);
	foreach($tbldtls as $tbldtlsdata){
  		$tbldtlsplit = explode('_',$tbldtlsdata);
  		$dtml = (!empty($chairslist) ? ',':'');  
  		$chairslist .= $dtml.$tbldtlsplit[0];
	}
	$tablename    = $chairslist;
	$hms_info_obj = new restaurantbill();
	if(!empty($cardid)){
		$htd_info  = $hms_info_obj->gettabledetails($cardid);
		$fetch = db_fetch_array($htd_info); 
		$supplier = getsuppliername($fetch['htd_supplier_id']);
	}
	$selectbillid = db_query("SELECT bill_id FROM ".TABLE_HMS_BILL_ID." ");
	$fetch_billid = db_fetch_array($selectbillid);
	$bill_id  = $fetch_billid['bill_id'];
	$bill_id_session  = $accountsession.$fetch_billid['bill_id'];

	db_query("Update ".TABLE_HMS_RESTAURANT_ACCOUNT_DETAILS." SET bill_id='".$bill_id_session."' WHERE  account_card_id='".$cardid."'");
	db_query("Update ".TABLE_HMS_RESTAURANT_ORDER_DETAILS." SET bill_id='".$bill_id_session."' WHERE  order_cart_id='".$cardid."'");
	db_query("Update ".TABLE_HMS_CREDIT_PAYMENT_DETAIL." SET credit_bill_id='".$bill_id_session."' WHERE  credit_cart_id='".$cardid."'");
	db_query("Update ".TABLE_HMS_PAYMENT_DETAIL." SET bill_no='".$bill_id_session."' WHERE  cart_id='".$cardid."'");
	db_query("Update ".TABLE_HMS_TABLE_DETAILS." SET htd_bill_id='".$bill_id_session."' WHERE  htd_cart_id='".$cardid."'");
	$lstbill_id = $bill_id+1;
	db_query("Update ".TABLE_HMS_BILL_ID." SET bill_id=".$lstbill_id);
	//printer
	require 'printer/autoload.php';
	use Mike42\Escpos\Printer;
	use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;
	$connector = new NetworkPrintConnector(PRINTER_IP, 9100);
	$account_bill ="SELECT * FROM ".TABLE_HMS_RESTAURANT_ACCOUNT_DETAILS." WHERE account_card_id = '$cardid' AND tabel_id ='".$chairslist."' $wherecon";
	$account_bill_query = db_query($account_bill);
	if(db_num_rows($account_bill_query)>0){
		$printer = new Printer($connector);       
		$fetchbill = db_fetch_array($account_bill_query);
		$student_user_fetch_singrec_sql = "SELECT `hms_parameter_id`,`hms_hotel_name`,`hms_address1`,`hms_address2`,`hms_city`,`hms_state`,`hms_country`,`hms_pincode`,`hms_phone_no`,`hms_cell_no`,`hms_tin_no`,`hms_stc`,`hms_url`,`hms_email`,`hms_footertxt`,`date_added`,`date_modified`,`hms_active` FROM hms_parameter_entry WHERE `hms_active` = 'Y'";
    	$student_user_sing_records = db_query ($student_user_fetch_singrec_sql);
		$parameterEntry_values = db_fetch_array($student_user_sing_records);
		$printer -> selectPrintMode(Printer::MODE_EMPHASIZED); // Font bold Mode selection printer
		$printer -> setJustification(Printer::JUSTIFY_CENTER);// Printe center
		$hotel_name = stripslashes($parameterEntry_values["hms_hotel_name"]);
		$printer -> text("Invoice No Cash"."\n");
		$printer -> text($hotel_name."\n"); // print hotel name
		$printer -> text(stripslashes($parameterEntry_values["hms_address1"]).stripslashes( $parameterEntry_values["hms_address2"])."\n");// print address
		$printer -> text(stripslashes( $parameterEntry_values["hms_city"]).','.stripslashes( $parameterEntry_values["hms_state"]).'-'.stripslashes( $parameterEntry_values["hms_pincode"])."\n");// printaddress
		$printer -> text("Ph.NO : ". stripslashes( $parameterEntry_values["hms_phone_no"])."\n"); // Print phone number
		if($parameterEntry_values["hms_tin_no"]!=''){
			$printer -> text("TIN.NO :".stripslashes($parameterEntry_values["hms_tin_no"])."\n"); // Print tin number
		} 
		if($parameterEntry_values["hms_stc"]!=''){
			$printer -> text("STC :".stripslashes($parameterEntry_values["hms_stc"])."\n");  // print stc number
		}
		$printer -> selectPrintMode(); // Printer mode reset
		$printer -> setJustification(); // Printer alignment reset
		$printer -> selectPrintMode(Printer::MODE_FONT_B); // Printing font size small
		$printer -> setJustification(Printer::JUSTIFY_LEFT); // printer alignment left
		$printer -> text(str_pad("BILL NO: ".$fetchbill['bill_id'],33));
		$printer -> setJustification(Printer::JUSTIFY_RIGHT); //// printer alignment right
		$printer -> text(date("dS M Y h:i A")."\n"); // printer alignment date
		if(!empty($tablename)){
			$tbl_name="";
            $tbl_chair=(explode(",", $tablename));
            if(!empty(explode("a", $tbl_chair[0])))
            $tbl_name=explode("a", $tbl_chair[0]);
            else if(!empty(explode("b", $tbl_chair[0])))
            $tbl_name=explode("b", $tbl_chair[0]);
            else if(!empty(explode("c", $tbl_chair[0])))
            $tbl_name=explode("c", $tbl_chair[0]);
            else if(!empty(explode("d", $tbl_chair[0])))
            $tbl_name=explode("d", $tbl_chair[0]);
            else if(!empty(explode("e", $tbl_chair[0])))
            $tbl_name=explode("e", $tbl_chair[0]);
            else if(!empty(explode("f", $tbl_chair[0])))
            $tbl_name=explode("f", $tbl_chair[0]);
			$printer -> setJustification(Printer::JUSTIFY_LEFT);// printer alignment left
            $printer -> text(str_pad("TABLE NO: Table".$tbl_name[0]."(".$tablename.")",33)) ; // print table details
			$printer -> setJustification(Printer::JUSTIFY_RIGHT);// printer alignment right
			$printer -> text("S/I : ".$supplier."\n");// print suplier details
			$printer -> text(str_pad("No of Persons: ".$fetchbill['no_of_person'],33)); // print no of person
			$printer -> text("KOT NO :".$cardid."\n");
		}else{
			$printer -> text("KOT NO :".$cardid."\n");
		}
		$printer -> selectPrintMode(); //reset printer mode
		$printer -> text("------------------------------------------\n");
		$printer -> selectPrintMode(Printer::MODE_FONT_B);
		$printer -> setEmphasis(1 == 1);
		$printer -> text(str_pad("ITEM",47));
		$printer -> text("QTY\n");
		$printer -> setEmphasis(false);
		$printer -> selectPrintMode();
	 	$acc_query ="SELECT * FROM ".TABLE_HMS_RESTAURANT_ORDER_DETAILS." WHERE itemcancel=0 AND order_cart_id = '$cardid' AND table_entry_id ='".$chairslist."' ";
        $acc_query_result = db_query($acc_query);
		$printer -> text("------------------------------------------\n");
		$printer -> selectPrintMode(Printer::MODE_FONT_B);
		$i = 1; 	
		while ($acctdetails  = db_fetch_array($acc_query_result)) {
			if (isset($acctdetails["table_entry_id"]) && $acctdetails["table_entry_id"] !="" ) {
	            $hms_info_fetch_table_sql = "SELECT `table_entry_id`,`table_type_id`,`table_no`,`numbers_of_chairs`,`active`,`date_added`,`date_modified` FROM " . TABLE_HMS_TABLE_ENTRY . " WHERE table_entry_id IN ('".$acctdetails["table_entry_id"]."') ";
	            $table_records = db_query ($hms_info_fetch_table_sql);
				$table  = db_fetch_array($table_records);		
			}
			$bgcolor = (($i % 2 == 0) ? "#999999" : "#cccccc");
			if($acctdetails["parcel_status"]==1){
				$printer -> text(str_pad($acctdetails["order_product"]."(P)",47));
			}else{
				$printer -> text(str_pad($acctdetails["order_product"],47));
			} 
			$printer -> text($acctdetails["order_quantity"]."\n");
    		$i++; 
    	}
		$printer -> selectPrintMode();
		$printer -> text("------------------------------------------\n");
		$printer -> selectPrintMode(Printer::MODE_FONT_B);
		$printer -> text(str_pad("",37));
		$printer -> setEmphasis(1 == 1);
		$printer -> text("No Cash Amount\n");
		$printer -> setEmphasis(false);
		$printer -> selectPrintMode();
		$printer -> text("------------------------------------------\n");
		$printer -> selectPrintMode(Printer::MODE_FONT_B);
		if($fetchbill['nocashcomments']!=''){
			$printer -> text("NCAC -".$fetchbill['nocashcomments']."\n"); 
		}
		$printer -> selectPrintMode();
		$printer -> setJustification(Printer::JUSTIFY_CENTER);
		$printer -> text("Thanking You ! Visit Again !\n");
		$printer -> cut();
	} 
	// $chkparcel =db_query("SELECT parcel_status FROM ".TABLE_HMS_RESTAURANT_ORDER_DETAILS." WHERE itemcancel=0 AND order_cart_id = '$cardid' AND table_entry_id ='".$chairslist."' AND parcel_status=1");
	// if(db_num_rows($chkparcel)>0){
		// $account_bill ="SELECT * FROM ".TABLE_HMS_RESTAURANT_ACCOUNT_DETAILS." WHERE account_card_id = '$cardid' AND tabel_id ='".$chairslist."' $wherecon";
		// $account_bill_query = db_query($account_bill);
		// if(db_num_rows($account_bill_query)>0){       
			// $student_user_fetch_singrec_sql = "SELECT `hms_parameter_id`,`hms_hotel_name`,`hms_address1`,`hms_address2`,`hms_city`,`hms_state`,`hms_country`,`hms_pincode`,`hms_phone_no`,`hms_cell_no`,`hms_tin_no`,`hms_stc`,`hms_url`,`hms_email`,`hms_footertxt`,`date_added`,`date_modified`,`hms_active`  FROM hms_parameter_entry WHERE `hms_active` = 'Y'";
    		// $student_user_sing_records = db_query ($student_user_fetch_singrec_sql);
			// $parameterEntry_values = db_fetch_array($student_user_sing_records);
			// echo stripslashes($parameterEntry_values["hms_hotel_name"]);
			// echo stripslashes($parameterEntry_values["hms_address1"]).','.stripslashes( $parameterEntry_values["hms_address2"]);
			// echo stripslashes( $parameterEntry_values["hms_city"]).','.stripslashes( $parameterEntry_values["hms_state"]).'-'.stripslashes( $parameterEntry_values["hms_pincode"]);
			// echo 'Ph.NO :'.stripslashes( $parameterEntry_values["hms_phone_no"]);
			// if($parameterEntry_values["hms_tin_no"]!=''){
				// echo 'TIN.NO :'.stripslashes($parameterEntry_values["hms_tin_no"]); 
			// }
			// if($parameterEntry_values["hms_stc"]!=''){
				// echo 'STC :'.stripslashes($parameterEntry_values["hms_stc"]);
			// }
  			// echo "BILL NO: ".$fetchbill['bill_id'].""; 
  			// echo '&nbsp;'.date("dS  M  Y h:i A")."";
  			// if(!empty($tablename)){
  				// echo "TABLE NO: ".$tablename ;
  				// echo "&nbsp;S/I : ".$supplier ;
			// }
			// echo "Item";
			// echo"Qty.";
	  		// $totalamtt=0;	  
	 		// $acc_query ="SELECT * FROM ".TABLE_HMS_RESTAURANT_ORDER_DETAILS." WHERE itemcancel=0 AND order_cart_id = '$cardid' AND table_entry_id ='".$chairslist."' AND parcel_status=1 ";
        	// $acc_query_result = db_query($acc_query);
			// $i = 1; 	
			// while ($acctdetails  = db_fetch_array($acc_query_result)) {
				// if (isset($acctdetails["table_entry_id"]) && $acctdetails["table_entry_id"] !="" ) {
            		// $hms_info_fetch_table_sql = "SELECT `table_entry_id`,`table_type_id`,`table_no`,`numbers_of_chairs`,`active`,`date_added`,`date_modified` FROM " . TABLE_HMS_TABLE_ENTRY . " WHERE table_entry_id IN ('".$acctdetails["table_entry_id"]."') ";
            		// $table_records = db_query ($hms_info_fetch_table_sql);
					// $table  = db_fetch_array($table_records);		
				// }
				// $bgcolor = (($i % 2 == 0) ? "#999999" : "#cccccc");	
				// echo $acctdetails["order_product"];
				// echo $acctdetails["order_quantity"];
			// }
			// echo "No Cash Amount";
			// if($fetchbill['nocashcomments']!=''){
				// echo 'NCAC - '.$fetchbill['nocashcomments'] ;
			// }
			// echo 'Thanking You ! Visit Again !';
		// } 
// 
	// }
	$printer -> close();
?>

