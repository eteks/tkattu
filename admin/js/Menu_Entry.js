var frm;
function populateHotelInfoManageLists(id, action, value, page) {
   // alert("enter");

    var page = ((typeof page == 'undefined' || page == '' )? '1' : page );
    var glbDivId1 = document.getElementById("hotel_info_records");
    var reqStudUser = new XMLHttpRequest();
    reqStudUser.onreadystatechange = function () {
        if (reqStudUser.readyState == 4) {
            if (reqStudUser.status == 200) {
                glbDivId1.innerHTML = reqStudUser.responseText;
            } else {
                  alert("Error: While trying to process whatever you requested");
            } 
        } 
    } 
    var pars = "page=" + page + "&id=" + id + "&action=" + action + "&value=" + value;
    reqStudUser.open("GET", "Menu_Entry.process.php?" + pars, true);
    reqStudUser.send("");
}

function submitfrmStudentUser(obj) {
    frm = obj;
    var errs=0;
	if(frm.item_code=='"$menu_type_values["item_code"]"'){       
    msg('error_menu_category', "tahoma10rednormal", "already existing item code");
        }
	 if (frm.menu_category.selectedIndex>0) {
        msg('error_menu_category', "tahoma10rednormal", "");
    } else {
        msg ('error_menu_category', "tahoma10rednormal", "ERROR: required");
        errs +=1;
        setfocus(frm.menu_category);
    }
   	
    if (errs==0 && !commonCheck(obj.menu_name,'error_menu_name',true)) errs +=1;
    if (errs==0 && !commonCheck(obj.item_code,'error_item_code',true)) errs +=1;
      //if (errs==0 && !commonCheck(obj.actual_price,'error_actual_price',true)) errs +=1;
        if (errs==0 && !commonCheck(obj.menu_price,'error_menu_price',true)) errs +=1;
	 //if (errs==0 && !commonCheck(obj.menu_name,'error_menu_name',true)) errs +=1;
	 // if (errs==0 && !commonCheck(obj.menu_name,'error_menu_name',true)) errs +=1;
	
	
	if (errs>1)  alert('There are some fields which are required before sending');
    if (errs==1) alert('There is a field which is required before sending');
    if (errs == 0) {
        var reqFaq1 = new XMLHttpRequest();
          reqFaq1.onreadystatechange = function () {
            if (reqFaq1.readyState == 4) {
                  if (reqFaq1.status == 200) { //alert(reqFaq1.responseText);
                      if (reqFaq1.responseText == "1") {

                        if (frm.action.value == "menu_entry_insert") {
                            //alert("enter");
                           alert("Success: Table Entry added successfully");
                        } else {
                            alert("Success: Table Entry updated successfully");
                        }
                        frm.submit();
                      } else { 
                          alert("Error: Duplicate record found");  
                        
                      }
                 } else {
                     //alert(enter);
                      alert("Error: While trying to process whatever you requested");
                 }
              }
         }
         var pars = "id=" + obj.id.value + "&page=" + obj.page.value + "&active=" + obj.active.value + "&action=" + obj.action.value +"&menu_category=" + obj.menu_category.value +  "&menu_price=" + obj.menu_price.value+  "&menu_name=" + obj.menu_name.value+  "&item_code=" + obj.item_code.value+  "&menu_dept=" + obj.menu_dept.value  ;
        
        reqFaq1.open("GET", "Menu_Entry.process.php?" + pars, true);
         reqFaq1.send("");
    }
}

function deleteHmsInfoManageRecord(obj, action, id) {

    if (confirm("WARNING: Are you sure you want to delete this records, if yes, choose OK")) {
        obj.action.value = action;
        obj.id.value = id;
        obj.submit();

    }
}
function deleteSelectedHmsInfoManageRecord(obj, action) {

    if (confirm("WARNING: Are you sure you want to delete selected records, if yes, choose OK")) {

        obj.action.value = action;
        obj.submit();

    }
}

function blockNumbers(e) {  
        
        var key;
        var keychar;
        var reg;
        if(window.event) {
            key = e.keyCode;
        } else if(e.which) {
            key = e.which;
        } else {
            return true;
        }
        keychar = String.fromCharCode(key);
        if ( (key>=48 &&  key<=57) ||  (key==34) || (key==39) || (key==8) || (key==43) || (key==45)) {
            return true;
        } else {
            return false;
        }
}

function blockNumbers_email(e) {  
        
        var key;
        var keychar;
        var reg;
        if(window.event) {
            key = e.keyCode;
        } else if(e.which) {
            key = e.which;
        } else {
            return true;
        }
        keychar = String.fromCharCode(key);
        if ( key >= 32 && key <= 45 || key == 47 || key >=58 &&  key <=63 || key >=91 && key <=94 || key == 96 || key>=123 && key <=127) {
            return false;
        } else {
            return true;
        }
}


function subvalue(a){
//alert(a);
 var data =  'action='+'sub_menu_select'+ '&sub_categ=' + a;
	//alert(data);
	   $.ajax({
      type:'POST',
      url:'submenu.php',
      data: data,
      success: function(result){              
 // alert("success");
    $("#menu").hide();
  $("#output1").html(result);
      }
      }); 
	  
}

