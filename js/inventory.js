/******************************************************************05-12-2014*********************************************************************************/

function getpurchaseorder()
{
   $.ajax({
      type:'POST',
      url:'purchase_order.php',
      data:'',
      success: function(result){              
           $("#divmiddlecontent").html(result);
      }
      }); 
}

/*function getpurchaseorder(){
	
        var pars = '';
        var url  = 'purchase_order.php';
        var myAjax = new Ajax.Updater(
        { success: 'divmiddlecontent' },
        url, {
            method: 'post',
            evalScripts: true,
            parameters: pars,
            oncomplete : function (req) {
            }
        });
}*/



function getpurchasestock()
{
   $.ajax({
      type:'POST',
      url:'purchase_stock.php',
      data:'',
      success: function(result){              
           $("#divmiddlecontent").html(result);
      }
      }); 
}


/*function getpurchasestock(){
        var pars = '';
        var url  = 'purchase_stock.php';
        var myAjax = new Ajax.Updater(
        { success: 'divmiddlecontent' },
        url, {
            method: 'post',
            evalScripts: true,
            parameters: pars,
            oncomplete : function (req) {
            }
        });
}
*/


function getmaterialinward()
{
   $.ajax({
      type:'POST',
      url:'stock_report.php',
      data:'',
      success: function(result){              
           $("#divmiddlecontent").html(result);
      }
      }); 
}


/*function getmaterialinward() {
        var pars = '';
        var url  = 'stock_report.php';
        var myAjax = new Ajax.Updater(
        { success: 'divmiddlecontent' },
        url, {
            method: 'post',
            evalScripts: true,
            parameters: pars,
            oncomplete : function (req) {
            }
        });
}*/



function getpurchaseitemreturn()
{
   $.ajax({
      type:'POST',
      url:'purchase_return.php',
      data:'',
      success: function(result){              
           $("#divmiddlecontent").html(result);
      }
      }); 
}


/*function getpurchaseitemreturn() {
        var pars = '';
        var url  = 'purchase_return.php';
        var myAjax = new Ajax.Updater(
        { success: 'divmiddlecontent' },
        url, {
            method: 'post',
            evalScripts: true,
            parameters: pars,
            oncomplete : function (req) {
            }
        });
}*/


function getPurchaseReturn(i_id)
{
    var data= "i_id="+i_id;
  	  $.ajax({
      type:'POST',
      url:'inventory_value.php',
      data:data,
      success: function(result){
		  //alert(result);              
           $("#divmiddlecontent").html(result);
      }
      }); 
}

/*function getPurchaseReturn(i_id) {
	
        var pars = "i_id="+i_id;
		//alert(pars);
        var url  = 'inventory_value.php';
        var myAjax = new Ajax.Updater(
        { success: 'divmiddlecontent' },
        url, {
            method: 'post',
            evalScripts: true,
            parameters: pars,
            oncomplete : function (req) {
            }
        });
}*/
	
	
function getPurchaseRestore(r_id) {	

   var data= "r_id="+r_id;   
   $.ajax({
      type:'POST',
      url:'inventory_value.php',
      data:data,
      success: function(result){              
           $("#divmiddlecontent").html(result);
      }
      }); 
}
	
	
		
/*function getPurchaseRestore(r_id) {	
        var pars = "r_id="+r_id;
		//alert(pars);
        var url  = 'inventory_value.php';
        var myAjax = new Ajax.Updater(
        { success: 'divmiddlecontent' },
        url, {
            method: 'post',
            evalScripts: true,
            parameters: pars,
            oncomplete : function (req) {
            }
        });
}*/


function getVendorDetails(id1) {

   var data= "vendor_name="+id1;
   //alert(data);
 
   $.ajax({
      type:'POST',
      url:'inventory_value.php',
      data:data,
      success: function(result){   
             
      $('#vendor_details').html($.trim(result));

      }
      }); 
}

function Gettaxamt(){
	
	var tax    = document.getElementById("tax").value;
	if(tax=="")
	{
		var tax=0;
	}
    
    var total  = document.getElementById("item_total_price").value;		
    var tax_amt=Math.round(total*(tax/100.0));               
        
    document.getElementById('tax_amt').value=tax_amt;
 //$("#netamount").val(netamount);
}


