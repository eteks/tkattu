//bar Bill


function getRestaurantBill() { 
       
     $.ajax({
      type:'POST',
      url:'restaurantBill.php',
      data:'',
      success: function(result){              
               $("#divmiddlecontent").html(result);
      }
      });
 
}

function getBarBillView(action) {    
	
if(document.getElementById('sel_bill').value == '') {
    document.getElementById('error_service').style.display ="block";
    document.getElementById('error_service').innerHTML = "Please Enter Bill Number";
    document.getElementById('sel_bill').focus();
    return false;
   }
else if($("#ddDateFrom").val()=='')
{
    document.getElementById('error_service').style.display ="block";
    document.getElementById('error_service').innerHTML = "Please Select the Date";
    document.getElementById('billdate').focus();
    return false;   
}
 var sel_bill      = document.getElementById("sel_bill").value; 
 var billdate      = $("#ddDateFrom").val();
 
      $.ajax({
      type:'POST',  
      url:'restaurantBill.php',
      data:'action=' + action + '&sel_bill=' + sel_bill+ '&billdate=' + billdate,
      success: function(result){    
               $("#divmiddlecontent").html(result);
			  
      } 
      }); 
 
} 


function getPrintBarList(billId,cartId,tabelid,ncbc) { 

    var x,y;

    x = 720;

    y = 425;
    var url_is;
    if(ncbc==1)
     url_is = 'nocashbillprint.php?billId='+ billId + '&card_id=' + cartId+ '&chairs=' + tabelid;
    else
    url_is = 'Billprint.php?billId='+ billId + '&card_id=' + cartId+ '&table_id=' + tabelid; 

    window.open(url_is,this.target,'width='+x+',height='+y+',left=5,top=5,scrollbars=1, resizable=yes');
   

}




