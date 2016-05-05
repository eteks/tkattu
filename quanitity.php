<?php 
require_once ("includes/application_top.php");
session_start();
$hms_info_obj = new restaurantbill();
$action = $_POST["action"] ? $_POST["action"] : $_GET["action"];
switch ($action) {
    case "savemenulistres":
    $confirm_menu = $hms_info_obj->SaveMenuList();
    break;
    case "itemsremove":
    $remove = $hms_info_obj->getremoveitem(); 
    break;	
case "updatequantity":
    $remove = $hms_info_obj->getupdatequantity();
    break;
	}
$id=$_POST['tableid'];

$hms_info_sql           = $hms_info_obj->menuEntryAllRecords($id);

$hms_info_value           = $hms_info_obj->menudetailAllRecords();
$tabletree   = $hms_info_obj->getTableTree();

$ordertabletree   = $hms_info_obj->getorderTableTree();

if($_POST['ordertype']) 
{	
//display();
}
function display(){
	echo '<script>alert("Enter");</script>';

}
?>

<script type="text/javascript" src="js/jquery-1.8.0.min.js"></script>
<script type="text/javascript">


$(document).ready(function(){
	
		 $("#search-box").focus();
});

$(document).ready(function(){
				var timer = null;
				$('#search-box').keyup(function(e){
					
					if( e.keyCode ==38 ){
						if( $('#search_suggestion_holder').is(':visible') ){
							if( ! $('.selected').is(':visible') ){
								$('#search_suggestion_holder li').last().addClass('selected');
								var value	=	$('.selected').text();
										$('#search-box').val(value);
							}else{
								var i =  $('#search_suggestion_holder li').index($('#search_suggestion_holder li.selected')) ;
								$('#search_suggestion_holder li.selected').removeClass('selected');
								var value	=	$('.selected').text();
								$('#search-box').val(value);
								i--;
								$('#search_suggestion_holder li:eq('+i+')').addClass('selected');
								var value	=	$('.selected').text();
										$('#search-box').val(value);
							}
						}
					}else if(e.keyCode ==40){
						if( $('#search_suggestion_holder').is(':visible') ){
							if( ! $('.selected').is(':visible') ){
								$('#search_suggestion_holder li').first().addClass('selected');
								var value	=	$('.selected').text();
										$('#search-box').val(value);
							}else{
								var i =  $('#search_suggestion_holder li').index($('#search_suggestion_holder li.selected')) ;
								$('#search_suggestion_holder li.selected').removeClass('selected');
										var value	=	$('.selected').text();
										$('#search-box').val(value);			
								i++;
								$('#search_suggestion_holder li:eq('+i+')').addClass('selected');
								var value	=	$('.selected').text();
										$('#search-box').val(value);
							}
						}					
					}else if(e.keyCode ==13){
						if( $('.selected').is(':visible') ){
					var value	=	$('.selected').text();
					id=$('.selected').attr('id');
					//alert(id);

if(document.getElementById('ordertype').value == '') {
    document.getElementById('error_service').style.display ="block";
    document.getElementById('error_service').innerHTML = "Please Select Order Type";
    document.getElementById('ordertype').focus();
    return false;
   }

var ordertype = document.getElementById('ordertype').value;

if(ordertype == 'dine') {
	
   if(document.getElementById('tableid').value == '') {
    document.getElementById('error_service').style.display ="block";
    document.getElementById('error_service').innerHTML = "Please Select Table Number";
    document.getElementById('tableid').focus();
    return false;
   }
}


var tableid = document.getElementById("tableid").value; 


 $.ajax({
      type:'POST',  
      url:'restaurantOrderEntry.php',
      data:'action=' + 'savemenulistres' + '&ordertype=' + ordertype + '&tableid=' + tableid+  '&menuid=' + id,
      success: function(result){    

               $("#divmiddlecontent").html(result);
			   $("#tax_hidden").hide();
      }
      });
							$('#search-box').val(value);
							$('#search_suggestion_holder').hide();
							$('#search-box').focus();
						}
					}else{
						var keyword		=		$(this).val();
						
						var menu = $('#MenuCardid').val();
						var sub_menu = $('#sub_category').val();
					//alert(menu);
					//alert(sub_menu);	
						$('#loader').show();
						setTimeout( function(){
							$.ajax({
								url:'get_suggestions.php',
				data:'keyword='+keyword+ '&menu=' + menu+ '&sub_menu=' + sub_menu,
								success:function(data){
									$('#search_suggestion_holder').html(data);
									$('#search_suggestion_holder').show();
									$('#loader').hide();
								}
							});
						},400);
					}
				});
				
				$('#search_suggestion_holder').on('click','li',function(){
					var value	=	$(this).text();
					$('#search-box').val(value);
					$('#search_suggestion_holder').hide();
					$('#search-box').focus();
				});
				
			});




