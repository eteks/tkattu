<?php require_once ("includes/application_top.php");
session_start();
$hms_info_obj = new barbill();
$action_1 = (isset($_POST['action']) && !empty($_POST['action']) ? $_POST['action']:"" );
$billdate = (isset($_POST['billdate']) && !empty($_POST['billdate']) ? $_POST['billdate']:"" );
$action = (isset($action_1) ? $action_1 : $_GET["action"]);
switch ($action) {
  
    case "barbill":
	if(isset($_POST['sel_bill']) && $_POST['sel_bill'] != "" ) { 
           if(isset($_SESSION["admin_role_mst_id"]) && !empty($_SESSION["admin_role_mst_id"]) && $_SESSION["admin_role_mst_id"]!='1')
           $wherecon = " AND created_role_id='".$_SESSION["admin_role_mst_id"]."'";   
	  $order_query = "SELECT * FROM " . TABLE_HMS_RESTAURANT_ACCOUNT_DETAILS . " WHERE bill_id ='" .trim($_POST["sel_bill"]). "' AND orde_close_date ='" .trim($billdate). "' AND  status = 'close' $wherecon";	 
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
<td align="center">
    <table width="93%" border="0" align="center" cellpadding="0" cellspacing="0" class="tableborder">
<tr>
<td height="39" colspan="6" align="center" valign="middle" bgcolor="#D7DBB0" class="verdanabold">Restaurant Bill</td>
</tr> 
<tr>
<th colspan="6"><span id="error_service" style="display:none;background-color:#EC8F82;border:solid 1px #FF0000;" ></span></th>
				</tr>
                                
                                

<tr class="site_font_black"> 
<td class="verdanablack" align="right" width="45%">Bill No: </td> 
<td height="35" colspan="2" valign="middle" >
    <input type="text" name="sel_bill" id="sel_bill" class="selectinput1">   
</td>
</tr> 
<tr class="site_font_black"> 
<td class="verdanablack" align="right" width="45%">Date: </td> 
<td height="35" colspan="2" valign="middle" >
   <input name="ddDateFrom" id="ddDateFrom" class="inputCopy1" type="text" tabindex="19" size='16' value=""/><img src="images/Calendar New.jpg" width="16" height="16" style="cursor:pointer" onclick="return showCalendar('ddDateFrom','%Y-%m-%d',24, true);" />
  
</td>
</tr>
<tr> 
<td align="center">&nbsp;</td>
<td align="center">&nbsp;</td>
</tr>
<tr>
<td width="122" align="center"></td>
<td width="421" align="center">
<a href="javascript:void(0);" Onclick="Javascript:getBarBillView('barbill');" class="submenu" > Show</a>	
<!-- <a href="javascript:void(0);" Onclick="Javascript:reset('clear');" class="submenu" > Reset</a></td> -->			
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

<tr>
<td  align="center">
<table width="93%" align="center" cellpadding="0" cellspacing="0" class="tableborder">


<tr>
<td align="right"></a></td>
</tr>
<tr>
<td>
<table width="100%" border="1" cellspacing="0" cellpadding="5" class="ntab" style="font-size:12px;">
<tr >
    <td height="38" width="750"  colspan="8" align="center" valign="middle" bgcolor="#D7DBB0" class="verdanabold"><?php echo (!empty($tax_method) ? $tax_method : ""); ?> 
Restaurant Bill Details
</td>
</tr>
	<tr align="center" bgcolor="#ffffff" class="site_font_black">
        <td width="15%" style="text-align:center; font-weight:bold;"  align="center">Sr.No.</td>
        <td width="15%" style="text-align:center; font-weight:bold;" align="center">Table No.</td>
        <td width="15%" style="text-align:center; font-weight:bold;" align="center">Order Type</td>
        <td width="19%" style="text-align:center; font-weight:bold;" align="center"> Date </td>
        <td width="16%" style="text-align:center; font-weight:bold;" align="center">Amount&nbsp;&nbsp;</td>
    <td  width="16%" style="text-align:center; font-weight:bold;" align="center">View</td>
</tr>
<?php
if (isset($_POST["action"]) && $_POST["action"]=="barbill") {	 
	if(mysql_num_rows($order_query_result)>0) { 
	$i = 1;
  				 
		while ($acctdetails  = db_fetch_array($order_query_result)) {
		
		$bgcolor = (($i % 2 == 0) ? "#999999" : "#cccccc");	
		$date = explode('-',$acctdetails["orde_close_date"]);
?>
        <tr align="center" bgcolor="<? echo $bgcolor ?>">

                <td class="verdanablack"><?php echo $i;?></td>
                <td class="verdanablack"><?php echo $acctdetails["tabel_id"]; ?></td>
                <td class="verdanablack"><?=$acctdetails["order_type"];?></td>
                <td class="verdanablack"><?php echo $date[2] . "-" . $date[1] . "-" . $date[0];?></td>
                <td class="verdanablack">Rs.&nbsp;<?php 
                $disc=$acctdetails["total_amount"]*($acctdetails["discount"]/100); 
               
                echo round($acctdetails["total_amount"]-round($disc)); 
                $ncbc = (!empty($acctdetails["nocashcomments"]) ? 1:0);
                ?>&nbsp;&nbsp;</td>
       <td class="verdanablack"><a href="javascript:void(0);" onclick="javascript:getPrintBarList('<?php echo $acctdetails["bill_id"];?>','<?php echo $acctdetails["account_card_id"];?>','<?php echo $acctdetails["tabel_id"];?>',<?php echo $ncbc ;?>);">View Bill</a></td> 
        </tr>
	 <?php
	 $i++;
		}
	} else {
	?>
	<tr><td colspan="12" align="center"><strong><font color="#FF0000">No Details Available</font></strong></td>
	</tr>
	<?
	}
} else {
	?>
	<tr><td colspan="12" align="center"><strong><font color="#FF0000">No  Details Available</font></strong></td>
	</tr>
	<?
	}
 ?>
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


</table></th>
<th width="29" background="images/rightline.jpg" scope="col"><img src="images/rightline.jpg" width="29" height="33" /></th>
</tr>
<tr>
<th height="14" align="left" valign="middle" scope="col"><img src="images/left_bottom_corner.jpg" width="29" height="14" /></th>
<td align="center" valign="middle" background="images/bottomline.jpg" bgcolor="#FFFEFF"><img src="images/bottomline.jpg" width="7" height="14" /></td>
<th scope="col"><img src="images/right_bottom_corner.jpg" width="29" height="14" /></th>
</tr>
</table>


<script>

function reset(action) { 
document.getElementById("sel_bill").value = "";
   //alert(action);
}

</script>