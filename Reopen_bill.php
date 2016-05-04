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
case "bill_cancel":
    $deleterow = $hms_info_obj->getCancelBill($_POST['cart_id'],$_POST['table_id'],$cancelcomments,$accountsession); 
    break;

case "close_cancel":
    $closerow = $hms_info_obj->getCloseBill($_POST['cart_id'],$_POST['table_id']); 
    break;

	}   
 //echo $_POST['bill'];
$order_cart_id=$_POST['order_cart_id'];  
//echo $order_cart_id;
$id=$_POST['tableid'];
//echo $id;
$order_type=$_POST['ordertype']; 
//echo $order_type;

$hms_info_sql  = $hms_info_obj->menuEntryAllRecords($id,$order_type);

$hms_info_value  = $hms_info_obj->menudetailAllRecords($id,$order_type);

$tabletree  = $hms_info_obj->getTableTree();

$ordertabletree  = $hms_info_obj->getorderTableTree();


function display(){
	//echo '<script>alert("Enter");</script>';
}
?>

<script type="text/javascript" src="js/jquery-1.8.0.min.js"></script>

<script type="text/javascript">


//$(document).ready(function(){
//	
//		 $("#search-box").focus();
//});

$(document).ready(function(){
var timer = null;
$('#search-box').keyup(function(e){

if( e.keyCode ==38 ){
        if( $('#search_suggestion_holder').is(':visible') ){
                if( ! $('.selected').is(':visible') ){
                        $('#search_suggestion_holder li').last().addClass('selected');
                        var value	=	$('.selected').text();
                           //$('#search-box').val(value);
                }else{
                        var i =  $('#search_suggestion_holder li').index($('#search_suggestion_holder li.selected')) ;
                        $('#search_suggestion_holder li.selected').removeClass('selected');
                        var value	=	$('.selected').text();
                      //  $('#search-box').val(value);
                        i--;
                        $('#search_suggestion_holder li:eq('+i+')').addClass('selected');
                        var value	=	$('.selected').text();
                        // $('#search-box').val(value);
                }
        }
}else if(e.keyCode ==40){
        if( $('#search_suggestion_holder').is(':visible') ){
                if( ! $('.selected').is(':visible') ){
                        $('#search_suggestion_holder li').first().addClass('selected');
                        var value	=	$('.selected').text();
                                    // $('#search-box').val(value);
                }else{
                        var i =  $('#search_suggestion_holder li').index($('#search_suggestion_holder li.selected')) ;
                        $('#search_suggestion_holder li.selected').removeClass('selected');
                                        var value	=	$('.selected').text();
                                      // $('#search-box').val(value);			
                        i++;
                        $('#search_suggestion_holder li:eq('+i+')').addClass('selected');
                        var value	=	$('.selected').text();
                        //$('#search-box').val(value);
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
			   itemfocus();
      }
 });
      
      
$('#search-box').val(value);
$('#search_suggestion_holder').hide();
$('#search-box').focus();
}
}else{
var keyword = $(this).val();

//var menu = $('#MenuCardid').val();
//var sub_menu = $('#sub_category').val();
//alert(menu);
//alert(sub_menu);
var accountsession = $('input[name="accountsession"]:checked').val();	
var category = $('.getcategory:checked').map(function() {return this.value;}).get().join(',');
$('#loader').show();
setTimeout( function(){
$.ajax({
        url:'get_suggestions.php',
        data:'keyword='+keyword+"&category="+category+"&accountsession="+accountsession,
        success:function(data){
                $('#search_suggestion_holder').html(data);
                $('#search_suggestion_holder').show();
                $('#loader').hide();
				 itemfocus();
        }
});
},400);
}
});
				
				$('#search_suggestion_holder').on('click','li',function(){
					var value	=	$(this).text();
					//$('#search-box').val(value);
					$('#search_suggestion_holder').hide();
                    itemfocus();
					//$('#search-box').focus();
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
							//$('#search-box').val(value);
							$('#search_suggestion_holder').hide();
							$('#search-box').focus();
						}
					}else{
						var keyword		=		$(this).val();
						$('#loader').show();
							//var menu = $('#MenuCardid').val();
						//var sub_menu = $('#sub_category').val();
						
//alert(menu);
//alert(sub_menu);	
						setTimeout( function(){
													
							$.ajax({
								url:'get_data.php',
                                                    data:'keyword='+keyword,
								success:function(data){
									$('#search_suggestion_holder').html(data);
									$('#search_suggestion_holder').show();
									$('#loader').hide();
									$('#search-box').focus();
                                    itemfocus();
                                                                        
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
			   itemfocus();
			   
      }
      });
					//$('#search-box').val(value);
                    $('#search_suggestion_holder').hide();
                    $('#search-box').focus();
    itemfocus();
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
    
    
    
function get_amount_value(amt) { 
   //alert(amt);
   
   if(document.getElementById('cash_pay_amount').value)
   {
     //alert(document.getElementById('cash_pay_amount').value); 
   var cash_amount=document.getElementById('cash_pay_amount').value;
    }
    else if(document.getElementById('cash_pay_amount').value=="") { 
      
            var cash_amount="0"; }

   
   if(document.getElementById('card_pay_amount').value)
   {
       //alert("enter");
   var card_amount=document.getElementById('card_pay_amount').value;
    }
    else { var card_amount="0"; }
    
    
       if(document.getElementById('cheque_pay_amount').value)
   {
       //alert("enter");
   var cheque_amount=document.getElementById('cheque_pay_amount').value;
    }
    else { var cheque_amount="0"; }
    
     if(document.getElementById('online_pay_amount').value)
   {
       //alert("enter");
   var online_amount=document.getElementById('online_pay_amount').value;
    }
    else { var online_amount="0"; } 

 
 //alert(pay_amount);
 var return_amount =((document.getElementById('balance_amt').value)-cash_amount-card_amount-cheque_amount-online_amount);
//alert(document.getElementById('netamount_v').value);
//alert(return_amount);
 
var return_amt = document.getElementById('return_amount').value=return_amount;
//alert(return_amt);

}


	
function tabelshow(order){
//alert(order);	
/* if(order!=''){
	//alert(order);
	document.getElementById('showsearch').style.display = 'table-row';
	//document.getElementsByTagName('tableid').value = 1;
} */
if(order == 'dine'){
       // alert(order);
	// document.getElementById("tableid").innerHTML = "";
	document.getElementById('showtabel').style.display = 'table-row';
	document.getElementById('bill_row').style.display = 'none';
	//document.getElementsByTagName('tableid').value = 1;
}
if(order == 'parcel'){
	//alert(order);
  // document.getElementById("tableid").options.length=0;
	document.getElementById('showtabel').style.display = 'none';
	document.getElementById('bill_row').style.display = 'none';
	//document.getElementById("tableid").options.length = 0;
	$('#tableid').val('');
}
}	


function show_full()
{

if(document.getElementById('full').checked==true && document.getElementById('partial').checked==true)
{
document.getElementById("partial").checked = false;
document.getElementById('partial_customer').style.display = 'none';


}    

if(document.getElementById('full').checked==false && document.getElementById('partial').checked==false)
{
document.getElementById("partial").checked = true;
document.getElementById('partial_customer').style.display = '';
}    

}

function show_partial()
{
if(document.getElementById('full').checked==true && document.getElementById('partial').checked==true)
{
document.getElementById("full").checked = false;
document.getElementById('partial_customer').style.display = '';
}    

if(document.getElementById('full').checked==false && document.getElementById('partial').checked==false)
{
document.getElementById("full").checked = true;
document.getElementById('partial_customer').style.display = 'none';


}   
}


function show_cash(){
   
if(document.getElementById('cash').checked==true && document.getElementById('card').checked==true && document.getElementById('cheque').checked==true )
{
alert("Your Select more than two mode");
document.getElementById("cash").checked = false;
return false;
}
if(document.getElementById('cash').checked==true && document.getElementById('card').checked==true && document.getElementById('online').checked==true )
{
alert("Your Select more than two mode");
document.getElementById("cash").checked = false;
return false;
}
if(document.getElementById('cash').checked==true && document.getElementById('cheque').checked==true && document.getElementById('online').checked==true )
{
alert("Your Select more than two mode");
document.getElementById("cash").checked = false;
return false;
}
if(document.getElementById('card').checked==true && document.getElementById('cheque').checked==true && document.getElementById('online').checked==true )
{
alert("Your Select more than two mode");
document.getElementById("cash").checked = false;
return false;
}
 
  if(document.getElementById('cash').checked==false)
    {
      	document.getElementById('customer_details').style.display = 'none';
	/*document.getElementById('card_details').style.display = 'none';
        document.getElementById('cheque_details').style.display = 'none';
        document.getElementById('online_payment').style.display = 'none';
        
        document.getElementById('card').checked=false;
        document.getElementById('cheque').checked=false;
         document.getElementById('online').checked=false; */  
}
else {
     	document.getElementById('customer_details').style.display = '';
        document.getElementById('cash_pay_amount').value='';
        document.getElementById('return_amount').value='';
	/*document.getElementById('card_details').style.display = 'none';
        document.getElementById('cheque_details').style.display = 'none';
        document.getElementById('online_payment').style.display = 'none';
        
        document.getElementById('card').checked=false;
        document.getElementById('cheque').checked=false;
         document.getElementById('online').checked=false;   */
        }
}

function show_card(){
    
if(document.getElementById('cash').checked==true && document.getElementById('card').checked==true && document.getElementById('cheque').checked==true )
{
alert("Your Select more than two mode");
document.getElementById("card").checked = false;
return false;
}

if(document.getElementById('cash').checked==true && document.getElementById('card').checked==true && document.getElementById('online').checked==true )
{
alert("Your Select more than two mode");
document.getElementById("card").checked = false;
return false;
}


if(document.getElementById('cash').checked==true && document.getElementById('cheque').checked==true && document.getElementById('online').checked==true )
{
alert("Your Select more than two mode");
document.getElementById("card").checked = false;
return false;
}


if(document.getElementById('card').checked==true && document.getElementById('cheque').checked==true && document.getElementById('online').checked==true )
{
alert("Your Select more than two mode");
document.getElementById("card").checked = false;
return false;
}
 if(document.getElementById('card').checked==true)
    {

	/*document.getElementById('customer_details').style.display = 'none';*/
	document.getElementById('card_details').style.display = 'inherit';
       /* document.getElementById('cheque_details').style.display = 'none';
        document.getElementById('online_payment').style.display = 'none';
        
         document.getElementById('cash').checked=false;
         document.getElementById('cheque').checked=false;
         document.getElementById('online').checked=false;*/
        
}
else {
            document.getElementById('card_pay_amount').value='';
            document.getElementById('card_no').value='';
            document.getElementById('card_name').value='';
            document.getElementById('exp_date').value='';
           document.getElementById('return_amount').value='';
    
	/*document.getElementById('customer_details').style.display = 'none';*/
	document.getElementById('card_details').style.display = 'none';
       /* document.getElementById('cheque_details').style.display = 'none';
        document.getElementById('online_payment').style.display = 'none';
        
         document.getElementById('cash').checked=false;
         document.getElementById('cheque').checked=false;
         document.getElementById('online').checked=false;*/
        }
}

function show_cheque(){
    
if(document.getElementById('cash').checked==true && document.getElementById('card').checked==true && document.getElementById('cheque').checked==true )
{
alert("Your Select more than two mode");
document.getElementById("cheque").checked = false;
return false;
}

if(document.getElementById('cash').checked==true && document.getElementById('card').checked==true && document.getElementById('online').checked==true )
{
alert("Your Select more than two mode");
document.getElementById("cheque").checked = false;
return false;
}


if(document.getElementById('cash').checked==true && document.getElementById('cheque').checked==true && document.getElementById('online').checked==true )
{
alert("Your Select more than two mode");
document.getElementById("cheque").checked = false;
return false;
}


if(document.getElementById('card').checked==true && document.getElementById('cheque').checked==true && document.getElementById('online').checked==true )
{
alert("Your Select more than two mode");
document.getElementById("cheque").checked = false;
return false;
}
 if(document.getElementById('cheque').checked==true)
    {

	/*document.getElementById('customer_details').style.display = 'none';
	document.getElementById('card_details').style.display = 'none';*/
        document.getElementById('cheque_details').style.display = 'inherit';
      /*  document.getElementById('online_payment').style.display = 'none';
        
         document.getElementById('cash').checked=false;
         document.getElementById('card').checked=false;
         document.getElementById('online').checked=false;*/
       
}
else { 
    
          document.getElementById('cheque_pay_amount').value='';
            document.getElementById('cheque_no').value='';
            document.getElementById('ceq_name').value='';
            document.getElementById('ceq_date').value='';
            document.getElementById('return_amount').value='';
	/*document.getElementById('customer_details').style.display = 'none';
	document.getElementById('card_details').style.display = 'none';*/
        document.getElementById('cheque_details').style.display = 'none';
       /* document.getElementById('online_payment').style.display = 'none';
        
         document.getElementById('cash').checked=false;
         document.getElementById('card').checked=false;
         document.getElementById('online').checked=false;*/
}
}

function show_online_payment(){
if(document.getElementById('cash').checked==true && document.getElementById('card').checked==true && document.getElementById('cheque').checked==true )
{
alert("Your Select more than two mode");
document.getElementById("online").checked = false;
return false;
}

if(document.getElementById('cash').checked==true && document.getElementById('card').checked==true && document.getElementById('online').checked==true )
{
 alert("Your Select more than two mode");
 document.getElementById("online").checked = false;
return false;
}

if(document.getElementById('cash').checked==true && document.getElementById('cheque').checked==true && document.getElementById('online').checked==true )
{
alert("Your Select more than two mode");
document.getElementById("online").checked = false;
return false;
}

if(document.getElementById('card').checked==true && document.getElementById('cheque').checked==true && document.getElementById('online').checked==true )
{
alert("Your Select more than two mode");
document.getElementById("online").checked = false;
return false;
}
    
if(document.getElementById('online').checked==true)
    {
    
	/*document.getElementById('customer_details').style.display = 'none';
	document.getElementById('card_details').style.display = 'none';
        document.getElementById('cheque_details').style.display = 'none';*/
        document.getElementById('online_payment').style.display = 'inherit';
        
      /*  document.getElementById('cash').checked=false;
        document.getElementById('card').checked=false;
        document.getElementById('cheque').checked=false;*/
}

else {
    
            document.getElementById('online_pay_amount').value='';
            document.getElementById('on_card_no').value='';
            document.getElementById('on_card_name').value='';
            document.getElementById('on_exp_date').value='';
              document.getElementById('transactions_id').value='';
             document.getElementById('return_amount').value='';
       /*	document.getElementById('customer_details').style.display = 'none';
	document.getElementById('card_details').style.display = 'none';
        document.getElementById('cheque_details').style.display = 'none';*/
       document.getElementById('online_payment').style.display = 'none';
        
      /*   document.getElementById('cash').checked=false;
        document.getElementById('card').checked=false;
        document.getElementById('cheque').checked=false; */
        
        }
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

<script>
    
    function show_bill_list() {
        
        document.getElementById('show_list_bill').style.display="";
    }
    
    </script>

<script type="text/javascript" language="JavaScript">

function Get_tax() {
 if (document.getElementById('tax_box').checked == true) 
	{
 // alert("true");
        $("#tax_div").hide();
        $("#tax_div1").show();
        Gettax();                   
	}
	else
	{           
		$("#tax_div1").hide();
		$("#tax_div").show();
        Gettax1();
	}   
}

</script>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

    <script>
        
function show_list_bill()
{
   // alert("enter");
$(document).ready(function(){
    $("#show_list_bill").click(function(){
        $("#save_bill_content").slideToggle("slow");
    });
});
 
}

</script> 

<style type="text/css">
	

div #carry{
    display: none;
}
	
</style>



<?php
//$tax_method=$_POST['tax'];
$bill_id=$_GET['bill_id'];
//echo $bill_id;
$bill_status=$_GET['status'];
//echo $bill_status;

 $pending_list_sqls= db_query("SELECT *  FROM " . TABLE_HMS_RESTAURANT_ACCOUNT_DETAILS. " where bill_status='$bill_status' AND bill_id='$bill_id'"); 
 $count_list = db_fetch_array($pending_list_sqls);
if($count_list>0){ 

 $select_cart_id =db_query("SELECT * FROM ". TABLE_HMS_RESTAURANT_ORDER_DETAILS." WHERE itemcancel=0 AND bill_id='$bill_id'");

 ?>



<table id="bill_row" border="0" width="90%" align="center" valign="middle" > 

<tr>
<td width="100%" height="35" align="center" valign="middle" bgcolor="#D7DBB0" class="verdanabold"><span >RESTAURANT ORDER ITEM LIST </span></td>
</tr>
     
<tr>
 <?php
  $select_cart=db_query("SELECT * FROM ". TABLE_HMS_RESTAURANT_ORDER_DETAILS." WHERE itemcancel=0 AND bill_id='$bill_id'");
 if($hms_info_bill = db_fetch_array($select_cart)) 
{      

	  
   $tabel=$hms_info_bill["table_entry_id"]; 
   $bill=$hms_info_bill['bill_id'];
   $cardid=$hms_info_bill['order_cart_id'];
   $tabelid=$hms_info_bill['table_entry_id'];
   $order_type=$hms_info_bill['order_type'];  
 } 
 if(!empty($cardid))
{
$htd_info  = $hms_info_obj->gettabledetails($cardid);
$fetch = db_fetch_array($htd_info); 
$dbsuppliers = $fetch['htd_supplier_id'];
$dbnoofpersons = $fetch['htd_noofpersons'];
}
 ?>
 <td colspan="6" align="left" height="30">
        <table cellpaddin="0" cellspacing="0" border="0">
            <tr>
                <td><?php if(!empty($tabel) && $tabel!=0) echo 'Supplier : '.getsuppliername($dbsuppliers) ;?></td>
                <td><?php echo date("dS  M  Y h:i A"); ?></td>
                <td>Bill No.:<?php echo $bill; ?></td>
                <td><?php if(!empty($tabel) && $tabel!=0){ ?>
                Table NO:<?php echo $tabel  ?>			
                <?php } ?></td>
            </tr>
        </table>
    </td>    
</tr>
<tr>
<td colspan="6" align="center" height="30">
<div id="itemreplace"></div>
<div id="items"  style="border:solid 2px #666; ">
    
<table border="0" width="100%" height="35" align="center">
<tr>
<th width="1%" height="40">S.no</br></th>
<th width="16%">Item</th>
<th width="16%">Category</th>
<th width="10%">Rate</th>
<th width="5%">Qty</th>
<th width="10%">Amt</th>
<th width="14%">Total</th>
</tr>

 <?php 
 $hms_info_counter = 1;
 $q=1;  
 while ($hms_info_values = db_fetch_array($select_cart_id)) { 
?>

<tr>
<td class="verdanablack" style="text-align:center">
        <input type="hidden" class="noneborder" name="order_cart_id" id="order_cart_id" value="<?php echo $hms_info_values["order_cart_id"]; ?>" />
    <!--    <input type="checkbox" class="noneborder" name="checkbox[]" id="checkbox[]" value="<?php //echo $hms_info_values["order_id"]; ?>" />-->
          <?php echo $hms_info_counter; ?>
</td>
          <td class="verdanablack" style="text-align:center">  
              
  <?php  echo $hms_info_values["order_product"];  ?>             
          
          </td>
          
          
 <td class="verdanablack" style="text-align:center">             
          <?php
            $hms_info_fetch_table_sql = "SELECT `menu_category_id` FROM " . TABLE_HMS_MENUENTRY . " WHERE menu_id = ".$hms_info_values["menuid"]." ";
        // echo $hms_info_fetch_table_sql;
            $table_records = db_query ($hms_info_fetch_table_sql);
            $table  = db_fetch_array($table_records);		  
               
           // echo $table["menu_category_id"];   
            
            $hms_info_fetch_table_menu = "SELECT `hms_menu_category_name` FROM " . TABLE_HMS_MENU_CATEGORY . " WHERE hms_menu_category_id = ".$table["menu_category_id"]." ";
            $menu_records = db_query ($hms_info_fetch_table_menu);
           $menu_categ = db_fetch_array($menu_records);                
		echo $menu_categ["hms_menu_category_name"];                 
            ?>     
</td> 
          
         <td class="verdanablack" style="text-align:center">
             
  <?php echo $hms_info_values["order_price"]; ?> 
         
         </td>  
        
        
<td class="verdanablack" style="text-align:center">
    <input type="text"  name="quantity" id="quantity_<?php echo $hms_info_values["order_id"]; ?>" readonly="readonly" style="width:20px;" autofocus  onfocus="var temp_value=this.value;this.value='';this.value=temp_value"  value="<? echo $hms_info_values["order_quantity"]; ?>" 
       onkeyup="orderquantity('<?php echo $hms_info_values["order_id"]; ?>',this.value);" /> 
 </td>
 
 
 <td class="verdanablack" style="text-align:center">
     
  <?php
  $price=$hms_info_values["order_price"]*$hms_info_values["order_quantity"];  
   ?> 
     <input type="text" name="order_amount"  style="width:40px;" readonly="readonly" id="order_amount"  readonly="readonly" value="<?php echo $price;  ?>"/>         
  </td>
 
  <?php
            $hms_info_fetch_table_sql = "SELECT `menu_category_id` FROM " . TABLE_HMS_MENUENTRY . " WHERE menu_id = ".$hms_info_values["menuid"]." ";
        // echo $hms_info_fetch_table_sql;
            $table_records = db_query ($hms_info_fetch_table_sql);
            $table  = db_fetch_array($table_records);		  
               
           // echo $table["menu_category_id"];   
            
            $hms_info_fetch_table_menu = "SELECT `vat_tax`,`service_tax` FROM " . TABLE_HMS_MENU_CATEGORY . " WHERE hms_menu_category_id = ".$table["menu_category_id"]." ";
            $menu_records = db_query ($hms_info_fetch_table_menu);
            $menu_categ = db_fetch_array($menu_records);    
            
	    $vat_tax=$menu_categ["vat_tax"];  
            $service_tax=$menu_categ["service_tax"];  
        

   
 ?>
  
    
        
<?php
 if($vat_tax =="0" || $vat_tax =="") 
 {
  $v_tax=0;
  echo $v_tax;
 }
 
 else
     {      
  //echo "$vat_tax";
     $price=$hms_info_values["order_price"]*$hms_info_values["order_quantity"]; 
  $v_tax=$price*($vat_tax/100.0);    
 }
 ?>  
        <input type="hidden" name="vat_Tax" id="vat_Tax" value="<?php echo $v_tax; ?>" >  
    

      
       
 <?php
 if($service_tax =="0" || $service_tax =="") 
 {
  $s_tax=0;
 
 }
 
 else
     {      
   $price=$hms_info_values["order_price"]*$hms_info_values["order_quantity"]; 
  $s_tax=$price*($service_tax/100.0);    
 }
 ?>  
            <input type="hidden" name="ser_Tax" id="ser_Tax" value="<?php echo $s_tax; ?>" >  
            
   
  
 

<td class="verdanablack" style="text-align:center">
  <?php
  $price=$hms_info_values["order_price"]*$hms_info_values["order_quantity"];  
         
   //$incl_tax=$price*($s_tax)+($v_tax); 
           
         $net_total_price= $price+$s_tax+$v_tax;
	
  ?> 
         <input type="text" name="<?php echo $hms_info_values["order_id"]; ?>"  style="width:80px;"  id="<?php echo $hms_info_values["order_id"]; ?>" 
  readonly="readonly" value="<?php echo $net_total_price;  ?>"/>      
  </td>
 <?php 
          $hms_info_counter++;
		  $q++;
        }
    ?>
    </tr> 
    
    <tr>
  
     <td class="verdanablack" style="text-align:right; margin-left:50px;">
 <!--<input name="delete" type="submit" id="delete" value="Remove Item"  onclick="removeitems()"/>  -->
  
 </td>
 
    </tr>

    <tr>
     <td class="verdanablack"  colspan="12"  align='right' style="padding-right: 50px;"> 
 <div id="netamount" style="font-size: 14px; padding-right:30px; font-weight: bold;">TOTAL-AMOUNT: 
   <?php   
   $menuRecords = db_query("SELECT menuid, vat_amount,service_amount,order_amount FROM ".TABLE_HMS_RESTAURANT_ORDER_DETAILS." WHERE itemcancel=0 AND bill_id='$bill_id'");
    while($price_values=db_fetch_array($menuRecords))
   {
    $netamountt += ($price_values['vat_amount']+$price_values['service_amount']+$price_values['order_amount']);
   } echo roundoff($netamountt);?>
    
	 </div>
          <input type="hidden" name="netamount_v" id="netamount_v"  value="<?php  echo roundoff($netamountt); ?>"  style="width:40px;"> 
	 </td>     
      </tr>

    <?php  
       $pending_list_sqls= db_query("SELECT *  FROM " . TABLE_HMS_RESTAURANT_ACCOUNT_DETAILS. " where bill_id='$bill_id'"); 
 $count_list = db_fetch_array($pending_list_sqls);
$dicount=$count_list['disc'];

 $discount=roundoff($netamountt)*($count_list['discount']/100);  
 $totalamount=roundoff($netamountt)-$discount; 
 ?>

      <tr>
        <td class="verdanablack"  colspan="12"  style="text-align: right; font-size: 12px;  padding-right: 80px;" >
            <input type="hidden" name="disc" id="disc" value="<?php echo $count_list['discount']; ?>">            
            Discount(<?php echo $count_list['discount']; ?>%): <?php echo $discount; ?>  </td>
          </tr>     
      
        <tr>
            
    <tr>
     <td class="verdanablack"  colspan="12"  style="text-align: right; font-size: 15px; font-weight:bold; padding-right:80px; padding-top: 20px;" >
        Net-Amount:  <?php echo number_format((float)$totalamount, 2, '.', '');?>
         
       
	 </td>
     
      </tr>         
            
     <td class="verdanablack"  colspan="12"  align='left' style="padding-left:10px; padding-bottom: 10px;"> 
         PAYMENT TYPE: 
         <input type="checkbox" checked="checked" name="full" id="full" value="1" onclick="show_full()">  Full
        <input type="checkbox" name="partial" id="partial" value="1" onclick="show_partial(this.value)">  Partial      
	 </td>          
         
      </tr>   
      
 <?php  
 $pending_bill= db_query("SELECT name,mobile,address,paid_date,total_amount,paid_amount, sum(paid_amount) as p_amount  FROM ".TABLE_HMS_CREDIT_PAYMENT_DETAIL." where credit_bill_id='$bill_id'"); 
if($pending = db_fetch_array($pending_bill))
{    
 $t_paid_amount=$pending['p_amount'];   
 $pending_amount = $pending['total_amount']-$t_paid_amount; 
}

 $pending_bill_sqls= db_query("SELECT *  FROM ".TABLE_HMS_CREDIT_PAYMENT_DETAIL." where credit_bill_id='$bill_id' order by id ASC"); 
 while($pending_list = db_fetch_array($pending_bill_sqls))
 {
$date = explode('-',$pending_list["paid_date"]); 
$paid_amount=$pending_list['paid_amount'];
$customer_name=$pending_list['name']; 
$mobile=$pending_list['mobile']; 
$address=$pending_list['address']; 
    
 ?>  
      
    <tr>
    <td class="verdanablack"  colspan="12" align='right'style="text-align: right; font-size: 15px; font-weight:bold; padding-right:80px; padding-top: 10px;" >

      <?php echo $date[2] . "-" . $date[1] . "-" . $date[0]; ?>  Paid Amount :  <?php echo number_format((float)$paid_amount, 2, '.', ''); ?>
    </td>      
    </tr>
      
<?php  }  ?>
    
     <tr>            
    <td class="verdanablack"  colspan="12"  align='right' style="text-align: right; font-size: 15px; font-weight:bold; padding-right:80px; padding-top: 10px;" >
       Pending Amount :  <?php echo number_format((float)$pending_amount, 2, '.', ''); ?>
    <input type="hidden" name="balance_amt" id="balance_amt" value="<?php echo $pending_amount; ?> ">
    </td>      
    </tr>
      
      
      <tr> <td colspan="12" >
          <table border="0" width="100%" align="left"  cellpadding="10" cellspacing="10" id="partial_customer" style="display:none;">                          
    
                 <tr>
                       <td style="font-size: 12px; font-weight: bold;" class="verdanablack" align="left" colspan="4">Customer Name :  
                <input type="text" name="customer_name" id="customer_name" value="<?php echo $customer_name; ?>" >
                       </td>   
                 
                 <td style="font-size: 12px; font-weight: bold;" class="verdanablack" align="left"> Mobile Number : 
                     <input type="text" name="mobile" id="mobile" value="<?php echo $mobile; ?>" maxlength="15" > 
                 </td>
                 
                 <td style="font-size: 12px; font-weight: bold;" class="verdanablack" align="left" valign="top">
                &nbsp; &nbsp;  Address : 
                <textarea id="address" name="address"><?php echo $address; ?></textarea>
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
                     <input type="text" name="cash_pay_amount" id="cash_pay_amount"  onkeyup="get_amount_value(this.value);" value="<?php echo $pay_amout; ?>" > 
                 </td>
             </tr> 
            
           </table>
           
                     

                     
             <table border="0" width="100%"  align="left" cellpadding="10" cellspacing="10"  id="card_details" style="display:none;">                    
              <tr>
                  <td style="font-size: 12px; font-weight: bold;" align="right" colspan="3"> Card Pay Amount :  
                <input type="text" name="card_pay_amount" id="card_pay_amount"  onkeyup="get_amount_value(this.value);" value="<?php echo $pay_amout; ?>" >   </td>
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
                <tr >
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
                    &nbsp; &nbsp; &nbsp;  <input type="text" name="ceq_date" placeholder="ex: 01-01-2015" style="width: 100px;" id="ceq_date" value="<?php echo $ceq_date; ?>" > 
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
                     <input type="text" name="on_card_no" id="on_card_no" value="<?php echo $on_card_no; ?>" >  </td>
                 <td style="font-size: 12px; font-weight: bold;" align="left" width="500">
                 &nbsp;  &nbsp;  Name : 
                  <input type="text" name="on_card_name" id="on_card_name" value="<?php echo $on_card_name; ?>" > 
                 </td>
             </tr> 
             
               <tr>
                 <td style="font-size: 12px; font-weight: bold;" align="left" width="500"> Expire Date : 
                     &nbsp;  <input type="text" name="on_exp_date" id="on_exp_date" placeholder="ex: 01-01-2015" style="width: 100px;" value="<?php echo $on_exp_date; ?>" >  </td>
                
                 <td style="font-size: 12px; font-weight: bold;" align="left" width="500" colspan="2"> Transactions Id : 
                     &nbsp;  <input type="text" name="transactions_id" id="transactions_id" value="<?php echo $transactions_id; ?>" > 
                 </td>
             </tr> 
              </table>
         
         
         
    <tr>

        <td align="right" colspan="12" style="padding-right: 20px; font-size: 12px; font-weight: bold;"> Balance Amount :  <input type="text" name="return_amount" id="return_amount" value="<?php echo $return_amount; ?>" >   </td>
     </tr> 
         
            
   
    <tr>
     <td class="verdanablack" style="text-align:center; margin-left:60px;" colspan="12">
         </br>         </br>
          <input name="Save" type="submit" id="Save" value="Save & Print" onclick="Save_bill('<?php echo $tabelid; ?>','<?php echo $bill; ?>','<?php echo $cardid; ?>','<?php echo $order_type; ?>','','')" 
 style="background-color:#063; font-family:Arial, Helvetica, sans-serif; color:#FFF;" />
        
         
<!--<input name="print" type="submit" id="print" value="print"  onclick="print_bill('<?php echo $tabelid; ?>','<?php echo $cardid; ?>','<?php echo $bill; ?>')" 
 style="background-color:#063; font-family:Arial, Helvetica, sans-serif; color:#FFF;" />-->
  
  
  <!-- <input name="bill_cancel" type="submit" id="bill_cancel" value="Cancel Bill"  onclick="bill_cancel('bill_cancel','<?php echo $cardid; ?>','<?php echo $tabelid; ?>')" 
 style="background-color:#063; font-family:Arial, Helvetica, sans-serif; color:#FFF;" />-->
  
  
</td>
</tr>
</table>


    
</div> 

    <!-- <tr>
     <td class="verdanablack" style="text-align:left; margin-left:20px;" colspan="12">
        
         <input name="show_list_bill" type="button" id="show_list_bill" value="Show Bill List"  onclick="show_bill_list()" 
 style="background-color:#063; font-family:Arial, Helvetica, sans-serif; color:#FFF;" />
        </td>
    </tr> -->

</td>
</tr> 

   

<?php  } else{ ?>     
<tr>
<td width="100%" height="35" align="center" valign="middle" bgcolor="#D7DBB0" class="verdanabold"><span >NO BILLS FOUND 
</span></td>
</tr> <?php } ?>
<!--new end-->  

 </table>


<script>
function Save_bill(table_id,bill_id,cart_id,ordertype,accountsession)
{

var disc    = document.getElementById('disc').value;
if(disc==0 && disc=="")
{
var disc=0;
}

 var bill_s = document.getElementById('return_amount').value;
 //alert(bill_status)
 if(bill_s > 0)
 { 
var bill_status="Pending";
if(document.getElementById('partial').checked==false)
{
    alert("Please Pay Full Net Amount");
     return false; 
    
}

    }
    else {
     var bill_status="Paid";   
 }
  
 
 if(document.getElementById('partial').checked==true)
{
   
var customer_name = document.getElementById('customer_name').value;
if(customer_name =="")
{
 alert("Please Enter The Customer Name");   
 document.getElementById('customer_name').focus(); 
    return false; 
 }
 
    var mobile= document.getElementById('mobile').value;
    if(mobile=="")
    {
    alert("Please Enter The Mobile Number");
     document.getElementById('mobile').focus(); 
    return false; 
     }
    if(!mobile.match(/^\d+/))
        {
        alert("Please only enter numeric characters only for Mobile Number");
         document.getElementById('mobile').values=""; 
         document.getElementById('mobile').focus();      
          return false; 
        }
     
     
     
    var address= document.getElementById('address').value;
    if(address=="")
    {
   alert("Please Enter The Address");
     document.getElementById('address').focus(); 
    return false; 
     }  
     
     var pay_type="partial";
     
     var p_type='&pay_type='+pay_type+'&name='+customer_name+'&mobile='+mobile+'&address='+address;
    // alert(p_type);
     
 }


if(document.getElementById('full').checked==true)
{
var pay_type ="full";

 var p_type='&pay_type='+pay_type;
} 
 
 
if(document.getElementById('cash').checked==false && document.getElementById('card').checked==false && document.getElementById('cheque').checked==false && document.getElementById('online').checked==false)
{
 alert("Please Select The Mode Of Payment Method");
     return false;
}

if(document.getElementById('cash').checked==true && document.getElementById('card').checked==true && document.getElementById('cheque').checked==true )
{
 alert("Your Select more than two mode");
     return false;
}

if(document.getElementById('cash').checked==true && document.getElementById('card').checked==true && document.getElementById('online').checked==true )
{
 alert("Your Select more than two mode");
     return false;
}


if(document.getElementById('cash').checked==true && document.getElementById('cheque').checked==true && document.getElementById('online').checked==true )
{
 alert("Your Select more than two mode");
     return false;
}


if(document.getElementById('card').checked==true && document.getElementById('cheque').checked==true && document.getElementById('online').checked==true )
{
 alert("Your Select more than two mode");
     return false;
}


if(document.getElementById('cash').checked==true)
{
var cash_amount = document.getElementById('cash_pay_amount').value;
if(cash_amount =="")
{
 alert("Please Enter Cash Pay Amount Value");   
 document.getElementById('cash_pay_amount').focus(); 
    return false; 
 }
    if(!cash_amount.match(/^\d+/))
        {
        alert("Please only enter numeric characters only for Cash Pay Amount");
           document.getElementById('cash_pay_amount').values=""; 
         document.getElementById('cash_pay_amount').focus();      
          return false; 
        } 
}



if(document.getElementById('card').checked==true)
{   
    var card_amount = document.getElementById('card_pay_amount').value;
if(card_amount =="")
{
 alert("Please Enter Card Pay Amount Value");   
 document.getElementById('card_pay_amount').focus(); 
    return false; 
 }
     if(!card_amount.match(/^\d+/))
        {
        alert("Please only enter numeric characters only for Card Pay Amount");
        document.getElementById('card_pay_amount').values=""; 
         document.getElementById('card_pay_amount').focus(); 
              return false; 
        }
        
 
    var card_no= document.getElementById('card_no').value;
    if(card_no=="")
    {
    alert("Please Enter The Card Number");
     document.getElementById('card_no').focus(); 
    return false; 
     }
     if(!card_no.match(/^\d+/))
        {
        alert("Please only enter numeric characters only for Card Number");
        document.getElementById('card_no').values=""; 
         document.getElementById('card_no').focus(); 
              return false; 
        }  
     
     
     
    var card_name= document.getElementById('card_name').value;
    if(card_name=="")
    {
   alert("Please Enter The Card Name");
     document.getElementById('card_name').focus(); 
    return false; 
     }
     
    var exp_date= document.getElementById('exp_date').value;
     if(exp_date=="")
    {
    alert("Please Enter The Expire Date");
     document.getElementById('exp_date').focus(); 
    return false; 
     }
    var pattern =/^([0-9]{2})-([0-9]{2})-([0-9]{4})$/;    
    if (!pattern.test(exp_date))
    {
     alert("Invalid Expire Date Format");
     document.getElementById('exp_date').value="";
      document.getElementById('exp_date').focus();
        return false;
    }

}


if(document.getElementById('cheque').checked==true)
{      
var cheque_amount = document.getElementById('cheque_pay_amount').value;
if(cheque_amount =="")
{
 alert("Please Enter Cheque Pay Amount Value");   
 document.getElementById('cheque_pay_amount').focus(); 
    return false; 
 }
      if(!cheque_amount.match(/^\d+/))
        {
        alert("Please only enter numeric characters only for Cheque Amount");
        document.getElementById('cheque_pay_amount').values=""; 
         document.getElementById('cheque_pay_amount').focus(); 
              return false; 
        }  
 
 
    var cheque_no= document.getElementById('cheque_no').value;
    if(cheque_no=="")
    {
    alert("Please Enter The Cheque Number");
     document.getElementById('cheque_no').focus(); 
    return false; 
     }
     if(!cheque_no.match(/^\d+/))
        {
        alert("Please only enter numeric characters only for Cheque Number");
        document.getElementById('cheque_no').values=""; 
         document.getElementById('cheque_no').focus(); 
              return false; 
        }  
  
     
    var ceq_name= document.getElementById('ceq_name').value;
    if(ceq_name=="")
    {
   alert("Please Enter The Cheque Name");
     document.getElementById('ceq_name').focus(); 
    return false; 
     }
     
    var ceq_date= document.getElementById('ceq_date').value;
     if(ceq_date=="")
    {
 alert("Please Enter The Ceque Date");
     document.getElementById('ceq_date').focus(); 
    return false; 
     }
     
    var pattern =/^([0-9]{2})-([0-9]{2})-([0-9]{4})$/;
    if (!pattern.test(ceq_date))
    {
     alert("Invalid Ceque Date Format");
     document.getElementById('ceq_date').value="";
      document.getElementById('ceq_date').focus();
        return false;
    }


}


if(document.getElementById('online').checked==true)
{
    
  var online_amount = document.getElementById('online_pay_amount').value;
if(online_amount =="")
{
 alert("Please Enter Online Pay Amount Pay Amount Value");   
 document.getElementById('online_pay_amount').focus(); 
    return false; 
 }
   if(!online_amount.match(/^\d+/))
        {
        alert("Please only enter numeric characters only for Online Pay Amount");
        document.getElementById('online_pay_amount').values=""; 
         document.getElementById('online_pay_amount').focus(); 
              return false; 
        }  
 
 
    var on_card_no= document.getElementById('on_card_no').value;
    if(on_card_no=="")
    {
    alert("Please Enter The Card Number");
     document.getElementById('on_card_no').focus(); 
    return false; 
     }
       if(!on_card_no.match(/^\d+/))
        {
        alert("Please only enter numeric characters only for Card Number");
        document.getElementById('on_card_no').values=""; 
         document.getElementById('on_card_no').focus(); 
              return false; 
        }  
     
     
    var on_card_name= document.getElementById('on_card_name').value;
    if(on_card_name=="")
    {
   alert("Please Enter The Card Name");
     document.getElementById('on_card_name').focus(); 
    return false; 
     }
     
    var on_exp_date= document.getElementById('on_exp_date').value;
     if(on_exp_date=="")
    {
    alert("Please Enter The Expire Date");
     document.getElementById('on_exp_date').focus(); 
    return false; 
     }
    var pattern =/^([0-9]{2})-([0-9]{2})-([0-9]{4})$/;
    if (!pattern.test(on_exp_date))
    {
     alert("Invalid Expire Date Format");
     document.getElementById('on_exp_date').value="";
      document.getElementById('on_exp_date').focus();
        return false;
    }  
     
     
    var transactions_id= document.getElementById('transactions_id').value;
     if(transactions_id=="")
    {
 alert("Please Enter The Transactions Id");
     document.getElementById('transactions_id').focus(); 
    return false; 
     }
     
}


if(document.getElementById('cash').checked==true && document.getElementById('card').checked==false && document.getElementById('cheque').checked==false && document.getElementById('online').checked==false)
{
        var pay_method ="cash"; 
 var  data1= 'action='+'savebill'+'&table_id='+table_id+'&bill_id='+bill_id+'&cart_id='+cart_id+'&pay_method='+pay_method+'&cash_amount='+cash_amount+'&bill_status='+bill_status+'&disc='+disc+p_type+'&accountsession='+accountsession;
//alert(data1);
}

  if(document.getElementById('cash').checked==false && document.getElementById('card').checked==true && document.getElementById('cheque').checked==false && document.getElementById('online').checked==false)
{
         var pay_method ="card"; 
    var  data1= 'action='+'savebill'+'&table_id='+table_id+'&bill_id='+bill_id+'&cart_id='+cart_id+'&pay_method='+pay_method+'&card_amount='+card_amount+'&card_no='+card_no+'&card_name='+card_name+'&exp_date='+exp_date+'&bill_status='+bill_status+'&disc='+disc+p_type+'&accountsession='+accountsession;
//alert(data1);
}

  if(document.getElementById('cash').checked==false && document.getElementById('card').checked==false && document.getElementById('cheque').checked==true && document.getElementById('online').checked==false)
{
      var pay_method ="cheque"; 
  var  data1= 'action='+'savebill'+'&table_id='+table_id+'&bill_id='+bill_id+'&cart_id='+cart_id+'&pay_method='+pay_method+'&cheque_amount='+cheque_amount+'&cheque_no='+cheque_no+'&ceq_name='+ceq_name+'&ceq_date='+ceq_date+'&bill_status='+bill_status+'&disc='+disc+p_type+'&accountsession='+accountsession;
//alert(data1);
}

  if(document.getElementById('cash').checked==false && document.getElementById('card').checked==false && document.getElementById('cheque').checked==false && document.getElementById('online').checked==true)
{
      var pay_method ="online"; 
    var  data1= 'action='+'savebill'+'&table_id='+table_id+'&bill_id='+bill_id+'&cart_id='+cart_id+'&pay_method='+pay_method+'&online_amount='+online_amount+'&on_card_no='+on_card_no+'&on_card_name='+on_card_name+'&on_exp_date='+on_exp_date+'&transactions_id='+transactions_id+'&bill_status='+bill_status+'&disc='+disc+p_type+'&accountsession='+accountsession;
//alert(data1);
}

if(document.getElementById('cash').checked==true && document.getElementById('card').checked==true)
{
     var pay_method ="cash-card"; 
 var  data1= 'action='+'savebill'+'&table_id='+table_id+'&bill_id='+bill_id+'&cart_id='+cart_id+'&pay_method='+pay_method+'&cash_amount='+cash_amount+'&card_amount='+card_amount+'&card_no='+card_no+'&card_name='+card_name+'&exp_date='+exp_date+'&bill_status='+bill_status+'&disc='+disc+p_type+'&accountsession='+accountsession;
//alert(data1);

}

  if(document.getElementById('cash').checked==true &&  document.getElementById('cheque').checked==true)
{
     var pay_method ="cash-cheque"; 
    var  data1= 'action='+'savebill'+'&table_id='+table_id+'&bill_id='+bill_id+'&cart_id='+cart_id+'&pay_method='+pay_method+'&cash_amount='+cash_amount+'&cheque_amount='+cheque_amount+'&cheque_no='+cheque_no+'&ceq_name='+ceq_name+'&ceq_date='+ceq_date+'&bill_status='+bill_status+'&disc='+disc+p_type+'&accountsession='+accountsession;
//alert(data1);
   
}

  if(document.getElementById('cash').checked==true && document.getElementById('online').checked==true)
{
    //alert("online enter");
     var pay_method ="cash-online"; 
    var  data1= 'action='+'savebill'+'&table_id='+table_id+'&bill_id='+bill_id+'&cart_id='+cart_id+'&pay_method='+pay_method+'&cash_amount='+cash_amount+'&online_amount='+online_amount+'&on_card_no='+on_card_no+'&on_card_name='+on_card_name+'&on_exp_date='+on_exp_date+'&transactions_id='+transactions_id+'&bill_status='+bill_status+'&disc='+disc+p_type+'&accountsession='+accountsession;
//alert(data1);   
}


if(document.getElementById('card').checked==true && document.getElementById('cheque').checked==true)
{
         var pay_method ="card-cheque"; 
    var  data1= 'action='+'savebill'+'&table_id='+table_id+'&bill_id='+bill_id+'&cart_id='+cart_id+'&pay_method='+pay_method+'&card_amount='+card_amount+'&card_no='+card_no+'&card_name='+card_name+'&exp_date='+exp_date+'&cheque_amount='+cheque_amount+'&cheque_no='+cheque_no+'&ceq_name='+ceq_name+'&ceq_date='+ceq_date+'&bill_status='+bill_status+'&disc='+disc+p_type+'&accountsession='+accountsession;
//alert(data1);
}

  if(document.getElementById('card').checked==true &&  document.getElementById('online').checked==true)
{
     var pay_method ="card-online"; 
    var  data1= 'action='+'savebill'+'&table_id='+table_id+'&bill_id='+bill_id+'&cart_id='+cart_id+'&pay_method='+pay_method+'&card_amount='+card_amount+'&card_no='+card_no+'&card_name='+card_name+'&exp_date='+exp_date+'&online_amount='+online_amount+'&on_card_no='+on_card_no+'&on_card_name='+on_card_name+'&on_exp_date='+on_exp_date+'&transactions_id='+transactions_id+'&bill_status='+bill_status+'&disc='+disc+p_type+'&accountsession='+accountsession;
//alert(data1);
}

if(document.getElementById('cheque').checked==true && document.getElementById('online').checked==true)
{
  var pay_method ="card-online"; 
  var  data1= 'action='+'savebill'+'&table_id='+table_id+'&bill_id='+bill_id+'&cart_id='+cart_id+'&pay_method='+pay_method+'&cheque_amount='+cheque_amount+'&cheque_no='+cheque_no+'&ceq_name='+ceq_name+'&ceq_date='+ceq_date+'&online_amount='+online_amount+'&on_card_no='+on_card_no+'&on_card_name='+on_card_name+'&on_exp_date='+on_exp_date+'&transactions_id='+transactions_id+'&bill_status='+bill_status+'&disc='+disc+p_type+'&accountsession='+accountsession;
}
//var data ='action=' + 'savebill' + '&table_id='+table_id+'&bill_id='+bill_id,
 $.ajax({
type: "POST",
url: "reopen_bill_save.php",
data:data1,

success: function(data) {    
    $("#save_bill_content").html(data);
    $("#bill_row").hide();        
    print_bill(table_id,cart_id,bill_id,accountsession);   
    
   window.close();
}
});
}


function print_bill(table_id,cart_id,bill_id,accountsession){
      
document.getElementById('bill_row').style.display='none'; 

window.open("Billprint.php?table_id="+table_id+"&card_id="+cart_id+"&billId="+bill_id+"&accountsession="+accountsession,'_blank');

}

function getPendingBill() { 
   $.ajax({
      type:'POST',
      url:'pending_bill_report.php',
      data:'',
      success: function(result){              
               $("#divmiddlecontent").html(result); 
      }
      });
 
}

</script>