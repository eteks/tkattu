// JavaScript Documentvar frm;
function populateParameterManageLists(id, action, value, page) {

    var page = ((typeof page == 'undefined' || page == '' )? '1' : page );
    var glbDivId1 = document.getElementById("parameter_setting_records");
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
    reqStudUser.open("GET", "parameter_info.process.php?" + pars, true);
    reqStudUser.send("");
}

function submitfrmStudentUser(obj) {
    frm = obj;
    var errs=0;
    if (errs == 0 && !commonCheck(obj.hms_parameter_name,'error_hms_parameter_name',true)) errs +=1;
	if (errs == 0 && !commonCheck(obj.hms_hotel_name,'error_hms_hotel_name',true)) errs +=1;
    if (errs == 0 && !commonCheck(obj.hms_address1, 'error_hms_address1', true)) errs += 1;
	if (errs == 0 && !commonCheck(obj.hms_address2, 'error_hms_address2', true)) errs += 1;
    if (errs == 0 && !commonCheck(obj.hms_city, 'error_hms_city', true)) errs += 1;
    if (errs == 0 && !commonCheck(obj.hms_state, 'error_hms_state', true)) errs += 1;
	if (errs == 0 && !commonCheck(obj.hms_country, 'error_hms_country', true)) errs += 1;
    if (errs == 0 && !commonCheck(obj.hms_pincode, 'error_hms_pincode', true)) errs += 1;
    if (errs == 0 && !commonCheck(obj.hms_phone_no, 'error_hms_phone_no', true)) errs += 1;
    

    if (errs>1)  alert('There are some fields which are required before sending');
    if (errs==1) alert('There is a field which is required before sending');
    if (errs == 0) {
        var req = new XMLHttpRequest();
        obj.submit();
    }
}

function deleteHmsParameterManageRecord(obj, action, id) {

    if (confirm("WARNING: Are you sure you want to delete this records, if yes, choose OK")) {
        obj.action.value = action;
        obj.id.value = id;
        obj.submit();

    }
}
function deleteSelectedHmsParameterManageRecord(obj, action) {
//alert(action);
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