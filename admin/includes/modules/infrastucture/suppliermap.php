<?php
$action_pos = (isset($_POST["action"]) && !empty($_POST["action"]) ? $_POST["action"]:"");
$action_get = (isset($_GET["action"]) && !empty($_GET["action"]) ? $_GET["action"]:"");
$action     = (isset($action_pos) && !empty($action_pos) ? $action_pos : $action_get);
$page       = (isset($_POST["page"]) && !empty($_POST["page"]) ? $_POST["page"]:"");
$page_get   = (isset($_GET["page"]) && !empty($_GET["page"]) ? $_GET["page"]:"");
if (isset($action) && ($action == "suppliermap_add" || $action == "suppliermap_edit")) {
	$suppliermap_add = "suppliermap_insert";
	$suppliermap_edit = "suppliermap_update";
if (isset($action) && $action == "suppliermap_edit" ) {
    $suppliermap_result = $hms_info_obj->tableTypeSingRec();
    $suppliermap_values = db_fetch_array($suppliermap_result);
}
    if (!empty( $suppliermap_values["active"])) 
    ${$suppliermap_values["active"]}= "checked";
    else $Y = "checked";
    $suppliermap_type       = $hms_info_obj->getTableTypeTree();
    $suppliermap_supplier   = $hms_info_obj->getSupplierTree();

?>
<form name="frmStudentUser" method="POST" enctype="multipart/form-data" action="<?php echo href_link(FILENAME_SUPPLIER_MAP); ?>">
    <input type="hidden" name="action" value="<?php echo ${$_GET["action"]}; ?>">
   <input type="hidden" name="page" value="<?php echo (isset($page) ? $page : 1); ?>">
    <?php 
    if ( isset($action) && $action =="suppliermap_edit" ) {?>
        <input type="hidden" name="id" value="<?php echo (isset($_GET["id"]) ? $_GET["id"] : ""); ?>">
    <?php } ?>
    <table width="100%" border="0" cellspacing="0" cellpadding="2">
          <tr><td></td></tr>
    <tr><td></td></tr>
	      <tr>
            <td colspan="6" align="left" style="background-image:url(images/back_header_bg.jpg); background-repeat:repeat-x; padding-top:8px; padding-left:0px"><table border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="left" style="padding-left:6px"><img src="images/arrow_heading.gif" /></td>
                <td align="left" class="heading_light_blue" valign="top">&nbsp;<?php echo TITLE_MANAGE_SUPPLIER_MAPPING;?></td>
              </tr>
            </table></td>
        </tr>
        <tr>
            <td colspan="2"></td>
        </tr>
        <tr>
            <td width="17%" class="tahoma12blacknormal padding_left">Table Type:</td>
         <td width="83%" colspan = "2" class="tahoma12blacknormal padding_left">
             <?php    $suppliermap_type_id    = (!empty($suppliermap_values["table_type_id"]) ? $suppliermap_values["table_type_id"]:"");
                      echo draw_pull_down_menu ('suppliermap_type', $suppliermap_type, $suppliermap_type_id, 'tabindex="1" class="normaltext" id="suppliermap_type" style="width:175px;" ONCHANGE = "validatePresent(this, \'error_suppliermap_type\');"', '',''); ?>&nbsp;<span id="error_suppliermap_type" class="tahoma10rednormal"><? if (!empty($suppliermap_type_id)) {?>Required<? }?></span>			
             </td>
       </tr>
        <tr>
            <td width="17%" class="tahoma12blacknormal padding_left">Table:</td>
            <td width="83%" colspan = "2" class="tahoma12blacknormal padding_left"><?php $table_no_id    = (!empty($suppliermap_values["table_no_id"]) ? $suppliermap_values["table_no_id"]:"");?>
                <select id="suppliermap_table" name="suppliermap_table" onchange="validatePresent(this, 'error_suppliermap_table');" style="width:175px;" >
                    <?php  if($action == "suppliermap_edit"){
                       $select = db_query("SELECT `table_entry_id`,`table_no`  FROM " . TABLE_HMS_TABLE_ENTRY . " WHERE active=1 AND table_type_id='".$suppliermap_type_id."' ORDER BY `date_added` desc");
                                if(db_num_rows($select)>0)
                                {
                                       echo '<option value="">--Select Table--</option>';
                                    while($fetch = db_fetch_array($select))
                                    {?>
                                        <option value='<?php echo $fetch['table_entry_id'];?>' <?php if($table_no_id==$fetch['table_entry_id']) {echo "selected='selected'" ;}?>  ><?php echo $fetch['table_no'];?></option>
                                        
                                    <?php }
                                }
                    }?></select>&nbsp;<span id="error_suppliermap_table" class="tahoma10rednormal"><? if (!empty($table_no_id)) {?>Required<? }?></span>
         </td>
       </tr>
        <tr>
            <td width="17%" class="tahoma12blacknormal padding_left">Supplier:</td>
         <td width="83%" colspan = "2" class="tahoma12blacknormal padding_left">
             <?php    $suppliermap_supplier_id    = (!empty($suppliermap_values["supplier_id"]) ? $suppliermap_values["supplier_id"]:"");
                      echo draw_pull_down_menu ('suppliermap_supplier', $suppliermap_supplier, $suppliermap_supplier_id, 'tabindex="1" class="normaltext" id="suppliermap_supplier" style="width:175px;" ONCHANGE = "validatePresent(this, \'error_suppliermap_supplier\');"', '',''); ?>&nbsp;<span id="error_suppliermap_supplier" class="tahoma10rednormal"><? if (!empty($suppliermap_supplier_id)) {?>Required<? }?></span>			
         </td>
       </tr>
        <tr>
            <td class="tahoma12blacknormal padding_left">Active:</td>
          <td width="83%" colspan = "2"><input name="active" class="noneborder" type="radio" tabindex="2" value="Y" <?php echo (!empty($Y) ? $Y:""); ?>>
            <span class="tahoma12blacknormal padding_left">Yes</span>
            <input name="active" class="noneborder" type="radio" tabindex="3" value="N" <?php echo (!empty($N) ? $N:""); ?>>
          <span class="tahoma12blacknormal padding_left">No</span></td>
      </tr>
        <tr>
            <td>&nbsp;</td>
            <td >
                <input style="font-size:11px; color:#e1e1e1; background:#666666; border:1px solid #000; padding:1px 3px 1px 3px;cursor:pointer;" name="buttonSubmit" type="button" tabindex="4" title="Submit" onClick="submitfrmStudentUser(document.frmStudentUser);" value="Submit" >&nbsp;
                <input class="btn_style1" name="buttonCancel" type="button" tabindex="5" title="Cancel" value="Cancel" ONCLICK="document.location.href='<?php echo href_link(FILENAME_SUPPLIER_MAP, 'page=' . $page_get); ?>'" style="font-size:11px; color:#e1e1e1; background:#666666; border:1px solid #000; padding:1px 3px 1px 3px;cursor:pointer;"></td>
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
                <td class="tahoma11blacknormal" align="left" style="padding-left:8px; padding-bottom:5px"><img src="images/newfolder.gif" width="16" height="16" align="absbottom" alt="Add Event">&nbsp;&nbsp;<a title="Click to add new hms info add" href="<?php echo href_link(FILENAME_SUPPLIER_MAP, 'action=suppliermap_add'); ?>"><b>Add Supplier Mapping</b></a></td>
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