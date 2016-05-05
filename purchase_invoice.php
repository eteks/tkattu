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
.style1 {
	font-size: 12px;
	font-style: normal;
	line-height: normal;
	font-variant: normal;
	text-transform: none;
	color: #000000;
	text-decoration: none;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}
.style2 {
	color: #FF0000
}
-->
</style>
<script language="JavaScript" type="text/javascript" src="js/inventory.js"></script>
</head>

<body>
<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <th width="29" align="left" valign="middle" background="images/left_bg.jpg" scope="col"> <img src="images/left_bg.jpg" width="29" height="20" /> </th>
    <th width="942" align="center" valign="top" scope="col"> <table width="942" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td>
          
          <table width="95%" align="center" cellpadding="0" cellspacing="0" class="tableborder">
              <?php if (isset($_POST["msg"]) && $_POST["msg"] != "" ) { ?>
              <tr>
                <th height="30"><span class="style2"><?php echo $_POST["msg"]; ?></span></th>
              </tr>
              <?php } ?>
              <tr>
                <td width="100%" height="30" align="center" valign="middle" class="verdanablack"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <th><span  id="error_service" style="display:none;background-color:#EC8F82;border:solid 1px #FF0000;" ></span></th>
                    </tr>
                    <tr>
                      <th height="30" bgcolor="#D7DBB0" class="style1" scope="col">Purchase Invoice</th>
                    </tr>
                  </table></td>
              </tr>
              <tr>
                <td width="100%" height="30" align="center" valign="middle" class="verdanablack">
                
                
                
                
 <table width="100%" border="0" cellspacing="0" cellpadding="5" class="ntab" style="font-size:12px;">
    <tr>
         <th width="5%" style="text-align:center" >Order ID</th>
          <th width="14%" style="text-align:center" >Vendor Name</th>        
         <th width="12%" style="text-align:center" >Item  Name</th>
		  <th width="13%" style="text-align:center" >Item Type </th>
		   <th width="12%" style="text-align:center" >Unit </th>
            <th width="8%" style="text-align:center" >Min.Qty</th>
		    <th width="15%" style="text-align:center" >Standard Quantity</th>
         <th style="text-align:center" colspan="3">Action</th>
    </tr>
    

 <?php		
	$item_fetch_detail =  "SELECT *  FROM " . TABLE_HMS_ITEM_ENTRY. " where status='0' order by item_entry_id asc ";
	//echo $item_fetch_singrec_sql;
    $item_records = db_query ($item_fetch_detail);
	if ($item_records > 0) {
	while ($hms_item_values = db_fetch_array($item_records)) {	
	
	?>
    
    
    <tr>
	        <td width="7%" bgcolor="<? echo $bgcolor ?>" class="tahoma11blacknormal" style="text-align:center" >
             <? if(strlen($hms_item_values["item_entry_id"]) > 30) echo substr(stripslashes($hms_item_values["item_entry_id"]),0,28).".."; else echo stripslashes($hms_item_values["item_entry_id"]); ?>
            </td>

        <td width="1%" bgcolor="<? echo $bgcolor ?>" class="tahoma11blacknormal" style="text-align:center" >
        <? if(strlen($hms_item_values["vendor_name"]) > 30) echo substr(stripslashes($hms_item_values["vendor_name"]),0,28).".."; else echo stripslashes($hms_item_values["vendor_name"]); ?></td>
        
       <td width="8%" bgcolor="<? echo $bgcolor ?>" class="tahoma11blacknormal" style="text-align:center" >
         
         <? if(strlen($hms_item_values["item_entry_name"]) > 30) echo substr(stripslashes($hms_item_values["item_entry_name"]),0,28).".."; else echo stripslashes($hms_item_values["item_entry_name"]); ?></td>
        
		  <td width="10%" bgcolor="<? echo $bgcolor ?>" class="tahoma11blacknormal" style="text-align:center" >
		    <? if(strlen($hms_item_values["item_entry_type"]) > 30) echo substr($hms_item_values["item_entry_type"],0,28).".."; else echo $hms_item_values["item_entry_type"]; ?></td>


		  <td width="7%" bgcolor="<? echo $bgcolor ?>" class="tahoma11blacknormal" style="text-align:center" >
        <? if(strlen($hms_item_values["item_unit"]) > 30) echo substr($hms_item_values["item_unit"],0,28).".."; else echo $hms_item_values["item_unit"]; ?></td>

		 

		  <td width="7%" bgcolor="<? echo $bgcolor ?>" class="tahoma11blacknormal" style="text-align:center" >
        <? if(strlen($hms_item_values["item_minqty"]) > 30) echo substr($hms_item_values["item_minqty"],0,28).".."; else echo $hms_item_values["item_minqty"]; ?></td>


		  <td width="7%" bgcolor="<? echo $bgcolor ?>" class="tahoma11blacknormal" style="text-align:center" >
        <? if(strlen($hms_item_values["standard_qty"]) > 30) echo substr($hms_item_values["standard_qty"],0,28).".."; else echo $hms_item_values["standard_qty"]; ?></td>



            <td width="2%" colspan="2" style="text-align:center; font-size:12px; color:#F00; cursor:pointer;" bgcolor="<? echo $bgcolor ?>" onclick="getPurchaseReturn( <? if(strlen($hms_item_values["item_entry_id"]) > 30) echo substr(stripslashes($hms_item_values["item_entry_id"]),0,28).".."; else echo stripslashes($hms_item_values["item_entry_id"]); ?>)">
            
            <img src="images/Returns-512.png" height="20" style="cursor:pointer;" title="Return"  />
            
            </td>
            
  <td width="4%" style="text-align:center" bgcolor="<? echo $bgcolor ?>"><a href="<? echo FILENAME_ENTRY_TYPE_VIEW. '?id=' . $hms_info_values["item_entry_id"]; ?>" onClick="return hs.htmlExpand(this, { objectType: 'ajax'} )"><img src="admin/images/view.gif" width="16" height="16" border="0" title="View" /></a>
        </td>
 

    </tr>
  
  <?php } } ?>
  
    </table>
                
                
            </td>
          </tr>
        </table>
            </td>
        </tr>
     
      </table></th>
    <th width="29" background="images/rightline.jpg" scope="col"><img src="images/rightline.jpg" width="29" height="33" /></th>
  </tr>
  <tr>
    <th height="14" align="left" valign="middle" scope="col"><img src="images/left_bottom_corner.jpg" width="29" height="14" /></th>
    <td align="center" valign="middle" background="images/bottomline.jpg" bgcolor="#FFFEFF"><img src="images/bottomline.jpg" width="7" height="14" /></td>
    <th scope="col"><img src="images/right_bottom_corner.jpg" width="29" height="14" /></th>
  </tr>
</table>
</form>
</body>
</html>