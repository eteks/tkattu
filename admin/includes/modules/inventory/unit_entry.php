<?php
$defaultCountry   = 'Select a Country';
$action = $_POST["action"] ? $_POST["action"] : $_GET["action"];
$page = $_POST["page"] ? $_POST["page"] : $_GET["page"];
if ($action == "unit_add" || $action == "unit_edit") {
	$unit_add = "unit_insert";
	$unit_edit = "unit_update";
if ($action == "unit_edit" ) {
    $student_user_result = $hms_info_obj->unitSingRec();
    $student_user_values = db_fetch_array ($student_user_result);
}
    if ( not_null ( $student_user_values["active"] ) ) ${$student_user_values["active"]}= "checked";
    else $Y = "checked";

?>
<form name="frmStudentUser" method="POST" enctype="multipart/form-data" action="<?php echo href_link(FILENAME_UNIT_ENTRY); ?>">
    <input type="hidden" name="action" value="<?php echo ${$_GET["action"]}; ?>">
   <input type="hidden" name="page" value="<?php echo (isset($page) ? $page : 1); ?>">
    <?php 
    if ( $action =="unit_edit" ) {?>
        <input type="hidden" name="id" value="<?php echo $_GET["id"]; ?>">
    <?php } ?>
    <table width="100%" border="0" cellspacing="0" cellpadding="2">
    <tr><td></td></tr>
    <tr><td></td></tr>
	      <tr>
            <td colspan="6" align="left" style="background-image:url(images/back_header_bg.jpg); background-repeat:repeat-x;"><table border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="left" style="padding-left:6px"><img src="images/arrow_heading.gif" /></td>
                <td align="left" class="heading_light_blue" valign="top">&nbsp;<?php echo TITLE_MANAGE_UNIT_ENTRY?></td>
              </tr>
            </table></td>
        </tr>
        <tr>
            <td colspan="2"></td>
        </tr>
        <tr>
            <td width="13%" class="tahoma12blacknormal padding_left"> Unit:</td>
            <td width="87%" colspan = "2" class="tahoma12blacknormal padding_left">
             <input name="unit_name" type="text"  id="unit_name" tabindex="1" dir="ltr" size="60%" value="<?php print stripslashes($student_user_values["unit_name"]); ?>" ONCHANGE="validatePresent(this, 'error_unit_name');">&nbsp;<span id="error_unit_name" class="tahoma10rednormal"><?php if (! not_null ($student_user_values["unit_name"]) ) { ?>Required<?php } ?>
          </td>
        </tr>
		        <tr>
            <td class="tahoma12blacknormal padding_left">Active:</td>
          <td width="87%" colspan = "2"><input name="active" class="noneborder" type="radio" tabindex="2" value="Y" <? echo $Y ?>>
            <span class="tahoma12blacknormal padding_left">Yes</span>
            <input name="active" class="noneborder" type="radio" tabindex="3" value="N" <? echo $N ?>>
          <span class="tahoma12blacknormal padding_left">No</span></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td >
                <input style="font-size:11px; color:#e1e1e1; background:#666666; border:1px solid #000; padding:1px 3px 1px 3px;cursor:pointer;" name="buttonSubmit" type="button" tabindex="4" title="Submit" onClick="submitfrmStudentUser(document.frmStudentUser);" value="Submit" >&nbsp;
                <input class="btn_style1" name="buttonCancel" type="button" tabindex="5" title="Cancel" value="Cancel" ONCLICK="document.location.href='<?php echo href_link(FILENAME_UNIT_ENTRY, 'page=' . $_GET["page"]); ?>'" style="font-size:11px; color:#e1e1e1; background:#666666; border:1px solid #000; padding:1px 3px 1px 3px;cursor:pointer;"></td>
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
                <td height="100" class="tahoma11blacknormal" align="left" style="padding-left:8px; padding-bottom:5px"><img src="images/newfolder.gif" width="16" height="16" align="absbottom" alt="Add Event">&nbsp;&nbsp;<a title="Click to add new hms info add" href="<?php echo href_link(FILENAME_UNIT_ENTRY, 'action=unit_add'); ?>"><b>Add unit</b></a></td>
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