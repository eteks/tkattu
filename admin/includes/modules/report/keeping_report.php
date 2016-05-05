
<table width="93%" align="center" cellpadding="0" cellspacing="0" class="tableborder">
  <tr>
          <td width="100" height="19" align="center" valign="middle" class="verdanabold">&nbsp; </td>
  </tr>
  <tr>
         <td>
  <tr>
		      <td class="tahoma12blacknormal padding_left" align="right"><img height="16" width="16" border="0" align="absmiddle" src="images/arrow-l.gif"/><a href="<? echo href_link(FILENAME_ROOM_REPORT)?>">
  <b>BACK TO MAIN LIST</b></a>
              </td>
  </tr>
				      </td>
         <td height="140" valign="middle" class="verdanablack"><br />
           <table width="100%" border="1" cellpadding="0" cellspacing="0">
             <tr>
                <td>
				    <table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC" class=                     "Table_Border_bottom_right">
             <tr>
                <td height="37" colspan="9" align="center" bgcolor="#D7DBB0">House Keeping Report</td>
             </tr>
             <tr >
                <td height="19">&nbsp;</td>
                <td align="right" valign="middle" class="tahoma12blacknormal padding_left">&nbsp;</td>
                <td valign="top"></td>
                <td colspan="2">&nbsp;</td>
                <td valign="top" class="tahoma12blacknormal padding_left">&nbsp;</td>
                <td valign="top">&nbsp;</td>
                <td colspan="2">&nbsp;</td>
              </tr>
              <tr >
                <td width="9%" height="27">&nbsp;</td>
                <td width="12%" align="right" valign="middle" class="tahoma12blacknormal padding_left"><b>From Date :</b></td>
                <td width="3%" valign="top"></td>
                 
                <td colspan="2"><input type="text" name="ddDateFrom" id="ddDateFrom" value="<?php if (isset($_POST["ddDateFrom"]))                { echo $_POST["ddDateFrom"]; }?>" class="selectinput2" /><img src="images/Calendar New.jpg" width="16" height="16"                style="cursor:pointer" onClick="return showCalendar('ddDateFrom','%Y-%m-%d',24, true);" /></td>
                <td width="13%" valign="top" class="tahoma12blacknormal padding_left"><b>To Date :</b></td>
                <td width="2%" valign="top">:</td>
                
               <td colspan="2"><input type="text" name="ExDate" id="ExDate" value="<?php if (isset($_POST["ExDate"])) { echo $_POST                 ["ExDate"]; }?>" class="selectinput" /><img src="images/Calendar New.jpg" width="16" height="16" style="cursor:                  pointer" onClick="return showCalendar('ExDate','%Y-%m-%d',24, true);" />
	          </td>
              </tr>
              <tr class="site_font_black">
                <td height="10" colspan="8"></td>
              </tr>
              <tr>
                <td height="27">&nbsp;</td>
                <td colspan="2">&nbsp;</td>
                <td width="22%" align="right"><a style="cursor:hand"><img src="images/bt_show.jpg" width="48" height="22" border="0" onclick="return validate();" /></a></td>
                <td width="6%">&nbsp;</td>
                <td><a href="room_report.php"><img src="images/bt_exit.jpg" width="48" height="22" border="0" /></a></td>
                <td>&nbsp;</td>
                <td width="30%"><a href="admin_view.php"> </a></td>
              </tr>
             
            </table></td>
          </tr>
      </table>
       </td>
  </tr>
  <tr><td>&nbsp;</td></tr>
   <tr>

                      <td height="25" align="right"><a href="room_occupancy_report_print.php?from_date=03/02/2009&to_date=03/02/2009" target="_blank" title="PRINT"><img src="images/bt_print.jpg" width="51" height="22" border="0" /></a></td>
  </tr>
  <tr>
    <td height="30" align="right" valign="middle" class="verdanablack"><table width="100%" border="0" align="center" cellpadding="2" cellspacing="1" bgcolor="#FFFFFF">
      
	  <tr >
                <td height="37" colspan="9" align="center" bgcolor="#D7DBB0">House Keeping Services</td>
        </tr>
      <tr class="tableborder">
        <td width="10%" height="30" align="center" valign="middle" bgcolor="#CCCCCC" class="verdanablack">Sr.NO</td>
        <td width="13%" align="center" valign="middle" bgcolor="#CCCCCC" class="verdanablack">Room  </td>
        <td width="20%" align="center" valign="middle" bgcolor="#CCCCCC" class="verdanablack"><span class="Under_Border_black">Type Of Work</span></td>
		 <td width="20%" align="center" valign="middle" bgcolor="#CCCCCC" class="verdanablack"><span class="Under_Border_black">Assign Date/Time</span></td>
		  <td width="23%" align="center" valign="middle" bgcolor="#CCCCCC" class="verdanablack"><span class="Under_Border_black">Completion Date/Time </span></td>
		  <td width="14%" align="center" valign="middle" bgcolor="#CCCCCC" class="verdanablack"><span class="Under_Border_black">Status </span></td>
      </tr>
       <tr>
	   <p>&nbsp;</p>
			<table width="100%"  cellpadding="1" cellspacing="0" class="tableborder" border="1">
			  <tr >
                 <td height="40" align="center" class="tahoma12blacknormal padding_left"><b>No Housekeeping Record for Selected Date.</b> 
	            </td>
	  	      </tr>
	      </table>
		  <tr>

       <td height="25" align="right"><a href="room_occupancy_report_print.php?from_date=03/02/2009&to_date=03/02/2009" target="_blank" title="PRINT"><img src="images/bt_print.jpg" width="51" height="22" border="0" align="right" /></a></td>
  </tr>
    </table></td>
  </tr>
   
  
</table>
			   </td>
	       </tr>
		   
	    </td>
		
			  
	
	         </table>
	