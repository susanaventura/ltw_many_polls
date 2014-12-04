// Load the Visualization API and the piechart package.
  google.load('visualization', '1.0', {'packages':['corechart']});

  // Set a callback to run when the Google Visualization API is loaded.
  //google.setOnLoadCallback(drawChart);

  // Callback that creates and populates a data table,
  // instantiates the pie chart, passes in the data and
  // draws it.
  function drawCharts(questionText, results) {

	// Create the data table.
	var data = new google.visualization.DataTable();
	data.addColumn('string', 'Topping');
	data.addColumn('number', 'Slices');
	
	answers = ["oi", "oioi"];
	values = ["1", "2"]
	
		/*
  for ( var i = 0; i < answers.length; i++ ) {
	  data.addRow([JSON.stringify(answers[i]), JSON.stringify(values[i])]);
  }*/
	/*
	data.addRows([
	  ['Mushrooms', 3],
	  ['Onions', 1],
	  ['Olives', 1],
	  ['Zucchini', 1],
	  ['Pepperoni', 2]
	]);*/
	
	data.addRows(results);

	// Set chart options
	var options = {'title': questionText,
				   'width':600,
				   'height':500,
				   'backgroundColor': 'transparent'};
	//options.title=questionText;
			   
	//change image to img-transparent
	var img = document.getElementById('pollImage');
	$(img).addClass("img-transparent");
			   
	// Instantiate and draw our chart, passing in some options.
	$chartDiv = 'chart_div1';
	//alert(alertDiv);
	var chart = new google.visualization.PieChart(document.getElementById("chart_div1"));
	chart.draw(data, options);
  }