$(document).ready(function(){
				var timer = null;
				$('#search-box').click(function(e){
					
					if( e.keyCode ==38 ){
						if( $('#search_suggestion_holder').is(':visible') ){
							if( ! $('.selected').is(':visible') ){
								$('#search_suggestion_holder li').last().addClass('selected');
							}else{
								var i =  $('#search_suggestion_holder li').index($('#search_suggestion_holder li.selected')) ;
								$('#search_suggestion_holder li.selected').removeClass('selected');
								i--;
								$('#search_suggestion_holder li:eq('+i+')').addClass('selected');
							}
						}
					}else if(e.keyCode ==40){
						if( $('#search_suggestion_holder').is(':visible') ){
							if( ! $('.selected').is(':visible') ){
								$('#search_suggestion_holder li').first().addClass('selected');
							}else{
								var i =  $('#search_suggestion_holder li').index($('#search_suggestion_holder li.selected')) ;
								$('#search_suggestion_holder li.selected').removeClass('selected');
								i++;
								$('#search_suggestion_holder li:eq('+i+')').addClass('selected');
								$('#search_suggestion_holder li.selected').scroll('selected');
								
							}
						}					
					}else if(e.keyCode ==13){
						if( $('.selected').is(':visible') ){
							var value	=	$('.selected').text();
							id=$('.selected').attr('id');
							$('#search-box').val(value);
							$('#search_suggestion_holder').hide();
							$('#search-box').focus();
						}
					}else{
						var keyword		=		$(this).val();
						$('#loader').show();
							var menu = $('#MenuCardid').val();
						var sub_menu = $('#sub_category').val();
						
//alert(menu);
//alert(sub_menu);	
						setTimeout( function(){
						
							
							$.ajax({
								url:'get_data.php',
				data:'keyword='+keyword+ '&menu=' + menu+ '&sub_menu=' + sub_menu,
								success:function(data){
									$('#search_suggestion_holder').html(data);
									$('#search_suggestion_holder').show();
									$('#loader').hide();
								}
							});
						},400);
					}
				});
				
$('#search_suggestion_holder').on('click','li',function(){
var value	=	$(this).text();
var id  = $(this).attr('id');
		//alert(value);			
if(document.getElementById('ordertype').value == '') {
document.getElementById('error_service').style.display ="block";
document.getElementById('error_service').innerHTML = "Please Select Order Type";
document.getElementById('ordertype').focus();
return false;
}

var ordertype = document.getElementById('ordertype').value;

if(ordertype == 'dine') {
	
   if(document.getElementById('tableid').value == '') {
    document.getElementById('error_service').style.display ="block";
    document.getElementById('error_service').innerHTML = "Please Select Table Number";
    document.getElementById('tableid').focus(); 
    return false; 
   }
}  
var tableid = document.getElementById("tableid").value; 

 $.ajax({
      type:'POST',  
      url:'restaurantOrderEntry.php', 
      data:'action=' + 'savemenulistres' + '&ordertype=' + ordertype + '&tableid=' + tableid+  '&menuid=' + id,
      success: function(result){    

               $("#divmiddlecontent").html(result);
			   $("#tax_hidden").hide();
			   
      }
      });
					$('#search-box').val(value);
					$('#search_suggestion_holder').hide();
					$('#search-box').focus();
				});
				
			});



function showState(sel) {
var country_id = sel.options[sel.selectedIndex].value;  
$("#output1").html( "" );
if (country_id.length > 0 ) {

$.ajax({
type: "POST",
url: "subcategory.php",
data: "country_id="+country_id,
cache: false,
beforeSend: function () {
$('#output1').html('<img src="images/loading.gif" alt="" width="24" height="24">');
},
success: function(html) {    
$("#output1").html( html );
}
});
}
}


