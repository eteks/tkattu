<?php
$action = $_POST["action"] ? $_POST["action"] : $_GET["action"];
$page = $_POST["page"] ? $_POST["page"] : $_GET["page"];
$id     = $_POST["id"] ? $_POST["id"] : $_GET["id"];

if ($action == "services_entry_add" || $action == "services_entry_edit") {
	$services_entry_add = "services_entry_insert";
	$services_entry_edit = "services_entry_update";
	
    $getServicesTreeArray = $hms_info_obj->getServicesTree();

if ($action == "services_entry_edit" ) {
    $services_entry_result = $hms_info_obj->servicesEntrySingRec();
    $services_entry_values = db_fetch_array ($services_entry_result);
}
?>
<form name="frmService" method="POST" enctype="multipart/form-data" action="<?php echo href_link(FILENAME_ROOM_SERVICES); ?>">
    <input type="hidden" name="action1" id="action" value="<?php echo ${$action}; ?>">
    <input type="hidden" name="page" value="<?php echo (isset($page) ? $page : 1); ?>">
    <?php 
    if ( $action =="services_entry_edit" ) {?>
        <input type="hidden" name="id" value="<?php echo $_GET["id"]; ?>">
    <?php } else {?>
		<input type="hidden" name="id">
	<?php } ?>
<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <th width="29" align="left" valign="middle" background="images/left_bg.jpg" scope="col"><img src="images/left_bg.jpg" width="29" height="20" /></th>
    <th width="942" align="center" valign="top" scope="col">
	<table width="942" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td align="center">
		<table width="95%" align="center" cellpadding="0" border="0" cellspacing="0" class="tableborder">
      <tr>
        <td align="center" colspan="3"><span  id="error_service" style="display:none;background-color:#EC8F82;border:solid 1px #FF0000;" >&nbsp;</span></td>
      </tr>
          <tr>
            <td width="100%" height="35" colspan="3" align="center" valign="middle" bgcolor="#D7DBB0" class="verdanabold">Room Services View</td>
          </tr>
          <tr>
            <td height="30" colspan="3" align="center"class="verdanablack">
				<table width="63%" border="0" cellspacing="0" cellpadding="2">
		 <tr>
				<td colspan="6" align="left" style="background-image:url(images/back_header_bg.jpg); background-repeat:repeat-x;">
				
			    </td>
        </tr>
        <tr>
            <td colspan="2"></td>
        </tr>
        <tr>
            <td width="45%" class="verdanablack"><span id="lbl_sel_cust">Customer Name</span>:</td>
            <td width="55%">
             <input name="customer_name" type="text" class="selectinput" id="customer_name" tabindex="1" dir="ltr" size="40%" value="<?php print stripslashes($hms_info_values["hms_info_name"]); ?>">
          </td>
        </tr>
		<tr>
			  <td class="verdanablack"><span id="lbl_sel_room">Room Number</span>: </td>
			  <td><select name="room_number" id="room_number" class="selectinput" tabindex="2">
					 <?php 
					 $count_time = count($getServicesTreeArray);
					 for($Services=0;$Services<$count_time;$Services++) { 
						 if($getUserDetails['tbs_time_zone'] == $getServicesTreeArray[$Services]['id'])
							 $sel = "selected";
						 else
							 $sel = "";
					 ?>
					  <option value="<?php echo $getServicesTreeArray[$Services]['id'];?>" <?php echo $sel;?>><?php  echo $getServicesTreeArray[$Services]['text'];?></option>
					 <?php  } ?>
				  </select>
               </td>
		</tr>
        <tr>
            <td class="verdanablack" valign="top;"><span id="lbl_from_date">Date</span>:</td>
            <td><input type="text" name="ddDateFrom" id="ddDateFrom" value="<?php if (isset($_POST["formDate"])) { echo $_POST["formDate"]; }?>" class="selectinput" /><img src="images/Calendar New.jpg" width="16" height="16" style="cursor:pointer" tabindex="3" onclick="return showCalendar('ddDateFrom','%Y-%m-%d',24, true);" /></td>
        </tr>
		
        <tr>
            <td height="28" class="verdanablack"><span id="lbl_time">Time</span>:</td>
            <td ><select name="hour" class="smallselect" tabindex="4">
					  					    <option value="1">
					      01</option>

					  					    <option value="2">
					      02</option>
					  					    <option value="3"  >
					      03</option>
					  					    <option value="4"  >
					      04</option>
					  					    <option value="5"  >

					      05</option>
					  					    <option value="6"  >
					      06</option>
					  					    <option value="7"  >
					      07</option>
					  					    <option value="8"  >
					      08</option>

					  					    <option value="9"  >
					      09</option>
					  					    <option value="10"  >
					      10</option>
					  					    <option value="11"  >
					      11</option>
					  					    <option value="12"  >

					      12</option>
					  					    <option value="13"  >
					      13</option>
					  					    <option value="14"  >
					      14</option>
					  					    <option value="15"  >
					      15</option>

					  					    <option value="16"  >
					      16</option>
					  					    <option value="17"  >
					      17</option>
					  					    <option value="18"  >
					      18</option>
					  					    <option value="19"  >

					      19</option>
					  					    <option value="20"  >
					      20</option>
					  					    <option value="21"  >
					      21</option>
					  					    <option value="22"  >
					      22</option>

					  					    <option value="23"  >
					      23</option>
					  					    <option value="24"  >
					      24</option>
					  					  </select>
					  :
					  <select name="min" class="smallselect" tabindex="5">
					0<option value="1">

					    01</option>
					  					    <option value="2" >
					    02</option>
					  					    <option value="3" >
					    03</option>
					  					    <option value="4" >
					    04</option>

					  					    <option value="5" >
					    05</option>
					  					    <option value="6" >
					    06</option>
					  					    <option value="7" >
					    07</option>
					  					    <option value="8" >

					    08</option>
					  					    <option value="9" >
					    09</option>
					  					    <option value="10" >
					    10</option>
					  					    <option value="11" >
					    11</option>

					  					    <option value="12" >
					    12</option>
					  					    <option value="13" >
					    13</option>
					  					    <option value="14" >
					    14</option>
					  					    <option value="15" >

					    15</option>
					  					    <option value="16" >
					    16</option>
					  					    <option value="17" >
					    17</option>
					  					    <option value="18" >
					    18</option>

					  					    <option value="19" >
					    19</option>
					  					    <option value="20" >
					    20</option>
					  					    <option value="21" >
					    21</option>
					  					    <option value="22" >

					    22</option>
					  					    <option value="23" >
					    23</option>
					  					    <option value="24" >
					    24</option>
					  					    <option value="25" >
					    25</option>

					  					    <option value="26" >
					    26</option>
					  					    <option value="27" >
					    27</option>
					  					    <option value="28" >
					    28</option>
					  					    <option value="29" >

					    29</option>
					  					    <option value="30" >
					    30</option>
					  					    <option value="31" >
					    31</option>
					  					    <option value="32" >
					    32</option>

					  					    <option value="33" >
					    33</option>
					  					    <option value="34" >
					    34</option>
					  					    <option value="35" >
					    35</option>
					  					    <option value="36" >

					    36</option>
					  					    <option value="37" >
					    37</option>
					  					    <option value="38" >
					    38</option>
					  					    <option value="39" >
					    39</option>

					  					    <option value="40" >
					    40</option>
					  					    <option value="41" >
					    41</option>
					  					    <option value="42" >
					    42</option>
					  					    <option value="43" >

					    43</option>
					  					    <option value="44" >
					    44</option>
					  					    <option value="45" >
					    45</option>
					  					    <option value="46" >
					    46</option>

					  					    <option value="47" >
					    47</option>
					  					    <option value="48" >
					    48</option>
					  					    <option value="49" >
					    49</option>
					  					    <option value="50" >

					    50</option>
					  					    <option value="51" >
					    51</option>
					  					    <option value="52" >
					    52</option>
					  					    <option value="53" >
					    53</option>

					  					    <option value="54" >
					    54</option>
					  					    <option value="55" >
					    55</option>
					  					    <option value="56" >
					    56</option>
					  					    <option value="57" >

					    57</option>
					  					    <option value="58" >
					    58</option>
					  					    <option value="59" >
					    59</option>
	  					  </select>
            </td>
        </tr>
       
       
       
        <tr>
            <td class="verdanablack"><span id="lbl_sel_dept">Department</span>:</td>
            <td>
            
             <?php echo draw_pull_down_menu ('depart', $hms_info_obj->getDepartTree(), $_GET["cat_id"], 'tabindex="1" style="width:150px;" class="selectinput" id="depart"'); ?>
       
            
            </td>
        </tr>
		
        
        
        
        
        
        <tr>
            <td class="verdanablack">Services:</td>
            <td>
             <input name="services" type="text" class="selectinput" id="services" tabindex="7" dir="ltr" size="40%" value="<?php print stripslashes($hms_info_values["hms_info_name"]); ?>">
          </td>
        </tr>
        <tr>
            <td class="verdanablack">Service Description:</td>
            <td>
              <textarea name="service_description" class="textareainput" id="service_description" tabindex="8" dir="ltr" style="width:19em;"><?php print stripslashes($hms_info_values["hms_info_address"]); ?></textarea></td>
        </tr>
        <tr>
            <td class="verdanablack">Other Services:</td>
            <td><textarea name="other_service" class="textareainput" id="other_service" tabindex="9" dir="ltr" style="width:19em;"><?php print stripslashes($hms_info_values["hms_info_address"]); ?></textarea></td>
        </tr>
        <tr>
            <td class="verdanablack"><span id="lbl_txtcharges">Charges</span>:</td>
            <td><span class="verdanablack">Rs.</span>
              <input name="charge" type="text" class="selectinput" id="charge" tabindex="10" dir="ltr" size="40%" value="<?php print $hms_info_values["hms_info_fax"]; ?>" maxlength="10"></td>
        </tr>
        <tr>
            <td class="verdanablack">Expected Completion Date:</td>
            <td><input type="text" name="ExDate" id="ExDate" value="<?php if (isset($_POST["formDate"])) { echo $_POST["formDate"]; }?>" class="selectinput" /><img src="images/Calendar New.jpg" width="16" height="16" tabindex="11" style="cursor:pointer" onclick="return showCalendar('ExDate','%Y-%m-%d',24, true);" /></td>
        </tr>
        <tr>
            <td class="verdanablack">Expected Completion Time:</td>
            <td><select name="ex_hour" class="smallselect" tabindex="12">
					  					    <option value="1"  >
					      01</option>

					  					    <option value="2"  >
					      02</option>
					  					    <option value="3"  >
					      03</option>
					  					    <option value="4"  >
					      04</option>
					  					    <option value="5"  >

					      05</option>
					  					    <option value="6"  >
					      06</option>
					  					    <option value="7"  >
					      07</option>
					  					    <option value="8"  >
					      08</option>

					  					    <option value="9"  >
					      09</option>
					  					    <option value="10"  >
					      10</option>
					  					    <option value="11"  >
					      11</option>
					  					    <option value="12"  >

					      12</option>
					  					    <option value="13"  >
					      13</option>
					  					    <option value="14"  >
					      14</option>
					  					    <option value="15"  >
					      15</option>

					  					    <option value="16"  >
					      16</option>
					  					    <option value="17"  >
					      17</option>
					  					    <option value="18"  >
					      18</option>
					  					    <option value="19"  >

					      19</option>
					  					    <option value="20"  >
					      20</option>
					  					    <option value="21"  >
					      21</option>
					  					    <option value="22"  >
					      22</option>

					  					    <option value="23"  >
					      23</option>
					  					    <option value="24"  >
					      24</option>
					  					  </select>
					  :
					  <select name="ex_min" class="smallselect" tabindex="13">
					0					    <option value="1" >

					    01</option>
					  					    <option value="2" >
					    02</option>
					  					    <option value="3" >
					    03</option>
					  					    <option value="4" >
					    04</option>

					  					    <option value="5" >
					    05</option>
					  					    <option value="6" >
					    06</option>
					  					    <option value="7" >
					    07</option>
					  					    <option value="8" >

					    08</option>
					  					    <option value="9" >
					    09</option>
					  					    <option value="10" >
					    10</option>
					  					    <option value="11" >
					    11</option>

					  					    <option value="12" >
					    12</option>
					  					    <option value="13" >
					    13</option>
					  					    <option value="14" >
					    14</option>
					  					    <option value="15" >

					    15</option>
					  					    <option value="16" >
					    16</option>
					  					    <option value="17" >
					    17</option>
					  					    <option value="18" >
					    18</option>

					  					    <option value="19" >
					    19</option>
					  					    <option value="20" >
					    20</option>
					  					    <option value="21" >
					    21</option>
					  					    <option value="22" >

					    22</option>
					  					    <option value="23" >
					    23</option>
					  					    <option value="24" >
					    24</option>
					  					    <option value="25" >
					    25</option>

					  					    <option value="26" >
					    26</option>
					  					    <option value="27" >
					    27</option>
					  					    <option value="28" >
					    28</option>
					  					    <option value="29" >

					    29</option>
					  					    <option value="30" >
					    30</option>
					  					    <option value="31" >
					    31</option>
					  					    <option value="32" >
					    32</option>

					  					    <option value="33" >
					    33</option>
					  					    <option value="34" >
					    34</option>
					  					    <option value="35" >
					    35</option>
					  					    <option value="36" >

					    36</option>
					  					    <option value="37" >
					    37</option>
					  					    <option value="38" >
					    38</option>
					  					    <option value="39" >
					    39</option>

					  					    <option value="40" >
					    40</option>
					  					    <option value="41" >
					    41</option>
					  					    <option value="42" >
					    42</option>
					  					    <option value="43" >

					    43</option>
					  					    <option value="44" >
					    44</option>
					  					    <option value="45" >
					    45</option>
					  					    <option value="46" >
					    46</option>

					  					    <option value="47" >
					    47</option>
					  					    <option value="48" >
					    48</option>
					  					    <option value="49" >
					    49</option>
					  					    <option value="50" >

					    50</option>
					  					    <option value="51" >
					    51</option>
					  					    <option value="52" >
					    52</option>
					  					    <option value="53" >
					    53</option>

					  					    <option value="54" >
					    54</option>
					  					    <option value="55" >
					    55</option>
					  					    <option value="56" >
					    56</option>
					  					    <option value="57" >

					    57</option>
					  					    <option value="58" >
					    58</option>
					  					    <option value="59" >
					    59</option>
	  					  </select>
            </td>
        </tr>
        <tr>
            <td class="verdanablack"><span id="lbl_sel_status">Status</span>:</td>
          <td><select name="sel_status" id="sel_status" class="selectinput" tabindex="14">
                  <option value="0">Select Status</option>
                  <option value="1" >Complete</option>
				  <option value="2" >In Process</option>
				  <option value="3" >Pending</option>
              </select>
		  </td>
        </tr>
        <tr>

            <td>&nbsp;</td>
            <td colspan = "2">
                <input style="font-size:11px; color:#e1e1e1; background:#666666; border:1px solid #000; padding:1px 3px 1px 3px;cursor:pointer;" name="buttonSubmit" type="button" tabindex="15" title="Submit" onClick="Javascript:RoomServiceAdd();" value="Submit" >&nbsp;
                <input class="btn_style1" name="buttonCancel" type="button" tabindex="16" title="Cancel" value="Cancel" onClick="Javascript:getRoomService();" style="font-size:11px; color:#e1e1e1; background:#666666; border:1px solid #000; padding:1px 3px 1px 3px;cursor:pointer;"></td>
       </tr>
    </table>
            </td>
          </tr>
          <tr>
            <td height="30" colspan="3" align="left" valign="middle" class="verdanabold"></td>
          </tr>
        </table>
		</td>
      </tr>
     
    </table>
	</th>
    <th width="29" background="images/rightline.jpg" scope="col"><img src="images/rightline.jpg" width="29" height="33" /></th>
  </tr>
  <tr>
    <th height="14" align="left" valign="middle" scope="col"><img src="images/left_bottom_corner.jpg" width="29" height="14" /></th>
    <td align="center" valign="middle" background="images/bottomline.jpg" bgcolor="#FFFEFF"><img src="images/bottomline.jpg" width="7" height="14" /></td>
    <th scope="col"><img src="images/right_bottom_corner.jpg" width="29" height="14" /></th>
  </tr>
</table>
</form>
<?php
} else {
?>

<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <th width="29" align="left" valign="middle" background="images/left_bg.jpg" scope="col"><img src="images/left_bg.jpg" width="29" height="20" /></th>
    <th width="942" align="center" valign="top" scope="col"><table width="942" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td align="center"><table width="95%" align="center" cellpadding="0" cellspacing="0" class="tableborder">
          <tr>
            <td width="100%" height="35" colspan="3" align="center" valign="middle" bgcolor="#D7DBB0" class="verdanablack">Room Services View </td>
          </tr>
          <tr>
            <td height="20" colspan="3" align="left" valign="middle" class="verdanablack">
			<div id="hotel_info_records" >
<?php
$search = $_POST["search"] ? $_POST["search"] : $_GET["search"];
    $hms_info_db_num_rows = 0;
    $page_num_label = "&nbsp;";
    $hms_info_total_num_rows = $hms_info_obj->getStudentUserTotalRecords();
    $true = 1;
    $page = $_POST["page"] ? $_POST["page"] : $_GET["page"];
    while ($true) {
        $start_limit = ((not_null($page) && $page>1) ? (($page-1) * ROWS_PER_PAGE) : '0');
        $limit_rows = ROWS_PER_PAGE;
		if (isset($search) == 'search') {
			$hms_info_sql = $hms_info_obj->searchFetchAllRecords($start_limit,$limit_rows);
		} else {
			$hms_info_sql = $hms_info_obj->studentUserFetchAllRecords($start_limit,$limit_rows);
		}
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
<form name="frmFAQMenu" method="GET" action="<?php echo href_link(FILENAME_ROOM_SERVICES); ?>" style="margin:0px;">
    <input type="hidden" name="search" value="search">

<table border="0" align="center" cellpadding="3" cellspacing="3" bgcolor="#FFFFFF">
      <tr>
        <td align="center" colspan="3"><span  id="error_service_process" style="display:none;background-color:#EC8F82;border:solid 1px #FF0000;" >&nbsp;</span></td>
      </tr>
	<tr class="tableborder">
	  <td height="30" align="right" valign="middle" class="verdanablack">Room Number: </td>
	  <td>&nbsp;</td>
	  <td align="left" class="verdanablack"><?php echo draw_pull_down_menu ('room_number', $hms_info_obj->storedroomsNumber(), $_POST["room_number"], 'tabindex="1" style="width:125px;" class="selectinput" id="room_number" '); ?> </td>
	</tr>
	<tr class="tableborder">
	  <td height="30" align="right" valign="middle" class="verdanablack">Department:</td>
	  <td>&nbsp;</td>
	  <td align="left">
		   <?php echo draw_pull_down_menu ('depart', $hms_info_obj->getDepartTree(), $_GET["cat_id"], 'tabindex="1" style="width:150px;" class="selectinput" id="depart" '); ?>
	   </td>
	</tr>
	<tr class="tableborder">
	  <td height="30" align="right" valign="middle" class="verdanablack"><span id="lbl_from_date">From Date: </span></td>
	  <td>&nbsp;</td>
	  <td align="left"><input type="text" name="ddDateFrom" id="ddDateFrom" value="<?php if (isset($_POST["formDate"])) { echo $_POST["formDate"]; }?>" class="selectinput" /><img src="images/Calendar New.jpg" width="16" height="16" style="cursor:pointer" onclick="return showCalendar('ddDateFrom','%Y-%m-%d',24, true);" /></td>
	</tr>
	<tr class="tableborder">
	  <td height="30" align="right" valign="middle" class="verdanablack"><span id="lbl_to_date">To Date: </span></td>
	  <td>&nbsp;</td>
	  <td align="left"><input type="text" name="ExDate" id="ExDate" value="<?php if (isset($_POST["formDate"])) { echo $_POST["formDate"]; }?>" class="selectinput" /><img src="images/Calendar New.jpg" width="16" height="16" style="cursor:pointer" onclick="return showCalendar('ExDate','%Y-%m-%d',24, true);" />
	  </td>
	</tr>
	<tr class="tableborder">
	  <td height="30" align="center" valign="middle" class="verdanablack">&nbsp;</td>
	  <td height="30" align="center" valign="middle" class="verdanablack">&nbsp;</td>
	  <td height="30" align="left" valign="middle" class="verdanablack"><table border="0" align="left" cellpadding="2" cellspacing="2">
		  <tr>
			<td align="center"><a href="javascript:void(0);" onClick="javascript:getServicesSearch();" class="submenu">Show</a></td>
		  </tr>
	  </table></td>
	</tr>
 </table>
</form>
    <?php
    if ($hms_info_db_num_rows > 0) {
?>

<form name="frmnewsletter_manageRecords" id="frmnewsletter_manageRecords" method="get" action="<? echo href_link(FILENAME_ROOM_SERVICES);?>" style="margin:0px;">
    <input type="hidden" name="action">
    <input type="hidden" name="id">
    <input type="hidden" name="page" value="<? print $page; ?>">

<table width="100%" border="0" cellspacing="1" cellpadding="2" align="center">

   <tr>
       <td height="30" colspan="2"><input style="cursor:pointer;" class="buttons" type="button" name="Delete_Selected" value="Delete Selected" disabled onClick="deleteSelectedHmsInfoManageRecord(document.frmnewsletter_manageRecords, 'services_selected_hmsInfo_manage_records');"></td>
       <td height="30" colspan="2" align="left" style="padding-left:170px"></td>
       <td width="58%" height="30" align="left" class="verdanablack">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<? print $page_num_label; ?></td>
       <td width="8%" height="30" colspan="6" align="right" style="padding-right: 5px;" class="verdanablack"><? print $prev_link . $seperator . $next_link;?></td>
  </tr>
      <tr>
         <td colspan="11"><table width="100%" border="0" cellspacing="1" cellpadding="2" class="Table_Border_bottom_right">
    <tr>
         <th width="4%" height="27" bgcolor="#CCCCCC" style="text-align:center" ><input type="checkbox" name="All" id="All" class="Under_Border_black" title="Check / Uncheck all" onClick="toggle_all_box(document.frmnewsletter_manageRecords, this.checked);set_button_stat(document.frmnewsletter_manageRecords, 'All', document.frmnewsletter_manageRecords.Delete_Selected);"></th>
        <th width="11%" bgcolor="#CCCCCC" class="verdanablack" style="text-align:center" >Room No.</th>
        <th width="21%" bgcolor="#CCCCCC" class="verdanablack" style="text-align:center">Service Provided</th>
        <th bgcolor="#CCCCCC" class="verdanablack" style="text-align:center">Date/Time</th>
        <th bgcolor="#CCCCCC" class="verdanablack" style="text-align:center">Amount</th>
		<th width="16%" bgcolor="#CCCCCC" class="verdanablack" style="text-align:center">Department</th>
        <th width="14%" bgcolor="#CCCCCC" class="verdanablack" style="text-align:center">Status</th>
       
    </tr>
    <?php    
        $hms_info_counter = 1;
        while ($hms_info_values = db_fetch_array($hms_info_sql)) {
        if ($hms_info_counter > ROWS_PER_PAGE) break;
              $bgcolor = (($hms_info_counter % 2 == 0) ? FIRSTROWCOLOR : SECONDROWCOLOR);
    ?> 
    <tr class="site_font_black">
        <td width="4%" bgcolor="#E4E4E4" class="verdanablack" style="text-align:center">
			<input type="checkbox" class="noneborder" onClick="change_box_stat(document.frmnewsletter_manageRecords, 'All');set_button_stat(document.frmnewsletter_manageRecords, 'All', document.frmnewsletter_manageRecords.Delete_Selected);" id="newsletter_manage_ids" name="newsletter_manage_ids[]" value="<? print $hms_info_values["room_services_id"]; ?>">
		</td>

       <td width="11%" bgcolor="#E4E4E4" class="verdanablack" style="text-align:center">
        <? echo $hms_info_values["room_number"]; ?></td>

        <td width="21%" bgcolor="#E4E4E4" class="verdanablack" style="text-align:center" >
        <? echo stripslashes($hms_info_values["services"]); ?></td>

        <td width = "24%" bgcolor="#E4E4E4" class="verdanablack" style="text-align:center"><?php echo $hms_info_values["date"]." ".$hms_info_values["time"]; ?></td>

        <td width = "10%" bgcolor="#E4E4E4" class="verdanablack" style="text-align:center"><?php echo $hms_info_values["charges"]; ?></td>

		<td width="16%" align="center" bgcolor="#E4E4E4" class="verdanablack" ><? echo $hms_info_values["department"];?></td>

        <td width = "10%" bgcolor="#E4E4E4" class="verdanablack" style="text-align:center"><span class="verdanablack" style="text-align:center">
          <?php 
			 $count_time = count($status_array);
			 for($status=0;$status<$count_time;$status++) { 
				 if($hms_info_values['status'] == $status_array[$status]['id'])
					 $sel = $status_array[$status]['text'];
				 else
					 $sel = "";
			 ?>
        </span>
          <?php  echo $sel;?>
			 <?php  } ?></td>
         
   
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
   <td colspan="10" height="27" class="Table_Sub_Title_black">&nbsp;</td>
  </tr>
  <tr>
   <td colspan="10" height="30" class="Under_Border_black" align="center">No Record Found </td>
  </tr>
</table>
<?
    }
?>
</div>
				<table width="100%" border="0" cellspacing="0" cellpadding="2" align="center">
					<tr>
						<td height="5"></td>
					</tr>
					<tr>
						<td class="verdanablack" align="left">&nbsp;&nbsp;<a title="Click to Add New Room Services" href="Javascript:getRoomServiceAdd('services_entry_add');"><b>Add Room Services </b></a></td>
					</tr>
				</table>
		    </td>
          </tr>
          <tr>
            <td height="30" colspan="3" align="left" valign="middle" class="verdanablack"></td>
          </tr>

        </table></td>
      </tr>
    
    </table>
	</th>
    <th width="29" background="images/rightline.jpg" scope="col"><img src="images/rightline.jpg" width="29" height="33" /></th>
  </tr>
  <tr>
    <th height="14" align="left" valign="middle" scope="col"><img src="images/left_bottom_corner.jpg" width="29" height="14" /></th>
    <td align="center" valign="middle" background="images/bottomline.jpg" bgcolor="#FFFEFF"><img src="images/bottomline.jpg" width="7" height="14" /></td>
    <th scope="col"><img src="images/right_bottom_corner.jpg" width="29" height="14" /></th>
  </tr>

</table>
    <?php
}
?>