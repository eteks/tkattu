<table width="100%" align="center" cellpadding="0" cellspacing="0" class="tableborder">
  <tr>
    <td width="100" height="19"  valign="middle" class="heading_light_blue"><br />
    <img src="images/arrow_heading.gif" />&nbsp;<?php echo TITLE_MANAGE_HMS_BAR;?> </td>
  </tr>
  <tr>

    <td height="30" align="center" valign="middle" class="verdanablack"><br />
<form name="frmStudentUser" method="POST" enctype="multipart/form-data" action="<?php echo href_link(FILENAME_REPORT_BAR); ?>">	
      <table width="84%" border="1" cellpadding="0" cellspacing="0">
          <tr>
            <td><table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC" class="Table_Border_bottom_right">
              <tr >
                <td height="37" colspan="7" align="center" bgcolor="#D7DBB0"><span class="verdanabold"> Report By Bar</span></td>
              </tr>
              <tr >
                <td height="19">&nbsp;</td>
                <td align="right" valign="middle" class="tahoma12blacknormal padding_left">&nbsp;</td>
                <td colspan="2" valign="top"></td>
                <td valign="top" class="tahoma12blacknormal padding_left">&nbsp;</td>
                <td width="36%" colspan="2" valign="top">&nbsp;</td>
                </tr>
              <tr >
                <td width="1%" height="27" valign="middle">&nbsp;</td>
                <td width="15%" align="right" valign="middle" class="tahoma12blacknormal padding_left"><b>From Date :</b></td>
                <td width="35%" align="center" valign="middle"><input type="text" name="ddDateFrom" id="ddDateFrom" value="<?php if (isset($_POST["ddDateFrom"])) { echo $_POST["ddDateFrom"]; }?>" class="selectinput2" /><img src="images/Calendar New.jpg" width="16" height="16" style="cursor:pointer" onClick="return showCalendar('ddDateFrom','%Y-%m-%d',24, true);" /></td>
                
                <td width="9%" valign="middle" class="tahoma12blacknormal padding_left"><b>To Date :</b></td>
                <td width="2%" valign="middle">:</td>
               <td colspan="2" valign="middle"><input type="text" name="ExDate" id="ExDate" value="<?php if (isset($_POST["ExDate"])) { echo $_POST["ExDate"]; }?>" class="selectinput" /><img src="images/Calendar New.jpg" width="16" height="16" style="cursor:                  pointer" onClick="return showCalendar('ExDate','%Y-%m-%d',24, true);" />	     </td>
                </tr>
              <tr class="site_font_black">
                <td height="10" colspan="6"></td>
              </tr>
              <tr>
                <td height="27">&nbsp;</td>
                <td colspan="5" align="center"><input style="font-size:11px; color:#e1e1e1; background:#666666; border:1px solid #000; padding:1px 3px 1px 3px;cursor:pointer;" name="buttonSubmit" type="button" tabindex="4" title="Submit" onClick="order_act_total(document.frmStudentUser);" value="Submit" >
                  &nbsp;
                  <input class="btn_style1" name="buttonCancel" type="button" tabindex="5" title="Cancel" value="Cancel" ONCLICK="document.location.href='<?php echo href_link(FILENAME_DEFAULT, 'page=' . $_GET["page"]); ?>'" style="font-size:11px; color:#e1e1e1; background:#666666; border:1px solid #000; padding:1px 3px 1px 3px;cursor:pointer;">                  <a href="admin_view.php"> </a></td>
                </tr>
              <tr>
                <td height="19" colspan="6">&nbsp;</td>
              </tr>
            </table></td>
          </tr>
      </table>
	  <br />
      <br />
</form>
        </td>
  </tr>
	<?php

	if (isset($_POST["ddDateFrom"]) && $_POST["ddDateFrom"] != "") {

		 $select_acct ="SELECT * FROM hms_bar_order_account_details WHERE ( order_act_date  BETWEEN '" .$_POST["ddDateFrom"] . "' AND '" . $_POST["ExDate"] . "'  ) ";
		
         $select_acct_result = db_query($select_acct); 
		 
	
     if(db_num_rows($select_acct_result)>0) {
	?>  
  <tr>
    <td height="30" align="center" valign="middle" class="verdanablack"><table width="84%" border="1" cellpadding="0" cellspacing="0">
      <tr>
        <td><table width="110%"  border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC" class="Table_Border_bottom_right">
            <tr >
              <td height="37" colspan="6" align="center" bgcolor="#D7DBB0"><span class="verdanabold"> Report By Bar List </span><a href="export_report.php?fn=member_report"> <img src="images/xcomma.gif" border="0"></a></td>
            </tr>
            <tr >
              <td width="24%" height="19" align="center" bgcolor="#666666" class="padding_left tahoma12blacknormal"><strong><span class="verdanabold">Table No</span></strong></td>
              <td width="34%" align="center" bgcolor="#666666" class="padding_left tahoma12blacknormal"><strong><span class="verdanabold">Amount</span></strong></td>
              </tr>
 <?php 		  $hms_info_counter = 1;
			  $i=0;
			  while ($roomReport = db_fetch_array($select_acct_result)) {

			  $tableName = db_query("SELECT `table_entry_id`,`table_type_id`,`table_no`,`numbers_of_chairs`,`active`,`date_added`,`date_modified` FROM " . TABLE_HMS_TABLE_ENTRY . " WHERE table_entry_id = '". trim($roomReport["order_act_table"]) ."'");
			  $Table = db_fetch_array($tableName);
			  						  
              $bgcolor = (($hms_info_counter % 2 == 0) ? FIRSTROWCOLOR : SECONDROWCOLOR);
				     $_SESSION['report_values'][$i][0] = $Table["table_no"];
				     $_SESSION['report_values'][$i][2] = $roomReport["order_act_total"];
				     //$_SESSION['report_values'][$i][4] = $amount;
	  
	?>
             <tr>
				  <td height="19" align="center" class="tahoma11blacknormal" bgcolor="<? echo $bgcolor ?>"><?php echo $Table["table_no"];?></td>
				   <td colspan="2" align="center" class="tahoma11blacknormal" bgcolor="<? echo $bgcolor ?>"><?php echo $roomReport["order_act_total"];?></td>
             </tr>
<?php $hms_info_counter++; 
	  $i = $i+1;
		}
$_SESSION['report_header']=array("TABLE NO","AMOUNT"); 
} else { ?>			  
            <tr>
				  <td height="19" colspan="4" align="center"><font color="red"><strong> No Reports Available </strong></font></td>
			  </tr>
<?php } 

	} 
	?>
        </table></td>
      </tr>
    </table>
    <br /></td>
  </tr>
</table>
