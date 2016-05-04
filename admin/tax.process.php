<?php
require_once ("includes/application_top.php");
checklogin();

$hms_info_obj = new hmsInfo();
$action = $_POST["action"] ? $_POST["action"] : $_GET["action"];
switch ($action) {
    case "tax_update_active":
        $hms_info_obj->taxUpdateActive();
    break;
    case "tax_update_live_active":
        $hms_info_obj->taxUpdateLive();
    break;
}
    $hms_info_db_num_rows = 0;
    $page_num_label = "&nbsp;";
    $hms_info_total_num_rows = $hms_info_obj->getStudentUserTotalRecords();
    $true = 1;
    $page = $_POST["page"] ? $_POST["page"] : $_GET["page"];
    while ($true) {
        $start_limit = ((not_null($page) && $page>1) ? (($page-1) * ROWS_PER_PAGE) : '0');
        $limit_rows = ROWS_PER_PAGE;
        $hms_info_sql = $hms_info_obj->getTaxInfoFetchAllRecords($start_limit,$limit_rows);
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
<form name="frmnewsletter_manageRecords" method="get" action="<? echo href_link(FILENAME_TAX_INFO);?>" style="margin:0px;">
    <input type="hidden" name="action">
    <input type="hidden" name="id">
    <input type="hidden" name="page" value="<? print $page; ?>">

<table width="100%" border="0" cellspacing="0" cellpadding="2" align="center" bgcolor="#FFFFFF">
<tr><td></td></tr>
<tr><td></td></tr>
      <tr>
        <td  colspan="11" ><table border="0" cellspacing="0" cellpadding="0">
			<tr>
			  <td style="padding-left:6px"><img src="images/arrow_heading.gif" /></td>
			  <td align="left" class="heading_light_blue">&nbsp;<?php echo TITLE_MANAGE_TAX_INFO;?></td>
			</tr>
		  </table></td>
      </tr>
   <tr>
      <?php /* ?> <td height="30" colspan="2"><input style="cursor:pointer;" class="buttons" type="button" name="Delete_Selected" value="Delete Selected" disabled onclick="deleteSelectedHmsInfoManageRecord(document.frmnewsletter_manageRecords, 'delete_selected_hmsInfo_manage_records');"></td>  <?php */ ?>
       <td height="30" colspan="2" align="left" class="show" style="padding-left:170px"><? print $page_num_label; ?></td>
       <td height="30" align="left" class="tahoma12blackbold" style="padding-left:180px">&nbsp;</td>
       <td height="30" colspan="6" align="right" class="tahoma12blackbold" style="padding-right: 5px;"><? print $prev_link . $seperator . $next_link;?></td>
      </tr>
      <tr>
         <td colspan="11"><table width="100%" border="0" cellspacing="0" cellpadding="5" class="ntab">
    <tr>
         <?php /* ?>  <th height="27" width="4%" style="text-align:center" ><input type="checkbox" name="All" id="All" class="noneborder" title="Check / Uncheck all" onclick="toggle_all_box(document.frmnewsletter_manageRecords, this.checked);set_button_stat(document.frmnewsletter_manageRecords, 'All', document.frmnewsletter_manageRecords.Delete_Selected);"></th><?php */ ?>
         <th width="32%" style="text-align:center" >Tax Name </th>
		<!--  <th width="32%" style="text-align:center" >Tax Category Name </th> -->
         <th width="36%" style="text-align:center" >Charge </th>
		 <th width="10%" style="text-align:center" >Live </th>
 		 <th width="5%" style="text-align:center" >Active</th>
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
        <?php /* ?>   <td width="4%" style="text-align:center" bgcolor="<? echo $bgcolor ?>"><input type="checkbox" class="noneborder" onclick="change_box_stat(document.frmnewsletter_manageRecords, 'All');set_button_stat(document.frmnewsletter_manageRecords, 'All', document.frmnewsletter_manageRecords.Delete_Selected);" name="newsletter_manage_ids[]" value="<? print $hms_info_values["tax_info_id"]; ?>"></td><?php */ ?>
	
        <td style="text-align:center" width="32%" class="tahoma11blacknormal" bgcolor="<? echo $bgcolor ?>" >
        <? if(strlen($hms_info_values["tax_info_name"]) > 30) echo substr($hms_info_values["tax_info_name"],0,28).".."; else echo $hms_info_values["tax_info_name"]; ?></td>

 
		<td style="text-align:center" width="36%" class="tahoma11blacknormal" bgcolor="<? echo $bgcolor ?>" >
        <? echo $hms_info_values["charge"] . ".00". "
		%"; ?></td>

		<td width="10%" align="center" bgcolor="<? echo $bgcolor ?>" ><a href="javascript:populateHotelInfoManageLists ('<? echo $hms_info_values["tax_info_id"] ?>', 'tax_update_live_active', '<? echo (($hms_info_values["live"] == "Y") ? "N" : "Y"); ?>', '<? print $page ;?>', '');"><img src="images/<? echo $hms_info_values["live"]; ?>.gif" border="0" <? if ($hms_info_values["live"]=='Y'){print "title='Click to disable'";} else { print "title='Click to enable'";}?>></a></td>

		<td width="5%" align="center" bgcolor="<? echo $bgcolor ?>" ><a href="javascript:populateHotelInfoManageLists ('<? echo $hms_info_values["tax_info_id"] ?>', 'tax_update_active', '<? echo (($hms_info_values["active"] == "Y") ? "N" : "Y"); ?>', '<? print $page ;?>', '');"><img src="images/<? echo $hms_info_values["active"]; ?>.gif" border="0" <? if ($hms_info_values["active"]=='Y'){print "title='Click to disable'";} else { print "title='Click to enable'";}?>></a></td>

        <td width="4%" style="text-align:center" bgcolor="<? echo $bgcolor ?>"><a href="<? echo FILENAME_TAX_INFO_VIEW. '?id=' . $hms_info_values["tax_info_id"]; ?>" onClick="return hs.htmlExpand(this, { objectType: 'ajax'} )"><img src="images/view.gif" width="16" height="16" border="0" /></a></td>

        <td width="4%" style="text-align:center" bgcolor="<? echo $bgcolor ?>"><a href="<? echo href_link(FILENAME_TAX_INFO, 'id=' . $hms_info_values["tax_info_id"] . '&action=tax_edit&page=' . $page) ?>"><img src="images/edit.gif" alt="Edit" border="0" title="Click to edit"></a></td>

       <?php /* ?> <td width="5%" style="text-align:center" bgcolor="<? echo $bgcolor ?>"><a href="javascript:deleteHmsInfoManageRecord(document.frmnewsletter_manageRecords, 'tax_manage_delete', '<? echo $hms_info_values["tax_info_id"] ?>')"><img src="images/delete.gif" alt="Delete" border="0" title="Click to delete"></a></td>
	    <?php */ ?>

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
       <td align="left" class="heading_light_blue">&nbsp;<?php echo TITLE_MANAGE_TAX_INFO;?></td>
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
<?
    }
?>
<? require_once('mysql_close.php');?>