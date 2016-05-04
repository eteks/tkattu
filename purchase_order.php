<?php
require_once ("includes/application_top.php");
session_start();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

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
<script src="js/jquery-latest.min.js"type="text/javascript"></script>
<script src="js/jquery-1.8.3.min.js" type="text/javascript"></script>
<script src="js/jquery.js" type="text/javascript"></script>
<script>
/* window.onbeforeunload = function() {
    return"";
 };   */
</script>
</head>

<body>

<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
 <tr>
                
  <tr>
    <th width="29" align="left" valign="middle" background="images/left_bg.jpg" scope="col">
        <img src="images/left_bg.jpg" width="29" height="20" />
    </th>
    <th width="942" align="center" valign="top" scope="col">
       <table width="95%" align="center" cellpadding="0" cellspacing="0" class="tableborder">
			
          <tr>
            <td width="100%" height="30" align="center" valign="middle" class="verdanablack">
                
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <th><span  id="error_service" style="display:none;background-color:#EC8F82;border:solid 1px #FF0000;" ></span></th>
                </tr>

              <tr>
                <th height="30" bgcolor="#D7DBB0" class="style1" scope="col">Purchase Entry</th>
                </tr>
              </table></td>
            </tr>
            
          <tr>
            <td width="100%" height="30" align="center" valign="middle" class="verdanablack">
            
            <table width="99%" border="0" align="center" cellpadding="2" cellspacing="1" bgcolor="#FFFFFF">                
              <tr class="tableborder">
                <td height="17" colspan="6" align="right" valign="middle" class="verdanablack">&nbsp;</td>
                </tr>
                
                <th><span  id="error_service" style="display:none;background-color:#EC8F82;border:solid 1px #FF0000;" ></span></th>
                </tr>
             
              <tr class="tableborder">
                <td width="1%" height="40" align="right" valign="middle" class="verdanablack">&nbsp;</td>
                  <td width="1%" align="right" valign="middle" class="verdanablack"><label>&nbsp; </label></td>
                  <td width="21%" align="right" valign="middle" class="verdanablack"><label>Vendor Name : </label></td>
                  
                  <td width="24%" align="left" valign="middle" class="verdanablack"><input type="hidden" id="opsubmit" name="opsubmit" />
                  
<select onchange="getVendorDetails(this.value)"   style="width:125px;" name="main_menu_id" id="main_menu_id" >
<option  value="">Select</option>

    <?php
	 $item_fetch_singrec_sql =  "SELECT *  FROM " . TABLE_HMS_VENDOR_CREATION. " ";
    $item_sing_records = db_query ($item_fetch_singrec_sql);
	if ($item_sing_records > 0) {
	while ($hms_info_values1 = db_fetch_array($item_sing_records)) {	
	?>
    
	<option value="<?php echo $hms_info_values1['vendor_id']; ?>"> <?php echo $hms_info_values1['vendor_name']; ?> </option>
	
    <?php } } ?>	
        
	</select><input type="text" readonly style="width:125px;display:none;" name="main_menu_id_temp" id="main_menu_id_temp" ></select>
	</td>

<td width="10%" align="right" valign="middle" class="verdanablack">Date:</td>
                  <td width="16%" align="left" valign="middle" class="verdanablack"><input name="ddDateFrom" id="ddDateFrom" class="inputCopy1" type="text" tabindex="19" size='16' value=""/><img src="images/Calendar New.jpg" width="16" height="16" style="cursor:pointer" onclick="return showCalendar('ddDateFrom','%Y-%m-%d',24, true);" /> </td>                  
                </tr>
                

<tr class="tableborder">
<td height="40" rowspan="2" align="right" valign="middle" class="verdanablack">&nbsp;</td>
<td rowspan="2" align="right" valign="middle" class="verdanablack">&nbsp;</td>
<td rowspan="2" align="right" valign="middle" class="verdanablack">Vendor Details :</td>
<td rowspan="2" align="left" valign="middle" class="verdanablack">
<div id="vendor_item_type"><textarea style=" width:160px; height:60px;" id="vendor_details" name="vendor_details"></textarea></div>
</td>
<td height="69" align="left" colspan="2" rowspan="2" valign="middle" class="verdanablack"></td>
</tr>
              <tr class="tableborder">
              </tr>
              <tr class="tableborder">
                <td height="40" align="right" valign="middle" class="verdanablack">&nbsp;</td>
                  <td align="center" valign="middle" class="verdanablack">&nbsp;</td>
                 <td align="right" valign="middle" class="verdanablack">Item Name:</td>
                  <td align="left" valign="middle" class="verdanablack">
                  
