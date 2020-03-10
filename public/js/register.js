window.onload = function() {
	var request = createRequest();

	if (request == null) {
		alert("Error");
		return;
	}
	
	var entityInfo = "request=ajax";
	
	var url = "/user/getCityList";
	request.open("GET", url, true);

	request.onreadystatechange = function () {
		if (request.readyState == 4 && request.status == 200) {
			var return_data = request.responseText;
			
			var output = eval("(" + return_data + ")");
			
			var t = document.getElementById("city");
			var e = document.createElement('option');
			e.value = 0;
			t.appendChild(e);
			e.innerHTML += 'בחר עיר...</option>';
			
			for(var i=0; i < output.length; i++) {
				writeInfo(output[i].id, output[i].name);
			}
		}
	}
	request.send(entityInfo);
}

function writeInfo(id, name) {
	var t = document.getElementById("city");
	var e = document.createElement('option');
	e.value = id;
	t.appendChild(e);
	e.innerHTML += name + '</option>';
}

function checkUsername() {
	var elem = document.getElementById("username");
	elem.value = elem.value.toLowerCase();
	
	if (checkEmail(elem) == false) {
		return false;
	}

	var request = createRequest();

	if (request == null) {
		alert("Error");
		return;
	}
	
	var entityInfo = "request=ajax&username=" + elem.value;

	var url = "/user/checkUserExists";
	request.open("POST", url, true);
	request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	
	request.onreadystatechange = function () {
		if (request.readyState == 4 && request.status == 200) {
			var return_data = request.responseText;
			var el = document.getElementById("username-msg");
			
			return_data = eval("(" + return_data + ")");
			
			if (return_data == true) {
				el.style.color = 'red';
				el.innerHTML = 'כתובת מייל בשימוש';
				elem.focus();
				elem.value = '';
			} else {
				el.style.color = 'green';
				el.innerHTML = 'כתובת מייל פנויה';
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
	
	el.innerHTML = '';
	return true;
}

function submitRegisterForm() {
	var request = createRequest();
	
	if (request == null) {
		alert("Error");
		return;
	}
	
	var elemUserName = document.getElementById("username");
	var elemFirstName = document.getElementById("firstname");
	var elemSurName = document.getElementById("surname");
	var elemCity = document.getElementById("city");
	var elemAddress = document.getElementById("address");
	var elemPhone = document.getElementById("phone");

	var userName = "user_name=" + elemUserName.value;
	var firstName = "first_name=" + elemFirstName.value;
	var surName = "sur_name=" + elemSurName.value;
	var city = "city=" + elemCity.value;
	var address = "address=" + elemAddress.value;
	var phone = "phone=" + elemPhone.value;
	
	var entityInfo = "request=ajax&" + userName + "&" + firstName + "&" + surName + "&" + city + "&" + address + "&" + phone;

	var url = "/user/signup";
	request.open("POST", url, true);
	request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	
	request.onreadystatechange = function () {
		if (request.readyState == 4 && request.status == 200) {
			var return_data = request.responseText;
			
			var output = eval("(" + return_data + ")");

			if (output == true) {
				el = document.getElementsByTagName("h1");
				el[0].innerHTML = 'המשתמש הוסף בהצלחה<br />' +
							'מייל אקטיבציה נשלח אליך<br />' +
							'יש לבדוק את תיקיית הספאם במידת הצורך';
				el = document.getElementById('register_form');
				el.innerHTML = '<input type="submit" id="return" value="חזרה" onclick="returnToHome()" />';
				return;
			}
			
			if (output == false) {
				el = document.getElementsByTagName("h1");
				el[0].innerHTML = 'קיימת בעיה בשליחת המייל';
				el = document.getElementById('register_form');
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

function clearOldMessages(elem) {
	el = document.getElementById(elem);
	el.innerHTML = '';
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
