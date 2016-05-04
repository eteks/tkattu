<?php
require_once ("includes/application_top.php");
//require_once ("sss.html");
session_start();
?>

<?php
$_POST['vendor_name'] = (isset($_POST["vendor_name"]) && !empty($_POST["vendor_name"]) ? $_POST["vendor_name"] : "");
    $vendor_name = $_POST['vendor_name'];   
    if($vendor_name !="")
    {
?>
        
<?php
    $item_fetch_item_type_sqls1 = "SELECT * FROM " .TABLE_HMS_VENDOR_CREATION. " where vendor_id= '".$vendor_name."'";	 	
    $item_item_type_recordss1 = db_query ($item_fetch_item_type_sqls1);
	if ($item_item_type_recordss1 > 0) {
	while ($hms_info_values1s = db_fetch_array($item_item_type_recordss1)) {	
?>

<?php echo $hms_info_values1s['vendor_address'];?>,
<?php echo $hms_info_values1s['vendor_state']; ?>,
<?php echo $hms_info_values1s['vendor_country']; ?>,
<?php echo $hms_info_values1s['vendor_zip']; ?>,
<?php echo $hms_info_values1s['vendor_mobile']; ?>.

<?php } } ?>
      
<?php } ?>

<?php	$_POST["item_menu_id"] = (isset($_POST['item_menu_id']) && !empty($_POST['item_menu_id']) ? $_POST['item_menu_id']:"" );
$id = $_POST['item_menu_id'];	
if($id !="")
{
?>
        
<?php
$item_fetch_item_type =  "SELECT * FROM " . TABLE_HMS_ITEM_ENTRY. " where item_entry_id = '$id'";	 	
$item_item_type_records2 = db_query ($item_fetch_item_type);
if ($item_item_type_records2 > 0) {
while ($hms_info_values2 = db_fetch_array($item_item_type_records2))
{	
?> 
    
<table border="0" width="100%">
    <tr>
    <td align="right" valign="middle" class="verdanablack">Item Type:</td>
    
    <td align="left" valign="middle" class="verdanablack">
        <input type="text" style="width:100px;" id="item_type_value_tmp" readonly="readonly"  value="<?php echo itemtypename($hms_info_values2['item_entry_type']);?>" />
        <input type="hidden" id="item_type_value" name="item_type_value" style="width:100px;"  value="<?php echo $hms_info_values2['item_entry_type'];?>" />
    
    </td>
     
    <td width="-2%" align="right" valign="middle" class="verdanablack">Unit:</td>
    
    <td width="27%" align="left" valign="middle" class="verdanablack">
    <input type="text" style="width:100px;" id="item_unit_value_tmp" readonly="readonly" value="<?php echo unitname($hms_info_values2['item_unit']);?>" />
    <input type="hidden" id="item_unit_value" name="item_unit_value" style="width:100px;" readonly="readonly" value="<?php echo $hms_info_values2['item_unit'];?>" />
    
    </td> 	
    </tr>
</table>
 
<?php } } ?>
      
<?php } ?>