<select onchange="getItemDetails(this.value)"   style="width:125px;
overflow-y: scroll;" name="item_menu_id" id="item_menu_id" >
<option  value="">Select</option>

    <?php
	 $item_fetch_singrec_sql1 =  "SELECT *  FROM " . TABLE_HMS_ITEM_ENTRY. " ";
	//echo $item_fetch_singrec_sql1;
	
    $item_sing_records1 = db_query ($item_fetch_singrec_sql1);
	if ($item_sing_records1 > 0) {
	while ($hms_info_values2 = db_fetch_array($item_sing_records1)) {	
	?>
    
	<option value="<?php echo $hms_info_values2['item_entry_id']; ?>"> <?php echo $hms_info_values2['item_entry_name']; ?> </option>
	
	  
      <?php   } }   ?>
	
</select>

</td> 
                 
                 <td colspan="4">
                     <div id="item_type">

</div>
                 </td>             
</tr>
            

                 
                 
                <tr class="tableborder">
                <td height="40" align="right" valign="middle" class="verdanablack">&nbsp;</td>
                  <td align="center" valign="middle" class="verdanablack">&nbsp;</td>
                 <td align="right" valign="middle" class="verdanablack">Quantity:</td>
                  <td align="left" valign="middle" class="verdanablack"><input type="text" id="item_quantity" name="item_quantity" style="width:100px;" />
</td>
                  <td align="right" valign="middle" class="verdanablack">Unit Price:</td>
                  <td align="left" valign="middle" class="verdanablack"><input type="text" id="item_unit_price" name="item_unit_price" style="width:100px;" onkeyup=" return calcTotalPrice()" /></td>
                  <td width="9%" align="right" valign="middle" class="verdanablack">Total Price:</td>
                  <td width="18%" align="left" valign="middle" class="verdanablack"><input type="text" id="item_total_price" name="item_total_price" style="width:100px;" /></td>
                </tr>
                
                
                 <tr class="tableborder">
                <td height="40" align="right" valign="middle" class="verdanablack">&nbsp;</td>
                  <td align="center" valign="middle" class="verdanablack">&nbsp;</td>
                 <td align="right" valign="middle" class="verdanablack">ReOrder Level:</td>
          <td align="left" valign="middle" class="verdanablack"><input type="text" id="reorderlevel" name="reorderlevel" style="width:100px;" /></td>                 
                </tr>
           
                
       <tr class="tableborder">
          <td height="40" align="right" valign="middle" class="verdanablack">&nbsp;</td>
          <td align="center" valign="middle" class="verdanablack">&nbsp;</td>
          <td align="right" valign="middle" class="verdanablack">Tax:</td>                 
          <td align="left" valign="middle" class="verdanablack">              
              <input type="text" id="tax" name="tax" style="width:100px;" onkeyup="Gettaxamt()"/>%  
         <input type="hidden" id="tax_amt" name="tax_amt" style="width:100px;"/>             
          </td>   
                 
          <td align="right" valign="middle" class="verdanablack">Purchase Tax:</td>
          <td align="left" valign="middle" class="verdanablack">
              <input type="text" id="purchase_tax" name="purchase_tax" onkeyup="Getpurchasetax()" style="width:100px;"/>%
         <input type="hidden" id="purchase_tax_amt" name="purchase_tax_amt" style="width:100px;"/>

          </td>    
          
            <td align="right" valign="middle" class="verdanablack">Discount:</td>            
          <td align="left" valign="middle" class="verdanablack">
              <input type="text" id="discount" name="discount" onkeyup="Getdiscountpurchase()" style="width:100px;"/>%
              <input type="hidden" id="discount_amt" name="discount_amt" value=""/>
          </td>       
       </tr>     


              <tr class="tableborder">
                <td height="40" align="right" valign="middle" class="verdanablack">&nbsp;</td>
                  <td align="center" valign="middle" class="verdanablack">&nbsp;</td>
                  <td align="center" valign="middle" class="verdanablack">&nbsp;</td>
                  <td align="center" valign="middle" class="verdanablack">&nbsp;</td>
                  <td align="center" valign="middle" class="verdanablack"><a href="javascript:void(0);" Onclick="Javascript:return addPurchaseList();" class="submenu" > Add</a></td>
                  
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
             
              
                 <div id="PurchaseAddList">
              
                
                </div>
              <div style="height:30px;"></div>
              </td>
            </tr>
            <tr>&nbsp;</tr>
            <tr>&nbsp;</tr>
            <tr>&nbsp;</tr>
            
    
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