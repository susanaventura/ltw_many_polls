	
function showResults(questionId){
	
	//$results = document.getElementById("chart").getAttribute("value");
	//alert($results);
	console.log("question "+questionId);
	$.ajax({
			type: "GET",
			url: "../php/action_getResults.php",
			data: {	question : questionId},
			dataType: 'json',
			success: function (res){
				console.log(res);
			},
			error: function(res, status) {
				console.log(res);
				console.log(status);
				return false;
			}
		});
	
	
	
	
	//drawCharts('blablabla', '1', 'nhe');
}
