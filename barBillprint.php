<?php 
	session_start(); 
	require_once ("includes/application_top.php");
	$tabel=(isset($_GET['table_id']) && !empty($_GET['table_id']) ? $_GET['table_id']:"");
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
	db_query("Update ".TABLE_HMS_RESTAURANT_ACCOUNT_DETAILS." SET bill_id='".$bill_id_session."' WHERE  account_card_id=$cardid");
	db_query("Update ".TABLE_HMS_RESTAURANT_ORDER_DETAILS." SET bill_id='".$bill_id_session."' WHERE  order_cart_id='".$cardid."'");
	db_query("Update ".TABLE_HMS_CREDIT_PAYMENT_DETAIL." SET credit_bill_id='".$bill_id_session."' WHERE  credit_cart_id='".$cardid."'");
	db_query("Update ".TABLE_HMS_PAYMENT_DETAIL." SET bill_no='".$bill_id_session."' WHERE  cart_id='".$cardid."'");
	db_query("Update ".TABLE_HMS_TABLE_DETAILS." SET htd_bill_id='".$bill_id_session."' WHERE  htd_cart_id='".$cardid."'");
	$lstbill_id = $bill_id+1;
	db_query("Update ".TABLE_HMS_BILL_ID." SET bill_id=$lstbill_id");
	$account_bill ="SELECT * FROM ".TABLE_HMS_RESTAURANT_ACCOUNT_DETAILS." WHERE account_card_id = '$cardid' AND tabel_id ='".$chairslist."' $wherecon";
	$account_bill_query = db_query($account_bill);
	if($ordertype=='dine')
		$bill_format = "Invoice";
	else
		$bill_format = "Invoice Parcel";		
	// printer configuration
	require 'printer/autoload.php';
	use Mike42\Escpos\Printer;
	use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;
	$connector = new NetworkPrintConnector(PRINTER_IP, 9100);
	
	// end printer configuration
	if(db_num_rows($account_bill_query)>0){
		$printer = new Printer($connector);       
		$fetchbill = db_fetch_array($account_bill_query);
		$student_user_fetch_singrec_sql = "SELECT `hms_parameter_id`,`hms_hotel_name`,`hms_address1`,`hms_address2`,`hms_city`,`hms_state`,`hms_country`,`hms_pincode`,`hms_phone_no`,`hms_cell_no`,`hms_tin_no`,`hms_stc`,`hms_url`,`hms_email`,`hms_footertxt`,`date_added`,`date_modified`,`hms_active` FROM hms_parameter_entry WHERE `hms_active` = 'Y'";
		$student_user_sing_records = db_query ($student_user_fetch_singrec_sql);
		$parameterEntry_values = db_fetch_array($student_user_sing_records);
		$printer -> selectPrintMode(Printer::MODE_EMPHASIZED); // Font bold Mode selection printer
		$printer -> setJustification(Printer::JUSTIFY_CENTER);// Printe center
		$hotel_name = stripslashes($parameterEntry_values["hms_hotel_name"]);
		$printer -> text($bill_format."\n");
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
		$printer -> text(str_pad("ITEM",20));
		$printer -> text(str_pad("RATE",10));
		$printer -> text(str_pad("QTY",7));
		$printer -> text(str_pad("AMT",10));
		$printer -> text("TOTAL\n");
		$printer -> setEmphasis(false);
		$printer -> selectPrintMode();
	 	$acc_query ="SELECT * FROM ".TABLE_HMS_RESTAURANT_ORDER_DETAILS." WHERE itemcancel=0 AND order_cart_id = '$cardid' AND table_entry_id ='".$chairslist."' ";
        $acc_query_result = db_query($acc_query);
		$printer -> text("------------------------------------------\n");
		$printer -> selectPrintMode(Printer::MODE_FONT_B);
		$i = 1; 
		$parcel_status = FALSE;	
		while ($acctdetails  = db_fetch_array($acc_query_result)) {
			if (isset($acctdetails["table_entry_id"]) && $acctdetails["table_entry_id"] !="" ) {
	            $hms_info_fetch_table_sql = "SELECT `table_entry_id`,`table_type_id`,`table_no`,`numbers_of_chairs`,`active`,`date_added`,`date_modified` FROM " . TABLE_HMS_TABLE_ENTRY . " WHERE table_entry_id IN ('".$acctdetails["table_entry_id"]."') ";
	            $table_records = db_query ($hms_info_fetch_table_sql);
				$table  = db_fetch_array($table_records);		
			}
			$bgcolor = (($i % 2 == 0) ? "#999999" : "#cccccc");
			if($acctdetails["parcel_status"]==1){
				$printer -> text(str_pad($acctdetails["order_product"]."(P)",20));
				$parcel_status = TRUE;
			}else{
				$printer -> text(str_pad($acctdetails["order_product"],20));
			}	
			
			$printer -> text(str_pad($acctdetails["order_price"],10));
            $printer -> text(str_pad($acctdetails["order_quantity"],7));
 			$amt=$acctdetails["order_price"]*$acctdetails["order_quantity"];  
        	//$incl_tax=$amt * ($acctdetails['incl_tax']/100.0); 
        	$net_total_price= $amt; 
			$printer -> text(str_pad($net_total_price,10)); 
			$printer -> text($acctdetails["order_total_price"]."\n");
			$i++; 
    	} 
    	$acc_query3 = "SELECT vat_amount,service_amount,order_amount FROM ".TABLE_HMS_RESTAURANT_ORDER_DETAILS." WHERE itemcancel=0 AND order_cart_id='$cardid' AND table_entry_id ='".$chairslist."' ";	
    	$acc_query_result3 = db_query($acc_query3);
	    while($acctdetails3=db_fetch_array($acc_query_result3)){
	    	$netamountt += ($acctdetails3['vat_amount']+$acctdetails3['service_amount']+$acctdetails3['order_amount']);
	   	}
		$acc_query2 = "SELECT * FROM ".TABLE_HMS_RESTAURANT_ACCOUNT_DETAILS." WHERE account_card_id='$cardid' AND tabel_id ='".$chairslist."' ";	
	  	$acc_query_result2 = db_query($acc_query2);
	  	$acctdetails2 = db_fetch_array($acc_query_result2); 
		$acc_query4 = "SELECT * FROM ".TABLE_HMS_RESTAURANT_ACCOUNT_DETAILS." WHERE account_card_id='$cardid' AND tabel_id ='".$chairslist."' ";	
	  	$acc_query_result4 = db_query($acc_query4);
	  	$acctdetails4 = db_fetch_array($acc_query_result4); 
		if($acctdetails4['discount']!="0.00"){  
	        $total=$acctdetails2['total_amount']*($acctdetails4['discount']/100.0);
	        $printer -> text(str_pad("",37)); 
			$printer -> setEmphasis(1 == 1);
			$printer -> text(str_pad($acctdetails4["discount"]."(%):",10));
			$printer -> setEmphasis(false);
			$printer -> text($total.".00\n");
		}
		$acc_disc = "SELECT * FROM ".TABLE_HMS_RESTAURANT_ACCOUNT_DETAILS." WHERE account_card_id='$cardid' AND tabel_id ='".$chairslist."' ";	
	  	$acc_disc1 = db_query($acc_disc);
	  	while($acc_disc2 = db_fetch_array( $acc_disc1)){ 
	  		$discount1=roundoff($netamountt)*($acc_disc2['discount']/100);	
	  	}
		$acc_query2 = "SELECT * FROM ".TABLE_HMS_RESTAURANT_ACCOUNT_DETAILS." WHERE account_card_id='$cardid' AND tabel_id ='".$chairslist."' ";	
	  	$acc_query_result2 = db_query($acc_query2);
	  	$acctdetails2 = db_fetch_array($acc_query_result2); 
	  	$printer -> text(str_pad("",37));
		$printer -> setEmphasis(1 == 1);
		$printer -> text(str_pad("Total : ",10));
		$printer -> setEmphasis(false);
		$printer -> text(roundoff(roundoff($netamountt)-$discount1)."\n");
		$printer -> setEmphasis(1 == 1); 
		$printer -> text(str_pad("TAX DETAILS",27));
		$printer -> text(str_pad("VALUE",10));
		$printer -> text(str_pad("TAX",10));
		$printer -> text("TOTAL\n");   
		$printer -> setEmphasis(false);   
	   	$menu_t = db_query("SELECT  sum(vat_amount) as vat_amt, vat_tax FROM ".TABLE_HMS_RESTAURANT_ORDER_DETAILS." WHERE itemcancel=0 AND table_entry_id='".$chairslist."' AND order_cart_id='$cardid' group by service_tax");
	  	while ($table_T = db_fetch_array($menu_t)){        
	    	$hms_info_fetch_tax_vat = "SELECT sum(order_price) as price_value FROM " . TABLE_HMS_RESTAURANT_ORDER_DETAILS . " WHERE  itemcancel=0 AND table_entry_id='".$chairslist."' AND order_cart_id='$cardid' AND vat_tax='".$table_T['vat_tax']."'";
	   		// echo $hms_info_fetch_tax_vat;
	    	$menu_records_v_tax = db_query ($hms_info_fetch_tax_vat);
	    	while ($menu_categ_v_tax = db_fetch_array($menu_records_v_tax)){
	    		$printer -> text(str_pad("VAT".$table_T['vat_tax']."%",27));
	         	$v_tax_amt =$menu_categ_v_tax['price_value'];
	         	$printer -> text(str_pad(round($v_tax_amt,2),10));
	            $v_tax=$table_T['vat_amt'];  
				$printer -> text(str_pad(round($v_tax,2),10));                      
				$total_v= $v_tax_amt+$v_tax;
				$printer -> text(round($total_v,2)."\n");                
			} 
		}
		if(!$parcel_status){        
		   	$menu_s = db_query("SELECT  service_tax FROM ".TABLE_HMS_RESTAURANT_ORDER_DETAILS." WHERE  itemcancel=0 AND table_entry_id='".$chairslist."' AND order_cart_id='$cardid' group by service_tax");
			while ($table_s = db_fetch_array($menu_s)){
				$hms_info_fetch_tax_ser = "SELECT sum(order_amount) as price_value FROM " . TABLE_HMS_RESTAURANT_ORDER_DETAILS . " WHERE itemcancel=0 AND table_entry_id='".$chairslist."' AND order_cart_id='$cardid'  AND service_tax='".$table_s['service_tax']."'";
		   		// echo $hms_info_fetch_tax_vat;
				$menu_records_s_tax = db_query ($hms_info_fetch_tax_ser);
		    	while ($menu_categ_s_tax = db_fetch_array($menu_records_s_tax)){
		        	$s_tax_amt =$menu_categ_s_tax['price_value']; 
					$printer -> text(str_pad("CST". $table_s['service_tax']."%(".round($s_tax_amt,2).")",27));       
		  			$printer -> text(str_pad("0.00",10));
		    		$s_tax=$s_tax_amt*($table_s['service_tax']/100.0);
					$printer -> text(str_pad(round($s_tax,2),10));                    
					$total_s=$s_tax; 
					$printer -> text(round($total_s,2)."\n");                
				} 
			}
		}
		$printer -> selectPrintMode();
		$printer -> text("------------------------------------------\n");
		$printer -> selectPrintMode(Printer::MODE_FONT_B);
		$printer -> text(str_pad("",37));
		$printer -> setEmphasis(1 == 1);
		$printer -> text(str_pad("NET AMOUNT : ",10));
		$printer -> setEmphasis(false);
		$printer -> text(roundoff(roundoff($netamountt)-$discount1)."\n");
		$printer -> selectPrintMode();
		$printer -> text("------------------------------------------\n");
		$printer -> selectPrintMode(Printer::MODE_FONT_B);
	   	$acc_pay = "SELECT * FROM ".TABLE_HMS_PAYMENT_DETAIL." WHERE cart_id	='$cardid' AND table_id ='".$chairslist."' ";	
	    $acc_pay_result = db_query($acc_pay);
		while($acctdetailsresult = db_fetch_array($acc_pay_result))  {
			$printer -> text("Payment Mode:".$acctdetailsresult['payment_method']."\n"); 
		}
		$acc_pay = "SELECT * FROM ".TABLE_HMS_PAYMENT_DETAIL." WHERE cart_id ='$cardid' AND table_id ='".$chairslist."' ";	
		$acc_pay_result = db_query($acc_pay);
		while($acctdetailsresult = db_fetch_array($acc_pay_result)){   
			
	 		$pay_method = $acctdetailsresult['payment_method'];
			if($pay_method=="cash"){      
	             $pay_amount=$acctdetailsresult['cash_amount'];
	        }
	        if($pay_method=="card"){      
	             $pay_amount=$acctdetailsresult['card_amount'];
	        }
	         if($pay_method=="cheque"){      
	             $pay_amount=$acctdetailsresult['cheque_amount'];
	        }
	         if($pay_method=="online"){      
	             $pay_amount=$acctdetailsresult['on_amount'];
	        }
	         if($pay_method=="cash-card"){      
	             $pay_amount=$acctdetailsresult['cash_amount']+$acctdetailsresult['card_amount'];
	            // echo $pay_amount;
	        }
	        if($pay_method=="cash-cheque"){      
	             $pay_amount=$acctdetailsresult['cash_amount']+$acctdetailsresult['cheque_amount'];
	        }
	        if($pay_method=="cash-online"){      
	             $pay_amount=$acctdetailsresult['cash_amount']+$acctdetailsresult['on_amount'];
	        }
	        
	         if($pay_method=="card-cheque"){      
	             $pay_amount=$acctdetailsresult['card_amount']+$acctdetailsresult['cheque_amount'];
	        }
	        if($pay_method=="card-online"){      
	             $pay_amount=$acctdetailsresult['card_amount']+$acctdetailsresult['on_amount'];
	        }
	        if($pay_method=="cheque-online"){      
	             $pay_amount=$acctdetailsresult['cheque_amount']+$acctdetailsresult['on_amount'];
	        }
			$printer -> text("Cash:".$pay_amount."\n"); 
			
		}
		$acc_pay = "SELECT * FROM ".TABLE_HMS_PAYMENT_DETAIL." WHERE cart_id='$cardid' AND table_id ='".$chairslist."'";	
		$acc_pay_result = db_query($acc_pay);
		$acctdetailsresult = db_fetch_array($acc_pay_result); 
		$disc_amt= $acctdetails2['total_amount']*($acctdetails4['discount']/100.0); 
		$total=$acctdetails2['total_amount']-$disc_amt;
		//echo $total; 
		if($total < $pay_amount){
			$printer -> text("Change:".$balance = $pay_amount-$total."\n");  
			  
		}elseif($total > $pay_amount){
			$balance = $pay_amount-$total;
			$printer -> text("Pending Amount::".$final= str_replace("-","",$balance)."\n");    
			
		}
		$printer -> selectPrintMode();
		$printer -> setJustification(Printer::JUSTIFY_CENTER);
		$printer -> text("Thanking You ! Visit Again !\n");
		$printer -> cut();
	} 





	$chkparcel =db_query("SELECT parcel_status FROM ".TABLE_HMS_RESTAURANT_ORDER_DETAILS." WHERE itemcancel=0 AND order_cart_id = '$cardid' AND table_entry_id ='".$chairslist."' AND parcel_status=1");
	// if(db_num_rows($chkparcel)>0){
		// $account_bill ="SELECT * FROM ".TABLE_HMS_RESTAURANT_ACCOUNT_DETAILS." WHERE account_card_id = '$cardid' AND tabel_id ='".$chairslist."' $wherecon";
		// $account_bill_query = db_query($account_bill);
		// if(db_num_rows($account_bill_query)>0){       
			// $student_user_fetch_singrec_sql = "SELECT `hms_parameter_id`,`hms_hotel_name`,`hms_address1`,`hms_address2`,`hms_city`,`hms_state`,`hms_country`,`hms_pincode`,`hms_phone_no`,`hms_cell_no`,`hms_tin_no`,`hms_stc`,`hms_url`,`hms_email`,`hms_footertxt`,`date_added`,`date_modified`,`hms_active`  FROM hms_parameter_entry WHERE `hms_active` = 'Y'";
    		// $student_user_sing_records = db_query ($student_user_fetch_singrec_sql);
			// $parameterEntry_values = db_fetch_array($student_user_sing_records);
			// $printer -> selectPrintMode(Printer::MODE_EMPHASIZED);
			// $printer -> setJustification(Printer::JUSTIFY_CENTER);
			// $hotel_name = stripslashes($parameterEntry_values["hms_hotel_name"]);
			// $printer -> text($hotel_name."\n");
			// $printer -> text(stripslashes($parameterEntry_values["hms_address1"]).stripslashes( $parameterEntry_values["hms_address2"])."\n");//address
			// $printer -> text(stripslashes( $parameterEntry_values["hms_city"]).','.stripslashes( $parameterEntry_values["hms_state"]).'-'.stripslashes( $parameterEntry_values["hms_pincode"])."\n");//address
			// $printer -> text("Ph.NO : ". stripslashes( $parameterEntry_values["hms_phone_no"])."\n"); 
			// if($parameterEntry_values["hms_tin_no"]!=''){
				// $printer -> text("TIN.NO :".stripslashes($parameterEntry_values["hms_tin_no"])."\n"); 
			// } 
			// if($parameterEntry_values["hms_stc"]!=''){
				// $printer -> text("STC :".stripslashes($parameterEntry_values["hms_stc"])."\n"); 
			// }
			// $printer -> selectPrintMode();
			// $printer -> setJustification();
			// $printer -> selectPrintMode(Printer::MODE_FONT_B);
			// $printer -> setJustification(Printer::JUSTIFY_LEFT);
			// $printer -> text(str_pad("BILL NO: ".$fetchbill['bill_id'],33));
			// $printer -> setJustification(Printer::JUSTIFY_RIGHT);
			// $printer -> text(date("dS M Y h:i A")."\n");
         	// if(!empty($tablename)){
         		// echo "TABLE NO: ".$tablename ;
         		// echo "&nbsp;S/I : ".$supplier ;
         		// $printer -> setJustification(Printer::JUSTIFY_LEFT);
	            // $printer -> text(str_pad("TABLE NO: Table".$tablename."",33)) ;
				// $printer -> setJustification(Printer::JUSTIFY_RIGHT);
				// $printer -> text("S/I : ".$supplier."\n");
			// }
			// $printer -> selectPrintMode();
			// $printer -> text("------------------------------------------\n");
			// $printer -> selectPrintMode(Printer::MODE_FONT_B);
			// $printer -> setEmphasis(1 == 1);
			// $printer -> text(str_pad("ITEM",20));
			// $printer -> text(str_pad("RATE",10));
			// $printer -> text(str_pad("QTY",7));
			// $printer -> text(str_pad("AMT",10));
			// $printer -> text("TOTAL\n");
			// $printer -> setEmphasis(false);
			// $printer -> selectPrintMode();
			// // ITEM		RETE 	QTY		AMOUNT	TOTAL
	  		// $totalamtt=0;	  
			// $acc_query ="SELECT * FROM ".TABLE_HMS_RESTAURANT_ORDER_DETAILS." WHERE itemcancel=0 AND order_cart_id = '$cardid' AND table_entry_id ='".$chairslist."' AND parcel_status=1 ";
        	// $acc_query_result = db_query($acc_query);
			// $printer -> text("------------------------------------------\n");
			// $printer -> selectPrintMode(Printer::MODE_FONT_B);
			// $i = 1; 	
			// while ($acctdetails  = db_fetch_array($acc_query_result)) {
				// if (isset($acctdetails["table_entry_id"]) && $acctdetails["table_entry_id"] !="" ) {
		            // $hms_info_fetch_table_sql = "SELECT `table_entry_id`,`table_type_id`,`table_no`,`numbers_of_chairs`,`active`,`date_added`,`date_modified` FROM " . TABLE_HMS_TABLE_ENTRY . " WHERE table_entry_id IN ('".$acctdetails["table_entry_id"]."')";
		            // $table_records = db_query ($hms_info_fetch_table_sql);
					// $table  = db_fetch_array($table_records);		
				// }
				// $bgcolor = (($i % 2 == 0) ? "#999999" : "#cccccc");	
				// $printer -> text(str_pad($acctdetails["order_product"]."(P)",20));
				// $printer -> text(str_pad($acctdetails["order_price"],10));
            	// $printer -> text(str_pad($acctdetails["order_quantity"],7));
				// $amt=$acctdetails["order_price"]*$acctdetails["order_quantity"];  
	        	// //$incl_tax=$amt * ($acctdetails['incl_tax']/100.0); 
	        	// $net_total_price= $amt; 
				// $totalamtt += $acctdetails["order_total_price"];
				// $printer -> text(str_pad($net_total_price,10)); 
				// $printer -> text($acctdetails["order_total_price"]."\n");
	    		// $i++; 
    		// } 
		    // $acc_query3 = "SELECT vat_amount,service_amount,order_amount FROM ".TABLE_HMS_RESTAURANT_ORDER_DETAILS." WHERE itemcancel=0 AND order_cart_id='$cardid' AND table_entry_id ='".$chairslist."' AND parcel_status=1";	
		    // while($acctdetails3=db_fetch_array($acc_query_result3)){
		    	// $netamountt += ($acctdetails3['vat_amount']+$acctdetails3['service_amount']+$acctdetails3['order_amount']);
		   	// }
		  	// $acc_query2 = "SELECT * FROM ".TABLE_HMS_RESTAURANT_ACCOUNT_DETAILS." WHERE account_card_id='$cardid' AND tabel_id ='".$chairslist."' ";	
		  	// $acc_query_result2 = db_query($acc_query2);
		  	// $acctdetails2 = db_fetch_array($acc_query_result2); 
			// $acc_query4 = "SELECT * FROM ".TABLE_HMS_RESTAURANT_ACCOUNT_DETAILS." WHERE account_card_id='$cardid' AND tabel_id ='".$chairslist."' ";	
		  	// $acc_query_result4 = db_query($acc_query4);
		  	// $acctdetails4 = db_fetch_array($acc_query_result4); 
			// if($acctdetails4['discount']!="0.00"){  
				// $total=$acctdetails2['total_amount']*($acctdetails4['discount']/100.0); 
		        // $printer -> text(str_pad("",37)); 
				// $printer -> setEmphasis(1 == 1);
				// $printer -> text(str_pad($acctdetails4["discount"]."(%):",10));
				// $printer -> setEmphasis(false);
				// $printer -> text($total.".00\n");
			// }
			// $acc_disc = "SELECT * FROM ".TABLE_HMS_RESTAURANT_ACCOUNT_DETAILS." WHERE account_card_id='$cardid' AND tabel_id ='".$chairslist."' ";	
		  	// $acc_disc1 = db_query($acc_disc);
		  	// while($acc_disc2 = db_fetch_array( $acc_disc1)){
		  		// $discount1=roundoff($netamountt)*($acc_disc2['discount']/100);	
		  	// }
			// $acc_query2 = "SELECT * FROM ".TABLE_HMS_RESTAURANT_ACCOUNT_DETAILS." WHERE account_card_id='$cardid' AND tabel_id ='".$chairslist."' ";	
		  	// $acc_query_result2 = db_query($acc_query2);
		  	// $acctdetails2 = db_fetch_array($acc_query_result2); 
			// $printer -> text(str_pad("",37));
			// $printer -> setEmphasis(1 == 1);
			// $printer -> text(str_pad("Total : ",10));
			// $printer -> setEmphasis(false);
			// $printer -> text(roundoff(roundoff($netamountt)-$discount1)."\n");
			// $printer -> setEmphasis(1 == 1); 
			// $printer -> text(str_pad("TAX DETAILS",27));
			// $printer -> text(str_pad("VALUE",10));
			// $printer -> text(str_pad("TAX",10));
			// $printer -> text("TOTAL\n");   
			// $printer -> setEmphasis(false);            
		   	// $menu_t = db_query("SELECT  sum(vat_amount) as vat_amt, vat_tax FROM ".TABLE_HMS_RESTAURANT_ORDER_DETAILS." WHERE itemcancel=0 AND table_entry_id='".$chairslist."' AND order_cart_id='$cardid' AND parcel_status=1 group by service_tax");
		   	// while ($table_T = db_fetch_array($menu_t)){        
		    	// $hms_info_fetch_tax_vat = "SELECT sum(order_price) as price_value FROM " . TABLE_HMS_RESTAURANT_ORDER_DETAILS . " WHERE  itemcancel=0 AND table_entry_id='".$chairslist."' AND order_cart_id='$cardid' AND vat_tax='".$table_T['vat_tax']."' AND parcel_status=1";
		   		// // echo $hms_info_fetch_tax_vat;
		    	// $menu_records_v_tax = db_query ($hms_info_fetch_tax_vat);
		    	// while ($menu_categ_v_tax = db_fetch_array($menu_records_v_tax)){