function Getpurchasetax(){
	
        var purchase_tax  = document.getElementById("purchase_tax").value;
	if(purchase_tax=="")
	{
		var purchase_tax=0;
	}
    
    var total  = document.getElementById("item_total_price").value;		
    var purchasetax_amt=Math.round(total*(purchase_tax/100.0));               
        
    document.getElementById('purchase_tax_amt').value=purchasetax_amt;
 //$("#netamount").val(netamount);

}



function Getdiscountpurchase(){
	
	var disc    = document.getElementById("discount").value;
	if(disc=="")
	{
		var disc=0;
	}
    
    var total  = document.getElementById("item_total_price").value;		
    var disc_smt=Math.round(total*(disc/100.0));               
        
    document.getElementById('discount_amt').value=disc_smt;
 //$("#netamount").val(netamount);
}


/*function getVendorDetails(id) {
	//alert(id);
	var pars = 'main_menu_id=' + id;
	//alert(pars);
        var url  = 'inventory_value.php';
        var myAjax = new Ajax.Updater(
        { success: 'vendor_details'  }  ,
        url, {			
            method: 'post',
            evalScripts: true,
            parameters: pars,
            oncomplete : function (req) {
        }
        });
}*/	


function getItemDetails(id) {

   var data= 'item_menu_id=' + id;
   $.ajax({
      type:'POST',
      url:'inventory_value.php',
      data:data,
      success: function(result){  
          // alert(result);
           $("#item_type").html(result);
      }
      }); 
}
	




/*
function getVendorItem() {
	var item_id = 
	//alert(main_menu_id);
  var pars = 'main_menu_id=' + main_menu_id ;
        var url  = 'inventory_value.php';
        var myAjax = new Ajax.Updater(
        { success: 'divmiddlecontent' },
        url, {
            method: 'post',
            evalScripts: true,
            parameters: pars,
            oncomplete : function (req) {
            }
        });
}
*/

function getVendorList() {
	
   if(document.getElementById('item_name_id').value == '') {
    document.getElementById('error_service').style.display ="block";
    document.getElementById('error_service').innerHTML = "Please Select Item Type";
    document.getElementById('item_name_id').focus();
    return false;
   }
	var item_name_id = document.getElementById('item_name_id').value;
	


var data =  'item_name_id=' + item_name_id;
	//alert(pars);
	  $.ajax({
      type:'POST',
      url:'vendor_list.php',
      data: data,
      success: function(result){   
	  //  alert(result);
               $("#vendorListResult").html(result);
			   //  alert(vendorListResult);       
      }
      }); 
}


function getstockreport() {
	
   if(document.getElementById('item_name_id').value == '') {
    document.getElementById('error_service').style.display ="block";
    document.getElementById('error_service').innerHTML = "Please Select Item Type";
    document.getElementById('item_name_id').focus();
    return false;
   }
   document.getElementById('error_service').style.display ="none";
   
	var item_name_id = document.getElementById('item_name_id').value;
//alert(item_name_id);

var data =  'item_name=' + item_name_id+ '&action=' + "check" ;
	//alert(data);
	  $.ajax({
      type:'POST',
      url:'check_quantity.php',
    data: data,
      success: function(result){   
//alert(result);
            if(result.trim() !="")
            { 
              alert(result);
          }
          else {  }
              // $("#vendorListResult").html(result);
			   //  alert(vendorListResult);       
      }
      }); 
}

 /*       var url  = 'vendor_list.php';
        var myAjax = new Ajax.Updater(
     //  function(html) {
       //      $("#vendorListResult").html(html);
     {   success: 'vendorListResult'  }  ,
        url, {
            method: 'post',
            evalScripts: true,
            parameters: pars,
            oncomplete : function (req) {
				alert(vendorListResult);
            }

 });
}*/	



