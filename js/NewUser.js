function ValidateRegister()
{
	    var uname = document.RegUser.uname.value;
		var email = document.RegUser.email.value;
		var pwd = document.RegUser.pwd.value;
		var cpwd = document.RegUser.cpwd.value;
		var fname = document.RegUser.fname.value;
		var lname = document.RegUser.lname.value;
		var gender = document.RegUser.sex.value;		
		var bday = document.RegUser.bday.value;
		var phone = document.RegUser.phone.value;
		var photo = document.RegUser.photo.value;
		var favplayer = document.RegUser.favplayer.value;
		var moment = document.RegUser.moment.value;
		var terms = document.RegUser.agree.value;
		
		if (uname == "") 
		{ 
	alert("One or more mandatory fields are not filled. Please enter desired user name");
	return false;
	document.RegUser.firstname.focus();
	}
	if (email == "") 
		{ 
	alert("One or more mandatory fields are not filled. Please enter your email ID");	
	return false;
	document.RegUser.email.focus();
	}
	
if (pwd == "") 
		{ 
	alert("One or more mandatory fields are not filled. Please enter your password");
	return false;
	document.RegUser.pwd.focus();
	
	}
if(document.RegUser.pwd.value.length < 6) {
        alert("Password must contain at least six characters! Please re-enter the password");
         return false;
		document.RegUser.pwd.focus();
       
      }
if (cpwd == "") 
		{ 
	alert("One or more mandatory fields are not filled. Please confirm your password");
	return false;
	document.RegUser.cpwd.focus();
	
	}
	
	
	  if (pwd != cpwd) 
		{ 
	alert("Passwords you entered, do not match. Please enter the passwords again");
	return false;
	document.RegUser.pwd.focus();
	
	}
	
	if (fname == "") 
		{ 
	alert("One or more mandatory fields are not filled. Please enter your first name");
	return false;
	document.RegUser.fname.focus();
	
	}
	if (lname == "") 
		{ 
	alert("One or more mandatory fields are not filled. Please enter your last name");
	
	return false;
	document.RegUser.lname.focus();
	}
	if (gender == "") 
		{ 
	alert("One or more mandatory fields are not filled. Please select your gender");
	return false;
	document.RegUser.sex.focus();

	}
	if (bday == "") 
		{ 
	alert("One or more mandatory fields are not filled. Please enter your birthday");
	return false;
	document.RegUser.bday.focus();
	}
		
		if (phone == "") 
		{ 
	alert("One or more mandatory fields are not filled. Please enter your phone number");
	return false;
	document.RegUser.phone.focus();
	}
	if(document.RegUser.phone.value.length < 10) 
	{
        alert("This seems like a invalid phone number. Please re-enter your phone number");
        return false;
      	document.RegUser.phone.focus();
	  }
	  
	if(!document.RegUser.agree.checked)
	{
	    alert("You must agree to the terms to be a part of RCB community");
		return false;
	}
	


	
}