function getmenubill(id){
//alert(id);
$.ajax({
type: "POST",
url: "bill_menu.php",
data:'action='+"billmenu"+'&tableid='+id,
cache: false,
beforeSend: function () {
$('#itemreplace').html('<img src="images/loading.gif" alt="" width="24" height="24">');
},
success: function(html) {  
$("#items").hide(); 
$("#itemreplace").html(html).show();
}
});		
}

   
function calculateSum() {
 
// alert("enter");
        var sum = 0;
        //iterate through each textboxes and add the values
        $(".txt").each(function() {
 
            //add only if the value is number
            if(!isNaN(this.value) && this.value.length!=0) {
                sum += parseFloat(this.value);
            }
 
        });
       $("#total_tax").val(sum);
	  // alert(sum); //.toFixed() method will roundoff the final sum to 2 decimal places
        //$("#sum").html(sum.toFixed(2));
    }
	
function tabelshow(order){
	

if(order == 'dine'){
	//alert(order);
	document.getElementById('showtabel').style.display = 'table-row';
	//document.getElementsByTagName('tableid').value = 1;
}
if(order == 'parcel'){
	//alert(order);
	document.getElementById('showtabel').style.display = 'none';
	//document.getElementById("tableid").options.length = 0;
	$('#tableid').val('');
}
}	

function gettax(tax){
$.ajax({
type: "POST",
url: "updatequantity.php",
data:'action='+"taxvalue"+'&tax='+tax,
success: function(html) {  
$("#tax_values").html(html).show();
 calculateSum();
}
});			

}


function carrytobill(){
$("#carry").show();
}

function getcustomername(room){

$.ajax({
type: "POST",
url: "updatequantity.php",
data:'action='+"getcustomername"+'&room='+room,
success: function(data) {  
 $("#cus_name").val(data);
}
});	
}

</script>


<style type="text/css">
	

div #carry{
    display: none;
}
	
</style>	
<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <th width="29" align="left" valign="middle" background="images/left_bg.jpg" scope="col"><img src="images/left_bg.jpg" width="29" height="20" /></th>
    <th width="942" align="center" valign="top" scope="col">
 
    <table width="942" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td align="center"><table width="93%" align="center" cellpadding="0" cellspacing="0" class="tableborder">

          <tr>
       <td width="100%" height="35" align="center" valign="middle" bgcolor="#D7DBB0" class="verdanabold"><span >RESTAURANT ORDER ENTRY </span></td>
          </tr>
		  
          <tr>
            <td height="30" valign="middle" class="verdanablack">
			<table width="100%" border="0" align="center" cellpadding="2" cellspacing="1">
              <tbody>
				<tr>
					<th colspan="6"><span  id="error_service" style="display:none;background-color:#EC8F82;border:solid 1px #FF0000;" ></span></th>
				</tr>
          
                <?php if (isset($_POST["msg"]) && $_POST["msg"] != "" ) { ?>
              <tr>
                <th colspan="6"><span style="color:#F00" class="style2"><?php echo $_POST["msg"]; ?></span></th>
              </tr>
			  <?php } ?>
                <tr>
                  <td colspan="6" align="center" height="30">&nbsp;</td>
                </tr>
		<?php echo $_POST['vat']; ?>
			  <tr>
                  <td width="1%" height="22">&nbsp;</td>
                  <td width="14%" class="verdanablack">Order Type: </td>
                  <td colspan="3" align="left">
           
<select name='ordertype' id='ordertype' class="selectinput"  onchange="tabelshow(this.value)" <?php if($_POST['ordertype']!=""){ ?> disabled="disabled"<?php }?> >
<option value=''>-Select-</option>
<option <?php if($_POST['ordertype']== dine) echo 'selected="selected"';  ?> value='dine'>Dine</option>
<option <?php if($_POST['ordertype']== parcel) echo 'selected="selected"'; ?> value='parcel'>Take Out</option>		
</select>			
			
			    </td>
                
                </tr>		
                <!-- THIS ROW WILL ONLY EXIST ON EDIT OF AN EXISTING BILL -->

