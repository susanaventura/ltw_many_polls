function showInformationDialog(text, action){
	
	var confirmationDialog = document.getElementById("confirmationModal");
	$(confirmationDialog).find("#yesBtn").remove();
	$(confirmationDialog).find("#noBtn").text("Ok");
	$( "#confirmation" ).text( text );
	
	if(action === "reload"){
		$(confirmationDialog).find("#noBtn").one('click', function(){
			location.reload();
		});
	}
	
	
	$(confirmationDialog).modal('show');
	
	
}


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
		choices_array.push($ESAPI.encoder().encodeForHTML(allChoices[i].value));
	}
	
	var errorMsg = document.getElementById('errorMsg');
	
	if(user == 'anonymous') {
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
		
		console.log($('#multSelect').is(":checked"));
		//$(this).hasClass('active')
		console.log($('#multSelect').is(":checked"));
		
		console.log(getPrivacy());
		
		var multiple;
		if($('#multSelect').is(":checked")) multiple = "1"; else multiple = "0";

		//envia a imagem maior
		var img = $("#img-preview").attr('src');
		console.log(img);
		
		$.ajax({
			type: "POST",
			url: "../php/action_submitPoll.php",
			data: {	csrf_token : token,
					question : $ESAPI.encoder().encodeForHTML(document.forms.EditPollForm.question.value),
					title : $ESAPI.encoder().encodeForHTML(document.forms.EditPollForm.pollTitle.value),
					image : img,
					multipleAnswer : multiple,
					isPrivate : getPrivacy(),
					voteLabel : $("#voteLabel").val(),
					resultsLabel : $("#resultsLabel").val(),
					answers : JSON.stringify(choices_array)},
			dataType: 'json',
			success: function (res){
				console.log(res);
				if(res['pollSubmitted']===true) {alert("OK"); window.location.replace("../php/pollsListPage.php?searchText=MyPolls"); return true;}
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


function validateSubmitVote(username, token, pollId, questionId){
	var errorMsg = document.getElementById('errorMsg');
	
	//check if at least one choice is checked
	if ($("input[name='choice']:checked").length == 0) {  
		errorMsg.textContent = "You must select a choice!";
        return false;
    }
	else{
		errorMsg.textContent = "";
			
		var choices_array = [];
		$("input[name='choice']:checked").each(function(){
			console.log($(this).val());
			choices_array.push($(this).val());
		});
		
		$.ajax({
			type: "POST",
			url: "../php/action_submitVote.php",
			data: {	user : username,
					poll : pollId,
					csrf_token : token,
					answers : JSON.stringify(choices_array)},
			dataType: 'json',
			success: function (res){
				console.log(res);
				if(res['voteSubmitted']===true) {
					$("input[name='choice']").each(function(){
						if($(this).attr("checked") == true)
							$(this).parent('.wrapperChoice').addClass('withBorder');
						$(this).attr("disabled", true);
					});
					$("#voteButton").attr('disabled','disabled');
					showResults(questionId);
					//document.getElementById('resultsBtn').show();
					return true;
				} else  {
					alert("Invalid credentials"); 
					return true;
				}
			},
			error: function(res, status) {
				console.log(res);
				console.log(status);
				return false;
			}
		});
		
		
		return true;
	}
}



function validateNewAccountSettings(oldPsw, token){

	//ask for confirmation
	var confirmationDialog = document.getElementById("confirmationModal");

	$( "#confirmation" ).text( "Do you really want to change your account settings?" );

	$(confirmationDialog).find("#yesBtn").one('click', function(e){
		e.preventDefault();
		
		//ask for other confirmation (psw)
		var newPsw = document.forms["submitForm"]["password"].value;
		
		if(newPsw.length > 0)
			showPswDialog(newPsw, token);
		else {newPsw = oldPsw; changeSettings(newPsw, token);}
				
	});
		
	$(confirmationDialog).modal('show');
}

function showPswDialog(newPsw, token){
	
	var dialog = document.getElementById('confirmationPsw');
	
	dialog.innerHTML = "<div class='modal-dialog'>"+
							"<div class='modal-content'>"+
							  "<!-- dialog header -->"+
							  "<div class='modal-header'>"+
								  "<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>×</button>"+
								 "<h4 class='modal-title'>Changing password!</h4>"+
							  "</div>"+
							  "<!-- dialog body -->"+
							  "<div class='modal-body'>"+
								"<form role='form' name='newPswForm'>"+
									"<div id='form-group-newpsw' class='form-group'>"+
										"<p>You are trying to change your password. Please confirm the new password.</p>"+
										"<label for='newpsw' class='col-md-3 control-label'>Confirm new password</label>"+
										"<div class='col-md-9'>"+
											"<input type='password' class='form-control' name='newpsw' placeholder='Your new password' required>"+
										"</div>"+
									"</div>"+
								"</form>"+
							  "</div>"+
							  "<!-- dialog buttons -->"+
							  "<div class='modal-footer'>"+
								"<button id='yesBtn' type='submit' class='btn btn-primary'>Confirm</button>"+
								"<button id='noBtn' type='button' class='btn btn-primary' data-dismiss='modal' aria-hidden='true'>Cancel</button>"+
							   "</div>"+
							"</div>"+
						"</div>";
					
	$(dialog).find("#yesBtn").one('click', function(e){
		e.preventDefault();

		if(document.forms["newPswForm"]["newpsw"].value === newPsw)
			{
				$(dialog).find("#form-group-newpsw").addClass("has-success");
				changeSettings(newPsw, token);
				return true;
			}
			else {
				$(dialog).find("#form-group-newpsw").addClass("has-error");
				return false;
			}
		
	});
					
	$(dialog).modal('show');
}

function changeSettings(newPsw, token){
	$.ajax({
		type: "POST",
		url: "../php/action_changeAccountSettings.php",
		data: { username : $ESAPI.encoder().encodeForHTML(document.forms["submitForm"]["username"].value), 
				password : newPsw,
				birthDate :  $ESAPI.encoder().encodeForHTML(document.forms["submitForm"]["birth"].value),
				firstName :  $ESAPI.encoder().encodeForHTML(document.forms["submitForm"]["firstname"].value),
				lastName :  $ESAPI.encoder().encodeForHTML(document.forms["submitForm"]["lastname"].value),
				csrf_token : token
			  },
		dataType: 'json',
		success: function (res){
			console.log(res);
			if(res['status']===true) {
			location.reload(); 
			var dialog = document.getElementById('confirmationPsw');
			$(dialog).modal('hide');
			dialog = document.getElementById('confirmationModal');
			$(dialog).modal('hide');
			return true;}
			else {alert("error");  return false;}
		},
		error: function(res, status) {
			console.log(res);
			console.log(status);
			return false;
		}
	});	
}
