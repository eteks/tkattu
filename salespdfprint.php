<?php
require_once ("includes/application_top.php");
include('fpdf/html2pdf.class.php');
session_start();

 $from=$_REQUEST['from'];
  $to =$_REQUEST['to'];
 //$id = 'MjAwMTg=';
 //$html = html_entity_decode(file_get_contents(''.$http_server.'salespdfprint.php?from='.$from.'&to='.$to.''));

//echo "<script type='text/javascript'>alert('$http_server');</script>";
  $html = html_entity_decode(file_get_contents('http://localhost/restaturant/saler_report_pdf.php?from='.$from.'&to='.$to.''));
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