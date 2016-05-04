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

$cancel_list_sqls = "SELECT *  FROM " . TABLE_HMS_RESTAURANT_ACCOUNT_DETAILS. " where orde_close_date BETWEEN '$FromDate' AND '$ToDate' AND status='cancel' AND bill_status='cancel' order by bill_id ASC"; 
$cancel_list_recordss = db_query ($cancel_list_sqls);                                                      

//$count = mysql_num_fields($cancel_list_recordss);
    
//$header ="S.No\tBILL NO\tDATE\tG.VALUE\tTAX\tService Tax\tT0TAL";	
//$num = mysql_num_rows($cancel_list_recordss);

$headings = array('S.No','BILL NO','DATE','G.VALUE','TAX','Service Tax','TOTAL'); 

  $objPHPExcel = new PHPExcel(); 
    $objPHPExcel->getActiveSheet()->setTitle('result'); 

    $rowNumber = 1; 
    $col = 'A'; 
    foreach($headings as $heading) { 
	$objPHPExcel->getActiveSheet()-> setCellValueExplicit( $col.$rowNumber,$heading, PHPExcel_Cell_DataType::TYPE_STRING); 
       $col++; 
    } 
	

 $rowCount = 2; 
 $Count= 1; 
while($row = db_fetch_array($cancel_list_recordss))
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
                
        $date = explode('-',$row['orde_close_date']);  
        $date1=$date[2]."-".$date[1]."-".$date[0]; 		
		
     $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $Count); 
	 $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, $row['bill_id']); 
	 $objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, $date1); 
	 $objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, $acctdetails3['total']); 
     $objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount,$sum_vat['vat']); 
     $objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount, $sum_ser['ser']); 	
$objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount, $total_amount); 		 
    $rowCount++; 
	$Count++;
   } 
   
$objPHPExcel->getActiveSheet()->getStyle("A1:G1")->getFont()->setBold(true);

$objPHPExcel->getActiveSheet()->getStyle("A1:G1")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
 //$sheet->getActiveSheet()->getStyle('A1:B1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
//$objPHPExcel->getActiveSheet()->getStyle("A1:G1")->getFont()->setBold(true); 
  
  foreach(range('A','G') as $columnID) {
    $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
        ->setAutoSize(true);
}
  
 $objPHPExcel->getActiveSheet()->getStyle(
    'A1:' . 
    $objPHPExcel->getActiveSheet()->getHighestColumn() . 
    $objPHPExcel->getActiveSheet()->getHighestRow()
)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
  
header('Content-Type: application/vnd.ms-excel'); 
header('Content-Disposition: attachment;filename="Cancelbill_reportxls.xls"'); 
header('Cache-Control: max-age=0'); 
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5'); 
$objWriter->save('php://output');

/* $query = "SELECT *  FROM " . TABLE_HMS_RESTAURANT_ACCOUNT_DETAILS. " WHERE orde_close_date BETWEEN '$FromDate' AND '$ToDate' AND status='cancel' AND bill_status='cancel' order by bill_id ASC"; 

$result = mysql_query($query) or die(mysql_error());

$objPHPExcel = new PHPExcel(); 

$objPHPExcel->setActiveSheetIndex(0); 


$headings = array('S.No','BILL NO','DATE','G.VALUE','TAX','Service Tax','T0TAL'); 

  $objPHPExcel = new PHPExcel(); 
    $objPHPExcel->getActiveSheet()->setTitle('result'); 

    $rowNumber = 1; 
    $col = 'A'; 
    foreach($headings as $heading) { 
	$objPHPExcel->getActiveSheet()-> setCellValueExplicit( $col.$rowNumber,$heading, PHPExcel_Cell_DataType::TYPE_STRING); 
       $col++; 
    } 


$Count = 1;
$rowCount = 2; 

while($row = mysql_fetch_array($result)){ 

$payment_mode = mysql_query("SELECT *  FROM " .TABLE_HMS_PAYMENT_DETAIL. " where bill_no='".$row["bill_id"]."'");       
$table_data  = mysql_fetch_array($payment_mode);

$acc_query3 = "SELECT sum(order_amount) as total FROM ".TABLE_HMS_RESTAURANT_ORDER_DETAILS." WHERE bill_id='".trim($row["bill_id"])."' ";	
              $acc_query_result3 = mysql_query($acc_query3);
             $acctdetails3 = mysql_fetch_array($acc_query_result3);   

$acc_query3 = "SELECT sum(vat_amount) as vat FROM ".TABLE_HMS_RESTAURANT_ORDER_DETAILS." WHERE bill_id='".trim($row["bill_id"])."' ";	
              $acc_query_result3 = mysql_query($acc_query3);
             $sum_vat = mysql_fetch_array($acc_query_result3);  

$acc_query3 = "SELECT sum(service_amount) as ser FROM ".TABLE_HMS_RESTAURANT_ORDER_DETAILS." WHERE bill_id='".trim($row["bill_id"])."' ";	
              $acc_query_result3 = mysql_query($acc_query3);
             $sum_ser = mysql_fetch_array($acc_query_result3); 
            
              $disc=$row["discount"];
                 
                   if($disc !=""){                          
                     $discount_amount=$row["total_amount"]*($disc/100.0);    
                    $total_amount= round($row["total_amount"])-$discount_amount;                           
                   }
                   
                   else {
                       
                      $total_amount= round($row["total_amount"]);                      
                   }
                
        $date = explode('-',$row['orde_close_date']);  
        $date1=$date[2]."-".$date[1]."-".$date[0]; 		

    $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount,$Count); 

    $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount,$row['bill_id']); 
	
	$objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount,$date1); 

    $objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount,$sum_vat['vat']); 
	
	$objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount,$sum_ser['ser']); 
	
	$objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount,$total_amount); 
   
    $rowCount++; 
	$Count++;
} 

header('Content-Type: application/vnd.ms-excel'); 
header('Content-Disposition: attachment;filename="Results.xls"'); 
header('Cache-Control: max-age=0'); 
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5'); 
$objWriter->save('php://output'); */
}

?> 