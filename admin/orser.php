<?php  
require_once ("includes/application_top.php");
session_start();
$hms_info_obj = new restaurantbill();
$POST = (isset($_POST["action"]) ? $_POST["action"] : "");
$action = (isset($POST) ? $POST : $_GET["action"]);
$tableid = (isset($_POST['tableid']) && !empty($_POST['tableid']) ? $_POST['tableid']:"");
$ordertype = (isset($_POST['ordertype']) && !empty($_POST['ordertype']) ? $_POST['ordertype']:"");
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
    $deleterow = $hms_info_obj->getCancelBill($_POST['cart_id'],$_POST['table_id']); 
    break;

case "close_cancel":
    $closerow = $hms_info_obj->getCloseBill($_POST['cart_id'],$_POST['table_id']); 
    break;
case "cancelitem":
    $cancel = $hms_info_obj->getcancelitem(); 
    break;
case "parcelitem":
    $cancel = $hms_info_obj->getparcelitem(); 
    break;
	}   
 //echo $_POST['bill'];
$order_cart_id=(isset($_POST['order_cart_id']) ? $_POST['order_cart_id']:"");  
//echo $order_cart_id;
$id=(isset($_POST['tableid']) ? $_POST['tableid']:""); 
//echo $id;
$order_type=(isset($_POST['ordertype']) ? $_POST['ordertype']:""); 
//echo $order_type;

$hms_info_sql  = $hms_info_obj->menuEntryAllRecords($id,$order_type);

$hms_info_value  = $hms_info_obj->menudetailAllRecords($id,$order_type);

$tabletree  = $hms_info_obj->getTableTree();

$ordertabletree  = $hms_info_obj->getorderTableTree();


function display(){
	//echo '<script>alert("Enter");</script>';
}
?>
<link href="js/dist/tinyNotice-theme.css" rel="stylesheet" type="text/css" />
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
$('#loader').show();
setTimeout( function(){
$.ajax({
        url:'get_suggestions.php',
        data:'keyword='+keyword,
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
					
                            //item notification
                   /* var menu_ids  = $(this).attr('id');
                    $.ajax({
                        type:'POST',  
                        url:'checking.php', 
                        data:'action=itemavil&menuid='+menu_ids,
                        success: function(data){ 
                                 var res = data.split("###");
                                 if(res!='')
                                 { 
                                     $.tinyNotice({
                                       status: "warning",
                                       statusTitle: res[0],
                                       statusText: "Available Quantity :"+res[1],
                                       lifeTime: 10000
                                   });
                                 }

                        }
                        });   */  
                    //notification
                    
                    $('#search_suggestion_holder').hide();
                    itemfocus();
					//$('#search-box').focus();
				});
				
			});




