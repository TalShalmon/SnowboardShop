window.onload = function() {
	fillManufactureList();
	fillProfileTypeList();
	fillWidthList();
	fillAbilityLevelList();
	fillGenderList();
}

function fillManufactureList() {
	var request = createRequest();

	if (request == null) {
		alert("Error");
		return;
	}
	
	var entityInfo = "request=ajax";
	
	var url = "/product/getManufactureList";
	request.open("GET", url, true);

	request.onreadystatechange = function () {
		if (request.readyState == 4 && request.status == 200) {
			var return_data = request.responseText;
			
			var output = eval("(" + return_data + ")");
			
			var t = document.getElementById("manufacture");
			var e = document.createElement('option');
			e.value = 0;
			t.appendChild(e);
			e.innerHTML += 'בחר יצרן...</option>';
			
			for(var i=0; i < output.length; i++) {
				writeInfo("manufacture", output[i].id, output[i].name);
			}
		}
	}
	request.send(entityInfo);
}

function fillProfileTypeList() {
	var request = createRequest();

	if (request == null) {
		alert("Error");
		return;
	}
	
	var entityInfo = "request=ajax";
	
	var url = "/product/getProfileTypeList";
	request.open("GET", url, true);

	request.onreadystatechange = function () {
		if (request.readyState == 4 && request.status == 200) {
			var return_data = request.responseText;
			
			var output = eval("(" + return_data + ")");
			
			var t = document.getElementById("profiletype");
			var e = document.createElement('option');
			e.value = 0;
			t.appendChild(e);
			e.innerHTML += 'בחר סוג פרופיל...</option>';
			
			for(var i=0; i < output.length; i++) {
				writeInfo("profiletype", output[i].id, output[i].name);
			}
		}
	}
	request.send(entityInfo);
}

function fillWidthList() {
	var request = createRequest();

	if (request == null) {
		alert("Error");
		return;
	}
	
	var entityInfo = "request=ajax";
	
	var url = "/product/getWidthList";
	request.open("GET", url, true);

	request.onreadystatechange = function () {
		if (request.readyState == 4 && request.status == 200) {
			var return_data = request.responseText;
			
			var output = eval("(" + return_data + ")");
			
			var t = document.getElementById("width");
			var e = document.createElement('option');
			e.value = 0;
			t.appendChild(e);
			e.innerHTML += 'בחר רוחב...</option>';
			
			for(var i=0; i < output.length; i++) {
				writeWidthInfo(output[i].id, output[i].name, output[i].min, output[i].max);
			}
		}
	}
	request.send(entityInfo);
}

function fillAbilityLevelList() {
	var request = createRequest();

	if (request == null) {
		alert("Error");
		return;
	}
	
	var entityInfo = "request=ajax";
	
	var url = "/product/getAbilityLevelList";
	request.open("GET", url, true);

	request.onreadystatechange = function () {
		if (request.readyState == 4 && request.status == 200) {
			var return_data = request.responseText;
			
			var output = eval("(" + return_data + ")");
			
			var t = document.getElementById("abilitylevel");
			var e = document.createElement('option');
			e.value = 0;
			t.appendChild(e);
			e.innerHTML += 'בחר רמת קושי...</option>';
			
			for(var i=0; i < output.length; i++) {
				writeInfo("abilitylevel", output[i].id, output[i].name);
			}
		}
	}
	request.send(entityInfo);
}

function fillGenderList() {
	var request = createRequest();

	if (request == null) {
		alert("Error");
		return;
	}
	
	var entityInfo = "request=ajax";
	
	var url = "/product/getGenderList";
	request.open("GET", url, true);

	request.onreadystatechange = function () {
		if (request.readyState == 4 && request.status == 200) {
			var return_data = request.responseText;
			
			var output = eval("(" + return_data + ")");
			
			var t = document.getElementById("gender");
			var e = document.createElement('option');
			e.value = 0;
			t.appendChild(e);
			e.innerHTML += 'בחר מגדר...</option>';
			
			for(var i=0; i < output.length; i++) {
				writeInfo("gender", output[i].id, output[i].name);
			}
		}
	}
	request.send(entityInfo);
}

function writeInfo(elemName, id, name) {
	var t = document.getElementById(elemName);
	var e = document.createElement('option');
	e.value = id;
	t.appendChild(e);
	e.innerHTML += name + '</option>';
}

function writeWidthInfo(id, name, min, max) {
	var t = document.getElementById('width');
	var e = document.createElement('option');
	e.value = id;
	t.appendChild(e);
	
	if (min == null) {
		min = '';
	}
	if (max == null) {
		max = '';
	}

	e.innerHTML += name + ' (' + min + ' - ' + max + ')</option>';
}

function checkName() {
	var elem = document.getElementById("name");

	var request = createRequest();

	if (request == null) {
		alert("Error");
		return;
	}
	
	var entityInfo = "request=ajax&name=" + elem.value;

	var url = "/product/checkProductExists";
	request.open("POST", url, true);
	request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	
	request.onreadystatechange = function () {
		if (request.readyState == 4 && request.status == 200) {
			var return_data = request.responseText;
			var el = document.getElementById("name-msg");
			
			return_data = eval("(" + return_data + ")");
			
			if (return_data == true) {
				el.style.color = 'red';
				el.innerHTML = 'קיים פריט בשם זה';
				elem.focus();
				elem.value = '';
			}
		}
	}
	request.send(entityInfo);
}

function triggerPictureUpload() {
	document.getElementById("pic_upload").click();
}

function addProduct(files) {
	
	var request = createRequest();
	
	if (request == null) {
		alert("Error");
		return;
	}
	
	var elemName = document.getElementById("name");
	var elemManufacture = document.getElementById("manufacture");
	var elemProfileType = document.getElementById("profiletype");
	var elemSize = document.getElementById("size");
	var elemWidth = document.getElementById("width");
	var elemAbilityLevel = document.getElementById("abilitylevel");
	var elemGender = document.getElementById("gender");
	var elemPrice = document.getElementById("price");

	var name = "name=" + elemName.value;
	var manufacture = "manufacture=" + elemManufacture.value;
	var profiletype = "profile_type=" + elemProfileType.value;
	var size = "size=" + elemSize.value;
	var width = "width=" + elemWidth.value;
	var abilitylevel = "ability_level=" + elemAbilityLevel.value;
	var gender = "gender=" + elemGender.value;
	var price = "price=" + elemPrice.value;
	
	var entityInfo = "request=ajax&" + name + "&" + manufacture + "&" + profiletype + "&" + size + "&" + width + "&" + abilitylevel + "&" + gender + "&" + price;

	var url = "/product/addProduct";
	request.open("POST", url, true);
	request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	
	request.onreadystatechange = function () {
		if (request.readyState == 4 && request.status == 200) {
			var return_data = request.responseText;
			
			var output = eval("(" + return_data + ")");
			
			if (output == true) {
				el = document.getElementsByTagName("h1");
				el[0].innerHTML = 'המוצר הוסף בהצלחה';
				el = document.getElementById('add_product_form');
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
