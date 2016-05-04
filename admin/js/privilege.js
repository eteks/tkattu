var frm;
var glbDivId;

function submitfrmPrivilegeUserMenu(obj) {
    frm=obj;
    populate_privilege_users_records('1', frm.role_master_id.options[frm.role_master_id.selectedIndex].value);
}


function submitfrmPrivilegeUsers(obj) {
    frm = obj;
    var errs=0;
    if (!commonCheck(frm.parent_id, 'error_parent_id', true)) errs += 1;
    if (errs == 0 && !commonCheck(frm.uname, 'error_uname', true)) errs += 1;
    if (errs == 0 && !commonCheck(frm.pword, 'error_pword', true)) errs += 1;
    if (errs == 0 && !commonCheck(frm.fname, 'error_fname', true)) errs += 1;
    if (errs == 0 && !commonCheck(frm.lname, 'error_lname', true)) errs += 1;
    if (errs == 0 && !validateEmail(frm.email, 'error_email', true)) errs += 1;

    if (errs==1) alert('There is a field which is required before sending');    
    if (errs == 0) {
        var requsersubmit = new XMLHttpRequest();
        requsersubmit.onreadystatechange = function()
        {
            if (requsersubmit.readyState == 4) {
                if (requsersubmit.status == 200) {
                    if (trim(requsersubmit.responseText)!=='') {
                        msg ('error_uname', "tahoma10rednormal", requsersubmit.responseText);
                        setfocus(frm.uname);
                    } else if (trim(requsersubmit.responseText)=='') {
                        frm.submit();
                    } else {
                        alert("Error: While trying to submit the user detail, please try again");
                    }
                }
            }
        }
        if (frm.action.value=='privilege_user_update') {
            id=frm.id.value;
        } else {
            id='';
        }
        requsersubmit.open("GET", "privilege_users.process.php?id="+id+"&uname="+escape(trim(obj.uname.value))+"&action=privilege_user_duplication", true);
        requsersubmit.send("");
    }
    return false;
}

function deletePrivilegeUserRecords (obj, action, id) {
    if (confirm("WARNING: Are you sure you want to delete this user, if yes, choose OK")) {
        obj.action.value = action;
        obj.id.value = id;
        obj.submit();
    }
}

function populate_privilege_users_records(page, role_id, id, action, value) {   
    var glbDivId1 = document.getElementById("privilege_users_records");
    var reqPrivilege1 = new XMLHttpRequest();
    reqPrivilege1.onreadystatechange = function () {
        if (reqPrivilege1.readyState == 4) {
            if (reqPrivilege1.status == 200) {
                glbDivId1.innerHTML = reqPrivilege1.responseText;
            } else {
                alert("Error: While trying to process whatever you requested");
            }
        }
    }
    reqPrivilege1.open("GET", "privilege_users.process.php?page="+page+"&parent_id="+role_id+"&id="+id+"&action="+action+"&value="+value, true);
    reqPrivilege1.send("");
}

function update_roles_modules_records(placeid, role_id, addflag, id) {
    if (document.frmPrivilegeUsers.parent_id.selectedIndex>0) {
        document.getElementById('error_parent_id').innerHTML='';
        document.getElementById('Mainlistofrow').style.display='';
        var glbDivId1 = document.getElementById(placeid);
        var reqPrivilege1 = new XMLHttpRequest();
        reqPrivilege1.onreadystatechange = function () {
            if (reqPrivilege1.readyState == 4) {
                if (reqPrivilege1.status == 200) {
                    glbDivId1.innerHTML = reqPrivilege1.responseText;
                } else {
                    alert("Error: While trying to process whatever you requested");
                }
            }
        }
        reqPrivilege1.open("GET", "privilege_users.process.php?parent_id="+role_id+"&action=update_role_modules_tree&addflag="+addflag+"&id="+id, true);
        reqPrivilege1.send("");
    } else {
        document.getElementById(placeid).innerHTML='';
        document.getElementById('Mainlistofrow').style.display='none';
        document.getElementById('error_parent_id').innerHTML='Required';        
    }   
}

function update_user_modules_records(obj, placeid, role_id, module_id) {
    addflag = '1';
    id='';
    if (typeof(document.frmPrivilegeUsers.action)=='privilege_user_update') {
        addflag='0';
        id=document.frmPrivilegeUsers.id.value;
    }
    var glbDivId1 = document.getElementById(placeid);
    if (obj.checked) {
        var reqPrivilege1 = new XMLHttpRequest();
        reqPrivilege1.onreadystatechange = function ()
        {
            if (reqPrivilege1.readyState == 4) {
                if (reqPrivilege1.status == 200) {
                    glbDivId1.style.display='';
                    glbDivId1.innerHTML = reqPrivilege1.responseText;
                } else {
                    alert("Error: While trying to process whatever you requested");
                }
            }
        }
        reqPrivilege1.open("GET", "privilege_users.process.php?parent_id="+role_id+"&action=update_user_modules_tree&module_id="+module_id+"&addflag="+addflag+"&id="+id, true);
        reqPrivilege1.send("");
    } else {
        document.getElementById(placeid).innerHTML='';
        glbDivId1.style.display='none';
    }
}

