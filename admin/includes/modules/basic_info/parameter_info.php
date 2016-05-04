<?php
$defaultCountry   = 'Select a Country';
$action = $_POST["action"] ? $_POST["action"] : $_GET["action"];
$page = $_POST["page"] ? $_POST["page"] : $_GET["page"];
if ($action == "hms_parameter_add" || $action == "hms_parameter_edit") {
	$hms_parameter_add = "hms_parameter_insert";
	$hms_parameter_edit = "hms_parameter_update";
if ($action == "hms_parameter_edit" ) {
    $parameter_entry_result = $hms_parameter_obj->parameterEntrySingRec();
    $parameter_entry_values = db_fetch_array ($parameter_entry_result);
}
    if ( not_null ( $parameter_entry_values["hms_active"] ) ) ${$parameter_entry_values["hms_active"]}= "checked";
    else $Y = "checked";
?>

<form name="frmStudentUser" method="POST" enctype="multipart/form-data" action="<?php echo href_link(FILENAME_PARAMETER_INFO); ?>">
    <input type="hidden" name="action" value="<?php echo ${$_GET["action"]}; ?>">
   <input type="hidden" name="page" value="<?php echo (isset($page) ? $page : 1); ?>">
    <?php 
    if ( $action =="hms_parameter_edit" ) {?>
        <input type="hidden" name="id" value="<?php echo $_GET["id"]; ?>">
    <?php } else {?>
		<input type="hidden" name="id">
	<?php } ?>
    <table width="100%" border="0" cellspacing="0" cellpadding="2">
          <tr><td></td></tr>
          <tr><td></td></tr>
            <tr>
        <td  colspan="11" ><table border="0" cellspacing="0" cellpadding="0">
			<tr>
			  <td style="padding-left:6px"><img src="images/arrow_heading.gif" /></td>
			  <td align="left" class="heading_light_blue">&nbsp;<?php echo TITLE_MANAGE_PARAMETER_INFO;?></td>
			</tr>
		  </table></td>
      </tr>
        <tr>
            <td width="16%" class="tahoma12blacknormal padding_left">Hotel Name:</td>
            <td width="87%" colspan = "2" class="tahoma12blacknormal padding_left">
             <input name="hms_hotel_name" type="text"  id="hms_hotel_name" tabindex="1" dir="ltr" size="50%" value="<?php echo stripslashes($parameter_entry_values["hms_hotel_name"]); ?>" ONCHANGE="validatePresent(this, 'error_hms_parameter_name');">&nbsp;<span id="error_hms_parameter_name" class="tahoma10rednormal"><?php if (! not_null ($parameter_entry_values["hms_hotel_name"]) ) { ?>Required<?php } ?>
			 
          </td>
        </tr>
		<tr>
            <td width="16%" class="tahoma12blacknormal padding_left">Address1:</td>
            <td width="87%" colspan = "2" class="tahoma12blacknormal padding_left">
             <input name="hms_address1" type="text"  id="hms_address1" tabindex="2" dir="ltr" size="50%" value="<?php print stripslashes($parameter_entry_values["hms_address1"]); ?>" ONCHANGE="validatePresent(this, 'error_hms_address1');">&nbsp;<span id="error_hms_address1" class="tahoma10rednormal">
			 
          </td>
        </tr>
		
		<tr>
            <td width="16%" class="tahoma12blacknormal padding_left">Address2:</td>
            <td width="87%" colspan = "2" class="tahoma12blacknormal padding_left">
             <input name="hms_address2" type="text"  id="hms_address2" tabindex="3" dir="ltr" size="50%" value="<?php print stripslashes($parameter_entry_values["hms_address2"]); ?>" ONCHANGE="validatePresent(this, 'error_hms_address2');">&nbsp;<span id="error_hms_address2" class="tahoma10rednormal">
			 
          </td>
        </tr>
		
	     <tr>
            <td width="16%" class="tahoma12blacknormal padding_left">City:</td>
            <td width="87%" colspan = "2" class="tahoma12blacknormal padding_left">
             <input name="hms_city" type="text"  id="hms_city" tabindex="4" dir="ltr" size="50%" value="<?php print stripslashes($parameter_entry_values["hms_city"]); ?>" ONCHANGE="validatePresent(this,'error_hms_city');">&nbsp;<span id="error_hms_city" class="tahoma10rednormal"><?php if (! not_null ($parameter_entry_values["hms_city"]) ) { ?>Required<?php } ?>
			 
          </td>
        </tr>
		<tr>
            <td width="16%" class="tahoma12blacknormal padding_left">State:</td>
            <td width="87%" colspan = "2" class="tahoma12blacknormal padding_left">
             <input name="hms_state" type="text"  id="hms_state" tabindex="5" dir="ltr" size =  "50%" value="<?php print stripslashes($parameter_entry_values["hms_state"]); ?>" 
			 ONCHANGE="validatePresent(this,'error_hms_state');">&nbsp;<span id="error_hms_state" class="tahoma10rednormal"><?php if (! not_null ($parameter_entry_values["hms_state"]) ) { ?>Required<?php } ?>
			 
          </td>
        </tr>
		<tr>
            <td width="16%" class="tahoma12blacknormal padding_left">Country:</td>
            <td width="87%" colspan = "2" class="tahoma12blacknormal padding_left">
             <input name="hms_country" type="text"  id="hms_country" tabindex="6" dir="ltr" size= "50%" value="<?php print stripslashes($parameter_entry_values["hms_country"]); ?>" ONCHANGE="validatePresent(this,'error_hms_country');">&nbsp;<span id="error_hms_country" class="tahoma10rednormal"><?php if (! not_null ($parameter_entry_values["hms_country"]) ) { ?>Required<?php } ?>
          </td>
        </tr>
		<tr>
            <td width="16%" class="tahoma12blacknormal padding_left">Pincode:</td>
            <td width="87%" colspan = "2" class="tahoma12blacknormal padding_left">
             <input name="hms_pincode" type="text"  id="hms_pincode" tabindex="7" dir="ltr" size= "50%" value="<?php print stripslashes($parameter_entry_values["hms_pincode"]); ?>" 
			 ONCHANGE="validatePresent(this,'error_hms_pincode');">&nbsp;<span id="error_hms_pincode" class="tahoma10rednormal"><?php if (! not_null ($parameter_entry_values["hms_pincode"]) ) { ?>Required<?php } ?>
          </td>
        </tr>
		
        <tr>
            <td width="16%" class="tahoma12blacknormal padding_left">PhoneNo:</td>
            <td width="87%" colspan = "2" class="tahoma12blacknormal padding_left">
                <input name="hms_phone_no" type="text"  id="hms_phone_no" tabindex="8" onkeyup="checkNumber(this);" dir= "ltr" size= "50%" maxlength="15" value="<?php print stripslashes($parameter_entry_values["hms_phone_no"]); ?>"
			  ONCHANGE="validatePresent(this,'error_hms_pincode');">&nbsp;<span id="error_hms_pincode" class="tahoma10rednormal"><?php if (! not_null ($parameter_entry_values["hms_phone_no"]) ) { ?>Required<?php } ?>
          </td>   
        </tr>
         <tr>
            <td width="16%" class="tahoma12blacknormal padding_left">Cell.No:</td>
            <td width="87%" colspan = "2" class="tahoma12blacknormal padding_left">
                <input name="hms_cell_no" type="text"  id="hms_cell_no" tabindex="8" onkeyup="checkNumber(this);" dir= "ltr" size= "50%" maxlength="15" value="<?php print stripslashes($parameter_entry_values["hms_cell_no"]); ?>">
          </td>   
        </tr>
         <tr>
            <td width="16%" class="tahoma12blacknormal padding_left">TIN-NO:</td>
            <td width="87%" colspan = "2" class="tahoma12blacknormal padding_left">
                <input name="hms_tin_no" type="text"  id="hms_tin_no" tabindex="8" onkeyup="checkNumber(this);" dir= "ltr" size= "50%" maxlength="15" value="<?php print stripslashes($parameter_entry_values["hms_tin_no"]); ?>" >
          </td>   
        </tr>
         <tr>
            <td width="16%" class="tahoma12blacknormal padding_left">STC:</td>
            <td width="87%" colspan = "2" class="tahoma12blacknormal padding_left">
                <input name="hms_stc" type="text"  id="hms_stc" tabindex="8" onkeyup="checkNumber(this);" dir= "ltr" size= "50%" maxlength="15" value="<?php print stripslashes($parameter_entry_values["hms_stc"]); ?>" >
          </td>   
        </tr>
		 <tr>
            <td width="16%" class="tahoma12blacknormal padding_left">Url:</td>
            <td width="87%" colspan = "2" class="tahoma12blacknormal padding_left">
             <input name="hms_url" type="text"  id="hms_url" tabindex="9" dir= "ltr" size= "50%" value="<?php print stripslashes($parameter_entry_values["hms_url"]); ?>" ONCHANGE="validatePresent(this,'error_hms_url');">&nbsp;<span id="error_hms_url" class="tahoma10rednormal"><?php if (! not_null ($parameter_entry_values["hms_url"]) ) { ?>Required<?php } ?>
          </td>   
        </tr>
		 <tr>
            <td width="16%" class="tahoma12blacknormal padding_left">Email:</td>
            <td width="87%" colspan = "2" class="tahoma12blacknormal padding_left">
             <input name="hms_email" type="text"  id="hms_email" tabindex="10" dir= "ltr" size= "50%" value="<?php print stripslashes($parameter_entry_values["hms_email"]); ?>" 
			 ONCHANGE="validatePresent(this,'error_hms_email');">&nbsp;<span id="error_hms_email" class="tahoma10rednormal"><?php if (! not_null ($parameter_entry_values["hms_email"]) ) { ?>Required<?php } ?>
          </td>   
        </tr>
		 <tr>
            <td width="16%" class="tahoma12blacknormal padding_left">Footer Text:</td>
            <td width="87%" colspan = "2" class="tahoma12blacknormal padding_left">
             <input name="hms_footertxt" type="text"  id="hms_footertxt" tabindex="11" dir= "ltr" size= "50%" value="<?php print stripslashes($parameter_entry_values["hms_footertxt"]); ?>" 
			 ONCHANGE="validatePresent(this,'error_hms_footertxt');">&nbsp;<span id="error_hms_footertxt" class="tahoma10rednormal"><?php if (! not_null ($parameter_entry_values["hms_footertxt"]) ) { ?>Required<?php } ?>
          </td>   
        </tr>
        <tr>
            <td class="tahoma12blacknormal padding_left">Active:</td>
          <td width="87%" colspan = "2"><input name="hms_active" class="noneborder" type="radio" tabindex="12" value="Y" <? echo $Y ?>>
            <span class="tahoma12blacknormal padding_left">Yes</span>
            <input name="hms_active" class="noneborder" type="radio" tabindex="13" value="N" <? echo $N ?>>
          <span class="tahoma12blacknormal padding_left">No</span></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td colspan = "2">
                <input style="font-size:11px; color:#e1e1e1; background:#666666; border:1px solid #000; padding:1px 3px 1px 3px;cursor:pointer;" name="buttonSubmit" type="button" tabindex="14" title="Submit" onClick="submitfrmStudentUser(document.frmStudentUser);" value="Submit" >&nbsp;
                <input class="btn_style1" name="buttonCancel" type="button" tabindex="15" title="Cancel" value="Cancel" ONCLICK="document.location.href='<?php echo href_link(FILENAME_PARAMETER_INFO, 'page=' . $_GET["page"]); ?>'" style="font-size:11px; color:#e1e1e1; background:#666666; border:1px solid #000; padding:1px 3px 1px 3px;cursor:pointer;"></td>
       </tr>
    </table>
</form>
<?php
} else {
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
 <tr>
  <td bgcolor="#FFFFFF" >
    <div id="parameter_setting_records" ></div>
        <table width="100%" border="0" cellspacing="0" cellpadding="2" align="center">
            <tr>
                <td height="5"></td>
            </tr>
            <!-- <tr>
                <td class="tahoma11blacknormal" align="left" style="padding-left:8px; padding-bottom:5px"><img src="images/newfolder.gif" width="16" height="16" align="absbottom" alt="Add Event">&nbsp;&nbsp;<a title="Click to add new hms parameter add" href="<?php echo href_link(FILENAME_PARAMETER_INFO, 'action=hms_parameter_add '); ?>"><b>Add parameter Entry</b></a></td>
            </tr> -->
        </table>
  </td>
 </tr>
</table>
        <script language="javascript" type="text/javascript">
        <!--//
            populateParameterManageLists('', '', '', '<?=$page?>');
        //-->
    </script>
    <?php
}
?>