<?php  if($_POST['ordertype']== dine){  ?>   
<tr id="showtabel" >
<td width="1%" height="22">&nbsp;</td>
<td width="14%" class="verdanablack">Table Number: </td>
<td colspan="3" align="left">
<select name='tableid' id='tableid' class="selectinput" <?php if($_POST['tableid']!=""){ ?> disabled="disabled"<?php }?> >
<option value=''>-Select-</option>
<?php  while ($roomTreeresultSet = db_fetch_array($tabletree)) {	?>
<option value='<?php echo $roomTreeresultSet['table_entry_id']; ?>' <?php if($_POST['tableid'] == $roomTreeresultSet['table_entry_id']) { ?> selected="selected" <?php } ?> > 
<?php echo $roomTreeresultSet['table_no']; ?></option>
<?php } ?>
</select>			
</td> 
</tr>	
<?php } ?>
<tr id="showtabel" style="display:none;">
<td width="1%" height="22">&nbsp;</td>
<td width="14%" class="verdanablack">Table Number: </td>
<td colspan="3" align="left">
<select name='tableid' id='tableid' class="selectinput" >
<option value=''>-Select-</option>
<?php  while ($roomTreeresultSet = db_fetch_array($tabletree)) {	
if($_POST['tableid'] == $roomTreeresultSet['table_entry_id']) $sel = "selected";
else $sel = "";?>
<option value='<?php echo $roomTreeresultSet['table_entry_id']; ?>' <?php echo $sel;?>> 
<?php echo $roomTreeresultSet['table_no']; ?></option>
<?php } ?>
</select>			
</td> 
</tr>	
	
<tr>  </tr>
                <tr>
                  <td height="22">&nbsp;</td>
                  <td class="verdanablack">Categories Name: </td>
                  <td width="12%">
			
<select name='MenuCardid' id='MenuCardid' class="selectinput" onChange="showState(this);">
<option value=''>-Select-</option>
<?php  
$menuEntry_fetch_singrec_sql1 = "SELECT `hms_menu_category_id`,`hms_menu_category_name`,`active`,`date_added`,`date_modified` FROM ".TABLE_HMS_MENU_CATEGORY." WHERE `active` = 'Y'";
$menuEntry_sing_records1 = db_query($menuEntry_fetch_singrec_sql1);
while($allMenuType1 = db_fetch_array($menuEntry_sing_records1))					
 {					
?>
<option value="<?php echo $allMenuType1["hms_menu_category_id"]; ?>"><?php  echo $allMenuType1["hms_menu_category_name"]; ?></option>
<?php } ?>
</select>
</td>
										 
<td width="10%" class="verdanablack">Sub_category</td>
<td width="22%"> 			  
<div id="output1">	
</div> 
</td>
 <td width="41%"></div>                                                  
 </tr>
<tr>
<td height="20"></td>
<td class="verdanablack" valign="top" style="padding-top:37px;">Item Name:</td>
<td colspan="4">
<div class="form">
			<img src="images/301.GIF" id="loader" />
			<input id="search-box" placeholder="search"  class="search" type="text" autocomplete="off"/>
		
            <ul id="search_suggestion_holder" >
			</ul>
        
		</div>

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
           <?php
		    $select_cart_id =db_query("SELECT * FROM ". TABLE_HMS_RESTAURANT_ORDER_DETAILS." WHERE status='open' AND itemcancel=0");
        $count = mysql_num_rows($select_cart_id); 
