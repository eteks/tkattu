<?php
require_once ("includes/application_top.php");
include('fpdf/html2pdf.class.php');
session_start();

 $from=$_REQUEST['from'];
  $to =$_REQUEST['to'];
   $page =$_REQUEST['open'];
   $vendor=(isset($_REQUEST['vendor']) && !empty($_REQUEST['vendor']) ?  $_REQUEST['vendor']:"");
 //$id = 'MjAwMTg=';
 //$html = html_entity_decode(file_get_contents(''.$http_server.'tax_pdf_file.php?from='.$from.'&to='.$to.''));

//echo "<script type='text/javascript'>alert('$http_server');</script>";
   if($page=="tax_pdf")
   {
  $html = html_entity_decode(file_get_contents($http_server.'tax_pdf_file.php?from='.$from.'&to='.$to.''));
   }
   if($page=="cancel_pdf")
   {
     $html = html_entity_decode(file_get_contents($http_server.'Cancel_bill_list.php?from='.$from.'&to='.$to.'&open='.$page.''));
   }
   if($page=="pending_pdf")
   { 
  $html = html_entity_decode(file_get_contents($http_server.'pending_bill_list.php?from='.$from.'&to='.$to.'&open='.$page.''));
   }
   if($page=="purchase_pdf")
   { 
  $html = html_entity_decode(file_get_contents($http_server.'purchase_pdf.php?vendor='.$vendor.'&from='.$from.'&to='.$to.'&open='.$page.''));
   }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    
   
   try
    {
     $html2pdf = new HTML2PDF('P', 'A4', 'en', false, 'UTF-8'); // array(mL, mT, mR, mB))//, array(20, 10, 20, 10)
     $html2pdf->writeHTML($html);
     $html2pdf->Output('TaxReport'.'.pdf');
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }

?>