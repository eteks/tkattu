<?php require_once ("includes/application_top.php");
$tabel=$_GET['table_id'];
$cardid=$_GET['card_id'];

$vat=$_GET['vat'];
$ser=$_GET['ser'];
$sales=$_GET['sales'];
$totaltax=$_GET['totaltax'];

$roomsno=$_GET['roomsno'];
$cus_name=$_GET['cus_name'];
$sql=db_query("SELECT `order_id`,`order_cart_id`,`bill_id`,`order_type`,`table_entry_id`,`order_total_price`,`order_open_date`,`menuid`, sum(`order_total_price`) as `total` ,`status`,`bill` FROM ".TABLE_HMS_RESTAURANT_ORDER_DETAILS." WHERE `status` = 'open' AND itemcancel='0'   AND table_entry_id ='".trim($_REQUEST["table_id"])."' AND order_cart_id = '".trim($_REQUEST["card_id"])."' ");

$sql_exis=db_query("SELECT * FROM ".TABLE_HMS_RESTAURANT_ACCOUNT_DETAILS." WHERE tabel_id='".$_GET['table_id']."' AND account_card_id='".trim($_REQUEST["card_id"])."'");
$count_table1 =mysql_num_rows($sql_exis);

if($count_table1==0){

while($row_data=db_fetch_array($sql)){
	
 $taxes=$row_data['total']*($totaltax/100);
 $totalamount=$row_data['total']+$taxes;
 	
$sql_insert=db_query("INSERT INTO ".TABLE_HMS_RESTAURANT_ACCOUNT_DETAILS." (`account_id`,`account_card_id`,`bill_id`,`vat`,`service`,`sales`,`roomno`,`customer_name`,`tabel_id`,`taxes`,`subtotal`,`total_amount`,`orde_close_date`,created_by,created_role_id) VALUES ('','".$row_data['order_cart_id']."','".$row_data['bill_id']."','".$vat."','".$ser."','".$sales."','".$roomsno."','".$cus_name."','".$row_data['table_entry_id']."','".$taxes."','".$row_data['total']."','".$totalamount."',NOW()),'".$_SESSION["userid"]."','".$_SESSION["admin_role_mst_id"]."'");	
}
}
else{
	while($row_data=db_fetch_array($sql)){
	while($row_values=db_fetch_array($sql_exis)){
		
$sql_insert=db_query("UPDATE ".TABLE_HMS_RESTAURANT_ACCOUNT_DETAILS." SET `orde_close_date`= NOW() WHERE account_card_id='".$row_values['account_card_id']."'");

}
	}
}

$sql_update=db_query("UPDATE ".TABLE_HMS_RESTAURANT_ORDER_DETAILS."  SET  `status` ='closed',`order_close_date`= NOW() WHERE order_cart_id='".$_GET['card_id']."'");

$sql_update=db_query("UPDATE  ".TABLE_HMS_RESTAURANT_ACCOUNT_DETAILS." SET `status`='close' WHERE account_card_id='".$_GET['card_id']."'");

