

//dynamically add choice field
var choiceCnt = 1; //initial text box count
var maxChoices = 10;
function addChoice(divName){
	if(Object.keys(options).length == maxChoices){
		alert("You have reached the number of choices limit ("+choiceCnt+")");
	} else {
		choiceCnt++;
		//add to form
		var newdiv = document.createElement('div');
		newdiv.className = "wrapperChoice";
		newdiv.innerHTML = "<input id='choice"+choiceCnt+"' type='text' class='form-control' name='choices[]' placeholder='Enter choice'> "+
							"<a href='#' id='remove_choice"+choiceCnt+
							"' class='remove_field'>x</a>";
		document.getElementById(divName).appendChild(newdiv);
		
		//add to preview form
		newdiv = document.createElement('div');
		newdiv.className = "wrapperPrevChoice";
		newdiv.innerHTML = "<input type='checkbox' id='choice"+choiceCnt+"Preview' class='choicePreview'> <label for='choice"+choiceCnt+"Preview'></label>";

		document.getElementById('previewChoices').appendChild(newdiv);
		options['choice'+choiceCnt+'Preview'] = newdiv;
		console.log(options);
	}
};
	
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
		$("label[for='"+prevDivName+"']").empty().append(output);
	});
	
	//update question
	$("#questionInput").on("keyup", '.form-control', function(){
		var divName = $(this).attr('id');
		var prevDivName = divName+"Preview";
		var output = $(this).val();
		$("#questionPreview").empty().append(output);
	});
	

});