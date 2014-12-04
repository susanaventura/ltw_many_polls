
/*http://stackoverflow.com/questions/901115/how-can-i-get-query-string-values-in-javascript*/
function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}

function validateLogin() {
	var errorMsg = document.getElementById('errorMsg');

	$.ajax({
        type: "POST",
        url: "../php/action_login.php",
        data: {username : document.forms["loginForm"]["username"].value, password : document.forms["loginForm"]["password"].value},
		dataType: 'json',
        success: function (res){
			console.log(res);
			if(res['correctLogin']===true) {errorMsg.textContent = "OK"; location.reload(); return true;}
			else {errorMsg.textContent = "Wrong password or username!"; return false;}
		},
		error: function(res, status) {
			console.log(res);
			console.log(status);
			return false;
        }
    });
}

function validateSignup() {
	var errorMsg = document.getElementById('errorMsg');

	$.ajax({
        type: "POST",
        url: "../php/action_signup.php",
        data: { username : $ESAPI.encoder().encodeForHTML(document.forms["submitForm"]["username"].value), 
				password : document.forms["submitForm"]["password"].value,
				birth :  $ESAPI.encoder().encodeForHTML(document.forms["submitForm"]["birth"].value),
				email :  $ESAPI.encoder().encodeForHTML(document.forms["submitForm"]["email"].value),
				firstname :  $ESAPI.encoder().encodeForHTML(document.forms["submitForm"]["firstname"].value),
				lastname :  $ESAPI.encoder().encodeForHTML(document.forms["submitForm"]["lastname"].value)
			  },
		dataType: 'json',
        success: function (res){
			console.log(res);
			if(res['correctSignup']===true) {errorMsg.textContent = "OK"; location.reload(); return true;}
			else {errorMsg.textContent = res['errorMsg']; return false;}
		},
		error: function(res, status) {
			console.log(res);
			console.log(status);
			return false;
        }
    });
}


function repeatedChoices(choices){
	var choices_aux = [];
	
	for(var i = 0; i < choices.length; i++){
		if($.inArray(choices[i], choices_aux) != -1)
			return false;
		
		choices_aux.push(choices[i]);	
	}
	
	return true;
}


function validatePollSubmit(user, token){
	
	var allChoices = document.getElementsByName('choices[]');
	
	var choices_array = [];
	for(var i = 0; i < allChoices.length; i++){
		choices_array.push(allChoices[i].value);
	}
	
	var errorMsg = document.getElementById('errorMsg');
	
	if(!user) {
		errorMsg.textContent = "You must login first!";
		login();
		return false;
	}
	else {
		var question = document.forms.EditPollForm.question.value;
		
		if(question == ""){errorMsg.textContent = "You must provide a question!"; return false;}
		if(choiceCnt <= 1) {errorMsg.textContent = "You must provide at least two different choices!"; return false;}
		if( !repeatedChoices(choices_array) ){errorMsg.textContent = "All choices must be different!"; return false;}
	
		console.log(JSON.stringify(choices_array));
		console.log(token);
		console.log(document.forms.EditPollForm.pollTitle.value);
		//console.log(document.forms["settingsForm"]["multSelect"].val());
	
		//TODO CHECK BOX VALUE ???
		
		$.ajax({
			type: "POST",
			url: "../php/action_submitPoll.php",
			data: {	csrf_token : token,
					question : document.forms.EditPollForm.question.value,
					title : document.forms.EditPollForm.pollTitle.value,
					image : "http://placehold.it/300&text=placehold.it+rocks!",
					multipleAnswer : "0",
					isPrivate : "0",
					answers : JSON.stringify(choices_array)},
			dataType: 'json',
			success: function (res){
				console.log(res);
				if(res['pollSubmitted']===true) {alert("OK"); return true;}
				else  {alert("invalid credentials"); return true;}
			},
			error: function(res, status) {
				console.log(res);
				console.log(status);
				return false;
			}
		});
		
	}
			
}

