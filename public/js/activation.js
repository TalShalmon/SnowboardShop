function submitActivationForm() {
	var request = createRequest();
	
	if (request == null) {
		alert("Error");
		return;
	}
	
	var elemUserName = document.getElementById("username");
	elemUserName.value = elemUserName.value.toLowerCase();

	if (checkEmail(elemUserName) == false) {
		return false;
	}

	var userName = "user_name=" + elemUserName.value;
	var entityInfo = "request=ajax&" + userName;
	var url = "/user/resetPassword";
	request.open("POST", url, true);
	request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	
	request.onreadystatechange = function () {
		if (request.readyState == 4 && request.status == 200) {
			var return_data = request.responseText;
			
			var output = eval("(" + return_data + ")");
			
			if (output == true) {
				el = document.getElementsByTagName("h1");
				el[0].innerHTML = 'מייל אקטיבציה נשלח אליך<br />' +
							'יש לבדוק את תיקיית הספאם במידת הצורך';
				el = document.getElementById('activation_form');
				el.innerHTML = '<input type="submit" id="return" value="חזרה" onclick="returnToHome()" />';
				return;
			}
			
			if (output == false) {
				el = document.getElementsByTagName("h1");
				el[0].innerHTML = 'קיימת בעיה בשליחת המייל';
				el = document.getElementById('activation_form');
				el.innerHTML = '<input type="submit" id="return" value="חזרה" onclick="returnToHome()" />';
				return;
			}
			
			for(var i=0; i < output.length; i++) {
				msg_lebel = output[i].key + "-msg";
				el = document.getElementById(msg_lebel);
				el.style.color = 'red';
				el.innerHTML = output[i].value;
			}
		}
	}
	request.send(entityInfo);
}

function checkEmail(elem) {
	var mail = elem.value;
	var el = document.getElementById("username-msg");
	
	var reg = /^([a-z0-9_\-\.])+\@([a-z0-9_\-\.])+\.([a-z]{2,4})$/;

	if (reg.test(mail) == false) {
		el.style.color = 'red';
		el.innerHTML = 'כתובת מייל לא חוקית';
		elem.focus();
		elem.value = '';
		return false;
	}
	
	return true;
}

function testPassword() {
	var intScore = 0
	var strVerdict = "חלש"
	var strLog = ""
	var e = document.getElementById("password");
	var pass = e.value;
	var el = document.getElementById('password-msg');
	
	if (pass.length == 0) {
		el.innerHTML = "";
		return;
	}
	// PASSWORD LENGTH
	if (pass.length<5) { // length 4 or less
		intScore = (intScore+3);
	} else if (pass.length<8) { // length between 5 and 7
		intScore = (intScore+6)
	} else if (pass.length<16) { // length between 8 and 15
		intScore = (intScore+12)
	} else { // length 16 or more
		intScore = (intScore+18)
	}
	
	// LETTERS
	if (pass.match(/[a-z]/)) { // [verified] at least one lower case letter
		intScore = (intScore+1)
	}
	if (pass.match(/[A-Z]/)) { // [verified] at least one upper case letter
		intScore = (intScore+5)
	}
	
	// NUMBERS
	if (pass.match(/\d+/)) { // [verified] at least one number
		intScore = (intScore+5)
	}
	if (pass.match(/(.*[0-9].*[0-9].*[0-9])/)) { // [verified] at least three numbers
		intScore = (intScore+5)
	}
	
	// SPECIAL CHAR
	if (pass.match(/.[!,@,#,$,%,^,&,*,?,_,~]/)) { // [verified] at least one special character
		intScore = (intScore+5)
	}
	// [verified] at least two special characters
	if (pass.match(/(.*[!,@,#,$,%,^,&,*,?,_,~].*[!,@,#,$,%,^,&,*,?,_,~])/)) {
		intScore = (intScore+5)
	}
	
	// COMBOS
	if (pass.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/)) { // [verified] both upper and lower case
		intScore = (intScore+2)
	}
	if (pass.match(/([a-zA-Z])/) && pass.match(/([0-9])/)) { // [verified] both letters and numbers
		intScore = (intScore+2)
	}
	// [verified] letters, numbers, and special characters
	if (pass.match(/([a-zA-Z0-9].*[!,@,#,$,%,^,&,*,?,_,~])|([!,@,#,$,%,^,&,*,?,_,~].*[a-zA-Z0-9])/)) {
		intScore = (intScore+2)
	}
	
	if(intScore < 16) {
		el.style.color = 'orange';
		strVerdict = "חלש מאוד"
	} else if (intScore < 25) {
		el.style.color = 'orange';
		strVerdict = "חלש"
	} else if (intScore < 35) {
		el.style.color = 'yellow';
		strVerdict = "בינוני"
	} else if (intScore < 45) {
		el.style.color = 'green';
		strVerdict = "חזק"
	} else {
		el.style.color = 'green';
		strVerdict = "חזק מאוד"
	}
	
	el.innerHTML = strVerdict;
}

function submitChangePasswordForm(id,username) {
	var request = createRequest();
	
	if (request == null) {
		alert("Error");
		return;
	}
	
	var elemPassword = document.getElementById("password");
	var elemVerify = document.getElementById("verify");

	id = "id=" + id;
	username = "username=" + username;
	var password = "password=" + elemPassword.value;
	var verify = "verify=" + elemVerify.value;
	
	var entityInfo = "request=ajax&" + id + "&" + username + "&" + password + "&" + verify;

	var url = "/user/changePassword";
	request.open("POST", url, true);
	request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	
	request.onreadystatechange = function () {
		if (request.readyState == 4 && request.status == 200) {
			var return_data = request.responseText;
			
			var output = eval("(" + return_data + ")");

			if (output == true) {
				el = document.getElementsByTagName("h1");
				el[0].innerHTML = 'הסיסמה עודכנה בהצלחה';
				el = document.getElementById('activation_form');
				el.innerHTML = '<input type="submit" id="return" value="להמשך שימוש באתר לחץ כאן" onclick="returnToHome()" />';
				return;
			}
			
			for(var i=0; i < output.length; i++) {
				msg_lebel = output[i].key + "-msg";
				el = document.getElementById(msg_lebel);
				el.style.color = 'red';
				el.innerHTML = output[i].value;
			}
		}
	}
	request.send(entityInfo);
}

function clearOldMessages(elem) {
	el = document.getElementById(elem);
	el.innerHTML = '';
}

function clearMessage() {
	var elem = document.getElementById("username-msg");
	elem.innerHTML = '';
}

function returnToHome() {
	window.location = '/';
}

function createRequest() {
	if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
		request = new XMLHttpRequest();
	} else if (window.ActiveXObject) {
		// code for IE6, IE5
		request = new ActiveXObject("Microsoft.XMLHTTP");
		// code for other IE
		//request = new ActiveXObject("Msxml2.XMLHTTP");
	} else {
		// failed
		request = null;
	}

	return request;
}
