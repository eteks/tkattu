
function getCancelBill() { 
   $.ajax({
      type:'POST',
      url:'Cancel_bill_report.php',
      data:'',
      success: function(result){              
               $("#divmiddlecontent").html(result); 
      }
      });
 
}



function getCancelbillList() {	  
   
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
          
        //var Tax = document.getElementById('tax').value;
	var ddDateFrom = document.getElementById('ddDateFrom').value;
	var ddDateTo = document.getElementById('ddDateTo').value;
        
  
var data ='ddDateFrom=' + ddDateFrom+ '&ddDateTo=' + ddDateTo ;
	//alert(pars);
      $.ajax({
      type:'POST',
      url:'cancel_bill.php',
      data: data,
      success: function(result){   	    
               $("#vendorListResult").html(result);
			   //  alert(vendorListResult);       
      }
      }); 
}


function getcancelListView(from,to)
{
    var x,y;
    x = 700;
    y = 520;
    var url_is = 'Cancel_bill_list.php?from=' + from + '&to=' + to+ ' &open=' + 'cancel_pdf' + '&action=' + 'cancel_print';
    window.open(url_is,this.target,'width='+x+',height='+y+',left=5,top=5,scrollbars=1, resizable=yes');
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



function getPendingBillList() {	  
   
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
          
        //var Tax = document.getElementById('tax').value;
	var ddDateFrom = document.getElementById('ddDateFrom').value;
	var ddDateTo = document.getElementById('ddDateTo').value;
        
  
var data ='ddDateFrom=' + ddDateFrom+ '&ddDateTo=' + ddDateTo ;
	//alert(pars);
      $.ajax({
      type:'POST',
      url:'pending_bill.php',
      data: data,
      success: function(result){   	    
               $("#vendorListResult").html(result);
			   //  alert(vendorListResult);       
      }
      }); 
}

function getpendingListView(from,to)
{
    var x,y;
    x = 700;
    y = 520;
    var url_is = 'pending_bill_list.php?from=' + from + '&to=' + to+ ' &open=' + 'pending_pdf' + '&action=' + 'pending_print';
    window.open(url_is,this.target,'width='+x+',height='+y+',left=5,top=5,scrollbars=1,  resizable=yes');
}

function getReopenList(bill_id,status)
{
var x,y;
    x = 700;
    y = 520;
    var url_is = 'Reopen_bill.php?bill_id=' + bill_id + '&status=' + status;
    window.open(url_is,this.target,'width='+x+',height='+y+',left=5,top=5,scrollbars=1, resizable=yes');
}


function getTotalSales() {
   $.ajax({
      type:'POST',
      url:'total_sales.php',
      data:'',
      success: function(result){              
               $("#divmiddlecontent").html(result);
      }
      });
 
}

function getTableSales() {
   $.ajax({
      type:'POST',
      url:'table_sales.php',
      data:'',
      success: function(result){              
               $("#divmiddlecontent").html(result);
      }
      });
 
}
function getParcelSales() {
   $.ajax({
      type:'POST',
      url:'parcel_sales.php',
      data:'',
      success: function(result){              
               $("#divmiddlecontent").html(result);
      }
      });
 
}
function getItemSales() { 
   $.ajax({
      type:'POST',
      url:'item_sales.php',
      data:'',
      success: function(result){              
               $("#divmiddlecontent").html(result); 
      }
      }); 
}

function getTaxreport()
{
   $.ajax({
      type:'POST',
      url:'tax_report.php',
      data:'',
      success: function(result){              
               $("#divmiddlecontent").html(result);
      }
      }); 
}

function gettotalsales(action) {     
	
if(document.getElementById('ddDateFrom').value == '') {
    document.getElementById('error_service').style.display ="block";
    document.getElementById('error_service').innerHTML = "Please Select the From Date";
    document.getElementById('ddDateFrom').focus();
    return false;
   }

if(document.getElementById('ddDateTo').value == '') {
    document.getElementById('error_service').style.display ="block";
    document.getElementById('error_service').innerHTML = "Please Select the To Date";
    document.getElementById('ddDateTo').focus();
    return false;
   }   
   
 var ddDateFrom      = document.getElementById("ddDateFrom").value; 
 var ddDateTo      = document.getElementById("ddDateTo").value; 
 
 $.ajax({
      type:'POST',  
      url:'total_sales.php',
      data:'action=' + action + '&ddDateFrom=' + ddDateFrom+ '&ddDateTo=' + ddDateTo,
      success: function(result){    
               $("#divmiddlecontent").html(result);
			  
      } 
      }); 
} 




function gettotalsalesview(fromdd,todd) { 

    var x,y;

    x = 720;

    y = 425;

    var url_is = 'total_sales_print.php?fromdd='+ fromdd + '&todd=' + todd;
//alert(url_is);
    window.open(url_is,this.target,'width='+x+',height='+y+',left=5,top=5,scrollbars=1,  resizable=yes');

}
function gettablesales(action) {     

if(tableid.selectedIndex==0){
		alert("please select the table");
		tableid.focus();
		return false;
	}
	
if(document.getElementById('ddDateFrom').value == '') {
    document.getElementById('error_service').style.display ="block";
    document.getElementById('error_service').innerHTML = "Please Select the From Date";
    document.getElementById('ddDateFrom').focus();
    return false;
   }

if(document.getElementById('ddDateTo').value == '') {
    document.getElementById('error_service').style.display ="block";
    document.getElementById('error_service').innerHTML = "Please Select the To Date";
    document.getElementById('ddDateTo').focus();
    return false;
   }   
   
   document.getElementById('error_service').style.display ="none";
   
 var ddDateFrom      = document.getElementById("ddDateFrom").value; 
 var ddDateTo      = document.getElementById("ddDateTo").value; 
  var table      = document.getElementById("tableid").value; 
  //alert(table);
  
      if(table !="0" && ddDateFrom !="" && ddDateTo !="")
    {
            document.getElementById('error_service').style.display ="none";
    }

  
 $.ajax({
      type:'POST',  
      url:'table_sales.php',
      data:'action=' + action + '&ddDateFrom=' + ddDateFrom+ '&ddDateTo=' + ddDateTo+ '&table=' + table,
      success: function(result){    
               $("#divmiddlecontent").html(result);
			  
      } 
      }); 
} 
function gettablesalesview(tableid,fromdd,todd) { 

    var x,y;
    x = 720;
    y = 425;

    var url_is = 'table_sales_print.php?fromdd='+ fromdd + '&todd=' + todd+ '&tableid=' + tableid;
//alert(url_is);
    window.open(url_is,this.target,'width='+x+',height='+y+',left=5,top=5,scrollbars=1, resizable=yes');

}

function getparcelsalesview(fromdd,todd) { 

    var x,y;
    x = 720;
    y = 425;

    var url_is = 'parcel_sales_print.php?fromdd='+ fromdd + '&todd=' + todd;
//alert(url_is);
    window.open(url_is,this.target,'width='+x+',height='+y+',left=5,top=5,scrollbars=1, resizable=yes');

}

function getparcelsales(action) {     


if(document.getElementById('ddDateFrom').value == '') {
    document.getElementById('error_service').style.display ="block";
    document.getElementById('error_service').innerHTML = "Please Select the From Date";
    document.getElementById('ddDateFrom').focus();
    return false;
   }

if(document.getElementById('ddDateTo').value == '') {
    document.getElementById('error_service').style.display ="block";
    document.getElementById('error_service').innerHTML = "Please Select the To Date";
    document.getElementById('ddDateTo').focus();
    return false;
   }   
   
   document.getElementById('error_service').style.display ="none";
   
 var ddDateFrom      = document.getElementById("ddDateFrom").value; 
 var ddDateTo      = document.getElementById("ddDateTo").value; 

  
      if(ddDateFrom !="" && ddDateTo !="")
    {
            document.getElementById('error_service').style.display ="none";
    }

  
 $.ajax({
      type:'POST',  
      url:'parcel_sales.php',
      data:'action=' + action + '&ddDateFrom=' + ddDateFrom+ '&ddDateTo=' + ddDateTo,
      success: function(result){    
               $("#divmiddlecontent").html(result);
			  
      } 
      }); 
} 




function getTaxStockList() {	  
   
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
          
        //var Tax = document.getElementById('tax').value;
	var ddDateFrom = document.getElementById('ddDateFrom').value;
	var ddDateTo = document.getElementById('ddDateTo').value;
        
  
var data ='ddDateFrom=' + ddDateFrom+ '&ddDateTo=' + ddDateTo ;
	//alert(pars);
      $.ajax({
      type:'POST',
      url:'tax_list.php',
      data: data,
      success: function(result){   	    
               $("#vendorListResult").html(result);
			   //  alert(vendorListResult);       
      }
      }); 
}
	 



function getsalesListView(from,to)
{
    var x,y;
    x = 700;
    y = 520;
    var url_is = 'total_sales_list.php?from=' + from + '&to=' + to;
    window.open(url_is,this.target,'width='+x+',height='+y+',left=5,top=5,scrollbars=1,resizable=yes');
}

function ex_export(from,to)
{
    var url_is = 'downloadXls_online.php?from=' + from + '&to=' + to;
    window.open(url_is,this.target,'width='+x+',height='+y+',left=5,top=5,scrollbars=1,resizable=yes');
}


function getItemList() {
	
    if(document.getElementById('main_menu_id').value == '') {
    document.getElementById('error_service').style.display ="block";
    document.getElementById('error_service').innerHTML = "Please Select Item Name";
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
        //alert(main_menu_id);
	var ddDateFrom = document.getElementById('ddDateFrom').value;
       //alert(ddDateFrom);
	var ddDateTo = document.getElementById('ddDateTo').value;
        //alert(ddDateTo);


    if(main_menu_id !="0" && ddDateFrom !="" && ddDateTo !="")
    {
            document.getElementById('error_service').style.display ="none";
    }

var data = 'main_menu_id=' + main_menu_id + '&ddDateFrom=' + ddDateFrom+ '&ddDateTo=' + ddDateTo ;
	//alert(pars);
      $.ajax({
      type:'POST',
      url:'item_list.php',
      data: data,
      success: function(result){   
	    
               $("#vendorListResult").html(result);
			   //  alert(vendorListResult);       
      }
      }); 
}


function getItemListView(item_name, from,to)
{
	var x,y;
    x = 800;
    y = 650;

    var url_is = 'item_list_view.php?item_name='+ item_name + '&from=' + from + '&to=' + to;
//alert(url_is);
    window.open(url_is,this.target,'width='+x+',height='+y+',left=5,top=5,scrollbars=1,  resizable=yes');
}

function gettaxListView(from,to)
{
    var x,y;
    x = 700;
    y = 520;
    var url_is = 'tax_list_view.php?from=' + from + '&to=' + to;
    window.open(url_is,this.target,'width='+x+',height='+y+',left=5,top=5,scrollbars=1,  resizable=yes'); 
}


