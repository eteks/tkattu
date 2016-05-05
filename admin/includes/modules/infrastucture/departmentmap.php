<?php
$action_pos = (isset($_POST["action"]) && !empty($_POST["action"]) ? $_POST["action"]:"");
$action_get = (isset($_GET["action"]) && !empty($_GET["action"]) ? $_GET["action"]:"");
$action     = (isset($action_pos) && !empty($action_pos) ? $action_pos : $action_get);
$page       = (isset($_POST["page"]) && !empty($_POST["page"]) ? $_POST["page"]:"");
$page_get   = (isset($_GET["page"]) && !empty($_GET["page"]) ? $_GET["page"]:"");
if (isset($action) && ($action == "departmentmap_add" || $action == "departmentmap_edit")) {
	$departmentmap_add = "departmentmap_insert";
	$departmentmap_edit = "departmentmap_update";
if (isset($action) && $action == "departmentmap_edit" ) {
    $departmentmap_result = $hms_info_obj->tableTypeSingRec();
    $departmentmap_values = db_fetch_array($departmentmap_result);
}
    if (!empty( $departmentmap_values["active"])) 
    ${$departmentmap_values["active"]}= "checked";
    else $Y = "checked";
    $menu_category = $hms_info_obj->getMenuEntryTree();
    
?>
<form name="frmStudentUser" method="POST" enctype="multipart/form-data" action="<?php echo href_link(FILENAME_DEPT_MAP); ?>">
    <input type="hidden" name="action" value="<?php echo ${$_GET["action"]}; ?>">
   <input type="hidden" name="page" value="<?php echo (isset($page) ? $page : 1); ?>">
    <?php 
    if ( isset($action) && $action =="departmentmap_edit" ) {?>
        <input type="hidden" name="id" value="<?php echo (isset($_GET["id"]) ? $_GET["id"] : ""); ?>">
    <?php } ?>
    <table width="100%" border="0" cellspacing="0" cellpadding="2">
          <tr><td></td></tr>
    <tr><td></td></tr>
	      <tr>
            <td colspan="6" align="left" style="background-image:url(images/back_header_bg.jpg); background-repeat:repeat-x; padding-top:8px; padding-left:0px"><table border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="left" style="padding-left:6px"><img src="images/arrow_heading.gif" /></td>
                <td align="left" class="heading_light_blue" valign="top">&nbsp;<?php echo TITLE_MANAGE_DEPARTMENT_MAPPING;?></td>
              </tr>
            </table></td>
        </tr>
        <tr>
            <td colspan="2"></td>
        </tr>
        <tr>
            <td width="17%" class="tahoma12blacknormal padding_left">Department:</td>
         <td width="83%" colspan = "2" class="tahoma12blacknormal padding_left">
             <?php $departmentmap_id    = (!empty($departmentmap_values["depart_id"]) ? $departmentmap_values["depart_id"]:""); ?>
             <select id="departmentmap_dept" name="departmentmap_dept" onchange="validatePresent(this, 'error_departmentmap_dept');" style="width:175px;" >
                 <option value=""> Select Department </option>
                 <option value="1" <?php if($departmentmap_id==1) echo "selected='selected'" ;?>>Kitchen Center</option>
                 <option value="2" <?php if($departmentmap_id==2) echo "selected='selected'" ;?>>Juice Center</option>
             </select>&nbsp;<span id="error_departmentmap_dept" class="tahoma10rednormal"><? if (!empty($departmentmap_id)) {?>Required<? }?></span>
             </td>
       </tr>
       <tr>
            <td width="17%" class="tahoma12blacknormal padding_left">Menu Category:</td>
         <td width="83%" colspan = "2" class="tahoma12blacknormal padding_left">
             <?php $depart_cate_id = (!empty($menu_type_values["depart_cate_id"]) ? $menu_type_values["depart_cate_id"]:"");
                  echo draw_pull_down_menu ('departmentmap_category', $menu_category, $depart_cate_id, 'tabindex="1" class="normaltext"  id="departmentmap_category" style="width:175px;" ONCHANGE = "validatePresent(this, \'error_departmentmap_categoryy\');"', '','' ); ?>&nbsp;<span id="error_departmentmap_category" class="tahoma10rednormal"><?php  if (!empty($depart_cate_id)) {?>Required<? }?></span>
			
         </td>
       </tr>
        <tr>
            <td width="17%" class="tahoma12blacknormal padding_left">Menu :</td>
            <td width="83%" colspan = "2" class="tahoma12blacknormal padding_left"><?php $depart_item_id    = (!empty($departmentmap_values["depart_item_id"]) ? $departmentmap_values["depart_item_id"]:"");  ;?>
                <select id="departmentmap_menu[]" name="departmentmap_menu[]" multiple onchange="validatePresent(this, 'error_departmentmap_menu');" style="width:175px;" >
                    <?php if($action == "departmentmap_edit"){
                       $select = db_query("SELECT `menu_id`,`menu_name`  FROM " . TABLE_HMS_TABLE_ENTRY . " WHERE active=1 AND menu_category_id='".$depart_cate_id."' ORDER BY `date_added` desc");
                                if(db_num_rows($select)>0)
                                {
                                       echo '<option value="">--Select Menu--</option>';
                                    while($fetch = db_fetch_array($select))
                                    {
                                        $select = ($depart_item_id==$fetch['menu_id'] ? "selected=selected":"");
                                        echo "<option value='".$fetch['menu_id']."' $select >".$fetch['menu_name']."</option>"; 
                                        
                                    }
                                }
                    }?></select>&nbsp;<span id="error_departmentmap_menu" class="tahoma10rednormal"><? if (!empty($depart_item_id)) {?>Required<? }?></span>
         </td>
       </tr>
        <tr>
            <td class="tahoma12blacknormal padding_left">Active:</td>
          <td width="83%" colspan = "2"><input name="active" class="noneborder" type="radio" tabindex="2" value="Y" <?php echo (!empty($Y) ? $Y:""); ?>>
            <span class="tahoma12blacknormal padding_left">Yes</span>
            <input name="active" class="noneborder" type="radio" tabindex="3" value="N" <?php echo (!empty($N) ? $N:""); ?>
          <span class="tahoma12blacknormal padding_left">No</span></td>
      </tr>
        <tr>
            <td>&nbsp;</td>
            <td >
                <input style="font-size:11px; color:#e1e1e1; background:#666666; border:1px solid #000; padding:1px 3px 1px 3px;cursor:pointer;" name="buttonSubmit" type="button" tabindex="4" title="Submit" onClick="submitfrmStudentUser(document.frmStudentUser);" value="Submit" >&nbsp;
                <input class="btn_style1" name="buttonCancel" type="button" tabindex="5" title="Cancel" value="Cancel" ONCLICK="document.location.href='<?php echo href_link(FILENAME_DEPT_MAP, 'page=' . $page_get); ?>'" style="font-size:11px; color:#e1e1e1; background:#666666; border:1px solid #000; padding:1px 3px 1px 3px;cursor:pointer;"></td>
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
                <td class="tahoma11blacknormal" align="left" style="padding-left:8px; padding-bottom:5px"><img src="images/newfolder.gif" width="16" height="16" align="absbottom" alt="Add Event">&nbsp;&nbsp;<a title="Click to add new hms info add" href="<?php echo href_link(FILENAME_DEPT_MAP, 'action=departmentmap_add'); ?>"><b>Add Supplier Mapping</b></a></td>
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