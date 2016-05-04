<?php
require_once ("includes/application_top.php");
checklogin();
$hms_parameter_obj = new hmsparameter();
$action = $_POST["action"] ? $_POST["action"] : $_GET["action"];
switch ($action) {
    case "hms_parameter_update_active":
        $hms_parameter_obj->getHmsParameterUpdateActive();
    break;
}
    $hms_parameter_db_num_rows = 0;
    $page_num_label = "&nbsp;";
    $hms_parameter_total_num_rows = $hms_parameter_obj->getParameterInfoTotalRecords();
    $true = 1;
    $page = $_POST["page"] ? $_POST["page"] : $_GET["page"];
    while ($true) {
        $start_limit = ((not_null($page) && $page>1) ? (($page-1) * ROWS_PER_PAGE) : '0');
        $limit_rows = ROWS_PER_PAGE;
        $hms_parameter_sql = $hms_parameter_obj->ParameterFetchAllRecords($start_limit,$limit_rows);
        $hms_parameter_db_num_rows = db_num_rows( $hms_parameter_sql );
        if ($page>1 && $hms_parameter_db_num_rows == 0) {
            $page = $page-1;
            $true = 1;
        } else $true = 0;
    }
    $page_num_label.= (($page && $hms_parameter_db_num_rows) ? ("<span class='page_num_label'>Showing ". ($start_limit+1) . " to ". ($start_limit + (($hms_parameter_db_num_rows == (ROWS_PER_PAGE + 1)) ? ($hms_parameter_db_num_rows-1) : $hms_parameter_db_num_rows)) . " out of  ".$hms_parameter_total_num_rows ." records </span>") : "");
    $hbgcolor = TITLEROWCOLOR;
    $next_link = (($hms_parameter_db_num_rows == $limit_rows) ? '<a class="navigation" href="javascript:populateParameterManageLists(\'\', \'\', \'\', \''.($page+1) .'\')">Next</a>' : '');
    $prev_link = (($page>1) ? '<a class="navigation" href="javascript:populateParameterManageLists(\'\', \'\', \'\', \''.($page-1).'\')">Prev</a>' : '');
    $seperator = (($prev_link!="" && $next_link!="") ? " <span class='seperator'>|</span> " : "");
    ?>
    <?php
    if ($hms_parameter_db_num_rows > 0) {
?>
<form name="frmnewsletter_manageRecords" method="get" action="<? echo href_link(FILENAME_PARAMETER_INFO);?>" style="margin:0px;">
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
			  <td align="left" height="20" class="heading_light_blue">&nbsp;<?php echo TITLE_MANAGE_PARAMETER_INFO;?></td>
			</tr>
		  </table></td>
      </tr>
   <tr>
       <td height="65" colspan="2"><input style="cursor:pointer;" class="buttons" type="button" name="Delete_Selected" value="Delete Selected" disabled onClick="deleteSelectedHmsparameterManageRecord(document.frmnewsletter_manageRecords, 'delete_selected_hmsparameter_manage_records');"></td>
       <td height="30" colspan="2" align="left" class="show" style="padding-left:170px"><? print $page_num_label; ?></td>
       <td height="30" align="left" class="tahoma12blackbold" style="padding-left:180px">&nbsp;</td>
       <td height="30" colspan="6" align="right" class="tahoma12blackbold" style="padding-right: 5px;"><? print $prev_link . $seperator . $next_link ;?></a></td>
      </tr>
      <tr>
         <td colspan="11"><table width="100%" border="0" cellspacing="0" cellpadding="5" class="ntab">
    <tr>
         <th height="27" width="4%" style="text-align:center" ><input type="checkbox" name="All" id="All" class="noneborder" title="Check / Uncheck all" onClick="toggle_all_box(document.frmnewsletter_manageRecords, this.checked);set_button_stat(document.frmnewsletter_manageRecords, 'All', document.frmnewsletter_manageRecords.Delete_Selected);"></th>
         <th width="25%" style="text-align:center" >Hotel Name</th>
        <th style="text-align:center" class="tahoma12whitebold">Created Date</th>
        <th style="text-align:center" class="tahoma12whitebold">Last Modified Date</th>
		<th width="6%" style="text-align:center" >Active</th>
         <th width="5%" style="text-align:center" >View</th>
         <th style="text-align:center" colspan="3">Action</th>
    </tr>
    <?php    
        $hms_parameter_counter = 1;
        while ($hms_parameter_values = db_fetch_array($hms_parameter_sql)) {
        if ($hms_parameter_counter > ROWS_PER_PAGE) break;
              $bgcolor = (($hms_parameter_counter % 2 == 0) ? FIRSTROWCOLOR : SECONDROWCOLOR);
    ?> 
  
    <tr>
        <td width="4%" style="text-align:center" bgcolor="<? echo $bgcolor ?>"><input type="checkbox" class="noneborder" onClick="change_box_stat(document.frmnewsletter_manageRecords, 'All');set_button_stat(document.frmnewsletter_manageRecords, 'All', document.frmnewsletter_manageRecords.Delete_Selected);" name="newsletter_manage_ids[]" value="<? print $hms_parameter_values["hms_parameter_id"]; ?>"></td>

		<td width="25%" style="text-align:center" class="tahoma11blacknormal" bgcolor="<? echo $bgcolor ?>">
         <? if(strlen($hms_parameter_values["hms_hotel_name"]) > 80)
		  echo substr( stripslashes($hms_parameter_value["hms_hotel_name"]),0,80).".."; else echo  stripslashes(          $hms_parameter_values["hms_hotel_name"]); ?></td>	

        <td width = "25%" style="text-align:center" class="tahoma11blacknormal" bgcolor="<?php echo $bgcolor; ?>"><?php echo date_long( $hms_parameter_values["date_added"] ); ?></td>

        <td width = "26%" style="text-align:center" class="tahoma11blacknormal" bgcolor="<?php echo $bgcolor; ?>"><?php echo date_long( $hms_parameter_values["date_modified"] ); ?></td>
		
		<td width="6%" align="center" bgcolor="<? echo $bgcolor ?>" ><a href="javascript:populateParameterManageLists ('<? echo $hms_parameter_values["hms_parameter_id"] ?>', 'hms_parameter_update_active', '<? echo (($hms_parameter_values["hms_active"] == "Y") ? "N" : "Y"); ?>', '<? print $page ;?>', '');"><img src="images/<? echo $hms_parameter_values["hms_active"]; ?>.gif" border="0" <? if ($hms_parameter_values["hms_active"]=='Y'){print "title='Click to disable'";} else { print "title='Click to enable'";}?>></a></td>

        <td width="5%" style="text-align:center" bgcolor="<? echo $bgcolor ?>"><a href="<? echo FILENAME_PARAMETER_INFO_VIEW . '?id=' . $hms_parameter_values["hms_parameter_id"]; ?>" onClick="return hs.htmlExpand(this, { objectType: 'ajax'} )"><img src="images/view.gif" width="16" height="16" border="0" /></a></td>

        <td width="4%" style="text-align:center" bgcolor="<? echo $bgcolor ?>"><a href="<? echo href_link(FILENAME_PARAMETER_INFO, 'id=' . $hms_parameter_values["hms_parameter_id"] . '&action=hms_parameter_edit&page=' . $page) ?>"><img src="images/edit.gif" alt="Edit" border="0" title="Click to edit"></a></td>

        <!-- <td width="5%" style="text-align:center" bgcolor="<? echo $bgcolor ?>"><a href="javascript:deleteHmsParameterManageRecord(document.frmnewsletter_manageRecords, 'hms_parameter_manage_delete', '<? echo $hms_parameter_values["hms_parameter_id"] ?>')"><img src="images/delete.gif" alt="Delete" border="0" title="Click to delete"></a>--></td>
  </tr>
    <?php
          $hms_parameter_counter++;
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
			  <td align="left" class="heading_light_blue">&nbsp;<?php echo TITLE_MANAGE_PARAMETER_INFO;?></td>
			</tr>
		  </table>
	</td>
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