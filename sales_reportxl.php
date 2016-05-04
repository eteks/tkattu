<?php
require_once ("includes/application_top.php");
require 'Classes/PHPExcel.php'; 
require_once 'Classes/PHPExcel/IOFactory.php';
//require_once ("sss.html");
session_start();

if($_POST['FromDate']!='' && $_POST['ToDate']!='' ) 
{
$FromDate=$_POST['FromDate'];
$ToDate=$_POST['ToDate'];

$tax_list_sqls = "SELECT *  FROM " . TABLE_HMS_RESTAURANT_ACCOUNT_DETAILS. " where status='close' AND orde_close_date BETWEEN '$FromDate' AND '$ToDate' ORDER BY bill_id ASC"; 
$tax_list_recordss = db_query ($tax_list_sqls);                                                   
$count = mysql_num_fields($tax_list_recordss);


//$header ="DATE\tBILL NO\tPARTY \tSWEETS & SAVORIES \t \tFOOD \t \tJUICE \t \tLIQUOR ITEMS \t \tICE CREAM ITEMS \t \tMINERAL WATER \t \tSOFT DRINKS \t \tTotal\tVat Tax\tSER.TAX\tDiscount\tNet Amount";	
  
//$header1 ="\t \t \tVALUE \tTAX \tVALUE \tTAX  \tVALUE \tTAX  \tVALUE \tTAX \tVALUE \tTAX \tVALUE \tTAX \tVALUE \tTAX \t\t\t\t\t";	

//,$headvalues,'Total','Vat Tax','SER.TAX','Discount','Net Amount'
$select_itemcate=db_query("SELECT * FROM ".TABLE_HMS_MENU_CATEGORY." WHERE  active='Y' ");

while($head  = mysql_fetch_array($select_itemcate)){
     $headvalues[].= $head['hms_menu_category_name'];
     $headvalues[].="";
     $value[].='VALUE';
      $value[].='TAX';
}

$headvalues1 = array('DATE','BILL NO','PARTY'); 

$headvalues2 = array('Total','Vat Tax','SER.TAX','Discount','Net Amount'); 

$headings = array_merge($headvalues1,$headvalues,$headvalues2);

//print_r($headings);
//exit;
//$headings = array('DATE','BILL NO','PARTY','SWEETS&SAVORIES','','FOOD','','JUICE','','LIQUOR ITEMS','','ICE CREAM ITEMS','','MINERAL WATER','','SOFT DRINKS','','Total','Vat Tax','SER.TAX','Discount','Net Amount'); 

$taxspace = array('','','');
$headings1 = array_merge($taxspace,$value);



  $objPHPExcel = new PHPExcel(); 
  $objPHPExcel->getActiveSheet()->setTitle('result'); 

    $rowNumber = 1; 
    $col = 'A'; 
    foreach($headings as $heading) { 
	$objPHPExcel->getActiveSheet()-> setCellValueExplicit( $col.$rowNumber,$heading, PHPExcel_Cell_DataType::TYPE_STRING); 
         $objPHPExcel->getActiveSheet()->getStyle($col.$rowNumber)->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle($col.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getColumnDimension($col)->setAutoSize(true);
        $col++; 
    } 
	
    $rowNumber = 2; 
    $col = 'A'; 
    foreach($headings1 as $heading) { 
	$objPHPExcel->getActiveSheet()-> setCellValueExplicit( $col.$rowNumber,$heading, PHPExcel_Cell_DataType::TYPE_STRING); 
        $objPHPExcel->getActiveSheet()->getStyle($col.$rowNumber)->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle($col.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
       $objPHPExcel->getActiveSheet()->getColumnDimension($col)->setAutoSize(true);
        $col++; 
    } 


 $select_itemcate=db_query("SELECT * FROM ".TABLE_HMS_MENU_CATEGORY." WHERE  active='Y' ");
 
 while($categ_list= db_fetch_array($select_itemcate))
  {
  $hms_menu_category_id = $categ_list['hms_menu_category_id'];

$num = mysql_num_rows($tax_list_recordss);
 $rowCount = 3;
   while ($hms_info_values_tax = db_fetch_array($tax_list_recordss)) { 
      
    $payment_mode = db_query("SELECT *  FROM " .TABLE_HMS_PAYMENT_DETAIL. " where bill_no='".$hms_info_values_tax["bill_id"]."'");       
	    $table_data  = db_fetch_array($payment_mode);
    
        $acc_query3 = "SELECT sum(order_amount) as total FROM ".TABLE_HMS_RESTAURANT_ORDER_DETAILS." WHERE bill_id='".trim($hms_info_values_tax["bill_id"])."' ";	
		 $acc_query_result3 = db_query($acc_query3);
		$acctdetails3 = db_fetch_array($acc_query_result3);   
          
         $acc_query3 = "SELECT sum(vat_amount) as vat FROM ".TABLE_HMS_RESTAURANT_ORDER_DETAILS." WHERE bill_id='".trim($hms_info_values_tax["bill_id"])."' ";	
		 $acc_query_result3 = db_query($acc_query3);
		$sum_vat = db_fetch_array($acc_query_result3);  
                
         $acc_query3 = "SELECT sum(service_amount) as ser FROM ".TABLE_HMS_RESTAURANT_ORDER_DETAILS." WHERE bill_id='".trim($hms_info_values_tax["bill_id"])."' ";	
		 $acc_query_result3 = db_query($acc_query3);
		$sum_ser = db_fetch_array($acc_query_result3);  

		

		$date = explode('-',$hms_info_values_tax['orde_close_date']);
        $date1=$date[2]."-".$date[1]."-".$date[0]; 
  
     $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $date1); 
	 $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, $hms_info_values_tax['bill_id']); 
	 $objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, $table_data['payment_method']);                

$select_itemcate=db_query("SELECT * FROM ".TABLE_HMS_MENU_CATEGORY." WHERE  active='Y' ");
  $i ='D'; 
  $j ='E'; 
  
 
  while($categ_list= db_fetch_array($select_itemcate))
  {
  $hms_menu_category_id = $categ_list['hms_menu_category_id'];
 $categ_value = "SELECT sum(order_amount) as categ_value FROM  " . TABLE_HMS_RESTAURANT_ORDER_DETAILS . " WHERE  category_id  = '$hms_menu_category_id' and bill_id='".trim($hms_info_values_tax["bill_id"])."' ";	 
$categ_v = db_query($categ_value);
  if($sum_categ = db_fetch_array($categ_v))
  {      
 $categ_v = "SELECT sum(vat_amount) as v_amt FROM  " . TABLE_HMS_RESTAURANT_ORDER_DETAILS . " WHERE  category_id  = '$hms_menu_category_id' and bill_id='".trim($hms_info_values_tax["bill_id"])."' ";
$categ_v_amt = db_query($categ_v);
$sum_categ_v = db_fetch_array($categ_v_amt); 
$vat_amount = $sum_categ_v['v_amt'];

$sum_categ = $sum_categ['categ_value'];
if($sum_categ=="")
{
    $sum_categ="0";
}

if($vat_amount=="")
{
    $vat_amount="0";
    
}
                           						
                $objPHPExcel->getActiveSheet()->SetCellValue($i.$rowCount, $sum_categ); 
                $objPHPExcel->getActiveSheet()->SetCellValue($j.$rowCount,$vat_amount); 
  } 
  $i++;
  $i++;
  $j++;
  $j++;
  }           
        

$categ_v = "SELECT sum(vat_amount) as v_amt FROM  " . TABLE_HMS_RESTAURANT_ORDER_DETAILS . " WHERE  bill_id='".trim($hms_info_values_tax["bill_id"])."' ";
$categ_v_amt = db_query($categ_v);
$sum_categ_v = db_fetch_array($categ_v_amt); 
$vat_amount = $sum_categ_v['v_amt'];

 $categ_s = "SELECT sum(service_amount) as s_amt FROM  " . TABLE_HMS_RESTAURANT_ORDER_DETAILS . " WHERE  bill_id='".trim($hms_info_values_tax["bill_id"])."' ";
$categ_s_amt = db_query($categ_s);
$sum_categ_s = db_fetch_array($categ_s_amt); 
$service_amount = $sum_categ_s['s_amt'];
   
$tax_amount = $vat_amount+$service_amount;

$netamount =$acctdetails3['total']+$tax_amount;

$disc = $hms_info_values_tax['discount'];
if($disc !="")
{
    $discount= $netamount*$disc/100;
}
else { $discount="0"; }

    $net_amount = $netamount-round($discount);
    
     
     $total= $i;
     $vat= $j;
    $first = $vat++;
    $second = $vat++;
    $third = $vat++;

    
     $objPHPExcel->getActiveSheet()->SetCellValue($total.$rowCount,round($acctdetails3['total'])); 	
     $objPHPExcel->getActiveSheet()->SetCellValue($first.$rowCount,$vat_amount); 
     $objPHPExcel->getActiveSheet()->SetCellValue($second.$rowCount,$service_amount); 	
     $objPHPExcel->getActiveSheet()->SetCellValue($third.$rowCount, round($discount)); 
     $objPHPExcel->getActiveSheet()->SetCellValue($vat.$rowCount,round($net_amount)); 		 
	 
	 $rowCount++;
}
 
}  	 
	

foreach(range('A','V') as $columnID) {
    $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
        ->setAutoSize(true);
}
 
//$objPHPExcel->getActiveSheet()->getStyle("A1:V1")->getFont()->setBold(true);
//$objPHPExcel->getActiveSheet()->getStyle("A2:V2")->getFont()->setBold(true);

//$objPHPExcel->getActiveSheet()->getStyle("A1")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
//$objPHPExcel->getActiveSheet()->getStyle("A2")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

     $objPHPExcel->getActiveSheet()->getStyle(
    'A1:' . 
    $objPHPExcel->getActiveSheet()->getHighestColumn() . 
    $objPHPExcel->getActiveSheet()->getHighestRow()
)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);   

   header('Content-Type: application/vnd.ms-excel'); 
header('Content-Disposition: attachment;filename="sales_reportxls.xls"'); 
header('Cache-Control: max-age=0'); 
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5'); 
$objWriter->save('php://output'); 

}

?> 