<?php
$customerDetails = "SELECT hct.`customer_name` , hct.`customer_address` , hct.`customer_city`,hct.`customer_zip`,hct.`customer_state`,hct.`customer_country`,hct.customer_contact_no,hct.`customer_email_id`,hct.`customer_id_type`,hct.`customer_id_no`,hct.`customer_veh_no`,hct.`created_by`,hct.`created_on`,hbs.`customer_id`,hbs.`booking_no`,hbs.`checking_no`,hbs.`no_adults`,hbs.`no_child`,hbs.`room_type_id`,hbs.`rooms_id`,hbs.`no_of_rooms`,hbs.`no_of_days`,hbs.`advance_pay`,hbs.`total_amount`,hbs.`extra_bed`,hbs.`extra_bed_charge`,hbs.`balance_amount`,hbs.`rooms_no`,hbs.`payment_type`,hbs.`total_amount`, hbs.`nature_of_guest`,hbs.`discount`,hbs.`status`,hbs.`checkin_date`,hbs.`checkout_date`,hbs.`created_by`,
hbs.`created_on` ,hbs.`updated_on` FROM " . TABLE_HMS_CUSTOMER_TABLE . " as hct, " . TABLE_HMS_BOOKING_STATUS . "  as hbs WHERE hct.`customer_id` = hbs.`customer_id` AND hbs.`customer_id` = '". $_GET["id"] ."'";

$customerQuery = db_query($customerDetails);
$customerArray = db_fetch_array($customerQuery);

$roomSel = "SELECT `room_type_id`,`room_type_name`,`facility_id`,`bed_size`,`charge`,`note`,`active`,`date_added`,`date_modified` FROM " . TABLE_HMS_ROOM_TYPE_CREATION . " WHERE `room_type_id` = '" .$customerArray["room_type_id"]."'";

$roomquery=db_query($roomSel);
$roomArray=db_fetch_array($roomquery);

$paySel= "SELECT `payment_mode_id`,`payment_mode`,`active`,`date_added`,`date_modified` FROM " . TABLE_HMS_PAYMENT_MODE . " WHERE `payment_mode_id` = '" .$customerArray["payment_type"]."'";

$payquery=db_query($paySel);
$payArray=db_fetch_array($payquery);

$checkindate =  explode('-',$customerArray["checkin_date"]);
$date =  $checkindate[2] . "-" . $checkindate[1]. "-" . $checkindate[0];

