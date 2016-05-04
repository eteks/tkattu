<?php 

require_once("include/configuration.inc");
 include('fpdf/html2pdf.class.php');
 $id =$_REQUEST['vai'];
 //$id = 'MjAwMTg=';
 $html = html_entity_decode(file_get_contents(''.$http_server.'apppdfprint.php?vai='.$id.''));

//echo "<script type='text/javascript'>alert('$http_server');</script>";
   //$html = html_entity_decode(file_get_contents('http://localhost/centaclive/apppdfprint.php?vai='.$id.''));
  try
    {
     $html2pdf = new HTML2PDF('P', 'A4', 'en', false, 'UTF-8'); // array(mL, mT, mR, mB))//, array(20, 10, 20, 10)
     $html2pdf->writeHTML($html);
     $html2pdf->Output('ApplicationForm'.'.pdf');
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }

?>