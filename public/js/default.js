function logout() {
	var request = createRequest();

	if (request == null) {
		alert("Error");
		return;
	}
	
	var entityInfo = "request=ajax";
	
	var url = "/user/logout";
	request.open("GET", url, true);

	request.onreadystatechange = function () {
		if (request.readyState == 4 && request.status == 200) {
			window.location = document.URL;
		}
	}
	request.send(entityInfo);
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
