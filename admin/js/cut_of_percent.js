function submitfrmCutOfPercent(obj){
    var frm = obj;
    var errs=0;
    if (!commonCheck(obj.cut_of_percent_name, 'error_set_name', true)) errs += 1;
    if (errs>1)  alert('There are some fields which are required before sending');
    if (errs==1) alert('There is a field which is required before sending');
    if (errs == 0) {
        var reqLoc = new XMLHttpRequest();
          reqLoc.onreadystatechange = function () {
              if (reqLoc.readyState == 4) {
                  if (reqLoc.status == 200) { //alert(reqLoc.responseText);
                      if (reqLoc.responseText == "1") {                     
                        if (frm.action.value == "cut_of_percent_insert") {
                            alert("Success: CutOfPercent added successfully");
                        } else {
                            alert("Success: CutOfPercent updated successfully");
                        }
                        frm.submit();
                      } else {
                          alert("Error: Duplicate record found");
                          setfocus(frm.cut_of_percent_name);
                      }
                 } else {
                      alert("Error: While trying to process whatever you requested");
                 }  
              }
         }
         var pars = "id=" + obj.id.value + "&name=" + obj.cut_of_percent_name.value + "&action=" + obj.action.value;
         reqLoc.open("GET", "cut_of_percent.process.php?" + pars, true);
         reqLoc.send("");
    }
}

function populateCutOfPercentShowrecords(id, action, value, page) {
    var page = ((typeof page == 'undefined' || page == '' )? '1' : page );
    var glbDivId1 = document.getElementById("cut_of_percent_records");
    var reqLoc = new XMLHttpRequest();
    reqLoc.onreadystatechange = function () {
        if (reqLoc.readyState == 4) {
              if (reqLoc.status == 200) {
                glbDivId1.innerHTML = reqLoc.responseText;
            } else {
                alert("Error: While trying to process whatever you requested");
            }
        }
    }
    reqLoc.open("GET", "cut_of_percent.process.php?page=" + page + "&id=" + id + "&action=" + action + "&value=" + value, true);
    reqLoc.send("");
}

function deleteCutOfPercentRecord(obj, action, id) {
    if (confirm("WARNING: Are you sure you want to delete this records, if yes, choose OK")) {
        obj.action.value = action;
        obj.id.value = id;
        obj.submit();
    }
}

function deleteSelectedCutOfPercentRecord(obj, action) {
    if (confirm("WARNING: Are you sure you want to delete selected records, if yes, choose OK")) {
        obj.action.value = action;
        obj.submit();
    }
}