var destphone=js_params.wa;
var messagebox=document.getElementById("smyp-message");

function smypCanLocate(){
	navigator.permissions.query({name:'geolocation'}).then(function(result) {
		if (result.state == 'prompt') {
			messagebox.innerHTML=js_params.geo_prompt;
			messagebox.classList.add("smyp-warn");
			messagebox.classList.remove("smyp-error");
		} else if (result.state == 'denied') {
			messagebox.innerHTML=js_params.geo_error;
			messagebox.classList.add("smyp-error");
			messagebox.classList.remove("smyp-warn");
			smypButtonDisable();
		}
	});
}

function smypButtonDisable(){
	var btns = document.getElementsByClassName("smyp-button");
	for (var i = 0; i < btns.length; i++) {
	  btns[i].disabled =true;
	}
}

function smypSend() {
	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(sendPosition, failPosition);
	}
}

function failPosition(){
	messagebox.innerHTML=js_params.geo_error;
	messagebox.classList.remove("smyp-warn");
	messagebox.classList.add("smyp-error");
	smypButtonDisable();
}

function sendPosition(position) {
	if (js_params.askname){
		var person=prompt(js_params.person_message);
		var message=person+"\r\n";
	} else {
		var message="";
	}
	var mapsUrl="https://www.google.com/maps/search/?api=1&query=" + position.coords.latitude+","+position.coords.longitude;
	message=encodeURIComponent(message+mapsUrl);
	var WAapi = "https://wa.me/"+destphone+"?text="+message;
	window.open(WAapi,'_self',false)
}

window.onload = function() {
	smypCanLocate();
}