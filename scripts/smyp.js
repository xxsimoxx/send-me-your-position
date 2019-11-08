var destphone=js_params.wa;

function smypCanLocate(){
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
	document.getElementById("smyp-error").innerHTML=js_params.geo_error;
	smypButtonDisable();
}

function sendPosition(position) {
	if (js_params.askname){
		var person=prompt(js_params.person_message);
		var message=encodeURIComponent(person+"\n");
	} else {
		var message="";
	}
	var mapsUrl="https://www.google.com/maps/search/?api=1&query=" + position.coords.latitude+","+position.coords.longitude;
	var WAapi = "https://api.whatsapp.com/send?phone="+destphone+"&text="+message+encodeURIComponent(mapsUrl);
	window.open(WAapi,'_self',false)
}

window.onload = function() {
	smypCanLocate();
}