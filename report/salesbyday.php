<?php
include("includes/applicationTop.php");
//print_R($_GET);
//session_unregister("report_values");
$crnt_date = date("Y-m-d");


/*if ($_GET["a"]=="table") {
echo $select_acct      = "SELECT *   FROM ".TABLE_ACCOUNT_DETAILS." WHERE act_table !='NULL'  ";
}*/


if ($_GET["a"]=="day") {
 $select_acct      = "SELECT *   FROM ".TABLE_ACCOUNT_DETAILS." WHERE act_date1 = '" . $crnt_date  . "'  ";
}

 if ($_GET["a"]=="order") {
  $select_acct      = "SELECT *   FROM ".TABLE_ACCOUNT_DETAILS." WHERE act_order_type  !='0'  "; 
 } 

 if ($_GET["a"]=="payment") {
  $select_acct      = "SELECT *   FROM ".TABLE_ACCOUNT_DETAILS." WHERE act_payment_type  !='0'  "; 
 } 

 if ($_GET["a"]=="cashier") {
  $select_acct      = "SELECT *   FROM ".TABLE_ACCOUNT_DETAILS." WHERE (act_userrole  ='1' OR act_userrole = '5' )"; 
 } 


 if ($_GET["a"]=="client") {
  $select_acct      = "SELECT *   FROM ".TABLE_ACCOUNT_DETAILS." WHERE act_clienttype  !='0'  "; 
 } 
 
 
 

 //} 
   
 
 if ($_GET["a"]=="week") {
 
 
 		$checkdate = explode("-",$crnt_date);
		$year  = $checkdate[0];
		$month = $checkdate[1];
		$dat   = $checkdate[2];
        $Nextdate = mktime(0, 0, 0, $month, $dat -7, $year);
        $nextcheckdate  = date("Y-m-d", $Nextdate);
      // $nextcheck= date("Y")."-".(date("m")+1)."-04";

   $select_acct ="SELECT * FROM ". TABLE_ACCOUNT_DETAILS." WHERE (act_date1 BETWEEN '" . $nextcheckdate . "' AND '" . $crnt_date . "') ";
 
 //   $select_userdetails ="SELECT * FROM ". TABLE_ACCOUNT_DETAILS." WHERE ( act_date BETWEEN '" . $_GET["fromdate"] . "' AND '" . $_GET["todate"] . "' AND sms_from_id='".$_SESSION["user_id"]."'  ) ";

   
 } 
 
 
 if ($_GET["a"]=="month") {
 
 		$checkdate = explode("-",$crnt_date);
		$year  = $checkdate[0];
		$month = $checkdate[1];
		$dat   = $checkdate[2];
        $Nextdate = mktime(0, 0, 0, $month, $dat -30, $year);
        $nextcheckdate  = date("Y-m-d", $Nextdate);
 
   $select_acct ="SELECT * FROM ". TABLE_ACCOUNT_DETAILS." WHERE (act_date1 BETWEEN '" . $nextcheckdate . "' AND '" . $crnt_date . "') ";
 } 

//echo $select_acct = "SELECT * FROM ".TABLE_ACCOUNT_DETAILS." WHERE MONTH(2009-02-23) = MONTH(".$crnt_date.")";

$select_acct_result = dbQuery($select_acct); 	

