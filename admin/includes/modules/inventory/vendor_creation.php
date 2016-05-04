<?php
$defaultCountry   = 'Select a Country';
$action = $_POST["action"] ? $_POST["action"] : $_GET["action"];
$page = $_POST["page"] ? $_POST["page"] : $_GET["page"];
if ($action == "vendor_add" || $action == "vendor_edit") {
	$vendor_add = "vendor_insert";
	$vendor_edit = "vendor_update";
if ($action == "vendor_edit" ) {
    $student_user_result = $hms_info_obj->vendorSingRec();
    $student_user_values = db_fetch_array ($student_user_result);
}
    if ( not_null ( $student_user_values["active"] ) ) ${$student_user_values["active"]}= "checked";
    else $Y = "checked";

?>
<form name="frmStudentUser" method="POST" enctype="multipart/form-data" action="<?php echo href_link(FILENAME_VENDOR_CREATION); ?>">
    <input type="hidden" name="action" value="<?php echo ${$_GET["action"]}; ?>">
   <input type="hidden" name="page" value="<?php echo (isset($page) ? $page : 1); ?>">
    <?php 
    if ( $action =="vendor_edit" ) {?>
        <input type="hidden" name="id" value="<?php echo $_GET["id"]; ?>">
    <?php } ?>
    <table width="100%" border="0" cellspacing="0" cellpadding="2">
       <tr><td></td></tr>
    <tr><td></td></tr>
	      <tr>
            <td colspan="6" align="left" style="background-image:url(images/back_header_bg.jpg); background-repeat:repeat-x;"><table border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="left" style="padding-left:6px"><img src="images/arrow_heading.gif" /></td>
                <td align="left" class="heading_light_blue" valign="top">&nbsp;<?php echo TITLE_MANAGE_VENDOR_CREATION;?></td>
              </tr>
            </table></td>
        </tr>
        <tr>
            <td colspan="2"></td>
        </tr>
        <tr>
            <td width="13%" class="tahoma12blacknormal padding_left">  Name:</td>
            <td width="87%" colspan = "2" class="tahoma12blacknormal padding_left">
            
      
            
				<input name="vendor_name" type="text"  id="vendor_name" tabindex="1" dir="ltr" size="60%" value="<?php print stripslashes($student_user_values["vendor_name"]); ?>" ONCHANGE="validatePresent(this, 'error_vendor_name');">&nbsp;<span id="error_vendor_name" class="tahoma10rednormal"><?php if (! not_null ($student_user_values["vendor_name"]) ) { ?>Required<?php } ?>
</span>  
   

            </td>
        </tr>

		<td width="13%" class="tahoma12blacknormal padding_left"> Address:</td>
            <td width="87%" colspan = "2" class="tahoma12blacknormal padding_left">
				<textarea name="vendor_address"  id="vendor_address" tabindex="2" dir="ltr" style="width:20em;" ONCHANGE="validatePresent(this, 'error_vendor_address');"><?php print stripslashes($student_user_values["vendor_address"]); ?></textarea>&nbsp;<span id="error_vendor_address" class="tahoma10rednormal"><?php if (! not_null ($student_user_values["vendor_address"]) ) { ?>Required<?php } ?></span> 
            </td>

		<tr>
		<td width="13%" class="tahoma12blacknormal padding_left"> City:</td>
            <td width="87%" colspan = "2" class="tahoma12blacknormal padding_left">
				<input name="vendor_city" type="text"  id="vendor_city" tabindex="3" dir="ltr" size="60%" value="<?php print $student_user_values["vendor_city"]; ?>" ONCHANGE="validatePresent(this, 'error_vendor_city');">&nbsp;<span id="error_vendor_city" class="tahoma10rednormal"><?php if (! not_null ($student_user_values["vendor_city"]) ) { ?>Required<?php } ?>
</span>            </td></tr>

          <tr>
		<td width="13%" class="tahoma12blacknormal padding_left"> State:</td>
            <td width="87%" colspan = "2" class="tahoma12blacknormal padding_left">
				<input name="vendor_state" type="text"  id="vendor_state" tabindex="4" dir="ltr" size="60%" value="<?php print $student_user_values["vendor_state"]; ?>" ONCHANGE="validatePresent(this, 'error_vendor_state');">&nbsp;<span id="error_vendor_state" class="tahoma10rednormal"><?php if (! not_null ($student_user_values["vendor_state"]) ) { ?>Required<?php } ?></span> 
            </td></tr>

			<tr>
		<td width="13%" class="tahoma12blacknormal padding_left"> Country:</td>
            <td width="87%" colspan = "2" class="tahoma12blacknormal padding_left">
				<input name="country_name" type="text"  id="vendor_country" tabindex="5" dir="ltr" size="60%" value="<?php print stripslashes($student_user_values["vendor_country"]); ?>" ONCHANGE="validatePresent(this, 'error_vendor_country');">&nbsp;<span id="error_vendor_country" class="tahoma10rednormal"><?php if (! not_null ($student_user_values["vendor_country"]) ) { ?>Required<?php } ?></span> 
            </td></tr>

			<tr>
		<td width="13%" class="tahoma12blacknormal padding_left">Zip:</td>
            <td width="87%" colspan = "2" class="tahoma12blacknormal padding_left">
				<input name="vendor_zip" type="text" class="tahoma12blacknormal padding_left" id="vendor_zip" tabindex="6" dir="ltr" size="60%" value="<?php print $student_user_values["vendor_zip"]; ?>"                             
	onKeyPress="return blockNumbers(event)" ONCHANGE="validatePresent(this, 'error_vendor_zip');">&nbsp;<span id="error_vendor_zip" class="tahoma10rednormal"><?php if (! not_null ($student_user_values["vendor_zip"]) ) { ?>Required<?php } ?></span> 
            </td></tr>

			<tr>
		<td width="13%" class="tahoma12blacknormal padding_left">Phone:</td>
            <td width="87%" colspan = "2" class="tahoma12blacknormal padding_left">
				<input name="vendor_phone" type="text"  id="vendor_phone" tabindex="7" dir="ltr" size="60%" value="<?php print $student_user_values["vendor_phone"]; ?>" onKeyPress="return blockNumbers(event)" ONCHANGE="validatePresent(this, 'error_vendor_phone');">&nbsp;<span id="error_vendor_phone" class="tahoma10rednormal"><?php if (! not_null ($student_user_values["vendor_phone"]) ) { ?>Required<?php } ?></span> 
            </td></tr>

			<tr>
		<td width="13%" class="tahoma12blacknormal padding_left"> Mobile:</td>
            <td width="87%" colspan = "2" class="tahoma12blacknormal padding_left">
				<input name="vendor_mobile" type="text"  id="vendor_mobile" tabindex="8" dir="ltr" size="60%" value="<?php print $student_user_values["vendor_mobile"]; ?>" onKeyPress="return blockNumbers(event)" ONCHANGE="validatePresent(this, 'error_vendor_mobile');">&nbsp;<span id="error_vendor_mobile" class="tahoma10rednormal"><?php if (! not_null ($student_user_values["vendor_mobile"]) ) { ?>Required<?php } ?></span> 
            </td></tr>

				<tr>
		<td width="13%" class="tahoma12blacknormal padding_left">Contact Person:</td>
            <td width="87%" colspan = "2" class="tahoma12blacknormal padding_left">
				<input name="vendor_contact" type="text"  id="vendor_contact" tabindex="9" dir="ltr" size="60%" value="<?php print stripslashes($student_user_values["vendor_contact"]); ?>" ONCHANGE="validatePresent(this, 'error_vendor_contact');">&nbsp;<span id="error_vendor_contact" class="tahoma10rednormal"><?php if (! not_null ($student_user_values["vendor_contact"]) ) { ?>Required<?php } ?></span> 
            </td></tr>

				<tr>
		<td width="13%" class="tahoma12blacknormal padding_left"><!--Item:--></td>
            <td width="87%" colspan = "2" class="tahoma12blacknormal padding_left">
				<input name="item_id" type="hidden"  id="item_id" tabindex="10" dir="ltr" size="60%" value="0" onKeyPress="">&nbsp;<span id="error_item_id" class="tahoma10rednormal"><?php if (! not_null ($student_user_values["item_id"]) ) { ?><?php } ?></span> 
            </td></tr>

        <tr>
            <td class="tahoma12blacknormal padding_left">Active:</td>
            <td width="87%" colspan = "2"><input name="active" class="noneborder" type="radio" tabindex="11" value="Y" <? echo $Y ?>>
				<span class="tahoma12blacknormal padding_left">Yes</span>
				<input name="active" class="noneborder" type="radio" tabindex="12" value="N" <? echo $N ?>>
				<span class="tahoma12blacknormal padding_left">No</span>
			</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td >
                <input style="font-size:11px; color:#e1e1e1; background:#666666; border:1px solid #000; padding:1px 3px 1px 3px;cursor:pointer;" name="buttonSubmit" type="button" tabindex="13" title="Submit" onClick="submitfrmStudentUser(document.frmStudentUser);" value="Submit" >&nbsp;
                <input class="btn_style1" name="buttonCancel" type="button" tabindex="14" title="Cancel" value="Cancel" ONCLICK="document.location.href='<?php echo href_link(FILENAME_VENDOR_CREATION, 'page=' . $_GET["page"]); ?>'" style="font-size:11px; color:#e1e1e1; background:#666666; border:1px solid #000; padding:1px 3px 1px 3px;cursor:pointer;"></td>
       </tr>
    </table>
</form>
<?php
} else {
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
 <tr>
  <td bgcolor="#FFFFFF" >
    <div id="hotel_info_records" ></div>
        <table width="100%" border="0" cellspacing="0" cellpadding="2" align="center">
            <tr>
                <td height="5"></td>
            </tr>
            <tr>
                <td height="100" class="tahoma11blacknormal" align="left" style="padding-left:8px; padding-bottom:5px"><img src="images/newfolder.gif" width="16" height="16" align="absbottom" alt="Add Event">&nbsp;&nbsp;<a title="Click to add new hms info add" href="<?php echo href_link(FILENAME_VENDOR_CREATION, 'action=vendor_add'); ?>"><b>Add Vendor</b></a></td>
            </tr>
        </table>
  </td>
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