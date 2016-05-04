<?php
$defaultCountry   = 'Select a Country';
$action_pos = (isset($_POST["action"]) && !empty($_POST["action"]) ? $_POST["action"]:"");
$action_get = (isset($_GET["action"]) && !empty($_GET["action"]) ? $_GET["action"]:"");
$action = (isset($action_pos) && !empty($action_pos) ? $action_pos : $action_get);

$page = (isset($_POST["page"]) && !empty($_POST["page"]) ? $_POST["page"] : "");
$page_get = (isset($_GET["page"]) && !empty($_GET["page"]) ? $_GET["page"] : "");

if ($action == "menu_entry_add" || $action == "menu_entry_edit") {
    $menu_entry_add = "menu_entry_insert";
    $menu_entry_edit = "menu_entry_update";
if ($action == "menu_entry_edit" ) {
    $menu_type_values = $hms_info_obj->menuEntrySingRec();
   // $menu_type_values = db_fetch_array ($menu_type_result);
} if(isset($menu_type_values) && !empty($menu_type_values))
    if ( not_null ( $menu_type_values["active"] ) ) ${$menu_type_values["active"]}= "checked";
    else $Y = "checked"; 
    $menu_category = $hms_info_obj->getMenuEntryTree();
     
 
 //$menu_sub_category = $hms_info_obj->getsubMenuEntryTree();


 //$menu_sub_category = $hms_info_obj->getsubMenuEntryTree();
?>

<form name="frmStudentUser" method="POST" enctype="multipart/form-data" action="<?php echo href_link(FILENAME_MENU_ENTRY); ?>">
    <input type="hidden" name="action" value="<?php echo ${$_GET["action"]}; ?>">
   <input type="hidden" name="page" value="<?php echo (isset($page) ? $page : 1); ?>">
    <?php 
    if ( $action =="menu_entry_edit" ) {?>
        <input type="hidden" name="id" value="<?php echo $_GET["id"]; ?>">
    <?php } ?>
    <table width="100%" border="0" cellspacing="0" cellpadding="2">
          <tr><td></td></tr>
    <tr><td></td></tr>
          <tr>
            <td colspan="6" align="left" style="background-image:url(images/back_header_bg.jpg); background-repeat:repeat-x;">
                <table border="0" cellspacing="0" cellpadding="0">
                    <tr>
                         <td align="left" style="padding-left:6px"><img src="images/arrow_heading.gif" /></td>
                         <td align="left" class="heading_light_blue" valign="top">&nbsp;<?php echo TITLE_MANAGE_MENU_ENTRY;?></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="2"></td>
        </tr>
<?php //echo $menu_type_values["menu_category_id"]; ?>
        <tr>
            <td width="15%" class="tahoma12blacknormal padding_left">Menu Category:</td>
            <td width="85%" colspan = "2" class="tahoma12blacknormal padding_left">
    <?php  
    $menu_category_id = (!empty($menu_type_values["menu_category_id"]) ? $menu_type_values["menu_category_id"]:"");
    echo draw_pull_down_menu ('menu_category', $menu_category, $menu_category_id, 'tabindex="1" class="normaltext"  id="menu_category" style="width:175px;" ONCHANGE = "validatePresent(this, \'error_menu_category\');"', '','' ); ?>&nbsp;<span id="error_menu_category" class="tahoma10rednormal"><?php  if (!empty($menu_category_id)) {?>Required<? }?></span>

            </td>
        </tr>
		
		 <tr>
            <td colspan="2"></td>
        </tr>

     <?php /*?>   <tr>
            <td width="15%" class="tahoma12blacknormal padding_left">Menu Sub Category:</td>
            <td width="85%" colspan = "2" class="tahoma12blacknormal padding_left">
				
	<div id="menu"> 
  <?php   $tax_edit=db_query("SELECT * FROM " . TABLE_HMS_MENUSUBCATEGORY_CREATION." WHERE hms_menu_category_id='".$menu_type_values["menu_category_id"]."'"); ?>
	<select name='menu_sub_category' id='menu_sub_category' >
<option value='0'>-Select a Menu Category-</option>
<?php 
while ($rs = db_fetch_array($tax_edit)) { ?>
<option <?php if( $menu_type_values["hms_menu_sub_category_id"]==$rs["hms_menu_sub_category_id"]) echo 'selected="selected"'; ?> value="<?php echo $rs["hms_menu_sub_category_id"]; ?>"><?php echo $rs["hms_menu_sub_category_name"]; ?></option>
<?php }  ?>
</select>

	<?php echo draw_pull_down_menu ('menu_sub_category', $menu_sub_category, $menu_type_values["hms_menu_sub_category_id"], 'tabindex="1" class="normaltext" id="menu_sub_category_id" style="width:175px;" '); ?>
    
    </div>
			
            <div id="output1"></div>
            </td>
        </tr><?php */?>
	<tr style="display:none;">
            <td width="17%" class="tahoma12blacknormal padding_left">Menu Department:</td>
         <td width="83%" colspan = "2" class="tahoma12blacknormal padding_left">
             <?php $menu_type_values_dept    = (!empty($menu_type_values["depart_id"]) ? $menu_type_values["depart_id"]:""); ?>
             <select id="menu_dept" name="menu_dept" onchange="validatePresent(this, 'error_menu_dept');" style="width:175px;" >
                 <option value="1" <?php if($menu_type_values_dept==1) echo "selected='selected'" ;?>>Kitchen Center</option>
                 
             </select>&nbsp;<span id="error_menu_dept" class="tahoma10rednormal"><? if (!empty($menu_type_values_dept)) {?>Required<? }?></span>
             </td>
       </tr>
        <tr>
            <td width="15%" class="tahoma12blacknormal padding_left">Menu Name:</td>
            <td width="85%" colspan = "2" class="tahoma12blacknormal padding_left"><?php $menu_type_values_name    = (!empty($menu_type_values["menu_name"]) ? $menu_type_values["menu_name"]:""); ?>
             <input name="menu_name" type="text"  id="menu_name" tabindex="2" dir="ltr" size="30%" value="<?php  print stripslashes($menu_type_values_name); ?>" ONCHANGE="validatePresent(this, 'error_menu_name');">&nbsp;<span id="error_menu_name" class="tahoma10rednormal"><?php  if (!empty($menu_type_values_name) ) { ?>Required<?php } ?>
          </td>
        </tr> 
         <tr>
            <td width="15%" class="tahoma12blacknormal padding_left">Item Code:</td>
            <td width="85%" colspan = "2" class="tahoma12blacknormal padding_left"><?php $menu_type_values_code    = (!empty($menu_type_values["item_code"]) ? $menu_type_values["item_code"]:""); ?>
             <input name="item_code" type="text"  id="item_code" tabindex="2" dir="ltr" size="30%" value="<?php  print stripslashes($menu_type_values_code); ?>" ONCHANGE="validatePresent(this, 'error_item_code');">&nbsp;<span id="error_item_code" class="tahoma10rednormal"><?php  if (!empty($menu_type_values_code) ) { ?>Required<?php } ?>
          </td>
        </tr> 
       
       <!--<tr>
            <td width="15%" class="tahoma12blacknormal padding_left">Actual Price:</td>
            <td width="85%" colspan = "2" class="tahoma12blacknormal padding_left">
             <input name="actual_price" type="text"  id="actual_price" tabindex="2" dir="ltr" size="30%" value="<?php if(isset($menu_type_values) && !empty($menu_type_values)) print stripslashes($menu_type_values["actual_price"]); ?>"  ONCHANGE="validatePresent(this, 'error_actual_price');">&nbsp;<span id="error_actual_price" class="tahoma10rednormal"><?php if(isset($menu_type_values) && !empty($menu_type_values)) if (!empty($menu_type_values["actual_price"]) ) { ?>Required<?php } ?>
          </td>
        </tr>-->
        
	    <tr>
            <td width="15%" class="tahoma12blacknormal padding_left">Menu Price:</td>
            <td width="85%" colspan = "2" class="tahoma12blacknormal padding_left"><?php $menu_type_values_price    = (!empty($menu_type_values["menu_price"]) ? $menu_type_values["menu_price"]:""); ?>
             <input name="menu_price" type="text"  id="menu_price" tabindex="2" dir="ltr" size="30%" value="<?php  print stripslashes($menu_type_values_price); ?>"  ONCHANGE="validatePresent(this, 'error_menu_price');">&nbsp;<span id="error_menu_price" class="tahoma10rednormal"><?php if (!empty($menu_type_values_price) ) { ?>Required<?php } ?>
          </td>
        </tr>
         <tr>
            <td width="15%" class="tahoma12blacknormal padding_left">Menu Reorder Level:</td>
            <td width="85%" colspan = "2" class="tahoma12blacknormal padding_left"><?php  $menu_type_values_qty    = (!empty($menu_type_values["menu_reorder_level"]) ? $menu_type_values["menu_reorder_level"]:""); ?>
             <input name="menu_reorder_level" type="text"  id="menu_reorder_level" tabindex="2" dir="ltr" size="30%" value="<?php  print stripslashes($menu_type_values_qty); ?>" >
          </td>
        </tr>
       <?php /* ?> <tr>
            <td width="15%" class="tahoma12blacknormal padding_left">Menu Tax:</td>
            <td width="85%" colspan = "2" class="tahoma12blacknormal padding_left">
             <input name="menu_tax" type="text"  id="menu_tax" tabindex="2" dir="ltr" size="30%" value="<?php print stripslashes($menu_type_values["tax"]); ?>"  ONCHANGE="validatePresent(this, 'error_menu_tax');">&nbsp;<span id="error_menu_tax" class="tahoma10rednormal"><?php if (! not_null ($menu_type_values["tax"]) ) { ?>Required<?php } ?>
          </td>
        </tr>
        <?php */ ?>
        <tr>
            <td class="tahoma12blacknormal padding_left">Active:</td>
          <td width="85%" colspan = "2"><input name="active" class="noneborder" type="radio" tabindex="3" value="Y" checked <?php echo (!empty($Y) ? $Y:""); ?>>
            <span class="tahoma12blacknormal padding_left">Yes</span>
            <input name="active" class="noneborder" type="radio" tabindex="4" value="N" <?php echo (!empty($N) ? $N:""); ?>>
          <span class="tahoma12blacknormal padding_left">No</span></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>
                <input style="font-size:11px; color:#e1e1e1; background:#666666; border:1px solid #000; padding:1px 3px 1px 3px;cursor:pointer;" name="buttonSubmit" type="button" tabindex="5" title="Submit" onClick="submitfrmStudentUser(document.frmStudentUser);" value="Submit" >&nbsp;
                <input class="btn_style1" name="buttonCancel" type="button" tabindex="6" title="Cancel" value="Cancel" ONCLICK="document.location.href='<?php echo href_link(FILENAME_MENU_ENTRY, 'page=' . $page_get); ?>'" style="font-size:11px; color:#e1e1e1; background:#666666; border:1px solid #000; padding:1px 3px 1px 3px;cursor:pointer;">
			</td>
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
                <td class="tahoma11blacknormal" align="left" style="padding-left:8px; padding-bottom:5px"><img src="images/newfolder.gif" width="16" height="16" align="absbottom" alt="Add Event">&nbsp;&nbsp;<a title="Click to add new hms info add" href="<?php echo href_link(FILENAME_MENU_ENTRY, 'action=menu_entry_add'); ?>"><b>Add Menu Entry</b></a></td>
            </tr>
        </table>
  </td>
 </tr>
</table>
        <script language="javascript" type="text/javascript">
        <!--//
            populateHotelInfoManageLists('', '', '', '<?php $page?>');
        //-->
		
		
    </script>
    <?php
}?>
