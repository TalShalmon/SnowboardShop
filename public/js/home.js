
window.onload = window.onresize = function() {

	var request = createRequest();

	if (request == null) {
		alert("Error");
		return;
	}
	
	var content_width = document.getElementById("content").offsetWidth; 
	
	var entityInfo = "request=ajax";
	
	var url = "/home/getProductsList";
	request.open("GET", url, true);

	request.onreadystatechange = function () {
		if (request.readyState == 4 && request.status == 200) {
			var return_data = request.responseText;
			
			var output = eval("(" + return_data + ")");

			document.getElementById("productsWaiting").innerHTML = "";
			
			var t = document.getElementById("productsList");
			var u = document.getElementById("listProducts");
			if (u != null) {
				t.removeChild(u);
			}
			var e = document.createElement('ul');
			e.id = 'listProducts';
			t.appendChild(e);
			e.className = 'prods';
			t.innerHTML += '</ul>';

			for(var i=0; i < output.length; i++) {
				writeInfo(output[i].id, output[i].name, output[i].price, content_width/4);
			}
		}
	}
	request.send(entityInfo);
	document.getElementById("productsWaiting").innerHTML = "בטיפול...";
}

function writeInfo(id, name, price, curr_width) {
	var l = document.getElementById("listProducts");
	var e = document.createElement('li');
	e.id = 'info' + id;
	e.className = 'prods';
	e.style.width = curr_width + 'px';
	l.appendChild(e);
	e.innerHTML += '<a href="product/showInfo/' + id + '" onClick="getInfo(' + "'" + id + "'" + ');return false"><img src="public/images/' + name + '.png" height=250 border=0 /></a><div class="prod-name">' + name + '</div><div class="prod-price">מחיר: ₪' + price + '</div></li>';
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