?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tr>
<th scope="row"><img src="images/seperator.jpg" width="8" height="8" /></th>
<th scope="row"><table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
  <tr>
    <th scope="row"><table width="100%" border="0" align="left" cellpadding="0" cellspacing="0" >
        <tr>
          <th width="7" align="left" valign="bottom" scope="row"><img src="images/left_top_corner.jpg" width="7" height="7" /></th>
          <td width="1356" class="tablebordertop"></td>
          <td width="8" align="right" valign="bottom"><img src="images/right_top_corner.jpg" width="8" height="7" /></td>
        </tr>
        <tr>
          <th height="191" colspan="3" valign="top" class="tableborderleft" scope="row"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td><img src="images/box.gif" width="25" height="25" /></td>
                  <td width="89%" align="left" valign="top"><table width="100%" border="0" align="left" cellpadding="0" cellspacing="0" class="tablebordergrey">
                    <tr class="tablebordergrey">
                      <th width="1%" align="left" valign="middle" class="verdanabold" scope="row"><img src="images/seperator.jpg" width="8" height="8" /></th>
                      <th width="50%" height="22" align="left" valign="middle" class="verdanabold" scope="row">Table</th>
                      <th width="50%" height="22" align="left" valign="middle" class="verdanabold" scope="row">Total</th>
                      </tr>
				  <?php
				
                 if(dbNumRows($select_acct_result)>0) {
				  $color1 = "#FFFFFF"; 
				  $color2 = "#EEEEEE"; 
				  $row_count = "0"; 
				   $i = 0 ;
                   while ($resultAcct = dbFetchArray($select_acct_result)) {
				  //  print_R($resultAcct);
					
					 $ordertype= dbQuery("SELECT  * FROM " . TABLE_ORDER_TYPES . "  WHERE order_type_id_pk='" . $resultAcct["act_order_type"] . "'");
					 $resultOrder = dbFetchArray($ordertype);
  //    echo "SELECT  * FROM " . TABLE_PAYMENT_DETAILS . "  WHERE payment_methodid_pk='" . $resultAcct["payment_methodid_pk_fk"] . "'";
					 $paymenttype= dbQuery("SELECT  * FROM " . TABLE_PAYMENT_DETAILS . "  WHERE payment_methodid_pk='" . $resultAcct["act_payment_type"] . "'");
					 $resultPayment = dbFetchArray($paymenttype);
                     $clienttype= dbQuery("SELECT  * FROM " . TABLE_CLIENT_DETAILS . "  WHERE clientid='" . $resultAcct["act_clienttype"] . "'");
					 $resultClient = dbFetchArray($clienttype);
					
				     $row_color = ($row_count % 2) ? $color1 : $color2; 
				     $_SESSION['report_values'][$i][0] = $resultAcct["act_total"];
				     $_SESSION['report_values'][$i][2] = $resultAcct["act_table"];
				     $_SESSION['report_values'][$i][4] = $resultOrder["order_type_name"];
				     $_SESSION['report_values'][$i][6] = $resultPayment["payment_through"];
				     $_SESSION['report_values'][$i][8] = $resultClient["client_firstname"];
					 
					 
					 
                  ?>  
                    <tr bgcolor="<?php echo $row_color; ?>">
                      <th align="left" valign="middle"  class="verdanablack" scope="row">&nbsp;</th>
                      <th height="22" align="left" valign="middle"  class="verdanablack" scope="row">
                      <?php 
					  
					     if (!empty($resultAcct["act_table"])) {
					        echo $resultAcct["act_table"]; 
						 } else {
						   echo "-";
						 }					  
					  
					 ?></th>                      
                     <th height="22" align="left" valign="middle"  class="verdanablack" scope="row">
					   <?php
					        echo $resultAcct["act_total"]; 
						 ?></th>
					  </td>
                    </tr>
                  <?php
				    $row_count++;
					 $i = $i+1;
					
				    }
					 $_SESSION['report_header']=array("Total","Table","Order","Payment","Client"); 
					 if((!isset($_POST["go_x"])) &&(empty($_POST["searchtext"]))&&(empty($_GET["searchtext"]))){
				  ?>
                    <tr>
                      <td colspan="5" align="right"><? echo $obj->anchors; ?></td>
                    </tr>                  
                  <?	
					 }
				   } else {	
				   
				   
				  ?>  
                    <tr>
                      <td align="center" valign="middle" class="verdanablack" colspan="4">&nbsp;</td>
                    </tr>

                    <tr>
                      <td align="center" valign="middle" class="verdanablack" colspan="4"><font color="red"><strong> No Reports Available </strong></font></td>
                    </tr>
                  <?php
				    }
				  ?>                  
                    <tr>
                      <th align="left" valign="middle" scope="row">&nbsp;</th>
                      <th height="22" align="center" valign="middle" scope="row" colspan="2"> <a href="export_report.php?fn=member_report"> <img src="images/xcomma.gif" border="0"></a> </th>
                      <td align="left" valign="middle">&nbsp;</td>
                    </tr>
                  </table></td>
                  <td width="9%" valign="top">&nbsp;</td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
          </table></th>
        </tr>
        <tr>
          <th align="left" valign="bottom" scope="row"><img src="images/left_bottom_corner.jpg" width="7" height="9" /></th>
          <td valign="bottom" background="images/box_bottom_gradient.jpg"></td>
          <td width="8" align="right" valign="bottom"><img src="images/right_bottom_corner.jpg" width="8" height="9" /></td>
        </tr>
    </table></th>
    <th scope="row"><img src="images/seperator.jpg" width="8" height="8" /></th>
  </tr>
</table></th>
</tr>
</table>
<?php
    session_unregister("values");
    session_unregister("error");

?>