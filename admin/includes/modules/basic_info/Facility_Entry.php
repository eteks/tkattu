<?php
$defaultCountry   = 'Select a Country';
$action = $_POST["action"] ? $_POST["action"] : $_GET["action"];
$page = $_POST["page"] ? $_POST["page"] : $_GET["page"];
if ($action == "facility_entry_add" || $action == "facility_entry_edit") {
	$facility_entry_add = "facility_entry_insert";
	$facility_entry_edit = "facility_entry_update";
if ($action == "facility_entry_edit" ) {
    $facility_entry_result = $hms_info_obj->facilityEntrySingRec();
    $facility_entry_values = db_fetch_array ($facility_entry_result);
}
    if ( not_null ( $facility_entry_values["active"] ) ) ${$facility_entry_values["active"]}= "checked";
    else $Y = "checked";

?>
<form name="frmStudentUser" method="POST" enctype="multipart/form-data" action="<?php echo href_link(FILENAME_FACILITY_ENTRY); ?>">
    <input type="hidden" name="action" value="<?php echo ${$_GET["action"]}; ?>">
   <input type="hidden" name="page" value="<?php echo (isset($page) ? $page : 1); ?>">
    <?php 
    if ( $action =="facility_entry_edit" ) {?>
        <input type="hidden" name="id" value="<?php echo $_GET["id"]; ?>">
    <?php } else {?>
		<input type="hidden" name="id">
	<?php } ?>
    <table width="100%" height="152" border="0" cellpadding="2" cellspacing="0">
    <tr><td></td></tr>
    <tr><td></td></tr>
<tr>
<td><span class="heading_light_blue" style="padding-left:6px"><img src="images/arrow_heading.gif" />&nbsp;<?php echo TITLE_MANAGE_FACILITY_ENTRY;?></span></td>
                <td align="left" style="padding-left:6px" class="heading_light_blue" >&nbsp;</td>
      <td align="left" colspan = "2" valign="top"></td>
              </tr>
        <tr>
            <td colspan="2"></td>
        </tr>
        <tr>
            <td width="16%" class="tahoma12blacknormal padding_left">Facility Name:</td>
            <td width="87%" colspan = "2" class="tahoma12blacknormal padding_left">
             <input name="facility_name" type="text"  id="facility_name" tabindex="1" dir="ltr" size="40%" value="<?php print stripslashes($facility_entry_values["hms_facility_entry_name"]); ?>" ONCHANGE="validatePresent(this, 'error_facility_name');">&nbsp;<span id="error_facility_name" class="tahoma10rednormal"><?php if (! not_null ($facility_entry_values["hms_facility_entry_name"]) ) { ?>Required<?php } ?>
			 
          </td>
        </tr>
        <tr>
            <td width="13%" class="tahoma12blacknormal padding_left">Charges:</td>
            <td width="87%" colspan = "2" class="tahoma12blacknormal padding_left">
             <input name="charges" type="text"  id="charges" tabindex="2" dir="ltr" size="20%" value="<?php print stripslashes($facility_entry_values["hms_facility_charges"]); ?>" ONCHANGE="validatePresent(this, 'error_charges');">&nbsp;<span id="error_charges" class="tahoma10rednormal"><?php if (! not_null ($facility_entry_values["hms_facility_charges"]) ) { ?>Required<?php } ?>
          </td>
        </tr>
        <tr>
            <td class="tahoma12blacknormal padding_left">Active:</td>
          <td width="87%" colspan = "2"><input name="active" class="noneborder" type="radio" tabindex="3" value="Y" <? echo $Y ?>>
            <span class="tahoma12blacknormal padding_left">Yes</span>
            <input name="active" class="noneborder" type="radio" tabindex="4" value="N" <? echo $N ?>>
          <span class="tahoma12blacknormal padding_left">No</span></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td colspan = "2">
                <input style="font-size:11px; color:#e1e1e1; background:#666666; border:1px solid #000; padding:1px 3px 1px 3px;cursor:pointer;" name="buttonSubmit" type="button" tabindex="5" title="Submit" onClick="submitfrmStudentUser(document.frmStudentUser);" value="Submit" >&nbsp;
                <input class="btn_style1" name="buttonCancel" type="button" tabindex="6" title="Cancel" value="Cancel" ONCLICK="document.location.href='<?php echo href_link(FILENAME_FACILITY_ENTRY, 'page=' . $_GET["page"]); ?>'" style="font-size:11px; color:#e1e1e1; background:#666666; border:1px solid #000; padding:1px 3px 1px 3px;cursor:pointer;"></td>
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
                <td class="tahoma11blacknormal" align="left" style="padding-left:8px; padding-bottom:5px"><img src="images/newfolder.gif" width="16" height="16" align="absbottom" alt="Add Event">&nbsp;&nbsp;<a title="Click to add new hms info add" href="<?php echo href_link(FILENAME_FACILITY_ENTRY, 'action=facility_entry_add'); ?>"><b>Add Facility Entry</b></a></td>
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