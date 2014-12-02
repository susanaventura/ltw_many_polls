/*http://stackoverflow.com/questions/901115/how-can-i-get-query-string-values-in-javascript*/
function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}


function validateLogin(){
	var errorMsg = document.getElementById('errorMsg');
	
	$.ajax({
        type: "POST",
        url: "../php/action_login.php",
        data: {username : document.forms["loginForm"]["username"].value, password : document.forms["loginForm"]["password"].value},
		dataType: 'json',
        success: function (res){
			console.log(res);
			if(res['correctLogin']===true) {errorMsg.textContent = "OK"; return true;}
			else {errorMsg.textContent = "Wrong password or username!"; return false;}
		},
		error: function(res, status) {
			console.log(res);
			console.log(status);
			return false;
        }
    });
}


function validatePollSubmit(username, id){
	var errorMsg = document.getElementById('errorMsg');
	
	if(!username) {
		errorMsg.textContent = "You must login first!";
		login();
		return false;
	}
	else {
		var question = document.forms["EditPollForm"]["question"].value;
		
		if(question == ""){errorMsg.textContent = "You must provide a question!"; return false;}
		if(choiceCnt <= 1) {errorMsg.textContent = "You must provide at least two different choices!"; return false;}
		
	/*
		$.ajax({
        type: "POST",
        url: "../php/action_submitPoll.php",
        data: {id : username : document.forms["loginForm"]["username"].value, password : document.forms["loginForm"]["password"].value},
		dataType: 'json',
        success: function (res){
			console.log(res);
			if(res['correctLogin']===true) {errorMsg.textContent = "OK"; return true;}
			else {errorMsg.textContent = "Wrong password or username!"; return false;}
		},
		error: function(res, status) {
			console.log(res);
			console.log(status);
			return false;
        }
    });
		*/
			
	}
}
