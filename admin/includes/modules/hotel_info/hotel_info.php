<?php
$defaultCountry   = 'Select a Country';
$action = $_POST["action"] ? $_POST["action"] : $_GET["action"];
if ($action == "hms_info_add" || $action == "hms_info_edit") {
	$hms_info_add   = "hms_info_insert";
	$hms_info_edit  = "hms_info_update";
    $dateTimeObject = new datetime_class();
if ($action == "hms_info_edit" ) {
    $hms_info_result = $hms_info_obj->hmsInfoSingRec();
    $hms_info_values = db_fetch_array ($hms_info_result);
}
    if ( not_null ( $hms_info_values["student_active"] ) ) ${$hms_info_values["student_active"]}= "checked";
    else $y = "checked";
    if (not_null ($hms_info_values["gender"])) ${$hms_info_values["gender"]} = "checked";
    else $F = "checked";
   // $country_role_arr    = $student_user_obj->getContryTree();
   // $selectedCountryId   = not_null($hms_info_values["countries_id"]) ? $hms_info_values["countries_id"] : $defaultCountry;
?>
<form name="frmStudentUser" method="POST" enctype="multipart/form-data" action="<?php echo href_link(FILENAME_HOTEL_INFO); ?>">
    <input type="hidden" name="action" value="<?php echo ${$_GET["action"]}; ?>">
   <input type="hidden" name="page" value="<?php echo (isset($_GET["page"]) ? $_GET["page"] : 1); ?>">
    <?php 
    if ( $_GET["action"]=="hms_info_edit" ) {?>
        <input type="hidden" name="id" value="<?php echo $_GET["id"]; ?>">
    <?php } ?>
    <table width="100%" border="0" cellspacing="0" cellpadding="2">
             <tr><td></td></tr>
             <tr><td></td></tr>
	      <tr>
            <td colspan="6" align="left" style="background-image:url(images/back_header_bg.jpg); background-repeat:repeat-x;"><table border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="left" style="padding-left:6px"><img src="images/arrow_heading.gif" /></td>
                <td align="left" class="heading_light_blue">&nbsp;<?php echo TITLE_MANAGE_HOTEL_INFO;?></td>
              </tr>
            </table></td>
        </tr>
        <tr>
            <td colspan="2"></td>
        </tr>
        <tr>
            <td class="tahoma12blacknormal padding_left">Hotel Name:</td>
            <td>
             <input name="hms_info_name" type="text" class="tahoma12blacknormal padding_left" id="hotel_name" tabindex="1" dir="ltr" size="40%" value="<?php print stripslashes($hms_info_values["hms_info_name"]); ?>" ONCHANGE="validatePresent(this, 'error_hms_info_name');">&nbsp;<span id="error_hms_info_name" class="tahoma10rednormal"><?php if (! not_null ($hms_info_values["hms_info_name"]) ) { ?>Required<?php } ?>
          </td>
        </tr>
	<?php
    if ( $_GET["action"]!="hms_info_edit" ) {?>
		<tr>
			  <td class="tahoma12blacknormal padding_left">Hotel Banner Upload: </td>
			  <td><input type="file" tabindex="2" title="Enter the Banner path" class="tahoma12blacknormal padding_left" name="upload_banner_image" id="upload_banner_image" size="40%">&nbsp;<span id="error_upload_banner_image" class="tahoma10rednormal"><?php if (! not_null ($banner_values["extension"])) { ?>Required<?php } ?></span><br><b><div class="normaltext" id="image_div" ></div></b></td>
		</tr>
    <?php } ?>

        <tr>
            <td class="tahoma12blacknormal padding_left" valign="top;">Address:</td>
            <td><textarea name="hms_info_address" class="tahoma12blacknormal padding_left" id="address" tabindex="3" dir="ltr" style="width:19em;" ONCHANGE="validatePresent(this, 'error_hms_info_address');"><?php print stripslashes($hms_info_values["hms_info_address"]); ?></textarea>&nbsp;<span id="error_hms_info_address" class="tahoma10rednormal"><?php if (! not_null ($hms_info_values["hms_info_address"]) ) { ?>Required<?php } ?></span></td>
        </tr>
		
        <tr>
            <td class="tahoma12blacknormal padding_left">City:</td>
            <td><input name="hms_info_city" type="text" id="city" class="tahoma12blacknormal padding_left" tabindex="4" dir="ltr" size="40%" value="<?php print stripslashes($hms_info_values["hms_info_city"]); ?>" ONCHANGE="validatePresent(this, 'error_hms_info_city');">&nbsp;<span id="error_hms_info_city" class="tahoma10rednormal"><?php if (! not_null ($hms_info_values["hms_info_city"]) ) { ?>Required<?php } ?></span></td>
        </tr>
        <tr>
            <td class="tahoma12blacknormal padding_left">State:</td>
            <td><input name="hms_info_state" type="text" class="tahoma12blacknormal padding_left" id="state" tabindex="5" dir="ltr" size="40%" value="<?php print stripslashes($hms_info_values["hms_info_state"]); ?>" ONCHANGE="validatePresent(this, 'error_hms_info_state');">&nbsp;<span id="error_hms_info_state" class="tahoma10rednormal"><?php if (! not_null ($hms_info_values["hms_info_state"]) ) { ?>Required<?php } ?></span></td>
        </tr>
		<tr>
            <td class="tahoma12blacknormal padding_left">Zip:</td>
            <td>
             <input name="hms_info_zip" type="text" class="tahoma12blacknormal padding_left" id="hotel_zip" tabindex="6" dir="ltr" size="40%" value="<?php print stripslashes($hms_info_values["hms_info_zip"]); ?>" ONCHANGE="validatePresent(this, 'error_hms_info_zip');">&nbsp;<span id="error_hms_info_zip" class="tahoma10rednormal"><?php if (! not_null ($hms_info_values["hms_info_zip"]) ) { ?>Required<?php } ?>
          </td>
        </tr>
        <tr>
            <td class="tahoma12blacknormal padding_left">Country:</td>
            <td class="tahoma12blacknormal padding_left">
              <select name="country" ONCHANGE="validatePresent(this, 'error_country');" tabindex="7">
			  <option value="">Select Country</option>
			  <option value="india">India</option>			  
              </select>&nbsp;<span id="error_country" class="tahoma10rednormal"><?php if (! not_null ($hms_info_values["hms_info_country"]) ) { ?>Required<?php } ?></span></td>
        </tr>
        <tr>
            <td class="tahoma12blacknormal padding_left">Phone:</td>
            <td><input name="hms_info_phone" type="text" class="tahoma12blacknormal padding_left" id="title" tabindex="8" dir="ltr" size="40%" value="<?php print $hms_info_values["hms_info_phone"]; ?>" ONCHANGE="validatePresent(this, 'error_hms_info_phone');" onKeyPress="return blockNumbers(event)" maxlength="10">&nbsp;&nbsp;<span id="error_hms_info_phone" class="tahoma10rednormal"><?php if (! not_null ($hms_info_values["hms_info_phone"]) ) { ?>Required<?php } ?></span></td>
        </tr>
        <tr>
            <td class="tahoma12blacknormal padding_left">Fax:</td>
            <td><input name="hms_info_fax" type="text" class="tahoma12blacknormal padding_left" id="title" tabindex="9" dir="ltr" size="40%" value="<?php print $hms_info_values["hms_info_fax"]; ?>" ONCHANGE="validatePresent(this, 'error_hms_info_fax');" onKeyPress="return blockNumbers(event)" maxlength="10">
          &nbsp;<span id="error_hms_info_fax" class="tahoma10rednormal"><?php if (! not_null ($hms_info_values["hms_info_fax"]) ) { ?>Required<?php } ?></span></td>
        </tr>
        <tr>
            <td class="tahoma12blacknormal padding_left">Email:</td>
            <td><input name="hms_info_email" type="text" id="title" tabindex="10" class="tahoma12blacknormal padding_left" dir="ltr" size="40%" value="<?php print $hms_info_values["hms_info_email"]; ?>" ONCHANGE="validatePresent(this, 'error_hms_info_email');">
          &nbsp;<span id="error_hms_info_email" class="tahoma10rednormal"><?php if (! not_null ($hms_info_values["hms_info_email"]) ) { ?>Required<?php } ?></span></td>
        </tr>
        <tr>
            <td class="tahoma12blacknormal padding_left">Website:</td>
            <td><input name="hms_info_url" type="text" id="title" tabindex="11" class="tahoma12blacknormal padding_left" dir="ltr" size="40%" value="<?php print $hms_info_values["hms_info_url"]; ?>" ONCHANGE="validatePresent(this, 'error_hms_info_url');">
          &nbsp;<span id="error_hms_info_url" class="tahoma10rednormal"><?php if (! not_null ($hms_info_values["hms_info_url"]) ) { ?>Required<?php } ?></span></td>
        </tr>
        <tr>
            <td class="tahoma12blacknormal padding_left">Active:</td>
          <td><input name="hms_info_active" class="noneborder" type="radio" tabindex="12" value="Y" <? echo $y ?>>
            <span class="tahoma12blacknormal padding_left">Yes</span>
            <input name="hms_info_active" class="noneborder" type="radio" tabindex="13" value="N" <? echo $n ?>>
          <span class="tahoma12blacknormal padding_left">No</span></td>
        </tr>
        <tr>

            <td>&nbsp;</td>
            <td colspan = "2">
                <input style="font-size:11px; color:#e1e1e1; background:#666666; border:1px solid #000; padding:1px 3px 1px 3px;cursor:pointer;" name="buttonSubmit" type="button" tabindex="14" title="Submit" onClick="submitfrmStudentUser(document.frmStudentUser);" value="Submit" >&nbsp;
                <input class="btn_style1" name="buttonCancel" type="button" tabindex="15" title="Cancel" value="Cancel" ONCLICK="document.location.href='<?php echo href_link(FILENAME_HOTEL_INFO, 'page=' . $_GET["page"]); ?>'" style="font-size:11px; color:#e1e1e1; background:#666666; border:1px solid #000; padding:1px 3px 1px 3px;cursor:pointer;"></td>
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
                <td class="tahoma11blacknormal" align="left" style="padding-left:8px; padding-bottom:5px"><img src="images/newfolder.gif" width="16" height="16" align="absbottom" alt="Add Event">&nbsp;&nbsp;<a title="Click to add new hms info add" href="<?php echo href_link(FILENAME_HOTEL_INFO, 'action=hms_info_add'); ?>"><b>Add Hotel Info</b></a></td>
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