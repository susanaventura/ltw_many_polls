
//dynamically add choice field
var choiceCnt = 1; //initial text box count
var maxChoices = 10;
var choiceType = 'checkbox';
function addChoice(divName){
	if(Object.keys(options).length == maxChoices){
		alert("You have reached the number of choices limit ("+choiceCnt+")");
	} else {
		choiceCnt++;
		//add to form
		var newdiv = document.createElement('div');
		newdiv.className = "wrapperChoice";
		newdiv.innerHTML = "<input id='choice"+choiceCnt+"' type='text' class='form-control' name='choices["+choiceCnt+"]' placeholder='Enter choice'> "+
							"<a href='#' id='remove_choice"+choiceCnt+
							"' class='remove_field'>x</a>";
		document.getElementById(divName).appendChild(newdiv);
		
		//add to preview form
		newdiv = document.createElement('div');
		newdiv.className = "wrapperPrevChoice";
		newdiv.innerHTML = "<input type='"+choiceType+"' id='choice"+choiceCnt+"Preview' class='choicePreview' name='choicePrev'> <label class='checkboxLabelNormal' for='choice"+choiceCnt+"Preview'></label>";

		document.getElementById('previewChoices').appendChild(newdiv);
		options['choice'+choiceCnt+'Preview'] = newdiv;
		console.log(options);
	}
};


var loginDialog = $('<div></div>').load("../php/templates/login.php");
function login(){

	$(loginDialog).find("#modalLogin").addClass("modal fade");
	$(loginDialog).find("#modalLogin").attr("tabindex", "-1");
	$(loginDialog).find("#modalLogin").attr("role", "dialog");
	$(loginDialog).find("#modalLogin").attr("aria-labelledby", "modalLoginLabel");
	$(loginDialog).find("#modalLogin").attr("aria-hidden", "true");
	
	$('#modal_container').empty();
	$('#modal_container').append($(loginDialog));
	
	$(loginDialog).find("#modalLogin").modal('show');
		
};

var signupDialog = $('<div></div>').load("../php/templates/signup.php");
function signup(){

	$(signupDialog).find("#modalSignUp").addClass("modal fade");
	$(signupDialog).find("#modalSignUp").attr("tabindex", "-1");
	$(signupDialog).find("#modalSignUp").attr("role", "dialog");
	$(signupDialog).find("#modalSignUp").attr("aria-labelledby", "modalSLabel");
	$(signupDialog).find("#modalSignUp").attr("aria-hidden", "true");
	
	$('#modal_container').empty();
	$('#modal_container').append($(signupDialog));
	
	$(signupDialog).find("#modalSignUp").modal('show');
		
};


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

	
var options = {};

$(document).ready(function(){
		
	options['choice1Preview'] = $('#choice1Preview');
	
	//remove choice
	$("#choiceInput").on("click",".remove_field", function(e){ //user click on remove text
		if(Object.keys(options).length > 1){
			//remove choice from form
			var divId = $(this).attr('id');
			$(this).parent('.wrapperChoice').remove();
			
			//remove from preview
			var prevDivId = "#"+divId.substr(7)+'Preview'; //without 'remove_'
			$(prevDivId).parent('.wrapperPrevChoice').remove();
		
			delete options[divId.substr(7)+'Preview']; 
			console.log(options);
			//choiceCnt--;
			
		} else {alert("You only have one choice field, you cannot remove it");}
	});
	
	
	//update choices
	$("#choiceInput").on("keyup", '.form-control', function(){
		var divName = $(this).attr('id');
		var prevDivName = divName+"Preview";
		var output = $(this).val();
		$("label[for='"+prevDivName+"']").empty().append( $ESAPI.encoder().encodeForHTML(output) );
	});
	
	
	//update question
	$("#questionInput").on("keyup", '.form-control', function(){
		var divName = $(this).attr('id');
		var prevDivName = divName+"Preview";
		var output = $(this).val();
		$("#questionPreview").empty().append( $ESAPI.encoder().encodeForHTML(output) );
	});
	
	//update buttons vote and see results
	$("#voteLabel").keyup(function() {
		var output = $(this).val();
		$("#btn_previewVote").empty().append(output);
	});
	$("#resultsLabel").keyup(function() {
		var output = $(this).val();
		$("#btn_previewSeeResults").empty().append(output);
	});
	
	//change between radio buttons e check boxes
	$("#multSelect").click(function() {
		if($("#multSelect").is(':checked'))
			choiceType = "checkbox";
		else choiceType = "radio";
		
		$(".choicePreview").each(function(i) {
			var checkbox = $(this);//$("#choice1Preview");
			var id = checkbox.attr('id');
			checkbox.replaceWith('<input type="' + choiceType + '" id="'+id+'" class="choicePreview" name="choicePrev">');
			});
		});
				
		
//		
});

