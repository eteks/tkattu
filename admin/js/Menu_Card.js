var frm;
function populateHotelInfoManageLists(id, action, value, page) {

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
    reqStudUser.open("GET", "Menu_Card.process.php?" + pars, true);
    reqStudUser.send("");
}

function submitfrmMenuCard(obj) {

alert("hi");
    frm = obj;
    var errs=0;
    //if (errs==0 && !commonCheck(obj.menu_card_name,'error_menu_card_name',true)) errs +=1;
   // if (errs>1)  alert('There are some fields which are required before sending');
   // if (errs==1) alert('There is a field which is required before sending');
    if (errs == 0) {
        var reqFaq1 = new XMLHttpRequest();
          reqFaq1.onreadystatechange = function () {
            if (reqFaq1.readyState == 4) {
                  if (reqFaq1.status == 200) { /*alert(reqFaq1.responseText);
                      if (reqFaq1.responseText == "1") {
                        if (frm.action.value == "menu_card_insert") {
                            alert("Success: Menu Card added successfully");
                        } else {
                            alert("Success: Menu Card updated successfully");
                        }*/
                        frm.submit();
                      /*} else {
                          alert("Error: Duplicate record found");
                          setfocus(frm.menu_card_name);
                      }*/
                 } else {
                      alert("Error: While trying to process whatever you requested");
                 }
              }
         }
         var pars = "id=" + obj.id.value + "&page=" + obj.page.value + "&action=" + obj.action.value + "&menuName=" + obj.menu_card_name.value;
         reqFaq1.open("GET", "Menu_Card.process.php?" + pars, true);
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

function statusupdate(item){
//alert(item);
  // if(item==true)
	  $.ajax({
      type:'POST',
      url:'ajax.php',
      data:'action='+"check"+'&item='+item,
      success: function(result){              
        // $('#msgbox').html("updated Successfully");  
		 //$("#msgbox").html("updated Successfully").show().delay(3000).fadeOut();
		// $('#msgbox').show();
           		 
      }
      });
}

function updatestatus(){
alert("updated Successfully");
}