function deletePrivilegeModuleRecords (obj, action, id) {
    if (confirm("WARNING: Are you sure you want to delete this module, if yes, choose OK")) {
        obj.action.value = action;
        obj.id.value = id;
        obj.submit();
    }
}
function populate_privilege_modules_records(parent_id, id, action, value) {
    var glbDivId1 = document.getElementById("privilege_modules_records");
    var reqPrivilege1 = new XMLHttpRequest();
    reqPrivilege1.onreadystatechange = function () {
        if (reqPrivilege1.readyState == 4) {
            if (reqPrivilege1.status == 200) {
                glbDivId1.innerHTML = reqPrivilege1.responseText;
            } else {
                alert("Error: While trying to process whatever you requested");
            }
        }
    }   
    reqPrivilege1.open("GET", "privilege_modules.process.php?parent_id="+parent_id+"&id="+id+"&action="+action+"&value="+value, true);
    reqPrivilege1.send("");
}
function update_modules_sortorder_records(parent_id, id, addflag, previous_parent_id) {
    var glbDivId1 = document.getElementById("module_sort_order");
    var reqPrivilege1 = new XMLHttpRequest();
    reqPrivilege1.onreadystatechange = function () {
        if (reqPrivilege1.readyState == 4) {
            if (reqPrivilege1.status == 200) {
                glbDivId1.innerHTML = reqPrivilege1.responseText;
            } else {
                alert("Error: While trying to process whatever you requested");
            }
        }
    }   
    reqPrivilege1.open("GET", "privilege_modules.process.php?parent_id="+parent_id+"&action=update_module_sortorder_combo&id="+id+"&addflag="+addflag+"&previous_parent_id="+previous_parent_id, true);
    reqPrivilege1.send("");
}
function submitfrmPrivilegeModules(obj) {  
    frm = obj;
    var errs=0;     
    if (!commonCheck(frm.name, 'error_name', true)) errs += 1;  
    if (!commonCheck(frm.filename, 'error_filename', true) ) errs += 1;    
    if (errs>1)  alert('There are some fields which are required before sending');
    if (errs==1) alert('There is a field which is required before sending');
    if (errs == 0) {
        frm.submit();
    }
}

function submitfrmPrivilegeEventModules(obj) {   
    frm = obj;
    var errs=0; 
    if (frm.module_event_parent_id.selectedIndex==0) {      
        msg ('error_eventparent', "tahoma10rednormal", "Error:Required");
        errs += 1;
    }
    if (!commonCheck(frm.event_name, 'error_eventname', true)) errs += 1;   
    if (!commonCheck(frm.event_filename, 'error_filename', true)) errs += 1;    
    
    if (errs>1)  alert('There are some fields which are required before sending');
    if (errs==1) alert('There is a field which is required before sending');
    if (errs == 0) {        
        frm.submit();
    }
}

function populate_privilege_events_records(event_module_parent_id) {  
    var EventsDivId = document.getElementById("privilege_events_records");
    if (event_module_parent_id==0) {
        EventsDivId.innerHTML = "<center><span class='normaltext'><b>Please Select Module Name</b></span></center>";
    } else {        
        var reqPrivEvent = new XMLHttpRequest();
        reqPrivEvent.onreadystatechange = function ()
        {
           if (reqPrivEvent.readyState == 4) { 
              if (reqPrivEvent.status == 200) {
                  EventsDivId.innerHTML = reqPrivEvent.responseText;
              } else {
                  alert("Error: While trying to fetch events records");
              }
           }
       }    
       reqPrivEvent.open("GET", "privilege_events.process.php?event_module_parent_id="+event_module_parent_id, true);
       reqPrivEvent.send("");
    }
}

function deleteAdminModuleEventsMasterRecords(obj, action, id,parentmoduleid) { 
    
     if (confirm("WARNING: Are you sure you want to delete this record, if yes, choose OK")) {
        obj.action.value = action;
        obj.id.value = id;
        obj.parent_moduleid.value = parentmoduleid;
        obj.submit();
    }
}