$(document).ready(function(){ $("input:text").focus(function() { $(this).select(); } );
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
                        $.ajax({
                        type:'POST',  
                        url:'checking.php', 
                        data:'action=itemavil&menuid='+id,
                        success: function(data){ 
                                 var res = data.split("###");
                                 if(res!='')
                                 { 
                                     $.tinyNotice({
                                       status: "warning",
                                       statusTitle: res[0],
                                       statusText: "Available Quantity :"+res[1],
                                       lifeTime: 10000
                                   });
                                 }

                        }
                        });
			   
      }
      });
					//$('#search-box').val(value);
                    $('#search_suggestion_holder').hide();
                    $('#search-box').focus();
    itemfocus();
            });
            
            
            
    $('#separatebill').on('click',function(){ 
    var ordertype = $("#ordertype").val();
    var tableno  = $("#tableid").val();
    var cartid  = $("#order_cart_id").val();
    var x,y;
    x = 300;
    y = 700;
    var url_is = "separatebill.php?action=deptbill&tableno="+tableno+"&ordertype="+ordertype+"&cartid="+cartid;
    window.open(url_is,this.target,'width='+x+',height='+y+',left=5,top=5,scrollbars=1,resizable=yes');
     });
    $('.quanty').on('keyup',function(){ 
     var  menuid  = $(this).attr("data");
     var  orderid = $(this).attr("data2");
     var  qty = $(this).val();
     $.ajax({
          type:'POST',  
          url:'checking.php', 
          data:'action=stockchk&orderid='+orderid+'&menuid='+menuid+'&qty='+qty,
          success: function(data){ 
                   var res = data.split("###");
                   if(res[0]=='1')
                   {    
                   alert("Available Stock Qantity " +res[1]);
                   $("#quantity_"+orderid).val(res[2]);
                   $("#quantity_"+orderid).focus();
                   $("#quantity_"+orderid).select();
                   }
                   else
                   orderquantity(orderid,qty);    
                   
          }
          });            
    });
    
            
    $('#tableid').on('change',function(){ 
     var tableid = $('#tableid').val(); 
     var ordertype = $("#ordertype").val();
     $.ajax({
          type:'POST',  
          url:'checking.php', 
          data:'action=tablechk&tableid='+tableid,
          success: function(data){    
                   if(data=='1')
                   {
                       alert("Already Booked");
                       $('#tableid').val("");
                   }
                   
          }
          }); 
          
    $.ajax({
          type:'POST',  
          url:'checking.php', 
          data:'action=tableexistchk&tableid='+tableid,
          success: function(data){    
                   if(data=='1')
                   {
                       $.ajax({
                            type:'POST',  
                            url:'restaurantOrderEntry.php',
                            data:'action=' + 'savemenulistres' + '&ordertype=' + ordertype + '&tableid=' + tableid,
                            success: function(result){    
                              $("#divmiddlecontent").html(result);
                              $("#tax_hidden").hide();
                              itemfocus();
                            }
                       });      
                   }
                   else
                   $("#bill_row").hide();
               
          }
          });        
      
          
    });
    $('#bill_cancel').on('click',function(){ 
    var ordertype = $("#ordertype").val();
    var tableno   = $("#tableid").val();
    var cartid    = $("#order_cart_id").val();   
     $.ajax({
          type:'POST',  
          url:'checking.php', 
          data:"action=deptordchk&cartid="+cartid,
          success: function(data){    
                   if(data=='1')
                   {   
                    var x,y;
                    x = 300;
                    y = 700;
                    var url_is = "separatebill.php?action=cancelbill&tableno="+tableno+"&ordertype="+ordertype+"&cartid="+cartid;
                    window.open(url_is,this.target,'width='+x+',height='+y+',left=5,top=5,scrollbars=1,resizable=yes');    
                   }
                   
          }
          });  
    bill_cancel('bill_cancel',cartid,tableno)      
    });
    
   
    
    $('#item_cancel').on('click',function(){ 
    var fields = $("input[name='checkbox[]']:checked").serializeArray(); 
    if (fields.length == 0) 
    { 
        alert('Please Select the Item for Cancel'); 
        return false;
    } 

    var ordertype = $("#ordertype").val();
    var tableno   = $("#tableid").val();
    var cartid    = $("#order_cart_id").val();
    cancelitems();
    var chkitems = $("input[name='checkbox[]']:checked").map(function() {
        return Number(this.value);
    }).get();
    
    var x,y;
    x = 300;
    y = 700;
    var url_is = "separatebill.php?action=cancelitem&tableno="+tableno+"&ordertype="+ordertype+"&cartid="+cartid+"&chkitems="+chkitems;
    window.open(url_is,this.target,'width='+x+',height='+y+',left=5,top=5,scrollbars=1,resizable=yes');  
   
    });
  
   $('.pchk').on('click',function(){ 
       var orderids;
       if($(this).prop("checked")==true)
       orderids = '1##'+$(this).attr('data');
       else
       orderids = '0##'+$(this).attr('data'); 
       var ordertype = document.getElementById('ordertype').value;
       var tableid = document.getElementById('tableid').value;
      var data='action=parcelitem&ordertype=' + ordertype + '&tableid=' + tableid+'&orderids='+orderids;
       $.ajax({
       type: "POST",
       url: "restaurantOrderEntry.php",
       data: data,
       success: function(result){  
        $("#divmiddlecontent").html(result); 
       }
       });
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
 var return_amount =((document.getElementById('netamount_v').value)-cash_amount-card_amount-cheque_amount-online_amount);
//alert(document.getElementById('netamount_v').value);
//alert(return_amount);
 
var return_amt = document.getElementById('return_amount').value=return_amount;
//alert(return_amt);

}

function tabelshow_default(order){
if(order == 'dine'){
document.getElementById('showtabel').style.display = 'table-row';
}

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

    document.getElementById('customer_name').value='';
    document.getElementById('mobile').value='';
    document.getElementById('address').value='';

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

    document.getElementById('customer_name').value='';
    document.getElementById('mobile').value='';
    document.getElementById('address').value='';

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

<script src="js/jquery-1.11.3.min.js"></script>
<script src="js/dist/tinyNotice.js"></script>
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

var ordertype = $("#ordertype").val();
if(ordertype == 'dine')
tabelshow_default(ordertype);

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
        <td align="center">
		
 <table width="93%" align="center" cellpadding="0" cellspacing="0" class="tableborder">

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
		<?php echo (isset($_POST['vat']) ? $_POST['vat']:""); ?>
			  <tr>
                  <td width="1%" height="22">&nbsp;</td>
                  <td width="14%" class="verdanablack">Order Type: </td>
                  <td colspan="3" align="left">
           
  <select name='ordertype' id='ordertype' class="selectinput" onchange="tabelshow(this.value)"> 
    <!-- <?php if(isset($_POST['ordertype']) && !empty($_POST['ordertype'])){ ?> disabled="disabled"<?php }?>  -->  
<?php if(isset($_SESSION["admin_role_mst_id"]) && !empty($_SESSION["admin_role_mst_id"]) && $_SESSION["admin_role_mst_id"]!='3'){?><option <?php if(isset($_POST['ordertype']) && $_POST['ordertype']== dine) echo 'selected="selected"';  ?> value='dine'>Dine</option><?php }?>
<?php if(isset($_SESSION["admin_role_mst_id"]) && !empty($_SESSION["admin_role_mst_id"]) && $_SESSION["admin_role_mst_id"]=='3'){?><option <?php if(isset($_POST['ordertype']) && $_POST['ordertype']== parcel) echo 'selected="selected"'; ?> value='parcel'>Take Out</option><?php }?>		
</select>			
			
			    </td>
                
                </tr>		
                <!-- THIS ROW WILL ONLY EXIST ON EDIT OF AN EXISTING BILL -->

<?php  if(isset($_POST['ordertype']) && $_POST['ordertype']== 'dine'){  ?>   
<tr><td height="15"></td></tr>               
<tr id="showtabel" >
<td width="1%" height="22">&nbsp;</td>
<td width="14%" class="verdanablack">Table Number:</td>
<td colspan="3" align="left">
<select name='tableid' id='tableid' class="selectinput" >
<!-- <?php if($_POST['tableid']!=""){ ?> disabled="disabled"<?php }?>--> 
    <option value=''>-Select-</option>

<?php  while ($roomTreeresultSet = db_fetch_array($tabletree)) {	?>
<option value='<?php echo $roomTreeresultSet['table_entry_id']; ?>' <?php if($_POST['tableid'] == $roomTreeresultSet['table_entry_id']) { ?> selected="selected" <?php } ?> > 
<?php echo $roomTreeresultSet['table_no']; ?></option> 
<?php } ?>
</select>			
</td> 
</tr>	
 <tr><td height="15"></td></tr>
<?php } ?>
 <tr><td height="15"></td></tr>
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
	
<tr><td height="15"></td></tr>
              
<tr >
<td height="20"></td>
<td class="verdanablack" valign="top" style="padding-top:37px;">Item Name:</td>
<td colspan="5">
<div class="form">
  <img src="images/301.GIF" id="loader" />
  <input id="search-box" name="search-box" placeholder="search"  onfocus="var temp_value=this.value;this.value='';this.value=temp_value"  class="search" type="text"    autocomplete="off"/>
<ul id="search_suggestion_holder">
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

<tr >
<td>

<table id="bill_row" border="0" width="100%" align="center" valign="middle" >
 

<tr>
<td width="100%" height="35" align="center" valign="middle" bgcolor="#D7DBB0" class="verdanabold"><span >RESTAURANT ORDER ITEM LIST </span></td>
</tr>
     
<tr>
 <?php
 while ($hms_info_bill = db_fetch_array($hms_info_value)) { 
 		
$hms_info_fetch_table_sql = "SELECT `table_entry_id`,`table_type_id`,`table_no`,`numbers_of_chairs`,`active`,`date_added`,`date_modified` FROM  ".TABLE_HMS_TABLE_ENTRY." WHERE table_entry_id = ".$hms_info_bill["table_entry_id"]." ";
           
   $table_records = db_query ($hms_info_fetch_table_sql);
   $table  = db_fetch_array($table_records);
	  
   $tabel=$table["table_no"]; 
   $bill=$hms_info_bill['bill_id'];
   $cardid=$hms_info_bill['order_cart_id'];
   $tabelid=$hms_info_bill['table_entry_id'];
   $order_type=$hms_info_bill['order_type'];  
 } 
 ?>
    <td colspan="6" align="left" height="30">
        <table cellpaddin="0" cellspacing="0" border="0" width="850">
            <tr>
                <td width="300"><?php echo (!empty($bill) ? 'BILL NO : '.$bill: ""); ?></td>
                <td width="450"><?php echo date("dS  M  Y h:i A"); ?></td>
                <td><?php if(!empty($tabel) && $tabel!=0){ ?>
                Table NO:<?php echo $tabel;  ?>			
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
<th width="1%" height="40">S.no</br></th>
<th width="16%">Item</th>
<th width="10%">Category</th>
<th width="8%">Rate</th>
<th width="5%">Qty</th>
<th width="5%">Cancel Qty</th>
<th width="8%">Amt</th>
<th width="8%">VAT%</th>
<th width="7%">VAT.Amt</th>
<th width="7%">CST%</th>
<th width="7%">CST.Amt</th>
<th width="10%">Total</th>
<?php if(isset($_SESSION["admin_role_mst_id"]) && !empty($_SESSION["admin_role_mst_id"]) && $_SESSION["admin_role_mst_id"]!='3'){?><th width="9%">Parcel</th><?php }?>
</tr>
<input type="hidden" id="itemcount" value="<?php echo db_num_rows($hms_info_sql);?>" />
 <?php 
 $hms_info_counter = 1;
 $q=1;  
 while ($hms_info_values = db_fetch_array($hms_info_sql)) { 
?>

<tr>
<td class="verdanablack" style="text-align:center">
        <input type="hidden" class="noneborder" name="order_cart_id" id="order_cart_id" value="<?php echo $hms_info_values["order_cart_id"]; ?>" />
        <input type="checkbox" class="noneborder classchk" name="checkbox[]" id="checkbox" value="<?php echo $hms_info_values["order_id"]; ?>" />
          <?php echo $hms_info_counter; ?>
</td>
          <td class="verdanablack" style="text-align:center">  
              
  <?php  echo $hms_info_values["order_product"];  if($hms_info_values["parcel_status"]==1) echo "<span class='pred'>(P)</span>";  ?>              
          
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
 <input type="text" class="quanty" name="quantity" data="<?php echo $hms_info_values["menuid"]; ?>" data2="<?php echo $hms_info_values["order_id"]; ?>" id="quantity_<?php echo $hms_info_values["order_id"]; ?>" style="width:45px;" autofocus  onfocus="var temp_value=this.value;this.value='';this.value=temp_value"  value="<?php echo $hms_info_values["order_quantity"]; ?>" 
        /> <!-- onkeyup="orderquantity('<?php echo $hms_info_values["order_id"]; ?>',this.value);"-->
 </td>
         
<td class="verdanablack" style="text-align:center">
 <input type="text" class="cquantity"   name="cquantity" id="cquantity_<?php echo $hms_info_values["order_id"]; ?>" style="width:45px;" autofocus  onfocus="var temp_value=this.value;this.value='';this.value=temp_value"   value="0" 
       onkeyup="cancelquantity('<?php echo $hms_info_values["order_id"]; ?>',this.value);" /> 
 </td>        

 
 <td class="verdanablack" style="text-align:center">
     
  <?php
  $price=$hms_info_values["order_price"]*$hms_info_values["order_quantity"];  
   ?> 
     <input type="text" name="order_amount"  style="width:50px;"  id="order_amount"  readonly="readonly" value="<?php echo $price;  ?>"/>         
  </td>
 
 
  <td class="verdanablack" style="text-align:center">
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
        
  echo $vat_tax; 
   
 ?>   </td>
  
    <td class="verdanablack" style="text-align:right">
        
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
 //echo round($v_tax,2); 
  echo $v_tax;
     }
 ?>  
        <input type="hidden" name="vat_Tax" id="vat_Tax" value="<?php echo $v_tax; ?>" >  
    </td>
    
      <td class="verdanablack" style="text-align:right">
          
  <?php
  echo $service_tax; 
 ?>  
      </td>
      
        <td class="verdanablack" style="text-align:right">
 <?php
 if($service_tax =="0" || $service_tax =="") 
 {
  $s_tax=0;
  echo $s_tax;
 }
 
 else
     {      
   $price=$hms_info_values["order_price"]*$hms_info_values["order_quantity"]; 
 $s_tax=$price*($service_tax/100.0);    
 //echo round($s_tax,2);
 echo $s_tax;
 
     }
 ?>  
            <input type="hidden" name="ser_Tax" id="ser_Tax" value="<?php echo $s_tax; ?>" >  
            
   </td>
  
 

<td class="verdanablack" style="text-align:right">
  <?php
  $price=$hms_info_values["order_price"]*$hms_info_values["order_quantity"];  
         
   //$incl_tax=$price*($s_tax)+($v_tax); 
           
        // $net_total_price= round($price+$s_tax+$v_tax);
   $net_total_price= $price+$s_tax+$v_tax;
	
  ?> 
         <input type="text" name="<?php echo $hms_info_values["order_id"]; ?>"  style="width:80px;"  id="<?php echo $hms_info_values["order_id"]; ?>" 
  readonly="readonly" value="<?php echo $net_total_price;  ?>"/>      
  </td>
  
  <?php if(isset($_SESSION["admin_role_mst_id"]) && !empty($_SESSION["admin_role_mst_id"]) && $_SESSION["admin_role_mst_id"]!='3'){?><td><input type="checkbox" class="noneborder pchk" name="pcheckbox[]" id="pcheckbox_<?php echo $q; ?>" <?php if($hms_info_values["parcel_status"]==1) echo "checked='checked'";?> data="<?php echo $hms_info_values["order_id"]; ?>" /></td><?php }?>
 <?php 
          $hms_info_counter++;
		  $q++;
        }
    ?>
    </tr> 
     <tr>
     <td class="verdanablack"  colspan="12"  style="text-align: right; font-size: 12px; padding-right: 32px; padding-top: 20px;" >
  Total-Amount: 
   <?php  
   
   $menuRecords = db_query("SELECT menuid,sum(order_total_price) as netamount FROM ".TABLE_HMS_RESTAURANT_ORDER_DETAILS." WHERE `status` = 'open' AND itemcancel=0 AND table_entry_id='".$tableid."' AND order_type='".$ordertype."' ");
   $price_values=db_fetch_array($menuRecords);  
   echo $price_values['netamount'];
	 ?>
    <input type="hidden" name="total" id="total" value="<?php  echo $price_values['netamount'];   ?>"/>  
	 </td>
     
      </tr>
    <tr>
  
  <td class="verdanablack" style="text-align:right; margin-left:50px;">
   <input name="delete" type="submit" id="delete" value="Remove Item"  onclick="removeitems()" style="background-color:#063; width:90px; font-family:Arial, Helvetica, sans-serif; color:#FFF;" />  
  <input name="item_cancel" type="submit" id="item_cancel" value="Cancel Item"   style="background-color:#063; width:90px; font-family:Arial, Helvetica, sans-serif; color:#FFF;" />  
  </td>
 
    </tr>
     <tr>
<td colspan="12" class="verdanablack" align="left" style="text-align:right; margin-right:50px;">    

    <table border="0" width="100%" style="font-size: 14px;">
          <tr height='20'>
              <th width="65%" align="left" style="padding-left: 10px;">  Tax Details </th>                
              <th  width="10%" align="left" >  Value  </th>              
               <th width="10%" align="left">   Tax     </th>              
               <th width="15%" align="left">  Total    </th>  
          </tr>  
          
  <?php          
   $menu_t = db_query("SELECT  sum(vat_amount) as vat_amt, vat_tax FROM ".TABLE_HMS_RESTAURANT_ORDER_DETAILS." WHERE `status` = 'open' AND itemcancel=0 AND table_entry_id='".$tableid."' AND order_type='".$ordertype."' group by vat_tax");
   while ($table_T = db_fetch_array($menu_t))
  {        
 
    $hms_info_fetch_tax_vat = "SELECT sum(order_price) as price_value FROM " . TABLE_HMS_RESTAURANT_ORDER_DETAILS . " WHERE  table_entry_id='".$tableid."' AND order_cart_id='$cardid' AND vat_tax='".$table_T['vat_tax']."'";
   // echo $hms_info_fetch_tax_vat;
    $menu_records_v_tax = db_query ($hms_info_fetch_tax_vat);
    while ($menu_categ_v_tax = db_fetch_array($menu_records_v_tax))
    {
?>
          
          <tr style="font-size: 11px; font-weight: unbold;">
           <td align="left" style="padding-left: 10px;">    
            
        VAT <?php  echo $table_T['vat_tax']; ?>% 
            </td>  
              
              
  <td align="left"> 
       <?php              
         $v_tax_amt =$menu_categ_v_tax['price_value'];        
       // echo round($v_tax_amt,2);
          echo $v_tax_amt;
         ?>                   
     </td>  
              
 <td align="left"> 
            <?php       
            $v_tax=$table_T['vat_amt'];            
            //echo round($v_tax,2); 
            echo $v_tax;
            ?>
   </td> 
         
   
   <td align="right" style="padding-right: 100px;">                  
  <?php 
$total_v= $v_tax_amt+$v_tax;             
//echo round($total_v,2);
echo $total_v;
?>
</td>    
              
  </tr>
          
 <?php  } } ?>        
  
  
<?php          
   $menu_s = db_query("SELECT  service_tax FROM ".TABLE_HMS_RESTAURANT_ORDER_DETAILS." WHERE `status` = 'open' AND itemcancel=0 AND table_entry_id='".$tableid."' AND order_type='".$ordertype."' group by service_tax");
   while ($table_s = db_fetch_array($menu_s))
  {        
 
    $hms_info_fetch_tax_ser = "SELECT sum(order_amount) as price_value FROM " . TABLE_HMS_RESTAURANT_ORDER_DETAILS . " WHERE  table_entry_id='".$tableid."' AND order_cart_id='$cardid'  AND service_tax='".$table_s['service_tax']."'";
   // echo $hms_info_fetch_tax_vat;
    $menu_records_s_tax = db_query ($hms_info_fetch_tax_ser);
    while ($menu_categ_s_tax = db_fetch_array($menu_records_s_tax))
    {
?>
          
          <tr style="font-size: 11px; font-weight: unbold;">
           <td align="left" style="padding-left: 10px;">                
        CST <?php  echo $table_s['service_tax']; ?>%
   (<?php              
        $s_tax_amt =$menu_categ_s_tax['price_value'];        
      // echo round($s_tax_amt,2);
         echo $s_tax_amt;
        ?>) 
            </td>  
              
              
  <td align="left"> 
      <?php echo "0.00"; ?>             
     </td>  
              
 <td align="left"> 
            <?php       
            $s_tax=$s_tax_amt*($table_s['service_tax']/100.0);            
            //echo round($s_tax,2); 
            echo $s_tax; 
            ?>
   </td> 
         
   
   <td align="right" style="padding-right: 100px;">                    
  <?php 
$total_s=$s_tax;             
//echo round($total_s,2);
echo $total_s;
?>
</td>    
              
  </tr>
          
 <?php  } } ?>        
  
  
        <tr><td colspan="5" align='right'>
              
                  <span style="font-weight:unbold; font-size: 13px;"> 
                 <?php /* Total Amount :     <?php $total_tax = $total_v+$total_s;
                  echo $total_tax; ?><?php */ ?></span>
                                    
              </td>
          </tr>     
      </table>
       
</td>


   </tr>
      <tr >
        <td class="verdanablack"  colspan="12"  style="text-align: right; font-size: 12px;  padding-right: 32px;" >
            Discount(%):<input type="text" name="disc" id="disc"  value="" onkeyup="Gettax()" style="width:40px;">   </td>
             </tr>
    <tr>
     <td class="verdanablack"  colspan="12"  align='right' style="padding-right: 50px;"> 
 <div id="netamount" style="font-size: 16px; padding-left: 20px;">NET-AMOUNT: 
   <?php   
   $menuRecords = db_query("SELECT menuid, sum(order_total_price) as netamount FROM ".TABLE_HMS_RESTAURANT_ORDER_DETAILS." WHERE `status` = 'open' AND itemcancel=0 AND table_entry_id='".$tableid."' AND order_type='".$ordertype."' ");
   $price_values=db_fetch_array($menuRecords);  
   echo $price_values['netamount'];
	 ?> 
     
    
	 </div>
          <input type="hidden" name="netamount_v" id="netamount_v"  value="<?php  echo $price_values['netamount']; ?>"  style="width:40px;"> 
	 </td>     
      </tr>
      
        <tr>
            
     <td class="verdanablack"  colspan="12"  align='left' style="padding-left:10px; padding-bottom: 10px;"> 
         PAYMENT TYPE: 
         <input type="checkbox" checked="checked" name="full" id="full" value="1" onclick="show_full()">  Full
        <input type="checkbox" name="partial" id="partial" value="1" onclick="show_partial(this.value)">  Partial      
	 </td>          
         
      </tr>   
      
      <tr> <td colspan="12" >
          <table border="0" width="100%" align="left"  cellpadding="10" cellspacing="10" id="partial_customer" style="display:none;">                          
    
                 <tr>
                       <td style="font-size: 12px; font-weight: bold;" class="verdanablack" align="left" colspan="5">Customer Name :  
                <input type="text" name="customer_name" id="customer_name" value="<?php echo $customer_name; ?>" >
                       </td>   
                 
                 <td style="font-size: 12px; font-weight: bold;" class="verdanablack" align="left"> Mobile Number : 
                     <input type="text" name="mobile" id="mobile" value="<?php echo $mobile; ?>" maxlength="15" > 
                 </td>
                 
                 <td style="font-size: 12px; font-weight: bold;" class="verdanablack" align="left" valign="top">
                &nbsp; &nbsp;  Address : 
                <textarea id="address" name="address"></textarea>
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
                     <input type="text" name="cash_pay_amount" id="cash_pay_amount"  onkeyup="get_amount_value(this.value);" value="<?php echo $price_values['netamount']; ?>" > 
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
                     <input type="text" name="on_card_no" id="on_card_no" value="<?php echo $on_card_no; ?>" >  </td>
                 <td style="font-size: 12px; font-weight: bold;" align="left" width="500">
                 &nbsp;  &nbsp;  Name : 
                  <input type="text" name="on_card_name" id="on_card_name" value="<?php echo $on_card_name; ?>" > 
                 </td>
             </tr> 
             
               <tr>
                 <td style="font-size: 12px; font-weight: bold;" align="left" width="500"> Expire Date : 
                     &nbsp;  <input type="text" name="on_exp_date" id="on_exp_date" value="<?php echo $on_exp_date; ?>" placeholder="ex: 01-01-2015" style="width: 100px;">  </td>
                
                 <td style="font-size: 12px; font-weight: bold;" align="left" width="500" colspan="2"> Transactions Id : 
                     &nbsp;  <input type="text" name="transactions_id" id="transactions_id" value="<?php echo $transactions_id; ?>" > 
                 </td>
             </tr> 
              </table>
         
         
         
    <tr>

        <td align="right" colspan="12" style="padding-right: 20px; font-size: 12px; font-weight: bold;"> Balance Amount :  <input type="text" name="return_amount" id="return_amount" value="<?php echo (isset($return_amount) && !empty($return_amount) ? $return_amount:"" ); ?>" >   </td>
     </tr> 
         
            
   
    <tr>
     <td class="verdanablack" style="text-align:center; margin-left:60px;" colspan="12">
         </br>         </br>
   
 <?php 
 $select = db_query("SELECT last_cancel_quantity_disp FROM ".TABLE_HMS_RESTAURANT_ORDER_DETAILS." WHERE last_cancel_quantity_disp!=0 AND order_cart_id='".$cardid."'");

 if(db_num_rows($select)==0){?><input name="separatebill" type="submit" class="genbtn" id="separatebill" value="Generate"    style="background-color:#063; font-family:Arial, Helvetica, sans-serif; color:#FFF;" /><?php }?>
 <input name="Save" type="submit" id="Save" value="Save & Print" onclick="Save_bill('<?php echo $tabelid; ?>','<?php echo $cardid; ?>','<?php echo $bill; ?>','<?php echo $order_type; ?>')" 
 style="background-color:#063; font-family:Arial, Helvetica, sans-serif; color:#FFF;"  />
 <input name="bill_cancel" type="submit" id="bill_cancel" value="Cancel Bill"   
 style="background-color:#063; font-family:Arial, Helvetica, sans-serif; color:#FFF;" />
 
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
</table>
    
    <table border="0" style="padding-top:20px;" width="100%" cellpadding="10">
    <tr>
        <td>
            <div id="save_bill_content">
             
                <table style="border:solid 1px #000000;" width="100%" cellpadding="20" id="show_list_bill" style="display:none;">
    <tr style="font-size: 14px; font-weight: bold; height:30px;" >
 <td width="50"   align="center" >
S.No
 </td>
 
 <td width="80"  align="center" >
Bill No
 </td><?php if(isset($_SESSION["admin_role_mst_id"]) && !empty($_SESSION["admin_role_mst_id"]) && $_SESSION["admin_role_mst_id"]!='3'){?>
   <td width="80"  align="center" >
Table No
 </td><?php }?>
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
  if(isset($_SESSION["admin_role_mst_id"]) && !empty($_SESSION["admin_role_mst_id"]) && $_SESSION["admin_role_mst_id"]!='1')
  $wherecon = " AND created_role_id='".$_SESSION["admin_role_mst_id"]."'";     
  $savebill_print=db_query("SELECT * FROM ".TABLE_HMS_RESTAURANT_ACCOUNT_DETAILS." WHERE  status='open' $wherecon");
  $sno=1;
  while($save_bill = db_fetch_array($savebill_print))
  {
      $table_id = $save_bill['tabel_id'];
      $cart_id = (!empty($save_bill['order_cart_id']) ? $save_bill['order_cart_id']:"");
      
    
 ?>
        
 <tr>
 <td width="50" class="verdanablack" align="center" >
<?php echo $sno; ?>
 </td>
 
 <td width="80" class="verdanablack"  align="center" >
<?php echo $save_bill['bill_id']; ?>
 </td>
 
 <?php if(isset($_SESSION["admin_role_mst_id"]) && !empty($_SESSION["admin_role_mst_id"]) && $_SESSION["admin_role_mst_id"]!='3'){?>
   <td width="80" class="verdanablack"  align="center" >
       
<?php 
$select_table_no=db_query("SELECT * FROM ".TABLE_HMS_TABLE_ENTRY." WHERE  table_entry_id='$table_id'");  
      
    if($table_no = db_fetch_array($select_table_no))
    {
    
echo $table_no['table_no'];  }?> 
 </td>
 <?php }?>
  <td width="80" class="verdanablack" align="center" >
<?php echo $save_bill['order_type']; ?>
 </td>
 
   <td width="80" class="verdanablack" align="center" >
<?php 
//echo $save_bill['discount'];
$total=$save_bill['total_amount']*($save_bill['discount']/100.0);

//echo $save_bill['total_amount']-round($total); 
echo $save_bill['total_amount']-$total; 
?>
 </td>
 
    <td width="80" height="50" class="verdanablack" align="center" >

        <a href="#" onclick="open_bill('<?php echo $save_bill['account_card_id']; ?>','<?php echo $save_bill['tabel_id']; ?>','<?php echo $save_bill['order_type']; ?>')"> Edit</a> (or)
        <a href="#" onclick="close_bill('close_cancel','<?php echo $save_bill['account_card_id']; ?>','<?php echo $save_bill['tabel_id']; ?>')"> Close </a>
 </td>
 
 </tr>
 
  <?php $sno++; } ?>
 

 
 </table>
            </div>            
        </td>        
    </tr>   
    

</table>

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
