
//$(document).ready(function(){

function removeChoice(divName) {
			
	alert(divName + " " + choiceCnt);
	$("."+divName).on("click",".remove_field", function(e){ //user click on remove text
		if(choiceCnt > 1){
			var divId = $(this).attr('id');
			alert(divId);
			e.preventDefault();
			$(this).parent('.wrapperChoice').remove();
			alert(document.body.innerHTML);
			choiceCnt--;
		} else {alert("You only have one choice field, you cannot remove it");}
	});
		
	
};


	
	
	//dynamically add choice field
	var choiceCnt = 1; //initial text box count
	var maxChoices = 10;
	function addChoice(divName){
		if(choiceCnt == maxChoices){
			alert("You have reached the number of choices limit ("+choiceCnt+")");
		} else {
			choiceCnt++;
			//add to form
			var newdiv = document.createElement('div');
			newdiv.className = "wrapperChoice";
			newdiv.innerHTML = "<input id='choice"+choiceCnt+"' type='text' class='form-control' name='choices[]' placeholder='Enter choice'> "+
								'<a href="#" id="remove_choice"'+choiceCnt+
								' class="remove_field" onClick="removeChoice(\'wrapperChoice\'); return false;">x</a>';
			document.getElementById(divName).appendChild(newdiv);
					
			//add to preview form
			newdiv = document.createElement('div');
			newdiv.innerHTML = "<input type='checkbox' id='choice"+choiceCnt+"' class='choicePreview'> <label for='choice"+choiceCnt+"Preview'></label>";
			//"<p id='choice"+choiceCnt+"Preview'></p>";
			document.getElementById('previewChoices').appendChild(newdiv);
			
		}
	};
	
	

	
//});
	
	
$(document).ready(function(){

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