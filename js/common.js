var nbsp = 160;    // non-breaking space char
var node_text = 3; // DOM text node-type
var emptyString = /^\s*$/
var glb_vfld;      // retain vfld for timer thread

// -----------------------------------------
//                  trim
// Trim leading/trailing whitespace off string
// -----------------------------------------

function trim(str)
{
  return str.replace(/^\s+|\s+$/g, '')
};


// -----------------------------------------
//                  setfocus
// Delayed focus setting to get around IE bug
// -----------------------------------------

function setFocusDelayed()
{
  glb_vfld.focus()
}

function setfocus(vfld)
{
  // save vfld in global variable so value retained when routine exits
  glb_vfld = vfld;
  setTimeout( 'setFocusDelayed()', 100 );
}


// -----------------------------------------
//                  msg
// Display warn/error message in HTML element
// commonCheck routine must have previously been called
// -----------------------------------------

function msg(fld,     // id of element to display message in
             msgtype, // class to give element ("warn" or "error")
             message) // string to display
{
  // setting an empty string can give problems if later set to a 
  // non-empty string, so ensure a space present. (For Mozilla and Opera one could 
  // simply use a space, but IE demands something more, like a non-breaking space.)
  var dispmessage;
  if (emptyString.test(message)) 
    dispmessage = String.fromCharCode(nbsp);    
  else  
    dispmessage = message;
  
  var elem = document.getElementById(fld);
  elem.innerHTML = dispmessage;  
  elem.className = msgtype;   // set the CSS class to adjust appearance of message
};

// -----------------------------------------
//            commonCheck
// Common code for all validation routines to:
// (a) check for older / less-equipped browsers
// (b) check if empty fields are required
// Returns true (validation passed), 
//         false (validation failed) or 
//         proceed (don't know yet)
// -----------------------------------------

var proceed = 2;  

function commonCheck    (vfld,   // element to be validated
                         ifld,   // id of element to receive info/error msg
                         reqd)   // true if required
{
  if (!document.getElementById) 
    return true;  // not available on this browser - leave validation to the server
  var elem = document.getElementById(ifld);
   if (emptyString.test(vfld.value)) {
    if (reqd) {
      msg (ifld, "tahoma10rednormal", "ERROR: required");  
      setfocus(vfld);
      return false;
    }
    else {
      msg (ifld, "warn", "");   // OK
      return true;
    }
  }
  return proceed;
}

// -----------------------------------------
//            validatePresent
// Validate if something has been entered
// Returns true if so 
// -----------------------------------------

function validatePresent(vfld,   // element to be validated
                         ifld )  // id of element to receive info/error msg
{

  var stat = commonCheck (vfld, ifld, true);
  if (stat != proceed) return stat;

  msg (ifld, "warn", "");
  return true;
};


function validatePresent2(vfld,   // element to be validated
                         ifld )  // id of element to receive info/error msg
{
	
  document.getElementById('sss').value= vfld.value;
  narasing();
  var stat = commonCheck (vfld, ifld, true);
  if (stat != proceed) return stat;

  msg (ifld, "warn", "");
  return true;
};
// -----------------------------------------
//               validateEmail
// Validate if e-mail address
// Returns true if so (and also if could not be executed because of old browser)
// -----------------------------------------

function validateEmail  (vfld,   // element to be validated
                         ifld,   // id of element to receive info/error msg
                         reqd)   // true if required
{
  var stat = commonCheck (vfld, ifld, reqd);
  if (stat != proceed) return stat;

  var tfld = trim(vfld.value);  // value of field with whitespace trimmed off
  //var email = /^[^@]+@[^@.]+\.[^@]*\w\w$/
  var email = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i

  if (!email.test(tfld)) {
    msg (ifld, "tahoma10rednormal", "ERROR: not a valid e-mail address");
    setfocus(vfld);
    return false;
  }

  var email2 = /^[A-Za-z][\w.-]+@\w[\w.-]+\.[\w.-]*[A-Za-z][A-Za-z]$/
  //var email2 = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i
  if (!email2.test(tfld)) 
    msg (ifld, "tahoma10rednormal", "Unusual e-mail address - check if correct");
  else
    msg (ifld, "warn", "");
  return true;
};

var testresults;
function checkemail(str) {
    var filter=/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i

    if (filter.test(str))
        testresults=true
    else{
         testresults=false
    }
    return (testresults)
}

// -----------------------------------------
//               validateWebsite
// Validate if e-mail address
// Returns true if so (and also if could not be executed because of old browser)
// -----------------------------------------

