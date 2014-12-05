



var pollDialog; 
function showPoll($pollTitle){
	//var $poll = document.getElementById('value').value;
	//alert($pollTitle);
	
	pollDialog = $('<div></div>').load("http://paginas.fe.up.pt/~ei12009/projeto/php/templates/pollX.php");
	
	$(pollDialog).find("#modalPoll").addClass("modal fade");
	$(pollDialog).find("#modalPoll").attr("tabindex", "-1");
	$(pollDialog).find("#modalPoll").attr("role", "dialog");
	$(pollDialog).find("#modalPoll").attr("aria-labelledby", "modalPollLabel");
	$(pollDialog).find("#modalPoll").attr("aria-hidden", "true");
	
	$('#modal_container').empty();
	$('#modal_container').append($(pollDialog));
	
	//change data

	/*$coiso = $(pollDialog).find("#title #titleText");
	$coiso.text($pollTitle['title']);
	$nhe = $(pollDialog).find("#title #userText");
	$nhe.text($pollTitle['title']);*/
	
	
	$(pollDialog).find("#modalPoll").modal('show');
		
};
//$(loginDialog).find("#modalLogin").modal('show');

function removePoll(pollId, token){
	
	//ask for confirmation
	var confirmationDialog = document.getElementById("confirmationModal");
	$( "#confirmation" ).text( "Are you sure you want to remove the poll?" );
		
	$(confirmationDialog).find("#yesBtn").one('click', function(e){
		e.preventDefault();
			$.ajax({
			type: "POST",
			url: "../php/action_removePoll.php",
			data: {id : pollId, csrf_token : token},
			dataType: 'json',
			success: function (res){
				console.log(res);
				if(res['status']===true) {
					//$(confirmationDialog).modal('hide');
					//location.reload();
					showInformationDialog("Poll removed", "reload");
					return false;
				} else {
					alert("Invalid credentials!");
					return true;
				}
				
			},
			error: function(res, status) {
				console.log(res);
				console.log(status);
				return false;
			}
		});	
	});
	
	$(confirmationDialog).modal('show');

}

function changePollPrivacy(pollId, privacy, token){
	
	var confirmationDialog = document.getElementById("confirmationModal");
	if(privacy === "1")
		{
			$( "#confirmation" ).text( "Do you really want to change the privacy to public? All users will be able to see your poll!" );
			privacy = "0";
		}
	else
		{
			$( "#confirmation" ).text( "Do you really want to change the privacy to private? Users won't be able to see your poll!" );
			privacy = "1";
		}
	
	
	
	$(confirmationDialog).find("#yesBtn").one('click', function(e){
		e.preventDefault();
			$.ajax({
			type: "POST",
			url: "../php/action_changePollPrivacy.php",
			data: {id : pollId, isPrivate : privacy, csrf_token : token},
			dataType: 'json',
			success: function (res){
				console.log(res);
				if(res['status']===true) {
					//$(confirmationDialog).modal('hide');
					//location.reload();
					showInformationDialog("New privacy set!", "reload");
					return false;
				} else {
					alert("Invalid credentials!");
					return true;
				}
				
			},
			error: function(res, status) {
				console.log(res);
				console.log(status);
				return false;
			}
		});	
	});
	
	$(confirmationDialog).modal('show');
	
}



$('.modal').on('shown.bs.modal', function() {
    $(this).find('.modal-dialog-center').css({
        'margin-top': function () {
            return -($(this).outerHeight() / 2);
        },
        'margin-left': function () {
            return -($(this).outerWidth() / 2);
        }
    });
});
