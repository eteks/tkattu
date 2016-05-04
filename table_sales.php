<?php require_once ("includes/application_top.php");
$_POST['ddDateFrom']= (isset($_POST['ddDateFrom']) && !empty($_POST['ddDateFrom']) ? $_POST['ddDateFrom']:"" );
$FromDate=$_POST['ddDateFrom'];
$_POST['ddDateTo']= (isset($_POST['ddDateTo']) && !empty($_POST['ddDateTo']) ? $_POST['ddDateTo']:"" );
$ToDate=$_POST['ddDateTo'];
$_POST["table"] = (isset($_POST['table']) && !empty($_POST['table']) ? $_POST['table']:"" );
$table=$_POST['table'];
$hms_info_obj = new barbill();
$action_1 = (isset($_POST['action']) && !empty($_POST['action']) ? $_POST['action']:"" );
$action = (isset($action_1) ? $action_1 : $_GET["action"]);
switch ($action) {
    case "tablesales":
	if(isset($_POST['ddDateFrom']) && $_POST['ddDateFrom'] != "" ) { 
	  $order_query = "SELECT * FROM " . TABLE_HMS_RESTAURANT_ACCOUNT_DETAILS . " WHERE 	tabel_id='".$table."' AND  orde_close_date BETWEEN '$FromDate' AND '$ToDate' AND status = 'close'";	 
	}	 
$order_query_result = db_query($order_query);
    break;
}
?>
<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
<tr>
<th width="29" align="left" valign="middle" background="images/left_bg.jpg" scope="col"><img src="images/left_bg.jpg" width="29" height="20" /></th>
<th width="950" align="center" valign="top" scope="col">
<table width="942" border="0" cellspacing="0" cellpadding="0">
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td align="center"><table width="93%" align="center" cellpadding="0" cellspacing="0" class="tableborder">
<tr>
<td height="39" colspan="6" align="center" valign="middle" bgcolor="#D7DBB0" class="verdanabold">
Table Sales Report</td>
</tr> 
<tr>
<th colspan="6"><span  id="error_service" style="display:none;background-color:#EC8F82;border:solid 1px #FF0000;" ></span></th>
				</tr>	

<tr class="site_font_black"> 
<td class="verdanablack"  align="right">Table No:</td> 
<td height="35" colspan="2" valign="middle">
   <select name='tableid' id='tableid' class="selectinput" >
    <option value=''>-Select-</option>

<?php  
$tabletree = db_query("SELECT `table_entry_id`,`table_type_id`,`table_no`,`numbers_of_chairs`,`active`,`date_added`,`date_modified` FROM " . TABLE_HMS_TABLE_ENTRY . " WHERE `active` = 'Y'");
while ($roomTreeresultSet = db_fetch_array($tabletree)) {	?>
<option value="<?php echo $roomTreeresultSet['table_entry_id']; ?>"> <?php echo $roomTreeresultSet['table_no']; ?> </option> 
<?php } ?>
</select>	
</td>
</tr> 
				
<tr class="site_font_black"> 
    <td class="verdanablack" width="45%" align="right">From:</td> 
<td height="35" colspan="2" valign="middle" >
     <input name="ddDateFrom" id="ddDateFrom" class="inputCopy1" type="text" tabindex="19" size='16' value=""/><img src="images/Calendar New.jpg" width="16" height="16" style="cursor:pointer" onclick="return showCalendar('ddDateFrom','%Y-%m-%d',24, true);" /> 
</td>
</tr> 
<tr class="site_font_black"> 
<td class="verdanablack"  align="right">To:</td> 
<td height="35" colspan="2" valign="middle" >
  <input name="ddDateTo" id="ddDateTo" type="text" tabindex="20" class="inputCopy1" size='16' value=""/><img src="images/Calendar New.jpg" width="16" height="16" style="cursor:pointer" onclick="return showCalendar('ddDateTo','%Y-%m-%d',24, true);" />
	</td>
</tr>
<tr> 
<td align="center">&nbsp;</td>
<td align="center">&nbsp;</td>
</tr>
<tr>

<td width="122" align="center"></td>
<td width="421" align="center"><a href="javascript:void(0);" Onclick="Javascript:gettablesales('tablesales');" class="submenu" > Show</a></td>		
</tr>
<tr>
  <td align="center">&nbsp;</td>
  <td align="center">&nbsp;</td>
  </tr>
</table>
</td>
</tr>
<tr>
        <td align="center">&nbsp;</td>