function validateWebsite  (vfld,   // element to be validated
                         ifld,   // id of element to receive info/error msg
                         reqd)   // true if required
{
 var stat = commonCheck (vfld, ifld, reqd);
    if (stat != proceed) return stat;
    var tfld = trim(vfld.value);  // value of field with whitespace trimmed off
    var website = /^(((h|H?)(t|T?)(t|T?)(p|P?)(s|S?))\:\/\/)?(www.|[a-zA-Z0-9].)[a-zA-Z0-9\-\.]+\.[a-zA-Z]*[\/]*$/  //expression accepts any URL with or without http/https
 //var website =/https?:\/\/([-\w\.]+)+(:\d+)?(\/([\w/_\.]*(\?\S+)?)?)?/;
 if (!website.test(tfld)) { 
        msg (ifld, "tahoma10rednormal", "Unusual url path - check if correct");
        return false;
 } else {
       msg (ifld, "tahoma10rednormal", "");
       return true;
 }
}
function validateUrlPath(vfld,   // element to be validated
                         ifld,   // id of element to receive info/error msg
                         reqd)   // true if required
{
 var stat = commonCheck (vfld, ifld, reqd);
    if (stat != proceed) return stat;
    var tfld = trim(vfld.value);  // value of field with whitespace trimmed off
    var website = /^(((h|H?)(t|T?)(t|T?)(p|P?)(s|S?))\:\/\/)?(www.|[a-zA-Z0-9].)[a-zA-Z0-9\-\.]+\.[a-zA-Z]*([\/]*[a-zA-Z0-9\.\_\?\&\/\~]*)*$/  //expression accepts any URL with or without http/https
 //var website =/https?:\/\/([-\w\.]+)+(:\d+)?(\/([\w/_\.]*(\?\S+)?)?)?/;
 if (!website.test(tfld)) { 
        msg (ifld, "tahoma10rednormal", "Unusual url path - check if correct");
        return false;
 } else {
       msg (ifld, "tahoma10rednormal", "");
       return true;
 }
}

function validateDate(obj, type, ifld) {
    eval ("var dtStr = obj." + type + "_month[obj." + type + "_month.selectedIndex].value");
    dtStr += "/";
    eval ("dtStr += obj." + type + "_day[obj." + type + "_day.selectedIndex].value");
    dtStr += "/";
    eval ("dtStr += obj." + type + "_year[obj." + type + "_year.selectedIndex].value");
 
    if (!isDate(dtStr)) { 
        msg (ifld, "tahoma10rednormal", "ERROR: not a valid date, please check");
        return false;
    } else { 
        msg (ifld, "tahoma10rednormal", "");
        return true;
    }
}

function compareDates(obj, from, to, ifld) {
    
    eval ("var from_sec_element= obj." + from + "_second"); 
    if (from_sec_element.type=="hidden")  var from_seconds = from_sec_element.value;
    else eval ("var from_seconds = obj." + from + "_second[obj." + from + "_second.selectedIndex].value");

    eval ("var to_sec_element= obj." + to + "_second"); 
    if (to_sec_element.type=="hidden")  var to_seconds = to_sec_element.value;
    else eval ("var to_seconds = obj." + to + "_second[obj." + to + "_second.selectedIndex].value");

    // eval ("var fromDate = new Date(obj." + from + "_year[obj." + from + "_year.selectedIndex].value,(obj." + from + "_month[obj." + from + "_month.selectedIndex].value - 1),obj." + from + "_day[obj." + from + "_day.selectedIndex].value, obj." + from + "_hour[obj." + from + "_hour.selectedIndex].value, obj." + from + "_minute[obj." + from + "_minute.selectedIndex].value, obj." + from + "_second[obj." + from + "_second.selectedIndex].value)");
    // eval ("var toDate = new Date(obj." + to + "_year[obj." + to + "_year.selectedIndex].value,(obj." + to + "_month[obj." + to + "_month.selectedIndex].value - 1),obj." + to + "_day[obj." + to + "_day.selectedIndex].value, obj." + to + "_hour[obj." + to + "_hour.selectedIndex].value, obj." + to + "_minute[obj." + to + "_minute.selectedIndex].value, obj." + to + "_second[obj." + to + "_second.selectedIndex].value)");
    eval ("var fromDate = new Date(obj." + from + "_year[obj." + from + "_year.selectedIndex].value,(obj." + from + "_month[obj." + from + "_month.selectedIndex].value - 1),obj." + from + "_day[obj." + from + "_day.selectedIndex].value, obj." + from + "_hour[obj." + from + "_hour.selectedIndex].value, obj." + from + "_minute[obj." + from + "_minute.selectedIndex].value, " + from_seconds +")");
    eval ("var toDate = new Date(obj." + to + "_year[obj." + to + "_year.selectedIndex].value,(obj." + to + "_month[obj." + to + "_month.selectedIndex].value - 1),obj." + to + "_day[obj." + to + "_day.selectedIndex].value, obj." + to + "_hour[obj." + to + "_hour.selectedIndex].value, obj." + to + "_minute[obj." + to + "_minute.selectedIndex].value, " + to_seconds + ")");
    
    if (toDate.getTime() < fromDate.getTime()) {
        msg (ifld, "tahoma10rednormal", "ERROR: " + to + " date has to be greater than or equal to " + from + " date, please check");
        return false;
    } else {
        msg (ifld, "tahoma10rednormal", "");
        return true;
    }
    
}

