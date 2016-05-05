<?php
$defaultCountry   = 'Select a Country';

$action_pos = (isset($_POST["action"]) && !empty($_POST["action"]) ? $_POST["action"]:"");
$action_get = (isset($_GET["action"]) && !empty($_GET["action"]) ? $_GET["action"]:"");
$action = (isset($action_pos) && !empty($action_pos) ? $action_pos : $action_get);
$page = (isset($_POST["page"]) && !empty($_POST["page"]) ? $_POST["page"]:"");
if (isset($action) && ($action == "table_type_add" || $action == "table_type_edit")) {
	$table_type_add = "table_type_insert";
	$table_type_edit = "table_type_update";
if (isset($action) && $action == "table_type_edit" ) {
    $table_type_result = $hms_info_obj->tableTypeSingRec();
    $table_type_values = db_fetch_array ($table_type_result);
}
    if (  !empty( $table_type_values["active"] ) ) 
    ${$table_type_values["active"]}= "checked";
    else $Y = "checked";

?>
<form name="frmStudentUser" method="POST" enctype="multipart/form-data" action="<?php echo href_link(FILENAME_TABLE_TYPE); ?>">
    <input type="hidden" name="action" value="<?php echo ${$_GET["action"]}; ?>">
   <input type="hidden" name="page" value="<?php echo (isset($page) ? $page : 1); ?>">
    <?php 
    if ( isset($action) && $action =="table_type_edit" ) {?>
        <input type="hidden" name="id" value="<?php echo $_GET["id"]; ?>">
    <?php } ?>
    <table width="100%" border="0" cellspacing="0" cellpadding="2">
          <tr><td></td></tr>
    <tr><td></td></tr>
	      <tr>
            <td colspan="6" align="left" style="background-image:url(images/back_header_bg.jpg); background-repeat:repeat-x; padding-top:8px; padding-left:0px"><table border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="left" style="padding-left:6px"><img src="images/arrow_heading.gif" /></td>
                <td align="left" class="heading_light_blue" valign="top">&nbsp;<?php echo TITLE_MANAGE_TABLE_TYPE_CREATION;?></td>
              </tr>
            </table></td>
        </tr>
        <tr>
            <td colspan="2"></td>
        </tr>
        <tr>
            <td width="17%" class="tahoma12blacknormal padding_left">Table Type Name:</td>
         <td width="83%" colspan = "2" class="tahoma12blacknormal padding_left"><?php $table_type_valuess = (!empty($table_type_values["table_type_name"]) ? $table_type_values["table_type_name"] :"") ;?>
           <input name="table_type_name" type="text"  id="table_type_name" tabindex="1" dir="ltr" size="60%" value="<?php print stripslashes($table_type_valuess); ?>" ONCHANGE="validatePresent(this, 'error_table_type_name');">&nbsp;<span id="error_table_type_name" class="tahoma10rednormal"><?php if (!empty($table_type_valuess) ) { ?>Required<?php } ?>
          </td>
      </tr>
        <tr>
            <td class="tahoma12blacknormal padding_left">Active:</td>
          <td width="83%" colspan = "2"><input name="active" class="noneborder" type="radio" tabindex="2" value="Y" <?php echo (!empty($Y) ? $Y:""); ?>>
            <span class="tahoma12blacknormal padding_left">Yes</span>
            <input name="active" class="noneborder" type="radio" tabindex="3" value="N" <?php echo (!empty($N) ? $N:""); ?> >
          <span class="tahoma12blacknormal padding_left">No</span></td>
      </tr>
        <tr>
            <td>&nbsp;</td>
            <td >
                <input style="font-size:11px; color:#e1e1e1; background:#666666; border:1px solid #000; padding:1px 3px 1px 3px;cursor:pointer;" name="buttonSubmit" type="button" tabindex="4" title="Submit" onClick="submitfrmStudentUser(document.frmStudentUser);" value="Submit" >&nbsp;
                <input class="btn_style1" name="buttonCancel" type="button" tabindex="5" title="Cancel" value="Cancel" ONCLICK="document.location.href='<?php echo href_link(FILENAME_TABLE_TYPE, 'page=' . $_GET["page"]); ?>'" style="font-size:11px; color:#e1e1e1; background:#666666; border:1px solid #000; padding:1px 3px 1px 3px;cursor:pointer;"></td>
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
                <td class="tahoma11blacknormal" align="left" style="padding-left:8px; padding-bottom:5px"><img src="images/newfolder.gif" width="16" height="16" align="absbottom" alt="Add Event">&nbsp;&nbsp;<a title="Click to add new hms info add" href="<?php echo href_link(FILENAME_TABLE_TYPE, 'action=table_type_add'); ?>"><b>Add Table Type</b></a></td>
            </tr>
        </table>
  </td>
 </tr>
</table>
        <script language="javascript" type="text/javascript">
        <!--//
            populateHotelInfoManageLists('', '', '', '<?php echo $page ;?>');
        //-->
    </script>
    <?php
}
?>