$account_bill ="SELECT * FROM ".TABLE_HMS_RESTAURANT_ACCOUNT_DETAILS." WHERE account_card_id = '".trim($_REQUEST["card_id"])."' AND tabel_id ='".trim($_REQUEST["table_id"])."'";
$account_bill_query = db_query($account_bill);
$account_bill_data = db_fetch_array($account_bill_query);
?><head>
<style>
    @media print { .ScreenOnly { display: none; } }
    @media screen { .PrintOnly { display: none; background-color:#5DA6EA }
    .TabContentHidden { display: none; visibility: hidden; } }
	
	.blackbold{ font-family:Arial, Helvetica, sans-serif; font-size:12px; }
</style>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/stylesheet.css" rel="stylesheet" type="text/css" />
</head>
<?php
     
	 
	 
	$student_user_fetch_singrec_sql = "SELECT `hms_parameter_id`,`hms_hotel_name`,`hms_address1`,`hms_address2`,`hms_city`,`hms_state`,`hms_country`,`hms_pincode`,`hms_phone_no`,`hms_url`,`hms_email`,`hms_footertxt`,`date_added`,`date_modified`,`hms_active` FROM hms_parameter_entry WHERE `hms_active` = 'Y'";
    $student_user_sing_records = db_query ($student_user_fetch_singrec_sql);
	$parameterEntry_values = db_fetch_array($student_user_sing_records);

?>






<div class="PrintOnly">
<table width="300"  align="left" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" class="tableborder">
  <tr >
    <td height="38"  colspan="14" align="center" valign="middle" bgcolor="#D7DBB0" class="verdanabold"><table width="112%" border="0" cellspacing="0" cellpadding="2">
      <tr>
        <td valign="top"><table border="0" cellspacing="0" cellpadding="3" width="100%" align="center">
            <tr>
              <td align="center" class="blackbold"><?php echo stripslashes($parameterEntry_values["hms_hotel_name"]);?>,                  </td>
            </tr>
            <tr>
              <td align="center" class="blackbold"><?php echo stripslashes($parameterEntry_values["hms_address1"]);?>-<?php echo stripslashes( $parameterEntry_values["hms_pincode"]);?>, </td>
            </tr>
            <tr>
              <td align="center" class="blackbold"><?php echo stripslashes( $parameterEntry_values["hms_state"]);?> ,<?php echo stripslashes( $parameterEntry_values["hms_country"]);?>,</td>
            </tr>

        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
   <td align="center" valign="top" class="blackbold"><?php echo "BILL NO:".$account_bill_data['bill_id']."   ";  echo date("dS  M  Y h:i A")."   ";?> </td>
    
  </tr>
  <tr>
    <td align="center" valign="top">
	<a href="javascript:void(0);" onClick="javascript:getPrintBARList('<?php echo trim($_POST["cartId"]);?>','<?php echo trim($_POST["date"]);?>');"></a>        <table width="100%" border="0" align="center" cellpadding="2" cellspacing="2" class="tableborder">
      <tr align="center" bgcolor="#999999">
             
            <td width="38%" bgcolor="#666666" class="verdanablack" style="text-align:left;">Item Name</td>
            <td width="6%" bgcolor="#666666" class="verdanablack">Quty.</td>
            <td width="10%" bgcolor="#666666" class="verdanablack" >Rate</td>
            <td width="8%" height="27" bgcolor="#666666" class="verdanablack">Amount&nbsp;&nbsp;</td>
      </tr>
      <?php
	//if(mysql_num_rows($order_query_result)>0) {
/*echo "<pre>";
print_R($_GET);
exit;*/
	  	  
		 $acc_query ="SELECT * FROM ".TABLE_HMS_RESTAURANT_ORDER_DETAILS." WHERE order_cart_id = '".trim($_REQUEST["card_id"])."' AND table_entry_id ='".trim($_REQUEST["table_id"])."' ";
		//exit;
		
        $acc_query_result = db_query($acc_query);
		$i = 1; 	
		while ($acctdetails  = db_fetch_array($acc_query_result)) {
		
		if (isset($acctdetails["table_entry_id"]) && $acctdetails["table_entry_id"] !="" ) {
            $hms_info_fetch_table_sql = "SELECT `table_entry_id`,`table_type_id`,`table_no`,`numbers_of_chairs`,`active`,`date_added`,`date_modified` FROM " . TABLE_HMS_TABLE_ENTRY . " WHERE table_entry_id = ".$acctdetails["table_entry_id"]." ";
            $table_records = db_query ($hms_info_fetch_table_sql);
			$table  = db_fetch_array($table_records);		
		}
		$bgcolor = (($i % 2 == 0) ? "#999999" : "#cccccc");	
		
?>
      <tr align="center" bgcolor="<? echo $bgcolor ?>">
       
        <td class="verdanablack" style="text-align:left;"><?php echo $acctdetails["order_product"];?></td>
        <td class="verdanablack"><?php echo $acctdetails["order_quantity"];?></td>
        <td class="verdanablack" style="text-align:right;"><?php echo $acctdetails["order_price"];?></td>
        <td class="verdanablack" style="text-align:right;"><?php echo $amt = $acctdetails["order_quantity"]*$acctdetails["order_price"];?></td>
       
      </tr>
      <?php
	 $i++;
		}
		$acc_query3 = "SELECT * FROM ".TABLE_HMS_RESTAURANT_ACCOUNT_DETAILS." WHERE account_card_id='".trim($_REQUEST["card_id"])."' AND tabel_id ='".trim($_REQUEST["table_id"])."' ";	
		 $acc_query_result3 = db_query($acc_query3);
		$acctdetails3 = db_fetch_array($acc_query_result3);
	?>
	
       
          <!--<tr>
            <td colspan="15" align="center"><strong><font color="#FF0000">No  Details Available</font></strong></td>
          </tr>-->
          <?
	//}
 ?> <tr>
      <?php
		
		 $acc_query2 = "SELECT * FROM ".TABLE_HMS_RESTAURANT_ACCOUNT_DETAILS." WHERE account_card_id='".trim($_REQUEST["card_id"])."' AND tabel_id ='".trim($_REQUEST["table_id"])."' ";	
	
        $acc_query_result2 = db_query($acc_query2);
		while($acctdetails2 = db_fetch_array($acc_query_result2)){

	?>
     <tr align="center" bgcolor="<? echo $bgcolor ?>">
          

            
          
            <td class="verdanablack" colspan="3" style="text-align:right;">
           
		   Total&nbsp;&nbsp;:<?php echo " "; ?><br />
		   <?php if($acctdetails2['vat']!="0.00"){  ?>
            VAT &nbsp;<?php echo $acctdetails2['vat']; ?>%&nbsp;&nbsp;:
            <?php } ?> <br />
            <?php if($acctdetails2['service']!="0.00"){  ?>
            SERVICE &nbsp;<?php echo $acctdetails2['service'];?>%&nbsp;&nbsp;: 
              <?php } ?><br />
                <?php if($acctdetails2['sales']!="0.00"){  ?>
            SALES &nbsp;<?php echo $acctdetails2['sales'];?>%&nbsp;&nbsp;:  
                          <?php } ?>

            </td>
<td class="verdanablack" style="text-align:right;">

<?php echo $acctdetails3["subtotal"]; ?><br />

<?php if($acctdetails2['vat']!="0.00"){  ?>
 <?php 
 $vat = $acctdetails3["subtotal"]*($acctdetails2['vat']/100);
 echo $vat; 
 ?>   
<?php } ?>   <br />

<?php if($acctdetails2['service']!="0.00"){  ?> 
 <?php 
  $ser = $acctdetails3["subtotal"]*($acctdetails2['service']/100);
   echo $ser; 
 
 ?>  
 <?php } ?><br />
 
 <?php if($acctdetails2['sales']!="0.00"){  ?> 
 <?php 
  $sale = $acctdetails3["subtotal"]*($acctdetails2['sales']/100);
   echo $sale; 
 ?>  
 <?php } ?> 
            </td>
          </tr>	
        
          <!--<tr>
            <td colspan="15" align="center"><strong><font color="#FF0000">No  Details Available</font></strong></td>
          </tr>-->
          <?
	//}
 ?> <tr>
    
          <tr align="center" bgcolor="<? echo $bgcolor ?>">
          

           
            <td  colspan="4" style="text-align:center; font-style:inherit; margin-left:20px;">
           <?php echo "-----------------------------------------------"; ?> <br />
           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; NET AMOUNT &nbsp; : &nbsp; <?php echo $acctdetails2["total_amount"]."  ";?> <br />
             <?php echo "-----------------------------------------------"; ?>
            </td>
          
          </tr>	
            <?php } ?>
          <!--<tr>
            <td colspan="15" align="center"><strong><font color="#FF0000">No  Details Available</font></strong></td>
          </tr>-->
          <?
	//}
 ?> <tr>
    <td colspan="8" align="center"></td>
  </tr>
    </table></td>
  </tr>
  
  <tr>
    <td valign="top">
          </tbody></td>
  </tr>
  
  <tr>
    <td align="center" bgcolor="#D7DBB0"><?php echo "*** THANK YOU VISIT AGAIN ***"; ?> </td>
  </tr>
  <tr>
    <td height="5" align="right"></td>
  </tr>
</table>
</div>
<div class="ScreenOnly">

<table width="300"  align="left" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" class="tableborder">
  <tr >
    <td height="38"  colspan="14" align="center" valign="middle" bgcolor="#D7DBB0" class="verdanabold"><table width="112%" border="0" cellspacing="0" cellpadding="2">
      <tr>
        <td valign="top"><table border="0" cellspacing="0" cellpadding="3" width="100%" align="center">
            <tr>
              <td align="center" class="blackbold"><?php echo stripslashes($parameterEntry_values["hms_hotel_name"]);?>,                  </td>
            </tr>
            <tr>
              <td align="center" class="blackbold"><?php echo stripslashes($parameterEntry_values["hms_address1"]);?>-<?php echo stripslashes( $parameterEntry_values["hms_pincode"]);?>, </td>
            </tr>
            <tr>
              <td align="center" class="blackbold"><?php echo stripslashes( $parameterEntry_values["hms_state"]);?> ,<?php echo stripslashes( $parameterEntry_values["hms_country"]);?>,</td>
            </tr>

        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
   <td align="center" valign="top" class="blackbold"><?php echo "BILL NO:".$account_bill_data['bill_id']."   ";  echo date("dS  M  Y h:i A")."   "; ?> </td>
    
  </tr>
  <tr>
    <td align="center" valign="top">
	<a href="javascript:void(0);" onClick="javascript:getPrintBARList('<?php echo trim($_POST["cartId"]);?>','<?php echo trim($_POST["date"]);?>');"></a>        <table width="100%" border="0" align="center" cellpadding="2" cellspacing="2" class="tableborder">
      <tr align="center" bgcolor="#999999">
             
            <td width="38%" bgcolor="#666666" class="verdanablack" style="text-align:left;">Item Name</td>
            <td width="6%" bgcolor="#666666" class="verdanablack">Quty.</td>
            <td width="10%" bgcolor="#666666" class="verdanablack" >Rate</td>
            <td width="8%" height="27" bgcolor="#666666" class="verdanablack">Amount&nbsp;&nbsp;</td>
      </tr>
      <?php
	//if(mysql_num_rows($order_query_result)>0) {
/*echo "<pre>";
print_R($_GET);
exit;*/
	  	  
		 $acc_query ="SELECT * FROM ".TABLE_HMS_RESTAURANT_ORDER_DETAILS." WHERE order_cart_id = '".trim($_REQUEST["card_id"])."' AND table_entry_id ='".trim($_REQUEST["table_id"])."' ";
		//exit;
		
        $acc_query_result = db_query($acc_query);
		$i = 1; 	
		while ($acctdetails  = db_fetch_array($acc_query_result)) {
		
		if (isset($acctdetails["table_entry_id"]) && $acctdetails["table_entry_id"] !="" ) {
            $hms_info_fetch_table_sql = "SELECT `table_entry_id`,`table_type_id`,`table_no`,`numbers_of_chairs`,`active`,`date_added`,`date_modified` FROM " . TABLE_HMS_TABLE_ENTRY . " WHERE table_entry_id = ".$acctdetails["table_entry_id"]." ";
            $table_records = db_query ($hms_info_fetch_table_sql);
			$table  = db_fetch_array($table_records);		
		}
		$bgcolor = (($i % 2 == 0) ? "#999999" : "#cccccc");	
		
?>
      <tr align="center" bgcolor="<? echo $bgcolor ?>">
       
        <td class="verdanablack" style="text-align:left;"><?php echo $acctdetails["order_product"];?></td>
        <td class="verdanablack"><?php echo $acctdetails["order_quantity"];?></td>
        <td class="verdanablack" style="text-align:right;"><?php echo $acctdetails["order_price"];?></td>
        <td class="verdanablack" style="text-align:right;"><?php echo $amt = $acctdetails["order_quantity"]*$acctdetails["order_price"];?></td>

      </tr>
      <?php
	 $i++;
		}
		$acc_query3 = "SELECT * FROM ".TABLE_HMS_RESTAURANT_ACCOUNT_DETAILS." WHERE account_card_id='".trim($_REQUEST["card_id"])."' AND tabel_id ='".trim($_REQUEST["table_id"])."' ";	
		 $acc_query_result3 = db_query($acc_query3);
		$acctdetails3 = db_fetch_array($acc_query_result3);
	?>
	
       
          <!--<tr>
            <td colspan="15" align="center"><strong><font color="#FF0000">No  Details Available</font></strong></td>
          </tr>-->
          <?
	//}
 ?> <tr>
      <?php
		
		 $acc_query2 = "SELECT * FROM ".TABLE_HMS_RESTAURANT_ACCOUNT_DETAILS." WHERE account_card_id='".trim($_REQUEST["card_id"])."' AND tabel_id ='".trim($_REQUEST["table_id"])."' ";	
	
        $acc_query_result2 = db_query($acc_query2);
		while($acctdetails2 = db_fetch_array($acc_query_result2)){

	?>
     <tr align="center" bgcolor="<? echo $bgcolor ?>">
          
            <td class="verdanablack" colspan="3" style="text-align:right;">
           
		   Total&nbsp;&nbsp;:<?php echo " "; ?><br />
		   <?php if($acctdetails2['vat']!="0.00"){  ?>
            VAT &nbsp;<?php echo $acctdetails2['vat']; ?>%&nbsp;&nbsp;:
            <?php } ?> <br />
            <?php if($acctdetails2['service']!="0.00"){  ?>
            SERVICE &nbsp;<?php echo $acctdetails2['service'];?>%&nbsp;&nbsp;: 
              <?php } ?><br />
                <?php if($acctdetails2['sales']!="0.00"){  ?>
            SALES &nbsp;<?php echo $acctdetails2['sales'];?>%&nbsp;&nbsp;:  
                          <?php } ?>

            </td>
<td class="verdanablack" style="text-align:right;">

<?php echo $acctdetails3["subtotal"]; ?><br />

<?php if($acctdetails2['vat']!="0.00"){  ?>
 <?php 
 $vat = $acctdetails3["subtotal"]*($acctdetails2['vat']/100);
 echo $vat; 
 ?>   
<?php } ?>   <br />

<?php if($acctdetails2['service']!="0.00"){  ?> 
 <?php 
  $ser = $acctdetails3["subtotal"]*($acctdetails2['service']/100);
   echo $ser; 
 
 ?>  
 <?php } ?><br />
 
 <?php if($acctdetails2['sales']!="0.00"){  ?> 
 <?php 
  $sale = $acctdetails3["subtotal"]*($acctdetails2['sales']/100);
   echo $sale; 
 ?>  
 <?php } ?> 
            </td>
          </tr>	
        
          <!--<tr>
            <td colspan="15" align="center"><strong><font color="#FF0000">No  Details Available</font></strong></td>
          </tr>-->
          <?
	//}
 ?> <tr>
    
          <tr align="center" bgcolor="<? echo $bgcolor ?>">
          

           
            <td  colspan="4" style="text-align:center; font-style:inherit; margin-left:20px;">
           <?php echo "-----------------------------------------------"; ?> <br />
           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; NET AMOUNT &nbsp; : &nbsp; <?php echo $acctdetails2["total_amount"]."  ";?> <br />
             <?php echo "-----------------------------------------------"; ?>
            </td>
          
          </tr>	
            <?php } ?>
          <!--<tr>
            <td colspan="15" align="center"><strong><font color="#FF0000">No  Details Available</font></strong></td>
          </tr>-->
          <?
	//}
 ?> <tr>
    <td colspan="8" align="center"></td>
  </tr>
    </table></td>
  </tr>
  
  <tr>
    <td valign="top">
          </tbody></td>
  </tr>
  
  <tr>
    <td align="center" bgcolor="#D7DBB0"><?php echo "*** THANK YOU VISIT AGAIN ***"; ?> </td>
  </tr>
  <tr>
    <td height="5" align="right"></td>
  </tr>
</table>
</div>
<div class="ScreenOnly">
      <div class="submenu" style="float:right"><a href="javascript:void(0);" onClick="javascript:self.close();">Close</a></div><div style="float:right; width:38px">&nbsp;</div><div class="submenu" style="float:right"><a href="javascript:void(0);"  onClick="javascript:window.print();">Print</a></div></div>