function compareOnlyDates(obj, from, to, ifld) { 
    eval ("var fromDate = new Date(obj." + from + "_year[obj." + from + "_year.selectedIndex].value,(obj." + from + "_month[obj." + from + "_month.selectedIndex].value - 1),obj." + from + "_day[obj." + from + "_day.selectedIndex].value)");
    eval ("var toDate = new Date(obj." + to + "_year[obj." + to + "_year.selectedIndex].value,(obj." + to + "_month[obj." + to + "_month.selectedIndex].value - 1),obj." + to + "_day[obj." + to + "_day.selectedIndex].value)");
 
 if (toDate.getTime() < fromDate.getTime()) { 
        msg (ifld, "tahoma10rednormal", "ERROR: " + to + " date has to be greater than or equal to " + from + " date, please check");
        return false;
    } else {
        msg (ifld, "tahoma10rednormal", "");
        return true;
    }
}


function validateFileExtension (obj, ifld) {

 if (!obj.value.match(/(.gif|.png|.jpg|.jpeg|.swf)$/i)) {
   msg (ifld, "tahoma10rednormal", "Invalid image format");
      //obj.photo_name.focus();
     return false;
   } else {
    msg (ifld, "tahoma10rednormal", "");
    return true;
   }
}

function validateImageSwfFileExtension (obj, ifld) {

 if (!obj.value.match(/(.gif|.png|.jpg|.jpeg|.swf)$/i)) {
   msg (ifld, "tahoma10rednormal", "Invalid image format");
      //obj.photo_name.focus();
     return false;
   } else {
    msg (ifld, "tahoma10rednormal", "");
    return true;
   }
}


function validatePdfExtension (obj, ifld) {

  if (!obj.value.match(/(.pdf)$/i)){//|.swf
     // = extensions example
   msg (ifld, "tahoma10rednormal", "Invalid file format");
      obj.focus();
     return false;
   } else {
    msg (ifld, "tahoma10rednormal", "");
    return true;
   }
}

// this is for combo box control
function commonComboCheck    (vfld,   // element to be validated
                         ifld,   // id of element to receive info/error msg
                         reqd)   // true if required
{
  if (!document.getElementById)
    return true;  // not available on this browser - leave validation to the server
    var elem = document.getElementById(ifld);

  if (emptyString.test(vfld.options[vfld.selectedIndex].value)) {
    if (reqd) {
      msg (ifld, "tahoma10rednormal", "ERROR: required");
      setfocus(vfld);
      return false;
    }
    else {
      msg (ifld, "warn", "");   // OK
      return true;
    }
  }
  return proceed;
}

function emptyComboBox(comboboxid) {
     var combo_obj = document.getElementById(comboboxid);
  if(combo_obj.options) {
  var combo_len =  combo_obj.options.length;
        if (combo_len > 0 ) {
            for (j=(combo_len-1); j>=0;j--) {
                combo_obj.remove(j);
            }
        }
  }  
}
/* multiple deletes ----------------------------------------- */
function toggle_all_box(obj, flag)
{
 if(obj.elements.length>0) {
  for(i=0;i<obj.elements.length;i++) {
   if(obj.elements[i].type=="checkbox") {
                obj.elements[i].checked = flag;
   }
  }
 } 
}

function is_all_box(obj, flag, main_box)
{
 if(obj.elements.length>0) {
  for(i=0;i<obj.elements.length;i++) {
   if(obj.elements[i].type=="checkbox" && obj.elements[i].name!=main_box) {
    if(obj.elements[i].checked!=flag) {
                    return false;
       }
   }
  }
 }
 return true;
}

