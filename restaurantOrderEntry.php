<?php
require_once ("includes/application_top.php");
session_start();
$hms_info_obj = new restaurantbill();
$POST = (isset($_POST["action"]) ? $_POST["action"] : "");
$action = (isset($POST) ? $POST : $_GET["action"]);
$tableid = (isset($_POST['tableid']) && !empty($_POST['tableid']) ? str_replace("undefined,", "", $_POST['tableid']) : "");
$table_idd = (isset($_POST['table_id']) && !empty($_POST['table_id']) ? str_replace("undefined,", "", $_POST['table_id']) : "");
$ordertype = (isset($_POST['ordertype']) && !empty($_POST['ordertype']) ? $_POST['ordertype'] : "");
$noofpersons = (isset($_POST['noofpersons']) && !empty($_POST['noofpersons']) ? $_POST['noofpersons'] : "");
$rsuppliers = (isset($_REQUEEST['suppliers']) && !empty($_REQUEEST['suppliers']) ? $_REQUEEST['suppliers'] : "");
$suppliers = (isset($_POST['suppliers']) && !empty($_POST['suppliers']) ? $_POST['suppliers'] : $rsuppliers);
$session = (isset($_POST['session']) && !empty($_POST['session']) ? $_POST['session'] : '');
$chktableid = explode(',', $tableid);
$chairs = (isset($_REQUEST['chairs']) && !empty($_REQUEST['chairs']) ? $_REQUEST['chairs'] : "");
$editstatus = (isset($_REQUEST['editstatus']) && !empty($_REQUEST['editstatus']) ? $_REQUEST['editstatus'] : "");
$tbldtls = explode(',', $chairs);
foreach ($tbldtls as $tbldtlsdata) {
	$tbldtlsplit = explode('_', $tbldtlsdata);
	$dtml = (!empty($chairslist) ? ',' : '');
	$chairslist .= $dtml . $tbldtlsplit[0];
	$chairedit[] = $tbldtlsplit[0];

}
$_SESSION['category'] = (isset($_POST['category']) && !empty($_POST['category']) ? $_POST['category'] : '');
if (isset($_SESSION['category']) && !empty($_SESSION['category']))
	$sessioncategory = explode(',', $_SESSION['category']);

switch ($action) {
	case "savemenulistres" :
		$confirm_menu = $hms_info_obj -> SaveMenuList();
		break;
	case "itemsremove" :
		
		$remove = $hms_info_obj -> getremoveitem();
		break;
	case "updatequantity" :
		$remove = $hms_info_obj -> getupdatequantity();
		break;
	case "bill_cancel" :
		$deleterow = $hms_info_obj -> getCancelBill($_POST['cart_id'], $chairslist, $_POST['cancelcomments'], $_POST['accountsession']);
		break;
	case "bill_nocash" :
		$hms_info_obj -> getnoCashBill($_POST['cart_id'], $chairslist, $_POST['nocashcomments']);
		break;
	case "close_cancel" :
		$closerow = $hms_info_obj -> getCloseBill($_POST['cart_id'], $chairslist);
		break;
	case "cancelitem" :
		$cancel = $hms_info_obj -> getcancelitem();
		break;
	case "parcelitem" :
		$cancel = $hms_info_obj -> getparcelitem();
		break;
}
//echo $_POST['bill'];
$order_cart_id = (isset($_POST['order_cart_id']) ? $_POST['order_cart_id'] : "");
//echo $order_cart_id;
$id = (isset($tableid) ? $tableid : "");
//echo $id;
$order_type = (isset($_POST['ordertype']) ? $_POST['ordertype'] : "");
//echo $order_type;

$hms_info_sql = $hms_info_obj -> menuEntryAllRecords($chairslist, $order_type);
$hms_info_value = $hms_info_obj -> menudetailAllRecords($chairslist, $order_type);
$tabletree = $hms_info_obj -> getTableTree();
$ordertabletree = $hms_info_obj -> getorderTableTree();
$getordersession = $hms_info_obj -> getordersession();

if (db_num_rows($getordersession) > 0) {
	$fetchordersession = db_fetch_array($getordersession);
	$ordersession = $fetchordersession['hros_session'];
	$session = (!empty($session) ? $session : $ordersession);
}
$getcategory = $hms_info_obj -> getcategorydetails();

$fetchcartdtlss = db_fetch_array($hms_info_value);
$cartids = $fetchcartdtlss['order_cart_id'];
if (!empty($cartids)) {
	$htd_info = $hms_info_obj -> gettabledetails($cartids);
	$fetch = db_fetch_array($htd_info);
	$dbsuppliers = $fetch['htd_supplier_id'];
	$dbnoofpersons = $fetch['htd_noofpersons'];
}
?>
<script src="js/jquery-ui.js"></script>
<script language="JavaScript" type="text/javascript" src="js/combobox.js"></script>
<input type='hidden' id='editstatus' name='editstatus' value='<?php echo $editstatus; ?>' />

  

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
		
 <table width="93%" align="center" cellpadding="0" cellspacing="0" class="tableborder">

          <tr>
       <td width="100%" height="35" align="center" valign="middle" bgcolor="#D7DBB0" class="verdanabold"><span >RESTAURANT ORDER ENTRY </span></td>
          </tr>
             <tr><td id="error_service" style="display:none;background-color:#EC8F82;border:solid 1px #FF0000;text-align:center;"></td></tr>
          <tr><td height="35"></td></tr>
           <tr align="center">
               <td  height="35" align="center"  class="verdanabold" >
                   <table width="50%" border="0" align="center" cellpadding="0" cellspacing="0" style="color:#3a6997;">
                       <tr><td><input tabindex="1" type="checkbox" <?php if($ordersession=='B'){?> checked="checked" <?php } ?> class="accsession" id="breakfast"  name="accountsession" value="B" />&nbsp; Breakfast</td>
                           <td><input tabindex="2" type="checkbox" <?php if($ordersession=='L'){?> checked="checked" <?php } ?>  class="accsession" id="lunch" name="accountsession" value="L" />&nbsp; Lunch</td>
                           <td><input tabindex="3" type="checkbox" <?php if($ordersession=='S'){?> checked="checked" <?php } ?>   class="accsession" id="snacks"  name="accountsession" value="S" />&nbsp; Snacks</td>
                           <td><input tabindex="4"  type="checkbox" <?php if($ordersession=='D'){?> checked="checked" <?php } ?>  class="accsession" id="dinner"  name="accountsession" value="D" />&nbsp; Dinner</td>
                           <td><input tabindex="5" type="checkbox" class="accsession" id="endofday" name="accountsession" value="E"   />&nbsp; EOD</td>
                       </tr>
                   </table>
                   
               </td>
          </tr>
	  	  
          <tr>
            <td height="30" valign="middle" class="verdanablack">
        <table width="100%" border="0" align="center" cellpadding="2" cellspacing="1">
        <tbody>
                
                
               
          
                <?php if (isset($_POST["msg"]) && $_POST["msg"] != "" ) { ?>
              <tr>
                <th colspan="6"><span style="color:#F00" class="style2"><?php echo $_POST["msg"]; ?></span></th>
              </tr>
			  <?php } ?>
                <tr>
                  <td colspan="6" align="center" height="30">&nbsp;</td>
                </tr>
		<?php echo(isset($_POST['vat']) ? $_POST['vat'] : ""); ?>
			  <tr>
                  <td width="1%" height="22">&nbsp;</td>
                  <td width="14%" class="verdanablack">Order Type: </td>
                  <td colspan="3" align="left">
           
  <select name='ordertype' id='ordertype' class="selectinput" onchange="tabelshow(this.value)" tabindex="6"> 
    <!-- <?php if(isset($_POST['ordertype']) && !empty($_POST['ordertype'])){ ?> disabled="disabled"<?php }?>  -->  