// 					  
					// $printer -> text(str_pad("VAT".$table_T['vat_tax']."%",27));           
		         	// $v_tax_amt =$menu_categ_v_tax['price_value'];        
		        	// $printer -> text(str_pad($v_tax_amt,10)); 
		            // $v_tax=$table_T['vat_amt'];            
		            // $printer -> text(str_pad($v_tax,10));      
					// $total_v= $v_tax_amt+$v_tax;             
					// $printer -> text($total_v."\n");     
				// }
			// }           
		   	// $menu_s = db_query("SELECT  service_tax FROM ".TABLE_HMS_RESTAURANT_ORDER_DETAILS." WHERE  itemcancel=0 AND table_entry_id='".$chairslist."' AND order_cart_id='$cardid' AND parcel_status=1 group by service_tax");
		   	// if($acctdetails["parcel_status"]==1){
// 			   	
			// }else{
				// while ($table_s = db_fetch_array($menu_s)){        
			    	// $hms_info_fetch_tax_ser = "SELECT sum(order_amount) as price_value FROM " . TABLE_HMS_RESTAURANT_ORDER_DETAILS . " WHERE itemcancel=0 AND table_entry_id='".$chairslist."' AND order_cart_id='$cardid'  AND service_tax='".$table_s['service_tax']."' AND parcel_status=1";
			   		// // echo $hms_info_fetch_tax_vat;
			    	// $menu_records_s_tax = db_query ($hms_info_fetch_tax_ser);
			    	// while ($menu_categ_s_tax = db_fetch_array($menu_records_s_tax)){
			    		// $s_tax_amt =$menu_categ_s_tax['price_value'];        
						// $printer -> text(str_pad("CST". $table_s['service_tax']."%(".$s_tax_amt.")",27));
						// $printer -> text(str_pad("0.00",10));   
			    		// $s_tax=$s_tax_amt*($table_s['service_tax']/100.0);            
			    		// $printer -> text(str_pad($s_tax,10));             
						// $total_s=$s_tax;             
						// $printer -> text($total_s."\n");
					// }
				// }
			// }
			// $printer -> selectPrintMode();
			// $printer -> text("------------------------------------------\n");
			// $printer -> selectPrintMode(Printer::MODE_FONT_B);
			// $printer -> text(str_pad("",37));
			// $printer -> setEmphasis(1 == 1);
			// $printer -> text(str_pad("NET AMOUNT : ",10));
			// $printer -> setEmphasis(false);
			// $printer -> text(roundoff(roundoff($netamountt)-$discount1)."\n");
			// $printer -> selectPrintMode();
			// $printer -> text("------------------------------------------\n");
			// $printer -> selectPrintMode(Printer::MODE_FONT_B);
		   	// $acc_pay = "SELECT * FROM ".TABLE_HMS_PAYMENT_DETAIL." WHERE cart_id	='$cardid' AND table_id ='".$chairslist."' ";	
		    // $acc_pay_result = db_query($acc_pay);
			// while($acctdetailsresult = db_fetch_array($acc_pay_result))  { 
				// $printer -> text("Payment Mode:".$acctdetailsresult['payment_method']."\n"); 
			// }
			// $acc_pay = "SELECT * FROM ".TABLE_HMS_PAYMENT_DETAIL." WHERE cart_id ='$cardid' AND table_id ='".$chairslist."' ";	
			// $acc_pay_result = db_query($acc_pay);
			// while($acctdetailsresult = db_fetch_array($acc_pay_result)){   
		 		// $pay_method = $acctdetailsresult['payment_method'];
		  		// if($pay_method=="cash"){      
		             // $pay_amount=$acctdetailsresult['cash_amount'];
		        // }
		        // if($pay_method=="card"){      
		             // $pay_amount=$acctdetailsresult['card_amount'];
		        // }
		         // if($pay_method=="cheque"){      
		             // $pay_amount=$acctdetailsresult['cheque_amount'];
		        // }
		         // if($pay_method=="online"){      
		             // $pay_amount=$acctdetailsresult['on_amount'];
		        // }
		         // if($pay_method=="cash-card"){      
		             // $pay_amount=$acctdetailsresult['cash_amount']+$acctdetailsresult['card_amount'];
		            // // echo $pay_amount;
		        // }
		        // if($pay_method=="cash-cheque"){      
		             // $pay_amount=$acctdetailsresult['cash_amount']+$acctdetailsresult['cheque_amount'];
		        // }
		        // if($pay_method=="cash-online"){      
		             // $pay_amount=$acctdetailsresult['cash_amount']+$acctdetailsresult['on_amount'];
		        // }