function change_box_stat(obj, main_box)
{
 document.getElementById(main_box).checked = ( is_all_box(obj, true, main_box) ? true : false ); 
}
function set_button_stat(obj, main_box, btnobj) {
    if(is_all_box(obj, false, main_box)) {
  btnobj.disabled = true;
 } else {
  btnobj.disabled = false;
 }
}
// Some Class  for fck editor
function FCKClass()
{
        this.UpdateEditorFormValue = function()
        {
                for ( i = 0; i < parent.frames.length; ++i ) {
                        if ( parent.frames[i].FCK )
                                parent.frames[i].FCK.UpdateLinkedField();
    }
        }
}

function remSpecial($str){
	$string	 	= 	strtolower(stripslashes($str));
	$special 	=	array("/","!","&","*",",","!","~","@","#","$","%","^","(",")","+","=","_","'","`","|",":"); 
	$dash		=	array('----','---','--');
	$spaceStr	=	str_replace($special,' ',$string);
	$dashStr	=	str_replace(' ','-',$spaceStr);
	$outStr		=	str_replace($dash,'-',$dashStr);
	return $outStr;
}
/* ---------------------------------------------------------- */
//Type Number Only//
function numbersonly(e){
 //alert(e);
var unicode=e.charCode? e.charCode : e.keyCode
if (unicode!=8){ //if the key isn't the backspace key (which we should allow)
if (unicode<48||unicode>57) //if not a number
return false //disable key press
}
}
//end//

