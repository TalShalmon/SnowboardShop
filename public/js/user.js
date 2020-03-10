window.onload = function() {
	var request = createRequest();

	if (request == null) {
		alert("Error");
		return;
	}
	
	var entityInfo = "request=ajax";
	
	var url = "/user/getUserInfo";
	request.open("GET", url, true);

	request.onreadystatechange = function () {
		if (request.readyState == 4 && request.status == 200) {
			var return_data = request.responseText;
			
			var output = eval("(" + return_data + ")");
			output = output[0];
			
			for(var propertyName in output) {
				fillInfo(propertyName, output[propertyName]);
			}
		}
	}
	request.send(entityInfo);
}

function fillInfo(propertyName, data) {
	if (propertyName == 'user_name') {
		var t = document.getElementsByTagName('h1');
		t[0].innerHTML += data;
	} else if (propertyName == 'city') {
		fillCityList(data);
	} else {	
		var e = document.getElementById(propertyName);
		e.value = data;
	}
}

function fillCityList(cityIndex) {
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
			
			if (cityIndex == null) {
				e.value = 0;
				t.appendChild(e);
				e.innerHTML += 'בחר עיר...</option>';
			}
			
			for(var i=0; i < output.length; i++) {
				writeInfo(output[i].id, output[i].name);
			}
			
			if (cityIndex) {
				for (var j=0; j<t.options.length; j++) {
					if (t[j].value == cityIndex) {
						t.options[j].selected = true;
					}
				}
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

function clearOldMessages(elem) {
	el = document.getElementById(elem);
	el.innerHTML = '';
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

function submitUpdateForm() {
	var request = createRequest();
	
	if (request == null) {
		alert("Error");
		return;
	}
	
	var elemPassword = document.getElementById("password");
	var elemVerify = document.getElementById("verify");
	var elemFirstName = document.getElementById("first_name");
	var elemSurName = document.getElementById("sur_name");
	var elemCity = document.getElementById("city");
	var elemAddress = document.getElementById("address");
	var elemPhone = document.getElementById("phone");

	var password = "password=" + elemPassword.value;
	var verify = "verify=" + elemVerify.value;
	var firstName = "first_name=" + elemFirstName.value;
	var surName = "sur_name=" + elemSurName.value;
	var city = "city=" + elemCity.value;
	var address = "address=" + elemAddress.value;
	var phone = "phone=" + elemPhone.value;
	
	var entityInfo = "request=ajax&" + password + "&" + verify + "&" + firstName + "&" + surName + "&" + city + "&" + address + "&" + phone;

	var url = "/user/update";
	request.open("POST", url, true);
	request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	
	request.onreadystatechange = function () {
		if (request.readyState == 4 && request.status == 200) {
			var return_data = request.responseText;
			
			var output = eval("(" + return_data + ")");

			if (output == true) {
				el = document.getElementsByTagName("h1");
				el[0].innerHTML = 'הפרטים עודכנו בהצלחה';
				el = document.getElementById('updating_form');
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

function returnToHome() {
	window.location = '/';
}

function createRequest() {
	if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
		request = new XMLHttpRequest();
		// code for other IE
		//request = new ActiveXObject("Msxml2.XMLHTTP");
	} else if (window.ActiveXObject) {
		// code for IE6, IE5
		request = new ActiveXObject("Microsoft.XMLHTTP");
	} else {
		// failed
		request = null;
	}

	return request;
}
