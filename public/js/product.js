window.onload = function() {
	var url = window.location.pathname;
	url = url.split("/");
	productId = url[url.length-1];

	setInterval(function() {
			getAllReviews(productId);
		}, 1000);
}

function addReviewWindow(productId, userId) {
	var el = document.getElementById('add_review');
	var rev = document.getElementById('review');
	var area = document.createElement('textarea');
	var buttons = document.createElement('div');
	var submitButton = document.createElement('input');
	var cancelButton = document.createElement('input');
	var radioButtons = new Array();
	var radioLabels = new Array();
	
	el.disabled = true;
	
	area.id = 'user-review';
	area.name = 'user-review';
	area.maxLength = 250;
	area.cols = 80;
	area.rows = 7;
	rev.appendChild(area);
	
	submitButton.id = 'submitButton';
	submitButton.type = 'submit';
	submitButton.value = 'הוסף תגובה';
	submitButton.setAttribute('onClick', 'addReview(' + productId + ',' + userId + ');');
	
	cancelButton.id = 'cancelButton';
	cancelButton.type = 'submit';
	cancelButton.value = 'ביטול';
	cancelButton.setAttribute('onClick', 'cancelReview();');
	
	for (var i=0; i<5; i++) {
		var name = i+1;
		name = 'radio' + name;
		radioButtons[i] = document.createElement('input');
		radioButtons[i].id = name;
		radioButtons[i].type = 'radio';
		radioButtons[i].name = 'rank';
		radioButtons[i].value = i+1;
		radioLabels[i] = document.createElement('label');
		radioLabels[i].htmlFor = name;
		radioLabels[i].appendChild(document.createTextNode(i+1));
	}
	
	buttons.id = 'buttons';
	buttons.appendChild(submitButton);
	buttons.appendChild(cancelButton);

	for (var i=0; i<5; i++) {
		buttons.appendChild(radioButtons[i]);
		buttons.appendChild(radioLabels[i]);
	}
	
	rev.appendChild(buttons);
}

function addToCart() {
	// not Available right now
}

function cancelReview() {
	var el = document.getElementById('add_review');
	var rev = document.getElementById('review');
	
	el.disabled = false;
	
	while (rev.hasChildNodes()) {
		rev.removeChild(rev.lastChild);
	}
}

function addReview(productId, userId) {
	var request = createRequest();

	if (request == null) {
		alert("Error");
		return;
	}
	
	var area = document.getElementById('user-review');
	var radioButtonlist = document.getElementsByName('rank');
	
	var review = area.value;
	
	for (var i=0; i<radioButtonlist.length; i++) {
		if (radioButtonlist[i].checked) {
			var grade = radioButtonlist[i].value;
		}
	}
	
	var product = 'product=' + productId;
	var user = 'reviewed_by=' + userId;
	var text = 'text=' + review;
	
	if (grade == undefined) {
		grade = null;
	}
	grade = 'grade=' + grade;

	var entityInfo = 'request=ajax&' + product + '&' + user + '&' + text + '&' + grade;
	
	var url = "/product/addReview";
	request.open("POST", url, true);
	request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

	request.onreadystatechange = function () {
		if (request.readyState == 4 && request.status == 200) {
			var return_data = request.responseText;

			var output = eval("(" + return_data + ")");
			
			var id = output['id'];
			var name = output['username'];
			var reviewedDate = output['reviewed_date'];
			var grade = output['grade'];
			var reviewText = output['text'];
			
			var elem = document.getElementById('reviews');
			
			insertReview(id, name, reviewedDate, grade, reviewText, elem);
			cancelReview();
		}
	}
	
	request.send(entityInfo);
}

function insertReview(id, name, reviewedDate, grade, reviewText, elem) {
	var reviewElem = document.createElement('div');
	var reviewTitle = document.createElement('div');
	var reviewName = document.createElement('div');
	var reviewDate = document.createElement('div');
	var reviewBody = document.createElement('div');
	
	reviewName.className = 'review-info';
	reviewDate.className = 'review-info';
	reviewTitle.className = 'review_title';
	reviewBody.className = 'review_body';
	reviewBody.id = 'review' + id;
	
	reviewName.innerHTML = 'שם: ' + name;
	reviewedDate = new Date(reviewedDate)
	reviewDate.innerHTML = 'תאריך: ' + formatedDate(reviewedDate);
	
	reviewTitle.appendChild(reviewName);
	reviewTitle.appendChild(reviewDate);

	if (grade) {
		var reviewGrade = document.createElement('div');
		reviewGrade.className = 'grades';
		reviewGrade.innerHTML = 'ציון: ' + grade;
		reviewTitle.appendChild(reviewGrade);
	}
	
	reviewBody.innerHTML = reviewText;
	
	reviewElem.appendChild(reviewTitle);
	reviewElem.appendChild(reviewBody);
	reviewElem.id = 'review_' + id;
	
	elem.insertBefore(reviewElem, elem.firstChild);
}

function getAllReviews(productId) {
	var request = createRequest();

	if (request == null) {
		alert("Error");
		return;
	}
	
	var product = 'product=' + productId;
	
	var entityInfo = 'request=ajax&' + product;
	
	var url = "/product/getReviews";
	request.open("POST", url, true);
	request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

	request.onreadystatechange = function () {
		if (request.readyState == 4 && request.status == 200) {
			var return_data = request.responseText;

			var output = eval("(" + return_data + ")");

			var elem = document.getElementById('reviews');
			clearAllReviews(elem);
			
			for (var i =0; i < output.length; i++) {
				var id = output[i]['id'];
				var name = output[i]['username'];
				var reviewedDate = output[i]['reviewed_date'];
				var grade = output[i]['grade'];
				var reviewText = output[i]['text'];
				
				insertReview(id, name, reviewedDate, grade, reviewText, elem);
			}
		}
	}
	
	request.send(entityInfo);
}

function clearAllReviews(elem) {
	while (elem.hasChildNodes()) {
		elem.removeChild(elem.lastChild);
	}
}

function formatedDate(date) {
	var day = date.getDate();
	var month = date.getMonth() +1;
	var year = date.getFullYear();
	var hour = date.getHours();
	var minutes = date.getMinutes();
	
	if (day < 10) {
		day = '0' + day;
	}
	if (month < 10) {
		month = '0' + month;
	}
	if (hour < 10) {
		hour = '0' + hour;
	}
	if (minutes < 10) {
		minutes = '0' + minutes;
	}
	
	date = day + '/' + month + '/' + year + ' ' + hour + ':' + minutes;
	return date;
}

function createRequest() {
	if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
		request = new XMLHttpRequest();
	} else if (window.ActiveXObject) {
		// code for IE6, IE5
		request = new ActiveXObject("Microsoft.XMLHTTP");
		// code for other IE
	} else {
		// failed
		request = null;
	}

	return request;
}