function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode
    
	if (charCode > 31 && (charCode < 48 || charCode > 57)) return false;

	return true;
}
$(document).ready(function(){
	


    // /** Item Name Auto suggestion with scroll **/
    // $(document).on('keydown', '#search-box', function (e) {
        // if ($('#search_suggestion_holder').is(':visible')) {
            // var menu = $('#search_suggestion_holder');                        
            // var active = menu.find('.selected');                        
            // var height = active.outerHeight(); //Height of <li>   
            // var top = menu.scrollTop(); //Current top of scroll window
            // var menuHeight = menu[0].scrollHeight; //Full height of <ul>
// 
            // //Up
            // if (e.keyCode == 38) {
                // if (top != 0) {
                    // //All but top item goes up
                    // menu.scrollTop(top - height);
                // } else {
                    // //Top item - go to bottom of menu
                    // menu.scrollTop(menuHeight + height);
                // }
            // }
//             
            // //Down
            // if (e.keyCode == 40) {
                // //window.alert(menuHeight - height);
                // var nextHeight = top + height; //Next scrollTop height
                // var maxHeight = menuHeight - height; //Max scrollTop height
// 
                // if (nextHeight <= maxHeight) {                    
                    // //All but bottom item goes down
                    // menu.scrollTop(top + height);
                // } else {
                    // //Bottom item - go to top of menu                    
                    // menu.scrollTop(0);
                // }
            // }
        // }
    // });

    

  $(document).on('change','#ordertype',function(){
    	var value = $(this).val();
    	if(value =='parcel'){
    		$('#itemcode').focus();
    	}
    });
    
 $(document).on('change','#lunch,#snacks,#dinner,#endofday',function(){
       if($(this).is(':checked')){
          var session = $(this).val();
            $.ajax({
              type: 'POST',
              url: 'sms_sending.php',
              data: {'session':session},
              dataType:'json',
              success: function(data) {
                status = true;
                if (data == ''){
                  status = '';
                }
                $.each(data, function(i){
                  if(data[i].status == "open")  
                    status = false;
                });
                  if(status == "true"){
                      var d = new Date();
                      var month = new Array();
                      month[0] = "Jan";
                      month[1] = "Feb";
                      month[2] = "Mar";
                      month[3] = "Apr";
                      month[4] = "May";
                      month[5] = "Jun";
                      month[6] = "Jul";
                      month[7] = "Aug";
                      month[8] = "Sep";
                      month[9] = "Oct";
                      month[10] = "Nov";
                      month[11] = "Dec";
                      var n = month[d.getMonth()];
                      var lenth = data.length;
                      var date = data[0].orde_close_date;
                      var spilted_date = date.split('-');
                      var combined_date = spilted_date[2]+n+spilted_date[0];
                      var no_of_bils = data[0].bill_id +'to'+data[lenth-1].bill_id;
                      var amount = 0.00;
                      $.each(data, function(i){
                        amount += parseFloat(data[i].total_amount);
                      });
                      if(session.toLowerCase() == 'l'){
                          var sess = 'Breakfast';
                          var message = sess+'\nDate :'+combined_date+';\nNo of bills:'+no_of_bils+';\nAmount Collection : Rs'+amount;
                      //    $.ajax({
                       //       type: 'GET',
                          // url: 'http://bulksms.blackholesolution.com/app/smsapi/index.php',
                          // data: {'key':'55113155e7e2c','type':'text','contacts':'9786243021','senderid':'VNSPDY','msg':message},
                       //     success: function(data) {
                              
                       //     }
                       //   });
                          alert(message);
                          alert("Breakfast Session has been Closed!!! SMS Sent Successfully!");
                      }else if(session.toLowerCase() == 's'){
                          var sess = 'Lunch';
                          var message = sess+'\nDate :'+combined_date+';\nNo of bills:'+no_of_bils+';\nAmount Collection : Rs'+amount;
                      //    $.ajax({
                       //       type: 'GET',
                          // url: 'http://bulksms.blackholesolution.com/app/smsapi/index.php',
                          // data: {'key':'55113155e7e2c','type':'text','contacts':'9786243021','senderid':'VNSPDY','msg':message},
                       //     success: function(data) {
                              
                       //     }
                       //   });
                          alert(message);
                          alert("Lunch Session has been Closed!!! SMS Sent Successfully!");
                      }
                      else if(session.toLowerCase() == 'd'){
                          var sess = 'Snacks';
                          var message = sess+'\nDate :'+combined_date+';\nNo of bills:'+no_of_bils+';\nAmount Collection : Rs'+amount;
                      //    $.ajax({
                       //       type: 'GET',
                          // url: 'http://bulksms.blackholesolution.com/app/smsapi/index.php',
                          // data: {'key':'55113155e7e2c','type':'text','contacts':'9786243021','senderid':'VNSPDY','msg':message},
                       //     success: function(data) {
                              
                       //     }
                       //   });
                          alert(message);
                          alert("Snacks Session has been Closed!!! SMS Sent Successfully!");
                      }else if(session.toLowerCase() == 'e'){
                         var sess = 'Dinner';
                         var message = sess+'\nDate :'+combined_date+';\nNo of bills:'+no_of_bils+';\nAmount Collection : Rs'+amount;
                         alert(message);
                         alert("Dinner Session has been Closed!!! SMS Sent Successfully!");

                      }
                }
                else if(status == "false"){
                    alert("Please close all the bills");
                }
                else if(status == ''){
                    alert("Not Yet created the bill for this session");
                }
          }
         });
       }
  });
  
  // short cut keys for restratunt billing
        $(window).keydown(function(event) {
        	//alert(event.which);
            if (event.ctrlKey && (event.which == 75)) { // ctrl + k = generate bill
                var ordertype = $("#ordertype").val();
            var cartid = $("#order_cart_id").val();
            var cart_id = cartid;
            var tableno = $('.gettableid:checked').map(function() {
                return this.value;
            }).get().join(',');
            var chairs = $('.chairs:checked').map(function() {
                return this.value;
            }).get().join(',');
            $.ajax({
                type: 'POST',
                url: 'checking.php',
                data: 'action=checkgen&cartid=' + cartid,
                success: function(data) {
                    if (data == '0') {
                        // var x,y;
                        // x = 900;
                        // y = 700;
                        //var url_is = "separatebill.php?action=deptbill&tableno="+tableno+"&chairs="+chairs+"&ordertype="+ordertype+"&cartid="+cartid+'&cart_id='+cart_id;
                        //window.open(url_is,this.target,'width='+x+',height='+y+',left=5,top=5,scrollbars=1,resizable=yes');
                        $.ajax({
                            type: 'POST',
                            url: 'separatebill.php',
                            data: 'action=deptbill&tableno=' + tableno + '&chairs=' + chairs + '&ordertype=' + ordertype + '&cartid=' + cartid + '&cart_id=' + cart_id,
                            success: function(data) {


                            }
                        });
                        $.ajax({
                            type: 'POST',
                            url: 'checking.php',
                            data: 'action=update&depart=1&cartid=' + cartid,
                            success: function(data) {


                            }
                        });

                    } else
                        alert("Order Entry Generated");
                }
            });
                event.preventDefault();
            }
            if (event.ctrlKey && (event.which == 72)) { // ctrl + h  = hold
                var ordertype = $("#ordertype").val();
	            var cartid = $("#order_cart_id").val();
	            var billid = $("#order_bill_id").val();
	            var accountsession = $('input[name="accountsession"]:checked').val();
	            var tableno = $('.gettableid:checked').map(function() {
	                return this.value;
	            }).get().join(',');
	            var chairs = $('.chairs:checked').map(function() {
	                return this.value;
	            }).get().join(',');
	            var sup_name = $('#suppliers').val();
	
	            $.ajax({
	                type: 'POST',
	                url: 'checking.php',
	                data: 'action=checkgen&cartid=' + cartid,
	                success: function(data) {
	                    if (data == '1') {
	                        Save_bill(chairs, sup_name, cartid, billid, ordertype, accountsession, '');
	                        $('#tableid').val('');
	                        $('#suppliers').val('');
	                        $('#noofpersons').val('');
	                        
	                        $('.getcategory').prop("checked", false);
	                        
	                        $('#ordertype').focus();
	                        
	                    } else
	                        alert("Please Generate the Order Entry");
	                }
	            });
                event.preventDefault();
            }
            if (event.ctrlKey && (event.keyCode == 80)) { // ctrl + p = print and close
                var ordertype = $("#ordertype").val();
	            var cartid = $("#order_cart_id").val();
	            var billid = $("#order_bill_id").val();
	            var sup_name = $("#suppliers").val();
	            var accountsession = $('input[name="accountsession"]:checked').val();
	            var tableno = $('.gettableid:checked').map(function() {
	                return this.value;
	            }).get().join(',');
	            var chairs = $('.chairs:checked').map(function() {
	                return this.value;
	            }).get().join(',');
	            $.ajax({
	                type: 'POST',
	                url: 'checking.php',
	                data: 'action=checkgen&cartid=' + cartid,
	                success: function(data) {
	                    if (data == '1'){
	                    	Save_bill(chairs, sup_name, cartid, billid, ordertype, accountsession, 1);
	                    }
	                        
	                    else{
	                    	alert("Please Generate the Order Entry");
	                    }
	                        
	                }
	            });
                event.preventDefault();
            }
            if (event.ctrlKey && (event.which == 67)) { // ctrl + c = Cancel bill
                $('#bill_cancel_cmt').click();
                event.preventDefault();
            }
            if (event.ctrlKey && (event.which == 78)) { // ctrl + n = No cash amount
                $('#nocashamt').click();
                event.preventDefault();
            }
            if (event.ctrlKey && (event.which == 81)) { // ctrl + q = Cancel quantity
               	$('.cquantity:first').focus().select();
                event.preventDefault();
            }
            if (event.ctrlKey && (event.which == 73)) { // ctrl + i = Cancel item
               	$('.classchk:first').focus().select();
                event.preventDefault();
            }
            if (event.ctrlKey && (event.which == 90)) { // ctrl + Z= Cancel item
               	var fields = $("input[name='checkbox[]']:checked").serializeArray();
               	
	            if (fields.length == 0) {
	                alert('Please Select the Item for Cancel');
	                return false;
	            }
	
	            var ordertype = $("#ordertype").val();
	            var cartid = $("#order_cart_id").val();
	            var tableno = $('.gettableid:checked').map(function() {
	                return this.value;
	            }).get().join(',');
	            var chairs = $('.chairs:checked').map(function() {
	                return this.value;
	            }).get().join(',');
	            cancelitems();
	            var chkitems = $("input[name='checkbox[]']:checked").map(function() {
	                return Number(this.value);
	            }).get();
	            var editstatus = $("#editstatus").val();
	            var x, y;
	            x = 900;
	            y = 700;
	            // var url_is = "separatebill.php?action=cancelitem&tableno=" + tableno + "&ordertype=" + ordertype + "&chairs=" + chairs + "&cartid=" + cartid + "&chkitems=" + chkitems + '&editstatus=' + editstatus;
	            // window.open(url_is, this.target, 'width=' + x + ',height=' + y + ',left=5,top=5,scrollbars=1,resizable=yes');
	            $.ajax({
                    type: 'POST',
                    url: 'separatebill.php',
                    data: 'action=cancelitem&tableno='+tableno+'&ordertype='+ordertype+'&chairs='+chairs+'&cartid='+cartid+'&chkitems='+chkitems+'&editstatus='+editstatus,
                    success: function(data){
                    }
                });
                event.preventDefault();
            }
        });

});