if($count>0){
 ?>
          
 <!-- new -->    
<tr>
<td width="100%" height="35" align="center" valign="middle" bgcolor="#D7DBB0" class="verdanabold"><span >RESTAURANT ORDER ITEM LIST 
</span></td>
</tr>
     
<tr>
 <? 
 while ($hms_info_bill = db_fetch_array($hms_info_value)) {
 		
$hms_info_fetch_table_sql = "SELECT `table_entry_id`,`table_type_id`,`table_no`,`numbers_of_chairs`,`active`,`date_added`,`date_modified` FROM      ".TABLE_HMS_TABLE_ENTRY." WHERE table_entry_id = ".$hms_info_bill["table_entry_id"]." ";
           
   $table_records = db_query ($hms_info_fetch_table_sql);
   $table  = db_fetch_array($table_records);
	  
   $tabel=$table["table_no"]; 
   $bill=$hms_info_bill['bill_id'];
   $cardid=$hms_info_bill['order_cart_id'];
   $tabelid=$hms_info_bill['table_entry_id'];
 }
		  ?>
<td colspan="6" align="left" height="30">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
BILL NO:<?php echo $bill; ?>	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php echo date("dS  M  Y h:i A"); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
Table NO:<?php echo $tabel; ?>			
</td>

</tr>
<tr>
<td colspan="6" align="center" height="30">
<div id="itemreplace"></div>
<div id="items"  style="border:solid #666; ">
<table border="0" width="91%" height="35" align="center">
<tr>
<th width="7%">S.no</th>

<th width="28%">Item</th>
<th width="21%">Quantity</th>
<th width="12%">price Per/U</th>
<th width="20%">Total</th>
</tr>
 <?php 
 $hms_info_counter = 1;
 $q=1;
  
 while ($hms_info_values = db_fetch_array($hms_info_sql)) {
	
?>
<tr>
<td class="verdanablack" style="text-align:center">
        <input type="checkbox" class="noneborder" name="checkbox[]" id="checkbox[]" value="<? echo $hms_info_values["order_id"]; ?>" />

          <? echo $hms_info_counter; ?></td>
<!-- <td class="verdanablack" style="text-align:center"> -->
          <? 
		  //$hms_info_fetch_table_sql = "SELECT `table_entry_id`,`table_type_id`,`table_no`,`numbers_of_chairs`,`active`,`date_added`,`date_modified` FROM " . TABLE_HMS_TABLE_ENTRY . " WHERE table_entry_id = ".$hms_info_values["table_entry_id"]." ";
           // $table_records = db_query ($hms_info_fetch_table_sql);
			//$table  = db_fetch_array($table_records);
		  
		 // $tabel=$table["table_no"]; 
		  //echo $table["table_no"]; 
		  ?>
		  <!-- </td> -->
          <td class="verdanablack" style="text-align:center">
          <? echo $hms_info_values["order_product"]; ?></td>
<td class="verdanablack" style="text-align:center">

 <input type="text"  name="quantity" id="quantity<? echo $q; ?>" style="width:50px;" value="<? echo $hms_info_values["order_quantity"]; ?>" 
       onkeyup="orderquantity('<?php echo $hms_info_values["order_id"]; ?>',this.value);" />
 </td>
 <td class="verdanablack" style="text-align:center">
  <?
 echo $hms_info_values["order_price"]; ?>   </td>
<td class="verdanablack" style="text-align:center">
  <?
  $price=$hms_info_values["order_price"]*$hms_info_values["order_quantity"];
         ?> 
  <input type="text" name="<?php echo $hms_info_values["order_id"]; ?>" style="width:80px;"  id="<?php echo $hms_info_values["order_id"]; ?>" 
  value="<?php echo $price;  ?>"/>      
  </td>
 <?php 
          $hms_info_counter++;
		  $q++;
        }
    ?>
    </tr>
     <tr>
     <td class="verdanablack"  colspan="6"  style="text-align: right; font-size: 12px; padding-right: 32px; padding-top: 20px;" >
  Total-Amount: 
   <?php    
   $menuRecords = db_query("SELECT sum(order_total_price) as netamount FROM ".TABLE_HMS_RESTAURANT_ORDER_DETAILS." WHERE `status` = 'open' AND itemcancel='0'  ");
   $price_values=db_fetch_array($menuRecords);  
   echo $price_values['netamount'];
	 ?>
    <input type="hidden" name="total" id="total" value="<?php  echo $price_values['netamount']; ?>"/>  
	 </td>
     
      </tr>
    <tr>
  
     <td class="verdanablack" style="text-align:right; margin-left:50px;">
 <input name="delete" type="submit" id="delete" value="Delete"  onclick="removeitems()"/>  
  
 </td>
 
    </tr>
     <tr>
  <td class="verdanablack" style="text-align:right; margin-left:50px;" colspan="2"></td> 
   
  <td class="verdanablack" style="text-align:right; margin-left:50px;">
  <?php /*?> <select name="tax" id="tax" onchange="gettax(this.value);">
   <option>---select tax---</option>
  <?php
  $sql_tax=db_query("SELECT * FROM ".TABLE_HMS_TAX_SCHEME."");
  while($row_tax=db_fetch_array($sql_tax)){
  ?>
 <option value="<?php echo $row_tax['tax_scheme_id']; ?>"><?php echo $row_tax['tax_scheme_name']; ?></option>
  <?php } ?>
    <input type="hidden" name="total_tax" id="total_tax" />   
  </select><?php */?>
  </td> 
  
<td colspan="2" class="verdanablack" style="text-align:right; margin-left:50px;">
<div id="tax_values" >

<table  cellpadding="2" cellspacing="2" align="right"> 
<tr style="width:55px;" align="right">
<td height="18" width="150" style="font-family:Georgia, 'Times New Roman', Times, serif; font-size:14px;">VAT:<input type="text" name="vat" id="vat"  value="<?php echo $_POST['vat']; ?>" onkeyup="Gettax()"  style="width:40px;"/>% &nbsp;&nbsp;&nbsp;<div style="float:right; width:10px;" id="vat_amt"></div></td>
</tr>

<tr style="width:55px;" align="right">
<td height="18" width="40" style="font-family:Georgia, 'Times New Roman', Times, serif; font-size:14px;">SERVICE:<input type="text" name="service" id="service"  value="<?php echo $_POST['service']; ?>" onkeyup="Gettax()" style="width:40px;"/>%&nbsp;&nbsp;&nbsp;<div style="float:right; width:10px;" id="ser_smt"></div></td>
</tr>

<tr style="width:55px;" align="right">
<td height="18" width="40" style="font-family:Georgia, 'Times New Roman', Times, serif; font-size:14px;">SALES:<input type="text" name="sales" id="sales" value="<?php echo $_POST['sales']; ?>" onkeyup="Gettax()" style="width:40px;"/>%&nbsp;&nbsp;&nbsp;<div style="float:right; width:10px;" id="sales_smt"></div></td>

</tr>
</table>

</p>
<p><input type="hidden" name="totaltax" id="totaltax" /></p> 
</div>  
</td>
   </tr>
    <tr>
     <td class="verdanablack"  colspan="6"  style="text-align:right;"> 
 <div id="netamount" style="font-size: 16px;">NET-AMOUNT: 
   <?php   
   $menuRecords = db_query("SELECT sum(order_total_price) as netamount FROM ".TABLE_HMS_RESTAURANT_ORDER_DETAILS." WHERE `status` = 'open' AND itemcancel='0'  ");
   $price_values=db_fetch_array($menuRecords);  
   echo $price_values['netamount'];
	 ?> </div>
	 </td>
     
      </tr>
   
    <tr>
     <td class="verdanablack" style="text-align:center; margin-left:60px;" colspan="6">
  
 <input name="print" type="submit" id="print" value="print" 
 onclick="print('<? echo $tabelid; ?>','<?php echo $cardid; ?>')" 
 style="background-color:#063; font-family:Arial, Helvetica, sans-serif; color:#FFF;" />
  
  
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input name="print" type="submit" id="print" value="Carry to bill" onclick="carrytobill()" style="background-color:#063; font-family:Arial, Helvetica, sans-serif; color:#FFF;" />

<div id="carry">
<select name="rooms" id="rooms" onchange="getcustomername(this.value)" >
<option>-Rooms-</option>
<?php
$rooms=db_query("SELECT * FROM ".TABLE_HMS_BOOKING_STATUS." WHERE status='C'"); 
while($rooms_no=db_fetch_array($rooms)){
?>
<option value="<?php echo $rooms_no['rooms_no']; ?>"><?php echo $rooms_no['rooms_no']; ?></option> 
<?php }  ?>
</select>

<input type="text" name="cus_name" id="cus_name"/>

<input name="print" type="submit" id="print" value="Bill" onclick="RoomBill('<? echo $tabelid; ?>','<?php echo $cardid; ?>')" style="background-color:#063; font-family:Arial, Helvetica, sans-serif; color:#FFF;" />

</div>
</td>
</tr>
</table> </div> 
</td>
</tr>          
      <?php  } else{ ?>     
<tr>
<td width="100%" height="35" align="center" valign="middle" bgcolor="#D7DBB0" class="verdanabold"><span >NO ITEMS FOUND 
</span></td>
</tr> <?php } ?>
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
</table>