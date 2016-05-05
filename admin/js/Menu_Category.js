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
    reqStudUser.open("GET", "Menu_Category.process.php?" + pars, true);
    reqStudUser.send("");
}

function submitfrmStudentUser(obj) {
    frm = obj;
    var errs=0;
   //  if (!commonCheck(obj.service_tax,'error_service_tax',true)) errs +=1;
    //  if (!commonCheck(obj.vat_tax,'error_vat_tax',true)) errs +=1;
    if (!commonCheck(obj.menucategory_name,'error_menucategory_name',true)) errs +=1;
        if (!commonCheck(obj.normalicon,'error_normalicon',true) && !commonCheck(obj.normaliconedit,'error_normalicon',true)) errs +=1;

    //if (!commonCheck(obj.activeicon,'error_activeicon',true) && !commonCheck(obj.activeiconedit,'error_activeicon',true)) errs +=1;

	 if (!commonCheck(obj.taxable,'error_taxable',true)) errs +=1;

    if (errs>1)  alert('There are some fields which are required before sending');
    if (errs==1) alert('There is a field which is required before sending');
    if (errs == 0) {
        var req = new XMLHttpRequest();
        obj.submit();
    }
     else {
                     //alert(enter);
                      alert("Error: While trying to process whatever you requested");
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
function validate1()
{
	var taxable;
	if(document.frmStudentUser.taxable.checked==true)
	{
		document.frmStudentUser.taxable.value=="YES";
	}
	else
	{
		document.frmStudentUser.taxable.value=="NO";
	}
}