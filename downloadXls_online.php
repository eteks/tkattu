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

$tax_list_sqls = "SELECT *  FROM " . TABLE_HMS_RESTAURANT_ACCOUNT_DETAILS. " where status='close' AND orde_close_date BETWEEN '$FromDate' AND '$ToDate'  order by bill_id ASC"; 
//echo $tax_list_sqls;
$tax_list_recordss = db_query ($tax_list_sqls);    
    
 $vat_amt_sqls = "SELECT sum(vat_amt) as v_amt  FROM " . TABLE_HMS_RESTAURANT_ACCOUNT_DETAILS. " where status='close' AND orde_close_date BETWEEN '$FromDate' AND '$ToDate'  order by bill_id ASC"; 
//echo $tax_list_sqls;
$vat_amt_recordss = db_query ($vat_amt_sqls); 
$vat_info_values_tax = db_fetch_array($vat_amt_recordss);
 
$ser_amt_sqls = "SELECT sum(service_amt) as s_amt  FROM " . TABLE_HMS_RESTAURANT_ACCOUNT_DETAILS. " where status='close' AND orde_close_date BETWEEN '$FromDate' AND '$ToDate'  order by bill_id ASC"; 
//echo $tax_list_sqls;
$ser_amt_recordss = db_query ($ser_amt_sqls); 
$ser_info_values_tax = db_fetch_array($ser_amt_recordss);
 
 
$val_amt_sqls = "SELECT sum(order_amount) as t_amt FROM ".TABLE_HMS_RESTAURANT_ORDER_DETAILS."  where status='close' AND order_open_date BETWEEN '$FromDate' AND '$ToDate'  order by bill_id ASC"; 
$val_amt_recordss = db_query($val_amt_sqls);
$val_info_values_tax = db_fetch_array($val_amt_recordss);  
                

 $tol_amt_sqls = "SELECT sum(total_amount) as total_amt FROM ".TABLE_HMS_RESTAURANT_ACCOUNT_DETAILS."  where status='close' AND orde_close_date BETWEEN '$FromDate' AND '$ToDate'  order by bill_id ASC"; 
 $tol_amt_recordss = db_query($tol_amt_sqls);
$tol_info_values_tax = db_fetch_array($tol_amt_recordss);  
 
    $d_amt_sqls = "SELECT sum(disc_amt) as discnt  FROM " . TABLE_HMS_RESTAURANT_ACCOUNT_DETAILS. " where status='close' AND orde_close_date BETWEEN '$FromDate' AND '$ToDate'  order by bill_id ASC"; 
//echo $tax_list_sqls;
$d_amt_recordss = db_query ($d_amt_sqls); 
 $d_info_values_tax = db_fetch_array($d_amt_recordss);

//$header ="S.NO\tPARTY\tBILL NO\tDATE\tG.VALUE\tTAX\tSERVICE TAX\tDISCOUNT\tT0TAL";	

$headings = array('S.NO','PARTY','BILL NO','DATE','G.VALUE','TAX','SERVICE TAX','DISCOUNT','TOTAL'); 

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
        
$acc_disc = "SELECT * FROM ".TABLE_HMS_RESTAURANT_ACCOUNT_DETAILS." WHERE bill_id='".trim($row["bill_id"])."' ";	
$acc_query = db_query($acc_disc);
$disc_data = db_fetch_array($acc_query);    
$disc=$row["total_amount"]*($disc_data["discount"]/100);
$total= round($row["total_amount"]-round($disc));
             
$date = explode('-',$row['orde_close_date']);   
 $date1=$date[2]."-".$date[1]."-".$date[0]; 	  	
		
	 $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $Count); 
	 $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, $table_data['payment_method']); 
	 $objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, $row['bill_id']); 
	 $objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, $date1); 
     $objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount,round($acctdetails3["total"],1)); 
     $objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount, $sum_vat['vat']); 	
     $objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount, $sum_ser['ser']); 
     $objPHPExcel->getActiveSheet()->SetCellValue('H'.$rowCount, round($disc)); 	
     $objPHPExcel->getActiveSheet()->SetCellValue('I'.$rowCount, $total); 	 	 
    $rowCount++; 
	$Count++;	
		
}   
//$objPHPExcel->getActiveSheet()->freezePane('A2');
 $objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount,round($val_info_values_tax['t_amt'],1));
  $objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount,$vat_info_values_tax['v_amt']);
   $objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount,$ser_info_values_tax['s_amt']);
    $objPHPExcel->getActiveSheet()->SetCellValue('H'.$rowCount,$d_info_values_tax['discnt']);
	  $ttt= round($tol_info_values_tax["total_amt"])-round($d_info_values_tax['discnt']);   
	 $objPHPExcel->getActiveSheet()->SetCellValue('I'.$rowCount,$ttt);
//$S->setCellValueExplicit('J'.$rowCount, round($val_info_values_tax['t_amt'],1));
  // $objPHPExcel->getActiveSheet()->getStyle(
  //  'A1:I1'
//)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
 
foreach(range('A','I') as $columnID) {
    $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
        ->setAutoSize(true);
}
 
$objPHPExcel->getActiveSheet()->getStyle("A1:I1")->getFont()->setBold(true);

$objPHPExcel->getActiveSheet()->getStyle("A1:I1")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

     $objPHPExcel->getActiveSheet()->getStyle(
    'A1:' . 
    $objPHPExcel->getActiveSheet()->getHighestColumn() . 
    $objPHPExcel->getActiveSheet()->getHighestRow()
)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);   

   header('Content-Type: application/vnd.ms-excel'); 
header('Content-Disposition: attachment;filename="tax_reportxls.xls"'); 
header('Cache-Control: max-age=0'); 
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5'); 
$objWriter->save('php://output');           
   
}
?> 