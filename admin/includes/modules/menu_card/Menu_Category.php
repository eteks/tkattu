<?php
$defaultCountry   = 'Select a Country';
$action = $_POST["action"] ? $_POST["action"] : $_GET["action"];
$page = $_POST["page"] ? $_POST["page"] : $_GET["page"];
if ($action == "menucategory_add" || $action == "menucategory_edit") {
	$menucategory_add = "menucategory_insert";
	$menucategory_edit = "menucategory_update";
if ($action == "menucategory_edit" ) {
    $student_user_result = $hms_info_obj->menucaegorySingRec();
    $student_user_values = db_fetch_array ($student_user_result);
}
    if ( not_null ( $student_user_values["active"] ) ) ${$student_user_values["active"]}= "checked";
    else $Y = "checked";

?>
<form name="frmStudentUser" method="POST" enctype="multipart/form-data" action="<?php echo href_link(FILENAME_MENU_CATEGORY); ?>">
    <input type="hidden" name="action" value="<?php echo ${$_GET["action"]}; ?>">
   <input type="hidden" name="page" value="<?php echo (isset($page) ? $page : 1); ?>">
    <?php 
    if ( $action =="menucategory_edit" ) {?>
        <input type="hidden" name="id" value="<?php echo $_GET["id"]; ?>">
    <?php } ?>
    <table width="100%" border="0" cellspacing="0" cellpadding="2">
    <tr><td></td></tr>
    <tr><td></td></tr>
	      <tr>
            <td colspan="6" align="left" style="background-image:url(images/back_header_bg.jpg); background-repeat:repeat-x; padding-top:8px; padding-left:0px"><table border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="left" style="padding-left:6px"><img src="images/arrow_heading.gif" /></td>
                <td align="left" class="heading_light_blue" valign="top">&nbsp;<?php echo TITLE_MANAGE_MENU_CATEGORY;?></td>
              </tr>
            </table></td>
        </tr>
        <tr>
            <td colspan="2"></td>
        </tr>
<tr>
<td width="13%" class="tahoma12blacknormal padding_left"> Menu Category:</td>
<td width="87%" colspan = "2" class="tahoma12blacknormal padding_left">
 <input name="menucategory_name" type="text"  id="menucategory_name" tabindex="1" dir="ltr" size="60%" value="<?php print stripslashes($student_user_values["hms_menu_category_name"]); ?>" 
        ONCHANGE="validatePresent(this, 'error_menucategory_name');">&nbsp;<span id="error_menucategory_name" class="tahoma10rednormal"><?php if (! not_null ($student_user_values["hms_menu_category_name"]) ) { ?>Required<?php } ?>
</td>
</tr>
<tr style="display:none;">
<td width="13%" class="tahoma12blacknormal padding_left">Session:</td>
<td width="87%" colspan = "2" class="tahoma12blacknormal padding_left">
 <select id="menu_session" name="menu_session" onchange="validatePresent(this, 'error_menu_session');" style="width:175px;" >
                 <option value=""> Select Session </option>
                 <option value="B" <?php if($student_user_values["session"]=='B') echo "selected='selected'" ;?>>Breakfast</option>
                 <option value="L" <?php if($student_user_values["session"]=="L") echo "selected='selected'" ;?>>Lunch</option>
                 <option value="S" <?php if($student_user_values["session"]=="S") echo "selected='selected'" ;?>>Snacks</option>
                 <option value="D" <?php if($student_user_values["session"]=="D") echo "selected='selected'" ;?>>Dinner</option>
             </select>&nbsp;<span id="error_menu_session" class="tahoma10rednormal"><?php if (! not_null ($student_user_values["session"]) ) { ?>Required<?php } ?></span></td>
</tr>
<tr>
<td width="13%" class="tahoma12blacknormal padding_left">Icon:</td>
<td width="87%" colspan = "2" class="tahoma12blacknormal padding_left">
<input type="file" id="normalicon" name="normalicon" /> 
<?php if($_REQUEST['action']=='menucategory_edit'){?>
<input type="hidden" id="normaliconedit" name="normaliconedit" value="<?php echo $student_user_values["hms_menu_icon"];?>" /> 
<?php if(!empty($student_user_values["hms_menu_icon"])){?><img src="../images/categoryicon/<?php echo $student_user_values["hms_menu_icon"];?>" style="width:25px;" /><?php }}?>
&nbsp;<span id="error_normalicon" class="tahoma10rednormal"><?php if (!empty($student_user_values["hms_menu_icon"]) ) { ?>Required<?php } ?></span></td>
</tr>
<tr style="display:none;">
<td width="13%" class="tahoma12blacknormal padding_left">Active Icon:</td>
<td width="87%" colspan = "2" class="tahoma12blacknormal padding_left">
<input type="file" id="activeicon" name="activeicon" /> 
<?php if($_REQUEST['action']=='menucategory_edit'){?>
<input type="hidden" id="activeiconedit" name="activeiconedit" value="<?php echo $student_user_values["hms_menu_icon_active"];?>" /> 
<?php if(!empty($student_user_values["hms_menu_icon_active"])){?><img src="../images/categoryicon/<?php echo $student_user_values["hms_menu_icon_active"];?>" style="width:25px;" /><?php }}?>
&nbsp;<span id="error_activeicon" class="tahoma10rednormal"><?php if (! not_null ($student_user_values["hms_menu_icon_active"]) ) { ?>Required<?php } ?></span>
</td>
</tr>
        
            <tr>
            <td width="13%" class="tahoma12blacknormal padding_left"> VAT Tax:</td>
            <td width="87%" colspan = "2" class="tahoma12blacknormal padding_left">
  
                
 <input name="vat_tax" type="text"  id="vat_tax" tabindex="1" dir="ltr" size="60%" value="<?php print stripslashes($student_user_values["vat_tax"]); ?>"  ONCHANGE="validatePresent(this, 'error_vat_tax');">&nbsp;<span id="error_vat_tax" class="tahoma10rednormal"><?php if (! not_null ($student_user_values["vat_tax"]) ) { ?>Required<?php } ?>        
          </td>
        </tr>
        
        
            <tr>
            <td width="13%" class="tahoma12blacknormal padding_left"> CST Tax:</td>
            <td width="87%" colspan = "2" class="tahoma12blacknormal padding_left">
             <input name="service_tax" type="text"  id="service_tax" tabindex="1" dir="ltr" size="60%" value="<?php print stripslashes($student_user_values["service_tax"]); ?>"  ONCHANGE="validatePresent(this, 'error_service_tax');">&nbsp;<span id="error_service_tax" class="tahoma10rednormal"><?php if (! not_null ($student_user_values["service_tax"]) ) { ?>Required<?php } ?>        
          </td>
        </tr>
        
        
		 <tr>
<!--		<tr><td>&nbsp;&nbsp;</td>
		<td><input name="taxable" type="checkbox" tabindex="2" value="YES" <?php if ($student_user_values["taxable"] == "YES") { ?>checked="checked" <?php } ?>/>
		<font class="tahoma12blacknormal padding_left">Taxable</font> </td></tr>-->
<input name="taxable" type="hidden" tabindex="2" value="YES"/>		
        <tr>
            <td class="tahoma12blacknormal padding_left">Active:</td>
          <td width="87%" colspan = "2"><input name="active" class="noneborder" type="radio" tabindex="3" value="Y" <? echo $Y ?>>
            <span class="tahoma12blacknormal padding_left">Yes</span>
            <input name="active" class="noneborder" type="radio" tabindex="4" value="N" <? echo $N ?>>
          <span class="tahoma12blacknormal padding_left">No</span></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td >
                <input style="font-size:11px; color:#e1e1e1; background:#666666; border:1px solid #000; padding:1px 3px 1px 3px;cursor:pointer;" name="buttonSubmit" type="button" tabindex="5" title="Submit" onClick="submitfrmStudentUser(document.frmStudentUser);" value="Submit" >&nbsp;
                <input class="btn_style1" name="buttonCancel" type="button" tabindex="6" title="Cancel" value="Cancel" ONCLICK="document.location.href='<?php echo href_link(FILENAME_MENU_CATEGORY, 'page=' . $_GET["page"]); ?>'" style="font-size:11px; color:#e1e1e1; background:#666666; border:1px solid #000; padding:1px 3px 1px 3px;cursor:pointer;"></td>
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
                <td height="20"></td>
            </tr>
            <tr>
                <td class="tahoma11blacknormal" align="left" style="padding-left:8px; padding-bottom:5px"><img src="images/newfolder.gif" width="16" height="16" align="absbottom" alt="Add Event">&nbsp;&nbsp;<a title="Click to add new hms info add" href="<?php echo href_link(FILENAME_MENU_CATEGORY, 'action=menucategory_add'); ?>"><b>Add Menu Category</b></a></td>
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