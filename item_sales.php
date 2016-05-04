<?php
require_once ("includes/application_top.php");
session_start();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script src="js/jquery-latest.min.js"type="text/javascript"></script>
<script src="js/jquery-1.8.3.min.js" type="text/javascript"></script>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>:: ATOMICKA ~ Hotel Management System ::</title>
<style type="text/css">
<!--
.style1 {font-size: 12px; font-style: normal; line-height: normal; font-variant: normal; text-transform: none; color: #000000; text-decoration: none; font-family: Verdana, Arial, Helvetica, sans-serif;}
.style2 {color: #FF0000}
-->
</style>

<script language="JavaScript" type="text/javascript" src="js/inventory.js"></script>
<style type="text/css" media="print">    
.nonprintable

    {
      display: none;
    }  
    #vendorListResult
    {
            display:table;
            }

    </style>

</head>

<body>

<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF">
  <tr>
    <th width="29" align="left" valign="middle" background="images/left_bg.jpg" scope="col">
        <img src="images/left_bg.jpg" width="29" height="20" />
    </th>
    <th width="942" align="center" valign="top" scope="col">
        <table width="942" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><table width="95%" align="center" cellpadding="0" cellspacing="0" class="tableborder">
			
          <tr>
            <td width="100%" height="30" align="center" valign="middle" class="verdanablack"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <th><span  id="error_service" style="display:none;background-color:#EC8F82;border:solid 1px #FF0000;" ></span></th>
                </tr>

              <tr>
                <th height="30" bgcolor="#D7DBB0" class="style1" scope="col">Item Sales Report</th>
                </tr>
              </table></td>
            </tr>
          <tr>
            <td width="100%" height="30" align="center" valign="middle" class="verdanablack">
                <table width="100%" border="0" align="center" cellpadding="10" cellspacing="10" bgcolor="#FFFFFF">
              
              <tr class="tableborder">
                <td height="17" colspan="6" align="right" valign="middle" class="verdanablack">&nbsp;</td>
                </tr>
             
              <tr class="tableborder">
                  <td width="39%" align="right" valign="middle" class="verdanablack"><label>Item Name:</label></td>                  
                  <td width="35%" align="left" valign="middle" class="verdanablack">
 <select  style="width:125px;" name="main_menu_id" id="main_menu_id" >
<option  value="0">Select</option>
<option  value="All">All</option>

 <?php
$item_fetch_singrec_sql =  "SELECT  distinct order_product  FROM " . TABLE_HMS_RESTAURANT_ORDER_DETAILS. " ";
//echo $item_fetch_singrec_sql;

$item_sing_records = db_query ($item_fetch_singrec_sql);
if ($item_sing_records > 0) {
while ($hms_info_values1 = db_fetch_array($item_sing_records)) {	
?>
    
<option value="<?php echo $hms_info_values1['order_product']; ?>"> <?php echo $hms_info_values1['order_product']; ?> </option>
	  
 <?php   } }  ?>	
	
</select></td>

                </tr>
              
              <tr class="tableborder">
                  <td align="right" valign="middle" class="verdanablack" align="right" width="45%">From:</td>
                  <td align="left" valign="middle" class="verdanablack">
<input name="ddDateFrom" id="ddDateFrom" class="inputCopy1" type="text" tabindex="19" size='16' value=""/><img src="images/Calendar New.jpg" width="16" height="16" style="cursor:pointer" onclick="return showCalendar('ddDateFrom','%Y-%m-%d',24, true);" /></td>
                </tr>
                
                <tr class="tableborder">
                 <td align="right" valign="middle" class="verdanablack" align="right" width="45%">To:</td>
                  <td align="left" valign="middle" class="verdanablack">
<input name="ddDateTo" id="ddDateTo" type="text" tabindex="20" class="inputCopy1" size='16' value=""/><img src="images/Calendar New.jpg" width="16" height="16" style="cursor:pointer" onclick="return showCalendar('ddDateTo','%Y-%m-%d',24, true);" /></td>
                  <td align="center" valign="middle" class="verdanablack">&nbsp;</td>
                </tr>
                
                
              <tr class="tableborder">
  <td align="center" valign="middle" class="verdanablack">&nbsp;</td>
                  <td align="center" valign="middle" class="verdanablack">
                  <a href="javascript:void(0);" Onclick="Javascript:return getItemList();" class="submenu" > Show</a></td>
                  <td align="center" valign="middle" class="verdanablack">&nbsp;</td>

                </tr>
                
                
                 <tr class="tableborder">
                  <td align="center" valign="middle" class="verdanablack">&nbsp;</td>
                  <td align="center" valign="middle" class="verdanablack">&nbsp;</td>

                </tr>
                
               
              </table>
             
              
                 <div id="vendorListResult">
                
                </div>
              
              </td>
            </tr>
        </table></td>
      </tr>
      
     
    </table></th>
    <th width="29" background="images/rightline.jpg" scope="col">&nbsp;</th>
  </tr>
  <tr>
    <th height="14" align="left" valign="middle" scope="col"><img src="images/left_bottom_corner.jpg" width="29" height="14" /></th>
    <td align="center" valign="middle" background="images/bottomline.jpg" bgcolor="#FFFEFF"><img src="images/bottomline.jpg" width="7" height="14" /></td>
    <th scope="col"><img src="images/right_bottom_corner.jpg" width="29" height="14" /></th>
  </tr>
</table>

</body>
</html>