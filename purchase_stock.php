<?php
require_once ("includes/application_top.php");
session_start();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<script src="js/jquery.js"type="text/javascript"></script>


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


</head>

<body>

<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
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
                <th height="30" bgcolor="#D7DBB0" class="style1" scope="col">Stock Information</th>
                </tr>
              </table></td>
            </tr>
          <tr>
            <td width="100%" height="30" align="center" valign="middle" class="verdanablack"><table width="100%" border="0" align="center" cellpadding="2" cellspacing="1" bgcolor="#FFFFFF">
              
              <tr class="tableborder">
                <td height="17" colspan="6" align="right" valign="middle" class="verdanablack">&nbsp;</td>
                </tr>
             
             
              <tr class="tableborder">
                <td height="40" align="right" valign="middle" class="verdanablack">&nbsp;</td>
                  <td align="right" valign="middle" class="verdanablack">&nbsp;</td>
                  <td align="right" valign="middle" class="verdanablack">Item Name :</td>
                  <td align="left" valign="middle" class="verdanablack">     
                  <select  style="width:125px;" name="item_name_id" id="item_name_id" >
<option  value="">Select</option>
<option  value="All">All</option>

    <?php
	 $item_type_fetch_sql =  "SELECT *  FROM " . TABLE_HMS_ITEM_ENTRY. " ";	
         $item_type_records = db_query ($item_type_fetch_sql);
         if ($item_type_records > 0) {
	 while ($hms_info_item_values = db_fetch_array($item_type_records)) {	
    ?>
    
	<option value="<?php echo $hms_info_item_values['item_entry_id']; ?>"> <?php echo $hms_info_item_values['item_entry_name']; ?> </option>
	
      <?php
      } }
      ?>
	
	
</select>
                  
                  
                  </td>
                  <td align="left" valign="middle" class="verdanablack">&nbsp;</td>
                  <td width="1%" align="left" valign="middle" class="verdanablack">&nbsp;</td>
                </tr>
              
                
                
              <tr class="tableborder">
                <td height="40" align="right" valign="middle" class="verdanablack">&nbsp;</td>
                  <td align="center" valign="middle" class="verdanablack">&nbsp;</td>
                  <td align="center" valign="middle" class="verdanablack">&nbsp;</td>
                  
    	<td align="center" valign="middle" class="verdanablack">
        <a href="javascript:void(0);" Onclick="Javascript:return getVendorList(), getstockreport();" class="submenu"> Show</a>
        </td>
                  <td align="center" valign="middle" class="verdanablack">&nbsp;</td>
                  <td align="center" valign="middle" class="verdanablack">&nbsp;</td>
                </tr>
                
                
                 <tr class="tableborder">
                <td height="40" align="right" valign="middle" class="verdanablack">&nbsp;</td>
                  <td align="center" valign="middle" class="verdanablack">&nbsp;</td>
                  <td align="center" valign="middle" class="verdanablack">&nbsp;</td>
                  <td align="center" valign="middle" class="verdanablack">&nbsp;</td>
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
<img src="images/rightline.jpg" width="29" height="33" />
</form>
</body>
</html>