function getStockList() {
	
	if(document.getElementById('main_menu_id').value == '') {
    document.getElementById('error_service').style.display ="block";
    document.getElementById('error_service').innerHTML = "Please Select Vendor Name";
    document.getElementById('main_menu_id').focus();
    return false;
   }
   
   if(document.getElementById('ddDateFrom').value == '') {
    document.getElementById('error_service').style.display ="block";
    document.getElementById('error_service').innerHTML = "Please Select From Date";
    document.getElementById('ddDateFrom').focus();
    return false;
   }
   
   if(document.getElementById('ddDateTo').value == '') {
    document.getElementById('error_service').style.display ="block";
    document.getElementById('error_service').innerHTML = "Please Select To Date";
    document.getElementById('ddDateTo').focus();
    return false;
   }
   
    document.getElementById('error_service').style.display ="none";
	
	var main_menu_id = document.getElementById('main_menu_id').value;
	var ddDateFrom = document.getElementById('ddDateFrom').value;
	var ddDateTo = document.getElementById('ddDateTo').value;

   if(main_menu_id !="0" && ddDateFrom !="" && ddDateTo !="")
    {
            document.getElementById('error_service').style.display ="none";
    }
    
var data = 'main_menu_id=' + main_menu_id + '&ddDateFrom=' + ddDateFrom+ '&ddDateTo=' + ddDateTo ;
	//alert(pars);
      $.ajax({
      type:'POST',
      url:'stock_list.php',
      data: data,
      success: function(result){   
	    
               $("#vendorListResult").html(result);
			   //  alert(vendorListResult);       
      }
      }); 
}
	 
	 	 
/*  var url  = 'stock_list.php';
      var myAjax = new Ajax.Updater(
     //  function(html) {
       //      $("#vendorListResult").html(html);
     {   success: 'vendorListResult'  }  ,
        url, {
            method: 'post',
            evalScripts: true,
            parameters: pars,
            oncomplete : function (req) {
				alert(vendorListResult);
            }

 });
}	
*/


	
	function getVendorViewList(item_name, item_type, avail_qty) {
//alert(item_name);
//alert(item_type);
//alert(tot_qty);
    //function divHide();
    var x,y;
    x = 700;
    y = 520;

    var url_is = 'Purchase_list_detail.php?item_name='+item_name+'&item_type='+item_type+'&avail_qty='+avail_qty ;
//alert(url_is);
    window.open(url_is,this.target,'width='+x+',height='+y+',left=5,top=5,toolbar=no ,menubar=no,scrollbars=no, resizable=yes');

}





function calcTotalPrice()
{
	
	var item_quantity = document.getElementById('item_quantity').value;
	var item_price = document.getElementById('item_unit_price').value;
	
	var total_price=item_quantity * item_price;
	
	document.getElementById('item_total_price').value=total_price;
	}
	
	
	