<?php 
if(isset($_SESSION["admin_role_mst_id"]) && !empty($_SESSION["admin_role_mst_id"]) && $_SESSION["admin_role_mst_id"]!='3'){
?>
<option <?php if (isset($_POST['ordertype']) && $_POST['ordertype'] == dine) echo 'selected="selected"'; ?> value='dine'>Dine</option>
<option <?php if (isset($_POST['ordertype']) && $_POST['ordertype'] == parcel) echo 'selected="selected"'; ?> value='parcel'>Take Out</option>
<?php } ?>
		
</select>			
			
			    </td>
                
                </tr>		
                <!-- THIS ROW WILL ONLY EXIST ON EDIT OF AN EXISTING BILL -->

<?php if(isset($_SESSION["admin_role_mst_id"]) && !empty($_SESSION["admin_role_mst_id"]) && $_SESSION["admin_role_mst_id"]!='3'){?>
<tr><td height="20"></td><td class="verdanablack">Table</td>
<td colspan="4">
    <?php
	include ("restauranttable.php");
?>
</td>
</tr> 
<tr><td height="15"></td></tr>
<tr>
    <td height="20"></td><td class="verdanablack">Select Table No:</td><td colspan="5">
        <select id="tables" tabindex="7" name="tables"  onchange="changetable(this.value);"  >
            
           <?php
           $selecttable = db_query("SELECT *  FROM " . TABLE_HMS_TABLE_ENTRY . " WHERE active=1 ORDER BY `table_entry_id`");
           if(db_num_rows($selecttable)>0){
               ?> <option value="" > -- Select Table -- </option> <?php
                   while($fetchtable = db_fetch_array($selecttable))
                   { 
                      
                    
                       ?>
            <option value="<?php echo $fetchtable['table_entry_id']; ?>" <?php if($dbsuppliers==$fetchtable['table_entry_id']){?> selected="selected" <?php } ?>  ><?php echo $fetchtable['table_no']; ?></option>  
         
                   <?php }
			}
           ?>
        </select>
    </td>
</tr>
<tr><td height="20"></td><td class="verdanablack">No. of Persons</td><td colspan="5"><input tabindex="8" type="text" value="<?php echo $dbnoofpersons; ?>" id="noofpersons"  name="noofpersons" style="width:60px;" onkeyup="checkNumber(this);" onblur="assign_chair(this.value);" onfocus="clear_chair();" /></td></tr>
<tr>
    <td height="20"></td><td class="verdanablack">Suppliers</td><td colspan="5">
        <select id="suppliers" tabindex="9"   name="suppliers">
            <option value="" >--Select Supplier--</option>
           <?php
           $selectsupplier = db_query("SELECT `supplier_id`,`supplier_name` FROM " . TABLE_HMS_SUPPLIER_CREATION . " WHERE active=1 ORDER BY `supplier_id`");
           if(db_num_rows($selectsupplier)>0){
                   while($fetchsupplier = db_fetch_array($selectsupplier))
                   {?>
                     <option  value="<?php echo $fetchsupplier['supplier_id']; ?>" <?php if($dbsuppliers==$fetchsupplier['supplier_id']){?> selected="selected" <?php } ?> ><?php echo $fetchsupplier['supplier_name']; ?></option>  
                   <?php }
						}
           ?>
        </select>
    </td>
</tr>


<tr><td height="15"></td></tr> 



<tr><td height="15"></td></tr> 
<?php } ?>
 