function submitfrmPrivilegeAdminRoles(obj) {   
    frm = obj;
    var errs=0;
    if (!commonCheck(obj.role_name, 'error_rolename', true)) errs += 1;

    if (errs>1)  alert('There are some fields which are required before sending');
    if (errs==1) alert('There is a field which is required before sending');

    if (errs == 0) {           
        var reqrolesubmit = new XMLHttpRequest();
        reqrolesubmit.onreadystatechange = function() 
        {
            if (reqrolesubmit.readyState == 4) {
                if (reqrolesubmit.status == 200) {
                    if (reqrolesubmit.responseText == 1) {
                        /*if (frm.action.value == "privilege_roles_insert") {
                             //alert("Sucess: Role added successfully");
                        } else {
                             //alert("Sucess: Role updated successfully");
                        }*/
                        frm.submit();
                    } else {
                            alert("Error: Duplicate record found");
                            setfocus(frm.role_name);
                    }
                } else {
                    alert("Error: While trying to process , please try again");
                }
            }
        }       
        reqrolesubmit.open("GET", "privilege_roles.process.php?id="+obj.id.value+"&role_parent_id="+obj.role_parent_id.value+"&role_name="+obj.role_name.value+"&action="+obj.action.value, true);
        reqrolesubmit.send("");
    }
    
}

function get_admin_module_child_checkbox (child_id) {   
    //alert(child_id);
    var role_edit_id=0;
    if (document.getElementById("edit_id").value!="") {
        role_edit_id=document.getElementById("edit_id").value;
    }   
    var divchild = document.getElementById('div_child'+child_id);
    if (!document.getElementById('parent'+child_id).checked) {
        divchild.style.display ='none';
    } else {
        var reqchild = new XMLHttpRequest();
        reqchild.onreadystatechange = function () 
        {
            if (reqchild.readyState == 4) {
                if (reqchild.status == 200) {   //alert(reqchild.responseText);
                    if (reqchild.responseText !="") {
                        var response_text_array = reqchild.responseText.split("<NEXTCHILDID>");
                        //alert (response_text_array[1]);
                        if (typeof(response_text_array[1])!="undefined") {
                            divchild.innerHTML = response_text_array[0];
                             get_admin_module_child_checkbox(response_text_array[1]);
                        } else {
                            divchild.innerHTML = reqchild.responseText;
                        }


                        //get_admin_module_child_checkbox('3');
                        divchild.style.display='block';
                    } 
                }
            }
        }       
        reqchild.open("GET", "privilege_roles.process.php?child_id="+child_id+"&action=admin_role_child_names&role_edit_id="+role_edit_id, true);
        reqchild.send("");
   }
}

function deletefrmAdminPrivilegeRoleRecord(obj, action, id, parentid)  {

    if (confirm("WARNING: Are you sure you want to delete this role,\n Deleting this role will delete all the sub roles associated with it if any, if yes, choose OK")) {
        obj.action.value = action;
        obj.id.value = id;
        //obj.id.value = 132123;
        obj.parentid.value = parentid;
        obj.submit();
    }
}

function populateAdminRoleSortOrderValues(parentid, sort_selectedvalue) {       
    sort_select="";
    sort_select = sort_selectedvalue;   
    var req1 = new XMLHttpRequest();
    req1.onreadystatechange = function() { 
        if (req1.readyState == 4) {
            if (req1.status == 200) { //alert(req1.responseText);
                if (req1.responseText !="") {
                   // first empty the sort_order select box
                    var sort_order_obj = document.getElementById('role_sort_order');
                    var sort_order_len =  sort_order_obj.options.length;

                    for (j=(sort_order_len-1); j>0;j--) {
                        sort_order_obj.remove(j);
                    }

                    if (req1.responseText > 0 ) {
                         for (i=0; i<req1.responseText; i++ ) {
                            var k= i+1;
                            sort_order_obj.options[k] = new Option(k, k);
                            if (sort_select == k) {
                                sort_order_obj.options[k].selected=true;
                            }
                         }
                    }
               }
            } else {
                 alert("Error: While trying to get sort number entry, please try again");
            }
        }
    }
    req1.open("GET", "privilege_roles.process.php?parent_id="+parentid+"&action=adminrole_generate_sort_order_values", true);
    req1.send("");
}

function populate_privilege_roles_records(parentid) { 

    var req3 = new XMLHttpRequest();
    req3.onreadystatechange = function() {
        if (req3.readyState == 4) {
             //ToggleFloatingLayer('PleaseWaitFloatingLayer', 0);
             if (req3.status == 200) {
                 var tbl = document.getElementById ("privilege_roles_records");
                 tbl.innerHTML = req3.responseText;

              } else {
                 alert("Error: While trying to perform action, please try again later");
              }
       } else {
        //ToggleFloatingLayer('PleaseWaitFloatingLayer', 1);
       }
    }
    req3.open("GET", "privilege_roles.process.php?&parentid="+parentid, true);
    req3.send("");

}
function populate_admin_role_records(id, action, value, parentid) {  

    var req4 = new XMLHttpRequest();    
    req4.onreadystatechange = function() {
        if (req4.readyState == 4) {
            if (req4.status == 200) {

                var tbl = document.getElementById ("privilege_roles_records");
                tbl.innerHTML = req4.responseText;
            } else {
            alert("Error: While trying to perform action, please try again later");
           }
       }
    }
    req4.open("GET", "privilege_roles.process.php?&id="+id+"&action="+action+"&value="+value+"&parentid="+parentid, true);
    req4.send("");
}