$checkoutdate =  explode('-',$customerArray["checkout_date"]);
$date1 =  $checkoutdate[2] . "-" . $checkoutdate[1]. "-" . $checkoutdate[0];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>:: ATOMICKA ~ Hotel Management System ::</title>
<style type="text/css">
<!--
.style1 {font-size: 12px; font-style: normal; line-height: normal; font-variant: normal; text-transform: none; color: #000000; text-decoration: none; font-family: Verdana, Arial, Helvetica, sans-serif;}
-->
</style>

</head>

<body>
<form name="reser" id="reser" action="">
<table width="680" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#FFFFFF">
  <tr>
    <th width="29" align="left" valign="middle" background="images/left_bg.jpg" scope="col">&nbsp;</th>
    <th width="680" align="center" valign="top" scope="col">
      <table width="680" border="0" cellspacing="0" cellpadding="0">
      
      <tr>
        <td align="center"><table width="100%" align="center" cellpadding="0" cellspacing="0" border="1" class="tableborder">
          <tr>
            <td width="100%" height="30" align="center" valign="middle" class=""><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <th><span  id="error_service" style="display:none;background-color:#EC8F82;border:solid 1px #FF0000;" ></span></th>
              </tr>
              <tr>
                <th height="30" bgcolor="#D7DBB0" class="style1" scope="col">Customer Details</th>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td width="100%" height="30" align="center" valign="middle" class=""><table width="100%" border="0" align="center" cellpadding="2" cellspacing="1" bgcolor="#FFFFFF">
              <tr class="tableborder">
               <?php if($_GET["status"]=="C"){
	   ?>
    <td colspan="3"  align="center" valign="middle" height="42" bgcolor="#D7DBB0" class="tahoma12blackbold">Checkin No 
      <?php  echo $customerArray["checking_no"]; ?></td>
    <td colspan="3" align="center" valign="middle" bgcolor="#D7DBB0" class="tahoma12blackbold">Checkin  Date 
      <?php  echo $date; ?></td>
    <?php
		}
		else if($_GET["status"]=="B")
	   {
	   ?>
    <td colspan="3" height="42" align="center" valign="middle" bgcolor="#D7DBB0" class="tahoma12blackbold">Booking No 
      <?php  echo $customerArray["booking_no"]; ?></td>
    <td colspan="3" align="center" valign="middle" bgcolor="#D7DBB0" class="tahoma12blackbold">Booking Date  <?php echo date('d-m-Y'); ?></td>
    <?php 
		}
		else 
		{
		?>
    <td colspan="3" height="42" align="center" valign="middle" bgcolor="#D7DBB0" class="tahoma12blackbold">Booking No 
      <?php  echo $customerArray["booking_no"]; ?></td>
    <td width="10%" colspan="3"  align="center" valign="middle" bgcolor="#D7DBB0" class="tahoma12blackbold">Booking Cancel  <?php echo $customerArray["updated_on"];  ?></td>
    <?php 
		}
		?>
              </tr>

              <tr class="tableborder">
                <td width="14%" height="40" align="left" valign="middle" class="style1"> <b>Name </b></td>
                <td width="6%" align="left" valign="middle" class=""><span class=" "><?php if ($customerArray["customer_name"]== ""){ echo "- -";} else{ echo $customerArray["customer_name"];}?></span></td>
                
                <td width="14%" align="left" valign="middle" class=""> <b>Phone No </b></td>
                <td width="7%" align="left" valign="middle" class=""><span class="tahoma11blacknormal"><?php if ($customerArray["customer_contact_no"]== ""){ echo "- -";} else { echo $customerArray["customer_contact_no"];}?></span></td>
                
                <td width="15%" align="left" valign="middle" class=""><b> No of Rooms </b></b></td>
                <td width="7%" align="left" valign="middle" class=""><span class="tahoma11blacknormal"><?php if ($customerArray["no_of_rooms"]== ""){ echo "- -";} else { echo $customerArray["no_of_rooms"];}?></span></td>
              </tr>
              <tr class="tableborder">
                <td height="40" align="left" valign="middle" class=""><b>Address </b></td>
                <td align="left" valign="middle" class=""><span class="tahoma11blacknormal"><?php echo $customerArray["customer_address"];?></span></td>
                <td align="left" valign="middle" class="tahoma11blackbold"><b>Email ID </b></td>
                <td align="left" valign="middle" class=""><span class="tahoma11blacknormal"><?php if ($customerArray["customer_email_id"]== ""){ echo "- -";} else { echo $customerArray["customer_email_id"];}?></span></td>
                <td align="left" valign="middle" class=""><b>No of Adults </b></td>
                <td align="left" valign="middle" class=""><span class="tahoma11blacknormal"><?php echo $customerArray["no_adults"];?></span></td>
              </tr>
              <tr class="tableborder">
                <td height="40" align="left" valign="middle" class=""><b>City</b></td>
                <td align="left" valign="middle" class=""><span class="tahoma11blacknormal"><b></b><?php echo $customerArray["customer_city"];?></span></td>
                <td align="left" valign="middle" class=""><b>ID Type </b></td>
                <td align="left" valign="middle" class=""><span class="tahoma11blacknormal">
                  <?php 
                   
                     $IDType_Array = count($IDTypeArray);
                     for( $IDType=0; $IDType<$IDType_Array; $IDType++ ) { 
                     	if($customerArray['customer_id_type'] == $IDTypeArray[$IDType]['id']) 
						{
						if ($IDTypeArray[$IDType]["text"]=="Select")
						{
						 echo "- -";
						 }
						 else
						 {
					 		echo $IDTypeArray[$IDType]["text"];
							}
							}
					 } 
			?>
                </span></td>
                <td align="left" valign="middle" class=""> <b>No of Children </b></td>
                <td align="left" valign="middle" class=""><span class="tahoma11blacknormal"><?php if ($customerArray["no_child"]== "0"){ echo "- -";} else { echo $customerArray["no_child"];}?></span></td>
              </tr>
              <tr class="tableborder">
                <td height="39" align="left" valign="middle" class=""><b>State</b></td>
                <td align="left" valign="middle" class=""><span class="tahoma11blacknormal"><b></b><?php echo $customerArray["customer_state"];?></span></td>
                <td align="left" valign="middle" class=""><b>ID No </b></td>
                <td align="left" valign="middle" class=""><span class="tahoma11blacknormal" style="padding-left:3px">
                  <?php if ($customerArray["customer_id_no"]== ""){ echo "- -";} else { echo $customerArray["customer_id_no"];}?>
                </span></td>
                <td align="left" valign="middle" class=""><b>No of Extra Bed </b></td>
                <td align="left" valign="middle" class=""><span class="tahoma11blacknormal">
                  <?php if ($customerArray["extra_bed"]== "0"){ echo "- -";} else { echo $customerArray["extra_bed"];}?>
                </span></td>
              </tr>
              <tr class="tableborder">
                <td height="40" align="left" valign="middle" class=""><b>Country </b></td>
                <td align="left" valign="middle" class=""><span class="tahoma11blacknormal">
                  <b></b>
                  <?php 
                     $country_Array = count($countryArray);
                     for( $country=0; $country<$country_Array; $country++ ) { 
                       		if($customerArray["customer_country"] == $countryArray[$country]['id'])
					 			echo $countryArray[$country]['text'];
					 } ?>
                </span></td>
                <td align="left" valign="middle" class=""><b>Vehicle No </b></td>
                <td align="left" valign="middle" class=""><span class="tahoma11blacknormal" style="padding-left:3px">
                  <?php if ($customerArray["customer_veh_no"]== ""){ echo "- -";} else { echo $customerArray["customer_veh_no"];}?>
                </span></td>
                <td align="left" valign="middle" class=""><b>Extra Bed Charge</b></td>
                <td align="left" valign="middle" class=""><span class="tahoma11blacknormal"><?php if ($customerArray["extra_bed_charge"]== "0.00"){ echo "- -";} else { echo $customerArray["extra_bed_charge"];}?> </span></td>
              </tr>
              <tr class="tableborder">
                <td height="41" align="left" valign="middle" class=""><b>Pincode </b></td>
                <td align="left" valign="middle" class=""><span class="tahoma11blacknormal"><b></b><?php echo $customerArray["customer_zip"];?></span></td>
                <td align="left" valign="middle" class=""><b>Nature of Guest </b></td>
                <td align="left" valign="middle" class=""><span class="">
                  <?php 
if( $customerArray["nature_of_guest"] != "0" && $customerArray["nature_of_guest"] != "" ) {
	$CHECKIN_Array = count($CHECKINTypeArray);
	for( $IDType=0; $IDType<$CHECKIN_Array; $IDType++ ) { 
		if ($customerArray["nature_of_guest"] == $CHECKINTypeArray[$IDType]['id']) {
			echo $CHECKINTypeArray[$IDType]['text'];
		}					   
	} 
} else { 
 echo "--"; } ?>
                </span></td>
                <td align="left" valign="middle" class=""><b>No of Days </b></td>
                <td align="left" valign="middle" class=""><span class="tahoma11blacknormal" style="padding-left:5px"><?php echo $customerArray["no_of_days"];?></span></td>
               </tr>
               
                <tr class="tableborder">
                <td height="41" align="left" valign="middle" class=""><b>Check In Date</b></td>
                <td align="left" valign="middle" class=""><span class="tahoma11blacknormal" style="padding-left:5px"><b></b><?php echo $date;?></span></td>
                <td align="left" valign="middle" class=""><b>Check Out Date </b></td>
                <td align="left" valign="middle" class=""><span class="tahoma11blacknormal" style="padding-left:5px"><?php echo $date1;?></span></td>
                <td align="left" valign="middle" class=""><b>Discount(%) </b></td>
                <td align="left" valign="middle" class=""><span class="tahoma11blacknormal">
                  <?php if ($customerArray["discount"]== "0"){ echo "- -";} else { echo $customerArray["discount"];}?>
                </span></td>
               </tr>
                 <tr class="tableborder">
                <td height="41" align="left" valign="middle" class=""><b>Room Type</b></td>
                <td align="left" valign="middle" class=""><span class="tahoma11blacknormal" style="padding-left:5px"><b></b><span class="tahoma11blacknormal" style="padding-left:3px">
                  <?php if ($roomArray["room_type_name"]==""){ echo "--";} else {  echo $roomArray["room_type_name"];}?>
                </span></span></td>
                <td align="left" valign="middle" class=""><b>Payment Type </b></td>
                <td align="left" valign="middle" class=""><span class="tahoma11blacknormal" style="padding-left:5px"><?php echo $payArray["payment_mode"];?></span></td>
                <td align="left" valign="middle" ><b>Room No </b></td>
                <td align="left" valign="middle" ><span class="tahoma11blacknormal" style="padding-left:5px"><?php echo $customerArray["rooms_no"];?></span></td>
               </tr>
                 <tr class="tableborder">
                <td height="41" align="left" valign="middle" class=""><b>Total Amount </b></td>
                <td align="left" valign="middle" class=""><span class="tahoma11blacknormal" style="padding-left:3px"><b></b><?php echo $customerArray["total_amount"];?></span></td>
                <td align="left" valign="middle" class=""><b>Advance Amount </b></td>
                <td align="left" valign="middle" class=""><span class="tahoma11blacknormal">
                  <?php if ($customerArray["advance_pay"]== "0"){ echo "- -";} else { echo $customerArray["advance_pay"];}?>
                </span></td>
                <td align="left" valign="middle" class="vernabold"><b>Balance Amount </b></td>
                <td align="left" valign="middle" class=""><span class="tahoma11blacknormal" style="padding-left:3px"><?php if ($customerArray["balance_amount"]== "0"){ echo "- -";} else { echo $customerArray["balance_amount"];}?></span></td>
               </tr>
              
            </table></td>
          </tr>
        </table></td>
      </tr>
    </table></th>
    <th width="29" background="images/rightline.jpg" scope="col">&nbsp;</th>
  </tr>
</table>
</body>
</html>