var destphone="+393473650691";

function getLocation() {
	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(sendPosition);
	} else {
		console.log("Geolocation is not supported by this browser.");
	}
}

function smypSend(){
	console.log("Button");
}

function sendPosition(position) {
	var person = prompt("Please enter your name.");
	var mapsUrl="https://www.google.com/maps/search/?api=1&pquery=" + position.coords.latitude+","+position.coords.longitude;
	var message=encodeURIComponent(person+"\n");
	var WAapi = "https://api.whatsapp.com/send?phone="+destphone+"&text="+message+encodeURIComponent(mapsUrl);
	window.open(WAapi,'_self',false);
}

function canLocate(){
	navigator.permissions.query({ name: 'geolocation' }).then(console.log)
}

window.onload = function() {

alert("JS");

  canLocate();
};