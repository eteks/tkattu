var req;
var frm;
function comparePassword (obj) {
    if (obj.new_password.value != obj.confirm_new_password.value) {
        msg ("error_new_password", "tahoma10rednormal", "ERROR: The New Password and Confirm New Password are not identical, please try again");
        obj.new_password.value = "";
        obj.confirm_new_password.value = "";
        setfocus(obj.new_password);
        return false;
    } else {
        return true;
    }
}

function processReqChange() {
    if (req.readyState == 4) {
        ToggleFloatingLayer('PleaseWaitFloatingLayer',0);
        if (req.status == 200) {
            if(req.responseText == "1") {
                alert("Sucess: Password updated successfully");
                frm.submit();
            } else {
                alert("Error: Invalid current password!");
                setfocus(frm.password);
            }
         } else {
            alert("Error: while trying to update new password, please try again");
         }
    } else {
      ToggleFloatingLayer('PleaseWaitFloatingLayer',1);
    }
}

function submitfrmChangeProfile (obj) {
    frm = obj;
    var errs=0;
    if (!commonCheck(obj.confirm_new_password, 'error_confirm_new_password', true)) errs += 1;
    if (!commonCheck(obj.new_password, 'error_new_password', true)) errs += 1;
    if (!commonCheck(obj.password, 'error_password', true)) errs += 1;
    if (!commonCheck(obj.username, 'error_username', true)) errs += 1;
    if (errs>1)  alert('There are some fields which are required before sending');
    if (errs==1) alert('There is a field which is required before sending');
    if (errs == 0) {
        if (comparePassword(obj)) {
            req = new XMLHttpRequest();
            req.onreadystatechange = processReqChange;
            req.open("GET", "change_profile.process.php?username="+escape(obj.username.value)+"&password="+escape(obj.password.value)+"&new_password="+escape(obj.new_password.value), true);
            req.send("");
        }
    }
   return false;
}
