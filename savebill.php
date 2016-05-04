<?php
	require_once ("includes/application_top.php");
	session_start();
 	$action=$_REQUEST['action'];
	
  	$table_id = (isset($_POST['table_id']) && !empty($_POST['table_id']) ? trim($_POST['table_id']):"" );
	
	$sup_id = (isset($_POST['sup_id']) && !empty($_POST['sup_id']) ? trim($_POST['sup_id']):"" );
	
  	$cart_id = (isset($_POST['cart_id']) && !empty($_POST['cart_id']) ? $_POST['cart_id']:"" );
  
  	$pay_type= (isset($_POST['pay_type']) && !empty($_POST['pay_type']) ? $_POST['pay_type']:"" );  
	
  	$name = (isset($_POST['name']) && !empty($_POST['name']) ? $_POST['name']:"" );
  
  	$mobile= (isset($_POST['mobile']) && !empty($_POST['mobile']) ? $_POST['mobile']:"" );  
	
  	$address= (isset($_POST['address']) && !empty($_POST['address']) ? $_POST['address']:"" );
   
  	$pay_method=(isset($_POST['pay_method']) && !empty($_POST['pay_method']) ? $_POST['pay_method']:"" ); 
	  
  	$bill_status= (isset($_POST['bill_status']) && !empty($_POST['bill_status']) ? $_POST['bill_status']:"" );
  
  	$cash_amount=(isset($_POST['cash_amount']) && !empty($_POST['cash_amount']) ? $_POST['cash_amount']:"" ); 
  
  	$card_amount=(isset($_POST['card_amount']) && !empty($_POST['card_amount']) ? $_POST['card_amount']:"" ); 
	
  	$card_no=(isset($_POST['card_no']) && !empty($_POST['card_no']) ? $_POST['card_no']:"" ); 
	
  	$card_name=(isset($_POST['card_name']) && !empty($_POST['card_name']) ? $_POST['card_name']:"" );
	
  	$exp_date=(isset($_POST['exp_date']) && !empty($_POST['exp_date']) ? $_POST['exp_date']:"" ); 
  
	$cheque_amount= (isset($_POST['cheque_amount']) && !empty($_POST['cheque_amount']) ? $_POST['cheque_amount']:"" );
	
  	$cheque_no= (isset($_POST['cheque_no']) && !empty($_POST['cheque_no']) ? $_POST['cheque_no']:"" );
	
  	$ceq_name= (isset($_POST['ceq_name']) && !empty($_POST['ceq_name']) ? $_POST['ceq_name']:"" );
	
  	$ceq_date= (isset($_POST['ceq_date']) && !empty($_POST['ceq_date']) ? $_POST['ceq_date']:"" );
  
  	$online_amount= (isset($_POST['online_amount']) && !empty($_POST['online_amount']) ? $_POST['online_amount']:"" );
	
  	$on_card_no= (isset($_POST['on_card_no']) && !empty($_POST['on_card_no']) ? $_POST['on_card_no']:"" );
	
  	$on_card_name= (isset($_POST['on_card_name']) && !empty($_POST['on_card_name']) ? $_POST['on_card_name']:"" );
	
  	$on_exp_date= (isset($_POST['on_exp_date']) && !empty($_POST['on_exp_date']) ? $_POST['on_exp_date']:"" );
	
  	$transactions_id= (isset($_POST['transactions_id']) && !empty($_POST['transactions_id']) ? $_POST['transactions_id']:"" );
	
  	$disc= (isset($_POST['disc']) && !empty($_POST['disc']) ? $_POST['disc']:"" );
	
  	$accountsession= (isset($_POST['accountsession']) && !empty($_POST['accountsession']) ? $_POST['accountsession']:"" );
	
    $tbldtls = explode(',',$table_id);
	
    foreach($tbldtls as $tbldtlsdata)
    {
      	$tbldtlsplit = explode('_',$tbldtlsdata);
      	$dtml = (!empty($chairslist) ? ',':'');  
      	$chairslist .= $dtml.$tbldtlsplit[0];
    }
  	if($action=='savebill')
	{
     
   // $condition="(`bill_no`,`table_id`,`cart_id`,`payment_method`,`cash_amount`,`card_no`,`card_name`,`expire_date`,`card_amount`,
          //  `cheque_number`,`cheque_name`,`cheque_date`,`cheque_amount`,`on_card_no`,`on_exp_date`,`on_card_name`,`on_amount`,`	transactions_id`,created_date)
         //   VALUES ('$bill_id','$table_id ',$cart_id','$pay_method','$cash_amount','$card_name','$exp_date','$cheque_amount','$cheque_no','$ceq_name',
        //    '$ceq_date','$online_amount','$on_card_no','$on_card_name','$on_exp_date','$transactions_id',NOW())";
 ?>

		<table border="0"  width="100%" cellpadding="0" cellspacing="0" bgcolor="#000000">

<?php 
	
	$sql=db_query("SELECT `order_id`,`order_cart_id`,`bill_id`, `menuid`, `vat_amount`, `service_amount`, `order_type`,`table_entry_id`,`order_total_price`,`order_open_date`,`menuid`, sum(`vat_amount`) as v_amount, sum(`service_amount`) as ser_amount,  sum(`order_total_price`) as `total` ,`status`,`bill`,`no_of_person` FROM ".TABLE_HMS_RESTAURANT_ORDER_DETAILS." WHERE `status` = 'open' AND itemcancel='0'  AND table_entry_id ='$chairslist' AND order_cart_id = '$cart_id' ");

	$sql_delete_acc=db_query("DELETE FROM ".TABLE_HMS_RESTAURANT_ACCOUNT_DETAILS." WHERE tabel_id='$chairslist' AND account_card_id='$cart_id'");

	$sql_delete_pay=db_query("DELETE FROM ".TABLE_HMS_PAYMENT_DETAIL." WHERE table_id='$chairslist' AND cart_id='$cart_id'");

	$sql_delete_pay=db_query("DELETE FROM ".TABLE_HMS_CREDIT_PAYMENT_DETAIL." WHERE credit_bill_id='$cart_id'");

	$sql_exis=db_query("SELECT * FROM ".TABLE_HMS_RESTAURANT_ACCOUNT_DETAILS." WHERE tabel_id='$chairslist' AND account_card_id='$cart_id'");

	$count_table1 =mysql_num_rows($sql_exis);

	if($count_table1==0){
		while($row_data=db_fetch_array($sql)){	
			$disc_1=(isset($_GET['disc']) && !empty($_GET['disc']) ? $_GET['disc'] : '');
			$discount=$row_data['total']*($disc_1/100);  
			$taxes=(!empty($taxes) ? $taxes : '');
		 	$totalamount=$row_data['total']+$taxes-$discount; 
		 	$discount1=$totalamount*($disc/100);  
		 	$vat=(!empty($vat) ? $vat : '');
		  	$ser=(!empty($ser) ? $ser : '');//".$row_data['bill_id']."
			$sql_insert=db_query("INSERT INTO ".TABLE_HMS_RESTAURANT_ACCOUNT_DETAILS." (`account_id`,`account_card_id`,`bill_id`, `order_type`,`vat`,`service`,`vat_amt`,`service_amt`,`discount`,`disc_amt`,`tabel_id`,`sup_name`,`subtotal`,`total_amount`,`orde_close_date`,`status`,`bill_status`,created_by,created_role_id,account_session,`no_of_person`) VALUES ('','".$row_data['order_cart_id']."','', '".$row_data['order_type']."','".$vat."','".$ser."','".$row_data['v_amount']."','".$row_data['ser_amount']."','".$disc."','".$discount1."','".$row_data['table_entry_id']."','".$sup_id."','".$row_data['total']."','".$totalamount."',NOW(),'open','$bill_status','".$_SESSION["userid"]."','".$_SESSION["admin_role_mst_id"]."','".$accountsession."','".$row_data["no_of_person"]."')");	
			
			$sql_insert_customerdetails=
		      db_query("INSERT INTO ".TABLE_HMS_PAYMENT_DETAIL." (`bill_no`,`table_id`,`cart_id`, `credit_bill_id`, `payment_type`, `payment_method`,`cash_amount`,`card_no`,`card_name`,`expire_date`,`card_amount`,
		      `cheque_number`,`cheque_name`,`cheque_date`,`cheque_amount`,`on_card_no`,`on_exp_date`,`on_card_name`,`on_amount`,`transactions_id`, created_date)
		      VALUES ('$bill_id','$chairslist ','$cart_id', '', '$pay_type', '$pay_method','$cash_amount','$card_no','$card_name','$exp_date','$card_amount','$cheque_no','$ceq_name',
		       '$ceq_date','$cheque_amount','$on_card_no','$on_card_name','$on_exp_date','$online_amount','$transactions_id',NOW())");
			$paid_amount= $cash_amount+$card_amount+$cheque_amount+$online_amount;
			if($pay_type=="partial"){
				$discount=$row_data['total']*($disc/100);  
		 		$totalamount=$row_data['total']-$discount; 
				$pending_amount=$totalamount-$paid_amount;
				$sql_insert_customerdetails=db_query("INSERT INTO ".TABLE_HMS_CREDIT_PAYMENT_DETAIL." (credit_cart_id,`credit_bill_id`, `name`, `mobile`,`address`,`total_amount`,`payment_method`,`paid_amount`,`pending_amount`,`paid_date`)
		 			VALUES ('".$row_data['order_cart_id']."','', '$name', '$mobile','$address','$totalamount','$pay_method','$paid_amount','$pending_amount', NOW())");
			}
			$sql_update=db_query("UPDATE ".TABLE_HMS_RESTAURANT_ORDER_DETAILS." SET `status`='open'  WHERE table_entry_id='$chairslist' AND order_cart_id='$cart_id'");
		}
	}else{
		while($row_data=db_fetch_array($sql)){
			while($row_values=db_fetch_array($sql_exis)){		
				$sql_insert=db_query("UPDATE ".TABLE_HMS_RESTAURANT_ACCOUNT_DETAILS." SET `orde_close_date`= NOW() WHERE account_card_id='".$row_values['account_card_id']."'");
	        }
		}
	}
	if(isset($_SESSION["admin_role_mst_id"]) && !empty($_SESSION["admin_role_mst_id"]) && $_SESSION["admin_role_mst_id"]!='1')
		$wherecon = " AND created_role_id='".$_SESSION["admin_role_mst_id"]."'";
	

?>
		</table>
<?php 
} 



?>