function addPurchaseList()
{
	
	 if(document.getElementById('main_menu_id').value == '') {
    document.getElementById('error_service').style.display ="block";
    document.getElementById('error_service').innerHTML = "Please Select Vendor Name";
    document.getElementById('main_menu_id').focus();
    return false;
   }
   
    if(document.getElementById('ddDateFrom').value == '') {
    document.getElementById('error_service').style.display ="block";
    document.getElementById('error_service').innerHTML = "Please Select Date";
    document.getElementById('ddDateFrom').focus();
    return false;
   }
   
    if(document.getElementById('item_menu_id').value == '') {
    document.getElementById('error_service').style.display ="block";
    document.getElementById('error_service').innerHTML = "Please Select Item Name";
    document.getElementById('item_menu_id').focus();
    return false;
   }
   
    if(document.getElementById('item_quantity').value == '') {
    document.getElementById('error_service').style.display ="block";
    document.getElementById('error_service').innerHTML = "Please Enter Quantity";
    document.getElementById('item_quantity').focus();
    return false;
   }
   
    if(document.getElementById('item_unit_price').value == '') {
    document.getElementById('error_service').style.display ="block";
    document.getElementById('error_service').innerHTML = "Please Enter Unit Price";
    document.getElementById('item_unit_price').focus();
    return false;
   }
   
    if(document.getElementById('item_total_price').value == '') {
    document.getElementById('error_service').style.display ="block";
    document.getElementById('error_service').innerHTML = "Please Enter total Price";
    document.getElementById('item_total_price').focus();
    return false;
   }
   
       if(document.getElementById('reorderlevel').value == '') {
    document.getElementById('error_service').style.display ="block";
    document.getElementById('error_service').innerHTML = "Please Enter Reorder level ";
    document.getElementById('item_total_price').focus();
    return false;
   }
	document.getElementById('error_service').style.display ="none";
	
	var main_menu_id = document.getElementById('main_menu_id').value;
	var ddDateFrom = document.getElementById('ddDateFrom').value;
	var vendor_details = document.getElementById('vendor_details').value;
	var item_menu_id = document.getElementById('item_menu_id').value;
	var item_type_value = document.getElementById('item_type_value').value;
	var item_unit_value = document.getElementById('item_unit_value').value;
	var item_quantity = document.getElementById('item_quantity').value;
        var reorderlevel = document.getElementById('reorderlevel').value;
	var item_unit_price = document.getElementById('item_unit_price').value;
        var tax = document.getElementById('tax').value;
        var tax_amt = document.getElementById('tax_amt').value;
        var purchase_tax = document.getElementById('purchase_tax').value;
	var purchase_tax_amt = document.getElementById('purchase_tax_amt').value;
        var discount = document.getElementById('discount').value;
	var discount_amt = document.getElementById('discount_amt').value;        
	var item_total_price = document.getElementById('item_total_price').value;
        
        var purchase ="text";
        
     if(tax!="" && purchase_tax=="" && discount=="")
     {
    var purchase_type='&tax='+tax+'&tax_amt='+tax_amt;
     }
     
    if(tax =="" && purchase_tax !="" && discount !="")
     {
    var purchase_type='&purchase_tax='+purchase_tax+'&purchase_tax_amt='+purchase_tax_amt+'&discount='+discount+'&discount_amt='+discount_amt;
     }
     
      if(tax !="" && purchase_tax =="" && discount !="")
     {
    var purchase_type='&tax='+tax+'&tax_amt='+tax_amt+'&discount='+discount+'&discount_amt='+discount_amt;
     }
     
     if(tax!="" && purchase_tax !="" && discount=="")
     {
    var purchase_type='&tax='+tax+'&tax_amt='+tax_amt+'&purchase_tax='+purchase_tax+'&purchase_tax_amt='+purchase_tax_amt;
     }
 
    if(tax!="" && purchase_tax !="" && discount !="")
     {  
         var purchase_type='&tax='+tax+'&tax_amt='+tax_amt+'&purchase_tax='+purchase_tax+'&purchase_tax_amt='+purchase_tax_amt+'&discount='+discount+'&discount_amt='+discount_amt;
     }
     
     if(tax =="" && purchase_tax =="" && discount =="")
     {  
         var purchase_type='&purchase='+purchase;
     }


    var data = 'main_menu_id=' + main_menu_id + '&ddDateFrom=' + ddDateFrom + '&vendor_details=' + vendor_details  + '&item_menu_id=' + item_menu_id  + '&item_type_value=' + item_type_value  + '&item_unit_value=' + item_unit_value  + '&item_quantity=' + item_quantity  + '&reorderlevel=' + reorderlevel  +'&item_unit_price=' + item_unit_price  + '&item_total_price=' + item_total_price+purchase_type;
  // alert(data);

	document.getElementById('item_menu_id').value="";
	document.getElementById('item_type_value').value="";
	document.getElementById('item_unit_value').value="";
	document.getElementById('item_quantity').value="";
	document.getElementById('item_unit_price').value="";
	document.getElementById('item_total_price').value="";
	document.getElementById('reorderlevel').value="";
        document.getElementById('tax').value="";
        document.getElementById('tax_amt').value="";
        document.getElementById('purchase_tax').value="";
	document.getElementById('purchase_tax_amt').value="";
        document.getElementById('discount').value="";
	document.getElementById('discount_amt').value="";       
	document.getElementById('item_total_price').value="";
        document.getElementById('item_type_value_tmp').value="";
        document.getElementById('item_unit_value_tmp').value="";
	
	 	//alert(data);
     $.ajax({
      type:'POST',
      url:'purchase_item_add.php',
      data: data,
      success: function(result){   
         // alert(result);
               var res = result.split('###')
               $("#PurchaseAddList").html(res[0]);
               $("#main_menu_id").hide();
               $("#main_menu_id_temp").show();
               $("#main_menu_id_temp").val(res[1]);
               $("#item_type").hide();
               $("#opsubmit").val(1);
      }
      }); 
}

  /*      var myAjax = new Ajax.Updater(
     //  function(html) {
       // $("#vendorListResult").html(html);
     {   success: 'PurchaseAddList'  }  ,
        url, {
            method: 'post',
            evalScripts: true,
            parameters: pars,
            oncomplete : function (req) {
				//alert(vendorListResult);
            }
 });
	}*/
	
	
	
	
	
