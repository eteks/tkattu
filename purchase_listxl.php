<?php
require_once ("includes/application_top.php");
require 'Classes/PHPExcel.php'; 
require_once 'Classes/PHPExcel/IOFactory.php';
//require_once ("sss.html");
session_start();

if($_POST['FromDate']!='' && $_POST['ToDate']!='' )
{
$vendor=$_POST['vendor'];
$FromDate=$_POST['FromDate'];
$ToDate=$_POST['ToDate'];

if($vendor=="All")
{
$aaa= "where status='1' AND date BETWEEN '$FromDate' AND '$ToDate'  order by pur_fck_id ASC";
}
else
{
$aaa= " where vendor_name ='$vendor' AND  status='1' AND date BETWEEN '$FromDate' AND '$ToDate'  order by pur_fck_id ASC";
}


$tax_list_sqls = "SELECT DISTINCT pur_fck_id FROM ".TABLE_HMS_PURCHASE_ORDER_DETAIL." $aaa ";  
//echo $tax_list_sqls;
$tax_list_recordss = db_query ($tax_list_sqls); 
//$count = mysql_num_fields($tax_list_recordss);

//$header ="S.No\tBILL NO\tDATE\tSupplier Name\tT0TAL";	

//$num = mysql_num_rows($tax_list_recordss);

$headings = array('S.No','BILL NO','DATE','Supplier Name','TOTAL'); 

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
 
   while($hms_info_values_tax = db_fetch_array($tax_list_recordss))
   {          
   $payment_mode = db_query("SELECT *  FROM " .TABLE_HMS_PURCHASE_ORDER_DETAIL. " where pur_fck_id='".$hms_info_values_tax["pur_fck_id"]."'");       
   $table_data  = db_fetch_array($payment_mode);
   
   $payment_total = db_query("SELECT sum(total_amount) as t_amount FROM " .TABLE_HMS_PURCHASE_ORDER_DETAIL. " where pur_fck_id='".$hms_info_values_tax["pur_fck_id"]."'");       
   $payment_t = db_fetch_array($payment_total);

      $date = explode('-',$table_data['date']);   
      $date1=$date[2]."-".$date[1]."-".$date[0];  
	  
	   $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $Count); 
	 $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, $hms_info_values_tax['pur_fck_id']); 
	 $objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, $date1); 
    $objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, $table_data['vendor_name']); 
	 $objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount, round($payment_t['t_amount'])); 
	 
   $rowCount++; 
	$Count++;  
   
                }
foreach(range('A','E') as $columnID) {
    $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
        ->setAutoSize(true);
}

$objPHPExcel->getActiveSheet()->getStyle("A1:E1")->getFont()->setBold(true);

 $objPHPExcel->getActiveSheet()->getStyle("A1:E1")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); 
 
 $objPHPExcel->getActiveSheet()->getStyle(
    'A1:' . 
    $objPHPExcel->getActiveSheet()->getHighestColumn() . 
    $objPHPExcel->getActiveSheet()->getHighestRow()
)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN); 
  
header('Content-Type: application/vnd.ms-excel'); 
header('Content-Disposition: attachment;filename="purchase_listxls.xls"');  
header('Cache-Control: max-age=0'); 
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');  
$objWriter->save('php://output');
}
?> 