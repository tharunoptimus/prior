function chat_ajax(){

	var req = new XMLHttpRequest();
	req.onreadystatechange = function() {
		if(req.readyState == 4 && req.status == 200){
			document.getElementById('announcements_div').innerHTML = req.responseText;
		}
	}
	req.open('GET', 'chat.php', true);
	req.send(); 
}

setInterval(function(){chat_ajax()}, 2000)

function notifyMe() {

	if (!("Notification" in window)) {
		alert("This browser does not support system notifications");
	}
	else if (Notification.permission === "granted") {
		notify();
	}
	else if (Notification.permission !== 'denied') {
		Notification.requestPermission(function (permission) {
	if (permission === "granted") {
		notify();
	}

	});

}

function notify() {

	var notification = new Notification('You got a new Prior!', {
		icon: 'assets/images/p.png',
		body: "Visit the website to know more about it.",
	});

	notification.onclick = function () { window.open("https://example.com/"); //Redirect to the website     
}; 

;}}
