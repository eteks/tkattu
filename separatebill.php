<?php
/* Change to the correct path if you copy this example! */
	
	
	session_start(); 
	require_once ("includes/application_top.php");
	$tableno   = (isset($_REQUEST['tableno']) && !empty($_REQUEST['tableno']) ? trim(str_replace("undefined,","",$_REQUEST['tableno'])):"");
	$ordertype = (isset($_REQUEST['ordertype']) && !empty($_REQUEST['ordertype']) ? trim($_REQUEST['ordertype']):"");
	$chkitems = (isset($_REQUEST['chkitems']) && !empty($_REQUEST['chkitems']) ? trim($_REQUEST['chkitems']):"");
	$cartid    = (isset($_REQUEST['cartid']) && !empty($_REQUEST['cartid']) ? trim($_REQUEST['cartid']):"");
	$action    = (isset($_REQUEST['action']) && !empty($_REQUEST['action']) ? trim($_REQUEST['action']):"");
	$datetime  = date("dS  M  Y h:i A");
	$chairs=(isset($_REQUEST['chairs']) && !empty($_REQUEST['chairs']) ? $_REQUEST['chairs']:"");
	
	$tbldtls = explode(',',$chairs);
	foreach($tbldtls as $tbldtlsdata){
  		$tbldtlsplit = explode('_',$tbldtlsdata);
  		$dtml = (!empty($chairslist) ? ',':'');  
  		$chairslist .= $dtml.$tbldtlsplit[0];
	}

	$tablename    = $chairslist;
	$hms_info_obj = new restaurantbill();
	if(!empty($chairslist)){
		$htd_info  = $hms_info_obj->gettabledetails($cartid);
		$fetch = db_fetch_array($htd_info); 
		$supplier = getsuppliername($fetch['htd_supplier_id']);
	}
	$sel_parameter  = "SELECT hms_hotel_name FROM hms_parameter_entry WHERE `hms_active` = 'Y'";
	$rows_parameter = db_query ($sel_parameter);
	$fet_parameter  = db_fetch_array($rows_parameter);



	if($action=='cancelitem'){
		$orderid = explode(',',$chkitems);
		foreach($orderid as $orderidval){
  			$innerselect  = "SELECT order_quantity,bill_id,order_cart_id,last_cancel_quantity,order_id,menuid,depart_id,parcel_status FROM ".TABLE_HMS_RESTAURANT_ORDER_DETAILS." WHERE order_id = '$orderidval' ";
  			$innerrows    = db_query($innerselect); 
  			$innerfetch   = db_fetch_array($innerrows);
  			if($innerfetch['last_cancel_quantity']!=0)
  				$finalqty     = -$innerfetch['last_cancel_quantity']; 
  			else
  				$finalqty     = -$innerfetch['order_quantity'];
  
  			db_query("INSERT INTO hms_order_qty_flow SET bill_id='".$innerfetch['bill_id']."',itemcancel='".$innerfetch['itemcancel']."',last_cancel_quantity='".$innerfetch['itemcancel']."',depart_id='".$innerfetch['depart_id']."',order_cart_id='".$innerfetch['order_cart_id']."', menuid='".$innerfetch['menuid']."',order_id='".$innerfetch['order_id']."', order_quantity='".$finalqty."', cancel_status=1, parcel_status='".$fetch['parcel_status']."'");
  			db_query("UPDATE " .TABLE_HMS_RESTAURANT_ORDER_DETAILS." SET last_cancel_quantity=0 WHERE order_id='$orderidval' ");
		}
		$wherecon = " AND cancel_status=1 AND depart_status=0";
		$bill_format = "KOT Cancel";
	}
	else if($action=='deptbill'){
		$select  ="SELECT order_id,order_quantity,bill_id,order_cart_id,last_cancel_quantity,depart_id,menuid, parcel_status, no_of_person FROM ".TABLE_HMS_RESTAURANT_ORDER_DETAILS." WHERE  order_cart_id = '$cartid' ";
		$rows = db_query($select);
		while($fetch = db_fetch_array($rows)){
  			$innerselect  = "SELECT sum(order_quantity) as totqty FROM hms_order_qty_flow WHERE  order_id = '".$fetch['order_id']."' group by menuid";
			  $innerrows    = db_query($innerselect); 
			  $innerfetch   = db_fetch_array($innerrows);
  				if(db_num_rows($innerrows)>0)
  					$finalqty     = abs($innerfetch['totqty']-$fetch['order_quantity']);
  				else
  					$finalqty     = $fetch['order_quantity'];  
  				if($finalqty!=0 && $innerfetch['totqty']!=$fetch['order_quantity'])
  					db_query("INSERT INTO hms_order_qty_flow SET bill_id='".$fetch['bill_id']."',itemcancel='".$fetch['itemcancel']."',last_cancel_quantity='".$fetch['itemcancel']."',depart_id='".$fetch['depart_id']."',order_cart_id='".$fetch['order_cart_id']."', menuid='".$fetch['menuid']."',order_id='".$fetch['order_id']."', order_quantity='".$finalqty."', parcel_status='".$fetch['parcel_status']."'");
		}
		$wherecon = " AND itemcancel=0 AND depart_status=0";
		if($ordertype=='dine')
			$bill_format = "KOT Order";
		else
			$bill_format = "KOT Parcel";
	}
	else if($action=='cancelbill'){
		if($ordertype=='dine')
			$bill_format = "Invoice Cancel";
		else
			$bill_format = "Invoice Parcel Cancel";		
	}

