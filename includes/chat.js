function loadMessages() {
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("chat-box").innerHTML = this.responseText;
		}
	};

	var url = window.location.href;

	var chunk = url.split('=');

	xhttp.open("GET", "getMessages.php?user=" + chunk[1], true);
	xhttp.send();
}
setInterval(function() {
	loadMessages();
}, 500);