function addPurchaseOrder()
{
	var cart_id = document.getElementById('cart_id').value;	
	var data = 'cart_id=' + cart_id; 
/*	var url  = 'purchase_order_item_add.php';*/
	
	$.ajax({
      type:'POST',
      url:'purchase_order_item_add.php',
      data: data,
      success: function(result){              
               $("#PurchaseAddList").html(result);
               $("#main_menu_id").show();
               $("#main_menu_id").val('');
               $("#main_menu_id_temp").hide();
               $("#main_menu_id_temp").val('');
               $("#item_type").hide();
               $("#opsubmit").val(0);
      }
      }); 
}
	
	
	/*var myAjax = new Ajax.Updater(
	{ 
	success: 'PurchaseAddList'  }  ,
	url, {
	method: 'post',
	evalScripts: true,
	parameters: pars,
	oncomplete : function (req) {
	}
	});	
	}*/
	
	
function deletePurchaseItemRecord()
{
	n=confirm("Do you Want to Delete?");
    if(n==true)
	var Pur_id = document.getElementById('Pur_id').value;
        var vendor_name = document.getElementById('main_menu_id').value;
	//alert(Pur_id);
	var data = 'Pur_id=' + Pur_id + '&vendor_name='+vendor_name;
	//alert(data);
/*	var url  = 'purchase_order_item_delete.php'; */
	
	$.ajax({
      type:'POST',
      url:'purchase_order_item_delete.php',
      data: data,
      success: function(result){              
               $("#PurchaseAddList").html(result);
      }
      }); 
}
	
/*	var myAjax = new Ajax.Updater(
     {
	success: 'PurchaseAddList'  }  ,
    url, {
            method: 'post',
            evalScripts: true,
            parameters: pars,
            oncomplete : function (req) {
		//alert(vendorListResult);
       }

 });	
}*/
	
	
    function addPurchaseCancel()
{
	n=confirm("Do you Want to Cancel Purchase Order");
	if(n==true)
        {
	var Pur_id = document.getElementById('Pur_id').value;	
	//alert(Pur_id);
/*	var url  = 'purchase_order_delete_all.php'; */
	

	var data = 'Pur_id=' + Pur_id;
	
	  $.ajax({
      type:'POST',
      url:'purchase_order_delete_all.php',
      data: data,
      success: function(result){         
	                      $("#PurchaseAddList").html(result); 
                              $("#main_menu_id").show();
                                $("#main_menu_id").val('');
                                $("#main_menu_id_temp").hide();
                                $("#main_menu_id_temp").val('');
                                $("#item_type").hide();
      }
      }); 
}
}
/*	var myAjax = new Ajax.Updater(
	{ 
	success: 'PurchaseAddList'  }  ,
	url, {
	method: 'post',
	evalScripts: true,
	oncomplete : function (req) {
	}
	});	
}
	*/
	
function ConfirmClose()
{
	n=confirm("Do you Want to Leave this Page");
	if(n==true)
	var url  = 'purchase_order_delete_all.php'; 
	document.getElementById('main_menu_id').value="";
	document.getElementById('vendor_details').value="";
	document.getElementById('item_menu_id').value="";
	document.getElementById('item_type_value').value="";
	document.getElementById('item_unit_value').value="";
	document.getElementById('item_quantity').value="";
	document.getElementById('item_unit_price').value="";
	document.getElementById('item_total_price').value="";
	
	var myAjax = new Ajax.Updater(
     {   success: 'PurchaseAddList'  }  ,
        url, {
            method: 'post',
            evalScripts: true,
            //parameters: pars,
            oncomplete : function (req) {				
				//alert(vendorListResult);
            }
 });	
}
	
	
	function getVendorItem() {
	var item_id = document.getElementById('item_type_id').value;

	//alert(main_menu_id);
  var data = 'main_menu_id=' + main_menu_id;
  
  	   $.ajax({
      type:'POST',
      url:'inventory_value.php',
      data: data,
      success: function(result){              
               $("#divmiddlecontent").html(result);
      }
      }); 
}

  
/*        var url  = 'inventory_value.php';
        var myAjax = new Ajax.Updater(
        { success: 'divmiddlecontent' },
        url, {
            method: 'post',
            evalScripts: true,
            parameters: pars,
            oncomplete : function (req) {
            }
        });
}*/
	
	
	
function getStockListView(vendor_name, from,to)
{
	var x,y;
    x = 700;
    y = 520;

    var url_is = 'stock_list_view.php?vendor_name='+ vendor_name + '&from=' + from + '&to=' + to;
//alert(url_is);
    window.open(url_is,this.target,'width='+x+',height='+y+',left=5,top=5,toolbar=no,menubar=no,scrollbars=no, resizable=yes');
}

