<?php
require_once ("includes/application_top.php");
//require_once ("sss.html");
session_start();


if($_POST['FromDate']!='' && $_POST['ToDate']!='' )
{
$FromDate=$_POST['FromDate'];
$ToDate=$_POST['ToDate'];

$cancel_list_sqls = "SELECT *  FROM " . TABLE_HMS_RESTAURANT_ACCOUNT_DETAILS. " where orde_close_date BETWEEN '$FromDate' AND '$ToDate' AND status='cancel' AND bill_status='cancel' order by bill_id ASC"; 
$cancel_list_recordss = db_query ($cancel_list_sqls);                                                      

$count = mysql_num_fields($cancel_list_recordss);

	
$header ="S.No\tBILL NO\tDATE\tG.VALUE\tVat TAX\tService Tax\tTOTAL";	

  //$header .= $b.$title_val.$b."\t"
$num = mysql_num_rows($tax_list_recordss);
$sno=1; 
while($row = mysql_fetch_assoc($tax_list_recordss))
{ 
$payment_mode = db_query("SELECT *  FROM " .TABLE_HMS_PAYMENT_DETAIL. " where bill_no='".$row["bill_id"]."'");       
$table_data  = db_fetch_array($payment_mode);

$acc_query3 = "SELECT sum(order_amount) as total FROM ".TABLE_HMS_RESTAURANT_ORDER_DETAILS." WHERE bill_id='".trim($row["bill_id"])."' ";	
              $acc_query_result3 = db_query($acc_query3);
             $acctdetails3 = db_fetch_array($acc_query_result3);   

$acc_query3 = "SELECT sum(vat_amount) as vat FROM ".TABLE_HMS_RESTAURANT_ORDER_DETAILS." WHERE bill_id='".trim($row["bill_id"])."' ";	
              $acc_query_result3 = db_query($acc_query3);
             $sum_vat = db_fetch_array($acc_query_result3);  

$acc_query3 = "SELECT sum(service_amount) as ser FROM ".TABLE_HMS_RESTAURANT_ORDER_DETAILS." WHERE bill_id='".trim($row["bill_id"])."' ";	
              $acc_query_result3 = db_query($acc_query3);
             $sum_ser = db_fetch_array($acc_query_result3); 
             
             $disc=$row["discount"];
                 
                   if($disc !=""){                          
                     $discount_amount=$row["total_amount"]*($disc/100.0);    
                    $total_amount= round($row["total_amount"])-$discount_amount;                           
                   }
                   
                   else {
                       
                      $total_amount= round($row["total_amount"]);                      
                   }
             
		$line = '';
                
		$row1[0]=$sno;
		$row1[1]=$row['bill_id'];
		$row1[2]=$row['orde_close_date'];
                $row1[3]=round($acctdetails3['total']);
		$row1[4]=$sum_vat['vat'];
		$row1[5]=$sum_ser['ser'];
		$row1[6]= $total_amount;  
		//$row1[6]=$row['total_amount']; 		

 
        for($r=0; $r < 73; $r++)  
	     {
		$value = $row1[$r];
		if(!isset($value) || $value == "")	{	$value = "\t"; 	}
		else	
		{
			# important to escape any quotes to preserve them in the data.
			$value = str_replace('"', '""', $value);
			# needed to encapsulate data in quotes because some data might be multi line.
			# the good news is that numbers remain numbers in Excel even though quoted.
			$value = '"' . $value . '"' . "\t"; //.'"' . $value . '"' . "\t";
		}
                
		$line .= $value;
	}

	$data .= trim($line)."\n";
   $sno++; }  
# this line is needed because returns embedded in the data have "\r"
# and this looks like a "box character" in Excel
    $data = str_replace("\r", "", $data);
# Nice to let someone know that the search came up empty.
# Otherwise only the column name headers will be output to Excel.
//if ($data == "") {
//  $data = "\nno matching records found\n";
//}

# This line will stream the file to the user rather than spray it across the screen
header("Content-type: application/octet-stream");

# replace Spreadsheet.xls with whatever you want the filename to default to
$dateDwn= date('m-d-Y');
 header("Content-Disposition: attachment; filename=$dateDwn.tax.xls");
 header("Pragma: no-cache");
 header("Expires: 0");

echo $b.$header."\n".$data; 
}

?> 