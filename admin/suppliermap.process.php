<?php
require_once ("includes/application_top.php");
checklogin();

$hms_info_obj = new hmsInfo();
$action_pos = (isset($_POST["action"]) && !empty($_POST["action"]) ? $_POST["action"]:"");
$action_get = (isset($_GET["action"]) && !empty($_GET["action"]) ? $_GET["action"]:"");
$action = (isset($action_pos) && !empty($action_pos) ? $action_pos : $action_get);
switch ($action) {
    case "suppliermap_update_active":
        $hms_info_obj->tableTypeUpdateActive();
    break;
    case "suppliermap_insert":
        echo $hms_info_obj->checkDuplicate('insert');
        exit;
    break;
    case "suppliermap_update":
        echo $hms_info_obj->checkDuplicate('update');
        exit;
    break;
}

    $hms_info_db_num_rows = 0;
    $page_num_label = "&nbsp;";
    $hms_info_total_num_rows = $hms_info_obj->getTableTypeTotalRecords();
    $true = 1;
    $page = (isset($_POST["page"]) && !empty($_POST["page"]) ? $_POST["page"] : "");
    $page_get = (isset($_GET["page"]) && !empty($_GET["page"]) ? $_GET["page"] : "");
    $page = (isset($_POST["page"]) && !empty($_POST["page"]) ? $page : $page_get);
    while ($true) {
        $start_limit = ((not_null($page) && $page>1) ? (($page-1) * ROWS_PER_PAGE) : '0');
        $limit_rows = ROWS_PER_PAGE;
        $hms_info_sql = $hms_info_obj->tableTypeFetchAllRecords($start_limit,$limit_rows);
        $hms_info_db_num_rows = db_num_rows( $hms_info_sql );
        if ($page>1 && $hms_info_db_num_rows == 0) {
            $page = $page-1;
            $true = 1;
        } else $true = 0;
    }

    $page_num_label.= (($page && $hms_info_db_num_rows) ? ("<span class='page_num_label'>Showing ". ($start_limit+1) . " to ". ($start_limit + (($hms_info_db_num_rows == (ROWS_PER_PAGE + 1)) ? ($hms_info_db_num_rows-1) : $hms_info_db_num_rows)) . " out of  ".$hms_info_total_num_rows ." records </span>") : "");
    $hbgcolor = TITLEROWCOLOR;
    $next_link = (($hms_info_db_num_rows == $limit_rows) ? '<a class="navigation" href="javascript:populateHotelInfoManageLists(\'\', \'\', \'\', \''.($page+1) .'\')">Next</a>' : '');
    $prev_link = (($page>1) ? '<a class="navigation" href="javascript:populateHotelInfoManageLists(\'\', \'\', \'\', \''.($page-1).'\')">Prev</a>' : '');
    $seperator = (($prev_link!="" && $next_link!="") ? " <span class='seperator'>|</span> " : "");
    ?>
    <?php
    if ($hms_info_db_num_rows > 0) {
?>
<form name="frmnewsletter_manageRecords" method="get" action="<? echo href_link(FILENAME_SUPPLIER_MAP);?>" style="margin:0px;">
    <input type="hidden" name="action">
    <input type="hidden" name="id">
    <input type="hidden" name="page" value="<? print $page; ?>">

<table width="100%" border="0" cellspacing="0" cellpadding="2" align="center" bgcolor="#FFFFFF">
<tr><td></td></tr>
<tr><td></td></tr>
      <tr>
        <td  colspan="13" ><table border="0" cellspacing="0" cellpadding="0">
			<tr>
			  <td style="padding-left:6px"><img src="images/arrow_heading.gif" /></td>
			  <td align="left" height="20" class="heading_light_blue">&nbsp;<?php echo TITLE_MANAGE_SUPPLIER_MAPPING;?></td>
			</tr>
		  </table></td>
      </tr>
   <tr>
       <td height="65" colspan="2"><input style="cursor:pointer;" class="buttons" type="button" name="Delete_Selected" value="Delete Selected" disabled onclick="deleteSelectedHmsInfoManageRecord(document.frmnewsletter_manageRecords, 'delete_selected_hmsInfo_manage_records');"></td>
       <td height="30" colspan="2" align="left" class="show" style="padding-left:170px"><?php echo $page_num_label; ?></td>
       <td height="30" align="left" class="tahoma12blackbold" style="padding-left:180px">&nbsp;</td>
       <td height="30" colspan="6" align="right" class="tahoma12blackbold" style="padding-right: 5px;"><? print $prev_link . $seperator . $next_link;?></td>
      </tr>
      <tr>
         <td colspan="13"><table width="100%" border="0" cellspacing="0" cellpadding="5" class="ntab">
    <tr>
         <th height="27" width="5%" style="text-align:center" ><input type="checkbox" name="All" id="All" class="noneborder" title="Check / Uncheck all" onclick="toggle_all_box(document.frmnewsletter_manageRecords, this.checked);set_button_stat(document.frmnewsletter_manageRecords, 'All', document.frmnewsletter_manageRecords.Delete_Selected);"></th>
         <th width="19%" style="text-align:center" >Table Type</th>
         <th width="19%" style="text-align:center" >Table</th>
         <th width="19%" style="text-align:center" >Supplier</th>
        <th style="text-align:center" class="tahoma12whitebold">Created Date</th>
        <th style="text-align:center" class="tahoma12whitebold">Last Modified Date</th>
		<th width="6%" style="text-align:center" >Active</th>
         <th width="4%" style="text-align:center" >View</th>
         <th style="text-align:center" colspan="3">Action</th>
    </tr>
    <?php    
        $hms_info_counter = 1;
        while ($hms_info_values = db_fetch_array($hms_info_sql)) {
        if ($hms_info_counter > ROWS_PER_PAGE) break;
              $bgcolor = (($hms_info_counter % 2 == 0) ? FIRSTROWCOLOR : SECONDROWCOLOR);
    ?> 
    <tr>
        <td width="5%" style="text-align:center" bgcolor="<? echo $bgcolor ?>"><input type="checkbox" class="noneborder" onclick="change_box_stat(document.frmnewsletter_manageRecords, 'All');set_button_stat(document.frmnewsletter_manageRecords, 'All', document.frmnewsletter_manageRecords.Delete_Selected);" name="newsletter_manage_ids[]" value="<?php print $hms_info_values["suppliermap_id"]; ?>"></td>
	
        <td style="text-align:center" width="19%" class="tahoma11blacknormal" bgcolor="<?php echo $bgcolor ?>" >
        <?php if(strlen($hms_info_values["table_type_name"]) > 30) echo substr(stripslashes($hms_info_values["table_type_name"]),0,28).".."; else echo stripslashes($hms_info_values["table_type_name"]); ?></td>
        <td style="text-align:center" width="19%" class="tahoma11blacknormal" bgcolor="<?php echo $bgcolor ?>" >
        <?php if(strlen($hms_info_values["table_no"]) > 30) echo substr(stripslashes($hms_info_values["table_no"]),0,28).".."; else echo stripslashes($hms_info_values["table_no"]); ?></td>
        <td style="text-align:center" width="19%" class="tahoma11blacknormal" bgcolor="<?php echo $bgcolor ?>" >
        <?php if(strlen($hms_info_values["supplier_name"]) > 30) echo substr(stripslashes($hms_info_values["supplier_name"]),0,28).".."; else echo stripslashes($hms_info_values["supplier_name"]); ?></td>
        <td width = "26%" style="text-align:center" class="tahoma11blacknormal" bgcolor="<?php echo $bgcolor; ?>"><?php echo date_long( $hms_info_values["date_added"] ); ?></td>

        <td width = "28%" style="text-align:center" class="tahoma11blacknormal" bgcolor="<?php echo $bgcolor; ?>"><?php echo date_long( $hms_info_values["date_modified"] ); ?></td>
		
        <td width="6%" align="center" bgcolor="<? echo $bgcolor ?>" ><a href="javascript:populateHotelInfoManageLists ('<?php echo $hms_info_values["suppliermap_id"] ?>', 'suppliermap_update_active', '<?php echo (($hms_info_values["active"] == "Y") ? "N" : "Y"); ?>', '<? print $page ;?>', '');"><img src="images/<?php echo $hms_info_values["active"]; ?>.gif" border="0" <?php if ($hms_info_values["active"]=='Y'){print "title='Click to disable'";} else { print "title='Click to enable'";}?>></a></td>

        <td width="4%" style="text-align:center" bgcolor="<? echo $bgcolor ?>"><a href="<?php echo FILENAME_SUPPLIER_MAP_VIEW . '?id=' . $hms_info_values["suppliermap_id"]; ?>" onClick="return hs.htmlExpand(this, { objectType: 'ajax'} )"><img src="images/view.gif" width="16" height="16" border="0" /></a></td>

        <td width="6%" style="text-align:center" bgcolor="<? echo $bgcolor ?>"><a href="<?php echo href_link(FILENAME_SUPPLIER_MAP, 'id=' . $hms_info_values["suppliermap_id"] . '&action=suppliermap_edit&page=' . $page) ?>"><img src="images/edit.gif" alt="Edit" border="0" title="Click to edit"></a></td>

        <td width="6%" style="text-align:center" bgcolor="<? echo $bgcolor ?>"><a href="javascript:deleteHmsInfoManageRecord(document.frmnewsletter_manageRecords, 'suppliermap_manage_delete', '<?php echo $hms_info_values["suppliermap_id"] ?>')"><img src="images/delete.gif" alt="Delete" border="0" title="Click to delete"></a></td>

  </tr>
    <?php
          $hms_info_counter++;
        }
    ?>
    </table></td></tr>
   </table>
</form>
<?php    
    }  else {
?>
<table width="100%" border="0" cellspacing="0" cellpadding="2" align="center">
  <tr>
   <td colspan="10" height="30" class="gray_headline"><table border="0" cellspacing="0" cellpadding="0">
     <tr>
       <td style="padding-left:6px"><img src="images/arrow_heading.gif" /></td>
       <td align="left" class="heading_light_blue">&nbsp;<?php echo TITLE_MANAGE_SUPPLIER_MAPPING;?></td>
     </tr>
   </table></td>
  </tr>
  <tr>
   <td colspan="10" height="27"  bgcolor='<?php echo TITLEROWCOLOR ;?>'>&nbsp;</td>
  </tr>
  <tr>
   <td colspan="10" height="30" bgcolor='<?php echo SECONDROWCOLOR ;?>' align="center" class="heading_light_blue">No Record Found </td>
  </tr>
</table>
   <?php } require_once('mysql_close.php');?>