function balancestock() {
        if(document.getElementById('item_name').value == '') {
    document.getElementById('error_service').style.display ="block";
    document.getElementById('error_service').innerHTML = "Please Enter Item Name";
    document.getElementById('item_name').focus();
    return false;
   }
   
   if(document.getElementById('item_type').value == '') {
    document.getElementById('error_service').style.display ="block";
    document.getElementById('error_service').innerHTML = "Please Enter Item Type";
    document.getElementById('item_type').focus();
    return false;
   }
   
   if(document.getElementById('available_qty').value == '') {
    document.getElementById('error_service').style.display ="block";
    document.getElementById('error_service').innerHTML = "Please Enter Available Quantity";
    document.getElementById('available_qty').focus();
    return false;
   }
   
   if(document.getElementById('processed_qty').value == '') {
    document.getElementById('error_service').style.display ="block";
    document.getElementById('error_service').innerHTML = "Please Enter Processed Quantity";
    document.getElementById('processed_qty').focus();
    return false;
   }
   
   if(document.getElementById('balance_qty').value == '') {
    document.getElementById('error_service').style.display ="block";
    document.getElementById('error_service').innerHTML = "Please Enter Balance Quantity";
    document.getElementById('balance_qty').focus();
    return false;
   }
	
	var item_name = document.getElementById('item_name').value;
	var item_type = document.getElementById('item_type').value;
	var available_qty = document.getElementById('available_qty').value;
	var processed_qty = document.getElementById('processed_qty').value;
	var balance_qty = document.getElementById('balance_qty').value;
	
	
	var pars = 'item_name=' + item_name + '&item_type=' + item_type + '&available_qty=' + available_qty  + '&processed_qty=' + processed_qty  + '&balance_qty=' + balance_qty ;
	alert(pars);
        var url  = 'stock_process.php';
		var myAjax = new Ajax.Updater(
        url, {
            method: 'post',
            evalScripts: true,
            parameters: pars,
            oncomplete : function (req) {
	

             				
				//alert(vendorListResult);
            }

 });
	window.close();
	
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
    
    
    function getpurchasereport()
{
   $.ajax({
      type:'POST',
      url:'purchase_report.php',
      data:'',
      success: function(result){              
               $("#divmiddlecontent").html(result);
      }
      }); 
}


function getPurchaseList() {	  
   
   
   if(document.getElementById('main_menu_id').value == '') {
    document.getElementById('error_service').style.display ="block";
    document.getElementById('error_service').innerHTML = "Please Select Vendor Name";
    document.getElementById('main_menu_id').focus();
    return false;
   }
   
   if(document.getElementById('ddDateFrom').value == '') {
    document.getElementById('error_service').style.display ="block";
    document.getElementById('error_service').innerHTML = "Please Select From Date";
    document.getElementById('ddDateFrom').focus();
    return false;
   }
   
   if(document.getElementById('ddDateTo').value == '') {
    document.getElementById('error_service').style.display ="block";
    document.getElementById('error_service').innerHTML = "Please Select To Date";
    document.getElementById('ddDateTo').focus();
    return false;
   }
            
	document.getElementById('error_service').style.display ="none";
          
        var main_menu_id = document.getElementById('main_menu_id').value;
	var ddDateFrom = document.getElementById('ddDateFrom').value;
	var ddDateTo = document.getElementById('ddDateTo').value;
        
  
var data ='main_menu_id=' + main_menu_id +'&ddDateFrom=' + ddDateFrom+ '&ddDateTo=' + ddDateTo ;
	//alert(pars);
      $.ajax({
      type:'POST',
      url:'purchase_list.php',
      data: data,
      success: function(result){   	    
               $("#vendorListResult").html(result);
			   //  alert(vendorListResult);       
      }
      }); 
}
	 
function getPurchaseListView(vendor_name,from,to)
{
    var x,y;
    x = 700;
    y = 520;
    var url_is = 'purchase_list_view.php?vendor_name='+ vendor_name + '&from=' + from + '&to=' + to;
    window.open(url_is,this.target,'width='+x+',height='+y+',left=5,top=5,scrollbars=1,  resizable=yes'); 
}


function getPurchaseView(pur_id)
{
    var x,y;
    x = 700;
    y = 520;
    var url_is = 'purchase_view.php?pur_id=' + pur_id;
    window.open(url_is,this.target,'width='+x+',height='+y+',left=5,top=5,scrollbars=1,  resizable=yes'); 
}