<?php $_POST["i_id"] = (isset($_POST['i_id']) && !empty($_POST['i_id']) ? $_POST['i_id']:"" );
	$i_id = $_POST['i_id'];	
	if($i_id !="")
	{
	$item_fetch_item_type_sqlsu =  ("UPDATE " . TABLE_HMS_ITEM_ENTRY . " SET `status`='1' WHERE  item_entry_id = '$i_id' ");	 	
        $item_item_type_recordssu = db_query ($item_fetch_item_type_sqlsu);
?>
    
    
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
                      <th height="30" bgcolor="#D7DBB0" class="style1" scope="col">Stock Report</th>
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
	$item_fetch_detail =  "SELECT  *  FROM " . TABLE_HMS_ITEM_ENTRY. " where status='0' order by item_entry_id asc ";
	//echo $item_fetch_singrec_sql;
    $item_records = db_query ($item_fetch_detail);
	if ($item_records > 0) {
	while ($hms_item_values = db_fetch_array($item_records)) {
	 ?>
    
    
    <tr>
	        <td width="7%" bgcolor="<? echo $bgcolor ?>" class="tahoma11blacknormal" style="text-align:center" >
             <?php if(strlen($hms_item_values["item_entry_id"]) > 30) echo substr(stripslashes($hms_item_values["item_entry_id"]),0,28).".."; else echo stripslashes($hms_item_values["item_entry_id"]); ?>
            </td>

        <td width="1%" bgcolor="<? echo $bgcolor ?>" class="tahoma11blacknormal" style="text-align:center" >
        <?php if(strlen($hms_item_values["vendor_name"]) > 30) echo substr(stripslashes($hms_item_values["vendor_name"]),0,28).".."; else echo stripslashes($hms_item_values["vendor_name"]); ?></td>
        
       <td width="8%" bgcolor="<? echo $bgcolor ?>" class="tahoma11blacknormal" style="text-align:center" >
         
         <?php if(strlen($hms_item_values["item_entry_name"]) > 30) echo substr(stripslashes($hms_item_values["item_entry_name"]),0,28).".."; else echo stripslashes($hms_item_values["item_entry_name"]); ?></td>
        
		  <td width="10%" bgcolor="<? echo $bgcolor ?>" class="tahoma11blacknormal" style="text-align:center" >
		    <? if(strlen($hms_item_values["item_entry_type"]) > 30) echo substr($hms_item_values["item_entry_type"],0,28).".."; else echo $hms_item_values["item_entry_type"]; ?></td>

		  <td width="7%" bgcolor="<? echo $bgcolor ?>" class="tahoma11blacknormal" style="text-align:center" >
        <? if(strlen($hms_item_values["item_unit"]) > 30) echo substr($hms_item_values["item_unit"],0,28).".."; else echo $hms_item_values["item_unit"]; ?>
        </td>

      <td width="7%" bgcolor="<? echo $bgcolor ?>" class="tahoma11blacknormal" style="text-align:center" >
    <? if(strlen($hms_item_values["item_minqty"]) > 30) echo substr($hms_item_values["item_minqty"],0,28).".."; else echo $hms_item_values["item_minqty"]; ?>
    </td>

      <td width="7%" bgcolor="<? echo $bgcolor ?>" class="tahoma11blacknormal" style="text-align:center" >
   <? if(strlen($hms_item_values["standard_qty"]) > 30) echo substr($hms_item_values["standard_qty"],0,28).".."; else echo $hms_item_values["standard_qty"]; ?>			</td>

            <td width="2%" colspan="2" style="text-align:center; font-size:12px; color:#F00; cursor:pointer;" bgcolor="<? echo $bgcolor ?>" onclick="getPurchaseReturn( <? if(strlen($hms_item_values["item_entry_id"]) > 30) echo substr(stripslashes($hms_item_values["item_entry_id"]),0,28).".."; else echo stripslashes($hms_item_values["item_entry_id"]); ?>)">            
            <img src="images/Returns-512.png" height="20" style="cursor:pointer;" title="Return"  />
            </td>
            
    <td width="4%" style="text-align:center" bgcolor="<? echo $bgcolor ?>"><a href="javascript:void(0);" onclick="javascript:getVendorViewList('<?php echo $hms_item_values["vendor_name"];?>','<?php echo $hms_info_values["item_entry_id"];?>');"><img src="admin/images/view.gif" width="16" height="16" border="0" title="View" /> </a>
    </td>
 
 
   </tr>
  <?php } } else { ?>
 <tr>
 <td colspan="10" align="center" style="font-size:14px; color:#F00;">
<?php echo "NO RECORDS FOUND" ?>
 </td>
 </tr> 
  
  <?php } ?>
  
    </table>
          </td>
          </tr>
        </table>
        
	<?php	} ?>



<?php
$_POST["r_id"] = (isset($_POST['r_id']) && !empty($_POST['r_id']) ? $_POST['r_id']:"" );
	$r_id = $_POST['r_id'];
	
	if($r_id !="")
	{
	$item_fetch_item_type_sqlsr =  ("UPDATE " . TABLE_HMS_ITEM_ENTRY . " SET `status`='0' WHERE  item_entry_id = '$r_id' ");	 	
    $item_item_type_recordssr = db_query ($item_fetch_item_type_sqlsr);
	?>
    
    
    
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
                      <th height="30" bgcolor="#D7DBB0" class="style1" scope="col">Purchase Return</th>
                    </tr>
                  </table></td>
              </tr>
              <tr>
                <td width="100%" height="30" align="center" valign="middle" class="verdanablack">

                    
                
 <table width="100%" border="0" cellspacing="0" cellpadding="5" class="ntab" style="font-size:12px;">
    <tr>
         <th width="5%" style="text-align:center" >Return ID</th>
          <th width="14%" style="text-align:center" >Vendor Name</th>        
         <th width="12%" style="text-align:center" >Item  Name</th>
		  <th width="13%" style="text-align:center" >Item Type </th>
		   <th width="12%" style="text-align:center" >Unit </th>
            <th width="8%" style="text-align:center" >Min.Qty</th>
		    <th width="15%" style="text-align:center" >Standard Quantity</th>
         <th style="text-align:center" colspan="3">Action</th>
    </tr>
    

 <?php		
	$item_fetch_detail =  "SELECT *  FROM " . TABLE_HMS_ITEM_ENTRY. " where status='1' order by item_entry_id asc ";
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



            <td width="2%" colspan="2" style="text-align:center; font-size:12px; color:#F00; cursor:pointer;" bgcolor="<? echo $bgcolor ?>" onclick="getPurchaseRestore( <? if(strlen($hms_item_values["item_entry_id"]) > 30) echo substr(stripslashes($hms_item_values["item_entry_id"]),0,28).".."; else echo stripslashes($hms_item_values["item_entry_id"]); ?>)">
            
            <img src="images/Refresh_black-512.png" height="20" style="cursor:pointer;" title="Re Store"  />
            
            </td>
            
  <td width="4%" style="text-align:center" bgcolor="<? echo $bgcolor ?>"><a href="javascript:void(0);" onclick="javascript:getVendorViewList('<?php echo $hms_info_values["vendor_name"];?>','<?php echo $hms_info_values["item_entry_id"];?>');"> <img src="admin/images/view.gif" width="16" height="16" border="0" title="View" /></a>
        </td>
 

    </tr>
  
  <?php } } ?>
  
    </table>
                
                
            </td>
          </tr>
        </table>
	
	
	
<?php	} ?>