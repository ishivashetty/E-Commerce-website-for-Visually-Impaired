
function isNumber(str){
	 var pattern = new RegExp("^[0-9]+$")
	 return pattern.test(str); 
}

function isPrice(str){
	 var pattern = new RegExp("^([0-9]|[0-9]\.[0-9]{1})+$")
	 return pattern.test(str); 
}

function isEmail(str){
	 var pattern = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	 return pattern.test(str); 
}

function isPassword(str){
	 var pattern = new RegExp("^[0-9a-zA-Z]+$")
	 return pattern.test(str); 
}

function speak(voice){
	var msg = new SpeechSynthesisUtterance(voice);
	window.speechSynthesis.speak(msg);
}

function isEmpty(str){
	str = str.trim()
	if(str==undefined || str=="" || str.length==0)
		return true;
	else
		return false;
}

function listen(elementID) {
	
	if (window.hasOwnProperty('webkitSpeechRecognition')) {

		var recognition = new webkitSpeechRecognition();
		recognition.continuous = true;
		recognition.interimResults = true;
		recognition.lang = "en-US";
		recognition.start();

		recognition.onresult = function (e) {
			document.getElementById(elementID).value = e.results[0][0].transcript;
			recognition.stop();
		};
		recognition.onerror = function (e) {
			recognition.stop();
		}
	}
}

function showLogoutPopup(){
	document.getElementById('modalLogout').style.display='block';
}

var recognition = new webkitSpeechRecognition();
recognition.continuous = true;
recognition.interimResults = true;
recognition.lang = "en-US";
		
function toggleMic(title){
	if(title=="Mic Off"){
		document.getElementById("micSearch").title = "Mic On";
		document.getElementById("micSearch").src = "src/images/micon.png";
		
		recognition.start();
		recognition.onresult = function (e) {
			document.getElementById("searchbar").value = e.results[0][0].transcript;
			turnOffMic();
			
		};
		recognition.onerror = function (e) {
			turnOffMic();
		}
	}
	else{
		turnOffMic();
	}	
}

function turnOffMic(){
	recognition.stop();	
	document.getElementById("micSearch").title = "Mic Off";
	document.getElementById("micSearch").src = "src/images/micoff.png";	
}

var searchBarX = document.getElementById("searchbar");
if(searchBarX!=null){
	searchBarX.addEventListener("keyup", function(event) {
	  if (event.keyCode === 13) {
		var valX = searchBarX.value;
		if(!isEmpty(valX)){
			window.location.href = 'ProductDisplay.php?search=' + valX.trim();
		}
	  }
	});
}