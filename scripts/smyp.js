var destphone=js_params.wa;

function canLocate(){
	navigator.permissions.query({name:'geolocation'}).then(function(result) {
		if (result.state == 'prompt') {
			document.getElementById("smyp-error").innerHTML=js_params.geo_prompt;
		} else if (result.state == 'denied') {
			document.getElementById("smyp-error").innerHTML=js_params.geo_error;
			smypButtonDisable();
		}
	});
	
}

function smypButtonDisable(){
	var elements = document.getElementsByClassName("smyp-button");
	for (var i = 0; i < elements.length; i++) {
	  elements[i].disabled =true;
	}
}

function smypSend() {
	if (js_params.debug){
		console.log("Button pressed");
	}
	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(sendPosition, failPosition);
	} else {
		if (js_params.debug){
			console.log("smyp: geolocation is not supported by this browser.");
		}
	}
}

function failPosition(error){
	document.getElementById("smyp-error").innerHTML=js_params.geo_error;
	smypButtonDisable();
	if (js_params.debug){
		var errorType = {
			0: "Unknown Error",
			1: "Permission denied by the user",
			2: "Position of the user not available",
			3: "Request timed out"
		};
		var errMsg = errorType[error.code];
		if(error.code == 0 || error.code == 2){
			errMsg = errMsg+" - "+error.message;
		}
		console.log("smyp: "+errMsg);
	}
}

function sendPosition(position) {
	if (js_params.askname){
		var person = prompt(js_params.person_message);
	}
	var mapsUrl="https://www.google.com/maps/search/?api=1&query=" + position.coords.latitude+","+position.coords.longitude;
	var message=encodeURIComponent(person+"\n");
	var WAapi = "https://api.whatsapp.com/send?phone="+destphone+"&text="+message+encodeURIComponent(mapsUrl);
	window.open(WAapi,'_self',false)
}

window.onload = function() {
	canLocate();
	if (js_params.debug){
		console.log("smyp: JS loaded");
		console.log("smyp: wa=" + js_params.wa);
	}
}