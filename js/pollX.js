	
function showResults(questionId){
	
	console.log("question "+questionId);
	
	$.ajax({
			type: "GET",
			url: "../php/action_getResults.php",
			data: {	question : questionId},
			dataType: 'json',
			success: function (res){
				console.log(res['answers']);
				$('#resultsDiv').show();
				$('#resultsDiv')[0].scrollIntoView(true);
				drawCharts(res['questionText'], res['answers']);
			},
			error: function(res, status) {
				console.log(res);
				console.log(status);
				return false;
			}
		});

}


$(document).ready(function() {
	$('#resultsDiv').hide();

});