</tr>
<?php $_POST["action"] = (isset($_POST['action']) && !empty($_POST['action']) ? $_POST['action']:"" );
if ($_POST["action"]=="tablesales") {	 
	if(mysql_num_rows($order_query_result)>0) { 
?>
<tr>
<td  align="center">
<table width="93%" align="center" cellpadding="0" cellspacing="0" class="tableborder">
<tr >
<td height="38"  colspan="14" align="center" valign="middle" bgcolor="#D7DBB0" class="verdanabold">Table Sales Report Details</td>
</tr>
<tr>
<td align="right"></a></td>
</tr>
<tr>
<td align="center"><br />
  <table width="89%" border="0" cellpadding="2" cellspacing="2" class="tableborder">
    <tr align="center" bgcolor="#999999" class="site_font_black">
            <td width="9%" height="27" bgcolor="#cccccc" class="verdanablack">S.No.</td>
            <td width="15%" height="27" bgcolor="#cccccc" class="verdanablack">Bill No.</td>
            <td width="15%" height="27" bgcolor="#cccccc" class="verdanablack">Status</td>
            <td width="19%" height="27" bgcolor="#cccccc" class="verdanablack"> Date </td>
            <td width="16%" height="27" bgcolor="#cccccc" class="verdanablack">Amount&nbsp;&nbsp;</td>
    </tr>
    
<?php

	$i = 1;
  				 
		while ($acctdetails  = db_fetch_array($order_query_result)) {
		
		//$bgcolor = (($i % 2 == 0) ? "#999999" : "#cccccc");	
		$date = explode('-',$acctdetails["orde_close_date"]);
?>
            <tr align="center" bgcolor="<? echo $bgcolor ?>">

                    <td height="20"  class="verdanablack"><?php echo $i;?></td>
                    <td height="20"  class="verdanablack"><?php echo $acctdetails["bill_id"]; ?></td>
                    <td height="20"  class="verdanablack"><?=$acctdetails["status"];?></td>
                    <td height="20"  class="verdanablack"><?php echo $date[2] . "-" . $date[1] . "-" . $date[0];?></td>
                    <td height="20"  class="verdanablack">Rs.&nbsp;<?php 
                    //echo $acctdetails["total_amount"]; 

                     $disc=  $acctdetails["total_amount"]*($acctdetails["discount"]/100);
                    echo round($acctdetails["total_amount"]-$disc); ?>&nbsp;&nbsp;
                    </td> 
            </tr>
	 <?php
	 $i++;
		}
$Purchase_total_amount = "SELECT sum(total_amount) as total_amount FROM " . TABLE_HMS_RESTAURANT_ACCOUNT_DETAILS . " WHERE tabel_id='".$table."' AND orde_close_date BETWEEN '$FromDate' AND '$ToDate' AND status = 'close'";  

$total_amount = db_query($Purchase_total_amount);
$Purchase_amount =db_fetch_array($total_amount);
?>		
	<tr align="center"  bgcolor="#cccccc">

						<!--
      <td height="20" colspan="4" align="right"  class="verdanablack">Total Amount</td>
							<td height="20"  class="verdanablack">Rs.&nbsp;<?php 
                                                       $disc=  $Purchase_amount["total_amount"]*($Purchase_amount["discount"]/100);
                                                        echo round($Purchase_amount["total_amount"]-$disc); 
                                                        ?>&nbsp;&nbsp;</td> -->
						</tr>	
 <tr>
   <td colspan="7" align="center" class="nonprintable">
 <input name="btnPrint" type="button" id="btnPrint" class="submit"
  value="Print" onClick="gettablesalesview('<?php echo $table; ?>','<?php echo $FromDate; ?>','<?php echo $ToDate; ?>');">
  </td>
  </tr>						
	
 </table>  <br />
  <p>&nbsp;</p>
 <div id="divbarbillview"></div>
  </td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
</tbody></table>
</td>
</tr>
<?php 
	} 
        else {
	?>


	<tr><td colspan="12" align="center"><strong><font color="#FF0000">No Details Available</font></strong></td>
	</tr>
	<?php
	}
} 
 ?>


</table></th>
<th width="29" background="images/rightline.jpg" scope="col"><img src="images/rightline.jpg" width="29" height="33" /></th>
</tr>
<tr>
<th height="14" align="left" valign="middle" scope="col"><img src="images/left_bottom_corner.jpg" width="29" height="14" /></th>
<td align="center" valign="middle" background="images/bottomline.jpg" bgcolor="#FFFEFF"><img src="images/bottomline.jpg" width="7" height="14" /></td>
<th scope="col"><img src="images/right_bottom_corner.jpg" width="29" height="14" /></th>
</tr>
</table>