<?php if($session!='' && $session!='E'){?><tr class="category"><td height="20"></td><td class="verdanablack"><!-- Category --></td>
    <td colspan="4">
        <table cellpadding="0" cellspacing="0" border="0"  class="verdanablack mss"  style="color: #3a6997;">
            <tr>
                <?php 
                if(db_num_rows($getcategory)>0)
                {$i=1;
                while($fetchcategory = db_fetch_array($getcategory)){
                ?>
                <td><div>
                     <input type="checkbox" name="category" <?php if(!empty($sessioncategory) && in_array($fetchcategory['hms_menu_category_id'],$sessioncategory)){?> checked="checked" <?php } ?> class="getcategory chkcaticon<?php echo $i; ?>" id="category<?php echo $i; ?>" value="<?php echo $fetchcategory['hms_menu_category_id']; ?>" />
                     <label for="category<?php echo $i; ?>" title="<?php echo $fetchcategory['hms_menu_category_name']; ?>"></label></div></td>
            <style>
    
                .chkcaticon<?php echo $i; ?>[type=checkbox] {
                   display:none;
                 }

                 .chkcaticon<?php echo $i; ?>[type=checkbox] + label
                  {
                      background: url('images/categoryicon/<?php echo $fetchcategory['hms_menu_icon']; ?>
					') no-repeat;
					height: 50px;
					width: 50px;
					display: inline-block;
					padding: 0 0 0 0px;
					border: 1px solid #777272;
					background-size: 100% 100%;
					/*cursor: pointer;*/

					}

					.chkcaticon
<?php echo $i; ?>
	[type=checkbox]:checked + label {
		height: 50px;
		width: 50px;
		display: inline-block;
		padding: 0 0 0 0px;
		border: 3px solid red;
		opacity: 0.4;
		filter: alpha(opacity=40);
		/*cursor: pointer;*/
	}
	.mss td {
		width: 10px;
		padding: 10px 8px;
	}
               </style> 
                
                    <?php
					if ($i % 10 == 0) {echo '</tr><tr>';
					}
					$i++;
					}}
				?>
            </tr>
        </table>
    </td>
</tr> 
<tr><td height="15"></td></tr><?php } ?> 
<tr>
<td height="20"></td>
<td class="verdanablack" valign="top" style="padding-top:37px;">Category Search:</td>            
<td>
<div class="form2">
<!-- <img src="images/301.GIF" id="loader2" /> -->
<!-- <input id="search-box2" name="search-box2"  placeholder="-- ALL --"    tabindex="10" class="search"  type="text" autocomplete="off" /> -->
<select id="search-box2" tabindex="10"></select>
<input id="categ_id" name="categ_id" type="hidden"/>
<!-- <ul id="search_suggestion_holder2">   </ul> -->
</div>
</td>
                      
</tr>
<tr>
<td height="20"></td>
<td class="verdanablack" valign="top" style="padding-top:37px;">Item Name:</td>
<td colspan="5">
<div class="form">
  <!-- <img src="images/301.GIF" id="loader" />
  <input id="search-box" name="search-box" placeholder="search"  onfocus="var temp_value=this.value;this.value='';this.value=temp_value" tabindex="11" class="search" type="text"    autocomplete="off"/>
	<ul id="search_suggestion_holder">
  </ul> -->
<select id="search-box" tabindex="11"></select>
</div>

 </td>
</tr> 
<tr><td height="15"></td></tr> 
<tr><td height="20"></td><td class="verdanablack">Item Code: </td><td colspan="5" ><input onkeyup="checkNumber(this);" type="text" tabindex="12" id="itemcode"  name="itemcode" style="width:100px;" /> &nbsp;&nbsp;&nbsp; <span id="item_name" class="verdanablack" ></span></td><td colspan="3"></td></tr>
<tr>
        <td >
  
       <!-- onkeyup="orderquantity('<?php echo $hms_info_values["order_id"]; ?>',this.value);"-->
 </td>
</tr>
  <!-- THIS SET CAN ONLY EXIST ONCE SERVICE IS CHOSEN -->
    
                <tr>
                  <td colspan="5"></td>
                </tr>
               
              </tbody>
            </table></td>
          </tr>
          <tr>
            <td height="20" align="left" valign="middle" class="verdanablack">&nbsp;</td>
          </tr>

         
 <!-- new -->   

<tr >
<td>
 <?php
 $select_cart_id =db_query("SELECT * FROM ". TABLE_HMS_RESTAURANT_ORDER_DETAILS." WHERE status='open' AND itemcancel=0");
 $count = mysql_num_rows($select_cart_id); 
if($count>0){ 
 ?>
<table id="bill_row" border="0" width="100%" align="center" valign="middle" >
 

<tr>
<td width="100%" height="35" align="center" valign="middle" bgcolor="#D7DBB0" class="verdanabold"><span >RESTAURANT ORDER ITEM LIST </span></td>
</tr>
     
<tr>
 <?php

while ($hms_info_bill = db_fetch_array($hms_info_value)) {

	$hms_info_fetch_table_sql = "SELECT `table_entry_id`,`table_type_id`,`table_no`,`numbers_of_chairs`,`active`,`date_added`,`date_modified` FROM  " . TABLE_HMS_TABLE_ENTRY . " WHERE table_entry_id = '" . $hms_info_bill["table_entry_id"] . "' ";

	$table_records = db_query($hms_info_fetch_table_sql);
	$table = db_fetch_array($table_records);

	$tabel = $table["table_no"];
	$bill = $hms_info_bill['bill_id'];
	$cardid = $hms_info_bill['order_cart_id'];
	$tabelid = $hms_info_bill['table_entry_id'];
	$order_type = $hms_info_bill['order_type'];

}

if (isset($_SESSION["admin_role_mst_id"]) && !empty($_SESSION["admin_role_mst_id"]) && $_SESSION["admin_role_mst_id"] != '1')
	$wherecon = " AND created_role_id='" . $_SESSION["admin_role_mst_id"] . "'";
$savebill_printchk = db_query("SELECT * FROM " . TABLE_HMS_RESTAURANT_ACCOUNT_DETAILS . " WHERE  status='open' $wherecon");
$save_bill_chk = db_fetch_array($savebill_printchk);
$account_id = $save_bill_chk['account_id'];
$account_totalcartamt = $save_bill_chk['total_amount'];
 ?>
  <input type="hidden" id="account_id" name="account_id" value="<?php echo $account_id?>" /> 
    <td colspan="6" align="left" height="30">
        <table cellpaddin="0" cellspacing="0" border="0" width="850">
            <tr>
                <td width="300"><?php
				if (!empty($chairslist))
					echo 'Supplier : ' . getsuppliername($dbsuppliers);
			?></td>
                <td width="400"><?php echo date("d-m-y h:i:s"); ?></td>
                <td><?php if(!empty($chairslist)){ ?>
                Table NO:<?php echo $chairslist; ?>			
                <?php } ?></td>
            </tr>
        </table>
    </td>    
</tr>
<tr>
<td colspan="6" align="center" height="30">
<div id="itemreplace"></div>
<div id="items"  style="border:solid 2px #666; ">
    
<table border="0" class="itementrycls" width="100%" height="35" align="center">
<tr>
    <th width="1%" height="40"><input type="checkbox" id="chksno" />S.No</br></th>
<th width="15%">Item</th>
<th width="15%">Category</th>
<th width="10%">Rate</th>
<th width="10%">Qty</th>
<th width="15%">Cancel Qty</th>
<th width="10%">Amt</th>
<th width="10%">Total</th>
<?php if(isset($_SESSION["admin_role_mst_id"]) && !empty($_SESSION["admin_role_mst_id"]) && $_SESSION["admin_role_mst_id"]!='3'){?><th width="10%"><input type="checkbox" type="hidden" id="chkparcel" />Parcel</th><?php } ?>
</tr>
<input type="hidden" id="itemcount" value="<?php echo db_num_rows($hms_info_sql); ?>" />
 <?php 
 
 
 $hms_info_counter = 1;
 $q=1;  
 while ($hms_info_values = db_fetch_array($hms_info_sql)) { 
   
          
    ?>

<tr>
<td class="verdanablack" style="text-align:center">
    <input type="hidden" class="noneborder" name="checksave" id="checksave" value="<?php echo $checksave; ?>" />
    <input type="hidden" class="noneborder" name="order_bill_id" id="order_bill_id" value="<?php echo $bill; ?>" />
    <input type="hidden" class="noneborder" name="order_cart_id" id="order_cart_id" value="<?php echo $hms_info_values["order_cart_id"]; ?>" />
    <input type="checkbox" class="noneborder classchk" name="checkbox[]" id="checkbox" value="<?php echo $hms_info_values["order_id"]; ?>" />
  	<?php echo $hms_info_counter; ?>
</td>
<td class="verdanablack" style="text-align:center">  
	<?php  echo $hms_info_values["order_product"];
			if ($hms_info_values["parcel_status"] == 1)
				echo "<span class='pred'>(P)</span>";
  	?>              
</td>
<td class="verdanablack" style="text-align:center">
	<?php
		$hms_info_fetch_table_sql = "SELECT `menu_category_id` FROM " . TABLE_HMS_MENUENTRY . " WHERE menu_id = " . $hms_info_values["menuid"] . " ";
		$table_records = db_query($hms_info_fetch_table_sql);
		$table = db_fetch_array($table_records);
		$hms_info_fetch_table_menu = "SELECT `hms_menu_category_name` FROM " . TABLE_HMS_MENU_CATEGORY . " WHERE hms_menu_category_id = " . $table["menu_category_id"] . " ";
		$menu_records = db_query($hms_info_fetch_table_menu);
		$menu_categ = db_fetch_array($menu_records);
		echo $menu_categ["hms_menu_category_name"];
    ?>     
</td>
<td class="verdanablack" style="text-align:center">
	<?php echo $hms_info_values["order_price"]; ?> 
</td>  
<td class="verdanablack" style="text-align:center">
	<input type="text" tabindex="13" class="quanty" name="quantity" data="<?php echo $hms_info_values["menuid"]; ?>" data2="<?php echo $hms_info_values["order_id"]; ?>" id="quantity_<?php echo $hms_info_values["order_id"]; ?>" style="width:45px;" autofocus  onfocus="var temp_value=this.value;this.value='';this.value=temp_value"  value="<?php echo $hms_info_values["order_quantity"]; ?>"/> 
	<!-- onkeyup="orderquantity('<?php echo $hms_info_values["order_id"]; ?>',this.value);"-->
</td>
<td class="verdanablack" style="text-align:center">
	<input type="text" class="cquantity"   name="cquantity" id="cquantity_<?php echo $hms_info_values["order_id"]; ?>" style="width:45px;" autofocus  onfocus="var temp_value=this.value;this.value='';this.value=temp_value"   value="0" onkeyup="cancelquantity('<?php echo $hms_info_values["order_id"]; ?>',this.value);" /> 
</td>        
<td class="verdanablack" style="text-align:center">
	<?php
		$price = $hms_info_values["order_price"] * $hms_info_values["order_quantity"];
	?> 
    <input type="text" name="order_amount"  style="width:50px;"  id="order_amount"  readonly="readonly" value="<?php echo number_format((float)$price, 2, '.', ''); ; ?>"/>         
</td>
	<?php
		$hms_info_fetch_table_sql = "SELECT `menu_category_id` FROM " . TABLE_HMS_MENUENTRY . " WHERE menu_id = " . $hms_info_values["menuid"] . " ";
		// echo $hms_info_fetch_table_sql;
		$table_records = db_query($hms_info_fetch_table_sql);
		$table = db_fetch_array($table_records);
		// echo $table["menu_category_id"];
		$hms_info_fetch_table_menu = "SELECT `vat_tax`,`service_tax` FROM " . TABLE_HMS_MENU_CATEGORY . " WHERE hms_menu_category_id = " . $table["menu_category_id"] . " ";
		$menu_records = db_query($hms_info_fetch_table_menu);
		$menu_categ = db_fetch_array($menu_records);
		$vat_tax = $menu_categ["vat_tax"];
		$service_tax = $menu_categ["service_tax"];
		if ($vat_tax == "0" || $vat_tax == "")
			$v_tax = 0;
		else {
			$price = $hms_info_values["order_price"] * $hms_info_values["order_quantity"];
			$v_tax = $price * ($vat_tax / 100.0);
		}
	?>  
	<input type="hidden" name="vat_Tax" id="vat_Tax" value="<?php echo $v_tax; ?>" >  
 	<?php
		if ($service_tax == "0" || $service_tax == "")
			$s_tax = 0;
		else {
			$price = $hms_info_values["order_price"] * $hms_info_values["order_quantity"];
			$s_tax = $price * ($service_tax / 100.0);
		}
 	?>  
    <input type="hidden" name="ser_Tax" id="ser_Tax" value="<?php echo $s_tax; ?>" >  
	<td class="verdanablack" style="text-align:right">
  		<?php
			$price = $hms_info_values["order_price"] * $hms_info_values["order_quantity"];
			//$incl_tax=$price*($s_tax)+($v_tax);
			// $net_total_price= round($price+$s_tax+$v_tax);
			$net_total_price = $price + $s_tax + $v_tax;
  		?> 
		<input type="text" name="<?php echo $hms_info_values["order_id"]; ?>"  style="width:80px;"  id="<?php echo $hms_info_values["order_id"]; ?>" readonly="readonly" value="<?php echo number_format((float)$net_total_price, 2,'.', ''); ?>"/>      
  	</td>
  
  	<?php if(isset($_SESSION["admin_role_mst_id"]) && !empty($_SESSION["admin_role_mst_id"]) && $_SESSION["admin_role_mst_id"]!='3'){?>
  		<td style="text-align:center;">
  			<input tabindex="13" type="checkbox" class="noneborder pchk" name="pcheckbox[]" id="pcheckbox_<?php echo $q; ?>"<?php if ($hms_info_values["parcel_status"] == 1 || $_POST['ordertype'] == 'parcel') echo "checked='checked'"; ?> data="<?php echo $hms_info_values["order_id"]; ?>" />
  		</td>
  	<?php } ?>
 	<?php
		$hms_info_counter++;
		$q++;
		}
    ?>
    </tr> 
	<tr>
		<td class="verdanablack"  colspan="12"  style="text-align: right; font-size: 12px; padding-right: 32px; padding-top: 20px;" >Total-Amount: 
		   	<?php
				$menuRecords = db_query("SELECT menuid,vat_amount,order_amount,service_amount FROM " . TABLE_HMS_RESTAURANT_ORDER_DETAILS . " WHERE `status` = 'open' AND itemcancel=0 AND table_entry_id='" . $chairslist . "' AND order_type='" . $ordertype . "' ");
				while ($price_values = db_fetch_array($menuRecords)) {
					$netamountt += ($price_values['vat_amount'] + $price_values['service_amount'] + $price_values['order_amount']);
				}
				//	echo($netamountt);
				echo number_format((float)$netamountt, 2, '.', ''); 
		 	?>
	    	<input type="hidden" name="total" id="total" value="<?php  echo($netamountt); ?>"/>  
		</td>
	</tr>
    <tr>
    	<td class="verdanablack" style="text-align:right; margin-left:50px;">
   			<input name="delete" type="submit" id="delete" value="Remove Item"  onclick="removeitems()" style="background-color:#063; width:90px; font-family:Arial, Helvetica, sans-serif; color:#FFF;" />  
  			<input name="item_cancel" type="submit" id="item_cancel" value="Cancel Item"   style="background-color:#063; width:90px; font-family:Arial, Helvetica, sans-serif; color:#FFF;" />  
  		</td>
   	</tr>
   	<tr>
   		<td class="verdanablack"  colspan="12"  style="text-align: right; font-size: 12px;  padding-right: 32px;" >
    		Discount(%):<input type="text" name="disc" id="disc"  value="" onkeyup="Gettax()" style="width:40px;">   
        </td>
   	</tr>
    <tr>
     	<td class="verdanablack"  colspan="12"  align='right' style="padding-right: 50px;"> 
 			<div id="netamount" style="font-size: 16px; padding-left: 20px;">NET-AMOUNT: 
   				<?php
					echo roundoff($netamountt);
 				?> 
	 		</div>
          	<input type="hidden" name="netamount_v" id="netamount_v"  value="<?php  echo roundoff($netamountt); ?>"  style="width:40px;"> 
	 	</td>
	 </tr>
      
	<tr>
		<td class="verdanablack"  colspan="12"  align='left' style="padding-left:10px; padding-bottom: 10px;"> PAYMENT TYPE: 
        	<input type="checkbox" checked="checked" name="full" id="full" value="1" onclick="show_full()">  Full
        	<input type="checkbox" name="partial" id="partial" value="1" onclick="show_partial(this.value)">  Partial      
	 	</td>          
  	</tr>   
  	<tr> 
  		<td colspan="12" >
        	<table border="0" width="100%" align="left"  cellpadding="10" cellspacing="10" id="partial_customer" style="display:none;">
        		<tr>
					<td style="font-size: 12px; font-weight: bold;" class="verdanablack" align="left" colspan="5">
						Customer Name : <input type="text" name="customer_name" id="customer_name" value="<?php echo $customer_name; ?>" >
					</td>   
					<td style="font-size: 12px; font-weight: bold;" class="verdanablack" align="left"> 
						Mobile Number : <input type="text" name="mobile" id="mobile" onkeyup="checkNumber(this);" value="<?php echo $mobile; ?>" maxlength="13" > 
                 	</td>
					<td style="font-size: 12px; font-weight: bold;" class="verdanablack" align="left" valign="top">&nbsp; &nbsp;  
						Address : <textarea id="address" name="address"></textarea>
                 	</td>
				</tr>   
			</table>
		</td>
	</tr>
	<tr>
		<td class="verdanablack"  colspan="12"  align='left' style="padding-left:10px;"> 
        	MODE OF PAYMENT : 
        	<input type="checkbox" checked="checked" name="cash" id="cash" value="1" onclick="show_cash()">  Cash
        	<input type="checkbox" name="card" id="card" value="1" onclick="show_card(this.value)">  Credit (or) Debit Card      
        	<input type="checkbox" name="cheque" id="cheque" value="1" onclick="show_cheque(this.value)"> Cheque
        	<input type="checkbox" name="online" id="online" value="1" onclick="show_online_payment(this.value)">  Online Payment
	 	</td>
	</tr>   
	<tr>
    	<td class="verdanablack"  colspan="12"   style="padding-left: 10px;"> 
			<table border="0" width="100%" align="left"  cellpadding="10" cellspacing="10" id="customer_details" style="display:;">                          
				<tr>
					<td style="font-size: 12px; font-weight: bold;" align="right" colspan="3">
						Cash Pay Amount : 
						<input type="text" name="cash_pay_amount" id="cash_pay_amount"  onkeyup="checkNumberdot(this);get_amount_value(this.value);" value="<?php echo number_format((float)roundoff($netamountt), 2, '.', ''); ?>" > 
                 	</td>
             	</tr> 
			</table>
			<table border="0" width="100%"  align="left" cellpadding="10" cellspacing="10"  id="card_details" style="display:none;">                    
				<tr>
					<td style="font-size: 12px; font-weight: bold;" align="right" colspan="3"> Card Pay Amount :  
                		<input type="text" name="card_pay_amount" id="card_pay_amount"  onkeyup="get_amount_value(this.value);" value="<?php echo $pay_amout; ?>" >   
                	</td>
             	</tr>
             	<tr>
					<td style="font-size: 12px; font-weight: bold;" align="left" width="500"> Card Number : 
						<input type="text" name="card_no" id="card_no" value="<?php echo $card_no; ?>" >
					</td>
					<td style="font-size: 12px; font-weight: bold;" align="left" width="500">
						&nbsp;Name : 
                  		<input type="text" name="card_name" id="card_name" value="<?php echo $card_name; ?>" > 
                 	</td>
                 	<td style="font-size: 12px; font-weight: bold;" align="left" width="500"> Expire Date : 
                     	&nbsp;  <input type="text" name="exp_date" id="exp_date" placeholder="ex: 01-01-2015" style="width: 100px;" value="<?php echo $exp_date; ?>" > 
                 	</td>               
				</tr> 
			</table>
			<table border="0" width="100%" align="left"  cellpadding="10" cellspacing="10" id="cheque_details" style="display:none;">
				<tr>
					<td style="font-size: 12px; font-weight: bold;" align="right" colspan="3">Cheque Pay Amount :  
                	<input type="text" name="cheque_pay_amount" id="cheque_pay_amount"  onkeyup="get_amount_value(this.value);" value="<?php echo $pay_amout; ?>" >   </td>
             	</tr> 
                <tr>
                	<td style="font-size: 12px; font-weight: bold;" align="left" width="500"> Cheque Number : 
                    	<input type="text" name="cheque_no" id="cheque_no" value="<?php echo $cheque_no; ?>" > 
                 	</td>
                 	<td style="font-size: 12px; font-weight: bold;" align="left" width="500">
                		&nbsp; &nbsp;  Cheque Name : 
                  		<input type="text" name="ceq_name" id="ceq_name" value="<?php echo $ceq_name; ?>" > 
                 	</td>
					<td style="font-size: 12px; font-weight: bold;" align="left" width="500"> Cheque Date : 
						&nbsp; &nbsp; &nbsp;  <input type="text" name="ceq_date" id="ceq_date" placeholder="ex: 01-01-2015" style="width: 100px;" width="30" value="<?php echo $ceq_date; ?>" > 
                   </td>
				</tr>
			</table>
			<table border="0" width="100%"  align="left" cellpadding="10" cellspacing="10"  id="online_payment" style="display:none;">
				<tr >
					<td style="font-size: 12px; font-weight: bold;" align="right" colspan="3">Online Pay Amount :  
                	<input type="text" name="online_pay_amount" id="online_pay_amount"  onkeyup="get_amount_value(this.value);" value="<?php echo $pay_amout; ?>" >   </td>
				</tr>    
				<tr>
					<td style="font-size: 12px; font-weight: bold;" align="left" width="500"> Card Number : 
						<input type="text" name="on_card_no" id="on_card_no" value="<?php echo $on_card_no; ?>" >  
					</td>
                 	<td style="font-size: 12px; font-weight: bold;" align="right" width="500">
                 		&nbsp;  &nbsp;  Name : 
                  		<input type="text" name="on_card_name" id="on_card_name" value="<?php echo $on_card_name; ?>" > 
                 	</td>
             	</tr> 
               	<tr>
					<td style="font-size: 12px; font-weight: bold;" align="left" width="500"> Expire Date : 
                    	&nbsp;  <input type="text" name="on_exp_date" id="on_exp_date" value="<?php echo $on_exp_date; ?>" placeholder="ex: 01-01-2015" style="width: 100px;">
                    </td>
					<td style="font-size: 12px; font-weight: bold;" align="right" width="500" colspan="2"> Transactions Id : 
						&nbsp;  <input type="text" name="transactions_id" id="transactions_id" value="<?php echo $transactions_id; ?>" > 
                 	</td>
             	</tr> 
			</table>
			<tr>
	    		<td align="right" colspan="12" style="padding-right: 9px; font-size: 12px; font-weight: bold;"> Balance Amount :  <input type="text" name="return_amount" id="return_amount" onkeyup="get_amount_value(this.value);" value="<?php echo(isset($return_amount) && !empty($return_amount) ? $return_amount : ""); ?>" >   </td>
			</tr> 
			<tr id="cancelcmt" style="display:none;">
				<td colspan="13" align="right">  
					<table>
	 					<tr>
	     					<td>Comments : </td>
	     					<td onkeyup="checkNumber(this);"><textarea id="cancelcomments" name="cancelcomments"></textarea></td>
						</tr>
						<tr>
	     					<td></td>
	     					<td style="text-align: center;"><input name="bill_cancel" type="submit" id="bill_cancel" value="Submit" style="background-color:#063; font-family:Arial, Helvetica, sans-serif; color:#FFF;" />
	     						<input  type="button" id="omitcancel" value="Cancel" style="background-color:#063; font-family:Arial, Helvetica, sans-serif; color:#FFF;" />
	     					</td>
						</tr>
					</table>
	 			</td>  
			</tr>   
			<tr id="nocashcmt" style="display:none;">
	 			<td colspan="13" align="right">  
					<table>
	 					<tr>
	     					<td>Comments : </td>
	     					<td><textarea id="nocashcomments" name="nocashcomments"></textarea></td>
						</tr>
	  					<tr>
	     					<td></td>
	     					<td style="text-align: center;"><input name="bill_nocash" type="submit" id="bill_nocash" value="Submit" style="background-color:#063; font-family:Arial, Helvetica, sans-serif; color:#FFF;" />
	     						<input type="button" id="omitnocash" value="Cancel" style="background-color:#063; font-family:Arial, Helvetica, sans-serif; color:#FFF;" />
	     					</td>
	 					</tr>
					</table>
	 			</td>  
			</tr>
			<tr>
				<td class="verdanablack" style="text-align:center; margin-left:60px;" colspan="12"></br></br>
					<?php 
						$select = db_query("SELECT last_cancel_quantity_disp FROM ".TABLE_HMS_RESTAURANT_ORDER_DETAILS." WHERE last_cancel_quantity_disp!=0 AND order_cart_id='".$cardid."'");
						if(db_num_rows($select)==0){
					?>
							<input tabindex="15" name="separatebill" type="submit" class="genbtn" id="separatebill" value="Generate" style="background-color:#063; font-family:Arial, Helvetica, sans-serif; color:#FFF;" />
							
					<?php 
						} 
					?>
						<input tabindex="16" name="Save" type="submit" id="Save" value="Hold" style="background-color:#063; font-family:Arial, Helvetica, sans-serif; color:#FFF;"  />
						<input name="printclose" tabindex="17" type="button" id="printclose" value="Print & Close" style="background-color:#063; font-family:Arial, Helvetica, sans-serif; color:#FFF;"  />
						<input name="bill_cancel_cmt" type="button" id="bill_cancel_cmt" value="Cancel Bill" style="background-color:#063; font-family:Arial, Helvetica, sans-serif; color:#FFF;" />
						<?php if(isset($_SESSION["userid"]) && is_allow_module($_SESSION["userid"], 30)){?>
							<input name="nocashamt" type="button" id="nocashamt" value="No Cash Amount" style="background-color:#063; font-family:Arial, Helvetica, sans-serif; color:#FFF;" />
						<?php } ?>
					</td>
				</tr>
				<tr>
					<td class="verdanablack" style=" margin-left:60px;" colspan="12">
						<p style="margin-left: 255px;font-size:9px;">Ctrl+K &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ctrl+H&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ctrl+P&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ctrl+C&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ctrl+N</p>
					</td>
				</tr>
				<tr>
					<td colspan="12" height="30"></td>
				</tr>
			</table>
		</div>
	</td>
</tr> 
</table>
<?php } if(isset($_SESSION["admin_role_mst_id"]) && !empty($_SESSION["admin_role_mst_id"]) && $_SESSION["admin_role_mst_id"]!='1')
	$wherecon = " AND created_role_id='".$_SESSION["admin_role_mst_id"]."'";
	$savebill_print=db_query("SELECT * FROM ".TABLE_HMS_RESTAURANT_ACCOUNT_DETAILS." WHERE  status='open' $wherecon");
	
	if(db_num_rows($savebill_print)>0){
?>   
    <table border="0"  width="100%" cellpadding="0" cellspacing="0" bgcolor="#000000">
    <tr>
        <td>
            <div id="save_bill_content">
             
                <table width="100%" cellpadding="0" id="show_list_bill" >
    <tr style="font-size: 14px; font-weight: bold;" bgcolor="#a8b158">
 <td width="50"   align="center"  height="40">
S.No
 </td>
 
 <?php if(isset($_SESSION["admin_role_mst_id"]) && !empty($_SESSION["admin_role_mst_id"]) && $_SESSION["admin_role_mst_id"]!='3'){?>
   <td width="80"  align="center" >
		Table No
   </td>
   <td width="80"  align="center" >
		Supplier Name
   </td>
 <?php } ?>
  <td width="80" align="center" >
Order Type
 </td>
 
  <td width="80" align="center" >
Total Amount
 </td>
 
   <td width="80" align="center" >
Action
 </td>
 
 </tr> 
 
 <?php
  
  $sno=1;
  
  while($save_bill = db_fetch_array($savebill_print))
  {
  
      $table_id = $save_bill['tabel_id'];
      $account_id = $save_bill['account_id'];
      $cart_id = (!empty($save_bill['order_cart_id']) ? $save_bill['order_cart_id']:"");
 
 ?>
 <tr bgcolor="#ffffff" class="highlighteditorder<?php echo $save_bill['account_card_id']; ?>">
 <td width="50" class="verdanablack" align="center"  height="30">
<?php echo $sno; ?>
 </td>

 <?php if(isset($_SESSION["admin_role_mst_id"]) && !empty($_SESSION["admin_role_mst_id"]) && $_SESSION["admin_role_mst_id"]!='3'){?>
   <td width="80" class="verdanablack"  align="center" >
       
<?php
		//echo $save_bill['tabel_id'];
		$table_no_char = explode(",", $save_bill['tabel_id']);
		$table_no  = substr($table_no_char[0], 0, 1);
		echo 'Table '.$table_no.' ('.$save_bill['tabel_id'].')';
		
	?> 
 </td>
 <td width="80" class="verdanablack"  align="center" >
       
<?php
		$sup_name = db_query("SELECT * FROM " .TABLE_HMS_SUPPLIER_CREATION. " WHERE active=1 and supplier_id =".$save_bill['sup_name']."");
		$sup_name_array = db_fetch_array($sup_name);
		echo $sup_name_array['supplier_name'];
		//echo $sup_name_array;
	?> 
 </td>
 
 <?php } ?>
  <td width="80" class="verdanablack" align="center" >
<?php echo $save_bill['order_type']; ?>
 </td>
 
   <td width="80" class="verdanablack" align="center" >
<?php
	//echo $save_bill['discount'];
	$total = $save_bill['total_amount'] * ($save_bill['discount'] / 100.0);

	//echo $save_bill['total_amount']-round($total);
	echo number_format((float)$save_bill['total_amount'] - $total, 2, '.', '');
?>
 </td>
 
    <td width="80" class="verdanablack" align="center" >

        <a href="#" onclick="open_bill('<?php echo $save_bill['account_card_id']; ?>','<?php echo $save_bill['tabel_id']; ?>','<?php echo $save_bill['order_type']; ?>')"><img src="images/edit1.png" width="30" alt="Edit" border="0" title="Click to edit"></a>
         </td>
 
 </tr>
 
  <?php $sno++;
	}
 ?>
 

 
 </table>
            </div>            
        </td>        
    </tr>   
    

</table>
 <?php  } else{ ?><table border="0"  width="100%" cellpadding="0" cellspacing="0">     
<tr>
<td width="100%" height="35" align="center" valign="middle" bgcolor="#D7DBB0" class="verdanabold"><span >NO ORDER FOUND 
</span></td>
</tr></table><?php } ?>
</td>
</tr> 

     
<!--new end-->  

 
        </table></td>
      </tr>
       
      
     
    </table></th>
    <th width="29" background="images/rightline.jpg" scope="col"><img src="images/rightline.jpg" width="29" height="33" /></th>
  </tr>
  <tr>
    <th height="14" align="left" valign="middle" scope="col"><img src="images/left_bottom_corner.jpg" width="29" height="14" /></th>
    <td align="center" valign="middle" background="images/bottomline.jpg" bgcolor="#FFFEFF"><img src="images/bottomline.jpg" width="7" height="14" /></td>
    <th scope="col"><img src="images/right_bottom_corner.jpg" width="29" height="14" /></th>
  </tr>
</table><input type="hidden" id="showtabel" />
<style>
  .custom-combobox {
    position: relative;
    display: inline-block;
  }
  .custom-combobox-toggle {
    position: absolute;
    top: 0;
    bottom: 0;
    margin-left: -1px;
    padding: 0;
  }
  .custom-combobox-input {
   background: #f5f5f5 none repeat scroll 0 0;
    border: 1px solid #eee;
    margin-bottom: 1px;
    margin-top: 26px;
    padding: 10px;
    width: 500px;
  }
  .ui-autocomplete{
     background: #ffffff none repeat scroll 0 0;
    border: 1px solid;
    display: none;
    font-family: verdana;
    font-size: 12px;
    height: 160px;
    list-style: outside none none;
    overflow-x: hidden;
    overflow-y: scroll;
    padding: 2px 0;
    position: absolute;
    top: auto;
    width: 505px !important;
    z-index: 9999
  }
  </style>
<script> 
  $(function() {
  $( "#search-box2" ).combobox();
  $( "#search-box" ).combobox();
  function generatemenulist(){
            var value = $('#search-box option:selected').attr('id');
            var id = $('#search-box option:selected').attr('id');
            if ($(".accsession:checkbox:checked").length == 0) {
                $("#error_service").show();
                $("#error_service").html("Please Select Session");
                $(window).scrollTop('#error_service');
                $("#breakfast").focus();
                return false;
            } //alert(value);           
            else if (document.getElementById('ordertype').value == '') {
                document.getElementById('error_service').style.display = "block";
                document.getElementById('error_service').innerHTML = "Please Select Order Type";
                document.getElementById('ordertype').focus();
                return false;
            }

            var ordertype = document.getElementById('ordertype').value;

            if (ordertype == 'dine') {

                if ($(".gettableid:checkbox:checked").length == 0) {
                    $("#error_service").show();
                    $("#error_service").html("Please Select Table");
                    $(window).scrollTop('#error_service');
                    $(".gettableid").focus();
                    return false;
                } else if ($(".chairs:checkbox:checked").length == 0) {
                    $("#error_service").show();
                    $("#error_service").html("Please Select Chair");
                    $(window).scrollTop('#error_service');
                    $(".chairs").focus();
                    return false;
                } else if ($("#suppliers").val() == "") {
                    $("#error_service").show();
                    $("#error_service").html("Please Select the Supplier");
                    $(window).scrollTop('#error_service');
                    $("#suppliers").focus();
                    return false;
                } else if ($("#noofpersons").val() == "") {
                    $("#error_service").show();
                    $("#error_service").html("Please Enter the No. of Persons");
                    $(window).scrollTop('#error_service');
                    $("#noofpersons").focus();
                    return false;
                }
            }
            $("#error_service").hide();
            var suppliers = $("#suppliers").val();
            var noofpersons = $("#noofpersons").val();
            var editstatus = $("#editstatus").val();
            var tableid = $('.gettableid:checked').map(function() {
                return this.value;
            }).get().join(',');
            var chairs = $('.chairs:checked').map(function() {
                return this.value;
            }).get().join(',');
            var accountsession = $('input[name="accountsession"]:checked').val();
            var category = $('.getcategory:checked').map(function() {
                return this.value;
            }).get().join(',');
            var cart_id = $("#order_cart_id").val();
            //alert(cart_id);
            $.ajax({
                type: 'POST',
                url: 'restaurantOrderEntry.php',
                data: 'action=' + 'savemenulistres' + '&editstatus=' + editstatus + '&ordertype=' + ordertype + '&tableid=' + tableid + '&chairs=' + chairs + '&suppliers=' + suppliers + '&noofpersons=' + noofpersons + '&category=' + category + '&accountsession=' + accountsession + '&cart_id=' + cart_id + '&menuid=' + id + "&t=2",
                success: function(result) {
                    //alert(result.html());
                    $("#divmiddlecontent").html(result);
                    $("#tax_hidden").hide();
                    $.ajax({
                        type: 'POST',
                        url: 'checking.php',
                        data: 'action=itemavil&menuid=' + id,
                        success: function(data) {
                            var res = data.split("###");
                            if (res != '') {

                                $.tinyNotice({
                                    status: "warning",
                                    statusTitle: res[0],
                                    statusText: "Available Quantity :" + res[1],
                                    lifeTime: 10000
                                });
                            }

                        }
                    });

                }
            });
            //$('#search-box').val(value);
            $('#search_suggestion_holder').hide();
            //$('#search-box').focus();
            $('.quanty').last().focus().select();
            //itemfocus();
  }
  $(document).on('click','#ui-id-2 .ui-menu-item',function() {
  generatemenulist();   
  });
  search_box = $( "#search-box" ).next( ".custom-combobox" ).find('.custom-combobox-input');
  $(search_box).bind('keydown',function(e){
    if(e.which == 13){
      generatemenulist();  
    }
  });

  });
  </script>
<?php
	include ("restaurantorderentryscript.php");
?>