function submitfrmLogin () {
	//alert("hai");
  if (trim(document.loginform.username.value) =='') {

	alert("Enter the username");  

	document.loginform.username.focus();

    return false;

  } else if (trim(document.loginform.password.value) == '') {

	alert("Enter the password");  

	document.loginform.password.focus();

    return false;

  } 
  return true;
}