// 		        
		         // if($pay_method=="card-cheque"){      
		             // $pay_amount=$acctdetailsresult['card_amount']+$acctdetailsresult['cheque_amount'];
		        // }
		        // if($pay_method=="card-online"){      
		             // $pay_amount=$acctdetailsresult['card_amount']+$acctdetailsresult['on_amount'];
		        // }
		        // if($pay_method=="cheque-online"){      
		             // $pay_amount=$acctdetailsresult['cheque_amount']+$acctdetailsresult['on_amount'];
		        // }
				// $printer -> text("Cash:".$pay_amount."\n");
		     // }
			// $acc_pay = "SELECT * FROM ".TABLE_HMS_PAYMENT_DETAIL." WHERE cart_id='$cardid' AND table_id ='".$chairslist."'";	
			// $acc_pay_result = db_query($acc_pay);
			// $acctdetailsresult = db_fetch_array($acc_pay_result); 
			// $disc_amt= $acctdetails2['total_amount']*($acctdetails4['discount']/100.0); 
			// $total=$acctdetails2['total_amount']-$disc_amt;
			// //echo $total; 
			// if($total < $pay_amount){ 
// 				
				// $printer -> text("Change:".$balance = $pay_amount-$total."\n");  
			// }elseif($total > $pay_amount){
				// $balance = $pay_amount-$total;  
				// $printer -> text("Pending Amount::".$final= str_replace("-","",$balance)."\n");
			// }
			// $printer -> selectPrintMode();
			// $printer -> setJustification(Printer::JUSTIFY_CENTER);
			// $printer -> text("Thanking You ! Visit Again !\n");
		// } 
	// }
	
	$printer -> close();
?>