//KOT
	require 'printer/autoload.php';
	use Mike42\Escpos\Printer;
	use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;
	$connector = new NetworkPrintConnector("192.168.2.100", 9100);
	
	$sel_separatebill  ="SELECT order_id,sum(order_quantity) as order_quantity,bill_id,order_cart_id,last_cancel_quantity, parcel_status,menuid FROM hms_order_qty_flow WHERE depart_id=1 $wherecon AND order_cart_id = '$cartid' group by menuid order by order_id ASC";
	$rows_separatebill = db_query($sel_separatebill);
	if(db_num_rows($rows_separatebill)>0){
		$printer = new Printer($connector);
		//echo $fet_parameter['hms_hotel_name'] ; //NAME
		$hotel_name = $fet_parameter['hms_hotel_name'];
		$printer -> selectPrintMode(Printer::MODE_EMPHASIZED);
		$printer -> setJustification(Printer::JUSTIFY_CENTER);
		$printer -> text($bill_format."\n");
		$printer -> text($hotel_name."\n");
		$printer -> setJustification();
		$printer -> selectPrintMode();
		$printer -> text("------------------------------------------\n");
		if($ordertype=='dine'){
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
            $printer -> text("T.No: Table".$tbl_name[0]."(".$tablename.")\n"); //TABLE
       } 

       $npersons="SELECT DISTINCT no_of_person FROM `hms_restaurant_order_details` WHERE  order_cart_id = '$cartid'";
       $npersons_separatebill = db_query($npersons);
       $npersonsfetch   = db_fetch_array($npersons_separatebill);
       if(db_num_rows($npersons_separatebill)>0)
       		$printer -> text("No of Persons:".$npersonsfetch['no_of_person']."\n") ; // NO OF PERSON
       
		$printer -> text("D/T : ".$datetime."\n") ;
		if($ordertype=='dine'){
			$printer -> text("S/I : ".$supplier." Dept : KOT".$cartid."\n") ;
		}else{
			$printer -> text("Dept : KOT".$cartid."\n") ;
		}
		$printer -> text("------------------------------------------\n");

		$printer -> setJustification(Printer::JUSTIFY_LEFT);
		
		$printer -> text(str_pad("Item",37));

		$printer -> setJustification(Printer::JUSTIFY_RIGHT);
		$printer -> text("Qty\n");
		$printer -> text("------------------------------------------\n");
 		while($fet_separatebill = db_fetch_array($rows_separatebill)){
            $totqty += $fet_separatebill['order_quantity'];
            $cartid   = $fet_separatebill['order_cart_id'];
            $printer -> setJustification(Printer::JUSTIFY_LEFT);
            $printer -> text(str_pad(menuname($fet_separatebill['menuid']),37));
			$printer -> setJustification(Printer::JUSTIFY_RIGHT);
            if($fet_separatebill['parcel_status']==1) 
            	echo "<span class='pred'>(P)</span>";
             $printer -> text($fet_separatebill['order_quantity']."\n");
 		}
		$printer -> setJustification();
		$printer -> text("------------------------------------------\n");
		$printer -> setJustification(Printer::JUSTIFY_LEFT);
		$printer -> text(str_pad("            Total :",37));
		$printer -> setJustification(Printer::JUSTIFY_RIGHT);
		$printer -> text($totqty."\n");
		$printer -> text("------------------------------------------\n");
		if($action=='cancelbill')
   			echo 'BILL CANCELLED'; 
   		if($action=='cancelitem')
   			echo 'ITEM CANCELLED'; 
		echo $cartid ;
		$printer -> cut();
 	}
	
	$printer -> close();
?> 