<?php
$defaultCountry   = 'Select a Country';
$action = $_POST["action"] ? $_POST["action"] : $_GET["action"];
$page = $_POST["page"] ? $_POST["page"] : $_GET["page"];
if ($action == "item_add" || $action == "item_edit") {
	$item_add = "item_insert";
	$item_edit = "item_update";
if ($action == "item_edit" ) {
    $student_user_result = $hms_info_obj->itemSingRec();
    $student_user_values = db_fetch_array ($student_user_result);
}
    if ( not_null ( $student_user_values["active"] ) ) ${$student_user_values["active"]}= "checked";
    else $Y = "checked";
?>
<script>
function totalAmountCalc()
{
	var purchased_Qty = document.getElementById("standard_qty").value;
	var price_per_unit = document.getElementById("standard_rate").value;
	var total;
	//alert(total);
	
	total = ((purchased_Qty) * (price_per_unit));
	
	document.getElementById('item_maxqty').value  = total;
	}

</script>
<form name="frmStudentUser" method="POST" enctype="multipart/form-data" action="<?php echo href_link(FILENAME_ENTRY_TYPE); ?>">
  <input type="hidden" name="action" value="<?php echo ${$_GET["action"]}; ?>">
  <input type="hidden" name="page" value="<?php echo (isset($page) ? $page : 1); ?>">
  <?php 
    if ( $action =="item_edit" ) {?>
  <input type="hidden" name="id" value="<?php echo $_GET["id"]; ?>">
  <?php } ?>
  <table width="100%" border="0" cellspacing="0" cellpadding="2">
    <tr>
      <td></td>
    </tr>
    <tr>
      <td colspan="6" align="left" style="background-image:url(images/back_header_bg.jpg); background-repeat:repeat-x;"><table border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="left" style="padding-left:6px"><img src="images/arrow_heading.gif" /></td>
            <td align="left" class="heading_light_blue" valign="top">&nbsp;<?php echo TITLE_MANAGE_ITEM_ENTRY;?></td>
          </tr>
        </table></td>
    </tr>
    <tr>
      <td colspan="2"></td>
    </tr>
    <!--<tr>
      <td width="13%" class="tahoma12blacknormal padding_left"> Vendor Name:</td>
      <td width="87%" colspan = "2" class="tahoma12blacknormal padding_left"><select name="vendor_name"  id="vendor_name" tabindex="1" dir="ltr" style="width:455px; height:22px;" ONCHANGE="validatePresent(this, 'error_vendor_name');">
          <option value="">----------------------------------- Select Vendor Name--------------------------------- </option>
          <?php		
	$item_fetch_singrec_sql =  "SELECT vendor_name  FROM " . TABLE_HMS_VENDOR_CREATION. " ";
	//echo $item_fetch_singrec_sql;
    $item_sing_records = db_query ($item_fetch_singrec_sql);
	if ($item_sing_records > 0) {
	while ($hms_info_values = db_fetch_array($item_sing_records)) {	
	
	?>
          <option  <?php if($student_user_values["vendor_name"]==$hms_info_values['vendor_name'] ) { echo  ' selected="selected" ';  } ?> value="<?php echo $hms_info_values['vendor_name']; ?> " > <?php echo $hms_info_values['vendor_name']; ?> </option>
          <?php } } ?>
        </select>
        &nbsp;<span id="error_vendor_name" class="tahoma10rednormal">
        <?php if (! not_null ($student_user_values["vendor_name"]) ) { ?>
        Required
        <?php } ?>
        </span></td>
    </tr>-->
    <tr>
      <td width="13%" class="tahoma12blacknormal padding_left"> Item Type:</td>
      <td width="87%" colspan = "2" class="tahoma12blacknormal padding_left">
      
      <select name="item_entry_type"  id="item_entry_type" tabindex="1" dir="ltr" style="width:455px; height:22px;" ONCHANGE="validatePresent(this, 'error_item_entry_type');">
          <option value="">-------------------------------------- Select Item Type----------------------------------- </option>
         
     <?php		
	$item_fetch_singrec_sqli =  "SELECT item_type_id,item_type_name FROM " . TABLE_HMS_ITEM_TYPE. " ";
	//echo $item_fetch_singrec_sql;
    $item_sing_recordsi = db_query ($item_fetch_singrec_sqli);
	if ($item_sing_recordsi > 0) {
	while ($hms_info_valuesi = db_fetch_array($item_sing_recordsi)) {	
	?>
          <option  <?php if($hms_info_valuesi['item_type_id']==$student_user_values["item_entry_type"]) { echo  'selected="selected"';  } ?> value="<?php echo $hms_info_valuesi['item_type_id']; ?>" > <?php echo $hms_info_valuesi['item_type_name']; ?> </option>
          
          <?php } } ?>
          
        </select>
        
        &nbsp;<span id="error_item_entry_type" class="tahoma10rednormal">
        <?php if (! not_null ($student_user_values["item_entry_type"]) ) { ?>
        Required
        <?php } ?>
        </span></td>
    </tr>
    <tr>
      <td width="13%" class="tahoma12blacknormal padding_left"> Item Name:</td>
      <td width="87%" colspan = "2" class="tahoma12blacknormal padding_left"><input name="item_entry_name" type="text"  id="item_entry_name" tabindex="2" dir="ltr" size="60%" value="<?php print $student_user_values["item_entry_name"]; ?>" ONCHANGE="validatePresent(this, 'error_item_entry_name');">
        &nbsp;<span id="error_item_entry_name" class="tahoma10rednormal">
        <?php if (! not_null ($student_user_values["item_entry_name"]) ) { ?>
        Required
        <?php } ?>
        </span></td>
    </tr>
    <tr>
      <td width="13%" class="tahoma12blacknormal padding_left"> Unit:</td>
      <td width="87%" colspan = "2" class="tahoma12blacknormal padding_left">
      
      <select name="item_unit"  id="item_unit" tabindex="1" dir="ltr" style="width:455px; height:22px;" ONCHANGE="validatePresent(this, 'error_item_unit');">
          <option value="">----------------------------------- Select Unit Type ------------------------------------ </option>
          <?php		
	$item_fetch_singrec_sqlu =  "SELECT unit_entry_id,unit_name  FROM " . TABLE_HMS_UNIT_ENTRY. " ";
	//echo $item_fetch_singrec_sql;
    $item_sing_recordsu = db_query ($item_fetch_singrec_sqlu);
	if ($item_sing_recordsu > 0) {
	while ($hms_info_valuesu = db_fetch_array($item_sing_recordsu)) {	
		?>
          <option  <?php if($hms_info_valuesu['unit_entry_id']==$student_user_values["item_unit"]) { echo  'selected="selected"';  } ?> value="<?php echo $hms_info_valuesu['unit_entry_id']; ?>" > <?php echo $hms_info_valuesu['unit_name']; ?> </option>
          <?php } } ?>
        </select>&nbsp;<span id="error_item_unit" class="tahoma10rednormal">
        <?php if (!empty($student_user_values["item_unit"]) ) { ?>
        Required
        <?php } ?>
        </span></td>
    </tr>

<input name="opening_stock" type="hidden"  id="opening_stock" tabindex="4" dir="ltr" size="60%" value="0" ONCHANGE="validatePresent(this, 'error_opening_stock');">
       <?php /*?> &nbsp;<span id="error_opening_stock" class="tahoma10rednormal">
        <?php if (! not_null ($student_user_values["opening_stock"]) ) { ?>
        Required
        <?php } ?><?php */?>
        </span>
    <input name="item_minqty" type="hidden"  id="item_minqty" tabindex="6" dir="ltr" size="60%" value="0" ONCHANGE="validatePresent(this, 'error_item_minqty');">
        &nbsp;<span id="error_item_minqty" class="tahoma10rednormal">
       <?php /*?> <?php if (! not_null ($student_user_values["item_minqty"]) ) { ?>
        Required
        <?php } ?><?php */?>
        </span>
        <!--<tr>
      <td width="13%" class="tahoma12blacknormal padding_left">Purchased Qty:</td>-->
      <!--<td width="87%" colspan = "2" class="tahoma12blacknormal padding_left">--><input name="standard_qty" type="hidden"  id="standard_qty" tabindex="7" dir="ltr" size="60%" value="0" ONCHANGE="validatePresent(this, 'error_standard_qty');">
       <!-- &nbsp;<span id="error_standard_qty" class="tahoma10rednormal">
        <?php if (! not_null ($student_user_values["standard_qty"]) ) { ?>
        Required
        <?php } ?>
        </span></td>
    </tr>-->
    <!--<tr>
      <td width="13%" class="tahoma12blacknormal padding_left"> Price/Unit:</td>
      <td width="87%" colspan = "2" class="tahoma12blacknormal padding_left"> --><input name="standard_rate" type="hidden"  id="standard_rate" tabindex="8" dir="ltr" size="60%" value="0" onkeyup="return totalAmountCalc()">
        &nbsp;<span id="error_standard_rate" class="tahoma10rednormal">
        <?php /*if (! not_null ($student_user_values["standard_rate"]) ) { ?>
        Required
        <?php }*/ ?>
        </span><!--</td>
    </tr>-->
    <!--<tr>
      <td width="13%" class="tahoma12blacknormal padding_left"> Total Amount:</td>
      <td width="87%" colspan = "2" class="tahoma12blacknormal padding_left">--> <input name="item_maxqty" type="hidden"  id="item_maxqty" tabindex="5" dir="ltr" size="60%" value="0" ONCHANGE="validatePresent(this, 'error_item_maxqty');">
        &nbsp;<span id="error_item_maxqty" class="tahoma10rednormal">
        <?php /*if (! not_null ($student_user_values["item_maxqty"]) ) { ?>
        Required
        <?php }*/ ?>
        </span><!--</td>
    </tr>-->
   
    <!--<tr>
      <td class="tahoma12blacknormal padding_left">Active:</td>
      <td width="87%" colspan = "2"><input name="active" class="noneborder" type="radio" tabindex="9" value="Y" <? echo $Y ?>>
        <span class="tahoma12blacknormal padding_left">Yes</span>
        <input name="active" class="noneborder" type="radio" tabindex="10" value="N" <? echo $N ?>>
        <span class="tahoma12blacknormal padding_left">No</span></td>
    </tr>-->
    `
    <tr>
      <td>&nbsp;</td>
      <td ><input style="font-size:11px; color:#e1e1e1; background:#666666; border:1px solid #000; padding:1px 3px 1px 3px;cursor:pointer;" name="buttonSubmit" type="button" tabindex="11" title="Submit" onClick="submitfrmStudentUser(document.frmStudentUser);" value="Submit" >
        &nbsp;
        <input class="btn_style1" name="buttonCancel" type="button" tabindex="12" title="Cancel" value="Cancel" ONCLICK="document.location.href='<?php echo href_link(FILENAME_ENTRY_TYPE, 'page=' . $_GET["page"]); ?>'" style="font-size:11px; color:#e1e1e1; background:#666666; border:1px solid #000; padding:1px 3px 1px 3px;cursor:pointer;"></td>
    </tr>
  </table>
</form>
<?php
} else {
?>

<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td bgcolor="#FFFFFF" ><div id="hotel_info_records" ></div>
      <table width="100%" border="0" cellspacing="0" cellpadding="2" align="center">
        <tr>
          <td height="5"></td>
        </tr>
        <tr>
          <td height="100" class="tahoma11blacknormal" align="left" style="padding-left:8px; padding-bottom:5px"><img src="images/newfolder.gif" width="16" height="16" align="absbottom" alt="Add Event">&nbsp;&nbsp;<a title="Click to add new hms info add" href="<?php echo href_link(FILENAME_ENTRY_TYPE, 'action=item_add'); ?>"><b>Add Item Entry</b></a></td>
        </tr>
      </table></td>
  </tr>
</table>
<script language="javascript" type="text/javascript">
        <!--//
            populateHotelInfoManageLists('', '', '', '<?=$page?>');
        //-->
    </script>
<?php
}
?>
