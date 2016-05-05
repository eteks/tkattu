<?php
require_once ("includes/application_top.php");
session_start();
?>
 <?php 
 $action=$_REQUEST['action'];
 
  $table_id = $_POST['table_id'];
  $bill_id = $_POST['bill_id'];
  $cart_id = $_POST['cart_id'];  
  
  $credit_bill_id = $_POST['bill_id'];
  $pay_type= $_POST['pay_type'];  
  $name= $_POST['name'];  
  $mobile= $_POST['mobile'];  
  $address= $_POST['address'];
   
  $pay_method= $_POST['pay_method'];  
  
  $bill_status= $_POST['bill_status'];  
  
  $cash_amount= $_POST['cash_amount'];
  
  $card_amount= $_POST['card_amount'];
  $card_no= $_POST['card_no'];
  $card_name= $_POST['card_name']; 
  $exp_date= $_POST['exp_date'];
  
  $cheque_amount= $_POST['cheque_amount'];
  $cheque_no= $_POST['cheque_no'];
  $ceq_name= $_POST['ceq_name'];
  $ceq_date= $_POST['ceq_date'];
  
  $online_amount= $_POST['online_amount'];
  $on_card_no= $_POST['on_card_no'];
  $on_card_name= $_POST['on_card_name'];
  $on_exp_date= $_POST['on_exp_date'];
  $transactions_id= $_POST['transactions_id'];
  $disc= $_POST['disc']; 
  if($action=='savebill')
{
      
   // $condition="(`bill_no`,`table_id`,`cart_id`,`payment_method`,`cash_amount`,`card_no`,`card_name`,`expire_date`,`card_amount`,
          //  `cheque_number`,`cheque_name`,`cheque_date`,`cheque_amount`,`on_card_no`,`on_exp_date`,`on_card_name`,`on_amount`,`	transactions_id`,created_date)
         //   VALUES ('$bill_id','$table_id ',$cart_id','$pay_method','$cash_amount','$card_name','$exp_date','$cheque_amount','$cheque_no','$ceq_name',
        //    '$ceq_date','$online_amount','$on_card_no','$on_card_name','$on_exp_date','$transactions_id',NOW())";
 ?>
     
     
<?php 
$sql=db_query("SELECT `order_id`,`order_cart_id`,`bill_id`, `menuid`, `vat_amount`, `service_amount`, `order_type`,`table_entry_id`,`order_total_price`,`order_open_date`,`menuid`, sum(`vat_amount`) as v_amount, sum(`service_amount`) as ser_amount,  sum(`order_total_price`) as `total` ,`status`,`bill` FROM ".TABLE_HMS_RESTAURANT_ORDER_DETAILS." WHERE `status` = 'close' AND table_entry_id ='$table_id' AND order_cart_id = '$cart_id' ");

$sql_delete_acc=db_query("DELETE FROM ".TABLE_HMS_RESTAURANT_ACCOUNT_DETAILS." WHERE tabel_id='$table_id' AND account_card_id='$cart_id'");

$sql_exis=db_query("SELECT * FROM ".TABLE_HMS_RESTAURANT_ACCOUNT_DETAILS." WHERE tabel_id='$table_id' AND account_card_id='$cart_id'");
$count_table1 =mysql_num_rows($sql_exis);

if($count_table1==0){
while($row_data=db_fetch_array($sql)){	

$discount=$row_data['total']*($_GET['disc']/100);  
 $totalamount=$row_data['total']+$taxes-$discount; 
 
$sql_insert=db_query("INSERT INTO ".TABLE_HMS_RESTAURANT_ACCOUNT_DETAILS." (`account_id`,`account_card_id`,`bill_id`, `order_type`,`vat`,`service`,`vat_amt`,`service_amt`,`discount`,`tabel_id`,`subtotal`,`total_amount`,`orde_close_date`,`status`,`bill_status`,created_by,created_role_id) VALUES ('','".$row_data['order_cart_id']."','".$row_data['bill_id']."', '".$row_data['order_type']."','".$vat."','".$ser."','".$row_data['v_amount']."','".$row_data['ser_amount']."','".$disc."','".$row_data['table_entry_id']."','".$row_data['total']."','".$totalamount."',NOW(),'close','$bill_status','".$_SESSION["userid"]."','".$_SESSION["admin_role_mst_id"]."')");


$sql_insert_customerdetails=db_query("INSERT INTO ".TABLE_HMS_PAYMENT_DETAIL." (`bill_no`,`table_id`,`cart_id`, `credit_bill_id`, `payment_type`, `payment_method`,`cash_amount`,`card_no`,`card_name`,`expire_date`,`card_amount`,
            `cheque_number`,`cheque_name`,`cheque_date`,`cheque_amount`,`on_card_no`,`on_exp_date`,`on_card_name`,`on_amount`,`transactions_id`, created_date)
            VALUES ('$bill_id','$table_id ','$cart_id', '$credit_bill_id', '$pay_type', '$pay_method','$cash_amount','$card_no','$card_name','$exp_date','$card_amount','$cheque_no','$ceq_name',
            '$ceq_date','$cheque_amount','$on_card_no','$on_card_name','$on_exp_date','$online_amount','$transactions_id',NOW())");

$paid_amount= $cash_amount+$card_amount+$cheque_amount+$online_amount;

$discount=$row_data['total']*($disc/100);  
 $totalamount=$row_data['total']-$discount; 
 
 $pending_amount=$totalamount-$paid_amount; 
        
$sql_insert_customerdetails=db_query("INSERT INTO ".TABLE_HMS_CREDIT_PAYMENT_DETAIL." (`credit_bill_id`, `name`, `mobile`,`address`,`total_amount`,`payment_method`,`paid_amount`,`pending_amount`,`paid_date`)
 VALUES ('$credit_bill_id', '$name', '$mobile','$address','$totalamount','$pay_method','$paid_amount','$pending_amount', NOW())");

}
}
else{    
	while($row_data=db_fetch_array($sql)){
	while($row_values=db_fetch_array($sql_exis)){		
$sql_insert=db_query("UPDATE ".TABLE_HMS_RESTAURANT_ACCOUNT_DETAILS." SET `orde_close_date`= NOW() WHERE account_card_id='".$row_values['account_card_id']."'");
}
}
}

}
?>