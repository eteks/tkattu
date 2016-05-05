<?php
require_once ("includes/application_top.php");
checklogin();

?>
<table width="100%" align="center" cellpadding="0" cellspacing="0" class="tableborder">
  <tr>
 
    <td width="100" height="19"  valign="middle" class="heading_light_blue"><br />
    <img src="images/arrow_heading.gif" />&nbsp;<?php echo TITLE_MANAGE_HMS_ROOM;?> </td>
  </tr>
  <tr>

    <td align="center" class="heading_light_blue">
      <form name="frmStudentUser" method="POST" enctype="multipart/form-data" action="<?php echo href_link(FILENAME_REPORT_ROOMS); ?>">
<br />
<table width="88%" border="1" cellpadding="0" cellspacing="0">
          <tr>
            <td><table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC" class="Table_Border_bottom_right">
              <tr >
                <td height="37" colspan="8" align="center" bgcolor="#D7DBB0"><span class="verdanabold"> Report By Room</span></td>
              </tr>
              <tr >
                <td height="19">&nbsp;</td>
                <td align="right" valign="middle" class="tahoma12blacknormal padding_left">&nbsp;</td>
                <td valign="top"></td>
                <td width="24%">&nbsp;</td>
                <td valign="top" class="tahoma12blacknormal padding_left">&nbsp;</td>
                <td valign="top">&nbsp;</td>
                <td colspan="2">&nbsp;</td>
              </tr>
              <tr >
                <td width="10%" height="27" valign="middle">&nbsp;</td>
                <td width="17%" align="right" valign="middle" class="tahoma12blacknormal padding_left"><b>From Date :</b></td>
                <td width="1%" valign="middle"></td>
                
                <td valign="middle"><input type="text" name="ddDateFrom" id="ddDateFrom" value="<?php if (isset($_POST["ddDateFrom"])) { echo $_POST["ddDateFrom"]; }?>" class="selectinput2" /><img src="images/Calendar New.jpg" width="16" height="16"                 style="cursor:pointer" onClick="return showCalendar('ddDateFrom','%Y-%m-%d',24, true);" /></td>
                <td width="10%" valign="middle" class="tahoma12blacknormal padding_left"><b>To Date :</b></td>
                <td valign="middle">&nbsp;</td>
                
                <td colspan="2" valign="middle"><input type="text" name="ExDate" id="ExDate" value="<?php if (isset($_POST["ExDate"])) { echo $_POST["ExDate"]; }?>" class="selectinput" /><img src="images/Calendar New.jpg" width="16" height="16" style="cursor:                  pointer" onClick="return showCalendar('ExDate','%Y-%m-%d',24, true);" />	     </td>
              </tr>
              <tr class="site_font_black">
                <td height="10" colspan="7"></td>
              </tr>
              <tr>
                <td height="27">&nbsp;</td>
                <td colspan="2">&nbsp;</td>
                <td align="center" colspan="3"><input style="font-size:11px; color:#e1e1e1; background:#666666; border:1px solid #000; padding:1px 3px 1px 3px;cursor:pointer;" name="buttonSubmit" type="button" tabindex="4" title="Submit" onClick="submitfrmStudentUser(document.frmStudentUser);" value="Submit" >&nbsp;
                  <input class="btn_style1" name="buttonCancel" type="button" tabindex="5" title="Cancel" value="Cancel" onclick="document.location.href='<?php echo href_link(FILENAME_DEFAULT, 'page=' . $_GET["page"]); ?>'" style="font-size:11px; color:#e1e1e1; background:#666666; border:1px solid #000; padding:1px 3px 1px 3px;cursor:pointer;" /></td>
                <td width="36%"><a href="admin_view.php"> </a></td>
              </tr>
              <tr>
                <td height="19" colspan="7">&nbsp;</td>
              </tr>
            </table></td>
          </tr>
      </table>
	  </form>
        <br />
    <br /></td>
  </tr>
	<?php
	
	if (isset($_POST["ddDateFrom"]) && $_POST["ddDateFrom"] != "") {
				
		  $select_acct ="SELECT * FROM hms_booking_status WHERE ( created_on  BETWEEN '" .$_POST["ddDateFrom"] . "' AND '" . $_POST["ExDate"] . "'  ) ";
		
		  $select_acct_result = db_query($select_acct); 
	
		
     if(db_num_rows($select_acct_result)>0) {
	?>  
  <tr>
    <td height="30" align="center" valign="middle" class="verdanablack"><table width="88%" border="1" cellpadding="0" cellspacing="0">
      <tr>
        <td><table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC" class="Table_Border_bottom_right">
            <tr >
              <td height="37" colspan="7" align="center" bgcolor="#D7DBB0"><span class="verdanabold"> Report By Room List </span><a href="export_report.php?fn=member_report"> <img src="images/xcomma.gif" border="0"></a></td>
            </tr>
            <tr >
              <td width="24%" height="19" align="center" bgcolor="#666666" class="padding_left tahoma12blacknormal"><strong><span class="verdanabold">Date</span></strong></td>
              <td colspan="2" align="center" bgcolor="#666666" class="padding_left tahoma12blacknormal"><strong><span class="verdanabold">Room No</span></strong> </td>
              <td width="30%" align="center" bgcolor="#666666" class="padding_left tahoma12blacknormal"><strong><span class="verdanabold">Status</span></strong></td>
              <td width="17%" align="center" bgcolor="#666666" class="tahoma12blacknormal padding_left"><strong>View</strong></td>
            </tr>
 <?php 		  $hms_info_counter = 1;
			  $i=0;
			  while ($roomReport = db_fetch_array($select_acct_result)) {
			  
				if (isset($roomReport["status"]) && $roomReport["status"]=="B") { $status = "Booking"; } 
				else if(isset($roomReport["status"]) && $roomReport["status"]=="BC") { $status = "Booking Cancel";} 
				else if(isset($roomReport["status"]) && $roomReport["status"]=="C") { $status = "CheckIn";}	
						  
              $bgcolor = (($hms_info_counter % 2 == 0) ? FIRSTROWCOLOR : SECONDROWCOLOR);
				     $_SESSION['report_values'][$i][0] = $roomReport["created_on"];
				     $_SESSION['report_values'][$i][2] = $roomReport["rooms_no"];
				     $_SESSION['report_values'][$i][4] = $status;
					 $roomdate =  explode('-',$roomReport["created_on"]);
                      $date2 =  $roomdate[2] . "-" . $roomdate[1]. "-" . $roomdate[0];

	  
	?>
             <tr>
				  <td height="19" align="center" class="tahoma11blacknormal" bgcolor="<? echo $bgcolor ?>"><?php echo $date2;?></td>
				  <td colspan="2" align="center" class="tahoma11blacknormal" bgcolor="<? echo $bgcolor ?>"><?php echo $roomReport["rooms_no"];?></td>
				  <td align="center" valign="top" bgcolor="<? echo $bgcolor ?>" class="tahoma11blacknormal"><?php if (isset($roomReport["status"]) && $roomReport["status"]=="B") { echo "Booking"; } else if(isset($roomReport["status"]) && $roomReport["status"]=="BC") { echo "Booking Cancel";} else if(isset($roomReport["status"]) && $roomReport["status"]=="C") { echo "CheckIn";}?></td>
                  
             <td align="center" valign="top" bgcolor="<? echo $bgcolor ?>" <a href="javascript:void(0);" onClick="javascript:getViewList('<? echo $roomReport["customer_id"]; ?>','<?php echo $roomReport["status"];?>');">View </a></td>
                  
         
             </tr>
<?php $hms_info_counter++; 
	  $i = $i+1;
		}
$_SESSION['report_header']=array("DATE","ROOM NO","STATUS"); 
} else { ?>			  
            <tr>
				  <td height="19" colspan="5" align="center"><font color="red"><strong> No Reports Available </strong></font></td>
			  </tr>
<?php } }?>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>
