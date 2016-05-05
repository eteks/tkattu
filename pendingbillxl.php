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

//echo $FromDate;
//echo $ToDate;
//exit;

$cancel_list_sqls = "SELECT *  FROM " . TABLE_HMS_RESTAURANT_ACCOUNT_DETAILS. " where orde_close_date BETWEEN '$FromDate' AND '$ToDate' AND status='close' AND bill_status='pending' order by bill_id ASC";  
$cancel_list_recordss = db_query ($cancel_list_sqls);                                                      

$count = mysql_num_fields($cancel_list_recordss);
    
//$header ="S.No\tBILL NO\tCus-Name\tDATE\tTotal Amount\tPaid Amount\tPending Amount";	


$headings = array('S.No','BILL NO','Cus-Name','DATE','Total Amount','Paid Amount','Pending Amount'); 

  $objPHPExcel = new PHPExcel(); 
    $objPHPExcel->getActiveSheet()->setTitle('result'); 

    $rowNumber = 1; 
    $col = 'A'; 
    foreach($headings as $heading) { 
	$objPHPExcel->getActiveSheet()-> setCellValueExplicit( $col.$rowNumber,$heading, PHPExcel_Cell_DataType::TYPE_STRING); 
       $col++; 
    } 
  
//$num = mysql_num_rows($cancel_list_recordss);
 $rowCount = 2; 
 $Count= 1; 
while($row = mysql_fetch_assoc($cancel_list_recordss))
{  
$payment_details = db_query("SELECT name,total_amount,sum(paid_amount) as p_amount FROM " .TABLE_HMS_CREDIT_PAYMENT_DETAIL. " where credit_bill_id='".$row["bill_id"]."'");       
    while($payment_data  = db_fetch_array($payment_details)){
        
        $name=$payment_data['name'];
        $paid=$payment_data['p_amount'];
    }  

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
         
     $pay_method = $table_data['payment_method'];
       
            if($pay_method=="cash"){      
                 $pay_amount=$table_data['cash_amount'];
            }
            if($pay_method=="card"){      
                 $pay_amount=$table_data['card_amount'];
            }
             if($pay_method=="cheque"){      
                 $pay_amount=$table_data['cheque_amount'];
            }
             if($pay_method=="online"){      
                 $pay_amount=$table_data['on_amount'];
            }
             if($pay_method=="cash-card"){      
                 $pay_amount=$table_data['cash_amount']+$table_data['card_amount'];
                // echo $pay_amount;
            }
            if($pay_method=="cash-cheque"){      
                 $pay_amount=$table_data['cash_amount']+$table_data['cheque_amount'];
            }
            if($pay_method=="cash-online"){      
                 $pay_amount=$table_data['cash_amount']+$table_data['on_amount'];
            }
            
             if($pay_method=="card-cheque"){      
                 $pay_amount=$table_data['card_amount']+$table_data['cheque_amount'];
            }
            if($pay_method=="card-online"){      
                 $pay_amount=$table_data['card_amount']+$table_data['on_amount'];
            }
            if($pay_method=="cheque-online"){      
                 $pay_amount=$table_data['cheque_amount']+$table_data['on_amount'];
            }
 
	
                
        $date = explode('-',$row['orde_close_date']); 
         $date1=$date[2]."-".$date[1]."-".$date[0];                
	
    $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $Count); 
	 $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, $row['bill_id']); 
	 $objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, $name); 
	 $objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount,  $date1); 
     $objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount,round($total_amount)); 
     $objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount,$paid); 	
$objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount, round($total_amount)-$paid); 		 
    $rowCount++; 
	$Count++;     

}

foreach(range('A','G') as $columnID) {
    $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
        ->setAutoSize(true);
}

$objPHPExcel->getActiveSheet()->getStyle("A1:G1")->getFont()->setBold(true);

$objPHPExcel->getActiveSheet()->getStyle("A1:G1")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
  
 $objPHPExcel->getActiveSheet()->getStyle(
    'A1:' . 
    $objPHPExcel->getActiveSheet()->getHighestColumn() . 
    $objPHPExcel->getActiveSheet()->getHighestRow()
)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
  
header('Content-Type: application/vnd.ms-excel'); 
header('Content-Disposition: attachment;filename="pendingbill_reportxls.xls"'); 
header('Cache-Control: max-age=0'); 
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5'); 
$objWriter->save('php://output');
}
?> 