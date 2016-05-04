<?php
require_once ("includes/application_top.php");
checklogin();
$hms_info_obj = new hmsInfo();
$action = $_POST["action"] ? $_POST["action"] : $_GET["action"];
switch ($action) {
    case "menu_card_update_active":
        $hms_info_obj->MenuCardUpdateActive();
    break;
   /*case "check":
        echo $hms_info_obj->updatestatus();
           break;*/
   
    /*case "menu_entry_insert":
        echo $hms_info_obj->checkDuplicate('insert');
        exit;
    break;
    case "menu_entry_update":
        echo $hms_info_obj->checkDuplicate('update');
        exit;
    break;*/
}
    $hms_info_db_num_rows = 0;
    $page_num_label = "&nbsp;";
    $hms_info_total_num_rows = $hms_info_obj->getMenuCardTotalRecords();
    $true = 1;
    $page = $_POST["page"] ? $_POST["page"] : $_GET["page"];
    while ($true) {
        $start_limit = ((not_null($page) && $page>1) ? (($page-1) * ROWS_PER_PAGE):'0');
        $limit_rows = ROWS_PER_PAGE;
        $hms_info_sql = $hms_info_obj->MenuCardFetchAllRecords($start_limit,$limit_rows);
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
	
    if ($hms_info_db_num_rows > 0) {
?>
<form name="frmnewsletter_manageRecords" method="get" action="<? echo href_link(FILENAME_MENU_CARD);?>" style="margin:0px;">
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
			  <td align="left" height="20" class="heading_light_blue">&nbsp;<?php echo TITLE_MANAGE_MENU_CARD_CREATION;?></td>
			</tr>
		  </table></td>
      </tr>
      
         <td colspan="11"><table width="100%" border="0" cellspacing="0" cellpadding="5" class="ntab">
 
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
       <td align="left" class="heading_light_blue">&nbsp;<?php echo TITLE_MANAGE_MENU_CARD_CREATION;?></td>
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