<?php
$defaultCountry   = 'Select a Country';
$action = $_POST["action"] ? $_POST["action"] : $_GET["action"];
$page = $_POST["page"] ? $_POST["page"] : $_GET["page"];
if ($action == "services_entry_add" || $action == "services_entry_edit") {
	$services_entry_add = "services_entry_insert";
	$services_entry_edit = "services_entry_update";
if ($action == "services_entry_edit" ) {
    $services_entry_result = $hms_info_obj->servicesEntrySingRec();
    $services_entry_values = db_fetch_array ($services_entry_result);
}
    if ( not_null ( $services_entry_values["active"] ) ) ${$services_entry_values["active"]}= "checked";
    else $Y = "checked";

?>
<form name="frmStudentUser" method="POST" enctype="multipart/form-data" action="<?php echo href_link(FILENAME_SERVICES_ENTRY); ?>">
    <input type="hidden" name="action" value="<?php echo ${$_GET["action"]}; ?>">
   <input type="hidden" name="page" value="<?php echo (isset($page) ? $page : 1); ?>">
    <?php 
    if ( $action =="services_entry_edit" ) {?>
        <input type="hidden" name="id" value="<?php echo $_GET["id"]; ?>">
    <?php } else {?>
		<input type="hidden" name="id">
	<?php } ?>
    <table width="100%" border="0" cellspacing="0" cellpadding="2">
              <tr>
                <td align="left" style="padding-left:6px" class="heading_light_blue" ><img src="images/arrow_heading.gif" />&nbsp;<?php echo TITLE_MANAGE_SERVICES_ENTRY;?></td>
                <td align="left" colspan = "2" valign="top"></td>
              </tr>
        <tr>
            <td colspan="2"></td>
        </tr>
        <tr>
            <td width="16%" class="tahoma12blacknormal padding_left">Department:</td>
            <td width="87%" colspan = "2" class="tahoma12blacknormal padding_left">
             <input name="department" type="text"  id="department" tabindex="1" dir="ltr" size="50%" value="<?php print stripslashes($services_entry_values["hms_services_entry_department"]); ?>" ONCHANGE="validatePresent(this, 'error_department');">&nbsp;<span id="error_department" class="tahoma10rednormal"><?php if (! not_null ($services_entry_values["hms_services_entry_department"]) ) { ?>Required<?php } ?>
          </td>
        </tr>
        <tr>
            <td width="16%" class="tahoma12blacknormal padding_left">Services Name:</td>
            <td width="87%" colspan = "2" class="tahoma12blacknormal padding_left">
             <input name="services_name" type="text"  id="services_name" tabindex="2" dir="ltr" size="50%" value="<?php print stripslashes($services_entry_values["hms_services_entry_name"]); ?>" ONCHANGE="validatePresent(this, 'error_services_name');">&nbsp;<span id="error_services_name" class="tahoma10rednormal"><?php if (! not_null ($services_entry_values["hms_services_entry_name"]) ) { ?>Required<?php } ?>
          </td>
        </tr>
        <tr>
            <td width="13%" class="tahoma12blacknormal padding_left">Charges:</td>
            <td width="87%" colspan = "2" class="tahoma12blacknormal padding_left">
             <input name="charges" type="text"  id="charges" tabindex="3" dir="ltr" size="20%" value="<?php print stripslashes($services_entry_values["hms_services_entry_charges"]); ?>" ONCHANGE="validatePresent(this, 'error_charges');">&nbsp;<span id="error_charges" class="tahoma10rednormal"><?php if (! not_null ($services_entry_values["hms_services_entry_charges"]) ) { ?>Required<?php } ?>
          </td>
        </tr>
        <tr>
            <td class="tahoma12blacknormal padding_left">Active:</td>
          <td width="87%" colspan = "2"><input name="active" class="noneborder" type="radio" tabindex="4" value="Y" <? echo $Y ?>>
            <span class="tahoma12blacknormal padding_left">Yes</span>
            <input name="active" class="noneborder" type="radio" tabindex="5" value="N" <? echo $N ?>>
          <span class="tahoma12blacknormal padding_left">No</span></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td colspan = "2">
                <input style="font-size:11px; color:#e1e1e1; background:#666666; border:1px solid #000; padding:1px 3px 1px 3px;cursor:pointer;" name="buttonSubmit" type="button" tabindex="6" title="Submit" onClick="submitfrmStudentUser(document.frmStudentUser);" value="Submit" >&nbsp;
                <input class="btn_style1" name="buttonCancel" type="button" tabindex="7" title="Cancel" value="Cancel" ONCLICK="document.location.href='<?php echo href_link(FILENAME_SERVICES_ENTRY, 'page=' . $_GET["page"]); ?>'" style="font-size:11px; color:#e1e1e1; background:#666666; border:1px solid #000; padding:1px 3px 1px 3px;cursor:pointer;"></td>
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
                <td class="tahoma11blacknormal" align="left" style="padding-left:8px; padding-bottom:5px"><img src="images/newfolder.gif" width="16" height="16" align="absbottom" alt="Add Event">&nbsp;&nbsp;<a title="Click to add new hms info add" href="<?php echo href_link(FILENAME_SERVICES_ENTRY, 'action=services_entry_add'); ?>"><b>Add Services Entry</b></a></td>
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