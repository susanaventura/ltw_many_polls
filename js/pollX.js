/*
$.ajax({
        url : '../php/pollXPage.php',
        //type : 'POST',
        //data : 'data',
        success : function (result) {
			alert(result["ajax"]); // "Hello world!" alerted
           //console.log(result['advert']) // The value of your php $row['adverts'] will be displayed
          // alert(userAnswers); // "Hello world!" alerted
           //console.log(userAnswers[0]) // The value of your php $row['adverts'] will be displayed
        },
        error : function () {
           alert("error");
        }
    })
		
*/

/*

function showResults(){
$.ajax({
			type: "GET",
			url: "../database/polls_getResults.php",
			data: { "id":1 },
			success: function(result){
			   alert(result);
			   //show results
			   
			},
			error: function(){
			   alert('error');
			}

		}); // Ajax Call
}

*/
	
function showResults(){
	
	//$results = document.getElementById("chart").getAttribute("value");
	//alert($results);
	
	drawCharts('blablabla', '1', 'nhe');
}
