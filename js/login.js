function getLogin() {
        var pars = '';
        var url  = 'index1.php';
        var myAjax = new Ajax.Updater(
        { success: 'divmiddlecontent' },
        url, {
            method: 'post',
            evalScripts: true,
            parameters: pars,
            oncomplete : function (req) {
            }
        });

}

function trim(str) {

  return str.replace(/^\s*|\s*$/g,"");

}

function ValidateUser() {

  if (trim(document.loginform.username.value) =='') {

	alert("Enter the username");  

	document.loginform.username.focus();

    return false;

  } else if (trim(document.loginform.password.value) == '') {

	alert("Enter the password");  

	document.loginform.password.focus();

    return false;

  } 
  

}